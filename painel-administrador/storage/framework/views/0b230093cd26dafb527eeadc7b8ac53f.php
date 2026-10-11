

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/suporte.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="head">
    <h1>Suporte</h1>
    <span class="sm">3 chamados abertos</span>
</div>

<div class="sup">

    <div class="card">
        <div class="tabs">
            <button class="tab on">Abertos</button>
            <button class="tab">Resolvidos</button>
        </div>

        <label class="sbox">
            <i data-lucide="search"></i>
            <input type="text" placeholder="Buscar chamado…">
        </label>

        <div class="tl">
            <button class="ti on">
                <b><span class="ud"></span> ID 346520</b>
                <div class="sub2">A barra lateral não responde em dispositivos móveis.</div>
                <div class="sub2">João Ninguém</div>
            </button>

            <button class="ti">
                <b>ID 346101</b>
                <div class="sub2">Não consigo recuperar minha senha</div>
                <div class="sub2">Marina Costa</div>
            </button>

            <button class="ti">
                <b>ID 345871</b>
                <div class="sub2">Erro ao enviar anexo no chat</div>
                <div class="sub2">Ricardo Alves</div>
            </button>
        </div>
    </div>

    <div class="card">

        <div class="th">
            <div>
                <h3><span>ID 346520 -</span> A barra lateral não responde em dispositivos móveis.</h3>
                <p class="sm">Segunda-feira, 15h20 (há 2 dias)</p>
            </div>

            <div class="nv">
                <button class="btn g s"><i data-lucide="check"></i> Marcar como resolvido</button>
                <button class="nvb" aria-label="Anterior"><i data-lucide="chevron-left"></i></button>
                <button class="nvb" aria-label="Próximo"><i data-lucide="chevron-right"></i></button>
            </div>
        </div>

        <div class="thr">

            <div class="bub">
                <div class="mav">J</div>
                <div>
                    <div class="nm">João Ninguém</div>
                    <div class="em">jhondelin@gmail.com · 15h20</div>
                    <div class="bd2">Olá, suporte da Vênus

Gostaria de informar que foi identificado um problema na barra lateral do sistema. Em dispositivos móveis, a barra lateral não está respondendo corretamente às interações do usuário, impedindo que as opções sejam acessadas normalmente.

Solicito, por gentileza, que o problema seja verificado e corrigido para garantir o funcionamento adequado da barra lateral também em dispositivos móveis.
Atenciosamente,
João</div>
                </div>
            </div>

        </div>

        <div class="resposta-area">
            <div class="qr">
                <button type="button">Em análise</button>
                <button type="button">Problema corrigido</button>
                <button type="button">Pedir mais detalhes</button>
            </div>

            <form class="cmp" action="" method="POST">
                <?php echo csrf_field(); ?>
                <textarea placeholder="Digite sua resposta aqui…"></textarea>
                <div class="bar">
                    <button type="button" class="btn g s"><i data-lucide="paperclip"></i> Anexar</button>
                    <span class="sm">Ctrl + Enter envia</span>
                    <button type="submit" class="btn p s">Responder <i data-lucide="send"></i></button>
                </div>
            </form>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/denuncias/suporte.blade.php ENDPATH**/ ?>