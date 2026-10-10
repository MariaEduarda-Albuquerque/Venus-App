/* =========================================================
   RELATÓRIOS (usuárias, atendimento e denúncias)
   Cada página define window.RELATORIO com título, rótulos e gráficos.
   ========================================================= */
function paginaRelatorio() {
    // Se a página não tem a configuração, não é uma página de relatório
    const config = window.RELATORIO;
    if (!config) {
        return;
    }

    const graficos = config.graficos;
    const toast = document.getElementById('toast');
    const seletorPeriodo = document.getElementById('rel-p');
    const cores = ['#9B1B2A', '#D6576A', '#EDA3AE', '#B8A3A8', '#F5D5DA'];

    let charts = [];   // os gráficos que estão na tela

    // Mostra o aviso por alguns segundos
    function mostrarAviso(texto) {
        toast.querySelector('span').textContent = texto;
        toast.classList.add('is-show');
        clearTimeout(toast.tempo);
        toast.tempo = setTimeout(function () {
            toast.classList.remove('is-show');
        }, 2400);
    }

    // Soma os números de uma lista: [['A', 10], ['B', 5]] vira 15
    function somar(lista) {
        let total = 0;
        for (let i = 0; i < lista.length; i++) {
            total = total + lista[i][1];
        }
        return total;
    }

    // Acha o nome do item com o maior número
    function acharMaior(lista) {
        let nome = '';
        let maior = -1;
        for (let i = 0; i < lista.length; i++) {
            if (lista[i][1] > maior) {
                maior = lista[i][1];
                nome = lista[i][0];
            }
        }
        return nome;
    }

    // Devolve os dados já multiplicados pelo período escolhido
    // (30 dias x1, 90 dias x2,8, 1 ano x11). Se "periodo" for false, fica x1.
    function dadosDoPeriodo() {
        let fator = 1;
        if (config.periodo) {
            fator = Number(seletorPeriodo.value);
        }

        const resultado = [];
        for (let i = 0; i < graficos.length; i++) {
            const itens = [];
            for (let j = 0; j < graficos[i].d.length; j++) {
                const nome = graficos[i].d[j][0];
                const valor = graficos[i].d[j][1];
                itens.push([nome, Math.round(valor * fator)]);
            }
            resultado.push({ t: graficos[i].t, s: graficos[i].s, rosa: graficos[i].rosa, d: itens });
        }
        return resultado;
    }

    // Cria um gráfico de pizza dentro de uma caixa
    function criarGrafico(caixa, grafico) {
        const itens = [];
        for (let i = 0; i < grafico.d.length; i++) {
            itens.push({ name: grafico.d[i][0], value: grafico.d[i][1] });
        }

        const opcoes = {
            textStyle: { fontFamily: 'Nunito' },
            color: cores,
            animationDuration: 800,
            tooltip: {
                trigger: 'item',
                formatter: '{b}: <b>{c}</b> ({d}%)',
                backgroundColor: '#fff',
                borderWidth: 0,
                textStyle: { color: '#2B1F22' },
                extraCssText: 'box-shadow:0 4px 16px rgba(0,0,0,.1);border-radius:10px'
            },
            legend: { bottom: 0, icon: 'circle', itemWidth: 8, textStyle: { color: '#7E7075' } },
            series: [{
                type: 'pie',
                radius: grafico.rosa ? ['18%', '68%'] : ['50%', '72%'],
                center: ['50%', '44%'],
                roseType: grafico.rosa ? 'radius' : false,
                itemStyle: { borderRadius: 8, borderColor: '#fff', borderWidth: 3 },
                label: { show: false },
                emphasis: { scaleSize: 8 },
                data: itens
            }]
        };

        // Os gráficos "rosa" não mostram o total no meio
        if (!grafico.rosa) {
            opcoes.title = {
                text: somar(grafico.d).toLocaleString('pt-BR'),
                subtext: 'total',
                left: 'center',
                top: '36%',
                textStyle: { fontSize: 24, fontWeight: 800, color: '#2B1F22' },
                subtextStyle: { color: '#7E7075' }
            };
        }

        const g = echarts.init(caixa);
        g.setOption(opcoes);
        return g;
    }

    // Desenha a página: números de cima e os gráficos
    function desenhar() {
        // Apaga os gráficos antigos
        for (let i = 0; i < charts.length; i++) {
            charts[i].dispose();
        }
        charts = [];

        const dados = dadosDoPeriodo();

        // Os 3 cards de cima usam o primeiro gráfico
        document.getElementById('k-total').textContent = somar(dados[0].d).toLocaleString('pt-BR');
        document.getElementById('k-grupo').textContent = acharMaior(dados[0].d);
        document.getElementById('k-extra').textContent = config.extra;

        // Cria as caixas dos gráficos
        let html = '';
        for (let i = 0; i < dados.length; i++) {
            html += '<div class="rel-card">'
                  +   '<h3>' + dados[i].t + '</h3>'
                  +   '<p>' + dados[i].s + '</p>'
                  +   '<div class="rel-grafico" id="rch' + i + '"></div>'
                  + '</div>';
        }
        document.getElementById('rel-c').innerHTML = html;

        // Desenha cada gráfico dentro da sua caixa
        for (let i = 0; i < dados.length; i++) {
            charts.push(criarGrafico(document.getElementById('rch' + i), dados[i]));
        }

        if (window.lucide) {
            lucide.createIcons();
        }
    }

    // Gera o PDF com os números e os gráficos
    function baixarPdf() {
        if (!window.jspdf) {
            mostrarAviso('Gerador de PDF indisponível. Verifique a conexão.');
            return;
        }

        const doc = new window.jspdf.jsPDF();
        const periodo = seletorPeriodo.options[seletorPeriodo.selectedIndex].text;

        doc.setFont('helvetica', 'bold');
        doc.setFontSize(18);
        doc.setTextColor(155, 27, 42);
        doc.text('Vênus', 14, 18);

        doc.setFontSize(13);
        doc.setTextColor(43, 31, 34);
        doc.text(config.titulo, 14, 27);

        doc.setFont('helvetica', 'normal');
        doc.setFontSize(9);
        doc.setTextColor(126, 112, 117);
        doc.text(periodo + ' · Gerado em ' + new Date().toLocaleString('pt-BR'), 14, 33);

        // Tabela com os 3 números
        doc.autoTable({
            startY: 38,
            head: [['Indicador', 'Valor']],
            body: [
                [config.rotulos[0], document.getElementById('k-total').textContent],
                [config.rotulos[1], document.getElementById('k-grupo').textContent],
                [config.rotulos[2], document.getElementById('k-extra').textContent]
            ],
            styles: { font: 'helvetica', fontSize: 9, cellPadding: 3, textColor: [43, 31, 34] },
            headStyles: { fillColor: [155, 27, 42], textColor: 255 },
            alternateRowStyles: { fillColor: [253, 246, 247] },
            margin: { left: 14, right: 14 }
        });

        // Os gráficos, um embaixo do outro
        let y = doc.lastAutoTable.finalY + 10;
        for (let i = 0; i < charts.length; i++) {
            const largura = 120;
            const altura = largura * charts[i].getHeight() / charts[i].getWidth();

            // Não coube na página: começa outra
            if (y + altura + 14 > 282) {
                doc.addPage();
                y = 20;
            }

            doc.setFont('helvetica', 'bold');
            doc.setFontSize(12);
            doc.setTextColor(155, 27, 42);
            doc.text(graficos[i].t, 14, y);

            const imagem = charts[i].getDataURL({ pixelRatio: 2, backgroundColor: '#fff' });
            doc.addImage(imagem, 'PNG', 14, y + 3, largura, altura);
            y = y + altura + 14;
        }

        doc.save(config.arquivo + '-' + new Date().toISOString().slice(0, 10) + '.pdf');
        mostrarAviso('PDF gerado com sucesso.');
    }

    // Botão "Baixar PDF"
    document.getElementById('btn-pdf').addEventListener('click', baixarPdf);

    // Trocou o período: desenha de novo
    seletorPeriodo.addEventListener('change', desenhar);

    // Ajusta os gráficos quando a janela muda de tamanho
    window.addEventListener('resize', function () {
        for (let i = 0; i < charts.length; i++) {
            charts[i].resize();
        }
    });

    desenhar();
}

// Roda quando a página termina de carregar.
// Se der erro, aparece no Console (F12) e não atrapalha outros arquivos.
document.addEventListener('DOMContentLoaded', function () {
    try {
        paginaRelatorio();
    } catch (erro) {
        console.error('Erro na página "Relatório":', erro);
    }
});