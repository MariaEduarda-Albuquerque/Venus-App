document.addEventListener("DOMContentLoaded", function () {

    // --- SIDEBAR & SUBMENUS ---
    document.querySelectorAll(".submenu").forEach(function (sm) {
        sm.classList.remove("ativo");
    });

    const menuBtn = document.getElementById("menuBtn");
    const sidebar = document.getElementById("sidebar");

    if (menuBtn && sidebar) {
        menuBtn.addEventListener("click", function (event) {
            event.preventDefault();
            sidebar.classList.toggle("compacta");
        });
    }

    document.querySelectorAll(".imgMaisOpcoes").forEach(function (botao) {
        botao.addEventListener("click", function (event) {
            event.stopPropagation();
            const item = this.closest(".itemsSidebar");
            const submenu = item ? item.querySelector(".submenu") : null;
            if (submenu) submenu.classList.toggle("ativo");
        });
    });

    // --- DROPDOWN DO FILTRO ---
    const btnFiltro = document.getElementById("btnFiltro");
    const dropdownFiltro = document.getElementById("dropdownFiltro");

    if (btnFiltro && dropdownFiltro) {
        btnFiltro.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();
            dropdownFiltro.classList.toggle("show");
        });

        document.addEventListener("click", function (event) {
            if (!event.target.closest("#btnFiltro") && !dropdownFiltro.contains(event.target)) {
                dropdownFiltro.classList.remove("show");
            }
        });
    }
});