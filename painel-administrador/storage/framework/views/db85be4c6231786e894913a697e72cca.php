<link rel="stylesheet" href="<?php echo e(asset('css/sidebar-pesquisa.css')); ?>">

<aside id="side">
    <div class="logo">
        <span class="lb">Vênus</span>
        <span class="vm">V.</span>
        <small class="lb">Painel administrativo</small>
    </div>

    <button class="nav" data-grp="g1">
        <i data-lucide="layout-grid"></i>
        <span class="lb">Painel</span>
        <span class="bd">5</span>
        <i data-lucide="chevron-down" class="chev"></i>
    </button>
    <div class="sub" id="g1">
        <a class="nav <?php echo e(request()->is('/') ? 'on' : ''); ?>" href="/">Visão geral</a>
        <a class="nav <?php echo e(request()->is('relatorio') ? 'on' : ''); ?>" href="/relatorio">Relatório</a>
        <a class="nav <?php echo e(request()->is('grc') ? 'on' : ''); ?>" href="/grc">GRC</a>
        <a class="nav <?php echo e(request()->is('logistica') ? 'on' : ''); ?>" href="/logistica">Logística</a>
    </div>

    <div class="nl">Gestão</div>

    <button class="nav" data-grp="g2">
        <i data-lucide="user-round"></i>
        <span class="lb">Usuários</span>
        <i data-lucide="chevron-down" class="chev"></i>
    </button>
    <div class="sub" id="g2">
        <a class="nav <?php echo e(request()->is('usuarios') ? 'on' : ''); ?>" href="/usuarios">Contas de Usuarias</a>
        <a class="nav <?php echo e(request()->is('profissionais') ? 'on' : ''); ?>" href="/profissionais">Contas de Profissionais</a>
        <a class="nav <?php echo e(request()->is('aprovar-cadastros') ? 'on' : ''); ?>" href="/aprovar-cadastros">
            Aprovação de cadastros<span class="bd">5</span>
        </a>
        <a class="nav <?php echo e(request()->is('denuncias') ? 'on' : ''); ?>" href="/denuncias">
            Denúncias<span class="bd">23</span>
        </a>
        <a class="nav <?php echo e(request()->is('denuncias-mensagens') ? 'on' : ''); ?>" href="/denuncias-mensagens">Mensagens denunciadas</a>
    </div>

    <button class="nav" data-grp="g3">
        <i data-lucide="file-text"></i>
        <span class="lb">Conteúdos</span>
        <i data-lucide="chevron-down" class="chev"></i>
    </button>
    <div class="sub" id="g3">
        <a class="nav <?php echo e(request()->is('conteudos-aprender') ? 'on' : ''); ?>" href="/conteudos-aprender">Conteúdo Aprender</a>
        <a class="nav <?php echo e(request()->is('destaques-principais') ? 'on' : ''); ?>" href="/destaques-principais">Destaque sazonal</a>
    </div>

    <button class="nav" data-grp="g5">
        <i data-lucide="bar-chart-3"></i>
        <span class="lb">Relatórios</span>
        <i data-lucide="chevron-down" class="chev"></i>
    </button>
    <div class="sub" id="g5">
        <a class="nav <?php echo e(request()->is('relatorios/usuarias') ? 'on' : ''); ?>" href="/relatorios/usuarias">Usuárias</a>
        <a class="nav <?php echo e(request()->is('relatorios/atendimento') ? 'on' : ''); ?>" href="/relatorios/atendimento">Atendimento</a>
        <a class="nav <?php echo e(request()->is('relatorios/denuncias') ? 'on' : ''); ?>" href="/relatorios/denuncias">Denúncias</a>
        <a class="nav <?php echo e(request()->is('relatorios/profissional') ? 'on' : ''); ?>" href="/relatorios/profissional">Profissionais</a>
    </div>

    <button class="nav" data-grp="g4">
        <svg class="lucide" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
            <path d="M3 3v5h5"/>
            <path d="M12 7v5l4 2"/>
        </svg>
        <span class="lb">Histórico</span>
        <i data-lucide="chevron-down" class="chev"></i>
    </button>
    <div class="sub" id="g4">
        <a class="nav <?php echo e(request()->is('atividades-recentes') ? 'on' : ''); ?>" href="/atividades-recentes">Atividades recentes</a>
        <a class="nav <?php echo e(request()->is('acessos') ? 'on' : ''); ?>" href="/acessos">Acessos</a>
    </div>

    <div class="nl">Atendimento</div>

    <a class="nav <?php echo e(request()->is('conversas') ? 'on' : ''); ?>" href="/conversas">
        <i data-lucide="message-circle"></i>
        <span class="lb">Conversas</span>
    </a>

    <a class="nav <?php echo e(request()->is('feedbacks') ? 'on' : ''); ?>" href="/feedbacks">
        <i data-lucide="message-square-text"></i>
        <span class="lb">Feedbacks</span>
        <span class="bd">5</span>
    </a>

    <a class="nav <?php echo e(request()->is('suporte') ? 'on' : ''); ?>" href="/suporte">
        <i data-lucide="headset"></i>
        <span class="lb">Suporte</span>
    </a>

    <div class="spacer"></div>

    <div class="out">
        <a class="nav <?php echo e(request()->is('configuracoes') ? 'on' : ''); ?>" href="/configuracoes">
            <i data-lucide="settings"></i>
            <span class="lb">Configurações</span>
        </a>

        
        <form method="POST" action="/logout" id="form-logout">
            <?php echo csrf_field(); ?>
            <button type="button" class="nav" id="btn-logout">
                <i data-lucide="log-out"></i>
                <span class="lb">Sair</span>
            </button>
        </form>
    </div>
</aside>


<div class="logout-modal" id="logout-modal" aria-hidden="true">
    <div class="logout-caixa" role="dialog" aria-modal="true" aria-labelledby="logout-titulo">
        <span class="logout-icone"><i data-lucide="log-out"></i></span>
        <h3 id="logout-titulo">Deseja sair da conta?</h3>
        <p>Você precisará entrar novamente para acessar o painel.</p>

        <div class="logout-acoes">
            <button type="button" class="logout-btn logout-btn--neutro" id="logout-cancelar">Cancelar</button>
            <button type="button" class="logout-btn logout-btn--perigo" id="logout-confirmar">Sair</button>
        </div>
    </div>
</div><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>