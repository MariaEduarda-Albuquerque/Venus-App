@extends('layouts.dashboard')

@section('title', 'Perfil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/config-perfil.css') }}">
@endpush

@section('content')

<div class="prf-pagina">
    <div class="prf-card">

        {{-- Cabeçalho --}}
        <div class="prf-topo">
            <div class="prf-identidade">
                <div class="prf-avatar">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="8.5" r="4"></circle>
                        <path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="prf-nome">{{$admin->nomeAdmin}}</h1>
                    <p class="prf-subtitulo">{{ $admin->tbpapel->nomePapel }} &nbsp;|&nbsp; {{$admin->cidadeAdmin}}, {{$admin->paisAdmin}}</p>
                </div>
            </div>

            <a href="/perfil/editar" class="prf-botao">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"></path>
                </svg>
                Editar
            </a>
        </div>

        {{-- Dados pessoais --}}
        <div class="prf-secao">
            <div class="prf-grid prf-grid--2">
                <div class="prf-campo">
                    <span class="prf-label">Nome</span>
                    <span class="prf-valor">{{$admin->nomeAdmin}}</span>
                </div>

            </div>

            <div class="prf-grid prf-grid--3">
                <div class="prf-campo">
                    <span class="prf-label">Endereço de Email</span>
                    <span class="prf-valor">{{$admin->emailAdmin}}</span>
                </div>
                <div class="prf-campo">
                    <span class="prf-label">Telefone</span>
                    <span class="prf-valor">{{$admin->telAdmin}}</span>
                </div>
                <div class="prf-campo">
                    <span class="prf-label">Cargo</span>
                    <span class="prf-valor prf-valor--leve">{{ $admin->tbpapel->nomePapel }}</span>
                </div>
            </div>
        </div>

        <hr class="prf-divisor">

        {{-- Endereço --}}
        <div class="prf-secao">
            <h2 class="prf-titulo-secao">Endereço</h2>

            <div class="prf-grid prf-grid--2">
                <div class="prf-campo">
                    <span class="prf-label">País</span>
                    <span class="prf-valor">{{$admin->paisAdmin}}</span>
                </div>
                <div class="prf-campo">
                    <span class="prf-label">Cidade/Estado</span>
                    <span class="prf-valor">{{$admin->cidadeAdmin}}, {{$admin->ufAdmin}}</span>
                </div>
            </div>

            <div class="prf-grid prf-grid--2">
                <div class="prf-campo">
                    <span class="prf-label">Código Postal</span>
                    <span class="prf-valor">{{$admin->cepAdmin}}</span>
                </div>
                <div class="prf-campo">
                    <span class="prf-label">Nº Fiscal</span>
                    <span class="prf-valor">{{$admin->nrFiscalAdmin}}</span>
                </div>
            </div>
        </div>

        <hr class="prf-divisor">

        {{-- Segurança --}}
        <div class="prf-secao">
            <h2 class="prf-titulo-secao">Segurança</h2>

            <div class="prf-linha-seguranca">
                <div>
                    <p class="prf-seg-titulo">Alterar senha</p>
                    <p class="prf-seg-texto">Receba notificações em tempo real e alertas da equipe.</p>
                </div>
                <a href="#" class="prf-botao prf-botao--pequeno">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"></path>
                    </svg>
                    Alterar a senha
                </a>
            </div>

            <div class="prf-linha-seguranca">
                <div>
                    <p class="prf-seg-titulo">Autenticação de dois fatores (2FA)</p>
                    <p class="prf-seg-texto">Mantenha sua conta segura ativando a autenticação de dois fatores (2FA).</p>
                </div>

                <label class="prf-switch">
                    <input type="checkbox" name="doisFatores">
                    <span class="prf-switch-trilho"></span>
                </label>
            </div>
        </div>

    </div>
</div>

@endsection