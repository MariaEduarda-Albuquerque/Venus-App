<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth:admin');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/esqueciSenha', function () {
    return view('esqueci-senha');
});

Route::get('/novaSenha', function () {
    return view('nova-senha');
});

Route::get('/Conteudo-Aprender', function () {
    return view('adm.ConteudoAprender-Screen');
 })->middleware('auth:admin');

Route::middleware(['web'])->group(function () {
    Route::post('/fazerLogin', [AdmController::class, 'fazerLogin']);
    Route::post('/fazerLogOut', [AdmController::class, 'fazerLogOut']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth:admin');

// Route::get('/dashboard', [UsuarioController::class, 'dashboard'])
//     ->name('dashboard')
//     ->middleware('auth:admin');

Route::get('/dashboard', [AdmController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('auth:admin');

Route::get('/admin/usuarios', [UsuarioController::class, 'index'])
    ->name('admin.usuarios')
    ->middleware('auth:admin');

Route::get('/denuncias', [DenunciaController::class, 'index'])
    ->name('admin.denuncias')
    ->middleware('auth:admin');


Route::get('/admin/usuarios', [UsuarioController::class, 'index'])
    ->name('admin.usuarios')
    ->middleware('auth:admin');

    Route::get('/Conteudo-Aprender', [ConteudoController::class, 'index'])
    ->name('adm.ConteudoAprender-Screen')
    ->middleware('auth:admin');

   Route::get('/grafico', function () {
    return view('grafico');
});