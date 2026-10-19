<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbforumpublicacaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbforumpublicacao')->delete();
        
        \DB::table('tbforumpublicacao')->insert(array (
            0 => 
            array (
                'codForumPublicacao' => 1,
                'codUsuario' => 1,
                'codTipoCategoria' => 1,
                'tituloPublicacao' => 'Alguem mais sente ansiedade antes da menstruacao?',
                'textoPublicacao' => 'Percebi que nos dias anteriores ao ciclo fico muito mais ansiosa. Isso e comum? Como voces lidam?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-09-17 18:19:08',
            ),
            1 => 
            array (
                'codForumPublicacao' => 2,
                'codUsuario' => 3,
                'codTipoCategoria' => 5,
                'tituloPublicacao' => 'DIU ou pilula: qual voces escolheram?',
                'textoPublicacao' => 'Uso pilula ha dois anos mas esqueco de tomar algumas vezes. Estou pensando em trocar por um metodo de longa duracao. Quem usa DIU ou implante, como foi a experiencia?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-09-18 20:15:00',
            ),
            2 => 
            array (
                'codForumPublicacao' => 3,
                'codUsuario' => 4,
                'codTipoCategoria' => 3,
                'tituloPublicacao' => 'Onde posso fazer teste de IST sem ninguem ficar sabendo?',
                'textoPublicacao' => 'Sou adolescente e fiquei com receio de ter pego alguma IST. Quero fazer o teste, mas nao quero contar para meus pais. Tem como?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 1,
                'dataPublicacao' => '2026-09-20 22:40:00',
            ),
            3 => 
            array (
                'codForumPublicacao' => 4,
                'codUsuario' => 9,
                'codTipoCategoria' => 2,
                'tituloPublicacao' => 'Primeira gravidez aos 41: dicas de pre-natal?',
                'textoPublicacao' => 'Estou na 9a semana e muito feliz, mas tambem com medo por causa da idade. Alguem passou por isso? O que perguntar nas consultas?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-09-21 09:30:00',
            ),
            4 => 
            array (
                'codForumPublicacao' => 5,
                'codUsuario' => 12,
                'codTipoCategoria' => 6,
                'tituloPublicacao' => 'Menstruacao atrasada ha 10 dias, o que fazer?',
                'textoPublicacao' => 'Meu ciclo e regular e agora atrasou 10 dias. Estou nervosa. Devo fazer teste de farmacia ou ir direto na UBS?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-09-22 19:05:00',
            ),
            5 => 
            array (
                'codForumPublicacao' => 6,
                'codUsuario' => 6,
                'codTipoCategoria' => 4,
                'tituloPublicacao' => 'Posso ser atendida na UBS sem meus pais?',
                'textoPublicacao' => 'Tenho 17 anos e queria conversar com um medico sobre contraceptivos. Preciso levar meus pais? Eles ficam sabendo o que eu falei?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 1,
                'dataPublicacao' => '2026-09-23 21:50:00',
            ),
            6 => 
            array (
                'codForumPublicacao' => 7,
                'codUsuario' => 17,
                'codTipoCategoria' => 1,
                'tituloPublicacao' => 'Parei meus remedios e estou otima, voces deviam parar tambem',
                'textoPublicacao' => 'Parei de tomar meu antidepressivo por conta propria e me sinto otima. Acho que todas deviam largar os remedios.',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-09-17 17:50:00',
            ),
            7 => 
            array (
                'codForumPublicacao' => 8,
                'codUsuario' => 13,
                'codTipoCategoria' => 7,
                'tituloPublicacao' => 'Como sair de um relacionamento abusivo?',
                'textoPublicacao' => 'Estou ha 3 anos com uma pessoa que controla meu celular e minhas roupas. Tenho medo de terminar. Por onde comecar?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 1,
                'dataPublicacao' => '2026-09-25 23:10:00',
            ),
            8 => 
            array (
                'codForumPublicacao' => 9,
                'codUsuario' => 10,
                'codTipoCategoria' => 1,
                'tituloPublicacao' => 'Dicas para crises de ansiedade em transporte lotado',
                'textoPublicacao' => 'Sempre que pego onibus lotado, sinto o coracao disparar e falta de ar. O que voces fazem para se acalmar?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-09-27 07:40:00',
            ),
            9 => 
            array (
                'codForumPublicacao' => 10,
                'codUsuario' => 7,
                'codTipoCategoria' => 6,
                'tituloPublicacao' => 'Colica forte todo mes: e normal?',
                'textoPublicacao' => 'Desde a adolescencia sofro com colicas que me impedem de ir trabalhar. Isso e normal ou devo investigar?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-09-28 21:20:00',
            ),
            10 => 
            array (
                'codForumPublicacao' => 11,
                'codUsuario' => 2,
                'codTipoCategoria' => 5,
                'tituloPublicacao' => 'Como foi colocar o implante? Quem ja usa?',
                'textoPublicacao' => 'Estou pensando em colocar o implante. Alguem pode contar como foi, se doi e como ficou o ciclo?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-10-01 14:20:00',
            ),
            11 => 
            array (
                'codForumPublicacao' => 12,
                'codUsuario' => 14,
                'codTipoCategoria' => 4,
                'tituloPublicacao' => 'Me senti desrespeitada no parto: o que posso fazer?',
                'textoPublicacao' => 'Fui xingada durante o trabalho de parto ha dois anos e ate hoje isso me incomoda. Existe algo que eu possa fazer?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-10-03 16:30:00',
            ),
            12 => 
            array (
                'codForumPublicacao' => 13,
                'codUsuario' => 16,
                'codTipoCategoria' => 2,
                'tituloPublicacao' => 'Primeiro trimestre: enjoo e emocoes',
                'textoPublicacao' => 'Estou com 5 semanas e os enjoos nao dao tregua. Alem disso, estou muito emotiva. Alguem tem dicas?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-10-08 21:00:00',
            ),
            13 => 
            array (
                'codForumPublicacao' => 14,
                'codUsuario' => 20,
                'codTipoCategoria' => 1,
                'tituloPublicacao' => 'Grupo de apoio para maes solo?',
                'textoPublicacao' => 'Alguem sabe de grupos de apoio para maes que criam filhos sozinhas? Estou exausta e sem rede.',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-10-09 22:00:00',
            ),
            14 => 
            array (
                'codForumPublicacao' => 15,
                'codUsuario' => 19,
                'codTipoCategoria' => 7,
                'tituloPublicacao' => 'Quando acionar o Conselho Tutelar?',
                'textoPublicacao' => 'Uma amiga da escola esta passando por uma situacao dificil em casa. Quando devemos acionar o Conselho Tutelar?',
                'anexoPublicacao' => NULL,
                'publicadoAnonimo' => 0,
                'dataPublicacao' => '2026-10-11 18:30:00',
            ),
        ));
        
        
    }
}