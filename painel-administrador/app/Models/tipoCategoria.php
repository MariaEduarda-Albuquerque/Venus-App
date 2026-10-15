<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoCategoria extends Model
{
    //
    protected $table = 'codtipocategoria';
    protected $primaryKey = 'codTipoCategoria';

    protected $fillable = [
        'nomeTipoCategoria',
        'descricaoTipoCategoria',
    ];

}
