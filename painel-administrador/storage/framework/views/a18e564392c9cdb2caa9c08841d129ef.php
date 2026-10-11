
 
<?php $__env->startSection('titulo', 'Conteúdos Aprender - Painel Administrativo - Vênus'); ?>
 
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/listas.css')); ?>">
<?php $__env->stopPush(); ?>
 
<?php $__env->startSection('content'); ?>
<div class="lst-page">
 
    
    <div class="lst-topo">
        <h1>Conteúdos Aprender</h1>
    </div>
 
    
    <div class="lst-kpis">
        <button type="button" class="lst-card lst-kpi" data-filtro="recusado" aria-pressed="false"
                title="Mostrar só os recusados">
            <span class="lst-icone"><i data-lucide="triangle-alert"></i></span>
            <span class="lst-kpi-texto"><b id="ct-recusados">1</b><span class="lst-kpi-rotulo">Recusados</span></span>
        </button>
 
        <button type="button" class="lst-card lst-kpi" data-filtro="analise" aria-pressed="false"
                title="Mostrar só os aguardando revisão">
            <span class="lst-icone lst-icone--amarelo"><i data-lucide="hourglass"></i></span>
            <span class="lst-kpi-texto"><b id="ct-analise">3</b><span class="lst-kpi-rotulo">Aguardando revisão</span></span>
        </button>
 
        <button type="button" class="lst-card lst-kpi" data-filtro="publicado" aria-pressed="false"
                title="Mostrar só os publicados">
            <span class="lst-icone lst-icone--verde"><i data-lucide="check-circle-2"></i></span>
            <span class="lst-kpi-texto"><b id="ct-publicados">2</b><span class="lst-kpi-rotulo">Publicados</span></span>
        </button>
    </div>
 
    
    <div class="lst-card lst-espaco">
        <div class="lst-barra">
            <h3>Conteúdos</h3>
 
            <label class="lst-busca">
                <i data-lucide="search"></i>
                <input type="search" id="ct-busca" placeholder="Pesquisar…" aria-label="Pesquisar conteúdos">
            </label>
 
            <button type="button" class="lst-btn lst-btn--neutro lst-btn--pequeno" data-pdf>
                <i data-lucide="download"></i>Baixar PDF
            </button>
 
            <div class="lst-filtro">
                <button type="button" class="lst-btn lst-btn--primario" id="ct-filtro-btn"
                        aria-haspopup="true" aria-expanded="false" aria-controls="ct-menu">
                    <i data-lucide="sliders-horizontal"></i><span id="ct-filtro-rotulo">Filtro</span>
                </button>
 
                <div class="lst-menu" id="ct-menu">
                    <button type="button" data-filtro="todos" aria-pressed="true">Todos<i data-lucide="check"></i></button>
                    <button type="button" data-filtro="publicado" aria-pressed="false">Publicado<i data-lucide="check"></i></button>
                    <button type="button" data-filtro="analise" aria-pressed="false">Em análise<i data-lucide="check"></i></button>
                    <button type="button" data-filtro="recusado" aria-pressed="false">Recusado<i data-lucide="check"></i></button>
                </div>
            </div>
        </div>
 
        <div class="lst-tabela-wrap">
            <table class="lst-tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profissional</th>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>
 
                
                <tbody id="ct-corpo">
                    <tr data-id="CO000006" data-nome="Roberta Oliveira" data-cargo="Ginecologista" data-status="analise"
                        data-completo="1" data-titulo-completo="O que são ISTs?"
                        data-resumo="As infecções sexualmente transmissíveis (ISTs) são causadas por vírus, bactérias ou outros microrganismos, transmitidos principalmente pelo contato sexual. Mas existem formas simples de se proteger, e esse artigo vai te mostrar tudo.">
                        <td class="lst-mono">CO000006</td>
                        <td>RobertaOli@gmail.com</td>
                        <td>O que são ISTs, como identificar e tratar</td>
                        <td>27/07/2026</td>
                        <td><span class="lst-status lst-status--pendente">Em análise</span></td>
                    </tr>
                    <tr data-id="CO000005" data-nome="Ricardo Nunes" data-cargo="Ginecologista" data-status="analise">
                        <td class="lst-mono">CO000005</td>
                        <td>RicardoN@gmail.com</td>
                        <td>Como achar campanhas de vacinações por perto</td>
                        <td>06/07/2026</td>
                        <td><span class="lst-status lst-status--pendente">Em análise</span></td>
                    </tr>
                    <tr data-id="CO000004" data-nome="Aline Souza" data-cargo="Ginecologista" data-status="publicado">
                        <td class="lst-mono">CO000004</td>
                        <td>AlineSP@gmail.com</td>
                        <td>Entenda como lidar com os efeitos de uma IST</td>
                        <td>13/06/2026</td>
                        <td><span class="lst-status lst-status--ok">Publicado</span></td>
                    </tr>
                    <tr data-id="CO000003" data-nome="Júnior Correia" data-cargo="Ginecologista" data-status="analise">
                        <td class="lst-mono">CO000003</td>
                        <td>JuniorCOR@gmail.com</td>
                        <td>Muito legal meu dia ontem</td>
                        <td>11/05/2026</td>
                        <td><span class="lst-status lst-status--pendente">Em análise</span></td>
                    </tr>
                    <tr data-id="CO000002" data-nome="Usuário hdhd" data-cargo="Ginecologista" data-status="recusado">
                        <td class="lst-mono">CO000002</td>
                        <td>hdhdihjhj@gmail.com</td>
                        <td>Xnsjhwjsjjsssss</td>
                        <td>02/02/2026</td>
                        <td><span class="lst-status lst-status--recusado">Recusado</span></td>
                    </tr>
                    <tr data-id="CO000001" data-nome="Ana Paula" data-cargo="Ginecologista" data-status="publicado">
                        <td class="lst-mono">CO000001</td>
                        <td>AnaPaula@gmail.com</td>
                        <td>Como se prevenir do câncer de mama</td>
                        <td>04/01/2026</td>
                        <td><span class="lst-status lst-status--ok">Publicado</span></td>
                    </tr>
 
                    <tr id="ct-vazio" hidden>
                        <td colspan="5" class="lst-vazio">Nenhum conteúdo encontrado.</td>
                    </tr>
                </tbody>
            </table>
        </div>
 
        <p class="lst-mute lst-dica">Clique em um conteúdo para revisar, aprovar ou recusar.</p>
    </div>
 
    
    <div class="lst-modal" id="ct-modal" role="dialog" aria-modal="true" aria-labelledby="ct-nome">
        <div class="lst-card lst-modal-caixa">
 
            <div class="lst-modal-topo">
                <div class="lst-avatar" id="ct-avatar"></div>
                <div>
                    <b id="ct-nome"></b>
                    <span class="lst-status lst-status--ok">Ativa</span>
                </div>
                <button type="button" class="lst-icone-btn" data-fechar="1" aria-label="Fechar">
                    <i data-lucide="x"></i>
                </button>
            </div>
 
            <div class="lst-modal-corpo">
                <div class="lst-mute">ID do conteúdo</div>
                <b id="ct-id"></b>
            </div>
 
            <div class="lst-modal-corpo">
                <div class="lst-mute">Título do conteúdo</div>
                <b id="ct-titulo"></b>
                <div><span class="lst-status" id="ct-status"></span></div>
            </div>
 
            <button type="button" class="lst-btn lst-btn--suave lst-btn--pequeno" id="ct-ver">
                <i data-lucide="eye"></i>Ver conteúdo
            </button>
 
            <div class="lst-decisao">
                <button type="button" class="lst-btn lst-btn--neutro" id="ct-aprovar" data-decisao="publicado">
                    <i data-lucide="check"></i>Aprovar
                </button>
                <button type="button" class="lst-btn lst-btn--primario" id="ct-recusar" data-decisao="recusado">
                    <i data-lucide="x"></i>Recusar
                </button>
            </div>
        </div>
    </div>
 
    
    <div class="lst-modal lst-modal--2" id="ct-modal-completo" role="dialog" aria-modal="true" aria-labelledby="cc-titulo">
        <div class="lst-card lst-modal-caixa lst-modal-caixa--larga">
 
            <div class="lst-doc-topo">
                <div>
                    <h2 class="lst-doc-titulo" id="cc-titulo"></h2>
                    <p class="lst-doc-resumo" id="cc-resumo"></p>
                </div>
 
                <div class="lst-doc-autor">
                    <div class="lst-info">
                        <b id="cc-autor"></b>
                        <span class="lst-mute" id="cc-cargo"></span>
                    </div>
                    <button type="button" class="lst-icone-btn" data-fechar="1" aria-label="Fechar tudo">
                        <i data-lucide="x"></i>
                    </button>
                </div>
            </div>
 
            
            <div id="cc-artigo" hidden>
                <h3 class="lst-secao-titulo">Principais tipos de ISTs</h3>
                <div class="lst-doc-meio">
                    <div class="lst-doc-grade">
                        <div class="lst-info"><b>HIV/AIDS</b>Vírus que afeta o sistema imunológico. Com tratamento, a pessoa vive com qualidade.</div>
                        <div class="lst-info"><b>Sífilis</b>Bactéria curável. Quanto antes o diagnóstico, mais simples o tratamento.</div>
                        <div class="lst-info"><b>Gonorreia e Clamídia</b>Infecções bacterianas comuns, tratadas com antibióticos.</div>
                        <div class="lst-info"><b>HPV</b>Vírus frequente, com vacina gratuita no SUS.</div>
                    </div>
                    <img src="<?php echo e(asset('images/img-conteudo.png')); ?>" alt="Ilustração do conteúdo">
                </div>
 
                <h3 class="lst-secao-titulo">Como me proteger?</h3>
                <div class="lst-doc-grade">
                    <div class="lst-info"><b>Use camisinha sempre</b>É o método que mais protege contra ISTs e gravidez.</div>
                    <div class="lst-info"><b>Faça exames regulares</b>Os testes rápidos e o Papanicolau são gratuitos no SUS.</div>
                    <div class="lst-info"><b>Tome a vacina contra HPV</b>Disponível gratuitamente para meninas e meninos.</div>
                </div>
 
                <div class="lst-info lst-fontes">
                    <b>Fontes consultadas</b>
                    <ul>
                        <li>Ministério da Saúde - saude.gov.br, 2024</li>
                        <li>OMS - Organização Mundial da Saúde, 2023</li>
                        <li>Febrasgo - Federação Brasileira de Ginecologia, 2024</li>
                        <li>UNAIDS Brasil - unaids.org.br</li>
                    </ul>
                </div>
            </div>
 
            <div class="lst-acoes">
                <button type="button" class="lst-btn lst-btn--neutro" data-fechar="2">Fechar</button>
            </div>
        </div>
    </div>
 
    
    <div class="lst-toast" id="ct-toast" role="status" aria-live="polite">
        <i data-lucide="check-circle-2"></i><span></span>
    </div>
 
</div>
<?php $__env->stopSection(); ?>
 
<?php $__env->startPush('scripts'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.min.js"></script>
    <script src="<?php echo e(asset('js/conteudos.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/listas/lista-conteudo-aprender.blade.php ENDPATH**/ ?>