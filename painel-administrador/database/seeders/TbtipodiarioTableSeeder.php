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
            1 => 
            array (
                'codTipoDiario' => 2,
                'descricaoTipoDiario' => 'Sintomas fisicos',
            ),
            2 => 
            array (
                'codTipoDiario' => 3,
                'descricaoTipoDiario' => 'Consultas e exames',
            ),
            3 => 
            array (
                'codTipoDiario' => 4,
                'descricaoTipoDiario' => 'Sono e rotina',
            ),
            4 => 
            array (
                'codTipoDiario' => 5,
                'descricaoTipoDiario' => 'Alimentacao e hidratacao',
            ),
            5 => 
            array (
                'codTipoDiario' => 6,
                'descricaoTipoDiario' => 'Conquistas e gratidao',
            ),
        ));
        
        
    }
}