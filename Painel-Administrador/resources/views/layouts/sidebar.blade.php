  <link rel="stylesheet" href="{{asset('css/sidebar-pesquisa.css')}}">
  
  <aside class="sidebar" id="sidebar">

        <div>
            <h1 class="tituloAberto">Vênus</h1>
            <h1 class="tituloFechado">V.</h1>

            <ul>
            <li class="itemsSidebar">
                <div class="topoItem">
                <div>
                    <a href="/">
                    <img src="{{asset('images/dashboard.png')}}" alt="">
                    <span>Painel</span>
                    </a>
                </div>
                <!-- <img class="imgMaisOpcoes" onclick="abrirSubMenu(this)" src="{{asset('images/chevron-down.png')}}" alt=""> -->
                </div>
                <!-- <ul class="submenu">
                    <a href="">
                        <li>Relatório</li>
                    </a>
                    <a href="">
                        <li>GRC</li>
                    </a>
                    <a href="">
                        <li>Logística</li>
                    </a>
                </ul> -->
            </li>
            <a href="/">
                <img class="iconeOpcoes" src="{{ asset('images/dashboard.png') }}" alt="">
            </a>
            </ul>

            <ul>
            <li class="itemsSidebar">
                <div class="topoItem">
                    <div>
                        <img src="{{ asset('images/user.png') }}" alt="">
                        <span>Usuários</span>
                    </div>
                <img class="imgMaisOpcoes" onclick="abrirSubMenu(this)" src="{{ asset('images/chevron-down.png') }}" alt="">
                </div>
                <ul class="submenu">
                    <!-- <a href="">
                        <li>Denúncias</li>
                    </a> -->
                    <a href="usuarios">
                    <li>Contas</li>
                    </a>
                </ul>
            </li>
            <img class="iconeOpcoes" src="{{ asset('images/user.png') }}" alt="">
            </ul>

            <ul>
            <li class="itemsSidebar">
                <div class="topoItem">
                    <div>
                        <img src="{{ asset('images/file-report.png') }}" alt="">
                        <span>Relatórios</span>
                    </div>
                <img class="imgMaisOpcoes" onclick="abrirSubMenu(this)" src="{{ asset('images/chevron-down.png') }}" alt="">
                </div>
                <ul class="submenu">
                    <a href="/feedbacks">
                        <li>Feedbacks</li>
                    </a>
                    <a href="/denuncias">
                        <li>Denúncias</li>
                    </a>
                </ul>
            </li>
            <img class="iconeOpcoes" src="{{ asset('images/file-report.png') }}" alt="">
            </ul>

            <!-- <ul>
                <li class="itemsSidebar">
                    <div class="topoItem">
                        <div>
                            <img src="{{ asset('images/history.png') }}" alt="">
                            <span>Histórico</span>
                        </div>
                        <img class="imgMaisOpcoes" onclick="abrirSubMenu(this)" src="{{ asset('images/chevron-down.png') }}" alt="">
                    </div>
                    <ul class="submenu">
                        <a href="">
                        <li>Logs</li>
                        </a>
                        <a href="">
                        <li>Ações</li>
                        </a>
                    </ul>
                </li>
                <img class="iconeOpcoes" src="{{ asset('images/history.png') }}" alt="">
            </ul> -->

            <ul>
                <li class="itemsSidebar">
                    <div class="topoItem">
                        <div>
                            <img src="{{ asset('images/file-detail.png') }}" alt="">
                            <span>Conteúdos</span>
                        </div>
                    <img class="imgMaisOpcoes" id="imgMaisOpcoes" onclick="abrirSubMenu(this)" src="{{ asset('images/chevron-down.png') }}" alt="">
                    </div>
                    <ul class="submenu">
                        <a href="/conteudos-aprender">
                            <li>Aprender</li>
                        </a>
                        <a href="/destaques-principais">
                            <li>Destaques</li>
                        </a>
                    </ul>
                </li>
                <img class="iconeOpcoes" src="{{ asset('images/file-detail.png') }}" alt="">
            </ul>

            <ul>
                <li class="itemsSidebar">
                    <div class="topoItem">
                        <div>
                            <a href="/denuncias-mensagens">
                                <img src="{{ asset('images/message-circle-detail.png') }}" alt="">
                                <span>Conversas</span>
                            </a>
                        </div>
                    <img class="imgMaisOpcoes" onclick="abrirSubMenu(this)" src="{{ asset('images/chevron-down.png') }}" alt="">
                    </div>
                    <ul class="submenu">
                        <a href="/denuncias-mensagens">
                            <li>Denúncias</li>
                        </a>
                    </ul>
                </li>
                <a href="/denuncias-mensagens">
                    <img class="iconeOpcoes" src="{{ asset('images/message-circle-detail.png') }}" alt="">
                </a>            
            </ul>
        </div>

        <div>

            <div class="tres-pontos-sidebar">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <ul class="itemsSidebar">
                <li class="topoItem-sup-msg">
                    <a href="/configuracoes">
                        <img src="{{ asset('images/settings.png') }}" alt="">
                        <span>Configurações</span>
                    </a>
                </li>
            </ul>
            <a href="/configuracoes">
                <img class="iconeOpcoes" src="{{ asset('images/settings.png') }}" alt="">
            </a>   

            <ul class="itemsSidebar">
                <li class="topoItem-sup-msg">
                    <a href="/suporte">
                    <img src="{{ asset('images/headphone-mic.png') }}" alt="">
                    <span>Suporte</span>
                    </a>
                </li>
            </ul>
            <a href="/suporte">
                 <img class="iconeOpcoes" src="{{ asset('images/headphone-mic.png') }}" alt="">
            </a>
        </div>

    </aside>

        <script src="{{ asset('js/adm.js') }}"></script>
