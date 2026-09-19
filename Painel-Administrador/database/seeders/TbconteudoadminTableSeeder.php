<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbconteudoadminTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbconteudoadmin')->delete();
        
        \DB::table('tbconteudoadmin')->insert(array (
            0 => 
            array (
                'codConteudoAdmin' => 1,
                'codConteudo' => 1,
                'codAdmin' => 1,
                'decisao' => 'aprovado',
                'motivoDecisao' => 'Conteudo revisado, linguagem adequada e fontes confiaveis.',
                'dataDecisao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}