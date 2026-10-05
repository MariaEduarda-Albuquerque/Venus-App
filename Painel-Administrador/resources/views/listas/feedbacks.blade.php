<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">
        @include('layouts.mini-header', [
            'titulo' => 'Feedbacks'
        ])

                <div class="container-global">

        <div class="lista">

            <div class="header-tabela">

                <h1>Feedbacks</h1>

                <form action="">
                    <button>
                        <img src="{{ asset('images/lupa.png') }}" alt="">
                    </button>
                    <input type="text" placeholder="Pesquisar...">
                </form>


            </div>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Assunto</th>
                        <th>Data</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>FE000008</td>
                        <td>RobertaOli@gmail.com</td>
                        <td>Demoram muito para analisar</td>
                        <td>30/08/2026</td>
                        <td><span class="responder-feedback" onclick="responder()">Responder</span></td>
                    </tr>

                    <tr>
                        <td>FE000007</td>
                        <td>RicardoN@gmail.com</td>
                        <td>Gostei do site profissional, adicionem modo escuro</td>
                        <td>06/07/2026</td>
                        <td><span class="responder-feedback" onclick="responder()">Responder</span></td>
                    </tr>

                    <tr>
                        <td>FE000006</td>
                        <td>AlineSP@gmail.com</td>
                        <td>A Interface do app está bugada.</td>
                        <td>12/06/2026/td>
                        <td><span class="responder-feedback" onclick="responder()">Responder</span></td>
                    </tr>

                    <tr>
                        <td>FE000005</td>
                        <td>JuniorCOR@gmail.com</td>
                        <td>Ainda está bem incompleto</td>
                        <td>12/06/2026</td>
                        <td><span class="responder-feedback" onclick="responder()">Responder</span></td>
                    </tr>

                    <tr>
                        <td>FE000004</td>
                        <td>AlineSP@gmail.com</td>
                        <td>Falta só o conteúdo sobre câncer de mama</td>
                        <td>11/06/2026</td>
                        <td><span class="responder-feedback" onclick="responder()">Responder</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal-overlay" id="modal-overlay" name="modal-overlay">
            <div class="responder-feedback-container">
                <div class="topo-responder-feedback">
                    <h1>RobertaOli@gmail.com</h1>
                    <div onclick="responderFechar()" class="imagem-voltar-feedback">
                        <img src="{{asset('images/voltar.png')}}" alt="">
                    </div>
                </div>
                <h2>Assunto: Demoram muito para analisar</h2>
                <p>Vocês demoram muito para analisar os conteúdos, podem por favor analisarem mais rápido os conteúdos que nós, profissionais, postamos? Obrigada.</p>
                <form action="">
                    <input type="text" placeholder="Responder...">
                    <div>
                        <button>Enviar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>