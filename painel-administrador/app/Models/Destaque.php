<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Destaque extends Model
{
    protected $table = 'tbdestaque';

    protected $primaryKey = 'codDestaque';

    protected $fillable = [
        'admin_id',
        'tituloDestaque',
        'objetivoDestaque',
        'publicoalvoDestaque',
        'faixaetariaDestaque',
        'categoriaDestaque',
        'duracaoDestaque',
        'tagsDestaque',
        'mensagemprincipalDestaque',
        'apresentacaoDestaque',
        'ctaDestaque',
        'fontesreferenciaDestaque',
        'fotoprincipalDestaque',
        'materiaiscomplementaresDestaque',
        'statusDestaque',
        'datainicioDestaque',
        'dataterminoDestaque',
    ];

    protected $casts = [
        'tagsDestaque'                    => 'array',
        'materiaiscomplementaresDestaque' => 'array',
        'datainicioDestaque'              => 'date',
        'dataterminoDestaque'             => 'date',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}