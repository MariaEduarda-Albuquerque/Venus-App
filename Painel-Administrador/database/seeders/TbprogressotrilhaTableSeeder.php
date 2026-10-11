<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbprogressotrilhaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbprogressotrilha')->delete();
        
        \DB::table('tbprogressotrilha')->insert(array (
            0 => 
            array (
                'codUsuario' => 1,
                'codTrilha' => 1,
                'codConteudo' => 1,
                'concluidoEm' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}