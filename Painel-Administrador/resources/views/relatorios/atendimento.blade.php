@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/relatorios.css') }}">
@endpush

@section('content')

<div class="rel-page">

    <div class="rel-topo">
        <h1>Relatório de atendimento</h1>

        <div class="rel-acoes">
            <button type="button" class="rel-btn" id="btn-pdf">
                <i data-lucide="download"></i>Baixar PDF
            </button>

            <select class="rel-select" id="rel-p" aria-label="Período">
                <option value="1">Últimos 30 dias</option>
                <option value="2.8">Últimos 90 dias</option>
                <option value="11">Último ano</option>
            </select>
        </div>
    </div>

    <div class="rel-kpis">
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="headset"></i></span>
            <span class="rel-kpi-texto"><b id="k-total">0</b><span>Chamados atendidos</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="trending-up"></i></span>
            <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">—</b><span>Canal mais usado</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="smile"></i></span>
            <span class="rel-kpi-texto"><b id="k-extra">—</b><span>Satisfação média</span></span>
        </div>
    </div>

    <div class="rel-graficos" id="rel-c"></div>

    <div class="rel-toast" id="toast"><i data-lucide="check-circle-2"></i><span></span></div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.min.js"></script>
<script>
window.RELATORIO = {
    titulo: 'Relatório de atendimento',
    arquivo: 'relatorio-atendimento',
    periodo: true, // os números acompanham o seletor de período
    rotulos: ['Chamados atendidos', 'Canal mais usado', 'Satisfação média'],
    extra: '4,6 / 5',
    graficos: [
        { t: 'Canais de atendimento', s: 'Por onde as usuárias nos procuram', rosa: false,
          d: [['Chat', 420], ['E-mail', 260], ['Formulário', 180], ['Telefone', 90]] },
        { t: 'Motivos dos chamados', s: 'Assuntos mais comuns', rosa: true,
          d: [['Dúvidas de uso', 310], ['Acesso e senha', 240], ['Erros técnicos', 170], ['Conta e dados', 130], ['Sugestões', 100]] },
        { t: 'Satisfação com o atendimento', s: 'Avaliações recebidas', rosa: false,
          d: [['Muito satisfeita', 520], ['Satisfeita', 300], ['Neutra', 90], ['Insatisfeita', 40]] }
    ]
};
</script>
<script src="{{ asset('js/relatorio.js') }}"></script>
@endpush