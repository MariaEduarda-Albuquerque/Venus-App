<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecuperacaoSenha extends Model
{
    protected $table = 'tbRecuperacaoSenha';

    protected $fillable = [
        'emailProfissionalSaude',
        'chave',
    ];
}