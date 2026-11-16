<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disponibilidade extends Model
{
    protected $table = 'tbdisponibilidade';
    protected $primaryKey = 'codDisponibilidade';
    public $timestamps = false;

    protected $fillable = ['codProfissionalSaude', 'diaSemana', 'horaInicio', 'horaFim', 'tipoAtendimento'];
}
