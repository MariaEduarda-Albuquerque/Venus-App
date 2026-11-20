<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    /**
     * Redireciona o profissional para a tela de consentimento do Google.
     */
    public function redirect()
    {
        return Socialite::driver('google')
            ->stateless()
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Retorno do Google: valida o profissional e abre a sessão do painel.
     */
    public function callback(Request $request)
    {
        // Usuário clicou em "Cancelar" na tela do Google
        if ($request->has('error')) {
            return redirect('/')->with('erro', 'Login com Google cancelado.');
        }

        try {
            $google = Socialite::driver('google')->stateless()->user();
        } catch (Throwable $e) {
            report($e);
            return redirect('/')->with('erro', 'Não foi possível entrar com o Google. Tente novamente.');
        }

        $email = $google->getEmail();
        $googleId = $google->getId();

        if (!$email) {
            return redirect('/')->with('erro', 'Sua conta Google não retornou um e-mail.');
        }

        // Só aceita e-mails verificados pelo Google (evita tomada de conta)
        $verificado = $google->user['email_verified'] ?? $google->user['verified_email'] ?? false;
        if (!$verificado) {
            return redirect('/')->with('erro', 'O e-mail da sua conta Google não está verificado.');
        }

        // Procura primeiro pelo googleId já vinculado, depois pelo e-mail
        $user = User::where('googleIdProfissional', $googleId)->first()
            ?? User::where('emailProfissionalSaude', $email)->first();

        // O cadastro exige CPF/CNPJ, categoria e comprovante do conselho,
        // então não criamos conta automaticamente pelo Google.
        if (!$user) {
            return redirect('/')->with(
                'erro',
                'Nenhuma conta encontrada para este e-mail. Faça seu cadastro primeiro.'
            );
        }

        // Mesmas regras do login por e-mail e senha
        if ($user->statusConta == 'Excluída') {
            return redirect('/')->with('erro', 'Esta conta não existe.');
        } elseif ($user->statusVerificacao == 'Em análise') {
            return redirect('/')->with('erro', 'Esta conta está em análise.');
        } elseif ($user->statusVerificacao == 'Pendência') {
            return redirect('/')->with('erro', 'Esta conta está pendente.');
        } elseif ($user->statusConta == 'Suspensa') {
            return redirect('/')->with('erro', 'Esta conta está suspensa.');
        }

        // Vincula a conta Google no primeiro acesso
        if (empty($user->googleIdProfissional)) {
            $user->googleIdProfissional = $googleId;
            $user->provedorLoginProfissional = 'Google';
            $user->save();
        } elseif ($user->googleIdProfissional !== $googleId) {
            return redirect('/')->with('erro', 'Este e-mail está vinculado a outra conta Google.');
        }

        $request->session()->regenerate();

        session([
            'id' => $user->codProfissionalSaude,
            'nome' => $user->nomeProfissionalSaude,
        ]);

        return redirect()->route('painel.dashboard');
    }
}
