

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

        
        <article class="dst-card dst-destaque">
            <div class="dst-destaque-info">
                <div class="dst-destaque-titulo">
                    <h2>Proteja-se: ISTs podem ser prevenidas</h2>
                    <span class="dst-chip dst-chip--ok">Publicado</span>
                </div>

                <p class="dst-mute dst-categoria">ISTs (Infecções Sexualmente Transmissíveis)</p>

                <dl class="dst-resumo">
                    <dt>Objetivo</dt>
                    <dd>Conscientizar sobre as infecções e a importância do diagnóstico precoce.</dd>

                    <dt>Público</dt>
                    <dd>Adolescentes e jovens (14 a 25 anos)</dd>

                    <dt>Período</dt>
                    <dd>01/07/2025 a 31/07/2025</dd>

                    <dt>Chamada</dt>
                    <dd>Prevenir é um ato de amor</dd>

                    <dt>Tags</dt>
                    <dd>
                        <span class="dst-chip">#ISTs</span>
                        <span class="dst-chip">#Prevenção</span>
                        <span class="dst-chip">#Saúde Sexual</span>
                        <span class="dst-chip">#Teste</span>
                    </dd>
                </dl>
            </div>

            
            <div class="dst-imagem">Proteja-se: ISTs podem ser prevenidas!</div>
        </article>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/conteudos/destaques.blade.php ENDPATH**/ ?>