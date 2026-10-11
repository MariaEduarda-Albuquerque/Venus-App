@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/suporte.css') }}">
@endpush

@php
    $chamados = $chamados ?? [
        ['id' => 346520, 'assunto' => 'A barra lateral não responde em dispositivos móveis.', 'nome' => 'João Ninguém', 'email' => 'jhondelin@gmail.com', 'quando' => 'Segunda-feira, 15h20 (há 2 dias)', 'status' => 'o', 'novo' => true,
         'msgs' => [['u', '15h20', "Olá, suporte da Vênus\n\nGostaria de informar que foi identificado um problema na barra lateral do sistema. Em dispositivos móveis, a barra lateral não está respondendo corretamente às interações do usuário, impedindo que as opções sejam acessadas normalmente.\n\nSolicito, por gentileza, que o problema seja verificado e corrigido para garantir o funcionamento adequado da barra lateral também em dispositivos móveis.\nAtenciosamente,\nJoão"]]],
        ['id' => 346101, 'assunto' => 'Não consigo recuperar minha senha', 'nome' => 'Marina Costa', 'email' => 'marinac@gmail.com', 'quando' => 'Terça-feira, 09h05 (ontem)', 'status' => 'o', 'novo' => true,
         'msgs' => [['u', '09h05', 'Oi! Pedi a redefinição de senha três vezes e o e-mail não chega. Pode me ajudar?']]],
        ['id' => 345871, 'assunto' => 'Erro ao enviar anexo no chat', 'nome' => 'Ricardo Alves', 'email' => 'ricardoa@gmail.com', 'quando' => 'Domingo, 18h40 (há 3 dias)', 'status' => 'o', 'novo' => false,
         'msgs' => [['u', '18h40', 'Quando tento anexar uma imagem no chat aparece uma mensagem de erro.'], ['s', '19h10', 'Olá, Ricardo! Estamos analisando o problema. Pode nos dizer o tamanho da imagem?']]],
        ['id' => 345640, 'assunto' => 'Denúncia aprovada sem notificação', 'nome' => 'Paula Reis', 'email' => 'paular@gmail.com', 'quando' => 'Sexta-feira, 11h12 (há 5 dias)', 'status' => 'r', 'novo' => false,
         'msgs' => [['u', '11h12', 'Minha denúncia foi aprovada, mas não recebi nenhum aviso.'], ['s', '14h30', 'Corrigimos o envio das notificações. Obrigada pelo aviso!']]],
        ['id' => 344912, 'assunto' => 'Solicitação de exclusão de conta', 'nome' => 'Beatriz Lima', 'email' => 'bealima@gmail.com', 'quando' => 'Quarta-feira, 16h50 (há 1 semana)', 'status' => 'r', 'novo' => false,
         'msgs' => [['u', '16h50', 'Gostaria de excluir minha conta e todos os meus dados.'], ['s', '17h20', 'Sua conta foi excluída conforme solicitado.']]],
    ];
@endphp

@section('content')

<div class="head">
    <h1>Suporte</h1>
    <span class="sm" id="sup-contagem"></span>
</div>

<div class="sup" id="sup">

    {{-- Lista de chamados --}}
    <div class="card">
        <div class="tabs">
            <button type="button" class="tab on" data-aba="o">Abertos</button>
            <button type="button" class="tab" data-aba="r">Resolvidos</button>
        </div>

        <label class="sbox">
            <i data-lucide="search"></i>
            <input type="text" id="sup-busca" placeholder="Buscar chamado…">
        </label>

        <div class="tl" id="sup-lista">
            @foreach ($chamados as $c)
                <button type="button" class="ti" data-id="{{ $c['id'] }}" data-status="{{ $c['status'] }}"
                        data-texto="{{ $c['id'] }} {{ $c['assunto'] }} {{ $c['nome'] }}">
                    <b>@if ($c['novo'])<span class="ud"></span>@endif ID {{ $c['id'] }}</b>
                    <div class="sub2">{{ $c['assunto'] }}</div>
                    <div class="sub2">{{ $c['nome'] }}</div>
                </button>
            @endforeach
            <p class="sm vazio" id="sup-vazio" hidden>Nenhum chamado.</p>
        </div>
    </div>

    {{-- Conversa --}}
    <div class="card">

        <div class="empty" id="sup-sem-chamado" hidden>Nenhum chamado selecionado.</div>

        @foreach ($chamados as $c)
            <div class="chamado" data-id="{{ $c['id'] }}" hidden>
                <div class="th">
                    <div>
                        <h3><span>ID {{ $c['id'] }} -</span> {{ $c['assunto'] }}</h3>
                        <p class="sm">{{ $c['quando'] }}</p>
                    </div>
                    <div class="nv">
                        <button type="button" class="btn g s" data-resolver>
                            <i data-lucide="check"></i><span></span>
                        </button>
                        <button type="button" class="nvb" data-anterior aria-label="Anterior"><i data-lucide="chevron-left"></i></button>
                        <button type="button" class="nvb" data-proximo aria-label="Próximo"><i data-lucide="chevron-right"></i></button>
                    </div>
                </div>

                <div class="thr">
                    @foreach ($c['msgs'] as [$de, $hora, $texto])
                        @if ($de === 'u')
                            <div class="bub">
                                <div class="mav">{{ mb_substr($c['nome'], 0, 1) }}</div>
                                <div>
                                    <div class="nm">{{ $c['nome'] }}</div>
                                    <div class="em">{{ $c['email'] }} · {{ $hora }}</div>
                                    <div class="bd2">{{ $texto }}</div>
                                </div>
                            </div>
                        @else
                            <div class="bub s">
                                <div class="mav">V</div>
                                <div>
                                    <div class="nm">Suporte Vênus</div>
                                    <div class="em">{{ $hora }}</div>
                                    <div class="bd2">{{ $texto }}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

        {{-- Caixa de resposta (uma só, usada em todos os chamados) --}}
        <div class="resposta-area" id="sup-resposta-area">
            <div class="qr">
                <button type="button" data-rapida="Olá! Estamos analisando o seu chamado e retornaremos em breve.">Em análise</button>
                <button type="button" data-rapida="Olá! O problema foi corrigido. Pode confirmar se tudo funciona normalmente?">Problema corrigido</button>
                <button type="button" data-rapida="Olá! Para continuar, pode nos enviar mais detalhes ou uma captura de tela?">Pedir mais detalhes</button>
            </div>

            <div class="cmp">
                <textarea id="sup-resposta" placeholder="Digite sua resposta aqui…"></textarea>
                <div id="sup-anexos"></div>
                <div class="bar">
                    <button type="button" class="btn g s" id="sup-anexar"><i data-lucide="paperclip"></i> Anexar</button>
                    <span class="sm">Ctrl + Enter envia</span>
                    <button type="button" class="btn p s" id="sup-enviar" disabled>Responder <i data-lucide="send"></i></button>
                </div>
            </div>
        </div>

    </div>
</div>

<input type="file" id="sup-arquivo" multiple hidden>

<div class="toast" id="sup-toast"><i data-lucide="check-circle-2"></i><span></span></div>

@endsection