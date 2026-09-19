<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbprofissionalsaudeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbprofissionalsaude')->delete();
        
        \DB::table('tbprofissionalsaude')->insert(array (
            0 => 
            array (
                'codProfissionalSaude' => 1,
                'nomeProfissionalSaude' => 'Dra. Helena Costa',
                'emailProfissionalSaude' => 'helena.costa@venus.com.br',
            'telProfissionalSaude' => '(11)98888-1234',
                'senhaProfissionalSaude' => '$2y$12$pu0e7ncsoYW8bEY9RxTtwe03T.qGW5L.q6hwmAN.xZFd3jWw3bL5G',
                'duasEtapasAtiva' => 0,
                'provedorLoginProfissional' => 'local',
                'googleIdProfissional' => NULL,
                'categoriaProfissional' => 'medico',
                'especialidadeProfissionalSaude' => 'Ginecologia',
                'apresentacaoProfissional' => 'Ginecologista com 12 anos de atuacao em saude da mulher e planejamento familiar.',
                'paisProfissional' => NULL,
                'cidadeProfissional' => NULL,
                'ufProfissional' => NULL,
                'cepProfissional' => NULL,
                'nrFiscalProfissional' => NULL,
                'fotoPerfilProfissional' => 'perfis/profissionais/1.jpg',
                'statusVerificacao' => 'aprovado',
                'statusConta' => 'ativa',
                'dataCadastro' => '2026-09-17 18:19:08',
                'dataAtualizacao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}