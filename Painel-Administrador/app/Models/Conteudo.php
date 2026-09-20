<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProfissionalModel;

class Conteudo extends Model
{
    //
    protected $table = 'tbconteudo';

    protected $fillable = [
        'tituloConteudo',
        'corpoConteudo',
        'capaConteudo',
        'tempoLeituraMinutos',
        'codTipoCategoria',
        'codTipoConteudo',
        'codProfissionalSaude',
        'statusConteudo',
        'dataCriacao',
        'dataAtualizacao'
    ];

    public function tbprofissionalsaude()
    {
        return $this->belongsTo(
                    ProfissionalModel::class, 
                    'codProfissionalSaude', // Chave estrangeira que está na tabela 'tbconteudo'
                    'codProfissionalSaude'  // Chave primária que está na tabela 'profissionais' (ou 'id' se lá for 'id')
                );
    }
}
