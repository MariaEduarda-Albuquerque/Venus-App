<?php

namespace App\Http\Controllers;

use App\Models\DataSaude;
use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

// Agenda mensal: calendário em grade com as datas e campanhas de relevância para a saúde da mulher.
class AgendaController extends Controller
{
    // Fuso usado para saber "hoje" (usado também pelo RelatorioController)
    const FUSO = 'America/Sao_Paulo';

    private $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

    private $diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];

    public function index(Request $request)
    {
        $profissional = User::find(session('id'));
        $hoje = Carbon::now(self::FUSO)->startOfDay();

        // Mês exibido: ?mes=2026-10 (qualquer valor inválido volta para o mês atual)
        $mes = $hoje->copy()->startOfMonth();
        if (preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', (string) $request->mes)) {
            $mes = Carbon::createFromFormat('!Y-m', $request->mes, self::FUSO);
        }

        // Datas de relevância do mês: as do mês inteiro primeiro, depois as pontuais por dia
        $datas = DataSaude::with('categoria')
            ->where('mesDataSaude', $mes->month)
            ->orderByRaw('diaDataSaude IS NOT NULL')
            ->orderBy('diaDataSaude')
            ->get();

        $relevancias = [];
        $porDia = [];

        foreach ($datas as $d) {
            // Campanha do mês inteiro: sugere o dia 1 (ou hoje, se o mês já começou)
            $data = Carbon::create($mes->year, $mes->month, $d->diaDataSaude ?? 1, 0, 0, 0, self::FUSO);
            if ($d->diaDataSaude === null && $mes->isSameMonth($hoje)) {
                $data = $hoje->copy();
            }

            $item = [
                'id' => $d->codDataSaude,
                'nome' => $d->nomeDataSaude,
                'cor' => $d->corDataSaude,
                'pauta' => $d->pautaDataSaude,
                'categoriaId' => $d->codTipoCategoria,
                'categoriaNome' => optional($d->categoria)->nomeTipoCategoria,
                'mesInteiro' => $d->diaDataSaude === null,
                'rotulo' => $d->diaDataSaude === null ? 'Mês todo' : 'Dia ' . $d->diaDataSaude,
                'data' => $data->format('Y-m-d'),
            ];

            $relevancias[] = $item;

            if ($d->diaDataSaude !== null) {
                $porDia[$d->diaDataSaude][] = $item;
            }
        }

        // Grade: semanas de domingo a sábado cobrindo o mês inteiro
        $inicio = $mes->copy()->startOfMonth()->startOfWeek(Carbon::SUNDAY);
        $fim = $mes->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);

        $semanas = [];
        $dia = $inicio->copy();
        while ($dia->lte($fim)) {
            $semana = [];
            for ($i = 0; $i < 7; $i++) {
                $doMes = $dia->month === $mes->month;
                $semana[] = [
                    'numero' => $dia->day,
                    'doMes' => $doMes,
                    'hoje' => $dia->isSameDay($hoje),
                    'itens' => $doMes ? ($porDia[$dia->day] ?? []) : [],
                ];
                $dia->addDay();
            }
            $semanas[] = $semana;
        }

        $tituloMes = $this->meses[$mes->month - 1] . ' ' . $mes->year;
        $nomeMes = $this->meses[$mes->month - 1];
        $mesAnterior = $mes->copy()->subMonth()->format('Y-m');
        $mesSeguinte = $mes->copy()->addMonth()->format('Y-m');
        $ehMesAtual = $mes->isSameMonth($hoje);
        $diasSemana = $this->diasSemana;

        $categorias = TipoCategoria::orderBy('codTipoCategoria')->get();
        $tipos = TipoConteudo::orderBy('codTipoConteudo')->get();

        return view('painelProfissional.agenda', compact(
            'profissional', 'tituloMes', 'nomeMes', 'mesAnterior', 'mesSeguinte', 'ehMesAtual',
            'diasSemana', 'semanas', 'relevancias', 'categorias', 'tipos'
        ));
    }
}
