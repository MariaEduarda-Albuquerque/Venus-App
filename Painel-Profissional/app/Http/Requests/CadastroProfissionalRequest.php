<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validação do formulário de cadastro do profissional (user.cadastro).
 *
 * Os documentos (comprovanteConselho e docComplementar) NÃO são validados aqui,
 * de propósito: o envio deles é opcional e livre por enquanto.
 */
class CadastroProfissionalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * O celular é guardado só com números (ex.: 11997728276), porque
     * "(11) 99772-8276" tem 15 caracteres e a coluna aceita 14.
     * A máscara do formulário formata de novo ao exibir.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('telefone')) {
            $this->merge(['telefone' => preg_replace('/\D/', '', (string) $this->input('telefone'))]);
        }
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'min:3', 'max:120'],

            'email' => ['required', 'email', 'max:150', 'unique:tbprofissionalsaude,emailProfissionalSaude'],

            // DDD + número: 10 dígitos (fixo) ou 11 (celular, começando com 9)
            'telefone' => [
                'required', 'string',
                'regex:/^\d{2}(9\d{8}|\d{8})$/',
                'unique:tbprofissionalsaude,telProfissionalSaude',
            ],

            'nrFiscal' => [
                'required', 'string', 'min:11', 'max:20',
                'unique:tbprofissionalsaude,nrFiscalProfissional',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (!$this->validarCpfCnpj(preg_replace('/\D/', '', $value))) {
                        $fail('CPF ou CNPJ inválido.');
                    }
                },
            ],

            'senha' => [
                'required', 'string', 'min:8', 'max:255', 'confirmed',
                'regex:/\p{Ll}/u', 'regex:/\p{Lu}/u', 'regex:/\p{N}/u', 'regex:/[\p{Z}\p{S}\p{P}]/u',
            ],

            'apresentacao' => ['nullable', 'string', 'max:400'],

            'fotoPerfil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'categoria' => ['required', 'string', Rule::in(['Médico', 'Enfermeiro', 'Psicologo', 'Assistente Social', 'Outro'])],
            'especialidade' => ['nullable', 'string', 'min:3', 'max:25'],
            'cep' => ['nullable', 'string', 'regex:/^\d{5}-?\d{3}$/'],
            'rua' => ['nullable', 'string', 'max:150'],
            'pais' => ['nullable', 'string', 'max:60'],
            'cidade' => ['nullable', 'string', 'min:2', 'max:100', "regex:/^[\p{L}][\p{L}\s'.\-]*$/u"],
            'uf' => ['nullable', 'string', 'size:2', Rule::in([
                'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA',
                'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO',
            ])],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Campo nome obrigatório.',
            'nome.min' => 'O nome deve ter no mínimo :min caracteres.',
            'nome.max' => 'O nome deve ter no máximo :max caracteres.',

            'email.required' => 'Campo e-mail obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Esse e-mail já foi cadastrado.',
            'email.max' => 'O e-mail deve ter no máximo :max caracteres.',

            'telefone.required' => 'Campo celular (com DDD) obrigatório.',
            'telefone.regex' => 'Informe o celular com DDD. Ex: (11) 99999-9999.',
            'telefone.unique' => 'Esse celular já está cadastrado.',

            'nrFiscal.required' => 'Campo CPF ou CNPJ obrigatório.',
            'nrFiscal.min' => 'O CPF ou CNPJ deve ter no mínimo :min caracteres.',
            'nrFiscal.max' => 'O CPF ou CNPJ deve ter no máximo :max caracteres.',
            'nrFiscal.unique' => 'Esse CPF ou CNPJ já foi cadastrado.',

            'senha.required' => 'Campo senha obrigatório.',
            'senha.min' => 'A senha deve ter no mínimo :min caracteres.',
            'senha.max' => 'A senha deve ter no máximo :max caracteres.',
            'senha.confirmed' => 'A confirmação de senha não confere.',
            'senha.regex' => 'A senha deve ter letra maiúscula, minúscula, número e caractere especial.',

            'apresentacao.max' => 'A apresentação deve ter no máximo :max caracteres.',

            'fotoPerfil.image' => 'A foto de perfil deve ser uma imagem.',
            'fotoPerfil.mimes' => 'A foto de perfil deve ser jpg, jpeg, png ou webp.',
            'fotoPerfil.max' => 'A foto de perfil deve ter no máximo 2 MB.',

            'categoria.required' => 'Campo categoria obrigatório.',
            'categoria.in' => 'Selecione uma categoria válida.',
            'especialidade.required' => 'Campo especialidade obrigatório.',
            'especialidade.min' => 'A especialidade deve ter no mínimo :min caracteres.',
            'especialidade.max' => 'A especialidade deve ter no máximo :max caracteres.',
            'cep.regex' => 'Informe o CEP no formato 00000-000.',
            'pais.max' => 'O país deve ter no máximo :max caracteres.',
            'cidade.min' => 'A cidade deve ter no mínimo :min caracteres.',
            'cidade.max' => 'A cidade deve ter no máximo :max caracteres.',
            'cidade.regex' => 'A cidade deve conter apenas letras.',
            'uf.size' => 'A UF deve ter 2 letras.',
            'uf.in' => 'Selecione uma UF válida.',
        ];
    }

    // ---------------------------------------------------------------- CPF / CNPJ

    private function validarCpfCnpj(string $documento): bool
    {
        return match (strlen($documento)) {
            11 => $this->validarCpf($documento),
            14 => $this->validarCnpj($documento),
            default => false,
        };
    }

    private function validarCpf(string $cpf): bool
    {
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $soma = 0;
            for ($i = 0; $i < $t; $i++) {
                $soma += $cpf[$i] * (($t + 1) - $i);
            }
            $digito = (($soma * 10) % 11) % 10;
            if ((int) $cpf[$t] !== $digito) {
                return false;
            }
        }

        return true;
    }

    private function validarCnpj(string $cnpj): bool
    {
        if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
            return false;
        }

        $pesos = [
            12 => [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2],
            13 => [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2],
        ];

        foreach ($pesos as $posicao => $lista) {
            $soma = 0;
            foreach ($lista as $i => $peso) {
                $soma += $cnpj[$i] * $peso;
            }
            $resto = $soma % 11;
            $digito = $resto < 2 ? 0 : 11 - $resto;
            if ((int) $cnpj[$posicao] !== $digito) {
                return false;
            }
        }

        return true;
    }
}
