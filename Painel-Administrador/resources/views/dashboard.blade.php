<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Vênus</title>
    <link rel="stylesheet" href="{{ asset('css/adm.css') }}">
</head>
<body>
   <aside class="sidebar" id="sidebar">

        <h1 class="tituloAberto">Vênus</h1>
        <h1 class="tituloFechado">V.</h1>

        <ul>
          <li class="itemsSidebar">
            <div class="topoItem">
              <img src="{{ asset('images/dashboard.png') }}" alt="">
              <span>Painel</span>
              <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
            </div>
            <ul class="submenu">
              <li>Relatório</li>
              <li>GRC</li>
              <li>Logística</li>
            </ul>
          </li>
          <img class="iconeOpcoes" src="{{ asset('images/dashboard.png') }}" alt="">
        </ul>

        <ul>
          <li class="itemsSidebar">
            <div class="topoItem">
              <img src="{{ asset('images/user.png') }}" alt="">
              <span>Usuários</span>
              <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
            </div>
            <ul class="submenu">
              <li>Denúncias</li>
              <a href="admin/usuarios">
              <li>Contas</li>
              </a>
            </ul>
          </li>
          <img class="iconeOpcoes" src="{{ asset('images/dashboard.png') }}" alt="">
        </ul>

        <ul>
          <li class="itemsSidebar">
            <div class="topoItem">
              <img src="{{ asset('images/file-report.png') }}" alt="">
              <span>Relatórios</span>
              <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
            </div>
            <ul class="submenu">
              <li>Financeiro</li>
              <li>Operacional</li>
              <li>Estatísticas</li>
            </ul>
          </li>
          <img class="iconeOpcoes" src="{{ asset('images/file-report.png') }}" alt="">
        </ul>

        <ul>
            <li class="itemsSidebar">
                <div class="topoItem">
                    <img src="{{ asset('images/history.png') }}" alt="">
                    <span>Histórico</span>
                    <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
                </div>
                <ul class="submenu">
                    <li>Logs</li>
                    <li>Ações</li>
                </ul>
            </li>
            <img class="iconeOpcoes" src="{{ asset('images/history.png') }}" alt="">
        </ul>

        <ul>
            <li class="itemsSidebar">
                <div class="topoItem">
                <img src="{{ asset('images/file-detail.png') }}" alt="">
                <span>Conteúdos</span>
                <img class="imgMaisOpcoes" src="{{ asset('images/chevron-down.png') }}" alt="">
                </div>
                <ul class="submenu">
                <a href="/Conteudo-Aprender">
                    <li>Aprender</li>
                </a>
                <li>Documentos</li>
                <li>Imagens</li>
                </ul>
            </li>
            <img class="iconeOpcoes" src="{{ asset('images/file-deitail.png') }}" alt="">
        </ul>

        <ul class="itemsSidebar">
            <li class="topoItem-sup-msg">
                <img src="{{ asset('images/message-circle-detail.png') }}" alt="">
                <span>Conversas</span>
            </li>
            <img class="iconeOpcoes" src="{{ asset('images/message-circle-detail.png') }}" alt="">
        </ul>

        <ul class="itemsSidebar">
            <li class="topoItem-sup-msg">
                <img src="{{ asset('images/headphone-mic.png') }}" alt="">
                <span>Suporte</span>
            </li>
            <img class="iconeOpcoes" src="{{ asset('images/headphone-mic.png') }}" alt="">
        </ul>

    </aside>

    <div class="direita">

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
            <div class="conteudo">
                <h1>Painel administrativo</h1>
            </div>
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>