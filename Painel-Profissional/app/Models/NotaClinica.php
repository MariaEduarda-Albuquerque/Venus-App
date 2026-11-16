<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaClinica extends Model
{
    protected $table = 'tbnotaclinica';
    protected $primaryKey = 'codNota';

    const CREATED_AT = 'dataCriacao';
    const UPDATED_AT = null;

    protected $fillable = ['codConsulta', 'codUsuario', 'codProfissionalSaude', 'textoNota'];

    protected $casts = [
        'dataCriacao' => 'datetime',
    ];

    // Notas são privadas: sempre buscar com ->doProfissional(id)
    public function scopeDoProfissional($query, $codProfissional)
    {
        return $query->where('codProfissionalSaude', $codProfissional);
    }

    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'codConsulta', 'codConsulta');
    }
}
