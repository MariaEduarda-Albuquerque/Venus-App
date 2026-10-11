@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
@endpush

@section('content')

<div class="lst-page">

    <div class="lst-topo">
        <h1>Lista de usuários</h1>
        <button type="button" class="lst-btn lst-btn--neutro" data-pdf>
            <i data-lucide="download"></i>Baixar PDF
        </button>
    </div>

    <div class="lst-card">
        <div class="lst-barra">
            <label class="lst-busca">
                <i data-lucide="search"></i>
                <input type="text" id="us-busca" placeholder="Pesquisar…">
            </label>

            <div class="lst-filtro lst-filtro--fim">
                <button type="button" class="lst-btn lst-btn--primario" id="us-filtro-btn" aria-expanded="false">
                    <i data-lucide="sliders-horizontal"></i><span id="us-filtro-rotulo">Filtro</span>
                </button>
                <div class="lst-menu" id="us-menu">
                    <button type="button" data-filtro="todos"><span>Todos</span><i data-lucide="check"></i></button>
                    <button type="button" data-filtro="ativo"><span>Ativo</span><i data-lucide="check"></i></button>
                    <button type="button" data-filtro="desativado"><span>Desativado</span><i data-lucide="check"></i></button>
                    <button type="button" data-filtro="suspenso"><span>Suspenso</span><i data-lucide="check"></i></button>
                </div>
            </div>
        </div>

        <div class="lst-tabela-wrap">
            <table class="lst-tabela">
                <thead>
                    <tr>
                        <th aria-sort="none"><button type="button" class="lst-ordenar" data-ordenar="id">ID</button></th>
                        <th aria-sort="none"><button type="button" class="lst-ordenar" data-ordenar="nome">Nome</button></th>
                        <th aria-sort="none"><button type="button" class="lst-ordenar" data-ordenar="conta">Conta</button></th>
                        <th aria-sort="none"><button type="button" class="lst-ordenar" data-ordenar="cadastro">Cadastro</button></th>
                        <th aria-sort="none"><button type="button" class="lst-ordenar" data-ordenar="status">Status</button></th>
                    </tr>
                </thead>
                <tbody id="us-corpo">
                    <tr data-id="US124321" data-nome="Maria Ninguém" data-conta="Profissional" data-cadastro="2024-06-15" data-status="ativo" tabindex="0">
                        <td class="lst-mono">US124321</td>
                        <td>Maria Ninguém</td>
                        <td>Profissional</td>
                        <td>15/06/2024</td>
                        <td><span class="lst-status lst-status--ok">Ativo</span></td>
                    </tr>
                    <tr data-id="US356412" data-nome="Gabriela Ninguém" data-conta="Administração" data-cadastro="2025-12-09" data-status="desativado" tabindex="0">
                        <td class="lst-mono">US356412</td>
                        <td>Gabriela Ninguém</td>
                        <td>Administração</td>
                        <td>09/12/2025</td>
                        <td><span class="lst-status lst-status--recusado">Desativado</span></td>
                    </tr>
                    <tr data-id="US956487" data-nome="Júlia Ninguém" data-conta="Usuário" data-cadastro="2026-03-01" data-status="ativo" tabindex="0">
                        <td class="lst-mono">US956487</td>
                        <td>Júlia Ninguém</td>
                        <td>Usuário</td>
                        <td>01/03/2026</td>
                        <td><span class="lst-status lst-status--ok">Ativo</span></td>
                    </tr>
                    <tr id="us-vazio" hidden>
                        <td colspan="5" class="lst-vazio">Nenhum usuário encontrado.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="lst-mute lst-dica" id="us-contagem"></p>
    </div>

    {{-- Painel lateral (abre ao clicar numa linha) --}}
    <div class="lst-painel" id="us-painel">
        <div class="lst-painel-fundo" data-fechar></div>
        <div class="lst-painel-caixa">
            <div class="lst-painel-topo">
                <h3>Detalhe da conta</h3>
                <button type="button" class="lst-icone-btn" data-fechar aria-label="Fechar"><i data-lucide="x"></i></button>
            </div>

            <div class="lst-modal-topo">
                <span class="lst-avatar" id="us-avatar"></span>
                <div><b id="us-nome"></b><span class="lst-mute" id="us-meta"></span></div>
            </div>
            <span class="lst-status" id="us-status"></span>

            <div class="lst-modal-corpo lst-espaco">
                <p class="lst-mute">Cadastro</p>
                <b id="us-cadastro"></b>
                <p class="lst-mute lst-espaco">Último acesso</p>
                <b>há 2 dias</b>
            </div>

            <div class="lst-acoes lst-acoes--coluna">
                <button type="button" class="lst-btn lst-btn--neutro" id="us-suspender"><i data-lucide="user-x"></i>Suspender conta</button>
                <button type="button" class="lst-btn lst-btn--primario" id="us-reativar"><i data-lucide="user-check"></i>Reativar conta</button>
                <button type="button" class="lst-btn lst-btn--perigo" id="us-excluir"><i data-lucide="trash-2"></i>Excluir conta</button>
            </div>
        </div>
    </div>

    {{-- Modal: confirmar suspender / reativar --}}
    <div class="confirma-modal" id="us-confirma-modal">
        <div class="confirma-caixa">
            <span class="confirma-icone"><i data-lucide="user-x"></i></span>
            <h3 id="us-confirma-titulo"></h3>
            <p id="us-confirma-texto"></p>
            <div class="confirma-acoes">
                <button type="button" class="confirma-btn confirma-btn--neutro" id="us-confirma-cancelar">Cancelar</button>
                <button type="button" class="confirma-btn confirma-btn--ok" id="us-confirma-ok">Confirmar</button>
            </div>
        </div>
    </div>

    {{-- Modal: confirmar exclusão (digitar EXCLUIR) --}}
    <div class="lst-modal" id="us-modal">
        <div class="lst-modal-caixa lst-card">
            <div class="lst-modal-cabeca">
                <span class="lst-icone"><i data-lucide="trash-2"></i></span>
                <h3>Excluir conta?</h3>
                <p>Ação permanente. Digite <b>EXCLUIR</b> para confirmar.</p>
            </div>
            <div class="lst-escrever" id="us-confirma-caixa">
                <input type="text" id="us-confirma" placeholder="EXCLUIR">
            </div>
            <span class="lst-erro-msg">Digite EXCLUIR para continuar.</span>
            <div class="lst-acoes">
                <button type="button" class="lst-btn lst-btn--neutro" data-cancelar>Cancelar</button>
                <button type="button" class="lst-btn lst-btn--perigo" id="us-excluir-ok">Excluir definitivamente</button>
            </div>
        </div>
    </div>

    <div class="lst-toast" id="us-toast"><i data-lucide="check-circle-2"></i><span></span></div>

</div>

@endsection