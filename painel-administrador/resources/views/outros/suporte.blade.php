
@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/suporte.css') }}">
@endpush

@section('content')

@php
    $urlResponder = route('suporte.responder', ['codChamado' => '__ID__']);
@endphp

<div class="head">
    <h1>Suporte</h1>
    <span class="sm" id="sup-contagem">{{ $chamados->count() }} chamados</span>
</div>

<div class="sup" id="sup">

    {{-- Lista de chamados --}}
    <div class="card">

        <div class="tabs">
            <button type="button" class="tab on" data-aba="o">
                Abertos
            </button>

            <button type="button" class="tab" data-aba="r">
                Resolvidos
            </button>
        </div>

        <label class="sbox">
            <i data-lucide="search"></i>
            <input
                type="text"
                id="sup-busca"
                placeholder="Buscar chamado..."
            >
        </label>

        <div class="tl" id="sup-lista">

            @forelse ($chamados as $c)

                @php
                    $profissional = $c->profissional;

                    $nome = $profissional?->nomeProfissionalSaude ?? 'Profissional não identificado';

                    $email = $profissional?->emailProfissionalSaude ?? '';

                    $status = $c->statusChamado === 'resolvido' ? 'r' : 'o';

                    $novo = $c->mensagens
                        ->where('tipoRemetente', 'admin')
                        ->isEmpty();
                @endphp

                <button
                    type="button"
                    class="ti"
                    data-id="{{ $c->codChamado }}"
                    data-status="{{ $status }}"
                    data-texto="{{ $c->codChamado }} {{ $c->assuntoChamado }} {{ $nome }}"
                >

                    <b>
                        @if ($novo)
                            <span class="ud"></span>
                        @endif

                        ID {{ $c->codChamado }}
                    </b>

                    <div class="sub2">
                        {{ $c->assuntoChamado }}
                    </div>

                    <div class="sub2">
                        {{ $nome }}
                    </div>

                </button>

            @empty

                <p class="sm vazio">
                    Nenhum chamado cadastrado.
                </p>

            @endforelse

            <p class="sm vazio" id="sup-vazio" hidden>
                Nenhum chamado.
            </p>

        </div>
    </div>


    {{-- Conversa --}}
    <div class="card">

        <div class="empty" id="sup-sem-chamado">
            Nenhum chamado selecionado.
        </div>

        @foreach ($chamados as $c)

            @php
                $profissional = $c->profissional;

                $nome = $profissional?->nomeProfissionalSaude ?? 'Profissional não identificado';

                $email = $profissional?->emailProfissionalSaude ?? '';

                $status = $c->statusChamado;
            @endphp

            <div
                class="chamado"
                data-id="{{ $c->codChamado }}"
                data-status="{{ $status === 'resolvido' ? 'r' : 'o' }}"
                hidden
            >

                <div class="th">

                    <div>
                        <h3>
                            <span>ID {{ $c->codChamado }} -</span>
                            {{ $c->assuntoChamado }}
                        </h3>

                        <p class="sm">
                            {{ $c->dataAbertura?->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <div class="nv">

                        <button
                            type="button"
                            class="btn g s"
                            data-resolver
                            data-status-atual="{{ $status }}"
                        >
                            <i data-lucide="check"></i>
                            <span></span>
                        </button>

                        <button
                            type="button"
                            class="nvb"
                            data-anterior
                            aria-label="Anterior"
                        >
                            <i data-lucide="chevron-left"></i>
                        </button>

                        <button
                            type="button"
                            class="nvb"
                            data-proximo
                            aria-label="Próximo"
                        >
                            <i data-lucide="chevron-right"></i>
                        </button>

                    </div>
                </div>


                {{-- Histórico de mensagens --}}
                <div class="thr">

                    {{-- Mensagem inicial do chamado --}}
                    <div class="bub">

                        <div class="mav">
                            {{ mb_substr($nome, 0, 1) }}
                        </div>

                        <div>

                            <div class="nm">
                                {{ $nome }}
                            </div>

                            <div class="em">
                                {{ $email }}
                                ·
                                {{ $c->dataAbertura?->format('d/m/Y H:i') }}
                            </div>

                            <div class="bd2">
                                {{ $c->descricaoChamado }}
                            </div>

                            @if ($c->anexoChamado)

                                <div class="em">
                                    <a
                                        href="{{ Storage::disk('public')->url($c->anexoChamado) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        Visualizar anexo inicial
                                    </a>
                                </div>

                            @endif

                        </div>
                    </div>


                    {{-- Mensagens posteriores --}}
                    @foreach ($c->mensagens as $msg)

                        @if ($msg->tipoRemetente === 'profissional')

                            <div class="bub">

                                <div class="mav">
                                    {{ mb_substr($nome, 0, 1) }}
                                </div>

                                <div>

                                    <div class="nm">
                                        {{ $nome }}
                                    </div>

                                    <div class="em">
                                        {{ $msg->dataMensagem?->format('d/m/Y H:i') }}
                                    </div>

                                    <div class="bd2">
                                        {{ $msg->textoMensagem }}
                                    </div>

                                    @if ($msg->anexoMensagem)

                                        <div class="em">
                                            <a
                                                href="{{ Storage::disk('public')->url($msg->anexoMensagem) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                            >
                                                Visualizar anexo
                                            </a>
                                        </div>

                                    @endif

                                </div>
                            </div>

                        @else

                            <div class="bub s">

                                <div class="mav">
                                    V
                                </div>

                                <div>

                                    <div class="nm">
                                        Suporte Vênus
                                    </div>

                                    <div class="em">
                                        {{ $msg->dataMensagem?->format('d/m/Y H:i') }}
                                    </div>

                                    <div class="bd2">
                                        {{ $msg->textoMensagem }}
                                    </div>

                                    @if ($msg->anexoMensagem)

                                        <div class="em">
                                            <a
                                                href="{{ Storage::disk('public')->url($msg->anexoMensagem) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                            >
                                                Visualizar anexo
                                            </a>
                                        </div>

                                    @endif

                                </div>
                            </div>

                        @endif

                    @endforeach

                </div>

            </div>

        @endforeach


        {{-- Caixa de resposta --}}
        <div class="resposta-area" id="sup-resposta-area">

            <div class="qr">

                <button
                    type="button"
                    data-rapida="Olá! Estamos analisando o seu chamado e retornaremos em breve."
                >
                    Em análise
                </button>

                <button
                    type="button"
                    data-rapida="Olá! O problema foi corrigido. Pode confirmar se tudo funciona normalmente?"
                >
                    Problema corrigido
                </button>

                <button
                    type="button"
                    data-rapida="Olá! Para continuar, pode nos enviar mais detalhes ou uma captura de tela?"
                >
                    Pedir mais detalhes
                </button>

            </div>


            <form
                id="sup-form-resposta"
                action="{{ $urlResponder }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <div class="cmp">

                    <textarea
                        id="sup-resposta"
                        name="textoMensagem"
                        placeholder="Digite sua resposta aqui..."
                    ></textarea>

                    <div id="sup-anexos"></div>

                    <div class="bar">

                        <button
                            type="button"
                            class="btn g s"
                            id="sup-anexar"
                        >
                            <i data-lucide="paperclip"></i>
                            Anexar
                        </button>


                        <button
                            type="submit"
                            class="btn p s"
                            id="sup-enviar"
                            disabled
                        >
                            Responder
                            <i data-lucide="send"></i>
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- Arquivo --}}
<input
    type="file"
    id="sup-arquivo"
    name="anexoMensagem"
    form="sup-form-resposta"
    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
    hidden
>


{{-- Formulário para atualizar status --}}
<form
    id="sup-form-status"
    method="POST"
    action="{{ route('suporte.status', ['codChamado' => '__ID__']) }}"
    hidden
>
    @csrf
    @method('PATCH')

    <input
        type="hidden"
        name="statusChamado"
        id="sup-status-valor"
    >
</form>


{{-- Modal de confirmação --}}
<div class="confirma-modal" id="sup-confirma-modal">

    <div class="confirma-caixa">

        <span class="confirma-icone">
            <i data-lucide="check-circle-2"></i>
        </span>

        <h3 id="sup-confirma-titulo"></h3>

        <p>Você pode mudar isso depois.</p>

        <div class="confirma-acoes">

            <button
                type="button"
                class="confirma-btn confirma-btn--neutro"
                id="sup-confirma-cancelar"
            >
                Cancelar
            </button>

            <button
                type="button"
                class="confirma-btn confirma-btn--ok"
                id="sup-confirma-ok"
            >
                Confirmar
            </button>

        </div>

    </div>

</div>


{{-- Toast --}}
<div class="toast" id="sup-toast">
    <i data-lucide="check-circle-2"></i>
    <span></span>
</div>

@endsection
