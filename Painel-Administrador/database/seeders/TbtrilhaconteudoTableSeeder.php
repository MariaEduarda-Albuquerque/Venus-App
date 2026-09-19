<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbtrilhaconteudoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbtrilhaconteudo')->delete();
        
        \DB::table('tbtrilhaconteudo')->insert(array (
            0 => 
            array (
                'codTrilha' => 1,
                'codConteudo' => 1,
                'ordem' => 1,
            ),
        ));
        
        
    }
}