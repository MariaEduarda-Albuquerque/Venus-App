<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbdiarioTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbdiario')->delete();
        
        \DB::table('tbdiario')->insert(array (
            0 => 
            array (
                'codDiario' => 1,
                'tituloDiario' => 'Semana puxada no trabalho',
                'descricaoDiario' => 'Me senti sobrecarregada, mas consegui manter a rotina de sono.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-12',
                'codUsuario' => 1,
                'codTipoDiario' => 1,
            ),
        ));
        
        
    }
}