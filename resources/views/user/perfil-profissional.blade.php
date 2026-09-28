<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    @php
        $inicial = strtoupper(substr($profissional->nomeProfissional ?? 'P', 0, 1));
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

                    <a href="{{ url('user.perfil-profissional') }}" class="nav-item active">
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
                    <span class="avatar-circle">{{ $inicial }}</span>
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
                <span class="breadcrumb">Vênus / <strong>Meu Perfil</strong></span>

                <div class="topbar-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                    <input type="text" placeholder="Buscar atendimentos, pacientes...">
                </div>

                <div class="topbar-right">
                    <svg class="topbar-bell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 8-3 8h18s-3-1-3-8" /><path d="M13.7 21a2 2 0 0 1-3.4 0" /></svg>

                    <div class="topbar-user">
                        <span class="avatar-circle">{{ $inicial }}</span>
                        <div class="topbar-user-info">
                            <strong>{{ $profissional->nomeProfissionalSaude }}</strong>
                        </div>
                    </div>
                </div>
            </header>

            <main class="page-content">

                <div class="page-header">
                    <div>
                        <h1>Meu Perfil</h1>
                        <p class="subtitle">Dados públicos exibidos para as usuárias.</p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('erro'))
                    <div class="alert-error">
                        {{ session('erro') }}
                    </div>
                @endif

                <div class="profile-grid">

                    {{-- ===================== DADOS DO PERFIL (SOMENTE LEITURA) ===================== --}}
                    <div class="profile-card">

                        <div class="profile-card-head">
                            <div>
                                <h2>{{ $profissional->nomeProfissionalSaude }}</h2>
                                <p>Dados profissionais &middot; Estas informações aparecem no perfil público.</p>
                            </div>

                            <div class="profile-actions">
                                <a href="{{ url('user.mudar-senha') }}" class="btn-outline-sm">Trocar senha</a>
                                <a href="{{ url('user.update-profissional') }}" class="btn-outline-sm">Editar perfil</a>
                            </div>
                        </div>

                        <div class="avatar-row">
                            <span class="avatar-circle avatar-lg">{{ $inicial }}</span>
                            <div class="avatar-row-info">
                                <a href="{{ url('user.update-profissional') }}" class="btn-outline-sm">Trocar foto</a>
                                <span>JPG ou PNG &middot; até 5MB</span>
                            </div>
                        </div>

                        <div class="field-view" style="margin-bottom: 20px;">
                            <div>
                                <label>Email</label>
                                <div class="field-display">{{ $profissional->emailProfissionalSaude }}</div>
                            </div>
                        </div>

                        <div class="field-grid-2 field-view">
                            <div>
                                <label>Telefone</label>
                                <div class="field-display">{{ $profissional->telProfissionalSaude ?? '-' }}</div>
                            </div>

                            <div>
                                <label>CPF ou CNPJ</label>
                                <div class="field-display">{{ $profissional->nrFiscalProfissional ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="field-grid-2 field-view">
                            <div>
                                <label>CEP</label>
                                <div class="field-display">{{ $profissional->cepProfissional ?? '-' }}</div>
                            </div>
                            <div>
                                <label>UF</label>
                                <div class="field-display">{{ $profissional->ufProfissional ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="field-grid-2 field-view">
                            <div>
                                <label>País</label>
                                <div class="field-display">{{ $profissional->paisProfissional ?? '-' }}</div>
                            </div>
                            <div>
                                <label>Cidade</label>
                                <div class="field-display">{{ $profissional->cidadeProfissional ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="field-grid-2 field-view">
                            <div>
                                <label>Categoria Profissional</label>
                                <div class="field-display">{{ $profissional->categoriaProfissional }}</div>
                            </div>
                            <div>
                                <label>Especialidade</label>
                                <div class="field-display">{{ $profissional->especialidadeProfissionalSaude ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="field-view" style="margin-bottom: 20px;">
                            <label>Apresentação profissional</label>
                            <div class="field-display" style="white-space: pre-line;">{{ $profissional->apresentacaoProfissional ?? '-' }}</div>
                        </div>

                        <div class="danger-zone">
                            <button type="button" class="link-danger" onclick="abrirModal()">Desativar conta</button>
                        </div>

                    </div>

                    {{-- ===================== PRÉVIA DO PERFIL PÚBLICO ===================== --}}
                    <div class="preview-card">
                        <p class="preview-card-head">
                            Prévia do perfil
                            <strong>Como a usuária verá você</strong>
                        </p>

                        <span class="avatar-circle avatar-lg" style="margin: 0 auto 10px;">{{ $inicial }}</span>

                        <div class="preview-verified">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M8 12.5l2.5 2.5L16 9.5" /></svg>
                            Verificado
                        </div>

                        <p class="preview-name">{{ $profissional->nomeProfissionalSaude }}</p>
                        <p class="preview-specialty">{{ $profissional->especialidadeProfissionalSaude }}</p>
                        <p class="preview-bio">{{ $profissional->apresentacaoProfissional }}</p>
                    </div>

                </div>

            </main>

        </div>

    </div>

    {{-- ===================== MODAL DESATIVAR CONTA ===================== --}}
    <div id="modalDesativar" class="modal-overlay" style="display: none;">
        <div class="modal-box">
            <h2>Desativar conta</h2>
            <p>Tem certeza que deseja desativar sua conta?</p>

            <div class="modal-actions">
                <button type="button" class="btn-outline-sm" onclick="fecharModal()" style="justify-content: center;">Cancelar</button>

                <form action="{{ route('conta.desativar') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-danger">Sim, desativar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function abrirModal() {
            document.getElementById('modalDesativar').style.display = 'flex';
        }

        function fecharModal() {
            document.getElementById('modalDesativar').style.display = 'none';
        }
    </script>

</body>

</html>