<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    // MOSTRAR UM USUÁRIO
    public function showUserApi(Request $request, string $id)
    {
        $usuario = $request->user();
        if (!$usuario || (string) $usuario->codUsuario !== (string) $id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }
        return response()->json($usuario);
    }

    // CADASTRAR USUÁRIO
    public function storeApi(Request $request)
    {
        // Aceita CPF com ou sem pontuação, mas valida sempre os 11 dígitos.
        $request->merge(['cpfUsuario' => preg_replace('/\D/', '', (string) $request->input('cpfUsuario'))]);

        $request->validate([
            'nomeUsuario' => 'required|string|max:120',
            'apelidoUsuario' => 'nullable|string|max:60',
            'emailUsuario' => 'required|email|max:150|unique:tbUsuario,emailUsuario',
            'cpfUsuario' => ['required', 'digits:11', 'unique:tbUsuario,cpfUsuario', function ($attribute, $value, $fail) {
                if (!$this->cpfValido($value)) {
                    $fail('O CPF informado é inválido. Confira os números e tente novamente.');
                }
            }],
            'senhaUsuario' => 'required|string|min:8|max:255',
            'dataNascimentoUsuario' => 'required|date_format:Y-m-d',
            'cidadeUsuario' => 'nullable|string|max:100',
            'ufUsuario' => 'nullable|string|size:2',
            'fotoPerfilUsuario' => 'nullable|string|max:255',
            'temaUsuario' => 'nullable|in:claro,escuro,sistema',
            'idiomaUsuario' => 'nullable|string|max:10',
            'anonimaPadraoUsuario' => 'nullable|boolean',
        ]);

        $usuario = Usuario::create([
            'nomeUsuario' => $request->nomeUsuario,
            'apelidoUsuario' => $request->apelidoUsuario,
            'emailUsuario' => strtolower(trim($request->emailUsuario)),
            'cpfUsuario' => $request->cpfUsuario,

            // Criptografa a senha antes de salvar
            'senhaUsuario' => Hash::make($request->senhaUsuario),

            'dataNascimentoUsuario' => $request->dataNascimentoUsuario,
            'cidadeUsuario' => $request->cidadeUsuario,
            'ufUsuario' => $request->ufUsuario,
            'fotoPerfilUsuario' => $request->fotoPerfilUsuario,

            'temaUsuario' => $request->temaUsuario ?? 'claro',
            'idiomaUsuario' => $request->idiomaUsuario ?? 'pt-BR',
            'anonimaPadraoUsuario' => $request->anonimaPadraoUsuario ?? 0,
            'statusUsuario' => 'ativa',
        ]);

        $token = $usuario->createToken('venus-mobile')->plainTextToken;
        return response()->json([
            'message' => 'Usuário cadastrado com sucesso',
            'usuario' => $usuario,
            'token' => $token,
        ], 201);
    }

    // LOGIN
    public function loginApi(Request $request)
    {
        $request->validate([
            'emailUsuario' => 'required|email',
            'senhaUsuario' => 'required|string',
        ]);

        $email = strtolower(trim($request->emailUsuario));
        $usuario = Usuario::where('emailUsuario', $email)->first();

        if (!$usuario) {
            return response()->json([
                'message' => 'E-mail ou senha incorretos'
            ], 401);
        }

        if ($usuario->statusUsuario !== 'ativa') {
            return response()->json([
                'message' => 'Este usuário não está ativo'
            ], 403);
        }

        if (!Hash::check(
            $request->senhaUsuario,
            $usuario->senhaUsuario
        )) {
            return response()->json([
                'message' => 'E-mail ou senha incorretos'
            ], 401);
        }

        $token = $usuario->createToken('venus-mobile')->plainTextToken;
        return response()->json([
            'message' => 'Login realizado com sucesso',
            'usuario' => $usuario,
            'token' => $token,
        ]);
    }


    // Salva as preferências da tela de configurações no MySQL.
    public function updatePreferenciasApi(Request $request, string $id)
    {
        $usuario = $request->user();
        if (!$usuario || (string) $usuario->codUsuario !== (string) $id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $dados = $request->validate([
            'temaUsuario' => 'sometimes|in:claro,escuro,sistema',
            'idiomaUsuario' => 'sometimes|string|in:pt-BR,es,en',
            'tamanhoFonteUsuario' => 'sometimes|numeric|min:0|max:1',
            'altoContrasteUsuario' => 'sometimes|boolean',
            'preferenciasNotificacaoUsuario' => 'sometimes|array',
            'preferenciasNotificacaoUsuario.*' => 'boolean',
            'filtrosInteresseUsuario' => 'sometimes|array',
            'filtrosInteresseUsuario.*' => 'string|max:80',
            'ocultarSensivelUsuario' => 'sometimes|boolean',
            'visibilidadePerfilUsuario' => 'sometimes|in:anonima,profissionais,comunidade',
            'mostrarBioUsuario' => 'sometimes|boolean',
            'permitirApoioUsuario' => 'sometimes|boolean',
            'anonimaPadraoUsuario' => 'sometimes|boolean',
        ]);

        $usuario->fill($dados);
        $usuario->save();

        return response()->json([
            'message' => 'Preferências salvas com sucesso.',
            'preferencias' => $usuario->fresh(),
        ]);
    }

    // EDITAR PERFIL
    public function updateUserApi(Request $request, string $id)
    {
        $request->merge(['cpfUsuario' => preg_replace('/\D/', '', (string) $request->input('cpfUsuario'))]);
        $usuario = $request->user();
        if (!$usuario || (string) $usuario->codUsuario !== (string) $id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $request->validate([
            'nomeUsuario' => 'required|string|max:120',
            'apelidoUsuario' => 'nullable|string|max:60',
            'emailUsuario' => 'required|email|max:150|unique:tbUsuario,emailUsuario,' . $id . ',codUsuario',
            'cpfUsuario' => ['required', 'digits:11', 'unique:tbUsuario,cpfUsuario,' . $id . ',codUsuario', function ($attribute, $value, $fail) {
                if (!$this->cpfValido($value)) {
                    $fail('O CPF informado é inválido. Confira os números e tente novamente.');
                }
            }],
            'dataNascimentoUsuario' => 'required|date_format:Y-m-d',
            'cidadeUsuario' => 'nullable|string|max:100',
            'ufUsuario' => 'nullable|string|size:2',
            'fotoPerfilUsuario' => 'nullable|string|max:255',
            'temaUsuario' => 'in:claro,escuro,sistema',
            'idiomaUsuario' => 'string|max:10',
            'anonimaPadraoUsuario' => 'boolean',
        ]);

        $usuario->update(
            $request->only([
                'nomeUsuario',
                'apelidoUsuario',
                'emailUsuario',
                'cpfUsuario',
                'dataNascimentoUsuario',
                'cidadeUsuario',
                'ufUsuario',
                'fotoPerfilUsuario',
                'temaUsuario',
                'idiomaUsuario',
                'anonimaPadraoUsuario',
            ])
        );

        return response()->json([
            'message' => 'Usuário alterado com sucesso',
            'usuario' => $usuario
        ]);
    }

    // Atualiza os dados pessoais e, opcionalmente, a senha numa única requisição.
    public function updateDadosPessoaisApi(Request $request, string $id)
    {
        $usuario = $request->user();
        if (!$usuario || (string) $usuario->codUsuario !== (string) $id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $dados = $request->validate([
            'emailUsuario' => 'required|email|max:150|unique:tbUsuario,emailUsuario,' . $id . ',codUsuario',
            'dataNascimentoUsuario' => 'required|date_format:Y-m-d',
            'senhaAtual' => 'nullable|required_with:senhaUsuario|string',
            'senhaUsuario' => 'nullable|required_with:senhaAtual|string|min:8|max:255',
        ]);

        if (!empty($dados['senhaUsuario']) && !Hash::check($dados['senhaAtual'], $usuario->senhaUsuario)) {
            return response()->json(['message' => 'A senha atual está incorreta.'], 422);
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($usuario, $dados) {
            $usuario->update([
                'emailUsuario' => strtolower(trim($dados['emailUsuario'])),
                'dataNascimentoUsuario' => $dados['dataNascimentoUsuario'],
            ]);

            if (!empty($dados['senhaUsuario'])) {
                $usuario->update(['senhaUsuario' => Hash::make($dados['senhaUsuario'])]);
            }
        });

        return response()->json([
            'message' => 'Dados pessoais atualizados.',
            'usuario' => $usuario->fresh(),
        ]);
    }

    // ALTERAR SENHA
    public function updateSenhaApi(Request $request, string $id)
    {
        $usuario = $request->user();
        if (!$usuario || (string) $usuario->codUsuario !== (string) $id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }
        $request->validate([
            'senhaAtual' => 'required|string',
            'senhaUsuario' => 'required|string|min:8|max:255',
        ]);
        if (!Hash::check($request->senhaAtual, $usuario->senhaUsuario)) {
            return response()->json(['message' => 'A senha atual está incorreta.'], 422);
        }
        $usuario->update(['senhaUsuario' => Hash::make($request->senhaUsuario)]);

        return response()->json([
            'message' => 'Senha alterada com sucesso'
        ]);
    }

    // DELETAR USUÁRIO
    public function destroyUserApi(Request $request, string $id)
    {
        $usuario = $request->user();
        if (!$usuario || (string) $usuario->codUsuario !== (string) $id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }
        $usuario->tokens()->delete();
        $usuario->delete();

        return response()->json([
            'message' => 'Usuário excluído com sucesso'
        ]);
    }

    // Envio de foto de perfil autenticado.
    public function uploadFoto(Request $request, string $id)
    {
        $usuarioAutenticado = $request->user();
        if (!$usuarioAutenticado || (string) $usuarioAutenticado->codUsuario !== (string) $id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }
        $request->validate(['foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120']);
        $usuario = Usuario::findOrFail($id);
        if ($usuario->fotoPerfilUsuario) {
            Storage::disk('public')->delete($usuario->fotoPerfilUsuario);
        }
        $path = $request->file('foto')->store('perfis', 'public');
        $usuario->update(['fotoPerfilUsuario' => $path]);
        return response()->json(['message' => 'Foto atualizada.', 'fotoPerfilUsuario' => $path, 'usuario' => $usuario]);
    }

    public function logoutApi(Request $request)
    {
        $request->user()?->currentAccessToken()?->delete();
        return response()->json(['message' => 'Sessão encerrada.']);
    }

    /** Confere os dígitos verificadores do CPF; não consulta a Receita Federal. */
    private function cpfValido(string $cpf): bool
    {
        $cpf = preg_replace('/\D/', '', $cpf);
        if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        for ($digito = 9; $digito <= 10; $digito++) {
            $soma = 0;
            for ($i = 0; $i < $digito; $i++) {
                $soma += (int) $cpf[$i] * (($digito + 1) - $i);
            }
            $resto = ($soma * 10) % 11;
            $calculado = ($resto === 10) ? 0 : $resto;
            if ($calculado !== (int) $cpf[$digito]) {
                return false;
            }
        }
        return true;
    }
}