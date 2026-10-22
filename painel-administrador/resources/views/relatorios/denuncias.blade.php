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
            
            <button type="button" class="rel-btn" id="btn-planilha">
                <i data-lucide="file-spreadsheet"></i>Baixar planilha
            </button>

        <select class="rel-select" id="rel-p" aria-label="Período"
                onchange="window.location = '?periodo=' + this.value">
            <option value="30"  @selected($periodo == 30)>Últimos 30 dias</option>
            <option value="90"  @selected($periodo == 90)>Últimos 90 dias</option>
            <option value="365" @selected($periodo == 365)>Último ano</option>
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
    periodo: false,
    rotulos: ['Total de denúncias', 'Mais frequente', 'Variação no período'],
    extra: '{{ $variacaoPeriodo > 0 ? "+" : "" }}{{ $variacaoPeriodo }}%',
    graficos: [
        { t: 'Denúncias por tipo', s: 'Onde ocorreram', rosa: true,
          d: [['Publicação no fórum', {{ $denunciasTipoFP }}], ['Resposta no fórum', {{ $denunciasTipoFR }}],
              ['Mensagem no chat', {{ $denunciasTipoMC }}], ['Perfil profissional', {{ $denunciasTipoPP }}]] },
        { t: 'Denúncias por status', s: 'Situação atual', rosa: false,
          d: [['Pendentes', {{ $denunciasStatusPendente }}], ['Em análise', {{ $denunciasStatusEmAnalise }}],
              ['Resolvidas', {{ $denunciasStatusResolvida }}], ['Arquivadas', {{ $denunciasStatusArquivada }}]] },
        { t: 'Denúncias por gravidade', s: 'Nível de risco', rosa: false,
          d: [['Baixa', {{ $denunciasGravidadeBaixa }}], ['Média', {{ $denunciasGravidadeMedia }}], ['Alta', {{ $denunciasGravidadeAlta }}]] }
    ]
};
</script>
<script src="{{ asset('js/relatorio.js') }}"></script>
@endpush