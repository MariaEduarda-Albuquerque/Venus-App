<?php

// ONDE SALVAR: app/Mail/CodigoRedefinicaoSenha.php
//
// Se a pasta app/Mail ainda não existir no seu projeto, pode criar
// normalmente — o Laravel não se importa, ou rode:
//   php artisan make:mail CodigoRedefinicaoSenha
// e depois só substitui o conteúdo por este daqui.

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodigoRedefinicaoSenha extends Mailable
{
    use Queueable, SerializesModels;

    public string $codigo;

    public function __construct(string $codigo)
    {
        $this->codigo = $codigo;
    }

    public function build()
    {
        return $this
            ->subject('Seu código de redefinição de senha - Vênus')
            ->view('emails.codigo-redefinicao')
            ->with([
                'codigo' => $this->codigo,
            ]);
    }
}
