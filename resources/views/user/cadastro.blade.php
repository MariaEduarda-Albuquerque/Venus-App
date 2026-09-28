<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="cadastro-page">

    <section class="login-page">

        <div class="login-left">

            <div class="decor-circle decor-circle--top"></div>
            <div class="decor-circle decor-circle--bottom"></div>

            <div class="brand">
                <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus - A saúde da Mulher na palma da sua mão" class="logo">
            </div>

            <div class="info-card" style="background-image: url('{{ asset('images/RetanguloLogin.png') }}');">
                <span class="info-badge">CRM &middot; CRP &middot; COREN &middot; CRESS</span>
                <h2>Conectando profissionais à saúde da mulher</h2>
                <p>Atendimento com sigilo, acolhimento e responsabilidade.</p>
            </div>

        </div>

        <div class="login-right">

            <div class="login-box cadastro-box">

                <span class="eyebrow">Solicitar acesso</span>
                <h1>Cadastro Profissional</h1>
                <p class="subtitle">
                    Preencha seus dados. A conta será liberada após a validação do registro profissional.
                </p>

                <div class="stepper">
                    <div class="step" data-step-indicator="1">
                        <span class="step-circle">1</span>
                        <span class="step-label">Pessoais</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step" data-step-indicator="2">
                        <span class="step-circle">2</span>
                        <span class="step-label">Profissionais</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step" data-step-indicator="3">
                        <span class="step-circle">3</span>
                        <span class="step-label">Documentos</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step" data-step-indicator="4">
                        <span class="step-circle">4</span>
                        <span class="step-label">Revisão</span>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="user.cadastro" method="post" enctype="multipart/form-data" id="formCadastro" novalidate>
                    @csrf

                    {{-- ===================== PASSO 1 - DADOS PESSOAIS ===================== --}}
                    <div class="form-step active" data-step="1">

                        <span class="step-count">1 DE 4</span>
                        <h2 class="step-title">Dados Pessoais</h2>
                        <p class="step-subtitle">Informações básicas para criar sua conta.</p>

                        <div class="field">
                            <label for="nome">Nome completo</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome completo" required>
                        </div>

                        <div class="field-row-2">
                            <div class="field">
                                <label for="email">E-mail profissional</label>
                                <input type="email" name="email" id="email" placeholder="seu@email.com" required>
                            </div>
                            <div class="field">
                                <label for="telefone">Celular (com DDD)</label>
                                <input type="text" name="telefone" id="telefone" placeholder="(11) 99999-9999">
                            </div>
                        </div>

                        <div class="field">
                            <label for="cpf">CPF ou CNPJ</label>
                            <input type="text" name="nrFiscal" id="cpf" placeholder="000.000.000-00 ou 00.000.000/0000-00" required>
                        </div>

                        <div class="field-row-2 field-row-senha">
                            <div class="field">
                                <label for="senha">Senha</label>
                                <div class="input-password">
                                    <input type="password" name="senha" id="senha" placeholder="Digite uma senha forte" required>
                                    <button type="button" class="toggle-password" data-target="senha" aria-label="Mostrar senha">&#128065;</button>
                                </div>
                            </div>
                            <div class="field">
                                <label for="senha_confirmation">Confirmar senha</label>
                                <div class="input-password">
                                    <input type="password" name="senha_confirmation" id="senha_confirmation" placeholder="Repita sua senha" required>
                                    <button type="button" class="toggle-password" data-target="senha_confirmation" aria-label="Mostrar senha">&#128065;</button>
                                </div>
                            </div>
                        </div>
                        <p class="field-hint">Use letras, números e símbolos.</p>

                        <div class="field">
                            <label for="apresentacao">Apresentação</label>
                            <textarea name="apresentacao" id="apresentacao" rows="3" placeholder="Conte brevemente sua experiência e abordagem de atendimento."></textarea>
                        </div>

                        <div class="field">
                            <label class="upload-box" for="fotoPerfil">
                                <span class="upload-icon">&#8593;</span>
                                <span class="upload-text">
                                    <strong>Foto de perfil</strong>
                                    <span class="upload-desc">JPG ou PNG</span>
                                </span>
                                <span class="upload-filename" data-filename-for="fotoPerfil">Nenhum arquivo selecionado</span>
                            </label>
                            <input type="file" name="fotoPerfil" id="fotoPerfil" accept="image/*" class="upload-input">
                        </div>

                        <label class="checkbox terms-checkbox">
                            <input type="checkbox" id="aceiteTermos" required>
                            <span>Li e aceito os Termos de Uso e a Política de Privacidade.</span>
                        </label>

                        <div class="wizard-actions">
                            <button type="button" class="btn-primary btn-next" data-next="2">Continuar</button>
                        </div>

                    </div>

                    {{-- ===================== PASSO 2 - DADOS PROFISSIONAIS ===================== --}}
                    <div class="form-step" data-step="2">

                        <span class="step-count">2 DE 4</span>
                        <h2 class="step-title">Dados Profissionais</h2>
                        <p class="step-subtitle">Defina sua área de atuação e como poderá atender dentro da Vênus.</p>

                        <div class="field-row-2">
                            <div class="field">
                                <label for="categoria">Categoria profissional</label>
                                <select name="categoria" id="categoria" required>
                                    <option value="">Selecione</option>
                                    <option value="Médica">Médica</option>
                                    <option value="Enfermeira">Enfermeira</option>
                                    <option value="Psicologo">Psicóloga</option>
                                    <option value="Outro">Outro</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="especialidade">Especialidade</label>
                                <input type="text" name="especialidade" id="especialidade" placeholder="Ex: Ginecologista">
                            </div>
                        </div>
                        
                        <div class="field">
                            <label for="cep">CEP</label>
                            <input type="text" name="cep" id="cep" placeholder="Ex: 01001-000">
                        </div>

                        <div class="field-row-2">
                            <div class="field">
                                <label for="pais">País</label>
                                <input type="text" name="pais" id="pais" placeholder="Ex: Brasil">
                            </div>
                            <div class="field">
                                <label for="cidade">Cidade</label>
                                <input type="text" name="cidade" id="cidade" placeholder="Ex: São Paulo">
                            </div>
                        </div>

                        <div class="field">
                            <label for="uf">UF</label>
                            <select name="uf" id="uf">
                                <option value="">Selecione a UF</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>

                        <div class="wizard-actions">
                            <button type="button" class="btn-outline btn-prev" data-prev="1">Voltar</button>
                            <button type="button" class="btn-primary btn-next" data-next="3">Continuar</button>
                        </div>

                    </div>

                    {{-- ===================== PASSO 3 - DOCUMENTOS ===================== --}}
                    <div class="form-step" data-step="3">

                        <!-- <span class="step-count">3 DE 4</span>
                        <h2 class="step-title">Documento para verificação</h2>
                        <p class="step-subtitle">Envie os documentos solicitados para validar seu cadastro profissional.</p>

                        <label class="upload-box upload-box--big" for="comprovanteConselho">
                            <span class="upload-icon">&#8593;</span>
                            <span class="upload-text">
                                <strong>Comprovante do conselho de classe</strong>
                                <span class="upload-desc">CRM/CRP/COREN/CRESS &middot; PDF, JPG ou PNG &middot; até 10 MB</span>
                            </span>
                            <span class="upload-filename" data-filename-for="comprovanteConselho">Nenhum arquivo selecionado</span>
                        </label>
                        <input type="file" name="comprovanteConselho" id="comprovanteConselho" class="upload-input" required>

                        <label class="upload-box upload-box--big" for="docComplementar">
                            <span class="upload-icon">&#8593;</span>
                            <span class="upload-text">
                                <strong>Documento complementar</strong>
                                <span class="upload-desc">Se solicitado para conferência cadastral &middot; PDF, JPG ou PNG &middot; até 10 MB</span>
                            </span>
                            <span class="upload-filename" data-filename-for="docComplementar">Nenhum arquivo selecionado</span>
                        </label>
                        <input type="file" name="docComplementar" id="docComplementar" class="upload-input">

                        <div class="info-note">
                            Os documentos serão usados exclusivamente para análise e verificação do cadastro profissional.
                        </div> -->

                        <div class="wizard-actions">
                            <button type="button" class="btn-outline btn-prev" data-prev="2">Voltar</button>
                            <button type="button" class="btn-primary btn-next" data-next="4">Continuar</button>
                        </div>

                    </div>

                    {{-- ===================== PASSO 4 - REVISÃO ===================== --}}
                    <div class="form-step" data-step="4">

                        <span class="step-count">4 DE 4</span>
                        <h2 class="step-title">Revise seus dados</h2>
                        <p class="step-subtitle">Confira se as informações estão corretas antes de enviar.</p>

                        <div class="review-list">
                            <div class="review-item">
                                <span class="review-label">Nome</span>
                                <span class="review-value" data-review="nome">—</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">E-mail</span>
                                <span class="review-value" data-review="email">—</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">Celular</span>
                                <span class="review-value" data-review="telefone">—</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">Categoria</span>
                                <span class="review-value" data-review="categoria">—</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">Especialidade</span>
                                <span class="review-value" data-review="especialidade">—</span>
                            </div>
                            <!-- <div class="review-item">
                                <span class="review-label">Conselho</span>
                                <span class="review-value" data-review="conselho">—</span>
                            </div>
                            <div class="review-item">
                                <span class="review-label">Atendimentos</span>
                                <span class="review-value" data-review="atendimentos">—</span>
                            </div> -->
                        </div>

                        <div class="info-note">
                            Os documentos serão usados exclusivamente para análise e verificação do cadastro profissional.
                        </div>

                        <div class="wizard-actions">
                            <button type="button" class="btn-outline btn-prev" data-prev="3">Voltar</button>
                            <button type="submit" class="btn-primary">Continuar</button>
                        </div>

                    </div>

                </form>

                <p class="signup">
                    Já possuo uma conta?
                    <a href="/">Voltar para o login</a>
                </p>

            </div>

        </div>

    </section>

    <script>
        document.getElementById('cep').addEventListener('blur', function () {

        let cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {

                if (data.erro) {
                    alert('CEP não encontrado.');
                    return;
                }

                document.getElementById('pais').value = 'Brasil';
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('uf').value = data.uf;

            });
        });

        (function () {
            var form = document.getElementById('formCadastro');
            var steps = Array.prototype.slice.call(form.querySelectorAll('.form-step'));
            var indicators = Array.prototype.slice.call(document.querySelectorAll('[data-step-indicator]'));

            function goToStep(n) {
                steps.forEach(function (panel) {
                    panel.classList.toggle('active', panel.dataset.step === String(n));
                });
                indicators.forEach(function (ind) {
                    var num = Number(ind.dataset.stepIndicator);
                    ind.classList.toggle('active', num === n);
                    ind.classList.toggle('completed', num < n);
                });
                document.querySelector('.login-box').scrollTo({ top: 0, behavior: 'smooth' });
            }

            function validateStep(panel) {
                var fields = Array.prototype.slice.call(panel.querySelectorAll('[required]'));
                for (var i = 0; i < fields.length; i++) {
                    if (!fields[i].reportValidity()) {
                        return false;
                    }
                }
                return true;
            }

            form.querySelectorAll('.btn-next').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var currentPanel = btn.closest('.form-step');
                    if (!validateStep(currentPanel)) return;
                    goToStep(Number(btn.dataset.next));
                });
            });

            form.querySelectorAll('.btn-prev').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    goToStep(Number(btn.dataset.prev));
                });
            });

            form.querySelectorAll('.toggle-password').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var input = document.getElementById(btn.dataset.target);
                    input.type = input.type === 'password' ? 'text' : 'password';
                });
            });

            form.querySelectorAll('.upload-input').forEach(function (input) {
                input.addEventListener('change', function () {
                    var label = form.querySelector('[data-filename-for="' + input.id + '"]');
                    if (label) {
                        label.textContent = input.files.length ? input.files[0].name : 'Nenhum arquivo selecionado';
                    }
                });
            });

            // Preenche o passo de revisão com o que foi digitado
            document.querySelectorAll('.btn-next[data-next="4"]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var get = function (id) { return document.getElementById(id); };
                    var setReview = function (key, value) {
                        var el = form.querySelector('[data-review="' + key + '"]');
                        if (el) el.textContent = value && value.trim() !== '' ? value : '—';
                    };

                    setReview('nome', get('nome').value);
                    setReview('email', get('email').value);
                    setReview('telefone', get('telefone').value);

                    var categoriaSelect = get('categoria');
                    setReview('categoria', categoriaSelect.options[categoriaSelect.selectedIndex]?.text);

                    setReview('especialidade', get('especialidade').value);

                    /*var conselhoSelect = get('conselho');
                    var ufSelect = get('ufConselho');
                    var conselhoTexto = conselhoSelect.value ? conselhoSelect.value + ' - ' + get('numConselho').value + '/' + ufSelect.value : '';
                    setReview('conselho', conselhoTexto);

                    var atendimentos = [];
                    if (get('atendeChat').checked) atendimentos.push('Chat');
                    if (get('atendeDuvidaRapido').checked) atendimentos.push('Dúvida rápida');
                    if (get('atendePresencial').checked) atendimentos.push('Presencial em parceria');
                    setReview('atendimentos', atendimentos.join(', '));*/
                });
            });
        })();
    </script>

</body>

</html>