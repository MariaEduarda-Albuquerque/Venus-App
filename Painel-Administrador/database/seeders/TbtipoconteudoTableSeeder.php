<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbtipoconteudoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbtipoconteudo')->delete();
        
        \DB::table('tbtipoconteudo')->insert(array (
            0 => 
            array (
                'codTipoConteudo' => 1,
                'descricaoTipoConteudo' => 'Artigo',
            ),
        ));
        
        
    }
}