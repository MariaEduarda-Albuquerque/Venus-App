<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataSaude extends Model
{
    protected $table = 'tbdatasaude';
    protected $primaryKey = 'codDataSaude';
    public $timestamps = false;

    protected $fillable = [
        'nomeDataSaude',
        'mesDataSaude',
        'diaDataSaude',
        'corDataSaude',
        'pautaDataSaude',
        'codTipoCategoria',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(TipoCategoria::class, 'codTipoCategoria', 'codTipoCategoria');
    }
}
