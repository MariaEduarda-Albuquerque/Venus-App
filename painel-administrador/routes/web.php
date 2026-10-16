<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\CadastroController;
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
    Route::view('/perfil', 'perfil-config.perfil-adm')->name('perfil');
    Route::view('/editar/perfil', 'perfil-config.editar-perfil')->name('perfil.editar');
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
        Route::patch('/{profissional}/status', [ProfissionalController::class, 'atualizarStatus'])->name('status');
        Route::patch('/{profissional}/verificacao', [ProfissionalController::class, 'atualizarVerificacao'])->name('verificacao');
        Route::delete('/{profissional}', [ProfissionalController::class, 'excluir'])->name('excluir');
    });

    // Conteúdos
    Route::view('/conteudos-aprender', 'conteudos.lista-conteudo-aprender')->name('conteudos.aprender');
    Route::view('/destaques-principais', 'conteudos.destaques')->name('destaques');
    Route::view('/criar-destaque', 'conteudos.criar-destaque')->name('destaques.criar');

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

    // Relatórios
    Route::prefix('relatorios')->name('relatorios.')->group(function () {
        Route::view('/usuarias', 'relatorios.usuarias')->name('usuarias');
        Route::view('/atendimento', 'relatorios.atendimento')->name('atendimento');
        Route::view('/denuncias', 'relatorios.denuncias')->name('denuncias');
    });
});
