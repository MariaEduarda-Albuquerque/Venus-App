@extends('layouts.app')

@section('titulo', 'Feedbacks - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
@endpush

@section('content')
<div class="lst-page">

    {{-- Título + baixar PDF --}}
    <div class="lst-topo">
        <h1>Feedbacks</h1>
        <button type="button" class="lst-btn lst-btn--neutro" data-pdf>
            <i data-lucide="download"></i>Baixar PDF
        </button>
    </div>

    {{-- Cards de resumo: clicar filtra a tabela --}}
    <div class="lst-kpis">
        <button type="button" class="lst-card lst-kpi is-active" data-filtro="todos" aria-pressed="true"
                title="Mostrar todos os feedbacks">
            <span class="lst-icone"><i data-lucide="message-square-text"></i></span>
            <span class="lst-kpi-texto"><b id="fb-total">8</b><span class="lst-kpi-rotulo">Total de feedbacks</span></span>
        </button>

        <button type="button" class="lst-card lst-kpi" data-filtro="pendente" aria-pressed="false"
                title="Mostrar só os aguardando resposta">
            <span class="lst-icone lst-icone--amarelo"><i data-lucide="hourglass"></i></span>
            <span class="lst-kpi-texto"><b id="fb-pendentes">8</b><span class="lst-kpi-rotulo">Aguardando resposta</span></span>
        </button>

        <button type="button" class="lst-card lst-kpi" data-filtro="respondido" aria-pressed="false"
                title="Mostrar só os respondidos">
            <span class="lst-icone lst-icone--verde"><i data-lucide="check-circle-2"></i></span>
            <span class="lst-kpi-texto"><b id="fb-respondidos">0</b><span class="lst-kpi-rotulo">Respondidos</span></span>
        </button>
    </div>

    {{-- Tabela --}}
    <div class="lst-card lst-espaco">
        <div class="lst-barra">
            <h3>Feedbacks</h3>

            <div class="lst-abas">
                <button type="button" class="lst-aba is-active" data-filtro="todos" aria-pressed="true">Todos</button>
                <button type="button" class="lst-aba" data-filtro="pendente" aria-pressed="false">Pendentes</button>
                <button type="button" class="lst-aba" data-filtro="respondido" aria-pressed="false">Respondidos</button>
            </div>

            <label class="lst-busca">
                <i data-lucide="search"></i>
                <input type="search" id="fb-busca" placeholder="Pesquisar…" aria-label="Pesquisar feedbacks">
            </label>
        </div>

        <div class="lst-tabela-wrap">
            <table class="lst-tabela">
                <thead>
                    <tr>
                        <th><button type="button" class="lst-ordenar" data-ordenar="id">ID</button></th>
                        <th><button type="button" class="lst-ordenar" data-ordenar="email">Usuária</button></th>
                        <th><button type="button" class="lst-ordenar" data-ordenar="assunto">Assunto</button></th>
                        <th><button type="button" class="lst-ordenar" data-ordenar="data">Data</button></th>
                        <th><button type="button" class="lst-ordenar" data-ordenar="status">Status</button></th>
                        <th><span class="lst-mute">Ação</span></th>
                    </tr>
                </thead>

                {{-- Exemplo estático: trocar por @foreach quando tiver o back-end --}}
                <tbody id="fb-corpo">
                    <tr data-id="FE000008" data-email="RobertaOli@gmail.com" data-data="2026-08-30" data-status="pendente"
                        data-mensagem="Vocês demoram muito para analisar os conteúdos. Podem, por favor, analisar mais rápido? Nós, profissionais, precisamos. Obrigada!" data-resposta="">
                        <td class="lst-mono">FE000008</td>
                        <td>RobertaOli@gmail.com</td>
                        <td>Demoram muito para analisar</td>
                        <td>30/08/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno">Responder</button></td>
                    </tr>
                    <tr data-id="FE000007" data-email="RicardoN@gmail.com" data-data="2026-07-06" data-status="pendente"
                        data-mensagem="Gostei muito do site profissional. Seria ótimo ter um modo escuro para usar à noite." data-resposta="">
                        <td class="lst-mono">FE000007</td>
                        <td>RicardoN@gmail.com</td>
                        <td>Gostei do site profissional, adicionem modo escuro</td>
                        <td>06/07/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno">Responder</button></td>
                    </tr>
                    <tr data-id="FE000006" data-email="AlineSP@gmail.com" data-data="2026-06-12" data-status="pendente"
                        data-mensagem="Alguns botões não respondem no app e a tela de perfil trava ao rolar." data-resposta="">
                        <td class="lst-mono">FE000006</td>
                        <td>AlineSP@gmail.com</td>
                        <td>A interface do app está bugada</td>
                        <td>12/06/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno">Responder</button></td>
                    </tr>
                    <tr data-id="FE000005" data-email="JuniorCOR@gmail.com" data-data="2026-06-11" data-status="pendente"
                        data-mensagem="A interface do app está bugada, os textos ficam sobrepostos em alguns celulares." data-resposta="">
                        <td class="lst-mono">FE000005</td>
                        <td>JuniorCOR@gmail.com</td>
                        <td>A interface do app está bugada</td>
                        <td>11/06/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno">Responder</button></td>
                    </tr>
                    <tr data-id="FE000004" data-email="hdhdihjhj@gmail.com" data-data="2026-06-11" data-status="pendente"
                        data-mensagem="Xnsjhwjsjjsssss" data-resposta="">
                        <td class="lst-mono">FE000004</td>
                        <td>hdhdihjhj@gmail.com</td>
                        <td>Xnsjhwjsjjsssss</td>
                        <td>11/06/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno">Responder</button></td>
                    </tr>
                    <tr data-id="FE000003" data-email="" data-data="2026-05-01" data-status="pendente"
                        data-mensagem="Falta só o conteúdo sobre câncer de mama para ficar completo." data-resposta="">
                        <td class="lst-mono">FE000003</td>
                        <td><span class="lst-mute">Anônimo</span></td>
                        <td>Falta só o conteúdo sobre câncer de mama</td>
                        <td>01/05/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno">Responder</button></td>
                    </tr>
                    <tr data-id="FE000002" data-email="" data-data="2026-02-02" data-status="pendente"
                        data-mensagem="Problemas demais no app, está ruim!" data-resposta="">
                        <td class="lst-mono">FE000002</td>
                        <td><span class="lst-mute">Anônimo</span></td>
                        <td>Problemas demais no app, está ruim!</td>
                        <td>02/02/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno">Responder</button></td>
                    </tr>
                    <tr data-id="FE000001" data-email="" data-data="2026-01-04" data-status="pendente"
                        data-mensagem="Ainda está bem incompleto, faltam várias funções." data-resposta="">
                        <td class="lst-mono">FE000001</td>
                        <td><span class="lst-mute">Anônimo</span></td>
                        <td>Ainda está bem incompleto</td>
                        <td>04/01/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno">Responder</button></td>
                    </tr>

                    <tr id="fb-vazio" hidden>
                        <td colspan="6" class="lst-vazio">Nenhum feedback encontrado.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="lst-mute lst-dica">Clique em um feedback para ler a mensagem completa e responder.</p>
    </div>

    {{-- Modal: ler e responder --}}
    <div class="lst-modal" id="fb-modal" role="dialog" aria-modal="true" aria-labelledby="fb-nome">
        <div class="lst-card lst-modal-caixa">

            <div class="lst-modal-topo">
                <div class="lst-avatar" id="fb-avatar"></div>
                <div>
                    <b id="fb-nome"></b>
                    <div class="lst-mute" id="fb-meta"></div>
                </div>
                <button type="button" class="lst-icone-btn" data-fechar aria-label="Fechar">
                    <i data-lucide="x"></i>
                </button>
            </div>

            <div class="lst-modal-corpo">
                <div class="lst-mute">Assunto</div>
                <b id="fb-assunto"></b>
                <blockquote class="lst-citacao" id="fb-mensagem"></blockquote>
            </div>

            {{-- Resposta já enviada --}}
            <div class="lst-balao" id="fb-resposta-bloco" hidden>
                <div class="lst-avatar">V</div>
                <div>
                    <b>Suporte Vênus</b>
                    <p id="fb-resposta-texto"></p>
                </div>
            </div>

            {{-- Feedback sem e-mail --}}
            <div class="lst-aviso" id="fb-aviso" hidden>
                <i data-lucide="info"></i>
                <span>Feedback anônimo: não há e-mail para enviar uma resposta.</span>
            </div>

            {{-- Escrever resposta --}}
            <div id="fb-responder" hidden>
                <div class="lst-rapidas">
                    <button type="button" data-texto="Olá! Obrigada pelo seu feedback, vamos encaminhá-lo para a equipe responsável.">Agradecer</button>
                    <button type="button" data-texto="Olá! Estamos trabalhando nessa melhoria e avisaremos assim que estiver disponível.">Em andamento</button>
                    <button type="button" data-texto="Olá! Pode nos enviar mais detalhes ou uma captura de tela?">Pedir detalhes</button>
                </div>
                <div class="lst-escrever">
                    <textarea id="fb-campo" placeholder="Escreva sua resposta…" aria-label="Resposta"></textarea>
                </div>
            </div>

            <div class="lst-acoes">
                <button type="button" class="lst-btn lst-btn--neutro" data-fechar>Fechar</button>
                <button type="button" class="lst-btn lst-btn--primario" id="fb-enviar" disabled hidden>
                    <i data-lucide="send"></i>Enviar resposta
                </button>
                <button type="button" class="lst-btn lst-btn--primario" id="fb-analisar" hidden>
                    <i data-lucide="check"></i>Marcar como analisado
                </button>
            </div>
        </div>
    </div>

    {{-- Aviso rápido --}}
    <div class="lst-toast" id="fb-toast" role="status" aria-live="polite">
        <i data-lucide="check-circle-2"></i><span></span>
    </div>

</div>
@endsection

@push('scripts')
    {{-- Gerador de PDF (só esta tela usa) --}}
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.min.js"></script>
    <script src="{{ asset('js/feedbacks.js') }}"></script>
@endpush