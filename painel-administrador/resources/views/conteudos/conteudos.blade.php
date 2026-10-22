@extends('layouts.app')

@section('titulo', 'Publicação de conteúdo - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/destaque.css') }}">
@endpush

@section('content')
<div class="dst-page">

    {{-- Título + subtítulo --}}
    <div class="dst-topo dst-topo--coluna">
        <h1>Publicação de conteúdo</h1>
        <p class="dst-mute">Crie artigos, vídeos e infográficos para a revisão editorial.</p>
    </div>

    {{-- Filtros --}}
    <div class="dst-filtros" id="pc-filtros">
        <button type="button" class="dst-filtro is-on" data-filtro="todos">Todos</button>
        <button type="button" class="dst-filtro" data-filtro="rascunho">Rascunhos</button>
        <button type="button" class="dst-filtro" data-filtro="revisao">Em Revisão</button>
        <button type="button" class="dst-filtro" data-filtro="publicado">Publicados</button>
        <button type="button" class="dst-filtro" data-filtro="recusado">Recusados</button>
    </div>

    {{-- Grade de conteúdos --}}
    <div class="dst-grade" id="pc-grade">

        {{-- Exemplo estático: trocar por @foreach quando tiver o back-end (um <article> por conteúdo) --}}
        <article class="dst-card dst-conteudo" data-status="publicado">
            <div class="dst-conteudo-capa">Saúde<br>Menstrual</div>
            <div class="dst-conteudo-corpo">
                <span class="dst-chip">Corpo</span>
                <h2>Saúde menstrual: tudo que você precisa saber</h2>
                <p class="dst-mute">Artigo educativo para o catálogo da Vênus.</p>
                <div class="dst-conteudo-rodape">
                    <span class="dst-chip dst-chip--ok">Publicado</span>
                    <span class="dst-mute">1.145 visualizações</span>
                </div>
            </div>
        </article>

        <article class="dst-card dst-conteudo" data-status="revisao">
            <div class="dst-conteudo-capa">Conversar<br>sem medo</div>
            <div class="dst-conteudo-corpo">
                <span class="dst-chip">Saúde mental</span>
                <h2>Como conversar sobre seu corpo sem tabu</h2>
                <p class="dst-mute">Conteúdo em revisão editorial.</p>
                <div class="dst-conteudo-rodape">
                    <span class="dst-chip dst-chip--aviso">Em revisão</span>
                    <span class="dst-mute">Ainda sem visualizações</span>
                </div>
            </div>
        </article>

        <article class="dst-card dst-conteudo" data-status="publicado">
            <div class="dst-conteudo-capa">Anticoncepcionais</div>
            <div class="dst-conteudo-corpo">
                <span class="dst-chip">Contraceptivos</span>
                <h2>Anticoncepcionais: mitos e verdades</h2>
                <p class="dst-mute">Artigo educativo para o catálogo da Vênus.</p>
                <div class="dst-conteudo-rodape">
                    <span class="dst-chip dst-chip--ok">Publicado</span>
                    <span class="dst-mute">7.877 visualizações</span>
                </div>
            </div>
        </article>

    </div>

    <p class="dst-mute dst-vazio-lista" id="pc-vazio" hidden>Nenhum conteúdo nesta categoria.</p>
</div>
@endsection

@push('scripts')
<script>
// Filtros: mostra só os cartões do status escolhido
(function () {
    const filtros = document.querySelectorAll('#pc-filtros .dst-filtro');
    const cartoes = document.querySelectorAll('#pc-grade .dst-conteudo');
    const vazio = document.getElementById('pc-vazio');

    for (let i = 0; i < filtros.length; i++) {
        filtros[i].addEventListener('click', function () {
            const escolhido = filtros[i].dataset.filtro;
            let visiveis = 0;

            for (let j = 0; j < filtros.length; j++) {
                filtros[j].classList.toggle('is-on', filtros[j] === filtros[i]);
            }
            for (let j = 0; j < cartoes.length; j++) {
                const mostrar = escolhido === 'todos' || cartoes[j].dataset.status === escolhido;
                cartoes[j].hidden = !mostrar;
                if (mostrar) {
                    visiveis++;
                }
            }
            vazio.hidden = visiveis > 0;
        });
    }
})();
</script>
@endpush