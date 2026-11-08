<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/perfil-config.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="wrap">

    <div class="head">
        <div>
            <h1>Editar perfil</h1>
            <p class="sm">Atualize seus dados para manter o perfil em dia.</p>
        </div>
        <a href="<?php echo e(route('perfil')); ?>" class="bk" aria-label="Voltar">
            <i data-lucide="arrow-left"></i>
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div class="alerta erro" role="alert">Confira os campos destacados e tente de novo.</div>
    <?php endif; ?>

    <form class="ef" action="<?php echo e(route('perfil.atualizar')); ?>" method="POST" novalidate>
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="card" style="text-align:center">
            <div class="pav" style="margin:6px auto 14px">
                <span><?php echo e($inicial); ?></span>
            </div>

            <b><?php echo e($nomeCompleto); ?></b>
        </div>

        <div class="stack">

            <div class="card">
                <div class="sech">
                    <div class="ico"><i data-lucide="user-round"></i></div>
                    <div>
                        <h3>Informações pessoais</h3>
                        <p>Como você aparece para a equipe.</p>
                    </div>
                </div>

                <div class="two">
                    <div class="f">
                        <label for="primeiro_nome">Primeiro nome <em>*</em></label>
                        <input type="text" id="primeiro_nome" name="primeiro_nome" maxlength="60"
                               value="<?php echo e(old('primeiro_nome', $primeiroNome)); ?>"
                               class="<?php echo e($errors->has('primeiro_nome') ? 'invalido' : ''); ?>">
                        <?php $__errorArgs = ['primeiro_nome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="erro-campo"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="f">
                        <label for="sobrenome">Sobrenome</label>
                        <input type="text" id="sobrenome" name="sobrenome" maxlength="60"
                               value="<?php echo e(old('sobrenome', $sobrenome)); ?>"
                               class="<?php echo e($errors->has('sobrenome') ? 'invalido' : ''); ?>">
                        <?php $__errorArgs = ['sobrenome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="erro-campo"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="f">
                        <label for="email">E-mail <em>*</em></label>
                        <input type="email" id="email" name="email" maxlength="150"
                               value="<?php echo e(old('email', $email)); ?>"
                               class="<?php echo e($errors->has('email') ? 'invalido' : ''); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="erro-campo"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="f">
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="telefone" maxlength="14" inputmode="numeric"
                               placeholder="11 99999-9999"
                               value="<?php echo e(old('telefone', $telefone)); ?>"
                               class="<?php echo e($errors->has('telefone') ? 'invalido' : ''); ?>">
                        <?php $__errorArgs = ['telefone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="erro-campo"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="f">
                        <label>Cargo</label>
                        <input type="text" value="Gerente Administrativo" disabled>
                        <div class="hint">Definido pela equipe gestora.</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="sech">
                    <div class="ico"><i data-lucide="map-pin"></i></div>
                    <div>
                        <h3>Endereço</h3>
                        <p>Usado em relatórios e documentos oficiais.</p>
                    </div>
                </div>

                <div class="two">
                    <div class="f">
                        <label for="pais">País</label>
                        <input type="text" id="pais" name="pais" maxlength="60"
                               value="<?php echo e(old('pais', $pais)); ?>"
                               class="<?php echo e($errors->has('pais') ? 'invalido' : ''); ?>">
                        <?php $__errorArgs = ['pais'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="erro-campo"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="f">
                        <label for="cidade">Cidade/Estado</label>
                        <input type="text" id="cidade" name="cidade" maxlength="104"
                               placeholder="Ex.: São Paulo, SP"
                               value="<?php echo e(old('cidade', $cidadeUf)); ?>"
                               class="<?php echo e(($errors->has('cidade_nome') || $errors->has('uf')) ? 'invalido' : ''); ?>">
                        <?php if($errors->has('cidade_nome') || $errors->has('uf')): ?>
                            <div class="erro-campo"><?php echo e($errors->first('cidade_nome') ?: $errors->first('uf')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="f">
                        <label for="cep">Código postal</label>
                        <input type="text" id="cep" name="cep" maxlength="9" inputmode="numeric"
                               placeholder="00000-000"
                               value="<?php echo e(old('cep', $cepFormatado)); ?>"
                               class="<?php echo e($errors->has('cep') ? 'invalido' : ''); ?>">
                        <?php $__errorArgs = ['cep'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="erro-campo"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="f">
                        <label for="nfiscal">Nº fiscal</label>
                        <input type="text" id="nfiscal" name="nfiscal" maxlength="20"
                               value="<?php echo e(old('nfiscal', $nrfiscal)); ?>"
                               class="<?php echo e($errors->has('nfiscal') ? 'invalido' : ''); ?>">
                        <?php $__errorArgs = ['nfiscal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="erro-campo"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <div class="savebar">
                <span class="sm">As alterações só valem depois de salvar.</span>
                <div style="display:flex;gap:10px">
                    <a href="<?php echo e(route('perfil')); ?>" class="btn g">Cancelar</a>
                    <button type="submit" class="btn p">
                        <i data-lucide="check"></i> Salvar alterações
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Máscaras simples: telefone "11 99999-9999" e código postal "00000-000"
    (function () {
        var tel = document.getElementById('telefone');
        var cep = document.getElementById('cep');

        tel.addEventListener('input', function () {
            var n = tel.value.replace(/\D/g, '').slice(0, 11);
            var texto = n;
            if (n.length > 2) {
                var resto = n.slice(2);
                var corte = n.length > 10 ? 5 : 4;
                texto = n.slice(0, 2) + ' ' + resto.slice(0, corte) + (resto.length > corte ? '-' + resto.slice(corte) : '');
            }
            tel.value = texto;
        });

        cep.addEventListener('input', function () {
            var n = cep.value.replace(/\D/g, '').slice(0, 8);
            cep.value = n.length > 5 ? n.slice(0, 5) + '-' + n.slice(5) : n;
        });
    })();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/perfil-config/editar-perfil.blade.php ENDPATH**/ ?>