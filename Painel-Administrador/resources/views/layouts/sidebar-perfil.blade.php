<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel Administrativo - Vênus')</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
     @stack('styles')
</head>
<body>
<aside class="sidebar compacta" id="sidebar">

    <h1 class="tituloAberto">Vênus</h1>
    <h1 class="tituloFechado">V.</h1>

    <!-- 1. Painel -->
    <ul>
        <li class="itemsSidebar">
            <div class="topoItem">
                <div>
                    <img src="{{ asset('images/dashboard.png') }}" alt="">
                    <a href="{{ route('admin.dashboard') }}"><span>Painel</span></a>
                </div>
                <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
            </div>
            <ul class="submenu">
                <li>Relatório</li>
                <li>GRC</li>
                <li>Logística</li>
            </ul>
        </li>
        <div>
            <a href="/dashboard">
                <img class="iconeOpcoes" src="{{ asset('images/dashboard.png') }}" alt="">
            </a> 
        </div>

    </ul>

    <!-- 2. Usuários (CORRIGIDO: user.png no iconeOpcoes) -->
    <ul>
        <li class="itemsSidebar">
            <div class="topoItem">
                <div>
                    <img src="{{ asset('images/user.png') }}" alt="">
                    <span>Usuários</span>
                </div>
                <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
            </div>
            <ul class="submenu">
                <li>Denúncias</li>
                <li><a href="admin/usuarios">Contas</a></li>
            </ul>
        </li>
        <img class="iconeOpcoes" src="{{ asset('images/user.png') }}" alt="">
    </ul>

    <!-- 3. Histórico -->
    <ul>
        <li class="itemsSidebar">
            <div class="topoItem">
                <div>
                    <img src="{{ asset('images/history.png') }}" alt="">
                    <span>Histórico</span>
                </div>
                <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
            </div>
            <ul class="submenu">
                <li>Logs</li>
                <li>Ações</li>
            </ul>
        </li>
        <img class="iconeOpcoes" src="{{ asset('images/history.png') }}" alt="">
    </ul>

    <!-- 4. Relatórios -->
    <ul>
        <li class="itemsSidebar">
            <div class="topoItem">
                <div>
                    <img src="{{ asset('images/file-report.png') }}" alt="">
                    <span>Relatórios</span>  
                </div>
                <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
            </div>
            <ul class="submenu">
                <li>Financeiro</li>
                <li>Operacional</li>
                <li>Estatísticas</li>
            </ul>
        </li>
        <img class="iconeOpcoes" src="{{ asset('images/file-report.png') }}" alt="">
    </ul>

    <!-- 5. Conteúdos (CORRIGIDO: file-detail.png) -->
    <ul>
        <li class="itemsSidebar">
            <div class="topoItem">
                <div>
                    <img src="{{ asset('images/file-detail.png') }}" alt="">
                    <span>Conteúdos</span>
                </div>
                <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
            </div>
            <ul class="submenu">
                <li><a href="/Conteudo-Aprender">Aprender</a></li>
            </ul>
        </li>
        <img class="iconeOpcoes" src="{{ asset('images/file-detail.png') }}" alt="">
    </ul>

<!-- 6. Conversas  -->
<ul class="menu-inferior">
    <li class="itemsSidebar">
        <div class="topoItem-sup-msg">
            <div>
                <img src="{{ asset('images/message-circle-detail.png') }}" alt="">
                <span>Conversas</span>
            </div>
        </div>
    </li>
    <img class="iconeOpcoes" src="{{ asset('images/message-circle-detail.png') }}" alt="">
</ul>

<!-- 7. Suporte -->
<ul>
    <li class="itemsSidebar">
        <div class="topoItem-sup-msg">
            <div>
                <img src="{{ asset('images/headphone-mic.png') }}" alt="">
                <a href="{{ route('admin.suporte') }}">Suporte</a>
            </div>
        </div>
    </li>
    <img class="iconeOpcoes" src="{{ asset('images/headphone-mic.png') }}" alt="">
</ul>

    <!-- Logout -->
    <form action="/fazerLogOut" method="POST">
        @csrf
        <button class="btn-logout" type="submit">Logout</button>
    </form>

</aside>

        
            <main class="conteudo">

            @yield('content')
        </main>


    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>