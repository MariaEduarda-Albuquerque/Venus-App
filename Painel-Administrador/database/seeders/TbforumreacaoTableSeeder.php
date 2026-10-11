<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbforumreacaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbforumreacao')->delete();
        
        \DB::table('tbforumreacao')->insert(array (
            0 => 
            array (
                'codForumPublicacao' => 1,
                'codUsuario' => 1,
                'tipoReacao' => 'apoio',
            ),
        ));
        
        
    }
}