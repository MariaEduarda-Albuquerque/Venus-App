<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'tbusuario';
    protected $primaryKey = 'codUsuario';

    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAtualizacao';

    protected $fillable = [
        'nomeUsuario',
        'apelidoUsuario',
        'emailUsuario',
        'senhaUsuario',
        'dataNascimentoUsuario',
        'cidadeUsuario',
        'ufUsuario',
        'fotoPerfilUsuario',
        'temaUsuario',
        'idiomaUsuario',
        'anonimaPadraoUsuario',
        'statusUsuario',
    ];

    protected $hidden = ['senhaUsuario'];

    protected $casts = [
        'anonimaPadraoUsuario' => 'boolean',
    ];
}
