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
            1 => 
            array (
                'codAvaliacao' => 2,
                'codUnidade' => 1,
                'codUsuario' => 7,
                'nota' => 5,
                'lotacaoPercebida' => 'livre',
                'comentario' => 'Cheguei cedo e fui atendida rapido. Equipe muito gentil.',
                'dataAvaliacao' => '2026-09-21 09:10:00',
            ),
            2 => 
            array (
                'codAvaliacao' => 3,
                'codUnidade' => 1,
                'codUsuario' => 16,
                'nota' => 4,
                'lotacaoPercebida' => 'moderado',
                'comentario' => 'Pre-natal bem acompanhado, so a fila da recepcao que demora.',
                'dataAvaliacao' => '2026-10-02 11:45:00',
            ),
            3 => 
            array (
                'codAvaliacao' => 4,
                'codUnidade' => 2,
                'codUsuario' => 13,
                'nota' => 3,
                'lotacaoPercebida' => 'cheio',
                'comentario' => 'Atendimento bom, mas a espera passou de 1 hora.',
                'dataAvaliacao' => '2026-09-25 13:20:00',
            ),
            4 => 
            array (
                'codAvaliacao' => 5,
                'codUnidade' => 2,
                'codUsuario' => 3,
                'nota' => 4,
                'lotacaoPercebida' => 'moderado',
                'comentario' => 'Consegui fazer o preventivo no mesmo dia.',
                'dataAvaliacao' => '2026-09-29 15:05:00',
            ),
            5 => 
            array (
                'codAvaliacao' => 6,
                'codUnidade' => 3,
                'codUsuario' => 2,
                'nota' => 5,
                'lotacaoPercebida' => 'livre',
                'comentario' => 'Fui bem recebida e tiraram todas as minhas duvidas sobre metodos contraceptivos.',
                'dataAvaliacao' => '2026-09-12 10:30:00',
            ),
            6 => 
            array (
                'codAvaliacao' => 7,
                'codUnidade' => 3,
                'codUsuario' => 17,
                'nota' => 2,
                'lotacaoPercebida' => 'cheio',
                'comentario' => 'Muita demora e faltou informacao na recepcao.',
                'dataAvaliacao' => '2026-09-26 14:00:00',
            ),
            7 => 
            array (
                'codAvaliacao' => 8,
                'codUnidade' => 4,
                'codUsuario' => 9,
                'nota' => 4,
                'lotacaoPercebida' => 'moderado',
                'comentario' => 'Enfermagem atenciosa no pre-natal.',
                'dataAvaliacao' => '2026-10-03 08:50:00',
            ),
            8 => 
            array (
                'codAvaliacao' => 9,
                'codUnidade' => 5,
                'codUsuario' => 5,
                'nota' => 3,
                'lotacaoPercebida' => 'cheio',
                'comentario' => 'Precisei voltar duas vezes para conseguir marcar exame.',
                'dataAvaliacao' => '2026-09-19 17:40:00',
            ),
            9 => 
            array (
                'codAvaliacao' => 10,
                'codUnidade' => 6,
                'codUsuario' => 14,
                'nota' => 4,
                'lotacaoPercebida' => 'moderado',
                'comentario' => 'Atendimento de urgencia foi rapido e resolutivo.',
                'dataAvaliacao' => '2026-10-01 22:10:00',
            ),
            10 => 
            array (
                'codAvaliacao' => 11,
                'codUnidade' => 8,
                'codUsuario' => 10,
                'nota' => 5,
                'lotacaoPercebida' => 'livre',
                'comentario' => 'Acolhimento humano e sem julgamentos. Me senti segura.',
                'dataAvaliacao' => '2026-10-05 16:25:00',
            ),
            11 => 
            array (
                'codAvaliacao' => 12,
                'codUnidade' => 8,
                'codUsuario' => 12,
                'nota' => 4,
                'lotacaoPercebida' => 'moderado',
                'comentario' => 'Equipe muito atenciosa, mas a sala de espera e pequena.',
                'dataAvaliacao' => '2026-10-07 10:05:00',
            ),
            12 => 
            array (
                'codAvaliacao' => 13,
                'codUnidade' => 10,
                'codUsuario' => 20,
                'nota' => 5,
                'lotacaoPercebida' => 'livre',
                'comentario' => 'Me orientaram sobre beneficios e encaminharam para a rede de apoio.',
                'dataAvaliacao' => '2026-10-08 14:15:00',
            ),
            13 => 
            array (
                'codAvaliacao' => 14,
                'codUnidade' => 11,
                'codUsuario' => 7,
                'nota' => 4,
                'lotacaoPercebida' => 'moderado',
                'comentario' => 'Atendimento da assistente social foi muito esclarecedor.',
                'dataAvaliacao' => '2026-10-09 09:30:00',
            ),
            14 => 
            array (
                'codAvaliacao' => 15,
                'codUnidade' => 12,
                'codUsuario' => 11,
                'nota' => 4,
                'lotacaoPercebida' => 'livre',
                'comentario' => 'Consegui retirar o medicamento sem fila.',
                'dataAvaliacao' => '2026-10-10 12:00:00',
            ),
            15 => 
            array (
                'codAvaliacao' => 16,
                'codUnidade' => 7,
                'codUsuario' => 18,
                'nota' => 3,
                'lotacaoPercebida' => 'cheio',
                'comentario' => 'Demorou, mas o atendimento medico foi bom.',
                'dataAvaliacao' => '2026-10-11 20:45:00',
            ),
        ));
        
        
    }
}