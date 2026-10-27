@extends('layouts.app')

@php
    $publicos = [
        'adolescentes_e_jovens' => 'Adolescentes e jovens',
        'mulheres_adultas'      => 'Mulheres adultas',
        'gestantes'             => 'Gestantes',
        'todas_as_usuarias'     => 'Todas as usuárias',
    ];
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('css/destaque.css') }}">
@endpush

@section('content')
<div class="dst-page">

    <div class="dst-topo">
        <h1>Destaques</h1>
    </div>

    {{-- Mensagem de sucesso (vem do redirect do controller) --}}
    @if (session('sucesso'))
        <div class="dst-ok" role="status" style="margin-bottom:16px">{{ session('sucesso') }}</div>
    @endif

    {{-- Erros de validação do servidor --}}
    @if ($errors->any())
        <div class="dst-erro" role="alert" style="display:block;margin-bottom:16px">
            <ul style="margin:0;padding-left:18px">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Barra de etapas (o JavaScript troca is-on / is-done) --}}
    <ol class="dst-passos" aria-label="Etapas do destaque">
        <li class="dst-passo is-on" aria-current="step">
            <span class="dst-passo-num"><span class="dst-numero">1</span><i data-lucide="check"></i></span>Informações básicas
        </li>
        <li class="dst-passo">
            <span class="dst-passo-num"><span class="dst-numero">2</span><i data-lucide="check"></i></span>Conteúdo do destaque
        </li>
        <li class="dst-passo">
            <span class="dst-passo-num"><span class="dst-numero">3</span><i data-lucide="check"></i></span>Materiais e divulgação
        </li>
        <li class="dst-passo">
            <span class="dst-passo-num"><span class="dst-numero">4</span><i data-lucide="check"></i></span>Revisão e publicação
        </li>
    </ol>

    {{-- IMPORTANTE: a action usa a rota POST (destaques.store), não a da view --}}
    <form class="dst-trabalho" id="form-destaque" method="POST" action="{{ route('destaques.store') }}" enctype="multipart/form-data">

        @csrf

        {{-- ============ Coluna da esquerda: as 4 etapas ============ --}}
        <div class="dst-card">

            {{-- Etapa 1 --}}
            <section class="dst-etapa is-on" data-etapa="1">
                <h3 class="dst-etapa-titulo" tabindex="-1">Informações básicas</h3>

                <div class="dst-campo" data-campo="titulo">
                    <label for="titulo">Título do destaque <em>*</em></label>
                    <div class="dst-entrada">
                        <input name="titulo" id="titulo" maxlength="80" value="{{ old('titulo') }}" placeholder="Ex.: Maio Vermelho — cuide da sua saúde">
                        <span class="dst-contador">0/80</span>
                    </div>
                    <span class="dst-erro">Informe o título do destaque.</span>
                </div>

                <div class="dst-campo" data-campo="objetivo">
                    <label for="objetivo">Objetivo do destaque <em>*</em></label>
                    <div class="dst-entrada">
                        <textarea id="objetivo" name="objetivo" maxlength="250" placeholder="O que este destaque quer alcançar?">{{ old('objetivo') }}</textarea>
                        <span class="dst-contador">0/250</span>
                    </div>
                    <span class="dst-erro">Descreva o objetivo.</span>
                </div>

                <div class="dst-duas">
                    <div class="dst-campo" data-campo="publico_alvo">
                        <label for="publico_alvo">Público-alvo <em>*</em></label>
                        <select id="publico_alvo" name="publico_alvo">
                            <option value="">Selecione</option>
                            @foreach (['Adolescentes e jovens', 'Mulheres adultas', 'Gestantes', 'Todas as usuárias'] as $opcao)
                                <option value="{{ $opcao }}" @selected(old('publico_alvo') === $opcao)>{{ $opcao }}</option>
                            @endforeach
                        </select>
                        <span class="dst-erro">Selecione o público.</span>
                    </div>

                    <div class="dst-campo" data-campo="faixa_etaria">
                        <label for="faixa_etaria">Faixa etária <em>*</em></label>
                        <select id="faixa_etaria" name="faixa_etaria">
                            <option value="">Selecione</option>
                            @foreach (['14 a 25 anos', '26 a 40 anos', '41 a 60 anos', 'Todas as idades'] as $opcao)
                                <option value="{{ $opcao }}" @selected(old('faixa_etaria') === $opcao)>{{ $opcao }}</option>
                            @endforeach
                        </select>
                        <span class="dst-erro">Selecione a faixa etária.</span>
                    </div>

                    <div class="dst-campo" data-campo="categoria">
                        <label for="categoria">Categoria <em>*</em></label>
                        <select id="categoria" name="categoria">
                            <option value="">Selecione</option>
                            @foreach (['ISTs (Infecções Sexualmente Transmissíveis)', 'Saúde mental', 'Saúde reprodutiva', 'Prevenção e exames'] as $opcao)
                                <option value="{{ $opcao }}" @selected(old('categoria') === $opcao)>{{ $opcao }}</option>
                            @endforeach
                        </select>
                        <span class="dst-erro">Selecione a categoria.</span>
                    </div>

                    <div class="dst-campo" data-campo="duracao">
                        <label for="duracao">Duração <em>*</em></label>
                        <select id="duracao" name="duracao">
                            <option value="">Selecione</option>
                            @foreach ([7 => '7 dias', 15 => '15 dias', 30 => '30 dias', 90 => '90 dias'] as $valor => $rotulo)
                                <option value="{{ $valor }}" @selected((string) old('duracao') === (string) $valor)>{{ $rotulo }}</option>
                            @endforeach
                        </select>
                        <span class="dst-erro">Selecione a duração.</span>
                    </div>
                </div>

                <div class="dst-campo">
                    <label for="tag-entrada">Tags <span class="dst-mute">(opcional)</span></label>
                    <div class="dst-tags" id="tags">
                        <input id="tag-entrada" placeholder="Digite e pressione Enter">
                    </div>
                    <input type="hidden" name="tags" id="tags-valor">
                    <div class="dst-dica" id="tag-dica">Até 8 tags. Use Enter ou vírgula para adicionar.</div>
                </div>

                <div class="dst-acoes">
                    <span></span>
                    <div>
                        <button type="button" class="dst-btn dst-btn--primario" data-proxima>Continuar<i data-lucide="arrow-right"></i></button>
                    </div>
                </div>
            </section>

            {{-- Etapa 2 --}}
            <section class="dst-etapa" data-etapa="2">
                <h3 class="dst-etapa-titulo" tabindex="-1">Conteúdo do destaque</h3>
                <p class="dst-mute dst-etapa-sub">Defina as informações e mensagens que serão compartilhadas.</p>

                <div class="dst-campo" data-campo="mensagem">
                    <label for="mensagem">Mensagem principal <em>*</em></label>
                    <div class="dst-entrada">
                        <input id="mensagem" name="mensagem" maxlength="80" value="{{ old('mensagem') }}" placeholder="A frase que aparece em destaque">
                        <span class="dst-contador">0/80</span>
                    </div>
                    <span class="dst-erro">Escreva a mensagem principal.</span>
                </div>

                <div class="dst-campo" data-campo="texto">
                    <label for="texto">Texto de apresentação <em>*</em></label>
                    <div class="dst-entrada">
                        <textarea id="texto" name="texto" maxlength="250" placeholder="Explique o tema em poucas linhas">{{ old('texto') }}</textarea>
                        <span class="dst-contador">0/250</span>
                    </div>
                    <span class="dst-erro">Escreva o texto de apresentação.</span>
                </div>

                <div class="dst-campo" data-campo="cta">
                    <label for="cta">Chamada para ação (CTA) <em>*</em></label>
                    <div class="dst-entrada">
                        <input id="cta" name="cta" maxlength="30" value="{{ old('cta') }}" placeholder="Ex.: Agende seu exame">
                        <span class="dst-contador">0/30</span>
                    </div>
                    <span class="dst-erro">Informe a chamada para ação.</span>
                </div>

                <div class="dst-campo" data-campo="fontes">
                    <label for="fontes">Fontes de referência <em>*</em></label>
                    <input id="fontes" name="fontes" value="{{ old('fontes') }}" placeholder="Ex.: Ministério da Saúde, OMS">
                    <span class="dst-erro">Cite ao menos uma fonte.</span>
                </div>

                <div class="dst-acoes">
                    <button type="button" class="dst-btn dst-btn--neutro" data-anterior><i data-lucide="arrow-left"></i>Voltar</button>
                    <div>
                        <button type="button" class="dst-btn dst-btn--primario" data-proxima>Continuar<i data-lucide="arrow-right"></i></button>
                    </div>
                </div>
            </section>

            {{-- Etapa 3 --}}
            <section class="dst-etapa" data-etapa="3">
                <h3 class="dst-etapa-titulo" tabindex="-1">Materiais e divulgação</h3>
                <p class="dst-mute dst-etapa-sub">Adicione os materiais que serão usados para informar e engajar o público.</p>

                <div class="dst-campo" data-campo="peca_principal">
                    <label>Peça principal do destaque <em>*</em></label>

                    {{-- Sem arquivo --}}
                    <button type="button" class="dst-soltar" id="principal-vazio" data-escolher="principal">
                        <i data-lucide="image-up"></i>
                        <b>Enviar peça principal</b>
                        <span class="dst-mute">PNG ou JPG, clique para escolher</span>
                    </button>

                    {{-- Com arquivo --}}
                    <div class="dst-arquivo dst-arquivo--grande" id="principal-arquivo" hidden>
                        <div class="dst-miniatura" id="principal-miniatura"><i data-lucide="image"></i></div>
                        <div class="dst-arquivo-info">
                            <b id="principal-nome"></b>
                            <div class="dst-mute" id="principal-tamanho"></div>
                            <div class="dst-ok">Enviado com sucesso</div>
                        </div>
                        <button type="button" class="dst-btn dst-btn--neutro dst-btn--pequeno" data-escolher="principal">Substituir</button>
                        <button type="button" class="dst-icone-btn" data-remover-principal aria-label="Remover peça principal">
                            <i data-lucide="trash-2"></i>
                        </button>
                    </div>

                    <span class="dst-erro">Envie a peça principal para continuar.</span>
                </div>

                <label class="dst-rotulo">Materiais complementares <span class="dst-mute">(opcional)</span></label>
                <div class="dst-arquivos" id="complementares"></div>

                <button type="button" class="dst-adicionar" data-escolher="complementares">
                    <i data-lucide="plus"></i>Adicionar mais materiais
                </button>

                {{-- Os inputs de arquivo precisam ficar DENTRO do <form> --}}
                <input type="file" id="arquivo-principal" name="peca_principal" accept="image/*" hidden>
                <input type="file" id="arquivo-complementar" name="materiais[]" multiple hidden>

                <div class="dst-acoes">
                    <button type="button" class="dst-btn dst-btn--neutro" data-anterior><i data-lucide="arrow-left"></i>Voltar</button>
                    <div>
                        <button type="button" class="dst-btn dst-btn--primario" data-proxima>Continuar<i data-lucide="arrow-right"></i></button>
                    </div>
                </div>
            </section>

            {{-- Etapa 4 --}}
            <section class="dst-etapa" data-etapa="4">
                <h3 class="dst-etapa-titulo" tabindex="-1">Resumo do destaque</h3>
                <p class="dst-mute dst-etapa-sub">Confira todas as informações antes de publicar.</p>

                <div class="dst-secao">
                    <h3>Informações básicas</h3>
                    <dl class="dst-resumo">
                        <dt>Título</dt><dd data-resumo="titulo">—</dd>
                        <dt>Objetivo</dt><dd data-resumo="objetivo">—</dd>
                        <dt>Público-alvo</dt><dd data-resumo="publico_alvo">—</dd>
                        <dt>Faixa etária</dt><dd data-resumo="faixa_etaria">—</dd>
                        <dt>Categoria</dt><dd data-resumo="categoria">—</dd>
                        <dt>Duração</dt><dd data-resumo="duracao">—</dd>
                        <dt>Tags</dt><dd data-resumo="tags">—</dd>
                    </dl>
                </div>

                <div class="dst-secao">
                    <h3>Conteúdo do destaque</h3>
                    <dl class="dst-resumo">
                        <dt>Mensagem</dt><dd data-resumo="mensagem">—</dd>
                        <dt>Texto</dt><dd data-resumo="texto">—</dd>
                        <dt>CTA</dt><dd data-resumo="cta">—</dd>
                        <dt>Fontes</dt><dd data-resumo="fontes">—</dd>
                    </dl>
                </div>

                <div class="dst-secao">
                    <h3>Materiais e divulgação</h3>
                    <dl class="dst-resumo">
                        <dt>Principal</dt><dd data-resumo="principal">—</dd>
                        <dt>Outros</dt><dd data-resumo="outros">—</dd>
                    </dl>
                </div>

                <div class="dst-acoes">
                    <button type="button" class="dst-btn dst-btn--neutro" data-anterior><i data-lucide="arrow-left"></i>Voltar</button>
                    <div>
                        <button type="button" class="dst-btn dst-btn--primario" data-publicar><i data-lucide="send"></i>Publicar</button>
                    </div>
                </div>
            </section>
        </div>

        {{-- ============ Coluna da direita: prévia e dicas ============ --}}
        <div class="dst-lateral">

            <div class="dst-card dst-previa">
                <div class="dst-previa-topo">
                    <h3>Prévia do destaque</h3>
                    <button type="button" class="dst-btn dst-btn--neutro dst-btn--pequeno" data-editar>
                        <i data-lucide="pencil"></i>Editar
                    </button>
                </div>

                <div class="dst-previa-imagem" id="previa-imagem">
                    <i data-lucide="image"></i>
                    <span class="dst-chip" id="previa-categoria">Categoria</span>
                </div>

                <div class="dst-previa-corpo">
                    <h3 class="dst-previa-titulo dst-vazio" id="previa-titulo">Título do destaque</h3>
                    <p class="dst-previa-mensagem dst-vazio" id="previa-mensagem">Mensagem principal</p>
                    <p class="dst-vazio" id="previa-texto">O texto de apresentação aparece aqui conforme você digita.</p>

                    <div class="dst-previa-meta">
                        <span><i data-lucide="users"></i><b id="previa-publico">Público</b></span>
                        <span><i data-lucide="cake"></i><b id="previa-faixa">Faixa etária</b></span>
                        <span><i data-lucide="calendar-range"></i><b id="previa-duracao">Duração</b></span>
                    </div>

                    <div class="dst-previa-tags" id="previa-tags"></div>
                    <span class="dst-cta" id="previa-cta">Chamada para ação</span>
                    <div class="dst-mute dst-previa-fontes" id="previa-fontes"></div>
                </div>
            </div>

            <div class="dst-card dst-dicas">
                <h3>Dicas para seu destaque</h3>
                <p class="dst-mute">Destaques educativos ajudam a levar informação de qualidade para mulheres e jovens da nossa comunidade.</p>
                <ul>
                    <li>Use linguagem simples e acolhedora.</li>
                    <li>Baseie-se em fontes confiáveis (OMS, Ministério da Saúde).</li>
                    <li>Inclua orientações práticas de prevenção e cuidado.</li>
                    <li>Respeite a diversidade e promova a inclusão.</li>
                </ul>
            </div>
        </div>
    </form>

    {{-- Modelo de um material complementar (o JavaScript copia este bloco) --}}
    <template id="modelo-arquivo">
        <div class="dst-arquivo">
            <div class="dst-icone"><i data-lucide="file-text"></i></div>
            <div class="dst-arquivo-info">
                <b></b>
                <div class="dst-mute"></div>
            </div>
            <button type="button" class="dst-icone-btn" data-remover-material aria-label="Remover material">
                <i data-lucide="x"></i>
            </button>
        </div>
    </template>

    {{-- Confirmação de publicação --}}
    <div class="dst-modal" id="modal-publicar" role="dialog" aria-modal="true" aria-labelledby="modal-publicar-titulo">
        <div class="dst-card dst-modal-caixa">
            <div class="dst-icone dst-icone--grande"><i data-lucide="send"></i></div>
            <h3 id="modal-publicar-titulo">Publicar este destaque?</h3>
            <p>Ele ficará visível para o público selecionado assim que for publicado.</p>
            <div class="dst-modal-acoes">
                <button type="button" class="dst-btn dst-btn--neutro" data-cancelar>Cancelar</button>
                {{-- Agora envia o formulário (sem data-destino) --}}
                <button type="button" class="dst-btn dst-btn--primario" id="btn-confirmar-publicacao" data-confirmar>Confirmar publicação</button>
            </div>
        </div>
    </div>

    {{-- Modal Sim ou Não (remover peça principal / material) --}}
    <div class="dst-modal" id="modal-pergunta" role="dialog" aria-modal="true" aria-labelledby="pergunta-texto">
        <div class="dst-card dst-modal-caixa">
            <h3 id="pergunta-texto"></h3>
            <div class="dst-modal-acoes">
                <button type="button" class="dst-btn dst-btn--neutro" id="pergunta-nao">Não</button>
                <button type="button" class="dst-btn dst-btn--primario" id="pergunta-sim">Sim</button>
            </div>
        </div>
    </div>

    {{-- Aviso rápido --}}
    <div class="dst-toast" id="dst-toast" role="status" aria-live="polite">
        <i data-lucide="check-circle-2"></i><span></span>
    </div>

</div>

{{-- Envio real do formulário --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('form-destaque');
        var btnConfirmar = document.getElementById('btn-confirmar-publicacao');
        if (!form || !btnConfirmar) return;

        // Captura o clique ANTES de qualquer JS antigo (que só redirecionava para a lista)
        // e envia o formulário de verdade.
        document.addEventListener('click', function (e) {
            if (!e.target.closest('#btn-confirmar-publicacao')) return;
            e.preventDefault();
            e.stopPropagation();

            btnConfirmar.disabled = true;
            form.submit();
        }, true);
    });
</script>
@endsection