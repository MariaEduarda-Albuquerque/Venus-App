<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'tbUsuario';

    protected $primaryKey = 'codUsuario';

    public $timestamps = false;

    protected $fillable = [
        'nomeUsuario',
        'apelidoUsuario',
        'emailUsuario',
        'cpfUsuario',
        'senhaUsuario',
        'dataNascimentoUsuario',
        'cidadeUsuario',
        'ufUsuario',
        'fotoPerfilUsuario',
        'temaUsuario',
        'idiomaUsuario',
        'anonimaPadraoUsuario',
        'preferenciasNotificacaoUsuario',
        'filtrosInteresseUsuario',
        'visibilidadePerfilUsuario',
        'mostrarBioUsuario',
        'permitirApoioUsuario',
        'ocultarSensivelUsuario',
        'tamanhoFonteUsuario',
        'altoContrasteUsuario',
        'statusUsuario',
    ];

    protected $casts = [
        'preferenciasNotificacaoUsuario' => 'array',
        'filtrosInteresseUsuario' => 'array',
        'anonimaPadraoUsuario' => 'boolean',
        'mostrarBioUsuario' => 'boolean',
        'permitirApoioUsuario' => 'boolean',
        'ocultarSensivelUsuario' => 'boolean',
        'altoContrasteUsuario' => 'boolean',
        'tamanhoFonteUsuario' => 'float',
    ];

    protected $hidden = [
        'senhaUsuario',
    ];
}