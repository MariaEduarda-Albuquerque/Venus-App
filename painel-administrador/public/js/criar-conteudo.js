
document.addEventListener('DOMContentLoaded', () => {

    // =====================================================
    // 1. ELEMENTOS PRINCIPAIS
    // =====================================================

    const form = document.getElementById('form-conteudo');

    if (!form) return;

    const titulo = document.getElementById('titulo');
    const categoria = document.getElementById('categoria');
    const texto = document.getElementById('texto');
    const fontes = document.getElementById('fontes');

    const formatoValor = document.getElementById('formato-valor');
    const campoAcao = document.getElementById('acao-conteudo');

    const arquivoCapa = document.getElementById('arquivo-capa');
    const capaVazio = document.getElementById('capa-vazio');
    const capaArquivo = document.getElementById('capa-arquivo');

    const modalPublicar = document.getElementById('modal-publicar');
    const modalPergunta = document.getElementById('modal-pergunta');

    const toast = document.getElementById('dst-toast');

    const botaoRascunho = document.querySelector('[data-rascunho]');
    const botaoPublicar = document.querySelector('[data-enviar]');

    const botoesFormato = document.querySelectorAll(
        '#pc-formatos [data-formato]'
    );

    // Prévia
    const previaTitulo = document.getElementById('pc-titulo');
    const previaResumo = document.getElementById('pc-resumo');
    const previaCategoria = document.getElementById('pc-categoria');

    const previaCapa = document.getElementById('pc-capa');
    const previaCapaTexto = document.getElementById('pc-capa-texto');

    // Leitura
    const previaLeitura = document.getElementById('pc-leitura');
    const previaPalavras = document.getElementById('pc-palavras');
    const previaTempo = document.getElementById('pc-tempo');

    const tempoLeituraValor = document.getElementById(
        'tempo-leitura-valor'
    );

    // Controle interno
    let urlCapa = null;
    let acaoRemoverCapa = null;
    let enviando = false;
    let temporizadorToast = null;


    // =====================================================
    // 2. UTILITÁRIOS
    // =====================================================

    function mostrarToast(mensagem) {

        const textoToast = toast.querySelector('span');

        textoToast.textContent = mensagem;

        toast.classList.add('is-show');

        clearTimeout(temporizadorToast);

        temporizadorToast = setTimeout(() => {

            toast.classList.remove('is-show');

        }, 3500);

    }


    function abrirModal(modal) {

        if (!modal) return;

        modal.classList.add('is-open');

    }


    function fecharModal(modal) {

        if (!modal) return;

        modal.classList.remove('is-open');

    }


    function atualizarIcones() {

        if (window.lucide) {
            window.lucide.createIcons();
        }

    }


    // =====================================================
    // 3. CONTADORES DE CARACTERES
    // =====================================================

    function atualizarContador(campo) {

        const contador = campo
            .closest('.dst-entrada')
            ?.querySelector('.dst-contador');

        if (!contador) return;

        const limite = campo.maxLength;
        const quantidade = campo.value.length;

        contador.textContent = `${quantidade}/${limite}`;

    }


    [titulo, texto, fontes].forEach(campo => {

        atualizarContador(campo);

        campo.addEventListener('input', () => {

            atualizarContador(campo);

        });

    });


    // =====================================================
    // 4. PRÉVIA DO CONTEÚDO
    // =====================================================

    function atualizarPrevia() {

        // Título
        const valorTitulo = titulo.value.trim();

        previaTitulo.textContent =
            valorTitulo || 'Título do conteúdo';

        previaTitulo.classList.toggle(
            'dst-vazio',
            !valorTitulo
        );


        // Resumo
        const valorTexto = texto.value.trim();

        const resumo = valorTexto
            ? valorTexto.substring(0, 180) +
                (valorTexto.length > 180 ? '...' : '')
            : 'O resumo aparece aqui conforme você escreve o texto.';

        previaResumo.textContent = resumo;

        previaResumo.classList.toggle(
            'dst-vazio',
            !valorTexto
        );


        // Categoria
        const nomeCategoria = categoria.value
            ? categoria.selectedOptions[0].textContent.trim()
            : 'Categoria';

        // Formato
        const formatoSelecionado = document.querySelector(
            '#pc-formatos .dst-filtro.is-on'
        );

        const nomeFormato = formatoSelecionado
            ? formatoSelecionado.textContent.trim()
            : 'Formato';

        previaCategoria.textContent =
            `${nomeCategoria} · ${nomeFormato}`;

    }


    titulo.addEventListener('input', atualizarPrevia);
    texto.addEventListener('input', atualizarPrevia);
    categoria.addEventListener('change', atualizarPrevia);


    // =====================================================
    // 5. SELEÇÃO DO FORMATO
    // =====================================================

    botoesFormato.forEach(botao => {

        botao.addEventListener('click', () => {

            botoesFormato.forEach(item => {

                item.classList.remove('is-on');

                item.setAttribute('aria-checked', 'false');

            });

            botao.classList.add('is-on');

            botao.setAttribute('aria-checked', 'true');

            // Guarda o ID do formato no campo oculto.
            formatoValor.value = botao.dataset.formato;

            atualizarPrevia();

        });

    });


    // =====================================================
    // 6. TEMPO DE LEITURA E CONTAGEM DE PALAVRAS
    // =====================================================

    function atualizarLeitura() {

        const conteudo = texto.value.trim();

        const palavras = conteudo
            ? conteudo.match(/[\p{L}\p{N}]+/gu) || []
            : [];

        const quantidade = palavras.length;

        const minutos = quantidade > 0
            ? Math.max(1, Math.ceil(quantidade / 200))
            : 0;


        // Quantidade de palavras
        previaPalavras.textContent =
            `${quantidade} ${quantidade === 1 ? 'palavra' : 'palavras'}`;


        // Tempo estimado
        previaLeitura.textContent = quantidade > 0
            ? `${minutos} min`
            : '—';


        previaTempo.textContent = quantidade > 0
            ? `${minutos} min de leitura`
            : 'Tempo de leitura automático';


        // Campo enviado ao Laravel
        tempoLeituraValor.value = minutos;

    }


    texto.addEventListener('input', atualizarLeitura);


    // =====================================================
    // 7. SELEÇÃO DA CAPA
    // =====================================================

    function escolherCapa() {

        arquivoCapa.click();

    }


    document.querySelectorAll('[data-escolher-capa]')
        .forEach(botao => {

            botao.addEventListener('click', escolherCapa);

        });


    function limparUrlCapa() {

        if (urlCapa) {

            URL.revokeObjectURL(urlCapa);

            urlCapa = null;

        }

    }


    function limparVisualCapa() {

        limparUrlCapa();

        arquivoCapa.value = '';

        capaVazio.hidden = false;
        capaArquivo.hidden = true;

        previaCapa.style.backgroundImage = 'none';

        previaCapa.classList.remove('tem-imagem');

        previaCapaTexto.textContent = 'Capa do conteúdo';

        const miniatura = document.getElementById('capa-miniatura');

        miniatura.style.backgroundImage = 'none';

        miniatura.innerHTML = '<i data-lucide="image"></i>';

        limparErro(arquivoCapa);

        atualizarIcones();

    }


    function exibirCapa(arquivo) {

        if (!arquivo) return;


        // Formatos permitidos
        const tiposPermitidos = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        const tamanhoMaximo = 5 * 1024 * 1024;


        // Validação do formato
        if (!tiposPermitidos.includes(arquivo.type)) {

            mostrarToast(
                'Formato inválido. Utilize JPG, PNG ou WEBP.'
            );

            limparVisualCapa();

            return;

        }


        // Validação do tamanho
        if (arquivo.size > tamanhoMaximo) {

            mostrarToast(
                'A imagem deve ter no máximo 5 MB.'
            );

            limparVisualCapa();

            return;

        }


        // Cria URL temporária
        limparUrlCapa();

        urlCapa = URL.createObjectURL(arquivo);


        // Nome do arquivo
        document.getElementById('capa-nome').textContent =
            arquivo.name;


        // Tamanho do arquivo
        const tamanhoMB = arquivo.size / (1024 * 1024);

        document.getElementById('capa-tamanho').textContent =
            `${tamanhoMB.toFixed(2)} MB`;


        // Miniatura
        const miniatura = document.getElementById('capa-miniatura');

        miniatura.style.backgroundImage = `url("${urlCapa}")`;

        miniatura.style.backgroundSize = 'cover';

        miniatura.style.backgroundPosition = 'center';

        miniatura.innerHTML = '';


        // Prévia
        previaCapa.style.backgroundImage = `url("${urlCapa}")`;

        previaCapa.style.backgroundSize = 'cover';

        previaCapa.style.backgroundPosition = 'center';

        previaCapa.classList.add('tem-imagem');

        previaCapaTexto.textContent = '';


        // Alterna os elementos
        capaVazio.hidden = true;

        capaArquivo.hidden = false;

        limparErro(arquivoCapa);

    }


    arquivoCapa.addEventListener('change', () => {

        const arquivo = arquivoCapa.files[0];

        if (arquivo) {

            exibirCapa(arquivo);

        }

    });


    // =====================================================
    // 8. REMOVER CAPA
    // =====================================================

    document.querySelectorAll('[data-remover-capa]')
        .forEach(botao => {

            botao.addEventListener('click', () => {

                document.getElementById('pergunta-texto')
                    .textContent = 'Deseja remover a capa selecionada?';

                acaoRemoverCapa = limparVisualCapa;

                abrirModal(modalPergunta);

            });

        });


    // Cancelar remoção
    document.getElementById('pergunta-nao')
        .addEventListener('click', () => {

            fecharModal(modalPergunta);

            acaoRemoverCapa = null;

        });


    // Confirmar remoção
    document.getElementById('pergunta-sim')
        .addEventListener('click', () => {

            if (acaoRemoverCapa) {

                acaoRemoverCapa();

            }

            acaoRemoverCapa = null;

            fecharModal(modalPergunta);

        });


    // =====================================================
    // 9. VALIDAÇÃO DOS CAMPOS
    // =====================================================

    function marcarErro(campo, mensagem) {

        const container = campo.closest('.dst-campo');

        if (!container) return;

        const erro = container.querySelector('.dst-erro');

        container.classList.add('is-erro');

        if (erro) {

            erro.textContent = mensagem;

        }

        campo.setAttribute('aria-invalid', 'true');

    }


    function limparErro(campo) {

        const container = campo.closest('.dst-campo');

        if (!container) return;

        container.classList.remove('is-erro');

        campo.removeAttribute('aria-invalid');

    }


    function validarFormulario(acao) {

        let valido = true;

        const campos = [
            titulo,
            categoria,
            texto,
            fontes
        ];


        // Limpa erros anteriores
        campos.forEach(campo => {

            limparErro(campo);

        });


        // Título
        if (!titulo.value.trim()) {

            marcarErro(
                titulo,
                'Informe o título do conteúdo.'
            );

            valido = false;

        }


        // Categoria
        if (!categoria.value) {

            marcarErro(
                categoria,
                'Selecione a categoria.'
            );

            valido = false;

        }


        // Formato
        if (!formatoValor.value) {

            mostrarToast(
                'Selecione o formato do conteúdo.'
            );

            valido = false;

        }


        // Texto
        if (!texto.value.trim()) {

            marcarErro(
                texto,
                'Escreva o texto do conteúdo.'
            );

            valido = false;

        }


        // Fontes
        if (!fontes.value.trim()) {

            marcarErro(
                fontes,
                'Cite ao menos uma fonte ou referência.'
            );

            valido = false;

        }


        // Capa: obrigatória somente na publicação
        if (
            acao === 'publicar' &&
            !arquivoCapa.files.length
        ) {

            marcarErro(
                arquivoCapa,
                'Envie uma capa para publicar o conteúdo.'
            );

            valido = false;

        }


        // Direciona para o primeiro campo com erro
        if (!valido) {

            const primeiroErro = form.querySelector(
                '[aria-invalid="true"]'
            );

            if (primeiroErro) {

                primeiroErro.focus();

            } else {

                mostrarToast(
                    'Confira os campos obrigatórios.'
                );

            }

        }

        return valido;

    }


    // Remove erros ao corrigir os campos
    [titulo, categoria, texto, fontes].forEach(campo => {

        campo.addEventListener('input', () => {

            limparErro(campo);

        });

        campo.addEventListener('change', () => {

            limparErro(campo);

        });

    });


    // =====================================================
    // 10. ENVIO DO FORMULÁRIO
    // =====================================================

    function enviarFormulario(acao) {

        if (enviando) return;


        // Verifica os campos
        if (!validarFormulario(acao)) return;


        // Define a ação enviada ao Laravel
        campoAcao.value = acao;


        // Publicação exige confirmação
        if (acao === 'publicar') {

            abrirModal(modalPublicar);

            return;

        }


        // Rascunho: envia diretamente
        form.requestSubmit();

    }


    // Botão salvar rascunho
    botaoRascunho.addEventListener('click', () => {

        enviarFormulario('rascunho');

    });


    // Botão publicar
    botaoPublicar.addEventListener('click', () => {

        enviarFormulario('publicar');

    });


    // =====================================================
    // 11. CONFIRMAÇÃO DE PUBLICAÇÃO
    // =====================================================

    // Cancelar publicação
    document.querySelector('[data-cancelar-publicacao]')
        .addEventListener('click', () => {

            fecharModal(modalPublicar);

        });


    // Confirmar publicação
    document.querySelector('[data-confirmar-publicacao]')
        .addEventListener('click', () => {

            if (enviando) return;

            fecharModal(modalPublicar);

            form.requestSubmit();

        });


    // =====================================================
    // 12. PROTEÇÃO CONTRA ENVIO DUPLICADO
    // =====================================================

    form.addEventListener('submit', event => {

        if (enviando) {

            event.preventDefault();

            return;

        }

        enviando = true;

        botaoRascunho.disabled = true;

        botaoPublicar.disabled = true;

        botaoRascunho.textContent = 'Salvando...';

        botaoPublicar.textContent = 'Enviando...';

    });


    // =====================================================
    // 13. FECHAR MODAIS
    // =====================================================

    [modalPublicar, modalPergunta].forEach(modal => {

        modal.addEventListener('click', event => {

            if (event.target === modal) {

                fecharModal(modal);

            }

        });

    });


    // Fechar com ESC
    document.addEventListener('keydown', event => {

        if (event.key === 'Escape') {

            fecharModal(modalPublicar);

            fecharModal(modalPergunta);

        }

    });


    // =====================================================
    // 14. INICIALIZAÇÃO
    // =====================================================

    atualizarContador(titulo);

    atualizarContador(texto);

    atualizarContador(fontes);

    atualizarPrevia();

    atualizarLeitura();

    atualizarIcones();

});
