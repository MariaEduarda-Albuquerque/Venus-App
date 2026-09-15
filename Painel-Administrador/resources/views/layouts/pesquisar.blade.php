<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/adm.css') }}">
</head>
<body>
            <div class="form">

            <div class="menu-btn" id="menuBtn">
                ☰
            </div>

            <button type="submit" class="btn-logo">
                <img src="{{ asset('images/lupa.png') }}" alt="Enviar">
            </button>

            <form action="">
                <input type="text" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            </form>

            <a href="">
                <div class="btn-pesquisar">
                    <img src="{{ asset('images/notification.png') }}" alt="">
                </div>
            </a>

            <a href="">
                <div class="btn-pesquisar">
                    <img src="{{ asset('images/perfil.png') }}" alt="">
                </div>
            </a>
        </div>
</body>
</html>