<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbeventoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbevento')->delete();
        
        \DB::table('tbevento')->insert(array (
            0 => 
            array (
                'codEvento' => 1,
                'tituloEvento' => 'Roda de conversa: saude menstrual',
                'descricaoEvento' => 'Encontro online para tirar duvidas sobre ciclo menstrual e autocuidado.',
                'bannerEvento' => 'banners/eventos/1.jpg',
                'formatoEvento' => 'online',
                'linkOuEndereco' => 'https://meet.venus.com.br/roda-saude-menstrual',
                'dataHoraEvento' => '2026-10-05 19:00:00',
                'duracaoMinutos' => 90,
                'vagasTotais' => 100,
                'codProfissionalSaude' => 1,
            ),
        ));
        
        
    }
}