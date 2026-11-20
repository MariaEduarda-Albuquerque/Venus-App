<?php

namespace App\Http\Controllers;

use App\Models\Suporte;
use Illuminate\Http\Request;

class SuporteContatoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'descricaoSuporte' => 'required|string|min:10|max:2000',
        ], [
            'descricaoSuporte.required' => 'Descreva o problema para continuar.',
            'descricaoSuporte.min'      => 'Descreva um pouco mais (mínimo de 10 caracteres).',
            'descricaoSuporte.max'      => 'O texto pode ter no máximo 2000 caracteres.',
        ]);

        Suporte::create([
            'codProfissionalSaude' => session('id'),
            'descricaoSuporte'     => $request->descricaoSuporte,
            'statusSuporte'        => 'aberto',
        ]);

        return redirect()->back()->with('sucesso', 'Recebemos sua mensagem! Já vamos resolver.');
    }
}