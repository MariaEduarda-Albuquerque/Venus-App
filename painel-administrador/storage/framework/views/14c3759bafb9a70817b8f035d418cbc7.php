


<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/suporte.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
    $urlResponder = route('suporte.responder', ['codChamado' => '__ID__']);
?>

<div class="head">
    <h1>Suporte</h1>
    <span class="sm" id="sup-contagem"><?php echo e($chamados->count()); ?> chamados</span>
</div>

<div class="sup" id="sup">

    
    <div class="card">

        <div class="tabs">
            <button type="button" class="tab on" data-aba="o">
                Abertos
            </button>

            <button type="button" class="tab" data-aba="r">
                Resolvidos
            </button>
        </div>

        <label class="sbox">
            <i data-lucide="search"></i>
            <input
                type="text"
                id="sup-busca"
                placeholder="Buscar chamado..."
            >
        </label>

        <div class="tl" id="sup-lista">

            <?php $__empty_1 = true; $__currentLoopData = $chamados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <?php
                    $profissional = $c->profissional;

                    $nome = $profissional?->nomeProfissionalSaude ?? 'Profissional não identificado';

                    $email = $profissional?->emailProfissionalSaude ?? '';

                    $status = $c->statusChamado === 'resolvido' ? 'r' : 'o';

                    $novo = $c->mensagens
                        ->where('tipoRemetente', 'admin')
                        ->isEmpty();
                ?>

                <button
                    type="button"
                    class="ti"
                    data-id="<?php echo e($c->codChamado); ?>"
                    data-status="<?php echo e($status); ?>"
                    data-texto="<?php echo e($c->codChamado); ?> <?php echo e($c->assuntoChamado); ?> <?php echo e($nome); ?>"
                >

                    <b>
                        <?php if($novo): ?>
                            <span class="ud"></span>
                        <?php endif; ?>

                        ID <?php echo e($c->codChamado); ?>

                    </b>

                    <div class="sub2">
                        <?php echo e($c->assuntoChamado); ?>

                    </div>

                    <div class="sub2">
                        <?php echo e($nome); ?>

                    </div>

                </button>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <p class="sm vazio">
                    Nenhum chamado cadastrado.
                </p>

            <?php endif; ?>

            <p class="sm vazio" id="sup-vazio" hidden>
                Nenhum chamado.
            </p>

        </div>
    </div>


    
    <div class="card">

        <div class="empty" id="sup-sem-chamado">
            Nenhum chamado selecionado.
        </div>

        <?php $__currentLoopData = $chamados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
                $profissional = $c->profissional;

                $nome = $profissional?->nomeProfissionalSaude ?? 'Profissional não identificado';

                $email = $profissional?->emailProfissionalSaude ?? '';

                $status = $c->statusChamado;
            ?>

            <div
                class="chamado"
                data-id="<?php echo e($c->codChamado); ?>"
                data-status="<?php echo e($status === 'resolvido' ? 'r' : 'o'); ?>"
                hidden
            >

                <div class="th">

                    <div>
                        <h3>
                            <span>ID <?php echo e($c->codChamado); ?> -</span>
                            <?php echo e($c->assuntoChamado); ?>

                        </h3>

                        <p class="sm">
                            <?php echo e($c->dataAbertura?->format('d/m/Y H:i')); ?>

                        </p>
                    </div>

                    <div class="nv">

                        <button
                            type="button"
                            class="btn g s"
                            data-resolver
                            data-status-atual="<?php echo e($status); ?>"
                        >
                            <i data-lucide="check"></i>
                            <span></span>
                        </button>

                        <button
                            type="button"
                            class="nvb"
                            data-anterior
                            aria-label="Anterior"
                        >
                            <i data-lucide="chevron-left"></i>
                        </button>

                        <button
                            type="button"
                            class="nvb"
                            data-proximo
                            aria-label="Próximo"
                        >
                            <i data-lucide="chevron-right"></i>
                        </button>

                    </div>
                </div>


                
                <div class="thr">

                    
                    <div class="bub">

                        <div class="mav">
                            <?php echo e(mb_substr($nome, 0, 1)); ?>

                        </div>

                        <div>

                            <div class="nm">
                                <?php echo e($nome); ?>

                            </div>

                            <div class="em">
                                <?php echo e($email); ?>

                                ·
                                <?php echo e($c->dataAbertura?->format('d/m/Y H:i')); ?>

                            </div>

                            <div class="bd2">
                                <?php echo e($c->descricaoChamado); ?>

                            </div>

                            <?php if($c->anexoChamado): ?>

                                <div class="em">
                                    <a
                                        href="<?php echo e(Storage::disk('public')->url($c->anexoChamado)); ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        Visualizar anexo inicial
                                    </a>
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>


                    
                    <?php $__currentLoopData = $c->mensagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php if($msg->tipoRemetente === 'profissional'): ?>

                            <div class="bub">

                                <div class="mav">
                                    <?php echo e(mb_substr($nome, 0, 1)); ?>

                                </div>

                                <div>

                                    <div class="nm">
                                        <?php echo e($nome); ?>

                                    </div>

                                    <div class="em">
                                        <?php echo e($msg->dataMensagem?->format('d/m/Y H:i')); ?>

                                    </div>

                                    <div class="bd2">
                                        <?php echo e($msg->textoMensagem); ?>

                                    </div>

                                    <?php if($msg->anexoMensagem): ?>

                                        <div class="em">
                                            <a
                                                href="<?php echo e(Storage::disk('public')->url($msg->anexoMensagem)); ?>"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                            >
                                                Visualizar anexo
                                            </a>
                                        </div>

                                    <?php endif; ?>

                                </div>
                            </div>

                        <?php else: ?>

                            <div class="bub s">

                                <div class="mav">
                                    V
                                </div>

                                <div>

                                    <div class="nm">
                                        Suporte Vênus
                                    </div>

                                    <div class="em">
                                        <?php echo e($msg->dataMensagem?->format('d/m/Y H:i')); ?>

                                    </div>

                                    <div class="bd2">
                                        <?php echo e($msg->textoMensagem); ?>

                                    </div>

                                    <?php if($msg->anexoMensagem): ?>

                                        <div class="em">
                                            <a
                                                href="<?php echo e(Storage::disk('public')->url($msg->anexoMensagem)); ?>"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                            >
                                                Visualizar anexo
                                            </a>
                                        </div>

                                    <?php endif; ?>

                                </div>
                            </div>

                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        
        <div class="resposta-area" id="sup-resposta-area">

            <div class="qr">

                <button
                    type="button"
                    data-rapida="Olá! Estamos analisando o seu chamado e retornaremos em breve."
                >
                    Em análise
                </button>

                <button
                    type="button"
                    data-rapida="Olá! O problema foi corrigido. Pode confirmar se tudo funciona normalmente?"
                >
                    Problema corrigido
                </button>

                <button
                    type="button"
                    data-rapida="Olá! Para continuar, pode nos enviar mais detalhes ou uma captura de tela?"
                >
                    Pedir mais detalhes
                </button>

            </div>


            <form
                id="sup-form-resposta"
                action="<?php echo e($urlResponder); ?>"
                method="POST"
                enctype="multipart/form-data"
            >

                <?php echo csrf_field(); ?>

                <div class="cmp">

                    <textarea
                        id="sup-resposta"
                        name="textoMensagem"
                        placeholder="Digite sua resposta aqui..."
                    ></textarea>

                    <div id="sup-anexos"></div>

                    <div class="bar">

                        <button
                            type="button"
                            class="btn g s"
                            id="sup-anexar"
                        >
                            <i data-lucide="paperclip"></i>
                            Anexar
                        </button>

                        <span class="sm">
                            Ctrl + Enter envia
                        </span>

                        <button
                            type="submit"
                            class="btn p s"
                            id="sup-enviar"
                            disabled
                        >
                            Responder
                            <i data-lucide="send"></i>
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>



<input
    type="file"
    id="sup-arquivo"
    name="anexoMensagem"
    form="sup-form-resposta"
    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
    hidden
>



<form
    id="sup-form-status"
    method="POST"
    action="<?php echo e(route('suporte.status', ['codChamado' => '__ID__'])); ?>"
    hidden
>
    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>

    <input
        type="hidden"
        name="statusChamado"
        id="sup-status-valor"
    >
</form>



<div class="confirma-modal" id="sup-confirma-modal">

    <div class="confirma-caixa">

        <span class="confirma-icone">
            <i data-lucide="check-circle-2"></i>
        </span>

        <h3 id="sup-confirma-titulo"></h3>

        <p>Você pode mudar isso depois.</p>

        <div class="confirma-acoes">

            <button
                type="button"
                class="confirma-btn confirma-btn--neutro"
                id="sup-confirma-cancelar"
            >
                Cancelar
            </button>

            <button
                type="button"
                class="confirma-btn confirma-btn--ok"
                id="sup-confirma-ok"
            >
                Confirmar
            </button>

        </div>

    </div>

</div>



<div class="toast" id="sup-toast">
    <i data-lucide="check-circle-2"></i>
    <span></span>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/outros/suporte.blade.php ENDPATH**/ ?>