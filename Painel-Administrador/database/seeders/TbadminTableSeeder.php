<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TbadminTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        // \DB::table('tbadmin')->delete();
        
        \DB::table('tbadmin')->insert(array (
            0 => 
            array (
                'codAdmin' => 1,
                'nomeAdmin' => 'Otavio',
                'emailAdmin' => 'otavio@gmail.com',
                'telAdmin' => '1198461552430',
                'paisAdmin' => 'Brasil',
                'cidadeAdmin' => 'São Paulo',
                'ufAdmin' => 'SP',
                'cepAdmin' => '04538132',
                'nrFiscalAdmin' => '12345678900',
                'temaAdmin' => 'sistema',
                'senhaAdmin' => Hash::make('senha123'),
                'codPapel' => 1,
                'duasEtapasAtiva' => 1,
                'statusConta' => 'ativa',
                'dataCadastro' => '2026-09-20 18:19:08',
            )
          
        ));
        
        
    }
}