<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'dataAtualizacao',
        'tbtipocategoria_id',
        'tbtipoconteudo_id',
        ''
    ];
}
