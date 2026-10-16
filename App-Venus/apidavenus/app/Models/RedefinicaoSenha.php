<?php

// ONDE SALVAR: app/Models/RedefinicaoSenha.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedefinicaoSenha extends Model
{
    protected $table = 'tbRedefinicaoSenha';

    protected $primaryKey = 'codRedefinicaoSenha';

    protected $fillable = [
        'emailUsuario',
        'codigoRedefinicao',
        'expiraEmRedefinicao',
        'usadoRedefinicao',
    ];

    protected $casts = [
        'expiraEmRedefinicao' => 'datetime',
        'usadoRedefinicao' => 'boolean',
    ];
}
