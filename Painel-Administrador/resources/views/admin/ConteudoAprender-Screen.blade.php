<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteudos do Aprender</title>
    <link rel="stylesheet" href="{{asset('css/listas.css')}}">    

</script>
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">

            <div class="header">
            <div class="mini-header-titulo">
                <h1 class="titulo-tela">Conteúdos Aprender</h1>
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

        <div class="metrics-grid">
            <!-- Card 1: Recusados -->
            <div class="metric-card">
                <div class="icon-wrapper icon-danger">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div class="metric-info">
                    <span class="metric-value">{{$totalConteudosRecusados}}</span>
                    <span class="metric-label">Recusados</span>
                </div>
            </div>

            <!-- Card 2: Aguardando revisão -->
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
                    <span class="metric-value">{{$totalConteudosEmRevisao}}</span>
                    <span class="metric-label">Aguardando revisão</span>
                </div>
            </div>

            <!-- Card 3: Publicados -->
            <div class="metric-card">
                <div class="icon-wrapper icon-success">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="metric-info">
                    <span class="metric-value">{{$totalConteudosPublicados}}</span>
                    <span class="metric-label">Publicados</span>
                </div>
            </div>
        </div>

            <div class="card-container">
        <div class="toolbar">
            <h1>Conteúdos</h1>
            <div class="pesquisa-filtro">
            <div class="search-box">
                <svg viewBox="0 0 24 24">
                    <path d="M10 2a8 8 0 015.29 13.71l4.5 4.49-1.42 1.42-4.49-4.5A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z"/>
                </svg>
                <input type="text" placeholder="Pesquisar...">
            </div>
                <div class="filter-dropdown-wrapper">
                    <!-- Botão de Filtro -->
                    <button type="button" class="filtro" id="btnFiltro">
                        <img src="{{ asset('images/filtro.png') }}" alt="Filtro">
                        <h2>Filtro</h2>
                    </button>

                    <!-- Menu Dropdown -->
                @php $status = request('status'); @endphp

<div class="dropdown-menu" id="dropdownFiltro">
    <ul>
        <li class="{{ !$status ? 'active' : '' }}">
            <a href="{{ request()->url() }}">Todos</a>
        </li>
        <li class="{{ $status === 'publicado' ? 'active' : '' }}">
            <a href="{{ request()->url() }}?status=publicado">Publicado</a>
        </li>
        <li class="{{ $status === 'em_revisao' ? 'active' : '' }}">
            <a href="{{ request()->url() }}?status=em_revisao">Em Análise</a>
        </li>
        <li class="{{ $status === 'recusado' ? 'active' : '' }}">
            <a href="{{ request()->url() }}?status=recusado">Recusado</a>
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
                    <th>PROFISSIONAL</th>
                    <th>TITULO</th>
                    <th>DATA</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Conteudos as $conteudo)
                    <tr data-status="{{ $conteudo->statusConteudo }}">
                        <td>{{ $conteudo->codConteudo }}</td>
                        <td>{{ $conteudo->tbProfissionalSaude->nomeProfissionalSaude }}</td>
                        <td>{{ $conteudo->tituloConteudo }}</td>
                        <td>{{ \Carbon\Carbon::parse($conteudo->dataCriacao)->format('d/m/Y') }}</td>
                        <td>
                            @if ($conteudo->statusConteudo == 'publicado')
                                <span class="status-publicado">{{ $conteudo->statusConteudo }}</span>
                            @elseif ($conteudo->statusConteudo == 'em_revisao')
                                <span class="status-revisao">{{ $conteudo->statusConteudo }}</span>
                            @elseif ($conteudo->statusConteudo == 'recusado')
                                <span class="status-recusado">{{ $conteudo->statusConteudo }}</span>
                            @elseif ($conteudo->statusConteudo == 'rascunho')
                                <span class="status-rascunho">{{ $conteudo->statusConteudo }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>


    <script>
document.addEventListener('DOMContentLoaded', function () {
    var itens  = document.querySelectorAll('#dropdownFiltro li');
    var linhas = document.querySelectorAll('.custom-table tbody tr');

    itens.forEach(function (li) {
        li.addEventListener('click', function () {
            var filtro = li.querySelector('a').dataset.filtro;

            // marca o item selecionado
            itens.forEach(function (i) { i.classList.remove('active'); });
            li.classList.add('active');

            // mostra/esconde as linhas
            linhas.forEach(function (tr) {
                var mostrar = (filtro === 'todos' || tr.dataset.status === filtro);
                tr.style.display = mostrar ? '' : 'none';
            });
        });
    });
});
</script>
</body>
</html>