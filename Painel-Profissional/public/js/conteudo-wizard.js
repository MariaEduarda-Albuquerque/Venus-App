/* ==========================================================
   VÊNUS — Conteúdos: assistente de criação (4 passos) + prévia ao vivo
   Arquivo: public/js/conteudo-wizard.js

   Depende do que o conteudo.blade.php define antes de carregar este arquivo:
     window.cwConfig = { urlStore, urlBase, hoje, erros, errosCampos, antigo, abrirNovo }
   e do <script type="application/json" id="cwDados"> com os conteúdos da lista.
   ========================================================== */
(function () {
    'use strict';

    var cfg = window.cwConfig || {};
    var $ = function (id) { return document.getElementById(id); };

    var wizard = $('cwWizard');
    if (!wizard) return;

    var TEMAS = ['vinho', 'rosa', 'lilas', 'pessego', 'azul', 'grafite'];
    var NOMES_TEMA = { vinho: 'Vinho', rosa: 'Rosa', lilas: 'Lilás', pessego: 'Pêssego', azul: 'Azul', grafite: 'Grafite' };
    var LIMITE_IMAGEM = 3 * 1024 * 1024;
    var MAX_TAGS = 6;
    var MAX_TEXTO = 400;

    // Em qual passo fica cada campo (para reabrir no passo certo quando o servidor recusa)
    var PASSO_DO_CAMPO = {
        tituloConteudo: 1, objetivoConteudo: 1, publicoAlvoConteudo: 1, codTipoCategoria: 1,
        tagsConteudo: 1,
        mensagemPrincipalConteudo: 2, corpoConteudo: 2, chamadaAcaoConteudo: 2, fontesConteudo: 2,
        capaConteudo: 3, fundoConteudo: 3
    };

    var ILUSTRACAO =
        '<div class="cw-vazio-box">' +
        '<svg viewBox="0 0 120 96" width="120" height="96" aria-hidden="true">' +
        '<rect x="8" y="6" width="104" height="72" rx="10" fill="none" stroke="currentColor" stroke-width="5"/>' +
        '<rect x="18" y="16" width="84" height="52" rx="4" fill="currentColor" opacity=".12"/>' +
        '<circle cx="84" cy="30" r="7" fill="currentColor" opacity=".35"/>' +
        '<path d="M26 62l20-24 14 16 10-10 24 18z" fill="currentColor" opacity=".35"/>' +
        '</svg>' +
        '<p>A prévia aparece aqui enquanto você digita.</p>' +
        '</div>';

    var ICONE_IMAGEM =
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
        '<rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="1.6"/><path d="M21 16l-5-5-8 8"/></svg>';

    var dados = {};
    try { dados = JSON.parse($('cwDados').textContent || '{}'); } catch (e) { dados = {}; }

    var el = {
        lista: $('cwLista'),
        form: $('cwForm'),
        metodo: $('cwMetodo'),
        idCampo: $('cwId'),
        acao: $('cwAcao'),
        tituloPagina: $('cwTituloPagina'),
        chip: $('cwStatusChip'),
        aviso: $('cwAviso'),
        stepper: $('cwStepper'),
        resumo: $('cwResumo'),
        poster: $('cwPoster'),
        btnVoltar: $('cwBtnVoltar'),
        btnRascunho: $('cwBtnRascunho'),
        btnContinuar: $('cwBtnContinuar'),
        btnEnviar: $('cwBtnEnviar'),
        btnPrivar: $('cwBtnPrivar'),
        tagInput: $('cwTagInput'),
        tagsLista: $('cwTagsLista'),
        tagsValor: $('cwTagsValor'),
        publicoValor: $('cwPublicoValor'),
        imagem: $('cwImagem'),
        thumb: $('cwThumb'),
        imagemNome: $('cwImagemNome'),
        removerImagem: $('cwRemoverImagem'),
        removerCapa: $('cwRemoverCapa'),
        pvTitulo: $('pvTitulo'),
        pvObjetivo: $('pvObjetivo'),
        pvPublico: $('pvPublico'),
        pvCategoria: $('pvCategoria'),
        pvPeriodo: $('pvPeriodo')
    };

    var passoAtual = 1;
    var modo = 'novo';          // 'novo' | 'edicao' | 'leitura'
    var statusAtual = null;
    var tags = [];
    var capaAtual = null;       // URL da imagem já salva (edição)
    var objUrl = null;          // URL temporária da imagem escolhida agora
    var nomeArquivo = '';
    var sujo = false;

    /* ---------- utilitários ---------- */
    function criar(tag, classe, texto) {
        var e = document.createElement(tag);
        if (classe) e.className = classe;
        if (texto !== undefined && texto !== null) e.textContent = texto;
        return e;
    }

    function valor(id) { var e = $(id); return e ? e.value : ''; }

    function splitLista(s) {
        return String(s || '').split(',').map(function (x) { return x.trim(); }).filter(Boolean);
    }

    function limparTag(t) {
        return String(t || '').replace(/^#+/, '').replace(/[^\p{L}\p{N}_]/gu, '').slice(0, 24);
    }

    function mesclar(base, sobre) {
        Object.keys(sobre || {}).forEach(function (k) {
            if (sobre[k] !== undefined && sobre[k] !== null) base[k] = sobre[k];
        });
        return base;
    }

    /* ---------- leitura do formulário ---------- */
    // Público-alvo: uma opção da lista ou, em "Outro", o texto digitado
    var OUTRO = '__outro';

    function publicoEscolhido() {
        var sel = $('cwPublico').value;
        if (sel === OUTRO) return valor('cwPublicoOutro').trim();
        return sel;
    }

    function fundoEscolhido() {
        var r = el.form.querySelector('input[name="fundoConteudo"]:checked');
        return r ? r.value : 'vinho';
    }

    function lerDados() {
        var cat = $('cwCategoria');
        var catNome = cat && cat.selectedIndex > 0 ? cat.options[cat.selectedIndex].text : '';
        return {
            titulo: valor('cwTitulo').trim(),
            objetivo: valor('cwObjetivo').trim(),
            publico: publicoEscolhido(),
            publicoSelecao: valor('cwPublico'),
            categoria: valor('cwCategoria'),
            categoriaNome: catNome,
            tags: tags.slice(),
            mensagem: valor('cwMensagem').trim(),
            texto: valor('cwTexto').trim(),
            cta: valor('cwCta').trim(),
            fontes: valor('cwFontes').trim(),
            fundo: fundoEscolhido(),
            capa: objUrl || capaAtual
        };
    }

    /* ---------- a "arte" da publicação (prévia e miniaturas) ---------- */
    function montarPoster(alvo, d) {
        var mini = alvo.hasAttribute('data-mini');
        var etiquetas = d.tags || [];
        var titulo = d.titulo;
        var mensagem = d.mensagem;
        var texto = d.texto;
        var temConteudo = !!(titulo || mensagem || texto || d.capa || d.cta || etiquetas.length);

        alvo.innerHTML = '';
        alvo.style.backgroundImage = '';

        if (!temConteudo) {
            alvo.className = 'cw-post cw-post--vazio' + (mini ? ' cw-post--mini' : '');
            alvo.innerHTML = ILUSTRACAO;
            return;
        }

        var classes = 'cw-post cw-tema-' + (TEMAS.indexOf(d.fundo) >= 0 ? d.fundo : 'vinho');
        if (mini) classes += ' cw-post--mini';
        if (d.capa) {
            classes += ' cw-post--foto';
            alvo.style.backgroundImage = 'url("' + String(d.capa).replace(/"/g, '%22') + '")';
        }
        alvo.className = classes;

        var dentro = criar('div', 'cw-post-in');

        var topo = criar('div', 'cw-post-topo');
        if (d.categoriaNome) topo.appendChild(criar('span', 'cw-post-cat', d.categoriaNome));

        // Título e mensagem principal aparecem juntos: um não substitui o outro
        var meio = criar('div', 'cw-post-meio');
        meio.appendChild(criar('h4', 'cw-post-titulo' + (titulo ? '' : ' is-vazio'), titulo || 'Título da publicação'));
        if (mensagem) {
            meio.appendChild(criar('p', 'cw-post-msg', mensagem));
        } else if (!mini) {
            meio.appendChild(criar('p', 'cw-post-msg is-vazio', 'Sua mensagem principal aparece aqui.'));
        }
        if (texto) {
            meio.appendChild(criar('p', 'cw-post-texto', texto));
        } else if (!mini) {
            meio.appendChild(criar('p', 'cw-post-texto is-vazio', 'Seu texto de apresentação aparece aqui.'));
        }
        if (d.cta) meio.appendChild(criar('span', 'cw-post-cta', d.cta));

        var base = criar('div', 'cw-post-base');
        if (etiquetas.length) {
            base.appendChild(criar('span', 'cw-post-tags', etiquetas.map(function (t) { return '#' + t; }).join(' ')));
        }
        base.appendChild(criar('span', 'cw-post-marca', 'Vênus \u2022 A Saúde da Mulher'));

        dentro.appendChild(topo);
        dentro.appendChild(meio);
        dentro.appendChild(base);
        alvo.appendChild(dentro);
    }

    function paraPoster(s) {
        return {
            titulo: s.titulo, mensagem: s.mensagem, texto: s.texto, cta: s.cta,
            tags: splitLista(s.tags).map(limparTag).filter(Boolean),
            fundo: s.fundo || 'vinho', capa: s.capa, categoriaNome: s.categoriaNome
        };
    }

    /* ---------- prévia ao vivo ---------- */
    function setTexto(no, v, placeholder) {
        no.textContent = v || placeholder;
        no.classList.toggle('is-vazio', !v);
    }

    function atualizarContadores() {
        document.querySelectorAll('[data-contador-de]').forEach(function (c) {
            var campo = $(c.getAttribute('data-contador-de'));
            if (!campo) return;
            var max = campo.getAttribute('maxlength');
            c.textContent = campo.value.length + '/' + max;
            c.classList.toggle('is-estourou', campo.value.length > Number(max));
        });
    }

    function atualizarPrevia() {
        var d = lerDados();
        montarPoster(el.poster, d);

        setTexto(el.pvTitulo, d.titulo, 'Título da publicação');
        setTexto(el.pvObjetivo, d.objetivo, 'O objetivo aparece aqui.');
        setTexto(el.pvCategoria, d.categoriaNome, '—');

        el.pvPublico.innerHTML = '';
        if (d.publico) {
            el.pvPublico.appendChild(criar('span', 'cw-mini-chip', d.publico));
        } else {
            el.pvPublico.appendChild(criar('span', 'cw-previa-vazio', 'Público-alvo ainda não escolhido.'));
        }

        atualizarContadores();
    }

    /* ---------- público-alvo, tags, imagem, fundo ---------- */
    function sincronizarPublico() {
        var outro = $('cwPublico').value === OUTRO;
        $('cwPublicoOutroWrap').hidden = !outro;
        el.publicoValor.value = publicoEscolhido();
    }

    function definirPublico(texto) {
        var t = String(texto || '').trim();
        var sel = $('cwPublico');
        var existe = t && Array.prototype.some.call(sel.options, function (o) { return o.value === t && o.value !== OUTRO; });

        if (!t) { sel.value = ''; $('cwPublicoOutro').value = ''; }
        else if (existe) { sel.value = t; $('cwPublicoOutro').value = ''; }
        else { sel.value = OUTRO; $('cwPublicoOutro').value = t; }  // valor fora da lista = "Outro"
        sincronizarPublico();
    }

    function renderTags() {
        el.tagsLista.innerHTML = '';
        tags.forEach(function (t, i) {
            var chip = criar('span', 'cw-tag', '#' + t);
            var x = criar('button', null, '\u00d7');
            x.type = 'button';
            x.setAttribute('aria-label', 'Remover a tag ' + t);
            x.addEventListener('click', function () {
                if (modo === 'leitura') return;
                tags.splice(i, 1);
                renderTags();
                sujo = true;
                atualizarPrevia();
            });
            chip.appendChild(x);
            el.tagsLista.appendChild(chip);
        });
        el.tagsValor.value = tags.join(',');
        el.tagInput.disabled = tags.length >= MAX_TAGS || modo === 'leitura';
        el.tagInput.placeholder = tags.length >= MAX_TAGS ? 'Limite de ' + MAX_TAGS + ' tags' : '#digite e aperte Enter';
    }

    function adicionarTag(bruto) {
        var t = limparTag(bruto);
        el.tagInput.value = '';
        if (!t || tags.length >= MAX_TAGS) return;
        var jaTem = tags.some(function (x) { return x.toLowerCase() === t.toLowerCase(); });
        if (jaTem) return;
        tags.push(t);
        renderTags();
        sujo = true;
        atualizarPrevia();
    }

    function atualizarImagemUI() {
        var url = objUrl || capaAtual;
        el.thumb.innerHTML = '';
        if (url) {
            var img = criar('img');
            img.src = url;
            img.alt = '';
            el.thumb.appendChild(img);
        } else {
            el.thumb.innerHTML = ICONE_IMAGEM;
        }
        el.imagemNome.textContent = objUrl ? nomeArquivo : (capaAtual ? 'Imagem atual' : 'Nenhuma imagem selecionada');
        el.removerImagem.hidden = !url;
    }

    function soltarObjUrl() {
        if (objUrl) { URL.revokeObjectURL(objUrl); objUrl = null; }
        nomeArquivo = '';
    }

    function definirFundo(chave) {
        var alvo = el.form.querySelector('input[name="fundoConteudo"][value="' + (TEMAS.indexOf(chave) >= 0 ? chave : 'vinho') + '"]');
        if (alvo) alvo.checked = true;
    }

    /* ---------- erros e validação ---------- */
    function mostrarErro(idCampo, msg) {
        var alvo = document.querySelector('[data-erro-de="' + idCampo + '"]');
        if (alvo) { alvo.textContent = msg; alvo.hidden = false; }
        var campo = $(idCampo);
        var wrap = campo && campo.closest ? campo.closest('.cw-campo') : null;
        if (wrap) wrap.classList.add('is-erro');
    }

    function limparErros() {
        document.querySelectorAll('.cw-erro').forEach(function (p) { p.hidden = true; p.textContent = ''; });
        document.querySelectorAll('.cw-campo.is-erro').forEach(function (w) { w.classList.remove('is-erro'); });
    }

    function rolarAoErro() {
        var primeiro = document.querySelector('.cw-campo.is-erro');
        if (primeiro && primeiro.scrollIntoView) primeiro.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function validarPasso(n) {
        limparErros();
        var d = lerDados();
        var ok = true;
        function falha(id, msg) { mostrarErro(id, msg); ok = false; }

        if (n === 1) {
            if (!d.titulo) falha('cwTitulo', 'Informe o título da publicação.');
            if (!d.objetivo) falha('cwObjetivo', 'Descreva o objetivo da publicação.');
            if (!d.publicoSelecao) falha('cwPublico', 'Selecione o público-alvo.');
            else if (!d.publico) falha('cwPublico', 'Descreva o público-alvo em "Outro".');
            if (!d.categoria) falha('cwCategoria', 'Selecione uma categoria.');
        }
        if (n === 2) {
            if (!d.mensagem) falha('cwMensagem', 'Escreva a mensagem principal.');
            if (!d.texto) falha('cwTexto', 'Escreva o texto de apresentação.');
            else if (d.texto.length > MAX_TEXTO) falha('cwTexto', 'Reduza o texto para até ' + MAX_TEXTO + ' caracteres.');
        }
        if (!ok) rolarAoErro();
        return ok;
    }

    /* ---------- navegação entre passos ---------- */
    function atualizarRodape() {
        var ultimo = passoAtual === 4;
        var editavel = modo !== 'leitura';
        el.btnVoltar.textContent = passoAtual === 1 ? (editavel ? 'Cancelar' : 'Fechar') : '\u2190 Voltar';
        el.btnRascunho.hidden = !editavel;
        el.btnContinuar.hidden = ultimo;
        el.btnEnviar.hidden = !(ultimo && editavel);
        el.btnPrivar.hidden = !(ultimo && modo === 'leitura' && statusAtual === 'publicado');
    }

    function irPara(n) {
        passoAtual = n;
        document.querySelectorAll('.cw-passo').forEach(function (p) {
            p.hidden = Number(p.getAttribute('data-passo')) !== n;
        });
        el.stepper.querySelectorAll('.cw-step').forEach(function (b) {
            var i = Number(b.getAttribute('data-passo'));
            b.classList.toggle('is-ativo', i === n);
            b.classList.toggle('is-feito', i < n);
            b.querySelector('.cw-step-num').textContent = i < n ? '\u2713' : String(i);
            if (i === n) b.setAttribute('aria-current', 'step'); else b.removeAttribute('aria-current');
        });
        el.stepper.querySelectorAll('.cw-step-linha').forEach(function (l, idx) {
            l.classList.toggle('is-feito', idx + 1 < n);
        });
        if (n === 4) montarResumo();
        atualizarRodape();
        atualizarPrevia();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function tentarIrPara(destino) {
        if (destino <= passoAtual || modo === 'leitura') { irPara(destino); return; }
        for (var k = passoAtual; k < destino; k++) {
            if (!validarPasso(k)) { irPara(k); validarPasso(k); return; }
        }
        irPara(destino);
    }

    /* ---------- revisão (passo 4) ---------- */
    function secao(titulo, passo, linhas) {
        var s = criar('section', 'cw-res-sec');
        var cab = criar('div', 'cw-res-cab');
        cab.appendChild(criar('h3', null, titulo));
        var b = criar('button', 'btn-outline-sm cw-res-editar', 'Editar');
        b.type = 'button';
        b.setAttribute('data-ir', passo);
        cab.appendChild(b);
        s.appendChild(cab);

        var dl = criar('dl', 'cw-res-lista');
        linhas.forEach(function (l) {
            var row = criar('div', 'cw-res-linha');
            row.appendChild(criar('dt', null, l[0]));
            row.appendChild(criar('dd', l[1] ? null : 'is-vazio', l[1] || '\u2014'));
            dl.appendChild(row);
        });
        s.appendChild(dl);
        return s;
    }

    function montarResumo() {
        var d = lerDados();
        el.resumo.innerHTML = '';
        el.resumo.appendChild(secao('Informações básicas', 1, [
            ['Título', d.titulo],
            ['Objetivo', d.objetivo],
            ['Público-alvo', d.publico],
            ['Categoria', d.categoriaNome],
            ['Tags', d.tags.map(function (t) { return '#' + t; }).join(' ')]
        ]));
        el.resumo.appendChild(secao('Conteúdo da publicação', 2, [
            ['Mensagem principal', d.mensagem],
            ['Texto de apresentação', d.texto],
            ['Chamada para ação', d.cta],
            ['Fontes de referência', d.fontes]
        ]));
        el.resumo.appendChild(secao('Materiais e divulgação', 3, [
            ['Imagem', objUrl ? nomeArquivo : (capaAtual ? 'Imagem atual' : 'Sem imagem (fundo colorido)')],
            ['Cor de fundo', NOMES_TEMA[d.fundo]]
        ]));
    }

    /* ---------- abrir / fechar o assistente ---------- */
    function paraInterno(s) {
        return {
            titulo: s.titulo, objetivo: s.objetivo, publico: s.publico, categoria: s.categoria,
            tags: s.tags, mensagem: s.mensagem, texto: s.texto,
            cta: s.cta, fontes: s.fontes, fundo: s.fundo
        };
    }

    function doAntigo(a) {
        return {
            titulo: a.tituloConteudo, objetivo: a.objetivoConteudo, publico: a.publicoAlvoConteudo,
            categoria: a.codTipoCategoria,
            tags: a.tagsConteudo, mensagem: a.mensagemPrincipalConteudo, texto: a.corpoConteudo,
            cta: a.chamadaAcaoConteudo, fontes: a.fontesConteudo, fundo: a.fundoConteudo,
            dataPlanejada: a.dataPlanejadaConteudo
        };
    }

    function preencher(v) {
        $('cwTitulo').value = v.titulo || '';
        $('cwObjetivo').value = v.objetivo || '';
        definirPublico(v.publico || '');
        $('cwCategoria').value = v.categoria ? String(v.categoria) : '';
        tags = splitLista(v.tags).map(limparTag).filter(Boolean).slice(0, MAX_TAGS);
        $('cwMensagem').value = v.mensagem || '';
        $('cwTexto').value = v.texto || '';
        $('cwCta').value = v.cta || '';
        $('cwFontes').value = v.fontes || '';
        definirFundo(v.fundo || 'vinho');
    }

    function mostrarAviso(s) {
        var textos = {
            rascunho: ['info', 'Rascunho: continue editando ou envie para a revisão editorial.'],
            publicado: ['info', 'Publicado: ao privar, o conteúdo deixa de ser público e volta a ser rascunho.'],
            em_revisao: ['info', 'Em revisão: a equipe editorial está analisando, por isso a edição está bloqueada.']
        };
        el.aviso.className = 'cw-aviso';
        el.aviso.innerHTML = '';

        if (!s) { el.aviso.hidden = true; return; }

        if (s.status === 'recusado') {
            el.aviso.classList.add('cw-aviso--erro');
            el.aviso.appendChild(criar('strong', null, 'Motivo da recusa'));
            el.aviso.appendChild(criar('p', null, s.motivo || 'A moderação não informou o motivo.'));
            el.aviso.appendChild(criar('small', null, 'Ajuste a publicação e envie novamente para a revisão.'));
        } else if (textos[s.status]) {
            el.aviso.classList.add('cw-aviso--' + textos[s.status][0]);
            el.aviso.appendChild(criar('p', null, textos[s.status][1]));
        }
        el.aviso.hidden = !el.aviso.firstChild;
    }

    function iniciar(origem, sobrepor) {
        var s = origem || null;
        statusAtual = s ? s.status : null;
        modo = !s ? 'novo' : ((s.status === 'rascunho' || s.status === 'recusado') ? 'edicao' : 'leitura');

        soltarObjUrl();
        el.form.reset();
        limparErros();
        sujo = false;

        var base = s ? paraInterno(s) : { fundo: 'vinho' };
        preencher(mesclar(base, sobrepor));
        $('cwDataPlanejada').value = (sobrepor && sobrepor.dataPlanejada) || '';

        capaAtual = (s && s.capa) || null;
        el.removerCapa.value = '0';
        el.imagem.value = '';
        atualizarImagemUI();

        el.form.action = s ? (cfg.urlBase + '/' + s.id) : cfg.urlStore;
        el.metodo.disabled = !s;
        el.idCampo.value = s ? s.id : '';

        el.tituloPagina.textContent = !s ? 'Novo conteúdo' : (modo === 'leitura' ? 'Detalhes do conteúdo' : 'Editar conteúdo');
        el.chip.hidden = !s;
        if (s) {
            el.chip.textContent = s.statusRotulo;
            el.chip.className = 'ct-status ct-status--' + s.status;
        }
        mostrarAviso(s);

        var leitura = modo === 'leitura';
        wizard.classList.toggle('is-leitura', leitura);
        el.form.querySelectorAll('input[type="text"], input[type="date"], textarea').forEach(function (c) { c.readOnly = leitura; });
        $('cwPublico').disabled = leitura;
        renderTags();

        el.lista.hidden = true;
        wizard.hidden = false;
        irPara(1);
    }

    function fecharAssistente() {
        if (sujo && modo !== 'leitura' && !window.confirm('Descartar as alterações desta publicação?')) return;
        soltarObjUrl();
        wizard.hidden = true;
        el.lista.hidden = false;
        sujo = false;

        if (window.history && history.replaceState) {
            var p = new URLSearchParams(location.search);
            p.delete('criar');
            var qs = p.toString();
            history.replaceState(null, '', location.pathname + (qs ? '?' + qs : ''));
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    /* ---------- eventos ---------- */
    el.btnVoltar.addEventListener('click', function () {
        if (passoAtual === 1) fecharAssistente(); else irPara(passoAtual - 1);
    });

    el.btnContinuar.addEventListener('click', function () {
        if (modo !== 'leitura' && !validarPasso(passoAtual)) return;
        irPara(passoAtual + 1);
    });

    el.stepper.addEventListener('click', function (e) {
        var b = e.target.closest('.cw-step');
        if (b) tentarIrPara(Number(b.getAttribute('data-passo')));
    });

    el.resumo.addEventListener('click', function (e) {
        var b = e.target.closest('[data-ir]');
        if (b) irPara(Number(b.getAttribute('data-ir')));
    });

    // O botão clicado define a ação enviada ao servidor (rascunho, revisao ou privar)
    [el.btnRascunho, el.btnEnviar, el.btnPrivar].forEach(function (b) {
        b.addEventListener('click', function () { el.acao.value = b.getAttribute('data-acao'); });
    });

    el.form.addEventListener('submit', function (e) {
        sincronizarPublico();
        var acao = el.acao.value;
        if (acao === 'privar') return;

        limparErros();
        if (acao === 'rascunho') {
            if (!valor('cwTitulo').trim()) {
                e.preventDefault();
                irPara(1);
                mostrarErro('cwTitulo', 'Dê um título para salvar o rascunho.');
                rolarAoErro();
            }
            return;
        }

        for (var n = 1; n <= 2; n++) {
            if (!validarPasso(n)) { e.preventDefault(); irPara(n); validarPasso(n); return; }
        }
    });

    // Enter dentro de um campo não deve enviar o formulário sem querer
    el.form.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && e.target.tagName === 'INPUT' && e.target.type !== 'submit' && e.target.type !== 'button') {
            e.preventDefault();
        }
    });

    el.form.addEventListener('input', function (e) {
        sujo = true;
        if (e.target.id === 'cwPublicoOutro') sincronizarPublico();
        var wrap = e.target.closest ? e.target.closest('.cw-campo') : null;
        if (wrap) {
            wrap.classList.remove('is-erro');
            var msg = wrap.querySelector('.cw-erro');
            if (msg) { msg.hidden = true; msg.textContent = ''; }
        }
        atualizarPrevia();
    });

    el.form.addEventListener('change', function (e) {
        sujo = true;
        if (e.target.closest && e.target.closest('#cwPublico')) sincronizarPublico();
        atualizarPrevia();
    });

    el.tagInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            adicionarTag(el.tagInput.value);
        } else if (e.key === 'Backspace' && !el.tagInput.value && tags.length) {
            tags.pop();
            renderTags();
            atualizarPrevia();
        }
    });
    el.tagInput.addEventListener('blur', function () { if (el.tagInput.value) adicionarTag(el.tagInput.value); });

    el.imagem.addEventListener('change', function () {
        var f = this.files && this.files[0];
        if (!f) return;
        limparErros();

        if (!/^image\/(jpeg|png|webp)$/.test(f.type)) {
            this.value = '';
            mostrarErro('cwImagem', 'Use uma imagem JPG, PNG ou WEBP.');
            return;
        }
        if (f.size > LIMITE_IMAGEM) {
            this.value = '';
            mostrarErro('cwImagem', 'A imagem passa de 3 MB. Escolha uma menor.');
            return;
        }
        if (objUrl) URL.revokeObjectURL(objUrl);
        objUrl = URL.createObjectURL(f);
        nomeArquivo = f.name;
        el.removerCapa.value = '0';
        atualizarImagemUI();
        atualizarPrevia();
    });

    el.removerImagem.addEventListener('click', function () {
        soltarObjUrl();
        capaAtual = null;
        el.imagem.value = '';
        el.removerCapa.value = '1';
        sujo = true;
        atualizarImagemUI();
        atualizarPrevia();
    });

    document.querySelectorAll('.js-cw-novo').forEach(function (b) {
        b.addEventListener('click', function () { iniciar(null); });
    });

    /* ---------- lista: miniaturas e abertura dos cards ---------- */
    document.querySelectorAll('[data-poster]').forEach(function (alvo) {
        var s = dados[alvo.getAttribute('data-poster')];
        if (s) montarPoster(alvo, paraPoster(s));
    });

    document.querySelectorAll('.cw-card[data-id]').forEach(function (card) {
        function abrirCard() {
            var s = dados[card.getAttribute('data-id')];
            if (s) iniciar(s);
        }
        card.addEventListener('click', abrirCard);
        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); abrirCard(); }
        });
    });

    /* ---------- aviso de sucesso some sozinho ---------- */
    var toast = $('toastSucesso');
    if (toast) {
        var sair = function () {
            toast.classList.add('saindo');
            setTimeout(function () { toast.remove(); }, 300);
        };
        toast.querySelector('.toast-fechar').addEventListener('click', sair);
        setTimeout(sair, 4500);
    }

    /* ---------- estado inicial ---------- */
    if (cfg.erros) {
        // O servidor recusou o envio: reabre o mesmo conteúdo com o que a pessoa digitou
        var antigo = cfg.antigo || {};
        var origem = antigo.codConteudo ? dados[antigo.codConteudo] : null;
        iniciar(origem, doAntigo(antigo));

        var menor = 4;
        (cfg.errosCampos || []).forEach(function (campo) {
            if (PASSO_DO_CAMPO[campo] && PASSO_DO_CAMPO[campo] < menor) menor = PASSO_DO_CAMPO[campo];
        });
        irPara(menor === 4 ? 1 : menor);
        sujo = true;
    } else if (cfg.abrirNovo) {
        iniciar(null, cfg.prefill || null);
        if (cfg.prefill) { atualizarPrevia(); }
    } else {
        atualizarPrevia();
    }
})();