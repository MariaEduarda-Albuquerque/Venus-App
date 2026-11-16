<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvaliacaoConsulta extends Model
{
    protected $table = 'tbavaliacaoconsulta';
    protected $primaryKey = 'codAvaliacaoConsulta'; // PK REAL da tabela
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['codConsulta', 'nota', 'comentario'];

    // RELACIONAMENTO QUE FALTAVA:
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'codConsulta', 'codConsulta');
    }
}