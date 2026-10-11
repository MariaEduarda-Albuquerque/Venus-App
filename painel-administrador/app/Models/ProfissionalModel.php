<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfissionalModel extends Model
{
    protected $table = 'tbprofissionalsaude';
    protected $primaryKey = 'codProfissionalSaude';

    // A tabela usa dataCadastro / dataAtualizacao, não created_at / updated_at
    const CREATED_AT = 'dataCadastro';
    const UPDATED_AT = 'dataAtualizacao';

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
        'comprovanteConselhoClasseProfissional',
        'documentoComplementarProfissional',
    ];

    protected $hidden = ['senhaProfissionalSaude'];

    protected function casts(): array
    {
        return [
            'duasEtapasAtiva' => 'boolean',
            'dataCadastro'    => 'datetime',
            'dataAtualizacao' => 'datetime',
        ];
    }
}