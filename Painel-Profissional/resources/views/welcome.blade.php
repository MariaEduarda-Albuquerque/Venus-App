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
                            <button type="button" class="toggle-password" data-target="senhaProfissional" aria-label="Mostrar senha">
                                <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" /><circle cx="12" cy="12" r="3" /></svg>
                                <svg class="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.9 17.9A10.9 10.9 0 0 1 12 19c-7 0-11-7-11-7a19.8 19.8 0 0 1 5.1-5.9M9.9 4.2A10.7 10.7 0 0 1 12 4c7 0 11 7 11 7a19.7 19.7 0 0 1-3.2 4.2M1 1l22 22" /><path d="M14.1 14.1a3 3 0 1 1-4.2-4.2" /></svg>
                            </button>
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

                    <a href="{{ route('auth.google') }}" class="btn-google">
                        <svg class="google-svg" width="18" height="18" viewBox="0 0 48 48" aria-hidden="true"><path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9.1 3.6l6.8-6.8C35.8 2.4 30.3 0 24 0 14.6 0 6.5 5.4 2.6 13.2l7.9 6.1C12.4 13.6 17.7 9.5 24 9.5z"/><path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.1-.4-4.5H24v9h12.7c-.6 3-2.3 5.5-4.8 7.2l7.6 5.9c4.4-4.1 7-10.1 7-17.6z"/><path fill="#FBBC05" d="M10.5 28.7c-.5-1.4-.8-3-.8-4.7s.3-3.2.8-4.7l-7.9-6.1C.9 16.4 0 20.1 0 24s.9 7.6 2.6 10.8l7.9-6.1z"/><path fill="#34A853" d="M24 48c6.5 0 11.9-2.1 15.9-5.8l-7.6-5.9c-2.1 1.4-4.9 2.3-8.3 2.3-6.3 0-11.6-4.1-13.5-9.8l-7.9 6.1C6.5 42.6 14.6 48 24 48z"/></svg>
                        Entrar com Google
                    </a>

                    <p class="signup">
                        Ainda não é cadastrado?
                        <a href="{{ url('user.cadastro') }}">Cadastrar</a>
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
                var mostrando = input.type === 'password';

                input.type = mostrando ? 'text' : 'password';
                btn.classList.toggle('mostrando', mostrando);
                btn.setAttribute('aria-label', mostrando ? 'Ocultar senha' : 'Mostrar senha');
            });
        });
    </script>

</body>
</html>