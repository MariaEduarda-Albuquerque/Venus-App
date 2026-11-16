<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $table = 'tbmensagem';
    protected $primaryKey = 'codMensagem';
    public $timestamps = false;

    protected $fillable = ['codUsuario', 'codProfissionalSaude', 'remetenteMensagem', 'textoMensagem', 'lidaMensagem'];

    protected $casts = [
        'lidaMensagem' => 'boolean',
        'dataEnvio' => 'datetime',
    ];
}
