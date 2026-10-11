@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/adm.css') }}">
@endpush

@section('content')

<div class="head">
    <h1>Painel administrativo</h1>
    <button class="date" id="datebtn" aria-label="Abrir calendário">
        <i data-lucide="calendar"></i>
        <span id="datetxt">23 de maio de 2026</span>
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
        <div><b>{{$usuariasAtivas}}</b><span>Usuárias ativas</span> <span class="up">↑ 8,2% no mês</span></div>
    </div>
    <div class="card kpi">
        <div class="ico"><i data-lucide="stethoscope"></i></div>
        <div><b>{{$profissionaisAtivos}}</b><span>Profissionais ativos</span> <span class="up">↑ 5,6% no mês</span></div>
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
            <div style="flex:1"><b>9</b><span>Conteúdos aguardando revisão · 5 artigos e 4 vídeos</span></div>
            <button class="btn g s">Ir para conteúdos</button>
        </div>
    </div>
</div>

<div class="grid g3 mt">
    <div class="card kpi">
        <div class="ico"><i data-lucide="clock"></i></div>
        <div><b>2h 45min</b><span>Tempo médio de resposta a denúncias</span></div>
    </div>
    <div class="card kpi">
        <div class="ico"><i data-lucide="smile"></i></div>
        <div><b>4,6/5</b><span>Satisfação das usuárias (30 dias)</span></div>
    </div>
    <div class="card">
        <div class="kpi">
            <div class="ico"><i data-lucide="flag"></i></div>
            <div><b>23</b><span>Denúncias pendentes</span> <span class="dn">↑ 4 desde ontem</span></div>
        </div>
    </div>
</div>

<div class="card mt">
    <h3>Denúncias por tipo</h3>
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
    const x = ['23/03','04/04','11/04','18/04','25/04','02/05','09/05','16/05'];

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
            { name: 'Usuárias', type: 'line', smooth: true, symbolSize: 6, data: [540,670,500,630,700,760,720,860], areaStyle: { color: new echarts.graphic.LinearGradient(0,0,0,1,[{offset:0,color:'rgba(232,161,172,.35)'},{offset:1,color:'rgba(232,161,172,0)'}]) } },
            { name: 'Profissionais', type: 'line', smooth: true, symbolSize: 6, data: [200,250,190,220,200,240,225,255] }
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
            data: [{value:9,name:'Assédio'},{value:6,name:'Conteúdo impróprio'},{value:4,name:'Perfil falso'},{value:3,name:'Spam'},{value:1,name:'Outros'}]
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

    /* ---------- NOVO: calendário ---------- */
    const TODAY = new Date(2026, 4, 23);
    const same = (a, b) => a.toDateString() === b.toDateString();
    const fdl = d => d.toLocaleDateString('pt-BR', { day: 'numeric', month: 'long', year: 'numeric' });

    let calSel = new Date(TODAY);
    let calV = new Date(2026, 4, 1);

    function renderCal() {
        const y = calV.getFullYear(), m = calV.getMonth(), f = new Date(y, m, 1).getDay();

        const cells = Array.from({ length: 42 }, (_, i) => {
            const d = new Date(y, m, 1 - f + i);
            return `<button type="button" class="cal-d${d.getMonth() !== m ? ' o' : ''}${same(d, TODAY) ? ' t' : ''}${same(d, calSel) ? ' on' : ''}" data-cd="${d.getTime()}" aria-label="${fdl(d)}">${d.getDate()}</button>`;
        }).join('');

        $('#cmb4').innerHTML = `
            <div class="cal-h">
                <h3>${calV.toLocaleDateString('pt-BR', { month: 'long', year: 'numeric' })}</h3>
                <div class="nv">
                    <button type="button" class="nvb" data-cn="-1" aria-label="Mês anterior"><i data-lucide="chevron-left"></i></button>
                    <button type="button" class="nvb" data-cn="1" aria-label="Próximo mês"><i data-lucide="chevron-right"></i></button>
                </div>
            </div>
            <div class="cal-g">${['D','S','T','Q','Q','S','S'].map(w => `<div class="cal-w">${w}</div>`).join('')}${cells}</div>
            <div class="acts" style="margin-top:20px;align-items:center">
                <span class="sm">Selecionado: <b style="color:var(--ink)">${fdl(calSel)}</b></span>
                <div>
                    <button type="button" class="btn g s" data-ct="1">Hoje</button>
                    <button type="button" class="btn p s" data-cc="1">Fechar</button>
                </div>
            </div>`;
        lucide.createIcons();
    }

    $('#datebtn').addEventListener('click', () => {
        calV = new Date(calSel.getFullYear(), calSel.getMonth(), 1);
        renderCal();
        $('#cm4').classList.add('show');
    });

    document.addEventListener('click', e => {
        let b;
        if ((b = e.target.closest('[data-cn]'))) {
            calV = new Date(calV.getFullYear(), calV.getMonth() + +b.dataset.cn, 1);
            renderCal();
        } else if ((b = e.target.closest('[data-cd]'))) {
            calSel = new Date(+b.dataset.cd);
            $('#datetxt').textContent = fdl(calSel);
            $('#cm4').classList.remove('show');
            toast('Data selecionada: ' + fdl(calSel));
        } else if (e.target.closest('[data-ct]')) {
            calSel = new Date(TODAY);
            calV = new Date(2026, 4, 1);
            $('#datetxt').textContent = fdl(calSel);
            renderCal();
        } else if (e.target.closest('[data-cc]')) {
            $('#cm4').classList.remove('show');
        }
        if (e.target.id === 'cm4') e.target.classList.remove('show');
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') $('#cm4').classList.remove('show');
    });
</script>
@endpush