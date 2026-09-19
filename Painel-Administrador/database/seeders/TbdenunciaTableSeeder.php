<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbdenunciaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbdenuncia')->delete();
        
        \DB::table('tbdenuncia')->insert(array (
            0 => 
            array (
                'codDenuncia' => 1,
                'tipoAlvo' => 'forum_publicacao',
                'codAlvo' => 1,
                'codUsuarioDenunciante' => 1,
                'motivoDenuncia' => 'Informacao de saude possivelmente incorreta',
                'comentarioDenuncia' => 'A publicacao sugere interromper medicacao sem orientacao medica.',
                'gravidade' => 'alta',
                'statusDenuncia' => 'resolvida',
                'dataDenuncia' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}