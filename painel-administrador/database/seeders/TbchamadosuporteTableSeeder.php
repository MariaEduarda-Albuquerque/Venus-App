<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbchamadosuporteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbchamadosuporte')->delete();
        
        \DB::table('tbchamadosuporte')->insert(array (
            0 => 
            array (
                'codChamado' => 1,
                'codProfissionalSaude' => 1,
                'assuntoChamado' => 'Erro ao anexar arquivo no chat',
                'descricaoChamado' => 'Ao tentar enviar um PDF de exame na consulta, o sistema retorna erro de upload apos 90 por cento do envio.',
                'anexoChamado' => 'anexos/chamados/1.png',
                'statusChamado' => 'em_atendimento',
                'dataAbertura' => '2026-09-17 18:19:08',
                'canalChamado' => 'formulario',
                'motivoChamado' => 'acesso_a_senha',
                'avaliacaoChamado' => '5',
            ),
            1 => 
            array (
                'codChamado' => 2,
                'codProfissionalSaude' => 5,
                'assuntoChamado' => 'Nao consigo atualizar minha foto de perfil',
                'descricaoChamado' => 'Ao selecionar uma nova foto, a tela volta para a anterior sem salvar.',
                'anexoChamado' => NULL,
                'statusChamado' => 'resolvido',
                'dataAbertura' => '2026-09-26 09:40:00',
                'canalChamado' => 'formulario',
                'motivoChamado' => 'acesso_a_senha',
                'avaliacaoChamado' => '2',
            ),
            2 => 
            array (
                'codChamado' => 3,
                'codProfissionalSaude' => 10,
                'assuntoChamado' => 'Documento do conselho em analise',
                'descricaoChamado' => 'Enviei meu registro profissional ha alguns dias e queria saber o prazo de verificacao.',
                'anexoChamado' => NULL,
                'statusChamado' => 'aberto',
                'dataAbertura' => '2026-10-12 16:00:00',
                'canalChamado' => 'telefone',
                'motivoChamado' => 'conta_e_dados',
                'avaliacaoChamado' => '3',
            ),
            3 => 
            array (
                'codChamado' => 4,
                'codProfissionalSaude' => 11,
                'assuntoChamado' => 'Como enviar documento complementar?',
                'descricaoChamado' => 'A plataforma pediu documento complementar, mas nao encontrei onde anexar.',
                'anexoChamado' => 'anexos/chamados/4.png',
                'statusChamado' => 'em_atendimento',
                'dataAbertura' => '2026-10-07 10:20:00',
                'canalChamado' => 'email',
                'motivoChamado' => 'sugestoes',
                'avaliacaoChamado' => '5',
            ),
            4 => 
            array (
                'codChamado' => 5,
                'codProfissionalSaude' => 8,
                'assuntoChamado' => 'Limite de tamanho de anexos',
                'descricaoChamado' => 'Exames em PDF acima de 5 MB nao sao enviados no chat.',
                'anexoChamado' => NULL,
                'statusChamado' => 'aberto',
                'dataAbertura' => '2026-10-12 14:30:00',
                'canalChamado' => 'email',
                'motivoChamado' => 'duvida',
                'avaliacaoChamado' => '4',
            ),
        ));
        
        
    }
}