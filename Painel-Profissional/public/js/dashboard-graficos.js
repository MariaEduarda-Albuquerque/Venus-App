/* ==========================================================
   VÊNUS — Gráficos do dashboard (ECharts) — 4 GRÁFICOS DE CONTEÚDO
   public/js/dashboard-graficos.js

   Mesmo tema (claro/escuro) e idioma de antes. Os dados vêm de
   window.dashboardData, montado no dashboard.blade.php:
     porMes       -> [{ rotulo, total }]
     porCategoria -> [{ categoria, total }]
     alcance      -> [{ titulo, visualizacoes, curtidas }]
     aprovacao    -> { taxa, publicados, enviados }

   1) chartMeses      barras: publicações por mês
   2) chartCategorias rosa:   conteúdos por categoria
   3) chartAlcance    barras agrupadas: visualizações x curtidas
   4) chartAprovacao  medidor: taxa de aprovação
   ========================================================== */

(function () {
    'use strict';

    var charts = {};

    // Tons da marca para as fatias de categoria
    var PALETA = ['#9E182B', '#c23553', '#d9506b', '#f1a3b3', '#6b1330', '#a83a56', '#e07a8f'];

    function t(texto) { return window.Venus ? Venus.t(texto) : texto; }
    function escuro() { return window.Venus && Venus.getTema() === 'escuro'; }

    function cores() {
        var e = escuro();
        return {
            texto: e ? '#b3b3b3' : '#8a7680',
            grade: e ? '#2b2b2b' : '#f3e6e8',
            destaque: e ? '#ef5b73' : '#6b1330',
            borda: e ? '#151515' : '#ffffff',
            fundoBarra: e ? '#1f1f1f' : '#fbefee',
            linhaRotulo: e ? '#555555' : '#d9c3c8',
            sombra: e ? 'rgba(0, 0, 0, 0.5)' : 'rgba(107, 19, 48, 0.18)',
            tooltip: {
                backgroundColor: e ? '#1f1f1f' : '#ffffff',
                borderColor: e ? '#333333' : '#eadfe1',
                textStyle: { color: e ? '#f5f5f5' : '#3a2530' }
            },
            vazio: e ? '#2a2a2a' : '#fafafa'
        };
    }

    function criar(id) {
        var el = document.getElementById(id);
        if (!el) return null;
        if (!charts[id]) charts[id] = echarts.init(el);
        return charts[id];
    }

    function grad(c1, c2) {
        return new echarts.graphic.LinearGradient(0, 0, 0, 1, [
            { offset: 0, color: c1 },
            { offset: 1, color: c2 }
        ]);
    }

    function tooltip(base, c) {
        var o = {};
        for (var k in base) o[k] = base[k];
        for (var k2 in c.tooltip) o[k2] = c.tooltip[k2];
        return o;
    }

    // Quadro "sem dados" (usado quando não há nada para desenhar)
    function desenharVazio(chart, titulo, sub) {
        if (!chart) return;
        var c = cores();
        chart.clear();
        chart.setOption({
            title: {
                text: t(titulo),
                subtext: t(sub),
                left: 'center',
                top: 'middle',
                textStyle: { color: c.texto, fontSize: 14, fontWeight: 500 },
                subtextStyle: { color: c.texto, fontSize: 12 }
            },
            backgroundColor: c.vazio
        }, true);
    }

    function desenhar() {
        if (typeof echarts === 'undefined') return;

        var c = cores();
        var dados = window.dashboardData || {};

        /* ---------- 1) Publicações por mês ---------- */
        var c1 = criar('chartMeses');
        if (c1) {
            var meses = dados.porMes || [];

            c1.setOption({
                tooltip: tooltip({ trigger: 'axis', axisPointer: { type: 'shadow' } }, c),
                grid: { left: 10, right: 10, top: 30, bottom: 10, containLabel: true },
                xAxis: {
                    type: 'category',
                    data: meses.map(function (m) { return m.rotulo; }),
                    axisTick: { show: false },
                    axisLine: { lineStyle: { color: c.grade } },
                    axisLabel: { color: c.texto }
                },
                yAxis: {
                    type: 'value',
                    min: 0,
                    minInterval: 1,
                    max: function (v) { return Math.max(v.max, 4); },
                    splitLine: { lineStyle: { color: c.grade } },
                    axisLabel: { color: c.texto }
                },
                series: [{
                    name: t('Publicações'),
                    type: 'bar',
                    data: meses.map(function (m) { return m.total; }),
                    barMaxWidth: 46,
                    showBackground: true,
                    backgroundStyle: { color: c.fundoBarra, borderRadius: [6, 6, 0, 0] },
                    itemStyle: {
                        borderRadius: [6, 6, 0, 0],
                        color: grad('#d9506b', '#9E182B')
                    },
                    emphasis: { itemStyle: { color: grad('#9E182B', '#6b1330') } },
                    label: { show: true, position: 'top', color: c.destaque, fontWeight: 700, fontSize: 11 }
                }]
            }, true);
        }

        /* ---------- 2) Rosa: conteúdos por categoria ---------- */
        var c2 = criar('chartCategorias');
        if (c2) {
            var categorias = dados.porCategoria || [];
            var semCategorias = !categorias.length;

            c2.setOption({
                tooltip: semCategorias ? { show: false } : tooltip({ trigger: 'item', formatter: '{b}: {c} ({d}%)' }, c),
                title: semCategorias
                    ? {
                        text: t('Sem conteúdos ainda'),
                        left: 'center',
                        top: 'middle',
                        textStyle: { color: c.texto, fontSize: 13, fontWeight: 500 }
                    }
                    : { show: false },
                series: [{
                    name: t('Categorias'),
                    type: 'pie',
                    radius: semCategorias ? ['52%', '70%'] : ['18%', '68%'],
                    center: ['50%', '52%'],
                    roseType: semCategorias ? false : 'radius',
                    silent: semCategorias,
                    data: semCategorias
                        ? [{ value: 1, name: '', itemStyle: { color: c.fundoBarra } }]
                        : categorias.map(function (cat, i) {
                            return { value: cat.total, name: cat.categoria, itemStyle: { color: PALETA[i % PALETA.length] } };
                        }),
                    label: { show: !semCategorias, color: c.texto, fontFamily: 'Poppins', fontSize: 11 },
                    labelLine: { show: !semCategorias, lineStyle: { color: c.linhaRotulo }, smooth: 0.2, length: 8, length2: 14 },
                    itemStyle: semCategorias
                        ? { borderWidth: 0 }
                        : { borderColor: c.borda, borderWidth: 2, shadowBlur: 12, shadowColor: c.sombra },
                    animationType: 'scale',
                    animationEasing: 'elasticOut',
                    animationDelay: function () { return Math.random() * 200; }
                }]
            }, true);
        }

        /* ---------- 3) Alcance por conteúdo: visualizações x curtidas ---------- */
        var c3 = criar('chartAlcance');
        if (c3) {
            var alcance = dados.alcance || [];

            if (!alcance.length) {
                desenharVazio(c3, 'Sem conteúdos publicados', 'O alcance aparece aqui quando houver itens publicados.');
            } else {
                c3.setOption({
                    tooltip: tooltip({ trigger: 'axis', axisPointer: { type: 'shadow' } }, c),
                    legend: { bottom: 0, icon: 'circle', textStyle: { color: c.texto } },
                    grid: { left: 10, right: 44, top: 10, bottom: 40, containLabel: true },
                    xAxis: {
                        type: 'value',
                        min: 0,
                        minInterval: 1,
                        max: function (v) { return Math.max(v.max, 4); },
                        splitLine: { lineStyle: { color: c.grade } },
                        axisLabel: { color: c.texto }
                    },
                    yAxis: {
                        type: 'category',
                        inverse: true, // o conteúdo com mais alcance fica no topo
                        data: alcance.map(function (a) { return a.titulo; }),
                        axisTick: { show: false },
                        axisLine: { lineStyle: { color: c.grade } },
                        axisLabel: { color: c.texto, width: 130, overflow: 'truncate' }
                    },
                    series: [
                        {
                            name: t('Visualizações'), type: 'bar', barMaxWidth: 16,
                            data: alcance.map(function (a) { return a.visualizacoes; }),
                            itemStyle: { color: '#f1a3b3', borderRadius: [0, 6, 6, 0] },
                            label: { show: true, position: 'right', color: c.texto, fontSize: 11 }
                        },
                        {
                            name: t('Curtidas'), type: 'bar', barMaxWidth: 16,
                            data: alcance.map(function (a) { return a.curtidas; }),
                            itemStyle: { color: '#9E182B', borderRadius: [0, 6, 6, 0] },
                            label: { show: true, position: 'right', color: c.destaque, fontWeight: 700, fontSize: 11 }
                        }
                    ]
                }, true);
            }
        }

        /* ---------- 4) Medidor: taxa de aprovação ---------- */
        var c4 = criar('chartAprovacao');
        if (c4) {
            var ap = dados.aprovacao || {};
            var semEnvio = !(ap.enviados > 0);
            var taxa = semEnvio ? 0 : (ap.taxa || 0);
            var legenda = semEnvio
                ? t('Nenhum conteúdo enviado ainda')
                : ap.publicados + ' ' + t('de') + ' ' + ap.enviados + ' ' + t('enviados para revisão');

            c4.setOption({
                series: [{
                    type: 'gauge',
                    startAngle: 210,
                    endAngle: -30,
                    min: 0,
                    max: 100,
                    radius: '88%',
                    center: ['50%', '60%'],
                    progress: { show: !semEnvio, width: 18, roundCap: true, itemStyle: { color: '#9E182B' } },
                    axisLine: { roundCap: true, lineStyle: { width: 18, color: [[1, c.grade]] } },
                    pointer: { show: false },
                    axisTick: { show: false },
                    splitLine: { show: false },
                    axisLabel: { show: false },
                    anchor: { show: false },
                    title: { show: true, offsetCenter: [0, '36%'], color: c.texto, fontSize: 12, fontFamily: 'Poppins' },
                    detail: {
                        valueAnimation: true,
                        offsetCenter: [0, '-2%'],
                        fontSize: 36,
                        fontWeight: 700,
                        fontFamily: 'Poppins',
                        color: c.destaque,
                        formatter: function (v) { return semEnvio ? '—' : Math.round(v) + '%'; }
                    },
                    data: [{ value: taxa, name: legenda }]
                }]
            }, true);
        }
    }

    document.addEventListener('DOMContentLoaded', desenhar);
    document.addEventListener('venus:tema', desenhar);
    document.addEventListener('venus:idioma', desenhar);

    window.addEventListener('resize', function () {
        Object.keys(charts).forEach(function (id) { charts[id].resize(); });
    });
})();