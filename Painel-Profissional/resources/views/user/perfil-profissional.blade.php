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
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/preferencias.js?v=2') }}"></script>
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

                    <a href="{{ url('user.perfil-profissional') }}" class="nav-item active">
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
                <span class="breadcrumb">Vênus / <strong>Meu Perfil</strong></span>

                <div class="topbar-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                    <input type="text" placeholder="Buscar conteúdo, categorias...">
                </div>

                <div class="topbar-right">
                    <a href="{{ route('feedback.index') }}" style="display: inline-flex; align-items: center; text-decoration: none; color: inherit;" title="Feedback da moderação">
                        <svg class="topbar-bell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 8-3 8h18s-3-1-3-8" /><path d="M13.7 21a2 2 0 0 1-3.4 0" /></svg>
                    </a>

                    
                    <div class="topbar-user">
                        <div class="avatar-circle" style="margin: 0 auto 10px;">
                            @if (!empty($profissional->fotoPerfilProfissional))
                                <img 
                                    class="avatar-circle avatar-lg"
                                    src="{{ asset('storage/' . $profissional->fotoPerfilProfissional) }}"
                                    alt="Foto do profissional"
                                >
                            @else
                                <span class="avatar-circle avatar-lg">
                                    {{ $inicial }}
                                </span>
                            @endif
                        </div>
                        <div class="topbar-user-info">
                            <a href="{{ url('user.perfil-profissional') }}" style="text-decoration: none;">
                                <strong>{{ $profissional->nomeProfissionalSaude }}</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="page-content pf-page">

                @if (session('sucesso'))
                    <div class="toast-sucesso" id="toastSucesso" role="status">
                        <span class="toast-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5" /></svg>
                        </span>
                        <span>{{ session('sucesso') }}</span>
                        <button type="button" class="toast-fechar" onclick="fecharToast()" aria-label="Fechar">&times;</button>
                    </div>
                @endif

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

                <div class="pf-grid">

                    {{-- ============ COLUNA PRINCIPAL ============ --}}
                    <div class="pf-main">

                        {{-- Hero --}}
                        <section class="pf-card">
                            <div class="pf-cover"></div>
                            <div class="pf-hero">
                                <div class="pf-hero-row">
                                    <div class="pf-avatar-wrap">
                                        @if (!empty($profissional->fotoPerfilProfissional))
                                            <img class="pf-avatar" src="{{ asset('storage/' . $profissional->fotoPerfilProfissional) }}" alt="Foto do profissional">
                                        @else
                                            <span class="pf-avatar">{{ $inicial }}</span>
                                        @endif

                                        <div class="pf-photo-help">
                                            <a href="{{ url('user.update-profissional') }}" class="btn-outline-sm">Trocar foto</a>
                                            <small>JPG ou PNG, até 5MB</small>
                                        </div>
                                    </div>

                                    <div class="pf-actions">
                                        <a href="{{ url('user.mudar-senha') }}" class="btn-outline-sm">Trocar senha</a>
                                        <a href="{{ url('user.update-profissional') }}" class="btn-primary-sm">Editar perfil</a>
                                    </div>
                                </div>

                                <div class="pf-identity">
                                    <h2>{{ $profissional->nomeProfissionalSaude }}</h2>
                                    <div class="pf-identity-meta">
                                        @if (!empty($profissional->especialidadeProfissionalSaude))
                                            <span class="pf-chip">{{ $profissional->especialidadeProfissionalSaude }}</span>
                                        @endif
                                        <span class="pf-chip pf-chip--ok">Verificado</span>
                                    </div>
                                    <p>Estas informações aparecem no seu perfil público.</p>
                                </div>
                            </div>
                        </section>

                        {{-- Contato --}}
                        <section class="pf-card pf-section">
                            <h3 class="pf-section-title">Contato e documento</h3>
                            <dl class="pf-fields">
                                <div class="pf-field pf-field--full">
                                    <dt>Email</dt>
                                    <dd>{{ $profissional->emailProfissionalSaude }}</dd>
                                </div>
                                <div class="pf-field">
                                    <dt>Telefone</dt>
                                    <dd data-formato="telefone" class="{{ empty($profissional->telProfissionalSaude) ? 'is-empty' : '' }}">{{ $profissional->telProfissionalSaude ?? '-' }}</dd>
                                </div>
                                <div class="pf-field">
                                    <dt>CPF ou CNPJ</dt>
                                    <dd class="{{ empty($profissional->nrFiscalProfissional) ? 'is-empty' : '' }}">{{ $profissional->nrFiscalProfissional ?? '-' }}</dd>
                                </div>
                            </dl>
                        </section>

                        {{-- Localização --}}
                        <section class="pf-card pf-section">
                            <h3 class="pf-section-title">Localização</h3>
                            <dl class="pf-fields">
                                <div class="pf-field">
                                    <dt>CEP</dt>
                                    <dd data-formato="cep" class="{{ empty($profissional->cepProfissional) ? 'is-empty' : '' }}">{{ $profissional->cepProfissional ?? '-' }}</dd>
                                </div>
                                <div class="pf-field">
                                    <dt>UF</dt>
                                    <dd class="{{ empty($profissional->ufProfissional) ? 'is-empty' : '' }}">{{ $profissional->ufProfissional ?? '-' }}</dd>
                                </div>
                                <div class="pf-field">
                                    <dt>Cidade</dt>
                                    <dd class="{{ empty($profissional->cidadeProfissional) ? 'is-empty' : '' }}">{{ $profissional->cidadeProfissional ?? '-' }}</dd>
                                </div>
                                <div class="pf-field">
                                    <dt>País</dt>
                                    <dd class="{{ empty($profissional->paisProfissional) ? 'is-empty' : '' }}">{{ $profissional->paisProfissional ?? '-' }}</dd>
                                </div>
                                <div class="pf-field">
                                    <dt>Rua</dt>
                                    <dd class="{{ empty($profissional->ruaProfissional) ? 'is-empty' : '' }}">{{ $profissional->ruaProfissional ?? '-' }}</dd>
                                </div>
                                <div class="pf-field">
                                    <dt>Número</dt>
                                    <dd class="{{ empty($profissional->numeroProfissional) ? 'is-empty' : '' }}">{{ $profissional->numeroProfissional ?? '-' }}</dd>
                                </div>
                                <div class="pf-field pf-field--full">
                                    <dt>Complemento</dt>
                                    <dd class="{{ empty($profissional->complementoProfissional) ? 'is-empty' : '' }}">{{ $profissional->complementoProfissional ?? '-' }}</dd>
                                </div>
                            </dl>
                        </section>

                        {{-- Atuação --}}
                        <section class="pf-card pf-section">
                            <h3 class="pf-section-title">Atuação profissional</h3>
                            <dl class="pf-fields">
                                <div class="pf-field">
                                    <dt>Categoria profissional</dt>
                                    <dd>{{ $profissional->categoriaProfissional }}</dd>
                                </div>
                                <div class="pf-field">
                                    <dt>Especialidade</dt>
                                    <dd class="{{ empty($profissional->especialidadeProfissionalSaude) ? 'is-empty' : '' }}">{{ $profissional->especialidadeProfissionalSaude ?? '-' }}</dd>
                                </div>
                                <div class="pf-field pf-field--full">
                                    <dt>Apresentação profissional</dt>
                                    <dd class="{{ empty($profissional->apresentacaoProfissional) ? 'is-empty' : '' }}">{{ $profissional->apresentacaoProfissional ?? '-' }}</dd>
                                </div>
                            </dl>
                        </section>

                        {{-- Desativar conta --}}
                        <div class="pf-danger">
                            <span>Ao desativar, seu perfil deixa de aparecer para as usuárias.</span>
                            <button type="button" class="link-danger" onclick="abrirModal()">Desativar conta</button>
                        </div>

                    </div>

                    {{-- ============ PRÉVIA PÚBLICA ============ --}}
                    <aside class="pf-side">
                        <div class="pf-card pf-preview">
                            <div class="pf-cover"></div>

                            <p class="pf-preview-label">
                                Prévia do perfil
                                <strong>Como a usuária verá você</strong>
                            </p>

                            @if (!empty($profissional->fotoPerfilProfissional))
                                <img class="pf-avatar" src="{{ asset('storage/' . $profissional->fotoPerfilProfissional) }}" alt="Foto do profissional">
                            @else
                                <span class="pf-avatar">{{ $inicial }}</span>
                            @endif

                            <span class="pf-chip pf-chip--ok">Verificado</span>

                            <p class="pf-preview-name">{{ $profissional->nomeProfissionalSaude }}</p>
                            <p class="pf-preview-spec">{{ $profissional->especialidadeProfissionalSaude }}</p>

                            @if (!empty($profissional->apresentacaoProfissional))
                                <p class="pf-preview-bio">{{ $profissional->apresentacaoProfissional }}</p>
                            @endif
                        </div>
                    </aside>

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
        function fecharToast() {
            var toast = document.getElementById('toastSucesso');
            if (!toast) return;
            toast.classList.add('saindo');
            setTimeout(function () { toast.remove(); }, 300);
        }

        // Some sozinho depois de 5 segundos
        if (document.getElementById('toastSucesso')) {
            setTimeout(fecharToast, 5000);
        }
        
        function abrirModal() {
            document.getElementById('modalDesativar').style.display = 'flex';
        }

        function fecharModal() {
            document.getElementById('modalDesativar').style.display = 'none';
        }
    </script>

    <script>
        // Exibe telefone e CEP formatados
        document.querySelectorAll('[data-formato]').forEach(function (el) {
            var d = el.textContent.replace(/\D/g, '');
            if (!d) return;
            if (el.dataset.formato === 'telefone' && (d.length === 10 || d.length === 11)) {
                var corte = d.length === 11 ? 7 : 6;
                el.textContent = '(' + d.slice(0, 2) + ') ' + d.slice(2, corte) + '-' + d.slice(corte);
            } else if (el.dataset.formato === 'cep' && d.length === 8) {
                el.textContent = d.slice(0, 5) + '-' + d.slice(5);
            }
        });
    </script>

</body>

</html>