<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbavaliacaoconsultaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbavaliacaoconsulta')->delete();
        
        \DB::table('tbavaliacaoconsulta')->insert(array (
            0 => 
            array (
                'codConsulta' => 1,
                'nota' => 5,
                'comentario' => 'Atendimento muito acolhedor e explicativo.',
                'dataAvaliacao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}