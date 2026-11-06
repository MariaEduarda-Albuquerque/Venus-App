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

    <form class="sn" action="{{ route('perfil.senha.atualizar') }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="card">
            <div class="sech">
                <div class="ico"><i data-lucide="key-round"></i></div>
                <div>
                    <h3>Trocar senha</h3>
                    <p>Confirme a senha atual e escolha uma nova.</p>
                </div>
            </div>

            <div class="f">
                <label for="senha_atual">Senha atual <em>*</em></label>
                <div class="pw-box">
                    <input type="password" id="senha_atual" name="senha_atual" autocomplete="current-password"
                           class="{{ $errors->has('senha_atual') ? 'invalido' : '' }}">
                    <button type="button" class="pw-eye" data-alvo="senha_atual" data-nome="senha atual"
                            aria-label="Mostrar senha atual" aria-pressed="false" title="Mostrar senha">
                        <svg class="pw-ic pw-on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <svg class="pw-ic pw-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/>
                            <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/>
                            <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/>
                            <path d="m2 2 20 20"/>
                        </svg>
                    </button>
                </div>
                @error('senha_atual')<div class="erro-campo">{{ $message }}</div>@enderror
            </div>

            <div class="f">
                <label for="nova_senha">Nova senha <em>*</em></label>
                <div class="pw-box">
                    <input type="password" id="nova_senha" name="nova_senha" autocomplete="new-password"
                           aria-describedby="pw-lista"
                           class="{{ $errors->has('nova_senha') ? 'invalido' : '' }}">
                    <button type="button" class="pw-eye" data-alvo="nova_senha" data-nome="nova senha"
                            aria-label="Mostrar nova senha" aria-pressed="false" title="Mostrar senha">
                        <svg class="pw-ic pw-on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <svg class="pw-ic pw-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/>
                            <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/>
                            <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/>
                            <path d="m2 2 20 20"/>
                        </svg>
                    </button>
                </div>
                @error('nova_senha')<div class="erro-campo">{{ $message }}</div>@enderror
            </div>

            <div class="f">
                <label for="nova_senha_confirmation">Confirmar nova senha <em>*</em></label>
                <div class="pw-box">
                    <input type="password" id="nova_senha_confirmation" name="nova_senha_confirmation" autocomplete="new-password">
                    <button type="button" class="pw-eye" data-alvo="nova_senha_confirmation" data-nome="confirmação da nova senha"
                            aria-label="Mostrar confirmação da nova senha" aria-pressed="false" title="Mostrar senha">
                        <svg class="pw-ic pw-on" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <svg class="pw-ic pw-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/>
                            <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/>
                            <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/>
                            <path d="m2 2 20 20"/>
                        </svg>
                    </button>
                </div>
                <div class="pw-msg" id="pw-match" aria-live="polite"></div>
            </div>
        </div>

        <div class="card pw-regras">
            <div class="sech">
                <div class="ico"><i data-lucide="shield-check"></i></div>
                <div>
                    <h3>Sua nova senha precisa ter</h3>
                    <p>Os itens ficam verdes conforme você digita.</p>
                </div>
            </div>

            <ul class="pw-list" id="pw-lista">
                <li data-regra="tam"><span class="pw-dot"></span>Pelo menos 8 caracteres</li>
                <li data-regra="mai"><span class="pw-dot"></span>Uma letra maiúscula</li>
                <li data-regra="min"><span class="pw-dot"></span>Uma letra minúscula</li>
                <li data-regra="num"><span class="pw-dot"></span>Um número</li>
            </ul>

            <div class="pw-forca" id="pw-forca" data-nivel="0">
                <div class="pw-forca-top">
                    <span>Força da senha</span>
                    <b id="pw-forca-txt">—</b>
                </div>
                <div class="pw-barras"><i></i><i></i><i></i><i></i></div>
            </div>

            <p class="hint">Dica: uma frase longa é mais segura e mais fácil de lembrar.</p>
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

@push('scripts')
<script>
    (function () {
        var nova = document.getElementById('nova_senha');
        var conf = document.getElementById('nova_senha_confirmation');

        // Olho: mostra ou oculta a senha do campo ao lado
        document.querySelectorAll('.pw-eye').forEach(function (botao) {
            botao.addEventListener('click', function () {
                var campo = document.getElementById(botao.getAttribute('data-alvo'));
                var mostrar = campo.type === 'password';
                var fim = campo.value.length;

                campo.type = mostrar ? 'text' : 'password';
                botao.setAttribute('aria-pressed', mostrar ? 'true' : 'false');
                botao.setAttribute('aria-label', (mostrar ? 'Ocultar ' : 'Mostrar ') + botao.getAttribute('data-nome'));
                botao.setAttribute('title', mostrar ? 'Ocultar senha' : 'Mostrar senha');

                // devolve o cursor ao fim do texto para continuar digitando
                campo.focus();
                try { campo.setSelectionRange(fim, fim); } catch (e) {}
            });
        });

        // Mesmas regras que o servidor valida (PerfilController@atualizarSenha)
        var regras = {
            tam: function (v) { return v.length >= 8; },
            mai: function (v) { return /\p{Lu}/u.test(v); },
            min: function (v) { return /\p{Ll}/u.test(v); },
            num: function (v) { return /\p{N}/u.test(v); }
        };
        var itens = document.querySelectorAll('#pw-lista li');
        var forca = document.getElementById('pw-forca');
        var forcaTxt = document.getElementById('pw-forca-txt');
        var msg = document.getElementById('pw-match');
        var NOMES = ['—', 'Fraca', 'Razoável', 'Boa', 'Forte'];

        function conferir() {
            if (!conf.value) {
                msg.textContent = '';
                msg.className = 'pw-msg';
                return;
            }
            var igual = conf.value === nova.value;
            msg.textContent = igual ? 'As senhas coincidem.' : 'As senhas ainda não coincidem.';
            msg.className = 'pw-msg ' + (igual ? 'ok' : 'no');
        }

        function avaliar() {
            var v = nova.value;
            var cumpridas = 0;

            itens.forEach(function (li) {
                var passou = regras[li.getAttribute('data-regra')](v);
                li.classList.toggle('ok', passou);
                if (passou) cumpridas++;
            });

            var nivel = 0;
            if (v.length) {
                if (cumpridas <= 2) nivel = 1;
                else if (cumpridas === 3) nivel = 2;
                else nivel = v.length >= 12 ? 4 : 3;
            }

            forca.setAttribute('data-nivel', nivel);
            forcaTxt.textContent = NOMES[nivel];
            conferir();
        }

        nova.addEventListener('input', avaliar);
        conf.addEventListener('input', conferir);
        avaliar();
    })();
</script>
@endpush
