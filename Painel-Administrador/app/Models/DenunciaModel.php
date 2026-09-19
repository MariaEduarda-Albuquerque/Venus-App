<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DenunciaModel extends Model
{
    //
            // Define a tabela do banco
    protected $table = 'tbdenuncia';

    // Define a chave primária
    protected $primaryKey = 'codDenuncia';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'tipoAlvo',
        'codAlvo',
        'codUsuarioDenunciante',
        'motivoDenuncia',
        'comentarioDenuncia',
        'gravidade',
        'statusDenuncia',
        'dataDenuncia'
    ];
}
