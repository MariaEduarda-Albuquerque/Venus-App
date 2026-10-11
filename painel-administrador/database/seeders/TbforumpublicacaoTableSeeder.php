<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbforumpublicacaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbforumpublicacao')->delete();
        
        \DB::table('tbforumpublicacao')->insert(array (
            0 => 
            array (
                'codForumPublicacao' => 1,
                'codUsuario' => 1,
                'codTipoCategoria' => 1,
                'tituloPublicacao' => 'Alguem mais sente ansiedade antes da menstruacao?',
                'textoPublicacao' => 'Percebi que nos dias anteriores ao ciclo fico muito mais ansiosa. Isso e comum? Como voces lidam?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}