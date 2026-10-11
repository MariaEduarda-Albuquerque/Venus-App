<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PapelModel extends Model
{
    protected $table = 'tbpapel';
    protected $primaryKey = 'codPapel';
    public $timestamps = false;

    protected $fillable = ['nomePapel', 'descricaoPapel'];
}
