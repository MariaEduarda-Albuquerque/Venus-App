@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/adm.css') }}">
@endpush

@section('content')

<div class="head">
    <h1>Painel administrativo</h1>
    <button class="date" id="datebtn" onclick="paginaCalendario()" aria-label="Abrir calendário">
        <i data-lucide="calendar"></i>
        <span id="datetxt">{{$dataHoje}}</span>
    </button>
</div>

<div class="alert">
    <i data-lucide="alert-circle"></i>
    <span><b>Atenção:</b> existem {{$denunciasAltaGravidadeUltimas24h}} denúncias de gravidade alta pendentes há mais de 24 horas.</span>
    <button class="btn p s">Ver denúncias</button>
</div>

<div class="grid g3">
    <div class="card kpi">
        <div class="ico"><i data-lucide="users"></i></div>
        <div><b>{{$usuariasAtivas}}</b><span>Usuárias ativas</span> <span class="up">↑ {{$porcentagemUsuariasAtivasNoMes}}% no mês</span></div>
    </div>
    <div class="card kpi">
        <div class="ico"><i data-lucide="stethoscope"></i></div>
        <div><b>{{$profissionaisAtivos}}</b><span>Profissionais ativos</span> <span class="up">↑ {{$porcentagemProfissionaisAtivosNoMes}}% no mês</span></div>
    </div>
    <div class="card kpi">
        <div class="ico"><i data-lucide="user-plus"></i></div>
        <div><b>{{$aguardandoAprovacao}}</b><span>Cadastros aguardando aprovação</span></div>
    </div>
</div>

<div class="grid g2 mt">
    <div class="stack">
        {{-- "fila-prioritaria" é a classe que dá o tamanho fixo ao card (veja o CSS) --}}
        <div class="card fila-prioritaria">
            <h3>Fila prioritária</h3>
            <p class="sm">Denúncias de alta gravidade</p>

            @forelse ($denunciasAltaGravidade as $denuncia)
            <div class="row"><span class="t">{{ Str::limit($denuncia->motivoDenuncia, 35, '...')}}</span><span class="chip">{{$denuncia->tipoAlvo}}</span><span class="sm">{{$denuncia->dataDenuncia->locale('pt_BR')->diffForHumans(short: true, parts: 1, options: \Carbon\Carbon::JUST_NOW)}}</span></div>
            @empty
            <p class="sm" style="padding:9px 0">Nenhuma denúncia de alta gravidade.</p>
            @endforelse

            <h3 style="margin-top:14px">Aprovações de profissionais</h3>
            @forelse ($profissionaisAguardandoAprovacao as $profissional)
            <div class="row"><span class="t">{{$profissional->nomeProfissionalSaude}} <span class="sm">CRP 06/123456</span></span><span class="sm">{{$profissional->dataCadastro->locale('pt_BR')->diffForHumans(short: true, parts: 1, options: \Carbon\Carbon::JUST_NOW)}}</span></div>
            @empty
            <p class="sm" style="padding:9px 0">Nenhum cadastro aguardando aprovação.</p>
            @endforelse

            {{-- "fila-botao" mantém o botão sempre colado embaixo do card --}}
            <button class="btn g s mt fila-botao" style="width:100%;justify-content:center">Ver todas as pendências</button>
        </div>
    </div>

    <div class="stack">
        <div class="card">
            <h3>Novos cadastros</h3>
            <p class="sm">Últimas 8 semanas</p>
            <div id="c-line" class="chart"></div>
        </div>
        <div class="card kpi">
            <div class="ico"><i data-lucide="file-text"></i></div>
            <div style="flex:1"><b>{{$conteudosAguardandoRev}}</b><span>Conteúdos aguardando revisão · {{$conteudosAguardandoRevArtigo}} artigos e {{$conteudosAguardandoRevVideo}} vídeos</span></div>
            <button class="btn g s">Ir para conteúdos</button>
        </div>
    </div>
</div>

<div class="grid g3 mt">
    <div class="card kpi">
        <div class="ico"><i data-lucide="clock"></i></div>
        <div><b>{{$tempoMedio}}</b><span>Tempo médio de resposta a denúncias</span></div>
    </div>
    <div class="card kpi">
        <div class="ico"><i data-lucide="smile"></i></div>
        <div><b>{{$avaliacaoMediaUsuarias}}/5</b><span>Satisfação das usuárias referente ás consultas (30 dias)</span></div>
    </div>
    <div class="card">
        <div class="kpi">
            <div class="ico"><i data-lucide="flag"></i></div>
            <div><b>{{$qtdDenunciasPendentes}}</b><span>Denúncias pendentes</span> <span class="dn">↑ {{$qtdDenunciasPendentesDesdeOntem}} desde ontem</span></div>
        </div>
    </div>
</div>

<div class="card mt">
    <h3>Denúncias por tipo de alvo</h3>
    <p class="sm">Passe o mouse para ver detalhes</p>
    <div id="c-pie" class="chart" style="height:280px"></div>
</div>

{{-- NOVO: modal do calendário e aviso (toast) --}}
<div class="cm" id="cm4"><div class="cmb cal" id="cmb4"></div></div>
<div class="toast" id="toast"><i data-lucide="check-circle-2"></i><span></span></div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
<script>
    const $ = (s, r = document) => r.querySelector(s);

    /* ---------- gráficos (mesmo código de antes) ---------- */
    const font = { fontFamily: 'Nunito' };
    const W = '#9B1B2A';

    const l = echarts.init(document.getElementById('c-line'));
    const p = echarts.init(document.getElementById('c-pie'));
    const x = [@json($semana8),@json($semana7),@json($semana6),@json($semana5),@json($semana4),@json($semana3),@json($semana2), @json($semana1)];

    l.setOption({
        textStyle: font,
        animationDuration: 900,
        color: ['#E8A1AC', W],
        tooltip: { trigger: 'axis', backgroundColor: '#fff', borderWidth: 0, textStyle: { color: '#2B1F22' }, extraCssText: 'box-shadow:0 4px 16px rgba(0,0,0,.1);border-radius:10px' },
        legend: { right: 0, top: 0, icon: 'circle', itemWidth: 8, textStyle: { color: '#7E7075' } },
        grid: { left: 36, right: 10, top: 36, bottom: 24 },
        xAxis: { type: 'category', data: x, boundaryGap: false, axisLine: { show: false }, axisTick: { show: false }, axisLabel: { color: '#7E7075' } },
        yAxis: { type: 'value', axisLabel: { color: '#7E7075' }, splitLine: { lineStyle: { color: '#F1EAEB' } } },
        series: [
            { name: 'Usuárias', type: 'line', smooth: true, symbolSize: 6, data: [@json($usuariosSemana8),@json($usuariosSemana7),@json($usuariosSemana6),@json($usuariosSemana5),@json($usuariosSemana4),@json($usuariosSemana3),@json($usuariosSemana2),@json($usuariosSemana1)], areaStyle: { color: new echarts.graphic.LinearGradient(0,0,0,1,[{offset:0,color:'rgba(232,161,172,.35)'},{offset:1,color:'rgba(232,161,172,0)'}]) } },
            { name: 'Profissionais', type: 'line', smooth: true, symbolSize: 6, data: [@json($profissionaisSemana8),@json($profissionaisSemana8),@json($profissionaisSemana6),@json($profissionaisSemana5),@json($profissionaisSemana4),@json($profissionaisSemana3),@json($profissionaisSemana2),@json($profissionaisSemana1)] }
        ]
    });

    p.setOption({
        textStyle: font,
        animationDuration: 900,
        color: [W, '#C9475A', '#E8A1AC', '#F0CDD4', '#CFC4C7'],
        tooltip: { trigger: 'item', formatter: '{b}: <b>{c}</b> ({d}%)', backgroundColor: '#fff', borderWidth: 0, textStyle: { color: '#2B1F22' }, extraCssText: 'box-shadow:0 4px 16px rgba(0,0,0,.1);border-radius:10px' },
        legend: { orient: 'vertical', right: '8%', top: 'middle', icon: 'circle', textStyle: { color: '#2B1F22' } },
        series: [{
            type: 'pie', radius: ['48%','74%'], center: ['35%','50%'], roseType: 'radius',
            itemStyle: { borderRadius: 8, borderColor: '#fff', borderWidth: 3 },
            label: { show: false },
            emphasis: { scaleSize: 8, label: { show: true, fontWeight: 800, fontSize: 14, formatter: '{b}' } },
            data: [{value:@json($qtdDenunciasForumPublicação),name:'Fórum: Publicação'},{value:@json($qtdDenunciasForumResposta),name:'Fórum: Resposta'},{value:@json($qtdDenunciasMensagemChat),name:'Mensagem no chat'},{value:@json($qtdDenunciasPerfilProfissional),name:'Perfil Profissional'}]
        }]
    });

    window.addEventListener('resize', () => { l.resize(); p.resize(); });
    setTimeout(() => { l.resize(); p.resize(); }, 50);

    /* ---------- NOVO: aviso (toast) ---------- */
    let tt;
    function toast(t) {
        const e = $('#toast');
        $('span', e).textContent = t;
        e.classList.add('show');
        clearTimeout(tt);
        tt = setTimeout(() => e.classList.remove('show'), 2400);
    }

/* =========================================================
   Dashboard: calendário
   ========================================================= */
function paginaCalendario() {
    const botaoData = document.getElementById('datebtn');
    const janela = document.getElementById('cm4');
    const caixa = document.getElementById('cmb4');
    const toast = document.getElementById('toast');
    if (!botaoData || !janela || !caixa) {
        return;
    }

    let ano = @json($ano);
    let mes = @json($mes) - 1;
    let dia = @json($dia);

    const DIAS = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'];
    const HOJE = new Date(ano, mes, dia);   // data de exemplo (23/05/2026)

    let diaEscolhido = new Date(HOJE);    // dia selecionado
    let mesAberto = new Date(ano, mes, 1); // mês que aparece na tela

    // Escreve a data por extenso: "23 de maio de 2026"
    function dataPorExtenso(data) {
        return data.toLocaleDateString('pt-BR', { day: 'numeric', month: 'long', year: 'numeric' });
    }

    // Duas datas são o mesmo dia?
    function mesmoDia(a, b) {
        return a.toDateString() === b.toDateString();
    }

    // Monta o calendário do mês aberto
    function desenhar() {
     const anoAberto = mesAberto.getFullYear();
     const mesAbertoNum = mesAberto.getMonth();
     const diaDaSemanaDoPrimeiro = new Date(anoAberto, mesAbertoNum, 1).getDay();

        // Cabeçalho com D S T Q Q S S
        let semana = '';
        for (let i = 0; i < DIAS.length; i++) {
            semana += '<div class="cal-w">' + DIAS[i] + '</div>';
        }

        // 42 quadradinhos (6 semanas), começando no domingo antes do dia 1
        let dias = '';
        for (let i = 0; i < 42; i++) {
            const dia = new Date(ano, mes, 1 - diaDaSemanaDoPrimeiro + i);

            let classe = 'cal-d';
            if (dia.getMonth() !== mes) classe += ' o';            // dia de outro mês
            if (mesmoDia(dia, HOJE)) classe += ' t';               // hoje
            if (mesmoDia(dia, diaEscolhido)) classe += ' on';      // escolhido

            dias += '<button type="button" class="' + classe + '" data-dia="' + dia.getTime() + '">' + dia.getDate() + '</button>';
        }

        caixa.innerHTML =
            '<div class="cal-h">'
          +   '<h3>' + mesAberto.toLocaleDateString('pt-BR', { month: 'long', year: 'numeric' }) + '</h3>'
          +   '<div class="nv">'
          +     '<button type="button" class="nvb" data-mes="-1" aria-label="Mês anterior"><i data-lucide="chevron-left"></i></button>'
          +     '<button type="button" class="nvb" data-mes="1" aria-label="Próximo mês"><i data-lucide="chevron-right"></i></button>'
          +   '</div>'
          + '</div>'
          + '<div class="cal-g">' + semana + dias + '</div>'
          + '<div class="acts" style="margin-top:20px;align-items:center">'
          +   '<span class="sm">Selecionado: <b style="color:var(--ink)">' + dataPorExtenso(diaEscolhido) + '</b></span>'
          +   '<div>'
          +     '<button type="button" class="btn g s" data-hoje>Hoje</button>'
          +     '<button type="button" class="btn p s" data-fechar-cal>Fechar</button>'
          +   '</div>'
          + '</div>';

        criarIcones();
    }

    function abrir() {
        mesAberto = new Date(diaEscolhido.getFullYear(), diaEscolhido.getMonth(), 1);
        desenhar();
        janela.classList.add('show');
    }

    function fechar() {
        janela.classList.remove('show');
    }

    // Botão com a data: abre o calendário
    botaoData.addEventListener('click', abrir);

    // Cliques dentro do calendário
    document.addEventListener('click', function (e) {
        const alvo = e.target;

        // Setas de mês
        const botaoMes = alvo.closest('[data-mes]');
        if (botaoMes) {
            mesAberto = new Date(mesAberto.getFullYear(), mesAberto.getMonth() + Number(botaoMes.dataset.mes), 1);
            desenhar();
            return;
        }

        // Escolher um dia
        const botaoDia = alvo.closest('[data-dia]');
        if (botaoDia) {
            diaEscolhido = new Date(Number(botaoDia.dataset.dia));
            escreverTexto('datetxt', dataPorExtenso(diaEscolhido));
            fechar();
            mostrarToast(toast, 'Data selecionada: ' + dataPorExtenso(diaEscolhido));
            return;
        }

        // Botão "Hoje"
        if (alvo.closest('[data-hoje]')) {
            diaEscolhido = new Date(HOJE);
            mesAberto = new Date(ano, mes, 1);
            escreverTexto('datetxt', dataPorExtenso(diaEscolhido));
            desenhar();
            return;
        }

        // Botão "Fechar" ou clique no fundo escuro
        if (alvo.closest('[data-fechar-cal]') || alvo === janela) {
            fechar();
        }
    });

    // Esc fecha
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            fechar();
        }
    });
}
</script>
@endpush