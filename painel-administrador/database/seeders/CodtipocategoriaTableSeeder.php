<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CodtipocategoriaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('codtipocategoria')->delete();
        
        \DB::table('codtipocategoria')->insert(array (
            0 => 
            array (
                'codTipoCategoria' => 1,
                'nomeTipoCategoria' => 'Saude mental',
                'descricaoTipoCategoria' => 'Conteudos sobre bem-estar emocional e autocuidado',
            ),
        ));
        
        
    }
}