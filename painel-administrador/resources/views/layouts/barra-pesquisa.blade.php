<link rel="stylesheet" href="{{asset('css/sidebar-pesquisa.css')}}">

<div class="top">
    <button class="ib" id="menuBtn" aria-label="Menu" onclick="compactarSidebar()">
        <i data-lucide="menu"></i>
    </button>

    <form action="/pesquisar" method="GET" class="search">
        <i data-lucide="search"></i>
        <input type="text" id="pesquisar" name="pesquisar" placeholder="Pesquisar…">
    </form>

    <a href="" class="ib" aria-label="Notificações">
        <i data-lucide="bell"></i>
        <span class="dot"></span>
    </a>

    <a href="/perfil" class="av" aria-label="Meu perfil">
        <span>{{ substr(auth()->user()->name ?? 'C', 0, 1) }}</span>
    </a>
</div>