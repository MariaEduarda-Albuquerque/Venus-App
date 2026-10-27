<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\destaqueController;


// Login
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AdmController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdmController::class, 'login'])->name('login.autenticar');

    Route::view('/esqueci-senha', 'login.esqueci-senha')->name('senha.esqueci');
    Route::view('/nova-senha', 'login.nova-senha')->name('senha.nova');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdmController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil/Configuração
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::view('/editar/perfil', 'perfil-config.editar-perfil' )->name('perfil.editar');
    Route::view('/configuracoes', 'perfil-config.configuracoes')->name('configuracoes');

    // Usuários
    Route::view('/denuncias', 'usuario.lista-denuncias')->name('denuncias');
    Route::get('/aprovar-cadastros', [CadastroController::class, 'index'])->name('cadastros.aprovar');
    Route::get('/aprovar-cadastros/{profissional}', [CadastroController::class, 'show'])->name('cadastro.aprovar');
    Route::post('/aprovar-cadastros/{profissional}/decisao', [CadastroController::class, 'decidir'])->name('cadastro.decidir');
    Route::get('/aprovar-cadastros/{profissional}/documento/{tipo}', [CadastroController::class, 'documento'])->name('cadastro.documento');
    Route::view('/denuncias-mensagens', 'usuario.denuncias-mensagens')->name('denuncias.mensagens');
    Route::view('/usuarios', 'usuario.lista-usuarios')->name('denuncias.mensagens');

    // Profissionais
    Route::prefix('profissionais')->name('profissional.')->group(function () {
        Route::get('/', [ProfissionalController::class, 'index'])->name('index');
        Route::get('/{profissional}', [ProfissionalController::class, 'show'])->name('show');
        Route::patch('/{profissional}/status', [ProfissionalController::class, 'atualizarStatus'])->name('status');
        Route::patch('/{profissional}/verificacao', [ProfissionalController::class, 'atualizarVerificacao'])->name('verificacao');
        Route::delete('/{profissional}', [ProfissionalController::class, 'excluir'])->name('excluir');
        Route::get('/{profissional}/arquivo/{tipo}', [ProfissionalController::class, 'arquivo'])->name('arquivo');
    });

    // Conteúdos
    Route::view('/conteudos-aprender', 'conteudos.lista-conteudo-aprender')->name('conteudos.aprender');
    Route::get('/destaques-principais', [destaqueController::class, 'index'])->name('destaques');
Route::view('/criar-destaque', 'conteudos.criar-destaque')->name('destaques.criar');
Route::post('/criar-destaque', [destaqueController::class, 'store'])->name('destaques.store');


    // Outros
    Route::view('/feedbacks', 'outros.feedbacks')->name('feedbacks');
    Route::view('/suporte', 'outros.suporte')->name('suporte');
    Route::view('/conversas', 'outros.conversas')->name('conversas');

    // Painel
    Route::view('/relatorio', 'painel.relatorio')->name('painel.relatorio');
    Route::view('/grc', 'painel.grc')->name('painel.grc');
    Route::view('/logistica', 'painel.logistica')->name('painel.logistica');

    // Histórico
    Route::view('/atividades-recentes', 'historico.atividades-recentes')->name('historico.atividades');
    Route::view('/acessos', 'historico.acessos')->name('historico.acessos');
    Route::view('/criar-conteudo', 'historico.criar-conteudo')->name('conteudo.criar');
    Route::view('/meus-conteudos', 'historico.meus-conteudos')->name('meus.conteudos');

    // Relatórios
    Route::prefix('relatorios')->name('relatorios.')->group(function () {
        Route::get('/usuarias', [RelatorioController::class, 'Usuarias'])->name('usuarias');
        Route::get('/atendimento', [RelatorioController::class, 'Atendimento'])->name('atendimento');
        Route::get('/denuncias', [RelatorioController::class, 'Denuncias'])->name('denuncias');
        Route::get('/profissional', [RelatorioController::class, 'Profissional'])->name('relatorio-profissional');

    });
});
