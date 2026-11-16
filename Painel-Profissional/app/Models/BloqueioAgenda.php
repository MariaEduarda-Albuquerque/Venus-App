<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueioAgenda extends Model
{
    protected $table = 'tbbloqueioagenda';
    protected $primaryKey = 'codBloqueio';

    const CREATED_AT = 'dataCriacao';
    const UPDATED_AT = null;

    public const MOTIVOS = [
        'compromisso_pessoal' => 'Compromisso pessoal',
        'folga' => 'Folga',
        'ferias' => 'Férias',
        'reuniao' => 'Reunião',
        'outro' => 'Outro',
    ];

    protected $fillable = ['codProfissionalSaude', 'dataBloqueio', 'horaInicio', 'horaFim', 'motivoBloqueio'];

    protected $casts = [
        'dataBloqueio' => 'date:Y-m-d',
    ];
}
