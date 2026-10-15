<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Denuncia;

class DenunciaAcao extends Model
{
    //
    protected $table = 'tbdenunciaacao';
    protected $primaryKey = 'codDenunciaAcao';

    const CREATED_AT = 'dataAcao';

        protected $fillable = [
        'codDenuncia',
        'codAdmin',
        'acaoTomada',
        'justificativa',
        'dataAcao',
    ];

    protected function casts(): array
    {
        return [
            'dataAcao'    => 'datetime',
        ];
    }

    public function tbdenuncia()
    {
        return $this->belongsTo(
            Denuncia::class, 
            'codDenuncia', // Chave estrangeira que está na tabela 'tbconteudo'
            'codDenuncia'  // Chave primária que está na tabela 'profissionais' (ou 'id' se lá for 'id')
        ); 
    }
}
