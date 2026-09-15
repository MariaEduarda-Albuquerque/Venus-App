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
    protected $primaryKey = 'id';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nomeAdmin',
        'emailAdmin',
        'senhaAdmin',
        'tbConteudoAdmin_id',
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
}
