<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbpublicacaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbpublicacao')->delete();
        
        \DB::table('tbpublicacao')->insert(array (
            0 => 
            array (
                'codPublicacao' => 1,
                'tituloPublicacao' => 'Como identificar sinais de ansiedade no dia a dia',
                'descricaoPublicacao' => 'Um guia rapido com os principais sinais de alerta e orientacoes de autocuidado.',
                'codConteudo' => 1,
                'dataPublicacao' => '2026-09-17 18:19:08',
                'visualizacoes' => 342,
                'tempoMedioLeituraSeg' => 215,
            ),
            1 => 
            array (
                'codPublicacao' => 2,
                'tituloPublicacao' => 'Menstruacao: o que e normal e quando procurar ajuda',
                'descricaoPublicacao' => 'Entenda as variacoes normais do ciclo e os sinais que pedem avaliacao.',
                'codConteudo' => 2,
                'dataPublicacao' => '2026-08-24 09:00:00',
                'visualizacoes' => 1280,
                'tempoMedioLeituraSeg' => 190,
            ),
            2 => 
            array (
                'codPublicacao' => 3,
                'tituloPublicacao' => 'Papanicolau: para que serve e quando fazer',
                'descricaoPublicacao' => 'Como funciona o exame preventivo e com que frequencia fazer.',
                'codConteudo' => 3,
                'dataPublicacao' => '2026-08-27 08:30:00',
                'visualizacoes' => 965,
                'tempoMedioLeituraSeg' => 230,
            ),
            3 => 
            array (
                'codPublicacao' => 4,
                'tituloPublicacao' => 'Camisinha interna e externa: como usar corretamente',
                'descricaoPublicacao' => 'Passo a passo animado para usar a camisinha com seguranca.',
                'codConteudo' => 4,
                'dataPublicacao' => '2026-08-30 10:00:00',
                'visualizacoes' => 2104,
                'tempoMedioLeituraSeg' => 105,
            ),
            4 => 
            array (
                'codPublicacao' => 5,
                'tituloPublicacao' => 'HPV: vacina, prevencao e exames',
                'descricaoPublicacao' => 'O que voce precisa saber sobre HPV, vacina e prevencao.',
                'codConteudo' => 5,
                'dataPublicacao' => '2026-09-02 09:00:00',
                'visualizacoes' => 874,
                'tempoMedioLeituraSeg' => 200,
            ),
            5 => 
            array (
                'codPublicacao' => 6,
                'tituloPublicacao' => 'Pilula, DIU, implante ou injetavel? Compare os metodos',
                'descricaoPublicacao' => 'Card comparativo para ajudar a escolher o metodo contraceptivo.',
                'codConteudo' => 6,
                'dataPublicacao' => '2026-09-04 09:00:00',
                'visualizacoes' => 1530,
                'tempoMedioLeituraSeg' => 150,
            ),
            6 => 
            array (
                'codPublicacao' => 7,
                'tituloPublicacao' => 'Contracepcao de emergencia: o que voce precisa saber',
                'descricaoPublicacao' => 'Quando e como usar a pilula do dia seguinte.',
                'codConteudo' => 7,
                'dataPublicacao' => '2026-09-06 10:30:00',
                'visualizacoes' => 1892,
                'tempoMedioLeituraSeg' => 170,
            ),
            7 => 
            array (
                'codPublicacao' => 8,
                'tituloPublicacao' => 'Seus direitos no pre-natal e no parto',
                'descricaoPublicacao' => 'Cartilha com os principais direitos da gestante no SUS.',
                'codConteudo' => 8,
                'dataPublicacao' => '2026-09-09 09:00:00',
                'visualizacoes' => 702,
                'tempoMedioLeituraSeg' => 260,
            ),
            8 => 
            array (
                'codPublicacao' => 9,
                'tituloPublicacao' => 'Sigilo medico para adolescentes: o que diz a lei',
                'descricaoPublicacao' => 'Entenda seu direito ao atendimento e ao sigilo na adolescencia.',
                'codConteudo' => 9,
                'dataPublicacao' => '2026-09-10 11:00:00',
                'visualizacoes' => 1456,
                'tempoMedioLeituraSeg' => 210,
            ),
            9 => 
            array (
                'codPublicacao' => 10,
                'tituloPublicacao' => 'Gravidez na adolescencia: primeiros passos e onde buscar cuidado',
                'descricaoPublicacao' => 'Orientacoes de acolhimento e cuidado para adolescentes gestantes.',
                'codConteudo' => 10,
                'dataPublicacao' => '2026-09-12 09:00:00',
                'visualizacoes' => 811,
                'tempoMedioLeituraSeg' => 205,
            ),
            10 => 
            array (
                'codPublicacao' => 11,
                'tituloPublicacao' => 'Pre-natal: exames e consultas trimestre a trimestre',
                'descricaoPublicacao' => 'Infografico com o que esperar de cada fase do pre-natal.',
                'codConteudo' => 11,
                'dataPublicacao' => '2026-09-14 10:00:00',
                'visualizacoes' => 623,
                'tempoMedioLeituraSeg' => 120,
            ),
            11 => 
            array (
                'codPublicacao' => 12,
                'tituloPublicacao' => 'Ansiedade e menstruacao: existe relacao?',
                'descricaoPublicacao' => 'Como as variacoes hormonais podem afetar o humor.',
                'codConteudo' => 12,
                'dataPublicacao' => '2026-09-16 09:00:00',
                'visualizacoes' => 988,
                'tempoMedioLeituraSeg' => 195,
            ),
            12 => 
            array (
                'codPublicacao' => 13,
                'tituloPublicacao' => 'Relacionamento abusivo: sinais de alerta',
                'descricaoPublicacao' => 'Reconheca sinais de violencia psicologica e saiba onde pedir ajuda.',
                'codConteudo' => 13,
                'dataPublicacao' => '2026-09-19 09:30:00',
                'visualizacoes' => 1175,
                'tempoMedioLeituraSeg' => 240,
            ),
            13 => 
            array (
                'codPublicacao' => 14,
                'tituloPublicacao' => 'Como pedir ajuda: Ligue 180, CVV 188 e rede de protecao',
                'descricaoPublicacao' => 'Cartilha com telefones e servicos de apoio e protecao.',
                'codConteudo' => 14,
                'dataPublicacao' => '2026-09-20 10:00:00',
                'visualizacoes' => 1640,
                'tempoMedioLeituraSeg' => 180,
            ),
            14 => 
            array (
                'codPublicacao' => 15,
                'tituloPublicacao' => 'Respiracao e aterramento: tecnicas rapidas para crises de ansiedade',
                'descricaoPublicacao' => 'Duas tecnicas simples para se acalmar em momentos de ansiedade.',
                'codConteudo' => 15,
                'dataPublicacao' => '2026-09-22 09:00:00',
                'visualizacoes' => 1320,
                'tempoMedioLeituraSeg' => 95,
            ),
            15 => 
            array (
                'codPublicacao' => 16,
                'tituloPublicacao' => 'Teste rapido de IST no SUS: como funciona',
                'descricaoPublicacao' => 'Saiba onde fazer e o que esperar do teste rapido.',
                'codConteudo' => 19,
                'dataPublicacao' => '2026-09-28 09:00:00',
                'visualizacoes' => 1018,
                'tempoMedioLeituraSeg' => 175,
            ),
        ));
        
        
    }
}