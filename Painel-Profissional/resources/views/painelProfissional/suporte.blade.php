<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/preferencias.js') }}"></script>
</head>

<body>

    @php
        $inicial = strtoupper(substr($profissional->nomeProfissionalSaude ?? 'P', 0, 1));
    @endphp

    <div class="app-shell">

        {{-- ===================== BARRA LATERAL ===================== --}}
        <aside class="sidebar">

            <div class="sidebar-brand">
                <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus" class="sidebar-logo">
                <span class="brand-text">Portal do<br>Profissional</span>
            </div>

            <nav class="sidebar-nav">

                <div class="nav-group">
                    <p class="nav-group-label">Principal</p>

                    <a href="{{ url('/dashboard') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l9-8 9 8" /><path d="M5 10v10h14V10" /></svg>
                        <span>Painel</span>
                    </a>

                    <a href="{{ route('agenda.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                        <span>Agenda</span>
                    </a>
                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Gestão</p>

                    <a href="{{ route('conteudos.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5" /><rect x="14" y="3" width="7" height="7" rx="1.5" /><rect x="3" y="14" width="7" height="7" rx="1.5" /><rect x="14" y="14" width="7" height="7" rx="1.5" /></svg>
                        <span>Conteúdos</span>
                    </a>

                    <a href="{{ route('feedback.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H9l-5 4V5a1 1 0 0 1 1-1Z" /><path d="M8 9h8M8 12.5h5" /></svg>
                        <span>Feedback</span>
                    </a>

                    <a href="{{ route('relatorios.index') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20V10M12 20V4M20 20v-7" /></svg>
                        <span>Relatórios</span>
                    </a>

                </div>

                <div class="nav-group">
                    <p class="nav-group-label">Conta</p>

                    <a href="{{ url('user.perfil-profissional') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4" /><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" /></svg>
                        <span>Meu Perfil</span>
                    </a>

                    <a href="{{ url('/configuracoes') }}" class="nav-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3" /><path d="M19 12a7 7 0 0 0-.1-1.2l2-1.6-2-3.4-2.4 1a7 7 0 0 0-2-1.2L14 3h-4l-.5 2.6a7 7 0 0 0-2 1.2l-2.4-1-2 3.4 2 1.6A7 7 0 0 0 5 12a7 7 0 0 0 .1 1.2l-2 1.6 2 3.4 2.4-1a7 7 0 0 0 2 1.2L10 21h4l.5-2.6a7 7 0 0 0 2-1.2l2.4 1 2-3.4-2-1.6c.1-.4.1-.8.1-1.2Z" /></svg>
                        <span>Configurações</span>
                    </a>

                    <a href="{{ url('/suporte') }}" class="nav-item active">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><path d="M9.5 9.2a2.5 2.5 0 1 1 3.6 2.3c-.8.4-1.1 1-1.1 1.9" /><path d="M12 17h.01" /></svg>
                        <span>Suporte</span>
                    </a>
                </div>

            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user">
                    @if (!empty($profissional->fotoPerfilProfissional))
                        <img class="avatar-circle" src="{{ asset('storage/' . $profissional->fotoPerfilProfissional) }}" alt="Foto do profissional">
                    @else
                        <span class="avatar-circle">{{ $inicial }}</span>
                    @endif
                    <div class="sidebar-user-info">
                        <strong>{{ $profissional->nomeProfissionalSaude }}</strong>
                        <span>{{ $profissional->especialidadeProfissionalSaude }}</span>
                    </div>
                </div>

                <form action="/logout" method="post" class="sidebar-logout-form">
                    @csrf
                    <button type="submit" class="sidebar-logout-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><path d="M16 17l5-5-5-5" /><path d="M21 12H9" /></svg>
                        Sair
                    </button>
                </form>
            </div>

        </aside>

        {{-- ===================== CONTEÚDO ===================== --}}
        <div class="main-content">

            <header class="topbar">
                <span class="breadcrumb">Vênus / <strong>Suporte</strong></span>

                <div class="topbar-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                    <input type="text" placeholder="Buscar conteúdo, categorias...">
                </div>

                <div class="topbar-right">
                    <a href="{{ route('feedback.index') }}" style="display: inline-flex; align-items: center; text-decoration: none; color: inherit;" title="Feedback da moderação">
                        <svg class="topbar-bell" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 8-3 8h18s-3-1-3-8" /><path d="M13.7 21a2 2 0 0 1-3.4 0" /></svg>
                    </a>

                    <div class="topbar-user">
                        @if (!empty($profissional->fotoPerfilProfissional))
                            <img class="avatar-circle" src="{{ asset('storage/' . $profissional->fotoPerfilProfissional) }}" alt="Foto do profissional">
                        @else
                            <span class="avatar-circle">{{ $inicial }}</span>
                        @endif
                        <div class="topbar-user-info">
                            <a href="{{ url('user.perfil-profissional') }}" style="text-decoration: none;">
                                <strong>{{ $profissional->nomeProfissionalSaude }}</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="page-content sp-page">

                <div class="page-header">
                    <div>
                        <h1>Suporte</h1>
                        <p class="subtitle">Encontre respostas ou fale com a equipe gestora.</p>
                    </div>
                </div>

                {{-- ============ LINHA 1: AJUDA + FALE COM A EQUIPE ============ --}}
                <div class="sp-row-1">

                    <div class="card">
                        <div class="card-head">
                            <h3>Como podemos ajudar?</h3>
                        </div>

                        <div class="sp-search">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7" /><path d="M21 21l-4.3-4.3" /></svg>
                            <input type="text" id="spBusca" placeholder="Buscar na central de ajuda...">
                        </div>

                        <div class="sp-cats">
                            <a href="#spFaq" class="sp-cat" data-cat="conta" role="button" aria-pressed="false">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9" /><circle cx="12" cy="10" r="3" /><path d="M6.2 18.2c1-2.4 3.3-3.7 5.8-3.7s4.8 1.3 5.8 3.7" /></svg>
                                Conta e verificação
                                <svg class="sp-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                            </a>

                            <a href="#spFaq" class="sp-cat" data-cat="agenda" role="button" aria-pressed="false">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                                Agenda
                                <svg class="sp-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                            </a>

                            <a href="#spFaq" class="sp-cat" data-cat="mensagens" role="button" aria-pressed="false">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                                Caixa de entrada
                                <svg class="sp-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                            </a>

                            <a href="#spFaq" class="sp-cat" data-cat="conteudo" role="button" aria-pressed="false">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8Z" /><path d="M14 3v5h5M9 13h6M9 17h6" /></svg>
                                Publicação de conteúdo
                                <svg class="sp-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                            </a>
                        </div>
                    </div>

                    <div class="card sp-contact">
                        <div class="sp-contact-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10Z" /></svg>
                        </div>
                        <h3>Fale com a equipe</h3>
                        <p>Tem alguma dúvida ou situação que não conseguiu resolver? Nossa equipe está pronta para te ajudar.</p>

                        <a href="mailto:SuporteVenus&#64;gmail.com?subject=Atendimento%20-%20Portal%20do%20Profissional" class="btn-primary-sm">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a8 8 0 0 1-11.5 7.2L4 20l1-4.6A8 8 0 1 1 21 12Z" /></svg>
                            Iniciar atendimento
                        </a>

                        <span class="sp-online">Atendimento online</span>
                        <span class="sp-hours">Seg a Sex · 8h às 18h</span>
                    </div>

                </div>

                {{-- ============ LINHA 2: FAQ + STATUS + CANAIS ============ --}}
                <div class="sp-row-2">

                    <div class="card">
                        <div class="card-head">
                            <h3>Perguntas frequentes</h3>
                            <a href="#spFaq" id="spVerTodas">Ver todas
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                            </a>
                        </div>

                        <p class="sp-filtro" id="spFiltro" hidden>
                            Mostrando: <strong id="spFiltroNome"></strong>
                            <button type="button" id="spLimpar">Limpar filtro</button>
                        </p>

                        <div class="sp-faq" id="spFaq">
                            <details data-cat="conta">
                                <summary>Como redefinir minha senha?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Em Meu Perfil, clique em "Trocar senha" e siga as instruções. Se esqueceu a senha, use "Esqueci minha senha" na tela de login: enviaremos um link de redefinição para o seu e-mail.</p>
                            </details>

                            <details data-cat="conta">
                                <summary>Como alterar meus dados?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Acesse Meu Perfil e clique em "Editar perfil". Depois de ajustar as informações, é só salvar as alterações.</p>
                            </details>

                            <details data-cat="conta">
                                <summary>Como funciona a verificação do meu cadastro?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Após o cadastro, a equipe confere seu registro no conselho profissional e os documentos enviados. Você acompanha o resultado pelo e-mail informado.</p>
                            </details>

                            <details data-cat="conta">
                                <summary>Posso desativar minha conta?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Sim. Em Configurações, use a opção de desativar conta. Seus dados ficam protegidos conforme a política de privacidade da plataforma.</p>
                            </details>

                            <details data-cat="agenda">
                                <summary>Como funciona a agenda?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>A Agenda mostra, mês a mês, as datas e campanhas importantes para a saúde da mulher, como o Outubro Rosa, e as campanhas de vacinação.</p>
                            </details>

                            <details data-cat="agenda">
                                <summary>Como usar uma data da agenda para criar conteúdo?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Em cada data de relevância, clique em "Criar conteúdo". O assistente abre com a categoria sugerida e você só completa o texto.</p>
                            </details>

                            <details data-cat="agenda">
                                <summary>Posso navegar para outros meses?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Sim. Use as setas ao lado do nome do mês para avançar ou voltar, e o botão "Hoje" para retornar ao mês atual.</p>
                            </details>

                            <details data-cat="mensagens">
                                <summary>Onde vejo as decisões da moderação?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Clique no sino no topo da página ou abra o menu Feedback. Lá aparecem as publicações aprovadas e recusadas, com o motivo da recusa.</p>
                            </details>

                            <details data-cat="mensagens">
                                <summary>Como reenviar uma publicação recusada?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Abra a publicação em Feedback ou Conteúdos, ajuste o que a moderação pediu e envie novamente para revisão.</p>
                            </details>

                            <details data-cat="conteudo">
                                <summary>Como publicar conteúdos na plataforma?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Em Conteúdos, clique em "Criar conteúdo", preencha as etapas e envie para análise. Após a aprovação da equipe, ela fica disponível.</p>
                            </details>

                            <details data-cat="conteudo">
                                <summary>Posso salvar e continuar depois?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Sim. Use "Salvar rascunho" em qualquer etapa. O rascunho fica em Conteúdos e pode ser editado quando você quiser.</p>
                            </details>

                            <details data-cat="conteudo">
                                <summary>Como acessar meus laudos e relatórios?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>Os relatórios ficam disponíveis no menu Relatórios, organizados por período, e podem ser exportados.</p>
                            </details>

                            <details data-cat="conteudo">
                                <summary>Qual a diferença entre título e mensagem principal?
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                                </summary>
                                <p>O título identifica a publicação. A mensagem principal é a frase de destaque que aparece na arte, logo abaixo do título.</p>
                            </details>

                            <p class="sp-vazio" id="spVazio" hidden>Nenhuma pergunta encontrada. Tente outra palavra ou fale com a equipe.</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h3>Status dos serviços</h3>
                        </div>

                        <div class="sp-status">
                            <div class="sp-status-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="12" rx="2" /><path d="M8 20h8M12 16v4" /></svg>
                                Plataforma Vênus
                                <span class="sp-badge-ok">Operacional</span>
                            </div>
                            <div class="sp-status-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2" /><path d="M3 10h18M8 3v4M16 3v4" /></svg>
                                Agenda
                                <span class="sp-badge-ok">Operacional</span>
                            </div>
                            <div class="sp-status-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8Z" /><path d="M14 3v5h5" /></svg>
                                Publicações
                                <span class="sp-badge-ok">Operacional</span>
                            </div>
                            <div class="sp-status-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 1 0-12 0c0 7-3 8-3 8h18s-3-1-3-8" /><path d="M13.7 21a2 2 0 0 1-3.4 0" /></svg>
                                Notificações
                                <span class="sp-badge-ok">Operacional</span>
                            </div>
                            <div class="sp-status-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 14v-2a8 8 0 0 1 16 0v2" /><rect x="3" y="14" width="4" height="6" rx="1.5" /><rect x="17" y="14" width="4" height="6" rx="1.5" /></svg>
                                Suporte
                                <span class="sp-badge-ok">Operacional</span>
                            </div>
                        </div>

                        <div class="sp-updated">
                            Última atualização: 10/09/2026 às 22:30
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 1 1-3-6.7L21 8" /><path d="M21 3v5h-5" /></svg>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h3>Canais de atendimento</h3>
                        </div>

                        <div class="sp-channels">
                            <a href="mailto:SuporteVenus&#64;gmail.com?subject=Atendimento%20-%20Portal%20do%20Profissional" class="sp-channel">
                                <span class="sp-channel-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a8 8 0 0 1-11.5 7.2L4 20l1-4.6A8 8 0 1 1 21 12Z" /></svg>
                                </span>
                                <div>
                                    <strong>Chat online</strong>
                                    <span>Atendimento em tempo real</span>
                                </div>
                                <svg class="sp-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                            </a>

                            <a href="mailto:SuporteVenus&#64;gmail.com" class="sp-channel">
                                <span class="sp-channel-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="M3 7l9 6 9-6" /></svg>
                                </span>
                                <div>
                                    <strong>E-mail</strong>
                                    <span>SuporteVenus&#64;gmail.com</span>
                                </div>
                                <svg class="sp-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                            </a>

                            <a href="tel:08001234567" class="sp-channel">
                                <span class="sp-channel-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z" /></svg>
                                </span>
                                <div>
                                    <strong>Telefone</strong>
                                    <span>0800 123 4567 · Seg a Sex, 8h às 18h</span>
                                </div>
                                <svg class="sp-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6" /></svg>
                            </a>
                        </div>
                    </div>

                </div>

                <p class="sp-footer">Vênus • A Saúde da Mulher</p>

            </main>

        </div>

    </div>

    <script>
        // Central de ajuda: busca + botões de categoria filtram as perguntas frequentes
        (function () {
            var busca = document.getElementById('spBusca');
            var perguntas = document.querySelectorAll('#spFaq details');
            var botoes = document.querySelectorAll('.sp-cat[data-cat]');
            var aviso = document.getElementById('spFiltro');
            var avisoNome = document.getElementById('spFiltroNome');
            var vazio = document.getElementById('spVazio');
            var faq = document.getElementById('spFaq');
            var categoria = '';

            function aplicar() {
                var termo = busca ? busca.value.toLowerCase().trim() : '';
                var visiveis = 0;

                perguntas.forEach(function (item) {
                    var okCat = categoria === '' || item.getAttribute('data-cat') === categoria;
                    var okBusca = termo === '' || item.textContent.toLowerCase().indexOf(termo) !== -1;
                    var mostra = okCat && okBusca;
                    item.style.display = mostra ? '' : 'none';
                    if (mostra) visiveis++;
                });

                vazio.hidden = visiveis > 0;

                botoes.forEach(function (b) {
                    var ativo = b.getAttribute('data-cat') === categoria;
                    b.classList.toggle('is-active', ativo);
                    b.setAttribute('aria-pressed', ativo ? 'true' : 'false');
                    if (ativo) avisoNome.textContent = b.textContent.replace(/\s+/g, ' ').trim();
                });
                aviso.hidden = categoria === '';
            }

            function escolher(cat) {
                categoria = (cat === categoria) ? '' : cat;   // clicar de novo desmarca
                aplicar();
                if (categoria) {
                    // abre a primeira pergunta da categoria e leva a pessoa até a lista
                    perguntas.forEach(function (d) { d.open = false; });
                    var primeira = document.querySelector('#spFaq details[data-cat="' + categoria + '"]');
                    if (primeira) primeira.open = true;
                    faq.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }

            botoes.forEach(function (b) {
                b.addEventListener('click', function (e) {
                    e.preventDefault();
                    escolher(b.getAttribute('data-cat'));
                });
            });

            function limpar(e) {
                if (e) e.preventDefault();
                categoria = '';
                if (busca) busca.value = '';
                perguntas.forEach(function (d) { d.open = false; });
                aplicar();
            }
            document.getElementById('spLimpar').addEventListener('click', limpar);
            document.getElementById('spVerTodas').addEventListener('click', limpar);

            if (busca) busca.addEventListener('input', aplicar);
            aplicar();
        })();
    </script>

</body>

</html>