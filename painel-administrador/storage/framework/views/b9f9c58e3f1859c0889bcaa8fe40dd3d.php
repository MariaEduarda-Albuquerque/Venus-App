

<?php $__env->startSection('titulo', 'Aprovação de Cadastros - Painel Administrativo - Vênus'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/listas.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php

    $q = fn (array $extra = []) => array_filter(
        array_merge(['aba' => $aba, 'conselho' => $conselho, 'busca' => $busca], $extra),
        fn ($v) => $v !== null && $v !== ''
    );

    $kpis = [
        'p' => ['Aguardando análise', 'user-check',   '',                 'em_analise'],
        'r' => ['Reenvio solicitado', 'rotate-ccw',   'lst-icone--amarelo', 'pendencia'],
        'a' => ['Aprovados',          'badge-check',  'lst-icone--verde',   'aprovado'],
        'x' => ['Reprovados',         'user-x',       '',                 'reprovado'],
    ];

    $abas = ['p' => 'Pendentes', 'r' => 'Reenvio', 'a' => 'Aprovados', 'x' => 'Reprovados'];
    
?>

<div class="lst-page">

    <div class="lst-topo">
        <div>
            <h1>Aprovação de cadastros</h1>
            <p class="lst-mute">Valide os documentos de cada profissional antes de liberar o acesso.</p>
        </div>
    </div>

    
    <div class="lst-kpis">
        <?php $__currentLoopData = $kpis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chave => [$rotulo, $icone, $classeIcone, $st]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('cadastros.aprovar', ['aba' => $chave])); ?>"
               class="lst-card lst-kpi <?php echo e($aba === $chave ? 'is-active' : ''); ?>">
                <span class="lst-icone <?php echo e($classeIcone); ?>"><i data-lucide="<?php echo e($icone); ?>"></i></span>
                <span class="lst-kpi-texto">
                    <b><?php echo e($contagens[$st] ?? 0); ?></b>
                    <span class="lst-kpi-rotulo"><?php echo e($rotulo); ?></span>
                </span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="lst-card lst-espaco">
        <div class="lst-barra">
            <div class="lst-abas">
                <?php $__currentLoopData = $abas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chave => $rotulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('cadastros.aprovar', $q(['aba' => $chave]))); ?>"
                       class="lst-aba <?php echo e($aba === $chave ? 'is-active' : ''); ?>">
                        <?php echo e($rotulo); ?>

                        <?php if($chave === 'p' && ($contagens['em_analise'] ?? 0)): ?>
                            <span class="lst-aba-badge"><?php echo e($contagens['em_analise']); ?></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="lst-abas lst-abas--fim" aria-label="Filtrar por categoria">
                <a href="<?php echo e(route('cadastros.aprovar', $q(['conselho' => '']))); ?>"
                   class="lst-aba <?php echo e($conselho === '' ? 'is-active' : ''); ?>">Todos</a>
                <?php $__currentLoopData = $conselhos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('cadastros.aprovar', $q(['conselho' => $c]))); ?>"
                       class="lst-aba <?php echo e($conselho === $c ? 'is-active' : ''); ?>"><?php echo e($c); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <form method="GET" action="<?php echo e(route('cadastros.aprovar')); ?>" class="lst-busca">
                <input type="hidden" name="aba" value="<?php echo e($aba); ?>">
                <?php if($conselho !== ''): ?> <input type="hidden" name="conselho" value="<?php echo e($conselho); ?>"> <?php endif; ?>
                <button type="submit" class="lst-icone-btn" aria-label="Pesquisar"><i data-lucide="search"></i></button>
                <input type="search" name="busca" value="<?php echo e($busca); ?>" placeholder="Nome ou nº de conselho…">
            </form>
        </div>

        <div class="lst-tabela-wrap">
            <table class="lst-tabela lst-tabela--larga">
                <thead>
                    <tr>
                        <th>Profissional</th>
                        <th>Categoria</th>
                        <th>Especialidade</th>
                        <th>Aguardando</th>
                        <th>Status</th>
                        <th><span class="lst-mute">Ação</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $cadastros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $info  = $statusInfo[$c->statusVerificacao] ?? ['rotulo' => $c->statusVerificacao, 'classe' => ''];
                            $desde = \Carbon\Carbon::parse($c->dataCadastro);
                            $atraso = $c->statusVerificacao === 'em_analise' && $desde->diffInHours(now()) >= 24;
                        ?>
                        <tr>
                            <td>
                                <div class="lst-pessoa">
                                    <div class="lst-avatar"><?php echo e(mb_strtoupper(mb_substr($c->nomeProfissionalSaude, 0, 1))); ?></div>
                                    <div>
                                        <b><?php echo e($c->nomeProfissionalSaude); ?></b>
                                        <span class="lst-mute"><?php echo e($c->emailProfissionalSaude); ?></span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="lst-conselho"><?php echo e($c->categoriaProfissional ?? '—'); ?></span></td>
                            <td><?php echo e($c->especialidadeProfissionalSaude ?? '—'); ?></td>
                            <td>
                                <?php if($c->statusVerificacao === 'em_analise'): ?>
                                    <?php if($atraso): ?>
                                        <span class="lst-atraso"><i data-lucide="triangle-alert"></i><?php echo e($desde->locale('pt_BR')->diffForHumans(null, true)); ?></span>
                                    <?php else: ?>
                                        <?php echo e($desde->locale('pt_BR')->diffForHumans(null, true)); ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td><span class="lst-status <?php echo e($info['classe']); ?>"><?php echo e($info['rotulo']); ?></span></td>
                            <td>
                                <?php if($c->statusVerificacao === 'em_analise'): ?>
                                    <a href="<?php echo e(route('cadastro.aprovar', $c)); ?>" style="color:white" class="lst-btn lst-btn--primario lst-btn--pequeno">Analisar</a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('cadastro.aprovar', $c)); ?>" class="lst-btn lst-btn--neutro lst-btn--pequeno">Ver</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="lst-vazio">Nenhum cadastro nesta aba.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($cadastros->total()): ?>
            <p class="lst-mute lst-dica">Mostrando <?php echo e($cadastros->firstItem()); ?>–<?php echo e($cadastros->lastItem()); ?> de <?php echo e($cadastros->total()); ?></p>
        <?php endif; ?>
        <?php if($cadastros->hasPages()): ?>
            <div class="lst-paginacao"><?php echo e($cadastros->links()); ?></div>
        <?php endif; ?>
    </div>

    <?php if(session('sucesso')): ?>
        <div class="lst-toast lst-toast--show"><i data-lucide="check-circle-2"></i><span><?php echo e(session('sucesso')); ?></span></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/usuario/aprovar-cadastros.blade.php ENDPATH**/ ?>