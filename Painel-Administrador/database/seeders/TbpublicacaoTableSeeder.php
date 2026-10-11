<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbpublicacaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbpublicacao')->delete();
        
        \DB::table('tbpublicacao')->insert(array (
            0 => 
            array (
                'codPublicacao' => 1,
                'tituloPublicacao' => 'Como identificar sinais de ansiedade no dia a dia',
                'descricaoPublicacao' => 'Um guia rapido com os principais sinais de alerta e orientacoes de autocuidado.',
                'codConteudo' => 1,
                'dataPublicacao' => '2026-09-17 18:19:08',
                'visualizacoes' => 342,
                'tempoMedioLeituraSeg' => 215,
            ),
        ));
        
        
    }
}