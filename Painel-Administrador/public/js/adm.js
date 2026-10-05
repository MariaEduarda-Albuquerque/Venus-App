document.addEventListener("DOMContentLoaded", function () {

    // Sidebar
window.compactarSidebar = function() {
    document.getElementById("sidebar").classList.toggle("compacta");
}

window.abrirSubMenu = function(botao) {
    botao.classList.toggle("virada");
    const item = botao.closest(".itemsSidebar");
    const submenu = item ? item.querySelector(".submenu") : null;
    if (submenu) submenu.classList.toggle("ativo");
}


    // Modal Conteudos
        window.abrirModal = function () {
            document.querySelector('.modal-overlay').classList.add('ativo');
            document.querySelector(".modal-conteudo").classList.add('ativo');
        };

        window.fecharModal = function () {
            document.querySelector('.modal-overlay').classList.remove('ativo');
            document.querySelector(".modal-conteudo").classList.remove('ativo');
        };

        window.abrirModalCompleto = function (){
            document.querySelector(".modal-conteudo").classList.remove('ativo');
            document.querySelector('.modal-overlay').classList.remove('ativo');
            document.querySelector('.modal-overlay-2').classList.add('ativo');
            document.querySelector(".modal-conteudo-completo").classList.add('ativo');
        }

        
        window.fecharConteudoCompleto = function () {
            document.querySelector(".modal-conteudo").classList.add('ativo');
            document.querySelector('.modal-overlay').classList.add('ativo');
            document.querySelector('.modal-overlay-2').classList.remove('ativo');
            document.querySelector(".modal-conteudo-completo").classList.remove('ativo');
        };



    // Filtro
        window.abrirMenuFiltros = function (){
            document.querySelector('.filtro-menu').classList.toggle('ativo');
        }

    //Responder feedback:
        window.responder = function () {
            document.querySelector('.modal-overlay').classList.add('ativo');
        };

        window.responderFechar = function () {
            document.querySelector('.modal-overlay').classList.remove('ativo');
        };

    // Grafico

const ctx = document.getElementById('meuGrafico');

new Chart(ctx, {
    type: 'line',

    data: {
        labels: ['23/03', '04/04', '11/04', '18/04', '25/04', '02/05', '09/05', '16/05'],

        datasets: [
            {
                label: 'Usuárias',
                data: [260, 357, 287, 540, 600, 721, 610, 899],
                borderColor: '#EBA5B4',
                backgroundColor: '#EBA5B4',
                tension: 0.3
            },
            {
                label: 'Profissionais',
                data: [160, 257, 187, 340, 200, 421, 510, 699],
                borderColor: 'rgb(158, 24, 43)',
                backgroundColor: 'rgb(158, 24, 43)',
                tension: 0.3
            }
        ]
    },

    options: {
            scales: {
        x: {
            grid: {
                display: false 
            }
        },
        y: {
            min: 0,
            max: 1000,

            ticks: {
                stepSize: 250
            },
            grid: {
                display: true 
            }
        }
    },
        plugins: {
            legend: {
                position: 'top',
                align: 'end',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            }
        }
    }
});
});