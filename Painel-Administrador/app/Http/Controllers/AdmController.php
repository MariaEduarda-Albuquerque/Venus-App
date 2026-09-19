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

    $DenunciasAltaGravidade = DenunciaModel::where('gravidade', 'alta')->take(3)->get();
    $DenunciasAltaGravidadeAlta= DenunciaModel::where('gravidade', 'alta')->count();
    $totalDenunciasUltimas24h = DenunciaModel::where('gravidade', 'alta')
    ->where('dataDenuncia', '>=', Carbon::now()->subDay())
    ->count();

    $totalProsissionais = ProfissionalModel::count();
    $profissionaisPendentes = ProfissionalModel::where('statusVerificacao', 'aprovado')->take(3)->get();
    $profissionaisEmEspera = ProfissionalModel::where('statusVerificacao', 'em_analise')->count();

    $conteudosAguardandoRevisao = Conteudo::where('statusConteudo', 'em_revisao')->count();

    return view('admin.painel', compact('usuarios', 'totalUsuarios', 'totalProsissionais', 'DenunciasAltaGravidade', 'profissionaisPendentes', 'profissionaisEmEspera', 'conteudosAguardandoRevisao', 'totalDenunciasUltimas24h'));
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
