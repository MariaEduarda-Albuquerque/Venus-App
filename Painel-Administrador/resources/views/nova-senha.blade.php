<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="direita">
        <img src="{{ asset('images/logoVenusLogin.png') }}" alt="">
    </div>

    <div class="esquerda">
        <form action="">
            <div class="titulo-subtitulo">
                <h1>Trocar senha</h1>
                <p>Digite sua nova senha para redefini-la, ao redefinir, você retornará a tela de login.</p>
            </div>

            <div class="input-label">
                <label for="">Nova senha</label>
                <input type="password" id="senhaAdm" name="novaSenha">
            </div>

            <div class="input-label">
                <label for="">Confirmar senha</label>
                <input type="password" id="senhaAdm" name="novaSenha">
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