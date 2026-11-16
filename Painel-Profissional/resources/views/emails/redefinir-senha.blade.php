<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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

            <div class="info-card">
                <span class="info-badge">CRM · CRP · COREN · CRESS</span>
                <h2>Conectando profissionais à saúde da mulher</h2>
                <p>Atendimento com sigilo, acolhimento e responsabilidade.</p>
            </div>
        </aside>

        <main class="login-right">
            <div class="login-box">

                <a href="{{ url('/welcome') }}" class="back-link">&larr; Voltar para o login</a>

                <span class="eyebrow">Recuperação do acesso</span>
                <h1>Redefinir senha</h1>

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

                <p class="subtitle">Digite sua nova senha.</p>

                <form action="{{ url('emails.redefinir-senha/' . $chave) }}" method="POST" class="login-form" id="formRedefinir">
                    @csrf

                    <div class="field">
                        <label for="senhaProfissional">Nova senha</label>

                        <div class="input-password">
                            <input
                                type="password"
                                name="senhaProfissional"
                                id="senhaProfissional"
                                placeholder="Digite sua nova senha"
                                required>
                            
                            <button type="button" class="toggle-password" data-target="senhaProfissional" aria-label="Mostrar senha">&#128065;</button>
                        </div>
                    </div>

                    <div class="field">
                        <label for="senhaProfissional_confirmation">
                            Confirmar nova senha
                        </label>

                        
                        <div class="input-password">
                            <input
                                type="password"
                                name="senhaProfissional_confirmation"
                                id="senhaProfissional_confirmation"
                                placeholder="Digite novamente sua senha"
                                required>
                            <button type="button" class="toggle-password" data-target="senhaProfissional_confirmation" aria-label="Mostrar senha">&#128065;</button>
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

                    <button type="submit" class="btn-primary">Redefinir senha</button>
                </form>

                <p class="footer-note">
                    Por segurança, não informamos se um endereço está ou não cadastrado.
                </p>
            </div>
        </main>

    </div>

    <script>
        var form = document.getElementById('formRedefinir');

        form.querySelectorAll('.toggle-password').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.dataset.target);
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        });

        // ===== Força da senha e confirmação =====
        (function () {
            var senha = document.getElementById('senhaProfissional');
            var conf = document.getElementById('senhaProfissional_confirmation');
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

            function avaliarSenha() {
                var v = senha.value, ok = 0;

                itens.forEach(function (li) {
                    if (!regras[li.dataset.regra]) return; // "igual" é tratado na confirmação
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
                // Impede o envio enquanto a senha não for forte
                senha.setCustomValidity(ok === 5 ? '' : 'A senha precisa ter 8 caracteres, letra maiúscula, minúscula, número e caractere especial.');
            }

            function avaliarConfirmacao() {
                var b = conf.value;
                var iguais = b !== '' && b === senha.value;

                if (itemIgual) itemIgual.classList.toggle('ok', iguais);

                conf.classList.remove('campo-erro', 'campo-ok');

                if (b === '') {
                    conf.setCustomValidity('');
                    return;
                }

                if (iguais) {
                    conf.classList.add('campo-ok');
                    conf.setCustomValidity('');
                } else {
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
