        <link rel="stylesheet" href="<?php echo e(asset('css/sidebar-pesquisa.css')); ?>">

        <div class="form">

            <a class="sidebar-btn" id="menuBtn" href="javascript:void(0)" onclick="compactarSidebar()">
                ☰
            </a>

            <div class="mini-header-container">
                <h1><?php echo e($titulo); ?></h1>
            </div>

            <a href="">
                <div class="btn-sino-perfil">
                    <img src="<?php echo e(asset('images/notification.png')); ?>" alt="">
                </div>
            </a>

            <a href="/perfil">
                <div class="btn-sino-perfil">
                    <img src="<?php echo e(asset('images/perfil.png')); ?>" alt="">
                </div>
            </a>
        </div>

            <script src="<?php echo e(asset('js/adm.js')); ?>"></script>
<?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/layouts/mini-header.blade.php ENDPATH**/ ?>