<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuárias</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/listas.css')); ?>">
</head>
<body>
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="direita">

        <div class="pagina-conteudo">

            <div class="header-menu-btn">
                <div class="menu-btn" id="menuBtn">
                    <span>☰</span>
                </div>

                <div class="header">
                    <div class="mini-header-titulo">
                        <h1 class="titulo-tela">Lista de Usuárias</h1>
                    </div>

                    <div class="perfil-notificacao">
                        <a href="">
                            <div class="btn-miniHeader">
                                <img src="<?php echo e(asset('images/notification-off.png')); ?>" alt="">
                            </div>
                        </a>

                        <a href="">
                            <div class="btn-miniHeader">
                                <img src="<?php echo e(asset('images/perfil.png')); ?>" alt="">
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-container">
                <div class="toolbar">
                    <div class="search-box">
                        <svg viewBox="0 0 24 24">
                            <path d="M10 2a8 8 0 015.29 13.71l4.5 4.49-1.42 1.42-4.49-4.5A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z"/>
                        </svg>
                        <input type="text" placeholder="Pesquisar...">
                    </div>

                    <?php $status = request('status'); ?>

                    <div class="filter-dropdown-wrapper">
                        <button type="button" class="filtro" id="btnFiltro">
                            <img src="<?php echo e(asset('images/filtro.png')); ?>" alt="Filtro">
                            <h2>Filtro</h2>
                        </button>

                        <div class="dropdown-menu" id="dropdownFiltro">
                            <ul>
                                <li class="<?php echo e(!$status ? 'active' : ''); ?>">
                                    <a href="<?php echo e(request()->url()); ?>">Todos</a>
                                </li>
                                <li class="<?php echo e($status === 'ativa' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(request()->url()); ?>?status=ativa">Ativa</a>
                                </li>
                                <li class="<?php echo e($status === 'suspensa' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(request()->url()); ?>?status=suspensa">Suspensa</a>
                                </li>
                                <li class="<?php echo e($status === 'excluida' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(request()->url()); ?>?status=excluida">Excluída</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>CONTA</th>
                            <th>CADASTRO</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($usuario->codUsuario); ?></td>
                                <td><?php echo e($usuario->nomeUsuario); ?></td>
                                <td><?php echo e($usuario->emailUsuario); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($usuario->dataCadastro)->format('d/m/Y')); ?></td>
                                <td>
                                    <?php if($usuario->statusUsuario == 'ativa'): ?>
                                        <span class="status-publicado"><?php echo e($usuario->statusUsuario); ?></span>
                                    <?php elseif($usuario->statusUsuario == 'suspensa'): ?>
                                        <span class="status-revisao"><?php echo e($usuario->statusUsuario); ?></span>
                                    <?php elseif($usuario->statusUsuario == 'excluida'): ?>
                                        <span class="status-recusado"><?php echo e($usuario->statusUsuario); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/admin/usuario.blade.php ENDPATH**/ ?>