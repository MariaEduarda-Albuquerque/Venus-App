<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbforumrespostaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbforumresposta')->delete();
        
        \DB::table('tbforumresposta')->insert(array (
            0 => 
            array (
                'codForumResposta' => 1,
                'codForumPublicacao' => 1,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 1,
                'textoResposta' => 'Sim, e comum. A variacao hormonal da fase lutea pode intensificar sintomas de ansiedade. Registrar os sintomas ajuda muito na avaliacao.',
                'dataResposta' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}