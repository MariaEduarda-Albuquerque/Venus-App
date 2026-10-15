<?php

namespace App\Http\Controllers;

use App\Models\ProfissionalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CadastroController extends Controller
{
    private const ABAS = [
        'p' => 'em_analise',
        'r' => 'pendencia',
        'a' => 'aprovado',
        'x' => 'reprovado',
    ];

    private const STATUS = [
        'em_analise' => ['rotulo' => 'Pendente',           'classe' => 'lst-status--pendente'],
        'pendencia'  => ['rotulo' => 'Reenvio solicitado', 'classe' => 'lst-status--reenvio'],
        'aprovado'   => ['rotulo' => 'Aprovado',           'classe' => 'lst-status--ok'],
        'reprovado'  => ['rotulo' => 'Reprovado',          'classe' => ''],
    ];

    private const CONSULTAS = [
        'medico'     => 'https://portal.cfm.org.br/',
        'psicologo'  => 'https://www.cfp.org.br/',
        'enfermeiro' => 'https://www.cofen.gov.br/',
    ];

    public function index(Request $request)
    {
        $aba      = array_key_exists($request->input('aba'), self::ABAS) ? $request->input('aba') : 'p';
        $conselho = trim((string) $request->input('conselho', ''));
        $busca    = trim((string) $request->input('busca', ''));

        $contagens = ProfissionalModel::where('statusConta', '!=', 'excluida')
            ->selectRaw('statusVerificacao, count(*) as total')
            ->groupBy('statusVerificacao')
            ->pluck('total', 'statusVerificacao');

        $conselhos = ProfissionalModel::whereNotNull('categoriaProfissional')
            ->distinct()->orderBy('categoriaProfissional')
            ->pluck('categoriaProfissional');

        $cadastros = ProfissionalModel::where('statusConta', '!=', 'excluida')
            ->where('statusVerificacao', self::ABAS[$aba])
            ->when($conselho !== '', fn ($q) => $q->where('categoriaProfissional', $conselho))
            ->when($busca !== '', function ($q) use ($busca) {
                $q->where(function ($q) use ($busca) {
                    $q->where('nomeProfissionalSaude', 'like', "%{$busca}%")
                      ->orWhere('emailProfissionalSaude', 'like', "%{$busca}%")
                      ->orWhere('especialidadeProfissionalSaude', 'like', "%{$busca}%");
                });
            })
            ->orderBy('dataCadastro')
            ->paginate(10)
            ->appends(array_filter(compact('aba', 'conselho', 'busca')));

        return view('usuario.aprovar-cadastros', [
            'cadastros'  => $cadastros,
            'contagens'  => $contagens,
            'conselhos'  => $conselhos,
            'aba'        => $aba,
            'conselho'   => $conselho,
            'busca'      => $busca,
            'statusInfo' => self::STATUS,
        ]);
    }

    public function show(ProfissionalModel $profissional)
    {
        // Marca como lida a notificação deste cadastro
        $admin = auth('admin')->user();
        if ($admin && method_exists($admin, 'unreadNotifications')) {
            $admin->unreadNotifications
                ->where('data.profissional_id', $profissional->getKey())
                ->each->markAsRead();
        }

        [$fila, $posicao] = $this->fila($profissional);

        $historico = DB::table('tbverificacaoprofissional')
            ->where('codProfissionalSaude', $profissional->getKey())
            ->orderByDesc('created_at')
            ->get();

        return view('usuario.aprovar-cadastro', [
            'profissional' => $profissional,
            'statusInfo'   => self::STATUS,
            'consulta'     => self::CONSULTAS[$profissional->categoriaProfissional] ?? null,
            'historico'    => $historico,
            'fila'         => $fila->count(),
            'posicao'      => $posicao === false ? null : $posicao + 1,
            'anterior'     => $posicao !== false && $posicao > 0 ? $fila[$posicao - 1] : null,
            'proximo'      => $posicao !== false ? ($fila[$posicao + 1] ?? null) : null,
        ]);
    }

    /** Serve os comprovantes do disco privado compartilhado (só admin logado). */
    public function documento(ProfissionalModel $profissional, string $tipo)
    {
        $campo = [
            'comprovante'  => 'comprovanteConselhoClasseProfissional',
            'complementar' => 'documentoComplementarProfissional',
        ][$tipo] ?? abort(404);

        $caminho = $profissional->{$campo};

        abort_unless($caminho && Storage::disk('documentos')->exists($caminho), 404);

        return Storage::disk('documentos')->response($caminho);
    }

    public function decidir(Request $request, ProfissionalModel $profissional)
    {
        if ($profissional->statusVerificacao !== 'em_analise') {
            return back()->withErrors(['decisao' => 'Este cadastro não está mais aguardando análise.']);
        }

        $dados = $request->validate([
            'decisao' => ['required', 'in:aprovar,reenvio,reprovar'],
            'motivo'  => ['required_unless:decisao,aprovar', 'nullable', 'string', 'min:10', 'max:500'],
        ], [
            'motivo.required_unless' => 'Escreva o motivo com pelo menos 10 caracteres.',
            'motivo.min'             => 'Escreva o motivo com pelo menos 10 caracteres.',
        ]);

        // Aprovar exige os 5 itens do checklist marcados (validado no servidor)
        if ($dados['decisao'] === 'aprovar' && count($request->input('checklist', [])) < 5) {
            return back()->withInput()
                ->withErrors(['checklist' => 'Marque os 5 itens do checklist para aprovar.']);
        }

        $novoStatus = ['aprovar' => 'aprovado', 'reenvio' => 'pendencia', 'reprovar' => 'reprovado'][$dados['decisao']];

        // Calcula o próximo da fila antes de mudar o status
        [$fila, $posicao] = $this->fila($profissional);
        $proximo = $posicao !== false ? ($fila[$posicao + 1] ?? null) : null;

        DB::transaction(function () use ($profissional, $novoStatus, $dados) {
            $profissional->update(['statusVerificacao' => $novoStatus]);

            DB::table('tbverificacaoprofissional')->insert([
                'codProfissionalSaude' => $profissional->getKey(),
                'admin_id'             => auth('admin')->id(),
                'decisao'              => $novoStatus,
                'motivo'               => $dados['decisao'] === 'aprovar' ? null : $dados['motivo'],
                'created_at'           => now(),
                'updated_at'           => now(),
            ]);
        });

        $mensagens = [
            'aprovado'  => 'Cadastro aprovado.',
            'pendencia' => 'Reenvio solicitado ao profissional.',
            'reprovado' => 'Cadastro reprovado.',
        ];

        $destino = $proximo
            ? redirect()->route('cadastro.aprovar', $proximo)
            : redirect()->route('cadastros.aprovar');

        return $destino->with('sucesso', $mensagens[$novoStatus]);
    }

    /** Fila de pendentes (mais antigos primeiro) e a posição do cadastro nela. */
    private function fila(ProfissionalModel $profissional): array
    {
        $chave = $profissional->getKeyName();

        $fila = ProfissionalModel::where('statusVerificacao', 'em_analise')
            ->where('statusConta', '!=', 'excluida')
            ->orderBy('dataCadastro')->orderBy($chave)
            ->pluck($chave)->values();

        return [$fila, $fila->search($profissional->getKey())];
    }
}