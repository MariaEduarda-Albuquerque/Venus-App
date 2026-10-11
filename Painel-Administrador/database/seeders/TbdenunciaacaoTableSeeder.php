<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbdenunciaacaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbdenunciaacao')->delete();
        
        \DB::table('tbdenunciaacao')->insert(array (
            0 => 
            array (
                'codDenunciaAcao' => 1,
                'codDenuncia' => 1,
                'codAdmin' => 1,
                'acaoTomada' => 'advertir',
                'justificativa' => 'Autora advertida e orientada sobre as regras da comunidade.',
                'dataAcao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}