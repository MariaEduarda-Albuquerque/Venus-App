<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DenunciaController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth:admin');

Route::get('/perfil-adm', [AdmController::class, 'perfil'])
    ->name('perfil-config.perfil-adm')
    ->middleware('auth:admin');

    //  Route::get('/editar-perfil', [AdmController::class, 'editar'])
    //  ->name('perfil-config.editar-perfil')
    //  ->middleware('auth:admin');

//     Route::get('/editar-perfil', function () {
//     return view('perfil-config.editar-perfil');
// })->name('login')->middleware('auth:admin');

Route::get('/perfil/editar', [AdmController::class, 'editar'])->middleware('auth:admin');
Route::post('/perfil/atualizar', [AdmController::class, 'atualizar'])->middleware('auth:admin');

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
    return view('adim.ConteudoAprender-Screen');
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

Route::get('/suporte', [DenunciaController::class, 'index'])
    ->name('admin.suporte')
    ->middleware('auth:admin');

Route::get('/denuncias-mensagens', [DenunciaController::class, 'DenunciasMensagens'])
->name('admin.denuncias-mensagens')
->middleware('auth:admin');

Route::get('/denuncias', [DenunciaController::class, 'index2'])
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