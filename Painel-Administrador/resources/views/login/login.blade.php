<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador - Vênus</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="direita">
    </div>

    <div class="esquerda">
        <form action="" method="post">
            <div class="titulo-subtitulo">
                <h1>Login ADM</h1>
                <p>Entre no site para gerenciar e administrar o nosso aplicativo e o site de profissional.</p>
            </div>

            <div class="input-label">
                <label for="">E-mail</label>
                <div class="input-com-icone">
                    <img src="{{ asset('images/gmail.png') }}" alt="" class="icone-input">
                    <input type="email" id="emailAdmin" name="emailAdmin" placeholder="email@endereço">
                </div>
            </div>

            <div class="input-label">
                <label for="">Senha</label>
                <div class="input-com-icone">
                    <img src="{{ asset('images/senha.png') }}" alt="" class="icone-input">
                    <input type="password" id="password" name="password" placeholder="Digite sua senha">
                    <img src="{{ asset('images/visibilidade.png') }}" alt="" class="icone-input-direita">
                </div>
            </div>

            <div class="colocar-ladoAlado">
                <div class="lembrar-container">
                <input type="checkbox" id="lembrar" name="lembrar">
                <label for="lembrar">Lembrar de mim</label>
                </div>

                <a href="/esqueciSenha">Esqueci minha senha</a>
            </div>
            <button type="submit">Entrar</button>

            <div class="colocar-ladoAlado2">
                <p>Ainda não é cadastrado?</p>
                <a href="">Solicitar acesso</a>
            </div>
        </form>
    </div>
</body>
</html>