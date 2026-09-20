<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdmModel extends Authenticatable
{
    use Notifiable;

    // Define a tabela do banco
    protected $table = 'tbadmin';

    // Define a chave primária
    protected $primaryKey = 'codAdmin';

    public $timestamps = false;

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nomeAdmin',
        'emailAdmin',
        'telAdmin',
        'paisAdmin',
        'cidadeAdmin',
        'ufAdmin',
        'cepAdmin',
        'nrFiscalAdmin',
        'temaAdmin',
        'senhaAdmin',
        'codPapel',
        'duasEtapasAtiva',
        'statusConta',
        'dataCadastro',
    ];

    // Oculta a senha no retorno de arrays/JSON
    protected $hidden = [
        'senhaAdmin',
    ];

    // O Laravel espera a coluna 'password' por padrão. Diga a ele qual coluna usar:
    public function getAuthPassword()
    {
        return $this->senhaAdmin;
    }

            public function tbpapel()
        {
            return $this->belongsTo(
                    Papel::class, 
                    'codPapel', // Chave estrangeira que está na tabela 'tbconteudo'
                    'codPapel'  // Chave primária que está na tabela 'profissionais' (ou 'id' se lá for 'id')
                ); 
        }
}
