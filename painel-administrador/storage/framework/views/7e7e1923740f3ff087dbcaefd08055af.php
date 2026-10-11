

<?php $__env->startSection('titulo', 'Lista de Denúncias - Painel Administrativo - Vênus'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/listas.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="lst-page">

    
    <div class="lst-topo">
        <h1>Lista de denúncias</h1>

        
        <nav class="lst-abas" aria-label="Tipo de denúncia">
            <a href="/denuncias" class="lst-aba is-active" aria-current="page">
                <i data-lucide="list-checks"></i>Denúncias
            </a>
            <a href="/denuncias-mensagens" class="lst-aba">
                <i data-lucide="message-square-warning"></i>Mensagens denunciadas
                <span class="lst-aba-badge">3</span>
            </a>
        </nav>
    </div>

    
    <div class="lst-kpis">
        <button type="button" class="lst-card lst-kpi is-active" data-filtro="todos" aria-pressed="true"
                title="Mostrar todas as denúncias">
            <span class="lst-icone"><i data-lucide="alert-circle"></i></span>
            <span class="lst-kpi-texto"><b id="dn-total" data-valor="5347">5.347</b><span class="lst-kpi-rotulo">Total de denúncias</span></span>
        </button>

        <button type="button" class="lst-card lst-kpi" data-filtro="pendente" aria-pressed="false"
                title="Mostrar só as pendentes">
            <span class="lst-icone lst-icone--amarelo"><i data-lucide="hourglass"></i></span>
            <span class="lst-kpi-texto"><b id="dn-pendentes" data-valor="1230">1.230</b><span class="lst-kpi-rotulo">Denúncias pendentes</span></span>
        </button>

        <button type="button" class="lst-card lst-kpi" data-filtro="resolvida" aria-pressed="false"
                title="Mostrar só as resolvidas">
            <span class="lst-icone lst-icone--verde"><i data-lucide="check-circle-2"></i></span>
            <span class="lst-kpi-texto"><b id="dn-resolvidas" data-valor="4117">4.117</b><span class="lst-kpi-rotulo">Denúncias resolvidas</span></span>
        </button>
    </div>

    
    <div class="lst-card lst-espaco">
        <div class="lst-barra">
            <h3>Denúncias</h3>

            <div class="lst-abas">
                <button type="button" class="lst-aba is-active" data-filtro="todos" aria-pressed="true">Todas</button>
                <button type="button" class="lst-aba" data-filtro="pendente" aria-pressed="false">Pendentes</button>
                <button type="button" class="lst-aba" data-filtro="resolvida" aria-pressed="false">Resolvidas</button>
            </div>

            <button type="button" class="lst-btn lst-btn--neutro lst-btn--pequeno" data-pdf>
                <i data-lucide="download"></i>Baixar PDF
            </button>

            <label class="lst-busca">
                <i data-lucide="search"></i>
                <input type="search" id="dn-busca" placeholder="Pesquisar…" aria-label="Pesquisar denúncias">
            </label>
        </div>

        <div class="lst-tabela-wrap">
            <table class="lst-tabela">
                <thead>
                    <tr>
                        <th><button type="button" class="lst-ordenar" data-ordenar="id">ID</button></th>
                        <th><button type="button" class="lst-ordenar" data-ordenar="email">Solicitante</button></th>
                        <th><button type="button" class="lst-ordenar" data-ordenar="assunto">Assunto</button></th>
                        <th><button type="button" class="lst-ordenar" data-ordenar="data">Data</button></th>
                        <th><button type="button" class="lst-ordenar" data-ordenar="status">Status</button></th>
                    </tr>
                </thead>

                
                <tbody id="dn-corpo">
                    <tr data-id="DE266910" data-email="RicardoN@gmail.com" data-data="2026-10-04" data-status="pendente" tabindex="0">
                        <td class="lst-mono">DE266910</td>
                        <td>RicardoN@gmail.com</td>
                        <td>A integração não está funcionando.</td>
                        <td>04/10/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                    </tr>
                    <tr data-id="DE271003" data-email="LuizaR@gmail.com" data-data="2026-10-02" data-status="pendente" tabindex="0">
                        <td class="lst-mono">DE271003</td>
                        <td>LuizaR@gmail.com</td>
                        <td>Perfil falso identificado na plataforma</td>
                        <td>02/10/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                    </tr>
                    <tr data-id="DE270455" data-email="JoaoP@gmail.com" data-data="2026-09-30" data-status="pendente" tabindex="0">
                        <td class="lst-mono">DE270455</td>
                        <td>JoaoP@gmail.com</td>
                        <td>Não recebo o e-mail de confirmação</td>
                        <td>30/09/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                    </tr>
                    <tr data-id="DE270112" data-email="CarlaM@gmail.com" data-data="2026-09-28" data-status="pendente" tabindex="0">
                        <td class="lst-mono">DE270112</td>
                        <td>CarlaM@gmail.com</td>
                        <td>Cobrança duplicada no plano</td>
                        <td>28/09/2026</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                    </tr>
                    <tr data-id="DE268220" data-email="TaisB@gmail.com" data-data="2026-08-14" data-status="resolvida" tabindex="0">
                        <td class="lst-mono">DE268220</td>
                        <td>TaisB@gmail.com</td>
                        <td>Dúvida sobre exclusão de conta</td>
                        <td>14/08/2026</td>
                        <td><span class="lst-status lst-status--ok">Resolvida</span></td>
                    </tr>
                    <tr data-id="DE264789" data-email="MariaN@gmail.com" data-data="2026-05-02" data-status="resolvida" tabindex="0">
                        <td class="lst-mono">DE264789</td>
                        <td>MariaN@gmail.com</td>
                        <td>Bug encontrado no layout do Modo Escuro</td>
                        <td>02/05/2026</td>
                        <td><span class="lst-status lst-status--ok">Resolvida</span></td>
                    </tr>
                    <tr data-id="DE269346" data-email="AnaPaula@gmail.com" data-data="2026-01-11" data-status="resolvida" tabindex="0">
                        <td class="lst-mono">DE269346</td>
                        <td>AnaPaula@gmail.com</td>
                        <td>Erro 500 no painel de controle</td>
                        <td>11/01/2026</td>
                        <td><span class="lst-status lst-status--ok">Resolvida</span></td>
                    </tr>

                    <tr id="dn-vazio" hidden>
                        <td colspan="5" class="lst-vazio">Nenhuma denúncia encontrada.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="lst-mute lst-dica">Clique em uma linha para ver os detalhes e atualizar o status.</p>
    </div>

    
    <div class="lst-painel" id="dn-painel" role="dialog" aria-modal="true" aria-labelledby="dn-id">
        <div class="lst-painel-fundo" data-fechar></div>

        <div class="lst-painel-caixa">
            <div class="lst-painel-topo">
                <h3 id="dn-id"></h3>
                <button type="button" class="lst-icone-btn" data-fechar aria-label="Fechar">
                    <i data-lucide="x"></i>
                </button>
            </div>

            <span class="lst-status" id="dn-status"></span>
            <h3 class="lst-painel-titulo" id="dn-assunto"></h3>
            <p class="lst-mute" id="dn-meta"></p>

            <blockquote class="lst-citacao" id="dn-descricao"></blockquote>

            <div class="lst-acoes">
                <button type="button" class="lst-btn lst-btn--neutro" data-fechar>Fechar</button>
                <button type="button" class="lst-btn lst-btn--primario" id="dn-alternar"></button>
            </div>
        </div>
    </div>

        


<div class="lst-modal lst-modal--2" id="dn-pergunta-modal"
     role="dialog" aria-modal="true"
     aria-labelledby="dn-pergunta-texto">

    <div class="lst-card lst-modal-caixa lst-modal-caixa--pergunta">
        <h3 id="dn-pergunta-texto"></h3>

        <label class="lst-justificativa-label" for="dn-justificativa">
            Justificativa da decisão <span>*</span>
        </label>

        <div class="lst-escrever" id="dn-justificativa-caixa">
            <textarea
                id="dn-justificativa"
                placeholder="Explique o motivo da sua decisão..."
                rows="4"
                maxlength="1000"
                required></textarea>
        </div>

        <p class="lst-erro-msg" id="dn-justificativa-erro">
            Informe a justificativa antes de confirmar.
        </p>

        <div class="lst-acoes lst-acoes--centro">
            <button type="button" class="lst-btn lst-btn--neutro"
                    id="dn-pergunta-nao">Cancelar</button>
            <button type="button" class="lst-btn lst-btn--primario"
                    id="dn-pergunta-sim">Confirmar</button>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.min.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/usuario/lista-denuncias.blade.php ENDPATH**/ ?>