<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denúncias de mensagens</title>
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">

        @include('layouts.mini-header', [
            'titulo' => 'Denúncias de mensagens'
        ])
        <div class="container-global">


        <div class="lista">

            <div class="header-tabela">

                <h1>Mensagens denunciadas</h1>

                <div class="isolar">
                    <form action="">
                        <button>
                            <img src="{{ asset('images/lupa.png') }}" alt="">
                        </button>
                        <input type="text" placeholder="Pesquisar...">
                    </form>

                </div>

            </div>


            <div class="lista-denuncias">

                <div class="denuncia">

                    <div class="cabecalho-denuncia">

                        <div class="foto-usuario">
                            K
                        </div>

                        <div class="informacoes-usuario">
                            <h3>Karolyne Anjos</h3>
                            <p>03/09/2026</p>
                        </div>

                    </div>

                    <p class="mensagem-denunciada">
                        Eu quero que todas vocês que usam esse site parem de usar já!
                        É um lixo, não ouçam as postagens de nenhuma profissional daqui.
                    </p>

                    <p class="motivo">
                        Motivo da denúncia:
                        <strong>Calúnia e Injúria</strong>
                    </p>

                    <p class="descricao-denuncia">
                        Mensagem da denúncia: A mensagem não tem nenhum fundamento,
                        nem argumentos, apenas xingamentos sem fundamento.
                    </p>

                    <div class="botoes-denuncia">

                        <button class="botao-recusar">
                            Recusar Denúncia
                        </button>

                        <button class="botao-aceitar">
                            Aceitar Denúncia
                        </button>

                    </div>

                </div>

                <div class="denuncia">

                    <div class="cabecalho-denuncia">

                        <div class="foto-usuario">
                            A
                        </div>

                        <div class="informacoes-usuario">
                            <h3>Agatha Volkomenn</h3>
                            <p>28/04/2026</p>
                        </div>

                    </div>

                    <p class="mensagem-denunciada">
                        Eu acho que a melhor saída pra isso é contatar aqui
                        sroverissimo1413@hotmail.com
                    </p>

                    <p class="motivo">
                        Motivo da denúncia:
                        <strong>Contato Vazado</strong>
                    </p>

                    <p class="descricao-denuncia">
                        Mensagem da denúncia: O email nessa mensagem não é o email
                        da usuária, então considero como um email falso.
                    </p>

                    <div class="botoes-denuncia">

                        <button class="botao-recusar">
                            Recusar Denúncia
                        </button>

                        <button class="botao-aceitar">
                            Aceitar Denúncia
                        </button>

                    </div>

                </div>

                <div class="denuncia">

                    <div class="cabecalho-denuncia">

                        <div class="foto-usuario">
                            K
                        </div>

                        <div class="informacoes-usuario">
                            <h3>Karolyne Anjos</h3>
                            <p>2 dias atrás</p>
                        </div>

                    </div>

                    <p class="mensagem-denunciada">
                        Eu quero que todas vocês que usam esse site parem de usar já!
                        É um lixo, não ouçam as postagens de nenhuma profissional daqui.
                    </p>

                    <p class="motivo">
                        Motivo da denúncia:
                        <strong>Outro</strong>
                    </p>

                    <p class="descricao-denuncia">
                        Mensagem da denúncia: Não gosto da usuária, e gostaria que
                        fosse removido e ela tivesse a conta bloqueada, por favor.
                    </p>

                    <div class="botoes-denuncia">

                        <button class="botao-recusar">
                            Recusar Denúncia
                        </button>

                        <button class="botao-aceitar">
                            Aceitar Denúncia
                        </button>

                    </div>

                </div>

            </div>
            
        </div>
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>