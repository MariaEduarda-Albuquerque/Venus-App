<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudar senha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="recuperar-senha-page">
    <div class="login-page">

        <aside class="login-left">
            <span class="decor-circle decor-circle--top"></span>
            <span class="decor-circle decor-circle--bottom"></span>

            <div class="brand">
                <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus" class="logo">
            </div>

            <div class="info-card" style="background-image: url('{{ asset('images/RetanguloLogin.png') }}');">
                <span class="info-badge">SEGURANÇA DA CONTA</span>
                <h2>Sua senha, só sua</h2>
                <p>Use uma senha forte e que você não utilize em outros serviços.</p>
            </div>
        </aside>

        <main class="login-right">
            <div class="login-box">

                <a href="{{ url('user.update-profissional') }}" class="back-link">&larr; Voltar</a>

                <span class="eyebrow">Segurança</span>
                <h1>Alterar senha</h1>

                <p class="subtitle">Confirme sua senha atual e defina uma nova.</p>

                @if ($errors->any())
                    <div class="alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('erro'))
                    <div class="alert-error">
                        {{ session('erro') }}
                    </div>
                @endif

                <form action="{{ route('senha.atualizar') }}" method="POST" class="login-form" id="form-senha">
                    @csrf
                    @method('PUT')

                    <div class="field">
                        <label for="senhaAtual">Senha atual</label>

                        <div class="input-password">
                            <input type="password" name="senhaAtual" id="senhaAtual" placeholder="Digite sua senha atual" required>
                            <button type="button" class="toggle-password" data-target="senhaAtual" aria-label="Mostrar senha">
                                <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" /><circle cx="12" cy="12" r="3" /></svg>
                                <svg class="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.9 17.9A10.9 10.9 0 0 1 12 19c-7 0-11-7-11-7a19.8 19.8 0 0 1 5.1-5.9M9.9 4.2A10.7 10.7 0 0 1 12 4c7 0 11 7 11 7a19.7 19.7 0 0 1-3.2 4.2M1 1l22 22" /><path d="M14.1 14.1a3 3 0 1 1-4.2-4.2" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="field">
                        <label for="novaSenha">Nova senha</label>

                        <div class="input-password">
                            <input type="password" name="novaSenha" id="novaSenha" placeholder="Digite uma senha forte" required>
                            <button type="button" class="toggle-password" data-target="novaSenha" aria-label="Mostrar senha">
                                <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" /><circle cx="12" cy="12" r="3" /></svg>
                                <svg class="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.9 17.9A10.9 10.9 0 0 1 12 19c-7 0-11-7-11-7a19.8 19.8 0 0 1 5.1-5.9M9.9 4.2A10.7 10.7 0 0 1 12 4c7 0 11 7 11 7a19.7 19.7 0 0 1-3.2 4.2M1 1l22 22" /><path d="M14.1 14.1a3 3 0 1 1-4.2-4.2" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="field">
                        <label for="confirmarSenha">Confirmar nova senha</label>

                        <div class="input-password">
                            <input type="password" name="confirmarSenha" id="confirmarSenha" placeholder="Repita sua nova senha" required>
                            <button type="button" class="toggle-password" data-target="confirmarSenha" aria-label="Mostrar senha">
                                <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" /><circle cx="12" cy="12" r="3" /></svg>
                                <svg class="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.9 17.9A10.9 10.9 0 0 1 12 19c-7 0-11-7-11-7a19.8 19.8 0 0 1 5.1-5.9M9.9 4.2A10.7 10.7 0 0 1 12 4c7 0 11 7 11 7a19.7 19.7 0 0 1-3.2 4.2M1 1l22 22" /><path d="M14.1 14.1a3 3 0 1 1-4.2-4.2" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="senha-forca">
                        <div class="senha-forca-topo">
                            <span>Força da senha</span>
                            <strong id="senhaForcaTexto">—</strong>
                        </div>
                        <div class="senha-forca-barra"><span id="senhaForcaBarra"></span></div>
                    </div>

                    <ul class="senha-regras" id="senhaRegras">
                        <li data-regra="tamanho">Mínimo de 8 caracteres</li>
                        <li data-regra="minuscula">Uma letra minúscula</li>
                        <li data-regra="maiuscula">Uma letra maiúscula</li>
                        <li data-regra="numero">Um número</li>
                        <li data-regra="especial">Um caractere especial (!@#$%...)</li>
                        <li data-regra="igual">As senhas devem ser iguais</li>
                    </ul>

                    <div class="field-row">
                        <a href="{{ url('emails.esqueci-senha') }}" class="link">Esqueci minha senha</a>
                    </div>

                    <button type="submit" class="btn-primary">Alterar senha</button>
                </form>

                <p class="footer-note">
                    Ao alterar a senha, você continuará conectado neste dispositivo.
                </p>
            </div>
        </main>

    </div>

    <script>
        var form = document.getElementById('form-senha');

        form.querySelectorAll('.toggle-password').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.dataset.target);
                var mostrando = input.type === 'password';

                input.type = mostrando ? 'text' : 'password';
                btn.classList.toggle('mostrando', mostrando);
                btn.setAttribute('aria-label', mostrando ? 'Ocultar senha' : 'Mostrar senha');
            });
        });

         (function () {
            var senha = document.getElementById('novaSenha');
            var conf = document.getElementById('confirmarSenha');
            if (!senha || !conf) return;

            var regras = {
                tamanho:   function (s) { return s.length >= 8; },
                minuscula: function (s) { return /\p{Ll}/u.test(s); },
                maiuscula: function (s) { return /\p{Lu}/u.test(s); },
                numero:    function (s) { return /\p{N}/u.test(s); },
                especial:  function (s) { return /[\p{Z}\p{S}\p{P}]/u.test(s); }
            };
            var nomes = { '': '—', fraca: 'Fraca', media: 'Média', forte: 'Forte' };

            var itens = document.querySelectorAll('#senhaRegras li');
            var itemIgual = document.querySelector('#senhaRegras li[data-regra="igual"]');
            var barra = document.getElementById('senhaForcaBarra');
            var texto = document.getElementById('senhaForcaTexto');
            var aviso = document.getElementById('senhaMatch');

            function avaliarSenha() {
                var v = senha.value, ok = 0;

                itens.forEach(function (li) {
                    if (!regras[li.dataset.regra]) return;
                    var passou = regras[li.dataset.regra](v);
                    li.classList.toggle('ok', passou);
                    if (passou) ok++;
                });

                var nivel = v === '' ? '' : (ok === 5 ? 'forte' : (ok >= 3 ? 'media' : 'fraca'));
                barra.style.width = (v === '' ? 0 : ok / 5 * 100) + '%';
                barra.className = nivel ? 'nivel-' + nivel : '';
                texto.textContent = nomes[nivel];
                texto.className = nivel ? 'nivel-' + nivel : '';

                senha.classList.toggle('campo-erro', v !== '' && ok < 5);
                senha.classList.toggle('campo-ok', ok === 5);
                senha.setCustomValidity(ok === 5 ? '' : 'A senha precisa ter 8 caracteres, letra maiúscula, minúscula, número e caractere especial.');
            }

            function avaliarConfirmacao() {
                var b = conf.value;
                var iguais = b !== '' && b === senha.value;

                if (itemIgual) itemIgual.classList.toggle('ok', iguais);

                aviso.className = 'senha-match';
                conf.classList.remove('campo-erro', 'campo-ok');

                if (b === '') {
                    aviso.textContent = '';
                    conf.setCustomValidity('');
                    return;
                }

                if (iguais) {
                    aviso.textContent = '✓ As senhas coincidem';
                    aviso.classList.add('ok');
                    conf.classList.add('campo-ok');
                    conf.setCustomValidity('');
                } else {
                    aviso.textContent = 'As senhas não coincidem';
                    aviso.classList.add('erro');
                    conf.classList.add('campo-erro');
                    conf.setCustomValidity('As senhas não coincidem.');
                }
            }

            senha.addEventListener('input', function () { avaliarSenha(); avaliarConfirmacao(); });
            conf.addEventListener('input', avaliarConfirmacao);
            avaliarSenha();
            avaliarConfirmacao();
        })();
    </script>
</body>

</html>