@extends('layouts.app')

@section('titulo', 'Analisar cadastro - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
@endpush

@section('content')

@php
    $p         = $profissional;
    $info      = $statusInfo[$p->statusVerificacao] ?? ['rotulo' => $p->statusVerificacao, 'classe' => ''];
    $emAnalise = $p->statusVerificacao === 'em_analise';
    $enviado   = \Carbon\Carbon::parse($p->dataCadastro)->locale('pt_BR');

    // [tipo da rota, caminho gravado no banco]
    $documentos = [
        'Comprovante do conselho' => ['comprovante',  $p->comprovanteConselhoClasseProfissional],
        'Documento complementar'  => ['complementar', $p->documentoComplementarProfissional],
    ];

    // A foto fica no disco público do site do profissional
    $urlFoto = $p->fotoPerfilProfissional
        ? rtrim(config('services.profissional_url'), '/') . '/storage/' . $p->fotoPerfilProfissional
        : null;

    $checklist = [
        ['Nome confere com o documento',       'Compare o nome do comprovante com o cadastro'],
        ['Número confere na consulta pública', 'Busque no site oficial do conselho'],
        ['Situação ativa e regular',           'Sem suspensão ou cassação'],
        ['Documento legível e válido',         'Imagem nítida e dentro da validade'],
        ['Especialidade compatível',           'Igual à informada no cadastro'],
    ];

    $urlLista = url('/aprovar-cadastros'); // tela com a lista de cadastros
    $urlAnterior = null;                      // cadastro anterior da fila (null = botão desativado; este é o 1º da fila)
    $urlProximo = url('/aprovar-cadastro');   // próximo cadastro da fila (por enquanto a mesma tela, pois só existe uma)
@endphp

<div class="lst-page">

    {{-- Topo: voltar + navegação na fila --}}
    <div class="lst-cabeca">
        <a href="{{ route('cadastros.aprovar') }}" class="lst-btn lst-btn--neutro lst-btn--pequeno">
            <i data-lucide="arrow-left"></i>Voltar à fila
        </a>

        @if ($posicao)
            <div class="lst-fila">
                <span class="lst-mute">{{ $posicao }} de {{ $fila }} na fila</span>

                @if ($anterior)
                    <a href="{{ route('cadastro.aprovar', $anterior) }}" class="lst-nav-btn" aria-label="Anterior"><i data-lucide="chevron-left"></i></a>
                @else
                    <span class="lst-nav-btn" aria-disabled="true"><i data-lucide="chevron-left"></i></span>
                @endif

                @if ($proximo)
                    <a href="{{ route('cadastro.aprovar', $proximo) }}" class="lst-nav-btn" aria-label="Próximo"><i data-lucide="chevron-right"></i></a>
                @else
                    <span class="lst-nav-btn" aria-disabled="true"><i data-lucide="chevron-right"></i></span>
                @endif
            </div>
        @endif
    </div>

    <!-- Passo a passo -->
    <ol class="lst-etapas" aria-label="Passos da análise">
        <li class="lst-etapa is-on" id="dc-passo-0"><span class="lst-etapa-num" id="dc-passo-num-0">1</span>Ver os 3 documentos</li>
        <li class="lst-etapa" id="dc-passo-1"><span class="lst-etapa-num" id="dc-passo-num-1">2</span>Consultar o conselho</li>
        <li class="lst-etapa" id="dc-passo-2"><span class="lst-etapa-num" id="dc-passo-num-2">3</span>Conferir o checklist</li>
        <li class="lst-etapa" id="dc-passo-3"><span class="lst-etapa-num" id="dc-passo-num-3">4</span>Decidir</li>
    </ol>

    <div class="lst-detalhe">

        {{-- ============ Esquerda ============ --}}
        <div class="lst-pilha">

            <div class="lst-hero">
                <div class="lst-hero-topo">
                    <div class="lst-hero-avatar">{{ mb_strtoupper(mb_substr($p->nomeProfissionalSaude, 0, 1)) }}</div>
                    <div class="lst-hero-info">
                        <h1>{{ $p->nomeProfissionalSaude }}</h1>
                        <div class="lst-hero-sub">
                            {{ $p->especialidadeProfissionalSaude ?? 'Sem especialidade' }}
                            · {{ $p->cidadeProfissional }}{{ $p->ufProfissional ? ', '.$p->ufProfissional : '' }}
                        </div>
                        <div class="lst-pilulas">
                            <span class="lst-pilula lst-pilula--branca"><i data-lucide="id-card"></i>{{ $p->categoriaProfissional ?? '—' }}</span>
                            <span class="lst-pilula"><i data-lucide="clock"></i>Enviado {{ $enviado->diffForHumans() }}</span>
                        </div>
                    </div>
                    <span class="lst-pilula lst-pilula--branca lst-pilula--grande">{{ $info['rotulo'] }}</span>
                </div>
            </div>

            {{-- Documentos enviados --}}
            <div class="lst-card">
                <div class="lst-card-topo">
                    <h3 class="lst-card-titulo">Documentos enviados</h3>
                    <div class="lst-abas">
                        <button type="button" class="lst-aba is-active" id="dc-aba-0" onclick="abrirDocumento(0)">Carteira do conselho</button>
                        <button type="button" class="lst-aba" id="dc-aba-1" onclick="abrirDocumento(1)">Documento com foto</button>
                    </div>
                </div>

                <div class="lst-palco" id="dc-palco">

                    @foreach ($documentos as $titulo => [$tipo, $caminho])
                        <div class="lst-papel" id="dc-doc-{{ $loop->index }}" @if (!$loop->first) hidden @endif>
                            @if ($caminho)
                                @php
                                    $url = route('cadastro.documento', [$p, $tipo]);
                                    $pdf = strtolower(pathinfo($caminho, PATHINFO_EXTENSION)) === 'pdf';
                                @endphp

                                @if ($pdf)
                                    <iframe src="{{ $url }}" title="{{ $titulo }}"></iframe>
                                @else
                                    <img src="{{ $url }}" alt="{{ $titulo }}">
                                @endif

                                <a href="{{ $url }}" target="_blank" rel="noopener" class="lst-btn lst-btn--neutro lst-btn--pequeno">
                                    <i data-lucide="external-link"></i>Abrir em nova aba
                                </a>
                            @else
                                <p class="lst-mute">Não enviado.</p>
                            @endif
                        </div>
                    @endforeach

                    {{-- Zoom e giro --}}
                    <div class="lst-ferramentas">
                        <button type="button" class="lst-ferr-btn" onclick="diminuirZoom()" aria-label="Diminuir zoom"><i data-lucide="zoom-out"></i></button>
                        <span id="dc-zoom-texto">100%</span>
                        <button type="button" class="lst-ferr-btn" onclick="aumentarZoom()" aria-label="Aumentar zoom"><i data-lucide="zoom-in"></i></button>
                        <button type="button" class="lst-ferr-btn" onclick="girarDocumento()" aria-label="Girar"><i data-lucide="rotate-cw"></i></button>
                    </div>
                </div>
            </div>
    

            {{-- Dados --}}
            <div class="lst-card">
                <h3 class="lst-card-titulo">Dados do cadastro <span class="lst-mute">· somente leitura</span></h3>
                <div class="lst-dados">
                    <div><span class="lst-dados-rotulo">Nome completo</span><b>{{ $p->nomeProfissionalSaude }}</b></div>
                    <div><span class="lst-dados-rotulo">Nº fiscal</span><b>{{ $p->nrFiscalProfissional ?? '—' }}</b></div>
                    <div><span class="lst-dados-rotulo">E-mail</span><b>{{ $p->emailProfissionalSaude }}</b></div>
                    <div><span class="lst-dados-rotulo">Telefone</span><b>{{ $p->telProfissionalSaude ?? '—' }}</b></div>
                    <div><span class="lst-dados-rotulo">Cidade</span><b>{{ $p->cidadeProfissional }}{{ $p->ufProfissional ? ', '.$p->ufProfissional : '' }}</b></div>
                    <div><span class="lst-dados-rotulo">CEP</span><b>{{ $p->cepProfissional ?? '—' }}</b></div>
                    <div><span class="lst-dados-rotulo">Categoria</span><b>{{ $p->categoriaProfissional ?? '—' }}</b></div>
                    <div><span class="lst-dados-rotulo">Especialidade</span><b>{{ $p->especialidadeProfissionalSaude ?? '—' }}</b></div>
                </div>
                @if ($p->apresentacaoProfissional)
                    <p class="lst-mute lst-espaco">Apresentação</p>
                    <p>{{ $p->apresentacaoProfissional }}</p>
                @endif
            </div>

            {{-- Histórico --}}
            <div class="lst-card">
                <h3 class="lst-card-titulo">Histórico de tentativas</h3>
                <div class="lst-linha-tempo">
                    @foreach ($historico as $h)
                        <div>
                            <b>{{ $statusInfo[$h->decisao]['rotulo'] ?? $h->decisao }}{{ $h->motivo ? ': '.$h->motivo : '' }}</b>
                            <div class="lst-mute">{{ \Carbon\Carbon::parse($h->created_at)->format('d/m/Y H:i') }}</div>
                        </div>
                    @endforeach
                    <div>
                        <b>Cadastro enviado</b>
                        <div class="lst-mute">{{ $enviado->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ============ Direita ============ --}}
        <div class="lst-lateral">

            @if ($consulta)
                <div class="lst-card">
                    <h3 class="lst-card-titulo">Verificação externa</h3>
                    <a href="{{ $consulta }}" target="_blank" rel="noopener" class="lst-btn lst-btn--primario lst-btn--grande">
                        <i data-lucide="external-link"></i>Abrir consulta pública
                    </a>
                    <p class="lst-mute lst-dica">Confirme nome e situação no site oficial do conselho.</p>
                </div>
            @endif

            <div class="lst-card">
                
                @if ($emAnalise)
                    <form method="POST" action="{{ route('cadastro.decidir', $p) }}">
                        @csrf

                        <div class="lst-checklist-topo">
                            <div class="lst-anel" id="dc-anel">
                                <svg viewBox="0 0 84 84" aria-hidden="true">
                                    <circle class="lst-anel-trilha" cx="42" cy="42" r="36" fill="none" stroke-width="8"/>
                                    <circle class="lst-anel-progresso" id="dc-anel-progresso" cx="42" cy="42" r="36" fill="none"
                                            stroke-width="8" stroke-linecap="round" stroke-dasharray="0 226.2"/>
                                </svg>
                                <b id="dc-anel-texto">0/5</b>
                            </div>
                            <div>
                                <h3 class="lst-card-titulo">Checklist de verificação</h3>
                                <div class="lst-mute">Marque cada item após conferir.</div>
                            </div>
                        </div>

                        @foreach ($checklist as $i => [$titulo, $dica])
                            <label class="lst-item-check" id="dc-item-{{ $i }}">
                                <input type="checkbox" id="dc-check-<?= $i ?>" onchange="atualizarTela()" name="checklist[{{ $i }}]" value="1" @checked(old("checklist.$i"))>
                                <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                                <span><b>{{ $titulo }}</b><small>{{ $dica }}</small></span>
                            </label>
                        @endforeach
                        @error('checklist') <span class="lst-erro-msg" style="display:block">{{ $message }}</span> @enderror

                        <div class="lst-escrever {{ $errors->has('motivo') ? 'is-erro' : '' }} lst-espaco">
                            <textarea name="motivo" placeholder="Motivo (obrigatório para reenvio ou reprovação)…"
                                      aria-label="Motivo">{{ old('motivo') }}</textarea>
                        </div>
                        @error('motivo') <span class="lst-erro-msg" style="display:block">{{ $message }}</span> @enderror
                        @error('decisao') <span class="lst-erro-msg" style="display:block">{{ $message }}</span> @enderror

                        <div class="lst-botoes-decisao">
                            <button type="submit" name="decisao" value="aprovar" class="lst-btn lst-btn--ok lst-btn--grande">
                                <i data-lucide="badge-check"></i>Aprovar cadastro
                            </button>
                            <div class="lst-decisao lst-decisao--solta">
                                <button type="submit" name="decisao" value="reenvio" class="lst-btn lst-btn--neutro">
                                    <i data-lucide="rotate-ccw"></i>Solicitar reenvio
                                </button>
                                <button type="submit" name="decisao" value="reprovar" class="lst-btn lst-btn--perigo">
                                    <i data-lucide="user-x"></i>Reprovar
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <h3 class="lst-card-titulo">Decisão registrada</h3>
                    <p><span class="lst-status {{ $info['classe'] }}">{{ $info['rotulo'] }}</span></p>
                    @if ($historico->first()?->motivo)
                        <p class="lst-mute">{{ $historico->first()->motivo }}</p>
                    @endif
                @endif
            </div>
        </div>
    </div>

    @if (session('sucesso'))
        <div class="lst-toast lst-toast--show"><i data-lucide="check-circle-2"></i><span>{{ session('sucesso') }}</span></div>
    @endif

</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/aprovacao-cadastro.js') }}"></script>
@endpush