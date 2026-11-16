<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroProfissionalRequest;
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

    public function verificarDuplicidade(Request $request)
    {
        $valor = trim((string) $request->query('valor'));
        $digitos = preg_replace('/\D/', '', $valor);
        $existe = false;

        switch ($request->query('campo')) {
            case 'email':
                $existe = $valor !== '' && User::where('emailProfissionalSaude', $valor)->exists();
                break;
            case 'telefone':
                $existe = $digitos !== '' && User::where('telProfissionalSaude', $digitos)->exists();
                break;
            case 'nrFiscal':
                $existe = $digitos !== '' && User::whereRaw(
                    "REPLACE(REPLACE(REPLACE(nrFiscalProfissional, '.', ''), '-', ''), '/', '') = ?",
                    [$digitos]
                )->exists();
                break;
        }

        return response()->json(['existe' => $existe]);
    }

    public function store(CadastroProfissionalRequest $request)
    {

        $caminhoFoto = null;
        if ($request->hasFile('fotoPerfil')) {
            $caminhoFoto = $request->file('fotoPerfil')
                ->store('fotos-profissionais', 'public');
        }

        $request->validate([
            'nome' => 'required|string|max:120',
            'email' => 'required|email|unique:tbprofissionalsaude,emailProfissionalSaude|max:150',
            'telefone' => 'nullable|string|max:14|unique:tbprofissionalsaude,telProfissionalSaude',
            'senha' => ['required', 'string', 'min:8', 'max:255', 'confirmed', 'regex:/\p{Ll}/u', 'regex:/\p{Lu}/u', 'regex:/\p{N}/u', 'regex:/[\p{Z}\p{S}\p{P}]/u'],
            'categoria' => 'required|string',
            'especialidade' => 'nullable|string|max:25',
            'apresentacao' => 'nullable|string|max:400',
            'pais' => 'nullable|string|max:60',
            'cidade' => 'nullable|string|max:100',
            'uf' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:10',
            'rua' => 'nullable|string|max:150',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'nrFiscal' => 'nullable|string|max:20|min:11|unique:tbprofissionalsaude,nrFiscalProfissional',
            'fotoPerfil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'comprovanteConselho' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'docComplementar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
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
            'senha.confirmed' => 'A confirmação de senha não confere.',
            'senha.regex' => 'A senha deve ter letra maiúscula, minúscula, número e caractere especial.',

            'categoria.required' => 'Campo categoria obrigatório.',
            'especialidade.max' => 'A especialidade deve ter no máximo 25 caracteres.',
            'apresentacao.max' => 'A apresentação deve ter no máximo 400 caracteres.',

            'pais.max' => 'O país deve ter no máximo 60 caracteres',
            'cidade.max' => 'A cidade deve ter no máximo 100 caracteres',
            'uf.max' => 'O UF deve ter no máximo 2 caracteres',
            'cep.max' => 'O CEP deve ter no máximo 10 caracteres',
            'rua.max' => 'A rua deve ter no máximo 150 caracteres',
            'numero.max' => 'O número deve ter no máximo 10 caracteres',
            'complemento.max' => 'O complemento deve ter no máximo 100 caracteres',

            'nrFiscal.max' => 'O CPF  ou CPNJ devem ter no máximo 20 caracteres',
            'nrFiscal.min' => 'O CPF  ou CPNJ devem ter no mínimo 11 caracteres',
            'nrFiscal.unique' => 'Esse CPF ou CNPJ já foi cadastrado',

            'fotoPerfil.mimes' => 'O arquivo deve ser jpg, jpeg, png ou webp',
            'fotoPerfil.max' => 'O arquivo deve ter no máximo 2 MB',

            'comprovanteConselho.mimes' => 'O arquivo deve ser pdf, jpg, jpeg, png',
            'docComplementar.max' => 'O arquivo deve ter no máximo 2 MB',
            
            'documentoComplementar.mimes' => 'O arquivo deve ser pdf, jpg, jpeg, png',
            'documentoComplementar.max' => 'O arquivo deve ter no máximo 2 MB',

        ]);

        $documento = preg_replace('/\D/', '', $request->nrFiscal);

        if (!$this->validarCpfCnpj($documento)) {
            return back()
                ->withErrors([
                    'nrFiscal' => 'CPF ou CNPJ inválido.'
                ])
                ->withInput();
        }

        $caminhoFoto = null;
        if ($request->hasFile('fotoPerfil')) {
            $caminhoFoto = $request->file('fotoPerfil')
                ->store('fotos-profissionais', 'public');
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
            'ruaProfissional'=>$request->rua,
            'numeroProfissional' => $request->numero,
            'complementoProfissional' => $request->complemento,
            'nrFiscalProfissional'=>$request->nrFiscal,
            'fotoPerfilProfissional' => $caminhoFoto,
            'statusVerificacao' => 'Em análise',
            'statusConta' => 'Ativa',
            'comprovanteConselhoClasseProfissional' => $request->comprovanteConselho,
            'documentoComplementarProfissional' => $request->docComplementar,
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
        }elseif ($user && $user->statusVerificacao == 'Em análise') {
            return redirect('/')->with('erro', 'Esta conta está em análise.');
        }elseif ($user && $user->statusVerificacao == 'Pendência') {
            return redirect('/')->with('erro', 'Esta conta está pendente.');
        } elseif ($user && $user->statusConta == 'Suspensa') {
            return redirect('/')->with('erro', 'Esta conta está suspensa.');
        } elseif (!Hash::check($request->senha, $user->senhaProfissionalSaude)) {
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
            'rua' => 'nullable|string|max:150',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'fotoPerfil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'comprovanteConselho' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'docComplementar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
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
            'rua.max' => 'A rua deve ter no máximo 150 caracteres',
            'numero.max' => 'O número deve ter no máximo 10 caracteres',
            'complemento.max' => 'O complemento deve ter no máximo 100 caracteres',

            'fotoPerfil.mimes' => 'O arquivo deve ser jpg, jpeg, png ou webp',
            'fotoPerfil.max' => 'O arquivo deve ter no máximo 2 MB',

            'comprovanteConselho.mimes' => 'O arquivo deve ser pdf, jpg, jpeg, png',
            'comprovanteConselho.max' => 'O arquivo deve ter no máximo 2 MB',
            
            'docComplementar.mimes' => 'O arquivo deve ser pdf, jpg, jpeg, png',
            'docComplementar.max' => 'O arquivo deve ter no máximo 2 MB',
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
        $profissional->ruaProfissional = $request->rua;
        $profissional->numeroProfissional = $request->numero;
        $profissional->complementoProfissional = $request->complemento;
        $profissional->comprovanteConselhoClasseProfissional = $request->comprovanteConselho;
        $profissional->documentoComplementarProfissional = $request->docComplementar;
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
            'novaSenha' => ['required', 'string', 'min:8', 'max:255', 'regex:/\p{Ll}/u', 'regex:/\p{Lu}/u', 'regex:/\p{N}/u', 'regex:/[\p{Z}\p{S}\p{P}]/u'],
            'confirmarSenha' => 'required|same:novaSenha',
        ], [
            'senhaAtual.required' => 'Campo senha atual obrigatório.',
            'senhaAtual.min' => 'A senha atual deve ter no mínimo 8 caracteres.',

            'novaSenha.required' => 'Campo nova senha obrigatório.',
            'novaSenha.min' => 'A nova senha deve ter no mínimo 8 caracteres.',
            'novaSenha.max' => 'A nova senha deve ter no máximo 255 caracteres.',
            'novaSenha.regex' => 'A nova senha deve ter letra maiúscula, minúscula, número e caractere especial.',

            'confirmarSenha.required' => 'Campo confirmar senha obrigatório.',
            'confirmarSenha.same' => 'Os campos nova senha e confirmar senha devem ser iguais.',
        ]);

        $profissional = User::find(session('id'));

        if (!Hash::check($request->senhaAtual, $profissional->senhaProfissionalSaude)) {
            return back()->withErrors([
                'senhaAtual' => 'A senha atual está incorreta.'
            ]);
        }

        if (Hash::check($request->novaSenha, $profissional->senhaProfissionalSaude)) {
            return back()->withErrors([
                'novaSenha' => 'A nova senha não pode ser igual à senha atual.'
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

    public function dashboard()
    {
        $profissional = User::find(session('id'));

        // Dados reais do banco
        $hoje = now()->startOfDay();
        $inicioSemana = now()->startOfWeek();
        $fimSemana = now()->endOfWeek();

        // Consultas hoje
        $consultasHoje = \App\Models\Consulta::where('codProfissionalSaude', $profissional->codProfissionalSaude)
            ->whereDate('dataHoraAgendada', $hoje)
            ->count();

        // Mensagens não lidas
        $mensagensPendentes = \App\Models\Mensagem::where('codProfissionalSaude', $profissional->codProfissionalSaude)
            ->where('lidaMensagem', false)
            ->count();

        // Avaliação média
        $avaliacaoMedia = \App\Models\AvaliacaoConsulta::join('tbconsulta', 'tbavaliacaoconsulta.codConsulta', '=', 'tbconsulta.codConsulta')
            ->where('tbconsulta.codProfissionalSaude', $profissional->codProfissionalSaude)
            ->avg('tbavaliacaoconsulta.nota');

        // Usuárias atendidas (consultas encerradas únicas)
        $usuariasAtendidas = \App\Models\Consulta::where('codProfissionalSaude', $profissional->codProfissionalSaude)
            ->where('statusConsulta', 'encerrada')
            ->distinct('codUsuario')
            ->count('codUsuario');

        // Próximos atendimentos (próximos 7 dias)
        $proximosAtendimentos = \App\Models\Consulta::where('codProfissionalSaude', $profissional->codProfissionalSaude)
            ->where('statusConsulta', '!=', 'encerrada')
            ->where('dataHoraAgendada', '>=', now())
            ->where('dataHoraAgendada', '<=', now()->addDays(7))
            ->orderBy('dataHoraAgendada')
            ->limit(5)
            ->get();

        // Fila de dúvidas rápidas (consultas tipo duvida_rapida pendentes)
        $filaDuvidas = \App\Models\Consulta::where('codProfissionalSaude', $profissional->codProfissionalSaude)
            ->where('tipoConsulta', 'duvida_rapida')
            ->whereIn('statusConsulta', ['agendada', 'pendente'])
            ->orderBy('dataHoraAgendada')
            ->limit(10)
            ->get();

        // Dados para gráficos (últimos 20 dias)
        $dias = 20;
        $atendimentosPorDia = [];
        for ($i = $dias - 1; $i >= 0; $i--) {
            $data = now()->subDays($i)->startOfDay();
            $count = \App\Models\Consulta::where('codProfissionalSaude', $profissional->codProfissionalSaude)
                ->whereDate('dataHoraAgendada', $data)
                ->count();
            $atendimentosPorDia[] = [
                'data' => $data->format('d/m'),
                'total' => $count,
            ];
        }

        // Assuntos mais procurados (baseado no histórico das consultas)
        $assuntos = \App\Models\Consulta::where('codProfissionalSaude', $profissional->codProfissionalSaude)
            ->selectRaw('historicoConsulta as assunto, count(*) as total')
            ->whereNotNull('historicoConsulta')
            ->groupBy('historicoConsulta')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Avaliações recentes (últimas 5)
        $avaliacoesRecentes = \App\Models\AvaliacaoConsulta::join('tbconsulta', 'tbavaliacaoconsulta.codConsulta', '=', 'tbconsulta.codConsulta')
            ->where('tbconsulta.codProfissionalSaude', $profissional->codProfissionalSaude)
            ->orderByDesc('tbavaliacaoconsulta.dataAvaliacao')
            ->limit(5)
            ->select('tbavaliacaoconsulta.nota', 'tbavaliacaoconsulta.comentario', 'tbavaliacaoconsulta.dataAvaliacao')
            ->get();

        // Semana comparada (para chartSemana)
        $tipos = ['agendada', 'duvida_rapida', 'encerrada', 'cancelada', 'aguardando'];
        $semanaPassada = [];
        $estaSemana = [];
        foreach ($tipos as $tipo) {
            $semanaPassada[] = \App\Models\Consulta::where('codProfissionalSaude', $profissional->codProfissionalSaude)
                ->where('tipoConsulta', $tipo)
                ->whereBetween('dataHoraAgendada', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
                ->count();
            $estaSemana[] = \App\Models\Consulta::where('codProfissionalSaude', $profissional->codProfissionalSaude)
                ->where('tipoConsulta', $tipo)
                ->whereBetween('dataHoraAgendada', [now()->startOfWeek(), now()->endOfWeek()])
                ->count();
        }
        $semanaComparada = compact('semanaPassada', 'estaSemana');

        // Evolução semanal (últimos 7 dias)
        $evolucaoSemanal = [];
        for ($i = 6; $i >= 0; $i--) {
            $data = now()->subDays($i)->startOfDay();
            $evolucaoSemanal[] = \App\Models\Consulta::where('codProfissionalSaude', $profissional->codProfissionalSaude)
                ->where('statusConsulta', 'encerrada')
                ->whereDate('dataHoraAgendada', $data)
                ->distinct('codUsuario')
                ->count('codUsuario');
        }

        return view('painelProfissional.dashboard', compact(
            'profissional',
            'consultasHoje',
            'mensagensPendentes',
            'avaliacaoMedia',
            'usuariasAtendidas',
            'proximosAtendimentos',
            'filaDuvidas',
            'atendimentosPorDia',
            'assuntos',
            'avaliacoesRecentes',
            'semanaComparada',
            'evolucaoSemanal'
        ));
    }

    public function caixaEntrada(){
        $profissional = User::find(session('id'));

        return view('painelProfissional.caixa-entrada', compact('profissional'));
    }

    public function conteudo(){
        $profissional = User::find(session('id'));

        return view('painelProfissional.conteudo', compact('profissional'));
    }

    public function suporte(){
        $profissional = User::find(session('id'));

        return view('painelProfissional.suporte', compact('profissional'));
    }

    public function configuracoes(){
        $profissional = User::find(session('id'));

        return view('painelProfissional.configuracoes', compact('profissional'));
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