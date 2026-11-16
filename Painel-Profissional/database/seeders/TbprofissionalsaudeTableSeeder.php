<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbprofissionalsaudeTableSeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('tbprofissionalsaude')->delete();
        
        \DB::table('tbprofissionalsaude')->insert([
            [
                'codProfissionalSaude' => 1,
                'nomeProfissionalSaude' => 'Dra. Helena Costa',
                'emailProfissionalSaude' => 'helena.costa@venus.com.br',
                'telProfissionalSaude' => '(11)98888-1234',
                'senhaProfissionalSaude' => '$2y$12$8xu3FNIv0gFLRnBhLwh.ZOesyY2yYqB5A9bduIhR566.8r657vGGG',
                'duasEtapasAtiva' => 0,
                'provedorLoginProfissional' => 'Local',
                'googleIdProfissional' => NULL,
                'categoriaProfissional' => 'Médico',
                'especialidadeProfissionalSaude' => 'Ginecologia',
                'apresentacaoProfissional' => 'Ginecologista com 12 anos de atuacao em saude da mulher e planejamento familiar.',
                'paisProfissional' => NULL,
                'cidadeProfissional' => NULL,
                'ufProfissional' => NULL,
                'cepProfissional' => NULL,
                'nrFiscalProfissional' => NULL,
                'fotoPerfilProfissional' => NULL,
                'statusVerificacao' => 'Aprovado',
                'statusConta' => 'Ativa',
                'dataCadastro' => '2026-09-17 18:19:08',
                'dataAtualizacao' => '2026-09-17 18:19:08',
            ],
            // ... (copie o resto do array da seeder que você mandou)
        ]);
    }
}