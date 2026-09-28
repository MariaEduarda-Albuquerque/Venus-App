<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbProfissional')->insert([
            ['nomeProfissional' => 'Gabriela Rossi', 'emailProfissional' => 'gabriela@gmail.com', 'cpfProfissional' => '365.421.564.20', 'telefoneProfissional' => '11972634532', 'dataNascProfissional' => '2000-11-04', 'senhaProfissional' => 'gabriela123', 'categoriaProfissional' => 'Médico', 'especialidadeProfissional' => 'Ginecologista', 'conselhoClasseProfissional' => 'CRP', 'numConselhoProfissional' => '123456', 'ufConselhoProfissional' => 'BA', 'comprovanteConselhoProfissional' => 'C:\xampp\tmp\phpEDCC.tmp', 'docComplementarProfissional' => 'C:\xampp\tmp\phpEDCC.tmp', 'apresentacaoProfissional' => 'Olá, me chamo Gabriela. Sou médica ginecologista e estou aqui para fazer o possível para te ajudar.', 'fotoPerfilProfissional' => 'null', 'atendeChatProfissional' => '1', 'atendeDuvidaRapidoProfissional' => '0', 'atendePresencialProfissional' => '0', 'statusVerificacaoProfissional' => 'Em análise', 'statusContaProfissional' => 'Ativa'],
            ['nomeProfissional' => 'Larissa Mendonça', 'emailProfissional' => 'liviaoliveiraa2008@gmail.com', 'cpfProfissional' => '365.421.564.21', 'telefoneProfissional' => '11972634531', 'dataNascProfissional' => '1998-11-06', 'senhaProfissional' => 'larissa123', 'categoriaProfissional' => 'Psicologo', 'especialidadeProfissional' => 'Saúde da Mulher', 'conselhoClasseProfissional' => 'CRM', 'numConselhoProfissional' => '123457', 'ufConselhoProfissional' => 'SP', 'comprovanteConselhoProfissional' => 'C:\xampp\tmp\phpEDCC.tmp', 'docComplementarProfissional' => 'C:\xampp\tmp\phpEDCC.tmp', 'apresentacaoProfissional' => 'Oi, sou a Larrisa. Atuo na área de psicologia com foco em mulheres.', 'fotoPerfilProfissional' => 'null', 'atendeChatProfissional' => '1', 'atendeDuvidaRapidoProfissional' => '1', 'atendePresencialProfissional' => '0', 'statusVerificacaoProfissional' => 'Em análise', 'statusContaProfissional' => 'Ativa'],
        ]);
    }
}
