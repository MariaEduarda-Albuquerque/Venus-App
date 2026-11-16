<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdos | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/conteudo-wizard.css') }}">
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/preferencias.js') }}"></script>
</head>

<body>

    @php
        $inicial = strtoupper(substr($profissional->nomeProfissionalSaude ?? 'P', 0, 1));

        $filtros = [
            ''           => 'Todos',
            'rascunho'   => 'Rascunhos',
            'em_revisao' => 'Em Revisão',
            'publicado'  => 'Publicados',
            'recusado'   => 'Recusados',
        ];
        $statusAtivo = $statusAtivo ?? '';

        // Vem da Agenda ao clicar numa data de relevância
        $prefill = null;
        if (request()->filled('titulo')) {
            $dataPlan = (string) request('data');
            $prefill = [
                'titulo' => mb_substr((string) request('titulo'), 0, 80),
                'objetivo' => mb_substr((string) request('pauta'), 0, 250),
                'categoria' => request('categoria'),
                'dataPlanejada' => preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataPlan) ? $dataPlan : null,
            ];
        }

        // Opções do público-alvo (a última, "Outro", abre um campo para escrever)
        $publicos = [
            'Todas as mulheres',
            'Adolescentes e jovens',
            'Mulheres adultas',
            'Mulheres idosas',
            'Gestantes',
            'Puérperas e mães de recém-nascidos',
            'Mulheres que desejam engravidar',
            'Mulheres em planejamento familiar',
            'Mulheres na menopausa',
            'Mulheres em situação de violência',
            'Mulheres negras',
            'Mulheres LGBTQIAPN+',
            'Mulheres com deficiência',
            'Familiares e parceiros(as)',
            'Profissionais de saúde',
        ];

        $fundos = [
            'vinho'   => 'Vinho',
            'rosa'    => 'Rosa',
            'lilas'   => 'Lilás',
            'pessego' => 'Pêssego',
            'azul'    => 'Azul',
            'grafite' => 'Grafite',
        ];

        // Formato escolhido por padrão (o campo "Formato" saiu da tela, mas o banco ainda guarda um valor)
        $tipoPadrao = optional(($tipos ?? collect())->first())->codTipoConteudo;

        // Tudo que a lista e o assistente precisam saber de cada conteúdo
        $destaques = $conteudos->mapWithKeys(function ($c) {
            return [$c->codConteudo => [
                'id'            => $c->codConteudo,
                'status'        => $c->statusConteudo,
                'statusRotulo'  => $c->status_rotulo,
                'titulo'        => $c->tituloConteudo,
                'objetivo'      => $c->objetivoConteudo ?? null,
                'publico'       => $c->publicoAlvoConteudo ?? null,
                'categoria'     => $c->codTipoCategoria,
                'categoriaNome' => optional($c->categoria)->nomeTipoCategoria,
                'tags'          => $c->tagsConteudo ?? null,
                'mensagem'      => $c->mensagemPrincipalConteudo ?? null,
                'texto'         => strip_tags((string) $c->corpoConteudo),
                'cta'           => $c->chamadaAcaoConteudo ?? null,
                'fontes'        => $c->fontesConteudo ?? null,
                'fundo'         => $c->fundoConteudo ?: 'vinho',
                'capa'          => $c->capaConteudo ? asset('storage/' . $c->capaConteudo) : null,
                'motivo'        => $c->motivoRecusaConteudo ?? null,
            ]];
        });
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
                <span class="breadcrumb">Vênus / <strong>Conteúdos</strong></span>

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

            <main class="page-content ct-page cw-page">

                @if (session('sucesso'))
                    <div class="toast-sucesso" id="toastSucesso" role="status">
                        <span class="toast-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12" /></svg>
                        </span>
                        {{ session('sucesso') }}
                        <button type="button" class="toast-fechar" aria-label="Fechar">&times;</button>
                    </div>
                @endif

                {{-- ============================ LISTA ============================ --}}
                <section id="cwLista">

                    @if (session('erro'))
                        <div class="alert-error" style="margin-bottom:16px;">{{ session('erro') }}</div>
                    @endif

                    <div class="page-header">
                        <div>
                            <h1>Publicação de conteúdo</h1>
                            <p class="subtitle">Crie publicações de conscientização sobre a saúde da mulher e envie para a revisão editorial.</p>
                        </div>
                        <button type="button" class="btn-primary-sm js-cw-novo">+ Criar conteúdo</button>
                    </div>

                    <nav class="ct-filtros" aria-label="Filtrar por status">
                        @foreach ($filtros as $valor => $rotulo)
                            <a href="{{ $valor === '' ? route('conteudos.index') : route('conteudos.index', ['status' => $valor]) }}"
                               class="ct-pill {{ (string) $statusAtivo === (string) $valor ? 'active' : '' }}">{{ $rotulo }}</a>
                        @endforeach
                    </nav>

                    @if ($conteudos->isEmpty())
                        <div class="ct-vazio">
                            <strong>Nenhum conteúdo por aqui ainda</strong>
                            <p>Clique em “Criar conteúdo” para montar sua primeira publicação.</p>
                        </div>
                    @else
                        <div class="cw-grid">
                            @foreach ($conteudos as $c)
                                <article class="cw-card" role="button" tabindex="0" data-id="{{ $c->codConteudo }}">
                                    <div class="cw-card-poster">
                                        <div class="cw-post cw-post--mini" data-mini data-poster="{{ $c->codConteudo }}"></div>
                                    </div>
                                    <div class="cw-card-body">
                                        <span class="cw-card-cat">{{ $c->categoria->nomeTipoCategoria ?? 'Sem categoria' }}</span>
                                        <h3>{{ $c->tituloConteudo }}</h3>
                                        <p>{{ \Illuminate\Support\Str::limit(strip_tags((string) ($c->objetivoConteudo ?: $c->corpoConteudo)), 90) ?: 'Sem texto ainda.' }}</p>
                                        <div class="cw-card-foot">
                                            <span class="ct-status ct-status--{{ $c->statusConteudo }}">{{ $c->status_rotulo }}</span>
                                            <span class="cw-card-data">{{ $c->dataCriacao->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </section>

                {{-- ============================ ASSISTENTE ============================ --}}
                <section id="cwWizard" class="cw-wizard" hidden>

                    <form id="cwForm" method="POST" action="{{ route('conteudos.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" name="_method" value="PUT" id="cwMetodo" disabled>
                        <input type="hidden" name="codConteudo" id="cwId" value="">
                        <input type="hidden" name="codTipoConteudo" value="{{ $tipoPadrao }}">
                        <input type="hidden" name="acao" id="cwAcao" value="">
                        <input type="hidden" name="dataPlanejadaConteudo" id="cwDataPlanejada" value="">
                        <input type="hidden" name="removerCapa" id="cwRemoverCapa" value="0">

                        <div class="cw-topo">
                            <div>
                                <h1><span id="cwTituloPagina">Novo conteúdo</span> <span class="ct-status" id="cwStatusChip" hidden></span></h1>
                                <p class="subtitle">Monte a publicação passo a passo e veja a prévia ao lado enquanto escreve.</p>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert-error" style="margin-bottom:16px;">
                                <ul>
                                    @foreach ($errors->all() as $erro)
                                        <li>{{ $erro }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="cw-aviso" id="cwAviso" hidden></div>

                        <nav class="cw-stepper" id="cwStepper" aria-label="Etapas da publicação">
                            <button type="button" class="cw-step is-ativo" data-passo="1"><span class="cw-step-num">1</span><span>Informações básicas</span></button>
                            <span class="cw-step-linha"></span>
                            <button type="button" class="cw-step" data-passo="2"><span class="cw-step-num">2</span><span>Conteúdo da publicação</span></button>
                            <span class="cw-step-linha"></span>
                            <button type="button" class="cw-step" data-passo="3"><span class="cw-step-num">3</span><span>Materiais e divulgação</span></button>
                            <span class="cw-step-linha"></span>
                            <button type="button" class="cw-step" data-passo="4"><span class="cw-step-num">4</span><span>Revisão da publicação</span></button>
                        </nav>

                        <div class="cw-layout">

                            {{-- ---------- FORMULÁRIO ---------- --}}
                            <div class="cw-form-card">

                                {{-- PASSO 1 --}}
                                <div class="cw-passo" data-passo="1">
                                    <h2 class="cw-passo-titulo">Informações básicas</h2>
                                    <p class="cw-sub">Defina o tema da sua publicação de conscientização.</p>

                                    <div class="cw-campo">
                                        <label class="cw-label" for="cwTitulo">Título da publicação <span class="cw-obrig">*</span></label>
                                        <div class="cw-input-wrap">
                                            <input type="text" class="cw-input" id="cwTitulo" name="tituloConteudo" maxlength="80" autocomplete="off" placeholder="Ex.: Outubro Rosa: cuide da sua saúde">
                                            <span class="cw-contador" data-contador-de="cwTitulo">0/80</span>
                                        </div>
                                        <p class="cw-erro" data-erro-de="cwTitulo" hidden></p>
                                    </div>

                                    <div class="cw-campo">
                                        <label class="cw-label" for="cwObjetivo">Objetivo da publicação <span class="cw-obrig">*</span></label>
                                        <div class="cw-input-wrap cw-input-wrap--ta">
                                            <textarea class="cw-input" id="cwObjetivo" name="objetivoConteudo" rows="3" maxlength="250" placeholder="Ex.: Conscientizar sobre a importância do diagnóstico precoce do câncer de mama."></textarea>
                                            <span class="cw-contador" data-contador-de="cwObjetivo">0/250</span>
                                        </div>
                                        <p class="cw-erro" data-erro-de="cwObjetivo" hidden></p>
                                    </div>

                                    <div class="cw-campo">
                                        <label class="cw-label" for="cwPublico">Público-alvo <span class="cw-obrig">*</span></label>
                                        <select class="cw-input" id="cwPublico">
                                            <option value="">Selecione o público-alvo</option>
                                            @foreach ($publicos as $p)
                                                <option value="{{ $p }}">{{ $p }}</option>
                                            @endforeach
                                            <option value="__outro">Outro</option>
                                        </select>
                                        <div class="cw-input-wrap cw-publico-outro" id="cwPublicoOutroWrap" hidden>
                                            <input type="text" class="cw-input" id="cwPublicoOutro" maxlength="80" autocomplete="off" placeholder="Descreva o público-alvo. Ex.: Mulheres atletas">
                                            <span class="cw-contador" data-contador-de="cwPublicoOutro">0/80</span>
                                        </div>
                                        <input type="hidden" name="publicoAlvoConteudo" id="cwPublicoValor" value="">
                                        <p class="cw-erro" data-erro-de="cwPublico" hidden></p>
                                    </div>

                                    <div class="cw-campo">
                                        <label class="cw-label" for="cwCategoria">Categoria <span class="cw-obrig">*</span></label>
                                        <select class="cw-input" id="cwCategoria" name="codTipoCategoria">
                                            <option value="">Selecione a categoria</option>
                                            @foreach (($categorias ?? []) as $cat)
                                                <option value="{{ $cat->codTipoCategoria }}">{{ $cat->nomeTipoCategoria }}</option>
                                            @endforeach
                                        </select>
                                        @if (count($categorias ?? []) === 0)
                                            <p class="cw-dica-campo">Nenhuma categoria cadastrada ainda. Rode o CategoriasConteudoSeeder.</p>
                                        @endif
                                        <p class="cw-erro" data-erro-de="cwCategoria" hidden></p>
                                    </div>

                                    <div class="cw-campo">
                                        <label class="cw-label" for="cwTagInput">Tags <span class="cw-opc">(opcional · até 6)</span></label>
                                        <div class="cw-tags-caixa">
                                            <span class="cw-tags-lista" id="cwTagsLista"></span>
                                            <input type="text" class="cw-tag-input" id="cwTagInput" maxlength="25" autocomplete="off" placeholder="#digite e aperte Enter">
                                        </div>
                                        <input type="hidden" name="tagsConteudo" id="cwTagsValor" value="">
                                    </div>
                                </div>

                                {{-- PASSO 2 --}}
                                <div class="cw-passo" data-passo="2" hidden>
                                    <h2 class="cw-passo-titulo">Conteúdo da publicação</h2>
                                    <p class="cw-sub">Defina a mensagem que as usuárias vão ver na arte.</p>

                                    <div class="cw-campo">
                                        <label class="cw-label" for="cwMensagem">Mensagem principal <span class="cw-obrig">*</span></label>
                                        <div class="cw-input-wrap">
                                            <input type="text" class="cw-input" id="cwMensagem" name="mensagemPrincipalConteudo" maxlength="80" autocomplete="off" placeholder="Ex.: Toque, conheça seu corpo, previna-se.">
                                            <span class="cw-contador" data-contador-de="cwMensagem">0/80</span>
                                        </div>
                                        <p class="cw-erro" data-erro-de="cwMensagem" hidden></p>
                                    </div>

                                    <div class="cw-campo">
                                        <label class="cw-label" for="cwTexto">Texto de apresentação <span class="cw-obrig">*</span></label>
                                        <div class="cw-input-wrap cw-input-wrap--ta">
                                            <textarea class="cw-input" id="cwTexto" name="corpoConteudo" rows="5" maxlength="400" placeholder="Explique o tema com linguagem simples e acolhedora."></textarea>
                                            <span class="cw-contador" data-contador-de="cwTexto">0/400</span>
                                        </div>
                                        <p class="cw-erro" data-erro-de="cwTexto" hidden></p>
                                    </div>

                                    <div class="cw-campo">
                                        <label class="cw-label" for="cwCta">Chamada para ação (CTA) <span class="cw-opc">(opcional)</span></label>
                                        <div class="cw-input-wrap">
                                            <input type="text" class="cw-input" id="cwCta" name="chamadaAcaoConteudo" maxlength="60" autocomplete="off" placeholder="Ex.: Agende sua mamografia">
                                            <span class="cw-contador" data-contador-de="cwCta">0/60</span>
                                        </div>
                                    </div>

                                    <div class="cw-campo">
                                        <label class="cw-label" for="cwFontes">Fontes de referência <span class="cw-opc">(opcional)</span></label>
                                        <div class="cw-input-wrap cw-input-wrap--ta">
                                            <textarea class="cw-input" id="cwFontes" name="fontesConteudo" rows="3" maxlength="300" placeholder="Ex.: INCA, Ministério da Saúde, OMS"></textarea>
                                            <span class="cw-contador" data-contador-de="cwFontes">0/300</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- PASSO 3 --}}
                                <div class="cw-passo" data-passo="3" hidden>
                                    <h2 class="cw-passo-titulo">Materiais e divulgação</h2>
                                    <p class="cw-sub">Deixe a publicação mais bonita com uma foto ou uma cor de fundo.</p>

                                    <div class="cw-campo">
                                        <span class="cw-label">Imagem de destaque <span class="cw-opc">(opcional)</span></span>
                                        <label class="cw-upload" for="cwImagem">
                                            <span class="cw-upload-thumb" id="cwThumb"></span>
                                            <span class="cw-upload-txt">
                                                <strong id="cwImagemNome">Nenhuma imagem selecionada</strong>
                                                <small>JPG, PNG ou WEBP · até 3 MB · vira o fundo da publicação</small>
                                            </span>
                                            <span class="cw-upload-btn">Escolher imagem</span>
                                            <input type="file" class="cw-upload-input" id="cwImagem" name="capaConteudo" accept="image/jpeg,image/png,image/webp">
                                        </label>
                                        <button type="button" class="cw-remover" id="cwRemoverImagem" hidden>Remover imagem</button>
                                        <p class="cw-erro" data-erro-de="cwImagem" hidden></p>
                                    </div>

                                    <div class="cw-campo">
                                        <span class="cw-label">Cor de fundo</span>
                                        <div class="cw-swatches" id="cwSwatches">
                                            @foreach ($fundos as $chave => $nome)
                                                <label class="cw-swatch" title="{{ $nome }}">
                                                    <input type="radio" name="fundoConteudo" value="{{ $chave }}" {{ $chave === 'vinho' ? 'checked' : '' }}>
                                                    <span class="cw-cor cw-tema-{{ $chave }}"></span>
                                                    <em>{{ $nome }}</em>
                                                </label>
                                            @endforeach
                                        </div>
                                        <p class="cw-dica-campo">Com uma imagem escolhida, a cor fica como reserva e a foto vira o fundo.</p>
                                    </div>
                                </div>

                                {{-- PASSO 4 --}}
                                <div class="cw-passo" data-passo="4" hidden>
                                    <h2 class="cw-passo-titulo">Revisão da publicação</h2>
                                    <p class="cw-sub">Confira todos os detalhes antes de enviar.</p>

                                    <div class="cw-resumo" id="cwResumo"></div>

                                    <p class="cw-nota-rev">Ao enviar, a equipe editorial analisa a publicação antes de ela ser publicada. Você acompanha a decisão em Feedback.</p>
                                </div>

                                {{-- RODAPÉ --}}
                                <div class="cw-acoes">
                                    <button type="button" class="btn-outline-sm cw-btn-lg" id="cwBtnVoltar">Cancelar</button>

                                    <div class="cw-acoes-dir">
                                        <button type="submit" class="btn-outline-sm cw-btn-lg" id="cwBtnRascunho" data-acao="rascunho">Salvar rascunho</button>
                                        <button type="button" class="btn-primary-sm cw-btn-lg" id="cwBtnContinuar">Continuar &rarr;</button>
                                        <button type="submit" class="btn-primary-sm cw-btn-lg" id="cwBtnEnviar" data-acao="revisao" hidden>Enviar para revisão</button>
                                        <button type="submit" class="btn-danger-sm cw-btn-lg" id="cwBtnPrivar" data-acao="privar" hidden>Privar conteúdo</button>
                                    </div>
                                </div>
                            </div>

                            {{-- ---------- PRÉVIA + DICAS ---------- --}}
                            <aside class="cw-lado">
                                <div class="cw-previa">
                                    <div class="cw-previa-topo">
                                        <h3>Prévia da publicação</h3>
                                    </div>

                                    <div class="cw-post" id="cwPoster"></div>

                                    <div class="cw-previa-info">
                                        <h4 id="pvTitulo">Título da publicação</h4>
                                        <p id="pvObjetivo">O objetivo aparece aqui.</p>
                                        <div class="cw-mini-chips" id="pvPublico"></div>
                                        <dl class="cw-previa-meta">
                                            <dt>Categoria</dt><dd id="pvCategoria">—</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="cw-dicas">
                                    <h3>Dicas para sua publicação</h3>
                                    <ul class="cw-dicas-lista">
                                        <li>Use linguagem simples e acolhedora.</li>
                                        <li>Baseie-se em fontes confiáveis (OMS, Ministério da Saúde, INCA etc.).</li>
                                        <li>Inclua orientações práticas de prevenção e cuidado.</li>
                                        <li>Respeite a diversidade e promova a inclusão.</li>
                                        <li>Aproveite as datas do mês, como o Outubro Rosa (câncer de mama), para ligar a publicação ao tema do período.</li>
                                    </ul>
                                </div>
                            </aside>

                        </div>
                    </form>
                </section>

            </main>

        </div>

    </div>

    <script type="application/json" id="cwDados">@json((object) $destaques->all())</script>
    <script>
        window.cwConfig = {
            urlStore: "{{ route('conteudos.store') }}",
            urlBase: "{{ url('/conteudo') }}",
            publicos: @json($publicos),
            erros: @json($errors->any()),
            errosCampos: @json($errors->keys()),
            antigo: @json(old()),
            abrirNovo: @json(request('criar') == 1),
            // Vem da Agenda ao clicar numa data de relevância
            prefill: @json($prefill)
        };
    </script>
    <script src="{{ asset('js/conteudo-wizard.js') }}"></script>
</body>

</html>