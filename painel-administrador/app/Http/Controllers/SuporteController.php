<?php

namespace App\Http\Controllers;

use App\Models\ChamadoSuporte;
use App\Models\ChamadoMensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SuporteController extends Controller
{
    /**
     * Lista os chamados no painel administrativo.
     */

    public function index(Request $request)
    {
        $query = ChamadoSuporte::with([
            'profissional',
            'mensagens'
        ]);

        if ($request->filled('busca')) {
            $busca = $request->busca;

            $query->where(function ($q) use ($busca) {
                $q->where('assuntoChamado', 'like', "%{$busca}%")
                ->orWhere('descricaoChamado', 'like', "%{$busca}%")
                ->orWhereHas('profissional', function ($prof) use ($busca) {
                    $prof->where(
                        'nomeProfissionalSaude',
                        'like',
                        "%{$busca}%"
                    );
                });
            });
        }

        if ($request->filled('aba')) {
            if ($request->aba === 'o') {
                $query->whereIn('statusChamado', [
                    'aberto',
                    'em_atendimento'
                ]);
            } elseif ($request->aba === 'r') {
                $query->where('statusChamado', 'resolvido');
            }
        }

        if ($request->filled('status')) {
            $query->where('statusChamado', $request->status);
        }

        $chamados = $query
            ->orderBy('dataAbertura', 'desc')
            ->get();

        $totalAbertos = ChamadoSuporte::where(
            'statusChamado', 'aberto'
        )->count();

        $totalAtendimento = ChamadoSuporte::where(
            'statusChamado', 'em_atendimento'
        )->count();

        $totalResolvidos = ChamadoSuporte::where(
            'statusChamado', 'resolvido'
        )->count();

        $totalChamados = ChamadoSuporte::count();

        return view('outros.suporte', compact(
            'chamados',
            'totalAbertos',
            'totalAtendimento',
            'totalResolvidos',
            'totalChamados'
        ));
    }


    public function responder(Request $request, $codChamado)
    {
        $dados = $request->validate([
            'textoMensagem' => [
                'nullable',
                'string',
                'max:5000',
                'required_without:anexoMensagem'
            ],

            'anexoMensagem' => [
                'nullable',
                'file',
                'max:10240',
                'mimes:pdf,jpg,jpeg,png,doc,docx'
            ],
        ]);

        $chamado = ChamadoSuporte::findOrFail($codChamado);

        $adminId = Auth::guard('admin')->id();

        if (!$adminId) {
            abort(403, 'Administrador não autenticado.');
        }

        $caminhoAnexo = null;

        if ($request->hasFile('anexoMensagem')) {
            $caminhoAnexo = $request
                ->file('anexoMensagem')
                ->store('suporte/mensagens', 'public');
        }

        try {
            DB::transaction(function () use (
                $chamado,
                $dados,
                $adminId,
                $caminhoAnexo
            ) {
                ChamadoMensagem::create([
                    'codChamado' => $chamado->codChamado,
                    'tipoRemetente' => 'admin',
                    'codRemetente' => $adminId,
                    'textoMensagem' => $dados['textoMensagem'] ?? '',
                    'anexoMensagem' => $caminhoAnexo,
                ]);

                if ($chamado->statusChamado === 'aberto') {
                    $chamado->update([
                        'statusChamado' => 'em_atendimento'
                    ]);
                }
            });

        } catch (\Throwable $e) {
            if ($caminhoAnexo) {
                Storage::disk('public')->delete($caminhoAnexo);
            }

            throw $e;
        }

        return back()->with(
            'sucesso',
            'Resposta enviada com sucesso!'
        );
    }


    public function atualizarStatus(Request $request, $codChamado)
    {
        $dados = $request->validate([
            'statusChamado' => [
                'required',
                Rule::in([
                    'aberto',
                    'em_atendimento',
                    'resolvido'
                ])
            ],
        ]);

        $chamado = ChamadoSuporte::findOrFail($codChamado);

        $chamado->update([
            'statusChamado' => $dados['statusChamado']
        ]);

        return back()->with(
            'sucesso',
            'Status do chamado atualizado com sucesso!'
        );
    }
}
