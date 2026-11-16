<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Histórico de tudo que o profissional já publicou: campanhas e conteúdos educativos.
// Uma "campanha" é um conteúdo cujo tipo (tbtipoconteudo) é "Campanha".
class PublicacaoController extends Controller
{
    const POR_PAGINA = 10;

    const PERIODOS = [
        'todos' => 'Todos os períodos',
        '30dias' => 'Últimos 30 dias',
        '90dias' => 'Últimos 90 dias',
        '12meses' => 'Últimos 12 meses',
    ];

    // O profissional vê só o que ele publicou
    private function meus()
    {
        return Conteudo::with(['categoria', 'tipo'])->where('codProfissionalSaude', session('id'));
    }

    private function meu($id)
    {
        return $this->meus()->where('codConteudo', $id)->firstOrFail();
    }

    private function soCampanhas($query)
    {
        return $query->whereHas('tipo', function ($t) {
            $t->whereRaw('LOWER(descricaoTipoConteudo) = ?', [Conteudo::TIPO_CAMPANHA]);
        });
    }

    private function semCampanhas($query)
    {
        return $query->whereDoesntHave('tipo', function ($t) {
            $t->whereRaw('LOWER(descricaoTipoConteudo) = ?', [Conteudo::TIPO_CAMPANHA]);
        });
    }

    public function index(Request $request)
    {
        $profissional = User::find(session('id'));

        $aba = in_array($request->aba, ['campanhas', 'conteudos']) ? $request->aba : 'todos';
        $busca = trim((string) $request->q);
        $status = ($request->status == 'arquivado' || array_key_exists($request->status, Conteudo::STATUS)) ? $request->status : '';
        $periodo = array_key_exists($request->periodo, self::PERIODOS) ? $request->periodo : 'todos';
        $tipoId = (int) $request->tipo ?: null;

        $contagens = [
            'todos' => $this->meus()->whereNull('arquivadoEm')->count(),
            'campanhas' => $this->soCampanhas($this->meus()->whereNull('arquivadoEm'))->count(),
            'conteudos' => $this->semCampanhas($this->meus()->whereNull('arquivadoEm'))->count(),
        ];
        $totalGeral = $this->meus()->count();

        $query = $this->meus();

        if ($status == 'arquivado') {
            $query->whereNotNull('arquivadoEm');
        } else {
            $query->whereNull('arquivadoEm');
            if ($status) {
                $query->where('statusConteudo', $status);
            }
        }

        if ($aba == 'campanhas') {
            $this->soCampanhas($query);
        } elseif ($aba == 'conteudos') {
            $this->semCampanhas($query);
        }

        if ($tipoId) {
            $query->where('codTipoConteudo', $tipoId);
        }

        if ($busca !== '') {
            $query->where('tituloConteudo', 'like', '%' . addcslashes($busca, '%_\\') . '%');
        }

        $agora = Carbon::now(AgendaController::FUSO);
        $limite = null;
        if ($periodo == '30dias') $limite = $agora->copy()->subDays(30);
        if ($periodo == '90dias') $limite = $agora->copy()->subDays(90);
        if ($periodo == '12meses') $limite = $agora->copy()->subMonths(12);
        if ($limite) {
            $query->whereRaw('COALESCE(dataPublicacao, dataCriacao) >= ?', [$limite->startOfDay()->format('Y-m-d H:i:s')]);
        }

        $total = (clone $query)->count();
        $paginas = max(1, (int) ceil($total / self::POR_PAGINA));
        $pagina = min(max(1, (int) $request->pagina), $paginas);

        $itens = $query->orderByRaw('COALESCE(dataPublicacao, dataCriacao) DESC')
            ->skip(($pagina - 1) * self::POR_PAGINA)->take(self::POR_PAGINA)->get();

        $tipos = TipoConteudo::orderBy('codTipoConteudo')->get();
        $periodos = self::PERIODOS;
        $statusLista = Conteudo::STATUS + ['arquivado' => 'Arquivado'];

        $filtros = array_filter([
            'aba' => $aba != 'todos' ? $aba : null,
            'q' => $busca ?: null,
            'tipo' => $tipoId,
            'status' => $status ?: null,
            'periodo' => $periodo != 'todos' ? $periodo : null,
        ]);
        $temFiltro = count(array_diff_key($filtros, ['aba' => 1])) > 0;

        return view('painelProfissional.publicacoes', compact(
            'profissional', 'itens', 'aba', 'busca', 'status', 'periodo', 'tipoId', 'tipos', 'periodos', 'statusLista',
            'contagens', 'totalGeral', 'total', 'pagina', 'paginas', 'filtros', 'temFiltro'
        ));
    }

    public function show($id)
    {
        $profissional = User::find(session('id'));
        $item = $this->meu($id);

        return view('painelProfissional.publicacao-detalhe', compact('profissional', 'item'));
    }

    public function editar($id)
    {
        $profissional = User::find(session('id'));
        $item = $this->meu($id);

        if (!in_array($item->statusConteudo, ['rascunho', 'recusado'])) {
            return redirect()->route('publicacoes.show', $id)
                ->with('erro', 'Só é possível editar rascunhos ou itens recusados.');
        }

        $categorias = TipoCategoria::orderBy('codTipoCategoria')->get();
        $tipos = TipoConteudo::orderBy('codTipoConteudo')->get();

        return view('painelProfissional.publicacao-editar', compact('profissional', 'item', 'categorias', 'tipos'));
    }

    public function atualizar(Request $request, $id)
    {
        $item = $this->meu($id);

        if (!in_array($item->statusConteudo, ['rascunho', 'recusado'])) {
            return redirect()->route('publicacoes.show', $id)
                ->with('erro', 'Só é possível editar rascunhos ou itens recusados.');
        }

        $request->validate([
            'tituloConteudo' => 'required|string|max:150',
            'codTipoCategoria' => 'required|exists:tbtipocategoria,codTipoCategoria',
            'codTipoConteudo' => 'required|exists:tbtipoconteudo,codTipoConteudo',
            'corpoConteudo' => 'required_if:acao,revisao|nullable|string',
            'acao' => 'required|in:rascunho,revisao',
        ], [
            'tituloConteudo.required' => 'Informe o título.',
            'tituloConteudo.max' => 'O título deve ter no máximo 150 caracteres.',
            'codTipoCategoria.required' => 'Escolha uma categoria.',
            'codTipoCategoria.exists' => 'Categoria inválida.',
            'codTipoConteudo.required' => 'Escolha o tipo.',
            'codTipoConteudo.exists' => 'Tipo inválido.',
            'corpoConteudo.required_if' => 'Escreva o texto antes de enviar para revisão.',
        ]);

        $corpo = $request->corpoConteudo ?? '';

        $item->tituloConteudo = $request->tituloConteudo;
        $item->corpoConteudo = $corpo;
        $item->tempoLeituraMinutos = Conteudo::calcularTempoLeitura($corpo);
        $item->codTipoCategoria = $request->codTipoCategoria;
        $item->codTipoConteudo = $request->codTipoConteudo;

        if ($request->acao == 'revisao') {
            $item->statusConteudo = 'em_revisao';
            $item->motivoRecusaConteudo = null;
            $mensagem = 'Enviado para revisão editorial.';
        } else {
            $item->statusConteudo = 'rascunho';
            $mensagem = 'Rascunho salvo com sucesso.';
        }

        $item->save();

        return redirect()->route('publicacoes.show', $id)->with('sucesso', $mensagem);
    }

    // Duplicar: cria um rascunho novo com o mesmo texto, para reutilizar o conteúdo
    public function duplicar($id)
    {
        $item = $this->meu($id);

        $copia = Conteudo::create([
            'tituloConteudo' => Str::limit($item->tituloConteudo, 140, '') . ' (cópia)',
            'corpoConteudo' => $item->corpoConteudo,
            'capaConteudo' => $item->capaConteudo,
            'tempoLeituraMinutos' => $item->tempoLeituraMinutos,
            'codTipoCategoria' => $item->codTipoCategoria,
            'codTipoConteudo' => $item->codTipoConteudo,
            'codProfissionalSaude' => session('id'),
            'statusConteudo' => 'rascunho',
        ]);

        return redirect()->route('publicacoes.editar', $copia->codConteudo)
            ->with('sucesso', 'Duplicado como rascunho. Edite e envie para revisão quando quiser.');
    }

    public function arquivar($id)
    {
        $item = $this->meu($id);

        if ($item->statusConteudo != 'publicado' || $item->arquivadoEm) {
            return redirect()->route('publicacoes.show', $id)->with('erro', 'Só é possível arquivar itens publicados.');
        }

        $item->arquivadoEm = now();
        $item->save();

        return redirect()->route('publicacoes.index')->with('sucesso', 'Arquivado. Ele não aparece mais como publicação ativa.');
    }

    public function desarquivar($id)
    {
        $item = $this->meu($id);
        $item->arquivadoEm = null;
        $item->save();

        return redirect()->route('publicacoes.show', $id)->with('sucesso', 'Item desarquivado.');
    }

    public function excluir($id)
    {
        $item = $this->meu($id);

        if (!in_array($item->statusConteudo, ['rascunho', 'recusado'])) {
            return redirect()->route('publicacoes.show', $id)->with('erro', 'Só é possível excluir rascunhos ou itens recusados. Para itens publicados, use Arquivar.');
        }

        $item->delete();

        return redirect()->route('publicacoes.index')->with('sucesso', 'Item excluído.');
    }
}
