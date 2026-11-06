<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChamadoMensagem extends Model
{
    protected $table = 'tbchamadomensagem';

    protected $primaryKey = 'codMensagem';

    public $timestamps = false;

    protected $fillable = [
        'codChamado',
        'tipoRemetente',
        'codRemetente',
        'textoMensagem',
        'anexoMensagem',
        'dataMensagem',
    ];

    protected $casts = [
        'dataMensagem' => 'datetime',
    ];

    public function chamado(): BelongsTo
    {
        return $this->belongsTo(
            ChamadoSuporte::class,
            'codChamado',
            'codChamado'
        );
    }
}