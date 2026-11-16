/* Menu lateral recolhível — Vênus
   Salvar em: public/js/sidebar.js */
(function () {
    var CHAVE = 'venusSidebar';
    var raiz = document.documentElement;

    // Aplica o estado salvo antes da página aparecer (evita "piscar")
    try {
        if (localStorage.getItem(CHAVE) === 'recolhida') raiz.classList.add('sidebar-recolhida');
    } catch (e) {}

    document.addEventListener('DOMContentLoaded', function () {
        var topbar = document.querySelector('.topbar');
        var breadcrumb = document.querySelector('.topbar .breadcrumb');
        if (!topbar || !breadcrumb || !document.querySelector('.sidebar')) return;

        // Dica ao passar o mouse nos ícones quando o menu está recolhido
        document.querySelectorAll('.sidebar .nav-item').forEach(function (a) {
            var nome = a.querySelector('span:not(.nav-badge)');
            if (nome) a.setAttribute('title', nome.textContent.trim());
        });

        // Botão de recolher/expandir ao lado do breadcrumb
        var botao = document.createElement('button');
        botao.type = 'button';
        botao.className = 'sidebar-toggle';
        botao.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2" /><path d="M9 4v16" /></svg>';

        var grupo = document.createElement('div');
        grupo.className = 'topbar-left';
        topbar.insertBefore(grupo, breadcrumb);
        grupo.appendChild(botao);
        grupo.appendChild(breadcrumb);

        function atualizarRotulo() {
            var recolhida = raiz.classList.contains('sidebar-recolhida');
            botao.setAttribute('aria-label', recolhida ? 'Expandir menu lateral' : 'Recolher menu lateral');
            botao.setAttribute('title', recolhida ? 'Expandir menu' : 'Recolher menu');
            botao.setAttribute('aria-expanded', recolhida ? 'false' : 'true');
        }

        botao.addEventListener('click', function () {
            var recolhida = raiz.classList.toggle('sidebar-recolhida');
            try { localStorage.setItem(CHAVE, recolhida ? 'recolhida' : 'expandida'); } catch (e) {}
            atualizarRotulo();

            // Faz os gráficos do painel se ajustarem à nova largura
            setTimeout(function () { window.dispatchEvent(new Event('resize')); }, 300);
        });

        atualizarRotulo();
    });
})();