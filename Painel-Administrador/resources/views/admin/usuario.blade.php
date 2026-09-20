<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuárias</title>
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">

        <div class="pagina-conteudo">

            <div class="header-menu-btn">
                <div class="menu-btn" id="menuBtn">
                    <span>☰</span>
                </div>

                <div class="header">
                    <div class="mini-header-titulo">
                        <h1 class="titulo-tela">Lista de Usuárias</h1>
                    </div>

                    <div class="perfil-notificacao">
                        <a href="">
                            <div class="btn-miniHeader">
                                <img src="{{ asset('images/notification-off.png') }}" alt="">
                            </div>
                        </a>

                        <a href="">
                            <div class="btn-miniHeader">
                                <img src="{{ asset('images/perfil.png') }}" alt="">
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-container">
                <div class="toolbar">
                    <div class="search-box">
                        <svg viewBox="0 0 24 24">
                            <path d="M10 2a8 8 0 015.29 13.71l4.5 4.49-1.42 1.42-4.49-4.5A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z"/>
                        </svg>
                        <input type="text" placeholder="Pesquisar...">
                    </div>

                    @php $status = request('status'); @endphp

                    <div class="filter-dropdown-wrapper">
                        <button type="button" class="filtro" id="btnFiltro">
                            <img src="{{ asset('images/filtro.png') }}" alt="Filtro">
                            <h2>Filtro</h2>
                        </button>

                        <div class="dropdown-menu" id="dropdownFiltro">
                            <ul>
                                <li class="{{ !$status ? 'active' : '' }}">
                                    <a href="{{ request()->url() }}">Todos</a>
                                </li>
                                <li class="{{ $status === 'ativa' ? 'active' : '' }}">
                                    <a href="{{ request()->url() }}?status=ativa">Ativa</a>
                                </li>
                                <li class="{{ $status === 'suspensa' ? 'active' : '' }}">
                                    <a href="{{ request()->url() }}?status=suspensa">Suspensa</a>
                                </li>
                                <li class="{{ $status === 'excluida' ? 'active' : '' }}">
                                    <a href="{{ request()->url() }}?status=excluida">Excluída</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>CONTA</th>
                            <th>CADASTRO</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->codUsuario }}</td>
                                <td>{{ $usuario->nomeUsuario }}</td>
                                <td>{{ $usuario->emailUsuario }}</td>
                                <td>{{ \Carbon\Carbon::parse($usuario->dataCadastro)->format('d/m/Y') }}</td>
                                <td>
                                    @if ($usuario->statusUsuario == 'ativa')
                                        <span class="status-publicado">{{ $usuario->statusUsuario }}</span>
                                    @elseif ($usuario->statusUsuario == 'suspensa')
                                        <span class="status-revisao">{{ $usuario->statusUsuario }}</span>
                                    @elseif ($usuario->statusUsuario == 'excluida')
                                        <span class="status-recusado">{{ $usuario->statusUsuario }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>