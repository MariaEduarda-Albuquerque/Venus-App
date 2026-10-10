@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/relatorios.css') }}">
@endpush

@section('content')

<div class="rel-page">

    <div class="rel-topo">
        <h1>Relatório de denúncias</h1>

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
            <span class="rel-icone"><i data-lucide="flag"></i></span>
            <span class="rel-kpi-texto"><b id="k-total">0</b><span>Total de denúncias</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="trending-up"></i></span>
            <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">—</b><span>Mais frequente</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="target"></i></span>
            <span class="rel-kpi-texto"><b id="k-extra">—</b><span>Variação no período</span></span>
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
    titulo: 'Relatório de denúncias',
    arquivo: 'relatorio-denuncias',
    periodo: true, // os números acompanham o seletor de período
    rotulos: ['Total de denúncias', 'Mais frequente', 'Variação no período'],
    extra: '+6,4%',
    graficos: [
        { t: 'Denúncias por tipo', s: 'Motivos mais citados', rosa: true,
          d: [['Assédio', 142], ['Conteúdo impróprio', 96], ['Perfil falso', 64], ['Spam', 41], ['Outros', 22]] },
        { t: 'Denúncias por status', s: 'Situação atual', rosa: false,
          d: [['Resolvidas', 210], ['Pendentes', 88], ['Em análise', 45], ['Recusadas', 22]] },
        { t: 'Denúncias por origem', s: 'Onde ocorreram', rosa: false,
          d: [['Fórum', 150], ['Chat', 120], ['Perfil', 64], ['Conteúdos', 31]] }
    ]
};
</script>
<script src="{{ asset('js/relatorio.js') }}"></script>
@endpush