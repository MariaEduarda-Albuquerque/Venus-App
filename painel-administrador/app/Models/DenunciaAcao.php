<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DenunciaAcao extends Model
{
    protected $table = 'tbdenunciaacao';

    protected $primaryKey = 'codDenunciaAcao';

    const CREATED_AT = 'dataAcao';
    const UPDATED_AT = null;

    protected $fillable = [
        'codDenuncia',
        'codAdmin',
        'acaoTomada',
        'justificativa',
        'dataAcao',
    ];

    protected function casts(): array
    {
        return [
            'dataAcao' => 'datetime',
        ];
    }

    public function tbdenuncia()
    {
        return $this->belongsTo(
            Denuncia::class,
            'codDenuncia',
            'codDenuncia'
        );
    }
}
