@extends('layouts.app')

{{-- O nome vem da rota (veja o exemplo no fim). Se preferir copiar o arquivo, é só trocar 'Relatório' abaixo. --}}
@section('titulo', ($nome ?? 'Logística') . ' - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/em-construcao.css') }}">
@endpush

@section('content')
<section class="ec-page">
    <div class="ec-icone"><i data-lucide="construction"></i></div>

    <h1>Logística</h1>
    <p>Esta tela não faz parte da prévia.</p>

    <a href="{{ url('/') }}" class="ec-btn">Voltar ao painel</a>
</section>
@endsection
