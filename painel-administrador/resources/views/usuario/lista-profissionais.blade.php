@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
@endpush

@section('content')

@php
    $statusRotulos = ['ativa' => 'Ativa', 'suspensa' => 'Suspensa', 'excluida' => 'Excluída'];
    $statusClasses = ['ativa' => 'lst-status--ok', 'suspensa' => 'lst-status--pendente', 'excluida' => 'lst-status--recusado'];
    $verifRotulos  = ['em_analise' => 'Em análise', 'aprovado' => 'Aprovado', 'pendencia' => 'Pendência'];
    $filtroAtual   = request('status');
    $qs            = request()->only('busca', 'status', 'page'); // estado da lista, sem detalhe/excluir
@endphp

<div class="lst-page">

    <div class="lst-topo">
        <h1>Lista de profissionais</h1>
    </div>

    <div class="lst-card">
        <div class="lst-barra">
            {{-- Busca: GET puro --}}
            <form method="GET" action="{{ route('profissional.index') }}" class="lst-busca">
                @if ($filtroAtual)
                    <input type="hidden" name="status" value="{{ $filtroAtual }}">
                @endif
                <button type="submit" class="lst-icone-btn" aria-label="Pesquisar"><i data-lucide="search"></i></button>
                <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Pesquisar nome ou e-mail…">
            </form>

            {{-- Filtro: <details> abre/fecha sem JS; cada opção é um link --}}
            <details class="lst-filtro lst-filtro--fim">
                <summary class="lst-btn lst-btn--primario">
                    <i data-lucide="sliders-horizontal"></i>
                    <span>{{ $statusRotulos[$filtroAtual] ?? 'Filtro' }}</span>
                </summary>
                <div class="lst-menu is-open">
                    <a href="{{ route('profissional.index', request()->only('busca')) }}">
                        <span>Todos</span>@unless($filtroAtual)<i data-lucide="check"></i>@endunless
                    </a>
                    @foreach ($statusRotulos as $valor => $rotulo)
                        <a href="{{ route('profissional.index', array_merge(request()->only('busca'), ['status' => $valor])) }}">
                            <span>{{ $rotulo }}</span>@if($filtroAtual === $valor)<i data-lucide="check"></i>@endif
                        </a>
                    @endforeach
                </div>
            </details>
        </div>

        <div class="lst-tabela-wrap">
            <table class="lst-tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Especialidade</th>
                        <th>Cadastro</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($profissionais as $p)
                        @php $urlDetalhe = route('profissional.index', $qs + ['detalhe' => $p->getKey()]); @endphp
                        <tr data-id="{{ $p->getKey() }}">
                            <td class="lst-mono"><a href="{{ $urlDetalhe }}">{{ $p->getKey() }}</a></td>
                            <td><a href="{{ $urlDetalhe }}">{{ $p->nomeProfissionalSaude }}</a></td>
                            <td><a href="{{ $urlDetalhe }}">{{ $p->categoriaProfissional }}</a></td>
                            <td><a href="{{ $urlDetalhe }}">{{ $p->especialidadeProfissionalSaude }}</a></td>
                            <td><a href="{{ $urlDetalhe }}">{{ optional($p->dataCadastro)->format('d/m/Y') }}</a></td>
                            <td>
                                <a href="{{ $urlDetalhe }}">
                                    <span class="lst-status {{ $statusClasses[$p->statusConta] ?? '' }}">
                                        {{ $statusRotulos[$p->statusConta] ?? $p->statusConta }}
                                    </span>
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="lst-vazio">Nenhum profissional encontrado.</td></tr>
                    @endforelse
                 </tbody>
            </table>
        </div>

        <p class="lst-mute lst-dica">
            @if ($profissionais->total())
                Mostrando {{ $profissionais->firstItem() }}–{{ $profissionais->lastItem() }} de {{ $profissionais->total() }}
            @endif
        </p>

        @if ($profissionais->hasPages())
            <div class="lst-paginacao">{{ $profissionais->links() }}</div>
        @endif
    </div>

    {{-- Painel lateral: renderizado pelo servidor quando existe $detalhe --}}
    @if ($detalhe)
        <div class="lst-painel is-open">
            <a class="lst-painel-fundo" href="{{ route('profissional.index', $qs) }}" aria-label="Fechar"></a>
            <div class="lst-painel-caixa">
                <div class="lst-painel-topo">
                    <h3>Detalhe da conta</h3>
                    <a class="lst-icone-btn" href="{{ route('profissional.index', $qs) }}" aria-label="Fechar"><i data-lucide="x"></i></a>
                </div>

                <div class="lst-modal-topo">
                    <span class="lst-avatar">{{ mb_strtoupper(mb_substr($detalhe->nomeProfissionalSaude, 0, 1)) }}</span>
                    <div>
                        <b>{{ $detalhe->nomeProfissionalSaude }}</b>
                        <span class="lst-mute">{{ $detalhe->emailProfissionalSaude }} · {{ $detalhe->getKey() }}</span>
                    </div>
                </div>
                <span class="lst-status {{ $statusClasses[$detalhe->statusConta] ?? '' }}">
                    {{ $statusRotulos[$detalhe->statusConta] ?? $detalhe->statusConta }}
                </span>

                <div class="lst-modal-corpo lst-espaco">
                    <p class="lst-mute">Cadastro</p>
                    <b>{{ optional($detalhe->dataCadastro)->format('d/m/Y') }}</b>
                    <p class="lst-mute lst-espaco">Verificação</p>
                    <b>{{ $verifRotulos[$detalhe->statusVerificacao] ?? '—' }}</b>
                </div>
                <a class="btn-ver-mais-modal" href="/profissional">Ver mais</a>

                @if ($detalhe->statusConta !== 'excluida')
                    <div class="lst-acoes lst-acoes--coluna">
                        <form method="POST" action="{{ route('profissional.status', $detalhe) }}" class="lst-acoes lst-acoes--coluna">
                            @csrf
                            @method('PATCH')
                            @if ($detalhe->statusConta === 'ativa')
                                <button type="submit" name="statusConta" value="suspensa" class="lst-btn lst-btn--neutro">
                                    <i data-lucide="user-x"></i>Suspender conta
                                </button>
                            @else
                                <button type="submit" name="statusConta" value="ativa" class="lst-btn lst-btn--primario">
                                    <i data-lucide="user-check"></i>Reativar conta
                                </button>
                            @endif
                        </form>

                        <a class="lst-btn lst-btn--perigo"
                           href="{{ route('profissional.index', $qs + ['detalhe' => $detalhe->getKey(), 'excluir' => 1]) }}">
                            <i data-lucide="trash-2"></i>Excluir conta
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif

    {{-- Modal de exclusão: renderizado pelo servidor --}}
    @if ($confirmarExclusao)
        <div class="lst-modal is-open">
            <form method="POST" action="{{ route('profissional.excluir', $detalhe) }}" class="lst-modal-caixa lst-card">
                @csrf
                @method('DELETE')
                @foreach (request()->only('busca', 'status') as $k => $v)
                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                @endforeach

                <div class="lst-modal-cabeca">
                    <span class="lst-icone"><i data-lucide="trash-2"></i></span>
                    <h3>Excluir conta?</h3>
                    <p>Ação permanente. Digite <b>EXCLUIR</b> para confirmar.</p>
                </div>
                <div class="lst-escrever {{ $errors->has('confirmacao') ? 'is-erro' : '' }}">
                    <input type="text" name="confirmacao" placeholder="EXCLUIR" autocomplete="off" autofocus>
                </div>
                @error('confirmacao')
                    <span class="lst-erro-msg">{{ $message }}</span>
                @enderror
                <div class="lst-acoes">
                    <a class="lst-btn lst-btn--neutro"
                       href="{{ route('profissional.index', $qs + ['detalhe' => $detalhe->getKey()]) }}">Cancelar</a>
                    <button type="submit" class="lst-btn lst-btn--perigo">Excluir definitivamente</button>
                </div>
            </form>
        </div>
    @endif

    @if (session('sucesso') || ($errors->any() && ! $errors->has('confirmacao')))
        <div class="lst-toast lst-toast--show">
            <i data-lucide="check-circle-2"></i>
            <span>{{ session('sucesso') ?? $errors->first() }}</span>
        </div>
    @endif

</div>

@endsection