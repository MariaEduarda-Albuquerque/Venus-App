@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/perfil-config.css') }}">
@endpush

@section('content')

<div class="wrap">

    <div class="head">
        <div>
            <h1>Alterar senha</h1>
            <p class="sm">Digite sua senha atual e escolha uma nova.</p>
        </div>
        <a href="{{ route('perfil') }}" class="bk" aria-label="Voltar">
            <i data-lucide="arrow-left"></i>
        </a>
    </div>

    @if ($errors->any())
        <div class="alerta erro" role="alert">Confira os campos destacados e tente de novo.</div>
    @endif

    <form class="stack" style="max-width:36rem" action="{{ route('perfil.senha.atualizar') }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="card">
            <div class="sech">
                <div class="ico"><i data-lucide="key-round"></i></div>
                <div>
                    <h3>Nova senha</h3>
                    <p>Mínimo de 8 caracteres, com letra maiúscula, minúscula e número.</p>
                </div>
            </div>

            <div class="f">
                <label for="senha_atual">Senha atual <em>*</em></label>
                <input type="password" id="senha_atual" name="senha_atual" autocomplete="current-password"
                       class="{{ $errors->has('senha_atual') ? 'invalido' : '' }}">
                @error('senha_atual')<div class="erro-campo">{{ $message }}</div>@enderror
            </div>

            <div class="f">
                <label for="nova_senha">Nova senha <em>*</em></label>
                <input type="password" id="nova_senha" name="nova_senha" autocomplete="new-password"
                       class="{{ $errors->has('nova_senha') ? 'invalido' : '' }}">
                @error('nova_senha')<div class="erro-campo">{{ $message }}</div>@enderror
            </div>

            <div class="f">
                <label for="nova_senha_confirmation">Confirmar nova senha <em>*</em></label>
                <input type="password" id="nova_senha_confirmation" name="nova_senha_confirmation" autocomplete="new-password">
            </div>
        </div>

        <div class="savebar">
            <span class="sm">Você continua conectado depois de trocar a senha.</span>
            <div style="display:flex;gap:10px">
                <a href="{{ route('perfil') }}" class="btn g">Cancelar</a>
                <button type="submit" class="btn p">
                    <i data-lucide="check"></i> Salvar nova senha
                </button>
            </div>
        </div>
    </form>

</div>

@endsection
