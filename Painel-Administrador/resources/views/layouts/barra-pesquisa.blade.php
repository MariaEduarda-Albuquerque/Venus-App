        <link rel="stylesheet" href="{{asset('css/sidebar-pesquisa.css')}}">

        <div class="form">

            <div class="sidebar-btn" id="menuBtn" href="javascript:void(0)" onclick="compactarSidebar()">
                ☰
            </div>

            <button type="submit" class="btn-lupa">
                <img src="{{ asset('images/lupa.png') }}" alt="Enviar">
            </button>

            <form action="">
                <input type="text" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            </form>

            <a href="">
                <div class="btn-sino-perfil">
                    <img src="{{ asset('images/notification.png') }}" alt="">
                </div>
            </a>

            <a href="/perfil">
                <div class="btn-sino-perfil">
                    <img src="{{ asset('images/perfil.png') }}" alt="">
                </div>
            </a>
        </div>

            <script src="{{ asset('js/adm.js') }}"></script>
