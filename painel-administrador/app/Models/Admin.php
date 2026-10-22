<?php

namespace App\Models;
use App\Models\PapelModel;
use App\Models\DenunciaAcao;
use App\Models\ConteudoAdmin;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'tbadmin';
    protected $primaryKey = 'codAdmin';
    public $timestamps = false;
    
    protected $fillable = [
        'nomeAdmin', 'emailAdmin', 'telAdmin', 'paisAdmin', 'cidadeAdmin',
        'ufAdmin', 'cepAdmin', 'nrFiscalAdmin', 'temaAdmin', 'senhaAdmin',
        'codPapel', 'duasEtapasAtiva', 'statusConta', 'codpostalAdmin',
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
        return $this->belongsTo(PapelModel::class, 'codPapel', 'codPapel');
    }

    public function denunciaAcoes()
    {
        return $this->hasMany(DenunciaAcao::class, 'codAdmin', 'codAdmin');
    }
    public function ConteudoAdmin()
    {
        return $this->hasMany(ConteudoAdmin::class, 'codAdmin', 'codAdmin');
    }
}