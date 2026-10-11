<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbunidadeservicoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbunidadeservico')->delete();
        
        \DB::table('tbunidadeservico')->insert(array (
            0 => 
            array (
                'codUnidade' => 1,
                'codServico' => 1,
            ),
        ));
        
        
    }
}