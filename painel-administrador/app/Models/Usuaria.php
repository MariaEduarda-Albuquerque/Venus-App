<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuaria extends Model
{
    //
        protected $table = 'tbusuario';
    protected $primaryKey = 'codUsuario';

    // A tabela usa dataCadastro / dataAtualizacao, não created_at / updated_at
    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAtualizacao';

    protected $fillable = [
        'nomeUsuario',
        'apelidoUsuario',
        'biografiaUsuario',
        'pronomesUsuario',
        'linkUsuario',
        'emailUsuario',
        'telUsuario',
        'senhaUsuario',
        'provedorLoginUsuario',
        'googleIdUsuario',
        'dataNascimentoUsuario',
        'cidadeUsuario',
        'bairroUsuario',
        'ufUsuario',
        'fotoPerfilUsuario',
        'temaUsuario',
        'idiomaUsuario',
        'anonimaPadraoUsuario',
        'statusUsuario',
        'dataCadastro',
        'dataAtualizacao',
    ];

    protected $hidden = ['senhaUsuario'];


        protected function casts(): array
    {
        return [
            'dataCadastro'    => 'datetime',
            'dataAtualizacao' => 'datetime',
        ];
    }
}
