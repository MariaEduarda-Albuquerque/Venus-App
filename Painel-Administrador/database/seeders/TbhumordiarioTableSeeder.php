<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbhumordiarioTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbhumordiario')->delete();
        
        \DB::table('tbhumordiario')->insert(array (
            0 => 
            array (
                'codUsuario' => 1,
                'dataRegistro' => '2026-09-12',
                'humor' => 'bom',
            ),
        ));
        
        
    }
}