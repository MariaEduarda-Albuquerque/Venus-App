

<?php $__env->startSection('titulo', 'Analisar cadastro - Painel Administrativo - Vênus'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/listas.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
    $p         = $profissional;
    $info      = $statusInfo[$p->statusVerificacao] ?? ['rotulo' => $p->statusVerificacao, 'classe' => ''];
    $emAnalise = $p->statusVerificacao === 'em_analise';
    $enviado   = \Carbon\Carbon::parse($p->dataCadastro)->locale('pt_BR');

    // [tipo da rota, caminho gravado no banco]
    $documentos = [
        'Comprovante do conselho' => ['comprovante',  $p->comprovanteConselhoClasseProfissional],
        'Documento complementar'  => ['complementar', $p->documentoComplementarProfissional],
    ];

    // A foto fica no disco público do site do profissional
    $urlFoto = $p->fotoPerfilProfissional
        ? rtrim(config('services.profissional_url'), '/') . '/storage/' . $p->fotoPerfilProfissional
        : null;

    $checklist = [
        ['Nome confere com o documento',       'Compare o nome do comprovante com o cadastro'],
        ['Número confere na consulta pública', 'Busque no site oficial do conselho'],
        ['Situação ativa e regular',           'Sem suspensão ou cassação'],
        ['Documento legível e válido',         'Imagem nítida e dentro da validade'],
        ['Especialidade compatível',           'Igual à informada no cadastro'],
    ];

    $urlLista = url('/aprovar-cadastros'); // tela com a lista de cadastros
    $urlAnterior = null;                      // cadastro anterior da fila (null = botão desativado; este é o 1º da fila)
    $urlProximo = url('/aprovar-cadastro');   // próximo cadastro da fila (por enquanto a mesma tela, pois só existe uma)
?>

<div class="lst-page">

    
    <div class="lst-cabeca">
        <a href="<?php echo e(route('cadastros.aprovar')); ?>" class="lst-btn lst-btn--neutro lst-btn--pequeno">
            <i data-lucide="arrow-left"></i>Voltar à fila
        </a>

        <?php if($posicao): ?>
            <div class="lst-fila">
                <span class="lst-mute"><?php echo e($posicao); ?> de <?php echo e($fila); ?> na fila</span>

                <?php if($anterior): ?>
                    <a href="<?php echo e(route('cadastro.aprovar', $anterior)); ?>" class="lst-nav-btn" aria-label="Anterior"><i data-lucide="chevron-left"></i></a>
                <?php else: ?>
                    <span class="lst-nav-btn" aria-disabled="true"><i data-lucide="chevron-left"></i></span>
                <?php endif; ?>

                <?php if($proximo): ?>
                    <a href="<?php echo e(route('cadastro.aprovar', $proximo)); ?>" class="lst-nav-btn" aria-label="Próximo"><i data-lucide="chevron-right"></i></a>
                <?php else: ?>
                    <span class="lst-nav-btn" aria-disabled="true"><i data-lucide="chevron-right"></i></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Passo a passo -->
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
                    <div class="lst-hero-avatar"><?php echo e(mb_strtoupper(mb_substr($p->nomeProfissionalSaude, 0, 1))); ?></div>
                    <div class="lst-hero-info">
                        <h1><?php echo e($p->nomeProfissionalSaude); ?></h1>
                        <div class="lst-hero-sub">
                            <?php echo e($p->especialidadeProfissionalSaude ?? 'Sem especialidade'); ?>

                            · <?php echo e($p->cidadeProfissional); ?><?php echo e($p->ufProfissional ? ', '.$p->ufProfissional : ''); ?>

                        </div>
                        <div class="lst-pilulas">
                            <span class="lst-pilula lst-pilula--branca"><i data-lucide="id-card"></i><?php echo e($p->categoriaProfissional ?? '—'); ?></span>
                            <span class="lst-pilula"><i data-lucide="clock"></i>Enviado <?php echo e($enviado->diffForHumans()); ?></span>
                        </div>
                    </div>
                    <span class="lst-pilula lst-pilula--branca lst-pilula--grande"><?php echo e($info['rotulo']); ?></span>
                </div>
            </div>

            
            <div class="lst-card">
                <div class="lst-card-topo">
                    <h3 class="lst-card-titulo">Documentos enviados</h3>
                    <div class="lst-abas">
                        <button type="button" class="lst-aba is-active" id="dc-aba-0" onclick="abrirDocumento(0)">Carteira do conselho</button>
                        <button type="button" class="lst-aba" id="dc-aba-1" onclick="abrirDocumento(1)">Documento com foto</button>
                    </div>
                </div>

                <div class="lst-palco" id="dc-palco">

                    <?php $__currentLoopData = $documentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titulo => [$tipo, $caminho]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="lst-papel" id="dc-doc-<?php echo e($loop->index); ?>" <?php if(!$loop->first): ?> hidden <?php endif; ?>>
                            <?php if($caminho): ?>
                                <?php
                                    $url = route('cadastro.documento', [$p, $tipo]);
                                    $pdf = strtolower(pathinfo($caminho, PATHINFO_EXTENSION)) === 'pdf';
                                ?>

                                <?php if($pdf): ?>
                                    <iframe src="<?php echo e($url); ?>" title="<?php echo e($titulo); ?>"></iframe>
                                <?php else: ?>
                                    <img src="<?php echo e($url); ?>" alt="<?php echo e($titulo); ?>">
                                <?php endif; ?>

                                <a href="<?php echo e($url); ?>" target="_blank" rel="noopener" class="lst-btn lst-btn--neutro lst-btn--pequeno">
                                    <i data-lucide="external-link"></i>Abrir em nova aba
                                </a>
                            <?php else: ?>
                                <p class="lst-mute">Não enviado.</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
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
                    <div><span class="lst-dados-rotulo">Nome completo</span><b><?php echo e($p->nomeProfissionalSaude); ?></b></div>
                    <div><span class="lst-dados-rotulo">Nº fiscal</span><b><?php echo e($p->nrFiscalProfissional ?? '—'); ?></b></div>
                    <div><span class="lst-dados-rotulo">E-mail</span><b><?php echo e($p->emailProfissionalSaude); ?></b></div>
                    <div><span class="lst-dados-rotulo">Telefone</span><b><?php echo e($p->telProfissionalSaude ?? '—'); ?></b></div>
                    <div><span class="lst-dados-rotulo">Cidade</span><b><?php echo e($p->cidadeProfissional); ?><?php echo e($p->ufProfissional ? ', '.$p->ufProfissional : ''); ?></b></div>
                    <div><span class="lst-dados-rotulo">CEP</span><b><?php echo e($p->cepProfissional ?? '—'); ?></b></div>
                    <div><span class="lst-dados-rotulo">Categoria</span><b><?php echo e($p->categoriaProfissional ?? '—'); ?></b></div>
                    <div><span class="lst-dados-rotulo">Especialidade</span><b><?php echo e($p->especialidadeProfissionalSaude ?? '—'); ?></b></div>
                </div>
                <?php if($p->apresentacaoProfissional): ?>
                    <p class="lst-mute lst-espaco">Apresentação</p>
                    <p><?php echo e($p->apresentacaoProfissional); ?></p>
                <?php endif; ?>
            </div>

            
            <div class="lst-card">
                <h3 class="lst-card-titulo">Histórico de tentativas</h3>
                <div class="lst-linha-tempo">
                    <?php $__currentLoopData = $historico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <b><?php echo e($statusInfo[$h->decisao]['rotulo'] ?? $h->decisao); ?><?php echo e($h->motivo ? ': '.$h->motivo : ''); ?></b>
                            <div class="lst-mute"><?php echo e(\Carbon\Carbon::parse($h->created_at)->format('d/m/Y H:i')); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <b>Cadastro enviado</b>
                        <div class="lst-mute"><?php echo e($enviado->format('d/m/Y H:i')); ?></div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="lst-lateral">

            <?php if($consulta): ?>
                <div class="lst-card">
                    <div class="lst-card-topo">
                        <h3 class="lst-card-titulo">Verificação externa</h3>
                        <span class="lst-selo">CFESS</span>
                    </div>

                    <div class="lst-pessoa lst-pessoa--espaco">
                        <span class="lst-avatar">C</span>
                        <div>
                            <b>CRESS 34.221 (9ª)</b>
                            <span class="lst-mute">Conselho Regional de Serviço Social</span>
                        </div>
                        <button type="button" class="lst-icone-btn lst-pessoa-fim" aria-label="Copiar número do registro"
                                onclick="navigator.clipboard.writeText('CRESS 34.221 (9ª)')">
                            <i data-lucide="copy"></i>
                        </button>
                    </div>

                    <a href="<?php echo e($consulta); ?>" target="_blank" rel="noopener" class="lst-btn lst-btn--primario lst-btn--grande">
                        <i data-lucide="external-link"></i>Abrir consulta pública
                    </a>
                    <p class="lst-mute lst-dica">Confirme nome, número e situação no site oficial.</p>
                </div>
            <?php endif; ?>

            <div class="lst-card">
                
                <?php if($emAnalise): ?>
                    <form method="POST" action="<?php echo e(route('cadastro.decidir', $p)); ?>">
                        <?php echo csrf_field(); ?>

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

                        <?php $__currentLoopData = $checklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => [$titulo, $dica]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="lst-item-check" id="dc-item-<?php echo e($i); ?>">
                                <input type="checkbox" id="dc-check-<?= $i ?>" onchange="atualizarTela()" name="checklist[<?php echo e($i); ?>]" value="1" <?php if(old("checklist.$i")): echo 'checked'; endif; ?>>
                                <span class="lst-item-check-caixa"><i data-lucide="check"></i></span>
                                <span><b><?php echo e($titulo); ?></b><small><?php echo e($dica); ?></small></span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__errorArgs = ['checklist'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="lst-erro-msg" style="display:block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="lst-escrever <?php echo e($errors->has('motivo') ? 'is-erro' : ''); ?> lst-espaco">
                            <textarea name="motivo" placeholder="Motivo (obrigatório para reenvio ou reprovação)…"
                                      aria-label="Motivo"><?php echo e(old('motivo')); ?></textarea>
                        </div>
                        <?php $__errorArgs = ['motivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="lst-erro-msg" style="display:block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['decisao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="lst-erro-msg" style="display:block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <div class="lst-botoes-decisao">
                            <button type="submit" name="decisao" value="aprovar" class="lst-btn lst-btn--ok lst-btn--grande">
                                <i data-lucide="badge-check"></i>Aprovar cadastro
                            </button>
                            <div class="lst-decisao lst-decisao--solta">
                                <button type="submit" name="decisao" value="reenvio" class="lst-btn lst-btn--neutro">
                                    <i data-lucide="rotate-ccw"></i>Solicitar reenvio
                                </button>
                                <button type="submit" name="decisao" value="reprovar" class="lst-btn lst-btn--perigo">
                                    <i data-lucide="user-x"></i>Reprovar
                                </button>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <h3 class="lst-card-titulo">Decisão registrada</h3>
                    <p><span class="lst-status <?php echo e($info['classe']); ?>"><?php echo e($info['rotulo']); ?></span></p>
                    <?php if($historico->first()?->motivo): ?>
                        <p class="lst-mute"><?php echo e($historico->first()->motivo); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if(session('sucesso')): ?>
        <div class="lst-toast lst-toast--show"><i data-lucide="check-circle-2"></i><span><?php echo e(session('sucesso')); ?></span></div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/aprovacao-cadastro.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/usuario/aprovar-cadastro.blade.php ENDPATH**/ ?>