<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">

        @include('layouts.mini-header', [
            'titulo' => 'Lista de Usuários'
        ])
        <div class="container-global">

        <div class="lista">

            <div class="header-tabela">


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
                                <a href="">Ativo</a>
                            </li>
                            <li>
                                <a href="">Desativado</a>
                            </li>
                            <li>
                                <a href="">Suspenso</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Conta</th>
                        <th>Cadastro</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>US124321</td>
                        <td>Maria Ninguém</td>
                        <td>Profissional</td>
                        <td>15/06/2024</td>
                        <td><span class="status-verde">Ativo</span></td>
                    </tr>

                    <tr>
                        <td>US356412</td>
                        <td>Gabriela Ninguém</td>
                        <td>Administração</td>
                        <td>09/12/2025</td>
                        <td><span class="status-vermelho">Desativado</span></td>
                    </tr>

                    <tr>
                        <td>US956487</td>
                        <td>Júlia Ninguém</td>
                        <td>Usuário</td>
                        <td>01/03/2026</td>
                        <td><span class="status-verde">Ativo</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>