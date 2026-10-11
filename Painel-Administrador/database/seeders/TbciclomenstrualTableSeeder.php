<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbciclomenstrualTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbciclomenstrual')->delete();
        
        \DB::table('tbciclomenstrual')->insert(array (
            0 => 
            array (
                'codCiclo' => 1,
                'codUsuario' => 1,
                'dataInicio' => '2026-09-03',
                'duracaoDias' => 28,
            ),
        ));
        
        
    }
}