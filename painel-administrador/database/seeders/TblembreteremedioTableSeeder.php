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
            1 => 
            array (
                'codLembreteRemedio' => 2,
                'nomeLembreteRemedio' => 'Pilula anticoncepcional',
                'dosagemLembreteRemedio' => '1 comprimido',
                'horarioLembreteRemedio' => '21:00:00',
                'codUsuario' => 3,
                'ativo' => 1,
            ),
            2 => 
            array (
                'codLembreteRemedio' => 3,
                'nomeLembreteRemedio' => 'Pilula anticoncepcional',
                'dosagemLembreteRemedio' => '1 comprimido',
                'horarioLembreteRemedio' => '08:30:00',
                'codUsuario' => 2,
                'ativo' => 1,
            ),
            3 => 
            array (
                'codLembreteRemedio' => 4,
                'nomeLembreteRemedio' => 'Sulfato ferroso',
                'dosagemLembreteRemedio' => '40 mg de ferro elementar',
                'horarioLembreteRemedio' => '12:30:00',
                'codUsuario' => 12,
                'ativo' => 1,
            ),
            4 => 
            array (
                'codLembreteRemedio' => 5,
                'nomeLembreteRemedio' => 'Acido folico',
                'dosagemLembreteRemedio' => '5 mg - 1 comprimido',
                'horarioLembreteRemedio' => '09:00:00',
                'codUsuario' => 9,
                'ativo' => 1,
            ),
            5 => 
            array (
                'codLembreteRemedio' => 6,
                'nomeLembreteRemedio' => 'Sulfato ferroso',
                'dosagemLembreteRemedio' => '40 mg de ferro elementar',
                'horarioLembreteRemedio' => '19:00:00',
                'codUsuario' => 9,
                'ativo' => 1,
            ),
            6 => 
            array (
                'codLembreteRemedio' => 7,
                'nomeLembreteRemedio' => 'Acido folico',
                'dosagemLembreteRemedio' => '5 mg - 1 comprimido',
                'horarioLembreteRemedio' => '08:15:00',
                'codUsuario' => 16,
                'ativo' => 1,
            ),
            7 => 
            array (
                'codLembreteRemedio' => 8,
                'nomeLembreteRemedio' => 'Vitamina D',
                'dosagemLembreteRemedio' => '2000 UI - 1 capsula',
                'horarioLembreteRemedio' => '09:30:00',
                'codUsuario' => 14,
                'ativo' => 1,
            ),
            8 => 
            array (
                'codLembreteRemedio' => 9,
                'nomeLembreteRemedio' => 'Injetavel trimestral',
                'dosagemLembreteRemedio' => '1 aplicacao na UBS',
                'horarioLembreteRemedio' => '10:00:00',
                'codUsuario' => 7,
                'ativo' => 1,
            ),
            9 => 
            array (
                'codLembreteRemedio' => 10,
                'nomeLembreteRemedio' => 'Pilula anticoncepcional',
                'dosagemLembreteRemedio' => '1 comprimido',
                'horarioLembreteRemedio' => '22:00:00',
                'codUsuario' => 18,
                'ativo' => 1,
            ),
            10 => 
            array (
                'codLembreteRemedio' => 11,
                'nomeLembreteRemedio' => 'Vitamina D',
                'dosagemLembreteRemedio' => '1000 UI - 1 capsula',
                'horarioLembreteRemedio' => '08:00:00',
                'codUsuario' => 5,
                'ativo' => 0,
            ),
            11 => 
            array (
                'codLembreteRemedio' => 12,
                'nomeLembreteRemedio' => 'Anticoncepcional oral',
                'dosagemLembreteRemedio' => '1 comprimido',
                'horarioLembreteRemedio' => '20:00:00',
                'codUsuario' => 8,
                'ativo' => 1,
            ),
        ));
        
        
    }
}