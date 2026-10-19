<?php

namespace App\Http\Controllers;

use App\Models\ProfissionalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfissionalController extends Controller
{
    public function index(Request $request)
    {
        $profissionais = ProfissionalModel::query()
            ->when(
                in_array($request->input('status'), ['ativa', 'suspensa', 'excluida']),
                fn ($query) => $query->where('statusConta', $request->input('status'))
            )
            ->when($request->filled('busca'), function ($query) use ($request) {
                $busca = $request->input('busca');

                $query->where(function ($q) use ($busca) {
                    $q->where('nomeProfissionalSaude', 'like', "%{$busca}%")
                      ->orWhere('emailProfissionalSaude', 'like', "%{$busca}%");
                });
            })
            ->orderByDesc('dataCadastro')
            ->paginate(10)
            ->withQueryString();

        $detalhe = null;

        if ($request->filled('detalhe')) {
            $detalhe = ProfissionalModel::find($request->input('detalhe'));
        }

        $confirmarExclusao = $request->input('excluir') == '1' && $detalhe !== null;

        return view('usuario.lista-profissionais', compact(
            'profissionais',
            'detalhe',
            'confirmarExclusao'
        ));
    }

    public function show(Request $request, ProfissionalModel $profissional)
    {
        $periodo = (int) $request->input('periodo', 30);
        if (! in_array($periodo, [7, 30, 90], true)) {
            $periodo = 30;
        }

        $desde = now()->subDays($periodo)->startOfDay();

        $noPeriodo = fn () => $profissional->atendimentos()->where('dataCadastro', '>=', $desde);

        $totalUsuarias  = $noPeriodo()->distinct()->count('codUsuaria');
        $tempoMedioMin  = (int) round($noPeriodo()->avg('tempoRespostaMinutos') ?? 0);
        $avaliacaoMedia = $noPeriodo()->whereNotNull('avaliacao')->avg('avaliacao');

        $tempoMedio = $tempoMedioMin > 0
            ? intdiv($tempoMedioMin, 60) . 'h ' . ($tempoMedioMin % 60) . 'min'
            : '—';

        $porMes = $profissional->atendimentos()
            ->where('dataCadastro', '>=', now()->subMonths(4)->startOfMonth())
            ->selectRaw("DATE_FORMAT(dataCadastro, '%Y-%m') as mes, COUNT(*) as total")
            ->groupBy('mes')
            ->pluck('total', 'mes');

        $labels  = [];
        $valores = [];
        for ($i = 4; $i >= 0; $i--) {
            $mes       = now()->subMonths($i);
            $labels[]  = ucfirst($mes->locale('pt_BR')->translatedFormat('F'));
            $valores[] = (int) ($porMes[$mes->format('Y-m')] ?? 0);
        }

        $recentes = $noPeriodo()->latest('dataCadastro')->limit(5)->get();

        return view('usuario.profissional-selecionado-lista', [
            'p'              => $profissional,
            'periodo'        => $periodo,
            'totalUsuarias'  => $totalUsuarias,
            'tempoMedio'     => $tempoMedio,
            'avaliacaoMedia' => $avaliacaoMedia !== null
                ? number_format($avaliacaoMedia, 1, ',', '')
                : '—',
            'labels'         => $labels,
            'valores'        => $valores,
            'recentes'       => $recentes,
        ]);
    }
    public function arquivo(ProfissionalModel $profissional, string $tipo)
    {
        $campos = [
            'foto'      => 'fotoPerfilProfissional',
            'conselho'  => 'comprovanteConselhoClasseProfissional',
            'documento' => 'documentoComplementarProfissional',
        ];

        // Disco(s) onde cada tipo de arquivo é gravado
        $discos = [
            'foto'      => ['perfil_profissional'],
            'conselho'  => ['venus'],
            'documento' => ['venus'],
        ];

        abort_unless(isset($campos[$tipo]), 404, 'Tipo inválido: ' . $tipo);

        $caminho = $profissional->{$campos[$tipo]};
        abort_unless($caminho, 404, 'Sem caminho no banco.');

        $tentados = [];

        foreach ($discos[$tipo] as $disco) {
            if (! array_key_exists($disco, config('filesystems.disks'))) {
                $tentados[] = "$disco: DISCO NÃO CONFIGURADO";
                continue;
            }

            $tentados[] = "$disco: " . Storage::disk($disco)->path($caminho);

            if (Storage::disk($disco)->exists($caminho)) {
                $arquivo = Storage::disk($disco)->get($caminho);

                $mime = Storage::disk($disco)->mimeType($caminho)
                    ?: 'application/octet-stream';

                return response($arquivo, 200)
                    ->header('Content-Type', $mime)
                    ->header('X-Content-Type-Options', 'nosniff')
                    ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
            }
        }

        abort(404, "Arquivo não encontrado.\n" . implode("\n", $tentados));
    }
    public function atualizarVerificacao(Request $request, ProfissionalModel $profissional)
    {
        $dados = $request->validate([
            'statusVerificacao' => ['required', 'in:em_analise,aprovado,pendencia,reprovado'],
        ]);

        $profissional->update($dados);

        $mensagens = [
            'aprovado'   => 'Profissional aprovado com sucesso.',
            'pendencia'  => 'Profissional marcado com pendência.',
            'em_analise' => 'Profissional devolvido para análise.',
            'reprovado'  => 'Profissional reprovado.',
        ];

        return back()->with('sucesso', $mensagens[$dados['statusVerificacao']]);
    }

    public function atualizarStatus(Request $request, ProfissionalModel $profissional)
    {
        if ($profissional->statusConta === 'excluida') {
            return back()->withErrors(['statusConta' => 'Esta conta foi excluída e não pode ser alterada.']);
        }

        $dados = $request->validate([
            'statusConta' => ['required', 'in:ativa,suspensa'],
        ]);

        $profissional->update($dados);

        return back()->with(
            'sucesso',
            $dados['statusConta'] === 'suspensa' ? 'Conta suspensa.' : 'Conta reativada.'
        );
    }

    public function excluir(Request $request, ProfissionalModel $profissional)
    {
        if ($profissional->statusConta === 'excluida') {
            return redirect()
                ->route('profissional.index', $request->only('busca', 'status'))
                ->withErrors(['statusConta' => 'Esta conta já foi excluída.']);
        }

        $request->validate([
            'confirmacao' => ['required', 'in:EXCLUIR'],
        ], [
            'confirmacao.required' => 'Digite EXCLUIR para confirmar.',
            'confirmacao.in'       => 'Digite EXCLUIR para confirmar.',
        ]);

        // Exclusão lógica
        $profissional->update(['statusConta' => 'excluida']);

        return redirect()
            ->route('profissional.index', $request->only('busca', 'status'))
            ->with('sucesso', 'Conta excluída.');
    }
}