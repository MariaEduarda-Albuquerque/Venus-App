<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DenunciaModel extends Model
{
    //
            // Define a tabela do banco
    protected $table = 'tbdenuncia';

    // Define a chave primária
    protected $primaryKey = 'codDenuncia';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'tipoAlvo',
        'codAlvo',
        'codUsuarioDenunciante',
        'motivoDenuncia',
        'comentarioDenuncia',
        'gravidade',
        'statusDenuncia',
        'dataDenuncia'
    ];

        public function tbusuario()
        {
            return $this->belongsTo(
                    Usuario::class, 
                    'codUsuarioDenunciante', // Chave estrangeira que está na tabela 'tbconteudo'
                    'codUsuario'  // Chave primária que está na tabela 'profissionais' (ou 'id' se lá for 'id')
                ); 
        }

        public function tbmensagem()
        {
            return $this->belongsTo(
                    Mensagem::class, 
                    'codAlvo', // Chave estrangeira que está na tabela 'tbconteudo'
                    'codMensagem'  // Chave primária que está na tabela 'profissionais' (ou 'id' se lá for 'id')
                ); 
        }
}
