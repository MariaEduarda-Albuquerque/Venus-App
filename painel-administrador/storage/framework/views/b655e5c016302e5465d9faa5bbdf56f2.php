<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador - Vênus</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
</head>
<body>
    
    <div class="direita">
    </div>

    <div class="esquerda">
        <form action="<?php echo e(route('login.autenticar')); ?>" method="post">
        <?php echo csrf_field(); ?>
            <div class="titulo-subtitulo">
                <h1>Login ADM</h1>
                <p>Entre no site para gerenciar e administrar o nosso aplicativo e o site de profissional.</p>
            </div>

            
            <?php if($errors->any()): ?>
                <div class="erro-login" role="alert">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($erro); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="input-label">
                <label for="emailAdmin">E-mail</label>
                <div class="input-com-icone">
                    <img src="<?php echo e(asset('images/gmail.png')); ?>" alt="" class="icone-input">
                    <input type="email" id="emailAdmin" name="emailAdmin" value="<?php echo e(old('emailAdmin')); ?>" placeholder="email@endereço" autocomplete="email">
                </div>
            </div>

            <div class="input-label">
                <label for="password">Senha</label>
                <div class="input-com-icone">
                    <img src="<?php echo e(asset('images/senha.png')); ?>" alt="" class="icone-input">
                    <input type="password" id="password" name="password" placeholder="Digite sua senha" autocomplete="current-password">
                    <img src="<?php echo e(asset('images/visibilidade.png')); ?>" alt="Mostrar ou ocultar senha" class="icone-input-direita" id="olho" role="button" tabindex="0">
                </div>
            </div>

            <div class="colocar-ladoAlado">
                <div class="lembrar-container">
                    <input type="checkbox" id="lembrar" name="lembrar">
                    <label for="lembrar">Lembrar de mim</label>
                </div>

                <a href="/esqueciSenha">Esqueci minha senha</a>
            </div>

            <button type="submit">Entrar</button>

            <div class="colocar-ladoAlado2">
                <p>Ainda não é cadastrado?</p>
                
                <a href="#">Solicitar acesso</a>
            </div>
        </form>
    </div>

    
    <script>
        const olho = document.getElementById('olho');
        const campoSenha = document.getElementById('password');

        function alternarSenha() {
            const mostrando = campoSenha.type === 'text';
            campoSenha.type = mostrando ? 'password' : 'text';
            olho.classList.toggle('ativo', !mostrando);
        }

        olho.addEventListener('click', alternarSenha);
        olho.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                alternarSenha();
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/login/login.blade.php ENDPATH**/ ?>