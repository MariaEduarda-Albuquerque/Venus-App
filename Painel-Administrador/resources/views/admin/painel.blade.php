
@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.sidebar')

@section('title', 'Painel Administrativo')


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')

    <div class="vns-painel">


        <header class="vns-header">
            <h1 class="vns-titulo-pagina">Painel Administrativo</h1>

            <div class="vns-data">
                <svg class="vns-icone-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="5" width="18" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/>
                    <path d="M3 9H21" stroke="currentColor" stroke-width="1.6"/>
                    <path d="M8 3V6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    <path d="M16 3V6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
                {{-- futuramente: {{ now()->translatedFormat('d \d\e F \d\e Y') }} --}}
                <span>23 de maio de 2026</span>
            </div>
        </header>

        {{-- futuramente: @if($denunciasGravidadeAltaPendentes > 0) --}}
        <div class="vns-alerta vns-alerta--danger">
            <div class="vns-alerta-texto">
                <svg class="vns-icone-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/>
                    <path d="M12 8V13" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    <circle cx="12" cy="16.2" r="0.9" fill="currentColor"/>
                </svg>
                <span>
                    <strong>Atenção:</strong>
                    existem <strong>{{$totalDenunciasUltimas24h}}</strong> denúncias de gravidade alta pendentes há mais de 24 horas.
                </span>
            </div>
        </div>
        {{-- @endif --}}


        <div class="vns-grid-estat vns-grid-estat--3">

            <div class="vns-card vns-card-estat">
                <div class="vns-card-icone">
                    <svg class="vns-icone-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="8" r="3.4" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M5.5 20c0-3.6 2.9-6.2 6.5-6.2s6.5 2.6 6.5 6.2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="vns-card-info">
                    {{-- futuramente: {{ number_format($totalUsuariasAtivas, 0, ',', '.') }} --}}
                    <span class="quantidade">{{$totalUsuarios}}</span>
                    <p class="vns-card-label">Usuárias Ativas</p>
                    <p class="vns-card-variacao vns-card-variacao--positiva">
                        <span class="vns-seta">&uarr;</span> 8,2% último mês
                    </p>
                </div>
            </div>

            <div class="vns-card vns-card-estat">
                <div class="vns-card-icone">
                    <svg class="vns-icone-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 21V13.5C8 12.1 9.1 11 10.5 11H13.5C14.9 11 16 12.1 16 13.5V21"
                              stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                        <circle cx="12" cy="6.5" r="3" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M4 21V16.8C4 15.8 4.8 15 5.8 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                        <path d="M20 21V16.8C20 15.8 19.2 15 18.2 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero">{{$totalProsissionais}}</span>
                    <p class="vns-card-label">Profissionais ativos</p>
                    <p class="vns-card-variacao vns-card-variacao--positiva">
                        <span class="vns-seta">&uarr;</span> 5,6% último mês
                    </p>
                </div>
            </div>

            <div class="vns-card vns-card-estat">
                <div class="vns-card-icone">
                    <svg class="vns-icone-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="9" r="3.2" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M3.5 20c0-3.3 2.5-5.7 5.5-5.7s5.5 2.4 5.5 5.7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                        <path d="M18 8V14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                        <path d="M15 11H21" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero">{{$profissionaisEmEspera}}</span>
                    <p class="vns-card-label">Cadastro aguardando aprovação</p>
                    <p class="vns-card-legenda">Profissional</p>
                </div>
            </div>

        </div>

        <div class="vns-grid-principal">

            <div class="vns-coluna">

                <div class="vns-card vns-card-lista">
                    <h2 class="vns-card-titulo vns-card-titulo--danger">Fila prioritária</h2>
                    <p class="vns-card-subtitulo">Denúncia de alta gravidade</p>

                    <ul class="vns-lista-fila">
                        @foreach($DenunciasAltaGravidade as $denuncia)
                        <li class="vns-item-fila">
                            <span class="vns-item-fila-texto">{{ Str::limit($denuncia->comentarioDenuncia, 22, '...') }}</span>
                             @if($denuncia->tipoAlvo == 'forum_publicacao' || $denuncia->tipoAlvo == 'forum_resposta')
                            <span class="vns-badge">Fórum</span>
                            @elseif($denuncia->tipoAlvo == 'mensagem_chat')
                            <span class="vns-badge">Chat</span>
                            @else
                            <span class="vns-badge">Perfil</span>
                            @endif
                            <span class="vns-item-fila-tempo">{{ \Carbon\Carbon::parse($denuncia->dataDenuncia)->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="vns-card vns-card-lista">
                    <h2 class="vns-card-titulo vns-card-titulo--danger">Aprovações de profissionais</h2>

                    <ul class="vns-lista-aprovacoes">
                        @foreach($profissionaisPendentes as $profissional)
                        <li class="vns-item-aprovacao">
                            <span class="vns-item-aprovacao-nome">{{$profissional->nomeProfissionalSaude}}</span>
                            <span class="vns-item-aprovacao-registro">CRP 06/123456</span>
                            <span class="vns-item-aprovacao-tempo">{{ \Carbon\Carbon::parse($profissional->dataAtualizacao)->diffForHumans() }}</span>
                        </li>
                        @endforeach
                    </ul>


                </div>

            </div>

            <div class="vns-coluna">

                <div class="vns-card vns-card-grafico">
                    <div class="vns-card-grafico-header">
                        <div>
                            <h2 class="vns-card-titulo">Novos cadastros (usuárias e profissionais)</h2>
                            <p class="vns-card-subtitulo">Últimas 8 semanas</p>
                        </div>

                        <div class="vns-legenda-grafico">
                            <span class="vns-legenda-item">
                                <span class="vns-legenda-cor vns-legenda-cor--claro"></span> Usuárias
                            </span>
                            <span class="vns-legenda-item">
                                <span class="vns-legenda-cor vns-legenda-cor--escuro"></span> Profissionais
                            </span>
                        </div>
                    </div>

                    {{-- Placeholder visual do gráfico. Futuramente: substituir por
                         Chart.js / ApexCharts, alimentado por $novosCadastrosUsuarias
                         e $novosCadastrosProfissionais. --}}
                    <div class="vns-grafico-placeholder">
                        <svg viewBox="0 0 700 260" preserveAspectRatio="none" class="vns-grafico-svg">
                            <line x1="40" y1="10" x2="40" y2="220" class="vns-grafico-eixo" />
                            <line x1="40" y1="220" x2="690" y2="220" class="vns-grafico-eixo" />

                            <text x="10" y="14" class="vns-grafico-eixo-label">1.000</text>
                            <text x="10" y="112" class="vns-grafico-eixo-label">750</text>
                            <text x="10" y="168" class="vns-grafico-eixo-label">500</text>
                            <text x="10" y="220" class="vns-grafico-eixo-label">0</text>

                            <polyline class="vns-linha-usuarias" fill="none"
                                points="60,150 140,120 220,155 300,135 380,110 460,105 540,115 620,75" />
                            <polyline class="vns-linha-profissionais" fill="none"
                                points="60,195 140,190 220,200 300,195 380,193 460,190 540,192 620,188" />

                            <g class="vns-pontos-usuarias">
                                <circle cx="60" cy="150" r="4" /><circle cx="140" cy="120" r="4" />
                                <circle cx="220" cy="155" r="4" /><circle cx="300" cy="135" r="4" />
                                <circle cx="380" cy="110" r="4" /><circle cx="460" cy="105" r="4" />
                                <circle cx="540" cy="115" r="4" /><circle cx="620" cy="75" r="4" />
                            </g>
                            <g class="vns-pontos-profissionais">
                                <circle cx="60" cy="195" r="4" /><circle cx="140" cy="190" r="4" />
                                <circle cx="220" cy="200" r="4" /><circle cx="300" cy="195" r="4" />
                                <circle cx="380" cy="193" r="4" /><circle cx="460" cy="190" r="4" />
                                <circle cx="540" cy="192" r="4" /><circle cx="620" cy="188" r="4" />
                            </g>
                        </svg>

                        <div class="vns-grafico-eixo-x">
                            <span>23/03</span><span>04/04</span><span>11/04</span><span>18/04</span>
                            <span>25/04</span><span>02/05</span><span>09/05</span><span>16/05</span>
                        </div>
                    </div>
                </div>

                <div class="vns-card vns-card-revisao">
                    <div class="vns-card-icone">
                        <svg class="vns-icone-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 3.5H14L18 7.5V20.5H7V3.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                            <path d="M14 3.5V7.5H18" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                            <path d="M9.5 12H15.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                            <path d="M9.5 15.5H15.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                        </svg>
                    </div>

                    <div class="vns-card-revisao-info">
                        <h2 class="vns-card-titulo">Conteúdo aguardando revisão</h2>
                        <span class="vns-card-numero">{{$conteudosAguardandoRevisao}}</span>
                        <p class="vns-card-legenda">
                            Artigos/Vídeos aguardando moderação
                            <br>
                            5 artigos de profissionais &middot; 4 vídeos educativos
                        </p>
                    </div>


                </div>

            </div>

        </div>

        <div class="vns-grid-estat vns-grid-estat--3 vns-grid-estat--rodape">

            <div class="vns-card vns-card-estat vns-card-estat--centro">
                <div class="vns-card-icone">
                    <svg class="vns-icone-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M12 7.5V12L15 14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero">2h 45min</span>
                    <p class="vns-card-label">Tempo médio de resposta e dúvidas</p>
                </div>
            </div>

            <div class="vns-card vns-card-estat vns-card-estat--centro">
                <div class="vns-card-icone">
                    <svg class="vns-icone-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M8.5 14.5C9.2 15.6 10.5 16.3 12 16.3C13.5 16.3 14.8 15.6 15.5 14.5"
                              stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                        <circle cx="9" cy="10" r="0.9" fill="currentColor"/>
                        <circle cx="15" cy="10" r="0.9" fill="currentColor"/>
                    </svg>
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero">4,6/5</span>
                    <p class="vns-card-label">Satisfação das usuárias (últimos 30 dias)</p>
                </div>
            </div>

            <div class="vns-card vns-card-estat vns-card-estat--centro">
                <div class="vns-card-icone">
                    <svg class="vns-icone-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 3.5V20.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                        <path d="M6 4.5H16L14 8L16 11.5H6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero">23</span>
                    <p class="vns-card-label">
                        Denúncias pendentes
                        <span class="vns-card-variacao vns-card-variacao--negativa">&uarr; 4 desde ontem</span>
                    </p>
                </div>
            </div>

        </div>

    </div>

@endsection