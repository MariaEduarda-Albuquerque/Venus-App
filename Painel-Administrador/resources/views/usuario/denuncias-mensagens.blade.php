@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
@endpush

@section('content')

<div class="lst-page">

    <div class="lst-topo">
        <h1>Mensagens denunciadas</h1>

        <div class="lst-abas">
            <a class="lst-aba" href="/denuncias"><i data-lucide="list-checks"></i>Denúncias</a>
            <a class="lst-aba is-active" href="/denuncias-mensagens">
                <i data-lucide="message-square-warning"></i>Mensagens denunciadas
                <span class="lst-aba-badge" id="m-badge">0</span>
            </a>
        </div>
    </div>

    <div class="lst-card">
        <div class="lst-barra lst-barra--entre">
            <div class="lst-abas" id="m-abas">
                <button type="button" class="lst-aba is-active" data-ms="p">Pendentes <span class="lst-aba-badge" id="m-pend">0</span></button>
                <button type="button" class="lst-aba" data-ms="a">Aceitas</button>
                <button type="button" class="lst-aba" data-ms="x">Recusadas</button>
            </div>

            <label class="lst-busca">
                <i data-lucide="search"></i>
                <input type="text" id="m-busca" placeholder="Pesquisar…">
            </label>
        </div>

        <div class="lst-msgs" id="m-lista"></div>
    </div>

    <div class="lst-toast" id="toast"><i data-lucide="check-circle-2"></i><span></span></div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/denuncias-mensagens.js') }}"></script>
@endpush