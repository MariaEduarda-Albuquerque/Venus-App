

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/perfil-config.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="wrap">

    <div class="card">
        <div class="pcover">
        </div>

        <div class="top2">
            <div class="pav">
                <span><?php echo e($inicial); ?></span>
            </div>

            <div class="grow">
                <h1><?php echo e($nomeCompleto); ?></h1>
                <p class="sm">
                    <span class="stt dk"><i data-lucide="shield-check"></i> Admin</span>
                   <?php echo e($cargo); ?> · <?php echo e($cidade); ?>, <?php echo e($pais); ?>

                </p>
            </div>

            <a href="/editar/perfil" class="btn p">
                <i data-lucide="pencil"></i> Editar perfil
            </a>
        </div>

        <div class="pst">
            <div><b>142</b><span>Decisões no mês</span></div>
            <div><b>58</b><span>Cadastros aprovados</span></div>
            <div><b>71</b><span>Denúncias resolvidas</span></div>
            <div><b>2h 45</b><span>Tempo médio</span></div>
        </div>
    </div>

    <div class="pg">
        <div class="stack">
            <div class="card">
                <h3>Contato</h3>

                <div class="ct">
                    <div class="ico"><i data-lucide="mail"></i></div>
                    <div><label>E-mail</label><b><?php echo e($email); ?></b></div>
                </div>

                <div class="ct">
                    <div class="ico"><i data-lucide="phone"></i></div>
                    <div><label>Telefone</label><b><?php echo e($telefone); ?></b></div>
                </div>

                <div class="ct">
                    <div class="ico"><i data-lucide="map-pin"></i></div>
                    <div><label>Localização</label><b><?php echo e($cidade); ?>, <?php echo e($pais); ?></b></div>
                </div>
            </div>

            <div class="card">
                <h3>Segurança</h3>

                <div class="line">
                    <div>
                        <b>Autenticação de dois fatores</b>
                        <div class="sm">Mantenha sua conta segura ativando o 2FA.</div>
                    </div>
                    <label class="tog">
                        <input type="checkbox" checked>
                        <i></i>
                    </label>
                </div>

                <div class="line">
                    <div>
                        <b>Senha</b>
                        <div class="sm">Alterada há 42 dias.</div>
                    </div>
                    <a href="#" class="btn g s">
                        <i data-lucide="key-round"></i> Alterar
                    </a>
                </div>
            </div>
        </div>

        <div class="stack">
            <div class="card">
                <h3>Informações pessoais</h3>
                <div class="dl">
                    <div><label>Primeiro nome</label><b><?php echo e($primeiroNome); ?></b></div>
                    <div><label>Sobrenome</label><b><?php echo e($sobrenome); ?></b></div>
                    <div><label>Cargo</label><b><?php echo e($cargo); ?></b></div>
                    <div><label>Código postal</label><b><?php echo e($codPostal); ?></b></div>
                    <div><label>Nº fiscal</label><b><?php echo e($nrfiscal); ?></b></div>
                    <div><label>País</label><b><?php echo e($pais); ?></b></div>
                </div>
            </div>

            <div class="card">
                <h3>Atividade recente</h3>
                <div class="tln">
                    <div>
                        <b>Aprovou cadastro profissional</b>
                        <div class="sm">Dra. Helena Rocha · CRM 77412-MG · 23/05/2026</div>
                    </div>
                    <div>
                        <b>Reprovou cadastro profissional</b>
                        <div class="sm">Marcos Vieira · COREN 000812-SP · 22/05/2026</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/perfil-config/perfil-adm.blade.php ENDPATH**/ ?>