/* =========================================================
   FUNÇÕES QUE VÁRIAS PÁGINAS USAM
   ========================================================= */

// Recria os ícones (biblioteca Lucide)
function criarIcones() {
    if (window.lucide) {
        lucide.createIcons();
    }
}

// Troca o texto de um elemento pelo id dele
function escreverTexto(id, texto) {
    document.getElementById(id).textContent = texto;
}

// Deixa o texto minúsculo e sem acento (para a busca achar "Maria" digitando "maria")
function normalizar(texto) {
    return texto.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
}

// Troca 2026-09-30 por 30/09/2026
function dataBR(iso) {
    const partes = iso.split('-');
    return partes[2] + '/' + partes[1] + '/' + partes[0];
}

// Evita que um texto digitado vire código HTML
function escapar(texto) {
    const div = document.createElement('div');
    div.textContent = texto;
    return div.innerHTML;
}

// Mostra o aviso (toast) por alguns segundos
function mostrarToast(toast, texto) {
    toast.querySelector('span').textContent = texto;
    toast.classList.add('is-show');
    clearTimeout(toast.tempo);
    toast.tempo = setTimeout(function () {
        toast.classList.remove('is-show');
    }, 2600);
}

// Troca o texto e a cor do selo de status
// "mapa" é uma lista como: { pendente: { rotulo: 'Pendente', classe: 'lst-status--pendente' } }
function trocarStatus(elemento, mapa, status) {
    for (const chave in mapa) {
        if (mapa[chave].classe) {
            elemento.classList.remove(mapa[chave].classe);
        }
    }
    if (mapa[status].classe) {
        elemento.classList.add(mapa[status].classe);
    }
    elemento.textContent = mapa[status].rotulo;
}

// Marca ou desmarca os botões/cards que estão "ativos" (usa a classe is-active)
function marcarAtivos(lista, atributo, valorAtivo, soCards) {
    for (let i = 0; i < lista.length; i++) {
        const botao = lista[i];
        let ativo = botao.dataset[atributo] === valorAtivo;
        if (soCards) {
            ativo = ativo && botao.classList.contains('lst-kpi');
        }
        botao.classList.toggle('is-active', ativo);
        botao.setAttribute('aria-pressed', ativo);
    }
}

// Põe a setinha ↑ ou ↓ no título da coluna que está ordenando a tabela
function marcarOrdem(pagina, chave, direcao) {
    const titulos = pagina.querySelectorAll('th');
    for (let i = 0; i < titulos.length; i++) {
        const botao = titulos[i].querySelector('[data-ordenar]');
        if (!botao) {
            continue;
        }
        let valor = 'none';
        if (botao.dataset.ordenar === chave) {
            valor = direcao === 1 ? 'ascending' : 'descending';
        }
        titulos[i].setAttribute('aria-sort', valor);
    }
}

// Gera o PDF de uma lista (feedbacks, conteúdos e denúncias usam)
function baixarPdf(toast, titulo, cabecalho, linhas, nomeArquivo) {
    if (!window.jspdf) {
        mostrarToast(toast, 'Gerador de PDF indisponível. Verifique a conexão.');
        return;
    }

    const doc = new window.jspdf.jsPDF();

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(18);
    doc.setTextColor(155, 27, 42);
    doc.text('Vênus', 14, 18);

    doc.setFontSize(13);
    doc.setTextColor(43, 31, 34);
    doc.text(titulo, 14, 27);

    doc.setFont('helvetica', 'normal');
    doc.setFontSize(9);
    doc.setTextColor(126, 112, 117);
    doc.text('Gerado em ' + new Date().toLocaleString('pt-BR'), 14, 33);

    doc.autoTable({
        startY: 38,
        head: [cabecalho],
        body: linhas,
        styles: { font: 'helvetica', fontSize: 9, cellPadding: 3, textColor: [43, 31, 34] },
        headStyles: { fillColor: [155, 27, 42], textColor: 255 },
        alternateRowStyles: { fillColor: [253, 246, 247] },
        margin: { left: 14, right: 14, bottom: 18 }
    });

    // Número da página no rodapé
    const total = doc.getNumberOfPages();
    for (let i = 1; i <= total; i++) {
        doc.setPage(i);
        doc.setFontSize(8);
        doc.setTextColor(126, 112, 117);
        doc.text('Vênus · Painel administrativo · página ' + i + ' de ' + total, 14, 290);
    }

    doc.save(nomeArquivo + '-' + new Date().toISOString().slice(0, 10) + '.pdf');
    mostrarToast(toast, 'PDF gerado com sucesso.');
}


/* =========================================================
   Sidebar
   ========================================================= */
function sidebar() {
    // Quando clica num item que tem submenu, abre ou fecha SÓ ele
    document.addEventListener('click', function (e) {
        const botao = e.target.closest('[data-grp]');
        if (!botao) {
            return;
        }

        const submenu = document.getElementById(botao.dataset.grp);
        const menu = document.getElementById('side');

        // Se a sidebar estava compacta, volta ao tamanho normal
        if (menu) {
            menu.classList.remove('mini');
        }

        // Abre se estava fechado, fecha se estava aberto (os outros não mudam)
        const vaiAbrir = !submenu.classList.contains('open');
        submenu.classList.toggle('open', vaiAbrir);
        botao.classList.toggle('open', vaiAbrir);
    });
}

// O botão ☰ chama esta função (onclick="toggleMenu()")
function compactarSidebar() {
    const menu = document.getElementById('side');
    if (!menu) {
        return;
    }
    if (window.innerWidth > 1000) {
        menu.classList.toggle('mini');   // computador: deixa compacta
    } else {
        menu.classList.toggle('mob');    // celular: abre por cima
    }
}


/* =========================================================
   Modal Conteudos (modelo antigo)
   ========================================================= */
function abrirModal() {
    document.querySelector('.modal-overlay').classList.add('ativo');
    document.querySelector('.modal-conteudo').classList.add('ativo');
}

function fecharModal() {
    document.querySelector('.modal-overlay').classList.remove('ativo');
    document.querySelector('.modal-conteudo').classList.remove('ativo');
}

function abrirModalCompleto() {
    document.querySelector('.modal-conteudo').classList.remove('ativo');
    document.querySelector('.modal-overlay').classList.remove('ativo');
    document.querySelector('.modal-overlay-2').classList.add('ativo');
    document.querySelector('.modal-conteudo-completo').classList.add('ativo');
}

function fecharConteudoCompleto() {
    document.querySelector('.modal-conteudo').classList.add('ativo');
    document.querySelector('.modal-overlay').classList.add('ativo');
    document.querySelector('.modal-overlay-2').classList.remove('ativo');
    document.querySelector('.modal-conteudo-completo').classList.remove('ativo');
}

// Filtro (modelo antigo)
function abrirMenuFiltros() {
    document.querySelector('.filtro-menu').classList.toggle('ativo');
}

// Responder feedback (modelo antigo)
function responder() {
    document.querySelector('.modal-overlay').classList.add('ativo');
}

function responderFechar() {
    document.querySelector('.modal-overlay').classList.remove('ativo');
}


/* =========================================================
   configurações:
   ========================================================= */
function paginaConfiguracoes() {
    const pagina = document.querySelector('.cfg-page');
    if (!pagina) {
        return;
    }

    const toast = document.getElementById('cfg-toast');
    const modal = document.getElementById('cfg-modal');

    // Troca de aba (Conta, Segurança...)
    function abrirAba(nome) {
        const painel = document.getElementById('aba-' + nome);
        if (!painel) {
            return;
        }

        const botoes = pagina.querySelectorAll('[data-aba]');
        for (let i = 0; i < botoes.length; i++) {
            const ativo = botoes[i].dataset.aba === nome;
            botoes[i].classList.toggle('is-active', ativo);
            botoes[i].setAttribute('aria-current', ativo);
        }

        const paineis = pagina.querySelectorAll('.cfg-painel');
        for (let i = 0; i < paineis.length; i++) {
            paineis[i].classList.toggle('is-active', paineis[i] === painel);
        }
    }

    // Olhinho: mostra ou esconde o e-mail/telefone
    function alternarOlho(botao) {
        const valor = botao.closest('.cfg-linha').querySelector('[data-valor]');
        if (!valor) {
            return;
        }

        const estavaVisivel = valor.dataset.visivel === '1';
        if (estavaVisivel) {
            valor.textContent = valor.dataset.oculto;
            valor.dataset.visivel = '0';
            botao.innerHTML = '<i data-lucide="eye"></i>';
        } else {
            valor.textContent = valor.dataset.completo;
            valor.dataset.visivel = '1';
            botao.innerHTML = '<i data-lucide="eye-off"></i>';
        }
        criarIcones();
    }

    // Clique em qualquer lugar da página
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        const aba = alvo.closest('[data-aba]');
        if (aba) {
            abrirAba(aba.dataset.aba);
            return;
        }

        const olho = alvo.closest('[data-olho]');
        if (olho) {
            alternarOlho(olho);
            return;
        }

        const aviso = alvo.closest('[data-toast]');
        if (aviso) {
            mostrarToast(toast, aviso.dataset.toast);
            return;
        }

        const encerrar = alvo.closest('[data-encerrar]');
        if (encerrar) {
            // TODO: chamar o back-end para encerrar a sessão de verdade
            encerrar.closest('.cfg-sessao').remove();
            mostrarToast(toast, 'Sessão encerrada.');
            return;
        }

        if (alvo.closest('[data-abrir-modal]')) {
            modal.classList.add('is-open');
            return;
        }

        if (alvo.closest('[data-confirmar-sair]')) {
            // Página estática: só simula a saída de todos os dispositivos
            modal.classList.remove('is-open');
            mostrarToast(toast, 'Sessões encerradas (demonstração).');
            return;
        }

        // Fecha no botão "Cancelar" ou clicando no fundo escuro
        if (alvo.closest('[data-fechar-modal]') || alvo === modal) {
            modal.classList.remove('is-open');
        }
    });

    // Botão "Salvar": só mostra o aviso, sem recarregar a página
    document.getElementById('cfg-form').addEventListener('submit', function (e) {
        e.preventDefault();
        mostrarToast(toast, 'Alterações salvas (demonstração).');
    });

    // Tecla Esc fecha o modal
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            modal.classList.remove('is-open');
        }
    });

    // Abre uma aba direto pelo link, ex.: /configuracoes#seguranca
    if (location.hash) {
        abrirAba(location.hash.slice(1));
    }
}


/* =========================================================
   Grafico (Apache ECharts)
   (só cria o gráfico se a tela tiver o <div id="meuGrafico">)
   ========================================================= */
function paginaGrafico() {
    const caixa = document.getElementById('meuGrafico');
    if (!caixa || typeof echarts === 'undefined') {
        return;
    }

    const grafico = echarts.init(caixa);
    const cinza = { fontSize: 11, color: '#777' };

    grafico.setOption({
        textStyle: { fontFamily: 'Arial, Helvetica, sans-serif', color: '#777' },
        color: ['#EBA5B4', 'rgb(158, 24, 43)'],
        tooltip: { trigger: 'axis' },
        legend: {
            data: ['Usuárias', 'Profissionais'],
            right: 0, top: 0, icon: 'circle', itemWidth: 8, itemHeight: 8, textStyle: cinza
        },
        grid: { left: 0, right: 10, top: 36, bottom: 0, containLabel: true },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['23/03', '04/04', '11/04', '18/04', '25/04', '02/05', '09/05', '16/05'],
            axisLine: { show: false },
            axisTick: { show: false },
            axisLabel: cinza
        },
        yAxis: {
            type: 'value', min: 0, max: 1000, interval: 250,
            axisLabel: cinza,
            splitLine: { lineStyle: { color: '#ececec' } }
        },
        series: [
            {
                name: 'Usuárias', type: 'line', smooth: true, symbol: 'circle', symbolSize: 6,
                lineStyle: { width: 2 }, data: [260, 357, 287, 540, 600, 721, 610, 899]
            },
            {
                name: 'Profissionais', type: 'line', smooth: true, symbol: 'circle', symbolSize: 6,
                lineStyle: { width: 2 }, data: [160, 257, 187, 340, 200, 421, 510, 699]
            }
        ]
    });

    // Ajusta o gráfico quando a caixa muda de tamanho
    new ResizeObserver(function () {
        grafico.resize();
    }).observe(caixa);
}


/* =========================================================
   Listas: Feedbacks
   ========================================================= */
function paginaFeedbacks() {
    const pagina = document.querySelector('.lst-page');
    const corpo = document.getElementById('fb-corpo');
    if (!pagina || !corpo) {
        return;
    }

    const linhas = Array.from(corpo.querySelectorAll('tr[data-id]'));
    const linhaVazia = document.getElementById('fb-vazio');
    const toast = document.getElementById('fb-toast');
    const modal = document.getElementById('fb-modal');
    const campoResposta = document.getElementById('fb-campo');
    const botaoEnviar = document.getElementById('fb-enviar');
    const botaoAnalisar = document.getElementById('fb-analisar');

    let filtro = 'todos';                          // todos | pendente | respondido
    let busca = '';
    let ordemChave = 'data';
    let ordemDirecao = -1;                         // -1 = mais recentes primeiro
    let linhaAberta = null;

    // Texto da coluna "Assunto"
    function assuntoDa(linha) {
        return linha.cells[2].textContent.trim();
    }

    // Texto do selo: Pendente, Respondido ou Analisado
    function rotuloDa(linha) {
        if (linha.dataset.status === 'pendente') {
            return 'Pendente';
        }
        return linha.dataset.email ? 'Respondido' : 'Analisado';
    }

    // Atualiza selo e botão de uma linha
    function atualizarLinha(linha) {
        const pendente = linha.dataset.status === 'pendente';

        const selo = linha.querySelector('.lst-status');
        selo.textContent = rotuloDa(linha);
        selo.classList.toggle('lst-status--pendente', pendente);
        selo.classList.toggle('lst-status--ok', !pendente);

        const botao = linha.querySelector('.lst-btn');
        botao.textContent = pendente ? 'Responder' : 'Ver';
        botao.classList.toggle('lst-btn--primario', pendente);
        botao.classList.toggle('lst-btn--neutro', !pendente);
    }

    // Valor usado para ordenar uma linha
    function valorParaOrdenar(linha) {
        if (ordemChave === 'assunto') {
            return assuntoDa(linha);
        }
        return linha.dataset[ordemChave] || '';
    }

    // Ordena, filtra, busca e atualiza os contadores
    function aplicar() {
        // 1) Ordena as linhas (a linha "vazio" fica sempre no fim)
        linhas.sort(function (a, b) {
            const comparacao = valorParaOrdenar(a).localeCompare(valorParaOrdenar(b), 'pt-BR', { numeric: true });
            return comparacao * ordemDirecao;
        });
        for (let i = 0; i < linhas.length; i++) {
            corpo.insertBefore(linhas[i], linhaVazia);
        }

        // 2) Esconde as linhas que não passam no filtro ou na busca
        let visiveis = 0;
        for (let i = 0; i < linhas.length; i++) {
            const linha = linhas[i];
            const texto = normalizar((linha.dataset.email || 'anonimo') + ' ' + linha.dataset.id + ' ' + assuntoDa(linha));
            const passaFiltro = filtro === 'todos' || linha.dataset.status === filtro;

            linha.hidden = !(passaFiltro && texto.includes(busca));
            if (!linha.hidden) {
                visiveis++;
            }
        }
        linhaVazia.hidden = visiveis > 0;

        // 3) Números dos cards
        let pendentes = 0;
        for (let i = 0; i < linhas.length; i++) {
            if (linhas[i].dataset.status === 'pendente') {
                pendentes++;
            }
        }
        escreverTexto('fb-total', linhas.length);
        escreverTexto('fb-pendentes', pendentes);
        escreverTexto('fb-respondidos', linhas.length - pendentes);

        // 4) Visual dos cards, abas e setinha da ordenação
        marcarAtivos(pagina.querySelectorAll('[data-filtro]'), 'filtro', filtro, false);
        marcarOrdem(pagina, ordemChave, ordemDirecao);
    }

    function abrirModal(linha) {
        linhaAberta = linha;

        const email = linha.dataset.email;
        const anonimo = !email;
        const pendente = linha.dataset.status === 'pendente';
        const resposta = linha.dataset.resposta;

        escreverTexto('fb-avatar', anonimo ? '?' : email[0].toUpperCase());
        escreverTexto('fb-nome', anonimo ? 'Anônimo' : email);
        escreverTexto('fb-meta', linha.dataset.id + ' · ' + dataBR(linha.dataset.data));
        escreverTexto('fb-assunto', assuntoDa(linha));
        escreverTexto('fb-mensagem', linha.dataset.mensagem);
        escreverTexto('fb-resposta-texto', resposta || '');

        // Mostra ou esconde cada pedaço do modal
        document.getElementById('fb-resposta-bloco').hidden = pendente || !resposta;
        document.getElementById('fb-aviso').hidden = !(pendente && anonimo);
        document.getElementById('fb-responder').hidden = !(pendente && !anonimo);
        botaoEnviar.hidden = !(pendente && !anonimo);
        botaoAnalisar.hidden = !(pendente && anonimo);

        campoResposta.value = '';
        botaoEnviar.disabled = true;

        modal.classList.add('is-open');
    }

    function fecharModal() {
        modal.classList.remove('is-open');
        linhaAberta = null;
    }

    // Marca como respondido, atualiza a tela e fecha o modal
    function concluir(mensagem) {
        linhaAberta.dataset.status = 'respondido';
        atualizarLinha(linhaAberta);
        aplicar();
        fecharModal();
        mostrarToast(toast, mensagem);
    }

    // Cliques da página
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        // Cards e abas de filtro (clicar de novo num card ativo volta para "todos")
        const botaoFiltro = alvo.closest('[data-filtro]');
        if (botaoFiltro) {
            const ehCard = botaoFiltro.classList.contains('lst-kpi');
            if (ehCard && botaoFiltro.dataset.filtro === filtro) {
                filtro = 'todos';
            } else {
                filtro = botaoFiltro.dataset.filtro;
            }
            aplicar();
            return;
        }

        // Ordenar pelo título da coluna
        const botaoOrdenar = alvo.closest('[data-ordenar]');
        if (botaoOrdenar) {
            const chave = botaoOrdenar.dataset.ordenar;
            if (ordemChave === chave) {
                ordemDirecao = -ordemDirecao;
            } else {
                ordemDirecao = 1;
            }
            ordemChave = chave;
            aplicar();
            return;
        }

        // Baixar PDF (só as linhas que estão aparecendo)
        if (alvo.closest('[data-pdf]')) {
            const dados = [];
            for (let i = 0; i < linhas.length; i++) {
                const l = linhas[i];
                if (!l.hidden) {
                    dados.push([l.dataset.id, l.dataset.email || 'Anônimo', assuntoDa(l), l.dataset.mensagem, dataBR(l.dataset.data), rotuloDa(l)]);
                }
            }
            baixarPdf(toast, 'Feedbacks', ['ID', 'Usuária', 'Assunto', 'Mensagem', 'Data', 'Status'], dados, 'feedbacks');
            return;
        }

        // Respostas rápidas
        const rapida = alvo.closest('[data-texto]');
        if (rapida) {
            campoResposta.value = rapida.dataset.texto;
            botaoEnviar.disabled = false;
            campoResposta.focus();
            return;
        }

        // Enviar resposta
        if (alvo.closest('#fb-enviar')) {
            const texto = campoResposta.value.trim();
            if (linhaAberta && texto) {
                // TODO (back-end): enviar a resposta por e-mail e salvar no banco
                linhaAberta.dataset.resposta = texto;
                concluir('Resposta enviada para ' + linhaAberta.dataset.email + '.');
            }
            return;
        }

        // Marcar como analisado (feedback anônimo)
        if (alvo.closest('#fb-analisar')) {
            // TODO (back-end): salvar o status no banco
            if (linhaAberta) {
                concluir('Feedback marcado como analisado.');
            }
            return;
        }

        // Fechar o modal (botão ou clique no fundo escuro)
        if (alvo.closest('[data-fechar]') || alvo === modal) {
            fecharModal();
            return;
        }

        // Clicar numa linha abre o feedback
        const linha = alvo.closest('tr[data-id]');
        if (linha) {
            abrirModal(linha);
        }
    });

    // Busca
    document.getElementById('fb-busca').addEventListener('input', function (e) {
        busca = normalizar(e.target.value.trim());
        aplicar();
    });

    // O botão "Enviar" só liga quando tem texto
    campoResposta.addEventListener('input', function () {
        botaoEnviar.disabled = campoResposta.value.trim() === '';
    });

    // Esc fecha o modal
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            fecharModal();
        }
    });

    // Começo
    for (let i = 0; i < linhas.length; i++) {
        atualizarLinha(linhas[i]);
    }
    aplicar();
}


/* =========================================================
   Lista Conteudos Aprender
   ========================================================= */
function paginaConteudos() {
    const pagina = document.querySelector('.lst-page');
    const corpo = document.getElementById('ct-corpo');
    if (!pagina || !corpo) {
        return;
    }

    const linhas = Array.from(corpo.querySelectorAll('tr[data-id]'));
    const linhaVazia = document.getElementById('ct-vazio');
    const toast = document.getElementById('ct-toast');
    const menu = document.getElementById('ct-menu');
    const botaoFiltro = document.getElementById('ct-filtro-btn');
    const modal = document.getElementById('ct-modal');
    const modalCompleto = document.getElementById('ct-modal-completo');

    const STATUS = {
        analise:   { rotulo: 'Em análise', classe: 'lst-status--pendente' },
        publicado: { rotulo: 'Publicado',  classe: 'lst-status--ok' },
        recusado:  { rotulo: 'Recusado',   classe: 'lst-status--recusado' }
    };

    let filtro = 'todos';      // todos | analise | publicado | recusado
    let busca = '';
    let linhaAberta = null;

    // Texto de uma coluna: 0 ID, 1 Profissional, 2 Título, 3 Data, 4 Status
    function celula(linha, numero) {
        return linha.cells[numero].textContent.trim();
    }

    function abrirOuFecharMenu(abrir) {
        menu.classList.toggle('is-open', abrir);
        botaoFiltro.setAttribute('aria-expanded', abrir);
    }

    // Filtra e busca
    function aplicar() {
        let visiveis = 0;
        for (let i = 0; i < linhas.length; i++) {
            const linha = linhas[i];
            const texto = normalizar(celula(linha, 0) + ' ' + celula(linha, 1) + ' ' + celula(linha, 2));
            const passaFiltro = filtro === 'todos' || linha.dataset.status === filtro;

            linha.hidden = !(passaFiltro && texto.includes(busca));
            if (!linha.hidden) {
                visiveis++;
            }
        }
        linhaVazia.hidden = visiveis > 0;

        // Números dos cards
        let recusados = 0;
        let emAnalise = 0;
        let publicados = 0;
        for (let i = 0; i < linhas.length; i++) {
            const status = linhas[i].dataset.status;
            if (status === 'recusado') recusados++;
            if (status === 'analise') emAnalise++;
            if (status === 'publicado') publicados++;
        }
        escreverTexto('ct-recusados', recusados);
        escreverTexto('ct-analise', emAnalise);
        escreverTexto('ct-publicados', publicados);

        marcarAtivos(pagina.querySelectorAll('[data-filtro]'), 'filtro', filtro, true);
        escreverTexto('ct-filtro-rotulo', filtro === 'todos' ? 'Filtro' : STATUS[filtro].rotulo);
    }

    // Modal 1: revisão
    function abrirRevisao(linha) {
        linhaAberta = linha;
        const status = linha.dataset.status;

        escreverTexto('ct-avatar', linha.dataset.nome[0].toUpperCase());
        escreverTexto('ct-nome', linha.dataset.nome);
        escreverTexto('ct-id', linha.dataset.id);
        escreverTexto('ct-titulo', celula(linha, 2));
        trocarStatus(document.getElementById('ct-status'), STATUS, status);

        // Não faz sentido aprovar quem já está publicado (nem recusar quem já foi recusado)
        document.getElementById('ct-aprovar').disabled = status === 'publicado';
        document.getElementById('ct-recusar').disabled = status === 'recusado';

        modal.classList.add('is-open');
    }

    function fecharTudo() {
        modal.classList.remove('is-open');
        modalCompleto.classList.remove('is-open');
        linhaAberta = null;
    }

    function decidir(novoStatus) {
        if (!linhaAberta) {
            return;
        }
        // TODO (back-end): salvar a decisão no banco e avisar o profissional
        linhaAberta.dataset.status = novoStatus;
        trocarStatus(linhaAberta.querySelector('.lst-status'), STATUS, novoStatus);

        aplicar();
        fecharTudo();
        if (novoStatus === 'publicado') {
            mostrarToast(toast, 'Conteúdo aprovado e publicado.');
        } else {
            mostrarToast(toast, 'Conteúdo recusado.');
        }
    }

    // Modal 2: conteúdo completo
    function abrirCompleto() {
        if (!linhaAberta) {
            return;
        }
        const l = linhaAberta;

        escreverTexto('cc-titulo', l.dataset.tituloCompleto || celula(l, 2));
        escreverTexto('cc-resumo', l.dataset.resumo || 'Conteúdo enviado pelo profissional para revisão. O texto completo aparece aqui na versão final.');
        escreverTexto('cc-autor', l.dataset.nome);
        escreverTexto('cc-cargo', l.dataset.cargo + ' · ' + celula(l, 3));
        document.getElementById('cc-artigo').hidden = !l.dataset.completo;

        modalCompleto.classList.add('is-open');
    }

    function fecharCompleto() {
        modalCompleto.classList.remove('is-open');
    }

    // Cliques da página
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        // Clicou fora do filtro: fecha o menu
        if (!alvo.closest('.lst-filtro')) {
            abrirOuFecharMenu(false);
        }

        // Cards e opções do menu (clicar de novo num card ativo volta para "todos")
        const itemFiltro = alvo.closest('[data-filtro]');
        if (itemFiltro) {
            const ehCard = itemFiltro.classList.contains('lst-kpi');
            if (ehCard && itemFiltro.dataset.filtro === filtro) {
                filtro = 'todos';
            } else {
                filtro = itemFiltro.dataset.filtro;
            }
            abrirOuFecharMenu(false);
            aplicar();
            return;
        }

        // Botão "Filtro"
        if (alvo.closest('#ct-filtro-btn')) {
            abrirOuFecharMenu(!menu.classList.contains('is-open'));
            return;
        }

        // Baixar PDF
        if (alvo.closest('[data-pdf]')) {
            const dados = [];
            for (let i = 0; i < linhas.length; i++) {
                const l = linhas[i];
                if (!l.hidden) {
                    dados.push([celula(l, 0), celula(l, 1), celula(l, 2), celula(l, 3), STATUS[l.dataset.status].rotulo]);
                }
            }
            baixarPdf(toast, 'Conteúdos Aprender', ['ID', 'Profissional', 'Título', 'Data', 'Status'], dados, 'conteudos');
            return;
        }

        // Dentro dos modais
        if (alvo.closest('#ct-ver')) {
            abrirCompleto();
            return;
        }

        const decisao = alvo.closest('[data-decisao]');
        if (decisao) {
            decidir(decisao.dataset.decisao);
            return;
        }

        const fechar = alvo.closest('[data-fechar]');
        if (fechar) {
            if (fechar.dataset.fechar === '2') {
                fecharCompleto();
            } else {
                fecharTudo();
            }
            return;
        }

        // Clique no fundo escuro
        if (alvo === modalCompleto) {
            fecharCompleto();
            return;
        }
        if (alvo === modal) {
            fecharTudo();
            return;
        }

        // Clicar numa linha abre a revisão
        const linha = alvo.closest('tr[data-id]');
        if (linha) {
            abrirRevisao(linha);
        }
    });

    // Busca
    document.getElementById('ct-busca').addEventListener('input', function (e) {
        busca = normalizar(e.target.value.trim());
        aplicar();
    });

    // Esc fecha primeiro o que está por cima
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') {
            return;
        }
        if (modalCompleto.classList.contains('is-open')) {
            fecharCompleto();
        } else if (modal.classList.contains('is-open')) {
            fecharTudo();
        } else {
            abrirOuFecharMenu(false);
        }
    });

    aplicar();
}


/* =========================================================
   Lista de denuncias
   ========================================================= */
function paginaDenuncias() {
    const pagina = document.querySelector('.lst-page');
    const corpo = document.getElementById('dn-corpo');
    if (!pagina || !corpo) {
        return;
    }

    const linhas = Array.from(corpo.querySelectorAll('tr[data-id]'));
    const linhaVazia = document.getElementById('dn-vazio');
    const toast = document.getElementById('dn-toast');
    const painel = document.getElementById('dn-painel');
    const botaoAlternar = document.getElementById('dn-alternar');

    const STATUS = {
        pendente:  { rotulo: 'Pendente',  classe: 'lst-status--pendente' },
        resolvida: { rotulo: 'Resolvida', classe: 'lst-status--ok' }
    };
    const DESCRICAO_PADRAO = 'Descrição enviada pela solicitante. Na versão final, o texto completo da ocorrência aparece aqui.';

    // Os totais vêm do HTML (são do sistema todo, não só das linhas da tabela)
    let totalPendentes = Number(document.getElementById('dn-pendentes').dataset.valor);
    let totalResolvidas = Number(document.getElementById('dn-resolvidas').dataset.valor);

    let filtro = 'todos';       // todos | pendente | resolvida
    let busca = '';
    let ordemChave = 'data';
    let ordemDirecao = -1;
    let linhaAberta = null;

    function assuntoDa(linha) {
        return linha.cells[2].textContent.trim();
    }

    // Escreve os números dos 3 cards
    function atualizarNumeros() {
        escreverTexto('dn-total', (totalPendentes + totalResolvidas).toLocaleString('pt-BR'));
        escreverTexto('dn-pendentes', totalPendentes.toLocaleString('pt-BR'));
        escreverTexto('dn-resolvidas', totalResolvidas.toLocaleString('pt-BR'));
    }

    function valorParaOrdenar(linha) {
        if (ordemChave === 'assunto') {
            return assuntoDa(linha);
        }
        return linha.dataset[ordemChave] || '';
    }

    function aplicar() {
        // Ordena (a linha "vazio" fica sempre no fim)
        linhas.sort(function (a, b) {
            const comparacao = valorParaOrdenar(a).localeCompare(valorParaOrdenar(b), 'pt-BR', { numeric: true });
            return comparacao * ordemDirecao;
        });
        for (let i = 0; i < linhas.length; i++) {
            corpo.insertBefore(linhas[i], linhaVazia);
        }

        // Filtro + busca
        let visiveis = 0;
        for (let i = 0; i < linhas.length; i++) {
            const linha = linhas[i];
            const texto = normalizar(linha.dataset.id + ' ' + linha.dataset.email + ' ' + assuntoDa(linha));
            const passaFiltro = filtro === 'todos' || linha.dataset.status === filtro;

            linha.hidden = !(passaFiltro && texto.includes(busca));
            if (!linha.hidden) {
                visiveis++;
            }
        }
        linhaVazia.hidden = visiveis > 0;

        marcarAtivos(pagina.querySelectorAll('[data-filtro]'), 'filtro', filtro, false);
        marcarOrdem(pagina, ordemChave, ordemDirecao);
    }

    // Painel lateral
    function abrirPainel(linha) {
        linhaAberta = linha;
        const status = linha.dataset.status;

        escreverTexto('dn-id', linha.dataset.id);
        trocarStatus(document.getElementById('dn-status'), STATUS, status);
        escreverTexto('dn-assunto', assuntoDa(linha));
        escreverTexto('dn-meta', 'Aberta em ' + dataBR(linha.dataset.data) + ' por ' + linha.dataset.email);
        escreverTexto('dn-descricao', linha.dataset.descricao || DESCRICAO_PADRAO);
        botaoAlternar.textContent = status === 'resolvida' ? 'Reabrir denúncia' : 'Marcar como resolvida';

        painel.classList.add('is-open');
    }

    function fecharPainel() {
        painel.classList.remove('is-open');
        linhaAberta = null;
    }

    // Resolve a denúncia (ou reabre, se já estava resolvida)
    function alternarStatus() {
        if (!linhaAberta) {
            return;
        }
        // TODO (back-end): salvar o novo status no banco
        const virouResolvida = linhaAberta.dataset.status === 'pendente';

        if (virouResolvida) {
            linhaAberta.dataset.status = 'resolvida';
            totalPendentes = totalPendentes - 1;
            totalResolvidas = totalResolvidas + 1;
        } else {
            linhaAberta.dataset.status = 'pendente';
            totalPendentes = totalPendentes + 1;
            totalResolvidas = totalResolvidas - 1;
        }
        trocarStatus(linhaAberta.querySelector('.lst-status'), STATUS, linhaAberta.dataset.status);

        atualizarNumeros();
        aplicar();
        fecharPainel();
        mostrarToast(toast, virouResolvida ? 'Denúncia marcada como resolvida.' : 'Denúncia reaberta.');
    }

    // Cliques da página
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        // Cards e abas de filtro (clicar de novo num card ativo volta para "todos")
        const botaoFiltro = alvo.closest('[data-filtro]');
        if (botaoFiltro) {
            const ehCard = botaoFiltro.classList.contains('lst-kpi');
            if (ehCard && botaoFiltro.dataset.filtro === filtro) {
                filtro = 'todos';
            } else {
                filtro = botaoFiltro.dataset.filtro;
            }
            aplicar();
            return;
        }

        // Ordenar pelo título da coluna
        const botaoOrdenar = alvo.closest('[data-ordenar]');
        if (botaoOrdenar) {
            const chave = botaoOrdenar.dataset.ordenar;
            if (ordemChave === chave) {
                ordemDirecao = -ordemDirecao;
            } else {
                ordemDirecao = 1;
            }
            ordemChave = chave;
            aplicar();
            return;
        }

        // Baixar PDF
        if (alvo.closest('[data-pdf]')) {
            const dados = [];
            for (let i = 0; i < linhas.length; i++) {
                const l = linhas[i];
                if (!l.hidden) {
                    dados.push([l.dataset.id, l.dataset.email, assuntoDa(l), dataBR(l.dataset.data), STATUS[l.dataset.status].rotulo]);
                }
            }
            baixarPdf(toast, 'Lista de denúncias', ['ID', 'Solicitante', 'Assunto', 'Data', 'Status'], dados, 'denuncias');
            return;
        }

        if (alvo.closest('#dn-alternar')) {
            alternarStatus();
            return;
        }

        if (alvo.closest('[data-fechar]')) {
            fecharPainel();
            return;
        }

        // Clicar numa linha abre os detalhes
        const linha = alvo.closest('tr[data-id]');
        if (linha) {
            abrirPainel(linha);
        }
    });

    // Teclado: Enter ou Espaço numa linha também abre os detalhes
    corpo.addEventListener('keydown', function (e) {
        if (e.key !== 'Enter' && e.key !== ' ') {
            return;
        }
        const linha = e.target.closest('tr[data-id]');
        if (linha && e.target === linha) {
            e.preventDefault();
            abrirPainel(linha);
        }
    });

    // Busca
    document.getElementById('dn-busca').addEventListener('input', function (e) {
        busca = normalizar(e.target.value.trim());
        aplicar();
    });

    // Esc fecha o painel
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            fecharPainel();
        }
    });

    atualizarNumeros();
    aplicar();
}


/* =========================================================
   Criar destaque:
   ========================================================= */
function paginaCriarDestaque() {
    const pagina = document.querySelector('.dst-page');
    const form = document.getElementById('form-destaque');
    if (!pagina || !form) {
        return;
    }

    const etapas = Array.from(pagina.querySelectorAll('.dst-etapa'));
    const passos = Array.from(pagina.querySelectorAll('.dst-passo'));

    const caixaTags = document.getElementById('tags');
    const campoTag = document.getElementById('tag-entrada');
    const dicaTag = document.getElementById('tag-dica');

    const arquivoPrincipal = document.getElementById('arquivo-principal');
    const arquivoComplementar = document.getElementById('arquivo-complementar');
    const listaComplementares = document.getElementById('complementares');

    const modal = document.getElementById('modal-publicar');
    const toast = document.getElementById('dst-toast');

    // Campos obrigatórios de cada etapa (o nome é o atributo name do campo)
    const OBRIGATORIOS = {
        1: ['titulo', 'objetivo', 'publico_alvo', 'faixa_etaria', 'categoria', 'duracao'],
        2: ['mensagem', 'texto', 'cta', 'fontes'],
        3: ['peca_principal']
    };

    // Textos da prévia: [id na prévia, nome do campo, texto de exemplo]
    const PREVIA = [
        ['previa-titulo', 'titulo', 'Título do destaque'],
        ['previa-mensagem', 'mensagem', 'Mensagem principal'],
        ['previa-texto', 'texto', 'O texto de apresentação aparece aqui conforme você digita.'],
        ['previa-publico', 'publico_alvo', 'Público'],
        ['previa-faixa', 'faixa_etaria', 'Faixa etária'],
        ['previa-duracao', 'duracao', 'Duração']
    ];

    const TEXTO_DICA = 'Até 8 tags. Use Enter ou vírgula para adicionar.';

    const dados = {};          // guarda o que foi digitado em cada campo
    let etapaAtual = 1;
    let tags = [];
    let principal = null;      // { nome, tamanho, url }
    let complementares = [];   // [{ nome, tamanho }]

    // Acha a "caixinha" de um campo pelo nome
    function campoDe(nome) {
        return pagina.querySelector('[data-campo="' + nome + '"]');
    }

    // 1500000 vira "1.4 MB"
    function formatarTamanho(bytes) {
        if (bytes > 1048576) {
            return (bytes / 1048576).toFixed(1) + ' MB';
        }
        return Math.max(1, Math.round(bytes / 1024)) + ' KB';
    }

    // Escolhe o ícone conforme o tipo do arquivo
    function iconeDoArquivo(nome) {
        if (/\.(png|jpe?g|gif|webp)$/i.test(nome)) return 'file-image';
        if (/\.(mp3|wav|ogg)$/i.test(nome)) return 'file-audio';
        return 'file-text';
    }

    /* ---------- Etapas ---------- */
    function mostrarEtapa(numero) {
        etapaAtual = numero;

        for (let i = 0; i < etapas.length; i++) {
            etapas[i].classList.toggle('is-on', Number(etapas[i].dataset.etapa) === numero);
        }

        for (let i = 0; i < passos.length; i++) {
            const n = i + 1;
            passos[i].classList.toggle('is-done', n < numero);
            passos[i].classList.toggle('is-on', n === numero);
        }

        if (numero === 4) {
            preencherResumo();
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Confere os campos obrigatórios da etapa e marca os vazios em vermelho
    function validar(numero) {
        const nomes = OBRIGATORIOS[numero] || [];
        let primeiroErro = null;

        for (let i = 0; i < nomes.length; i++) {
            const campo = campoDe(nomes[i]);
            const vazio = !(dados[nomes[i]] || '').trim();
            campo.classList.toggle('is-erro', vazio);
            if (vazio && !primeiroErro) {
                primeiroErro = campo;
            }
        }

        if (primeiroErro) {
            const elemento = primeiroErro.querySelector('input, textarea, select, button');
            if (elemento) {
                elemento.focus();
            }
            mostrarToast(toast, 'Preencha os campos destacados.');
            return false;
        }
        return true;
    }

    /* ---------- Prévia ---------- */
    function atualizarPrevia() {
        // Textos: se o campo estiver vazio, mostra o exemplo em cinza
        for (let i = 0; i < PREVIA.length; i++) {
            const elemento = document.getElementById(PREVIA[i][0]);
            const valor = dados[PREVIA[i][1]];
            elemento.textContent = valor || PREVIA[i][2];
            elemento.classList.toggle('dst-vazio', !valor);
        }

        // Categoria sem o texto entre parênteses
        escreverTexto('previa-categoria', dados.categoria ? dados.categoria.replace(/ \(.*\)/, '') : 'Categoria');
        escreverTexto('previa-cta', dados.cta || 'Chamada para ação');
        escreverTexto('previa-fontes', dados.fontes ? 'Fontes: ' + dados.fontes : '');

        // Imagem da peça principal
        const imagem = document.getElementById('previa-imagem');
        const temImagem = principal !== null && principal.url;
        imagem.style.backgroundImage = temImagem ? 'url("' + principal.url + '")' : '';
        imagem.classList.toggle('tem-imagem', temImagem);

        // Tags
        const caixa = document.getElementById('previa-tags');
        caixa.textContent = '';
        for (let i = 0; i < tags.length; i++) {
            const chip = document.createElement('span');
            chip.className = 'dst-chip';
            chip.textContent = '#' + tags[i];
            caixa.appendChild(chip);
        }
    }

    // Quando digita em qualquer campo: guarda o valor, atualiza o contador e a prévia
    form.addEventListener('input', function (e) {
        const campo = e.target.closest('[data-campo]');
        if (!campo || !e.target.name || e.target.type === 'file') {
            return;
        }

        dados[e.target.name] = e.target.value;

        const contador = campo.querySelector('.dst-contador');
        if (contador) {
            contador.textContent = e.target.value.length + '/' + e.target.maxLength;
        }

        if (e.target.value.trim()) {
            campo.classList.remove('is-erro');
        }
        atualizarPrevia();
    });

    /* ---------- Tags ---------- */
    function desenharTags() {
        // Apaga as tags antigas e desenha todas de novo
        const antigas = caixaTags.querySelectorAll('.dst-tag');
        for (let i = 0; i < antigas.length; i++) {
            antigas[i].remove();
        }

        for (let i = 0; i < tags.length; i++) {
            const tag = document.createElement('span');
            tag.className = 'dst-tag';
            tag.textContent = tags[i];

            const remover = document.createElement('button');
            remover.type = 'button';
            remover.dataset.removerTag = i;
            remover.setAttribute('aria-label', 'Remover ' + tags[i]);
            remover.innerHTML = '<i data-lucide="x"></i>';

            tag.appendChild(remover);
            caixaTags.insertBefore(tag, campoTag);
        }

        document.getElementById('tags-valor').value = tags.join(',');
        criarIcones();
        atualizarPrevia();
    }

    function avisarTag(texto, erro) {
        dicaTag.textContent = texto;
        dicaTag.classList.toggle('is-erro', erro);
    }

    function adicionarTag() {
        const texto = campoTag.value.replace(/,/g, '').trim();
        if (!texto) {
            return;
        }

        // Já existe uma tag igual?
        for (let i = 0; i < tags.length; i++) {
            if (tags[i].toLowerCase() === texto.toLowerCase()) {
                campoTag.value = '';
                avisarTag('Essa tag já foi adicionada.', true);
                return;
            }
        }

        if (tags.length >= 8) {
            avisarTag('Limite de 8 tags atingido.', true);
            return;
        }

        tags.push(texto);
        campoTag.value = '';
        avisarTag(TEXTO_DICA, false);
        desenharTags();
    }

    campoTag.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            adicionarTag();
        } else if (e.key === 'Backspace' && campoTag.value === '' && tags.length > 0) {
            tags.pop();
            desenharTags();
        }
    });

    campoTag.addEventListener('blur', adicionarTag);

    caixaTags.addEventListener('click', function (e) {
        const remover = e.target.closest('[data-remover-tag]');
        if (remover) {
            tags.splice(Number(remover.dataset.removerTag), 1);
            desenharTags();
        }
        campoTag.focus();
    });

    /* ---------- Arquivos ---------- */
    function desenharPrincipal() {
        document.getElementById('principal-vazio').hidden = principal !== null;
        document.getElementById('principal-arquivo').hidden = principal === null;
        if (!principal) {
            return;
        }

        escreverTexto('principal-nome', principal.nome);
        escreverTexto('principal-tamanho', formatarTamanho(principal.tamanho));

        const miniatura = document.getElementById('principal-miniatura');
        miniatura.style.backgroundImage = principal.url ? 'url("' + principal.url + '")' : '';
        const icone = miniatura.querySelector('svg, i');
        if (icone) {
            icone.style.display = principal.url ? 'none' : '';
        }
    }

    function desenharComplementares() {
        listaComplementares.textContent = '';

        for (let i = 0; i < complementares.length; i++) {
            const item = document.getElementById('modelo-arquivo').content.cloneNode(true);

            item.querySelector('b').textContent = complementares[i].nome;
            item.querySelector('.dst-mute').textContent = formatarTamanho(complementares[i].tamanho);
            item.querySelector('[data-lucide]').dataset.lucide = iconeDoArquivo(complementares[i].nome);
            item.querySelector('[data-remover-material]').dataset.removerMaterial = i;

            listaComplementares.appendChild(item);
        }
        criarIcones();
    }

    // Peça principal escolhida (ou substituída)
    arquivoPrincipal.addEventListener('change', function () {
        const arquivo = arquivoPrincipal.files[0];
        if (!arquivo) {
            return;
        }

        if (principal && principal.url) {
            URL.revokeObjectURL(principal.url);
        }
        principal = { nome: arquivo.name, tamanho: arquivo.size, url: URL.createObjectURL(arquivo) };
        dados.peca_principal = arquivo.name;

        campoDe('peca_principal').classList.remove('is-erro');
        desenharPrincipal();
        atualizarPrevia();
        criarIcones();
    });

    // Materiais complementares escolhidos
    arquivoComplementar.addEventListener('change', function () {
        for (let i = 0; i < arquivoComplementar.files.length; i++) {
            const arquivo = arquivoComplementar.files[i];
            complementares.push({ nome: arquivo.name, tamanho: arquivo.size });
        }
        arquivoComplementar.value = '';
        desenharComplementares();
    });

    /* ---------- Resumo (etapa 4) ---------- */
    function preencherResumo() {
        const nomesOutros = [];
        for (let i = 0; i < complementares.length; i++) {
            nomesOutros.push(complementares[i].nome);
        }

        const valores = {
            titulo: dados.titulo,
            objetivo: dados.objetivo,
            publico_alvo: dados.publico_alvo,
            faixa_etaria: dados.faixa_etaria,
            categoria: dados.categoria,
            duracao: dados.duracao,
            tags: tags.join(', '),
            mensagem: dados.mensagem,
            texto: dados.texto,
            cta: dados.cta,
            fontes: dados.fontes,
            principal: principal ? principal.nome : '',
            outros: nomesOutros.join(', ')
        };

        const elementos = pagina.querySelectorAll('[data-resumo]');
        for (let i = 0; i < elementos.length; i++) {
            elementos[i].textContent = valores[elementos[i].dataset.resumo] || '—';
        }
    }

    /* ---------- Modal de publicar ---------- */
    function fecharModal() {
        modal.classList.remove('is-open');
    }

    /* ---------- Cliques da página ---------- */
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        if (alvo.closest('[data-proxima]')) {
            if (validar(etapaAtual)) {
                mostrarEtapa(etapaAtual + 1);
            }
            return;
        }

        if (alvo.closest('[data-anterior]')) {
            mostrarEtapa(etapaAtual - 1);
            return;
        }

        if (alvo.closest('[data-editar]')) {
            mostrarEtapa(1);
            return;
        }

        // Abre a janela de escolher arquivo
        const escolher = alvo.closest('[data-escolher]');
        if (escolher) {
            if (escolher.dataset.escolher === 'principal') {
                arquivoPrincipal.click();
            } else {
                arquivoComplementar.click();
            }
            return;
        }

        if (alvo.closest('[data-remover-principal]')) {
            if (principal && principal.url) {
                URL.revokeObjectURL(principal.url);
            }
            principal = null;
            delete dados.peca_principal;
            desenharPrincipal();
            atualizarPrevia();
            return;
        }

        const removerMaterial = alvo.closest('[data-remover-material]');
        if (removerMaterial) {
            complementares.splice(Number(removerMaterial.dataset.removerMaterial), 1);
            desenharComplementares();
            return;
        }

        if (alvo.closest('[data-publicar]')) {
            modal.classList.add('is-open');
            return;
        }

        if (alvo.closest('[data-cancelar]') || alvo === modal) {
            fecharModal();
            return;
        }

        const confirmar = alvo.closest('[data-confirmar]');
        if (confirmar) {
            // TODO (back-end): enviar o formulário (form.submit()) em vez de só voltar para a lista
            fecharModal();
            mostrarToast(toast, 'Destaque publicado.');
            setTimeout(function () {
                window.location.href = confirmar.dataset.destino;
            }, 900);
        }
    });

    // Esc fecha o modal
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            fecharModal();
        }
    });

    // Página estática: o formulário ainda não envia nada
    form.addEventListener('submit', function (e) {
        e.preventDefault();
    });

    atualizarPrevia();
}


/* =========================================================
   Aprovar Cadastros:
   ========================================================= */
function paginaAprovarCadastros() {
    const pagina = document.querySelector('.lst-page');
    const corpo = document.getElementById('ap-corpo');
    if (!pagina || !corpo) {
        return;
    }

    const linhas = Array.from(corpo.querySelectorAll('tr[data-id]'));
    const linhaVazia = document.getElementById('ap-vazio');
    const marcarTodos = document.getElementById('ap-todos');
    const barraLote = document.getElementById('ap-lote');
    const toast = document.getElementById('ap-toast');

    // Modal de decisão
    const modal = document.getElementById('ap-modal');
    const motivoCaixa = document.getElementById('ap-motivo-caixa');
    const motivo = document.getElementById('ap-motivo');
    const botaoConfirmar = document.getElementById('ap-confirmar');

    // p = pendente, r = reenvio solicitado, a = aprovado, x = reprovado
    const STATUS = {
        p: { rotulo: 'Pendente',           classe: 'lst-status--pendente' },
        r: { rotulo: 'Reenvio solicitado', classe: 'lst-status--reenvio' },
        a: { rotulo: 'Aprovado',           classe: 'lst-status--ok' },
        x: { rotulo: 'Reprovado',          classe: '' }
    };

    let aba = 'p';          // aba de status aberta
    let conselho = '';      // '' = todos os conselhos
    let busca = '';
    let decisao = '';       // 'aprovar' ou 'reenvio' (quando o modal está aberto)
    const selecionadas = [];   // ids das linhas marcadas na caixinha

    // Quantos cadastros existem em cada status
    function contar(status) {
        let total = 0;
        for (let i = 0; i < linhas.length; i++) {
            if (linhas[i].dataset.status === status) {
                total++;
            }
        }
        return total;
    }

    // Atualiza o visual de uma linha depois que o status mudou
    function atualizarLinha(linha) {
        const status = linha.dataset.status;
        trocarStatus(linha.querySelector('.lst-status'), STATUS, status);

        // Quem já foi decidido não tem mais tempo de espera
        if (status === 'a' || status === 'x') {
            linha.querySelector('[data-espera]').textContent = '—';
        }

        const caixa = linha.querySelector('.lst-chk');
        caixa.disabled = status !== 'p';
        caixa.checked = false;

        const botao = linha.querySelector('.lst-btn');
        botao.textContent = status === 'p' ? 'Analisar' : 'Ver';
        botao.classList.toggle('lst-btn--primario', status === 'p');
        botao.classList.toggle('lst-btn--neutro', status !== 'p');
    }

    // A linha deve aparecer? (aba + conselho + busca)
    function devePareceer(linha) {
        const texto = normalizar(linha.dataset.nome + ' ' + linha.dataset.numero + ' ' + linha.dataset.conselho);
        const daAba = linha.dataset.status === aba;
        const doConselho = conselho === '' || linha.dataset.conselho === conselho;
        return daAba && doConselho && texto.includes(busca);
    }

    function aplicar() {
        let mostradas = 0;

        for (let i = 0; i < linhas.length; i++) {
            const linha = linhas[i];
            const id = linha.dataset.id;

            linha.hidden = !devePareceer(linha);
            if (!linha.hidden) {
                mostradas++;
            } else if (selecionadas.indexOf(id) !== -1) {
                // Quem saiu da tela sai da seleção
                selecionadas.splice(selecionadas.indexOf(id), 1);
            }
            linha.querySelector('.lst-chk').checked = selecionadas.indexOf(id) !== -1;
        }

        linhaVazia.hidden = mostradas > 0;
        linhaVazia.querySelector('td').textContent = aba === 'p'
            ? 'Tudo em dia! Nenhum cadastro aguardando análise.'
            : 'Nenhum cadastro nesta aba.';

        // Números dos cards e da aba "Pendentes"
        escreverTexto('ap-total-p', contar('p'));
        escreverTexto('ap-total-r', contar('r'));
        escreverTexto('ap-total-a', contar('a'));
        escreverTexto('ap-badge-p', contar('p'));

        // Visual das abas, dos cards e dos filtros de conselho
        marcarAtivos(pagina.querySelectorAll('[data-aba]'), 'aba', aba, false);
        marcarAtivos(pagina.querySelectorAll('[data-conselho-filtro]'), 'conselhoFiltro', conselho, false);

        atualizarLote();
    }

    // Barra de ações em lote (aparece quando tem alguém marcado)
    function atualizarLote() {
        const n = selecionadas.length;
        barraLote.classList.toggle('is-show', n > 0);
        escreverTexto('ap-lote-n', n + (n > 1 ? ' selecionados' : ' selecionado'));

        // "Selecionar todos" fica marcado quando todas as linhas à mostra estão marcadas
        let selecionaveis = 0;
        let marcadas = 0;
        for (let i = 0; i < linhas.length; i++) {
            const l = linhas[i];
            if (!l.hidden && l.dataset.status === 'p') {
                selecionaveis++;
                if (selecionadas.indexOf(l.dataset.id) !== -1) {
                    marcadas++;
                }
            }
        }
        marcarTodos.checked = selecionaveis > 0 && selecionaveis === marcadas;
    }

    // Abre o modal de aprovar ou pedir reenvio
    function abrirModal(tipo) {
        if (selecionadas.length === 0) {
            return;
        }
        decisao = tipo;
        const aprovar = tipo === 'aprovar';

        // Nome que aparece no título
        let nome = selecionadas.length + ' profissionais';
        if (selecionadas.length === 1) {
            for (let i = 0; i < linhas.length; i++) {
                if (linhas[i].dataset.id === selecionadas[0]) {
                    nome = linhas[i].dataset.nome;
                }
            }
        }

        const icone = document.getElementById('ap-modal-icone');
        icone.innerHTML = '<i data-lucide="' + (aprovar ? 'badge-check' : 'rotate-ccw') + '"></i>';
        icone.classList.toggle('lst-icone--verde', aprovar);

        escreverTexto('ap-modal-titulo', aprovar ? 'Aprovar ' + nome + '?' : 'Solicitar reenvio');
        escreverTexto('ap-modal-texto', aprovar
            ? 'O acesso ao portal é liberado na hora e o e-mail de boas-vindas é enviado.'
            : 'O motivo é enviado por e-mail para ' + nome + '.');

        botaoConfirmar.textContent = aprovar ? 'Aprovar' : 'Enviar solicitação';
        botaoConfirmar.classList.toggle('lst-btn--ok', aprovar);
        botaoConfirmar.classList.toggle('lst-btn--primario', !aprovar);

        // O motivo só é pedido no reenvio
        document.getElementById('ap-motivo-bloco').hidden = aprovar;
        motivo.value = '';
        motivoCaixa.classList.remove('is-erro');

        modal.classList.add('is-open');
        criarIcones();
    }

    function fecharModal() {
        modal.classList.remove('is-open');
        decisao = '';
    }

    function confirmar() {
        const aprovar = decisao === 'aprovar';

        // No reenvio, o motivo precisa ter pelo menos 10 letras
        if (!aprovar) {
            const curto = motivo.value.trim().length < 10;
            motivoCaixa.classList.toggle('is-erro', curto);
            if (curto) {
                motivo.focus();
                return;
            }
        }

        // TODO (back-end): salvar a decisão (e o motivo) no banco e enviar o e-mail
        const total = selecionadas.length;
        for (let i = 0; i < linhas.length; i++) {
            if (selecionadas.indexOf(linhas[i].dataset.id) !== -1) {
                linhas[i].dataset.status = aprovar ? 'a' : 'r';
                atualizarLinha(linhas[i]);
            }
        }

        selecionadas.length = 0;   // limpa a seleção
        fecharModal();
        aplicar();

        if (total > 1) {
            mostrarToast(toast, total + ' cadastros atualizados.');
        } else {
            mostrarToast(toast, aprovar ? 'Cadastro aprovado.' : 'Reenvio solicitado.');
        }
    }

    // Cliques da página
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        // Abas e cards de status
        const botaoAba = alvo.closest('[data-aba]');
        if (botaoAba) {
            aba = botaoAba.dataset.aba;
            aplicar();
            return;
        }

        // Filtro por conselho
        const botaoConselho = alvo.closest('[data-conselho-filtro]');
        if (botaoConselho) {
            conselho = botaoConselho.dataset.conselhoFiltro;
            aplicar();
            return;
        }

        // Ações em lote (Aprovar selecionados / Solicitar reenvio)
        const lote = alvo.closest('[data-lote]');
        if (lote) {
            abrirModal(lote.dataset.lote);
            return;
        }

        // Motivos prontos: acrescentam o texto na caixa
        const pronto = alvo.closest('[data-motivo]');
        if (pronto) {
            motivo.value = (motivo.value ? motivo.value + ' ' : '') + pronto.dataset.motivo + '.';
            motivoCaixa.classList.remove('is-erro');
            motivo.focus();
            return;
        }

        if (alvo.closest('#ap-confirmar')) {
            confirmar();
            return;
        }

        if (alvo.closest('[data-fechar]') || alvo === modal) {
            fecharModal();
            return;
        }

        // Clicar na linha abre o detalhe (a caixinha e o link têm o próprio comportamento)
        if (alvo.closest('.lst-chk') || alvo.closest('a')) {
            return;
        }
        const linha = alvo.closest('tr[data-id]');
        if (linha) {
            window.location.href = linha.querySelector('a').href;
        }
    });

    // Marcar ou desmarcar uma linha
    corpo.addEventListener('change', function (e) {
        const caixa = e.target.closest('[data-selecionar]');
        if (!caixa) {
            return;
        }
        const id = caixa.dataset.selecionar;

        if (caixa.checked) {
            if (selecionadas.indexOf(id) === -1) {
                selecionadas.push(id);
            }
        } else if (selecionadas.indexOf(id) !== -1) {
            selecionadas.splice(selecionadas.indexOf(id), 1);
        }
        atualizarLote();
    });

    // Marcar ou desmarcar todas as linhas que estão à mostra
    marcarTodos.addEventListener('change', function () {
        for (let i = 0; i < linhas.length; i++) {
            const l = linhas[i];
            const id = l.dataset.id;
            const podeMarcar = !l.hidden && l.dataset.status === 'p';
            const indice = selecionadas.indexOf(id);

            if (podeMarcar && marcarTodos.checked) {
                if (indice === -1) {
                    selecionadas.push(id);
                }
            } else if (indice !== -1) {
                selecionadas.splice(indice, 1);
            }
            l.querySelector('.lst-chk').checked = selecionadas.indexOf(id) !== -1;
        }
        atualizarLote();
    });

    // Busca
    document.getElementById('ap-busca').addEventListener('input', function (e) {
        busca = normalizar(e.target.value.trim());
        aplicar();
    });

    // Tirou o erro assim que o motivo ficou grande o bastante
    motivo.addEventListener('input', function () {
        if (motivo.value.trim().length >= 10) {
            motivoCaixa.classList.remove('is-erro');
        }
    });

    // Esc fecha o modal
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            fecharModal();
        }
    });

    aplicar();
}


/* =========================================================
   Mensagens denunciadas:
   ========================================================= */

function paginaMensagensDenunciadas() {
    const lista = document.getElementById('m-lista');
    if (!lista) {
        return;
    }

    const toast = document.getElementById('toast');
    const confirmaModal = document.getElementById('m-confirma-modal');
    const campoJustificativa = document.getElementById('m-justificativa');
    const caixaJustificativa = document.getElementById('m-justificativa-caixa');
    const erroJustificativa = document.getElementById('m-justificativa-erro');

    const MSG = 'Eu quero que todas vocês que usam esse site parem de usar já! É um lixo, não ouçam as postagens de nenhuma profissional daqui.';

    const mensagens = [
        {
            nome: 'Karolyne Anjos',
            data: '03/09/2026',
            texto: MSG,
            motivo: 'Calúnia e Injúria',
            descricao: 'A mensagem não tem nenhum fundamento, nem argumentos, apenas xingamentos sem fundamento.',
            status: 'p'
        },
        {
            nome: 'Agatha Volkomenn',
            data: '28/04/2026',
            texto: 'Eu acho que a melhor saída pra isso é contatar aqui sroverissimo1413@hotmail.com',
            motivo: 'Contato Vazado',
            descricao: 'O email nessa mensagem não é o email da usuária, então considero como um email falso.',
            status: 'p'
        },
        {
            nome: 'Karolyne Anjos',
            data: '2 dias atrás',
            texto: MSG,
            motivo: 'Outro',
            descricao: 'Não gosto da usuária, e gostaria que fosse removido e ela tivesse a conta bloqueada, por favor.',
            status: 'p'
        }
    ];

    const AVISOS = {
        a: 'Denúncia aceita. A mensagem será analisada para remoção.',
        x: 'Denúncia recusada.',
        p: 'Denúncia revertida para pendente.'
    };

    let aba = 'p';
    let busca = '';
    let numeroPendente = -1;
    let acaoPendente = '';

    function desenhar() {
        let html = '';

        for (let i = 0; i < mensagens.length; i++) {
            const m = mensagens[i];
            const texto = (
                m.nome + ' ' + m.texto + ' ' + m.motivo
            ).toLowerCase();

            if (m.status !== aba || !texto.includes(busca)) {
                continue;
            }

            let botoes = '';

            if (m.status === 'p') {
                botoes =
                    '<button type="button" class="lst-btn lst-btn--neutro lst-btn--pequeno" data-acao="x" data-i="' + i + '">Recusar denúncia</button>' +
                    '<button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno" data-acao="a" data-i="' + i + '">Aceitar denúncia</button>';
            } else {
                botoes =
                    '<button type="button" class="lst-btn lst-btn--neutro lst-btn--pequeno" data-acao="p" data-i="' + i + '"><i data-lucide="undo-2"></i>Reverter</button>';
            }

            html +=
                '<article class="lst-msg">' +
                    '<span class="lst-avatar">' + escapar(m.nome[0]) + '</span>' +
                    '<div>' +
                        '<div class="lst-msg-autor">' +
                            '<b>' + escapar(m.nome) + '</b>' +
                            '<span class="lst-mute">' + escapar(m.data) + '</span>' +
                        '</div>' +
                        '<blockquote class="lst-citacao">' + escapar(m.texto) + '</blockquote>' +
                        '<span class="lst-msg-motivo">' + escapar(m.motivo) + '</span>' +
                        '<p class="lst-msg-descricao">' + escapar(m.descricao) + '</p>' +
                    '</div>' +
                    '<div class="lst-msg-botoes">' + botoes + '</div>' +
                '</article>';
        }

        if (html === '') {
            html = '<p class="lst-vazio">Nenhuma mensagem aqui.</p>';
        }

        lista.innerHTML = html;

        let pendentes = 0;

        for (let i = 0; i < mensagens.length; i++) {
            if (mensagens[i].status === 'p') {
                pendentes++;
            }
        }

        const selos = [
            document.getElementById('m-badge'),
            document.getElementById('m-pend')
        ];

        for (let i = 0; i < selos.length; i++) {
            if (selos[i]) {
                selos[i].textContent = pendentes;
                selos[i].hidden = pendentes === 0;
            }
        }

        marcarAtivos(
            document.querySelectorAll('[data-ms]'),
            'ms',
            aba,
            false
        );

        criarIcones();
    }

    function fecharConfirmacao() {
        confirmaModal.classList.remove('is-open');

        campoJustificativa.value = '';
        caixaJustificativa.classList.remove('is-erro');
        erroJustificativa.style.display = 'none';

        numeroPendente = -1;
        acaoPendente = '';
    }

    document.addEventListener('click', function (e) {
        const botaoAba = e.target.closest('[data-ms]');

        if (botaoAba) {
            aba = botaoAba.dataset.ms;
            desenhar();
            return;
        }

        const botaoAcao = e.target.closest('[data-acao]');

        if (!botaoAcao) {
            return;
        }

        numeroPendente = Number(botaoAcao.dataset.i);
        acaoPendente = botaoAcao.dataset.acao;

        if (acaoPendente === 'a') {
            escreverTexto('m-confirma-titulo', 'Aceitar denúncia?');
            escreverTexto(
                'm-confirma-texto',
                'A mensagem será analisada para remoção.'
            );
            escreverTexto('m-confirma-ok', 'Aceitar denúncia');

        } else if (acaoPendente === 'x') {
            escreverTexto('m-confirma-titulo', 'Recusar denúncia?');
            escreverTexto(
                'm-confirma-texto',
                'A mensagem continuará visível na plataforma.'
            );
            escreverTexto('m-confirma-ok', 'Recusar denúncia');

        } else {
            escreverTexto('m-confirma-titulo', 'Reverter denúncia?');
            escreverTexto(
                'm-confirma-texto',
                'A denúncia voltará para a lista de pendentes.'
            );
            escreverTexto('m-confirma-ok', 'Reverter denúncia');
        }

        campoJustificativa.value = '';
        caixaJustificativa.classList.remove('is-erro');
        erroJustificativa.style.display = 'none';

        confirmaModal.classList.add('is-open');
        campoJustificativa.focus();

        criarIcones();
    });

    document.getElementById('m-confirma-cancelar')
        .addEventListener('click', fecharConfirmacao);

    document.getElementById('m-confirma-ok')
        .addEventListener('click', function () {
            const justificativa = campoJustificativa.value.trim();

            if (!justificativa) {
                caixaJustificativa.classList.add('is-erro');
                erroJustificativa.style.display = 'block';
                campoJustificativa.focus();
                return;
            }

            if (numeroPendente < 0 || !acaoPendente) {
                return;
            }

            // Guarda a justificativa temporariamente no objeto da mensagem.
            // Para persistir de verdade, é necessário salvar no backend.
            mensagens[numeroPendente].justificativa = justificativa;
            mensagens[numeroPendente].status = acaoPendente;

            const acao = acaoPendente;

            fecharConfirmacao();
            desenhar();

            mostrarToast(toast, AVISOS[acao]);
        });

    confirmaModal.addEventListener('click', function (e) {
        if (e.target === confirmaModal) {
            fecharConfirmacao();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (
            e.key === 'Escape' &&
            confirmaModal.classList.contains('is-open')
        ) {
            fecharConfirmacao();
        }
    });

    document.getElementById('m-busca')
        .addEventListener('input', function (e) {
            busca = e.target.value.toLowerCase();
            desenhar();
        });

    desenhar();
}



/* =========================================================
   Lista de usuários:
   ========================================================= */
function paginaUsuarios() {
    const pagina = document.querySelector('.lst-page');
    const corpo = document.getElementById('us-corpo');
    if (!pagina || !corpo) {
        return;
    }

    const linhas = Array.from(corpo.querySelectorAll('tr[data-id]'));
    const linhaVazia = document.getElementById('us-vazio');
    const toast = document.getElementById('us-toast');
    const menu = document.getElementById('us-menu');
    const botaoFiltro = document.getElementById('us-filtro-btn');
    const painel = document.getElementById('us-painel');
    const modal = document.getElementById('us-modal');
    const caixaConfirma = document.getElementById('us-confirma-caixa');
    const campoConfirma = document.getElementById('us-confirma');

    const STATUS = {
        ativo:      { rotulo: 'Ativo',      classe: 'lst-status--ok' },
        desativado: { rotulo: 'Desativado', classe: 'lst-status--recusado' },
        suspenso:   { rotulo: 'Suspenso',   classe: 'lst-status--pendente' }
    };

    let filtro = 'todos';     // todos | ativo | desativado | suspenso
    let busca = '';
    let ordemChave = 'cadastro';
    let ordemDirecao = -1;    // -1 = mais recentes primeiro
    let linhaAberta = null;

    function abrirOuFecharMenu(abrir) {
        menu.classList.toggle('is-open', abrir);
        botaoFiltro.setAttribute('aria-expanded', abrir);
    }

    // Ordena, filtra e busca
    function aplicar() {
        // 1) Ordena (a linha "vazio" fica sempre no fim)
        linhas.sort(function (a, b) {
            const valorA = a.dataset[ordemChave] || '';
            const valorB = b.dataset[ordemChave] || '';
            return valorA.localeCompare(valorB, 'pt-BR', { numeric: true }) * ordemDirecao;
        });
        for (let i = 0; i < linhas.length; i++) {
            corpo.insertBefore(linhas[i], linhaVazia);
        }

        // 2) Esconde quem não passa no filtro ou na busca
        let visiveis = 0;
        for (let i = 0; i < linhas.length; i++) {
            const linha = linhas[i];
            const texto = normalizar(linha.dataset.id + ' ' + linha.dataset.nome + ' ' + linha.dataset.conta);
            const passaFiltro = filtro === 'todos' || linha.dataset.status === filtro;

            linha.hidden = !(passaFiltro && texto.includes(busca));
            if (!linha.hidden) {
                visiveis++;
            }
        }
        linhaVazia.hidden = visiveis > 0;
        escreverTexto('us-contagem', visiveis + ' de ' + linhas.length + ' usuários');

        // 3) Visual do menu, do botão e da setinha da ordenação
        marcarAtivos(menu.querySelectorAll('[data-filtro]'), 'filtro', filtro, false);
        escreverTexto('us-filtro-rotulo', filtro === 'todos' ? 'Filtro' : STATUS[filtro].rotulo);
        marcarOrdem(pagina, ordemChave, ordemDirecao);
    }

    // Painel lateral
    function abrirPainel(linha) {
        linhaAberta = linha;
        const status = linha.dataset.status;

        escreverTexto('us-avatar', linha.dataset.nome[0].toUpperCase());
        escreverTexto('us-nome', linha.dataset.nome);
        escreverTexto('us-meta', linha.dataset.id + ' · ' + linha.dataset.conta);
        escreverTexto('us-cadastro', dataBR(linha.dataset.cadastro));
        trocarStatus(document.getElementById('us-status'), STATUS, status);

        // Ativo pode ser suspenso; os outros podem ser reativados
        document.getElementById('us-suspender').hidden = status !== 'ativo';
        document.getElementById('us-reativar').hidden = status === 'ativo';

        painel.classList.add('is-open');
    }

    function fecharPainel() {
        painel.classList.remove('is-open');
        linhaAberta = null;
    }

    // Muda o status da conta aberta no painel
    function mudarStatus(novoStatus, mensagem) {
        if (!linhaAberta) {
            return;
        }
        // TODO (back-end): salvar o novo status no banco
        linhaAberta.dataset.status = novoStatus;
        trocarStatus(linhaAberta.querySelector('.lst-status'), STATUS, novoStatus);

        aplicar();
        fecharPainel();
        mostrarToast(toast, mensagem);
    }

    // Modal de exclusão
    function abrirModalExcluir() {
        campoConfirma.value = '';
        caixaConfirma.classList.remove('is-erro');
        modal.classList.add('is-open');
        campoConfirma.focus();
    }

    function fecharModalExcluir() {
        modal.classList.remove('is-open');
    }

    function excluirConta() {
        if (campoConfirma.value !== 'EXCLUIR') {
            caixaConfirma.classList.add('is-erro');
            campoConfirma.focus();
            return;
        }
        if (!linhaAberta) {
            return;
        }
        // TODO (back-end): excluir a conta no banco
        linhas.splice(linhas.indexOf(linhaAberta), 1);
        linhaAberta.remove();

        fecharModalExcluir();
        fecharPainel();
        aplicar();
        mostrarToast(toast, 'Conta excluída.');
    }

    // Cliques da página
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        // Clicou fora do filtro: fecha o menu
        if (!alvo.closest('.lst-filtro')) {
            abrirOuFecharMenu(false);
        }

        // Opção do menu de filtro
        const opcao = alvo.closest('[data-filtro]');
        if (opcao) {
            filtro = opcao.dataset.filtro;
            abrirOuFecharMenu(false);
            aplicar();
            return;
        }

        // Botão "Filtro"
        if (alvo.closest('#us-filtro-btn')) {
            abrirOuFecharMenu(!menu.classList.contains('is-open'));
            return;
        }

        // Ordenar pelo título da coluna
        const botaoOrdenar = alvo.closest('[data-ordenar]');
        if (botaoOrdenar) {
            const chave = botaoOrdenar.dataset.ordenar;
            if (ordemChave === chave) {
                ordemDirecao = -ordemDirecao;
            } else {
                ordemDirecao = 1;
            }
            ordemChave = chave;
            aplicar();
            return;
        }

        // Baixar PDF (só as linhas que estão aparecendo)
        if (alvo.closest('[data-pdf]')) {
            const dados = [];
            for (let i = 0; i < linhas.length; i++) {
                const l = linhas[i];
                if (!l.hidden) {
                    dados.push([l.dataset.id, l.dataset.nome, l.dataset.conta, dataBR(l.dataset.cadastro), STATUS[l.dataset.status].rotulo]);
                }
            }
            baixarPdf(toast, 'Lista de usuários', ['ID', 'Nome', 'Conta', 'Cadastro', 'Status'], dados, 'usuarios');
            return;
        }

        // Botões do painel
        if (alvo.closest('#us-suspender')) {
            mudarStatus('suspenso', 'Conta suspensa.');
            return;
        }
        if (alvo.closest('#us-reativar')) {
            mudarStatus('ativo', 'Conta reativada.');
            return;
        }
        if (alvo.closest('#us-excluir')) {
            abrirModalExcluir();
            return;
        }
        if (alvo.closest('#us-excluir-ok')) {
            excluirConta();
            return;
        }

        // Fechar modal de exclusão (botão ou fundo escuro)
        if (alvo.closest('[data-cancelar]') || alvo === modal) {
            fecharModalExcluir();
            return;
        }

        // Fechar painel (botão X ou fundo escuro)
        if (alvo.closest('[data-fechar]')) {
            fecharPainel();
            return;
        }

        // Clicar numa linha abre o painel
        const linha = alvo.closest('tr[data-id]');
        if (linha) {
            abrirPainel(linha);
        }
    });

    // Teclado: Enter ou Espaço numa linha também abre o painel
    corpo.addEventListener('keydown', function (e) {
        if (e.key !== 'Enter' && e.key !== ' ') {
            return;
        }
        const linha = e.target.closest('tr[data-id]');
        if (linha && e.target === linha) {
            e.preventDefault();
            abrirPainel(linha);
        }
    });

    // Busca
    document.getElementById('us-busca').addEventListener('input', function (e) {
        busca = normalizar(e.target.value.trim());
        aplicar();
    });

    // Esc fecha o que está por cima
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') {
            return;
        }
        if (modal.classList.contains('is-open')) {
            fecharModalExcluir();
        } else if (painel.classList.contains('is-open')) {
            fecharPainel();
        } else {
            abrirOuFecharMenu(false);
        }
    });

    aplicar();
}

/* =========================================================
   Logout (pop-up de confirmação)
   ========================================================= */
function logout() {
    const botaoSair = document.getElementById('btn-logout');
    const modal = document.getElementById('logout-modal');
    const formulario = document.getElementById('form-logout');
    if (!botaoSair || !modal || !formulario) {
        return;
    }

    function abrir() {
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.getElementById('logout-cancelar').focus();
    }

    function fechar() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        botaoSair.focus();
    }

    // Botão "Sair" da sidebar: só abre o pop-up
    botaoSair.addEventListener('click', abrir);

    // "Cancelar"
    document.getElementById('logout-cancelar').addEventListener('click', fechar);

    // "Sair" do pop-up: agora sim envia o formulário de logout
    document.getElementById('logout-confirmar').addEventListener('click', function () {
        formulario.submit();
    });

    // Clicar no fundo escuro fecha
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            fechar();
        }
    });

    // Esc fecha
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('is-open')) {
            fechar();
        }
    });
}


/* =========================================================
   Suporte:
   ========================================================= */
function paginaSuporte() {
    const lista = document.getElementById('sup-lista');
    if (!lista) {
        return;
    }

    const itens = Array.from(lista.querySelectorAll('.ti'));
    const chamados = Array.from(document.querySelectorAll('.chamado'));
    const vazio = document.getElementById('sup-vazio');
    const semChamado = document.getElementById('sup-sem-chamado');
    const areaResposta = document.getElementById('sup-resposta-area');
    const caixa = document.getElementById('sup-resposta');
    const botaoEnviar = document.getElementById('sup-enviar');
    const campoArquivo = document.getElementById('sup-arquivo');
    const caixaAnexos = document.getElementById('sup-anexos');
    const toast = document.getElementById('sup-toast');

    let aba = 'o';        // o = abertos, r = resolvidos
    let busca = '';
    let atual = null;     // item da lista que está aberto
    let anexos = [];      // nomes dos arquivos anexados e ainda não enviados

    // Itens que estão aparecendo na lista
    function itensVisiveis() {
        const resultado = [];
        for (let i = 0; i < itens.length; i++) {
            if (!itens[i].hidden) {
                resultado.push(itens[i]);
            }
        }
        return resultado;
    }

    // Conversa (bloco) de um item
    function chamadoDe(item) {
        for (let i = 0; i < chamados.length; i++) {
            if (chamados[i].dataset.id === item.dataset.id) {
                return chamados[i];
            }
        }
        return null;
    }

    // Mostra os anexos escolhidos embaixo da caixa
    function desenharAnexos() {
        caixaAnexos.textContent = '';
        for (let i = 0; i < anexos.length; i++) {
            const chip = document.createElement('span');
            chip.className = 'fc';
            chip.textContent = anexos[i];

            const remover = document.createElement('button');
            remover.type = 'button';
            remover.dataset.removerAnexo = i;
            remover.setAttribute('aria-label', 'Remover');
            remover.textContent = '×';

            chip.appendChild(remover);
            caixaAnexos.appendChild(chip);
        }
    }

    // Abre um chamado na conversa (ou nenhum, se item for null)
    function abrir(item) {
        atual = item;
        caixa.value = '';
        botaoEnviar.disabled = true;
        anexos = [];
        desenharAnexos();

        const visiveis = itensVisiveis();

        for (let i = 0; i < itens.length; i++) {
            itens[i].classList.toggle('on', itens[i] === item);
        }
        for (let i = 0; i < chamados.length; i++) {
            chamados[i].hidden = !(item && chamados[i].dataset.id === item.dataset.id);
        }
        semChamado.hidden = item !== null;
        areaResposta.hidden = item === null;

        if (!item) {
            return;
        }

        // Tira a bolinha de "não lido"
        const bolinha = item.querySelector('.ud');
        if (bolinha) {
            bolinha.remove();
        }

        // Texto do botão resolver e setas
        const bloco = chamadoDe(item);
        const resolvido = item.dataset.status === 'r';
        bloco.querySelector('[data-resolver] span').textContent = resolvido ? ' Reabrir' : ' Marcar como resolvido';

        const posicao = visiveis.indexOf(item);
        bloco.querySelector('[data-anterior]').disabled = posicao === 0;
        bloco.querySelector('[data-proximo]').disabled = posicao === visiveis.length - 1;

        // Rola a conversa até a última mensagem
        const conversa = bloco.querySelector('.thr');
        conversa.scrollTop = conversa.scrollHeight;
    }

    // Filtra a lista pela aba e pela busca
    function aplicar() {
        let mostrados = 0;
        let abertos = 0;

        for (let i = 0; i < itens.length; i++) {
            const item = itens[i];
            const combina = normalizar(item.dataset.texto).includes(busca);

            item.hidden = !(item.dataset.status === aba && combina);
            if (!item.hidden) {
                mostrados++;
            }
            if (item.dataset.status === 'o') {
                abertos++;
            }
        }
        vazio.hidden = mostrados > 0;
        document.getElementById('sup-contagem').textContent = abertos + ' chamados abertos';

        const abas = document.querySelectorAll('[data-aba]');
        for (let i = 0; i < abas.length; i++) {
            abas[i].classList.toggle('on', abas[i].dataset.aba === aba);
        }

        // Se o chamado aberto saiu da lista, abre o primeiro que sobrou
        const visiveis = itensVisiveis();
        if (!atual || atual.hidden) {
            abrir(visiveis.length > 0 ? visiveis[0] : null);
        } else {
            abrir(atual);
        }
    }

    // Marca como resolvido ou reabre
    function alternarResolvido() {
        // TODO (back-end): salvar o novo status no banco
        if (atual.dataset.status === 'o') {
            atual.dataset.status = 'r';
            mostrarToast(toast, 'Chamado resolvido.');
        } else {
            atual.dataset.status = 'o';
            mostrarToast(toast, 'Chamado reaberto.');
        }
        atual = null;
        aplicar();
    }

    // Adiciona a resposta na conversa
    function enviar() {
        const texto = caixa.value.trim();
        if (!atual || texto === '') {
            return;
        }
        // TODO (back-end): enviar a resposta por e-mail e salvar no banco
        const conversa = chamadoDe(atual).querySelector('.thr');

        const mensagem = document.createElement('div');
        mensagem.className = 'bub s';
        mensagem.innerHTML = '<div class="mav">V</div><div><div class="nm">Suporte Vênus</div><div class="em">agora</div><div class="bd2"></div></div>';
        mensagem.querySelector('.bd2').textContent = texto;

        for (let i = 0; i < anexos.length; i++) {
            const chip = document.createElement('span');
            chip.className = 'fc';
            chip.textContent = anexos[i];
            mensagem.querySelector('.bd2').parentNode.appendChild(chip);
        }

        conversa.appendChild(mensagem);
        conversa.scrollTop = conversa.scrollHeight;

        caixa.value = '';
        botaoEnviar.disabled = true;
        anexos = [];
        desenharAnexos();
        mostrarToast(toast, 'Resposta enviada.');
    }

    // Cliques da página
    document.addEventListener('click', function (e) {
        const alvo = e.target;

        // Escolher um chamado na lista
        const item = alvo.closest('.ti');
        if (item) {
            abrir(item);
            return;
        }

        // Trocar de aba
        const botaoAba = alvo.closest('[data-aba]');
        if (botaoAba) {
            aba = botaoAba.dataset.aba;
            atual = null;
            aplicar();
            return;
        }

        // Resposta rápida
        const rapida = alvo.closest('[data-rapida]');
        if (rapida) {
            caixa.value = rapida.dataset.rapida;
            botaoEnviar.disabled = false;
            caixa.focus();
            return;
        }

        // Remover anexo
        const removerAnexo = alvo.closest('[data-remover-anexo]');
        if (removerAnexo) {
            anexos.splice(Number(removerAnexo.dataset.removerAnexo), 1);
            desenharAnexos();
            return;
        }

        if (alvo.closest('[data-resolver]')) {
            alternarResolvido();
        } else if (alvo.closest('[data-anterior]') || alvo.closest('[data-proximo]')) {
            const visiveis = itensVisiveis();
            const passo = alvo.closest('[data-proximo]') ? 1 : -1;
            const vizinho = visiveis[visiveis.indexOf(atual) + passo];
            if (vizinho) {
                abrir(vizinho);
            }
        } else if (alvo.closest('#sup-anexar')) {
            campoArquivo.click();
        } else if (alvo.closest('#sup-enviar')) {
            enviar();
        }
    });

    // Arquivos escolhidos (guarda só o nome, sem banco ainda)
    campoArquivo.addEventListener('change', function () {
        for (let i = 0; i < campoArquivo.files.length; i++) {
            anexos.push(campoArquivo.files[i].name);
        }
        campoArquivo.value = '';
        desenharAnexos();
    });

    // O botão "Responder" só liga quando tem texto
    caixa.addEventListener('input', function () {
        botaoEnviar.disabled = caixa.value.trim() === '';
    });

    // Ctrl + Enter envia
    caixa.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
            enviar();
        }
    });

    // Busca
    document.getElementById('sup-busca').addEventListener('input', function (e) {
        busca = normalizar(e.target.value.trim());
        aplicar();
    });

    criarIcones();
    aplicar();
}

/* =========================================================
   Lista de usuários:
   ========================================================= */
function paginaUsuarios() {
    const pagina = document.querySelector('.lst-page');
    const corpo = document.getElementById('us-corpo');
    if (!pagina || !corpo) {
        return;
    }

    const linhas = Array.from(corpo.querySelectorAll('tr[data-id]'));
    const linhaVazia = document.getElementById('us-vazio');
    const toast = document.getElementById('us-toast');
    const menu = document.getElementById('us-menu');
    const botaoFiltro = document.getElementById('us-filtro-btn');
    const painel = document.getElementById('us-painel');
    const modal = document.getElementById('us-modal');                  // exclusão (digitar EXCLUIR)
    const confirmaModal = document.getElementById('us-confirma-modal'); // suspender / reativar
    const caixaConfirma = document.getElementById('us-confirma-caixa');
    const campoConfirma = document.getElementById('us-confirma');

    const STATUS = {
        ativo:      { rotulo: 'Ativo',      classe: 'lst-status--ok' },
        desativado: { rotulo: 'Desativado', classe: 'lst-status--recusado' },
        suspenso:   { rotulo: 'Suspenso',   classe: 'lst-status--pendente' }
    };

    let filtro = 'todos';     // todos | ativo | desativado | suspenso
    let busca = '';
    let ordemChave = 'cadastro';
    let ordemDirecao = -1;    // -1 = mais recentes primeiro
    let linhaAberta = null;
    let acaoPendente = '';    // 'suspender' ou 'reativar' (enquanto o pop-up está aberto)

    function abrirOuFecharMenu(abrir) {
        menu.classList.toggle('is-open', abrir);
        botaoFiltro.setAttribute('aria-expanded', abrir);
    }

    // Ordena, filtra e busca
    function aplicar() {
        // 1) Ordena (a linha "vazio" fica sempre no fim)
        linhas.sort(function (a, b) {
            const valorA = a.dataset[ordemChave] || '';
            const valorB = b.dataset[ordemChave] || '';
            return valorA.localeCompare(valorB, 'pt-BR', { numeric: true }) * ordemDirecao;
        });
        for (let i = 0; i < linhas.length; i++) {
            corpo.insertBefore(linhas[i], linhaVazia);
        }

        // 2) Esconde quem não passa no filtro ou na busca
        let visiveis = 0;
        for (let i = 0; i < linhas.length; i++) {
            const linha = linhas[i];
            const texto = normalizar(linha.dataset.id + ' ' + linha.dataset.nome + ' ' + linha.dataset.conta);
            const passaFiltro = filtro === 'todos' || linha.dataset.status === filtro;

            linha.hidden = !(passaFiltro && texto.includes(busca));
            if (!linha.hidden) {
                visiveis++;
            }
        }
        linhaVazia.hidden = visiveis > 0;
        escreverTexto('us-contagem', visiveis + ' de ' + linhas.length + ' usuários');

        // 3) Visual do menu, do botão e da setinha da ordenação
        marcarAtivos(menu.querySelectorAll('[data-filtro]'), 'filtro', filtro, false);
        escreverTexto('us-filtro-rotulo', filtro === 'todos' ? 'Filtro' : STATUS[filtro].rotulo);
        marcarOrdem(pagina, ordemChave, ordemDirecao);
    }

    // Painel lateral
    function abrirPainel(linha) {
        linhaAberta = linha;
        const status = linha.dataset.status;

        escreverTexto('us-avatar', linha.dataset.nome[0].toUpperCase());
        escreverTexto('us-nome', linha.dataset.nome);
        escreverTexto('us-meta', linha.dataset.id + ' · ' + linha.dataset.conta);
        escreverTexto('us-cadastro', dataBR(linha.dataset.cadastro));
        trocarStatus(document.getElementById('us-status'), STATUS, status);

        // Ativo pode ser suspenso; os outros podem ser reativados
        document.getElementById('us-suspender').hidden = status !== 'ativo';
        document.getElementById('us-reativar').hidden = status === 'ativo';

        painel.classList.add('is-open');
    }

    function fecharPainel() {
        painel.classList.remove('is-open');
        linhaAberta = null;
    }

    // Muda o status da conta aberta no painel
    function mudarStatus(novoStatus, mensagem) {
        if (!linhaAberta) {
            return;
        }
        // TODO (back-end): salvar o novo status no banco
        linhaAberta.dataset.status = novoStatus;
        trocarStatus(linhaAberta.querySelector('.lst-status'), STATUS, novoStatus);

        aplicar();
        fecharPainel();
        mostrarToast(toast, mensagem);
    }

    // Pop-up: confirmar suspender / reativar
    function abrirConfirmacao(acao) {
        acaoPendente = acao;
        const nome = linhaAberta.dataset.nome;

        if (acao === 'suspender') {
            escreverTexto('us-confirma-titulo', 'Suspender conta?');
            escreverTexto('us-confirma-texto', nome + ' perde o acesso até ser reativada.');
            escreverTexto('us-confirma-ok', 'Suspender');
        } else {
            escreverTexto('us-confirma-titulo', 'Reativar conta?');
            escreverTexto('us-confirma-texto', nome + ' volta a ter acesso ao painel.');
            escreverTexto('us-confirma-ok', 'Reativar');
        }
        confirmaModal.classList.add('is-open');
        criarIcones();
    }

    function fecharConfirmacao() {
        confirmaModal.classList.remove('is-open');
    }

    // Modal de exclusão
    function abrirModalExcluir() {
        campoConfirma.value = '';
        caixaConfirma.classList.remove('is-erro');
        modal.classList.add('is-open');
        campoConfirma.focus();
    }

    function fecharModalExcluir() {
        modal.classList.remove('is-open');
    }

    function excluirConta() {
        if (campoConfirma.value !== 'EXCLUIR') {
            caixaConfirma.classList.add('is-erro');
            campoConfirma.focus();
            return;
        }
        if (!linhaAberta) {
            return;
        }
        // TODO (back-end): excluir a conta no banco
        linhas.splice(linhas.indexOf(linhaAberta), 1);
        linhaAberta.remove();

        fecharModalExcluir();
        fecharPainel();
        aplicar();
        mostrarToast(toast, 'Conta excluída.');
    }

    // Cliques da página
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        // Clicou fora do filtro: fecha o menu
        if (!alvo.closest('.lst-filtro')) {
            abrirOuFecharMenu(false);
        }

        // Opção do menu de filtro
        const opcao = alvo.closest('[data-filtro]');
        if (opcao) {
            filtro = opcao.dataset.filtro;
            abrirOuFecharMenu(false);
            aplicar();
            return;
        }

        // Botão "Filtro"
        if (alvo.closest('#us-filtro-btn')) {
            abrirOuFecharMenu(!menu.classList.contains('is-open'));
            return;
        }

        // Ordenar pelo título da coluna
        const botaoOrdenar = alvo.closest('[data-ordenar]');
        if (botaoOrdenar) {
            const chave = botaoOrdenar.dataset.ordenar;
            if (ordemChave === chave) {
                ordemDirecao = -ordemDirecao;
            } else {
                ordemDirecao = 1;
            }
            ordemChave = chave;
            aplicar();
            return;
        }

        // Baixar PDF (só as linhas que estão aparecendo)
        if (alvo.closest('[data-pdf]')) {
            const dados = [];
            for (let i = 0; i < linhas.length; i++) {
                const l = linhas[i];
                if (!l.hidden) {
                    dados.push([l.dataset.id, l.dataset.nome, l.dataset.conta, dataBR(l.dataset.cadastro), STATUS[l.dataset.status].rotulo]);
                }
            }
            baixarPdf(toast, 'Lista de usuários', ['ID', 'Nome', 'Conta', 'Cadastro', 'Status'], dados, 'usuarios');
            return;
        }

        // Botões do painel: suspender e reativar pedem confirmação
        if (alvo.closest('#us-suspender')) {
            abrirConfirmacao('suspender');
            return;
        }
        if (alvo.closest('#us-reativar')) {
            abrirConfirmacao('reativar');
            return;
        }
        if (alvo.closest('#us-excluir')) {
            abrirModalExcluir();
            return;
        }
        if (alvo.closest('#us-excluir-ok')) {
            excluirConta();
            return;
        }

        // Pop-up de confirmação (suspender / reativar)
        if (alvo.closest('#us-confirma-cancelar') || alvo === confirmaModal) {
            fecharConfirmacao();
            return;
        }
        if (alvo.closest('#us-confirma-ok')) {
            fecharConfirmacao();
            if (acaoPendente === 'suspender') {
                mudarStatus('suspenso', 'Conta suspensa.');
            } else {
                mudarStatus('ativo', 'Conta reativada.');
            }
            return;
        }

        // Fechar modal de exclusão (botão ou fundo escuro)
        if (alvo.closest('[data-cancelar]') || alvo === modal) {
            fecharModalExcluir();
            return;
        }

        // Fechar painel (botão X ou fundo escuro)
        if (alvo.closest('[data-fechar]')) {
            fecharPainel();
            return;
        }

        // Clicar numa linha abre o painel
        const linha = alvo.closest('tr[data-id]');
        if (linha) {
            abrirPainel(linha);
        }
    });

    // Teclado: Enter ou Espaço numa linha também abre o painel
    corpo.addEventListener('keydown', function (e) {
        if (e.key !== 'Enter' && e.key !== ' ') {
            return;
        }
        const linha = e.target.closest('tr[data-id]');
        if (linha && e.target === linha) {
            e.preventDefault();
            abrirPainel(linha);
        }
    });

    // Busca
    document.getElementById('us-busca').addEventListener('input', function (e) {
        busca = normalizar(e.target.value.trim());
        aplicar();
    });

    // Esc fecha o que está por cima
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') {
            return;
        }
        if (confirmaModal.classList.contains('is-open')) {
            fecharConfirmacao();
        } else if (modal.classList.contains('is-open')) {
            fecharModalExcluir();
        } else if (painel.classList.contains('is-open')) {
            fecharPainel();
        } else {
            abrirOuFecharMenu(false);
        }
    });

    aplicar();
}

/* =========================================================
   Mensagens denunciadas:
   ========================================================= */
function paginaMensagensDenunciadas() {
    const lista = document.getElementById('m-lista');
    if (!lista) {
        return;
    }

    const toast = document.getElementById('toast');
    const confirmaModal = document.getElementById('m-confirma-modal');

    // Dados de exemplo (sem banco). status: p = pendente, a = aceita, x = recusada
    const MSG = 'Eu quero que todas vocês que usam esse site parem de usar já! É um lixo, não ouçam as postagens de nenhuma profissional daqui.';

    const mensagens = [
        {
            nome: 'Karolyne Anjos', data: '03/09/2026', texto: MSG, motivo: 'Calúnia e Injúria',
            descricao: 'A mensagem não tem nenhum fundamento, nem argumentos, apenas xingamentos sem fundamento.', status: 'p'
        },
        {
            nome: 'Agatha Volkomenn', data: '28/04/2026',
            texto: 'Eu acho que a melhor saída pra isso é contatar aqui sroverissimo1413@hotmail.com',
            motivo: 'Contato Vazado',
            descricao: 'O email nessa mensagem não é o email da usuária, então considero como um email falso.', status: 'p'
        },
        {
            nome: 'Karolyne Anjos', data: '2 dias atrás', texto: MSG, motivo: 'Outro',
            descricao: 'Não gosto da usuária, e gostaria que fosse removido e ela tivesse a conta bloqueada, por favor.', status: 'p'
        }
    ];

    const AVISOS = {
        a: 'Denúncia aceita. A mensagem será analisada para remoção.',
        x: 'Denúncia recusada.',
        p: 'Denúncia revertida para pendente.'
    };

    let aba = 'p';
    let busca = '';
    let numeroPendente = -1;   // qual mensagem está esperando confirmação
    let acaoPendente = '';     // 'a' (aceitar) ou 'x' (recusar)

    // Monta os cartões na tela
    function desenhar() {
        let html = '';

        for (let i = 0; i < mensagens.length; i++) {
            const m = mensagens[i];
            const texto = (m.nome + ' ' + m.texto + ' ' + m.motivo).toLowerCase();

            // Só desenha se for da aba atual e combinar com a busca
            if (m.status !== aba || !texto.includes(busca)) {
                continue;
            }

            let botoes = '';
            if (m.status === 'p') {
                botoes = '<button type="button" class="lst-btn lst-btn--neutro lst-btn--pequeno" data-acao="x" data-i="' + i + '">Recusar denúncia</button>'
                       + '<button type="button" class="lst-btn lst-btn--primario lst-btn--pequeno" data-acao="a" data-i="' + i + '">Aceitar denúncia</button>';
            } else {
                botoes = '<button type="button" class="lst-btn lst-btn--neutro lst-btn--pequeno" data-acao="p" data-i="' + i + '"><i data-lucide="undo-2"></i>Reverter</button>';
            }

            html += '<article class="lst-msg">'
                  +   '<span class="lst-avatar">' + escapar(m.nome[0]) + '</span>'
                  +   '<div>'
                  +     '<div class="lst-msg-autor"><b>' + escapar(m.nome) + '</b><span class="lst-mute">' + escapar(m.data) + '</span></div>'
                  +     '<blockquote class="lst-citacao">' + escapar(m.texto) + '</blockquote>'
                  +     '<span class="lst-msg-motivo">' + escapar(m.motivo) + '</span>'
                  +     '<p class="lst-msg-descricao">' + escapar(m.descricao) + '</p>'
                  +   '</div>'
                  +   '<div class="lst-msg-botoes">' + botoes + '</div>'
                  + '</article>';
        }

        if (html === '') {
            html = '<p class="lst-vazio">Nenhuma mensagem aqui.</p>';
        }
        lista.innerHTML = html;

        // Número de pendentes nos dois selos
        let pendentes = 0;
        for (let i = 0; i < mensagens.length; i++) {
            if (mensagens[i].status === 'p') {
                pendentes++;
            }
        }
        const selos = [document.getElementById('m-badge'), document.getElementById('m-pend')];
        for (let i = 0; i < selos.length; i++) {
            selos[i].textContent = pendentes;
            selos[i].hidden = pendentes === 0;
        }

        // Aba ativa
        marcarAtivos(document.querySelectorAll('[data-ms]'), 'ms', aba, false);
        criarIcones();
    }

    function fecharConfirmacao() {
        confirmaModal.classList.remove('is-open');
    }

    // Cliques nas abas e nos botões dos cartões
    document.addEventListener('click', function (e) {
        const botaoAba = e.target.closest('[data-ms]');
        if (botaoAba) {
            aba = botaoAba.dataset.ms;
            desenhar();
            return;
        }

        const botaoAcao = e.target.closest('[data-acao]');
        if (botaoAcao) {
            const numero = Number(botaoAcao.dataset.i);
            const acao = botaoAcao.dataset.acao;

            // "Reverter" não precisa de confirmação
            if (acao === 'p') {
                mensagens[numero].status = 'p';
                desenhar();
                mostrarToast(toast, AVISOS.p);
                return;
            }

            // Aceitar e recusar abrem o pop-up
            numeroPendente = numero;
            acaoPendente = acao;
            if (acao === 'a') {
                escreverTexto('m-confirma-titulo', 'Aceitar denúncia?');
                escreverTexto('m-confirma-texto', 'A mensagem será analisada para remoção.');
                escreverTexto('m-confirma-ok', 'Aceitar denúncia');
            } else {
                escreverTexto('m-confirma-titulo', 'Recusar denúncia?');
                escreverTexto('m-confirma-texto', 'A mensagem continuará visível na plataforma.');
                escreverTexto('m-confirma-ok', 'Recusar denúncia');
            }
            confirmaModal.classList.add('is-open');
            criarIcones();
        }
    });

    // Botões do pop-up
    document.getElementById('m-confirma-cancelar').addEventListener('click', fecharConfirmacao);

    document.getElementById('m-confirma-ok').addEventListener('click', function () {
        fecharConfirmacao();
        // TODO (back-end): salvar a decisão no banco
        mensagens[numeroPendente].status = acaoPendente;
        desenhar();
        mostrarToast(toast, AVISOS[acaoPendente]);
    });

    // Clicar no fundo escuro fecha
    confirmaModal.addEventListener('click', function (e) {
        if (e.target === confirmaModal) {
            fecharConfirmacao();
        }
    });

    // Esc fecha
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            fecharConfirmacao();
        }
    });

    // Busca
    document.getElementById('m-busca').addEventListener('input', function (e) {
        busca = e.target.value.toLowerCase();
        desenhar();
    });

    desenhar();
}

/* =========================================================
   Suporte:
   ========================================================= */
function paginaSuporte() {
    const lista = document.getElementById('sup-lista');
    if (!lista) {
        return;
    }

    const itens = Array.from(lista.querySelectorAll('.ti'));
    const chamados = Array.from(document.querySelectorAll('.chamado'));
    const vazio = document.getElementById('sup-vazio');
    const semChamado = document.getElementById('sup-sem-chamado');
    const areaResposta = document.getElementById('sup-resposta-area');
    const caixa = document.getElementById('sup-resposta');
    const botaoEnviar = document.getElementById('sup-enviar');
    const campoArquivo = document.getElementById('sup-arquivo');
    const caixaAnexos = document.getElementById('sup-anexos');
    const confirmaModal = document.getElementById('sup-confirma-modal');
    const toast = document.getElementById('sup-toast');

    let aba = 'o';        // o = abertos, r = resolvidos
    let busca = '';
    let atual = null;     // item da lista que está aberto
    let anexos = [];      // nomes dos arquivos anexados e ainda não enviados

    // Itens que estão aparecendo na lista
    function itensVisiveis() {
        const resultado = [];
        for (let i = 0; i < itens.length; i++) {
            if (!itens[i].hidden) {
                resultado.push(itens[i]);
            }
        }
        return resultado;
    }

    // Conversa (bloco) de um item
    function chamadoDe(item) {
        for (let i = 0; i < chamados.length; i++) {
            if (chamados[i].dataset.id === item.dataset.id) {
                return chamados[i];
            }
        }
        return null;
    }

    // Mostra os anexos escolhidos embaixo da caixa
    function desenharAnexos() {
        caixaAnexos.textContent = '';
        for (let i = 0; i < anexos.length; i++) {
            const chip = document.createElement('span');
            chip.className = 'fc';
            chip.textContent = anexos[i];

            const remover = document.createElement('button');
            remover.type = 'button';
            remover.dataset.removerAnexo = i;
            remover.setAttribute('aria-label', 'Remover');
            remover.textContent = '×';

            chip.appendChild(remover);
            caixaAnexos.appendChild(chip);
        }
    }

    // Abre um chamado na conversa (ou nenhum, se item for null)
    function abrir(item) {
        atual = item;
        caixa.value = '';
        botaoEnviar.disabled = true;
        anexos = [];
        desenharAnexos();

        const visiveis = itensVisiveis();

        for (let i = 0; i < itens.length; i++) {
            itens[i].classList.toggle('on', itens[i] === item);
        }
        for (let i = 0; i < chamados.length; i++) {
            chamados[i].hidden = !(item && chamados[i].dataset.id === item.dataset.id);
        }
        semChamado.hidden = item !== null;
        areaResposta.hidden = item === null;

        if (!item) {
            return;
        }

        // Tira a bolinha de "não lido"
        const bolinha = item.querySelector('.ud');
        if (bolinha) {
            bolinha.remove();
        }

        // Texto do botão resolver e setas
        const bloco = chamadoDe(item);
        const resolvido = item.dataset.status === 'r';
        bloco.querySelector('[data-resolver] span').textContent = resolvido ? ' Reabrir' : ' Marcar como resolvido';

        const posicao = visiveis.indexOf(item);
        bloco.querySelector('[data-anterior]').disabled = posicao === 0;
        bloco.querySelector('[data-proximo]').disabled = posicao === visiveis.length - 1;

        // Rola a conversa até a última mensagem
        const conversa = bloco.querySelector('.thr');
        conversa.scrollTop = conversa.scrollHeight;
    }

    // Filtra a lista pela aba e pela busca
    function aplicar() {
        let mostrados = 0;
        let abertos = 0;

        for (let i = 0; i < itens.length; i++) {
            const item = itens[i];
            const combina = normalizar(item.dataset.texto).includes(busca);

            item.hidden = !(item.dataset.status === aba && combina);
            if (!item.hidden) {
                mostrados++;
            }
            if (item.dataset.status === 'o') {
                abertos++;
            }
        }
        vazio.hidden = mostrados > 0;
        escreverTexto('sup-contagem', abertos + ' chamados abertos');

        const abas = document.querySelectorAll('[data-aba]');
        for (let i = 0; i < abas.length; i++) {
            abas[i].classList.toggle('on', abas[i].dataset.aba === aba);
        }

        // Se o chamado aberto saiu da lista, abre o primeiro que sobrou
        const visiveis = itensVisiveis();
        if (!atual || atual.hidden) {
            abrir(visiveis.length > 0 ? visiveis[0] : null);
        } else {
            abrir(atual);
        }
    }

    // Marca como resolvido ou reabre (só roda depois da confirmação)
    function alternarResolvido() {
        // TODO (back-end): salvar o novo status no banco
        if (atual.dataset.status === 'o') {
            atual.dataset.status = 'r';
            mostrarToast(toast, 'Chamado resolvido.');
        } else {
            atual.dataset.status = 'o';
            mostrarToast(toast, 'Chamado reaberto.');
        }
        atual = null;
        aplicar();
    }

    function fecharConfirmacao() {
        confirmaModal.classList.remove('is-open');
    }

    // Adiciona a resposta na conversa
    function enviar() {
        const texto = caixa.value.trim();
        if (!atual || texto === '') {
            return;
        }
        // TODO (back-end): enviar a resposta por e-mail e salvar no banco
        const conversa = chamadoDe(atual).querySelector('.thr');

        const mensagem = document.createElement('div');
        mensagem.className = 'bub s';
        mensagem.innerHTML = '<div class="mav">V</div><div><div class="nm">Suporte Vênus</div><div class="em">agora</div><div class="bd2"></div></div>';
        mensagem.querySelector('.bd2').textContent = texto;

        for (let i = 0; i < anexos.length; i++) {
            const chip = document.createElement('span');
            chip.className = 'fc';
            chip.textContent = anexos[i];
            mensagem.querySelector('.bd2').parentNode.appendChild(chip);
        }

        conversa.appendChild(mensagem);
        conversa.scrollTop = conversa.scrollHeight;

        caixa.value = '';
        botaoEnviar.disabled = true;
        anexos = [];
        desenharAnexos();
        mostrarToast(toast, 'Resposta enviada.');
    }

    // Cliques da página
    document.addEventListener('click', function (e) {
        const alvo = e.target;

        // Escolher um chamado na lista
        const item = alvo.closest('.ti');
        if (item) {
            abrir(item);
            return;
        }

        // Trocar de aba
        const botaoAba = alvo.closest('[data-aba]');
        if (botaoAba) {
            aba = botaoAba.dataset.aba;
            atual = null;
            aplicar();
            return;
        }

        // Resposta rápida
        const rapida = alvo.closest('[data-rapida]');
        if (rapida) {
            caixa.value = rapida.dataset.rapida;
            botaoEnviar.disabled = false;
            caixa.focus();
            return;
        }

        // Remover anexo
        const removerAnexo = alvo.closest('[data-remover-anexo]');
        if (removerAnexo) {
            anexos.splice(Number(removerAnexo.dataset.removerAnexo), 1);
            desenharAnexos();
            return;
        }

        // Marcar como resolvido / reabrir: abre o pop-up de confirmação
        if (alvo.closest('[data-resolver]')) {
            escreverTexto('sup-confirma-titulo', atual.dataset.status === 'o' ? 'Marcar como resolvido?' : 'Reabrir chamado?');
            confirmaModal.classList.add('is-open');
            criarIcones();
            return;
        }

        // Botões do pop-up
        if (alvo.closest('#sup-confirma-cancelar') || alvo === confirmaModal) {
            fecharConfirmacao();
            return;
        }
        if (alvo.closest('#sup-confirma-ok')) {
            fecharConfirmacao();
            alternarResolvido();
            return;
        }

        if (alvo.closest('[data-anterior]') || alvo.closest('[data-proximo]')) {
            const visiveis = itensVisiveis();
            const passo = alvo.closest('[data-proximo]') ? 1 : -1;
            const vizinho = visiveis[visiveis.indexOf(atual) + passo];
            if (vizinho) {
                abrir(vizinho);
            }
        } else if (alvo.closest('#sup-anexar')) {
            campoArquivo.click();
        } else if (alvo.closest('#sup-enviar')) {
            enviar();
        }
    });

    // Arquivos escolhidos (guarda só o nome, sem banco ainda)
    campoArquivo.addEventListener('change', function () {
        for (let i = 0; i < campoArquivo.files.length; i++) {
            anexos.push(campoArquivo.files[i].name);
        }
        campoArquivo.value = '';
        desenharAnexos();
    });

    // O botão "Responder" só liga quando tem texto
    caixa.addEventListener('input', function () {
        botaoEnviar.disabled = caixa.value.trim() === '';
    });

    // Ctrl + Enter envia
    caixa.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
            enviar();
        }
    });

    // Esc fecha o pop-up
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            fecharConfirmacao();
        }
    });

    // Busca
    document.getElementById('sup-busca').addEventListener('input', function (e) {
        busca = normalizar(e.target.value.trim());
        aplicar();
    });

    criarIcones();
    aplicar();
}

/* =========================================================
   Criar destaque:
   ========================================================= */
function paginaCriarDestaque() {
    const pagina = document.querySelector('.dst-page');
    const form = document.getElementById('form-destaque');
    if (!pagina || !form) {
        return;
    }

    const etapas = Array.from(pagina.querySelectorAll('.dst-etapa'));
    const passos = Array.from(pagina.querySelectorAll('.dst-passo'));

    const caixaTags = document.getElementById('tags');
    const campoTag = document.getElementById('tag-entrada');
    const dicaTag = document.getElementById('tag-dica');

    const arquivoPrincipal = document.getElementById('arquivo-principal');
    const arquivoComplementar = document.getElementById('arquivo-complementar');
    const listaComplementares = document.getElementById('complementares');

    const modal = document.getElementById('modal-publicar');            // publicar
    const modalPergunta = document.getElementById('modal-pergunta');    // Sim ou Não
    const toast = document.getElementById('dst-toast');

    // Campos obrigatórios de cada etapa (o nome é o atributo name do campo)
    const OBRIGATORIOS = {
        1: ['titulo', 'objetivo', 'publico_alvo', 'faixa_etaria', 'categoria', 'duracao'],
        2: ['mensagem', 'texto', 'cta', 'fontes'],
        3: ['peca_principal']
    };

    // Textos da prévia: [id na prévia, nome do campo, texto de exemplo]
    const PREVIA = [
        ['previa-titulo', 'titulo', 'Título do destaque'],
        ['previa-mensagem', 'mensagem', 'Mensagem principal'],
        ['previa-texto', 'texto', 'O texto de apresentação aparece aqui conforme você digita.'],
        ['previa-publico', 'publico_alvo', 'Público'],
        ['previa-faixa', 'faixa_etaria', 'Faixa etária'],
        ['previa-duracao', 'duracao', 'Duração']
    ];

    const TEXTO_DICA = 'Até 8 tags. Use Enter ou vírgula para adicionar.';

    const dados = {};          // guarda o que foi digitado em cada campo
    let etapaAtual = 1;
    let tags = [];
    let principal = null;      // { nome, tamanho, url }
    let complementares = [];   // [{ nome, tamanho }]
    let acaoSePedirSim = null; // o que fazer se clicar em "Sim"

    // Acha a "caixinha" de um campo pelo nome
    function campoDe(nome) {
        return pagina.querySelector('[data-campo="' + nome + '"]');
    }

    // 1500000 vira "1.4 MB"
    function formatarTamanho(bytes) {
        if (bytes > 1048576) {
            return (bytes / 1048576).toFixed(1) + ' MB';
        }
        return Math.max(1, Math.round(bytes / 1024)) + ' KB';
    }

    // Escolhe o ícone conforme o tipo do arquivo
    function iconeDoArquivo(nome) {
        if (/\.(png|jpe?g|gif|webp)$/i.test(nome)) return 'file-image';
        if (/\.(mp3|wav|ogg)$/i.test(nome)) return 'file-audio';
        return 'file-text';
    }

    /* ---------- Modal Sim ou Não ---------- */
    // "acao" é a função que roda só se clicar em Sim
    function perguntar(pergunta, acao) {
        escreverTexto('pergunta-texto', pergunta);
        acaoSePedirSim = acao;
        modalPergunta.classList.add('is-open');
    }

    function fecharPergunta() {
        modalPergunta.classList.remove('is-open');
        acaoSePedirSim = null;
    }

    /* ---------- Etapas ---------- */
    function mostrarEtapa(numero) {
        etapaAtual = numero;

        for (let i = 0; i < etapas.length; i++) {
            etapas[i].classList.toggle('is-on', Number(etapas[i].dataset.etapa) === numero);
        }

        for (let i = 0; i < passos.length; i++) {
            const n = i + 1;
            passos[i].classList.toggle('is-done', n < numero);
            passos[i].classList.toggle('is-on', n === numero);
        }

        if (numero === 4) {
            preencherResumo();
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Confere os campos obrigatórios da etapa e marca os vazios em vermelho
    function validar(numero) {
        const nomes = OBRIGATORIOS[numero] || [];
        let primeiroErro = null;

        for (let i = 0; i < nomes.length; i++) {
            const campo = campoDe(nomes[i]);
            const vazio = !(dados[nomes[i]] || '').trim();
            campo.classList.toggle('is-erro', vazio);
            if (vazio && !primeiroErro) {
                primeiroErro = campo;
            }
        }

        if (primeiroErro) {
            const elemento = primeiroErro.querySelector('input, textarea, select, button');
            if (elemento) {
                elemento.focus();
            }
            mostrarToast(toast, 'Preencha os campos destacados.');
            return false;
        }
        return true;
    }

    /* ---------- Prévia ---------- */
    function atualizarPrevia() {
        // Textos: se o campo estiver vazio, mostra o exemplo em cinza
        for (let i = 0; i < PREVIA.length; i++) {
            const elemento = document.getElementById(PREVIA[i][0]);
            const valor = dados[PREVIA[i][1]];
            elemento.textContent = valor || PREVIA[i][2];
            elemento.classList.toggle('dst-vazio', !valor);
        }

        // Categoria sem o texto entre parênteses
        escreverTexto('previa-categoria', dados.categoria ? dados.categoria.replace(/ \(.*\)/, '') : 'Categoria');
        escreverTexto('previa-cta', dados.cta || 'Chamada para ação');
        escreverTexto('previa-fontes', dados.fontes ? 'Fontes: ' + dados.fontes : '');

        // Imagem da peça principal
        const imagem = document.getElementById('previa-imagem');
        const temImagem = principal !== null && principal.url;
        imagem.style.backgroundImage = temImagem ? 'url("' + principal.url + '")' : '';
        imagem.classList.toggle('tem-imagem', temImagem);

        // Tags
        const caixa = document.getElementById('previa-tags');
        caixa.textContent = '';
        for (let i = 0; i < tags.length; i++) {
            const chip = document.createElement('span');
            chip.className = 'dst-chip';
            chip.textContent = '#' + tags[i];
            caixa.appendChild(chip);
        }
    }

    // Quando digita em qualquer campo: guarda o valor, atualiza o contador e a prévia
    form.addEventListener('input', function (e) {
        const campo = e.target.closest('[data-campo]');
        if (!campo || !e.target.name || e.target.type === 'file') {
            return;
        }

        dados[e.target.name] = e.target.value;

        const contador = campo.querySelector('.dst-contador');
        if (contador) {
            contador.textContent = e.target.value.length + '/' + e.target.maxLength;
        }

        if (e.target.value.trim()) {
            campo.classList.remove('is-erro');
        }
        atualizarPrevia();
    });

    /* ---------- Tags ---------- */
    function desenharTags() {
        // Apaga as tags antigas e desenha todas de novo
        const antigas = caixaTags.querySelectorAll('.dst-tag');
        for (let i = 0; i < antigas.length; i++) {
            antigas[i].remove();
        }

        for (let i = 0; i < tags.length; i++) {
            const tag = document.createElement('span');
            tag.className = 'dst-tag';
            tag.textContent = tags[i];

            const remover = document.createElement('button');
            remover.type = 'button';
            remover.dataset.removerTag = i;
            remover.setAttribute('aria-label', 'Remover ' + tags[i]);
            remover.innerHTML = '<i data-lucide="x"></i>';

            tag.appendChild(remover);
            caixaTags.insertBefore(tag, campoTag);
        }

        document.getElementById('tags-valor').value = tags.join(',');
        criarIcones();
        atualizarPrevia();
    }

    function avisarTag(texto, erro) {
        dicaTag.textContent = texto;
        dicaTag.classList.toggle('is-erro', erro);
    }

    function adicionarTag() {
        const texto = campoTag.value.replace(/,/g, '').trim();
        if (!texto) {
            return;
        }

        // Já existe uma tag igual?
        for (let i = 0; i < tags.length; i++) {
            if (tags[i].toLowerCase() === texto.toLowerCase()) {
                campoTag.value = '';
                avisarTag('Essa tag já foi adicionada.', true);
                return;
            }
        }

        if (tags.length >= 8) {
            avisarTag('Limite de 8 tags atingido.', true);
            return;
        }

        tags.push(texto);
        campoTag.value = '';
        avisarTag(TEXTO_DICA, false);
        desenharTags();
    }

    campoTag.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            adicionarTag();
        } else if (e.key === 'Backspace' && campoTag.value === '' && tags.length > 0) {
            tags.pop();
            desenharTags();
        }
    });

    campoTag.addEventListener('blur', adicionarTag);

    caixaTags.addEventListener('click', function (e) {
        const remover = e.target.closest('[data-remover-tag]');
        if (remover) {
            tags.splice(Number(remover.dataset.removerTag), 1);
            desenharTags();
        }
        campoTag.focus();
    });

    /* ---------- Arquivos ---------- */
    function desenharPrincipal() {
        document.getElementById('principal-vazio').hidden = principal !== null;
        document.getElementById('principal-arquivo').hidden = principal === null;
        if (!principal) {
            return;
        }

        escreverTexto('principal-nome', principal.nome);
        escreverTexto('principal-tamanho', formatarTamanho(principal.tamanho));

        const miniatura = document.getElementById('principal-miniatura');
        miniatura.style.backgroundImage = principal.url ? 'url("' + principal.url + '")' : '';
        const icone = miniatura.querySelector('svg, i');
        if (icone) {
            icone.style.display = principal.url ? 'none' : '';
        }
    }

    function desenharComplementares() {
        listaComplementares.textContent = '';

        for (let i = 0; i < complementares.length; i++) {
            const item = document.getElementById('modelo-arquivo').content.cloneNode(true);

            item.querySelector('b').textContent = complementares[i].nome;
            item.querySelector('.dst-mute').textContent = formatarTamanho(complementares[i].tamanho);
            item.querySelector('[data-lucide]').dataset.lucide = iconeDoArquivo(complementares[i].nome);
            item.querySelector('[data-remover-material]').dataset.removerMaterial = i;

            listaComplementares.appendChild(item);
        }
        criarIcones();
    }

    // Peça principal escolhida (ou substituída)
    arquivoPrincipal.addEventListener('change', function () {
        const arquivo = arquivoPrincipal.files[0];
        if (!arquivo) {
            return;
        }

        if (principal && principal.url) {
            URL.revokeObjectURL(principal.url);
        }
        principal = { nome: arquivo.name, tamanho: arquivo.size, url: URL.createObjectURL(arquivo) };
        dados.peca_principal = arquivo.name;

        campoDe('peca_principal').classList.remove('is-erro');
        desenharPrincipal();
        atualizarPrevia();
        criarIcones();
    });

    // Materiais complementares escolhidos
    arquivoComplementar.addEventListener('change', function () {
        for (let i = 0; i < arquivoComplementar.files.length; i++) {
            const arquivo = arquivoComplementar.files[i];
            complementares.push({ nome: arquivo.name, tamanho: arquivo.size });
        }
        arquivoComplementar.value = '';
        desenharComplementares();
    });

    /* ---------- Resumo (etapa 4) ---------- */
    function preencherResumo() {
        const nomesOutros = [];
        for (let i = 0; i < complementares.length; i++) {
            nomesOutros.push(complementares[i].nome);
        }

        const valores = {
            titulo: dados.titulo,
            objetivo: dados.objetivo,
            publico_alvo: dados.publico_alvo,
            faixa_etaria: dados.faixa_etaria,
            categoria: dados.categoria,
            duracao: dados.duracao,
            tags: tags.join(', '),
            mensagem: dados.mensagem,
            texto: dados.texto,
            cta: dados.cta,
            fontes: dados.fontes,
            principal: principal ? principal.nome : '',
            outros: nomesOutros.join(', ')
        };

        const elementos = pagina.querySelectorAll('[data-resumo]');
        for (let i = 0; i < elementos.length; i++) {
            elementos[i].textContent = valores[elementos[i].dataset.resumo] || '—';
        }
    }

    /* ---------- Modal de publicar ---------- */
    function fecharModal() {
        modal.classList.remove('is-open');
    }

    /* ---------- Cliques da página ---------- */
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        if (alvo.closest('[data-proxima]')) {
            if (validar(etapaAtual)) {
                mostrarEtapa(etapaAtual + 1);
            }
            return;
        }

        if (alvo.closest('[data-anterior]')) {
            mostrarEtapa(etapaAtual - 1);
            return;
        }

        if (alvo.closest('[data-editar]')) {
            mostrarEtapa(1);
            return;
        }

        // Abre a janela de escolher arquivo
        const escolher = alvo.closest('[data-escolher]');
        if (escolher) {
            if (escolher.dataset.escolher === 'principal') {
                arquivoPrincipal.click();
            } else {
                arquivoComplementar.click();
            }
            return;
        }

        // Remover a peça principal: pergunta antes
        if (alvo.closest('[data-remover-principal]')) {
            perguntar('Deseja remover a peça principal?', function () {
                if (principal && principal.url) {
                    URL.revokeObjectURL(principal.url);
                }
                principal = null;
                delete dados.peca_principal;
                desenharPrincipal();
                atualizarPrevia();
                mostrarToast(toast, 'Peça principal removida.');
            });
            return;
        }

        // Remover um material complementar: pergunta antes
        const removerMaterial = alvo.closest('[data-remover-material]');
        if (removerMaterial) {
            const numero = Number(removerMaterial.dataset.removerMaterial);
            perguntar('Deseja remover "' + complementares[numero].nome + '"?', function () {
                complementares.splice(numero, 1);
                desenharComplementares();
                mostrarToast(toast, 'Material removido.');
            });
            return;
        }

        // Modal Sim ou Não
        if (alvo.closest('#pergunta-nao') || alvo === modalPergunta) {
            fecharPergunta();
            return;
        }
        if (alvo.closest('#pergunta-sim')) {
            const acao = acaoSePedirSim;
            fecharPergunta();
            if (acao) {
                acao();
            }
            return;
        }

        // Modal de publicar
        if (alvo.closest('[data-publicar]')) {
            modal.classList.add('is-open');
            return;
        }

        if (alvo.closest('[data-cancelar]') || alvo === modal) {
            fecharModal();
            return;
        }

        const confirmar = alvo.closest('[data-confirmar]');
        if (confirmar) {
            // TODO (back-end): enviar o formulário (form.submit()) em vez de só voltar para a lista
            fecharModal();
            mostrarToast(toast, 'Destaque publicado.');
            setTimeout(function () {
                window.location.href = confirmar.dataset.destino;
            }, 900);
        }
    });

    // Esc fecha o que está por cima
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') {
            return;
        }
        if (modalPergunta.classList.contains('is-open')) {
            fecharPergunta();
        } else {
            fecharModal();
        }
    });

    // Página estática: o formulário ainda não envia nada
    form.addEventListener('submit', function (e) {
        e.preventDefault();
    });

    atualizarPrevia();
}

/* =========================================================
   Lista Conteudos Aprender
   ========================================================= */
function paginaConteudos() {
    const pagina = document.querySelector('.lst-page');
    const corpo = document.getElementById('ct-corpo');
    if (!pagina || !corpo) {
        return;
    }

    const linhas = Array.from(corpo.querySelectorAll('tr[data-id]'));
    const linhaVazia = document.getElementById('ct-vazio');
    const toast = document.getElementById('ct-toast');
    const menu = document.getElementById('ct-menu');
    const botaoFiltro = document.getElementById('ct-filtro-btn');
    const modal = document.getElementById('ct-modal');
    const modalCompleto = document.getElementById('ct-modal-completo');
    const modalPergunta = document.getElementById('ct-pergunta-modal');   // Sim ou Não

    const STATUS = {
        analise:   { rotulo: 'Em análise', classe: 'lst-status--pendente' },
        publicado: { rotulo: 'Publicado',  classe: 'lst-status--ok' },
        recusado:  { rotulo: 'Recusado',   classe: 'lst-status--recusado' }
    };

    let filtro = 'todos';      // todos | analise | publicado | recusado
    let busca = '';
    let linhaAberta = null;
    let acaoSePedirSim = null; // o que fazer se clicar em "Sim"

    // Texto de uma coluna: 0 ID, 1 Profissional, 2 Título, 3 Data, 4 Status
    function celula(linha, numero) {
        return linha.cells[numero].textContent.trim();
    }

    function abrirOuFecharMenu(abrir) {
        menu.classList.toggle('is-open', abrir);
        botaoFiltro.setAttribute('aria-expanded', abrir);
    }

    // Modal Sim ou Não: "acao" roda só se clicar em Sim
    function perguntar(pergunta, acao) {
        escreverTexto('ct-pergunta-texto', pergunta);
        acaoSePedirSim = acao;
        modalPergunta.classList.add('is-open');
    }

    function fecharPergunta() {
        modalPergunta.classList.remove('is-open');
        acaoSePedirSim = null;
    }

    // Filtra e busca
    function aplicar() {
        let visiveis = 0;
        for (let i = 0; i < linhas.length; i++) {
            const linha = linhas[i];
            const texto = normalizar(celula(linha, 0) + ' ' + celula(linha, 1) + ' ' + celula(linha, 2));
            const passaFiltro = filtro === 'todos' || linha.dataset.status === filtro;

            linha.hidden = !(passaFiltro && texto.includes(busca));
            if (!linha.hidden) {
                visiveis++;
            }
        }
        linhaVazia.hidden = visiveis > 0;

        // Números dos cards
        let recusados = 0;
        let emAnalise = 0;
        let publicados = 0;
        for (let i = 0; i < linhas.length; i++) {
            const status = linhas[i].dataset.status;
            if (status === 'recusado') recusados++;
            if (status === 'analise') emAnalise++;
            if (status === 'publicado') publicados++;
        }
        escreverTexto('ct-recusados', recusados);
        escreverTexto('ct-analise', emAnalise);
        escreverTexto('ct-publicados', publicados);

        marcarAtivos(pagina.querySelectorAll('[data-filtro]'), 'filtro', filtro, true);
        escreverTexto('ct-filtro-rotulo', filtro === 'todos' ? 'Filtro' : STATUS[filtro].rotulo);
    }

    // Modal 1: revisão
    function abrirRevisao(linha) {
        linhaAberta = linha;
        const status = linha.dataset.status;

        escreverTexto('ct-avatar', linha.dataset.nome[0].toUpperCase());
        escreverTexto('ct-nome', linha.dataset.nome);
        escreverTexto('ct-id', linha.dataset.id);
        escreverTexto('ct-titulo', celula(linha, 2));
        trocarStatus(document.getElementById('ct-status'), STATUS, status);

        // Não faz sentido aprovar quem já está publicado (nem recusar quem já foi recusado)
        document.getElementById('ct-aprovar').disabled = status === 'publicado';
        document.getElementById('ct-recusar').disabled = status === 'recusado';

        modal.classList.add('is-open');
    }

    function fecharTudo() {
        modal.classList.remove('is-open');
        modalCompleto.classList.remove('is-open');
        linhaAberta = null;
    }

    // Aplica a decisão (só roda depois de clicar em Sim)
    function decidir(novoStatus) {
        if (!linhaAberta) {
            return;
        }
        // TODO (back-end): salvar a decisão no banco e avisar o profissional
        linhaAberta.dataset.status = novoStatus;
        trocarStatus(linhaAberta.querySelector('.lst-status'), STATUS, novoStatus);

        aplicar();
        fecharTudo();
        if (novoStatus === 'publicado') {
            mostrarToast(toast, 'Conteúdo aprovado e publicado.');
        } else {
            mostrarToast(toast, 'Conteúdo recusado.');
        }
    }

    // Modal 2: conteúdo completo
    function abrirCompleto() {
        if (!linhaAberta) {
            return;
        }
        const l = linhaAberta;

        escreverTexto('cc-titulo', l.dataset.tituloCompleto || celula(l, 2));
        escreverTexto('cc-resumo', l.dataset.resumo || 'Conteúdo enviado pelo profissional para revisão. O texto completo aparece aqui na versão final.');
        escreverTexto('cc-autor', l.dataset.nome);
        escreverTexto('cc-cargo', l.dataset.cargo + ' · ' + celula(l, 3));
        document.getElementById('cc-artigo').hidden = !l.dataset.completo;

        modalCompleto.classList.add('is-open');
    }

    function fecharCompleto() {
        modalCompleto.classList.remove('is-open');
    }

    // Cliques da página
    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        // Clicou fora do filtro: fecha o menu
        if (!alvo.closest('.lst-filtro')) {
            abrirOuFecharMenu(false);
        }

        // Cards e opções do menu (clicar de novo num card ativo volta para "todos")
        const itemFiltro = alvo.closest('[data-filtro]');
        if (itemFiltro) {
            const ehCard = itemFiltro.classList.contains('lst-kpi');
            if (ehCard && itemFiltro.dataset.filtro === filtro) {
                filtro = 'todos';
            } else {
                filtro = itemFiltro.dataset.filtro;
            }
            abrirOuFecharMenu(false);
            aplicar();
            return;
        }

        // Botão "Filtro"
        if (alvo.closest('#ct-filtro-btn')) {
            abrirOuFecharMenu(!menu.classList.contains('is-open'));
            return;
        }

        // Baixar PDF
        if (alvo.closest('[data-pdf]')) {
            const dados = [];
            for (let i = 0; i < linhas.length; i++) {
                const l = linhas[i];
                if (!l.hidden) {
                    dados.push([celula(l, 0), celula(l, 1), celula(l, 2), celula(l, 3), STATUS[l.dataset.status].rotulo]);
                }
            }
            baixarPdf(toast, 'Conteúdos Aprender', ['ID', 'Profissional', 'Título', 'Data', 'Status'], dados, 'conteudos');
            return;
        }

        // Modal Sim ou Não (fica por cima dos outros, então vem primeiro)
        if (alvo.closest('#ct-pergunta-nao') || alvo === modalPergunta) {
            fecharPergunta();
            return;
        }
        if (alvo.closest('#ct-pergunta-sim')) {
            const acao = acaoSePedirSim;
            fecharPergunta();
            if (acao) {
                acao();
            }
            return;
        }

        // Dentro dos modais
        if (alvo.closest('#ct-ver')) {
            abrirCompleto();
            return;
        }

        // Aprovar / Recusar: pergunta antes
        const decisao = alvo.closest('[data-decisao]');
        if (decisao) {
            const novoStatus = decisao.dataset.decisao;
            const titulo = celula(linhaAberta, 2);

            if (novoStatus === 'publicado') {
                perguntar('Deseja aprovar e publicar "' + titulo + '"?', function () {
                    decidir('publicado');
                });
            } else {
                perguntar('Deseja recusar "' + titulo + '"?', function () {
                    decidir('recusado');
                });
            }
            return;
        }

        const fechar = alvo.closest('[data-fechar]');
        if (fechar) {
            if (fechar.dataset.fechar === '2') {
                fecharCompleto();
            } else {
                fecharTudo();
            }
            return;
        }

        // Clique no fundo escuro
        if (alvo === modalCompleto) {
            fecharCompleto();
            return;
        }
        if (alvo === modal) {
            fecharTudo();
            return;
        }

        // Clicar numa linha abre a revisão
        const linha = alvo.closest('tr[data-id]');
        if (linha) {
            abrirRevisao(linha);
        }
    });

    // Busca
    document.getElementById('ct-busca').addEventListener('input', function (e) {
        busca = normalizar(e.target.value.trim());
        aplicar();
    });

    // Esc fecha primeiro o que está por cima
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') {
            return;
        }
        if (modalPergunta.classList.contains('is-open')) {
            fecharPergunta();
        } else if (modalCompleto.classList.contains('is-open')) {
            fecharCompleto();
        } else if (modal.classList.contains('is-open')) {
            fecharTudo();
        } else {
            abrirOuFecharMenu(false);
        }
    });

    aplicar();
}

/* =========================================================
   Lista de denuncias
   ========================================================= */

function paginaDenuncias() {
    const pagina = document.querySelector('.lst-page');
    const corpo = document.getElementById('dn-corpo');

    if (!pagina || !corpo) {
        return;
    }

    const linhas = Array.from(corpo.querySelectorAll('tr[data-id]'));
    const linhaVazia = document.getElementById('dn-vazio');
    const toast = document.getElementById('dn-toast');
    const painel = document.getElementById('dn-painel');
    const botaoAlternar = document.getElementById('dn-alternar');
    const modalPergunta = document.getElementById('dn-pergunta-modal');

    const campoJustificativa = document.getElementById('dn-justificativa');
    const caixaJustificativa = document.getElementById('dn-justificativa-caixa');
    const erroJustificativa = document.getElementById('dn-justificativa-erro');

    const STATUS = {
        pendente: {
            rotulo: 'Pendente',
            classe: 'lst-status--pendente'
        },
        resolvida: {
            rotulo: 'Resolvida',
            classe: 'lst-status--ok'
        }
    };

    const DESCRICAO_PADRAO =
        'Descrição enviada pela solicitante. Na versão final, o texto completo da ocorrência aparece aqui.';

    let totalPendentes = Number(
        document.getElementById('dn-pendentes').dataset.valor
    );

    let totalResolvidas = Number(
        document.getElementById('dn-resolvidas').dataset.valor
    );

    let filtro = 'todos';
    let busca = '';
    let ordemChave = 'data';
    let ordemDirecao = -1;
    let linhaAberta = null;
    let acaoSePedirSim = null;

    function assuntoDa(linha) {
        return linha.cells[2].textContent.trim();
    }

    function perguntar(pergunta, acao) {
        escreverTexto('dn-pergunta-texto', pergunta);

        campoJustificativa.value = '';
        caixaJustificativa.classList.remove('is-erro');
        erroJustificativa.style.display = 'none';

        acaoSePedirSim = acao;

        modalPergunta.classList.add('is-open');
        campoJustificativa.focus();
    }

    function fecharPergunta() {
        modalPergunta.classList.remove('is-open');

        campoJustificativa.value = '';
        caixaJustificativa.classList.remove('is-erro');
        erroJustificativa.style.display = 'none';

        acaoSePedirSim = null;
    }

    function atualizarNumeros() {
        escreverTexto(
            'dn-total',
            (totalPendentes + totalResolvidas).toLocaleString('pt-BR')
        );

        escreverTexto(
            'dn-pendentes',
            totalPendentes.toLocaleString('pt-BR')
        );

        escreverTexto(
            'dn-resolvidas',
            totalResolvidas.toLocaleString('pt-BR')
        );
    }

    function valorParaOrdenar(linha) {
        if (ordemChave === 'assunto') {
            return assuntoDa(linha);
        }

        return linha.dataset[ordemChave] || '';
    }

    function aplicar() {
        linhas.sort(function (a, b) {
            const comparacao = valorParaOrdenar(a).localeCompare(
                valorParaOrdenar(b),
                'pt-BR',
                { numeric: true }
            );

            return comparacao * ordemDirecao;
        });

        for (let i = 0; i < linhas.length; i++) {
            corpo.insertBefore(linhas[i], linhaVazia);
        }

        let visiveis = 0;

        for (let i = 0; i < linhas.length; i++) {
            const linha = linhas[i];

            const texto = normalizar(
                linha.dataset.id + ' ' +
                linha.dataset.email + ' ' +
                assuntoDa(linha)
            );

            const passaFiltro =
                filtro === 'todos' ||
                linha.dataset.status === filtro;

            linha.hidden = !(passaFiltro && texto.includes(busca));

            if (!linha.hidden) {
                visiveis++;
            }
        }

        linhaVazia.hidden = visiveis > 0;

        marcarAtivos(
            pagina.querySelectorAll('[data-filtro]'),
            'filtro',
            filtro,
            false
        );

        marcarOrdem(pagina, ordemChave, ordemDirecao);
    }

    function abrirPainel(linha) {
        linhaAberta = linha;

        const status = linha.dataset.status;

        escreverTexto('dn-id', linha.dataset.id);
        trocarStatus(
            document.getElementById('dn-status'),
            STATUS,
            status
        );

        escreverTexto('dn-assunto', assuntoDa(linha));

        escreverTexto(
            'dn-meta',
            'Aberta em ' + dataBR(linha.dataset.data) +
            ' por ' + linha.dataset.email
        );

        escreverTexto(
            'dn-descricao',
            linha.dataset.descricao || DESCRICAO_PADRAO
        );

        botaoAlternar.textContent =
            status === 'resolvida'
                ? 'Reabrir denúncia'
                : 'Marcar como resolvida';

        painel.classList.add('is-open');
    }

    function fecharPainel() {
        painel.classList.remove('is-open');
        linhaAberta = null;
    }

    function alternarStatus(justificativa) {
        if (!linhaAberta) {
            return;
        }

        // Guarda a justificativa temporariamente na linha.
        // Para persistir de verdade, é necessário salvar no backend.
        linhaAberta.dataset.justificativa = justificativa;

        const virouResolvida =
            linhaAberta.dataset.status === 'pendente';

        if (virouResolvida) {
            linhaAberta.dataset.status = 'resolvida';
            totalPendentes--;
            totalResolvidas++;
        } else {
            linhaAberta.dataset.status = 'pendente';
            totalPendentes++;
            totalResolvidas--;
        }

        trocarStatus(
            linhaAberta.querySelector('.lst-status'),
            STATUS,
            linhaAberta.dataset.status
        );

        atualizarNumeros();
        aplicar();
        fecharPainel();

        mostrarToast(
            toast,
            virouResolvida
                ? 'Denúncia marcada como resolvida.'
                : 'Denúncia reaberta.'
        );
    }

    pagina.addEventListener('click', function (e) {
        const alvo = e.target;

        if (
            alvo.closest('#dn-pergunta-nao') ||
            alvo === modalPergunta
        ) {
            fecharPergunta();
            return;
        }

        if (alvo.closest('#dn-pergunta-sim')) {
            const justificativa = campoJustificativa.value.trim();

            if (!justificativa) {
                caixaJustificativa.classList.add('is-erro');
                erroJustificativa.style.display = 'block';
                campoJustificativa.focus();
                return;
            }

            const acao = acaoSePedirSim;

            fecharPergunta();

            if (acao) {
                acao(justificativa);
            }

            return;
        }

        const botaoFiltro = alvo.closest('[data-filtro]');

        if (botaoFiltro) {
            const ehCard = botaoFiltro.classList.contains('lst-kpi');

            if (ehCard && botaoFiltro.dataset.filtro === filtro) {
                filtro = 'todos';
            } else {
                filtro = botaoFiltro.dataset.filtro;
            }

            aplicar();
            return;
        }

        const botaoOrdenar = alvo.closest('[data-ordenar]');

        if (botaoOrdenar) {
            const chave = botaoOrdenar.dataset.ordenar;

            if (ordemChave === chave) {
                ordemDirecao = -ordemDirecao;
            } else {
                ordemDirecao = 1;
            }

            ordemChave = chave;
            aplicar();
            return;
        }

        if (alvo.closest('[data-pdf]')) {
            const dados = [];

            for (let i = 0; i < linhas.length; i++) {
                const linha = linhas[i];

                if (!linha.hidden) {
                    dados.push([
                        linha.dataset.id,
                        linha.dataset.email,
                        assuntoDa(linha),
                        dataBR(linha.dataset.data),
                        STATUS[linha.dataset.status].rotulo
                    ]);
                }
            }

            baixarPdf(
                toast,
                'Lista de denúncias',
                ['ID', 'Solicitante', 'Assunto', 'Data', 'Status'],
                dados,
                'denuncias'
            );

            return;
        }

        if (alvo.closest('#dn-alternar')) {
            if (!linhaAberta) {
                return;
            }

            const resolvida =
                linhaAberta.dataset.status === 'resolvida';

            const id = linhaAberta.dataset.id;

            if (resolvida) {
                perguntar(
                    'Deseja reabrir a denúncia ' + id + '?',
                    alternarStatus
                );
            } else {
                perguntar(
                    'Deseja marcar a denúncia ' + id + ' como resolvida?',
                    alternarStatus
                );
            }

            return;
        }

        if (alvo.closest('[data-fechar]')) {
            fecharPainel();
            return;
        }

        const linha = alvo.closest('tr[data-id]');

        if (linha) {
            abrirPainel(linha);
        }
    });

    corpo.addEventListener('keydown', function (e) {
        if (e.key !== 'Enter' && e.key !== ' ') {
            return;
        }

        const linha = e.target.closest('tr[data-id]');

        if (linha && e.target === linha) {
            e.preventDefault();
            abrirPainel(linha);
        }
    });

    document.getElementById('dn-busca')
        .addEventListener('input', function (e) {
            busca = normalizar(e.target.value.trim());
            aplicar();
        });

    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') {
            return;
        }

        if (modalPergunta.classList.contains('is-open')) {
            fecharPergunta();
        } else {
            fecharPainel();
        }
    });

    atualizarNumeros();
    aplicar();
}


function iniciarChecklistEditorial() {
    const checklist = document.getElementById('ct-checklist');

    if (!checklist) return;

    const itens = checklist.querySelectorAll(
        'input[type="checkbox"][data-criterio]'
    );

    const progressoTexto = document.getElementById('ct-progresso');
    const progressoCirculo = document.getElementById('ct-anel-progresso');
    const resumo = document.getElementById('ct-checklist-resumo');
    const anel = document.getElementById('ct-anel');

    const circunferencia = 2 * Math.PI * 42;

    function atualizarChecklist() {
        const marcados = checklist.querySelectorAll(
            'input[type="checkbox"][data-criterio]:checked'
        ).length;

        const total = itens.length;
        const porcentagem = total ? Math.round((marcados / total) * 100) : 0;

        progressoTexto.textContent = porcentagem + '%';

        progressoCirculo.style.strokeDasharray =
            `${circunferencia * porcentagem / 100} ${circunferencia}`;

        resumo.textContent =
            `${marcados} de ${total} critérios verificados`;

        anel.classList.toggle(
            'is-completo',
            total > 0 && marcados === total
        );

        itens.forEach((item) => {
            item.closest('.lst-item-check').classList.toggle(
                'is-on',
                item.checked
            );
        });
    }

    itens.forEach((item) => {
        item.addEventListener('change', atualizarChecklist);
    });

    atualizarChecklist();
}

document.addEventListener('DOMContentLoaded', iniciarChecklistEditorial);


/* =========================================================
   LIGAR TUDO (roda quando a página termina de carregar)
   Cada página roda dentro de um "try/catch": se uma der erro,
   as outras continuam funcionando. O erro aparece no Console (F12).
   ========================================================= */
function rodar(nome, funcao) {
    try {
        funcao();
    } catch (erro) {
        console.error('Erro na página "' + nome + '":', erro);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    rodar('Sidebar', sidebar);
    rodar('Configurações', paginaConfiguracoes);
    rodar('Gráfico', paginaGrafico);
    rodar('Feedbacks', paginaFeedbacks);
    rodar('Conteúdos Aprender', paginaConteudos);
    rodar('Lista de denúncias', paginaDenuncias);
    rodar('Criar destaque', paginaCriarDestaque);
    rodar('Aprovar cadastros', paginaAprovarCadastros);
    rodar('Mensagens denunciadas', paginaMensagensDenunciadas);
    rodar('Lista de usuários', paginaUsuarios);
    rodar('Logout', logout);
    rodar('Suporte', paginaSuporte);
});

//para salvar no git