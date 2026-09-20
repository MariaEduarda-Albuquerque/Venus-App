<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Denúncias</title>
    <link rel="stylesheet" href="{{asset('css/listas.css')}}">
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
                        <h1 class="titulo-tela">Lista de Denúncias</h1>
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

            <div class="metrics-grid">
                <!-- Card 1: Total -->
                <div class="metric-card">
                    <div class="icon-wrapper icon-warning">
                        <img src="{{ asset('images/alert-octagon.png') }}" alt="">
                    </div>
                    <div class="metric-info">
                        <span class="metric-value">{{$totalDenuncias}}</span>
                        <span class="metric-label">Total de Denúncias</span>
                    </div>
                </div>

                <!-- Card 2: Pendentes -->
                <div class="metric-card">
                    <div class="icon-wrapper icon-warning">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 22h14"></path>
                            <path d="M5 2h14"></path>
                            <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"></path>
                            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"></path>
                        </svg>
                    </div>
                    <div class="metric-info">
                        <span class="metric-value">{{$totalDenunciasPendentes}}</span>
                        <span class="metric-label">Denúncias pendentes</span>
                    </div>
                </div>

                <!-- Card 3: Resolvidas -->
                <div class="metric-card">
                    <div class="icon-wrapper icon-success">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div class="metric-info">
                        <span class="metric-value">{{$totalDenunciasEmResolvidas}}</span>
                        <span class="metric-label">Denúncias resolvidas</span>
                    </div>
                </div>
            </div>

            <div class="card-container">
                <div class="toolbar">
                    <h1>Denúncias</h1>
                    <div class="pesquisa-filtro">
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
                                    <li class="{{ $status === 'pendente' ? 'active' : '' }}">
                                        <a href="{{ request()->url() }}?status=pendente">Pendente</a>
                                    </li>
                                    <li class="{{ $status === 'em_analise' ? 'active' : '' }}">
                                        <a href="{{ request()->url() }}?status=em_analise">Em Análise</a>
                                    </li>
                                    <li class="{{ $status === 'resolvida' ? 'active' : '' }}">
                                        <a href="{{ request()->url() }}?status=resolvida">Resolvida</a>
                                    </li>
                                    <li class="{{ $status === 'arquivada' ? 'active' : '' }}">
                                        <a href="{{ request()->url() }}?status=arquivada">Arquivada</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SOLICITADO</th>
                            <th>ASSUNTO</th>
                            <th>DATA</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($denuncias as $denuncia)
                            <tr>
                                <td>{{ $denuncia->codDenuncia }}</td>
                                <td>{{ $denuncia->tbusuario->nomeUsuario }}</td>
                                <td>{{ $denuncia->motivoDenuncia }}</td>
                                <td>{{ \Carbon\Carbon::parse($denuncia->dataDenuncia)->format('d/m/Y') }}</td>
                                <td>
                                    @if ($denuncia->statusDenuncia == 'resolvida')
                                        <span class="status-publicado">{{ $denuncia->statusDenuncia }}</span>
                                    @elseif ($denuncia->statusDenuncia == 'pendente')
                                        <span class="status-revisao">{{ $denuncia->statusDenuncia }}</span>
                                    @elseif ($denuncia->statusDenuncia == 'arquivada')
                                        <span class="status-recusado">{{ $denuncia->statusDenuncia }}</span>
                                    @elseif ($denuncia->statusDenuncia == 'em_analise')
                                        <span class="status-rascunho">{{ $denuncia->statusDenuncia }}</span>
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