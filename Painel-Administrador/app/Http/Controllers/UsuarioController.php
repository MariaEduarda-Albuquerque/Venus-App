<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\ProfissionalModel;
use App\Models\DenunciaModel;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $totalUsuarios = Usuario::count();

    $usuarios = Usuario::query()
        ->when($request->query('status'), function ($query, $status) {
            if (in_array($status, ['ativa', 'suspensa', 'excluida'])) {
                $query->where('statusUsuario', $status);
            }
        })
        ->get();

    return view('admin.usuario', compact('usuarios', 'totalUsuarios'));
}

    public function dashboard()
{
    $usuarios = Usuario::all();
    $totalUsuarios = Usuario::where('statusUsuario', 'ativa')->count();
    $totalProsissionais = ProfissionalModel::count();
    $DenunciasAltaGravidade = DenunciaModel::where('gravidade', 'alta')->take(3)->get();

    return view('dashboard', compact('usuarios', 'totalUsuarios', 'totalProsissionais', 'DenunciasAltaGravidade'));
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
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
