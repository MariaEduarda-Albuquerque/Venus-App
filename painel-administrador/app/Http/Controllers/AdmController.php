<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

    /**
     * Tela de perfil (somente leitura).
     */
    public function perfil()
    {
        $admin = Auth::guard('admin')->user();
        [$primeiroNome, $sobrenome] = $this->separarNome($admin->nomeAdmin);

        // Ajuste "nomePapel" para o nome real da coluna na tabela de papéis.
        $cargo = $admin->papel->nomePapel ?? 'Administrador';

        $cidade = $admin->cidadeAdmin
            ? $admin->cidadeAdmin . ($admin->ufAdmin ? ' - ' . $admin->ufAdmin : '')
            : '—';

        return view('perfil-config.perfil-adm', [
            'admin'        => $admin,
            'inicial'      => mb_strtoupper(mb_substr($primeiroNome ?: 'A', 0, 1)),
            'nomeCompleto' => $admin->nomeAdmin,
            'primeiroNome' => $primeiroNome,
            'sobrenome'    => $sobrenome ?: '—',
            'cargo'        => $cargo,
            'cidade'       => $cidade,
            'pais'         => $admin->paisAdmin ?: '—',
            'email'        => $admin->emailAdmin,
            'telefone'     => $admin->telAdmin ?: '—',
            'codPostal'    => $admin->cepAdmin ?: '—',
            'nrfiscal'     => $admin->nrFiscalAdmin ?: '—',
        ]);
    }

    /**
     * Tela de edição do perfil.
     */
    public function editarPerfil()
    {
        $admin = Auth::guard('admin')->user();
        [$primeiroNome, $sobrenome] = $this->separarNome($admin->nomeAdmin);

        return view('perfil-config.editar-perfil', [
            'admin'        => $admin,
            'inicial'      => mb_strtoupper(mb_substr($primeiroNome ?: 'A', 0, 1)),
            'primeiroNome' => $primeiroNome,
            'sobrenome'    => $sobrenome,
            'cargo'        => $admin->papel->nomePapel ?? 'Administrador',
        ]);
    }

    /**
     * Salva as alterações do perfil.
     */
    public function atualizarPerfil(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $dados = $request->validate([
            'primeiro_nome' => ['required', 'string', 'max:100'],
            'sobrenome'     => ['nullable', 'string', 'max:100'],
            'email'         => [
                'required', 'email', 'max:255',
                Rule::unique('tbadmin', 'emailAdmin')->ignore($admin->codAdmin, 'codAdmin'),
            ],
            'telefone'      => ['nullable', 'string', 'max:20'],
            'pais'          => ['nullable', 'string', 'max:100'],
            'cidade'        => ['nullable', 'string', 'max:100'],
            'uf'            => ['nullable', 'string', 'size:2'],
            'cep'           => ['nullable', 'string', 'max:15'],
            'nfiscal'       => ['nullable', 'string', 'max:30'],
        ], [
            'primeiro_nome.required' => 'Informe o primeiro nome.',
            'email.required'         => 'Informe o e-mail.',
            'email.email'            => 'Informe um e-mail válido.',
            'email.unique'           => 'Este e-mail já está em uso.',
            'uf.size'                => 'Use a sigla do estado com 2 letras.',
        ]);

        // Mapeia os campos do formulário para as colunas reais da tbadmin.
        // codPapel, statusConta e senhaAdmin ficam de fora de propósito.
        $admin->update([
            'nomeAdmin'     => trim($dados['primeiro_nome'] . ' ' . ($dados['sobrenome'] ?? '')),
            'emailAdmin'    => $dados['email'],
            'telAdmin'      => $dados['telefone'] ?? null,
            'paisAdmin'     => $dados['pais'] ?? null,
            'cidadeAdmin'   => $dados['cidade'] ?? null,
            'ufAdmin'       => isset($dados['uf']) ? strtoupper($dados['uf']) : null,
            'cepAdmin'      => $dados['cep'] ?? null,
            'nrFiscalAdmin' => $dados['nfiscal'] ?? null,
        ]);

        return redirect()
            ->route('perfil')
            ->with('sucesso', 'Perfil atualizado com sucesso!');
    }

    /**
     * "Clodo Almeida Souza" => ['Clodo', 'Almeida Souza']
     */
    private function separarNome(?string $nome): array
    {
        $partes = explode(' ', trim((string) $nome), 2);

        return [$partes[0] ?? '', $partes[1] ?? ''];
    }
}