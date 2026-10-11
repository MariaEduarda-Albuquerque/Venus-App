<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conteúdos do Aprender</title>
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
                        <h1 class="titulo-tela">Conteúdos Aprender</h1>
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

            <div class="metrics-grid">
                <!-- Card 1: Recusados -->
                <div class="metric-card">
                    <div class="icon-wrapper icon-danger">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                    <div class="metric-info">
                        <span class="metric-value"><?php echo e($totalConteudosRecusados); ?></span>
                        <span class="metric-label">Recusados</span>
                    </div>
                </div>

                <!-- Card 2: Aguardando revisão -->
                <div class="metric-card">
                    <div class="icon-wrapper icon-warning">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 22h14"></path>
                            <path d="M5 2h14"></path>
                            <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"></path>
                            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"></path>
                        </svg>
                    </div>
                    <div class="metric-info">
                        <span class="metric-value"><?php echo e($totalConteudosEmRevisao); ?></span>
                        <span class="metric-label">Aguardando revisão</span>
                    </div>
                </div>

                <!-- Card 3: Publicados -->
                <div class="metric-card">
                    <div class="icon-wrapper icon-success">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div class="metric-info">
                        <span class="metric-value"><?php echo e($totalConteudosPublicados); ?></span>
                        <span class="metric-label">Publicados</span>
                    </div>
                </div>
            </div>

            <div class="card-container">
                <div class="toolbar">
                    <h1>Conteúdos</h1>
                    <div class="pesquisa-filtro">
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
                                    <li class="<?php echo e($status === 'publicado' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(request()->url()); ?>?status=publicado">Publicado</a>
                                    </li>
                                    <li class="<?php echo e($status === 'em_revisao' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(request()->url()); ?>?status=em_revisao">Em Análise</a>
                                    </li>
                                    <li class="<?php echo e($status === 'recusado' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(request()->url()); ?>?status=recusado">Recusado</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PROFISSIONAL</th>
                            <th>TITULO</th>
                            <th>DATA</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $Conteudos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conteudo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($conteudo->codConteudo); ?></td>
                                <td><?php echo e($conteudo->tbProfissionalSaude->nomeProfissionalSaude); ?></td>
                                <td><?php echo e($conteudo->tituloConteudo); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($conteudo->dataCriacao)->format('d/m/Y')); ?></td>
                                <td>
                                    <?php if($conteudo->statusConteudo == 'publicado'): ?>
                                        <span class="status-publicado"><?php echo e($conteudo->statusConteudo); ?></span>
                                    <?php elseif($conteudo->statusConteudo == 'em_revisao'): ?>
                                        <span class="status-revisao"><?php echo e($conteudo->statusConteudo); ?></span>
                                    <?php elseif($conteudo->statusConteudo == 'recusado'): ?>
                                        <span class="status-recusado"><?php echo e($conteudo->statusConteudo); ?></span>
                                    <?php elseif($conteudo->statusConteudo == 'rascunho'): ?>
                                        <span class="status-rascunho"><?php echo e($conteudo->statusConteudo); ?></span>
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
</html><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/admin/ConteudoAprender-Screen.blade.php ENDPATH**/ ?>