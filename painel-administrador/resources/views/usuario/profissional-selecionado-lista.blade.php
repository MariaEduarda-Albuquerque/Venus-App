@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/profissional.css') }}">
@endpush

@section('content')

<div class="pf-page">

    <a href="/profissionais" class="pf-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 6l-6 6 6 6"/></svg>
        Voltar para a lista
    </a>

    <div class="pf-grid">

        <div class="pf-main">

            <section class="pf-card">
                <div class="pf-cover"></div>

                <div class="pf-hero">
                    <div class="pf-hero-row">
                        <span class="pf-avatar">A</span>
                    </div>

                    <div class="pf-identity">
                        <h2>Ana da Silva Pinto</h2>
                        <div class="pf-identity-meta">
                            <span class="pf-chip">Ginecologista</span>
                            <span class="pf-chip pf-chip--ok">Ativa</span>
                        </div>
                        <p>Cadastrado em 16/10/2026.</p>
                    </div>
                </div>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Contato e documento</h3>
                <dl class="pf-fields">
                    <div class="pf-field pf-field--full">
                        <dt>Email</dt>
                        <dd>ana@gmail.com</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Telefone</dt>
                        <dd>11 96083-6370</dd>
                    </div>
                    <div class="pf-field">
                        <dt>CPF ou CNPJ</dt>
                        <dd>207.770.560-46</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Nº de conselho</dt>
                        <dd>CRESS 34.221 (9ª)</dd>
                    </div>
                </dl>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Localização</h3>
                <dl class="pf-fields">
                    <div class="pf-field">
                        <dt>CEP</dt>
                        <dd>88704-261</dd>
                    </div>
                    <div class="pf-field">
                        <dt>UF</dt>
                        <dd>SC</dd>
                    </div>
                    <div class="pf-field">
                        <dt>País</dt>
                        <dd>Brasil</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Cidade</dt>
                        <dd>Tubarão</dd>
                    </div>
                </dl>
            </section>

            {{-- RELATÓRIO: dentro da coluna da esquerda, ocupando o espaço em branco --}}
            <div class="rel-page">

                <div class="rel-topo">
                    <h1>Relatório do Profissional</h1>

                    <div class="rel-acoes">
                        <button type="button" class="rel-btn" id="btn-pdf">
                            <i data-lucide="download"></i>Baixar PDF
                        </button>

                        <select class="rel-select" id="rel-p" aria-label="Período">
                            <option value="1">Últimos 7 dias</option>
                            <option value="2.8">Últimos 30 dias</option>
                            <option value="11">Últimos 90 dias</option>
                        </select>
                    </div>
                </div>

                <div class="rel-kpis">
                    <div class="rel-card rel-kpi">
                        <span class="rel-icone"><i data-lucide="users"></i></span>
                        <span class="rel-kpi-texto"><b>86</b><span>Total de Usuarias atendidas</span></span>
                    </div>
                    <div class="rel-card rel-kpi">
                        <span class="rel-icone"><i data-lucide="trending-up"></i></span>
                        <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">3h 23min</b><span>Tempo médio de resposta</span></span>
                    </div>
                    <div class="rel-card rel-kpi">
                        <span class="rel-icone"><i data-lucide="user-plus"></i></span>
                        <span class="rel-kpi-texto"><b id="k-extra">5/10</b><span>Avaliação média</span></span>
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
            <p>Resumo sobre os atendimentos</p>
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
                    <tr>
                        <td>16/10</td>
                        <td>Agendada</td>
                        <td>3/10</td>
                    </tr>
                    <tr>
                        <td>15/10</td>
                        <td>Dúvida rápida</td>
                        <td>2/10</td>
                    </tr>
                    <tr>
                        <td>14/10</td>
                        <td>Dúvida rápida</td>
                        <td>5/10</td>
                    </tr>
                    <tr>
                        <td>13/10</td>
                        <td>Agendada</td>
                        <td>5/10</td>
                    </tr>
                    <tr>
                        <td>12/10</td>
                        <td>Dúvida rápida</td>
                        <td>6/10</td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

</div>

                <div class="rel-toast" id="toast"><i data-lucide="check-circle-2"></i><span></span></div>
            </div>

        </div>

        <aside class="pf-side">

            {{-- TODO (back-end): trocar as imagens pelas que o profissional enviou no cadastro --}}
            <section class="pf-card pf-section pf-docs">
                <h3 class="pf-section-title">Documentos com foto</h3>

                <figure class="pf-doc">
                    <figcaption>Carteira de conselho</figcaption>
                    <img src="{{ asset('images/carteira-conselho.png') }}" alt="Carteira de conselho">
                </figure>

                <figure class="pf-doc">
                    <figcaption>Documento com foto</figcaption>
                    <img src="{{ asset('images/documento-foto.png') }}" alt="Documento com foto">
                </figure>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Atuação profissional</h3>
                <dl class="pf-fields">
                    <div class="pf-field">
                        <dt>Categoria profissional</dt>
                        <dd>Médico</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Especialidade</dt>
                        <dd>Ginecologista</dd>
                    </div>
                    <div class="pf-field pf-field--full">
                        <dt>Apresentação profissional</dt>
                        <dd>sla n sei sla krai</dd>
                    </div>
                </dl>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Dados do cadastro</h3>
                <dl class="pf-fields">
                    <div class="pf-field">
                        <dt>ID</dt>
                        <dd>#3</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Status</dt>
                        <dd>Ativa</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Cadastro</dt>
                        <dd>16/10/2026</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Aprovação</dt>
                        <dd>16/10/2026</dd>
                    </div>
                </dl>
            </section>

                <div class="pf-acoes-conta">

                    <button type="button" class="btn-suspender">
                        <i data-lucide="user-round-x"></i>
                        <span>Suspender conta</span>
                    </button>

                    <button type="button" class="btn-excluir">
                        <i data-lucide="trash-2"></i>
                        <span>Excluir conta</span>
                    </button>

                </div>
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

    arquivo: 'relatorio-profissional',

    periodo: false,

    total: '1.631',
    grupo: '18–25 anos',
    extra: '+8,2%',

    atendimentos: {
        labels: [
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro'
        ],

        valores: [
            12,
            16,
            21,
            14,
            18
        ]
    },

};
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const elemento = document.getElementById('graficoAtendimentos');

    if (!elemento) return;

    const grafico = echarts.init(elemento);

    const dados = window.RELATORIO.atendimentos;

    grafico.setOption({

        tooltip: {
            trigger: 'axis'
        },

        grid: {
            top: 15,
            right: 15,
            bottom: 25,
            left: 35,
            containLabel: true
        },

        xAxis: {
            type: 'category',

            boundaryGap: false,

            data: dados.labels,

            axisLine: {
                lineStyle: {
                    color: '#EFE7E8'
                }
            },

            axisTick: {
                show: false
            },

            axisLabel: {
                color: '#7E7075',
                fontSize: 10
            }
        },

        yAxis: {
            type: 'value',

            min: 0,

            splitLine: {
                lineStyle: {
                    color: '#F1E9EA'
                }
            },

            axisLine: {
                show: false
            },

            axisTick: {
                show: false
            },

            axisLabel: {
                color: '#7E7075',
                fontSize: 10
            }
        },

        series: [{
            name: 'Atendimentos',

            type: 'line',

            data: dados.valores,

            smooth: true,

            symbol: 'circle',
            symbolSize: 6,

            lineStyle: {
                color: '#9B1B2A',
                width: 2.5
            },

            itemStyle: {
                color: '#9B1B2A'
            },

            areaStyle: {
                color: 'rgba(155, 27, 42, 0.08)'
            }
        }]

    });

    window.addEventListener('resize', function () {
        grafico.resize();
    });

});
</script>
<script src="{{ asset('js/relatorio.js') }}"></script>


@endpush