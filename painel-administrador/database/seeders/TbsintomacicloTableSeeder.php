<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbsintomacicloTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbsintomaciclo')->delete();
        
        \DB::table('tbsintomaciclo')->insert(array (
            0 => 
            array (
                'codCiclo' => 1,
                'dataRegistro' => '2026-09-03',
                'sintoma' => 'colica',
            ),
        ));
        
        
    }
}