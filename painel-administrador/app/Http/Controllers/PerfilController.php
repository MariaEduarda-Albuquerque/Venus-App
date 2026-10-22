<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\ConteudoAdmin;

use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
     $admin = Auth::guard('admin')->user();

    $nomeCompleto = $admin->nomeAdmin;
    $partes = explode(' ', trim($nomeCompleto));
    $primeiroNome = $partes[0];
    $sobrenome = count($partes) > 1 ? implode(' ', array_slice($partes, 1)) : '';    $cargo = $admin->papel->nomePapel;
    $inicial = mb_strtoupper(mb_substr($admin->nomeAdmin, 0, 1));

    $cidade = $admin->cidadeAdmin;
    $pais = $admin->paisAdmin;
    $email = $admin->emailAdmin;
    $telefone = $admin->telAdmin;
    $uf = $admin->ufAdmin;
    $cep = $admin->cepAdmin;
    $nrfiscal = $admin->nrFiscalAdmin;
    $statusConta = $admin->statusConta;
    $codPostal = $admin->codpostalAdmin;

            return view('perfil-config.perfil-adm', compact('nomeCompleto', 'primeiroNome', 'sobrenome', 'cargo', 'cidade', 'pais', 'email', 'telefone', 'telefone', 'uf', 'cep', 'nrfiscal', 'statusConta', 'inicial', 'codPostal'));
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
