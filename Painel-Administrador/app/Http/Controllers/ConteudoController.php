<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\Conteudo;
 use App\Models\ProfissionalModel;

class ConteudoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Primeiro cria as coleções
        $ConteudosRecusados  = Conteudo::with('tbProfissionalSaude')->where('statusConteudo', 'recusado')->get();
        $ConteudosPublicados = Conteudo::with('tbProfissionalSaude')->where('statusConteudo', 'publicado')->get();
        $ConteudosEmRevisao  = Conteudo::with('tbProfissionalSaude')->where('statusConteudo', 'em_revisao')->get();

        // 2. Totais
        $totalConteudosRecusados  = $ConteudosRecusados->count();
        $totalConteudosPublicados = $ConteudosPublicados->count();
        $totalConteudosEmRevisao  = $ConteudosEmRevisao->count();

        // 3. Depois escolhe qual mostrar (sem ?status, mostra todos)
        $Conteudos = match ($request->query('status')) {
            'publicado'  => $ConteudosPublicados,
            'em_revisao' => $ConteudosEmRevisao,
            'recusado'   => $ConteudosRecusados,
            default      => Conteudo::with('tbProfissionalSaude')->get(),
        };

        return view('admin.ConteudoAprender-Screen', compact(
            'Conteudos',
            'totalConteudosRecusados',
            'totalConteudosPublicados',
            'totalConteudosEmRevisao',
            'ConteudosRecusados',
            'ConteudosPublicados',
            'ConteudosEmRevisao'
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
