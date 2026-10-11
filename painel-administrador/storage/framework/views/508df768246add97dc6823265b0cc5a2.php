

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/relatorios.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="rel-page">

    <div class="rel-topo">
        <h1>Relatório de usuárias</h1>

        <div class="rel-acoes">
            <button type="button" class="rel-btn" id="btn-pdf">
                <i data-lucide="download"></i>Baixar PDF
            </button>

            <select class="rel-select" id="rel-p" aria-label="Período">
                <option value="1">Últimos 30 dias</option>
                <option value="2.8">Últimos 90 dias</option>
                <option value="11">Último ano</option>
            </select>
        </div>
    </div>

    <div class="rel-kpis">
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="users"></i></span>
            <span class="rel-kpi-texto"><b id="k-total">0</b><span>Total de usuárias</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="trending-up"></i></span>
            <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">—</b><span>Maior grupo</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="user-plus"></i></span>
            <span class="rel-kpi-texto"><b id="k-extra">—</b><span>Novos cadastros</span></span>
        </div>
    </div>

    <div class="rel-graficos" id="rel-c"></div>

    <div class="rel-toast" id="toast"><i data-lucide="check-circle-2"></i><span></span></div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.min.js"></script>
<script>
window.RELATORIO = {
    titulo: 'Relatório de usuárias',
    arquivo: 'relatorio-usuarias',
    periodo: false, // números fixos, como no arquivo de referência
    rotulos: ['Total de usuárias', 'Maior grupo', 'Novos cadastros'],
    extra: '+8,2%',
    graficos: [
        { t: 'Faixa etária', s: 'Distribuição das usuárias', rosa: false,
          d: [['14 a 25 anos', 5200], ['26 a 40 anos', 4300], ['41 a 60 anos', 2300], ['Mais de 60', 658]] },
        { t: 'Tipo de perfil', s: 'Quem usa a plataforma', rosa: false,
          d: [['Usuárias', 11240], ['Profissionais', 1230], ['Moderação', 48]] },
        { t: 'Região', s: 'Onde estão cadastradas', rosa: true,
          d: [['Sudeste', 5900], ['Nordeste', 2800], ['Sul', 2000], ['Centro-Oeste', 1100], ['Norte', 658]] }
    ]
};
</script>
<script src="<?php echo e(asset('js/relatorio.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/relatorios/usuarias.blade.php ENDPATH**/ ?>