<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

                <form action="{{ route('perfil.atualizar') }}" method="POST" id="formEditarPerfil">
                    @csrf
                    @method('PUT')

                    <div class="page-header">
                        <div>
                            <h1>Editar Perfil</h1>
                            <p class="subtitle">Atualize seus dados públicos e profissionais.</p>
                        </div>

                        <div class="profile-actions">
                            <a href="{{ url('user.perfil-profissional') }}" class="btn-outline-sm">Voltar</a>
                            <a href="{{ url('user.mudar-senha') }}" class="btn-outline-sm">Trocar senha</a>
                            <button type="submit" class="btn-primary-sm">Salvar alterações</button>
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

                    <div class="profile-grid">

                        {{-- ===================== FORMULÁRIO ===================== --}}
                        <div class="profile-card">

                            <div class="profile-card-head">
                                <div>
                                    <h2>Dados pessoais e profissionais</h2>
                                    <p>Essas informações aparecem no seu perfil público.</p>
                                </div>
                            </div>

                            <div class="avatar-row">
                                <span class="avatar-circle avatar-lg">{{ $inicial }}</span>
                                <div class="avatar-row-info">
                                    <label for="fotoPerfil" class="btn-outline-sm" style="cursor: pointer;">Trocar foto</label>
                                    <input type="file" name="fotoPerfil" id="fotoPerfil" accept="image/*" valeu="{{ $profissional->fotoPerfilProfissional }}" style="position: absolute; width: 1px; height: 1px; opacity: 0;">
                                    <span>JPG ou PNG &middot; até 5MB</span>
                                </div>
                            </div>

                            <div class="field-row-2">
                                <div class="field">
                                    <label for="nome">Nome</label>
                                    <input type="text" name="nome" id="nome" value="{{ $profissional->nomeProfissionalSaude }}">
                                </div>
                                <div class="field">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email" value="{{ $profissional->emailProfissionalSaude }}">
                                </div>
                            </div>

                            <div class="field">
                                <label for="telefone">Telefone</label>
                                <input type="text" name="telefone" id="telefone" value="{{ $profissional->telProfissionalSaude }}">
                            </div>

                            <div class="field-row-2">
                                <div class="field">
                                    <label for="categoria">Categoria</label>

                                    <select name="categoria" id="categoria">
                                        <option value="">Selecione</option>

                                        <option value="Médico"
                                            {{ $profissional->categoriaProfissional == 'Médico' ? 'selected' : '' }}>
                                            Médica
                                        </option>

                                        <option value="Enfermeiro"
                                            {{ $profissional->categoriaProfissional == 'Enfermeiro' ? 'selected' : '' }}>
                                            Enfermeira
                                        </option>

                                        <option value="Psicologo"
                                            {{ $profissional->categoriaProfissional == 'Psicologo' ? 'selected' : '' }}>
                                            Psicóloga
                                        </option>

                                        <option value="Assistente Social"
                                            {{ $profissional->categoriaProfissional == 'Assistente Social' ? 'selected' : '' }}>
                                            Assistente Social
                                        </option>

                                        <option value="Outro"
                                            {{ $profissional->categoriaProfissional == 'Outro' ? 'selected' : '' }}>
                                            Outro
                                        </option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label for="especialidade">Especialidade</label>
                                    <input type="text" name="especialidade" id="especialidade" value="{{ $profissional->especialidadeProfissionalSaude }}">
                                </div>
                            </div>

                            <div class="field-row-2">
                                <div class="field">
                                    <label for="cep">CEP</label>
                                    <input type="text" name="cep" id="cep" value="{{ $profissional->cepProfissional }}">
                                </div>
                                <div class="field">
                                    <label for="uf">UF</label>

                                    <select name="uf" id="uf">
                                        <option value="">Selecione a UF</option>

                                        <option value="AC" {{ $profissional->ufProfissional == 'AC' ? 'selected' : '' }}>Acre</option>
                                        <option value="AL" {{ $profissional->ufProfissional == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                        <option value="AP" {{ $profissional->ufProfissional == 'AP' ? 'selected' : '' }}>Amapá</option>
                                        <option value="AM" {{ $profissional->ufProfissional == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                        <option value="BA" {{ $profissional->ufProfissional == 'BA' ? 'selected' : '' }}>Bahia</option>
                                        <option value="CE" {{ $profissional->ufProfissional == 'CE' ? 'selected' : '' }}>Ceará</option>
                                        <option value="DF" {{ $profissional->ufProfissional == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                        <option value="ES" {{ $profissional->ufProfissional == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                        <option value="GO" {{ $profissional->ufProfissional == 'GO' ? 'selected' : '' }}>Goiás</option>
                                        <option value="MA" {{ $profissional->ufProfissional == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                        <option value="MT" {{ $profissional->ufProfissional == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                        <option value="MS" {{ $profissional->ufProfissional == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                        <option value="MG" {{ $profissional->ufProfissional == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                        <option value="PA" {{ $profissional->ufProfissional == 'PA' ? 'selected' : '' }}>Pará</option>
                                        <option value="PB" {{ $profissional->ufProfissional == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                        <option value="PR" {{ $profissional->ufProfissional == 'PR' ? 'selected' : '' }}>Paraná</option>
                                        <option value="PE" {{ $profissional->ufProfissional == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                        <option value="PI" {{ $profissional->ufProfissional == 'PI' ? 'selected' : '' }}>Piauí</option>
                                        <option value="RJ" {{ $profissional->ufProfissional == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                        <option value="RN" {{ $profissional->ufProfissional == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                        <option value="RS" {{ $profissional->ufProfissional == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                        <option value="RO" {{ $profissional->ufProfissional == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                        <option value="RR" {{ $profissional->ufProfissional == 'RR' ? 'selected' : '' }}>Roraima</option>
                                        <option value="SC" {{ $profissional->ufProfissional == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                        <option value="SP" {{ $profissional->ufProfissional == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                        <option value="SE" {{ $profissional->ufProfissional == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                        <option value="TO" {{ $profissional->ufProfissional == 'TO' ? 'selected' : '' }}>Tocantins</option>
                                    </select>
                                </div>
                            </div>

                            <div class="field-row-2">
                                <div class="field">
                                    <label for="pais">País</label>
                                    <input type="text" name="pais" id="pais" value="{{ $profissional->paisProfissional }}">
                                </div>
                                <div class="field">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" name="cidade" id="cidade" value="{{ $profissional->cidadeProfissional }}">
                                </div>
                            </div>

                            <div class="field">
                                <label for="apresentacao">Apresentação</label>
                                <textarea name="apresentacao" id="apresentacao" rows="4">{{ $profissional->apresentacaoProfissional }}</textarea>
                            </div>
                        </div>

                        {{-- ===================== PRÉVIA DO PERFIL (ATUALIZA AO DIGITAR) ===================== --}}
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

                            <p class="preview-name" id="previewNome">{{ $profissional->nomeProfissional }}</p>
                            <p class="preview-specialty" id="previewEspecialidade">{{ $profissional->especialidadeProfissional }}</p>
                            <p class="preview-bio" id="previewApresentacao">{{ $profissional->apresentacaoProfissional }}</p>

                            <div class="preview-badges" id="previewBadges">
                                @if ($profissional->atendeChatProfissional)
                                    <span class="badge-pill" data-badge="chat">Chat</span>
                                @endif
                                @if ($profissional->atendeDuvidaRapidoProfissional)
                                    <span class="badge-pill" data-badge="duvida">Dúvida rápida</span>
                                @endif
                                @if ($profissional->atendePresencialProfissional)
                                    <span class="badge-pill" data-badge="presencial">Presencial</span>
                                @endif
                            </div>
                        </div>

                    </div>

                </form>

            </main>

        </div>

    </div>

    <script>
        document.getElementById('cep').addEventListener('blur', function () {

        let cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {

                if (data.erro) {
                    alert('CEP não encontrado.');
                    return;
                }

                document.getElementById('pais').value = 'Brasil';
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('uf').value = data.uf;

            });
        });

        // Nome do arquivo escolhido nas caixas de upload
        document.querySelectorAll('.upload-input').forEach(function (input) {
            input.addEventListener('change', function () {
                var label = document.querySelector('[data-filename-for="' + input.id + '"]');
                if (label) {
                    label.textContent = input.files.length ? input.files[0].name : 'Nenhum arquivo escolhido';
                }
            });
        });

        // Atualiza a prévia do perfil em tempo real (não altera o que é enviado ao back-end)
        var nomeInput = document.getElementById('nome');
        var especialidadeInput = document.getElementById('especialidade');
        var apresentacaoInput = document.getElementById('apresentacao');

        if (nomeInput) {
            nomeInput.addEventListener('input', function () {
                document.getElementById('previewNome').textContent = nomeInput.value;
            });
        }
        if (especialidadeInput) {
            especialidadeInput.addEventListener('input', function () {
                document.getElementById('previewEspecialidade').textContent = especialidadeInput.value;
            });
        }
        if (apresentacaoInput) {
            apresentacaoInput.addEventListener('input', function () {
                document.getElementById('previewApresentacao').textContent = apresentacaoInput.value;
            });
        }
    </script>

</body>

</html>