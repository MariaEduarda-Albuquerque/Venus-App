<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChamadoSuporte extends Model
{
    //
    protected $table = 'tbchamadosuporte';
    protected $primaryKey = 'codChamado';

    const CREATED_AT = 'dataAbertura';

    protected $fillable = [
        'codProfissionalSaude',
        'assuntoChamado',
        'descricaoChamado',
        'anexoChamado',
        'statusChamado',
        'canalChamado',
        'motivoChamado',
        'avaliacaoChamado',
        'dataAbertura',
    ];

    protected function casts(): array
    {
        return [
            'dataAbertura'    => 'datetime',
        ];
    }
}
