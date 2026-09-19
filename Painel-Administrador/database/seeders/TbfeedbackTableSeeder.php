<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbfeedbackTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbfeedback')->delete();
        
        \DB::table('tbfeedback')->insert(array (
            0 => 
            array (
                'codFeedback' => 1,
                'autorTipo' => 'usuaria',
                'codUsuario' => 1,
                'codProfissionalSaude' => NULL,
                'nota' => 5,
                'categoriaFeedback' => 'elogio',
                'assuntoFeedback' => NULL,
                'comentario' => 'O diario de humor me ajudou muito a perceber padroes ao longo do mes.',
                'statusFeedback' => 'respondido',
                'dataFeedback' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}