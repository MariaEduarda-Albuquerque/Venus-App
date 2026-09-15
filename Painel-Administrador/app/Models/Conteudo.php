<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    //
    protected $table = 'tbconteudo';

    protected $fillable = [
        'tituloConteudo',
        'corpoConteudo',
        'tbtipocategoria_id',
        'tbtipoconteudo_id',
    ];
}
