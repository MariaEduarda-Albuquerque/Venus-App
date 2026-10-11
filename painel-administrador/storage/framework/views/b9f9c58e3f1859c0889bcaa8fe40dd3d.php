

<?php $__env->startSection('titulo', 'Aprovação de Cadastros - Painel Administrativo - Vênus'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/listas.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<?php
    $urlAnalisar = url('/aprovar-cadastro');
?>

<div class="lst-page">

    
    <div class="lst-topo">
        <div>
            <h1>Aprovação de cadastros</h1>
            <p class="lst-mute">Valide o número de conselho de cada profissional antes de liberar o acesso.</p>
        </div>
    </div>

    
    <div class="lst-kpis">
        <button type="button" class="lst-card lst-kpi is-active" data-aba="p" aria-pressed="true"
                title="Mostrar os pendentes">
            <span class="lst-icone"><i data-lucide="user-check"></i></span>
            <span class="lst-kpi-texto"><b id="ap-total-p">5</b><span class="lst-kpi-rotulo">Aguardando análise</span></span>
        </button>

        <button type="button" class="lst-card lst-kpi" data-aba="r" aria-pressed="false"
                title="Mostrar os reenvios solicitados">
            <span class="lst-icone lst-icone--amarelo"><i data-lucide="rotate-ccw"></i></span>
            <span class="lst-kpi-texto"><b id="ap-total-r">1</b><span class="lst-kpi-rotulo">Reenvio solicitado</span></span>
        </button>

        <button type="button" class="lst-card lst-kpi" data-aba="a" aria-pressed="false"
                title="Mostrar os aprovados">
            <span class="lst-icone lst-icone--verde"><i data-lucide="badge-check"></i></span>
            <span class="lst-kpi-texto"><b id="ap-total-a">1</b><span class="lst-kpi-rotulo">Aprovados</span></span>
        </button>

        <div class="lst-card lst-kpi lst-kpi--info">
            <span class="lst-icone"><i data-lucide="clock"></i></span>
            <span class="lst-kpi-texto"><b>3h 12min</b><span class="lst-kpi-rotulo">Tempo médio de análise</span></span>
        </div>
    </div>

    
    <div class="lst-card lst-espaco">
        <div class="lst-barra">
            <div class="lst-abas">
                <button type="button" class="lst-aba is-active" data-aba="p" aria-pressed="true">
                    Pendentes<span class="lst-aba-badge" id="ap-badge-p">5</span>
                </button>
                <button type="button" class="lst-aba" data-aba="r" aria-pressed="false">Reenvio</button>
                <button type="button" class="lst-aba" data-aba="a" aria-pressed="false">Aprovados</button>
                <button type="button" class="lst-aba" data-aba="x" aria-pressed="false">Reprovados</button>
            </div>

            <div class="lst-abas lst-abas--fim" aria-label="Filtrar por conselho">
                <button type="button" class="lst-aba is-active" data-conselho-filtro="" aria-pressed="true">Todos</button>
                <button type="button" class="lst-aba" data-conselho-filtro="CRM" aria-pressed="false">CRM</button>
                <button type="button" class="lst-aba" data-conselho-filtro="CRP" aria-pressed="false">CRP</button>
                <button type="button" class="lst-aba" data-conselho-filtro="COREN" aria-pressed="false">COREN</button>
                <button type="button" class="lst-aba" data-conselho-filtro="CRESS" aria-pressed="false">CRESS</button>
            </div>

            <label class="lst-busca">
                <i data-lucide="search"></i>
                <input type="search" id="ap-busca" placeholder="Nome ou nº de conselho…" aria-label="Pesquisar cadastros">
            </label>
        </div>

        
        <div class="lst-lote" id="ap-lote">
            <b class="lst-lote-texto" id="ap-lote-n"></b>
            <button type="button" class="lst-btn lst-btn--pequeno lst-btn--contorno" data-lote="reenvio">
                <i data-lucide="rotate-ccw"></i>Solicitar reenvio
            </button>
            <button type="button" class="lst-btn lst-btn--pequeno" data-lote="aprovar">
                <i data-lucide="check"></i>Aprovar selecionados
            </button>
        </div>

        <div class="lst-tabela-wrap">
            <table class="lst-tabela lst-tabela--larga">
                <thead>
                    <tr>
                        <th class="lst-col-chk">
                            <input type="checkbox" class="lst-chk" id="ap-todos" aria-label="Selecionar todos">
                        </th>
                        <th>Profissional</th>
                        <th>Conselho</th>
                        <th>Especialidade</th>
                        <th>Aguardando</th>
                        <th>Status</th>
                        <th><span class="lst-mute">Ação</span></th>
                    </tr>
                </thead>

                
                                <tbody id="ap-corpo">
                    <tr data-id="PR1038" data-status="p" data-conselho="CRESS" data-nome="Luciana Prado" data-numero="34.221 (9ª)">
                        <td><input type="checkbox" class="lst-chk" data-selecionar="PR1038" aria-label="Selecionar Luciana Prado"></td>
                        <td>
                            <div class="lst-pessoa">
                                <div class="lst-avatar">L</div>
                                <div><b>Luciana Prado</b><span class="lst-mute">luciana.prado@email.com</span></div>
                            </div>
                        </td>
                        <td><span class="lst-conselho">CRESS 34.221 (9ª)</span></td>
                        <td>Serviço social</td>
                        <td data-espera><span class="lst-atraso"><i data-lucide="triangle-alert"></i>2 dias</span></td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><a href="<?php echo e($urlAnalisar); ?>" class="lst-btn lst-btn--primario lst-btn--pequeno">Analisar</a></td>
                    </tr>
                    <tr data-id="PR1039" data-status="p" data-conselho="CRM" data-nome="Dr. Rafael Teixeira" data-numero="98211-RJ">
                        <td><input type="checkbox" class="lst-chk" data-selecionar="PR1039" aria-label="Selecionar Dr. Rafael Teixeira"></td>
                        <td>
                            <div class="lst-pessoa">
                                <div class="lst-avatar">R</div>
                                <div><b>Dr. Rafael Teixeira</b><span class="lst-mute">rafael.teixeira@email.com</span></div>
                            </div>
                        </td>
                        <td><span class="lst-conselho">CRM 98211-RJ</span></td>
                        <td>Infectologia</td>
                        <td data-espera><span class="lst-atraso"><i data-lucide="triangle-alert"></i>1 dia</span></td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><a href="<?php echo e($urlAnalisar); ?>" class="lst-btn lst-btn--primario lst-btn--pequeno">Analisar</a></td>
                    </tr>
                    <tr data-id="PR1037" data-status="r" data-conselho="CRP" data-nome="Dra. Bianca Furtado" data-numero="05/88231">
                        <td><input type="checkbox" class="lst-chk" data-selecionar="PR1037" aria-label="Selecionar Dra. Bianca Furtado" disabled></td>
                        <td>
                            <div class="lst-pessoa">
                                <div class="lst-avatar">B</div>
                                <div><b>Dra. Bianca Furtado</b><span class="lst-mute">bianca.furtado@email.com</span></div>
                            </div>
                        </td>
                        <td><span class="lst-conselho">CRP 05/88231</span></td>
                        <td>Psicologia</td>
                        <td data-espera>20h</td>
                        <td><span class="lst-status lst-status--reenvio">Reenvio solicitado</span></td>
                        <td><a href="<?php echo e($urlAnalisar); ?>" class="lst-btn lst-btn--neutro lst-btn--pequeno">Ver</a></td>
                    </tr>
                    <tr data-id="PR1040" data-status="p" data-conselho="COREN" data-nome="Dra. Ana Lima" data-numero="412908-SP">
                        <td><input type="checkbox" class="lst-chk" data-selecionar="PR1040" aria-label="Selecionar Dra. Ana Lima"></td>
                        <td>
                            <div class="lst-pessoa">
                                <div class="lst-avatar">A</div>
                                <div><b>Dra. Ana Lima</b><span class="lst-mute">ana.lima@email.com</span></div>
                            </div>
                        </td>
                        <td><span class="lst-conselho">COREN 412908-SP</span></td>
                        <td>Enfermagem obstétrica</td>
                        <td data-espera>8h</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><a href="<?php echo e($urlAnalisar); ?>" class="lst-btn lst-btn--primario lst-btn--pequeno">Analisar</a></td>
                    </tr>
                    <tr data-id="PR1041" data-status="p" data-conselho="CRM" data-nome="Dra. Camila Souza" data-numero="123456-SP">
                        <td><input type="checkbox" class="lst-chk" data-selecionar="PR1041" aria-label="Selecionar Dra. Camila Souza"></td>
                        <td>
                            <div class="lst-pessoa">
                                <div class="lst-avatar">C</div>
                                <div><b>Dra. Camila Souza</b><span class="lst-mute">camila.souza@email.com</span></div>
                            </div>
                        </td>
                        <td><span class="lst-conselho">CRM 123456-SP</span></td>
                        <td>Ginecologia e obstetrícia</td>
                        <td data-espera>5h</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><a href="<?php echo e($urlAnalisar); ?>" class="lst-btn lst-btn--primario lst-btn--pequeno">Analisar</a></td>
                    </tr>
                    <tr data-id="PR1042" data-status="p" data-conselho="CRP" data-nome="Dra. Juliana Mendes" data-numero="06/123456">
                        <td><input type="checkbox" class="lst-chk" data-selecionar="PR1042" aria-label="Selecionar Dra. Juliana Mendes"></td>
                        <td>
                            <div class="lst-pessoa">
                                <div class="lst-avatar">J</div>
                                <div><b>Dra. Juliana Mendes</b><span class="lst-mute">juliana.mendes@email.com</span></div>
                            </div>
                        </td>
                        <td><span class="lst-conselho">CRP 06/123456</span></td>
                        <td>Psicologia clínica</td>
                        <td data-espera>2h</td>
                        <td><span class="lst-status lst-status--pendente">Pendente</span></td>
                        <td><a href="<?php echo e($urlAnalisar); ?>" class="lst-btn lst-btn--primario lst-btn--pequeno">Analisar</a></td>
                    </tr>
                    <tr data-id="PR1036" data-status="a" data-conselho="CRM" data-nome="Dra. Helena Rocha" data-numero="77412-MG">
                        <td><input type="checkbox" class="lst-chk" data-selecionar="PR1036" aria-label="Selecionar Dra. Helena Rocha" disabled></td>
                        <td>
                            <div class="lst-pessoa">
                                <div class="lst-avatar">H</div>
                                <div><b>Dra. Helena Rocha</b><span class="lst-mute">helena.rocha@email.com</span></div>
                            </div>
                        </td>
                        <td><span class="lst-conselho">CRM 77412-MG</span></td>
                        <td>Dermatologia</td>
                        <td data-espera>—</td>
                        <td><span class="lst-status lst-status--ok">Aprovado</span></td>
                        <td><a href="<?php echo e($urlAnalisar); ?>" class="lst-btn lst-btn--neutro lst-btn--pequeno">Ver</a></td>
                    </tr>
                    <tr data-id="PR1035" data-status="x" data-conselho="COREN" data-nome="Marcos Vieira" data-numero="000812-SP">
                        <td><input type="checkbox" class="lst-chk" data-selecionar="PR1035" aria-label="Selecionar Marcos Vieira" disabled></td>
                        <td>
                            <div class="lst-pessoa">
                                <div class="lst-avatar">M</div>
                                <div><b>Marcos Vieira</b><span class="lst-mute">marcos.vieira@email.com</span></div>
                            </div>
                        </td>
                        <td><span class="lst-conselho">COREN 000812-SP</span></td>
                        <td>Enfermagem</td>
                        <td data-espera>—</td>
                        <td><span class="lst-status">Reprovado</span></td>
                        <td><a href="<?php echo e($urlAnalisar); ?>" class="lst-btn lst-btn--neutro lst-btn--pequeno">Ver</a></td>
                    </tr>

                    <tr id="ap-vazio" hidden>
                        <td colspan="7" class="lst-vazio"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="lst-modal" id="ap-modal" role="dialog" aria-modal="true" aria-labelledby="ap-modal-titulo">
        <div class="lst-card lst-modal-caixa">

            <div class="lst-modal-cabeca">
                <div class="lst-icone" id="ap-modal-icone"></div>
                <h3 id="ap-modal-titulo"></h3>
                <p id="ap-modal-texto"></p>
            </div>

            <div id="ap-motivo-bloco" hidden>
                <div class="lst-rapidas">
                    <button type="button" data-motivo="Documento ilegível">Documento ilegível</button>
                    <button type="button" data-motivo="Número divergente">Número divergente</button>
                    <button type="button" data-motivo="Documento vencido">Documento vencido</button>
                    <button type="button" data-motivo="Foto não confere">Foto não confere</button>
                </div>
                <div class="lst-escrever" id="ap-motivo-caixa">
                    <textarea id="ap-motivo" placeholder="Descreva o motivo (obrigatório)…" aria-label="Motivo"></textarea>
                </div>
                <span class="lst-erro-msg">Escreva o motivo com pelo menos 10 caracteres.</span>
            </div>

            <div class="lst-acoes">
                <button type="button" class="lst-btn lst-btn--neutro" data-fechar>Cancelar</button>
                <button type="button" class="lst-btn" id="ap-confirmar"></button>
            </div>
        </div>
    </div>

    
    <div class="lst-toast" id="ap-toast" role="status" aria-live="polite">
        <i data-lucide="check-circle-2"></i><span></span>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/aprovacao-cadastros.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/usuario/aprovar-cadastros.blade.php ENDPATH**/ ?>