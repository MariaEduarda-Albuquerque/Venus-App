@extends('layouts.app')

@section('titulo', ($nome ?? 'GRC') . ' - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/em-construcao.css') }}">
@endpush

@section('content')
<section class="ec-page">
    <div class="ec-icone"><i data-lucide="construction"></i></div>

    <h1>GRC</h1>
    <p>Esta tela não faz parte da prévia.</p>

    <a href="{{ url('/') }}" class="ec-btn">Voltar ao painel</a>
</section>
@endsection
