<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:120',
            'email' => 'required|email|unique:tbprofissionalsaude,emailProfissionalSaude|max:150',
            'telefone' => 'nullable|string|max:14|unique:tbprofissionalsaude,telProfissionalSaude',
            'senha' => 'required|string|max:255|min:8',
            'categoria' => 'required|string',
            'especialidade' => 'nullable|string|max:25',
            'apresentacao' => 'nullable|string|max:400',
            'pais' => 'nullable|string|max:60',
            'cidade' => 'nullable|string|max:100',
            'uf' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'nrFiscal' => 'nullable|string|max:20|min:11|unique:tbprofissionalsaude,nrFiscalProfissional',
            'fotoPerfil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nome.required' => 'Campo nome obrigatório.',
            'nome.max' => 'O nome deve ter no máximo 120 caracteres.',

            'email.required' => 'Campo email obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Esse email já foi cadastrado',
            'email.max' => 'O e-mail deve ter no máximo 150 caracteres.',

            'telefone.max' => 'O telefone deve ter no máximo 14 caracteres.',
            'telefone.unique' => 'Esse telefone já está cadastrado',

            'senha.required' => 'Campo senha obrigatório.',
            'senha.max' => 'A senha deve ter no máximo 255 caracteres.',
            'senha.min' => 'A senha deve ter no mínimo 8 caracteres',

            'categoria.required' => 'Campo categoria obrigatório.',
            'especialidade.max' => 'A especialidade deve ter no máximo 25 caracteres.',
            'apresentacao.max' => 'A apresentação deve ter no máximo 400 caracteres.',

            'pais.max' => 'O país deve ter no máximo 60 caracteres',
            'cidade.max' => 'A cidade deve ter no máximo 100 caracteres',
            'uf.max' => 'O UF deve ter no máximo 2 caracteres',
            'cep.max' => 'O CEP deve ter no máximo 10 caracteres',

            'nrFiscal.max' => 'O CPF  ou CPNJ devem ter no máximo 20 caracteres',
            'nrFiscal.min' => 'O CPF  ou CPNJ devem ter no mínimo 11 caracteres',
            'nrFiscal.unique' => 'Esse CPF ou CNPJ já foi cadastrado',

            'fotoPerfil.mimes' => 'O arquivo deve ser jpg, jpeg, png ou webp',
            'fotoPerfil.max' => 'O arquivo deve ter no máximo 2 MB',
        ]);

        $documento = preg_replace('/\D/', '', $request->nrFiscal);

        if (!$this->validarCpfCnpj($documento)) {
            return back()
                ->withErrors([
                    'nrFiscal' => 'CPF ou CNPJ inválido.'
                ])
                ->withInput();
        }

        User::create([
            'nomeProfissionalSaude' => $request->nome,
            'emailProfissionalSaude' => $request->email,
            'telProfissionalSaude' => $request->telefone,
            'senhaProfissionalSaude' => Hash::make($request->senha),
            'duasEtapasAtiva' => false,
            'provedorLoginProfissional' => 'Local',
            'googleIdProfissional' => null,
            'categoriaProfissional' => $request->categoria,
            'especialidadeProfissionalSaude' => $request->especialidade,
            'apresentacaoProfissional' => $request->apresentacao,
            'paisProfissional' => $request->pais,
            'cidadeProfissional'=> $request->cidade,
            'ufProfissional'=>$request->uf,
            'cepProfissional'=>$request->cep,
            'nrFiscalProfissional'=>$request->nrFiscal,
            'fotoPerfilProfissional' => $request->fotoPerfil,
            'statusVerificacao' => 'Em análise',
            'statusConta' => 'Ativa',
        ]);

        return redirect('/')->with('sucesso', 'Conta criada com sucesso!');
    }

    private function validarCpfCnpj($documento)
    {
        if (strlen($documento) === 11) {
            return $this->validarCpf($documento);
        }

        if (strlen($documento) === 14) {
            return $this->validarCnpj($documento);
        }

        return false;
    }

    private function validarCpf($cpf)
    {
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        $soma = 0;

        for ($i = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }

        $resto = $soma % 11;

        if ($resto < 2) {
            $digito1 = 0;
        } else {
            $digito1 = 11 - $resto;
        }

        if ($cpf[9] != $digito1) {
            return false;
        }

        $soma = 0;

        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }

        $resto = $soma % 11;

        if ($resto < 2) {
            $digito2 = 0;
        } else {
            $digito2 = 11 - $resto;
        }

        if ($cpf[10] != $digito2) {
            return false;
        }

        return true;
    }

    private function validarCnpj($cnpj)
    {
        if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
            return false;
        }

        $pesos = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $soma = 0;

        for ($i = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $pesos[$i];
        }

        $resto = $soma % 11;

        if ($resto < 2) {
            $digito1 = 0;
        } else {
            $digito1 = 11 - $resto;
        }

        if ($cnpj[12] != $digito1) {
            return false;
        }

        $soma = 0;

        $pesos = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $pesos[$i];
        }

        $resto = $soma % 11;

        if ($resto < 2) {
            $digito2 = 0;
        } else {
            $digito2 = 11 - $resto;
        }

        if ($cnpj[13] != $digito2) {
            return false;
        }

        return true;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'senha' => 'required|string',
        ], [
            'email.required' => 'Campo email obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'senha.required' => 'Campo senha obrigatório.',
        ]);

        $user = User::where('emailProfissionalSaude', $request->email)->first();

        if(!$user){
            return redirect('/')->with('erro', 'E-mail não encontrado.');
        }elseif ($user && $user->statusConta == 'Excluída') {
            return redirect('/')->with('erro', 'Esta conta não existe.');
        } elseif ($user && $user->statusConta == 'Suspensa') {
            return redirect('/')->with('erro', 'Esta conta está suspensa.');
        } elseif (!$user || !Hash::check($request->senha, $user->senhaProfissionalSaude)) {
            return redirect('/')->with('erro', 'Senha incorreta.');
        }

        $request->session()->regenerate();

        session([
            'id' => $user->codProfissionalSaude,
            'nome' => $user->nomeProfissionalSaude,
        ]);

        return redirect()->route('painel.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }

    public function perfil()
    {
        $profissional = User::find(session('id'));

        return view('user.perfil-profissional', compact('profissional'));
    }

    public function editar()
    {
        $profissional = User::find(session('id'));

        return view('user.update-profissional', compact('profissional'));
    }

    public function atualizar(Request $request)
    {
        $profissional = User::find(session('id'));

        if (!$profissional) {
            return redirect('/')->with('erro', 'Profissional não encontrado.');
        }

        $request->validate([
            'nome' => 'required|string|max:120',
            'email' => 'required|email|max:150|unique:tbprofissionalsaude,emailProfissionalSaude,' . $profissional->codProfissionalSaude . ',codProfissionalSaude',
            'telefone' => 'nullable|string|max:14|unique:tbprofissionalsaude,telProfissionalSaude,' . $profissional->codProfissionalSaude . ',codProfissionalSaude',
            'categoria' => 'required|string',
            'especialidade' => 'nullable|string|max:25',
            'apresentacao' => 'nullable|string|max:400',
            'pais' => 'nullable|string|max:60',
            'cidade' => 'nullable|string|max:100',
            'uf' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'fotoPerfil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nome.required' => 'Campo nome obrigatório.',
            'nome.max' => 'O nome deve ter no máximo 120 caracteres.',

            'email.required' => 'Campo email obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Esse email já foi cadastrado',
            'email.max' => 'O e-mail deve ter no máximo 150 caracteres.',

            'telefone.max' => 'O telefone deve ter no máximo 14 caracteres.',
            'telefone.unique' => 'Esse telefone já está cadastrado',

            'categoria.required' => 'Campo categoria obrigatório.',
            'especialidade.max' => 'A especialidade deve ter no máximo 25 caracteres.',
            'apresentacao.max' => 'A apresentação deve ter no máximo 400 caracteres.',

            'pais.max' => 'O país deve ter no máximo 60 caracteres',
            'cidade.max' => 'A cidade deve ter no máximo 100 caracteres',
            'uf.max' => 'O UF deve ter no máximo 2 caracteres',
            'cep.max' => 'O CEP deve ter no máximo 10 caracteres',

            'fotoPerfil.mimes' => 'O arquivo deve ser jpg, jpeg, png ou webp',
            'fotoPerfil.max' => 'O arquivo deve ter no máximo 2 MB',
        ]);

        $profissional->nomeProfissionalSaude = $request->nome;
        $profissional->emailProfissionalSaude = $request->email;
        $profissional->telProfissionalSaude = $request->telefone;
        $profissional->categoriaProfissional = $request->categoria;
        $profissional->especialidadeProfissionalSaude = $request->especialidade;
        $profissional->apresentacaoProfissional = $request->apresentacao;
        $profissional->paisProfissional = $request->pais;
        $profissional->cidadeProfissional = $request->cidade;
        $profissional->ufProfissional = $request->uf;
        $profissional->cepProfissional = $request->cep;
        // Atualiza a foto somente se o usuário enviar uma nova
        if ($request->hasFile('fotoPerfil')) {
            $foto = $request->file('fotoPerfil')->store('fotos/perfil', 'public');

            $profissional->fotoPerfilProfissional = $foto;
        }

        $profissional->save();

        return redirect('user.perfil-profissional')
            ->with('sucesso', 'Perfil atualizado com sucesso!');
        
    }


    public function mudarSenha()
    {
        return view('user.mudar-senha');
    }

    public function atualizarSenha(Request $request)
    {
        $request->validate([
            'senhaAtual' => 'required|min:8',
            'novaSenha' => 'required|min:8',
            'confirmarSenha' => 'required|same:novaSenha|min:8',
        ],[
            'senhaAtual.required'=> 'Campo senha atual obrigatório.',
            'senhaAtual.min' => 'A senha atual deve ter no mínimo 8 caracteres.',

            'novaSenha.required'=> 'Campo nova senha obrigatório.',
            'novaSenha.min' => 'A nova senha deve ter no mínimo 8 caracteres.',

            'confirmarSenha.required'=> 'Campo confirmar senha obrigatório.',
            'confirmarSenha.same'=> 'Os campos nova senha e confirmar senha devem ser iguais.',
            'confirmarSenha.min' => 'A nova senha deve ter no mínimo 8 caracteres.',
        ]);

        $profissional = User::find(session('id'));

        if (!Hash::check($request->senhaAtual, $profissional->senhaProfissionalSaude)) {
            return back()->withErrors([
                'senhaAtual' => 'A senha atual está incorreta.'
            ]);
        }

        $profissional->senhaProfissionalSaude = Hash::make($request->novaSenha);
        $profissional->save();

        return redirect('user.perfil-profissional')->with('sucesso', 'Senha alterada com sucesso!');
    }

    public function desativarConta()
    {
        $profissional = User::find(session('id'));

        $profissional->statusConta = 'Excluída';
        $profissional->save();

        session()->forget('id');

        return redirect('/')->with('sucesso', 'Sua conta foi desativada.');
    }

    public function dashboard(){
        $profissional = User::find(session('id'));

        return view('painelProfissional.dashboard', compact('profissional'));
    }

    //APIs
    public function indexApi()
    {
        $user = User::orderby('created_at', 'desc')->get();
        return response()->json($user);
    }

    public function storeApi(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:tbProfissional,emailProfissional|max:255',
            'cpf' => 'required|string|max:14|unique:tbProfissional,cpfProfissional',
            'telefone' => 'required|string|max:15',
            'dataNasc' => 'required|date',
            'senha' => 'required|string|min:8',
            'categoria' => 'required|string|max:17',
            'especialidade' => 'required|string|max:255',
            'conselho' => 'required|string|max:5',
            'numConselho' => 'required|string|max:9',
            'ufConselho' => 'required|string|max:2',
            'comprovanteConselho' => 'required|string|max:255',
            'docComplementar' => 'required|string|max:255',
            'apresentacao' => 'nullable|string|max:400',
            'fotoPerfil' => 'nullable|string|max:255',
            'atendeChat' => 'required|boolean',
            'atendeDuvidaRapido' => 'required|boolean',
            'atendePresencial' => 'required|boolean',
        ]);

        $user = User::create([
            'nomeProfissional' => $request->nome,
            'emailProfissional' => $request->email,
            'cpfProfissional' => $request->cpf,
            'telefoneProfissional' => $request->telefone,
            'dataNascProfissional' => $request->dataNasc,
            'senhaProfissional' => Hash::make($request->senha),
            'categoriaProfissional' => $request->categoria,
            'especialidadeProfissional' => $request->especialidade,
            'conselhoClasseProfissional' => $request->conselho,
            'numConselhoProfissional' => $request->numConselho,
            'ufConselhoProfissional' => $request->ufConselho,
            'comprovanteConselhoProfissional' => $request->comprovanteConselho,
            'docComplementarProfissional' => $request->docComplementar,
            'apresentacaoProfissional' => $request->apresentacao,
            'fotoPerfilProfissional' => $request->fotoPerfil,
            'atendeChatProfissional' => $request->atendeChat,
            'atendeDuvidaRapidoProfissional' => $request->atendeDuvidaRapido,
            'atendePresencialProfissional' => $request->atendePresencial,
            'statusVerificacaoProfissional' => $request->statusVerificacao,
            'statusContaProfissional' => $request->statusConta,
        ]);

        return response()->json($user);
    }

    public function updateApi(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        return response()->json([
            'message' => 'Usuário alterado com sucesso',
            'user' => $user
        ]);
    }

    public function destroyApi(string $id)
    {
        User::where('id', $id)->delete();

        return response()->json([
            'message' => 'Usuário excluído com sucesso',
            'code'    => 200
        ]);
    }

    public function countUserApi()
    {
        return response()->json([
            'count' => User::count(),
            'code'  => 200
        ]);
    }
}
