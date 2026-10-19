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
            1 => 
            array (
                'codTipoConteudo' => 2,
                'descricaoTipoConteudo' => 'Video curto',
            ),
            2 => 
            array (
                'codTipoConteudo' => 3,
                'descricaoTipoConteudo' => 'Video animado',
            ),
            3 => 
            array (
                'codTipoConteudo' => 4,
                'descricaoTipoConteudo' => 'Infografico',
            ),
            4 => 
            array (
                'codTipoConteudo' => 5,
                'descricaoTipoConteudo' => 'Cartilha',
            ),
            5 => 
            array (
                'codTipoConteudo' => 6,
                'descricaoTipoConteudo' => 'Card comparativo',
            ),
        ));
        
        
    }
}