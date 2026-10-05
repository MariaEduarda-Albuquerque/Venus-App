
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Vênus</title>
    <link rel="stylesheet" href="{{ asset('css/adm.css') }}">
</head>
<body>

    @include('layouts.sidebar')

    <div class="direita">

    @include('layouts.barra-pesquisa')

           <section>
                <div class="Container-Global">
                    <div class="conteudo">
                        <h1>Painel Administrativo</h1>

                        <div class="dataHoje">
                            <img src="{{ asset('images/calendario.png') }}" alt="">
                            <p>23 de Maio de 2026</p>
                        </div>
                    </div>

                    <div class="alerta-denuncia-container">
                        <img src="{{asset('images/alert-octagon.png')}}" alt="">
                        <h1>Atenção:</h1>
                        <p>existem 3 denúncias de gravidade alta pendentes há mais de 24 horas.</p>
                        <div class="btn-alerta-denuncias-container">
                            <a href="" class="btn-alerta-denuncias">
                                <h2>Ver denúncias</h2>
                            </a>
                        </div>
                        
                    </div>

                    <div class="container-1">
                        <div class="bloco">
                            <div class="img-fundo">
                                <img src="{{ asset('images/woman.png') }}" alt="">
                            </div>
                            <div class="desc-bloco">
                                 <h1>1902</h1>
                                <p>Usuárias ativas</p>
                                <p>8,2% ultimo mês</p>
                            </div>
                        </div>

                        <div class="bloco">
                            <div class="img-fundo">
                                <img src="{{ asset('images/face-mask.png') }}" alt="">
                            </div>
                            <div class="desc-bloco">
                                 <h1>802</h1>
                                <p>Profissionais ativas</p>
                                <p>5,6% ultimo mês</p>
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
                        <div class="container2-direita">
                           
                            <div class="titulo-direita">
                                <h1>Fila prioritária</h1>
                                <h2>Denúncias de alta gravidade</h2>
                            </div>

                            <div class="denuncia-aprovacao">
                                <p>Envio de fake news na...</p>
                                <div class="direita-denuncias">
                                    <div class="h1-com-fundo">
                                        <h1 class="denuncia-aprovacao-tipo">Fórum</h1>
                                    </div>
                                    <p>22h</p>
                                </div>
                            </div>

                            <div class="denuncia-aprovacao">
                                <p>Envio de fake news na...</p>
                                <div class="direita-denuncias">
                                    <div class="h1-com-fundo">
                                        <h1 class="denuncia-aprovacao-tipo">Perfil</h1>
                                    </div>
                                    <p>26h</p>
                                </div>
                            </div>

                            <div class="denuncia-aprovacao">
                                <p>Envio de fake news na...</p>
                                <div class="direita-denuncias">
                                    <div class="h1-com-fundo">
                                        <h1 class="denuncia-aprovacao-tipo">Chat</h1>
                                    </div>
                                    <p>48h</p>
                                </div>
                            </div>
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
                               
                                <div class="grafico-container">
                                    <div class="titulo-subtitulo-grafico">
                                        <h2>Novos Cadastros (usuárias e profissionais)</h2>
                                        <p>Últimas 8 semanas</p>
                                    </div>

                                    <canvas id="meuGrafico"></canvas>
                                </div>

                                <div class="revisao-conteudo">
                                    <div>
                                        <img src="{{ asset('images/file-detail red.png') }}" alt="">
                                    </div>
                            
                                    <div>
                                            <h1 class="titulo-conteudo-revisao">Conteudo aguardando revisão</h1>
                                            <h1 class="destaque-h1-revisao">9</h1>
                                            <div class="sub-div-revisao">
                                                <div>
                                                    <p>Artigos/Videos</p>
                                                    <p>aguardando moderação</p>
                                                </div>

                                                <hr>

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
                    

                    <div class="container-1">
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>