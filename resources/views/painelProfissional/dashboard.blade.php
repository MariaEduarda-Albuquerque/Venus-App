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
</head>

<body>

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

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                        <span>Caixa de Entrada</span>
                        <span class="nav-badge">5</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                        <span>Agenda</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5" /><path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6" /><circle cx="17" cy="9" r="2.8" /><path d="M15 14.2c2.7.4 5 2.4 5 5.8" /></svg>
                        <span>Pacientes</span>
                    </a>
                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Gestão</p>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5" /><rect x="14" y="3" width="7" height="7" rx="1.5" /><rect x="3" y="14" width="7" height="7" rx="1.5" /><rect x="14" y="14" width="7" height="7" rx="1.5" /></svg>
                        <span>Conteúdos</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20V10M12 20V4M20 20v-7" /></svg>
                        <span>Relatórios</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a8 8 0 1 1-3.2-6.4L21 4l-1 4.6c.6 1 1 2.2 1 3.4Z" /></svg>
                        <span>Fórum</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 8l10-5 10 5-10 5-10-5Z" /><path d="M6 11v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5" /></svg>
                        <span>Aprender</span>
                    </a>
                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Conta</p>

                    <a href="{{ url('user.perfil-profissional') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4" /><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" /></svg>
                        <span>Meu Perfil</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3" /><path d="M19 12a7 7 0 0 0-.1-1.2l2-1.6-2-3.4-2.4 1a7 7 0 0 0-2-1.2L14 3h-4l-.5 2.6a7 7 0 0 0-2 1.2l-2.4-1-2 3.4 2 1.6A7 7 0 0 0 5 12a7 7 0 0 0 .1 1.2l-2 1.6 2 3.4 2.4-1a7 7 0 0 0 2 1.2L10 21h4l.5-2.6a7 7 0 0 0 2-1.2l2.4 1 2-3.4-2-1.6c.1-.4.1-.8.1-1.2Z" /></svg>
                        <span>Configurações</span>
                    </a>

                    <a href="#" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M9.5 9.2a2.5 2.5 0 1 1 3.6 2.3c-.8.4-1.1 1-1.1 1.9" /><path d="M12 17h.01" /></svg>
                        <span>Suporte</span>
                    </a>
                </div>

            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <span class="avatar-circle">P</span>
                    <div class="sidebar-user-info">
                        <strong>Profissional</strong>
                        <span>Vênus</span>
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
                    <input type="text" placeholder="Buscar atendimentos, pacientes...">
                </div>

                <div class="topbar-right">
                    <svg class="topbar-bell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 8-3 8h18s-3-1-3-8" /><path d="M13.7 21a2 2 0 0 1-3.4 0" /></svg>

                    <div class="topbar-user">
                        <span class="avatar-circle">P</span>
                        <div class="topbar-user-info">
                            <strong>{{ $profissional->nomeProfissionalSaude }}</strong>
                        </div>
                    </div>
                </div>
            </header>

            <main class="page-content">

                <div class="page-header">
                    <div>
                        <h1>Boa tarde, Profissional</h1>
                        <p class="subtitle">Visão geral das suas atividades hoje.</p>
                    </div>
                    <a href="#" class="btn-primary-sm">+ Definir disponibilidade</a>
                </div>

                {{-- Cartões de indicadores (dados de exemplo) --}}
                <div class="stats-grid">

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                            Consultas hoje
                        </div>
                        <div class="stat-value">8</div>
                        <p class="stat-foot">+2 em relação a ontem</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                            Mensagens pendentes
                        </div>
                        <div class="stat-value">5</div>
                        <p class="stat-foot">2 aguardando há +2h</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l2.6 5.6 6.1.6-4.6 4 1.3 6-5.4-3.1-5.4 3.1 1.3-6-4.6-4 6.1-.6Z" /></svg>
                            Avaliação média
                        </div>
                        <div class="stat-value">4,9</div>
                        <p class="stat-foot">★★★★★</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-top">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="3.5" /><path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6" /><circle cx="17" cy="9" r="2.8" /><path d="M15 14.2c2.7.4 5 2.4 5 5.8" /></svg>
                            Usuárias atendidas
                        </div>
                        <div class="stat-value">142</div>
                        <p class="stat-foot">+18 esta semana</p>
                    </div>

                </div>

                {{-- Próximos atendimentos + fila de dúvidas (dados de exemplo) --}}
                <div class="dashboard-grid">

                    <div class="card">
                        <div class="card-head">
                            <h3>Próximos atendimentos</h3>
                            <a href="#">Ver agenda
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                            </a>
                        </div>

                        <div class="appointment-item">
                            <span class="appointment-time">14:30</span>
                            <div class="appointment-info">
                                <strong>Mariana Lima</strong>
                                <span>Consulta de rotina</span>
                            </div>
                            <div class="appointment-actions">
                                <span class="badge-status agendada">Agendada</span>
                                <a href="#" class="btn-mini">Entrar</a>
                            </div>
                        </div>

                        <div class="appointment-item">
                            <span class="appointment-time">15:30</span>
                            <div class="appointment-info">
                                <strong>Juliana Santos</strong>
                                <span>Dúvida rápida</span>
                            </div>
                            <div class="appointment-actions">
                                <span class="badge-status duvida">Dúvida rápida</span>
                                <a href="#" class="btn-mini">Entrar</a>
                            </div>
                        </div>

                        <div class="appointment-item">
                            <span class="appointment-time">16:00</span>
                            <div class="appointment-info">
                                <strong>Carla Oliveira</strong>
                                <span>Retorno</span>
                            </div>
                            <div class="appointment-actions">
                                <span class="badge-status agendada">Agendada</span>
                                <a href="#" class="btn-mini">Entrar</a>
                            </div>
                        </div>

                        <div class="appointment-item">
                            <span class="appointment-time">16:30</span>
                            <div class="appointment-info">
                                <strong>Fernanda Rocha</strong>
                                <span>Primeira consulta</span>
                            </div>
                            <div class="appointment-actions">
                                <span class="badge-status agendada">Agendada</span>
                                <a href="#" class="btn-mini">Entrar</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h3>Fila de dúvidas rápidas</h3>
                            <a href="#">Ver todas
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                            </a>
                        </div>

                        <div class="queue-item">
                            <span class="avatar-circle">A</span>
                            <div class="queue-info">
                                <strong>Ana Beatriz</strong>
                                <span>Aguardando resposta</span>
                            </div>
                            <span class="queue-time">3m</span>
                        </div>

                        <div class="queue-item">
                            <span class="avatar-circle">C</span>
                            <div class="queue-info">
                                <strong>Camila Ferreira</strong>
                                <span>Aguardando resposta</span>
                            </div>
                            <span class="queue-time">7m</span>
                        </div>

                        <div class="queue-item">
                            <span class="avatar-circle">M</span>
                            <div class="queue-info">
                                <strong>Mariana Souza</strong>
                                <span>Aguardando resposta</span>
                            </div>
                            <span class="queue-time">15m</span>
                        </div>
                    </div>

                </div>

                {{-- Gráfico semanal + avaliações (dados de exemplo) --}}
                <div class="dashboard-grid">

                    <div class="card">
                        <div class="card-head">
                            <h3>Atendimentos por semana</h3>
                        </div>

                        <div class="chart-bars">
                            <div class="chart-bar-col"><div class="chart-bar" style="height: 40%;"></div><span class="chart-bar-label">Sem 1</span></div>
                            <div class="chart-bar-col"><div class="chart-bar" style="height: 55%;"></div><span class="chart-bar-label">Sem 2</span></div>
                            <div class="chart-bar-col"><div class="chart-bar" style="height: 48%;"></div><span class="chart-bar-label">Sem 3</span></div>
                            <div class="chart-bar-col"><div class="chart-bar" style="height: 70%;"></div><span class="chart-bar-label">Sem 4</span></div>
                            <div class="chart-bar-col"><div class="chart-bar" style="height: 62%;"></div><span class="chart-bar-label">Sem 5</span></div>
                            <div class="chart-bar-col"><div class="chart-bar" style="height: 80%;"></div><span class="chart-bar-label">Sem 6</span></div>
                            <div class="chart-bar-col"><div class="chart-bar" style="height: 90%;"></div><span class="chart-bar-label">Sem 7</span></div>
                            <div class="chart-bar-col"><div class="chart-bar" style="height: 100%;"></div><span class="chart-bar-label">Sem 8</span></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h3>Avaliações recentes</h3>
                        </div>

                        <div class="review-item">
                            <div class="review-stars">★★★★★</div>
                            <p>"Me senti acolhida e consegui entender minhas opções sem julgamento."</p>
                        </div>

                        <div class="review-item">
                            <div class="review-stars">★★★★★</div>
                            <p>"Resposta clara e rápida. Muito obrigada."</p>
                        </div>
                    </div>

                </div>

                <div class="promo-banner">
                    <div>
                        <strong>Novidade na Vênus</strong>
                        <span>Aproveite as ferramentas que preparamos para facilitar o seu dia a dia.</span>
                    </div>
                    <a href="#">Conhecer recurso
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                    </a>
                </div>

            </main>

        </div>

    </div>

</body>

</html>