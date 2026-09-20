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
    1 =>
    array (
        'codProfissionalSaude' => 2,
        'nomeProfissionalSaude' => 'Dr. Lucas Almeida',
        'emailProfissionalSaude' => 'lucas.almeida@venus.com.br',
        'telProfissionalSaude' => '(11)97777-2345',
        'senhaProfissionalSaude' => '$2y$12$pu0e7ncsoYW8bEY9RxTtwe03T.qGW5L.q6hwmAN.xZFd3jWw3bL5G',
        'duasEtapasAtiva' => 0,
        'provedorLoginProfissional' => 'local',
        'googleIdProfissional' => NULL,
        'categoriaProfissional' => 'medico',
        'especialidadeProfissionalSaude' => 'Clinica Geral',
        'apresentacaoProfissional' => 'Medico com experiencia em atendimento clinico e orientacao preventiva.',
        'paisProfissional' => NULL,
        'cidadeProfissional' => NULL,
        'ufProfissional' => NULL,
        'cepProfissional' => NULL,
        'nrFiscalProfissional' => NULL,
        'fotoPerfilProfissional' => 'perfis/profissionais/2.jpg',
        'statusVerificacao' => 'pendente',
        'statusConta' => 'ativa',
        'dataCadastro' => '2026-09-18 09:25:14',
        'dataAtualizacao' => '2026-09-18 09:25:14',
    ),
    2 =>
    array (
        'codProfissionalSaude' => 3,
        'nomeProfissionalSaude' => 'Dra. Mariana Souza',
        'emailProfissionalSaude' => 'mariana.souza@venus.com.br',
        'telProfissionalSaude' => '(11)96666-3456',
        'senhaProfissionalSaude' => '$2y$12$pu0e7ncsoYW8bEY9RxTtwe03T.qGW5L.q6hwmAN.xZFd3jWw3bL5G',
        'duasEtapasAtiva' => 1,
        'provedorLoginProfissional' => 'local',
        'googleIdProfissional' => NULL,
        'categoriaProfissional' => 'enfermeiro',
        'especialidadeProfissionalSaude' => 'Saude da Mulher',
        'apresentacaoProfissional' => 'Enfermeira dedicada ao acolhimento e a educacao em saude da mulher.',
        'paisProfissional' => NULL,
        'cidadeProfissional' => NULL,
        'ufProfissional' => NULL,
        'cepProfissional' => NULL,
        'nrFiscalProfissional' => NULL,
        'fotoPerfilProfissional' => 'perfis/profissionais/3.jpg',
        'statusVerificacao' => 'aprovado',
        'statusConta' => 'ativa',
        'dataCadastro' => '2026-09-18 14:42:33',
        'dataAtualizacao' => '2026-09-18 14:42:33',
    ),
    3 =>
    array (
        'codProfissionalSaude' => 4,
        'nomeProfissionalSaude' => 'Dra. Beatriz Martins',
        'emailProfissionalSaude' => 'beatriz.martins@venus.com.br',
        'telProfissionalSaude' => '(11)95555-4567',
        'senhaProfissionalSaude' => '$2y$12$pu0e7ncsoYW8bEY9RxTtwe03T.qGW5L.q6hwmAN.xZFd3jWw3bL5G',
        'duasEtapasAtiva' => 0,
        'provedorLoginProfissional' => 'local',
        'googleIdProfissional' => NULL,
        'categoriaProfissional' => 'psicologo',
        'especialidadeProfissionalSaude' => 'Psicologia da Adolescencia',
        'apresentacaoProfissional' => 'Psicologa com foco em acolhimento emocional e acompanhamento de adolescentes.',
        'paisProfissional' => NULL,
        'cidadeProfissional' => NULL,
        'ufProfissional' => NULL,
        'cepProfissional' => NULL,
        'nrFiscalProfissional' => NULL,
        'fotoPerfilProfissional' => 'perfis/profissionais/4.jpg',
        'statusVerificacao' => 'pendente',
        'statusConta' => 'ativa',
        'dataCadastro' => '2026-09-19 10:15:27',
        'dataAtualizacao' => '2026-09-19 10:15:27',
    ),
    4 =>
    array (
        'codProfissionalSaude' => 5,
        'nomeProfissionalSaude' => 'Dr. Rafael Oliveira',
        'emailProfissionalSaude' => 'rafael.oliveira@venus.com.br',
        'telProfissionalSaude' => '(11)94444-5678',
        'senhaProfissionalSaude' => '$2y$12$pu0e7ncsoYW8bEY9RxTtwe03T.qGW5L.q6hwmAN.xZFd3jWw3bL5G',
        'duasEtapasAtiva' => 1,
        'provedorLoginProfissional' => 'local',
        'googleIdProfissional' => NULL,
        'categoriaProfissional' => 'medico',
        'especialidadeProfissionalSaude' => 'Dermatologia',
        'apresentacaoProfissional' => 'Dermatologista com atuacao em cuidados com a pele e orientacao preventiva.',
        'paisProfissional' => NULL,
        'cidadeProfissional' => NULL,
        'ufProfissional' => NULL,
        'cepProfissional' => NULL,
        'nrFiscalProfissional' => NULL,
        'fotoPerfilProfissional' => 'perfis/profissionais/5.jpg',
        'statusVerificacao' => 'aprovado',
        'statusConta' => 'ativa',
        'dataCadastro' => '2026-09-19 16:38:49',
        'dataAtualizacao' => '2026-09-19 16:38:49',
    ),
    5 =>
    array (
        'codProfissionalSaude' => 6,
        'nomeProfissionalSaude' => 'Dra. Camila Ferreira',
        'emailProfissionalSaude' => 'camila.ferreira@venus.com.br',
        'telProfissionalSaude' => '(11)93333-6789',
        'senhaProfissionalSaude' => '$2y$12$pu0e7ncsoYW8bEY9RxTtwe03T.qGW5L.q6hwmAN.xZFd3jWw3bL5G',
        'duasEtapasAtiva' => 0,
        'provedorLoginProfissional' => 'local',
        'googleIdProfissional' => NULL,
        'categoriaProfissional' => 'nutricionista',
        'especialidadeProfissionalSaude' => 'Nutricao da Adolescencia',
        'apresentacaoProfissional' => 'Nutricionista com foco em educacao alimentar e saude na adolescencia.',
        'paisProfissional' => NULL,
        'cidadeProfissional' => NULL,
        'ufProfissional' => NULL,
        'cepProfissional' => NULL,
        'nrFiscalProfissional' => NULL,
        'fotoPerfilProfissional' => 'perfis/profissionais/6.jpg',
        'statusVerificacao' => 'pendente',
        'statusConta' => 'ativa',
        'dataCadastro' => '2026-09-20 11:22:05',
        'dataAtualizacao' => '2026-09-20 11:22:05',
    ),
));
        
        
    }
}