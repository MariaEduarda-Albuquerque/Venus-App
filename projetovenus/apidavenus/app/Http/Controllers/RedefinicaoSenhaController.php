<?php

// ONDE SALVAR: app/Http/Controllers/RedefinicaoSenhaController.php

namespace App\Http\Controllers;

use App\Mail\CodigoRedefinicaoSenha;
use App\Models\RedefinicaoSenha;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RedefinicaoSenhaController extends Controller
{
    // PASSO 1: SOLICITAR CÓDIGO
    // POST /api/redefinir-senha  { emailUsuario }
    public function solicitarApi(Request $request)
    {
        $request->validate([
            'emailUsuario' => 'required|email',
        ]);

        $usuario = Usuario::where(
            'emailUsuario',
            $request->emailUsuario
        )->first();

        // Por segurança, sempre respondemos com a mesma mensagem de sucesso,
        // exista ou não esse e-mail cadastrado — assim ninguém consegue usar
        // essa rota pra "descobrir" quais e-mails têm conta no app.
        // Só geramos e enviamos o código se o usuário realmente existir.
        if ($usuario) {

            // invalida qualquer código anterior ainda válido desse e-mail,
            // pra sempre valer só o mais recente
            RedefinicaoSenha::where('emailUsuario', $request->emailUsuario)
                ->where('usadoRedefinicao', false)
                ->update(['usadoRedefinicao' => true]);

            $codigo = str_pad(
                (string) random_int(0, 999999),
                6,
                '0',
                STR_PAD_LEFT
            );

            RedefinicaoSenha::create([
                'emailUsuario' => $request->emailUsuario,
                'codigoRedefinicao' => Hash::make($codigo),
                'expiraEmRedefinicao' => Carbon::now()->addMinutes(15),
                'usadoRedefinicao' => false,
            ]);

            try {

                Mail::to($request->emailUsuario)
                    ->send(new CodigoRedefinicaoSenha($codigo));

            } catch (\Throwable $e) {
                // Não informar sucesso falso quando o serviço de e-mail falhar.
                $registro = RedefinicaoSenha::where('emailUsuario', $request->emailUsuario)
                    ->where('codigoRedefinicao', $codigo)
                    ->where('usadoRedefinicao', false)
                    ->latest('codRedefinicaoSenha')
                    ->first();
                if ($registro) {
                    $registro->update(['usadoRedefinicao' => true]);
                }
                Log::error('Erro ao enviar e-mail de redefinição de senha: ' . $e->getMessage());
                return response()->json([
                    'message' => 'Não foi possível enviar o e-mail agora. Confira a configuração de e-mail do Laravel e tente novamente.',
                ], 503);
            }
        }

        return response()->json([
            'message' => 'Se esse e-mail estiver cadastrado, enviamos um código de verificação para ele.'
        ]);
    }

    // PASSO 2: VERIFICAR CÓDIGO
    // POST /api/redefinir-senha/verificar  { emailUsuario, codigo }
    public function verificarApi(Request $request)
    {
        $request->validate([
            'emailUsuario' => 'required|email',
            'codigo' => 'required|string',
        ]);

        $registro = $this->buscarCodigoValido(
            $request->emailUsuario,
            $request->codigo
        );

        if (!$registro) {
            return response()->json([
                'message' => 'Código inválido ou expirado.'
            ], 422);
        }

        return response()->json([
            'message' => 'Código válido.'
        ]);
    }

    // PASSO 3: CONFIRMAR NOVA SENHA
    // POST /api/redefinir-senha/confirmar  { emailUsuario, codigo, novaSenha }
    public function confirmarApi(Request $request)
    {
        $request->validate([
            'emailUsuario' => 'required|email',
            'codigo' => 'required|string',
            'novaSenha' => 'required|string|min:6|max:255',
        ]);

        $registro = $this->buscarCodigoValido(
            $request->emailUsuario,
            $request->codigo
        );

        if (!$registro) {
            return response()->json([
                'message' => 'Código inválido ou expirado.'
            ], 422);
        }

        $usuario = Usuario::where(
            'emailUsuario',
            $request->emailUsuario
        )->first();

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuário não encontrado.'
            ], 404);
        }

        $usuario->update([
            'senhaUsuario' => Hash::make($request->novaSenha),
        ]);

        // marca o código como usado, pra não poder ser reaproveitado
        $registro->update(['usadoRedefinicao' => true]);

        return response()->json([
            'message' => 'Senha alterada com sucesso.'
        ]);
    }

    // Busca o código mais recente, ainda não usado e dentro da validade,
    // pra esse e-mail. Usada tanto na verificação quanto na confirmação.
    private function buscarCodigoValido(string $email, string $codigo)
    {
        return RedefinicaoSenha::where('emailUsuario', $email)
            ->where('usadoRedefinicao', false)
            ->where('expiraEmRedefinicao', '>=', Carbon::now())
            ->orderByDesc('codRedefinicaoSenha')
            ->get()
            ->first(fn ($registro) => Hash::check($codigo, $registro->codigoRedefinicao));
    }
}
