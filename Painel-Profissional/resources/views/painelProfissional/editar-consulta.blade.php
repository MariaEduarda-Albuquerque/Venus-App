<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar consulta | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/preferencias.js') }}"></script>
</head>

<body>

    @php
        $inicial = strtoupper(substr($profissional->nomeProfissionalSaude ?? 'P', 0, 1));
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

                    <a href="{{ url('/dashboard') }}" class="nav-item">
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
                <span class="breadcrumb">Vênus / <a href="{{ route('agenda.index') }}" style="color: inherit; text-decoration: none;">Agenda</a> / <strong>Editar consulta</strong></span>

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


            <main class="page-content ag-page">

                <div class="page-header">
                    <div>
                        <h1>Editar consulta</h1>
                        <p class="subtitle">Altere os dados do atendimento com {{ $nomePaciente }}.</p>
                    </div>
                </div>

                <section class="ag-card ec-card">
                    <form method="POST" action="{{ route('agenda.consultas.atualizar', $consulta->codConsulta) }}" novalidate>
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert-error">
                                <ul>
                                    @foreach ($errors->all() as $erro)
                                        <li>{{ $erro }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="field">
                            <label>Paciente</label>
                            <input type="text" value="{{ $nomePaciente }}" disabled>
                        </div>

                        <div class="field">
                            <label for="ecTitulo">Título</label>
                            <input type="text" id="ecTitulo" name="nomeConsulta" maxlength="120" value="{{ old('nomeConsulta', $consulta->nomeConsulta) }}">
                        </div>

                        <div class="field-row-2">
                            <div class="field">
                                <label for="ecTipo">Tipo de atendimento</label>
                                <select id="ecTipo" name="tipoConsulta">
                                    @foreach ($tiposLista as $valor => $rotulo)
                                        <option value="{{ $valor }}" @selected(old('tipoConsulta', $consulta->tipoConsulta) == $valor)>{{ $rotulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label for="ecStatus">Status</label>
                                <select id="ecStatus" name="statusConsulta">
                                    @foreach ($statusLista as $valor => $rotulo)
                                        <option value="{{ $valor }}" @selected(old('statusConsulta', $consulta->statusConsulta) == $valor)>{{ $rotulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="field-row-2">
                            <div class="field">
                                <label for="ecData">Data</label>
                                <input type="date" id="ecData" name="data" value="{{ old('data', optional($consulta->dataHoraAgendada)->format('Y-m-d')) }}">
                            </div>
                            <div class="field">
                                <label for="ecHora">Horário</label>
                                <input type="time" id="ecHora" name="hora" value="{{ old('hora', optional($consulta->dataHoraAgendada)->format('H:i')) }}">
                            </div>
                        </div>

                        <div class="field">
                            <label for="ecObs">Observações do atendimento</label>
                            <textarea id="ecObs" name="historicoConsulta" rows="5" maxlength="2000" placeholder="Resumo ou orientações passadas nesta consulta...">{{ old('historicoConsulta', $consulta->historicoConsulta) }}</textarea>
                        </div>

                        <div class="ag-modal-actions ec-acoes">
                            <a href="{{ route('agenda.index', ['semana' => optional($consulta->dataHoraAgendada)->format('Y-m-d')]) }}" class="btn-outline-sm">Cancelar</a>
                            <button type="submit" class="btn-primary-sm">Salvar alterações</button>
                        </div>
                    </form>
                </section>

            </main>

        </div>

    </div>

</body>

</html>
