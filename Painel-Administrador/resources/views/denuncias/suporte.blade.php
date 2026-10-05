<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte - Vênus</title>
    <link rel="stylesheet" href="{{ asset('css/suporte.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">
        @include('layouts.barra-pesquisa')

        <div class="Titulo-Pagina">
            <h1>Resposta à denúncia</h1>
        </div>

        <div class="container-denuncia">
            <div class="topo">
                <div class="grupo-de-txt">
                    <div class="id-titulo">
                        <h1>ID 346520 - </h1>
                        <p>A barra lateral não responde em dispositivos móveis.</p>
                    </div>
                    <p>Segunda-feira, 15h20 (há 2 dias)</p>
                </div>

                <div class="setas-nav">
                    <div class="seta-voltar">
                        <h1><</h1>
                    </div>
                    <div class="seta-avancar">
                        <h1>></h1>
                    </div>
                </div>
            </div>

            <hr class="divisor">

            <div class="mensagem">
                <div class="nome-perfil">
                    <img src="{{ asset('images/perfil-maior.png') }}" alt="">
                    <div class="textos-nome-perfil">
                        <h1>João Ninguém</h1>
                        <p>jhondelin@gmail.com</p>
                    </div>
                </div>

                <p>Olá, suporte do MaliWoman

                Gostaria de informar que foi identificado um problema na barra lateral do sistema. Em dispositivos móveis, a barra lateral não está respondendo corretamente às interações do usuário, impedindo que as opções sejam acessadas normalmente.

                Solicito, por gentileza, que o problema seja verificado e corrigido para garantir o funcionamento adequado da barra lateral também em dispositivos móveis.
                Atenciosamente,

                João</p>
            </div>

            <hr class="divisor">

            <div class="resposta">
                <div class="nome-perfil">
                    <img src="{{ asset('images/perfil-maior.png') }}" alt="">
                    <div class="textos-nome-perfil">
                        <h1>Suporte Vênus</h1>
                        <p>suportevenus@gmail.com</p>
                    </div>
                </div>

                <form class="mandar-resposta" action="">
                    <input type="text" placeholder="Digite sua resposta aqui...">
                    <div>
                        <img src="{{ asset('images/paperclip.png') }}" alt="">
                        <h2>Anexar</h2>
                    </div>
                    <button>
                        <h2>Responder</h2>
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>