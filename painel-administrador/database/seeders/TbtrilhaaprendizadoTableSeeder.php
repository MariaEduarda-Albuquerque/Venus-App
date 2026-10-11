<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbtrilhaaprendizadoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbtrilhaaprendizado')->delete();
        
        \DB::table('tbtrilhaaprendizado')->insert(array (
            0 => 
            array (
                'codTrilha' => 1,
                'nomeTrilha' => 'Primeiros passos no autocuidado',
                'descricaoTrilha' => 'Trilha introdutoria sobre saude mental e habitos de bem-estar.',
                'codTipoCategoria' => 1,
            ),
        ));
        
        
    }
}