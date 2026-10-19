<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AtendimentoModel extends Model
{
    protected $table = 'tbatendimento';
    protected $primaryKey = 'codAtendimento';

    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAtualizacao';

    protected $fillable = [
        'codProfissionalSaude',
        'codUsuaria',
        'tipoAtendimento',
        'tempoRespostaMinutos',
        'avaliacao',
    ];

    protected function casts(): array
    {
        return [
            'dataCadastro'    => 'datetime',
            'dataAtualizacao' => 'datetime',
        ];
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