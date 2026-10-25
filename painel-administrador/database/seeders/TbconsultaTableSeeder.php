<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbconsultaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbconsulta')->delete();
        
        \DB::table('tbconsulta')->insert(array (
            0 => 
            array (
                'codConsulta' => 1,
                'nomeConsulta' => 'Acompanhamento de ciclo menstrual',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => '2026-09-10 14:00:00',
                'historicoConsulta' => 'Paciente relatou colicas intensas no primeiro dia do ciclo. Orientada quanto a registro de sintomas no app.',
                'codUsuario' => 1,
                'codProfissionalSaude' => 1,
                'dataCriacao' => '2026-09-05 11:20:00',
            ),
            1 => 
            array (
                'codConsulta' => 2,
                'nomeConsulta' => 'Escolha de metodo contraceptivo',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => '2026-09-24 14:30:00',
                'historicoConsulta' => 'Paciente em duvida entre pilula e DIU. Discutidos beneficios e limites de cada metodo; orientada a agendar avaliacao presencial na UBS.',
                'codUsuario' => 3,
                'codProfissionalSaude' => 1,
                'dataCriacao' => '2026-09-20 09:15:00',
            ),
            2 => 
            array (
                'codConsulta' => 3,
                'nomeConsulta' => 'Acompanhamento psicologico - ansiedade',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => '2026-09-22 18:00:00',
                'historicoConsulta' => 'Relato de ansiedade e dificuldade para dormir associadas a sobrecarga de trabalho. Combinado acompanhamento quinzenal e tecnicas de respiracao.',
                'codUsuario' => 5,
                'codProfissionalSaude' => 3,
                'dataCriacao' => '2026-09-18 20:00:00',
            ),
            3 => 
            array (
                'codConsulta' => 4,
                'nomeConsulta' => 'Duvida sobre atraso menstrual',
                'tipoConsulta' => 'duvida_rapida',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => NULL,
                'historicoConsulta' => 'Atraso menstrual de 10 dias. Orientada a realizar teste de gravidez e procurar a UBS se o atraso persistir.',
                'codUsuario' => 12,
                'codProfissionalSaude' => 5,
                'dataCriacao' => '2026-09-30 10:15:00',
            ),
            4 => 
            array (
                'codConsulta' => 5,
                'nomeConsulta' => 'Duvida sobre sigilo na UBS',
                'tipoConsulta' => 'duvida_rapida',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => NULL,
                'historicoConsulta' => 'Adolescente com duvida sobre atendimento sem responsaveis. Orientada sobre direito ao atendimento e ao sigilo.',
                'codUsuario' => 6,
                'codProfissionalSaude' => 2,
                'dataCriacao' => '2026-09-28 20:10:00',
            ),
            5 => 
            array (
                'codConsulta' => 6,
                'nomeConsulta' => 'Primeira consulta de pre-natal',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => '2026-10-01 10:00:00',
                'historicoConsulta' => 'Gestante na 9a semana, primeira gestacao. Orientada sobre pre-natal com acompanhamento mais proximo, exames iniciais e acido folico.',
                'codUsuario' => 9,
                'codProfissionalSaude' => 4,
                'dataCriacao' => '2026-09-25 08:30:00',
            ),
            6 => 
            array (
                'codConsulta' => 7,
                'nomeConsulta' => 'Acompanhamento psicologico - crises de ansiedade',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => '2026-10-08 19:00:00',
                'historicoConsulta' => 'Crises de ansiedade em locais cheios. Trabalhadas tecnicas de respiracao e aterramento; combinada nova sessao.',
                'codUsuario' => 10,
                'codProfissionalSaude' => 6,
                'dataCriacao' => '2026-10-03 21:00:00',
            ),
            7 => 
            array (
                'codConsulta' => 8,
                'nomeConsulta' => 'Orientacao sobre prevencao de ISTs',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => '2026-10-14 15:00:00',
                'historicoConsulta' => 'Consulta presencial de orientacao sobre prevencao de ISTs. Testes rapidos realizados e orientacao de retorno.',
                'codUsuario' => 8,
                'codProfissionalSaude' => 8,
                'dataCriacao' => '2026-10-09 10:00:00',
            ),
            8 => 
            array (
                'codConsulta' => 9,
                'nomeConsulta' => 'Orientacao socioassistencial',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'aguardando',
                'dataHoraAgendada' => '2026-10-20 15:00:00',
                'historicoConsulta' => NULL,
                'codUsuario' => 13,
                'codProfissionalSaude' => 7,
                'dataCriacao' => '2026-10-14 19:30:00',
            ),
            9 => 
            array (
                'codConsulta' => 10,
                'nomeConsulta' => 'Conversa sobre implante contraceptivo',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'aguardando',
                'dataHoraAgendada' => '2026-10-22 15:00:00',
                'historicoConsulta' => NULL,
                'codUsuario' => 2,
                'codProfissionalSaude' => 1,
                'dataCriacao' => '2026-10-15 20:50:00',
            ),
            10 => 
            array (
                'codConsulta' => 11,
                'nomeConsulta' => 'Duvida sobre enjoo na gestacao',
                'tipoConsulta' => 'duvida_rapida',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'aguardando',
                'dataHoraAgendada' => NULL,
                'historicoConsulta' => NULL,
                'codUsuario' => 16,
                'codProfissionalSaude' => 5,
                'dataCriacao' => '2026-10-16 09:40:00',
            ),
            11 => 
            array (
                'codConsulta' => 12,
                'nomeConsulta' => 'Consulta de rotina',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'cancelada',
                'dataHoraAgendada' => '2026-10-12 18:30:00',
                'historicoConsulta' => NULL,
                'codUsuario' => 4,
                'codProfissionalSaude' => 2,
                'dataCriacao' => '2026-10-06 17:00:00',
            ),
            12 => 
            array (
                'codConsulta' => 13,
                'nomeConsulta' => 'Acompanhamento de vacinacao e ciclo',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'em_andamento',
                'dataHoraAgendada' => '2026-10-16 17:30:00',
                'historicoConsulta' => NULL,
                'codUsuario' => 14,
                'codProfissionalSaude' => 9,
                'dataCriacao' => '2026-10-10 12:00:00',
            ),
            13 => 
            array (
                'codConsulta' => 14,
                'nomeConsulta' => 'Acompanhamento psicologico - rotina universitaria',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => '2026-10-13 18:00:00',
                'historicoConsulta' => 'Ansiedade em periodo de provas. Combinado plano de rotina de sono e pausas.',
                'codUsuario' => 18,
                'codProfissionalSaude' => 3,
                'dataCriacao' => '2026-10-08 18:45:00',
            ),
            14 => 
            array (
                'codConsulta' => 15,
                'nomeConsulta' => 'Duvida sobre autoestima e escola',
                'tipoConsulta' => 'duvida_rapida',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => NULL,
                'historicoConsulta' => 'Adolescente com duvidas sobre autoestima e relacao com colegas. Orientada sobre rede de apoio e acompanhamento psicologico.',
                'codUsuario' => 19,
                'codProfissionalSaude' => 6,
                'dataCriacao' => '2026-10-10 15:00:00',
            ),
            15 => 
            array (
                'codConsulta' => 16,
                'nomeConsulta' => 'Orientacao sobre testagem e prevencao',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => '2026-10-15 19:30:00',
                'historicoConsulta' => 'Orientacoes sobre testagem periodica e prevencao combinada. Encaminhada para teste rapido na UBS.',
                'codUsuario' => 20,
                'codProfissionalSaude' => 8,
                'dataCriacao' => '2026-10-11 09:00:00',
            ),
        ));
        
        
    }
}