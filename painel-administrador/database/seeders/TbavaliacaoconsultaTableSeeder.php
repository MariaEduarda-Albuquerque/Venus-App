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
            1 => 
            array (
                'codConsulta' => 2,
                'nota' => 5,
                'comentario' => 'Tirou todas as minhas duvidas com paciencia.',
                'dataAvaliacao' => '2026-09-24 15:00:00',
            ),
            2 => 
            array (
                'codConsulta' => 3,
                'nota' => 5,
                'comentario' => 'Me senti ouvida e sem julgamentos.',
                'dataAvaliacao' => '2026-09-22 18:30:00',
            ),
            3 => 
            array (
                'codConsulta' => 4,
                'nota' => 4,
                'comentario' => 'Resposta clara, mas demorou um pouco.',
                'dataAvaliacao' => '2026-09-30 12:00:00',
            ),
            4 => 
            array (
                'codConsulta' => 5,
                'nota' => 5,
                'comentario' => 'Fiquei mais tranquila em saber dos meus direitos.',
                'dataAvaliacao' => '2026-09-29 09:30:00',
            ),
            5 => 
            array (
                'codConsulta' => 6,
                'nota' => 5,
                'comentario' => 'Muito atenciosa, explicou cada exame.',
                'dataAvaliacao' => '2026-10-01 10:30:00',
            ),
            6 => 
            array (
                'codConsulta' => 7,
                'nota' => 5,
                'comentario' => 'A tecnica de aterramento ja me ajudou.',
                'dataAvaliacao' => '2026-10-08 19:30:00',
            ),
            7 => 
            array (
                'codConsulta' => 8,
                'nota' => 4,
                'comentario' => 'Atendimento organizado e esclarecedor.',
                'dataAvaliacao' => '2026-10-14 16:00:00',
            ),
            8 => 
            array (
                'codConsulta' => 14,
                'nota' => 4,
                'comentario' => 'Gostei do plano de rotina, vou testar.',
                'dataAvaliacao' => '2026-10-13 18:30:00',
            ),
            9 => 
            array (
                'codConsulta' => 15,
                'nota' => 3,
                'comentario' => 'Resposta boa, mas achei meio direta.',
                'dataAvaliacao' => '2026-10-10 17:00:00',
            ),
            10 => 
            array (
                'codConsulta' => 16,
                'nota' => 5,
                'comentario' => 'Esclareceu tudo de forma simples.',
                'dataAvaliacao' => '2026-10-15 20:00:00',
            ),
        ));
        
        
    }
}