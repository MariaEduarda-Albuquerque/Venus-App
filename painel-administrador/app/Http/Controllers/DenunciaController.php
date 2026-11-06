<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\DenunciaAcao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DenunciaController extends Controller
{
    private const PENDENTE = 'pendente';
    private const RESOLVIDA = 'resolvida';

    /**
     * Exibe a lista de denúncias.
     */
   
    public function index()
    {
        // Lista todas as denúncias, incluindo os dados da usuária.
        $denuncias = Denuncia::with('tbusuario')
            ->orderByDesc('dataDenuncia')
            ->get();

        // Quantidade total de denúncias.
        $total = Denuncia::count();

        // Quantidade de denúncias pendentes.
        $pendentes = Denuncia::where('statusDenuncia', 'pendente')
            ->count();

        // Quantidade de denúncias resolvidas.
        $resolvidas = Denuncia::where('statusDenuncia', 'resolvida')
            ->count();

        // Quantidade de mensagens denunciadas ainda pendentes.
        $mensagensPendentes = Denuncia::where('tipoAlvo', 'mensagem_chat')
            ->where('statusDenuncia', 'pendente')
            ->count();

        return view('usuario.lista-denuncias', compact(
            'denuncias',
            'total',
            'pendentes',
            'resolvidas',
            'mensagensPendentes'
        ));
    }


    /**
     * Altera o status de uma denúncia e registra a ação do administrador.
     */
    public function decidir(Request $request, Denuncia $denuncia)
    {
        $dados = $request->validate([
            'status' => [
                'required',
                'in:' . self::PENDENTE . ',' . self::RESOLVIDA,
            ],
            'justificativa' => [
                'required',
                'string',
                'max:1000',
            ],
        ], [
            'status.required' => 'O status da denúncia é obrigatório.',
            'status.in' => 'O status informado é inválido.',
            'justificativa.required' => 'Informe a justificativa antes de confirmar.',
            'justificativa.max' => 'A justificativa pode ter no máximo 1000 caracteres.',
        ]);

        $adminId = Auth::guard('admin')->id();

        if (!$adminId) {
            return response()->json([
                'success' => false,
                'message' => 'Administrador não autenticado.',
            ], 401);
        }

        try {
            $resultado = DB::transaction(function () use (
                $denuncia,
                $dados,
                $adminId
            ) {
                // Atualiza o status da denúncia.
                $denuncia->statusDenuncia = $dados['status'];
                $denuncia->save();

                // Confere se o status foi gravado corretamente.
                $statusGravado = Denuncia::where(
                    'codDenuncia',
                    $denuncia->codDenuncia
                )->value('statusDenuncia');

                if ($statusGravado !== $dados['status']) {
                    throw new \RuntimeException(
                        'O status da denúncia não foi gravado corretamente.'
                    );
                }

                // Registra a ação realizada pelo administrador.
                DenunciaAcao::create([
                    'codDenuncia' => $denuncia->codDenuncia,
                    'codAdmin' => $adminId,
                    'acaoTomada' => $dados['status'] === self::RESOLVIDA
                        ? 'resolvida'
                        : 'reaberta',
                    'justificativa' => $dados['justificativa'],
                ]);

                return $statusGravado;
            });

            return response()->json([
                'success' => true,
                'message' => $resultado === self::RESOLVIDA
                    ? 'Denúncia marcada como resolvida.'
                    : 'Denúncia reaberta.',
                'status' => $resultado,
            ], 200);

        } catch (\Throwable $erro) {
            report($erro);

            return response()->json([
                'success' => false,
                'message' => 'Não foi possível atualizar a denúncia. Tente novamente.',
            ], 500);
        }
    }
}
