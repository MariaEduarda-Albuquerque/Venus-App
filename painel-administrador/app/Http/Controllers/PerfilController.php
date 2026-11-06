<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    private const UFS = [
        'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA',
        'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO',
    ];

    private function admin()
    {
        return Auth::guard('admin')->user();
    }

    // Dados do administrador logado, com os mesmos nomes que as telas de perfil já usavam
    private function dadosDoPerfil($admin): array
    {
        $nomeCompleto = trim((string) $admin->nomeAdmin);
        $partes = preg_split('/\s+/', $nomeCompleto, 2);

        return [
            'nomeCompleto' => $nomeCompleto,
            'primeiroNome' => $partes[0] ?? '',
            'sobrenome'    => $partes[1] ?? '',
            'cargo'        => optional($admin->papel)->nomePapel,
            'inicial'      => mb_strtoupper(mb_substr($nomeCompleto, 0, 1)),
            'cidade'       => $admin->cidadeAdmin,
            'pais'         => $admin->paisAdmin,
            'email'        => $admin->emailAdmin,
            'telefone'     => $admin->telAdmin,
            'uf'           => $admin->ufAdmin,
            'cep'          => $admin->cepAdmin,
            'nrfiscal'     => $admin->nrFiscalAdmin,
            'statusConta'  => $admin->statusConta,
            'codPostal'    => $admin->codpostalAdmin,
        ];
    }

    /**
     * Tela de perfil
     */
    public function index()
    {
        return view('perfil-config.perfil-adm', $this->dadosDoPerfil($this->admin()));
    }

    /**
     * Tela de editar perfil (os campos já vêm preenchidos com os dados salvos)
     */
    public function editar()
    {
        $admin = $this->admin();
        $dados = $this->dadosDoPerfil($admin);

        // "São Paulo, SP": a tela tem um campo só para cidade e estado
        $dados['cidadeUf'] = trim($admin->cidadeAdmin . ($admin->ufAdmin ? ', ' . $admin->ufAdmin : ''), ' ,');

        $cep = preg_replace('/\D/', '', (string) $admin->codpostalAdmin);
        $dados['cepFormatado'] = strlen($cep) === 8 ? substr($cep, 0, 5) . '-' . substr($cep, 5) : $cep;

        return view('perfil-config.editar-perfil', $dados);
    }

    /**
     * Salva o editar perfil
     */
    public function atualizar(Request $request)
    {
        $admin = $this->admin();

        // Telefone e CEP são validados só com os números
        $entrada = $request->all();
        $entrada['telefone'] = preg_replace('/\D/', '', (string) $request->input('telefone'));
        $entrada['cep'] = preg_replace('/\D/', '', (string) $request->input('cep'));

        // "São Paulo, SP" vira cidade + UF
        $cidade = trim((string) $request->input('cidade'));
        $uf = null;
        if (preg_match('/^(.+?)\s*[,\/\-]\s*([A-Za-z]{2})$/u', $cidade, $m)) {
            $cidade = trim($m[1]);
            $uf = strtoupper($m[2]);
        }
        $entrada['cidade_nome'] = $cidade;
        $entrada['uf'] = $uf;

        Validator::make($entrada, [
            'primeiro_nome' => ['required', 'string', 'min:2', 'max:60', "regex:/^[\p{L}][\p{L}\s'.\-]*$/u"],
            'sobrenome'     => ['nullable', 'string', 'max:60', "regex:/^[\p{L}][\p{L}\s'.\-]*$/u"],
            'email'         => ['required', 'email', 'max:150', Rule::unique('tbadmin', 'emailAdmin')->ignore($admin->codAdmin, 'codAdmin')],
            'telefone'      => ['nullable', 'regex:/^\d{10,11}$/'],
            'pais'          => ['nullable', 'string', 'max:60'],
            'cidade_nome'   => ['nullable', 'string', 'max:100'],
            'uf'            => ['nullable', Rule::in(self::UFS)],
            'cep'           => ['nullable', 'regex:/^\d{8}$/'],
            'nfiscal'       => ['nullable', 'string', 'max:20', 'regex:/^[\d.\-\/]+$/'],
        ], [
            'primeiro_nome.required' => 'Informe o primeiro nome.',
            'primeiro_nome.min'      => 'O nome deve ter no mínimo :min letras.',
            'primeiro_nome.max'      => 'O nome deve ter no máximo :max caracteres.',
            'primeiro_nome.regex'    => 'O nome deve conter apenas letras.',
            'sobrenome.max'          => 'O sobrenome deve ter no máximo :max caracteres.',
            'sobrenome.regex'        => 'O sobrenome deve conter apenas letras.',
            'email.required'         => 'Informe o e-mail.',
            'email.email'            => 'Informe um e-mail válido.',
            'email.max'              => 'O e-mail deve ter no máximo :max caracteres.',
            'email.unique'           => 'Esse e-mail já está em uso por outra conta.',
            'telefone.regex'         => 'Informe o telefone com DDD. Ex: 11 99999-9999.',
            'pais.max'               => 'O país deve ter no máximo :max caracteres.',
            'cidade_nome.max'        => 'A cidade deve ter no máximo :max caracteres.',
            'uf.in'                  => 'Estado inválido. Use a sigla com 2 letras. Ex: São Paulo, SP.',
            'cep.regex'              => 'Informe o código postal com 8 números. Ex: 01100-000.',
            'nfiscal.max'            => 'O nº fiscal deve ter no máximo :max caracteres.',
            'nfiscal.regex'          => 'O nº fiscal deve ter apenas números, pontos, traços ou barra.',
        ])->validate();

        $telefone = $entrada['telefone'];
        if ($telefone !== '') {
            $telefone = substr($telefone, 0, 2) . ' ' . (strlen($telefone) === 11
                ? substr($telefone, 2, 5) . '-' . substr($telefone, 7)
                : substr($telefone, 2, 4) . '-' . substr($telefone, 6));
        }

        $admin->fill([
            'nomeAdmin'      => trim($request->primeiro_nome . ' ' . $request->sobrenome),
            'emailAdmin'     => $request->email,
            'telAdmin'       => $telefone !== '' ? $telefone : null,
            'paisAdmin'      => $request->filled('pais') ? trim($request->pais) : null,
            'cidadeAdmin'    => $cidade !== '' ? $cidade : null,
            'ufAdmin'        => $uf,
            'codpostalAdmin' => $entrada['cep'],   // a coluna não aceita nulo
            'nrFiscalAdmin'  => $request->filled('nfiscal') ? trim($request->nfiscal) : null,
        ])->save();

        return redirect()->route('perfil')->with('sucesso', 'Perfil atualizado com sucesso.');
    }

    /**
     * Tela de alterar senha
     */
    public function senha()
    {
        return view('perfil-config.alterar-senha');
    }

    /**
     * Salva a nova senha
     */
    public function atualizarSenha(Request $request)
    {
        $admin = $this->admin();

        $request->validate([
            'senha_atual' => ['required'],
            'nova_senha'  => [
                'required', 'string', 'min:8', 'max:255', 'confirmed', 'different:senha_atual',
                'regex:/\p{Ll}/u', 'regex:/\p{Lu}/u', 'regex:/\p{N}/u',
            ],
        ], [
            'senha_atual.required'     => 'Informe a senha atual.',
            'nova_senha.required'      => 'Informe a nova senha.',
            'nova_senha.min'           => 'A nova senha deve ter no mínimo :min caracteres.',
            'nova_senha.max'           => 'A nova senha deve ter no máximo :max caracteres.',
            'nova_senha.confirmed'     => 'A confirmação da nova senha não confere.',
            'nova_senha.different'     => 'A nova senha deve ser diferente da atual.',
            'nova_senha.regex'         => 'A nova senha deve ter letra maiúscula, minúscula e número.',
        ]);

        if (!Hash::check($request->senha_atual, $admin->senhaAdmin)) {
            return back()->withErrors(['senha_atual' => 'A senha atual está incorreta.']);
        }

        // O model já guarda a senha criptografada (cast "hashed")
        $admin->senhaAdmin = $request->nova_senha;
        $admin->save();

        return redirect()->route('perfil')->with('sucesso', 'Senha alterada com sucesso.');
    }
}
