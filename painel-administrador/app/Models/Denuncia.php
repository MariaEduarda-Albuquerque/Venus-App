<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $table = 'tbdenuncia';

    protected $primaryKey = 'codDenuncia';

    const CREATED_AT = 'dataDenuncia';
    const UPDATED_AT = null;

    protected $fillable = [
        'tipoAlvo',
        'codAlvo',
        'codUsuarioDenunciante',
        'motivoDenuncia',
        'comentarioDenuncia',
        'gravidade',
        'statusDenuncia',
        'dataDenuncia',
    ];

    protected function casts(): array
    {
        return [
            'dataDenuncia' => 'datetime',
        ];
    }

    public function tbusuario()
    {
        return $this->belongsTo(
            Usuaria::class,
            'codUsuarioDenunciante',
            'codUsuario'
        );
    }
}
