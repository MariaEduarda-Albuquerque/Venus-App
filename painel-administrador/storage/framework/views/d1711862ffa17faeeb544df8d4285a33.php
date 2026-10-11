

<?php $__env->startSection('titulo', 'Analisar cadastro - Painel Administrativo - Vênus'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/listas.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<?php
    $urlLista = url('/aprovar-cadastros'); // tela com a lista de cadastros
    $urlAnterior = null;                      // cadastro anterior da fila (null = botão desativado; este é o 1º da fila)
    $urlProximo = url('/aprovar-cadastro');   // próximo cadastro da fila (por enquanto a mesma tela, pois só existe uma)
?>

<div class="lst-page">

    
    <div class="lst-cabeca">
        <a href="<?php echo e($urlLista); ?>" class="lst-btn lst-btn--neutro lst-btn--pequeno">
            <i data-lucide="arrow-left"></i>Voltar à fila
        </a>

        <div class="lst-fila">
            <span class="lst-mute">1 de 5 na fila</span>

            
            <?php if($urlAnterior): ?>
                <a href="<?php echo e($urlAnterior); ?>" class="lst-nav-btn" aria-label="Anterior"><i data-lucide="chevron-left"></i></a>
            <?php else: ?>
                <span class="lst-nav-btn" aria-disabled="true" aria-label="Anterior"><i data-lucide="chevron-left"></i></span>
            <?php endif; ?>

            
            <?php if($urlProximo): ?>
                <a href="<?php echo e($urlProximo); ?>" class="lst-nav-btn" aria-label="Próximo"><i data-lucide="chevron-right"></i></a>
            <?php else: ?>
                <span class="lst-nav-btn" aria-disabled="true" aria-label="Próximo"><i data-lucide="chevron-right"></i></span>
            <?php endif; ?>
        </div>
    </div>

    
    <ol class="lst-etapas" aria-label="Passos da análise">
        <li class="lst-etapa is-on" id="dc-passo-0"><span class="lst-etapa-num" id="dc-passo-num-0">1</span>Ver os 3 documentos</li>
        <li class="lst-etapa" id="dc-passo-1"><span class="lst-etapa-num" id="dc-passo-num-1">2</span>Consultar o conselho</li>
        <li class="lst-etapa" id="dc-passo-2"><span class="lst-etapa-num" id="dc-passo-num-2">3</span>Conferir o checklist</li>
        <li class="lst-etapa" id="dc-passo-3"><span class="lst-etapa-num" id="dc-passo-num-3">4</span>Decidir</li>
    </ol>

    <div class="lst-detalhe">

        
        <div class="lst-pilha">

            
            <div class="lst-hero">
                <div class="lst-hero-topo">
                    <div class="lst-hero-avatar">L</div>
                    <div class="lst-hero-info">
                        <h1 id="dc-nome">Luciana Prado</h1>
                        <div class="lst-hero-sub">Serviço social · Osasco, SP</div>
                        <div class="lst-pilulas">
                            <span class="lst-pilula lst-pilula--branca"><i data-lucide="id-card"></i>CRESS 34.221 (9ª)</span>
                            <span class="lst-pilula"><i data-lucide="clock"></i>Enviado há 2 dias</span>
                            <span class="lst-pilula"><i data-lucide="video"></i>Online + Presencial</span>
                        </div>
                    </div>
                    <span class="lst-pilula lst-pilula--branca lst-pilula--grande">Pendente</span>
                </div>
            </div>

            
            <div class="lst-card">
                <div class="lst-card-topo">
                    <h3 class="lst-card-titulo">Documentos enviados</h3>
                    <div class="lst-abas">
                        <button type="button" class="lst-aba is-active" id="dc-aba-0" onclick="abrirDocumento(0)">Carteira do conselho</button>
                        <button type="button" class="lst-aba" id="dc-aba-1" onclick="abrirDocumento(1)">Documento com foto</button>
                        <button type="button" class="lst-aba" id="dc-aba-2" onclick="abrirDocumento(2)">Comprovante</button>
                    </div>
                </div>

                <div class="lst-palco" id="dc-palco">

                    
                    <div class="lst-papel" id="dc-doc-0">
                        <div class="lst-papel-faixa lst-papel-faixa--vinho"><span>CONSELHO REGIONAL DE SERVIÇO SOCIAL</span><span>CRESS</span></div>
                        <div class="lst-papel-corpo">
                            <div class="lst-papel-foto"><i data-lucide="user-round"></i></div>
                            <dl>
                                <div><dt>Nome</dt><dd>LUCIANA PRADO</dd></div>
                                <div><dt>Inscrição</dt><dd>34.221 (9ª)</dd></div>
                                <div><dt>Categoria</dt><dd>Serviço Social</dd></div>
                                <div><dt>Validade</dt><dd>12/2028</dd></div>
                            </dl>
                        </div>
                        <div class="lst-papel-qr"></div>
                        <div class="lst-papel-holo"></div>
                    </div>

                    
                    <div class="lst-papel" id="dc-doc-1" hidden>
                        <div class="lst-papel-faixa lst-papel-faixa--cinza"><span>REPÚBLICA FEDERATIVA DO BRASIL</span><span>IDENTIDADE</span></div>
                        <div class="lst-papel-corpo">
                            <div class="lst-papel-foto"><i data-lucide="user-round"></i></div>
                            <dl>
                                <div><dt>Nome</dt><dd>LUCIANA PRADO</dd></div>
                                <div><dt>CPF</dt><dd>***.174.730-**</dd></div>
                                <div><dt>Nascimento</dt><dd>14/03/1990</dd></div>
                                <div><dt>Órgão emissor</dt><dd>SSP-SP</dd></div>
                            </dl>
                        </div>
                        <div class="lst-papel-holo"></div>
                    </div>

                    
                    <div class="lst-papel" id="dc-doc-2" hidden>
                        <div class="lst-papel-faixa lst-papel-faixa--verde"><span>CERTIDÃO DE REGULARIDADE</span><span>CFESS</span></div>
                        <div class="lst-papel-linhas">
                            <i style="width:70%"></i><i style="width:90%"></i><i style="width:55%"></i><i style="width:80%"></i><i style="width:40%"></i>
                        </div>
                        <div class="lst-papel-carimbo">REGULAR</div>
                    </div>

                    
                    <div class="lst-ferramentas">
                        <button type="button" class="lst-ferr-btn" onclick="diminuirZoom()" aria-label="Diminuir zoom"><i data-lucide="zoom-out"></i></button>
                        <span id="dc-zoom-texto">100%</span>
                        <button type="button" class="lst-ferr-btn" onclick="aumentarZoom()" aria-label="Aumentar zoom"><i data-lucide="zoom-in"></i></button>
                        <button type="button" class="lst-ferr-btn" onclick="girarDocumento()" aria-label="Girar"><i data-lucide="rotate-cw"></i></button>
                    </div>
                </div>
            </div>

            
            <div class="lst-card">
                <h3 class="lst-card-titulo">Dados do cadastro <span class="lst-mute">· somente leitura</span></h3>
                <div class="lst-dados">
                    <div><span class="lst-dados-rotulo">Nome completo</span><b>Luciana Prado</b></div>
                    <div><span class="lst-dados-rotulo">CPF</span><b>***.174.730-**</b></div>
                    <div><span class="lst-dados-rotulo">E-mail</span><b>luciana.prado@email.com</b></div>
                    <div><span class="lst-dados-rotulo">Telefone</span><b>11 99269-5495</b></div>
                    <div><span class="lst-dados-rotulo">Cidade</span><b>Osasco, SP</b></div>
                    <div><span class="lst-dados-rotulo">Especialidade</span><b>Serviço social</b></div>
                    <div><span class="lst-dados-rotulo">Nº de conselho</span><b>CRESS 34.221 (9ª)</b></div>
                    <div><span class="lst-dados-rotulo">Atendimento</span><b>Online, Presencial</b></div>
                </div>
            </div>

            
            <div class="lst-card">
                <h3 class="lst-card-titulo">Histórico de tentativas</h3>
                <div class="lst-linha-tempo">
                    <div>
                        <b>Reenvio solicitado: foto da carteira cortada.</b>
                        <div class="lst-mute">12/05/2026 · tentativa anterior</div>
                    </div>
                    <div>
                        <b>Cadastro enviado há 2 dias</b>
                        <div class="lst-mute">Tentativa 2 · 3 documentos anexados</div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="lst-lateral">

            
            <div class="lst-card">
                <div class="lst-card-topo">
                    <h3 class="lst-card-titulo">Verificação externa</h3>
                    <span class="lst-selo">CFESS</span>
                </div>

                <div class="lst-pessoa lst-pessoa--espaco">
                    <div class="lst-avatar">C</div>
                    <div>
                        <b>CRESS <span id="dc-numero">34.221 (9ª)</span></b>
                        <span class="lst-mute">Conselho Regional de Serviço Social</span>
                    </div>
                    <button type="button" class="lst-icone-btn lst-pessoa-fim" onclick="copiarNumero()" aria-label="Copiar número">
                        <i data-lucide="copy"></i>
                    </button>
                </div>

                <a href="https://www.cfess.org.br/" target="_blank" rel="noopener"
                   class="lst-btn lst-btn--primario lst-btn--grande" onclick="abrirConsulta()">
                    <i data-lucide="external-link"></i>Abrir consulta pública
                </a>
                <p class="lst-mute lst-dica" id="dc-consulta-dica">Confirme nome, número e situação no site oficial.</p>
            </div>

            
            <div class="lst-card">
                <div class="lst-checklist-topo">
                    <div class="lst-anel" id="dc-anel">
                        <svg viewBox="0 0 84 84" aria-hidden="true">
                            <circle class="lst-anel-trilha" cx="42" cy="42" r="36" fill="none" stroke-width="8"/>
                            <circle class="lst-anel-progresso" id="dc-anel-progresso" cx="42" cy="42" r="36" fill="none"
                                    stroke-width="8" stroke-linecap="round" stroke-dasharray="0 226.2"/>
                        </svg>
                        <b id="dc-anel-texto">0/5</b>
                    </div>
                    <div>
                        <h3 class="lst-card-titulo">Checklist de verificação</h3>
                        <div class="lst-mute">Marque cada item após conferir.</div>
                    </div>
                </div>

                
                <label class="lst-item-check" id="dc-item-0">
                    <input type="checkbox" id="dc-check-0" onchange="atualizarTela()">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span><b>Nome confere com o documento</b><small>Compare o nome da carteira com o cadastro</small></span>
                </label>
                <label class="lst-item-check" id="dc-item-1">
                    <input type="checkbox" id="dc-check-1" onchange="atualizarTela()">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span><b>Número confere na consulta pública</b><small>Busque no site oficial do conselho</small></span>
                </label>
                <label class="lst-item-check" id="dc-item-2">
                    <input type="checkbox" id="dc-check-2" onchange="atualizarTela()">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span><b>Situação ativa e regular</b><small>Sem suspensão ou cassação</small></span>
                </label>
                <label class="lst-item-check" id="dc-item-3">
                    <input type="checkbox" id="dc-check-3" onchange="atualizarTela()">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span><b>Documento legível e válido</b><small>Imagem nítida e dentro da validade</small></span>
                </label>
                <label class="lst-item-check" id="dc-item-4">
                    <input type="checkbox" id="dc-check-4" onchange="atualizarTela()">
                    <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                    <span><b>Especialidade compatível</b><small>Igual à informada no cadastro</small></span>
                </label>

                
                <div class="lst-botoes-decisao">
                    <button type="button" class="lst-btn lst-btn--ok lst-btn--grande" id="dc-aprovar"
                            onclick="abrirModalDecisao('aprovar')" disabled>
                        <i data-lucide="badge-check"></i>Aprovar cadastro
                    </button>

                    <div class="lst-decisao lst-decisao--solta">
                        <button type="button" class="lst-btn lst-btn--neutro" onclick="abrirModalDecisao('reenvio')">
                            <i data-lucide="rotate-ccw"></i>Solicitar reenvio
                        </button>
                        <button type="button" class="lst-btn lst-btn--perigo" onclick="abrirModalDecisao('reprovar')">
                            <i data-lucide="user-x"></i>Reprovar
                        </button>
                    </div>

                    <p class="lst-mute lst-dica lst-dica--centro" id="dc-faltam">Faltam 5 itens do checklist para liberar a aprovação.</p>
                </div>

                
            </div>
        </div>
    </div>

    
    <div class="lst-modal" id="dc-modal" role="dialog" aria-modal="true" aria-labelledby="dc-modal-titulo">
        
        <div class="lst-modal-fundo" onclick="fecharModalDecisao()"></div>

        <div class="lst-card lst-modal-caixa lst-modal-caixa--acima">

            <div class="lst-modal-cabeca">
                
                <div class="lst-icone lst-icone--verde" id="dc-icone-aprovar"><i data-lucide="badge-check"></i></div>
                <div class="lst-icone" id="dc-icone-reenvio" hidden><i data-lucide="rotate-ccw"></i></div>
                <div class="lst-icone" id="dc-icone-reprovar" hidden><i data-lucide="user-x"></i></div>

                <h3 id="dc-modal-titulo"></h3>
                <p id="dc-modal-texto"></p>
            </div>

            
            <div id="dc-motivo-bloco" hidden>
                <div class="lst-rapidas" id="dc-motivos-reenvio" hidden>
                    <button type="button" onclick="usarMotivo('Documento ilegível')">Documento ilegível</button>
                    <button type="button" onclick="usarMotivo('Número divergente')">Número divergente</button>
                    <button type="button" onclick="usarMotivo('Documento vencido')">Documento vencido</button>
                    <button type="button" onclick="usarMotivo('Foto não confere')">Foto não confere</button>
                </div>
                <div class="lst-rapidas" id="dc-motivos-reprovar" hidden>
                    <button type="button" onclick="usarMotivo('Número não localizado')">Número não localizado</button>
                    <button type="button" onclick="usarMotivo('Dados divergentes')">Dados divergentes</button>
                    <button type="button" onclick="usarMotivo('Situação irregular')">Situação irregular</button>
                </div>

                <div class="lst-escrever" id="dc-motivo-caixa">
                    <textarea id="dc-motivo" placeholder="Descreva o motivo (obrigatório)…" aria-label="Motivo"
                              oninput="limparErroMotivo()"></textarea>
                </div>
                <span class="lst-erro-msg">Escreva o motivo com pelo menos 10 caracteres.</span>
            </div>

            <div class="lst-acoes">
                <button type="button" class="lst-btn lst-btn--neutro" onclick="fecharModalDecisao()">Cancelar</button>
                
                <button type="button" class="lst-btn" id="dc-confirmar" onclick="confirmarDecisao()"
                        data-destino="<?php echo e($urlLista); ?>"></button>
            </div>
        </div>
    </div>

    
    <div class="lst-toast" id="dc-toast" role="status" aria-live="polite">
        <i data-lucide="check-circle-2"></i><span></span>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/aprovacao-cadastro.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/usuario/aprovar-cadastro.blade.php ENDPATH**/ ?>