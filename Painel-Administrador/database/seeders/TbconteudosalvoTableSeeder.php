<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbconteudosalvoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbconteudosalvo')->delete();
        
        \DB::table('tbconteudosalvo')->insert(array (
            0 => 
            array (
                'codUsuario' => 1,
                'codConteudo' => 1,
                'dataSalvo' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}