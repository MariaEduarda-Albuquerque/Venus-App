<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbconteudoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbconteudo')->delete();
        
        \DB::table('tbconteudo')->insert(array (
            0 => 
            array (
                'codConteudo' => 1,
                'tituloConteudo' => 'Como identificar sinais de ansiedade no dia a dia',
                'corpoConteudo' => 'A ansiedade se manifesta de formas diferentes em cada pessoa. Neste artigo reunimos sinais fisicos e emocionais mais comuns e quando procurar ajuda profissional.',
                'capaConteudo' => 'capas/conteudo/1.jpg',
                'tempoLeituraMinutos' => 6,
                'codTipoCategoria' => 1,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 1,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-17 18:19:08',
                'dataAtualizacao' => '2026-09-17 18:19:08',
            ),
            1 => 
            array (
                'codConteudo' => 2,
                'tituloConteudo' => 'Menstruacao: o que e normal e quando procurar ajuda',
                'corpoConteudo' => 'O ciclo menstrual costuma durar entre 21 e 35 dias, e o sangramento entre 3 e 7 dias. Pequenas variacoes de um mes para o outro sao comuns, principalmente na adolescencia. Procure uma unidade de saude se a menstruacao ficar ausente por mais de tres meses, se o fluxo for tao intenso que exija trocar o absorvente a cada hora ou se a colica impedir suas atividades.',
                'capaConteudo' => 'capas/conteudo/2.jpg',
                'tempoLeituraMinutos' => 5,
                'codTipoCategoria' => 6,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 1,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-08-20 10:00:00',
                'dataAtualizacao' => '2026-08-24 09:00:00',
            ),
            2 => 
            array (
                'codConteudo' => 3,
                'tituloConteudo' => 'Papanicolau: para que serve e quando fazer',
                'corpoConteudo' => 'O exame preventivo, ou Papanicolau, detecta alteracoes nas celulas do colo do utero antes que virem cancer. No SUS, a recomendacao e que mulheres de 25 a 64 anos que ja iniciaram a vida sexual facam o exame; depois de dois resultados normais com intervalo de um ano, a repeticao passa a ser a cada tres anos. O exame e rapido, gratuito nas UBS e nao deve doer: avise se sentir desconforto.',
                'capaConteudo' => 'capas/conteudo/3.jpg',
                'tempoLeituraMinutos' => 6,
                'codTipoCategoria' => 6,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 5,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-08-22 14:30:00',
                'dataAtualizacao' => '2026-08-27 08:30:00',
            ),
            3 => 
            array (
                'codConteudo' => 4,
                'tituloConteudo' => 'Camisinha interna e externa: como usar corretamente',
                'corpoConteudo' => 'Roteiro do video animado (2 min). A camisinha e o unico metodo que protege ao mesmo tempo contra gravidez e ISTs. Confira a validade e a embalagem, abra com cuidado sem usar dentes ou tesoura, use em todas as relacoes, do inicio ao fim, e descarte no lixo apos o uso. Camisinhas internas e externas sao distribuidas gratuitamente nas UBS.',
                'capaConteudo' => 'capas/conteudo/4.jpg',
                'tempoLeituraMinutos' => 2,
                'codTipoCategoria' => 3,
                'codTipoConteudo' => 3,
                'codProfissionalSaude' => 8,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-08-25 16:00:00',
                'dataAtualizacao' => '2026-08-30 10:00:00',
            ),
            4 => 
            array (
                'codConteudo' => 5,
                'tituloConteudo' => 'HPV: vacina, prevencao e exames',
                'corpoConteudo' => 'O HPV e um virus muito comum, transmitido por contato intimo, e alguns tipos podem causar verrugas genitais e cancer de colo do utero. A vacina e oferecida gratuitamente pelo SUS para o publico-alvo definido pelo Ministerio da Saude, principalmente criancas e adolescentes, antes do inicio da vida sexual. Mesmo vacinada, continue fazendo o exame preventivo e usando camisinha.',
                'capaConteudo' => 'capas/conteudo/5.jpg',
                'tempoLeituraMinutos' => 5,
                'codTipoCategoria' => 3,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 8,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-08-28 11:15:00',
                'dataAtualizacao' => '2026-09-02 09:00:00',
            ),
            5 => 
            array (
                'codConteudo' => 6,
                'tituloConteudo' => 'Pilula, DIU, implante ou injetavel? Compare os metodos',
                'corpoConteudo' => 'Camisinha: protege contra ISTs, uso a cada relacao. Pilula: uso diario, exige regularidade. Injetavel: aplicacao mensal ou trimestral. DIU: metodo de longa duracao, colocado por profissional de saude. Implante: pequeno bastao colocado sob a pele do braco, dura ate tres anos. Apenas a camisinha previne ISTs; a escolha do metodo deve ser conversada com um profissional.',
                'capaConteudo' => 'capas/conteudo/6.jpg',
                'tempoLeituraMinutos' => 4,
                'codTipoCategoria' => 5,
                'codTipoConteudo' => 6,
                'codProfissionalSaude' => 1,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-08-30 09:20:00',
                'dataAtualizacao' => '2026-09-04 09:00:00',
            ),
            6 => 
            array (
                'codConteudo' => 7,
                'tituloConteudo' => 'Contracepcao de emergencia: o que voce precisa saber',
                'corpoConteudo' => 'A contracepcao de emergencia (pilula do dia seguinte) reduz o risco de gravidez apos uma relacao sem protecao ou com falha do metodo. Quanto antes for tomada, melhor: a eficacia e maior nas primeiras 72 horas. Ela nao e abortiva e nao protege contra ISTs. Esta disponivel gratuitamente no SUS e nao deve ser usada como metodo de rotina.',
                'capaConteudo' => 'capas/conteudo/7.jpg',
                'tempoLeituraMinutos' => 4,
                'codTipoCategoria' => 5,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 1,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-01 15:10:00',
                'dataAtualizacao' => '2026-09-06 10:30:00',
            ),
            7 => 
            array (
                'codConteudo' => 8,
                'tituloConteudo' => 'Seus direitos no pre-natal e no parto',
                'corpoConteudo' => 'Toda gestante tem direito ao pre-natal pelo SUS, com pelo menos seis consultas e exames de rotina, ao vinculo com a maternidade onde vai parir e a um acompanhante de sua escolha durante o trabalho de parto, parto e pos-parto imediato (Lei 11.108/2005). Voce tambem tem direito a informacao clara, ao respeito e a nao sofrer procedimentos sem seu consentimento.',
                'capaConteudo' => 'capas/conteudo/8.jpg',
                'tempoLeituraMinutos' => 7,
                'codTipoCategoria' => 4,
                'codTipoConteudo' => 5,
                'codProfissionalSaude' => 4,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-03 13:00:00',
                'dataAtualizacao' => '2026-09-09 09:00:00',
            ),
            8 => 
            array (
                'codConteudo' => 9,
                'tituloConteudo' => 'Sigilo medico para adolescentes: o que diz a lei',
                'corpoConteudo' => 'O Estatuto da Crianca e do Adolescente garante ao adolescente o direito a saude, e o Codigo de Etica Medica protege o sigilo das informacoes de pacientes, inclusive adolescentes. Em regra, o profissional nao deve revelar o conteudo da consulta aos responsaveis sem autorizacao, salvo situacoes de risco grave, como violencia ou risco de vida, em que a protecao e prioridade. Voce pode pedir para ser atendida sozinha.',
                'capaConteudo' => 'capas/conteudo/9.jpg',
                'tempoLeituraMinutos' => 5,
                'codTipoCategoria' => 4,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 2,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-05 10:45:00',
                'dataAtualizacao' => '2026-09-10 11:00:00',
            ),
            9 => 
            array (
                'codConteudo' => 10,
                'tituloConteudo' => 'Gravidez na adolescencia: primeiros passos e onde buscar cuidado',
                'corpoConteudo' => 'Descobrir uma gravidez na adolescencia pode trazer muitas duvidas e emocoes. O primeiro passo e procurar a UBS mais proxima para confirmar a gestacao e iniciar o pre-natal o quanto antes. Voce tem direito a atendimento e a ser acolhida sem julgamentos. Converse com alguem de confianca e conte com a rede de apoio.',
                'capaConteudo' => 'capas/conteudo/10.jpg',
                'tempoLeituraMinutos' => 5,
                'codTipoCategoria' => 2,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 5,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-08 09:30:00',
                'dataAtualizacao' => '2026-09-12 09:00:00',
            ),
            10 => 
            array (
                'codConteudo' => 11,
                'tituloConteudo' => 'Pre-natal: exames e consultas trimestre a trimestre',
                'corpoConteudo' => 'Resumo do pre-natal. No primeiro trimestre, confirme a gestacao, inicie o acido folico conforme orientacao e faca os exames iniciais (sangue, urina e testes rapidos de HIV, sifilis e hepatites). No segundo trimestre, acompanhe o crescimento do bebe e faca o ultrassom morfologico quando indicado. No terceiro trimestre, as consultas ficam mais frequentes e e hora de conhecer a maternidade e montar o plano de parto.',
                'capaConteudo' => 'capas/conteudo/11.jpg',
                'tempoLeituraMinutos' => 3,
                'codTipoCategoria' => 2,
                'codTipoConteudo' => 4,
                'codProfissionalSaude' => 4,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-10 14:00:00',
                'dataAtualizacao' => '2026-09-14 10:00:00',
            ),
            11 => 
            array (
                'codConteudo' => 12,
                'tituloConteudo' => 'Ansiedade e menstruacao: existe relacao?',
                'corpoConteudo' => 'Muitas mulheres percebem mais ansiedade, irritabilidade e tristeza nos dias antes da menstruacao, fase conhecida como sindrome pre-menstrual (TPM). As oscilacoes hormonais podem influenciar o humor. Registrar sintomas no diario do Venus ajuda a identificar padroes. Se os sintomas forem muito intensos e atrapalharem sua rotina, procure avaliacao profissional.',
                'capaConteudo' => 'capas/conteudo/12.jpg',
                'tempoLeituraMinutos' => 5,
                'codTipoCategoria' => 1,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 3,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-12 16:20:00',
                'dataAtualizacao' => '2026-09-16 09:00:00',
            ),
            12 => 
            array (
                'codConteudo' => 13,
                'tituloConteudo' => 'Relacionamento abusivo: sinais de alerta',
                'corpoConteudo' => 'Relacionamentos abusivos nem sempre comecam com agressao fisica. Sinais de alerta incluem ciumes excessivo, controle de roupas, celular e amizades, humilhacoes, isolamento da familia e ameacas. A culpa nunca e da vitima. Se voce se identificou, procure alguem de confianca e ligue para o 180, a Central de Atendimento a Mulher, gratuita e disponivel 24 horas.',
                'capaConteudo' => 'capas/conteudo/13.jpg',
                'tempoLeituraMinutos' => 6,
                'codTipoCategoria' => 1,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 6,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-15 11:10:00',
                'dataAtualizacao' => '2026-09-19 09:30:00',
            ),
            13 => 
            array (
                'codConteudo' => 14,
                'tituloConteudo' => 'Como pedir ajuda: Ligue 180, CVV 188 e rede de protecao',
                'corpoConteudo' => 'Voce nao precisa passar por nada sozinha. O CVV (188) oferece apoio emocional gratuito 24 horas; o Ligue 180 atende mulheres em situacao de violencia; o Disque 100 recebe denuncias de violacoes de direitos humanos, inclusive contra criancas e adolescentes; em emergencias, ligue 190 (policia) ou 192 (SAMU). O CRAS, o CREAS e o Conselho Tutelar tambem acolhem e orientam.',
                'capaConteudo' => 'capas/conteudo/14.jpg',
                'tempoLeituraMinutos' => 4,
                'codTipoCategoria' => 7,
                'codTipoConteudo' => 5,
                'codProfissionalSaude' => 7,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-16 10:00:00',
                'dataAtualizacao' => '2026-09-20 10:00:00',
            ),
            14 => 
            array (
                'codConteudo' => 15,
                'tituloConteudo' => 'Respiracao e aterramento: tecnicas rapidas para crises de ansiedade',
                'corpoConteudo' => 'Roteiro do video curto (1 min 30). Tecnica 5-4-3-2-1: perceba 5 coisas que voce ve, 4 que toca, 3 que ouve, 2 que cheira e 1 que saboreia. Respire inspirando por 4 segundos e soltando o ar por 6. Essas tecnicas ajudam a acalmar o corpo em momentos de crise, mas nao substituem acompanhamento profissional.',
                'capaConteudo' => 'capas/conteudo/15.jpg',
                'tempoLeituraMinutos' => 2,
                'codTipoCategoria' => 1,
                'codTipoConteudo' => 2,
                'codProfissionalSaude' => 3,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-18 15:30:00',
                'dataAtualizacao' => '2026-09-22 09:00:00',
            ),
            15 => 
            array (
                'codConteudo' => 16,
                'tituloConteudo' => 'Higiene intima sem mitos',
                'corpoConteudo' => 'A vagina se autolimpa; lavar apenas a parte externa (vulva) com agua e, se desejar, sabonete neutro e suficiente. Evite duchas vaginais e produtos perfumados, que alteram a flora natural. Corrimento com cheiro forte, coceira ou dor merece avaliacao profissional.',
                'capaConteudo' => 'capas/conteudo/16.jpg',
                'tempoLeituraMinutos' => 4,
                'codTipoCategoria' => 6,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 9,
                'statusConteudo' => 'em_revisao',
                'dataCriacao' => '2026-10-08 10:20:00',
                'dataAtualizacao' => '2026-10-08 10:20:00',
            ),
            16 => 
            array (
                'codConteudo' => 17,
                'tituloConteudo' => 'Alimentacao acessivel e ciclo menstrual',
                'corpoConteudo' => 'Rascunho: ferro e menstruacao intensa; hidratacao; alimentos acessiveis e ricos em ferro (feijao, folhas escuras); quando buscar nutricionista.',
                'capaConteudo' => 'capas/conteudo/17.jpg',
                'tempoLeituraMinutos' => NULL,
                'codTipoCategoria' => 6,
                'codTipoConteudo' => 4,
                'codProfissionalSaude' => 11,
                'statusConteudo' => 'rascunho',
                'dataCriacao' => '2026-10-12 09:00:00',
                'dataAtualizacao' => '2026-10-12 09:00:00',
            ),
            17 => 
            array (
                'codConteudo' => 18,
                'tituloConteudo' => 'Chas e simpatias contra gravidez',
                'corpoConteudo' => 'Conteudo recusado na moderacao. Resumo: o texto afirmava que chas caseiros poderiam substituir metodos contraceptivos, sem qualquer respaldo cientifico.',
                'capaConteudo' => 'capas/conteudo/18.jpg',
                'tempoLeituraMinutos' => 3,
                'codTipoCategoria' => 5,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 10,
                'statusConteudo' => 'recusado',
                'dataCriacao' => '2026-10-10 18:40:00',
                'dataAtualizacao' => '2026-10-10 18:40:00',
            ),
            18 => 
            array (
                'codConteudo' => 19,
                'tituloConteudo' => 'Teste rapido de IST no SUS: como funciona',
                'corpoConteudo' => 'Os testes rapidos para HIV, sifilis e hepatites B e C sao gratuitos no SUS, feitos com uma gota de sangue ou fluido oral, e o resultado sai em cerca de 30 minutos. O atendimento e sigiloso. Se houver exposicao de risco, a profilaxia pos-exposicao (PEP) deve ser iniciada em ate 72 horas.',
                'capaConteudo' => 'capas/conteudo/19.jpg',
                'tempoLeituraMinutos' => 4,
                'codTipoCategoria' => 3,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 8,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-24 09:45:00',
                'dataAtualizacao' => '2026-09-28 09:00:00',
            ),
            19 => 
            array (
                'codConteudo' => 20,
                'tituloConteudo' => 'Violencia obstetrica: reconhecer e denunciar',
                'corpoConteudo' => 'Violencia obstetrica inclui desrespeito, procedimentos sem consentimento, negativa de acompanhante e xingamentos durante a gestacao, parto ou pos-parto. Voce pode registrar reclamacao na ouvidoria do SUS (136) e buscar a Defensoria Publica.',
                'capaConteudo' => 'capas/conteudo/20.jpg',
                'tempoLeituraMinutos' => 4,
                'codTipoCategoria' => 4,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 4,
                'statusConteudo' => 'em_revisao',
                'dataCriacao' => '2026-10-11 14:00:00',
                'dataAtualizacao' => '2026-10-11 14:00:00',
            ),
        ));
        
        
    }
}