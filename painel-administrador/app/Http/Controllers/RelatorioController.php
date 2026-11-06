<?php

namespace App\Http\Controllers;

use App\Models\Usuaria;
use App\Models\ProfissionalModel;
use App\Models\Denuncia;
use App\Models\Consulta;
use App\Models\ChamadoSuporte;
use App\Models\AvaliacaoConsulta;
use App\Models\Conteudo;

use App\Models\Admin;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Usuarias(Request $request)
    {
        $periodo = (int) $request->input('periodo', 30);
        if (!in_array($periodo, [30, 90, 365])) {
            $periodo = 30;
        }

        $hoje = Carbon::today();
        $inicio = $hoje->copy()->subDays($periodo);

        $faixaEtaria14a25 = Usuaria::where('dataCadastro', '>=', $inicio)
            ->whereBetween('dataNascimentoUsuario', [
                $hoje->copy()->subYears(26)->addDay(),
                $hoje->copy()->subYears(14)
            ])->count();

        $faixaEtaria26a40 = Usuaria::where('dataCadastro', '>=', $inicio)
            ->whereBetween('dataNascimentoUsuario', [
                $hoje->copy()->subYears(41)->addDay(),
                $hoje->copy()->subYears(26)
            ])->count();

        $faixaEtaria41a60 = Usuaria::where('dataCadastro', '>=', $inicio)
            ->whereBetween('dataNascimentoUsuario', [
                $hoje->copy()->subYears(61)->addDay(),
                $hoje->copy()->subYears(41)
            ])->count();

        $faixaEtaria60mais = Usuaria::where('dataCadastro', '>=', $inicio)
            ->where('dataNascimentoUsuario', '<=', $hoje->copy()->subYears(61))
            ->count();

        $totalUsuarias      = Usuaria::where('dataCadastro', '>=', $inicio)->count();
        $totalProfissionais = ProfissionalModel::where('dataCadastro', '>=', $inicio)->count();
        $totalAdmins        = Admin::where('dataCadastro', '>=', $inicio)->count();

        $totalGeral = Usuaria::count();
        $porcentagemUsuariasNovasNoMes = $totalGeral > 0
            ? round(($totalUsuarias / $totalGeral) * 100, 1)
            : 0;

        $totalUsuariosSudeste     = Usuaria::where('dataCadastro', '>=', $inicio)->whereIn('ufUsuario', ['SP', 'RJ', 'MG', 'ES'])->count();
        $totalUsuariosNordeste    = Usuaria::where('dataCadastro', '>=', $inicio)->whereIn('ufUsuario', ['AL', 'BA', 'CE', 'MA', 'PB', 'PE', 'PI', 'RN', 'SE'])->count();
        $totalUsuariosSul         = Usuaria::where('dataCadastro', '>=', $inicio)->whereIn('ufUsuario', ['PR', 'RS', 'SC'])->count();
        $totalUsuariosCentroOeste = Usuaria::where('dataCadastro', '>=', $inicio)->whereIn('ufUsuario', ['DF', 'GO', 'MT', 'MS'])->count();
        $totalUsuariosNorte       = Usuaria::where('dataCadastro', '>=', $inicio)->whereIn('ufUsuario', ['AC', 'AM', 'AP', 'PA', 'RO', 'RR', 'TO'])->count();

        return view('relatorios.usuarias', compact(
            'periodo',
            'faixaEtaria14a25', 'faixaEtaria26a40', 'faixaEtaria41a60', 'faixaEtaria60mais',
            'totalUsuarias', 'totalProfissionais', 'totalAdmins',
            'porcentagemUsuariasNovasNoMes',
            'totalUsuariosSudeste', 'totalUsuariosNordeste', 'totalUsuariosSul',
            'totalUsuariosCentroOeste', 'totalUsuariosNorte'
        ));
    }

    /**
     * Painel > Relatório: visão geral da plataforma (cadastros, conteúdos e distribuição das contas)
     */
    public function Geral(Request $request)
    {
        $periodo = (int) $request->input('periodo', 30);
        if (!in_array($periodo, [30, 90, 365])) {
            $periodo = 30;
        }

        $inicio = now()->subDays($periodo)->startOfDay();

        // Novos cadastros no período
        $novasUsuarias      = Usuaria::where('dataCadastro', '>=', $inicio)->count();
        $novosProfissionais = ProfissionalModel::where('dataCadastro', '>=', $inicio)->count();

        // Evolução dos cadastros: por semana (30 e 90 dias) ou por mês (último ano)
        $evolucaoCadastros = [];
        if ($periodo === 365) {
            for ($i = 11; $i >= 0; $i--) {
                $ini = now()->startOfMonth()->subMonths($i);
                $fim = $ini->copy()->endOfMonth();
                $evolucaoCadastros[] = [
                    $ini->copy()->locale('pt_BR')->translatedFormat('M/y'),
                    Usuaria::whereBetween('dataCadastro', [$ini, $fim])->count(),
                    ProfissionalModel::whereBetween('dataCadastro', [$ini, $fim])->count(),
                ];
            }
        } else {
            $semanas = (int) ceil($periodo / 7);
            for ($i = $semanas - 1; $i >= 0; $i--) {
                $fim = now()->subWeeks($i)->endOfDay();
                $ini = $fim->copy()->subDays(6)->startOfDay();
                if ($ini->lt($inicio)) {
                    $ini = $inicio->copy();
                }
                $evolucaoCadastros[] = [
                    $ini->format('d/m'),
                    Usuaria::whereBetween('dataCadastro', [$ini, $fim])->count(),
                    ProfissionalModel::whereBetween('dataCadastro', [$ini, $fim])->count(),
                ];
            }
        }

        // Conteúdos criados no período, por status
        $conteudosPorStatus = [];
        $conteudosPublicados = 0;
        foreach (['publicado' => 'Publicado', 'em_revisao' => 'Em revisão', 'recusado' => 'Recusado', 'rascunho' => 'Rascunho'] as $chave => $rotulo) {
            $total = Conteudo::where('statusConteudo', $chave)->where('dataCriacao', '>=', $inicio)->count();
            $conteudosPorStatus[] = [$rotulo, $total];
            if ($chave === 'publicado') {
                $conteudosPublicados = $total;
            }
        }

        // Profissionais ativos por especialidade (6 maiores + "Outras")
        $especialidades = ProfissionalModel::where('statusConta', 'ativa')
            ->select(
                DB::raw("COALESCE(NULLIF(especialidadeProfissionalSaude, ''), 'Não informada') as nome"),
                DB::raw('count(*) as total')
            )
            ->groupBy('nome')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($e) => [$e->nome, (int) $e->total])
            ->values();

        if ($especialidades->count() > 6) {
            $outras = $especialidades->slice(6)->sum(fn ($e) => $e[1]);
            $especialidades = $especialidades->take(6)->push(['Outras', $outras])->values();
        }

        // Usuárias ativas por região
        $regioes = [
            'Sudeste'      => ['SP', 'RJ', 'MG', 'ES'],
            'Nordeste'     => ['AL', 'BA', 'CE', 'MA', 'PB', 'PE', 'PI', 'RN', 'SE'],
            'Sul'          => ['PR', 'RS', 'SC'],
            'Centro-Oeste' => ['DF', 'GO', 'MT', 'MS'],
            'Norte'        => ['AC', 'AM', 'AP', 'PA', 'RO', 'RR', 'TO'],
        ];
        $usuariasPorRegiao = [];
        foreach ($regioes as $nome => $ufs) {
            $usuariasPorRegiao[] = [$nome, Usuaria::where('statusUsuario', 'ativa')->whereIn('ufUsuario', $ufs)->count()];
        }

        return view('painel.relatorio', compact(
            'periodo',
            'novasUsuarias', 'novosProfissionais',
            'evolucaoCadastros',
            'conteudosPorStatus', 'conteudosPublicados',
            'especialidades',
            'usuariasPorRegiao'
        ));
    }

    public function Denuncias(Request $request)
    {
        $periodo = (int) $request->input('periodo', 30);
        if (!in_array($periodo, [30, 90, 365])) {
            $periodo = 30;
        }

        $inicio = now()->subDays($periodo);           
        $inicioAnterior = now()->subDays($periodo * 2);

        $denunciasGravidadeBaixa = Denuncia::where('dataDenuncia', '>=', $inicio)->where('gravidade', 'baixa')->count();
        $denunciasGravidadeMedia = Denuncia::where('dataDenuncia', '>=', $inicio)->where('gravidade', 'media')->count();
        $denunciasGravidadeAlta  = Denuncia::where('dataDenuncia', '>=', $inicio)->where('gravidade', 'alta')->count();

        $denunciasTipoFP = Denuncia::where('dataDenuncia', '>=', $inicio)->where('tipoAlvo', 'forum_publicacao')->count();
        $denunciasTipoFR = Denuncia::where('dataDenuncia', '>=', $inicio)->where('tipoAlvo', 'forum_resposta')->count();
        $denunciasTipoMC = Denuncia::where('dataDenuncia', '>=', $inicio)->where('tipoAlvo', 'mensagem_chat')->count();
        $denunciasTipoPP = Denuncia::where('dataDenuncia', '>=', $inicio)->where('tipoAlvo', 'perfil_profissional')->count();

        $denunciasStatusPendente  = Denuncia::where('dataDenuncia', '>=', $inicio)->where('statusDenuncia', 'pendente')->count();
        $denunciasStatusEmAnalise = Denuncia::where('dataDenuncia', '>=', $inicio)->where('statusDenuncia', 'em_analise')->count();
        $denunciasStatusResolvida = Denuncia::where('dataDenuncia', '>=', $inicio)->where('statusDenuncia', 'resolvida')->count();
        $denunciasStatusArquivada = Denuncia::where('dataDenuncia', '>=', $inicio)->where('statusDenuncia', 'arquivada')->count();

        $denunciasPeriodoAtual = Denuncia::where('dataDenuncia', '>=', $inicio)->count();

        $denunciasPeriodoAnterior = Denuncia::whereBetween('dataDenuncia', [$inicioAnterior, $inicio])->count();

        $variacaoPeriodo = $denunciasPeriodoAnterior > 0
            ? (($denunciasPeriodoAtual - $denunciasPeriodoAnterior) / $denunciasPeriodoAnterior) * 100
            : 0;

        $variacaoPeriodo = round($variacaoPeriodo, 1);

        return view('relatorios.denuncias', compact(
            'periodo',
            'denunciasTipoFP', 'denunciasTipoFR', 'denunciasTipoMC', 'denunciasTipoPP',
            'denunciasStatusPendente', 'denunciasStatusEmAnalise', 'denunciasStatusResolvida', 'denunciasStatusArquivada',
            'denunciasGravidadeBaixa', 'denunciasGravidadeMedia', 'denunciasGravidadeAlta',
            'variacaoPeriodo'
        ));
    }

public function Atendimento(Request $request)
{
    $periodo = (int) $request->input('periodo', 30);
    if (!in_array($periodo, [30, 90, 365])) {
        $periodo = 30;
    }

    $inicio = now()->subDays($periodo);

    $canalAtendimentoChat  = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('canalChamado', 'chat')->count();
    $canalAtendimentoEmail = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('canalChamado', 'email')->count();
    $canalAtendimentoForm  = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('canalChamado', 'formulario')->count();
    $canalAtendimentoTel   = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('canalChamado', 'telefone')->count();

    $motivoChamadoDuvida       = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('motivoChamado', 'duvida')->count();
    $motivoChamadoAcessoAsenha = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('motivoChamado', 'acesso_a_senha')->count();
    $motivoChamadoErroTecnico  = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('motivoChamado', 'erro_tecnico')->count();
    $motivoChamadoDadosConta   = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('motivoChamado', 'conta_e_dados')->count();
    $motivoChamadoSugestoes    = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('motivoChamado', 'sugestoes')->count();

    $avaliacaoInsatisfeita    = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->whereIn('avaliacaoChamado', [1, 2])->count();
    $avaliacaoNeutra          = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('avaliacaoChamado', 3)->count();
    $avaliacaoSatisfeita      = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('avaliacaoChamado', 4)->count();
    $avaliacaoMuitoSatisfeita = ChamadoSuporte::where('dataAbertura', '>=', $inicio)->where('avaliacaoChamado', 5)->count();

    $avaliacaoMedia = round(ChamadoSuporte::where('dataAbertura', '>=', $inicio)->avg('avaliacaoChamado') ?? 0, 1);

    return view('relatorios.atendimento', compact(
        'periodo',
        'canalAtendimentoChat', 'canalAtendimentoEmail', 'canalAtendimentoForm', 'canalAtendimentoTel',
        'motivoChamadoDuvida', 'motivoChamadoAcessoAsenha', 'motivoChamadoErroTecnico', 'motivoChamadoDadosConta', 'motivoChamadoSugestoes',
        'avaliacaoInsatisfeita', 'avaliacaoNeutra', 'avaliacaoSatisfeita', 'avaliacaoMuitoSatisfeita',
        'avaliacaoMedia'
    ));
}

public function Profissional(Request $request)
{
    // Período escolhido: 30, 90 ou 365 dias (se vier outra coisa, usa 30)
    $periodo = (int) $request->input('periodo', 30);
    if (!in_array($periodo, [30, 90, 365])) {
        $periodo = 30;
    }

    $inicio = now()->subDays($periodo);

    $categoriaMedico           = ProfissionalModel::where('dataCadastro', '>=', $inicio)->where('categoriaProfissional', 'medico')->count();
    $categoriaMedicoEnfermeiro = ProfissionalModel::where('dataCadastro', '>=', $inicio)->where('categoriaProfissional', 'enfermeiro')->count();
    $categoriaMedicoPsicologo  = ProfissionalModel::where('dataCadastro', '>=', $inicio)->where('categoriaProfissional', 'psicologo')->count();
    $categoriaAssistenteSocial = ProfissionalModel::where('dataCadastro', '>=', $inicio)->where('categoriaProfissional', 'assistente_social')->count();
    $categoriaOutro            = ProfissionalModel::where('dataCadastro', '>=', $inicio)->where('categoriaProfissional', 'outro')->count();

    $conteudosPublicados = Conteudo::where('statusConteudo', 'publicado')
        ->where('dataCriacao', '>=', $inicio)
        ->count();

$conteudosPorCategoria = Conteudo::where('statusConteudo', 'publicado')
    ->where('dataCriacao', '>=', $inicio)
    ->select('codTipoCategoria', DB::raw('count(*) as total'))
    ->groupBy('codTipoCategoria')
    ->with('tipoCategoria')
    ->get()
    ->map(fn($c) => [
        $c->tipoCategoria->nomeTipoCategoria,
        (int) $c->total
    ])
    ->values();


$rankingProfissionais = Conteudo::where('tbconteudo.statusConteudo', 'publicado')
    ->where('tbconteudo.dataCriacao', '>=', $inicio)
    ->join(
        'tbprofissionalsaude',
        'tbconteudo.codProfissionalSaude',
        '=',
        'tbprofissionalsaude.codProfissionalSaude'
    )
    ->select(
        'tbprofissionalsaude.nomeProfissionalSaude',
        DB::raw('count(*) as publicados')
    )
    ->groupBy(
        'tbprofissionalsaude.codProfissionalSaude',
        'tbprofissionalsaude.nomeProfissionalSaude'
    )
    ->orderByDesc('publicados')
    ->limit(5)
    ->get()
    ->map(fn($r) => [
        $r->nomeProfissionalSaude,
        (int) $r->publicados
    ])
    ->values();

    return view('relatorios.profissional', compact(
        'periodo',
        'categoriaMedico', 'categoriaMedicoEnfermeiro', 'categoriaMedicoPsicologo', 'categoriaAssistenteSocial', 'categoriaOutro',
        'conteudosPublicados',
        'conteudosPorCategoria',
        'rankingProfissionais'
    ));
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
