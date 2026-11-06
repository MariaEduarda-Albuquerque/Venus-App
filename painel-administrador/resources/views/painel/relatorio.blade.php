@extends('layouts.app')

@section('titulo', 'Relatório - Painel Administrativo - Vênus')

@push('css')
<link rel="stylesheet" href="{{ asset('css/relatorios.css') }}">
@endpush

@section('content')

<div class="rel-page">

    <div class="rel-topo">
        <h1>Relatório da plataforma</h1>

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
            <span class="rel-icone"><i data-lucide="user-plus"></i></span>
            <span class="rel-kpi-texto"><b id="k-total">0</b><span>Novos cadastros</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="trending-up"></i></span>
            <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">—</b><span>Maior grupo de cadastros</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="file-text"></i></span>
            <span class="rel-kpi-texto"><b id="k-extra">—</b><span>Conteúdos publicados</span></span>
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
    titulo: 'Relatório da plataforma',
    arquivo: 'relatorio-plataforma',
    periodo: false,   // o servidor já filtra, o JS não multiplica de novo
    rotulos: ['Novos cadastros', 'Maior grupo de cadastros', 'Conteúdos publicados'],
    extra: '{{ $conteudosPublicados }}',
    graficos: [
        { t: 'Novos cadastros', s: 'Usuárias e profissionais no período', rosa: false,
          d: [['Usuárias', {{ $novasUsuarias }}], ['Profissionais', {{ $novosProfissionais }}]] },
        { t: 'Evolução dos cadastros', s: '{{ $periodo == 365 ? 'Cadastros por mês' : 'Cadastros por semana (data de início da semana)' }}',
          tipo: 'linha', colunas: ['Período', 'Usuárias', 'Profissionais'],
          d: @json($evolucaoCadastros) },
        { t: 'Conteúdos por status', s: 'Conteúdos criados no período', rosa: false,
          d: @json($conteudosPorStatus) },
        { t: 'Profissionais por especialidade', s: 'Contas ativas hoje (não muda com o período)', rosa: true,
          colunas: ['Especialidade', 'Profissionais'],
          d: @json($especialidades) },
        { t: 'Usuárias por região', s: 'Contas ativas hoje (não muda com o período)', rosa: true,
          colunas: ['Região', 'Usuárias'],
          d: @json($usuariasPorRegiao) }
    ]
};
</script>
<script src="{{ asset('js/relatorio.js') }}"></script>
@endpush
