<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denúncias de mensagens</title>
    <link rel="stylesheet" href="{{asset('css/listas.css')}}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">

            <div class="header">
            <div class="mini-header-titulo">
                <h1 class="titulo-tela">Denúncias de mensagens</h1>
            </div>

            <div class="perfil-notificacao">
                <a href="">
                    <div class="btn-miniHeader">
                        <img src="{{ asset('images/notification-off.png') }}" alt="">
                    </div>
                </a>

                <a href="">
                    <div class="btn-miniHeader">
                        <img src="{{ asset('images/perfil.png') }}" alt="">
                    </div>
                </a> 
            </div>
        </div>

            <div class="card-container">
        <div class="toolbar">
            <h1>Mensagens Denunciadas</h1>
            <div class="pesquisa-filtro">
            <div class="search-box">
                <svg viewBox="0 0 24 24">
                    <path d="M10 2a8 8 0 015.29 13.71l4.5 4.49-1.42 1.42-4.49-4.5A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z"/>
                </svg>
                <input type="text" placeholder="Pesquisar...">
            </div>
            </div>
        </div>
<div class="centralizar-card">
        <div class="card-denuncia">
    <!-- Cabeçalho do Card (Avatar + Nome e Data) -->
    <div class="card-header">
        <div class="avatar">K</div>
        <div class="user-info">
            <h3 class="user-name">Karolyne Anjos</h3>
            <span class="post-date">03/09/2026</span>
        </div>
    </div>

        <!-- Conteúdo do Card -->
         
        <div class="card-body">
                <p class="post-content">
                    Eu quero que todas vocês que usam esse site parem de usar já! É um lixo, não ouçam as postagens de nenhuma profissional daqui.
                </p>
                <p class="denuncia-motivo">
                    <strong>Motivo da denúncia:</strong> Calúnia e Injúria
                </p>
                <p class="denuncia-mensagem">
                    Mensagem da denúncia: A mensagem não tem nenhum fundamento, nem argumentos, apenas xingamentos sem fundamento.
                </p>
            </div>

            <!-- Ações / Botões -->
            <div class="card-actions">
                <button class="btn btn-outline">Recusar Denúncia</button>
                <button class="btn btn-filled">Aceitar Denúncia</button>
            </div>
        </div>
        </div>
    </div>
    </div>

</body>
</html>
</body>
</html>