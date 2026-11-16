<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use App\Models\User;
use Illuminate\Http\Request;

// Feedback da moderação: o profissional vê o que o Admin decidiu sobre cada conteúdo.
//  - Recusado: mostra o motivo (motivoRecusaConteudo) e a data da revisão (dataRevisaoConteudo),
//    e permite "Corrigir e reenviar", que devolve o conteúdo para "Em revisão".
//  - Quem grava motivo, data e status ao recusar/aprovar é o Admin (moderação).
class FeedbackController extends Controller
{
    const FILTROS = [
        'recusado'   => 'Recusados',
        'em_revisao' => 'Em revisão',
        'publicado'  => 'Aprovados',
    ];

    public function index(Request $request)
    {
        $profissional = User::find(session('id'));

        $filtro = array_key_exists($request->status, self::FILTROS) ? $request->status : 'recusado';

        $meus = Conteudo::where('codProfissionalSaude', session('id'));

        $contagens = [];
        foreach (array_keys(self::FILTROS) as $status) {
            $contagens[$status] = (clone $meus)->where('statusConteudo', $status)->count();
        }

        $itens = (clone $meus)
            ->with(['categoria', 'tipo'])
            ->where('statusConteudo', $filtro)
            ->orderByRaw('COALESCE(dataRevisaoConteudo, dataAtualizacao) DESC')
            ->get();

        $filtros = self::FILTROS;
        $categorias = TipoCategoria::orderBy('codTipoCategoria')->get();
        $tipos = TipoConteudo::orderBy('codTipoConteudo')->get();

        return view('painelProfissional.feedback', compact(
            'profissional', 'itens', 'filtro', 'filtros', 'contagens', 'categorias', 'tipos'
        ));
    }

    // Corrigir e reenviar: salva as correções e devolve o conteúdo para "Em revisão"
    public function reenviar(Request $request, $id)
    {
        $item = Conteudo::where('codConteudo', $id)
            ->where('codProfissionalSaude', session('id'))
            ->first();

        if (!$item) {
            return redirect()->route('feedback.index')->with('erro', 'Conteúdo não encontrado.');
        }

        if ($item->statusConteudo !== 'recusado') {
            return redirect()->route('feedback.index')->with('erro', 'Só é possível reenviar conteúdos recusados.');
        }

        $request->validate([
            'tituloConteudo' => 'required|string|max:150',
            'codTipoCategoria' => 'required|exists:tbtipocategoria,codTipoCategoria',
            'codTipoConteudo' => 'required|exists:tbtipoconteudo,codTipoConteudo',
            'corpoConteudo' => 'required|string',
        ], [
            'tituloConteudo.required' => 'Informe o título do conteúdo.',
            'tituloConteudo.max' => 'O título deve ter no máximo 150 caracteres.',
            'codTipoCategoria.required' => 'Escolha uma categoria.',
            'codTipoCategoria.exists' => 'Categoria inválida.',
            'codTipoConteudo.required' => 'Escolha o formato.',
            'codTipoConteudo.exists' => 'Formato inválido.',
            'corpoConteudo.required' => 'Escreva o conteúdo corrigido antes de reenviar.',
        ]);

        $item->tituloConteudo = $request->tituloConteudo;
        $item->corpoConteudo = $request->corpoConteudo;
        $item->tempoLeituraMinutos = Conteudo::calcularTempoLeitura($request->corpoConteudo);
        $item->codTipoCategoria = $request->codTipoCategoria;
        $item->codTipoConteudo = $request->codTipoConteudo;

        // Volta para a fila da moderação; a decisão anterior deixa de valer
        $item->statusConteudo = 'em_revisao';
        $item->motivoRecusaConteudo = null;
        $item->dataRevisaoConteudo = null;
        $item->save();

        return redirect()->route('feedback.index', ['status' => 'em_revisao'])
            ->with('sucesso', 'Conteúdo corrigido e reenviado para a revisão editorial.');
    }
}
