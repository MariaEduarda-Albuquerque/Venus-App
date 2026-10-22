

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/relatorios.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="rel-page">

    <div class="rel-topo">
        <h1>Relatório de denúncias</h1>

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
            <span class="rel-icone"><i data-lucide="flag"></i></span>
            <span class="rel-kpi-texto"><b id="k-total">0</b><span>Total de denúncias</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="trending-up"></i></span>
            <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">—</b><span>Mais frequente</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="target"></i></span>
            <span class="rel-kpi-texto"><b id="k-extra">—</b><span>Variação no período</span></span>
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
    titulo: 'Relatório de denúncias',
    arquivo: 'relatorio-denuncias',
    periodo: false,
    rotulos: ['Total de denúncias', 'Mais frequente', 'Variação no período'],
    extra: '<?php echo e($variacaoPeriodo > 0 ? "+" : ""); ?><?php echo e($variacaoPeriodo); ?>%',
    graficos: [
        { t: 'Denúncias por tipo', s: 'Onde ocorreram', rosa: true,
          d: [['Publicação no fórum', <?php echo e($denunciasTipoFP); ?>], ['Resposta no fórum', <?php echo e($denunciasTipoFR); ?>],
              ['Mensagem no chat', <?php echo e($denunciasTipoMC); ?>], ['Perfil profissional', <?php echo e($denunciasTipoPP); ?>]] },
        { t: 'Denúncias por status', s: 'Situação atual', rosa: false,
          d: [['Pendentes', <?php echo e($denunciasStatusPendente); ?>], ['Em análise', <?php echo e($denunciasStatusEmAnalise); ?>],
              ['Resolvidas', <?php echo e($denunciasStatusResolvida); ?>], ['Arquivadas', <?php echo e($denunciasStatusArquivada); ?>]] },
        { t: 'Denúncias por gravidade', s: 'Nível de risco', rosa: false,
          d: [['Baixa', <?php echo e($denunciasGravidadeBaixa); ?>], ['Média', <?php echo e($denunciasGravidadeMedia); ?>], ['Alta', <?php echo e($denunciasGravidadeAlta); ?>]] }
    ]
};
</script>
<script src="<?php echo e(asset('js/relatorio.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/relatorios/denuncias.blade.php ENDPATH**/ ?>