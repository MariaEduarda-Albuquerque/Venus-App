@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/profissional.css') }}">
@endpush

@section('content')

<div class="pf-page">

    <a href="/profissionais" class="pf-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 6l-6 6 6 6"/></svg>
        Voltar para a lista
    </a>

    <div class="pf-header">
        <h1>Consulta de profissional</h1>
        <p class="pf-subtitle">Dados cadastrais do profissional escolhido na lista (somente consulta).</p>
    </div>

    <div class="pf-grid">

        <div class="pf-main">

            <section class="pf-card">
                <div class="pf-cover"></div>

                <div class="pf-hero">
                    <div class="pf-hero-row">
                        <span class="pf-avatar">A</span>
                    </div>

                    <div class="pf-identity">
                        <h2>Ana da Silva Pinto</h2>
                        <div class="pf-identity-meta">
                            <span class="pf-chip">Ginecologista</span>
                            <span class="pf-chip pf-chip--ok">Ativa</span>
                        </div>
                        <p>Cadastrado em 16/10/2026.</p>
                    </div>
                </div>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Contato e documento</h3>
                <dl class="pf-fields">
                    <div class="pf-field pf-field--full">
                        <dt>Email</dt>
                        <dd>ana@gmail.com</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Telefone</dt>
                        <dd>11 96083-6370</dd>
                    </div>
                    <div class="pf-field">
                        <dt>CPF ou CNPJ</dt>
                        <dd>207.770.560-46</dd>
                    </div>
                    {{-- NOVO: número do conselho --}}
                    <div class="pf-field">
                        <dt>Nº de conselho</dt>
                        <dd>CRESS 34.221 (9ª)</dd>
                    </div>
                </dl>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Localização</h3>
                <dl class="pf-fields">
                    <div class="pf-field">
                        <dt>CEP</dt>
                        <dd>88704-261</dd>
                    </div>
                    <div class="pf-field">
                        <dt>UF</dt>
                        <dd>SC</dd>
                    </div>
                    <div class="pf-field">
                        <dt>País</dt>
                        <dd>Brasil</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Cidade</dt>
                        <dd>Tubarão</dd>
                    </div>
                </dl>
            </section>

        </div>

        <aside class="pf-side">

            {{-- NOVO: documentos com foto (no lugar da prévia do perfil) --}}
            {{-- TODO (back-end): trocar as imagens pelas que o profissional enviou no cadastro --}}
            <section class="pf-card pf-section pf-docs">
                <h3 class="pf-section-title">Documentos com foto</h3>

                <figure class="pf-doc">
                    <figcaption>Carteira de conselho</figcaption>
                    <img src="{{ asset('images/carteira-conselho.png') }}" alt="Carteira de conselho">
                </figure>

                <figure class="pf-doc">
                    <figcaption>Documento com foto</figcaption>
                    <img src="{{ asset('images/documento-foto.png') }}" alt="Documento com foto">
                </figure>
            </section>

            {{-- Atuação profissional --}}
            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Atuação profissional</h3>
                <dl class="pf-fields">
                    <div class="pf-field">
                        <dt>Categoria profissional</dt>
                        <dd>Médico</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Especialidade</dt>
                        <dd>Ginecologista</dd>
                    </div>
                    <div class="pf-field pf-field--full">
                        <dt>Apresentação profissional</dt>
                        <dd>sla n sei sla krai</dd>
                    </div>
                </dl>
            </section>

            <section class="pf-card pf-section">
                <h3 class="pf-section-title">Dados do cadastro</h3>
                <dl class="pf-fields">
                    <div class="pf-field">
                        <dt>ID</dt>
                        <dd>#3</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Status</dt>
                        <dd>Ativa</dd>
                    </div>
                    <div class="pf-field">
                        <dt>Cadastro</dt>
                        <dd>16/10/2026</dd>
                    </div>

                    <div class="pf-field">
                        <dt>Aprovação</dt>
                        <dd>16/10/2026</dd>
                    </div>
                </dl>
            </section>

        </aside>

    </div>

</div>

@endsection