<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbtipodiarioTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbtipodiario')->delete();
        
        \DB::table('tbtipodiario')->insert(array (
            0 => 
            array (
                'codTipoDiario' => 1,
                'descricaoTipoDiario' => 'Diario emocional',
            ),
        ));
        
        
    }
}