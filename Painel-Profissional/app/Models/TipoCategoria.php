<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCategoria extends Model
{
    protected $table = 'tbtipocategoria';
    protected $primaryKey = 'codTipoCategoria';
    public $timestamps = false;

    protected $fillable = ['nomeTipoCategoria', 'descricaoTipoCategoria'];
}
