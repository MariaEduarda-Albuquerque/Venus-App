@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/perfil-config.css') }}">
@endpush

@section('content')

<div class="wrap">

    <div class="head">
        <div>
            <h1>Editar perfil</h1>
            <p class="sm">Atualize seus dados para manter o perfil em dia.</p>
        </div>
        <a href="{{ route('perfil') }}" class="bk" aria-label="Voltar">
            <i data-lucide="arrow-left"></i>
        </a>
    </div>

    @if ($errors->any())
        <div class="alerta erro" role="alert">Confira os campos destacados e tente de novo.</div>
    @endif

    <form class="ef" action="{{ route('perfil.atualizar') }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="card" style="text-align:center">
            <div class="pav" style="margin:6px auto 14px">
                <span>{{ $inicial }}</span>
            </div>

            <b>{{ $nomeCompleto }}</b>
        </div>

        <div class="stack">

            <div class="card">
                <div class="sech">
                    <div class="ico"><i data-lucide="user-round"></i></div>
                    <div>
                        <h3>Informações pessoais</h3>
                        <p>Como você aparece para a equipe.</p>
                    </div>
                </div>

                <div class="two">
                    <div class="f">
                        <label for="primeiro_nome">Primeiro nome <em>*</em></label>
                        <input type="text" id="primeiro_nome" name="primeiro_nome" maxlength="60"
                               value="{{ old('primeiro_nome', $primeiroNome) }}"
                               class="{{ $errors->has('primeiro_nome') ? 'invalido' : '' }}">
                        @error('primeiro_nome')<div class="erro-campo">{{ $message }}</div>@enderror
                    </div>
                    <div class="f">
                        <label for="sobrenome">Sobrenome</label>
                        <input type="text" id="sobrenome" name="sobrenome" maxlength="60"
                               value="{{ old('sobrenome', $sobrenome) }}"
                               class="{{ $errors->has('sobrenome') ? 'invalido' : '' }}">
                        @error('sobrenome')<div class="erro-campo">{{ $message }}</div>@enderror
                    </div>
                    <div class="f">
                        <label for="email">E-mail <em>*</em></label>
                        <input type="email" id="email" name="email" maxlength="150"
                               value="{{ old('email', $email) }}"
                               class="{{ $errors->has('email') ? 'invalido' : '' }}">
                        @error('email')<div class="erro-campo">{{ $message }}</div>@enderror
                    </div>
                    <div class="f">
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="telefone" maxlength="14" inputmode="numeric"
                               placeholder="11 99999-9999"
                               value="{{ old('telefone', $telefone) }}"
                               class="{{ $errors->has('telefone') ? 'invalido' : '' }}">
                        @error('telefone')<div class="erro-campo">{{ $message }}</div>@enderror
                    </div>
                    <div class="f">
                        <label>Cargo</label>
                        <input type="text" value="Gerente Administrativo" disabled>
                        <div class="hint">Definido pela equipe gestora.</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="sech">
                    <div class="ico"><i data-lucide="map-pin"></i></div>
                    <div>
                        <h3>Endereço</h3>
                        <p>Usado em relatórios e documentos oficiais.</p>
                    </div>
                </div>

                <div class="two">
                    <div class="f">
                        <label for="pais">País</label>
                        <input type="text" id="pais" name="pais" maxlength="60"
                               value="{{ old('pais', $pais) }}"
                               class="{{ $errors->has('pais') ? 'invalido' : '' }}">
                        @error('pais')<div class="erro-campo">{{ $message }}</div>@enderror
                    </div>
                    <div class="f">
                        <label for="cidade">Cidade/Estado</label>
                        <input type="text" id="cidade" name="cidade" maxlength="104"
                               placeholder="Ex.: São Paulo, SP"
                               value="{{ old('cidade', $cidadeUf) }}"
                               class="{{ ($errors->has('cidade_nome') || $errors->has('uf')) ? 'invalido' : '' }}">
                        @if ($errors->has('cidade_nome') || $errors->has('uf'))
                            <div class="erro-campo">{{ $errors->first('cidade_nome') ?: $errors->first('uf') }}</div>
                        @endif
                    </div>
                    <div class="f">
                        <label for="cep">Código postal</label>
                        <input type="text" id="cep" name="cep" maxlength="9" inputmode="numeric"
                               placeholder="00000-000"
                               value="{{ old('cep', $cepFormatado) }}"
                               class="{{ $errors->has('cep') ? 'invalido' : '' }}">
                        @error('cep')<div class="erro-campo">{{ $message }}</div>@enderror
                    </div>
                    <div class="f">
                        <label for="nfiscal">Nº fiscal</label>
                        <input type="text" id="nfiscal" name="nfiscal" maxlength="20"
                               value="{{ old('nfiscal', $nrfiscal) }}"
                               class="{{ $errors->has('nfiscal') ? 'invalido' : '' }}">
                        @error('nfiscal')<div class="erro-campo">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="savebar">
                <span class="sm">As alterações só valem depois de salvar.</span>
                <div style="display:flex;gap:10px">
                    <a href="{{ route('perfil') }}" class="btn g">Cancelar</a>
                    <button type="submit" class="btn p">
                        <i data-lucide="check"></i> Salvar alterações
                    </button>
                </div>
            </div>

        </div>
    </form>

</div>

@endsection

@push('scripts')
<script>
    // Máscaras simples: telefone "11 99999-9999" e código postal "00000-000"
    (function () {
        var tel = document.getElementById('telefone');
        var cep = document.getElementById('cep');

        tel.addEventListener('input', function () {
            var n = tel.value.replace(/\D/g, '').slice(0, 11);
            var texto = n;
            if (n.length > 2) {
                var resto = n.slice(2);
                var corte = n.length > 10 ? 5 : 4;
                texto = n.slice(0, 2) + ' ' + resto.slice(0, corte) + (resto.length > corte ? '-' + resto.slice(corte) : '');
            }
            tel.value = texto;
        });

        cep.addEventListener('input', function () {
            var n = cep.value.replace(/\D/g, '').slice(0, 8);
            cep.value = n.length > 5 ? n.slice(0, 5) + '-' + n.slice(5) : n;
        });
    })();
</script>
@endpush
