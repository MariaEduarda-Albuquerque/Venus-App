<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de publicações | Vênus</title>

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
                <span class="breadcrumb">Vênus / <a href="{{ route('conteudos.index') }}" style="color: inherit; text-decoration: none;">Conteúdos</a> / <strong>Histórico</strong></span>

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

                <div class="page-header">
                    <div>
                        <h1>Histórico de publicações</h1>
                        <p class="subtitle">Tudo o que você já publicou: seus conteúdos educativos.</p>
                    </div>
                    <a href="{{ route('conteudos.index') }}" class="btn-primary-sm">+ Novo conteúdo</a>
                </div>

                <section class="card pb-card">

                    <form method="GET" action="{{ route('publicacoes.index') }}" class="pb-filtros" id="formFiltros">
                        <div class="pc-busca pb-busca">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                            <input type="search" name="q" value="{{ $busca }}" placeholder="Buscar por título..." autocomplete="off" aria-label="Buscar por título">
                        </div>

                        <select name="tipo" aria-label="Filtrar por tipo" class="js-auto">
                            <option value="">Todos os tipos</option>
                            @foreach ($tipos as $t)
                                <option value="{{ $t->codTipoConteudo }}" @selected($tipoId == $t->codTipoConteudo)>{{ $t->descricaoTipoConteudo }}</option>
                            @endforeach
                        </select>

                        <select name="status" aria-label="Filtrar por status" class="js-auto">
                            <option value="">Todos os status</option>
                            @foreach ($statusLista as $valor => $rotulo)
                                <option value="{{ $valor }}" @selected($status == $valor)>{{ $rotulo }}</option>
                            @endforeach
                        </select>

                        <select name="periodo" aria-label="Filtrar por período" class="js-auto">
                            @foreach ($periodos as $valor => $rotulo)
                                <option value="{{ $valor }}" @selected($periodo == $valor)>{{ $rotulo }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn-primary-sm">Filtrar</button>
                        @if ($temFiltro)
                            <a href="{{ route('publicacoes.index') }}" class="pb-limpar">Limpar</a>
                        @endif
                    </form>

                    @if ($totalGeral == 0)
                        <div class="md-vazio">
                            <svg viewBox="0 0 200 160" fill="none" aria-hidden="true">
                                <ellipse cx="100" cy="146" rx="62" ry="8" fill="#f6e3e6" />
                                <rect x="46" y="26" width="108" height="108" rx="12" fill="#fff" stroke="#e3b4bd" stroke-width="3" />
                                <rect x="60" y="40" width="80" height="34" rx="6" fill="#fbe3e7" />
                                <rect x="60" y="86" width="80" height="6" rx="3" fill="#f0dde0" />
                                <rect x="60" y="100" width="60" height="6" rx="3" fill="#f0dde0" />
                                <rect x="60" y="114" width="70" height="6" rx="3" fill="#f0dde0" />
                                <path d="M158 40c0-5 8-7 8 0 0-7 8-5 8 0 0 6-8 11-8 11s-8-5-8-11Z" fill="#9e182b" opacity=".85" />
                            </svg>
                            <strong>Você ainda não publicou nada</strong>
                            <p>Seus conteúdos educativos aparecerão aqui.</p>
                            <a href="{{ route('conteudos.index') }}" class="btn-primary-sm">Criar um conteúdo</a>
                        </div>
                    @elseif ($total == 0)
                        <div class="md-vazio md-vazio--sm">
                            <strong>Nenhum resultado</strong>
                            <p>Não encontramos publicações com esses filtros.</p>
                        </div>
                    @else
                        <div class="pc-scroll">
                            <table class="pc-tabela pb-tabela">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Tipo</th>
                                        <th>Categoria</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itens as $i)
                                        @php
                                            $podeEditar = in_array($i->statusConteudo, ['rascunho', 'recusado']);
                                            $data = $i->data_exibicao;
                                        @endphp
                                        <tr>
                                            <td>
                                                <a href="{{ route('publicacoes.show', $i->codConteudo) }}" class="pb-titulo">
                                                    <span class="pb-capa" @if ($i->capaConteudo) style="background-image:url('{{ asset('storage/' . $i->capaConteudo) }}')" @endif></span>
                                                    <strong>{{ $i->tituloConteudo }}</strong>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($i->tipo)
                                                    <span class="md-tag">{{ $i->tipo->descricaoTipoConteudo }}</span>
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td>{{ $i->categoria->nomeTipoCategoria ?? '—' }}</td>
                                            <td>
                                                @if ($data)
                                                    {{ $data->format('d/m/Y') }}
                                                @else
                                                    <span class="pb-nao-publicado">Criado em {{ $i->dataCriacao->format('d/m/Y') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="ct-status ct-status--{{ $i->statusConteudo }}">{{ $i->status_rotulo }}</span>
                                                @if ($i->arquivadoEm)
                                                    <span class="md-arquivado">Arquivado</span>
                                                @endif
                                            </td>
                                            <td class="pb-acoes">
                                                <a href="{{ route('publicacoes.show', $i->codConteudo) }}" class="md-acao">Ver</a>
                                                @if ($podeEditar)
                                                    <a href="{{ route('publicacoes.editar', $i->codConteudo) }}" class="md-acao">Editar</a>
                                                @endif
                                                @if ($i->arquivadoEm)
                                                    <form method="POST" action="{{ route('publicacoes.desarquivar', $i->codConteudo) }}" class="md-inline">
                                                        @csrf
                                                        <button type="submit" class="md-acao">Desarquivar</button>
                                                    </form>
                                                @elseif ($i->statusConteudo == 'publicado')
                                                    <button type="button" class="md-acao md-acao--perigo" data-confirmar
                                                            data-url="{{ route('publicacoes.arquivar', $i->codConteudo) }}"
                                                            data-titulo="Arquivar publicação?"
                                                            data-texto="“{{ $i->tituloConteudo }}” deixará de ficar ativo na plataforma. Você poderá desarquivar depois."
                                                            data-botao="Sim, arquivar">Arquivar</button>
                                                @elseif ($podeEditar)
                                                    <button type="button" class="md-acao md-acao--perigo" data-confirmar
                                                            data-url="{{ route('publicacoes.excluir', $i->codConteudo) }}"
                                                            data-metodo="DELETE"
                                                            data-titulo="Excluir item?"
                                                            data-texto="“{{ $i->tituloConteudo }}” será excluído de forma permanente. Essa ação não pode ser desfeita."
                                                            data-botao="Sim, excluir">Excluir</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($paginas > 1)
                            <nav class="md-pag" aria-label="Paginação">
                                <span class="md-pag-info">{{ ($pagina - 1) * 10 + 1 }}–{{ min($pagina * 10, $total) }} de {{ $total }}</span>
                                <div class="md-pag-botoes">
                                    @if ($pagina > 1)
                                        <a href="{{ route('publicacoes.index', $filtros + ['pagina' => $pagina - 1]) }}" aria-label="Página anterior">&lsaquo;</a>
                                    @endif
                                    @foreach (range(max(1, $pagina - 2), min($paginas, $pagina + 2)) as $n)
                                        <a href="{{ route('publicacoes.index', $filtros + ['pagina' => $n]) }}" class="{{ $n == $pagina ? 'ativo' : '' }}">{{ $n }}</a>
                                    @endforeach
                                    @if ($pagina < $paginas)
                                        <a href="{{ route('publicacoes.index', $filtros + ['pagina' => $pagina + 1]) }}" aria-label="Próxima página">&rsaquo;</a>
                                    @endif
                                </div>
                            </nav>
                        @endif
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

            // Selects filtram na hora
            document.querySelectorAll('.js-auto').forEach(function (s) {
                s.addEventListener('change', function () { $('formFiltros').submit(); });
            });
        })();
    </script>
</body>

</html>