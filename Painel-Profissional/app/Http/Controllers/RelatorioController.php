<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\TipoCategoria;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

// Relatório de conteúdo: publicações, status, categorias e alcance do profissional logado.
class RelatorioController extends Controller
{
    const POR_PAGINA = 10;

    private $mesesCurtos = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

    private function periodo(Request $request)
    {
        $hoje = Carbon::now(AgendaController::FUSO)->startOfDay();
        $chave = in_array($request->periodo, ['7', '30', '90', 'personalizado']) ? $request->periodo : '30';
        $erro = null;
        $inicio = null;
        $fim = null;

        if ($chave == 'personalizado') {
            $v = validator($request->all(), [
                'inicio' => 'required|date_format:Y-m-d',
                'fim' => 'required|date_format:Y-m-d',
            ], [
                'inicio.required' => 'Informe a data inicial.',
                'inicio.date_format' => 'Data inicial inválida.',
                'fim.required' => 'Informe a data final.',
                'fim.date_format' => 'Data final inválida.',
            ]);

            if ($v->fails()) {
                $erro = $v->errors()->first();
            } else {
                $inicio = Carbon::createFromFormat('!Y-m-d', $request->inicio, AgendaController::FUSO);
                $fim = Carbon::createFromFormat('!Y-m-d', $request->fim, AgendaController::FUSO);

                if ($fim->lt($inicio)) {
                    $erro = 'A data final deve ser igual ou depois da data inicial.';
                } elseif ($fim->gt($inicio->copy()->addDays(366))) {
                    $erro = 'O período personalizado pode ter no máximo 1 ano.';
                } elseif ($fim->gt($hoje)) {
                    $fim = $hoje->copy();
                    if ($inicio->gt($fim)) {
                        $erro = 'A data inicial não pode estar no futuro.';
                    }
                }
            }

            if ($erro) {
                $chave = '30';
            }
        }

        if ($chave != 'personalizado') {
            $inicio = $hoje->copy()->subDays((int) $chave - 1);
            $fim = $hoje->copy();
        }

        return [$chave, $inicio, $fim, $erro];
    }

    private function montar(Request $request)
    {
        $profissional = User::find(session('id'));
        list($chave, $inicio, $fim, $erro) = $this->periodo($request);

        $ini = $inicio->format('Y-m-d') . ' 00:00:00';
        $final = $fim->format('Y-m-d') . ' 23:59:59';

        $categorias = TipoCategoria::orderBy('nomeTipoCategoria')->get();
        $categoriaId = (int) $request->categoria ?: null;
        if ($categoriaId && !$categorias->contains('codTipoCategoria', $categoriaId)) {
            $categoriaId = null;
        }
        $categoriaNome = $categoriaId ? $categorias->firstWhere('codTipoCategoria', $categoriaId)->nomeTipoCategoria : null;

        // Data de referência: publicação (se já publicado) ou criação
        $data = function ($c) { return $c->dataPublicacao ?? $c->dataCriacao; };

        $consulta = function () use ($categoriaId) {
            $q = Conteudo::with(['categoria', 'tipo'])->where('codProfissionalSaude', session('id'));
            if ($categoriaId) {
                $q->where('codTipoCategoria', $categoriaId);
            }
            return $q;
        };

        $itens = $consulta()
            ->whereRaw('COALESCE(dataPublicacao, dataCriacao) BETWEEN ? AND ?', [$ini, $final])
            ->get()
            ->sortByDesc(function ($c) use ($data) { return $data($c)->format('Y-m-d H:i:s'); })
            ->values();

        $publicados = $itens->where('statusConteudo', 'publicado');
        $decididos = $itens->whereIn('statusConteudo', ['publicado', 'recusado'])->count();
        $cards = [
            'publicacoes' => $itens->count(),
            'publicados' => $publicados->count(),
            'taxaAprovacao' => $decididos ? round($publicados->count() / $decididos * 100) : null,
            'visualizacoes' => (int) $publicados->sum('visualizacoesConteudo'),
            'curtidas' => (int) $publicados->sum('curtidasConteudo'),
        ];

        // Status
        $porStatus = [];
        foreach (Conteudo::STATUS as $k => $rotulo) {
            $porStatus[] = ['chave' => $k, 'rotulo' => $rotulo, 'total' => $itens->where('statusConteudo', $k)->count()];
        }

        // Categorias
        $porCategoria = $itens->groupBy('codTipoCategoria')->map(function ($grupo) {
            $pub = $grupo->where('statusConteudo', 'publicado');
            return [
                'categoria' => optional($grupo->first()->categoria)->nomeTipoCategoria ?? 'Sem categoria',
                'total' => $grupo->count(),
                'publicados' => $pub->count(),
                'visualizacoes' => (int) $pub->sum('visualizacoesConteudo'),
                'curtidas' => (int) $pub->sum('curtidasConteudo'),
            ];
        })->sortByDesc('total')->values()->all();

        // Publicações por mês (mesma regra de janela do relatório anterior: 6 a 12 meses)
        $mesFim = $fim->copy()->startOfMonth();
        $mesIni = $inicio->copy()->startOfMonth();
        $qtdMeses = ($fim->year - $inicio->year) * 12 + $fim->month - $inicio->month + 1;
        if ($qtdMeses < 6) $mesIni = $mesFim->copy()->subMonths(5);
        if ($qtdMeses > 12) $mesIni = $mesFim->copy()->subMonths(11);

        $porMes = $consulta()
            ->whereRaw('COALESCE(dataPublicacao, dataCriacao) BETWEEN ? AND ?', [$mesIni->format('Y-m-d') . ' 00:00:00', $final])
            ->get()
            ->groupBy(function ($c) use ($data) { return $data($c)->format('Y-m'); });

        $grafico = [];
        for ($m = $mesIni->copy(); $m->lte($mesFim); $m->addMonth()) {
            $grafico[] = [
                'rotulo' => $this->mesesCurtos[$m->month - 1] . '/' . $m->format('y'),
                'total' => isset($porMes[$m->format('Y-m')]) ? $porMes[$m->format('Y-m')]->count() : 0,
            ];
        }

        $linhas = $itens->map(function ($c) use ($data) {
            return [
                'data' => $data($c)->format('d/m/Y'),
                'titulo' => $c->tituloConteudo,
                'tipo' => optional($c->tipo)->descricaoTipoConteudo ?? '—',
                'categoria' => optional($c->categoria)->nomeTipoCategoria ?? '—',
                'status' => $c->status_rotulo,
                'statusChave' => $c->statusConteudo,
                'visualizacoes' => $c->statusConteudo == 'publicado' ? (int) $c->visualizacoesConteudo : null,
                'curtidas' => $c->statusConteudo == 'publicado' ? (int) $c->curtidasConteudo : null,
            ];
        })->all();

        $periodoTexto = ($chave == 'personalizado' ? '' : 'Últimos ' . $chave . ' dias · ')
            . $inicio->format('d/m/Y') . ' a ' . $fim->format('d/m/Y')
            . ($categoriaNome ? ' · Categoria: ' . $categoriaNome : '');

        $filtro = ['periodo' => $chave];
        if ($chave == 'personalizado') {
            $filtro['inicio'] = $inicio->format('Y-m-d');
            $filtro['fim'] = $fim->format('Y-m-d');
        }
        if ($categoriaId) {
            $filtro['categoria'] = $categoriaId;
        }

        return compact(
            'profissional', 'chave', 'inicio', 'fim', 'erro', 'cards', 'porStatus', 'porCategoria', 'grafico',
            'linhas', 'periodoTexto', 'filtro', 'categorias', 'categoriaId'
        );
    }

    public function index(Request $request)
    {
        $d = $this->montar($request);

        $total = count($d['linhas']);
        $paginas = max(1, (int) ceil($total / self::POR_PAGINA));
        $pagina = min(max(1, (int) $request->pagina), $paginas);

        $d['linhasTabela'] = array_slice($d['linhas'], ($pagina - 1) * self::POR_PAGINA, self::POR_PAGINA);
        $d['paginacao'] = ['pagina' => $pagina, 'paginas' => $paginas, 'total' => $total];
        $d['hoje'] = Carbon::now(AgendaController::FUSO)->format('Y-m-d');

        return view('painelProfissional.relatorios', $d);
    }

    // Versão para impressão; o botão "Exportar PDF" da tela gera o arquivo a partir dela
    public function exportar(Request $request)
    {
        $d = $this->montar($request);
        $d['linhasTabela'] = $d['linhas'];
        $d['paginacao'] = null;
        $d['geradoEm'] = Carbon::now(AgendaController::FUSO)->format('d/m/Y H:i');

        return view('painelProfissional.relatorio-pdf', $d);
    }

    // Planilha em CSV (separador ";" e UTF-8 com BOM, para abrir direto no Excel em português)
    public function planilha(Request $request)
    {
        $d = $this->montar($request);

        // Evita que o Excel execute fórmulas em textos que começam com = + - @
        $seguro = function ($v) {
            $v = (string) $v;
            return $v !== '' && strpbrk($v[0], "=+-@\t\r") ? "'" . $v : $v;
        };

        $nome = 'relatorio-de-conteudo-' . $d['inicio']->format('Ymd') . '-' . $d['fim']->format('Ymd') . '.csv';

        return response()->streamDownload(function () use ($d, $seguro) {
            $f = fopen('php://output', 'w');
            fwrite($f, "\xEF\xBB\xBF");
            $linha = function (array $campos) use ($f) { fputcsv($f, $campos, ';'); };

            $linha(['Relatório de conteúdo']);
            $linha(['Profissional', $seguro($d['profissional']->nomeProfissionalSaude ?? '')]);
            $linha(['Filtro', $seguro($d['periodoTexto'])]);
            $linha([]);

            $linha(['Resumo']);
            $linha(['Publicações no período', $d['cards']['publicacoes']]);
            $linha(['Publicados', $d['cards']['publicados']]);
            $linha(['Taxa de aprovação (%)', $d['cards']['taxaAprovacao'] ?? '']);
            $linha(['Visualizações', $d['cards']['visualizacoes']]);
            $linha(['Curtidas', $d['cards']['curtidas']]);
            $linha([]);

            $linha(['Por status']);
            $linha(['Status', 'Quantidade']);
            foreach ($d['porStatus'] as $s) {
                $linha([$s['rotulo'], $s['total']]);
            }
            $linha([]);

            $linha(['Por categoria']);
            $linha(['Categoria', 'Publicações', 'Publicados', 'Visualizações', 'Curtidas']);
            foreach ($d['porCategoria'] as $c) {
                $linha([$seguro($c['categoria']), $c['total'], $c['publicados'], $c['visualizacoes'], $c['curtidas']]);
            }
            $linha([]);

            $linha(['Publicações']);
            $linha(['Data', 'Título', 'Tipo', 'Categoria', 'Status', 'Visualizações', 'Curtidas']);
            foreach ($d['linhas'] as $l) {
                $linha([$l['data'], $seguro($l['titulo']), $seguro($l['tipo']), $seguro($l['categoria']), $l['status'], $l['visualizacoes'] ?? '', $l['curtidas'] ?? '']);
            }

            fclose($f);
        }, $nome, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}
