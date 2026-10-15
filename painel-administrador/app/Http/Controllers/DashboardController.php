<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfissionalModel;
use App\Models\Usuaria;
use App\Models\Denuncia;
use App\Models\Conteudo;
use App\Models\TipoConteudo;
use App\Models\TipoCategoria;
use App\Models\DenunciaAcao;
use App\Models\AvaliacaoConsulta;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Profissionais:
        $profissionaisAtivos = ProfissionalModel::where('statusConta', 'ativa')->count();
        $UltimoMesProfissionais = ProfissionalModel::where('dataCadastro', '>=', now()->subMonth())->count();
        $porcentagemProfissionaisAtivosNoMes = ($UltimoMesProfissionais / $profissionaisAtivos) * 100;
        $aguardandoAprovacao = ProfissionalModel::whereIn('statusVerificacao', [
            'pendencia',
            'em_analise',
        ])->count();
        $profissionaisAguardandoAprovacao = ProfissionalModel::whereIn('statusVerificacao', [
            'pendencia',
            'em_analise',
        ])->take(3)->get();

        //Usuarias:
        $usuariasAtivas = Usuaria::where('statusUsuario', 'ativa')->count();
        $UltimoMesUsuarias = Usuaria::where('dataCadastro', '>=', now()->subMonth())->count();
        $porcentagemUsuariasAtivasNoMes = ($UltimoMesUsuarias / $usuariasAtivas) * 100;


        //Denuncias:
        $denunciasAltaGravidade = Denuncia::where('gravidade', 'alta')->take(3)->get();
        $denunciasAltaGravidadeUltimas24h = Denuncia::where('gravidade', 'alta')
        ->where('statusDenuncia', 'pendente')
        ->where('dataDenuncia', '<', Carbon::now()->subDay())
        ->count();
        $qtdDenunciasPendentes = Denuncia::where('statusDenuncia', 'pendente')->count();
        $qtdDenunciasPendentesDesdeOntem = Denuncia::where('statusDenuncia', 'pendente')->whereDate('dataDenuncia', '>=', now()->subDay())
    ->count(); 

    //Tempo medio de resposta da denuncia
        $denuncias = Denuncia::get();
        $totalMinutos = 0;
        $total = 0;

        foreach ($denuncias as $denuncia) {
            $acao = DenunciaAcao::where('codDenuncia', $denuncia->codDenuncia)->first();

            if ($acao) {
                $minutos = Carbon::parse($denuncia->dataDenuncia)
                    ->diffInMinutes(Carbon::parse($acao->dataAcao));

                $totalMinutos += $minutos;
                $total++;
            }
        }

        //Notas da satisfação das usuárias:
        $avaliacaoMediaUsuarias = number_format(AvaliacaoConsulta::avg('nota') ?? 0, 1, ',', '');


        $media = $total > 0 ? floor($totalMinutos / $total) : 0;

        $tempoMedio = floor($media / 60) . 'h ' . ($media % 60) . 'min';


        //Conteudos:
        $conteudosAguardandoRev = Conteudo::where('statusConteudo', 'em_revisao')->count();
        $conteudosAguardandoRevArtigo = Conteudo::where('statusConteudo', 'em_revisao')
            ->whereHas('tipoCategoria', function ($query) {
                $query->where('nomeTipoCategoria', 'artigo');
            })
            ->count();
        $conteudosAguardandoRevVideo = Conteudo::where('statusConteudo', 'em_revisao')
            ->whereHas('tipoCategoria', function ($query) {
                $query->where('nomeTipoCategoria', 'video');
            })
            ->count();

            //Pegar a data/Calendario:
            $dataHoje = Carbon::now()->locale('pt_BR')->translatedFormat('d \d\e F \d\e Y');
            $dia = now()->day;
            $mes = now()->month;
            $ano = now()->year;
            
            //Gráfico- cadastros por semana:
            $semana1 = now()->format('d/m');
            $semana2 = now()->copy()->subWeeks(1)->format('d/m');
            $semana3 = now()->copy()->subWeeks(2)->format('d/m');
            $semana4 = now()->copy()->subWeeks(3)->format('d/m');
            $semana5 = now()->copy()->subWeeks(4)->format('d/m');
            $semana6 = now()->copy()->subWeeks(5)->format('d/m');
            $semana7 = now()->copy()->subWeeks(6)->format('d/m');
            $semana8 = now()->copy()->subWeeks(7)->format('d/m');

            $usuariosSemana1 = Usuaria::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(1)->startOfDay(),
                Carbon::now()->endOfDay()
            ])->count();

            $usuariosSemana2 = Usuaria::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(2)->startOfDay(),
                Carbon::now()->subWeeks(1)->endOfDay()
            ])->count();

            $usuariosSemana3 = Usuaria::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(3)->startOfDay(),
                Carbon::now()->subWeeks(2)->endOfDay()
            ])->count();

            $usuariosSemana4 = Usuaria::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(4)->startOfDay(),
                Carbon::now()->endOfDay(3)->endOfDay()
            ])->count();

            $usuariosSemana5 = Usuaria::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(5)->startOfDay(),
                Carbon::now()->subWeeks(4)->endOfDay()
            ])->count();

            $usuariosSemana6 = Usuaria::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(6)->startOfDay(),
                Carbon::now()->subWeeks(5)->endOfDay()
            ])->count();

            $usuariosSemana7 = Usuaria::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(7)->startOfDay(),
                Carbon::now()->endOfDay(6)->endOfDay()
            ])->count();

            $usuariosSemana8 = Usuaria::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(8)->startOfDay(),
                Carbon::now()->subWeeks(7)->endOfDay()
            ])->count();


            //Grafico- Cadastros - Profissionais:
            $profissionaisSemana1 = ProfissionalModel::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(1)->startOfDay(),
                Carbon::now()->endOfDay()
            ])->count();

            $profissionaisSemana2 = ProfissionalModel::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(2)->startOfDay(),
                Carbon::now()->subWeeks(1)->endOfDay()
            ])->count();

            $profissionaisSemana3 = ProfissionalModel::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(3)->startOfDay(),
                Carbon::now()->subWeeks(2)->endOfDay()
            ])->count();

            $profissionaisSemana4 = ProfissionalModel::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(4)->startOfDay(),
                Carbon::now()->endOfDay(3)->endOfDay()
            ])->count();

            $profissionaisSemana5 = ProfissionalModel::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(5)->startOfDay(),
                Carbon::now()->subWeeks(4)->endOfDay()
            ])->count();

            $profissionaisSemana6 = ProfissionalModel::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(6)->startOfDay(),
                Carbon::now()->subWeeks(5)->endOfDay()
            ])->count();

            $profissionaisSemana7 = ProfissionalModel::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(7)->startOfDay(),
                Carbon::now()->endOfDay(6)->endOfDay()
            ])->count();

            $profissionaisSemana8 = ProfissionalModel::whereBetween('dataCadastro', [
                Carbon::now()->subWeeks(8)->startOfDay(),
                Carbon::now()->subWeeks(7)->endOfDay()
            ])->count();


        //Gráfico - Pizza:
            $qtdDenunciasForumPublicação = Denuncia::where('tipoAlvo', 'forum_publicacao')->count();
            $qtdDenunciasForumResposta = Denuncia::where('tipoAlvo', 'forum_resposta')->count();
            $qtdDenunciasMensagemChat= Denuncia::where('tipoAlvo', 'mensagem_chat')->count();
            $qtdDenunciasPerfilProfissional = Denuncia::where('tipoAlvo', 'perfil_profissional')->count();

        return view('dashboard', compact('profissionaisAtivos', 'aguardandoAprovacao', 'usuariasAtivas', 'denunciasAltaGravidade', 'denunciasAltaGravidadeUltimas24h', 'profissionaisAguardandoAprovacao', 'conteudosAguardandoRev', 'conteudosAguardandoRevArtigo', 'conteudosAguardandoRevVideo', 'porcentagemUsuariasAtivasNoMes', 'porcentagemProfissionaisAtivosNoMes', 'qtdDenunciasPendentes', 'qtdDenunciasPendentesDesdeOntem', 'dataHoje', 'dia', 'mes', 'ano', 'semana1', 'semana1', 'semana2', 'semana3', 'semana4', 'semana5', 'semana6', 'semana7', 'semana8', 'usuariosSemana1', 'usuariosSemana2', 'usuariosSemana3', 'usuariosSemana4', 'usuariosSemana5', 'usuariosSemana6', 'usuariosSemana7', 'usuariosSemana8', 'profissionaisSemana1', 'profissionaisSemana2', 'profissionaisSemana3', 'profissionaisSemana4', 'profissionaisSemana5', 'profissionaisSemana6', 'profissionaisSemana7', 'profissionaisSemana8', 'qtdDenunciasForumPublicação', 'qtdDenunciasForumResposta', 'qtdDenunciasMensagemChat', 'qtdDenunciasPerfilProfissional', 'tempoMedio', 'avaliacaoMediaUsuarias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
