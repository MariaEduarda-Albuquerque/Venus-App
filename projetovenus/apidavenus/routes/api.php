<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RedefinicaoSenhaController;

Route::post('/cadastro', [UsuarioController::class, 'storeApi']);
Route::post('/login', [UsuarioController::class, 'loginApi']);
Route::post('/redefinir-senha', [RedefinicaoSenhaController::class, 'solicitarApi'])->middleware('throttle:5,1');
Route::post('/redefinir-senha/verificar', [RedefinicaoSenhaController::class, 'verificarApi'])->middleware('throttle:10,1');
Route::post('/redefinir-senha/confirmar', [RedefinicaoSenhaController::class, 'confirmarApi'])->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UsuarioController::class, 'logoutApi']);
    Route::get('/usuario/{id}', [UsuarioController::class, 'showUserApi']);
    Route::put('/usuario/{id}', [UsuarioController::class, 'updateUserApi']);
    Route::put('/usuario/{id}/dados-pessoais', [UsuarioController::class, 'updateDadosPessoaisApi']);
    Route::put('/usuario/{id}/senha', [UsuarioController::class, 'updateSenhaApi']);
    Route::post('/usuario/{id}/foto', [UsuarioController::class, 'uploadFoto']);
    Route::delete('/usuario/{id}', [UsuarioController::class, 'destroyUserApi']);
});
