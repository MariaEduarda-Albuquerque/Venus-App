<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\DashboardController;


// Login:

Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AdmController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdmController::class, 'login'])->name('login.autenticar');

    Route::view('/esqueci-senha', 'login.esqueci-senha')->name('senha.esqueci');
    Route::view('/nova-senha', 'login.nova-senha')->name('senha.nova');
});



Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdmController::class, 'logout'])->name('logout');

//Dashboard:

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


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


//Usuario:

Route::get('/denuncias', function () {
    return view('usuario.lista-denuncias ');
});

Route::get('/usuarios', function () {
    return view('usuario.lista-usuarios ');
});

Route::get('/aprovar-cadastros', function () {
    return view('usuario.aprovar-cadastros ');
});

Route::get('/aprovar-cadastro', function () {
    return view('usuario.aprovar-cadastro ');
});

Route::get('/denuncias-mensagens', function () {
    return view('usuario.denuncias-mensagens ');
});



// Conteudos:

Route::get('/conteudos-aprender', function () {
    return view('conteudos.lista-conteudo-aprender ');
});

Route::get('/destaques-principais', function () {
    return view('conteudos.destaques');
});

Route::get('/criar-destaque', function () {
    return view('conteudos.criar-destaque');
});


//OUtros:

Route::get('/feedbacks', function () {
    return view('outros.feedbacks');
});

Route::get('/suporte', function () {
    return view('outros.suporte');
});

Route::get('/conversas', function () {
    return view('outros.conversas');
});




// Painel:
Route::get('/relatorio', function () {
    return view('painel.relatorio');
});

Route::get('/grc', function () {
    return view('painel.grc');
});

Route::get('/logistica', function () {
    return view('painel.logistica');
});



//Histórico
Route::get('/atividades-recentes', function () {
    return view('historico.atividades-recentes');
});

Route::get('/acessos', function () {
    return view('historico.acessos');
});



//Relatórios:
Route::get('/relatorios/usuarias', function () {
    return view('relatorios.usuarias');
});

Route::get('/relatorios/atendimento', function () {
    return view('relatorios.atendimento');
});

Route::get('/relatorios/denuncias', function () {
    return view('relatorios.denuncias');
});

});



