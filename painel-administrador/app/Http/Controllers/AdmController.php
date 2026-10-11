<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmController extends Controller
{
    public function showLogin()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $dados = $request->validate([
            'emailAdmin' => ['required', 'email'],
            'password'   => ['required'],
        ], 

        [
            'emailAdmin.required' => 'Informe o e-mail.',
            'emailAdmin.email'    => 'Informe um e-mail válido.',
            'password.required'   => 'Informe a senha.',
        ]);

        $admin = Admin::where('emailAdmin', $dados['emailAdmin'])->first();

        if ($admin
            && $admin->statusConta === 'suspensa'
            && password_verify($dados['password'], $admin->senhaAdmin)) {
            return back()
                ->withErrors(['emailAdmin' => 'Esta conta está suspensa. Fale com o responsável.'])
                ->onlyInput('emailAdmin');
        }

        $credenciais = [
            'emailAdmin'  => $dados['emailAdmin'],
            'password'    => $dados['password'],
            'statusConta' => 'ativa',
        ];

        if (Auth::guard('admin')->attempt($credenciais, $request->boolean('lembrar'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors(['emailAdmin' => 'E-mail ou senha inválidos.'])
            ->onlyInput('emailAdmin');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}