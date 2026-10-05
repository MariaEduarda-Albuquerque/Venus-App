<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DenunciaController;


//Dashboard:

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');



// Login:

Route::get('/login', function () {
    return view('login.login');
})->name('login');

Route::get('/esqueciSenha', function () {
    return view('login.esqueci-senha');
});

Route::get('/novaSenha', function () {
    return view('login.nova-senha');
});



//Perfil/Contiguração:

Route::get('/perfil', function () {
    return view('perfil-config.perfil-adm');
});

Route::get('/editar/perfil', function () {
    return view('perfil-config.editar-perfil');
});

Route::get('/configuracoes', function () {
    return view('perfil-config.configuracoes');
});


//Listas:

Route::get('/denuncias', function () {
    return view('listas.lista-denuncias ');
});

Route::get('/usuarios', function () {
    return view('listas.lista-usuarios ');
});

Route::get('/usuarios', function () {
    return view('listas.lista-usuarios ');
});

Route::get('/conteudos-aprender', function () {
    return view('listas.lista-conteudo-aprender ');
});

Route::get('/feedbacks', function () {
    return view('listas.feedbacks');
});


//Denuncias Telas:

Route::get('/denuncias-mensagens', function () {
    return view('denuncias.denuncias-mensagens ');
});

Route::get('/suporte', function () {
    return view('denuncias.suporte');
});


//Destaques:

Route::get('/destaques-principais', function () {
    return view('destaque-sazonal.destaques');
});

Route::get('/criar-destaque', function () {
    return view('destaque-sazonal.criar-destaque');
});

Route::get('/criar-destaque-pt2', function () {
    return view('destaque-sazonal.criar-destaque-2');
});

Route::get('/criar-destaque-pt3', function () {
    return view('destaque-sazonal.criar-destaque-3');
});

Route::get('/criar-destaque-pt4', function () {
    return view('destaque-sazonal.criar-destaque-4');
});