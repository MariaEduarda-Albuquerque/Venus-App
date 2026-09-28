<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="recuperar-senha-page">

    <section class="login-page">

        <div class="login-left">

            <div class="decor-circle decor-circle--top"></div>
            <div class="decor-circle decor-circle--bottom"></div>

            <div class="brand">
                <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus - A saúde da Mulher na palma da sua mão" class="logo">
            </div>

            <div class="info-card" style="background-image: url('{{ asset('images/RetanguloLogin.png') }}');">
                <span class="info-badge">CRM &middot; CRP &middot; COREN &middot; CRESS</span>
                <h2>Conectando profissionais à saúde da mulher</h2>
                <p>Atendimento com sigilo, acolhimento e responsabilidade.</p>
            </div>

        </div>

        <div class="login-right">

            <div class="login-box">

                <a href="{{ url('/welcome') }}" class="back-link">&larr; Voltar para o login</a>

                <div class="icon-circle">
                    <span class="icon-envelope">&#9993;</span>
                </div>

                <span class="eyebrow">Recuperação do acesso</span>
                <h1>Esqueceu sua senha?</h1>
                <p class="subtitle">
                    Informe o e-mail profissional cadastrado. Enviaremos um link
                    para criar uma nova senha.
                </p>

                <form action="{{ url('emails.esqueci-senha') }}" method="post" class="login-form">
                    @csrf

                    <div class="field">
                        <label for="emailProfissional">E-mail profissional</label>
                        <input
                            type="email"
                            name="emailProfissionalSaude"
                            id="emailProfissionalSaude"
                            placeholder="seu@email.com"
                            value="{{ old('emailProfissionalSaude') }}"
                            required>
                    </div>

                    @if ($errors->has('emailProfissionalSaude'))
                        <div class="alert-success">
                            <p>Chave de recuperação criada!</p>
                        </div>
                    @endif

                    @if (session('sucesso'))
                        <div class="alert-success">
                            <p>{{ session('sucesso') }}</p>
                        </div>
                    @endif

                    <button type="submit" class="btn-primary">Enviar link de recuperação</button>

                    <p class="footer-note">
                        Por segurança, não informamos se um endereço está ou não cadastrado.
                    </p>
                </form>

            </div>

        </div>

    </section>

</body>

</html>