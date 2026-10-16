@extends('layouts.app')

@section('titulo', 'Aprovação de Cadastros - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
@endpush

@section('content')

@php

    $q = fn (array $extra = []) => array_filter(
        array_merge(['aba' => $aba, 'conselho' => $conselho, 'busca' => $busca], $extra),
        fn ($v) => $v !== null && $v !== ''
    );

    $kpis = [
        'p' => ['Aguardando análise', 'user-check',   '',                 'em_analise'],
        'r' => ['Reenvio solicitado', 'rotate-ccw',   'lst-icone--amarelo', 'pendencia'],
        'a' => ['Aprovados',          'badge-check',  'lst-icone--verde',   'aprovado'],
        'x' => ['Reprovados',         'user-x',       '',                 'reprovado'],
    ];

    $abas = ['p' => 'Pendentes', 'r' => 'Reenvio', 'a' => 'Aprovados', 'x' => 'Reprovados'];
    
@endphp

<div class="lst-page">

    <div class="lst-topo">
        <div>
            <h1>Aprovação de cadastros</h1>
            <p class="lst-mute">Valide os documentos de cada profissional antes de liberar o acesso.</p>
        </div>
    </div>

    {{-- Cards de resumo: cada um abre a sua aba --}}
    <div class="lst-kpis">
        @foreach ($kpis as $chave => [$rotulo, $icone, $classeIcone, $st])
            <a href="{{ route('cadastros.aprovar', ['aba' => $chave]) }}"
               class="lst-card lst-kpi {{ $aba === $chave ? 'is-active' : '' }}">
                <span class="lst-icone {{ $classeIcone }}"><i data-lucide="{{ $icone }}"></i></span>
                <span class="lst-kpi-texto">
                    <b>{{ $contagens[$st] ?? 0 }}</b>
                    <span class="lst-kpi-rotulo">{{ $rotulo }}</span>
                </span>
            </a>
        @endforeach
    </div>

    <div class="lst-card lst-espaco">
        <div class="lst-barra">
            <div class="lst-abas">
                @foreach ($abas as $chave => $rotulo)
                    <a href="{{ route('cadastros.aprovar', $q(['aba' => $chave])) }}"
                       class="lst-aba {{ $aba === $chave ? 'is-active' : '' }}">
                        {{ $rotulo }}
                        @if ($chave === 'p' && ($contagens['em_analise'] ?? 0))
                            <span class="lst-aba-badge">{{ $contagens['em_analise'] }}</span>
                        @endif
                    </a>
                @endforeach
            </div>

            <div class="lst-abas lst-abas--fim" aria-label="Filtrar por categoria">
                <a href="{{ route('cadastros.aprovar', $q(['conselho' => ''])) }}"
                   class="lst-aba {{ $conselho === '' ? 'is-active' : '' }}">Todos</a>
                @foreach ($conselhos as $c)
                    <a href="{{ route('cadastros.aprovar', $q(['conselho' => $c])) }}"
                       class="lst-aba {{ $conselho === $c ? 'is-active' : '' }}">{{ $c }}</a>
                @endforeach
            </div>

            <form method="GET" action="{{ route('cadastros.aprovar') }}" class="lst-busca">
                <input type="hidden" name="aba" value="{{ $aba }}">
                @if ($conselho !== '') <input type="hidden" name="conselho" value="{{ $conselho }}"> @endif
                <button type="submit" class="lst-icone-btn" aria-label="Pesquisar"><i data-lucide="search"></i></button>
                <input type="search" name="busca" value="{{ $busca }}" placeholder="Nome ou nº de conselho…">
            </form>
        </div>

        <div class="lst-tabela-wrap">
            <table class="lst-tabela lst-tabela--larga">
                <thead>
                    <tr>
                        <th>Profissional</th>
                        <th>Categoria</th>
                        <th>Especialidade</th>
                        <th>Aguardando</th>
                        <th>Status</th>
                        <th><span class="lst-mute">Ação</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cadastros as $c)
                        @php
                            $info  = $statusInfo[$c->statusVerificacao] ?? ['rotulo' => $c->statusVerificacao, 'classe' => ''];
                            $desde = \Carbon\Carbon::parse($c->dataCadastro);
                            $atraso = $c->statusVerificacao === 'em_analise' && $desde->diffInHours(now()) >= 24;
                        @endphp
                        <tr>
                            <td>
                                <div class="lst-pessoa">
                                    <div class="lst-avatar">{{ mb_strtoupper(mb_substr($c->nomeProfissionalSaude, 0, 1)) }}</div>
                                    <div>
                                        <b>{{ $c->nomeProfissionalSaude }}</b>
                                        <span class="lst-mute">{{ $c->emailProfissionalSaude }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="lst-conselho">{{ $c->categoriaProfissional ?? '—' }}</span></td>
                            <td>{{ $c->especialidadeProfissionalSaude ?? '—' }}</td>
                            <td>
                                @if ($c->statusVerificacao === 'em_analise')
                                    @if ($atraso)
                                        <span class="lst-atraso"><i data-lucide="triangle-alert"></i>{{ $desde->locale('pt_BR')->diffForHumans(null, true) }}</span>
                                    @else
                                        {{ $desde->locale('pt_BR')->diffForHumans(null, true) }}
                                    @endif
                                @else
                                    —
                                @endif
                            </td>
                            <td><span class="lst-status {{ $info['classe'] }}">{{ $info['rotulo'] }}</span></td>
                            <td>
                                @if ($c->statusVerificacao === 'em_analise')
                                    <a href="{{ route('cadastro.aprovar', $c) }}" class="lst-btn lst-btn--primario lst-btn--pequeno">Analisar</a>
                                @else
                                    <a href="{{ route('cadastro.aprovar', $c) }}" class="lst-btn lst-btn--neutro lst-btn--pequeno">Ver</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="lst-vazio">Nenhum cadastro nesta aba.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($cadastros->total())
            <p class="lst-mute lst-dica">Mostrando {{ $cadastros->firstItem() }}–{{ $cadastros->lastItem() }} de {{ $cadastros->total() }}</p>
        @endif
        @if ($cadastros->hasPages())
            <div class="lst-paginacao">{{ $cadastros->links() }}</div>
        @endif
    </div>

    @if (session('sucesso'))
        <div class="lst-toast lst-toast--show"><i data-lucide="check-circle-2"></i><span>{{ session('sucesso') }}</span></div>
    @endif
</div>
@endsection