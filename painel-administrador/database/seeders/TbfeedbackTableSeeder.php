<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbfeedbackTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbfeedback')->delete();
        
        \DB::table('tbfeedback')->insert(array (
            0 => 
            array (
                'codFeedback' => 1,
                'autorTipo' => 'usuaria',
                'codUsuario' => 1,
                'codProfissionalSaude' => NULL,
                'nota' => 5,
                'categoriaFeedback' => 'elogio',
                'assuntoFeedback' => NULL,
                'comentario' => 'O diario de humor me ajudou muito a perceber padroes ao longo do mes.',
                'statusFeedback' => 'respondido',
                'dataFeedback' => '2026-09-17 18:19:08',
            ),
            1 => 
            array (
                'codFeedback' => 2,
                'autorTipo' => 'usuaria',
                'codUsuario' => 2,
                'codProfissionalSaude' => NULL,
                'nota' => 5,
                'categoriaFeedback' => 'elogio',
                'assuntoFeedback' => 'Chat com profissionais',
                'comentario' => 'Consegui conversar com uma ginecologista rapidamente. Atendimento muito acolhedor.',
                'statusFeedback' => 'respondido',
                'dataFeedback' => '2026-09-25 10:00:00',
            ),
            2 => 
            array (
                'codFeedback' => 3,
                'autorTipo' => 'usuaria',
                'codUsuario' => 6,
                'codProfissionalSaude' => NULL,
                'nota' => 4,
                'categoriaFeedback' => 'sugestao',
                'assuntoFeedback' => 'Modo discreto',
                'comentario' => 'Seria legal ter um icone discreto do app no celular para quem mora com a familia.',
                'statusFeedback' => 'em_analise',
                'dataFeedback' => '2026-09-30 20:00:00',
            ),
            3 => 
            array (
                'codFeedback' => 4,
                'autorTipo' => 'usuaria',
                'codUsuario' => 10,
                'codProfissionalSaude' => NULL,
                'nota' => 5,
                'categoriaFeedback' => 'elogio',
                'assuntoFeedback' => 'Tecnicas de respiracao',
                'comentario' => 'Os videos curtos de respiracao me ajudaram nas crises.',
                'statusFeedback' => 'respondido',
                'dataFeedback' => '2026-10-02 22:10:00',
            ),
            4 => 
            array (
                'codFeedback' => 5,
                'autorTipo' => 'usuaria',
                'codUsuario' => 13,
                'codProfissionalSaude' => NULL,
                'nota' => 2,
                'categoriaFeedback' => 'problema_tecnico',
                'assuntoFeedback' => 'Notificacoes nao chegam',
                'comentario' => 'Nao recebo as notificacoes de lembrete de remedio no meu celular.',
                'statusFeedback' => 'enviado',
                'dataFeedback' => '2026-10-06 08:40:00',
            ),
            5 => 
            array (
                'codFeedback' => 6,
                'autorTipo' => 'usuaria',
                'codUsuario' => 20,
                'codProfissionalSaude' => NULL,
                'nota' => 4,
                'categoriaFeedback' => 'sugestao',
                'assuntoFeedback' => 'Grupos de apoio',
                'comentario' => 'Poderia ter grupos tematicos por cidade no forum.',
                'statusFeedback' => 'enviado',
                'dataFeedback' => '2026-10-09 22:30:00',
            ),
            6 => 
            array (
                'codFeedback' => 7,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 3,
                'nota' => 5,
                'categoriaFeedback' => 'elogio',
                'assuntoFeedback' => 'Painel do profissional',
                'comentario' => 'O painel de consultas e muito claro e facil de usar.',
                'statusFeedback' => 'respondido',
                'dataFeedback' => '2026-10-01 18:00:00',
            ),
            7 => 
            array (
                'codFeedback' => 8,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 5,
                'nota' => 3,
                'categoriaFeedback' => 'problema_tecnico',
                'assuntoFeedback' => 'Erro ao reagendar',
                'comentario' => 'Ao reagendar uma consulta o sistema mostra horario duplicado.',
                'statusFeedback' => 'em_analise',
                'dataFeedback' => '2026-10-07 11:30:00',
            ),
            8 => 
            array (
                'codFeedback' => 9,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 8,
                'nota' => 4,
                'categoriaFeedback' => 'sugestao',
                'assuntoFeedback' => 'Anexos maiores',
                'comentario' => 'Aumentar o limite de tamanho de anexos no chat para exames em PDF.',
                'statusFeedback' => 'enviado',
                'dataFeedback' => '2026-10-12 14:20:00',
            ),
            9 => 
            array (
                'codFeedback' => 10,
                'autorTipo' => 'usuaria',
                'codUsuario' => 16,
                'codProfissionalSaude' => NULL,
                'nota' => 5,
                'categoriaFeedback' => 'elogio',
                'assuntoFeedback' => 'Conteudo de pre-natal',
                'comentario' => 'O infografico do pre-natal me ajudou a organizar as consultas.',
                'statusFeedback' => 'enviado',
                'dataFeedback' => '2026-10-13 21:00:00',
            ),
            10 => 
            array (
                'codFeedback' => 11,
                'autorTipo' => 'usuaria',
                'codUsuario' => 9,
                'codProfissionalSaude' => NULL,
                'nota' => 4,
                'categoriaFeedback' => 'outro',
                'assuntoFeedback' => 'Duvida sobre privacidade',
                'comentario' => 'Gostaria de entender como meus dados do diario sao protegidos.',
                'statusFeedback' => 'respondido',
                'dataFeedback' => '2026-10-04 09:00:00',
            ),
        ));
        
        
    }
}