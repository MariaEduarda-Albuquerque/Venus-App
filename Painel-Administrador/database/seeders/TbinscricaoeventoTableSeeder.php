<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbinscricaoeventoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbinscricaoevento')->delete();
        
        \DB::table('tbinscricaoevento')->insert(array (
            0 => 
            array (
                'codEvento' => 1,
                'codUsuario' => 1,
                'dataInscricao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}