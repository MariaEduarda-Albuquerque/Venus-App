{{-- Cards, gráficos e tabelas do Relatório de Conteúdo (usado na tela e no PDF) --}}
@php $fmt = function ($n) { return number_format($n, 0, ',', '.'); }; @endphp

<div class="rl-cards rl-cards--4">
    <div class="rl-card">
        <span class="rl-card-icone"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5" /><rect x="14" y="3" width="7" height="7" rx="1.5" /><rect x="3" y="14" width="7" height="7" rx="1.5" /><rect x="14" y="14" width="7" height="7" rx="1.5" /></svg></span>
        <div>
            <p class="rl-card-rotulo">Publicações</p>
            <strong class="rl-card-valor">{{ $fmt($cards['publicacoes']) }}</strong>
            <p class="rl-card-nota">{{ $cards['publicados'] }} {{ $cards['publicados'] == 1 ? 'publicado' : 'publicados' }} no período</p>
        </div>
    </div>

    <div class="rl-card">
        <span class="rl-card-icone"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M8 12.5l2.5 2.5L16 9.5" /></svg></span>
        <div>
            <p class="rl-card-rotulo">Taxa de aprovação</p>
            <strong class="rl-card-valor">{{ $cards['taxaAprovacao'] !== null ? $cards['taxaAprovacao'] . '%' : '—' }}</strong>
            <p class="rl-card-nota">{{ $cards['taxaAprovacao'] !== null ? 'Aprovados entre os já revisados' : 'Nenhuma revisão no período' }}</p>
        </div>
    </div>

    <div class="rl-card">
        <span class="rl-card-icone"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z" /><circle cx="12" cy="12" r="3" /></svg></span>
        <div>
            <p class="rl-card-rotulo">Alcance</p>
            <strong class="rl-card-valor">{{ $fmt($cards['visualizacoes']) }}</strong>
            <p class="rl-card-nota">Visualizações dos itens publicados</p>
        </div>
    </div>

    <div class="rl-card">
        <span class="rl-card-icone"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10Z" /></svg></span>
        <div>
            <p class="rl-card-rotulo">Curtidas</p>
            <strong class="rl-card-valor">{{ $fmt($cards['curtidas']) }}</strong>
            <p class="rl-card-nota">Nos itens publicados</p>
        </div>
    </div>
</div>

<section class="card rl-bloco">
    <div class="rl-bloco-topo">
        <div>
            <h3>Publicações por mês</h3>
            <p>Itens criados ou publicados a cada mês, até {{ $fim->format('d/m/Y') }}.</p>
        </div>
    </div>

    @php $maximo = max(1, max(array_column($grafico, 'total'))); @endphp
    <div class="rl-barras" role="img" aria-label="Gráfico de publicações por mês">
        @foreach ($grafico as $g)
            <div class="rl-barra-col">
                <span class="rl-barra-valor">{{ $g['total'] }}</span>
                <div class="rl-barra-trilho">
                    <div class="rl-barra {{ $g['total'] == 0 ? 'rl-barra--zero' : '' }}" style="height: {{ round($g['total'] / $maximo * 100) }}%"></div>
                </div>
                <span class="rl-barra-rotulo">{{ $g['rotulo'] }}</span>
            </div>
        @endforeach
    </div>
</section>

<div class="rl-duplo">
    <section class="card rl-bloco">
        <div class="rl-bloco-topo">
            <div>
                <h3>Por status</h3>
                <p>Situação dos itens do período.</p>
            </div>
        </div>

        @php $totalStatus = max(1, $cards['publicacoes']); @endphp
        <ul class="rl-status-lista">
            @foreach ($porStatus as $s)
                <li>
                    <div class="rl-status-linha">
                        <span class="ct-status ct-status--{{ $s['chave'] }}">{{ $s['rotulo'] }}</span>
                        <strong>{{ $s['total'] }}</strong>
                    </div>
                    <div class="rl-status-trilho"><div class="rl-status-barra rl-status-barra--{{ $s['chave'] }}" style="width: {{ round($s['total'] / $totalStatus * 100) }}%"></div></div>
                </li>
            @endforeach
        </ul>
    </section>

    <section class="card rl-bloco">
        <div class="rl-bloco-topo">
            <div>
                <h3>Por categoria</h3>
                <p>Publicações e alcance de cada categoria.</p>
            </div>
        </div>

        @if (count($porCategoria) == 0)
            <p class="rl-vazio-nota">Sem itens no período.</p>
        @else
            <table class="pc-tabela rl-tabela rl-tabela--compacta">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th class="rl-num">Itens</th>
                        <th class="rl-num">Visualizações</th>
                        <th class="rl-num">Curtidas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($porCategoria as $c)
                        <tr>
                            <td>{{ $c['categoria'] }}</td>
                            <td class="rl-num">{{ $c['total'] }}</td>
                            <td class="rl-num">{{ $fmt($c['visualizacoes']) }}</td>
                            <td class="rl-num">{{ $fmt($c['curtidas']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
</div>

<section class="card rl-bloco">
    <div class="rl-bloco-topo">
        <div>
            <h3>Publicações do período</h3>
            <p>{{ count($linhas) }} {{ count($linhas) == 1 ? 'item' : 'itens' }} no período selecionado.</p>
        </div>
    </div>

    @if (count($linhasTabela) == 0)
        <div class="pc-vazio" style="padding: 26px 10px 30px;">
            <strong>Nenhuma publicação no período</strong>
            <p>Escolha outro período ou categoria para ver os conteúdos.</p>
        </div>
    @else
        <div class="pc-scroll">
            <table class="pc-tabela rl-tabela">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th class="rl-num">Visualizações</th>
                        <th class="rl-num">Curtidas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($linhasTabela as $l)
                        <tr>
                            <td>{{ $l['data'] }}</td>
                            <td>{{ $l['titulo'] }}<br><small class="rl-sub">{{ $l['tipo'] }}</small></td>
                            <td>{{ $l['categoria'] }}</td>
                            <td><span class="ct-status ct-status--{{ $l['statusChave'] }}">{{ $l['status'] }}</span></td>
                            <td class="rl-num">{{ $l['visualizacoes'] === null ? '—' : $fmt($l['visualizacoes']) }}</td>
                            <td class="rl-num">{{ $l['curtidas'] === null ? '—' : $fmt($l['curtidas']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($paginacao && $paginacao['paginas'] > 1)
            <div class="rl-paginacao">
                @if ($paginacao['pagina'] > 1)
                    <a href="{{ route('relatorios.index', $filtro + ['pagina' => $paginacao['pagina'] - 1]) }}">&lsaquo; Anterior</a>
                @endif
                <span>Página {{ $paginacao['pagina'] }} de {{ $paginacao['paginas'] }}</span>
                @if ($paginacao['pagina'] < $paginacao['paginas'])
                    <a href="{{ route('relatorios.index', $filtro + ['pagina' => $paginacao['pagina'] + 1]) }}">Próxima &rsaquo;</a>
                @endif
            </div>
        @endif
    @endif
</section>
