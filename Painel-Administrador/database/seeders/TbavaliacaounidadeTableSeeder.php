<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbavaliacaounidadeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbavaliacaounidade')->delete();
        
        \DB::table('tbavaliacaounidade')->insert(array (
            0 => 
            array (
                'codAvaliacao' => 1,
                'codUnidade' => 1,
                'codUsuario' => 1,
                'nota' => 4,
                'lotacaoPercebida' => 'moderado',
                'comentario' => 'Atendimento organizado, esperei cerca de 30 minutos.',
                'dataAvaliacao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}