<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfissionalModel extends Model
{
    //
        // Define a tabela do banco
    protected $table = 'tbprofissionalsaude';

    // Define a chave primária
    protected $primaryKey = 'codProfissionalSaude';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nomeProfissionalSaude',
        'emailProfissionalSaude',
        'telProfissionalSaude',
        'senhaProfissionalSaude',
    ];
}
