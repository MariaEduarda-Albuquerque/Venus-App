<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfissionalModel;
use App\Models\Usuaria;
use App\Models\Denuncia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $profissionaisAtivos = ProfissionalModel::where('statusConta', 'ativa')->count();
        $aguardandoAprovacao = ProfissionalModel::whereIn('statusVerificacao', [
            'pendencia',
            'em_analise',
        ])->count();
        $profissionaisAguardandoAprovacao = ProfissionalModel::whereIn('statusVerificacao', [
            'pendencia',
            'em_analise',
        ])->take(3)->get();

        $usuariasAtivas = Usuaria::where('statusUsuario', 'ativa')->count();

        $denunciasAltaGravidade = Denuncia::where('gravidade', 'alta')->take(3)->get();
        $denunciasAltaGravidadeUltimas24h = Denuncia::where('gravidade', 'alta')
        ->where('statusDenuncia', 'pendente')
        ->where('dataDenuncia', '<', Carbon::now()->subDay())
        ->count();

        return view('dashboard', compact('profissionaisAtivos', 'aguardandoAprovacao', 'usuariasAtivas', 'denunciasAltaGravidade', 'denunciasAltaGravidadeUltimas24h', 'profissionaisAguardandoAprovacao'));

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
