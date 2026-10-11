

<?php $__env->startSection('titulo', ($nome ?? 'Relatório') . ' - Painel Administrativo - Vênus'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/em-construcao.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="ec-page">
    <div class="ec-icone"><i data-lucide="construction"></i></div>

    <h1>Relatório</h1>
    <p>Esta tela não faz parte da prévia.</p>

    <a href="<?php echo e(url('/')); ?>" class="ec-btn">Voltar ao painel</a>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/painel/relatorio.blade.php ENDPATH**/ ?>