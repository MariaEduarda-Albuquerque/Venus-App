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
    </script>
</body>

</html>