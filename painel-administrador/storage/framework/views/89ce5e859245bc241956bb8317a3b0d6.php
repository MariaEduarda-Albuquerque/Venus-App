

<?php $__env->startSection('titulo', 'Relatório - Painel Administrativo - Vênus'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/relatorios.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="rel-page">

    <div class="rel-topo">
        <h1>Relatório da plataforma</h1>

        <div class="rel-acoes">
            <button type="button" class="rel-btn" id="btn-pdf">
                <i data-lucide="download"></i>Baixar PDF
            </button>

            <button type="button" class="rel-btn" id="btn-planilha">
                <i data-lucide="file-spreadsheet"></i>Baixar planilha
            </button>

            <select class="rel-select" id="rel-p" aria-label="Período"
                    onchange="window.location = '?periodo=' + this.value">
                <option value="30"  <?php if($periodo == 30): echo 'selected'; endif; ?>>Últimos 30 dias</option>
                <option value="90"  <?php if($periodo == 90): echo 'selected'; endif; ?>>Últimos 90 dias</option>
                <option value="365" <?php if($periodo == 365): echo 'selected'; endif; ?>>Último ano</option>
            </select>
        </div>
    </div>

    <div class="rel-kpis">
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="user-plus"></i></span>
            <span class="rel-kpi-texto"><b id="k-total">0</b><span>Novos cadastros</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="trending-up"></i></span>
            <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">—</b><span>Maior grupo de cadastros</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="file-text"></i></span>
            <span class="rel-kpi-texto"><b id="k-extra">—</b><span>Conteúdos publicados</span></span>
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
    titulo: 'Relatório da plataforma',
    arquivo: 'relatorio-plataforma',
    periodo: false,   // o servidor já filtra, o JS não multiplica de novo
    rotulos: ['Novos cadastros', 'Maior grupo de cadastros', 'Conteúdos publicados'],
    extra: '<?php echo e($conteudosPublicados); ?>',
    graficos: [
        { t: 'Novos cadastros', s: 'Usuárias e profissionais no período', rosa: false,
          d: [['Usuárias', <?php echo e($novasUsuarias); ?>], ['Profissionais', <?php echo e($novosProfissionais); ?>]] },
        { t: 'Evolução dos cadastros', s: '<?php echo e($periodo == 365 ? 'Cadastros por mês' : 'Cadastros por semana (data de início da semana)'); ?>',
          tipo: 'linha', colunas: ['Período', 'Usuárias', 'Profissionais'],
          d: <?php echo json_encode($evolucaoCadastros, 15, 512) ?> },
        { t: 'Conteúdos por status', s: 'Conteúdos criados no período', rosa: false,
          d: <?php echo json_encode($conteudosPorStatus, 15, 512) ?> },
        { t: 'Profissionais por especialidade', s: 'Contas ativas hoje (não muda com o período)', rosa: true,
          colunas: ['Especialidade', 'Profissionais'],
          d: <?php echo json_encode($especialidades, 15, 512) ?> },
        { t: 'Usuárias por região', s: 'Contas ativas hoje (não muda com o período)', rosa: true,
          colunas: ['Região', 'Usuárias'],
          d: <?php echo json_encode($usuariasPorRegiao, 15, 512) ?> }
    ]
};
</script>
<script src="<?php echo e(asset('js/relatorio.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/painel/relatorio.blade.php ENDPATH**/ ?>