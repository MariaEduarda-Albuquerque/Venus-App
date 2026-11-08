<?php $__env->startSection('titulo', 'Lista de Denúncias - Painel Administrativo - Vênus'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/listas.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="lst-page">

    
    <div class="lst-topo">
        <h1>Lista de denúncias</h1>

        <nav class="lst-abas" aria-label="Tipo de denúncia">
            <a href="<?php echo e(route('denuncias')); ?>"
               class="lst-aba is-active"
               aria-current="page">
                <i data-lucide="list-checks"></i>
                Denúncias
            </a>

            <a href="<?php echo e(route('denuncias.mensagens')); ?>" class="lst-aba">
                <i data-lucide="message-square-warning"></i>
                Mensagens denunciadas

                <?php if($mensagensPendentes > 0): ?>
                    <span class="lst-aba-badge">
                        <?php echo e($mensagensPendentes); ?>

                    </span>
                <?php endif; ?>
            </a>
        </nav>
    </div>

    
    <div class="lst-kpis">

        <button type="button"
                class="lst-card lst-kpi is-active"
                data-filtro="todos"
                aria-pressed="true"
                title="Mostrar todas as denúncias">

            <span class="lst-icone">
                <i data-lucide="alert-circle"></i>
            </span>

            <span class="lst-kpi-texto">
                <b id="dn-total" data-valor="<?php echo e($total); ?>">
                    <?php echo e(number_format($total, 0, ',', '.')); ?>

                </b>
                <span class="lst-kpi-rotulo">
                    Total de denúncias
                </span>
            </span>
        </button>

        <button type="button"
                class="lst-card lst-kpi"
                data-filtro="pendente"
                aria-pressed="false"
                title="Mostrar só as pendentes">

            <span class="lst-icone lst-icone--amarelo">
                <i data-lucide="hourglass"></i>
            </span>

            <span class="lst-kpi-texto">
                <b id="dn-pendentes" data-valor="<?php echo e($pendentes); ?>">
                    <?php echo e(number_format($pendentes, 0, ',', '.')); ?>

                </b>
                <span class="lst-kpi-rotulo">
                    Denúncias pendentes
                </span>
            </span>
        </button>

        <button type="button"
                class="lst-card lst-kpi"
                data-filtro="resolvida"
                aria-pressed="false"
                title="Mostrar só as resolvidas">

            <span class="lst-icone lst-icone--verde">
                <i data-lucide="check-circle-2"></i>
            </span>

            <span class="lst-kpi-texto">
                <b id="dn-resolvidas" data-valor="<?php echo e($resolvidas); ?>">
                    <?php echo e(number_format($resolvidas, 0, ',', '.')); ?>

                </b>
                <span class="lst-kpi-rotulo">
                    Denúncias resolvidas
                </span>
            </span>
        </button>

    </div>

    
    <div class="lst-card lst-espaco">

        <div class="lst-barra">

            <h3>Denúncias</h3>

            <div class="lst-abas">
                <button type="button"
                        class="lst-aba is-active"
                        data-filtro="todos"
                        aria-pressed="true">
                    Todas
                </button>

                <button type="button"
                        class="lst-aba"
                        data-filtro="pendente"
                        aria-pressed="false">
                    Pendentes
                </button>

                <button type="button"
                        class="lst-aba"
                        data-filtro="resolvida"
                        aria-pressed="false">
                    Resolvidas
                </button>
            </div>

            <button type="button"
                    class="lst-btn lst-btn--neutro lst-btn--pequeno"
                    data-pdf>
                <i data-lucide="download"></i>
                Baixar PDF
            </button>

            <label class="lst-busca">
                <i data-lucide="search"></i>
                <input type="search"
                       id="dn-busca"
                       placeholder="Pesquisar…"
                       aria-label="Pesquisar denúncias">
            </label>

        </div>

        <div class="lst-tabela-wrap">

            <table class="lst-tabela">

                <thead>
                    <tr>
                        <th>
                            <button type="button"
                                    class="lst-ordenar"
                                    data-ordenar="id">
                                ID
                            </button>
                        </th>

                        <th>
                            <button type="button"
                                    class="lst-ordenar"
                                    data-ordenar="email">
                                Solicitante
                            </button>
                        </th>

                        <th>
                            <button type="button"
                                    class="lst-ordenar"
                                    data-ordenar="assunto">
                                Assunto
                            </button>
                        </th>

                        <th>
                            <button type="button"
                                    class="lst-ordenar"
                                    data-ordenar="data">
                                Data
                            </button>
                        </th>

                        <th>
                            <button type="button"
                                    class="lst-ordenar"
                                    data-ordenar="status">
                                Status
                            </button>
                        </th>
                    </tr>
                </thead>

                <tbody id="dn-corpo">

                    <?php $__currentLoopData = $denuncias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php
                            $codigo = 'DE' . str_pad(
                                $d->codDenuncia,
                                6,
                                '0',
                                STR_PAD_LEFT
                            );

                            // Confira o nome da coluna de e-mail no model Usuario.
                            $email = $d->tbusuario->emailUsuario ?? '—';

                            $pendente = $d->statusDenuncia === 'pendente';
                        ?>

                        <tr data-id="<?php echo e($codigo); ?>"
                            data-email="<?php echo e($email); ?>"
                            data-data="<?php echo e($d->dataDenuncia?->format('Y-m-d')); ?>"
                            data-status="<?php echo e($d->statusDenuncia); ?>"
                            data-assunto="<?php echo e($d->motivoDenuncia); ?>"
                            data-descricao="<?php echo e($d->comentarioDenuncia); ?>"
                            data-gravidade="<?php echo e($d->gravidade); ?>"
                            data-url="<?php echo e(route('denuncias.decidir', $d)); ?>"
                            tabindex="0">

                            <td class="lst-mono">
                                <?php echo e($codigo); ?>

                            </td>

                            <td>
                                <?php echo e($email); ?>

                            </td>

                            <td>
                                <?php echo e($d->motivoDenuncia); ?>

                            </td>

                            <td>
                                <?php echo e($d->dataDenuncia?->format('d/m/Y')); ?>

                            </td>

                            <td>
                                <span class="lst-status <?php echo e($pendente ? 'lst-status--pendente' : 'lst-status--ok'); ?>">
                                    <?php echo e($pendente ? 'Pendente' : 'Resolvida'); ?>

                                </span>
                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <tr id="dn-vazio" <?php if($denuncias->isNotEmpty()): ?> hidden <?php endif; ?>>
                        <td colspan="5" class="lst-vazio">
                            Nenhuma denúncia encontrada.
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <p class="lst-mute lst-dica">
            Clique em uma linha para ver os detalhes e atualizar o status.
        </p>

    </div>

    
    <div class="lst-painel"
         id="dn-painel"
         role="dialog"
         aria-modal="true"
         aria-labelledby="dn-id"
         data-token="<?php echo e(csrf_token()); ?>">

        <div class="lst-painel-fundo" data-fechar></div>

        <div class="lst-painel-caixa">

            <div class="lst-painel-topo">
                <h3 id="dn-id"></h3>

                <button type="button"
                        class="lst-icone-btn"
                        data-fechar
                        aria-label="Fechar">
                    <i data-lucide="x"></i>
                </button>
            </div>

            <span class="lst-status" id="dn-status"></span>

            <h3 class="lst-painel-titulo" id="dn-assunto"></h3>

            <p class="lst-mute" id="dn-meta"></p>

            <blockquote class="lst-citacao" id="dn-descricao"></blockquote>

            <div class="lst-acoes">

                <button type="button"
                        class="lst-btn lst-btn--neutro"
                        data-fechar>
                    Fechar
                </button>

                <button type="button"
                        class="lst-btn lst-btn--primario"
                        id="dn-alternar">
                </button>

            </div>

        </div>

    </div>

    
    <div class="lst-modal lst-modal--2"
         id="dn-pergunta-modal"
         role="dialog"
         aria-modal="true"
         aria-labelledby="dn-pergunta-texto">

        <div class="lst-card lst-modal-caixa lst-modal-caixa--pergunta">

            <h3 id="dn-pergunta-texto"></h3>

            <label class="lst-justificativa-label"
                   for="dn-justificativa">

                Justificativa da decisão
                <span>*</span>

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

                <button type="button"
                        class="lst-btn lst-btn--neutro"
                        id="dn-pergunta-nao">
                    Cancelar
                </button>

                <button type="button"
                        class="lst-btn lst-btn--primario"
                        id="dn-pergunta-sim">
                    Confirmar
                </button>

            </div>

        </div>

    </div>

    
    <div id="dn-toast"
         class="lst-toast"
         role="status"
         aria-live="polite">
        <span></span>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    

    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.min.js"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/usuario/lista-denuncias.blade.php ENDPATH**/ ?>