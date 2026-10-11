<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TblembreteremedioTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tblembreteremedio')->delete();
        
        \DB::table('tblembreteremedio')->insert(array (
            0 => 
            array (
                'codLembreteRemedio' => 1,
                'nomeLembreteRemedio' => 'Acido folico',
                'dosagemLembreteRemedio' => '5 mg - 1 comprimido',
                'horarioLembreteRemedio' => '08:00:00',
                'codUsuario' => 1,
                'ativo' => 1,
            ),
        ));
        
        
    }
}