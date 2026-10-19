<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    //
    protected $table = 'tbconsulta';
    protected $primaryKey = 'codConsulta';

     const CREATED_AT = 'dataCriacao';

        protected $fillable = [
        'nomeConsulta',
        'tipoConsulta',
        'idTipoAtendimento',
        'statusConsulta',
        'dataHoraAgendada',
        'historicoConsulta',
        'codUsuario',
        'codProfissionalSaude',
        'dataCriacao',
    ];

    protected function casts(): array
    {
        return [
            'dataCriacao'    => 'datetime',
        ];
    }
}
