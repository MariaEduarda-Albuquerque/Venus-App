@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/relatorios.css') }}">
@endpush

@section('content')

<div class="rel-page">

    <div class="rel-topo">
        <h1>Relatório de Profissionais</h1>

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
            <span class="rel-icone"><i data-lucide="users"></i></span>
            <span class="rel-kpi-texto"><b id="k-total">0</b><span>Total de profissionais</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="trending-up"></i></span>
            <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">—</b><span>Maior grupo</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="user-plus"></i></span>
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
    titulo: 'Relatório de profissionais',
    arquivo: 'relatorio-profissionais',
    periodo: false, // números fixos, como no arquivo de referência
    rotulos: ['Total de profissionais', 'Maior grupo', 'Novos cadastros'],
    extra: '7/10',
    graficos: [
        { t: 'Categoria', s: 'Categorias as quais os profissionais pertencem', rosa: false, 
          d: [['Médico', 313], ['Enfermeiro', 232], ['Psicologo', 312], ['Assistente social', 231], ['Outro', 543]] },
        { t: 'Status da Verificação', s: 'Status de verificação das contas de profissionais', rosa: false,
          d: [['Em analise', 323], ['Aprovado', 334], ['Pendente', 442]] },
        { t: 'Atendimentos por período', s: 'Quantidade de atendimentos nos últimos meses', rosa: true,
          d: [['Junho', 20], ['Julho', 28], ['Agosto', 2], ['Setembro', 11], ['Outubro', 13]] }
    ]
};
</script>
<script src="{{ asset('js/relatorio.js') }}"></script>
@endpush