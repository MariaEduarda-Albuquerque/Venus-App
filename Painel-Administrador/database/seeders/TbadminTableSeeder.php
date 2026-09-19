<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                'senhaAdmin' => '$2y$12$pu0e7ncsoYW8bEY9RxTtwe03T.qGW5L.q6hwmAN.xZFd3jWw3bL5G',
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
                'senhaAdmin' => '$2y$12$XAUAzen24FcOITuxNSScvemgx0h1jzfTGge6MK3.JIDbEl/chNI7G',
                'codPapel' => 1,
                'duasEtapasAtiva' => 1,
                'statusConta' => 'ativa',
                'dataCadastro' => '2026-09-18 19:11:16',
            ),
        ));
        
        
    }
}