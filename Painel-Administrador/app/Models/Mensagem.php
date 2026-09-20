<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    //
            // Define a tabela do banco
    protected $table = 'tbmensagem';

    // Define a chave primária
    protected $primaryKey = 'codMensagem';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'codConsulta',
        'remetenteTipo',
        'telProfissionalSaude',
        'textoMensagem',
        'anexoMensagem',
        'lidaEm',
        'dataEnvio',
    ];

        public function tbUsuario()
        {
            return $this->belongsTo(
                    Mensagem::class, 
                    'codAlvo', // Chave estrangeira que está na tabela 'tbconteudo'
                    'codMensagem'  // Chave primária que está na tabela 'profissionais' (ou 'id' se lá for 'id')
                ); 
        }
}
