<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhe da publicação | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modulos.css') }}">
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

                    <a href="{{ route('conteudos.index') }}" class="nav-item active">
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
                <span class="breadcrumb">Vênus / <a href="{{ route('conteudos.index') }}" style="color: inherit; text-decoration: none;">Conteúdos</a> / <a href="{{ route('publicacoes.index') }}" style="color: inherit; text-decoration: none;">Histórico</a> / <strong>Detalhe</strong></span>

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


            <main class="page-content pb-page">

                @if (session('sucesso'))
                    <div class="toast-sucesso" id="toastSucesso" role="status">
                        <span class="toast-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12" /></svg>
                        </span>
                        {{ session('sucesso') }}
                        <button type="button" class="toast-fechar" aria-label="Fechar">&times;</button>
                    </div>
                @endif

                @if (session('erro'))
                    <div class="alert-error" style="margin-bottom:16px;">{{ session('erro') }}</div>
                @endif

                @php
                    $podeEditar = in_array($item->statusConteudo, ['rascunho', 'recusado']);
                    $data = $item->data_exibicao;
                    $fmt = function ($n) { return number_format($n, 0, ',', '.'); };
                @endphp

                <a href="{{ route('publicacoes.index') }}" class="md-voltar">&larr; Voltar ao histórico</a>

                <article class="card pb-detalhe">
                    @if ($item->capaConteudo)
                        <div class="pb-detalhe-capa" style="background-image:url('{{ asset('storage/' . $item->capaConteudo) }}')" role="img" aria-label="Capa de {{ $item->tituloConteudo }}"></div>
                    @endif

                    <div class="pb-detalhe-corpo">
                        <div class="pb-detalhe-tags">
                            <span class="md-natureza md-natureza--{{ $item->eh_campanha ? 'campanha' : 'conteudo' }}">{{ $item->natureza_rotulo }}</span>
                            @if (!$item->eh_campanha && $item->tipo)
                                <span class="md-tag">{{ $item->tipo->descricaoTipoConteudo }}</span>
                            @endif
                            @if ($item->categoria)
                                <span class="md-tag">{{ $item->categoria->nomeTipoCategoria }}</span>
                            @endif
                            <span class="ct-status ct-status--{{ $item->statusConteudo }}">{{ $item->status_rotulo }}</span>
                            @if ($item->arquivadoEm)
                                <span class="md-arquivado">Arquivado</span>
                            @endif
                        </div>

                        <h1>{{ $item->tituloConteudo }}</h1>

                        <p class="pb-detalhe-meta">
                            @if ($data)
                                Publicado em {{ $data->format('d/m/Y') }}
                            @else
                                Criado em {{ $item->dataCriacao->format('d/m/Y') }}
                            @endif
                            @if ($item->tempoLeituraMinutos) · {{ $item->tempoLeituraMinutos }} min de leitura @endif
                        </p>

                        @if ($item->statusConteudo == 'recusado')
                            <div class="md-recusa">
                                <strong>Motivo da recusa</strong>
                                <p>{{ $item->motivoRecusaConteudo ?: 'A moderação não informou o motivo.' }}</p>
                            </div>
                        @elseif ($item->statusConteudo == 'em_revisao')
                            <div class="md-info">Este item está em análise pela equipe editorial. Você será avisado quando houver uma decisão.</div>
                        @endif

                        <div class="pb-texto">
                            @if (trim($item->corpoConteudo) !== '')
                                {!! nl2br(e($item->corpoConteudo)) !!}
                            @else
                                <span class="pb-nao-publicado">Este item ainda não tem texto.</span>
                            @endif
                        </div>

                        <div class="pb-detalhe-acoes">
                            @if ($podeEditar)
                                <a href="{{ route('publicacoes.editar', $item->codConteudo) }}" class="btn-primary-sm">Editar</a>
                            @endif

                            <!-- <form method="POST" action="{{ route('publicacoes.duplicar', $item->codConteudo) }}" class="md-inline">
                                @csrf
                                <button type="submit" class="btn-outline-sm">Duplicar</button>
                            </form> -->

                            @if ($item->arquivadoEm)
                                <form method="POST" action="{{ route('publicacoes.desarquivar', $item->codConteudo) }}" class="md-inline">
                                    @csrf
                                    <button type="submit" class="btn-outline-sm">Desarquivar</button>
                                </form>
                            @elseif ($item->statusConteudo == 'publicado')
                                <button type="button" class="btn-danger-sm" data-confirmar
                                        data-url="{{ route('publicacoes.arquivar', $item->codConteudo) }}"
                                        data-titulo="Arquivar publicação?"
                                        data-texto="“{{ $item->tituloConteudo }}” deixará de ficar ativo na plataforma. Você poderá desarquivar depois."
                                        data-botao="Sim, arquivar">Arquivar</button>
                            @elseif ($podeEditar)
                                <button type="button" class="btn-danger-sm" data-confirmar
                                        data-url="{{ route('publicacoes.excluir', $item->codConteudo) }}"
                                        data-metodo="DELETE"
                                        data-titulo="Excluir item?"
                                        data-texto="“{{ $item->tituloConteudo }}” será excluído de forma permanente. Essa ação não pode ser desfeita."
                                        data-botao="Sim, excluir">Excluir</button>
                            @endif
                        </div>
                    </div>
                </article>

                <section class="card pb-desempenho">
                    <h2>Desempenho</h2>

                    @if ($item->statusConteudo == 'publicado')
                        <div class="pb-metricas {{ $item->eh_campanha ? 'pb-metricas--3' : '' }}">
                            <div class="pb-metrica">
                                <span>Visualizações</span>
                                <strong>{{ $fmt($item->visualizacoesConteudo) }}</strong>
                            </div>
                            <div class="pb-metrica">
                                <span>Curtidas</span>
                                <strong>{{ $fmt($item->curtidasConteudo) }}</strong>
                            </div>
                            @if ($item->eh_campanha)
                                <div class="pb-metrica">
                                    <span>Inscritas</span>
                                    <strong>{{ $fmt($item->inscritasConteudo) }}</strong>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="pb-nao-publicado">Os dados de desempenho aparecem depois que o item for publicado.</p>
                    @endif
                </section>

                <p class="ag-rodape">Vênus &bull; A Saúde da Mulher</p>

            </main>

        </div>

    </div>

    {{-- ===================== MODAL: CONFIRMAÇÃO (excluir / arquivar) ===================== --}}
    <div class="ag-modal" id="modalConfirmar" role="dialog" aria-modal="true" aria-labelledby="cfTitulo">
        <form class="ag-modal-box ag-modal-box--sm" method="POST" action="" id="formConfirmar">
            @csrf
            <input type="hidden" name="_method" id="cfMetodo" value="POST">

            <h2 id="cfTitulo"></h2>
            <p class="ag-modal-sub" id="cfTexto"></p>

            <div class="ag-modal-actions">
                <button type="button" class="btn-outline-sm" data-fechar>Voltar</button>
                <button type="submit" class="btn-danger-sm" id="cfOk"></button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            var $ = function (id) { return document.getElementById(id); };
            var modais = Array.prototype.slice.call(document.querySelectorAll('.ag-modal'));
            function fechar(m) { m.classList.remove('open'); }
            modais.forEach(function (m) {
                m.addEventListener('click', function (e) { if (e.target === m) fechar(m); });
            });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') modais.forEach(fechar); });
            document.querySelectorAll('[data-fechar]').forEach(function (b) {
                b.addEventListener('click', function () { fechar(b.closest('.ag-modal')); });
            });

            // Ações que apagam ou arquivam pedem confirmação
            document.querySelectorAll('[data-confirmar]').forEach(function (b) {
                b.addEventListener('click', function () {
                    $('cfTitulo').textContent = b.dataset.titulo;
                    $('cfTexto').textContent = b.dataset.texto;
                    $('cfOk').textContent = b.dataset.botao;
                    $('formConfirmar').action = b.dataset.url;
                    $('cfMetodo').value = b.dataset.metodo || 'POST';
                    $('modalConfirmar').classList.add('open');
                });
            });

            var toast = $('toastSucesso');
            if (toast) {
                var sair = function () {
                    toast.classList.add('saindo');
                    setTimeout(function () { toast.remove(); }, 300);
                };
                toast.querySelector('.toast-fechar').addEventListener('click', sair);
                setTimeout(sair, 4500);
            }
        })();
    </script>
</body>

</html>
