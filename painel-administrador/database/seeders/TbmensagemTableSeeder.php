<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbmensagemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbmensagem')->delete();
        
        \DB::table('tbmensagem')->insert(array (
            0 => 
            array (
                'codMensagem' => 1,
                'codConsulta' => 1,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Boa tarde, doutora! Minhas colicas voltaram a piorar neste mes.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-10 14:03:00',
                'dataEnvio' => '2026-09-10 14:02:00',
            ),
            1 => 
            array (
                'codMensagem' => 2,
                'codConsulta' => 1,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Boa tarde, Beatriz! Vamos conversar sobre isso. A colica aparece em qual dia do ciclo e quanto tempo dura?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-10 14:06:00',
                'dataEnvio' => '2026-09-10 14:05:00',
            ),
            2 => 
            array (
                'codMensagem' => 3,
                'codConsulta' => 1,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'No primeiro e no segundo dia. Dura quase o dia todo.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-10 14:08:00',
                'dataEnvio' => '2026-09-10 14:08:00',
            ),
            3 => 
            array (
                'codMensagem' => 4,
                'codConsulta' => 1,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Obrigada. Continue registrando os sintomas no app, isso ajuda a identificar padroes. Se piorar ou atrapalhar sua rotina, podemos investigar melhor.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-10 14:13:00',
                'dataEnvio' => '2026-09-10 14:12:00',
            ),
            4 => 
            array (
                'codMensagem' => 5,
                'codConsulta' => 2,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Boa tarde, doutora! Estou em duvida entre a pilula e o DIU. Uso pilula ha 2 anos e esqueco as vezes.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-24 14:32:00',
                'dataEnvio' => '2026-09-24 14:31:00',
            ),
            5 => 
            array (
                'codMensagem' => 6,
                'codConsulta' => 2,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Boa tarde, Jessica! Esquecer doses reduz a eficacia da pilula. Voce tem alguma queixa com ela, como enxaqueca ou sangramentos fora de hora?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-24 14:34:00',
                'dataEnvio' => '2026-09-24 14:33:00',
            ),
            6 => 
            array (
                'codMensagem' => 7,
                'codConsulta' => 2,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Nao tenho queixa, so esqueco mesmo. Queria algo que nao dependesse de lembrar todo dia.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-24 14:35:00',
                'dataEnvio' => '2026-09-24 14:35:00',
            ),
            7 => 
            array (
                'codMensagem' => 8,
                'codConsulta' => 2,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Entao metodos de longa duracao, como o DIU, podem ser uma boa opcao. A colocacao e feita por profissional de saude, e nao protege contra ISTs, entao a camisinha continua importante. Vale uma avaliacao presencial antes.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-24 14:39:00',
                'dataEnvio' => '2026-09-24 14:38:00',
            ),
            8 => 
            array (
                'codMensagem' => 9,
                'codConsulta' => 2,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Entendi, vou agendar na UBS. Obrigada!',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-24 14:41:00',
                'dataEnvio' => '2026-09-24 14:41:00',
            ),
            9 => 
            array (
                'codMensagem' => 10,
                'codConsulta' => 3,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Oi, Priscila. Tenho acordado varias vezes durante a noite e fico com o coracao acelerado.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-22 18:01:00',
                'dataEnvio' => '2026-09-22 18:01:00',
            ),
            10 => 
            array (
                'codMensagem' => 11,
                'codConsulta' => 3,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Oi, Thais, obrigada por compartilhar. Desde quando isso vem acontecendo e o que costuma estar na sua cabeca nesses momentos?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-22 18:03:00',
                'dataEnvio' => '2026-09-22 18:03:00',
            ),
            11 => 
            array (
                'codMensagem' => 12,
                'codConsulta' => 3,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Faz umas tres semanas. Penso muito no trabalho e nas contas.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-22 18:06:00',
                'dataEnvio' => '2026-09-22 18:06:00',
            ),
            12 => 
            array (
                'codMensagem' => 13,
                'codConsulta' => 3,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Faz sentido sentir assim com tanta sobrecarga. Vamos combinar encontros quinzenais e, ate la, experimente respirar inspirando por 4 segundos e soltando por 6 antes de dormir.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-22 18:10:00',
                'dataEnvio' => '2026-09-22 18:10:00',
            ),
            13 => 
            array (
                'codMensagem' => 14,
                'codConsulta' => 4,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Oi! Meu ciclo e regular e atrasou 10 dias. O que devo fazer?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-30 11:41:00',
                'dataEnvio' => '2026-09-30 10:15:00',
            ),
            14 => 
            array (
                'codMensagem' => 15,
                'codConsulta' => 4,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Oi, Vitoria! Atrasos podem ter varias causas, como estresse. Se houve relacao sem protecao, faca um teste de gravidez (farmacia ou teste rapido na UBS). Se o atraso persistir ou houver dor forte, procure atendimento.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-30 11:45:00',
                'dataEnvio' => '2026-09-30 11:40:00',
            ),
            15 => 
            array (
                'codMensagem' => 16,
                'codConsulta' => 4,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Obrigada, vou fazer o teste amanha.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-30 11:46:00',
                'dataEnvio' => '2026-09-30 11:45:00',
            ),
            16 => 
            array (
                'codMensagem' => 17,
                'codConsulta' => 5,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Tenho 17 anos, posso ir sozinha na UBS sem que meus pais fiquem sabendo?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-29 08:31:00',
                'dataEnvio' => '2026-09-28 20:10:00',
            ),
            17 => 
            array (
                'codMensagem' => 18,
                'codConsulta' => 5,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Oi! Voce pode ser atendida sozinha e as informacoes da consulta sao sigilosas, em regra. A excecao sao situacoes de risco grave, como violencia. Na UBS, peca para conversar a sos com o profissional.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-29 09:00:00',
                'dataEnvio' => '2026-09-29 08:30:00',
            ),
            18 => 
            array (
                'codMensagem' => 19,
                'codConsulta' => 5,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Obrigada, ajudou muito!',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-09-29 09:05:00',
                'dataEnvio' => '2026-09-29 09:00:00',
            ),
            19 => 
            array (
                'codMensagem' => 20,
                'codConsulta' => 6,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Bom dia, Carolina! Estou na 9a semana e tenho muitas duvidas.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-01 10:01:00',
                'dataEnvio' => '2026-10-01 10:01:00',
            ),
            20 => 
            array (
                'codMensagem' => 21,
                'codConsulta' => 6,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Bom dia, Patricia, parabens! Vamos por partes. Voce ja iniciou o acido folico e fez os exames iniciais?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-01 10:03:00',
                'dataEnvio' => '2026-10-01 10:03:00',
            ),
            21 => 
            array (
                'codMensagem' => 22,
                'codConsulta' => 6,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Comecei o acido folico, mas ainda nao fiz os exames.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-01 10:05:00',
                'dataEnvio' => '2026-10-01 10:05:00',
            ),
            22 => 
            array (
                'codMensagem' => 23,
                'codConsulta' => 6,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Entao leve o pedido de exames para a UBS ainda esta semana. Pela sua idade, o acompanhamento sera mais proximo, o que e muito comum e seguro. Anote suas duvidas para cada consulta.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-01 10:10:00',
                'dataEnvio' => '2026-10-01 10:09:00',
            ),
            23 => 
            array (
                'codMensagem' => 24,
                'codConsulta' => 6,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Vou fazer isso. Muito obrigada!',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-01 10:12:00',
                'dataEnvio' => '2026-10-01 10:12:00',
            ),
            24 => 
            array (
                'codMensagem' => 25,
                'codConsulta' => 7,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Boa noite. Quando pego onibus lotado sinto falta de ar e medo de passar mal.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-08 19:01:00',
                'dataEnvio' => '2026-10-08 19:01:00',
            ),
            25 => 
            array (
                'codMensagem' => 26,
                'codConsulta' => 7,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Boa noite, Larissa. Obrigado por contar. Isso e mais comum do que parece. Vamos treinar uma tecnica de aterramento juntos?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-08 19:03:00',
                'dataEnvio' => '2026-10-08 19:03:00',
            ),
            26 => 
            array (
                'codMensagem' => 27,
                'codConsulta' => 7,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Vamos sim.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-08 19:04:00',
                'dataEnvio' => '2026-10-08 19:04:00',
            ),
            27 => 
            array (
                'codMensagem' => 28,
                'codConsulta' => 7,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Perceba cinco coisas que voce ve, quatro que toca, tres que ouve, duas que cheira e uma que saboreia. Respire devagar entre cada etapa.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-08 19:07:00',
                'dataEnvio' => '2026-10-08 19:07:00',
            ),
            28 => 
            array (
                'codMensagem' => 29,
                'codConsulta' => 7,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Senti o corpo mais calmo ate no chat. Vou praticar.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-08 19:14:00',
                'dataEnvio' => '2026-10-08 19:14:00',
            ),
            29 => 
            array (
                'codMensagem' => 30,
                'codConsulta' => 8,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Bom dia, doutora. Posso levar resultados de testes anteriores na consulta?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-12 10:30:00',
                'dataEnvio' => '2026-10-12 10:05:00',
            ),
            30 => 
            array (
                'codMensagem' => 31,
                'codConsulta' => 8,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Bom dia, Rafaela! Pode sim. Leve documento com foto e exames anteriores, se tiver.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-12 10:35:00',
                'dataEnvio' => '2026-10-12 10:30:00',
            ),
            31 => 
            array (
                'codMensagem' => 32,
                'codConsulta' => 9,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Bom dia, tenho consulta marcada na terca. Posso enviar antes algumas informacoes?',
                'anexoMensagem' => NULL,
                'lidaEm' => NULL,
                'dataEnvio' => '2026-10-16 08:20:00',
            ),
            32 => 
            array (
                'codMensagem' => 33,
                'codConsulta' => 10,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Oi, doutora! Quero conversar sobre implante contraceptivo.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-16 09:00:00',
                'dataEnvio' => '2026-10-15 21:00:00',
            ),
            33 => 
            array (
                'codMensagem' => 34,
                'codConsulta' => 10,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Oi, Camila! Combinado, vamos conversar na quinta as 15h. Anote suas duvidas ate la.',
                'anexoMensagem' => NULL,
                'lidaEm' => NULL,
                'dataEnvio' => '2026-10-16 09:00:00',
            ),
            34 => 
            array (
                'codMensagem' => 35,
                'codConsulta' => 11,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Estou com 6 semanas de gestacao e sentindo muito enjoo. E normal?',
                'anexoMensagem' => NULL,
                'lidaEm' => NULL,
                'dataEnvio' => '2026-10-16 09:40:00',
            ),
            35 => 
            array (
                'codMensagem' => 36,
                'codConsulta' => 12,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Doutor, preciso cancelar a consulta de amanha, minha escola marcou prova.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-11 19:30:00',
                'dataEnvio' => '2026-10-11 19:10:00',
            ),
            36 => 
            array (
                'codMensagem' => 37,
                'codConsulta' => 12,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Sem problemas, Luana. Cancelo aqui e voce pode remarcar quando quiser.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-11 19:35:00',
                'dataEnvio' => '2026-10-11 19:30:00',
            ),
            37 => 
            array (
                'codMensagem' => 38,
                'codConsulta' => 13,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Boa tarde, Tatiane! Queria conferir minhas vacinas em dia.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-16 17:31:00',
                'dataEnvio' => '2026-10-16 17:31:00',
            ),
            38 => 
            array (
                'codMensagem' => 39,
                'codConsulta' => 13,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Boa tarde, Natalia! Pode me dizer quais voce lembra de ter tomado? Se tiver foto da carteirinha, envie por aqui.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-16 17:34:00',
                'dataEnvio' => '2026-10-16 17:33:00',
            ),
            39 => 
            array (
                'codMensagem' => 40,
                'codConsulta' => 13,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Tomei a de gripe este ano. As outras nao lembro.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-16 17:36:00',
                'dataEnvio' => '2026-10-16 17:36:00',
            ),
            40 => 
            array (
                'codMensagem' => 41,
                'codConsulta' => 13,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Sem problemas. Vou orientar como consultar seu historico e quais vacinas costumam ser indicadas para adultas.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-16 17:41:00',
                'dataEnvio' => '2026-10-16 17:40:00',
            ),
            41 => 
            array (
                'codMensagem' => 42,
                'codConsulta' => 14,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Oi, Priscila. Estou muito ansiosa com as provas e com a rotina na faculdade.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-13 18:01:00',
                'dataEnvio' => '2026-10-13 18:01:00',
            ),
            42 => 
            array (
                'codMensagem' => 43,
                'codConsulta' => 14,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Oi, Daniela. Vamos organizar juntas sua rotina de estudo e sono. Quantas horas voce tem dormido?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-13 18:03:00',
                'dataEnvio' => '2026-10-13 18:03:00',
            ),
            43 => 
            array (
                'codMensagem' => 44,
                'codConsulta' => 14,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Umas 5 horas por noite.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-13 18:05:00',
                'dataEnvio' => '2026-10-13 18:05:00',
            ),
            44 => 
            array (
                'codMensagem' => 45,
                'codConsulta' => 14,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Vamos tentar subir para 7 horas e incluir pausas curtas durante o estudo. Combinado?',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-13 18:08:00',
                'dataEnvio' => '2026-10-13 18:08:00',
            ),
            45 => 
            array (
                'codMensagem' => 46,
                'codConsulta' => 15,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Oi, as vezes me sinto sozinha na escola e nao sei com quem conversar.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-10 16:20:00',
                'dataEnvio' => '2026-10-10 15:00:00',
            ),
            46 => 
            array (
                'codMensagem' => 47,
                'codConsulta' => 15,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Oi, Leticia! Obrigado por confiar. Voce pode conversar com a coordenacao ou um adulto de confianca, e tambem fazer sessoes com a gente aqui. Voce nao esta sozinha.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-10 16:30:00',
                'dataEnvio' => '2026-10-10 16:20:00',
            ),
            47 => 
            array (
                'codMensagem' => 48,
                'codConsulta' => 16,
                'remetenteTipo' => 'usuaria',
                'textoMensagem' => 'Boa noite, doutora. Gostaria de saber com que frequencia devo repetir os testes de IST.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-15 19:31:00',
                'dataEnvio' => '2026-10-15 19:31:00',
            ),
            48 => 
            array (
                'codMensagem' => 49,
                'codConsulta' => 16,
                'remetenteTipo' => 'profissional',
                'textoMensagem' => 'Boa noite, Fernanda! Depende da sua exposicao e historico. Em geral, a testagem e indicada sempre que houver exposicao de risco ou ao iniciar novo relacionamento sem camisinha. Procure a UBS para os testes rapidos, que sao gratuitos.',
                'anexoMensagem' => NULL,
                'lidaEm' => '2026-10-15 19:35:00',
                'dataEnvio' => '2026-10-15 19:34:00',
            ),
        ));
        
        
    }
}