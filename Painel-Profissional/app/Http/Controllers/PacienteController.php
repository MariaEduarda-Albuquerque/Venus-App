<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PacienteController extends Controller
{
    const STATUS_ATENDIDA = ['encerrada', 'em_andamento'];

    const PERIODOS = [
        'todos' => 'Todos os Períodos',
        '30dias' => 'Últimos 30 dias',
        '6meses' => 'Últimos 6 meses',
    ];

    const STATUS_USUARIA = ['ativa' => 'Ativa', 'suspensa' => 'Suspensa', 'excluida' => 'Excluída'];

    private function dataAtendimento($consulta)
    {
        return $consulta->dataHoraAgendada ?? $consulta->dataCriacao;
    }

    private function nomeUsuaria($usuaria, $codUsuario)
    {
        if (!$usuaria) {
            return 'Usuária';
        }

        if ($usuaria->anonimaPadraoUsuario) {
            return 'Usuária anônima #' . $codUsuario;
        }

        return $usuaria->apelidoUsuario ?: $usuaria->nomeUsuario;
    }

    public function index(Request $request)
    {
        $profissional = User::find(session('id'));
        $periodos = self::PERIODOS;
        $periodo = array_key_exists($request->periodo, $periodos) ? $request->periodo : 'todos';

        $agora = Carbon::now(AgendaController::FUSO);
        $limite = null;
        if ($periodo == '30dias') {
            $limite = $agora->copy()->subDays(30)->startOfDay()->format('Y-m-d H:i:s');
        } elseif ($periodo == '6meses') {
            $limite = $agora->copy()->subMonths(6)->startOfDay()->format('Y-m-d H:i:s');
        }

        $consultas = Consulta::with(['usuaria', 'avaliacao'])
            ->where('codProfissionalSaude', session('id'))
            ->whereIn('statusConsulta', self::STATUS_ATENDIDA)
            ->get();

        $linhas = [];
        $historicos = [];

        foreach ($consultas->groupBy('codUsuario') as $codUsuario => $grupo) {
            $grupo = $grupo->sortByDesc(function ($c) {
                return $this->dataAtendimento($c)->format('Y-m-d H:i:s');
            })->values();

            $ultimo = $this->dataAtendimento($grupo->first());

            if ($limite && $ultimo->format('Y-m-d H:i:s') < $limite) {
                continue;
            }

            $usuaria = $grupo->first()->usuaria;
            $nome = $this->nomeUsuaria($usuaria, $codUsuario);
            $status = $usuaria->statusUsuario ?? 'ativa';

            $notas = $grupo->map(function ($c) { return $c->avaliacao ? $c->avaliacao->nota : null; })->filter();
            $media = $notas->count() ? $notas->avg() : null;

            $linhas[] = [
                'id' => $codUsuario,
                'nome' => $nome,
                'inicial' => mb_strtoupper(mb_substr($nome, 0, 1)),
                'ultimo' => $ultimo->format('d/m/Y - H:i'),
                'ordem' => $ultimo->format('Y-m-d H:i:s'),
                'estrelas' => $media === null ? null : (int) round($media),
                'media' => $media === null ? null : number_format($media, 1, ',', ''),
                'status' => self::STATUS_USUARIA[$status] ?? $status,
                'statusClasse' => $status,
            ];

            $historicos[$codUsuario] = [
                'nome' => $nome,
                'inicial' => mb_strtoupper(mb_substr($nome, 0, 1)),
                'status' => self::STATUS_USUARIA[$status] ?? $status,
                'statusClasse' => $status,
                'itens' => $grupo->map(function ($c) {
                    return [
                        'data' => $this->dataAtendimento($c)->format('d/m/Y'),
                        'titulo' => $c->tipoConsulta == 'duvida_rapida' ? 'Dúvida rápida' : 'Consulta por chat',
                        'descricao' => Str::limit($c->historicoConsulta ?: $c->nomeConsulta, 140),
                    ];
                })->all(),
            ];
        }

        usort($linhas, function ($a, $b) { return strcmp($b['ordem'], $a['ordem']); });

        return view('painelProfissional.pacientes', compact('profissional', 'linhas', 'historicos', 'periodos', 'periodo'));
    }
}
