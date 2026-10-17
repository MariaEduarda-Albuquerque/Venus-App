<?php

namespace App\Http\Controllers;

use App\Models\ProfissionalModel;
use Illuminate\Http\Request;

class ProfissionalController extends Controller
{
public function index(Request $request)
{
    $profissionais = ProfissionalModel::query()
        ->when(
            in_array($request->input('status'), ['ativa', 'suspensa', 'excluida']),
            function ($query) use ($request) {
                $query->where('statusConta', $request->input('status'));
            }
        )
        ->when($request->filled('busca'), function ($query) use ($request) {
            $busca = $request->input('busca');

            $query->where(function ($q) use ($busca) {
                $q->where('nomeProfissionalSaude', 'like', "%{$busca}%")
                  ->orWhere('emailProfissionalSaude', 'like', "%{$busca}%");
            });
        })
        ->orderByDesc('dataCadastro')
        ->paginate(10)
        ->withQueryString();

    // Busca o profissional selecionado para exibir os detalhes.
    $detalhe = null;

    if ($request->filled('detalhe')) {
        $detalhe = ProfissionalModel::find($request->input('detalhe'));
    }

    // Verifica se o usuário solicitou a confirmação da exclusão.
    $confirmarExclusao = $request->input('excluir') == '1'
        && $detalhe !== null;

    return view('usuario.lista-profissionais', compact(
        'profissionais',
        'detalhe',
        'confirmarExclusao'
    ));
}

    public function atualizarVerificacao(Request $request, ProfissionalModel $profissional)
    {
        $dados = $request->validate([
            'statusVerificacao' => ['required', 'in:em_analise,aprovado,pendencia'],
        ]);

        $profissional->update($dados);

        $mensagens = [
            'aprovado'   => 'Profissional aprovado com sucesso.',
            'pendencia'  => 'Profissional marcado com pendência.',
            'em_analise' => 'Profissional devolvido para análise.',
        ];

        return back()->with('sucesso', $mensagens[$dados['statusVerificacao']]);
    }

    public function atualizarStatus(Request $request, ProfissionalModel $profissional)
    {
        if ($profissional->statusConta === 'excluida') {
            return back()->withErrors(['statusConta' => 'Esta conta foi excluída e não pode ser alterada.']);
        }

        $dados = $request->validate([
            'statusConta' => ['required', 'in:ativa,suspensa'],
        ]);

        $profissional->update($dados);

        return back()->with(
            'sucesso',
            $dados['statusConta'] === 'suspensa' ? 'Conta suspensa.' : 'Conta reativada.'
        );
    }
}