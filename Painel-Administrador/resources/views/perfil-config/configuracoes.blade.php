<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
    <link rel="stylesheet" href="{{asset('css/perfil-config.css')}}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">
        @include('layouts.mini-header', [
            'titulo' => 'Configurações'
        ])

        <form class="perfil-container" action="">
            <div class="parte1">
                <h1>Autenticação de 2 Fatores</h1>
                <div class="sub-abaixo">
                    <h2>E-mail para envio do código</h2>
                    <div class="exemplo-icones">
                        <p>xxxxxxxxxxxxxx@gmail.com </p>
                        <img src="{{asset('images/olho.png')}}" alt="">
                        <hr>
                        <img src="{{asset('images/editar-vermelho.png')}}" alt="">
                    </div>
                </div>
                <div class="sub-abaixo">
                    <h2>Telefone para envio do código</h2>
                    <div class="exemplo-icones">
                        <p>XX XXXXX-XXXX</p>
                        <img src="{{asset('images/olho.png')}}" alt="">
                        <hr>
                        <img src="{{asset('images/editar-vermelho.png')}}" alt="">
                    </div>
                </div>
            </div>

            <hr class="dividir-partes">

            <div class="config-parte2">
                <h1>Aparência</h1>
                <div class="sub-abaixo-config">
                    <h2>Tema do Site</h2>
                    <div class="opcoes-tema">
                        <label>
                            <input type="radio" name="tema" value="claro">
                            <span class="radio-personalizado"></span>
                            Claro
                        </label>

                        <label>
                            <input type="radio" name="tema" value="escuro">
                            <span class="radio-personalizado"></span>
                            Escuro
                        </label>

                        <label>
                            <input type="radio" name="tema" value="sistema" checked>
                            <span class="radio-personalizado"></span>
                            Sistema
                        </label>
                    </div>
                </div>
            </div>

            <hr class="dividir-partes">

            <div class="config-parte2">
                <h1>Notificações</h1>
                <div class="sub-abaixo-config">
                    <h2>Som e Pop-ups</h2>
                    <div class="opcoes-tema">
                        <label>
                            <input type="radio" name="Ativados" value="Ativados">
                            <span class="radio-personalizado"></span>
                            Ativados
                        </label>

                        <label>
                            <input type="radio" name="SomDesativado" value="SomDesativados">
                            <span class="radio-personalizado"></span>
                            Som desativado
                        </label>

                        <label>
                            <input type="radio" name="PopUpDesativado" value="PopUpDesativado">
                            <span class="radio-personalizado"></span>
                            Pop-Up desativado
                        </label>

                        <label>
                            <input type="radio" name="AmbosDesativados" value="AmbosDesativados" checked>
                            <span class="radio-personalizado"></span>
                            Ambos desativados
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>