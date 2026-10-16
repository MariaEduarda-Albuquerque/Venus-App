<?php

namespace App\Models;

use App\Models\TipoConteudo;
use App\Models\TipoCategoria;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    //
    protected $table = 'tbconteudo';
    protected $primaryKey = 'codConteudo';

    const CREATED_AT = 'dataCriacao';
    const UPDATED_AT = 'dataAtualizacao';

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
    ];

        protected function casts(): array
    {
        return [
            'dataCriacao'    => 'datetime',
            'dataAtualizacao' => 'datetime',
        ];
    }

        public function tipoConteudo()
    {
        return $this->belongsTo(TipoConteudo::class, 'codTipoConteudo', 'codTipoConteudo');
    }

        public function tipoCategoria()
    {
        return $this->belongsTo(tipoCategoria::class, 'codTipoCategoria', 'codTipoCategoria');
    }

}
    