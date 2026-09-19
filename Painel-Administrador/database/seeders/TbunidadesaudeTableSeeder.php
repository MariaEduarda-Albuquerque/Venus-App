<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbunidadesaudeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbunidadesaude')->delete();
        
        \DB::table('tbunidadesaude')->insert(array (
            0 => 
            array (
                'codUnidade' => 1,
                'nomeUnidade' => 'UBS Jardim Sao Paulo',
                'tipoUnidade' => 'UBS',
                'endereco' => 'Rua Deputado Emilio Carlos, 1200 - Jardim Sao Paulo, Sao Paulo - SP',
                'latitude' => '-23.4921000',
                'longitude' => '-46.6425000',
            'telefone' => '(11)3981-4455',
                'horarioFuncionamento' => 'Segunda a sexta, das 07h as 19h',
            ),
        ));
        
        
    }
}