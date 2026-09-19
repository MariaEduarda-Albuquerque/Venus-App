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
        <!-- <img src="{{ asset('images/logoVenusLogin.png') }}" alt=""> -->
    </div>

    <div class="esquerda">
        <form action="">
            <div class="titulo-subtitulo">
                <h1>Inserir Código</h1>
                <p>Insira o código que foi enviado para o seu e-mail para trocar sua senha.</p>
            </div>

            <div class="input-label">
                <label for="">Código</label>
                <input type="text" id="codNovaSenha" name="codNovaSenha">
            </div>

            <button type="submit">Inserir</button>

            <div class="colocar-ladoAlado2">
                <p>Ainda não é cadastrado?</p>
                <a href="">Solicitar acesso</a>
            </div>
        </form>
    </div>
</body>
</html>