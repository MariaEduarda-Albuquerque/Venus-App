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
        

        \DB::table('tbadmin')->delete();
        
        \DB::table('tbadmin')->insert(array (
            0 => 
            array (
                'codAdmin' => 1,
                'nomeAdmin' => 'Admin',
                'emailAdmin' => 'admin@admin.com',
                'telAdmin' => NULL,
                'paisAdmin' => NULL,
                'cidadeAdmin' => NULL,
                'ufAdmin' => NULL,
                'cepAdmin' => NULL,
                'nrFiscalAdmin' => NULL,
                'temaAdmin' => 'sistema',
                'senhaAdmin' => Hash::make('venusadm123'),
                'codPapel' => 1,
                'duasEtapasAtiva' => 1,
                'statusConta' => 'ativa',
                'dataCadastro' => '2026-09-17 18:19:08',
            ),
            1 => 
            array (
                'codAdmin' => 2,
                'nomeAdmin' => 'Admin',
                'emailAdmin' => 'admin@sistema.com',
                'telAdmin' => NULL,
                'paisAdmin' => NULL,
                'cidadeAdmin' => NULL,
                'ufAdmin' => NULL,
                'cepAdmin' => NULL,
                'nrFiscalAdmin' => NULL,
                'temaAdmin' => 'sistema',
                'senhaAdmin' => Hash::make('venusadm123123'),
                'codPapel' => 1,
                'duasEtapasAtiva' => 1,
                'statusConta' => 'ativa',
                'dataCadastro' => '2026-09-18 19:11:16',
            ),
        ));
        
        
    }
}