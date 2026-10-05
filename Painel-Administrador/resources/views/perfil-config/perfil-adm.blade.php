<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Administrador</title>
    <link rel="stylesheet" href="{{ asset('css/perfil-config.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">
        @include('layouts.barra-pesquisa')

        <div class="perfil-container">
            <div class="parte1">
                <div class="topo">
                    <img src="{{ asset('images/perfil-maior.png') }}" alt="">
                    <div class="dados-destaque-topo">
                        <h1>Clodo Almeida</h1>
                        <div class="sub-dados-destaque-topo">
                           <p>Gerente administrativo</p> 
                           <hr>
                           <p>São Paulo, Brasil</p>
                        </div>
                    </div>
                        <div class="isolar-btn-editar">
                            <a href="/editar/perfil" class="btn-editar">
                                <img src="{{ asset('images/editar.png') }}" alt="">
                                <h2>Editar</h2>
                            </a>
                        </div>
                </div>
                <div class="abaixo">
                    <div class="sub-abaixo">
                        <h2>Primeiro nome</h2>
                        <p>Clodo</p>
                    </div>
                    <div class="sub-abaixo">
                        <h2>Segundo nome</h2>
                        <p>Almeida</p>
                    </div>
                    <div></div>
                </div>
                
                <div class="abaixo">
                    <div class="sub-abaixo">
                        <h2>Endereço de Email</h2>
                        <p>ClodoAlmeida@gmail.com</p>
                    </div>
                    <div class="sub-abaixo">
                        <h2>Telefone</h2>
                        <p>11 99999-9999</p>
                    </div>
                    <div class="sub-abaixo">
                        <h2>Cargo</h2>
                        <p>Gerente Administrativo</p>
                    </div>
                </div>
            </div>

            <hr class="dividir-partes">

            <div class="parte2">
                <div class="topo">
                    <h1>Endereço</h1>
                </div>
                <div class="container-abaixo">
                    <div class="abaixo">
                        <div class="sub-abaixo">
                            <h2>País</h2>
                            <p>Brasil</p>
                        </div>
                        <div class="sub-abaixo">
                            <h2>Cidade/Estado</h2>
                            <p>São Paulo, SP</p>
                        </div>
                    </div>
                    <br>
                    <div class="abaixo">
                        <div class="sub-abaixo">
                            <h2>Código postal</h2>
                            <p>01100-000</p>
                        </div>
                        <div class="sub-abaixo">
                            <h2>Nº Fiscal</h2>
                            <p>000.123.456</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="dividir-partes">

            <div class="parte3">
                <div class="topo">
                    <h1>Segurança</h1>
                </div>
                <div class="abaixo">
                    <div class="sub-abaixo">
                        <h2>Alterar senha</h2>
                        <p>Receba notificações em tempo real e alertas da equipe.</p>
                    </div>

                    <div class="sub-abaixo-senha">
                        <a href="#" class="btn-editar-senha">
                            <img src="{{ asset('images/editar.png') }}" alt="">
                            <h2>Alterar a senha</h2>
                        </a>
                    </div>
                </div>

                <div class="abaixo">
                    <div class="sub-abaixo">
                        <h2>Autenticação de dois fatores (2FA)</h2>
                        <p>Mantenha sua conta segura ativando a autenticação de dois fatores (2FA).</p>
                    </div>

                    <div class="sub-abaixo-2fa">
                        <a href="#" class="btn-2fa">
                            <div class="circulo-2fa"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>