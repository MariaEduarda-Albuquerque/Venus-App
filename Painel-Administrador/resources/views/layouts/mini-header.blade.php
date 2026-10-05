        <link rel="stylesheet" href="{{asset('css/sidebar-pesquisa.css')}}">

        <div class="form">

            <a class="sidebar-btn" id="menuBtn" href="javascript:void(0)" onclick="compactarSidebar()">
                ☰
            </a>

            <div class="mini-header-container">
                <h1>{{ $titulo }}</h1>
            </div>

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
