<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PublicacaoController;


//Públicas
Route::get('/', [UserController::class, 'index'])->name('auth.index');
Route::post('user.cadastro', [UserController::class, 'store'])->name('cadastro.store');
Route::get('user.cadastro/verificar', [UserController::class, 'verificarDuplicidade'])->name('cadastro.verificar');
Route::post('/login', [UserController::class, 'login'])->name('auth.login');
Route::post('/logout', [UserController::class, 'logout'])->name('auth.logout');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('user.cadastro', function () {
    return view('user.cadastro');
});

Route::get('emails.esqueci-senha', [ForgotPasswordController::class, 'index']);
Route::post('emails.esqueci-senha', [ForgotPasswordController::class, 'enviar']);
Route::get('emails.redefinir-senha/{chave}', [ForgotPasswordController::class, 'redefinir']);
Route::post('emails.redefinir-senha/{chave}', [ForgotPasswordController::class, 'atualizarSenha']);


//privadas
Route::middleware('autenticacao')->group(function () {

Route::get('/configuracoes', [UserController::class, 'configuracoes'])->name('painel.configuracoes');

Route::get('/caixa-de-entrada', [UserController::class, 'caixaEntrada'])->name('caixa-de-entrada');
Route::get('/caixa-de-entrada/conversas', [MensagemController::class, 'conversas']);
Route::get('/caixa-de-entrada/buscar', [MensagemController::class, 'buscar']);
Route::get('/caixa-de-entrada/mensagens/{id}', [MensagemController::class, 'mensagens']);
Route::post('/caixa-de-entrada/enviar', [MensagemController::class, 'enviar']);

Route::get('/conteudo', [ConteudoController::class, 'index'])->name('conteudos.index');
Route::post('/conteudo', [ConteudoController::class, 'store'])->name('conteudos.store');
Route::put('/conteudo/{id}', [ConteudoController::class, 'update'])->name('conteudos.update');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::put('/feedback/{id}/reenviar', [FeedbackController::class, 'reenviar'])->name('feedback.reenviar');

Route::get('/publicacoes', [PublicacaoController::class, 'index'])->name('publicacoes.index');
Route::get('/publicacoes/{id}', [PublicacaoController::class, 'show'])->name('publicacoes.show');
Route::get('/publicacoes/{id}/editar', [PublicacaoController::class, 'editar'])->name('publicacoes.editar');
Route::put('/publicacoes/{id}', [PublicacaoController::class, 'atualizar'])->name('publicacoes.atualizar');
Route::post('/publicacoes/{id}/duplicar', [PublicacaoController::class, 'duplicar'])->name('publicacoes.duplicar');
Route::post('/publicacoes/{id}/arquivar', [PublicacaoController::class, 'arquivar'])->name('publicacoes.arquivar');
Route::post('/publicacoes/{id}/desarquivar', [PublicacaoController::class, 'desarquivar'])->name('publicacoes.desarquivar');
Route::delete('/publicacoes/{id}', [PublicacaoController::class, 'excluir'])->name('publicacoes.excluir');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes.index');

Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
Route::get('/relatorios/exportar', [RelatorioController::class, 'exportar'])->name('relatorios.exportar');
Route::get('/relatorios/planilha', [RelatorioController::class, 'planilha'])->name('relatorios.planilha');

Route::get('/suporte', [UserController::class, 'suporte'])->name('painel.suporte');
    
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('painel.dashboard');

Route::get('user.perfil-profissional', [UserController::class, 'perfil']);

Route::get('user.update-profissional', [UserController::class, 'editar'])->name('perfil.editar');
Route::put('user.update-profissional', [UserController::class, 'atualizar'])->name('perfil.atualizar');


Route::get('user.mudar-senha', [UserController::class, 'mudarSenha']);
Route::put('user.mudar-senha', [UserController::class, 'atualizarSenha'])->name('senha.atualizar');

Route::put('/desativar-conta', [UserController::class, 'desativarConta'])->name('conta.desativar');

});
