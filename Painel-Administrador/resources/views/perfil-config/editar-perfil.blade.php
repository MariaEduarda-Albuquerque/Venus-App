@extends('layouts.sidebar-perfil')

@section('title', 'Editar perfil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/editar-perfil.css') }}">
@endpush

@section('content')

<div class="edp-pagina">
<form class="edp-card" action="/perfil/atualizar" method="post">
    @csrf

    {{-- Cabeçalho --}}
    <div class="edp-topo">
        <div>
            <h1 class="edp-titulo">Editar informações pessoais</h1>
            <p class="edp-subtitulo">Atualize seus dados para manter seu perfil atualizado.</p>
        </div>

        <a href="/perfil-adm" class="edp-voltar" aria-label="Voltar">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M20 12H5"></path>
                <path d="m11 6-6 6 6 6"></path>
            </svg>
        </a>
    </div>

    {{-- Informações pessoais --}}
    <h2 class="edp-secao">Informações pessoais</h2>
    <div class="edp-grid">
        <div class="edp-campo edp-campo--largo">
            <label for="nomeAdmin">Nome</label>
            <input type="text" id="nomeAdmin" name="nomeAdmin"
                   value="{{ old('nomeAdmin', $admin->nomeAdmin) }}" placeholder="Nome">
        </div>
        <div class="edp-campo">
            <label for="emailAdmin">Endereço de email</label>
            <input type="email" id="emailAdmin" name="emailAdmin"
                   value="{{ old('emailAdmin', $admin->emailAdmin) }}" placeholder="email@gmail.com">
        </div>
        <div class="edp-campo">
            <label for="telAdmin">Telefone</label>
            <input type="text" id="telAdmin" name="telAdmin"
                   value="{{ old('telAdmin', $admin->telAdmin) }}" placeholder="11 99999-9999">
        </div>
    </div>

    {{-- Endereço --}}
    <h2 class="edp-secao">Endereço</h2>
    <div class="edp-grid">
        <div class="edp-campo">
            <label for="paisAdmin">País</label>
            <input type="text" id="paisAdmin" name="paisAdmin"
                   value="{{ old('paisAdmin', $admin->paisAdmin) }}" placeholder="Brasil">
        </div>
        <div class="edp-campo">
            <label for="cidadeAdmin">Cidade/Estado</label>
            <div class="edp-duplo">
                <input type="text" id="cidadeAdmin" name="cidadeAdmin"
                       value="{{ old('cidadeAdmin', $admin->cidadeAdmin) }}" placeholder="São Paulo">
                <input type="text" id="ufAdmin" name="ufAdmin" maxlength="2"
                       value="{{ old('ufAdmin', $admin->ufAdmin) }}" placeholder="SP" aria-label="Estado (UF)">
            </div>
        </div>
        <div class="edp-campo">
            <label for="cepAdmin">Código postal</label>
            <input type="text" id="cepAdmin" name="cepAdmin"
                   value="{{ old('cepAdmin', $admin->cepAdmin) }}" placeholder="01100-000">
        </div>
        <div class="edp-campo">
            <label for="nrFiscalAdmin">N°Fiscal</label>
            <input type="text" id="nrFiscalAdmin" name="nrFiscalAdmin"
                   value="{{ old('nrFiscalAdmin', $admin->nrFiscalAdmin) }}" placeholder="000.123.456">
        </div>
    </div>

    @if ($errors->any())
        <p class="edp-erro">{{ $errors->first() }}</p>
    @endif

    <div class="edp-acoes">
        <a href="/perfil" class="edp-btn edp-btn--outline">Fechar</a>
        <button type="submit" class="edp-btn edp-btn--cheio">Salvar alterações</button>
    </div>
</form>
</div>

@endsection