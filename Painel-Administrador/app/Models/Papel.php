<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Papel extends Model
{
    //

        protected $table = 'tbpapel';

    // Define a chave primária
    protected $primaryKey = 'codPapel';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nomePapel',
        'descricaoPapel'
    ];
}
