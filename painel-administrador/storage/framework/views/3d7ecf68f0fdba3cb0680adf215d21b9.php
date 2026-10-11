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
                <div class="etapa-atual">
                    <div class="numero-etapa"><h2>1</h2></div>
                    <p>Informações básicas</p>
                </div>
                <hr class="divisor-etapa">
                <div class="etapa">
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
            
                <h1>Informações básicas</h1>

                <div class="titulo-input">
                    <label>Título do destaque <span class="asterisco">*</span></label>
                    <input type="text" placeholder="Digite aqui...">
                </div>
                
                <div class="titulo-input">
                    <div class="titulo-input-com-info">
                        <label for="">Objetivo do destaque <span class="asterisco">*</span></label>
                        <a href="">
                            <p class="informativo">i</p>
                        </a>
                    </div>
                    <textarea placeholder="Digite aqui..." maxlength="250"></textarea>
                </div>

                <div class="bloco-criar">
                    <div class="titulo-input">
                        <label for="">Público-alvo<span class="asterisco">*</span></label>
                        <div class="select">
                            <span class="tag">
                                Adolescentes e jovens
                                <button type="button">×</button>
                            </span>

                            <span class="seta">⌄</span>
                        </div>
                    </div>

                    <div class="titulo-input">
                        <label for="">Faixa etária<span class="asterisco">*</span></label>
                        <input type="text" placeholder="entre 14 a 25 anos">
                    </div>
                </div>
                
                <div class="bloco-criar">
                    <div class="titulo-input">
                        <label for="">Categoria do destaque<span class="asterisco">*</span></label>
                        <select>
                            <option>ISTs (Infeccões Sexualmente ...)</option>
                        </select>
                    </div>

                    <div class="titulo-input">
                        <label for="">Duração do destaque<span class="asterisco">*</span></label>
                        <div class="input-datas">
                            <img src="<?php echo e(asset('images/calendario.png')); ?>" alt="">
                            <span>01/07/2025 a 31/07/2025</span>
                        </div>
                    </div>
                </div>

                <div class="titulo-input">
                    <label for="">Tags (opcional)</label>
                    <div class="select-tags">
                        <div class="tags">
                            <span class="tag">
                                ISTs
                                <button type="button">×</button>
                            </span>

                            <span class="tag">
                                Prevenção
                                <button type="button">×</button>
                            </span>

                            <span class="tag">
                                Saúde Sexual
                                <button type="button">×</button>
                            </span>

                            <span class="tag">
                                Teste
                                <button type="button">×</button>
                            </span>
                        </div>

                        <button type="button" class="maisopcoes"><img src="<?php echo e(asset('images/chevron-down-2.png')); ?>" alt=""></button>
                    </div>
                </div>

                <div class="btn-continuar">
                    <!-- <button class="button">
                        <h2>Continuar</h2>
                        <img src="<?php echo e(asset('images/continuar.png')); ?>" alt="">
                    </button> -->

                    <!-- Mudar para Button quando o form estiver funcional -->

                    <a class="button" href="/criar-destaque-pt2">
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
</html><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/destaque-sazonal/criar-destaque.blade.php ENDPATH**/ ?>