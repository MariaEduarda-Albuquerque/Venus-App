<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vênus — Trocar Senha</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <main class="login-page">

    <!-- Painel esquerdo -->
    <section class="brand-panel" aria-label="Vênus">
      <div class="decor decor-top"></div>
      <div class="decor decor-bottom"></div>
      <div class="decor decor-middle"></div>

      <svg class="fine-line line-one" viewBox="0 0 420 180" aria-hidden="true">
        <path d="M-20 145 C80 55 180 210 330 55 C370 15 400 0 440 -5"/>
      </svg>

      <svg class="fine-line line-two" viewBox="0 0 420 180" aria-hidden="true">
        <path d="M-20 35 C75 125 150 20 265 90 C330 130 380 160 440 145"/>
      </svg>

       <div class="logo">
        <img src="{{asset('images/logoVenusLogin.png')}}" alt="">
      </div>
      </div>
      </div>
    </section>

    <!-- Área direita -->
    <section class="form-area">
      <div class="ambient-circle ambient-one"></div>
      <div class="ambient-circle ambient-two"></div>

      <form class="login-card" action="#" method="post">
        @csrf
        <div class="title-line"></div>
        <h1>Trocar senha</h1>
        <p class="intro">
          Digite sua nova senha para redefini-la. Ao redefinir,<br class="desktop-only">
          você retornará à tela de login.
        </p>

        <div class="field">
          <label for="novaSenha">Nova senha</label>
          <div class="input-wrap">
            <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
              <rect x="5" y="10" width="14" height="10" rx="2"></rect>
              <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
            </svg>
            <input id="novaSenha" name="novaSenha" type="password" placeholder="Digite a nova senha" autocomplete="new-password">
            <button class="password-toggle" type="button" aria-label="Mostrar senha" data-target="novaSenha">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M2.5 12s3.2-5 9.5-5 9.5 5 9.5 5-3.2 5-9.5 5-9.5-5-9.5-5Z"></path>
                <circle cx="12" cy="12" r="2.5"></circle>
              </svg>
            </button>
          </div>
        </div>

        <div class="field">
          <label for="confirmarSenha">Confirmar senha</label>
          <div class="input-wrap">
            <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
              <rect x="5" y="10" width="14" height="10" rx="2"></rect>
              <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
            </svg>
            <input id="confirmarSenha" name="novaSenha_confirmation" type="password" placeholder="Confirme a nova senha" autocomplete="new-password">
            <button class="password-toggle" type="button" aria-label="Mostrar senha" data-target="confirmarSenha">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M2.5 12s3.2-5 9.5-5 9.5 5 9.5 5-3.2 5-9.5 5-9.5-5-9.5-5Z"></path>
                <circle cx="12" cy="12" r="2.5"></circle>
              </svg>
            </button>
          </div>
        </div>

        <button class="submit-button" type="submit">
          <span>Redefinir senha</span>
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M4 12h15"></path>
            <path d="m13 6 6 6-6 6"></path>
          </svg>
        </button>

        <div class="divider"></div>

        <p class="request-access">
          Ainda não é cadastrado?
          <a href="#">Solicitar acesso</a>
        </p>
      </form>
    </section>
  </main>

  <script>
    document.querySelectorAll(".password-toggle").forEach(function (toggle) {
      toggle.addEventListener("click", function () {
        var input = document.getElementById(toggle.dataset.target);
        var isPassword = input.type === "password";
        input.type = isPassword ? "text" : "password";
        toggle.setAttribute("aria-label", isPassword ? "Ocultar senha" : "Mostrar senha");
      });
    });
  </script>
</body>
</html>