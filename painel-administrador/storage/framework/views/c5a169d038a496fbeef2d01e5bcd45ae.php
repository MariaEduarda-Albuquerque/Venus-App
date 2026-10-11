

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/listas.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="lst-page">

    <div class="lst-topo">
        <h1>Mensagens denunciadas</h1>

        <div class="lst-abas">
            <a class="lst-aba" href="/denuncias"><i data-lucide="list-checks"></i>Denúncias</a>
            <a class="lst-aba is-active" href="/denuncias-mensagens">
                <i data-lucide="message-square-warning"></i>Mensagens denunciadas
                <span class="lst-aba-badge" id="m-badge">0</span>
            </a>
        </div>
    </div>

    <div class="lst-card">
        <div class="lst-barra lst-barra--entre">
            <div class="lst-abas" id="m-abas">
                <button type="button" class="lst-aba is-active" data-ms="p">Pendentes <span class="lst-aba-badge" id="m-pend">0</span></button>
                <button type="button" class="lst-aba" data-ms="a">Aceitas</button>
                <button type="button" class="lst-aba" data-ms="x">Recusadas</button>
            </div>

            <label class="lst-busca">
                <i data-lucide="search"></i>
                <input type="text" id="m-busca" placeholder="Pesquisar…">
            </label>
        </div>

        <div class="lst-msgs" id="m-lista"></div>
    </div>

    

<div class="confirma-modal" id="m-confirma-modal">
    <div class="confirma-caixa">

        <span class="confirma-icone">
            <i data-lucide="message-square-warning"></i>
        </span>

        <h3 id="m-confirma-titulo"></h3>

        <p id="m-confirma-texto"></p>

        <!-- Justificativa obrigatória -->
        <div id="m-justificativa-caixa">

            <label
                for="m-justificativa"
                class="lst-justificativa-label"
            >
                Justificativa <span>*</span>
            </label>

            <div class="lst-escrever">
                <textarea
                    id="m-justificativa"
                    name="justificativa"
                    placeholder="Informe o motivo desta decisão..."
                    rows="4"
                    maxlength="1000"
                    required
                ></textarea>
            </div>

            <p
                id="m-justificativa-erro"
                class="lst-erro-msg"
                role="alert"
            >
                Por favor, informe uma justificativa antes de continuar.
            </p>

        </div>

        <div class="confirma-acoes">
            <button
                type="button"
                class="confirma-btn confirma-btn--neutro"
                id="m-confirma-cancelar"
            >
                Cancelar
            </button>

            <button
                type="button"
                class="confirma-btn confirma-btn--ok"
                id="m-confirma-ok"
            >
                Confirmar
            </button>
        </div>

    </div>
</div>


    <div class="lst-toast" id="toast"><i data-lucide="check-circle-2"></i><span></span></div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/usuario/denuncias-mensagens.blade.php ENDPATH**/ ?>