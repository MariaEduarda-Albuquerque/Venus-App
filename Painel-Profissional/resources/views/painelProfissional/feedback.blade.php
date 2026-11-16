<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback da moderação | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feedback.css') }}">
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

                    <a href="{{ route('feedback.index') }}" class="nav-item active">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a8 8 0 0 1-8 8H4l2.5-3A8 8 0 1 1 21 12Z" /><path d="M9 11h6M9 14h4" /></svg>
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
                <span class="breadcrumb">Vênus / <a href="{{ route('conteudos.index') }}" style="color: inherit; text-decoration: none;">Conteúdos</a> / <strong>Feedback da moderação</strong></span>

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

            <main class="page-content fb-page">

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
                        <h1>Feedback da moderação</h1>
                        <p class="subtitle">Veja o que a equipe editorial decidiu sobre os seus conteúdos e corrija o que foi recusado.</p>
                    </div>
                </div>

                <nav class="fb-abas" aria-label="Filtrar por decisão">
                    @foreach ($filtros as $chave => $rotulo)
                        <a href="{{ route('feedback.index', ['status' => $chave]) }}" class="{{ $filtro == $chave ? 'active' : '' }}">
                            {{ $rotulo }}<span class="fb-contagem">{{ $contagens[$chave] }}</span>
                        </a>
                    @endforeach
                </nav>

                <div class="fb-lista">
                    @forelse ($itens as $item)
                        <article class="fb-card fb-card--{{ $item->statusConteudo }}">

                            <header class="fb-topo">
                                <div class="fb-titulo">
                                    <h2>{{ $item->tituloConteudo }}</h2>
                                    <p class="fb-meta">
                                        {{ optional($item->tipo)->descricaoTipoConteudo }}
                                        @if ($item->categoria) &middot; {{ $item->categoria->nomeTipoCategoria }} @endif
                                    </p>
                                </div>
                                <span class="ct-status ct-status--{{ $item->statusConteudo }}">{{ $item->status_rotulo }}</span>
                            </header>

                            @if ($item->statusConteudo == 'recusado')
                                <div class="fb-motivo">
                                    <strong>Motivo da recusa</strong>
                                    <p>{{ $item->motivoRecusaConteudo ?: 'A moderação não informou o motivo.' }}</p>
                                    @if ($item->dataRevisaoConteudo)
                                        <small>Revisado em {{ $item->dataRevisaoConteudo->format('d/m/Y') }} às {{ $item->dataRevisaoConteudo->format('H:i') }}</small>
                                    @endif
                                </div>

                                <div class="fb-acoes">
                                    <button type="button" class="btn-primary-sm" data-corrigir="{{ $item->codConteudo }}">Corrigir e reenviar</button>
                                    <a href="{{ route('publicacoes.show', $item->codConteudo) }}" class="btn-outline-sm">Ver conteúdo</a>
                                </div>
                            @elseif ($item->statusConteudo == 'em_revisao')
                                <p class="fb-nota">
                                    Em análise pela equipe editorial{{ $item->dataAtualizacao ? ' desde ' . $item->dataAtualizacao->format('d/m/Y') : '' }}.
                                    A decisão aparece aqui assim que houver uma.
                                </p>
                            @else
                                <p class="fb-nota fb-nota--ok">
                                    Aprovado{{ $item->dataRevisaoConteudo ? ' em ' . $item->dataRevisaoConteudo->format('d/m/Y') : '' }}.
                                </p>
                            @endif

                        </article>
                    @empty
                        <div class="fb-vazio">
                            @if ($filtro == 'recusado')
                                <strong>Nenhum conteúdo recusado.</strong>
                                <p>Quando a moderação recusar algum item, o motivo aparece aqui.</p>
                            @elseif ($filtro == 'em_revisao')
                                <strong>Nada em revisão no momento.</strong>
                                <p>Itens enviados para a equipe editorial aparecem aqui até a decisão.</p>
                            @else
                                <strong>Nenhum conteúdo aprovado ainda.</strong>
                                <p>As aprovações da moderação aparecem aqui.</p>
                            @endif
                        </div>
                    @endforelse
                </div>

                <p class="ag-rodape">Vênus &bull; A Saúde da Mulher</p>

            </main>

        </div>

    </div>

    {{-- ===================== MODAL: CORRIGIR E REENVIAR ===================== --}}
    @php
        $reabrir = $errors->any() ? old('codConteudo') : null;
        $dadosJs = $itens->where('statusConteudo', 'recusado')->mapWithKeys(function ($i) {
            return [$i->codConteudo => [
                'titulo' => $i->tituloConteudo,
                'categoria' => $i->codTipoCategoria,
                'tipo' => $i->codTipoConteudo,
                'corpo' => $i->corpoConteudo,
                'motivo' => $i->motivoRecusaConteudo ?: 'A moderação não informou o motivo.',
            ]];
        });
    @endphp

    <div class="ag-modal {{ $reabrir ? 'open' : '' }}" id="modalCorrigir" role="dialog" aria-modal="true" aria-labelledby="fbModalTitulo">
        <form class="ag-modal-box fb-modal-box" method="POST" action="" id="formCorrigir" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" name="codConteudo" id="fbId" value="{{ old('codConteudo') }}">
            <button type="button" class="ag-modal-close" id="fecharModalCorrigir" aria-label="Fechar">&times;</button>

            <h2 id="fbModalTitulo">Corrigir e reenviar</h2>
            <p class="ag-modal-sub">Ajuste o conteúdo conforme o motivo da recusa. Ao reenviar, ele volta para &ldquo;Em revisão&rdquo;.</p>

            <div class="fb-motivo fb-motivo--modal">
                <strong>Motivo da recusa</strong>
                <p id="fbMotivo"></p>
            </div>

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
                <label for="fbTitulo">Título</label>
                <input type="text" id="fbTitulo" name="tituloConteudo" maxlength="150" value="{{ old('tituloConteudo') }}">
            </div>

            <div class="field-row-2">
                <div class="field">
                    <label for="fbCategoria">Categoria</label>
                    <select id="fbCategoria" name="codTipoCategoria">
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->codTipoCategoria }}" @selected(old('codTipoCategoria') == $cat->codTipoCategoria)>{{ $cat->nomeTipoCategoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="fbTipo">Formato</label>
                    <select id="fbTipo" name="codTipoConteudo">
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->codTipoConteudo }}" @selected(old('codTipoConteudo') == $tipo->codTipoConteudo)>{{ $tipo->descricaoTipoConteudo }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="field">
                <label for="fbCorpo">Conteúdo</label>
                <textarea id="fbCorpo" name="corpoConteudo" rows="8">{{ old('corpoConteudo') }}</textarea>
            </div>

            <div class="ag-modal-actions">
                <button type="button" class="btn-outline-sm" id="cancelarCorrigir">Cancelar</button>
                <button type="submit" class="btn-primary-sm">Reenviar para revisão</button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            var modal = document.getElementById('modalCorrigir');
            var form = document.getElementById('formCorrigir');
            var dados = @json($dadosJs);
            var baseUrl = "{{ url('/feedback') }}";

            function abrir() { modal.classList.add('open'); }
            function fechar() { modal.classList.remove('open'); }

            // Aponta o formulário para o conteúdo certo e mostra o motivo da recusa
            function preparar(id, preencher) {
                var d = dados[id];
                if (!d) return false;
                form.action = baseUrl + '/' + id + '/reenviar';
                document.getElementById('fbId').value = id;
                document.getElementById('fbMotivo').textContent = d.motivo;
                if (preencher) {
                    document.getElementById('fbTitulo').value = d.titulo;
                    document.getElementById('fbCategoria').value = d.categoria;
                    document.getElementById('fbTipo').value = d.tipo;
                    document.getElementById('fbCorpo').value = d.corpo || '';
                }
                return true;
            }

            document.querySelectorAll('[data-corrigir]').forEach(function (botao) {
                botao.addEventListener('click', function () {
                    if (preparar(botao.dataset.corrigir, true)) {
                        abrir();
                        document.getElementById('fbTitulo').focus();
                    }
                });
            });

            // Erro de validação: reabre o mesmo conteúdo, mantendo o que a pessoa digitou
            @if ($reabrir)
                preparar(@json((string) $reabrir), false);
            @endif

            document.getElementById('fecharModalCorrigir').addEventListener('click', fechar);
            document.getElementById('cancelarCorrigir').addEventListener('click', fechar);
            modal.addEventListener('click', function (e) { if (e.target === modal) fechar(); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') fechar(); });

            var toast = document.getElementById('toastSucesso');
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
