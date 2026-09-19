@php
    use Illuminate\Support\Str;
@endphp
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
            <div>
                <img src="{{ asset('images/dashboard.png') }}" alt="">
                <span>Painel</span>
            </div>
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
                <div>
                    <img src="{{ asset('images/user.png') }}" alt="">
                    <span>Usuários</span>
                </div>
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
                <div>
                    <img src="{{ asset('images/file-report.png') }}" alt="">
                    <span>Relatórios</span>
                </div>
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
                    <div>
                        <img src="{{ asset('images/history.png') }}" alt="">
                        <span>Histórico</span>
                    </div>
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
                    <div>
                        <img src="{{ asset('images/file-detail.png') }}" alt="">
                        <span>Conteúdos</span>
                    </div>
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

           <section>
                <div class="Container-Global">
                    <div class="conteudo">
                        <h1>Painel Administrativo</h1>
                    </div>

                    <div class="container-1">
                        <div class="bloco">
                            <div class="img-fundo">
                                <img src="{{ asset('images/woman.png') }}" alt="">
                            </div>
                            <div class="desc-bloco">
                                <h1>{{$totalUsuarios}}</h1>
                                <p>Usuárias ativas</p>
                                <p>ultimo mês</p>
                            </div>
                        </div>

                        <div class="bloco">
                            <div class="img-fundo">
                                <img src="{{ asset('images/face-mask.png') }}" alt="">
                            </div>
                            <div class="desc-bloco">
                                <h1>{{$totalProsissionais}}</h1>
                                <p>Profissionais ativas</p>
                                <p>ultimo mês</p>
                            </div>
                        </div>

                        <div class="bloco">
                            <div class="img-fundo">
                                <img src="{{ asset('images/user-plus.png') }}" alt="">
                            </div>
                            <div class="desc-bloco">
                                <h1>23</h1>
                                <p>Cadastro aguardando</p>
                                <p>Aprovação - profissional</p>
                            </div>
                        </div>
                    </div>

                    <div class="container-2">
                        <div class="direita">
                           
                            <div class="titulo-direita">
                                <h1>Fila prioritária</h1>
                                <h2>Denúncia de alta gravidade</h2>
                            </div>

                            @foreach($DenunciasAltaGravidade as $denuncia)
                            <div class="denuncia-aprovacao">
                                <p>{{ Str::limit($denuncia->comentarioDenuncia, 22, '...') }}</p>
                                @if($denuncia->tipoAlvo == 'forum_publicacao' || $denuncia->tipoAlvo == 'forum_resposta')
                                <h1 class="h1-com-fundo">Fórum</h1>
                                @elseif($denuncia->tipoAlvo == 'mensagem_chat')
                                <h1 class="h1-com-fundo">Chat</h1>
                                @else
                                <h1 classe="h1-com-fundo">Perfil</h1>
                                @endif
                                <p>{{ \Carbon\Carbon::parse($denuncia->dataDenuncia)->diffForHumans() }}</p>
                            </div>
                            @endforeach
                            <hr>

                            
                                <h1>Aprovações de Profissionais</h1>
                                <div class="denuncia-aprovacao">
                                    <p> Dra Juliana </p>
                                    <p> CRP 09/22908108 </p>
                                    <p> 2h </p>
                                </div>

                                <div class="denuncia-aprovacao">
                                    <p> Dra Juliana </p>
                                    <p> CRP 09/22908108 </p>
                                    <p> 2h </p>
                                </div>

                                <div class="denuncia-aprovacao">
                                    <p> Dra Juliana </p>
                                    <p> CRP 09/22908108 </p>
                                    <p> 2h </p>
                                </div>

                                <a href="" >
                                    <h1 class="btn-dashboard">Ver todas as Pendências</h1>
                                </a>
                                 
                            </div>


                            <div class="esquerda">
                               
                                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                    <script type="text/javascript">
                                        google.charts.load('current', {'packages':['corechart']});
                                        google.charts.setOnLoadCallback(drawChart);

                                        function drawChart() {
                                            var data = google.visualization.arrayToDataTable([
                                            ['Year', 'Sales', 'Expenses'],
                                            ['2004',  1000,      400],
                                            ['2005',  1170,      460],
                                            ['2006',  660,       1120],
                                            ['2007',  1030,      540]
                                            ]);

                                            var options = {
                                            title: 'Company Performance',
                                            curveType: 'function',
                                            legend: { position: 'bottom' }
                                            };

                                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                                            chart.draw(data, options);
                                        }
                                    </script>
                                    <div class="grafico" id="curve_chart" style="width: 900px; height: 500px"></div>

                  

                                <div class="revisao-conteudo">
                                    <div>
                                        <img src="{{ asset('images/file-detail red.png') }}" alt="">
                                    </div>
                            
                                    <div>
                                            <h1>Conteudo aguardando revisão</h1>
                                            <h1>9</h1>
                                            <div class="sub-div-revisao">
                                                <div class="divisor">
                                                    <p>Artigos/Videos</p>
                                                    <p>aguardando moderação</p>
                                                </div>

                                                <div>
                                                    <p>5 artigos de profissionais</p>
                                                    <p>4 videos educativos</p>
                                                </div>
                                            </div>

                                    </div>

                                    <div class="isolar">
                                        <a href="" >
                                            <h1 class="btn-dashboard">Ir para conteudos</h1>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    

                    <div class="container-3">
                        <div class="bloco">
                            <div class="img-fundo">
                                <img src="{{ asset('images/clock.png') }}" alt="">
                            </div>
                            <div class="desc-bloco">
                                <h1>2h 45min</h1>
                                <p>Tempo médio de resposta e denúncias</p>
                            </div>
                        </div>

                        <div class="bloco">
                            <div class="img-fundo">
                                <img src="{{ asset('images/smile.png') }}" alt="">
                            </div>
                            <div class="desc-bloco">
                                <h1>4,6/5</h1>
                                <p>Satisfação das usuárias (Últimos 30 dias)</p>
                            </div>
                        </div>

                        <div class="bloco">
                            <div class="img-fundo">
                                <img src="{{ asset('images/flag-alt.png') }}" alt="">
                            </div>
                            <div class="desc-bloco">
                                <h1>23</h1>
                                <p>Denúncias pendentes </p>
                                <p>4 desde ontem</p>
                            </div>
                        </div>
                    </div>
                </div>
           </section>
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>