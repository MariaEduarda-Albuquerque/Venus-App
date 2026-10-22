<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConteudoAdmin extends Model
{
    //
    protected $table = 'tbconteudoadmin';
    protected $primaryKey = 'codConteudoAdmin';
    public $timestamps = false;
    
    const CREATED_AT = 'dataDecisao';

    protected $fillable = [
        'codConteudo', 'codAdmin', 'decisao', 'motivoDecisao', 'dataDecisao'
    ];

        protected function casts(): array
    {
        return [
            'dataDecisao' => 'datetime',
        ];
    }

}
