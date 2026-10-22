@extends('layouts.app')

@section('titulo', 'Criar conteúdo - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/destaque.css') }}">
@endpush

@section('content')
<div class="dst-page">

    {{-- Título + subtítulo (esquerda) e botão de voltar (canto superior direito) --}}
    <div class="dst-topo dst-topo--botao">
        <div class="dst-topo-texto">
            <h1>Criar conteúdo</h1>
            <p class="dst-mute">Escreva artigos, vídeos e infográficos para a revisão editorial.</p>
        </div>

        {{-- TODO (back-end): confirmar a URL da tela "Meus conteúdos" --}}
        <a href="/meus-conteudos" class="dst-btn dst-btn--neutro"><i data-lucide="arrow-left"></i>Meus conteúdos</a>
    </div>

    {{-- TODO (back-end): colocar method="POST", action e @csrf --}}
    <form class="dst-trabalho" id="form-conteudo" enctype="multipart/form-data" novalidate
          data-destino="{{ url('meus-conteudos') }}">

        {{-- ============ Coluna da esquerda: o formulário ============ --}}
        <div class="dst-card">

            <h3 class="dst-etapa-titulo">Informações do conteúdo</h3>

            {{-- Título --}}
            <div class="dst-campo" data-campo="titulo">
                <label for="titulo">Título <em>*</em></label>
                <div class="dst-entrada">
                    <input id="titulo" name="titulo" maxlength="100" placeholder="Ex.: Saúde menstrual: tudo que você precisa saber">
                    <span class="dst-contador">0/100</span>
                </div>
                <span class="dst-erro">Informe o título do conteúdo.</span>
            </div>

            {{-- Categoria --}}
            <div class="dst-campo" data-campo="categoria">
                <label for="categoria">Categoria <em>*</em></label>
                <select id="categoria" name="categoria">
                    <option value="">Selecione</option>
                    <option>Corpo</option>
                    <option>Saúde mental</option>
                    <option>Contraceptivos</option>
                    <option>ISTs</option>
                    <option>Gravidez e pós-parto</option>
                    <option>Direitos e acolhimento</option>
                </select>
                <span class="dst-erro">Selecione a categoria.</span>
            </div>

            {{-- Formato: artigo, vídeo ou infográfico --}}
            <div class="dst-campo">
                <label id="rotulo-formato">Formato <em>*</em></label>
                <div class="dst-filtros" id="pc-formatos" role="radiogroup" aria-labelledby="rotulo-formato">
                    <button type="button" class="dst-filtro is-on" role="radio" aria-checked="true" data-formato="Artigo">Artigo</button>
                    <button type="button" class="dst-filtro" role="radio" aria-checked="false" data-formato="Vídeo">Vídeo</button>
                    <button type="button" class="dst-filtro" role="radio" aria-checked="false" data-formato="Infográfico">Infográfico</button>
                </div>
                <input type="hidden" name="formato" id="formato-valor" value="Artigo">
            </div>

            {{-- Capa --}}
            <div class="dst-campo" data-campo="capa">
                <label>Capa <em>*</em></label>

                {{-- Sem arquivo --}}
                <button type="button" class="dst-soltar" id="capa-vazio" data-escolher-capa>
                    <i data-lucide="image-up"></i>
                    <b>Enviar capa</b>
                    <span class="dst-mute">PNG ou JPG, clique para escolher</span>
                </button>

                {{-- Com arquivo --}}
                <div class="dst-arquivo dst-arquivo--grande" id="capa-arquivo" hidden>
                    <div class="dst-miniatura" id="capa-miniatura"><i data-lucide="image"></i></div>
                    <div class="dst-arquivo-info">
                        <b id="capa-nome"></b>
                        <div class="dst-mute" id="capa-tamanho"></div>
                        <div class="dst-ok">Enviado com sucesso</div>
                    </div>
                    <button type="button" class="dst-btn dst-btn--neutro dst-btn--pequeno" data-escolher-capa>Substituir</button>
                    <button type="button" class="dst-icone-btn" data-remover-capa aria-label="Remover capa">
                        <i data-lucide="trash-2"></i>
                    </button>
                </div>

                <span class="dst-erro">Envie a capa para enviar à revisão.</span>
                <input type="file" id="arquivo-capa" name="capa" accept="image/*" hidden>
            </div>

            {{-- Texto --}}
            <div class="dst-campo" data-campo="texto">
                <label for="texto">Texto <em>*</em></label>
                <div class="dst-entrada">
                    <textarea id="texto" name="texto" class="dst-texto-grande" maxlength="8000"
                              placeholder="Escreva o artigo. Use parágrafos curtos e linguagem simples."></textarea>
                    <span class="dst-contador">0/8000</span>
                </div>
                <span class="dst-erro">Escreva o texto do conteúdo.</span>
            </div>

            {{-- Tempo de leitura (calculado sozinho, só para ver) --}}
            <div class="dst-campo">
                <label>Tempo de leitura <span class="dst-mute">(calculado automaticamente)</span></label>
                <div class="dst-leitura">
                    <i data-lucide="clock"></i>
                    <b id="pc-leitura">—</b>
                    <span class="dst-mute" id="pc-palavras">0 palavras</span>
                </div>
                <input type="hidden" name="tempo_leitura" id="tempo-leitura-valor" value="0">
            </div>

            {{-- Fontes e referências --}}
            <div class="dst-campo" data-campo="fontes">
                <label for="fontes">Fontes e referências <em>*</em></label>
                <div class="dst-entrada">
                    <textarea id="fontes" name="fontes" maxlength="500"
                              placeholder="Uma por linha. Ex.: Ministério da Saúde (saude.gov.br)"></textarea>
                    <span class="dst-contador">0/500</span>
                </div>
                <span class="dst-erro">Cite ao menos uma fonte ou referência.</span>
            </div>

            {{-- Ações --}}
            <div class="dst-acoes">
                <div>
                    <button type="button" class="dst-btn dst-btn--neutro" data-rascunho>
                        <i data-lucide="save"></i>Salvar rascunho
                    </button>
                </div>
                <div>
                    <button type="button" class="dst-btn dst-btn--primario" data-enviar>
                        <i data-lucide="send"></i>Enviar
                    </button>
                </div>
            </div>
        </div>

        {{-- ============ Coluna da direita: prévia e dicas ============ --}}
        <div class="dst-lateral">

            <div>
                <p class="dst-rotulo">Prévia do conteúdo <span class="dst-mute">· como aparece em Meus conteúdos</span></p>

                <article class="dst-card dst-conteudo">
                    <div class="dst-conteudo-capa" id="pc-capa"><span id="pc-capa-texto">Capa do conteúdo</span></div>
                    <div class="dst-conteudo-corpo">
                        <span class="dst-chip" id="pc-categoria">Categoria · Artigo</span>
                        <h2 class="dst-vazio" id="pc-titulo">Título do conteúdo</h2>
                        <p class="dst-mute dst-vazio" id="pc-resumo">O resumo aparece aqui conforme você escreve o texto.</p>
                        <div class="dst-conteudo-rodape">
                            <span class="dst-chip">Rascunho</span>
                            <span class="dst-mute" id="pc-tempo">Tempo de leitura automático</span>
                        </div>
                    </div>
                </article>
            </div>

            <div class="dst-card dst-dicas">
                <h3>Dicas para seu conteúdo</h3>
                <p class="dst-mute">Conteúdos claros e bem fundamentados ajudam a cuidar da saúde de quem usa a Vênus.</p>
                <ul>
                    <li>Escolha um título claro e acolhedor.</li>
                    <li>Use linguagem simples e explique termos técnicos.</li>
                    <li>Cite fontes confiáveis (OMS, Ministério da Saúde).</li>
                    <li>O conteúdo passa por revisão editorial antes de ser publicado.</li>
                </ul>
            </div>
        </div>
    </form>

    {{-- Confirmação de envio para revisão --}}
    <div class="dst-modal" id="modal-enviar" role="dialog" aria-modal="true" aria-labelledby="modal-enviar-titulo">
        <div class="dst-card dst-modal-caixa">
            <div class="dst-icone dst-icone--grande"><i data-lucide="send"></i></div>
            <h3 id="modal-enviar-titulo">Enviar para revisão?</h3>
            <p>A equipe editorial vai analisar o conteúdo. Depois de enviado, ele não pode ser editado até a revisão terminar.</p>
            <div class="dst-modal-acoes">
                <button type="button" class="dst-btn dst-btn--neutro" data-cancelar>Cancelar</button>
                {{-- TODO (back-end): trocar por envio do formulário. Por enquanto só volta para a lista. --}}
                <button type="button" class="dst-btn dst-btn--primario" data-confirmar>Enviar</button>
            </div>
        </div>
    </div>

    {{-- Modal Sim ou Não (remover a capa) --}}
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
@endsection

@push('scripts')
    <script src="{{ asset('js/criar-conteudo.js') }}"></script>
@endpush