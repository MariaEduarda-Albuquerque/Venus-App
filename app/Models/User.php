<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'tbprofissionalsaude';
    
    protected $primaryKey = 'codProfissionalSaude';
    
    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAtualizacao';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nomeProfissionalSaude',
        'emailProfissionalSaude',
        'telProfissionalSaude',
        'senhaProfissionalSaude',
        'duasEtapasAtiva',
        'provedorLoginProfissional',
        'googleIdProfissional',
        'categoriaProfissional',
        'especialidadeProfissionalSaude',
        'apresentacaoProfissional',
        'paisProfissional',
        'cidadeProfissional',
        'ufProfissional',
        'cepProfissional',
        'nrFiscalProfissional',
        'fotoPerfilProfissional',
        'statusVerificacao',
        'statusConta',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'senhaProfissionalSaude',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'duasEtapasAtiva' => 'boolean',
        ];
    }
}
