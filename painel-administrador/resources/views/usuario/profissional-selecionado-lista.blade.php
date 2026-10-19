@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/profissional.css') }}?v={{ @filemtime(public_path('css/profissional.css')) }}">
@endpush

@section('content')

@php
    $statusRotulos = ['ativa' => 'Ativa', 'suspensa' => 'Suspensa', 'excluida' => 'Excluída'];
    $statusChip    = ['ativa' => 'pf-chip--ok'];
    $verifRotulos  = [
        'em_analise' => 'Em análise',
        'aprovado'   => 'Aprovado',
        'pendencia'  => 'Pendência',
        'reprovado'  => 'Reprovado',
    ];
    $categorias = [
        'medico'            => 'Médico(a)',
        'enfermeiro'        => 'Enfermeiro(a)',
        'psicologo'         => 'Psicólogo(a)',
        'assistente_social' => 'Assistente social',
        'outro'             => 'Outro',
    ];
    $tipos = ['agendada' => 'Agendada', 'duvida_rapida' => 'Dúvida rápida'];

    $fmt   = fn ($d) => optional($d)->format('d/m/Y') ?? '—';
    $ehPdf = fn ($caminho) => $caminho && strtolower(pathinfo($caminho, PATHINFO_EXTENSION)) === 'pdf';

    $inicial = mb_strtoupper(mb_substr($p->nomeProfissionalSaude, 0, 1));

    $docs = [
        ['Carteira de conselho', $p->comprovanteConselhoClasseProfissional, 'conselho'],
        ['Documento com foto',   $p->documentoComplementarProfissional,   'documento'],
    ];
@endphp

<div class="pf-page">

    <a href="{{ route('profissional.index') }}" class="pf-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 6l-6 6 6 6"/></svg>
        Voltar para a lista
    </a>

    @if (session('sucesso') || $errors->any())
        <div role="status" style="margin:12px 0;padding:10px 14px;border-radius:8px;font-size:14px;
             background:{{ $errors->any() ? '#fdecee' : '#e9f7ef' }};
             color:{{ $errors->any() ? '#9B1B2A' : '#1e6b3a' }};">
            {{ session('sucesso') ?? $errors->first() }}
        </div>
    @endif

    <div class="pf-grid">

        {{-- ================= COLUNA PRINCIPAL ================= --}}
        <div class="pf-main">

            <section class="pf-card">
                <div class="pf-cover"></div>

                <div class="pf-hero">
                    <div class="pf-hero-row">
                        @if ($p->fotoPerfilProfissional)
                            <img class="pf-avatar"
                                 src="{{ route('profissional.arquivo', [$p, 'foto']) }}"
                                 alt="{{ $p->nomeProfissionalSaude }}"
                                 onerror="this.replaceWith(Object.assign(document.createElement('span'),{className:'pf-avatar',textContent:'{{ $inicial }}'}))">
                        @else
                            <span class="pf-avatar">{{ $inicial }}</span>
                        @endif
                    </div>

                    <div class="pf-identity">
                        <h2>{{ $p->nomeProfissionalSaude }}</h2>
                        <div class="pf-identity-meta">
                            @if ($p->especialidadeProfissionalSaude)
                                <span class="pf-chip">{{ $p->especialidadeProfissionalSaude }}</span>
                            @endif
                            <span class="pf-chip {{ $statusChip[$p->statusConta] ?? '' }}">
                                {{ $statusRotulos[$p->statusConta] ?? $p->statusConta }}
                            </span>
                        </div>
                        <p>Cadastrado em {{ $fmt($p->dataCadastro) }}.</p>
                    </div>
                </div>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Contato e documento</h3>
                <dl class="pf-fields">
                    <div class="pf-field pf-field--full">
                        <dt>Email</dt>
                        <dd>{{ $p->emailProfissionalSaude }}</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Telefone</dt>
                        <dd>{{ $p->telProfissionalSaude ?: '—' }}</dd>
                    </div>
                    <div class="pf-field">
                        <dt>CPF ou CNPJ</dt>
                        <dd>{{ $p->nrFiscalProfissional ?: '—' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Localização</h3>
                <dl class="pf-fields">
                    <div class="pf-field">
                        <dt>CEP</dt>
                        <dd>{{ $p->cepProfissional ?: '—' }}</dd>
                    </div>
                    <div class="pf-field">
                        <dt>UF</dt>
                        <dd>{{ $p->ufProfissional ?: '—' }}</dd>
                    </div>
                    <div class="pf-field">
                        <dt>País</dt>
                        <dd>{{ $p->paisProfissional ?: '—' }}</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Cidade</dt>
                        <dd>{{ $p->cidadeProfissional ?: '—' }}</dd>
                    </div>
                </dl>
            </section>

            {{-- RELATÓRIO --}}
            <div class="rel-page">

                <div class="rel-topo">
                    <h1>Relatório do Profissional</h1>

                    <div class="rel-acoes">
                        <button type="button" class="rel-btn" id="btn-pdf">
                            <i data-lucide="download"></i>Baixar PDF
                        </button>

                        {{-- Filtra recarregando a página com ?periodo= --}}
                        <select class="rel-select" id="rel-p" aria-label="Período"
                                onchange="window.location.search = '?periodo=' + this.value">
                            <option value="7"  @selected($periodo === 7)>Últimos 7 dias</option>
                            <option value="30" @selected($periodo === 30)>Últimos 30 dias</option>
                            <option value="90" @selected($periodo === 90)>Últimos 90 dias</option>
                        </select>
                    </div>
                </div>

                <div class="rel-kpis">
                    <div class="rel-card rel-kpi">
                        <span class="rel-icone"><i data-lucide="users"></i></span>
                        <span class="rel-kpi-texto"><b>{{ $totalUsuarias }}</b><span>Total de usuárias atendidas</span></span>
                    </div>
                    <div class="rel-card rel-kpi">
                        <span class="rel-icone"><i data-lucide="trending-up"></i></span>
                        <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">{{ $tempoMedio }}</b><span>Tempo médio de resposta</span></span>
                    </div>
                    <div class="rel-card rel-kpi">
                        <span class="rel-icone"><i data-lucide="user-plus"></i></span>
                        <span class="rel-kpi-texto"><b id="k-extra">{{ $avaliacaoMedia }}{{ $avaliacaoMedia !== '—' ? '/10' : '' }}</b><span>Avaliação média</span></span>
                    </div>
                </div>

                <div class="rel-conteudo">

                    <div class="rel-grafico-card">
                        <div class="rel-grafico-header">
                            <h3>Evolução</h3>
                            <p>Evolução mensal dos atendimentos</p>
                        </div>

                        <div id="graficoAtendimentos" class="rel-chart"></div>
                    </div>

                    <div class="rel-tabela-card">
                        <div class="rel-grafico-header">
                            <h3>Resumo</h3>
                            <p>Últimos atendimentos no período</p>
                        </div>

                        <div class="rel-tabela-wrap">
                            <table class="rel-tabela">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Tipo de atendimento</th>
                                        <th>Avaliação</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($recentes as $a)
                                        <tr>
                                            <td>{{ $a->dataCadastro->format('d/m') }}</td>
                                            <td>{{ $tipos[$a->tipoAtendimento] ?? $a->tipoAtendimento }}</td>
                                            <td>{{ $a->avaliacao !== null ? $a->avaliacao . '/10' : '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Nenhum atendimento no período.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="rel-toast" id="toast"><i data-lucide="check-circle-2"></i><span></span></div>
            </div>

        </div>

        {{-- ================= COLUNA LATERAL ================= --}}
        <aside class="pf-side">

            <section class="pf-card pf-section pf-docs">
                <h3 class="pf-section-title">Documentos com foto</h3>

                @foreach ($docs as [$titulo, $caminho, $tipo])
                    @php $url = $caminho ? route('profissional.arquivo', [$p, $tipo]) : null; @endphp

                    <figure class="pf-doc">
                        <figcaption>{{ $titulo }}</figcaption>

                        @if (! $caminho)
                            <p class="pf-mute">Não enviado.</p>
                        @elseif ($ehPdf($caminho))
                            <a href="{{ $url }}" target="_blank" rel="noopener">Abrir PDF</a>
                        @else
                            <a href="{{ $url }}" target="_blank" rel="noopener">
                                <img src="{{ $url }}" alt="{{ $titulo }}"
                                     onerror="this.replaceWith(document.createTextNode('Arquivo indisponível'))">
                            </a>
                        @endif
                    </figure>
                @endforeach
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Atuação profissional</h3>
                <dl class="pf-fields">
                    <div class="pf-field">
                        <dt>Categoria profissional</dt>
                        <dd>{{ $categorias[$p->categoriaProfissional] ?? $p->categoriaProfissional }}</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Especialidade</dt>
                        <dd>{{ $p->especialidadeProfissionalSaude ?: '—' }}</dd>
                    </div>
                    <div class="pf-field pf-field--full">
                        <dt>Apresentação profissional</dt>
                        <dd>{{ $p->apresentacaoProfissional ?: '—' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Dados do cadastro</h3>
                <dl class="pf-fields">
                    <div class="pf-field">
                        <dt>ID</dt>
                        <dd>#{{ $p->getKey() }}</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Status</dt>
                        <dd>{{ $statusRotulos[$p->statusConta] ?? $p->statusConta }}</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Cadastro</dt>
                        <dd>{{ $fmt($p->dataCadastro) }}</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Verificação</dt>
                        <dd>{{ $verifRotulos[$p->statusVerificacao] ?? '—' }}</dd>
                    </div>
                </dl>
            </section>

            @if ($p->statusConta !== 'excluida')
                <div class="pf-acoes-conta">

                    <form method="POST" action="{{ route('profissional.status', $p) }}">
                        @csrf
                        @method('PATCH')

                        @if ($p->statusConta === 'ativa')
                            <button type="submit" name="statusConta" value="suspensa" class="btn-suspender">
                                <i data-lucide="user-round-x"></i>
                                <span>Suspender conta</span>
                            </button>
                        @else
                            <button type="submit" name="statusConta" value="ativa" class="btn-suspender">
                                <i data-lucide="user-round-check"></i>
                                <span>Reativar conta</span>
                            </button>
                        @endif
                    </form>

                    <a class="btn-excluir"
                       href="{{ route('profissional.index', ['detalhe' => $p->getKey(), 'excluir' => 1]) }}">
                        <i data-lucide="trash-2"></i>
                        <span>Excluir conta</span>
                    </a>

                </div>
            @endif
        </aside>

    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.min.js"></script>
<script>
window.RELATORIO = {
    titulo: 'Relatório do profissional',
    arquivo: 'relatorio-profissional-{{ $p->getKey() }}',
    periodo: false,

    total: @json($totalUsuarias),
    grupo: @json($tempoMedio),
    extra: @json($avaliacaoMedia !== '—' ? $avaliacaoMedia . '/10' : '—'),

    atendimentos: {
        labels:  @json($labels),
        valores: @json($valores)
    }
};
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const elemento = document.getElementById('graficoAtendimentos');
    if (!elemento) return;

    const grafico = echarts.init(elemento);
    const dados = window.RELATORIO.atendimentos;

    grafico.setOption({
        tooltip: { trigger: 'axis' },

        grid: { top: 15, right: 15, bottom: 25, left: 35, containLabel: true },

        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: dados.labels,
            axisLine: { lineStyle: { color: '#EFE7E8' } },
            axisTick: { show: false },
            axisLabel: { color: '#7E7075', fontSize: 10 }
        },

        yAxis: {
            type: 'value',
            min: 0,
            minInterval: 1,
            splitLine: { lineStyle: { color: '#F1E9EA' } },
            axisLine: { show: false },
            axisTick: { show: false },
            axisLabel: { color: '#7E7075', fontSize: 10 }
        },

        series: [{
            name: 'Atendimentos',
            type: 'line',
            data: dados.valores,
            smooth: true,
            symbol: 'circle',
            symbolSize: 6,
            lineStyle: { color: '#9B1B2A', width: 2.5 },
            itemStyle: { color: '#9B1B2A' },
            areaStyle: { color: 'rgba(155, 27, 42, 0.08)' }
        }]
    });

    window.addEventListener('resize', function () {
        grafico.resize();
    });
});
</script>
@endpush