<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Painel Administrativo - Vênus')</title>

    <link rel="stylesheet" href="{{ asset('css/adm.css') }}">
    @stack('styles')
    @include('Components.Toggle')
</head>

<body>

    <aside class="sidebar" id="sidebar">

        <h1>Vênus</h1>

        <ul class="menu-item ativo">
            <img src="{{ asset('images/dashboard.png') }}" alt="">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    Painel
                </a>
            </li>
        </ul>

        <ul class="menu-item">
            <img src="{{ asset('images/user.png') }}" alt="">
            <li>
                <a href="{{ route('admin.usuarios') }}">
                    Usuários
                </a>
            </li>
        </ul>

        <ul class="menu-item">
            <img src="{{ asset('images/history.png') }}" alt="">
            <li>Histórico</li>
        </ul>

        <ul class="menu-item">
            <img src="{{ asset('images/file-detail.png') }}" alt="">
            <li>Conteúdos</li>
        </ul>

        <ul class="menu-item">
            <img src="{{ asset('images/file-report.png') }}" alt="">
            <li>Relatórios</li>
        </ul>

        <ul class="menu-item">
            <img src="{{ asset('images/message-circle-detail.png') }}" alt="">
            <li>Conversas</li>
        </ul>

        <ul class="menu-item">
            <img src="{{ asset('images/headphone-mic.png') }}" alt="">
            <li><a href="{{ route('admin.denuncias') }}">Suporte</a></li>
        </ul>
        
        <form action="/fazerLogOut" method="POST">
            @csrf
            <ul class="menu-item">
                <li><button class="btn-logout" type="submit">Logout</button></li>
            </ul>
        </form>

    </aside>


    <div class="direita">

        <header class="top-header">

            <div class="menu-btn" id="menuBtn">
                <span>☰</span>
            </div>

            <form action="" method="GET" class="search-box">
                <button type="submit" class="btn-lupa">
                    <img src="{{ asset('images/lupa.png') }}" alt="Pesquisar">
                </button>
                <input
                    type="text"
                    id="pesquisar"
                    name="pesquisar"
                    placeholder="Pesquisar..."
                >
            </form>

            <div class="top-actions">
                <a href="#" class="icon-btn" title="Notificações">
                    <img src="{{ asset('images/notification.png') }}" alt="Notificações">
                </a>

                <a href="#" class="icon-btn" title="Perfil">
                    <img src="{{ asset('images/perfil.png') }}" alt="Perfil">
                </a>
            </div>

        </header>

        <main class="conteudo">
            @yield('content')
        </main>

    </div>

</body>

</html>