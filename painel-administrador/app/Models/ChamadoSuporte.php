<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChamadoSuporte extends Model
{
    protected $table = 'tbchamadosuporte';

    protected $primaryKey = 'codChamado';

    public $timestamps = false;

    protected $fillable = [
        'codProfissionalSaude',
        'assuntoChamado',
        'descricaoChamado',
        'anexoChamado',
        'statusChamado',
        'canalChamado',
        'motivoChamado',
        'avaliacaoChamado',
    ];

    protected $casts = [
        'dataAbertura' => 'datetime',
        'avaliacaoChamado' => 'integer',
    ];

    public function mensagens(): HasMany
    {
        return $this->hasMany(
            ChamadoMensagem::class,
            'codChamado',
            'codChamado'
        )->orderBy('dataMensagem', 'asc');
    }

    public function profissional(): BelongsTo
    {
        return $this->belongsTo(
            ProfissionalModel::class,
            'codProfissionalSaude',
            'codProfissionalSaude'
        );
    }
}
