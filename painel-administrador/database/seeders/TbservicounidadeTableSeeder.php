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
        ));
        
        
    }
}