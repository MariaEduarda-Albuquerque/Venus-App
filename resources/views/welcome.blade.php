<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <section class="login-page">

        <div class="login-left">

            <div class="decor-circle decor-circle--top"></div>
            <div class="decor-circle decor-circle--bottom"></div>

            <div class="brand">
                <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus - A saúde da Mulher na palma da sua mão" class="logo">
            </div>

            <div class="info-card">
                <span class="info-badge">CRM &middot; CRP &middot; COREN &middot; CRESS</span>
                <h2>Conectando profissionais à saúde da mulher</h2>
                <p>Atendimento com sigilo, acolhimento e responsabilidade.</p>
            </div>

        </div>

        <div class="login-right">

            <div class="login-box">

                <span class="eyebrow">Portal do Profissional</span>
                <h1>Bem-vindo(a) de volta</h1>
                <p class="subtitle">Entre para gerenciar seus atendimentos e sua agenda.</p>

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

                <form action="/login" method="post" class="login-form" id="formLogin">
                    @csrf

                    <div class="field">
                        <label for="emailProfissional">E-mail</label>
                        <input
                            type="text"
                            name="email"
                            id="emailProfissional"
                            placeholder="seu@Email.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>

                    <div class="field">
                        <label for="senhaProfissional">Senha</label>

                        <div class="input-password">
                            <input
                                type="password"
                                name="senha"
                                id="senhaProfissional"
                                placeholder="Digite sua senha"
                                required
                            >
                            <button type="button" class="toggle-password" data-target="senhaProfissional" aria-label="Mostrar senha">&#128065;</button>
                        </div>
                    </div>

                    <div class="field-row">
                        <label class="checkbox">
                            <input type="checkbox" name="lembrar">
                            <span>Lembrar de mim</span>
                        </label>

                        <a href="{{ url('emails.esqueci-senha') }}" class="link">Esqueci minha senha</a>
                    </div>

                    <button type="submit" class="btn-primary">Entrar</button>

                    <div class="divider"><span>ou</span></div>

                    <button type="button" class="btn-google">
                        <span class="google-icon">G</span>
                        Entrar com Google
                    </button>

                    <p class="signup">
                        Ainda não é cadastrado?
                        <a href="{{ url('user.cadastro') }}">Solicitar acesso</a>
                    </p>

                </form>

            </div>

            <p class="footer-note">
                Seus dados são tratados com sigilo e segurança, conforme a
                Política de Privacidade e a LGPD.
            </p>

        </div>

    </section>

    <script>
        var form = document.getElementById('formLogin');

        form.querySelectorAll('.toggle-password').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.dataset.target);
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        });
    </script>

</body>
</html>