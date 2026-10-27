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

    @foreach($destaque as $d)
        <article class="dst-card dst-destaque">
            <div class="dst-destaque-info">
                <div class="dst-destaque-titulo">
                    <h2>{{ $d->tituloDestaque }}</h2>
                    <span class="dst-chip {{ $d->statusDestaque === 'ativa' ? 'dst-chip--ok' : '' }}">{{ $d->status_texto }}</span>
                </div>

                <p class="dst-mute dst-categoria">{{ $d->categoria_texto }}</p>

                <dl class="dst-resumo">
                    <dt>Objetivo</dt>
                    <dd>{{ $d->objetivoDestaque }}</dd>

                    <dt>Público</dt>
                    <dd>{{ $d->publico_texto }}</dd>

                    <dt>Período</dt>
                    <dd>{{ $d->periodo_texto }}</dd>

                    <dt>Chamada</dt>
                    <dd>{{ $d->ctaDestaque }}</dd>

                    <dt>Tags</dt>
                    <dd>
                        @forelse (($d->tagsDestaque ?? []) as $tag)
                            <span class="dst-chip">#{{ $tag }}</span>
                        @empty
                            —
                        @endforelse
                    </dd>
                </dl>
            </div>

            {{-- Degradê com a mensagem principal do destaque --}}
            <div class="dst-imagem">{{ $d->mensagemprincipalDestaque }}</div>
        </article>
    @endforeach

    </div>
</div>
@endsection