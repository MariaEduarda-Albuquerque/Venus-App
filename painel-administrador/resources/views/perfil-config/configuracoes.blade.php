@extends('layouts.app')

@section('titulo', 'Configurações - Painel Administrativo - Vênus')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">
@endpush

@section('content')

<div class="cfg-page">

    {{-- Título + botão salvar --}}
    <div class="cfg-topo">
        <div>
            <h1>Configurações</h1>
            <p class="cfg-mute">Gerencie sua conta, segurança e preferências.</p>
        </div>
        <button type="submit" form="cfg-form" class="cfg-btn cfg-btn--primario">
            <i data-lucide="save"></i>Salvar alterações
        </button>
    </div>

    <div class="cfg-layout">

        {{-- Menu lateral das configurações --}}
        <div class="cfg-card cfg-menu">
            <div class="cfg-quem">
                <div class="cfg-avatar">C</div>
                <div>
                    <b>Clodo Almeida</b>
                    <div class="cfg-mute">ClodoAlmeida@gmail.com</div>
                </div>
            </div>

            <nav class="cfg-menu-lista" aria-label="Seções das configurações">
                <button type="button" class="cfg-item is-active" data-aba="conta" aria-current="true">
                    <i data-lucide="user-round"></i>Conta
                </button>
                <button type="button" class="cfg-item" data-aba="seguranca">
                    <i data-lucide="shield-check"></i>Segurança
                </button>
                <button type="button" class="cfg-item" data-aba="aparencia">
                    <i data-lucide="palette"></i>Aparência
                </button>
                <button type="button" class="cfg-item" data-aba="notificacoes">
                    <i data-lucide="bell"></i>Notificações
                </button>
                <button type="button" class="cfg-item cfg-item--risco" data-aba="risco">
                    <i data-lucide="triangle-alert"></i>Zona de risco
                </button>
            </nav>
        </div>

        {{-- Conteúdo --}}
        {{-- TODO (back-end): colocar method, action e @csrf --}}
        <form id="cfg-form" class="cfg-conteudo">

            {{-- CONTA --}}
            <section class="cfg-card cfg-painel is-active" id="aba-conta">
                <div class="cfg-painel-topo">
                    <div class="cfg-icone"><i data-lucide="user-round"></i></div>
                    <div>
                        <h3>Conta</h3>
                        <p class="cfg-mute">Dados de acesso e dispositivos conectados.</p>
                    </div>
                </div>

                <div class="cfg-linha">
                    <div>
                        <div class="cfg-mute">E-mail de login</div>
                        <b class="cfg-valor">ClodoAlmeida@gmail.com</b>
                    </div>
                    {{-- TODO (back-end): trocar # pela rota de editar perfil --}}
                    <a href="#" class="cfg-btn cfg-btn--neutro cfg-btn--pequeno">
                        <i data-lucide="pencil"></i>Editar
                    </a>
                </div>

                <div class="cfg-linha">
                    <div>
                        <b>Senha</b>
                        <div class="cfg-mute">Recomendamos trocar a cada 90 dias.</div>
                    </div>
                    {{-- TODO: ligar ao envio do link de redefinição de senha --}}
                    <button type="button" class="cfg-btn cfg-btn--neutro cfg-btn--pequeno"
                            data-toast="Enviamos um link para redefinir sua senha.">
                        <i data-lucide="key-round"></i>Alterar senha
                    </button>
                </div>

                <h3 class="cfg-subtitulo">Sessões ativas</h3>

                {{-- Exemplo estático: trocar por @foreach quando tiver as sessões reais --}}
                <div class="cfg-sessao">
                    <div class="cfg-icone"><i data-lucide="monitor"></i></div>
                    <div class="cfg-sessao-info">
                        <b>Chrome · Windows</b>
                        <div class="cfg-mute">São Paulo, SP · agora</div>
                    </div>
                    <span class="cfg-chip cfg-chip--ok">Esta sessão</span>
                </div>

                <div class="cfg-sessao">
                    <div class="cfg-icone"><i data-lucide="smartphone"></i></div>
                    <div class="cfg-sessao-info">
                        <b>Safari · iPhone</b>
                        <div class="cfg-mute">São Paulo, SP · há 3 horas</div>
                    </div>
                    <button type="button" class="cfg-btn cfg-btn--perigo cfg-btn--pequeno" data-encerrar>Encerrar</button>
                </div>

                <div class="cfg-sessao">
                    <div class="cfg-icone"><i data-lucide="laptop"></i></div>
                    <div class="cfg-sessao-info">
                        <b>Firefox · macOS</b>
                        <div class="cfg-mute">Campinas, SP · ontem</div>
                    </div>
                    <button type="button" class="cfg-btn cfg-btn--perigo cfg-btn--pequeno" data-encerrar>Encerrar</button>
                </div>
            </section>

            {{-- SEGURANÇA --}}
            <section class="cfg-card cfg-painel" id="aba-seguranca">
                <div class="cfg-painel-topo">
                    <div class="cfg-icone"><i data-lucide="shield-check"></i></div>
                    <div>
                        <h3>Segurança</h3>
                        <p class="cfg-mute">Verificação em duas etapas, obrigatória para Admin.</p>
                    </div>
                </div>

                <div class="cfg-linha">
                    <div>
                        <b>Autenticação de dois fatores</b>
                        <div class="cfg-mute">Não pode ser desativada no papel Admin.</div>
                    </div>
                    <label class="cfg-tog">
                        <input type="checkbox" checked disabled aria-label="Autenticação de dois fatores">
                        <i></i>
                    </label>
                </div>

                <div class="cfg-linha">
                    <div>
                        <div class="cfg-mute">E-mail para envio do código</div>
                        <b class="cfg-valor" data-valor data-visivel="0"
                           data-completo="ClodoAlmeida@gmail.com" data-oculto="C•••••••@gmail.com">C•••••••@gmail.com</b>
                    </div>
                    <div class="cfg-icones">
                        <button type="button" class="cfg-icone-btn" data-olho aria-label="Mostrar e-mail">
                            <i data-lucide="eye"></i>
                        </button>
                        {{-- TODO: ligar à troca de e-mail do código --}}
                        <button type="button" class="cfg-icone-btn" aria-label="Editar e-mail"
                                data-toast="Enviamos um código para confirmar a alteração.">
                            <i data-lucide="pencil"></i>
                        </button>
                    </div>
                </div>

                <div class="cfg-linha">
                    <div>
                        <div class="cfg-mute">Telefone para envio do código</div>
                        <b class="cfg-valor" data-valor data-visivel="0"
                           data-completo="11 99999-9999" data-oculto="•• •••••-••99">•• •••••-••99</b>
                    </div>
                    <div class="cfg-icones">
                        <button type="button" class="cfg-icone-btn" data-olho aria-label="Mostrar telefone">
                            <i data-lucide="eye"></i>
                        </button>
                        {{-- TODO: ligar à troca de telefone do código --}}
                        <button type="button" class="cfg-icone-btn" aria-label="Editar telefone"
                                data-toast="Enviamos um código para confirmar a alteração.">
                            <i data-lucide="pencil"></i>
                        </button>
                    </div>
                </div>
            </section>

            {{-- APARÊNCIA --}}
            <section class="cfg-card cfg-painel" id="aba-aparencia">
                <div class="cfg-painel-topo">
                    <div class="cfg-icone"><i data-lucide="palette"></i></div>
                    <div>
                        <h3>Aparência</h3>
                        <p class="cfg-mute">Tema e idioma do painel.</p>
                    </div>
                </div>

                <div class="cfg-rotulo">Tema</div>
                <div class="cfg-temas">
                    <label class="cfg-tema">
                        <input type="radio" name="tema" value="claro">
                        <span class="cfg-previa cfg-previa--claro"><span></span><span></span></span>
                        <span class="cfg-tema-nome"><i data-lucide="sun"></i>Claro</span>
                    </label>

                    <label class="cfg-tema">
                        <input type="radio" name="tema" value="escuro">
                        <span class="cfg-previa cfg-previa--escuro"><span></span><span></span></span>
                        <span class="cfg-tema-nome"><i data-lucide="moon"></i>Escuro</span>
                    </label>

                    <label class="cfg-tema">
                        <input type="radio" name="tema" value="sistema" checked>
                        <span class="cfg-previa cfg-previa--sistema"><span></span><span></span></span>
                        <span class="cfg-tema-nome"><i data-lucide="monitor"></i>Sistema</span>
                    </label>
                </div>

                <div class="cfg-campo">
                    <label for="idioma">Idioma</label>
                    <select id="idioma" name="idioma">
                        <option value="pt-BR" selected>Português (Brasil)</option>
                        <option value="en"   >English</option>
                        <option value="es"   >Español</option>
                    </select>
                </div>
            </section>

            {{-- NOTIFICAÇÕES --}}
            <section class="cfg-card cfg-painel" id="aba-notificacoes">
                <div class="cfg-painel-topo">
                    <div class="cfg-icone"><i data-lucide="bell"></i></div>
                    <div>
                        <h3>Notificações</h3>
                        <p class="cfg-mute">Escolha o que merece sua atenção.</p>
                    </div>
                </div>

                <div class="cfg-linha">
                    <div>
                        <b>Denúncias de gravidade alta</b>
                        <div class="cfg-mute">Aviso imediato quando algo urgente chegar.</div>
                    </div>
                    <label class="cfg-tog">
                        <input type="checkbox" name="notif_denuncias" value="1" checked aria-label="Denúncias de gravidade alta">
                        <i></i>
                    </label>
                </div>

                <div class="cfg-linha">
                    <div>
                        <b>Novos cadastros de profissionais</b>
                        <div class="cfg-mute">Quando um cadastro entrar na fila de aprovação.</div>
                    </div>
                    <label class="cfg-tog">
                        <input type="checkbox" name="notif_cadastros" value="1" checked aria-label="Novos cadastros de profissionais">
                        <i></i>
                    </label>
                </div>

                <div class="cfg-linha">
                    <div>
                        <b>Conteúdos para revisão</b>
                        <div class="cfg-mute">Artigos e vídeos enviados pelos profissionais.</div>
                    </div>
                    <label class="cfg-tog">
                        <input type="checkbox" name="notif_conteudos" value="1" aria-label="Conteúdos para revisão">
                        <i></i>
                    </label>
                </div>

                <div class="cfg-linha">
                    <div>
                        <b>Som e pop-ups</b>
                        <div class="cfg-mute">Alertas sonoros e janelas na tela.</div>
                    </div>
                    <label class="cfg-tog">
                        <input type="checkbox" name="notif_som_popup" value="1" aria-label="Som e pop-ups">
                        <i></i>
                    </label>
                </div>
            </section>

            {{-- ZONA DE RISCO --}}
            <section class="cfg-card cfg-painel" id="aba-risco">
                <div class="cfg-painel-topo">
                    <div class="cfg-icone cfg-icone--perigo"><i data-lucide="triangle-alert"></i></div>
                    <div>
                        <h3>Zona de risco</h3>
                        <p class="cfg-mute">Ações de alto impacto, pedimos confirmação.</p>
                    </div>
                </div>

                <div class="cfg-perigo">
                    <div>
                        <b>Sair de todos os dispositivos</b>
                        <div class="cfg-mute">Encerra todas as sessões, inclusive esta. Você precisará entrar de novo.</div>
                    </div>
                    <button type="button" class="cfg-btn cfg-btn--perigo" data-abrir-modal>
                        <i data-lucide="log-out"></i>Sair de todos
                    </button>
                </div>
            </section>

        </form>
    </div>

    {{-- Modal de confirmação --}}
    <div class="cfg-modal" id="cfg-modal" role="dialog" aria-modal="true" aria-labelledby="cfg-modal-titulo">
        <div class="cfg-card cfg-modal-caixa">
            <div class="cfg-icone cfg-icone--perigo"><i data-lucide="log-out"></i></div>
            <h3 id="cfg-modal-titulo">Sair de todos os dispositivos?</h3>
            <p>Todas as sessões serão encerradas, inclusive esta.</p>

            <div class="cfg-modal-acoes">
                <button type="button" class="cfg-btn cfg-btn--neutro" data-fechar-modal>Cancelar</button>
                {{-- TODO (back-end): transformar em form POST para o logout --}}
                <button type="button" class="cfg-btn cfg-btn--perigo" data-confirmar-sair>Sair de todos</button>
            </div>
        </div>
    </div>

    {{-- Aviso rápido --}}
    <div class="cfg-toast" id="cfg-toast" role="status" aria-live="polite">
        <i data-lucide="check-circle-2"></i><span></span>
    </div>

</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/configuracoes.js') }}"></script>
@endpush