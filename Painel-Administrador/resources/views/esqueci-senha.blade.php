<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vênus — Inserir Código</title>
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
    </section>

    <!-- Área direita -->
    <section class="form-area">
      <div class="ambient-circle ambient-one"></div>
      <div class="ambient-circle ambient-two"></div>

      <form class="login-card" action="#" method="post">
        @csrf
        <div class="title-line"></div>
        <h1>Inserir Código</h1>
        <p class="intro">
          Insira o código que foi enviado para o seu e-mail<br class="desktop-only">
          para trocar sua senha.
        </p>

        <div class="field">
          <label for="codNovaSenha">Código</label>
          <div class="input-wrap">
            <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true">
              <rect x="5" y="10" width="14" height="10" rx="2"></rect>
              <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
            </svg>
            <input id="codNovaSenha" name="codNovaSenha" type="text" placeholder="Digite o código" autocomplete="one-time-code" inputmode="numeric">
          </div>
        </div>

        <button class="submit-button" type="submit">
          <span>Inserir</span>
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
</body>
</html>