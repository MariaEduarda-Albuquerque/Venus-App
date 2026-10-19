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
            1 => 
            array (
                'codCiclo' => 2,
                'codUsuario' => 1,
                'dataInicio' => '2026-07-09',
                'duracaoDias' => 28,
            ),
            2 => 
            array (
                'codCiclo' => 3,
                'codUsuario' => 1,
                'dataInicio' => '2026-08-06',
                'duracaoDias' => 28,
            ),
            3 => 
            array (
                'codCiclo' => 4,
                'codUsuario' => 1,
                'dataInicio' => '2026-10-01',
                'duracaoDias' => NULL,
            ),
            4 => 
            array (
                'codCiclo' => 5,
                'codUsuario' => 2,
                'dataInicio' => '2026-07-20',
                'duracaoDias' => 29,
            ),
            5 => 
            array (
                'codCiclo' => 6,
                'codUsuario' => 2,
                'dataInicio' => '2026-08-18',
                'duracaoDias' => 29,
            ),
            6 => 
            array (
                'codCiclo' => 7,
                'codUsuario' => 2,
                'dataInicio' => '2026-09-16',
                'duracaoDias' => NULL,
            ),
            7 => 
            array (
                'codCiclo' => 8,
                'codUsuario' => 3,
                'dataInicio' => '2026-07-15',
                'duracaoDias' => 27,
            ),
            8 => 
            array (
                'codCiclo' => 9,
                'codUsuario' => 3,
                'dataInicio' => '2026-08-11',
                'duracaoDias' => 28,
            ),
            9 => 
            array (
                'codCiclo' => 10,
                'codUsuario' => 3,
                'dataInicio' => '2026-09-08',
                'duracaoDias' => 29,
            ),
            10 => 
            array (
                'codCiclo' => 11,
                'codUsuario' => 3,
                'dataInicio' => '2026-10-07',
                'duracaoDias' => NULL,
            ),
            11 => 
            array (
                'codCiclo' => 12,
                'codUsuario' => 5,
                'dataInicio' => '2026-07-22',
                'duracaoDias' => 30,
            ),
            12 => 
            array (
                'codCiclo' => 13,
                'codUsuario' => 5,
                'dataInicio' => '2026-08-21',
                'duracaoDias' => 28,
            ),
            13 => 
            array (
                'codCiclo' => 14,
                'codUsuario' => 5,
                'dataInicio' => '2026-09-18',
                'duracaoDias' => NULL,
            ),
            14 => 
            array (
                'codCiclo' => 15,
                'codUsuario' => 7,
                'dataInicio' => '2026-07-28',
                'duracaoDias' => 28,
            ),
            15 => 
            array (
                'codCiclo' => 16,
                'codUsuario' => 7,
                'dataInicio' => '2026-08-25',
                'duracaoDias' => 31,
            ),
            16 => 
            array (
                'codCiclo' => 17,
                'codUsuario' => 7,
                'dataInicio' => '2026-09-25',
                'duracaoDias' => NULL,
            ),
            17 => 
            array (
                'codCiclo' => 18,
                'codUsuario' => 8,
                'dataInicio' => '2026-07-30',
                'duracaoDias' => 26,
            ),
            18 => 
            array (
                'codCiclo' => 19,
                'codUsuario' => 8,
                'dataInicio' => '2026-08-25',
                'duracaoDias' => 27,
            ),
            19 => 
            array (
                'codCiclo' => 20,
                'codUsuario' => 8,
                'dataInicio' => '2026-09-21',
                'duracaoDias' => NULL,
            ),
            20 => 
            array (
                'codCiclo' => 21,
                'codUsuario' => 10,
                'dataInicio' => '2026-07-25',
                'duracaoDias' => 32,
            ),
            21 => 
            array (
                'codCiclo' => 22,
                'codUsuario' => 10,
                'dataInicio' => '2026-08-26',
                'duracaoDias' => 29,
            ),
            22 => 
            array (
                'codCiclo' => 23,
                'codUsuario' => 10,
                'dataInicio' => '2026-09-24',
                'duracaoDias' => NULL,
            ),
            23 => 
            array (
                'codCiclo' => 24,
                'codUsuario' => 12,
                'dataInicio' => '2026-08-10',
                'duracaoDias' => 35,
            ),
            24 => 
            array (
                'codCiclo' => 25,
                'codUsuario' => 12,
                'dataInicio' => '2026-09-14',
                'duracaoDias' => NULL,
            ),
            25 => 
            array (
                'codCiclo' => 26,
                'codUsuario' => 14,
                'dataInicio' => '2026-07-18',
                'duracaoDias' => 28,
            ),
            26 => 
            array (
                'codCiclo' => 27,
                'codUsuario' => 14,
                'dataInicio' => '2026-08-15',
                'duracaoDias' => 28,
            ),
            27 => 
            array (
                'codCiclo' => 28,
                'codUsuario' => 14,
                'dataInicio' => '2026-09-12',
                'duracaoDias' => NULL,
            ),
            28 => 
            array (
                'codCiclo' => 29,
                'codUsuario' => 18,
                'dataInicio' => '2026-08-02',
                'duracaoDias' => 30,
            ),
            29 => 
            array (
                'codCiclo' => 30,
                'codUsuario' => 18,
                'dataInicio' => '2026-09-01',
                'duracaoDias' => 29,
            ),
            30 => 
            array (
                'codCiclo' => 31,
                'codUsuario' => 18,
                'dataInicio' => '2026-09-30',
                'duracaoDias' => NULL,
            ),
            31 => 
            array (
                'codCiclo' => 32,
                'codUsuario' => 19,
                'dataInicio' => '2026-08-12',
                'duracaoDias' => 31,
            ),
            32 => 
            array (
                'codCiclo' => 33,
                'codUsuario' => 19,
                'dataInicio' => '2026-09-12',
                'duracaoDias' => NULL,
            ),
        ));
        
        
    }
}