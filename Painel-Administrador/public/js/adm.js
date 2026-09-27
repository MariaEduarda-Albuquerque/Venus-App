document.addEventListener("DOMContentLoaded", function () {

    // Sidebar
    window.compactarSidebar = function () {
        document.getElementById("sidebar").classList.toggle("compacta");
    }

    window.abrirSubMenu = function (botao) {
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

    window.abrirModalCompleto = function () {
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
    window.abrirMenuFiltros = function () {
        document.querySelector('.filtro-menu').classList.toggle('ativo');
    }

    // Responder feedback:
    window.responder = function () {
        document.querySelector('.modal-overlay').classList.add('ativo');
    };

    window.responderFechar = function () {
        document.querySelector('.modal-overlay').classList.remove('ativo');
    };


    // Grafico (Apache ECharts)
    // (este arquivo é usado em várias telas: só cria o gráfico se a tela
    //  tiver o <div id="meuGrafico"> e o ECharts carregado)

    const el = document.getElementById('meuGrafico');

    if (el && typeof echarts !== 'undefined') {

        const grafico = echarts.init(el);

        grafico.setOption({
            textStyle: {
                fontFamily: 'Arial, Helvetica, sans-serif',
                color: '#777'
            },

            color: ['#EBA5B4', 'rgb(158, 24, 43)'],

            tooltip: {
                trigger: 'axis'
            },

            legend: {
                data: ['Usuárias', 'Profissionais'],
                right: 0,
                top: 0,
                icon: 'circle',
                itemWidth: 8,
                itemHeight: 8,
                textStyle: { fontSize: 11, color: '#777' }
            },

            grid: {
                left: 0,
                right: 10,
                top: 36,
                bottom: 0,
                containLabel: true
            },

            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: ['23/03', '04/04', '11/04', '18/04', '25/04', '02/05', '09/05', '16/05'],
                axisLine: { show: false },
                axisTick: { show: false },
                axisLabel: { fontSize: 11, color: '#777' }
            },

            yAxis: {
                type: 'value',
                min: 0,
                max: 1000,
                interval: 250,
                axisLabel: { fontSize: 11, color: '#777' },
                splitLine: { lineStyle: { color: '#ececec' } }
            },

            series: [
                {
                    name: 'Usuárias',
                    type: 'line',
                    smooth: true,
                    symbol: 'circle',
                    symbolSize: 6,
                    lineStyle: { width: 2 },
                    data: [260, 357, 287, 540, 600, 721, 610, 899]
                },
                {
                    name: 'Profissionais',
                    type: 'line',
                    smooth: true,
                    symbol: 'circle',
                    symbolSize: 6,
                    lineStyle: { width: 2 },
                    data: [160, 257, 187, 340, 200, 421, 510, 699]
                }
            ]
        });

        // Redimensiona sozinho quando a caixa muda de tamanho
        // (janela, sidebar abrindo/compactando, celular girando...)
        new ResizeObserver(function () {
            grafico.resize();
        }).observe(el);
    }
});