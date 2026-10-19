<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbservicounidadeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbservicounidade')->delete();
        
        \DB::table('tbservicounidade')->insert(array (
            0 => 
            array (
                'codServico' => 1,
                'nomeServico' => 'Consulta ginecologica',
            ),
            1 => 
            array (
                'codServico' => 2,
                'nomeServico' => 'Teste de IST',
            ),
            2 => 
            array (
                'codServico' => 3,
                'nomeServico' => 'Pre-natal',
            ),
            3 => 
            array (
                'codServico' => 4,
                'nomeServico' => 'Saude mental',
            ),
            4 => 
            array (
                'codServico' => 5,
                'nomeServico' => 'Vacina',
            ),
            5 => 
            array (
                'codServico' => 6,
                'nomeServico' => 'Anticoncepcao',
            ),
            6 => 
            array (
                'codServico' => 7,
                'nomeServico' => 'Atendimento a vitimas de violencia',
            ),
            7 => 
            array (
                'codServico' => 8,
                'nomeServico' => 'Distribuicao de preservativos',
            ),
            8 => 
            array (
                'codServico' => 9,
                'nomeServico' => 'Exame preventivo (Papanicolau)',
            ),
            9 => 
            array (
                'codServico' => 10,
                'nomeServico' => 'Orientacao socioassistencial',
            ),
            10 => 
            array (
                'codServico' => 11,
                'nomeServico' => 'Medicamentos gratuitos',
            ),
        ));
        
        
    }
}