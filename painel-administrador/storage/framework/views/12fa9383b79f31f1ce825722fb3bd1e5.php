<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', 'Painel Administrativo - Vênus'); ?></title>

    <link rel="stylesheet" href="<?php echo e(asset('css/adm.css')); ?>">

    <!-- <?php echo $__env->make('Components.Toggle', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> -->
</head>

<body>

    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



    <div class="direita">

        <div class="form">

            <div class="menu-btn" id="menuBtn">
                <span>☰</span>
            </div>

            <button type="submit" class="btn-logo">
                <img src="<?php echo e(asset('images/lupa.png')); ?>" alt="Enviar">
            </button>

            <form action="">
                <input
                    type="text"
                    id="pesquisar"
                    name="pesquisar"
                    placeholder="Pesquisar..."
                >
            </form>

            <a href="">
                <div class="btn-pesquisar">
                    <img src="<?php echo e(asset('images/notification.png')); ?>" alt="">
                </div>
            </a>

            <a href="">
                <div class="btn-pesquisar">
                    <img src="<?php echo e(asset('images/perfil.png')); ?>" alt="">
                </div>
            </a>

        </div>


        <div class="conteudo">

            <?php echo $__env->yieldContent('content'); ?>

        </div>

    </div>

</body>

</html><?php /**PATH C:\laravel\Venus\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>