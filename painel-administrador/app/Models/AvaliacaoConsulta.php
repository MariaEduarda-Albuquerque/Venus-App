<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvaliacaoConsulta extends Model
{
    //
    protected $table = 'tbavaliacaoconsulta';
    protected $primaryKey = 'codConsulta';

    const CREATED_AT = 'dataAvaliacao';

        protected $fillable = [
        'codConsulta',
        'nota',
        'comentario',
        'dataAvaliacao',
    ];

    protected function casts(): array
    {
        return [
            'dataAvaliacao'    => 'datetime',
        ];
    }
}
