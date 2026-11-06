
@extends('layouts.app')

@section('titulo', 'Criar conteúdo - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/destaque.css') }}">
@endpush

@section('content')

@php
    $primeiroFormato = $formatos->first();
    $formatoSelecionado = old(
        'formato',
        $primeiroFormato?->codTipoConteudo
    );
@endphp

<div class="dst-page">

    {{-- Cabeçalho --}}
    <div class="dst-topo dst-topo--botao">

        <div class="dst-topo-texto">
            <h1>Criar conteúdo</h1>

            <p class="dst-mute">
                Crie artigos, vídeos e infográficos para compartilhar
                informações de saúde.
            </p>
        </div>

        <a href="{{ url('/meus-conteudos') }}"
           class="dst-btn dst-btn--neutro">

            <i data-lucide="arrow-left"></i>
            Meus conteúdos

        </a>

    </div>

    {{-- Formulário --}}
    <form
        class="dst-trabalho"
        id="form-conteudo"
        method="POST"
        action="{{ route('conteudo.store') }}"
        enctype="multipart/form-data"
        novalidate
    >

        @csrf

        <input
            type="hidden"
            name="acao"
            id="acao-conteudo"
            value="rascunho"
        >

        {{-- Coluna esquerda --}}
        <div class="dst-card">

            <h3 class="dst-etapa-titulo">
                Informações do conteúdo
            </h3>

            {{-- Título --}}
            <div class="dst-campo" data-campo="titulo">

                <label for="titulo">
                    Título <em>*</em>
                </label>

                <div class="dst-entrada">

                    <input
                        id="titulo"
                        name="titulo"
                        maxlength="150"
                        value="{{ old('titulo') }}"
                        placeholder="Ex.: Saúde menstrual: tudo que você precisa saber"
                    >

                    <span class="dst-contador">0/150</span>

                </div>

                <span class="dst-erro">
                    Informe o título do conteúdo.
                </span>

            </div>

            {{-- Categoria --}}
            <div class="dst-campo" data-campo="categoria">

                <label for="categoria">
                    Categoria <em>*</em>
                </label>

                <select id="categoria" name="categoria">

                    <option value="">Selecione</option>

                    @foreach($categorias as $categoria)

                        <option
                            value="{{ $categoria->codTipoCategoria }}"
                            @selected(old('categoria') == $categoria->codTipoCategoria)
                        >
                            {{ $categoria->nomeTipoCategoria }}
                        </option>

                    @endforeach

                </select>

                <span class="dst-erro">
                    Selecione a categoria.
                </span>

            </div>

            {{-- Formato --}}
            <div class="dst-campo">

                <label id="rotulo-formato">
                    Formato <em>*</em>
                </label>

                <div
                    class="dst-filtros"
                    id="pc-formatos"
                    role="radiogroup"
                    aria-labelledby="rotulo-formato"
                >

                    @foreach($formatos as $formato)

                        <button
                            type="button"
                            class="dst-filtro {{ $formatoSelecionado == $formato->codTipoConteudo ? 'is-on' : '' }}"
                            role="radio"
                            aria-checked="{{ $formatoSelecionado == $formato->codTipoConteudo ? 'true' : 'false' }}"
                            data-formato="{{ $formato->codTipoConteudo }}"
                        >
                            {{ $formato->descricaoTipoConteudo }}
                        </button>

                    @endforeach

                </div>

                <input
                    type="hidden"
                    name="formato"
                    id="formato-valor"
                    value="{{ $formatoSelecionado }}"
                >

            </div>

            {{-- Capa --}}
            <div class="dst-campo" data-campo="capa">

                <label>
                    Capa <em>*</em>
                </label>

                {{-- Sem arquivo --}}
                <button
                    type="button"
                    class="dst-soltar"
                    id="capa-vazio"
                    data-escolher-capa
                >

                    <i data-lucide="image-up"></i>

                    <b>Enviar capa</b>

                    <span class="dst-mute">
                        PNG, JPG ou WEBP, clique para escolher
                    </span>

                </button>

                {{-- Com arquivo --}}
                <div
                    class="dst-arquivo dst-arquivo--grande"
                    id="capa-arquivo"
                    hidden
                >

                    <div
                        class="dst-miniatura"
                        id="capa-miniatura"
                    >
                        <i data-lucide="image"></i>
                    </div>

                    <div class="dst-arquivo-info">

                        <b id="capa-nome"></b>

                        <div
                            class="dst-mute"
                            id="capa-tamanho"
                        ></div>

                        <div class="dst-ok">
                            Arquivo selecionado
                        </div>

                    </div>

                    <button
                        type="button"
                        class="dst-btn dst-btn--neutro dst-btn--pequeno"
                        data-escolher-capa
                    >
                        Substituir
                    </button>

                    <button
                        type="button"
                        class="dst-icone-btn"
                        data-remover-capa
                        aria-label="Remover capa"
                    >
                        <i data-lucide="trash-2"></i>
                    </button>

                </div>

                <span class="dst-erro">
                    Envie uma capa para publicar o conteúdo.
                </span>

                <input
                    type="file"
                    id="arquivo-capa"
                    name="capa"
                    accept="image/jpeg,image/png,image/webp"
                    hidden
                >

            </div>

            {{-- Texto --}}
            <div class="dst-campo" data-campo="texto">

                <label for="texto">
                    Texto <em>*</em>
                </label>

                <div class="dst-entrada">

                    <textarea
                        id="texto"
                        name="texto"
                        class="dst-texto-grande"
                        maxlength="8000"
                        placeholder="Escreva o artigo. Use parágrafos curtos e linguagem simples."
                    >{{ old('texto') }}</textarea>

                    <span class="dst-contador">
                        0/8000
                    </span>

                </div>

                <span class="dst-erro">
                    Escreva o texto do conteúdo.
                </span>

            </div>

            {{-- Tempo de leitura --}}
            <div class="dst-campo">

                <label>
                    Tempo de leitura
                    <span class="dst-mute">
                        (calculado automaticamente)
                    </span>
                </label>

                <div class="dst-leitura">

                    <i data-lucide="clock"></i>

                    <b id="pc-leitura">—</b>

                    <span
                        class="dst-mute"
                        id="pc-palavras"
                    >
                        0 palavras
                    </span>

                </div>

                <input
                    type="hidden"
                    name="tempo_leitura"
                    id="tempo-leitura-valor"
                    value="0"
                >

            </div>

            {{-- Fontes --}}
            <div class="dst-campo" data-campo="fontes">

                <label for="fontes">
                    Fontes e referências <em>*</em>
                </label>

                <div class="dst-entrada">

                    <textarea
                        id="fontes"
                        name="fontes"
                        maxlength="500"
                        placeholder="Uma por linha. Ex.: Ministério da Saúde (saude.gov.br)"
                    >{{ old('fontes') }}</textarea>

                    <span class="dst-contador">
                        0/500
                    </span>

                </div>

                <span class="dst-erro">
                    Cite ao menos uma fonte ou referência.
                </span>

            </div>

            {{-- Ações --}}
            <div class="dst-acoes">

                <div>

                    <button
                        type="button"
                        class="dst-btn dst-btn--neutro"
                        data-rascunho
                    >

                        <i data-lucide="save"></i>
                        Salvar rascunho

                    </button>

                </div>

                <div>

                    <button
                        type="button"
                        class="dst-btn dst-btn--primario"
                        data-enviar
                    >

                        <i data-lucide="send"></i>
                        Publicar

                    </button>

                </div>

            </div>

        </div>

        {{-- Coluna direita --}}
        <div class="dst-lateral">

            {{-- Prévia --}}
            <div>

                <p class="dst-rotulo">

                    Prévia do conteúdo

                    <span class="dst-mute">
                        · como aparece em Meus conteúdos
                    </span>

                </p>

                <article class="dst-card dst-conteudo">

                    <div
                        class="dst-conteudo-capa"
                        id="pc-capa"
                    >
                        <span id="pc-capa-texto">
                            Capa do conteúdo
                        </span>
                    </div>

                    <div class="dst-conteudo-corpo">

                        <span
                            class="dst-chip"
                            id="pc-categoria"
                        >
                            Categoria · Formato
                        </span>

                        <h2
                            class="dst-vazio"
                            id="pc-titulo"
                        >
                            Título do conteúdo
                        </h2>

                        <p
                            class="dst-mute dst-vazio"
                            id="pc-resumo"
                        >
                            O resumo aparece aqui conforme você escreve
                            o texto.
                        </p>

                        <div class="dst-conteudo-rodape">

                            <span class="dst-chip">
                                Rascunho
                            </span>

                            <span
                                class="dst-mute"
                                id="pc-tempo"
                            >
                                Tempo de leitura automático
                            </span>

                        </div>

                    </div>

                </article>

            </div>

            {{-- Dicas --}}
            <div class="dst-card dst-dicas">

                <h3>Dicas para seu conteúdo</h3>

                <p class="dst-mute">
                    Conteúdos claros e bem fundamentados ajudam
                    a cuidar da saúde de quem usa a Vênus.
                </p>

                <ul>

                    <li>
                        Escolha um título claro e acolhedor.
                    </li>

                    <li>
                        Use linguagem simples e explique termos técnicos.
                    </li>

                    <li>
                        Cite fontes confiáveis (OMS, Ministério da Saúde).
                    </li>

                    <li>
                        Revise as informações e as fontes antes de publicar.
                    </li>

                </ul>

            </div>

        </div>

    </form>

    {{-- Modal de confirmação de publicação --}}
    <div
        class="dst-modal"
        id="modal-publicar"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-publicar-titulo"
    >

        <div class="dst-card dst-modal-caixa">

            <div class="dst-icone dst-icone--grande">
                <i data-lucide="send"></i>
            </div>

            <h3 id="modal-publicar-titulo">
                Publicar conteúdo?
            </h3>

            <p>
                O conteúdo será publicado diretamente e ficará
                disponível conforme as regras de exibição da plataforma.
            </p>

            <div class="dst-modal-acoes">

                <button
                    type="button"
                    class="dst-btn dst-btn--neutro"
                    data-cancelar-publicacao
                >
                    Cancelar
                </button>

                <button
                    type="button"
                    class="dst-btn dst-btn--primario"
                    data-confirmar-publicacao
                >
                    Confirmar publicação
                </button>

            </div>

        </div>

    </div>

    {{-- Modal para remover capa --}}
    <div
        class="dst-modal"
        id="modal-pergunta"
        role="dialog"
        aria-modal="true"
        aria-labelledby="pergunta-texto"
    >

        <div class="dst-card dst-modal-caixa">

            <h3 id="pergunta-texto"></h3>

            <div class="dst-modal-acoes">

                <button
                    type="button"
                    class="dst-btn dst-btn--neutro"
                    id="pergunta-nao"
                >
                    Não
                </button>

                <button
                    type="button"
                    class="dst-btn dst-btn--primario"
                    id="pergunta-sim"
                >
                    Sim
                </button>

            </div>

        </div>

    </div>

    {{-- Toast --}}
    <div
        class="dst-toast"
        id="dst-toast"
        role="status"
        aria-live="polite"
    >

        <i data-lucide="check-circle-2"></i>

        <span></span>

    </div>

</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/criar-conteudo.js') }}"></script>
@endpush
