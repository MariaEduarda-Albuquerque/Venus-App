<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suporte extends Model
{
    protected $table = 'tbsuporte';
    protected $primaryKey = 'idSuporte';

    protected $fillable = [
        'codProfissionalSaude',
        'descricaoSuporte',
        'statusSuporte',
    ];
}