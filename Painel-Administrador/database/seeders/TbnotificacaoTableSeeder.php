<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbnotificacaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbnotificacao')->delete();
        
        \DB::table('tbnotificacao')->insert(array (
            0 => 
            array (
                'codNotificacao' => 1,
                'destinatarioTipo' => 'usuaria',
                'codDestinatario' => 1,
                'tipoNotificacao' => 'consulta_confirmada',
                'tituloNotificacao' => 'Sua consulta foi confirmada',
                'corpoNotificacao' => 'A consulta com a Dra. Helena Costa esta confirmada para 10/09/2026 as 14h.',
                'lida' => 0,
                'dataEnvio' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}