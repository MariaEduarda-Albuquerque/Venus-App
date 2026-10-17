<?php

namespace App\Http\Controllers;

use App\Models\Usuaria;
use App\Models\ProfissionalModel;
use App\Models\Admin;


use Carbon\Carbon;

use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Usuarias()
    {
        //

        $hoje = Carbon::today();

        $faixaEtaria14a25 = Usuaria::whereBetween('dataNascimentoUsuario', [
            $hoje->copy()->subYears(26)->addDay(),
            $hoje->copy()->subYears(14)
        ])->count();

        $faixaEtaria26a40 = Usuaria::whereBetween('dataNascimentoUsuario', [
            $hoje->copy()->subYears(41)->addDay(),
            $hoje->copy()->subYears(26)
        ])->count();

        $faixaEtaria41a60 = Usuaria::whereBetween('dataNascimentoUsuario', [
            $hoje->copy()->subYears(61)->addDay(),
            $hoje->copy()->subYears(41)
        ])->count();

        $faixaEtaria60mais = Usuaria::where(
            'dataNascimentoUsuario',
            '<=',
            $hoje->copy()->subYears(61)
        )->count();



        $totalUsuarias = Usuaria::count();
        $totalProfissionais = ProfissionalModel::count();
        $totalAdmins= Admin::count();

        return view('relatorios.usuarias', compact('faixaEtaria14a25', 'faixaEtaria26a40', 'faixaEtaria41a60', 'faixaEtaria60mais', 'totalUsuarias', 'totalProfissionais', 'totalAdmins'));

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
