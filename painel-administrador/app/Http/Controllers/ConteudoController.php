<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConteudoRequest;
use App\Models\Conteudo;
use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ConteudoController extends Controller
{

    /**
     * Lista os conteúdos criados pelo próprio administrador logado.
     */
    public function index(): View
    {
        $admin = auth('admin')->user();

        if (!$admin) {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        $conteudos = DB::table('tbconteudo as c')
            ->leftJoin(
                'codtipocategoria as cat',
                'c.codTipoCategoria',
                '=',
                'cat.codTipoCategoria'
            )
            ->join(
                'tbtipoconteudo as tipo',
                'c.codTipoConteudo',
                '=',
                'tipo.codTipoConteudo'
            )
            ->where('c.codAdminCriador', $admin->codAdmin)
            ->whereNull('c.arquivadoEm')
            ->select(
                'c.*',
                'cat.nomeTipoCategoria',
                'tipo.descricaoTipoConteudo'
            )
            ->orderByDesc('c.dataCriacao')
            ->get();

        return view('historico.meus-conteudos', compact('conteudos'));
    }


    public function create(): View
    {
        $categorias = TipoCategoria::orderBy('nomeTipoCategoria')->get();

        $formatos = TipoConteudo::orderBy('descricaoTipoConteudo')->get();

        return view('historico.criar-conteudo', compact(
            'categorias',
            'formatos'
        ));
    }

    /**
     * Salva um conteúdo como rascunho ou publica diretamente.
     */
    public function store(ConteudoRequest $request): RedirectResponse
    {
        $admin = auth('admin')->user();

        // Segurança: somente administradores podem criar conteúdos.
        if (!$admin) {
            abort(403, 'Apenas administradores podem criar conteúdos.');
        }

        $acao = $request->input('acao');

        $status = $acao === 'publicar'
            ? 'publicado'
            : 'rascunho';

        $caminhoCapa = null;

        // Salva a imagem da capa, caso tenha sido enviada.
        if ($request->hasFile('capa')) {
            $caminhoCapa = $request->file('capa')
                ->store('capas-conteudos', 'public');
        }

        // Calcula o tempo estimado de leitura.
        $tempoLeitura = Conteudo::calcularTempoLeitura(
            $request->input('texto')
        );

        try {
            DB::transaction(function () use (
                $request,
                $admin,
                $status,
                $caminhoCapa,
                $tempoLeitura
            ) {
                $conteudo = Conteudo::create([
                    'tituloConteudo' => $request->input('titulo'),
                    'corpoConteudo' => $request->input('texto'),
                    'fontesConteudo' => $request->input('fontes'),

                    'capaConteudo' => $caminhoCapa,
                    'tempoLeituraMinutos' => $tempoLeitura,

                    'codTipoCategoria' => $request->input('categoria'),
                    'codTipoConteudo' => $request->input('formato'),

                    // Conteúdo criado diretamente pelo administrador.
                    'codProfissionalSaude' => null,
                    'codAdminCriador' => $admin->codAdmin,

                    'statusConteudo' => $status,

                    'dataEnvio' => null,
                    'dataPublicacao' => $status === 'publicado'
                        ? now()
                        : null,
                ]);

                // Registra a publicação direta no histórico administrativo.
                if ($status === 'publicado') {

                    DB::table('tbconteudoadmin')->insert([
                        'codConteudo' => $conteudo->codConteudo,
                        'codAdmin' => $admin->codAdmin,
                        'decisao' => 'aprovado',
                        'motivoDecisao' => 'Conteúdo publicado diretamente pelo administrador.',
                        'dataDecisao' => now(),
                    ]);

                    DB::table('tbconteudolog')->insert([
                        'codConteudo' => $conteudo->codConteudo,
                        'codAdmin' => $admin->codAdmin,
                        'acao' => 'publicou',
                        'dataLog' => now(),
                    ]);
                }
            });

        } catch (\Throwable $e) {

            // Remove a capa caso o cadastro no banco falhe.
            if ($caminhoCapa) {
                Storage::disk('public')->delete($caminhoCapa);
            }

            throw $e;
        }

        $mensagem = $status === 'publicado'
            ? 'Conteúdo publicado com sucesso!'
            : 'Conteúdo salvo como rascunho!';

        return redirect()
            ->back()
            ->with('sucesso', $mensagem);
    }

    /**
     * Tela "Conteúdos Aprender": conteúdos enviados por profissionais
     * (em revisão) e os já decididos. Rascunhos ficam de fora.
     */
    public function aprender(): View
    {
        if (!auth('admin')->check()) {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        $conteudos = Conteudo::comAutor()
            ->paraRevisao()
            ->orderByRaw('COALESCE(tbconteudo.dataEnvio, tbconteudo.dataCriacao) DESC')
            ->orderByDesc('tbconteudo.codConteudo')
            ->get();

        $contagem = [
            'recusado'  => $conteudos->where('statusConteudo', Conteudo::STATUS_RECUSADO)->count(),
            'analise'   => $conteudos->where('statusConteudo', Conteudo::STATUS_ANALISE)->count(),
            'publicado' => $conteudos->where('statusConteudo', Conteudo::STATUS_PUBLICADO)->count(),
        ];

        return view('conteudos.lista-conteudo-aprender', compact('conteudos', 'contagem'));
    }

    /**
     * Aprova (publica) ou recusa um conteúdo em revisão.
     * Responde em JSON, usado pelo fetch da tela.
     */
    public function decidir(Request $request, Conteudo $conteudo): JsonResponse
    {
        $admin = auth('admin')->user();

        if (!$admin) {
            return response()->json(['message' => 'Apenas administradores podem revisar conteúdos.'], 403);
        }

        // motivoDecisao (tbconteudoadmin) é varchar(255)
        $dados = $request->validate([
            'status' => ['required', 'in:publicado,recusado'],
            'motivo' => ['required_if:status,recusado', 'nullable', 'string', 'max:255'],
        ], [
            'motivo.required_if' => 'Informe o motivo da recusa.',
            'motivo.max'         => 'O motivo deve ter no máximo 255 caracteres.',
        ]);

        $aprovando = $dados['status'] === 'publicado';
        $motivo    = $aprovando ? null : trim($dados['motivo']);

        $resultado = DB::transaction(function () use ($conteudo, $admin, $aprovando, $motivo) {
            // Trava a linha para evitar duas decisões ao mesmo tempo
            $atual = Conteudo::lockForUpdate()->find($conteudo->getKey());

            if (!$atual || !$atual->emAnalise()) {
                return null;
            }

            $agora = now();

            $atual->update([
                'statusConteudo'       => $aprovando ? Conteudo::STATUS_PUBLICADO : Conteudo::STATUS_RECUSADO,
                'dataRevisaoConteudo'  => $agora,
                'dataPublicacao'       => $aprovando ? $agora : null,
                'motivoRecusaConteudo' => $motivo,
            ]);

            DB::table('tbconteudoadmin')->insert([
                'codConteudo'   => $atual->getKey(),
                'codAdmin'      => $admin->codAdmin,
                'decisao'       => $aprovando ? 'aprovado' : 'recusado',
                'motivoDecisao' => $motivo,
                'dataDecisao'   => $agora,
            ]);

            // acao é varchar(20)
            DB::table('tbconteudolog')->insert([
                'codConteudo' => $atual->getKey(),
                'codAdmin'    => $admin->codAdmin,
                'acao'        => $aprovando ? 'aprovou' : 'recusou',
                'dataLog'     => $agora,
            ]);

            return $atual;
        });

        if (!$resultado) {
            return response()->json(['message' => 'Este conteúdo já foi revisado.'], 409);
        }

        return response()->json([
            'status' => $resultado->statusUi,
            'motivo' => $resultado->motivoRecusaConteudo,
        ]);
    }
}