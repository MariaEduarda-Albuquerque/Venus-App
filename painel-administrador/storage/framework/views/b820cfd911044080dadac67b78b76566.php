

<?php $__env->startSection('titulo', 'Destaques - Painel Administrativo - Vênus'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/destaque.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="dst-page">

    
    <div class="dst-topo">
        <h1>Destaques - principal</h1>
        <a href="<?php echo e(url('criar-destaque')); ?>" class="dst-btn dst-btn--primario">
            <i data-lucide="plus"></i>Criar
        </a>
    </div>

    
    <div class="dst-lista">

    <?php $__currentLoopData = $destaque; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="dst-card dst-destaque">
            <div class="dst-destaque-info">
                <div class="dst-destaque-titulo">
                    <h2><?php echo e($d->tituloDestaque); ?></h2>
                    <span class="dst-chip <?php echo e($d->statusDestaque === 'ativa' ? 'dst-chip--ok' : ''); ?>"><?php echo e($d->status_texto); ?></span>
                </div>

                <p class="dst-mute dst-categoria"><?php echo e($d->categoria_texto); ?></p>

                <dl class="dst-resumo">
                    <dt>Objetivo</dt>
                    <dd><?php echo e($d->objetivoDestaque); ?></dd>

                    <dt>Público</dt>
                    <dd><?php echo e($d->publico_texto); ?></dd>

                    <dt>Período</dt>
                    <dd><?php echo e($d->periodo_texto); ?></dd>

                    <dt>Chamada</dt>
                    <dd><?php echo e($d->ctaDestaque); ?></dd>

                    <dt>Tags</dt>
                    <dd>
                        <?php $__empty_1 = true; $__currentLoopData = ($d->tagsDestaque ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <span class="dst-chip">#<?php echo e($tag); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            —
                        <?php endif; ?>
                    </dd>
                </dl>
            </div>

            
            <div class="dst-imagem"><?php echo e($d->mensagemprincipalDestaque); ?></div>
        </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/conteudos/destaques.blade.php ENDPATH**/ ?>