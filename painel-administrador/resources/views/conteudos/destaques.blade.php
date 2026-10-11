@extends('layouts.app')

@section('titulo', 'Destaques - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/destaque.css') }}">
@endpush

@section('content')
<div class="dst-page">

    {{-- Título + botão criar --}}
    <div class="dst-topo">
        <h1>Destaques - principal</h1>
        <a href="{{ url('criar-destaque') }}" class="dst-btn dst-btn--primario">
            <i data-lucide="plus"></i>Criar
        </a>
    </div>

    {{-- Lista de destaques --}}
    <div class="dst-lista">

        {{-- Exemplo estático: trocar por @foreach quando tiver o back-end (um <article> por destaque) --}}
        <article class="dst-card dst-destaque">
            <div class="dst-destaque-info">
                <div class="dst-destaque-titulo">
                    <h2>Proteja-se: ISTs podem ser prevenidas</h2>
                    <span class="dst-chip dst-chip--ok">Publicado</span>
                </div>

                <p class="dst-mute dst-categoria">ISTs (Infecções Sexualmente Transmissíveis)</p>

                <dl class="dst-resumo">
                    <dt>Objetivo</dt>
                    <dd>Conscientizar sobre as infecções e a importância do diagnóstico precoce.</dd>

                    <dt>Público</dt>
                    <dd>Adolescentes e jovens (14 a 25 anos)</dd>

                    <dt>Período</dt>
                    <dd>01/07/2025 a 31/07/2025</dd>

                    <dt>Chamada</dt>
                    <dd>Prevenir é um ato de amor</dd>

                    <dt>Tags</dt>
                    <dd>
                        <span class="dst-chip">#ISTs</span>
                        <span class="dst-chip">#Prevenção</span>
                        <span class="dst-chip">#Saúde Sexual</span>
                        <span class="dst-chip">#Teste</span>
                    </dd>
                </dl>
            </div>

            {{-- Degradê com a mensagem principal do destaque --}}
            <div class="dst-imagem">Proteja-se: ISTs podem ser prevenidas!</div>
        </article>

    </div>
</div>
@endsection