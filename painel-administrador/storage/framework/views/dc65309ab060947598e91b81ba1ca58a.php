

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/relatorios.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="rel-page">

    <div class="rel-topo">
        <h1>Relatório de atendimento</h1>

        <div class="rel-acoes">
            <button type="button" class="rel-btn" id="btn-pdf">
                <i data-lucide="download"></i>Baixar PDF
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
            <span class="rel-icone"><i data-lucide="headset"></i></span>
            <span class="rel-kpi-texto"><b id="k-total">0</b><span>Chamados atendidos</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="trending-up"></i></span>
            <span class="rel-kpi-texto"><b id="k-grupo" class="rel-kpi-texto-menor">—</b><span>Canal mais usado</span></span>
        </div>
        <div class="rel-card rel-kpi">
            <span class="rel-icone"><i data-lucide="smile"></i></span>
            <span class="rel-kpi-texto"><b id="k-extra">—</b><span>Satisfação média</span></span>
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
    titulo: 'Relatório de atendimento',
    arquivo: 'relatorio-atendimento',
    periodo: false,   // o servidor já filtra, o JS não multiplica de novo
    rotulos: ['Chamados atendidos', 'Canal mais usado', 'Satisfação média'],
    extra: '<?php echo e($avaliacaoMedia); ?> / 5',
    graficos: [
        { t: 'Canais de atendimento', s: 'Por onde as usuárias nos procuram', rosa: false,
          d: [['Chat', <?php echo e($canalAtendimentoChat); ?>], ['E-mail', <?php echo e($canalAtendimentoEmail); ?>],
              ['Formulário', <?php echo e($canalAtendimentoForm); ?>], ['Telefone', <?php echo e($canalAtendimentoTel); ?>]] },
        { t: 'Motivos dos chamados', s: 'Assuntos mais comuns', rosa: true,
          d: [['Dúvidas de uso', <?php echo e($motivoChamadoDuvida); ?>], ['Acesso e senha', <?php echo e($motivoChamadoAcessoAsenha); ?>],
              ['Erros técnicos', <?php echo e($motivoChamadoErroTecnico); ?>], ['Conta e dados', <?php echo e($motivoChamadoDadosConta); ?>],
              ['Sugestões', <?php echo e($motivoChamadoSugestoes); ?>]] },
        { t: 'Satisfação com o atendimento', s: 'Avaliações recebidas', rosa: false,
          d: [['Muito satisfeita', <?php echo e($avaliacaoMuitoSatisfeita); ?>], ['Satisfeita', <?php echo e($avaliacaoSatisfeita); ?>],
              ['Neutra', <?php echo e($avaliacaoNeutra); ?>], ['Insatisfeita', <?php echo e($avaliacaoInsatisfeita); ?>]] }
    ]
};
</script>
<script src="<?php echo e(asset('js/relatorio.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/relatorios/atendimento.blade.php ENDPATH**/ ?>