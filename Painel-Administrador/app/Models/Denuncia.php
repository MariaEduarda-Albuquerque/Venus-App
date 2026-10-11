<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    //
        protected $table = 'tbdenuncia';
    protected $primaryKey = 'codDenuncia';

        const CREATED_AT = 'dataDenuncia';

        protected $fillable = [
        'tipoAlvo',
        'codAlvo',
        'codUsuarioDenunciante',
        'motivoDenuncia',
        'comentarioDenuncia',
        'gravidade',
        'statusDenuncia',
        'dataDenuncia',
    ];

            protected function casts(): array
    {
        return [
            'dataDenuncia'    => 'datetime',
        ];
    }

            public function tbusuario()
        {
            return $this->belongsTo(
                    Usuario::class, 
                    'codUsuarioDenunciante', // Chave estrangeira que está na tabela 'tbconteudo'
                    'codUsuario'  // Chave primária que está na tabela 'profissionais' (ou 'id' se lá for 'id')
                ); 
        }
}
