<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoConteudo extends Model
{
    protected $table = 'tbtipoconteudo';
    protected $primaryKey = 'codTipoConteudo';
    public $timestamps = false;

    protected $fillable = ['descricaoTipoConteudo'];
}
