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

    @php
        $camposPasso1 = ['nome', 'email', 'telefone', 'nrFiscal', 'senha', 'senha_confirmation', 'apresentacao', 'fotoPerfil'];
        $camposPasso2 = ['categoria', 'especialidade', 'cep', 'rua', 'numero', 'complemento', 'pais', 'cidade', 'uf'];
        $passoInicial = 1;
        if ($errors->any() && !$errors->hasAny($camposPasso1) && $errors->hasAny($camposPasso2)) {
            $passoInicial = 2;
        }
    @endphp

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
                            <input type="text" name="nome" id="nome" placeholder="Nome completo" value="{{ old('nome') }}" class="{{ $errors->has('nome') ? 'campo-erro' : '' }}" required>
                        </div>

                        <div class="field-row-2">
                            <div class="field">
                                <label for="email">E-mail profissional</label>
                                <input type="email" name="email" id="email" placeholder="seu@email.com" value="{{ old('email') }}" class="{{ $errors->has('email') ? 'campo-erro' : '' }}" required>
                            </div>
                            <div class="field">
                                <label for="telefone">Celular (com DDD)</label>
                                <input type="text" name="telefone" id="telefone" placeholder="(11) 99999-9999" maxlength="15" value="{{ old('telefone') }}" class="{{ $errors->has('telefone') ? 'campo-erro' : '' }}" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="cpf">CPF ou CNPJ</label>
                            <input type="text" name="nrFiscal" id="cpf" placeholder="000.000.000-00 ou 00.000.000/0000-00" maxlength="20" value="{{ old('nrFiscal') }}" class="{{ $errors->has('nrFiscal') ? 'campo-erro' : '' }}" required>
                        </div>

                        <div class="field-row-2 field-row-senha">
                            <div class="field">
                                <label for="senha">Senha</label>
                                <div class="input-password">
                                    <input type="password" name="senha" id="senha" placeholder="Digite uma senha forte" required>
                                    <button type="button" class="toggle-password" data-target="senha" aria-label="Mostrar senha">
                                        <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" /><circle cx="12" cy="12" r="3" /></svg>
                                        <svg class="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.9 17.9A10.9 10.9 0 0 1 12 19c-7 0-11-7-11-7a19.8 19.8 0 0 1 5.1-5.9M9.9 4.2A10.7 10.7 0 0 1 12 4c7 0 11 7 11 7a19.7 19.7 0 0 1-3.2 4.2M1 1l22 22" /><path d="M14.1 14.1a3 3 0 1 1-4.2-4.2" /></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="field">
                                <label for="senha_confirmation">Confirmar senha</label>
                                <div class="input-password">
                                    <input type="password" name="senha_confirmation" id="senha_confirmation" placeholder="Repita sua senha" required>
                                    <button type="button" class="toggle-password" data-target="senha_confirmation" aria-label="Mostrar senha">
                                        <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" /><circle cx="12" cy="12" r="3" /></svg>
                                        <svg class="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.9 17.9A10.9 10.9 0 0 1 12 19c-7 0-11-7-11-7a19.8 19.8 0 0 1 5.1-5.9M9.9 4.2A10.7 10.7 0 0 1 12 4c7 0 11 7 11 7a19.7 19.7 0 0 1-3.2 4.2M1 1l22 22" /><path d="M14.1 14.1a3 3 0 1 1-4.2-4.2" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="senha-forca">
                            <div class="senha-forca-topo">
                                <span>Força da senha</span>
                                <strong id="senhaForcaTexto">—</strong>
                            </div>
                            <div class="senha-forca-barra"><span id="senhaForcaBarra"></span></div>
                        </div>

                        <ul class="senha-regras" id="senhaRegras">
                            <li data-regra="tamanho">Mínimo de 8 caracteres</li>
                            <li data-regra="minuscula">Uma letra minúscula</li>
                            <li data-regra="maiuscula">Uma letra maiúscula</li>
                            <li data-regra="numero">Um número</li>
                            <li data-regra="especial">Um caractere especial (!@#$%...)</li>
                            <li data-regra="igual">As senhas devem ser iguais</li>
                        </ul>

                        <div class="field">
                            <label for="apresentacao">Apresentação</label>
                            <textarea name="apresentacao" id="apresentacao" rows="3" maxlength="400" placeholder="Conte brevemente sua experiência e abordagem de atendimento." class="{{ $errors->has('apresentacao') ? 'campo-erro' : '' }}">{{ old('apresentacao') }}</textarea>
                        </div>

                        <div class="field">
                            <label class="upload-box">
                                <span class="upload-icon">&#8593;</span>
                                <span class="upload-text">
                                    <strong>Foto de perfil</strong>
                                    <span class="upload-desc">JPG ou PNG</span>
                                </span>
                                <span class="upload-filename" data-filename-for="fotoPerfil">Nenhum arquivo selecionado</span>
                                <input type="file" name="fotoPerfil" id="fotoPerfil" accept="image/*" class="upload-input">
                            </label>
                        </div>

                        <label class="checkbox terms-checkbox">
                            <input type="checkbox" name="aceiteTermos" id="aceiteTermos" value="1" {{ old('aceiteTermos') ? 'checked' : '' }} required>
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
                                <select name="categoria" id="categoria" class="{{ $errors->has('categoria') ? 'campo-erro' : '' }}" required>
                                    <option value="">Selecione</option>
                                    <option value="Médico" @selected(old('categoria') === 'Médico')>Médica</option>
                                    <option value="Enfermeiro" @selected(old('categoria') === 'Enfermeiro')>Enfermeira</option>
                                    <option value="Psicologo" @selected(old('categoria') === 'Psicologo')>Psicóloga</option>
                                    <option value="Outro" @selected(old('categoria') === 'Outro')>Outro</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="especialidade">Especialidade</label>
                                <input type="text" name="especialidade" id="especialidade" placeholder="Ex: Ginecologista" maxlength="25" value="{{ old('especialidade') }}" class="{{ $errors->has('especialidade') ? 'campo-erro' : '' }}">
                            </div>
                        </div>
                        
                        <div class="field">
                            <label for="cep">CEP</label>
                            <input type="text" name="cep" id="cep" placeholder="Ex: 01001-000" maxlength="9" value="{{ old('cep') }}" class="{{ $errors->has('cep') ? 'campo-erro' : '' }}">
                        </div>

                        <div class="field">
                            <label for="rua">Rua</label>
                            <input type="text" name="rua" id="rua" placeholder="Ex: Rua dos amores" maxlength="150" value="{{ old('rua') }}" class="{{ $errors->has('rua') ? 'campo-erro' : '' }}">
                        </div>

                        <div class="field-row-2">
                            <div class="field">
                                <label for="numero">Número</label>
                                <input type="text" name="numero" id="numero" placeholder="Ex: 123" maxlength="10" value="{{ old('numero') }}" class="{{ $errors->has('numero') ? 'campo-erro' : '' }}">
                            </div>
                            <div class="field">
                                <label for="complemento">Complemento</label>
                                <input type="text" name="complemento" id="complemento" placeholder="Ex: casa 1" maxlength="100" value="{{ old('complemento') }}" class="{{ $errors->has('complemento') ? 'campo-erro' : '' }}">
                            </div>
                        </div>

                        <div class="field-row-2">
                            <div class="field">
                                <label for="pais">País</label>
                                <input type="text" name="pais" id="pais" placeholder="Ex: Brasil" value="{{ old('pais') }}" class="{{ $errors->has('pais') ? 'campo-erro' : '' }}">
                            </div>
                            <div class="field">
                                <label for="cidade">Cidade</label>
                                <input type="text" name="cidade" id="cidade" placeholder="Ex: São Paulo" maxlength="100" pattern="[A-Za-zÀ-ÿ' .\-]{2,100}" title="Use apenas letras (mínimo 2). Ex: São Paulo" value="{{ old('cidade') }}" class="{{ $errors->has('cidade') ? 'campo-erro' : '' }}">
                            </div>
                        </div>

                        <div class="field">
                            <label for="uf">UF</label>
                            <select name="uf" id="uf" class="{{ $errors->has('uf') ? 'campo-erro' : '' }}">
                                <option value="">Selecione a UF</option>
                                <option value="AC" @selected(old('uf') === 'AC')>Acre</option>
                                <option value="AL" @selected(old('uf') === 'AL')>Alagoas</option>
                                <option value="AP" @selected(old('uf') === 'AP')>Amapá</option>
                                <option value="AM" @selected(old('uf') === 'AM')>Amazonas</option>
                                <option value="BA" @selected(old('uf') === 'BA')>Bahia</option>
                                <option value="CE" @selected(old('uf') === 'CE')>Ceará</option>
                                <option value="DF" @selected(old('uf') === 'DF')>Distrito Federal</option>
                                <option value="ES" @selected(old('uf') === 'ES')>Espírito Santo</option>
                                <option value="GO" @selected(old('uf') === 'GO')>Goiás</option>
                                <option value="MA" @selected(old('uf') === 'MA')>Maranhão</option>
                                <option value="MT" @selected(old('uf') === 'MT')>Mato Grosso</option>
                                <option value="MS" @selected(old('uf') === 'MS')>Mato Grosso do Sul</option>
                                <option value="MG" @selected(old('uf') === 'MG')>Minas Gerais</option>
                                <option value="PA" @selected(old('uf') === 'PA')>Pará</option>
                                <option value="PB" @selected(old('uf') === 'PB')>Paraíba</option>
                                <option value="PR" @selected(old('uf') === 'PR')>Paraná</option>
                                <option value="PE" @selected(old('uf') === 'PE')>Pernambuco</option>
                                <option value="PI" @selected(old('uf') === 'PI')>Piauí</option>
                                <option value="RJ" @selected(old('uf') === 'RJ')>Rio de Janeiro</option>
                                <option value="RN" @selected(old('uf') === 'RN')>Rio Grande do Norte</option>
                                <option value="RS" @selected(old('uf') === 'RS')>Rio Grande do Sul</option>
                                <option value="RO" @selected(old('uf') === 'RO')>Rondônia</option>
                                <option value="RR" @selected(old('uf') === 'RR')>Roraima</option>
                                <option value="SC" @selected(old('uf') === 'SC')>Santa Catarina</option>
                                <option value="SP" @selected(old('uf') === 'SP')>São Paulo</option>
                                <option value="SE" @selected(old('uf') === 'SE')>Sergipe</option>
                                <option value="TO" @selected(old('uf') === 'TO')>Tocantins</option>
                            </select>
                        </div>

                        <div class="wizard-actions">
                            <button type="button" class="btn-outline btn-prev" data-prev="1">Voltar</button>
                            <button type="button" class="btn-primary btn-next" data-next="3">Continuar</button>
                        </div>

                    </div>

                    {{-- ===================== PASSO 3 - DOCUMENTOS ===================== --}}
                    <div class="form-step" data-step="3">

                        <span class="step-count">3 DE 4</span>
                        <h2 class="step-title">Documento para verificação</h2>
                        <p class="step-subtitle">Envie os documentos solicitados para validar seu cadastro profissional.</p>

                        <label class="upload-box upload-box--big">
                            <span class="upload-icon">&#8593;</span>
                            <span class="upload-text">
                                <strong>Comprovante do conselho de classe</strong>
                                <span class="upload-desc">CRM/CRP/COREN/CRESS &middot; PDF, JPG ou PNG &middot; até 10 MB</span>
                            </span>
                            <span class="upload-filename" data-filename-for="comprovanteConselho">Nenhum arquivo selecionado</span>
                            <input type="file" name="comprovanteConselho" id="comprovanteConselho" class="upload-input">
                        </label>

                        <label class="upload-box upload-box--big">
                            <span class="upload-icon">&#8593;</span>
                            <span class="upload-text">
                                <strong>Documento complementar</strong>
                                <span class="upload-desc">Se solicitado para conferência cadastral &middot; PDF, JPG ou PNG &middot; até 10 MB</span>
                            </span>
                            <span class="upload-filename" data-filename-for="docComplementar">Nenhum arquivo selecionado</span>
                            <input type="file" name="docComplementar" id="docComplementar" class="upload-input">
                        </label>

                        <div class="info-note">
                            Os documentos serão usados exclusivamente para análise e verificação do cadastro profissional.
                        </div>

                        <div class="wizard-actions">
                            <button type="button" class="btn-outline btn-prev" data-prev="2">Voltar</button>
                            <button type="button" class="btn-primary btn-next" data-next="4">Continuar</button>
                        </div>

                    </div>

                    {{-- ===================== PASSO 4 - REVISÃO ===================== --}}
                    <div class="form-step" data-step="4">

                        <span class="step-count">4 DE 4</span>
                        <h2 class="step-title">Confira novamente os seus dados</h2>
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
                            <button type="button" class="btn-primary" onclick="abrirModal()">Continuar</button>
                        </div>

                    </div>

                    {{-- ===================== MODAL ===================== --}}
                    <div id="modalDesativar" class="modal-overlay" style="display: none;">
                        <div class="modal-box">
                            <h2>Conta em análise</h2>
                            <p>Agora sua conta será válidada por uma administrador.</p>

                            <div class="modal-actions">
                                <button type="submit" class="btn-outline-sm" onclick="fecharModal()" style="justify-content: center;">OK</button>
                            </div>
                        </div>
                    </div>

                </form>

                <p class="signup">
                    Já possui uma conta?
                    <a href="/">Voltar para o login</a>
                </p>

            </div>

        </div>

    </section>

    <script>
        function abrirModal() {
            document.getElementById('modalDesativar').style.display = 'flex';
        }

        function fecharModal() {
            document.getElementById('modalDesativar').style.display = 'none';
        }

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

        // Máscara do celular: (11) 99999-9999 (ou (11) 9999-9999)
        (function () {
            var tel = document.getElementById('telefone');
            if (!tel) return;

            function mascarar() {
                var d = tel.value.replace(/\D/g, '').slice(0, 11);
                var out = '';
                if (d.length > 0) out = '(' + d;            // o ")" só fecha a partir do 3º dígito
                if (d.length > 2) {
                    var resto = d.slice(2);
                    var corte = d.length > 10 ? 5 : 4;
                    out = '(' + d.slice(0, 2) + ') ' + resto.slice(0, corte);
                    if (resto.length > corte) out += '-' + resto.slice(corte);
                }
                tel.value = out;
            }

            tel.addEventListener('input', mascarar);
            mascarar();
        })();

        // Máscara do CPF (000.000.000-00) e do CNPJ (00.000.000/0000-00)
        (function () {
            var doc = document.getElementById('cpf');
            if (!doc) return;

            function mascarar() {
                var d = doc.value.replace(/\D/g, '').slice(0, 14);
                var out;
                if (d.length <= 11) {
                    out = d.replace(/^(\d{3})(\d)/, '$1.$2')
                           .replace(/^(\d{3})\.(\d{3})(\d)/, '$1.$2.$3')
                           .replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4');
                } else {
                    out = d.replace(/^(\d{2})(\d)/, '$1.$2')
                           .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
                           .replace(/^(\d{2})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3/$4')
                           .replace(/^(\d{2})\.(\d{3})\.(\d{3})\/(\d{4})(\d)/, '$1.$2.$3/$4-$5');
                }
                doc.value = out;
            }

            doc.addEventListener('input', mascarar);
            mascarar();
        })();

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

            // Depois de um erro do servidor, abre o passo onde está o problema
            var passoInicial = {{ $passoInicial }};
            if (passoInicial > 1) goToStep(passoInicial);

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
                    var mostrando = input.type === 'password';

                input.type = mostrando ? 'text' : 'password';
                btn.classList.toggle('mostrando', mostrando);
                btn.setAttribute('aria-label', mostrando ? 'Ocultar senha' : 'Mostrar senha');
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

                // Máscara de telefone: "11 97728-2760"
                (function () {
                    var senha = document.getElementById('senha');
                    var conf = document.getElementById('senha_confirmation');
                    if (!senha || !conf) return;

                    var regras = {
                        tamanho:   function (s) { return s.length >= 8; },
                        minuscula: function (s) { return /\p{Ll}/u.test(s); },
                        maiuscula: function (s) { return /\p{Lu}/u.test(s); },
                        numero:    function (s) { return /\p{N}/u.test(s); },
                        especial:  function (s) { return /[\p{Z}\p{S}\p{P}]/u.test(s); }
                    };
                    var nomes = { '': '—', fraca: 'Fraca', media: 'Média', forte: 'Forte' };

                    var itens = document.querySelectorAll('#senhaRegras li');
                    var itemIgual = document.querySelector('#senhaRegras li[data-regra="igual"]');
                    var barra = document.getElementById('senhaForcaBarra');
                    var texto = document.getElementById('senhaForcaTexto');

                    function avaliarSenha() {
                        var v = senha.value, ok = 0;

                        itens.forEach(function (li) {
                            if (!regras[li.dataset.regra]) return; // "igual" é tratado na confirmação
                            var passou = regras[li.dataset.regra](v);
                            li.classList.toggle('ok', passou);
                            if (passou) ok++;
                        });

                        var nivel = v === '' ? '' : (ok === 5 ? 'forte' : (ok >= 3 ? 'media' : 'fraca'));
                        barra.style.width = (v === '' ? 0 : ok / 5 * 100) + '%';
                        barra.className = nivel ? 'nivel-' + nivel : '';
                        texto.textContent = nomes[nivel];
                        texto.className = nivel ? 'nivel-' + nivel : '';

                        senha.classList.toggle('campo-erro', v !== '' && ok < 5);
                        senha.classList.toggle('campo-ok', ok === 5);
                        // Bloqueia o botão "Próximo" enquanto a senha não for forte
                        senha.setCustomValidity(ok === 5 ? '' : 'A senha precisa ter 8 caracteres, letra maiúscula, minúscula, número e caractere especial.');
                    }

                    function avaliarConfirmacao() {
                        var b = conf.value;
                        var iguais = b !== '' && b === senha.value;

                        if (itemIgual) itemIgual.classList.toggle('ok', iguais);

                        conf.classList.remove('campo-erro', 'campo-ok');

                        if (b === '') {
                            conf.setCustomValidity('');
                            return;
                        }

                        if (iguais) {
                            conf.classList.add('campo-ok');
                            conf.setCustomValidity('');
                        } else {
                            conf.classList.add('campo-erro');
                            conf.setCustomValidity('As senhas não coincidem.');
                        }
                    }

                    senha.addEventListener('input', function () { avaliarSenha(); avaliarConfirmacao(); });
                    conf.addEventListener('input', avaliarConfirmacao);
                    avaliarSenha();
                    avaliarConfirmacao();
                })();
    </script>
    <script>
        // ===== CEP: máscara 00000-000 e preenchimento automático da rua =====
        (function () {
            var cepEl = document.getElementById('cep');
            var ruaEl = document.getElementById('rua');
            if (!cepEl || !ruaEl) return;

            cepEl.setAttribute('inputmode', 'numeric');
            cepEl.setAttribute('autocomplete', 'postal-code');

            function mascararCep() {
                var d = cepEl.value.replace(/\D/g, '').slice(0, 8);
                cepEl.value = d.length > 5 ? d.slice(0, 5) + '-' + d.slice(5) : d;
            }

            function buscarRua() {
                var cep = cepEl.value.replace(/\D/g, '');
                if (cep.length !== 8) return;

                ruaEl.placeholder = 'Buscando endereço...';
                fetch('https://viacep.com.br/ws/' + cep + '/json/')
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        ruaEl.placeholder = 'Preenchida automaticamente ao informar o CEP';
                        if (data.erro) return;
                        if (data.logradouro) ruaEl.value = data.logradouro;
                        ruaEl.classList.remove('campo-erro');
                    })
                    .catch(function () {
                        ruaEl.placeholder = 'Informe a rua manualmente';
                    });
            }

            cepEl.addEventListener('input', function () {
                mascararCep();
                if (cepEl.value.replace(/\D/g, '').length === 8) buscarRua();
            });
            cepEl.addEventListener('blur', buscarRua);
            mascararCep();
        })();

    </script>
    <script>
        // ===== Validação paginada: cada passo é validado antes de avançar =====
        (function () {
            var form = document.getElementById('formCadastro');
            if (!form) return;

            var ufsValidas = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'];

            function digitos(v) { return (v || '').replace(/\D/g, ''); }

            function cpfValido(c) {
                if (c.length !== 11 || /^(\d)\1{10}$/.test(c)) return false;
                for (var t = 9; t < 11; t++) {
                    var soma = 0;
                    for (var i = 0; i < t; i++) soma += Number(c[i]) * (t + 1 - i);
                    var dv = ((soma * 10) % 11) % 10;
                    if (dv !== Number(c[t])) return false;
                }
                return true;
            }

            function cnpjValido(c) {
                if (c.length !== 14 || /^(\d)\1{13}$/.test(c)) return false;
                for (var t = 12; t < 14; t++) {
                    var pesos = t === 12 ? [5,4,3,2,9,8,7,6,5,4,3,2] : [6,5,4,3,2,9,8,7,6,5,4,3,2];
                    var soma = 0;
                    for (var i = 0; i < t; i++) soma += Number(c[i]) * pesos[i];
                    var r = soma % 11;
                    var dv = r < 2 ? 0 : 11 - r;
                    if (dv !== Number(c[t])) return false;
                }
                return true;
            }

            function arquivoInvalido(input, maxMb) {
                if (!input || !input.files || !input.files.length) return null;
                var f = input.files[0];
                if (!/\.(pdf|jpe?g|png|webp)$/i.test(f.name)) return 'Envie um arquivo PDF, JPG ou PNG.';
                if (f.size > maxMb * 1024 * 1024) return 'O arquivo deve ter no máximo ' + maxMb + ' MB.';
                return null;
            }

            var $ = function (id) { return document.getElementById(id); };

            // Regras de cada passo: [id do campo, função que devolve a mensagem de erro ou ''].
            var regras = {
                1: [
                    ['nome', function (v) {
                        v = v.trim();
                        if (v.length < 3) return 'Informe seu nome completo.';
                        if (!/^[A-Za-zÀ-ÿ][A-Za-zÀ-ÿ'.\- ]+$/.test(v)) return 'O nome deve conter apenas letras.';
                        if (v.split(/\s+/).length < 2) return 'Informe nome e sobrenome.';
                        return '';
                    }],
                    ['email', function (v) {
                        if (!v.trim()) return 'Informe seu e-mail.';
                        return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()) ? '' : 'Informe um e-mail válido.';
                    }],
                    ['telefone', function (v) {
                        var d = digitos(v);
                        if (!d) return 'Informe seu celular com DDD.';
                        return (d.length === 10 || d.length === 11) ? '' : 'Informe o celular com DDD. Ex: (11) 99999-9999';
                    }],
                    ['cpf', function (v) {
                        var d = digitos(v);
                        if (!d) return 'Informe seu CPF ou CNPJ.';
                        if (d.length === 11) return cpfValido(d) ? '' : 'CPF inválido.';
                        if (d.length === 14) return cnpjValido(d) ? '' : 'CNPJ inválido.';
                        return 'Informe um CPF (11 dígitos) ou CNPJ (14 dígitos).';
                    }],
                    ['senha', function (v) {
                        return $('senha').validationMessage ? $('senha').validationMessage : (v ? '' : 'Informe uma senha.');
                    }],
                    ['senha_confirmation', function (v) {
                        if (!v) return 'Confirme sua senha.';
                        return v === $('senha').value ? '' : 'As senhas não coincidem.';
                    }],
                    ['apresentacao', function (v) {
                        return v.length > 400 ? 'A apresentação deve ter no máximo 400 caracteres.' : '';
                    }],
                    ['fotoPerfil', function () {
                        var f = $('fotoPerfil').files[0];
                        if (!f) return '';
                        if (!/^image\//.test(f.type)) return 'A foto deve ser uma imagem (JPG ou PNG).';
                        return f.size > 2 * 1024 * 1024 ? 'A foto deve ter no máximo 2 MB.' : '';
                    }],
                    ['aceiteTermos', function () {
                        return $('aceiteTermos').checked ? '' : 'Você precisa aceitar os Termos de Uso e a Política de Privacidade.';
                    }]
                ],
                2: [
                    ['categoria', function (v) { return v ? '' : 'Selecione a categoria profissional.'; }],
                    ['especialidade', function (v) {
                        v = v.trim();
                        if (!v) return '';
                        return v.length < 3 ? 'A especialidade deve ter no mínimo 3 caracteres.' : '';
                    }],
                    ['cep', function (v) {
                        if (!v.trim()) return '';
                        return digitos(v).length === 8 ? '' : 'Informe o CEP no formato 00000-000.';
                    }],
                    ['rua', function (v) {
                        return v.length > 150 ? 'A rua deve ter no máximo 150 caracteres.' : '';
                    }],
                    ['numero', function (v) {
                        return v.trim().length > 10 ? 'O número deve ter no máximo 10 caracteres.' : '';
                    }],
                    ['complemento', function (v) {
                        return v.length > 100 ? 'O complemento deve ter no máximo 100 caracteres.' : '';
                    }],
                    ['cidade', function (v) {
                        v = v.trim();
                        if (!v) return '';
                        return /^[A-Za-zÀ-ÿ][A-Za-zÀ-ÿ' .\-]+$/.test(v) ? '' : 'A cidade deve conter apenas letras (mínimo 2).';
                    }],
                    ['uf', function (v) {
                        if (!v) return '';
                        return ufsValidas.indexOf(v) >= 0 ? '' : 'Selecione uma UF válida.';
                    }]
                ],
                3: [
                    ['comprovanteConselho', function () { return arquivoInvalido($('comprovanteConselho'), 2) || ''; }],
                    ['docComplementar', function () { return arquivoInvalido($('docComplementar'), 2) || ''; }]
                ]
            };

            function ponto(el) {
                // checkbox mostra a mensagem logo após o rótulo; demais campos, após o campo (ou o wrapper da senha)
                if (el.type === 'checkbox') return el.closest('label');
                if (el.type === 'file') return el.closest('label');
                return el.closest('.input-password') || el;
            }

            function limpar(el) {
                el.classList.remove('campo-erro');
                var alvo = ponto(el);
                var nxt = alvo && alvo.nextElementSibling;
                if (nxt && nxt.classList.contains('erro-passo')) nxt.remove();
            }

            function mostrar(el, msg) {
                limpar(el);
                el.classList.add('campo-erro');
                // Campos de senha: sem texto vermelho abaixo (as regras da senha forte já orientam)
                if (el.id === 'senha' || el.id === 'senha_confirmation') return;
                var span = document.createElement('small');
                span.className = 'erro-passo';
                span.setAttribute('role', 'alert');
                span.textContent = msg;
                var alvo = ponto(el);
                alvo.parentNode.insertBefore(span, alvo.nextSibling);
            }

            function validarCampo(par) {
                var el = $(par[0]);
                if (!el) return true;
                var msg = par[1](el.type === 'checkbox' || el.type === 'file' ? '' : el.value);
                if (msg) { mostrar(el, msg); return false; }
                limpar(el);
                return true;
            }

            // Valida todo o passo, marca todos os erros e foca no primeiro
            function validarPasso(n) {
                var lista = regras[n] || [];
                var primeiro = null;
                lista.forEach(function (par) {
                    if (!validarCampo(par) && !primeiro) primeiro = $(par[0]);
                });
                if (primeiro) {
                    primeiro.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    if (primeiro.focus) primeiro.focus({ preventScroll: true });
                    return false;
                }
                return true;
            }

            // Captura o clique em "Continuar" antes do avanço padrão; se houver erro, bloqueia
            // Campos que não podem repetir (checados no servidor)
            var unicos = { email: 'email', cpf: 'nrFiscal', telefone: 'telefone' };
            var rotulos = { email: 'Este e-mail já está cadastrado.', cpf: 'Este CPF/CNPJ já está cadastrado.', telefone: 'Este celular já está cadastrado.' };

            function checarUnico(id) {
                var el = $(id);
                if (!el || !el.value.trim()) return Promise.resolve(true);
                var url = '{{ url('user.cadastro/verificar') }}?campo=' + encodeURIComponent(unicos[id]) + '&valor=' + encodeURIComponent(el.value);
                return fetch(url, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' })
                    .then(function (r) { return r.json(); })
                    .then(function (d) {
                        if (d.existe) { mostrar(el, rotulos[id]); return false; }
                        return true;
                    })
                    .catch(function () { return true; }); // se a checagem falhar, o servidor valida no envio
            }

            // Ao sair do campo já avisa se está repetido (só se o formato estiver correto)
            Object.keys(unicos).forEach(function (id) {
                var el = $(id);
                if (!el) return;
                el.addEventListener('blur', function () {
                    var par = (regras[1] || []).filter(function (p) { return p[0] === id; })[0];
                    if (el.value.trim() && par && validarCampo(par)) checarUnico(id);
                });
            });

            form.querySelectorAll('.btn-next').forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    if (btn.dataset.liberado === '1') { delete btn.dataset.liberado; return; }

                    var painel = btn.closest('.form-step');
                    var n = Number(painel.dataset.step);
                    e.stopImmediatePropagation();
                    e.preventDefault();

                    if (!validarPasso(n)) return;

                    if (n !== 1) { btn.dataset.liberado = '1'; btn.click(); return; }

                    // Passo 1: confere no servidor se e-mail, CPF/CNPJ e celular já existem
                    btn.disabled = true;
                    Promise.all(Object.keys(unicos).map(checarUnico)).then(function (res) {
                        btn.disabled = false;
                        if (res.every(Boolean)) {
                            btn.dataset.liberado = '1';
                            btn.click();
                        } else {
                            var primeiro = Object.keys(unicos).filter(function (id) { return $(id).classList.contains('campo-erro'); })[0];
                            if (primeiro) { $(primeiro).scrollIntoView({ behavior: 'smooth', block: 'center' }); $(primeiro).focus({ preventScroll: true }); }
                        }
                    });
                }, true);
            });

            // Validação ao vivo: some o erro assim que o campo fica correto
            Object.keys(regras).forEach(function (n) {
                regras[n].forEach(function (par) {
                    var el = $(par[0]);
                    if (!el) return;
                    var evento = (el.type === 'checkbox' || el.type === 'file' || el.tagName === 'SELECT') ? 'change' : 'input';
                    el.addEventListener(evento, function () {
                        if (el.classList.contains('campo-erro')) validarCampo(par);
                    });
                    el.addEventListener('blur', function () {
                        if (el.type !== 'checkbox' && el.value !== '') validarCampo(par);
                    });
                });
            });

            // Segurança no envio final: revalida todos os passos e volta para o primeiro com erro
            form.addEventListener('submit', function (e) {
                for (var n = 1; n <= 3; n++) {
                    if (!validarPasso(n)) {
                        e.preventDefault();
                        var ind = document.querySelector('[data-step-indicator="' + n + '"]');
                        document.querySelectorAll('.form-step').forEach(function (p) {
                            p.classList.toggle('active', p.dataset.step === String(n));
                        });
                        document.querySelectorAll('[data-step-indicator]').forEach(function (i) {
                            var num = Number(i.dataset.stepIndicator);
                            i.classList.toggle('active', num === n);
                            i.classList.toggle('completed', num < n);
                        });
                        var modal = $('modalDesativar');
                        if (modal) modal.style.display = 'none';
                        return;
                    }
                }
            });
        })();
    </script>

</body>

</html>
