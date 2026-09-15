document.addEventListener("DOMContentLoaded", function () {

  // fecha todos os submenus ao carregar, pra garantir estado inicial
  document.querySelectorAll(".submenu").forEach(function (sm) {
    sm.classList.remove("ativo");
  });

  // menu hamburguer (compactar sidebar)
  const menuBtn = document.getElementById("menuBtn");
  const sidebar = document.getElementById("sidebar");

  if (menuBtn && sidebar) {
    menuBtn.addEventListener("click", function (event) {
      event.preventDefault();
      sidebar.classList.toggle("compacta");
    });
  }

  // abrir/fechar submenus ao clicar na seta
  const botoes = document.querySelectorAll(".imgMaisOpcoes");

  botoes.forEach(function (botao) {
    botao.addEventListener("click", function (event) {
      event.stopPropagation();
      const item = this.closest(".itemsSidebar");
      const submenu = item ? item.querySelector(".submenu") : null;
      if (submenu) {
        submenu.classList.toggle("ativo");
      }
    });
  });

});