<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbusuarioTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbusuario')->delete();
        
        \DB::table('tbusuario')->insert(array (
            0 => 
            array (
                'codUsuario' => 1,
                'nomeUsuario' => 'Beatriz Ramos',
                'apelidoUsuario' => 'Bia',
                'biografiaUsuario' => NULL,
                'pronomesUsuario' => NULL,
                'linkUsuario' => NULL,
                'emailUsuario' => 'beatriz.ramos@email.com',
                'telUsuario' => NULL,
                'senhaUsuario' => '$2y$12$pu0e7ncsoYW8bEY9RxTtwe03T.qGW5L.q6hwmAN.xZFd3jWw3bL5G',
                'provedorLoginUsuario' => 'local',
                'googleIdUsuario' => NULL,
                'dataNascimentoUsuario' => '1998-04-22',
                'cidadeUsuario' => 'Sao Paulo',
                'bairroUsuario' => NULL,
                'ufUsuario' => 'SP',
                'fotoPerfilUsuario' => 'perfis/usuarios/1.jpg',
                'temaUsuario' => 'claro',
                'idiomaUsuario' => 'pt-BR',
                'anonimaPadraoUsuario' => 0,
                'statusUsuario' => 'ativa',
                'dataCadastro' => '2026-09-17 18:19:08',
                'dataAtualizacao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}