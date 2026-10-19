<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbforumrespostaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbforumresposta')->delete();
        
        \DB::table('tbforumresposta')->insert(array (
            0 => 
            array (
                'codForumResposta' => 1,
                'codForumPublicacao' => 1,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 1,
                'textoResposta' => 'Sim, e comum. A variacao hormonal da fase lutea pode intensificar sintomas de ansiedade. Registrar os sintomas ajuda muito na avaliacao.',
                'dataResposta' => '2026-09-17 18:19:08',
            ),
            1 => 
            array (
                'codForumResposta' => 2,
                'codForumPublicacao' => 1,
                'autorTipo' => 'usuaria',
                'codUsuario' => 5,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Comigo tambem! Anoto no diario do Venus e percebo que melhora quando o ciclo comeca. Ajuda muito.',
                'dataResposta' => '2026-09-18 07:20:00',
            ),
            2 => 
            array (
                'codForumResposta' => 3,
                'codForumPublicacao' => 1,
                'autorTipo' => 'usuaria',
                'codUsuario' => 10,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Eu faco respiracao e caminhada nos dias antes. Conversar com psicologa tambem ajudou.',
                'dataResposta' => '2026-09-18 12:00:00',
            ),
            3 => 
            array (
                'codForumResposta' => 4,
                'codForumPublicacao' => 2,
                'autorTipo' => 'usuaria',
                'codUsuario' => 11,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Uso DIU ha dois anos. Nos primeiros meses a colica aumentou, depois estabilizou. Vale conversar com a ginecologista na UBS.',
                'dataResposta' => '2026-09-19 10:00:00',
            ),
            4 => 
            array (
                'codForumResposta' => 5,
                'codForumPublicacao' => 2,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 1,
                'textoResposta' => 'Oi, Jessica! Metodos de longa duracao, como DIU e implante, nao dependem de lembrar todo dia e sao muito eficazes. Cada um tem indicacoes e efeitos diferentes, entao vale uma avaliacao individual. A camisinha continua sendo a unica protecao contra ISTs.',
                'dataResposta' => '2026-09-19 11:30:00',
            ),
            5 => 
            array (
                'codForumResposta' => 6,
                'codForumPublicacao' => 3,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 8,
                'textoResposta' => 'Oi! Os testes rapidos de HIV, sifilis e hepatites sao gratuitos nas UBS e o atendimento e sigiloso. Se voce teve uma exposicao recente, procure a unidade o quanto antes, pois existem medidas de prevencao que precisam ser iniciadas em ate 72 horas.',
                'dataResposta' => '2026-09-21 08:30:00',
            ),
            6 => 
            array (
                'codForumResposta' => 7,
                'codForumPublicacao' => 3,
                'autorTipo' => 'usuaria',
                'codUsuario' => 8,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Fui na UBS e fiz o teste, o pessoal foi super gentil. Nao precisa ter medo.',
                'dataResposta' => '2026-09-21 12:45:00',
            ),
            7 => 
            array (
                'codForumResposta' => 8,
                'codForumPublicacao' => 4,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 5,
                'textoResposta' => 'Parabens pela gestacao! Iniciar o pre-natal cedo e o melhor caminho. Pergunte sobre exames, vacinas, acido folico e sinais de alerta para procurar a maternidade. A idade materna pede um acompanhamento mais proximo, mas a maioria das gestacoes evolui bem.',
                'dataResposta' => '2026-09-21 15:10:00',
            ),
            8 => 
            array (
                'codForumResposta' => 9,
                'codForumPublicacao' => 4,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 4,
                'textoResposta' => 'Complementando: leve suas duvidas anotadas e converse sobre o plano de parto. Voce tem direito a acompanhante durante o trabalho de parto, parto e pos-parto imediato.',
                'dataResposta' => '2026-09-22 09:00:00',
            ),
            9 => 
            array (
                'codForumResposta' => 10,
                'codForumPublicacao' => 4,
                'autorTipo' => 'usuaria',
                'codUsuario' => 5,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Tive meu segundo filho aos 35 e deu tudo certo. Tire todas as duvidas com a equipe, nao tenha vergonha.',
                'dataResposta' => '2026-09-22 11:00:00',
            ),
            10 => 
            array (
                'codForumResposta' => 11,
                'codForumPublicacao' => 5,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 5,
                'textoResposta' => 'Oi, Vitoria! Atrasos podem ter varias causas, como estresse e mudancas de rotina, mas tambem gravidez. Se houve relacao sem protecao, um teste de farmacia ou o teste rapido na UBS pode ser feito. Se o atraso persistir ou houver dor intensa, procure atendimento.',
                'dataResposta' => '2026-09-22 21:00:00',
            ),
            11 => 
            array (
                'codForumResposta' => 12,
                'codForumPublicacao' => 5,
                'autorTipo' => 'usuaria',
                'codUsuario' => 3,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Ja passei por isso, era so estresse. Mas fiz o teste para ficar tranquila.',
                'dataResposta' => '2026-09-23 07:00:00',
            ),
            12 => 
            array (
                'codForumResposta' => 13,
                'codForumPublicacao' => 6,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 2,
                'textoResposta' => 'Oi! Em regra, voce pode ser atendida sozinha e a consulta e sigilosa. As excecoes sao situacoes de risco grave, como violencia. Na UBS, peca para conversar a sos com o profissional.',
                'dataResposta' => '2026-09-24 08:20:00',
            ),
            13 => 
            array (
                'codForumResposta' => 14,
                'codForumPublicacao' => 7,
                'autorTipo' => 'usuaria',
                'codUsuario' => 5,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Renata, cuidado: parar antidepressivo sem orientacao pode causar efeitos serios. Converse com seu medico antes de qualquer mudanca.',
                'dataResposta' => '2026-09-17 19:00:00',
            ),
            14 => 
            array (
                'codForumResposta' => 15,
                'codForumPublicacao' => 7,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 3,
                'textoResposta' => 'Concordo com a Thais. Fico feliz que voce esteja se sentindo bem, mas suspender medicacao por conta propria e arriscado e nao deve ser recomendado a outras pessoas. Procure seu medico ou o CAPS da sua regiao.',
                'dataResposta' => '2026-09-17 20:30:00',
            ),
            15 => 
            array (
                'codForumResposta' => 16,
                'codForumPublicacao' => 8,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 7,
                'textoResposta' => 'Voce nao esta sozinha e a culpa nao e sua. Ligue 180, gratuito e 24 horas. Procure tambem o CRAS ou o CREAS da sua regiao para orientacao. Se estiver em perigo imediato, ligue 190.',
                'dataResposta' => '2026-09-26 08:00:00',
            ),
            16 => 
            array (
                'codForumResposta' => 17,
                'codForumPublicacao' => 8,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 3,
                'textoResposta' => 'Pense em um plano de seguranca: separe documentos, tenha contatos de confianca e um lugar seguro para ir. Dar o primeiro passo e dificil, mas existe ajuda.',
                'dataResposta' => '2026-09-26 09:30:00',
            ),
            17 => 
            array (
                'codForumResposta' => 18,
                'codForumPublicacao' => 8,
                'autorTipo' => 'usuaria',
                'codUsuario' => 13,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Obrigada pelas respostas. Vou ligar para o 180 ainda hoje.',
                'dataResposta' => '2026-09-26 12:00:00',
            ),
            18 => 
            array (
                'codForumResposta' => 19,
                'codForumPublicacao' => 9,
                'autorTipo' => 'usuaria',
                'codUsuario' => 5,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Coloco o fone e respiro contando ate 4 e soltando ate 6. Ajuda demais.',
                'dataResposta' => '2026-09-27 20:00:00',
            ),
            19 => 
            array (
                'codForumResposta' => 20,
                'codForumPublicacao' => 9,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 3,
                'textoResposta' => 'Experimente a tecnica 5-4-3-2-1, que esta no nosso video curto. Se as crises forem frequentes, vale buscar acompanhamento.',
                'dataResposta' => '2026-09-28 09:00:00',
            ),
            20 => 
            array (
                'codForumResposta' => 21,
                'codForumPublicacao' => 9,
                'autorTipo' => 'usuaria',
                'codUsuario' => 17,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Isso e so frescura, quem tem ansiedade so quer atencao.',
                'dataResposta' => '2026-09-28 12:30:00',
            ),
            21 => 
            array (
                'codForumResposta' => 22,
                'codForumPublicacao' => 10,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 1,
                'textoResposta' => 'Colica leve a moderada pode ser comum, mas dor que impede suas atividades merece avaliacao ginecologica. Pode haver causas tratavies, como a endometriose. Procure a UBS.',
                'dataResposta' => '2026-09-29 10:00:00',
            ),
            22 => 
            array (
                'codForumResposta' => 23,
                'codForumPublicacao' => 10,
                'autorTipo' => 'usuaria',
                'codUsuario' => 14,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Eu tinha o mesmo problema, fiz ultrassom e a ginecologista ajudou. Vale investigar.',
                'dataResposta' => '2026-09-29 08:30:00',
            ),
            23 => 
            array (
                'codForumResposta' => 24,
                'codForumPublicacao' => 11,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 1,
                'textoResposta' => 'O implante e um metodo de longa duracao muito eficaz, colocado sob a pele do braco com anestesia local. Pode alterar o padrao de sangramento. Podemos conversar com calma em consulta.',
                'dataResposta' => '2026-10-01 16:00:00',
            ),
            24 => 
            array (
                'codForumResposta' => 25,
                'codForumPublicacao' => 11,
                'autorTipo' => 'usuaria',
                'codUsuario' => 8,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Nao tenho implante, mas uma amiga conta que e rapido e o que mais incomodou foi o sangramento irregular nos primeiros meses.',
                'dataResposta' => '2026-10-02 11:00:00',
            ),
            25 => 
            array (
                'codForumResposta' => 26,
                'codForumPublicacao' => 12,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 4,
                'textoResposta' => 'Sinto muito pelo que viveu. O que voce descreve pode ser considerado violencia obstetrica. Voce pode registrar manifestacao na ouvidoria do SUS (136) e buscar a Defensoria Publica. Tambem pode procurar acolhimento psicologico.',
                'dataResposta' => '2026-10-03 18:00:00',
            ),
            26 => 
            array (
                'codForumResposta' => 27,
                'codForumPublicacao' => 12,
                'autorTipo' => 'usuaria',
                'codUsuario' => 9,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Que situacao horrivel. Voce nao merecia isso. Espero que consiga apoio.',
                'dataResposta' => '2026-10-04 07:30:00',
            ),
            27 => 
            array (
                'codForumResposta' => 28,
                'codForumPublicacao' => 13,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 4,
                'textoResposta' => 'Os enjoos sao comuns no primeiro trimestre. Fracione as refeicoes, evite jejum longo e converse com seu pre-natalista se nao conseguir se alimentar ou beber agua.',
                'dataResposta' => '2026-10-09 08:00:00',
            ),
            28 => 
            array (
                'codForumResposta' => 29,
                'codForumPublicacao' => 13,
                'autorTipo' => 'usuaria',
                'codUsuario' => 9,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Aqui tambem! Biscoito de agua e sal antes de levantar da cama ajudou.',
                'dataResposta' => '2026-10-09 09:10:00',
            ),
            29 => 
            array (
                'codForumResposta' => 30,
                'codForumPublicacao' => 14,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 7,
                'textoResposta' => 'O CRAS da sua regiao costuma ter grupos e servicos para familias, alem de orientar sobre beneficios. Vale fazer um acolhimento la.',
                'dataResposta' => '2026-10-10 08:30:00',
            ),
            30 => 
            array (
                'codForumResposta' => 31,
                'codForumPublicacao' => 14,
                'autorTipo' => 'usuaria',
                'codUsuario' => 5,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Fe, estou aqui! Tambem crio meus filhos sozinha boa parte do tempo. Se quiser trocar ideia, me chama.',
                'dataResposta' => '2026-10-10 12:00:00',
            ),
            31 => 
            array (
                'codForumResposta' => 32,
                'codForumPublicacao' => 15,
                'autorTipo' => 'profissional',
                'codUsuario' => NULL,
                'codProfissionalSaude' => 7,
                'textoResposta' => 'O Conselho Tutelar deve ser acionado quando ha suspeita ou confirmacao de violacao de direitos de crianca ou adolescente, como violencia, negligencia ou abandono. O Disque 100 tambem recebe denuncias. Em risco imediato, ligue 190.',
                'dataResposta' => '2026-10-12 08:15:00',
            ),
            32 => 
            array (
                'codForumResposta' => 33,
                'codForumPublicacao' => 15,
                'autorTipo' => 'usuaria',
                'codUsuario' => 20,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Importante conversar com um adulto de confianca na escola, como a coordenacao.',
                'dataResposta' => '2026-10-12 10:00:00',
            ),
            33 => 
            array (
                'codForumResposta' => 34,
                'codForumPublicacao' => 5,
                'autorTipo' => 'usuaria',
                'codUsuario' => 14,
                'codProfissionalSaude' => NULL,
                'textoResposta' => 'Eu tomo cha de canela e arruda quando atrasa, funciona sempre.',
                'dataResposta' => '2026-09-23 08:00:00',
            ),
        ));
        
        
    }
}