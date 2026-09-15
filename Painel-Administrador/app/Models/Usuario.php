<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'tbusuario';
    protected $primaryKey = 'id';

    protected $fillable = ['nomeUsuario', 'emailUsuario', 'senhaUsuario',  ];

    protected $hidden = ['senhaUsuario'];

    /*public function getAuthPassword(){
        return $this->senhaUsuario;
    }*/

    /*public function getAuthPasswordName(){
        return 'senhaUsuario';
    }*/
}
