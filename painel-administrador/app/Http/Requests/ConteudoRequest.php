<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConteudoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'titulo' => [
                'required',
                'string',
                'max:150',
            ],

            'categoria' => [
                'required',
                'integer',
                'exists:codtipocategoria,codTipoCategoria',
            ],

            'formato' => [
                'required',
                'integer',
                'exists:tbtipoconteudo,codTipoConteudo',
            ],

            'texto' => [
                'required',
                'string',
                'max:8000',
            ],

            'fontes' => [
                'required',
                'string',
                'max:500',
            ],

            'capa' => [
                'required_if:acao,publicar',
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'acao' => [
                'required',
                'in:rascunho,publicar',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'Informe o título do conteúdo.',
            'titulo.max' => 'O título pode ter no máximo 150 caracteres.',

            'categoria.required' => 'Selecione uma categoria.',
            'categoria.exists' => 'A categoria selecionada é inválida.',

            'formato.required' => 'Selecione o formato do conteúdo.',
            'formato.exists' => 'O formato selecionado é inválido.',

            'texto.required' => 'Escreva o conteúdo.',
            'texto.max' => 'O conteúdo pode ter no máximo 8000 caracteres.',

            'fontes.required' => 'Informe pelo menos uma fonte.',

            'capa.required_if' => 'Envie uma capa para continuar.',
            'capa.image' => 'O arquivo precisa ser uma imagem.',
            'capa.mimes' => 'Utilize PNG, JPG ou WEBP.',
            'capa.max' => 'A capa deve ter no máximo 5 MB.',

            'acao.required' => 'Selecione o que deseja fazer.',
            'acao.in' => 'A ação solicitada é inválida.',
        ];
    }

    public function enviando(): bool
    {
        return in_array($this->input('acao'), [
            'rascunho',
            'publicar',
        ], true);
    }

    public function publicando(): bool
    {
        return $this->input('acao') === 'publicar';
    }
}
