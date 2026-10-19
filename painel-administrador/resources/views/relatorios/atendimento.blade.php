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
    periodo: false,   // o servidor já filtra, o JS não multiplica de novo
    rotulos: ['Chamados atendidos', 'Canal mais usado', 'Satisfação média'],
    extra: '{{ $avaliacaoMedia }} / 5',
    graficos: [
        { t: 'Canais de atendimento', s: 'Por onde as usuárias nos procuram', rosa: false,
          d: [['Chat', {{ $canalAtendimentoChat }}], ['E-mail', {{ $canalAtendimentoEmail }}],
              ['Formulário', {{ $canalAtendimentoForm }}], ['Telefone', {{ $canalAtendimentoTel }}]] },
        { t: 'Motivos dos chamados', s: 'Assuntos mais comuns', rosa: true,
          d: [['Dúvidas de uso', {{ $motivoChamadoDuvida }}], ['Acesso e senha', {{ $motivoChamadoAcessoAsenha }}],
              ['Erros técnicos', {{ $motivoChamadoErroTecnico }}], ['Conta e dados', {{ $motivoChamadoDadosConta }}],
              ['Sugestões', {{ $motivoChamadoSugestoes }}]] },
        { t: 'Satisfação com o atendimento', s: 'Avaliações recebidas', rosa: false,
          d: [['Muito satisfeita', {{ $avaliacaoMuitoSatisfeita }}], ['Satisfeita', {{ $avaliacaoSatisfeita }}],
              ['Neutra', {{ $avaliacaoNeutra }}], ['Insatisfeita', {{ $avaliacaoInsatisfeita }}]] }
    ]
};
</script>
<script src="{{ asset('js/relatorio.js') }}"></script>
@endpush