<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbtipoatendimentoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbtipoatendimento')->delete();
        
        \DB::table('tbtipoatendimento')->insert(array (
            0 => 
            array (
                'idTipoAtendimento' => 1,
                'descricaoTipoAtendimento' => 'Atendimento por chat em tempo real',
            ),
        ));
        
        
    }
}