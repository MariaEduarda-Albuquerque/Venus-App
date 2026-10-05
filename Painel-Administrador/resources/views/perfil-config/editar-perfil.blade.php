<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil de Administrador</title>
    <link rel="stylesheet" href="{{ asset('css/perfil-config.css') }}">
</head>
<body>
    @include('layouts.sidebar')
    <div class="direita">
        <div class="perfil-container">
            <div class="topo">
                <div class="dados-destaque-topo">
                    <h1>Editar informações pessoais</h1>
                    <p>Atualize seus dados para manter seu perfil atualizado.</p>
                </div>

                <a href="/perfil" class="circulo-voltar">
                    <img src="{{ asset('images/voltar.png') }}" alt="">
                </a>
            </div>

            <form class="editar-perfil" action="">
                <div class="editar-foto">
                    <h2>Alterar Foto de Perfil</h2>
                    <div class="editar-foto-abaixo">
                        <a class="editar-foto-perfil" href="">
                            <img src="{{asset('images/perfil-grande.png')}}" alt="">
                            <div class="fundo-camera">
                                <img src="{{asset('images/camera.png')}}" alt="">
                            </div>
                        </a>
                        <p>Faça o upload de uma imagem quadrada (200×200 px) em formato JPEG ou PNG.</p>
                    </div>
                </div>

                <div class="editar-informacoes">
                    <h2>Informações Pessoais</h2>
                    <div class="campo-editar">
                        <div class="sub-campo-editar">
                            <label for="">Primeiro Nome</label>
                            <input type="text" placeholder="Clodo">
                        </div>
                        <div class="sub-campo-editar">
                            <label for="">Sobrenome</label>
                            <input type="text" placeholder="Almeida">
                        </div>
                    </div>

                    <div class="campo-editar">
                        <div class="sub-campo-editar">
                            <label for="">Endereço de Email</label>
                            <input type="text" placeholder="ClodoAlmeida@gmail.com">
                        </div>
                        <div class="sub-campo-editar">
                            <label for="">Telefone</label>
                            <input type="text" placeholder="11 99999-9999">
                        </div>
                    </div>
                </div>

                <div class="editar-informacoes">
                    <h2>Endereço</h2>
                    <div class="campo-editar">
                        <div class="sub-campo-editar">
                            <label for="">País</label>
                            <input type="text" placeholder="Brasil">
                        </div>
                        <div class="sub-campo-editar">
                            <label for="">Cidade/Estado</label>
                            <input type="text" placeholder="São Paulo, SP">
                        </div>
                    </div>

                    <div class="campo-editar">
                        <div class="sub-campo-editar">
                            <label for="">Código Postal</label>
                            <input type="text" placeholder="01100-000">
                        </div>
                        <div class="sub-campo-editar">
                            <label for="">Nº Fiscal</label>
                            <input type="text" placeholder="000.123.456">
                        </div>
                    </div>
                </div>

                <div class="fechar-salvar">
                    <a href="">
                        <h2>fechar</h2>
                    </a>

                    <button type="submit">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>