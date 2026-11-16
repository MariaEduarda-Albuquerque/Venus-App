<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/preferencias.js') }}"></script>
</head>

<body>

    @php
        $inicial = strtoupper(substr($profissional->nomeProfissionalSaude ?? 'P', 0, 1));

        // Dados do painel: se o controller não mandar, a própria tela busca pelo model
        $painel = $painel ?? \App\Models\Conteudo::resumoPainel(session('id'));

        // Cards de status (a ordem aqui é a ordem na tela)
        $cartoes = [
            'publicado'  => ['rotulo' => 'Publicados', 'icone' => '<circle cx="12" cy="12" r="9" /><path d="M8 12.5l2.5 2.5L16 9.5" />'],
            'em_revisao' => ['rotulo' => 'Em revisão',  'icone' => '<circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 2" />'],
            'rascunho'   => ['rotulo' => 'Rascunhos',   'icone' => '<path d="M12 20h9" /><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />'],
            'recusado'   => ['rotulo' => 'Recusados',   'icone' => '<circle cx="12" cy="12" r="9" /><path d="M15 9l-6 6M9 9l6 6" />'],
        ];
    @endphp

    <div class="app-shell">

        {{-- ===================== BARRA LATERAL ===================== --}}
        <aside class="sidebar">

            <div class="sidebar-brand">
                <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus" class="sidebar-logo">
                <span class="brand-text">Portal do<br>Profissional</span>
            </div>

            <nav class="sidebar-nav">

                <div class="nav-group">
                    <p class="nav-group-label">Principal</p>

                    <a href="{{ url('/dashboard') }}" class="nav-item active">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l9-8 9 8" /><path d="M5 10v10h14V10" /></svg>
                        <span>Painel</span>
                    </a>

                    <a href="{{ route('agenda.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                        <span>Agenda</span>
                    </a>
                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Gestão</p>

                    <a href="{{ route('conteudos.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5" /><rect x="14" y="3" width="7" height="7" rx="1.5" /><rect x="3" y="14" width="7" height="7" rx="1.5" /><rect x="14" y="14" width="7" height="7" rx="1.5" /></svg>
                        <span>Conteúdos</span>
                    </a>

                    <a href="{{ route('feedback.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H9l-5 4V5a1 1 0 0 1 1-1Z" /><path d="M8 9h8M8 12.5h5" /></svg>
                        <span>Feedback</span>
                    </a>

                    <a href="{{ route('relatorios.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20V10M12 20V4M20 20v-7" /></svg>
                        <span>Relatórios</span>
                    </a>

                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Conta</p>

                    <a href="{{ url('user.perfil-profissional') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4" /><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" /></svg>
                        <span>Meu Perfil</span>
                    </a>

                    <a href="{{ url('/configuracoes') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3" /><path d="M19 12a7 7 0 0 0-.1-1.2l2-1.6-2-3.4-2.4 1a7 7 0 0 0-2-1.2L14 3h-4l-.5 2.6a7 7 0 0 0-2 1.2l-2.4-1-2 3.4 2 1.6A7 7 0 0 0 5 12a7 7 0 0 0 .1 1.2l-2 1.6 2 3.4 2.4-1a7 7 0 0 0 2 1.2L10 21h4l.5-2.6a7 7 0 0 0 2-1.2l2.4 1 2-3.4-2-1.6c.1-.4.1-.8.1-1.2Z" /></svg>
                        <span>Configurações</span>
                    </a>

                    <a href="{{ url('/suporte') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M9.5 9.2a2.5 2.5 0 1 1 3.6 2.3c-.8.4-1.1 1-1.1 1.9" /><path d="M12 17h.01" /></svg>
                        <span>Suporte</span>
                    </a>
                </div>

            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user">
                    @if (!empty($profissional->fotoPerfilProfissional))
                        <img class="avatar-circle" src="{{ asset('storage/' . $profissional->fotoPerfilProfissional) }}" alt="Foto do profissional">
                    @else
                        <span class="avatar-circle">{{ $inicial }}</span>
                    @endif
                    <div class="sidebar-user-info">
                        <strong>{{ $profissional->nomeProfissionalSaude }}</strong>
                        <span>{{ $profissional->especialidadeProfissionalSaude }}</span>
                    </div>
                </div>

                <form action="/logout" method="post" class="sidebar-logout-form">
                    @csrf
                    <button type="submit" class="sidebar-logout-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><path d="M16 17l5-5-5-5" /><path d="M21 12H9" /></svg>
                        Sair
                    </button>
                </form>
            </div>

        </aside>

        {{-- ===================== CONTEÚDO ===================== --}}
        <div class="main-content">

            <header class="topbar">
                <span class="breadcrumb">Vênus / <strong>Painel</strong></span>

                <div class="topbar-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                    <input type="text" placeholder="Buscar conteúdo, categorias...">
                </div>

                <div class="topbar-right">
                    <a href="{{ route('feedback.index') }}" style="display: inline-flex; align-items: center; text-decoration: none; color: inherit;" title="Feedback da moderação">
                        <svg class="topbar-bell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 8-3 8h18s-3-1-3-8" /><path d="M13.7 21a2 2 0 0 1-3.4 0" /></svg>
                    </a>

                    <div class="topbar-user">
                        @if (!empty($profissional->fotoPerfilProfissional))
                            <img class="avatar-circle" src="{{ asset('storage/' . $profissional->fotoPerfilProfissional) }}" alt="Foto do profissional">
                        @else
                            <span class="avatar-circle">{{ $inicial }}</span>
                        @endif
                        <div class="topbar-user-info">
                            <a href="{{ url('user.perfil-profissional') }}" style="text-decoration: none;">
                                <strong>{{ $profissional->nomeProfissionalSaude }}</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="page-content dash-page">

                <div class="page-header">
                    <div>
                        <h1>Bem vinda(o), {{ $profissional->nomeProfissionalSaude }}</h1>
                        <p class="subtitle">Acompanhe o andamento e o alcance das suas publicações.</p>
                    </div>
                    <a href="{{ route('conteudos.index', ['criar' => 1]) }}" class="btn-primary-sm">+ Criar conteúdo</a>
                </div>

                {{-- ============ CARDS: CONTEÚDOS POR STATUS ============ --}}
                <div class="stats-grid">
                    @foreach ($cartoes as $chave => $info)
                        @php $n = $painel['status'][$chave] ?? 0; @endphp
                        <a href="{{ route('conteudos.index', ['status' => $chave]) }}" class="stat-card" title="Ver {{ mb_strtolower($info['rotulo']) }}">
                            <div class="stat-card-top">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $info['icone'] !!}</svg>
                                {{ $info['rotulo'] }}
                            </div>
                            <div class="stat-value">{{ $n }}</div>
                            <p class="stat-foot">{{ $painel['total'] > 0 ? round($n / $painel['total'] * 100) . '% do total' : 'Nenhum conteúdo ainda' }}</p>
                        </a>
                    @endforeach
                </div>

                {{-- ============ GRÁFICOS (aparecem mesmo vazios) ============ --}}
                <div class="dashboard-grid">

                    {{-- 1) Publicações por mês --}}
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <h3>Publicações por mês</h3>
                                <p>Conteúdos criados ou publicados nos últimos 6 meses</p>
                            </div>
                        </div>
                        <div id="chartMeses" class="chart-box"></div>
                    </div>

                    {{-- 2) Conteúdos por categoria --}}
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <h3>Conteúdos por categoria</h3>
                                <p>Distribuição dos seus conteúdos</p>
                            </div>
                        </div>
                        <div id="chartCategorias" class="chart-box"></div>
                    </div>

                </div>

                <div class="dashboard-grid">

                    {{-- 3) Alcance por conteúdo --}}
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <h3>Alcance por conteúdo</h3>
                                <p>Visualizações e curtidas dos 5 conteúdos publicados com mais alcance</p>
                            </div>
                        </div>
                        <div id="chartAlcance" class="chart-box"></div>
                    </div>

                    {{-- 4) Taxa de aprovação --}}
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <h3>Taxa de aprovação</h3>
                                <p>Publicados ÷ enviados para revisão</p>
                            </div>
                        </div>
                        <div id="chartAprovacao" class="chart-box"></div>
                    </div>

                </div>

            </main>

        </div>

    </div>

    {{-- ============ DADOS PARA OS GRÁFICOS (PASSADOS PRO JS) ============ --}}
    <script>
        window.dashboardData = {
            porMes: @json($painel['porMes']),
            porCategoria: @json($painel['porCategoria']),
            alcance: @json($painel['alcance']),
            aprovacao: {
                taxa: @json($painel['taxaAprovacao']),
                publicados: @json($painel['status']['publicado'] ?? 0),
                enviados: @json($painel['enviados'])
            }
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
    <script src="{{ asset('js/dashboard-graficos.js') }}"></script>

</body>

</html>