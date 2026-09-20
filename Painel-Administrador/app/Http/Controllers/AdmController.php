<?php

namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use App\Models\AdmModel;
 use App\Models\Usuario;
 use App\Models\ProfissionalModel;
 use App\Models\DenunciaModel;
 use App\Models\Conteudo;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Auth\AuthenticationException;
 use Illuminate\Support\Facades\Hash;
 use Carbon\Carbon;
 use Illuminate\Support\Facades\DB;

class AdmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        $totalUsuarios = Usuario::count();

        return view('admin.usuario', compact('usuarios', 'totalUsuarios'));
    }

    public function dashboard()
{
    $usuarios = Usuario::all();
    $totalUsuarios = Usuario::where('statusUsuario', 'ativa')->count();
    $UltimoMesUsuarios = Usuario::where('dataCadastro', '>=', now()->subMonth())->count();
    $percentagem = ($UltimoMesUsuarios / $totalUsuarios) * 100;

    $DenunciasAltaGravidade = DenunciaModel::where('gravidade', 'alta')->take(3)->get();
    $DenunciasAltaGravidadeAlta = DenunciaModel::where('gravidade', 'alta')->count();
    $totalDenunciasUltimas24h = DenunciaModel::where('gravidade', 'alta')
    ->where('statusDenuncia', 'pendente')
    ->where('dataDenuncia', '<', Carbon::now()->subDay())
    ->count();
    $DenunciasPendentes= DenunciaModel::where('statusDenuncia', 'pendente')->count();
    $DenunciasDesdeOntem = DenunciaModel::where('dataDenuncia', '>=', now()->subDay())->count();

    $totalProsissionais = ProfissionalModel::count();
    $profissionaisPendentes = ProfissionalModel::where('statusVerificacao', 'pendencia')->take(3)->get();
    $profissionaisEmEspera = ProfissionalModel::where('statusVerificacao', 'em_analise')->count();
    $UltimoMesProfissionais = Usuario::where('dataCadastro', '>=', now()->subMonth())->count();
    $porcentagemProfissionaisUltimoMes = ($UltimoMesProfissionais / $totalProsissionais) * 100;

    $conteudosAguardandoRevisao = Conteudo::where('statusConteudo', 'em_revisao')->count();

    Carbon::setLocale('pt_BR');
    $hoje = now()->translatedFormat('d \d\e F \d\e Y');

    //Grafico funcionar:
    // ===== Gráfico: novos cadastros nas últimas 8 semanas =====
$semanas = [];
$novosUsuarias = [];
$novosProfissionais = [];

for ($i = 7; $i >= 0; $i--) {
    $inicio = Carbon::now()->subWeeks($i)->startOfWeek();
    $fim    = $inicio->copy()->endOfWeek();

    $semanas[]            = $inicio->format('d/m');
    $novosUsuarias[]      = Usuario::whereBetween('dataCadastro', [$inicio, $fim])->count();
    $novosProfissionais[] = ProfissionalModel::whereBetween('dataCadastro', [$inicio, $fim])->count();
}

// Escala do eixo Y: 4 divisões iguais, arredondadas para cima
$maiorValor = max(max($novosUsuarias), max($novosProfissionais), 1);
$passoEixo  = (int) ceil($maiorValor / 4);
$eixoMax    = $passoEixo * 4;

// Rótulos do eixo Y (de 0 até o máximo) com a posição vertical no SVG
$rotulosEixoY = [];
for ($k = 0; $k <= 4; $k++) {
    $rotulosEixoY[] = [
        'valor' => $k * $passoEixo,
        'y'     => 220 - ($k / 4) * 210,   // 220 = base, 10 = topo
    ];
}

// Converte valores em coordenadas do SVG (x de 60 a 620, y de 220 a 10)
$montarPontos = function (array $valores) use ($eixoMax) {
    return collect($valores)->map(fn ($v, $i) => [
        'x'     => 60 + $i * 80,
        'y'     => round(220 - ($v / $eixoMax) * 210, 1),
        'valor' => $v,
    ])->all();
};

$pontosUsuarias      = $montarPontos($novosUsuarias);
$pontosProfissionais = $montarPontos($novosProfissionais);

return view('admin.painel', compact(
    'usuarios', 'totalUsuarios', 'totalProsissionais', 'DenunciasAltaGravidade',
    'profissionaisPendentes', 'profissionaisEmEspera', 'conteudosAguardandoRevisao',
    'totalDenunciasUltimas24h', 'percentagem', 'porcentagemProfissionaisUltimoMes',
    'DenunciasPendentes', 'DenunciasDesdeOntem', 'hoje',
    'semanas', 'rotulosEixoY', 'pontosUsuarias', 'pontosProfissionais'
));
}

public function perfil()
{
    $admin = Auth::guard('admin')->user()->load('tbpapel');

    return view('perfil-config.perfil-adm', compact('admin'));
}

public function editar()
{
    $admin = Auth::guard('admin')->user();
    return view('perfil-config.editar-perfil', compact('admin'));
}

public function atualizar(Request $request)
{
    $admin = Auth::guard('admin')->user();

    $admin->nomeAdmin     = $request->nomeAdmin;
    $admin->emailAdmin    = $request->emailAdmin;
    $admin->telAdmin      = $request->telAdmin;
    $admin->paisAdmin     = $request->paisAdmin;
    $admin->cidadeAdmin   = $request->cidadeAdmin;
    $admin->ufAdmin       = $request->ufAdmin;
    $admin->cepAdmin      = $request->cepAdmin;
    $admin->nrFiscalAdmin = $request->nrFiscalAdmin;

    $admin->save();

    return redirect('/perfil-adm');
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

public function fazerLogin(Request $request)
{
    $credenciais = [
        'emailAdmin' => $request->emailAdmin,
        'password'   => $request->password,
    ];

    if (!Auth::guard('admin')->attempt($credenciais)) {
        return redirect('/login');
    }

    return redirect('dashboard');
}

public function fazerLogOut(Request $request)
{
    Auth::guard('admin')->logout();
    return redirect('/login');
}
}
