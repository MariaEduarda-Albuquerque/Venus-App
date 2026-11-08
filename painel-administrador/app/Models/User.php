<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbprofissionalsaude';

    protected $primaryKey = 'codProfissionalSaude';

    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAtualizacao';

    protected $fillable = [
        'nomeProfissionalSaude',
        'emailProfissionalSaude',
        'senhaProfissionalSaude',
        'telProfissionalSaude',
        'categoriaProfissional',
        'especialidadeProfissionalSaude',
        'apresentacaoProfissional',
        'statusVerificacao',
        'statusConta',
    ];

    protected $hidden = [
        'senhaProfissionalSaude',
    ];

    protected function casts(): array
    {
        return [
            'senhaProfissionalSaude' => 'hashed',
            'dataCadastro' => 'datetime',
            'dataAtualizacao' => 'datetime',
            'duasEtapasAtiva' => 'boolean',
        ];
    }

    public function getAuthPasswordName(): string
    {
        return 'senhaProfissionalSaude';
    }

    public function getAuthPassword(): string
    {
        return $this->senhaProfissionalSaude;
    }
}