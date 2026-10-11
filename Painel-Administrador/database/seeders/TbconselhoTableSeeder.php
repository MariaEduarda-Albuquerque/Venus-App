<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbconselhoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbconselho')->delete();
        
        \DB::table('tbconselho')->insert(array (
            0 => 
            array (
                'codConselho' => 1,
                'codProfissionalSaude' => 1,
                'ufConselho' => 'SP',
                'numConselho' => '123456',
                'registroConselho' => 'documentos/conselho/crm-sp-123456.pdf',
                'documentoComplementarConselho' => NULL,
            ),
        ));
        
        
    }
}