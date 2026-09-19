<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbpapelTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbpapel')->delete();
        
        \DB::table('tbpapel')->insert(array (
            0 => 
            array (
                'codPapel' => 1,
                'nomePapel' => 'superadmin',
                'descricaoPapel' => 'Acesso total ao painel administrativo do Vênus',
            ),
        ));
        
        
    }
}