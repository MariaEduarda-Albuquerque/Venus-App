<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Denúncias</title>
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">

        @include('layouts.mini-header', [
            'titulo' => 'Lista de Denúncias'
        ])
        <div class="container-global">
            <div class="cards-inicio">
                <div class="card-inicio">
                    <img src="{{ asset('images/alert-octagon.png') }}" alt="">
                    <div class="textos-card-inicio">
                        <h1>5.347</h1>
                        <p>Total de denúncias</p>
                    </div>
                </div>

                <div class="card-inicio">
                    <img class="img-2" src="{{asset('images/tempo.png')}}" alt="">
                    <div class="textos-card-inicio">
                        <h1>1.230</h1>
                        <p>Denúncias pendentes</p>
                    </div>
                </div>

                <div class="card-inicio">
                    <img class="img-3" src="{{ asset('images/check-circle.png') }}" alt="">
                    <div class="textos-card-inicio">
                        <h1>4.117</h1>
                        <p>Denúncias resolvidas</p>
                    </div>
                </div>
            </div>

        <div class="lista">

            <div class="header-tabela">

                <h1>Denúncias</h1>

                <div class="isolar">
                    <form action="">
                        <button>
                            <img src="{{ asset('images/lupa.png') }}" alt="">
                        </button>
                        <input type="text" placeholder="Pesquisar...">
                    </form>

                    <div class="container-filtro">
                        <div class="btn-filtro" onclick="abrirMenuFiltros()">
                            <img src="{{ asset('images/filtro.png') }}" alt="">
                            <h2>Filtro</h2>
                        </div>

                        <div class="filtro-menu" id="filtro-menu">
                            <ul>
                                <li>
                                    <a href="">Todos</a>
                                </li>
                                <li>
                                    <a href="">Resolvido</a>
                                </li>
                                <li>
                                    <a href="">Recusado</a>
                                </li>
                                <li>
                                    <a href="">Pendente</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Solicitado</th>
                        <th>Assunto</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>DE264789</td>
                        <td>MariaN@gmail.com</td>
                        <td>Bug encontrado no layout do Modo Escuro</td>
                        <td>02/05/2026</td>
                        <td><span class="status-verde">Resolvido</span></td>
                    </tr>

                    <tr>
                        <td>DE266910</td>
                        <td>RicardoN@gmail.com</td>
                        <td>A integração não está funcionando.</td>
                        <td>06/10/2026</td>
                        <td><span class="status-amarelo">Pendente</span></td>
                    </tr>

                    <tr>
                        <td>DE269346</td>
                        <td>AnaPaula@gmail.com</td>
                        <td>Erro 500 no painel de controle</td>
                        <td>11/01/2026</td>
                        <td><span class="status-verde">Resolvido</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>