<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar destaque</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/destaque.css')); ?>">
</head>
<body>
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="direita">
        <?php echo $__env->make('layouts.barra-pesquisa', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="topo-pagina-criar">
            <h1>Destaques</h1>
            <div class="etapas">
                <div class="etapa-concluida">
                    <div class="etapa-numero-concluida"><img src="<?php echo e(asset('images/check.png')); ?>" alt=""></div>
                    <p>Informações básicas</p>
                </div>
                <hr class="divisor-etapa">
                <div class="etapa-atual">
                    <div class="numero-etapa"><h2>2</h2></div>
                    <p>Conteúdo do destaque</p>
                </div>
                <hr class="divisor-etapa">
                <div class="etapa">
                    <div class="numero-etapa"><h2>3</h2></div>
                    <p>Materiais e divulgação</p>
                </div>
                <hr class="divisor-etapa">
                <div class="etapa">
                    <div class="numero-etapa"><h2>4</h2></div>
                    <p>Revisão e publicação</p>
                </div>
            </div>
        </div>

        <form class="form-criar" action="">
            <div class="container-1">
            
                <div class="titulo-subtitulo">
                    <h1>Conteúdo do destaque</h1>
                    <p>Difina as informações e mensagens que serão compartilhadas.</p>
                </div>

                <div class="titulo-input">
                    <div class="titulo-input-com-info">
                        <label>Mensagem principal<span class="asterisco">*</span></label>
                        <a href="">
                            <p class="informativo">i</p>
                        </a>
                    </div>
                    <input type="text" placeholder="Digite aqui...">
                </div>
                
                <div class="titulo-input">
                    <div class="titulo-input-com-info">
                        <label for="">Texto de apresentação<span class="asterisco">*</span></label>
                        <a href="">
                            <p class="informativo">i</p>
                        </a>
                    </div>
                    <textarea placeholder="Digite aqui..." maxlength="250"></textarea>
                </div>

                <div class="titulo-input">
                    <div class="titulo-input-com-info">
                        <label>Chamada para ação (CAT)<span class="asterisco">*</span></label>
                        <a href="">
                            <p class="informativo">i</p>
                        </a>
                    </div>
                    <input type="text" placeholder="Digite aqui...">
                </div>

                <div class="titulo-input">
                    <div class="titulo-input-com-info">
                        <label>Fontes de referência<span class="asterisco">*</span></label>
                        <a href="">
                            <p class="informativo">i</p>
                        </a>
                    </div>
                    <input type="text" placeholder="Digite aqui...">
                </div>

                <div class="btn-continuar-pt2-em-diante">
                    <!-- <button class="button">
                        <h2>Continuar</h2>
                        <img src="<?php echo e(asset('images/continuar.png')); ?>" alt="">
                    </button> -->

                    <!-- Mudar para Button quando o form estiver funcional -->

                    <a class="button-voltar" href="/criar-destaque">
                        <img src="<?php echo e(asset('images/voltar-vermelho.png')); ?>" alt="">
                        <h2>Voltar</h2>
                    </a>

                    <a class="button" href="/criar-destaque-pt3">
                        <h2>Continuar</h2>
                        <img src="<?php echo e(asset('images/continuar.png')); ?>" alt="">
                    </a>
                </div>
            </div>

            <div class="containers-direita">
                <div class="container-2">
                    <div class="topo-container-2">
                        <h2>Prévia do destaque</h2>

                        <div class="btn-editar">
                            <img src="<?php echo e(asset('images/editar-2.png')); ?>" alt="">
                            <h2>Editar</h2>
                        </div>
                    </div>

                    <div class="img-criar-destaque">
                        <img src="<?php echo e(asset('images/img-criar-destaque.png')); ?>" alt="">
                    </div>
                </div>

                <div class="container-3">
                    <h2>Dicas para seu destaque</h2>
                    <p>Destaques educativos ajudam a levar informção de qualidade para mulheres e jovens da nossa comunidade</p>
                    <ul>
                        <li>Use linguagem simples e acolhedora</li>
                        <li>Baseie-se em fontes confiáveis (OMS, etc..)</li>
                        <li>Inclua orientações práticas de prevenção e cuidado</li>
                        <li>Respeite a diversidade e promova a inclusão</li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</body>
</html><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/destaque-sazonal/criar-destaque-2.blade.php ENDPATH**/ ?>