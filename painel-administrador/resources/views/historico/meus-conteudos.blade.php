
@extends('layouts.app')

@section('titulo', 'Meus conteúdos - Painel Administrativo - Vênus')

@push('css')
<link rel="stylesheet" href="{{ asset('css/destaque.css') }}">
@endpush

@section('content')

<div class="dst-page">

    {{-- Cabeçalho --}}
    <div class="dst-topo dst-topo--botao">

        <div class="dst-topo-texto">
            <h1>Meus conteúdos</h1>
            <p class="dst-mute">
                Gerencie seus artigos, vídeos e infográficos.
            </p>
        </div>

        <a href="{{ route('conteudo.criar') }}"
           class="dst-btn dst-btn--primario">

            <i data-lucide="plus"></i>
            Criar conteúdo

        </a>

    </div>


    {{-- Filtros --}}
    <div class="dst-filtros" id="pc-filtros">

        <button type="button"
                class="dst-filtro is-on"
                data-filtro="todos">
            Todos
        </button>

        <button type="button"
                class="dst-filtro"
                data-filtro="rascunho">

            Rascunhos

        </button>

        <button type="button"
                class="dst-filtro"
                data-filtro="revisao">

            Em Revisão

        </button>

        <button type="button"
                class="dst-filtro"
                data-filtro="publicado">

            Publicados

        </button>

        <button type="button"
                class="dst-filtro"
                data-filtro="recusado">

            Recusados

        </button>

    </div>


    {{-- Grade de conteúdos --}}
    <div class="dst-grade" id="pc-grade">

        @forelse ($conteudos as $conteudo)

            @php

                $status = $conteudo->statusConteudo;

                $filtroStatus = $status === 'em_revisao'
                    ? 'revisao'
                    : $status;

                $nomeStatus = [
                    'rascunho' => 'Rascunho',
                    'em_revisao' => 'Em revisão',
                    'publicado' => 'Publicado',
                    'recusado' => 'Recusado',
                ][$status] ?? 'Indefinido';

                $classeStatus = [
                    'rascunho' => 'dst-chip--aviso',
                    'em_revisao' => 'dst-chip--aviso',
                    'publicado' => 'dst-chip--ok',
                    'recusado' => 'dst-chip--aviso',
                ][$status] ?? '';

                $resumo = $conteudo->objetivoConteudo
                    ?: $conteudo->corpoConteudo;

            @endphp


            <article class="dst-card dst-conteudo"
                     data-status="{{ $filtroStatus }}">

                {{-- Capa --}}
                @if ($conteudo->capaConteudo)

                    <div class="dst-conteudo-capa"
                         style="
                            background-image: url('{{ asset('storage/' . $conteudo->capaConteudo) }}');
                            background-size: cover;
                            background-position: center;
                         ">
                    </div>

                @else

                    <div class="dst-conteudo-capa">
                        {{ $conteudo->tituloConteudo }}
                    </div>

                @endif


                {{-- Informações --}}
                <div class="dst-conteudo-corpo">

                    {{-- Categoria --}}
                    <span class="dst-chip">
                        {{ $conteudo->nomeTipoCategoria ?? 'Sem categoria' }}
                    </span>


                    {{-- Título --}}
                    <h2>
                        {{ $conteudo->tituloConteudo }}
                    </h2>


                    {{-- Resumo --}}
                    <p class="dst-mute">
                        {{ \Illuminate\Support\Str::limit(strip_tags($resumo ?? ''), 120) }}
                    </p>


                    {{-- Formato --}}
                    <p class="dst-mute">
                        {{ $conteudo->descricaoTipoConteudo }}
                    </p>


                    {{-- Rodapé --}}
                    <div class="dst-conteudo-rodape">

                        <span class="dst-chip {{ $classeStatus }}">
                            {{ $nomeStatus }}
                        </span>

                        @if ($status === 'publicado')

                            <span class="dst-mute">
                                {{ number_format($conteudo->visualizacoesConteudo, 0, ',', '.') }}
                                visualizações
                            </span>

                        @else

                            <span class="dst-mute">
                                {{ $conteudo->dataCriacao
                                    ? \Carbon\Carbon::parse($conteudo->dataCriacao)->format('d/m/Y')
                                    : '' }}
                            </span>

                        @endif

                    </div>

                </div>

            </article>

        @empty

            <p class="dst-mute">
                Você ainda não criou nenhum conteúdo.
            </p>

        @endforelse

    </div>


    {{-- Mensagem quando o filtro não encontra resultados --}}
    <p class="dst-mute dst-vazio-lista"
       id="pc-vazio"
       hidden>

        Nenhum conteúdo nesta categoria.

    </p>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    if (window.lucide) {
        window.lucide.createIcons();
    }

    const filtros = document.querySelectorAll(
        '#pc-filtros .dst-filtro'
    );

    const cartoes = document.querySelectorAll(
        '#pc-grade .dst-conteudo'
    );

    const vazio = document.getElementById('pc-vazio');

    function aplicarFiltro(escolhido) {

        let visiveis = 0;

        cartoes.forEach(cartao => {

            const mostrar =
                escolhido === 'todos' ||
                cartao.dataset.status === escolhido;

            cartao.hidden = !mostrar;

            if (mostrar) {
                visiveis++;
            }

        });

        vazio.hidden = visiveis > 0;

    }


    filtros.forEach(filtro => {

        filtro.addEventListener('click', function () {

            const escolhido = this.dataset.filtro;

            // Atualiza botão selecionado
            filtros.forEach(botao => {

                botao.classList.toggle(
                    'is-on',
                    botao === this
                );

            });

            aplicarFiltro(escolhido);

        });

    });
=

    aplicarFiltro('todos');

});

</script>

@endpush
