

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
        <a href="/perfil" class="bk" aria-label="Voltar">
            <i data-lucide="arrow-left"></i>
        </a>
    </div>

    <form class="ef" action="" method="POST">
        <?php echo csrf_field(); ?>

        <div class="card" style="text-align:center">
            <div class="pav" style="margin:6px auto 14px">
                <span>C</span>
                <span class="camb"><i data-lucide="camera"></i></span>
            </div>

            <b>Clodo</b>
            <div class="sm">Admin · Gerente Administrativo</div>

            <button type="button" class="drop">
                <i data-lucide="upload"></i>
                <br><b>Enviar nova foto</b>
                <div class="sm">JPEG ou PNG · 200×200 px</div>
            </button>

            <button type="button" class="btn g s" style="width:100%;justify-content:center">
                <i data-lucide="trash-2"></i> Remover foto
            </button>
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
                        <label>Primeiro nome <em>*</em></label>
                        <input type="text" name="primeiro_nome" value="Clodo">
                    </div>
                    <div class="f">
                        <label>Sobrenome</label>
                        <input type="text" name="sobrenome" value="Almeida">
                    </div>
                    <div class="f ic">
                        <label>E-mail <em>*</em></label>
                        <i data-lucide="mail"></i>
                        <input type="email" name="email" value="ClodoAlmeida@gmail.com">
                    </div>
                    <div class="f ic">
                        <label>Telefone</label>
                        <i data-lucide="phone"></i>
                        <input type="text" name="telefone" value="11 99999-9999">
                    </div>
                    <div class="f ic">
                        <label>Cargo</label>
                        <i data-lucide="lock"></i>
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
                        <label>País</label>
                        <input type="text" name="pais" value="Brasil">
                    </div>
                    <div class="f">
                        <label>Cidade/Estado</label>
                        <input type="text" name="cidade" value="São Paulo, SP">
                    </div>
                    <div class="f">
                        <label>Código postal</label>
                        <input type="text" name="cep" value="01100-000">
                    </div>
                    <div class="f">
                        <label>Nº fiscal</label>
                        <input type="text" name="nfiscal" value="000.123.456">
                    </div>
                </div>
            </div>

            <div class="savebar">
                <span class="sm">As alterações só valem depois de salvar.</span>
                <div style="display:flex;gap:10px">
                    <a href="/perfil" class="btn g">Cancelar</a>
                    <button type="submit" class="btn p">
                        <i data-lucide="check"></i> Salvar alterações
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/perfil-config/editar-perfil.blade.php ENDPATH**/ ?>