<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'tbadmin';
    protected $primaryKey = 'codAdmin';
    public $timestamps = false;
    
    protected $fillable = [
        'nomeAdmin', 'emailAdmin', 'telAdmin', 'paisAdmin', 'cidadeAdmin',
        'ufAdmin', 'cepAdmin', 'nrFiscalAdmin', 'temaAdmin', 'senhaAdmin',
        'codPapel', 'duasEtapasAtiva', 'statusConta',
    ];

    protected $hidden = ['senhaAdmin'];

    protected function casts(): array
    {
        return [
            'senhaAdmin' => 'hashed',
            'duasEtapasAtiva' => 'boolean',
            'dataCadastro' => 'datetime',
        ];
    }

    public function getAuthPassword()
    {
        return $this->senhaAdmin;
    }

    //public function getRememberToken() { return null; }
    //public function setRememberToken($value) {}
    //public function getRememberTokenName() { return ''; }

    public function papel()
    {
        return $this->belongsTo(Papel::class, 'codPapel', 'codPapel');
    }
}