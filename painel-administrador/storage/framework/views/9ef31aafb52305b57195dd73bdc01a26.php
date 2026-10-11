<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('titulo', 'Painel Administrativo - Vênus'); ?></title>

    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.469.0/dist/umd/lucide.min.js"></script>

    <link rel="stylesheet" href="<?php echo e(asset('css/sidebar-pesquisa.css')); ?>">
    <?php echo $__env->yieldPushContent('css'); ?>
</head>
<body>

    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="direita">
        <?php echo $__env->make('layouts.barra-pesquisa', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="<?php echo e(asset('js/adm.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>lucide.createIcons();</script>

</body>
</html><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/layouts/app.blade.php ENDPATH**/ ?>