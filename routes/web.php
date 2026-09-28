<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotPasswordController;


//Públicas
Route::get('/', [UserController::class, 'index'])->name('auth.index');
Route::post('user.cadastro', [UserController::class, 'store'])->name('cadastro.store');
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
    
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('painel.dashboard');

Route::get('user.perfil-profissional', [UserController::class, 'perfil']);

Route::get('user.update-profissional', [UserController::class, 'editar'])->name('perfil.editar');
Route::put('user.update-profissional', [UserController::class, 'atualizar'])->name('perfil.atualizar');


Route::get('user.mudar-senha', [UserController::class, 'mudarSenha']);
Route::put('user.mudar-senha', [UserController::class, 'atualizarSenha'])->name('senha.atualizar');

Route::put('/desativar-conta', [UserController::class, 'desativarConta'])->name('conta.desativar');
});