@extends('layouts.app')

@section('titulo', 'Conteúdos Aprender - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
@endpush

@section('content')
@php
    $statusUi = [
        'publicado' => ['Publicado',  'lst-status--ok'],
        'analise'   => ['Em análise', 'lst-status--pendente'],
        'recusado'  => ['Recusado',   'lst-status--recusado'],
    ];
@endphp

<div class="lst-page">

    {{-- Título --}}
    <div class="lst-topo">
        <h1>Conteúdos Aprender</h1>
    </div>

    {{-- Cards de resumo: clicar filtra a tabela --}}
    <div class="lst-kpis">
        <button type="button" class="lst-card lst-kpi" data-filtro="recusado" aria-pressed="false"
                title="Mostrar só os recusados">
            <span class="lst-icone"><i data-lucide="triangle-alert"></i></span>
            <span class="lst-kpi-texto"><b id="ct-recusados">{{ $contagem['recusado'] }}</b><span class="lst-kpi-rotulo">Recusados</span></span>
        </button>

        <button type="button" class="lst-card lst-kpi" data-filtro="analise" aria-pressed="false"
                title="Mostrar só os aguardando revisão">
            <span class="lst-icone lst-icone--amarelo"><i data-lucide="hourglass"></i></span>
            <span class="lst-kpi-texto"><b id="ct-analise">{{ $contagem['analise'] }}</b><span class="lst-kpi-rotulo">Aguardando revisão</span></span>
        </button>

        <button type="button" class="lst-card lst-kpi" data-filtro="publicado" aria-pressed="false"
                title="Mostrar só os publicados">
            <span class="lst-icone lst-icone--verde"><i data-lucide="check-circle-2"></i></span>
            <span class="lst-kpi-texto"><b id="ct-publicados">{{ $contagem['publicado'] }}</b><span class="lst-kpi-rotulo">Publicados</span></span>
        </button>
    </div>

    {{-- Tabela --}}
    <div class="lst-card lst-espaco">
        <div class="lst-barra">
            <h3>Conteúdos</h3>

            <label class="lst-busca">
                <i data-lucide="search"></i>
                <input type="search" id="ct-busca" placeholder="Pesquisar…" aria-label="Pesquisar conteúdos">
            </label>

            <button type="button" class="lst-btn lst-btn--neutro lst-btn--pequeno" data-pdf>
                <i data-lucide="download"></i>Baixar PDF
            </button>

            <div class="lst-filtro">
                <button type="button" class="lst-btn lst-btn--primario" id="ct-filtro-btn"
                        aria-haspopup="true" aria-expanded="false" aria-controls="ct-menu">
                    <i data-lucide="sliders-horizontal"></i><span id="ct-filtro-rotulo">Filtro</span>
                </button>

                <div class="lst-menu" id="ct-menu">
                    <button type="button" data-filtro="todos" aria-pressed="true">Todos<i data-lucide="check"></i></button>
                    <button type="button" data-filtro="publicado" aria-pressed="false">Publicado<i data-lucide="check"></i></button>
                    <button type="button" data-filtro="analise" aria-pressed="false">Em análise<i data-lucide="check"></i></button>
                    <button type="button" data-filtro="recusado" aria-pressed="false">Recusado<i data-lucide="check"></i></button>
                </div>
            </div>
        </div>

        <div class="lst-tabela-wrap">
            <table class="lst-tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profissional</th>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="ct-corpo" data-token="{{ csrf_token() }}">
                    @foreach ($conteudos as $c)
                        <tr data-id="{{ $c->codigo }}"
                            data-url="{{ route('conteudos.decidir', $c->codConteudo) }}"
                            data-nome="{{ $c->autor_nome }}"
                            data-cargo="{{ $c->autor_cargo }}"
                            data-status="{{ $c->statusUi }}"
                            data-titulo-completo="{{ $c->tituloConteudo }}"
                            data-resumo="{{ $c->objetivoConteudo }}"
                            data-corpo="{{ $c->corpoConteudo }}"
                            data-fontes="{{ $c->fontesConteudo }}"
                            data-capa="{{ $c->capaConteudo ? asset('storage/' . $c->capaConteudo) : '' }}"
                            data-tipo="{{ $c->tipo_nome }}"
                            data-categoria="{{ $c->categoria_nome }}"
                            data-tempo="{{ $c->tempoLeituraMinutos }}"
                            data-motivo="{{ $c->motivoRecusaConteudo }}">
                            <td class="lst-mono">{{ $c->codigo }}</td>
                            <td>{{ $c->autor_email }}</td>
                            <td>{{ $c->tituloConteudo }}</td>
                            <td>{{ ($c->dataEnvio ?? $c->dataCriacao)?->format('d/m/Y') }}</td>
                            <td>
                                <span class="lst-status {{ $statusUi[$c->statusUi][1] }}">{{ $statusUi[$c->statusUi][0] }}</span>
                            </td>
                        </tr>
                    @endforeach

                    <tr id="ct-vazio" hidden>
                        <td colspan="5" class="lst-vazio">Nenhum conteúdo encontrado.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="lst-mute lst-dica">Clique em um conteúdo para revisar, aprovar ou recusar.</p>
    </div>

    {{-- Modal 1: revisar (aprovar / recusar) --}}
    <div class="lst-modal" id="ct-modal" role="dialog" aria-modal="true" aria-labelledby="ct-nome">
        <div class="lst-card lst-modal-caixa">

            <div class="lst-modal-topo">
                <div class="lst-avatar" id="ct-avatar"></div>
                <div>
                    <b id="ct-nome"></b>
                    <span class="lst-mute" id="ct-cargo"></span>
                </div>
                <button type="button" class="lst-icone-btn" data-fechar="1" aria-label="Fechar">
                    <i data-lucide="x"></i>
                </button>
            </div>

            <div class="lst-modal-corpo">
                <div class="lst-mute">ID do conteúdo</div>
                <b id="ct-id"></b>
            </div>

            <div class="lst-modal-corpo">
                <div class="lst-mute">Título do conteúdo</div>
                <b id="ct-titulo"></b>
                <div><span class="lst-status" id="ct-status"></span></div>
            </div>

            <div class="lst-modal-corpo" id="ct-motivo-box" hidden>
                <div class="lst-mute">Motivo da recusa</div>
                <b id="ct-motivo-texto"></b>
            </div>

            <button type="button" class="lst-btn lst-btn--suave lst-btn--pequeno" id="ct-ver">
                <i data-lucide="eye"></i>Ver conteúdo
            </button>

            {{-- Checklist editorial --}}
            <div class="lst-card" id="ct-checklist" style="margin-top: 1rem;">

                <div class="lst-checklist-topo">
                    <div class="lst-anel" id="ct-anel">
                        <svg viewBox="0 0 100 100" aria-hidden="true">
                            <circle class="lst-anel-trilha" cx="50" cy="50" r="42" fill="none" stroke-width="8"/>
                            <circle class="lst-anel-progresso" id="ct-anel-progresso"
                                    cx="50" cy="50" r="42" fill="none" stroke-width="8"
                                    stroke-linecap="round" stroke-dasharray="0 264"/>
                        </svg>
                        <b id="ct-progresso">0%</b>
                    </div>

                    <div>
                        <h3 class="lst-card-titulo">Checklist editorial</h3>
                        <p class="lst-mute" id="ct-checklist-resumo">Verifique os critérios antes de aprovar.</p>
                    </div>
                </div>

                <label class="lst-item-check">
                    <input type="checkbox" data-criterio="clareza">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span>
                        <b>Clareza do conteúdo</b>
                        <small>O texto é compreensível e bem organizado.</small>
                    </span>
                </label>

                <label class="lst-item-check">
                    <input type="checkbox" data-criterio="ortografia">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span>
                        <b>Ortografia e gramática</b>
                        <small>Não foram encontrados erros relevantes de escrita.</small>
                    </span>
                </label>

                <label class="lst-item-check">
                    <input type="checkbox" data-criterio="fontes">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span>
                        <b>Fontes confiáveis</b>
                        <small>As informações estão apoiadas em fontes verificáveis.</small>
                    </span>
                </label>

                <label class="lst-item-check">
                    <input type="checkbox" data-criterio="adequacao">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span>
                        <b>Adequação do conteúdo</b>
                        <small>O conteúdo é pertinente à proposta da plataforma.</small>
                    </span>
                </label>

                <label class="lst-item-check">
                    <input type="checkbox" data-criterio="seguranca">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span>
                        <b>Segurança das orientações</b>
                        <small>As orientações não apresentam informações potencialmente prejudiciais.</small>
                    </span>
                </label>

            </div>

            <div class="lst-decisao">
                <button type="button" class="lst-btn lst-btn--neutro" id="ct-aprovar" data-decisao="publicado">
                    <i data-lucide="check"></i>Aprovar
                </button>
                <button type="button" class="lst-btn lst-btn--primario" id="ct-recusar" data-decisao="recusado">
                    <i data-lucide="x"></i>Recusar
                </button>
            </div>
        </div>
    </div>

    {{-- Modal 2: conteúdo completo --}}
    <div class="lst-modal lst-modal--2" id="ct-modal-completo" role="dialog" aria-modal="true" aria-labelledby="cc-titulo">
        <div class="lst-card lst-modal-caixa lst-modal-caixa--larga">

            <div class="lst-doc-topo">
                <div>
                    <h2 class="lst-doc-titulo" id="cc-titulo"></h2>
                    <p class="lst-mute" id="cc-meta"></p>
                    <p class="lst-doc-resumo" id="cc-resumo"></p>
                </div>

                <div class="lst-doc-autor">
                    <div class="lst-info">
                        <b id="cc-autor"></b>
                        <span class="lst-mute" id="cc-cargo"></span>
                    </div>
                    <button type="button" class="lst-icone-btn" data-fechar="1" aria-label="Fechar tudo">
                        <i data-lucide="x"></i>
                    </button>
                </div>
            </div>

            {{-- Preenchido via JS a partir dos data-* da linha --}}
            <div id="cc-artigo">
                <img id="cc-capa" alt="Capa do conteúdo" hidden>
                <div id="cc-corpo"></div>

                <div class="lst-info lst-fontes" id="cc-fontes-box" hidden>
                    <b>Fontes consultadas</b>
                    <ul id="cc-fontes"></ul>
                </div>
            </div>

            <div class="lst-acoes">
                <button type="button" class="lst-btn lst-btn--neutro" data-fechar="2">Fechar</button>
            </div>
        </div>
    </div>

    {{-- Modal Sim ou Não (aprovar / recusar) --}}
    <div class="lst-modal lst-modal--2" id="ct-pergunta-modal" role="dialog" aria-modal="true" aria-labelledby="ct-pergunta-texto">
        <div class="lst-card lst-modal-caixa lst-modal-caixa--pergunta">
            <h3 id="ct-pergunta-texto"></h3>

            <textarea id="ct-motivo" rows="3" maxlength="255" hidden
                      placeholder="Motivo da recusa (máx. 255 caracteres)"
                      aria-label="Motivo da recusa"
                      style="width:100%; margin-top:.75rem; padding:.6rem; border:1px solid #ddd; border-radius:8px; font:inherit; resize:vertical;"></textarea>

            <div class="lst-acoes lst-acoes--centro">
                <button type="button" class="lst-btn lst-btn--neutro" id="ct-pergunta-nao">Não</button>
                <button type="button" class="lst-btn lst-btn--primario" id="ct-pergunta-sim">Sim</button>
            </div>
        </div>
    </div>

    {{-- Aviso rápido --}}
    <div class="lst-toast" id="ct-toast" role="status" aria-live="polite">
        <i data-lucide="check-circle-2"></i><span></span>
    </div>

</div>
@endsection

@push('scripts')
    {{-- Gerador de PDF (só esta tela usa). A lógica da tela fica no adm.js --}}
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.min.js"></script>
@endpush