
<?php
    use Illuminate\Support\Str;
?>



<?php $__env->startSection('title', 'Painel Administrativo'); ?>


<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="vns-painel">


        <header class="vns-header">
            <h1 class="vns-titulo-pagina">Painel Administrativo</h1>

            <div class="vns-data">
                <button type="button" class="vns-data-btn" id="btnCalendario" aria-label="Abrir calendário">
                    <img src="<?php echo e(asset('images/calendar-alt.png')); ?>" alt="">
                </button>
                <span><?php echo e($hoje); ?></span>
            </div>
        </header>

        
        <div class="vns-alerta vns-alerta--danger">
            <div class="vns-alerta-texto">
                <img src="<?php echo e(asset('images/alert-octagon.png')); ?>" alt="">
                <span>
                    <strong>Atenção:</strong>
                    existem <strong><?php echo e($totalDenunciasUltimas24h); ?></strong> denúncias de gravidade alta pendentes há mais de 24 horas.
                </span>
            </div>
            <a href="/denuncias">
                <h2 class="btn-ver-denuncias">Ver Denúncias</h2>
            </a>
        </div>
        


        <div class="vns-grid-estat vns-grid-estat--3">

            <div class="vns-card vns-card-estat">
                <div class="vns-card-icone">
                    <img src="<?php echo e(asset('images/woman.png')); ?>" alt="">
                </div>
                <div class="vns-card-info">
                    
                    <span class="vns-card-numero"><?php echo e($totalUsuarios); ?></span>
                    <p class="vns-card-label">Usuárias Ativas</p>
                    <p class="vns-card-variacao vns-card-variacao--positiva">
                        <span class="vns-seta">&uarr;</span> <?php echo e($percentagem); ?>% último mês
                    </p>
                </div>
            </div>

            <div class="vns-card vns-card-estat">
                <div class="vns-card-icone">
                    <img src="<?php echo e(asset('images/face-mask.png')); ?>" alt="">
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero"><?php echo e($totalProsissionais); ?></span>
                    <p class="vns-card-label">Profissionais ativos</p>
                    <p class="vns-card-variacao vns-card-variacao--positiva">
                        <span class="vns-seta">&uarr;</span> <?php echo e($porcentagemProfissionaisUltimoMes); ?>% último mês
                    </p>
                </div>
            </div>

            <div class="vns-card vns-card-estat">
                <div class="vns-card-icone">
                   <img src="<?php echo e(asset('images/user-plus.png')); ?>" alt="">
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero"><?php echo e($profissionaisEmEspera); ?></span>
                    <p class="vns-card-label">Cadastro aguardando aprovação</p>
                    <p class="vns-card-legenda">Profissional</p>
                </div>
            </div>

        </div>

        <div class="vns-grid-principal">

            <div class="vns-coluna">

                <div class="vns-card vns-card-lista">
                    <h2 class="vns-card-titulo vns-card-titulo--danger">Fila prioritária</h2>
                    <p class="vns-card-subtitulo">Denúncia de alta gravidade</p>

                    <ul class="vns-lista-fila">
                        <?php $__currentLoopData = $DenunciasAltaGravidade; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $denuncia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="vns-item-fila">
                            <span class="vns-item-fila-texto"><?php echo e(Str::limit($denuncia->comentarioDenuncia, 22, '...')); ?></span>
                             <div class="sub-vns-item-fila">
                             <?php if($denuncia->tipoAlvo == 'forum_publicacao' || $denuncia->tipoAlvo == 'forum_resposta'): ?>
                            <span class="vns-badge">Fórum</span>
                            <?php elseif($denuncia->tipoAlvo == 'mensagem_chat'): ?>
                            <span class="vns-badge">Chat</span>
                            <?php else: ?>
                            <span class="vns-badge">Perfil</span>
                            <?php endif; ?>
                            <span class="vns-item-fila-tempo"><?php echo e(\Carbon\Carbon::parse($denuncia->dataDenuncia)->diffForHumans()); ?></span>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <hr>
               
                    <h2 class="vns-card-titulo vns-card-titulo--danger">Aprovações de profissionais</h2>

                    <ul class="vns-lista-aprovacoes">
                        <?php $__currentLoopData = $profissionaisPendentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profissional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="vns-item-aprovacao">
                            <span class="vns-item-aprovacao-nome"><?php echo e($profissional->nomeProfissionalSaude); ?></span>
                            <div class="sub-vns-item-aprovacao">
                                <span class="vns-item-aprovacao-registro">CRP 06/123456</span>
                                <span class="vns-item-aprovacao-tempo"><?php echo e(\Carbon\Carbon::parse($profissional->dataAtualizacao)->diffForHumans()); ?></span>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                
                <a href="">
                    <h1 class="btn-cards">Ver todas as pendências</h1>
                </a>
                </div>

            </div>

            <div class="vns-coluna">

                <div class="vns-card vns-card-grafico">
                    <div class="vns-card-grafico-header">
                        <div>
                            <h2 class="vns-card-titulo">Novos cadastros (usuárias e profissionais)</h2>
                            <p class="vns-card-subtitulo">Últimas 8 semanas</p>
                        </div>

                        <div class="vns-legenda-grafico">
                            <span class="vns-legenda-item">
                                <span class="vns-legenda-cor vns-legenda-cor--claro"></span> Usuárias
                            </span>
                            <span class="vns-legenda-item">
                                <span class="vns-legenda-cor vns-legenda-cor--escuro"></span> Profissionais
                            </span>
                        </div>
                    </div>

                    
<div class="vns-grafico-placeholder">
    <svg viewBox="0 0 700 260" preserveAspectRatio="none" class="vns-grafico-svg">
        <line x1="40" y1="10" x2="40" y2="220" class="vns-grafico-eixo" />
        <line x1="40" y1="220" x2="690" y2="220" class="vns-grafico-eixo" />

        <?php $__currentLoopData = $rotulosEixoY; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <text x="10" y="<?php echo e($r['y'] + 4); ?>" class="vns-grafico-eixo-label"><?php echo e(number_format($r['valor'], 0, ',', '.')); ?></text>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <polyline class="vns-linha-usuarias" fill="none"
            points="<?php echo e(collect($pontosUsuarias)->map(fn($p) => $p['x'].','.$p['y'])->implode(' ')); ?>" />
        <polyline class="vns-linha-profissionais" fill="none"
            points="<?php echo e(collect($pontosProfissionais)->map(fn($p) => $p['x'].','.$p['y'])->implode(' ')); ?>" />

        <g class="vns-pontos-usuarias">
            <?php $__currentLoopData = $pontosUsuarias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <circle cx="<?php echo e($p['x']); ?>" cy="<?php echo e($p['y']); ?>" r="4"><title><?php echo e($p['valor']); ?> usuárias</title></circle>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </g>
        <g class="vns-pontos-profissionais">
            <?php $__currentLoopData = $pontosProfissionais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <circle cx="<?php echo e($p['x']); ?>" cy="<?php echo e($p['y']); ?>" r="4"><title><?php echo e($p['valor']); ?> profissionais</title></circle>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </g>
    </svg>

    <div class="vns-grafico-eixo-x">
        <?php $__currentLoopData = $semanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $semana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span><?php echo e($semana); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
                </div>

                <div class="vns-card vns-card-revisao">
                    <div class="vns-card-icone vns-card-icone--revisao">
                        <img src="<?php echo e(asset('images/file-detail red.png')); ?>" alt="">
                    </div>

                    <div class="vns-card-revisao-info">
                        <h2 class="vns-card-titulo">Conteúdo aguardando revisão</h2>
                        <span class="vns-card-numero"><?php echo e($conteudosAguardandoRevisao); ?></span>

                        <div class="vns-revisao-detalhes">
                            <p class="vns-revisao-legenda">
                                Artigos/Vídeos<br>aguardando moderação
                            </p>
                            <div class="vns-revisao-divisor"></div>
                            <p class="vns-revisao-legenda">
                                5 artigos de profissionais<br>4 vídeos educativos
                            </p>
                        </div>
                    </div>

                    <a href="/Conteudo-Aprender" class="vns-revisao-botao">ir para conteúdos</a>
                </div>


                </div>

            </div>

        </div>

        <div class="vns-grid-estat vns-grid-estat--3 vns-grid-estat--rodape">

            <div class="vns-card vns-card-estat vns-card-estat--centro">
                <div class="vns-card-icone">
                    <img src="<?php echo e(asset('images/clock.png')); ?>" alt="">
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero">2h 45min</span>
                    <p class="vns-card-label">Tempo médio de resposta e dúvidas</p>
                </div>
            </div>

            <div class="vns-card vns-card-estat vns-card-estat--centro">
                <div class="vns-card-icone">
                    <img src="<?php echo e(asset('images/smile.png')); ?>" alt="">
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero">4,6/5</span>
                    <p class="vns-card-label">Satisfação das usuárias (últimos 30 dias)</p>
                </div>
            </div>

            <div class="vns-card vns-card-estat vns-card-estat--centro">
                <div class="vns-card-icone">
                    <img src="<?php echo e(asset('images/flag-alt.png')); ?>" alt="">
                </div>
                <div class="vns-card-info">
                    <span class="vns-card-numero"><?php echo e($DenunciasPendentes); ?></span>
                    <p class="vns-card-label">
                        Denúncias pendentes
                        <span class="vns-card-variacao vns-card-variacao--negativa">&uarr; <?php echo e($DenunciasDesdeOntem); ?> desde ontem</span>
                    </p>
                </div>
            </div>

        </div>



        
<div class="vns-cal-overlay" id="calOverlay" hidden>
    <div class="vns-cal" role="dialog" aria-modal="true" aria-label="Calendário">
        <div class="vns-cal-topo">
            <button type="button" class="vns-cal-nav" id="calAnterior" aria-label="Mês anterior">&lsaquo;</button>
            <strong id="calTitulo"></strong>
            <button type="button" class="vns-cal-nav" id="calProximo" aria-label="Próximo mês">&rsaquo;</button>
            <button type="button" class="vns-cal-fechar" id="calFechar" aria-label="Fechar">&times;</button>
        </div>

        <div class="vns-cal-semana">
            <span>Dom</span><span>Seg</span><span>Ter</span><span>Qua</span><span>Qui</span><span>Sex</span><span>Sáb</span>
        </div>

        <div class="vns-cal-dias" id="calDias"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var overlay = document.getElementById('calOverlay');
    var titulo  = document.getElementById('calTitulo');
    var dias    = document.getElementById('calDias');
    var meses   = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];

    var hoje = new Date();
    var ano  = hoje.getFullYear();
    var mes  = hoje.getMonth();

    function desenhar() {
        titulo.textContent = meses[mes] + ' ' + ano;
        dias.innerHTML = '';

        var primeiroDia = new Date(ano, mes, 1).getDay();
        var totalDias   = new Date(ano, mes + 1, 0).getDate();

        for (var i = 0; i < primeiroDia; i++) {
            dias.appendChild(document.createElement('span'));
        }

        for (var d = 1; d <= totalDias; d++) {
            var el = document.createElement('span');
            el.textContent = d;
            el.className = 'vns-cal-dia';
            if (d === hoje.getDate() && mes === hoje.getMonth() && ano === hoje.getFullYear()) {
                el.classList.add('vns-cal-hoje');
            }
            dias.appendChild(el);
        }
    }

    function abrir() {
        ano = hoje.getFullYear();
        mes = hoje.getMonth();
        desenhar();
        overlay.hidden = false;
    }

    function fechar() {
        overlay.hidden = true;
    }

    document.getElementById('btnCalendario').addEventListener('click', abrir);
    document.getElementById('calFechar').addEventListener('click', fechar);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) fechar();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') fechar();
    });

    document.getElementById('calAnterior').addEventListener('click', function () {
        mes--;
        if (mes < 0) { mes = 11; ano--; }
        desenhar();
    });

    document.getElementById('calProximo').addEventListener('click', function () {
        mes++;
        if (mes > 11) { mes = 0; ano++; }
        desenhar();
    });
});
</script>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/admin/painel.blade.php ENDPATH**/ ?>