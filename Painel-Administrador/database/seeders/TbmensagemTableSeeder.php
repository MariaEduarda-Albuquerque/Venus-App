<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbmensagemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbmensagem')->delete();
        
        \DB::table('tbmensagem')->insert(array (
            0 => 
            array (
                'codMensagem' => 1,
                'codConsulta' => 1,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Boa tarde, doutora! Minhas colicas voltaram a piorar neste mes.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-10 14:03:00',
                'dataEnvio' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}