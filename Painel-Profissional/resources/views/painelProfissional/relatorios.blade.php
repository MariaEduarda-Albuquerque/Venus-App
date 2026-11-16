<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Conteúdo | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/relatorio-conteudo.css') }}">
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

                    <a href="{{ route('relatorios.index') }}" class="nav-item active">
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
                <span class="breadcrumb">Vênus / <strong>Relatórios</strong></span>

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


            <main class="page-content rl-page">

                <div class="page-header">
                    <div>
                        <h1>Relatório de Conteúdo</h1>
                        <p class="subtitle">Acompanhe suas publicações, o status de cada uma, as categorias e o alcance dos conteúdos.</p>
                    </div>

                    <div class="rl-acoes">
                        <a href="{{ route('relatorios.planilha', $filtro) }}" class="btn-outline-sm">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><rect x="3" y="4" width="18" height="16" rx="2" /><path d="M3 10h18M9 4v16" /></svg>
                            Exportar planilha
                        </a>
                        <a href="{{ route('relatorios.exportar', $filtro) }}" target="_blank" rel="noopener" class="btn-primary-sm rl-exportar" id="rlExportar">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M12 3v12" /><path d="M7 10l5 5 5-5" /><path d="M5 21h14" /></svg>
                            Exportar PDF
                        </a>
                    </div>
                </div>

                <section class="card rl-filtro">
                    <div class="rl-pills">
                        @foreach (['7' => '7 dias', '30' => '30 dias', '90' => '90 dias'] as $valor => $rotulo)
                            <a href="{{ route('relatorios.index', ['periodo' => $valor] + ($categoriaId ? ['categoria' => $categoriaId] : [])) }}" class="rl-pill {{ $chave == $valor ? 'ativo' : '' }}">{{ $rotulo }}</a>
                        @endforeach
                        <button type="button" class="rl-pill {{ $chave == 'personalizado' ? 'ativo' : '' }}" id="rlPersonalizado">Personalizado</button>
                    </div>

                    <form class="rl-custom {{ ($chave == 'personalizado' || $erro) ? 'aberto' : '' }}" id="rlCustom" method="GET" action="{{ route('relatorios.index') }}">
                        <input type="hidden" name="periodo" value="personalizado">
                        @if ($categoriaId)<input type="hidden" name="categoria" value="{{ $categoriaId }}">@endif
                        <label>De <input type="date" name="inicio" max="{{ $hoje }}" value="{{ $chave == 'personalizado' ? $inicio->format('Y-m-d') : request('inicio') }}"></label>
                        <label>Até <input type="date" name="fim" max="{{ $hoje }}" value="{{ $chave == 'personalizado' ? $fim->format('Y-m-d') : request('fim') }}"></label>
                        <button type="submit" class="btn-primary-sm">Aplicar</button>
                    </form>

                    <form class="rl-filtro-categoria" method="GET" action="{{ route('relatorios.index') }}">
                        @foreach (array_diff_key($filtro, ['categoria' => 1]) as $nome => $valor)
                            <input type="hidden" name="{{ $nome }}" value="{{ $valor }}">
                        @endforeach
                        <label for="rlCategoria">Categoria</label>
                        <select name="categoria" id="rlCategoria" onchange="this.form.submit()">
                            <option value="">Todas</option>
                            @foreach ($categorias as $cat)
                                <option value="{{ $cat->codTipoCategoria }}" {{ $categoriaId == $cat->codTipoCategoria ? 'selected' : '' }}>{{ $cat->nomeTipoCategoria }}</option>
                            @endforeach
                        </select>
                    </form>

                    <span class="rl-periodo-texto">{{ $periodoTexto }}</span>
                </section>

                @if ($erro)
                    <div class="alert-error" style="margin-bottom: 16px;">{{ $erro }} Mostrando os últimos 30 dias.</div>
                @endif

                @include('painelProfissional.relatorio-corpo')

                <p class="ag-rodape">Vênus &bull; A Saúde da Mulher</p>

            </main>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('rlPersonalizado').addEventListener('click', function () {
            document.getElementById('rlCustom').classList.toggle('aberto');
        });

        // Exportar PDF: baixa direto, sem sair da página
        var btnPdf = document.getElementById('rlExportar');
        btnPdf.addEventListener('click', function (e) {
            e.preventDefault();

            if (typeof html2pdf === 'undefined') { window.open(btnPdf.href, '_blank'); return; }

            var original = btnPdf.innerHTML;
            btnPdf.classList.add('carregando');
            btnPdf.textContent = 'Gerando PDF...';

            var area = null;

            fetch(btnPdf.href, { credentials: 'same-origin' })
                .then(function (r) { if (!r.ok) throw new Error('falhou'); return r.text(); })
                .then(function (html) {
                    var doc = new DOMParser().parseFromString(html, 'text/html');
                    var origem = doc.querySelector('.rl-pdf');
                    var barra = origem.querySelector('.rl-pdf-barra');
                    if (barra) barra.remove();

                    // Área fora da tela só para montar o conteúdo
                    area = document.createElement('div');
                    area.style.cssText = 'position: fixed; left: -10000px; top: 0; width: 800px;';
                    var conteudo = document.createElement('div');
                    conteudo.className = 'rl-pdf';
                    conteudo.style.padding = '0';
                    conteudo.innerHTML = origem.innerHTML;
                    area.appendChild(conteudo);
                    document.body.appendChild(area);

                    return html2pdf().set({
                        margin: 10,
                        filename: 'relatorio-de-conteudo.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2, useCORS: true },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                        pagebreak: { mode: ['css', 'legacy'], avoid: ['tr', '.rl-card', '.rl-bloco'] }
                    }).from(conteudo).save();
                })
                .catch(function () { window.open(btnPdf.href, '_blank'); })
                .then(function () {
                    if (area) area.remove();
                    btnPdf.classList.remove('carregando');
                    btnPdf.innerHTML = original;
                });
        });
    </script>
</body>

</html>
