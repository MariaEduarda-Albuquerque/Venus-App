/* =========================================================
   ANÁLISE DO CADASTRO (botão "Analisar")
   JavaScript básico: só getElementById, querySelector,
   classList.add/remove, if e for.
   As funções abaixo são chamadas pelos onclick / onchange /
   oninput que estão no HTML.
   ========================================================= */


/* =========================================================
   1) INFORMAÇÕES GUARDADAS (o "estado" da tela)
   ========================================================= */

// Quais dos 3 documentos já foram abertos (o primeiro já aparece aberto)
var documentoVisto = [true, false, false];

// Vira true quando clicam em "Abrir consulta pública"
var consultaAberta = false;

// Zoom do documento (1 = 100%) e giro em graus
var zoom = 1;
var giro = 0;

// Qual decisão está no modal: 'aprovar', 'reenvio' ou 'reprovar'
var decisaoAtual = '';

// Guarda o temporizador do aviso rápido
var tempoAviso;

// Quantos itens tem o checklist
var TOTAL_ITENS = 5;

// Tamanho de uma volta completa do anel de progresso (2 x 3,14 x raio 36)
var VOLTA_DO_ANEL = 226.2;


/* =========================================================
   2) ATUALIZAR A TELA
   Roda sempre que algo muda: passos, anel, botão "Aprovar"
   ========================================================= */
function atualizarTela() {

    // --- Conta quantos itens do checklist estão marcados ---
    var marcados = 0;
    for (var i = 0; i < TOTAL_ITENS; i++) {
        var caixa = document.getElementById('dc-check-' + i);
        var item = document.getElementById('dc-item-' + i);

        if (caixa.checked) {
            marcados = marcados + 1;
            item.classList.add('is-on');       // pinta o item de rosa
        } else {
            item.classList.remove('is-on');
        }
    }

    // --- Confere se os 3 documentos já foram abertos ---
    var viuTodos = true;
    for (var d = 0; d < 3; d++) {
        if (documentoVisto[d] == false) {
            viuTodos = false;
        }
    }

    // --- Passos da análise ---
    // Cada passo fica "pronto" quando a condição dele é cumprida.
    // O 4º passo (Decidir) nunca fica pronto.
    var cumpridos = [viuTodos, consultaAberta, marcados == TOTAL_ITENS, false];

    // O passo atual é o primeiro que ainda não está pronto
    var passoAtual = 3;
    for (var p = 3; p >= 0; p--) {
        if (cumpridos[p] == false) {
            passoAtual = p;
        }
    }

    // Atualiza o visual de cada passo
    for (var n = 0; n < 4; n++) {
        var passo = document.getElementById('dc-passo-' + n);
        var numero = document.getElementById('dc-passo-num-' + n);

        passo.classList.remove('is-done');
        passo.classList.remove('is-on');
        numero.textContent = n + 1;

        // Passo pronto: fica com ✓
        if (n < 3 && cumpridos[n] == true) {
            passo.classList.add('is-done');
            numero.textContent = '✓';
        }

        // Passo atual: fica destacado em vinho
        if (n == passoAtual) {
            passo.classList.add('is-on');
        }
    }

    // --- Anel de progresso do checklist ---
    var anel = document.getElementById('dc-anel');
    var progresso = document.getElementById('dc-anel-progresso');
    var parteDoAnel = VOLTA_DO_ANEL * marcados / TOTAL_ITENS;

    progresso.style.strokeDasharray = parteDoAnel + ' ' + VOLTA_DO_ANEL;
    document.getElementById('dc-anel-texto').textContent = marcados + '/' + TOTAL_ITENS;

    // Anel verde quando o checklist está completo
    if (marcados == TOTAL_ITENS) {
        anel.classList.add('is-completo');
    } else {
        anel.classList.remove('is-completo');
    }

    // --- Botão "Aprovar" e aviso de quantos itens faltam ---
    var faltam = TOTAL_ITENS - marcados;
    var botaoAprovar = document.getElementById('dc-aprovar');
    var textoFaltam = document.getElementById('dc-faltam');

    if (faltam > 0) {
        botaoAprovar.disabled = true;      // bloqueado até marcar tudo
        textoFaltam.hidden = false;

        if (faltam == 1) {
            textoFaltam.textContent = 'Falta 1 item do checklist para liberar a aprovação.';
        } else {
            textoFaltam.textContent = 'Faltam ' + faltam + ' itens do checklist para liberar a aprovação.';
        }
    } else {
        botaoAprovar.disabled = false;     // liberado
        textoFaltam.hidden = true;
    }

    // --- Texto de ajuda da consulta pública ---
    var dicaConsulta = document.getElementById('dc-consulta-dica');
    if (consultaAberta == true) {
        dicaConsulta.textContent = '✓ Consulta aberta. Volte aqui e marque o checklist.';
    } else {
        dicaConsulta.textContent = 'Confirme nome, número e situação no site oficial.';
    }
}


/* =========================================================
   3) DOCUMENTOS (abas, zoom e giro)
   ========================================================= */

// Mostra o documento escolhido (0, 1 ou 2) e esconde os outros
function abrirDocumento(numero) {
    documentoVisto[numero] = true;

    for (var i = 0; i < 3; i++) {
        var papel = document.getElementById('dc-doc-' + i);
        var aba = document.getElementById('dc-aba-' + i);

        if (i == numero) {
            papel.hidden = false;
            aba.classList.add('is-active');
        } else {
            papel.hidden = true;
            aba.classList.remove('is-active');
        }
    }

    atualizarTela();
}

// Aplica o zoom e o giro no documento (o CSS usa as variáveis --zoom e --giro)
function ajustarDocumento() {
    var palco = document.getElementById('dc-palco');

    palco.style.setProperty('--zoom', zoom);
    palco.style.setProperty('--giro', giro + 'deg');

    document.getElementById('dc-zoom-texto').textContent = Math.round(zoom * 100) + '%';
}

function aumentarZoom() {
    zoom = zoom + 0.2;
    if (zoom > 1.6) {
        zoom = 1.6;                        // limite máximo: 160%
    }
    ajustarDocumento();
}

function diminuirZoom() {
    zoom = zoom - 0.2;
    if (zoom < 0.6) {
        zoom = 0.6;                        // limite mínimo: 60%
    }
    ajustarDocumento();
}

function girarDocumento() {
    giro = giro + 90;
    if (giro == 360) {
        giro = 0;                          // completou uma volta
    }
    ajustarDocumento();
}


/* =========================================================
   4) VERIFICAÇÃO EXTERNA (consulta no site do conselho)
   ========================================================= */

// Clicou em "Abrir consulta pública" (o link abre sozinho em outra aba)
function abrirConsulta() {
    consultaAberta = true;
    atualizarTela();
}

// Copia o número do conselho
function copiarNumero() {
    var numero = document.getElementById('dc-numero').textContent;

    if (navigator.clipboard) {
        navigator.clipboard.writeText(numero);
    }
    mostrarAviso('Número copiado.');
}


/* =========================================================
   5) AVISO RÁPIDO
   ========================================================= */

function mostrarAviso(texto) {
    var aviso = document.getElementById('dc-toast');

    aviso.querySelector('span').textContent = texto;
    aviso.classList.add('is-show');

    // Some sozinho depois de 2,4 segundos
    clearTimeout(tempoAviso);
    tempoAviso = setTimeout(esconderAviso, 2400);
}

function esconderAviso() {
    document.getElementById('dc-toast').classList.remove('is-show');
}


/* =========================================================
   6) MODAL DE DECISÃO (aprovar, solicitar reenvio ou reprovar)
   ========================================================= */

function abrirModalDecisao(tipo) {
    decisaoAtual = tipo;

    var nome = document.getElementById('dc-nome').textContent;
    var botao = document.getElementById('dc-confirmar');

    // --- Começa do zero: esconde tudo e limpa o motivo ---
    document.getElementById('dc-icone-aprovar').hidden = true;
    document.getElementById('dc-icone-reenvio').hidden = true;
    document.getElementById('dc-icone-reprovar').hidden = true;
    document.getElementById('dc-motivos-reenvio').hidden = true;
    document.getElementById('dc-motivos-reprovar').hidden = true;
    document.getElementById('dc-motivo-bloco').hidden = true;
    document.getElementById('dc-motivo').value = '';
    document.getElementById('dc-motivo-caixa').classList.remove('is-erro');

    botao.classList.remove('lst-btn--ok');
    botao.classList.remove('lst-btn--primario');
    botao.classList.remove('lst-btn--perigo');

    // --- Monta o modal de acordo com a decisão ---
    if (tipo == 'aprovar') {
        document.getElementById('dc-icone-aprovar').hidden = false;
        document.getElementById('dc-modal-titulo').textContent = 'Aprovar ' + nome + '?';
        document.getElementById('dc-modal-texto').textContent = 'O acesso ao portal é liberado na hora e o e-mail de boas-vindas é enviado.';
        botao.textContent = 'Aprovar';
        botao.classList.add('lst-btn--ok');
    }

    if (tipo == 'reenvio') {
        document.getElementById('dc-icone-reenvio').hidden = false;
        document.getElementById('dc-modal-titulo').textContent = 'Solicitar reenvio';
        document.getElementById('dc-modal-texto').textContent = 'O motivo é enviado por e-mail para ' + nome + '.';
        document.getElementById('dc-motivo-bloco').hidden = false;
        document.getElementById('dc-motivos-reenvio').hidden = false;
        botao.textContent = 'Enviar solicitação';
        botao.classList.add('lst-btn--primario');
    }

    if (tipo == 'reprovar') {
        document.getElementById('dc-icone-reprovar').hidden = false;
        document.getElementById('dc-modal-titulo').textContent = 'Reprovar cadastro?';
        document.getElementById('dc-modal-texto').textContent = 'Use quando o registro não for localizado ou houver irregularidade. O motivo fica no log.';
        document.getElementById('dc-motivo-bloco').hidden = false;
        document.getElementById('dc-motivos-reprovar').hidden = false;
        botao.textContent = 'Reprovar';
        botao.classList.add('lst-btn--perigo');
    }

    // --- Abre o modal ---
    document.getElementById('dc-modal').classList.add('is-open');

    // Leva o cursor para o lugar certo
    if (tipo == 'aprovar') {
        botao.focus();
    } else {
        document.getElementById('dc-motivo').focus();
    }
}

function fecharModalDecisao() {
    document.getElementById('dc-modal').classList.remove('is-open');
    decisaoAtual = '';
}

// Clicou em um motivo pronto: coloca o texto na caixa
function usarMotivo(texto) {
    var campo = document.getElementById('dc-motivo');

    if (campo.value != '') {
        campo.value = campo.value + ' ' + texto + '.';
    } else {
        campo.value = texto + '.';
    }

    limparErroMotivo();
    campo.focus();
}

// Tira o aviso vermelho quando o motivo já tem texto suficiente
function limparErroMotivo() {
    var motivo = document.getElementById('dc-motivo').value;

    if (motivo.trim().length >= 10) {
        document.getElementById('dc-motivo-caixa').classList.remove('is-erro');
    }
}

// Clicou no botão de confirmar do modal
function confirmarDecisao() {

    // Reenvio e reprovação exigem um motivo de pelo menos 10 letras
    if (decisaoAtual != 'aprovar') {
        var motivo = document.getElementById('dc-motivo').value;

        if (motivo.trim().length < 10) {
            document.getElementById('dc-motivo-caixa').classList.add('is-erro');
            document.getElementById('dc-motivo').focus();
            return;                        // para aqui e não confirma
        }
    }

    // TODO (back-end): salvar a decisão (e o motivo) e abrir o próximo cadastro da fila

    // Escolhe a mensagem do aviso
    var mensagem = '';
    if (decisaoAtual == 'aprovar') {
        mensagem = 'Cadastro aprovado.';
    }
    if (decisaoAtual == 'reenvio') {
        mensagem = 'Reenvio solicitado.';
    }
    if (decisaoAtual == 'reprovar') {
        mensagem = 'Cadastro reprovado.';
    }

    fecharModalDecisao();
    mostrarAviso(mensagem);

    // Depois de 0,9 segundo volta para a lista
    setTimeout(irParaLista, 900);
}

function irParaLista() {
    window.location.href = document.getElementById('dc-confirmar').dataset.destino;
}


/* =========================================================
   7) AO ABRIR A PÁGINA
   ========================================================= */
atualizarTela();
ajustarDocumento();