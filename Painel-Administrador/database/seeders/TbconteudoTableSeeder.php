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
        'tituloConteudo' => 'A importancia da educacao sexual na adolescencia',
        'corpoConteudo' => 'A educacao sexual ajuda adolescentes a compreenderem o proprio corpo, estabelecerem limites e tomarem decisoes informadas sobre a saude e os relacionamentos.',
        'capaConteudo' => 'capas/conteudo/2.jpg',
        'tempoLeituraMinutos' => 7,
        'codTipoCategoria' => 2,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 1,
        'statusConteudo' => 'publicado',
        'dataCriacao' => '2026-09-18 09:25:14',
        'dataAtualizacao' => '2026-09-18 09:25:14',
    ),
    2 =>
    array (
        'codConteudo' => 3,
        'tituloConteudo' => 'Prevencao e informacoes sobre infeccoes sexualmente transmissiveis',
        'corpoConteudo' => 'As infeccoes sexualmente transmissiveis podem ser prevenidas por meio de informacao, uso de preservativos, testagem e acompanhamento nos servicos de saude.',
        'capaConteudo' => 'capas/conteudo/3.jpg',
        'tempoLeituraMinutos' => 8,
        'codTipoCategoria' => 2,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 1,
        'statusConteudo' => 'publicado',
        'dataCriacao' => '2026-09-18 14:42:33',
        'dataAtualizacao' => '2026-09-18 14:42:33',
    ),
    3 =>
    array (
        'codConteudo' => 4,
        'tituloConteudo' => 'Saude mental e a importancia de pedir ajuda',
        'corpoConteudo' => 'Cuidar da saude mental envolve reconhecer sentimentos, buscar apoio e procurar profissionais quando as dificuldades interferem na rotina e no bem-estar.',
        'capaConteudo' => 'capas/conteudo/4.jpg',
        'tempoLeituraMinutos' => 5,
        'codTipoCategoria' => 1,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 3,
        'statusConteudo' => 'publicado',
        'dataCriacao' => '2026-09-19 10:15:27',
        'dataAtualizacao' => '2026-09-19 10:15:27',
    ),
    4 =>
    array (
        'codConteudo' => 5,
        'tituloConteudo' => 'Conhecendo o ciclo menstrual',
        'corpoConteudo' => 'O ciclo menstrual envolve mudancas hormonais que podem variar de pessoa para pessoa. Conhecer suas fases ajuda a compreender o proprio corpo e identificar alteracoes que merecem avaliacao.',
        'capaConteudo' => 'capas/conteudo/5.jpg',
        'tempoLeituraMinutos' => 6,
        'codTipoCategoria' => 3,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 1,
        'statusConteudo' => 'publicado',
        'dataCriacao' => '2026-09-19 16:38:49',
        'dataAtualizacao' => '2026-09-19 16:38:49',
    ),
    5 =>
    array (
        'codConteudo' => 6,
        'tituloConteudo' => 'Gravidez na adolescencia: informacao e acolhimento',
        'corpoConteudo' => 'A gravidez na adolescencia pode trazer desafios emocionais, sociais e relacionados a saude. O acesso a informacao confiavel e a uma rede de apoio e importante para cada pessoa.',
        'capaConteudo' => 'capas/conteudo/6.jpg',
        'tempoLeituraMinutos' => 9,
        'codTipoCategoria' => 2,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 1,
        'statusConteudo' => 'publicado',
        'dataCriacao' => '2026-09-20 11:22:05',
        'dataAtualizacao' => '2026-09-20 11:22:05',
    ),
    6 =>
    array (
        'codConteudo' => 7,
        'tituloConteudo' => 'Alimentacao equilibrada e saude na adolescencia',
        'corpoConteudo' => 'Uma alimentacao equilibrada contribui para o crescimento, a energia e o bem-estar. Conheca praticas alimentares saudaveis e a importancia de uma relacao positiva com a comida.',
        'capaConteudo' => 'capas/conteudo/7.jpg',
        'tempoLeituraMinutos' => 5,
        'codTipoCategoria' => 4,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 6,
        'statusConteudo' => 'publicado',
        'dataCriacao' => '2026-09-20 12:40:18',
        'dataAtualizacao' => '2026-09-20 12:40:18',
    ),
    7 =>
    array (
        'codConteudo' => 8,
        'tituloConteudo' => 'Quando procurar atendimento ginecologico',
        'corpoConteudo' => 'O acompanhamento ginecologico pode ajudar na prevencao e na identificacao de alteracoes na saude. Saiba como funciona o atendimento e quais duvidas podem ser levadas ao profissional.',
        'capaConteudo' => 'capas/conteudo/8.jpg',
        'tempoLeituraMinutos' => 7,
        'codTipoCategoria' => 3,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 1,
        'statusConteudo' => 'rascunho',
        'dataCriacao' => '2026-09-20 13:55:42',
        'dataAtualizacao' => '2026-09-20 13:55:42',
    ),
    8 =>
    array (
        'codConteudo' => 9,
        'tituloConteudo' => 'Autoestima e imagem corporal',
        'corpoConteudo' => 'A autoestima pode ser influenciada por experiencias pessoais e pela pressao social. Desenvolver uma relacao respeitosa consigo mesma e buscar apoio sao atitudes importantes para o bem-estar.',
        'capaConteudo' => 'capas/conteudo/9.jpg',
        'tempoLeituraMinutos' => 6,
        'codTipoCategoria' => 1,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 3,
        'statusConteudo' => 'publicado',
        'dataCriacao' => '2026-09-20 15:10:27',
        'dataAtualizacao' => '2026-09-20 15:10:27',
    ),
    9 =>
    array (
        'codConteudo' => 10,
        'tituloConteudo' => 'Como funciona o atendimento pelo SUS',
        'corpoConteudo' => 'O Sistema Unico de Saude oferece servicos de prevencao, atendimento e acompanhamento. Entenda como buscar uma unidade de saude e conhecer os servicos disponiveis na sua regiao.',
        'capaConteudo' => 'capas/conteudo/10.jpg',
        'tempoLeituraMinutos' => 8,
        'codTipoCategoria' => 5,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 1,
        'statusConteudo' => 'publicado',
        'dataCriacao' => '2026-09-20 16:25:49',
        'dataAtualizacao' => '2026-09-20 16:25:49',
    ),
    10 =>
    array (
        'codConteudo' => 11,
        'tituloConteudo' => 'A importancia do sono para a saude',
        'corpoConteudo' => 'Dormir bem contribui para a memoria, a concentracao e o equilibrio emocional. Conheca habitos que podem ajudar a melhorar a qualidade do sono e quando buscar orientacao.',
        'capaConteudo' => 'capas/conteudo/11.jpg',
        'tempoLeituraMinutos' => 5,
        'codTipoCategoria' => 4,
        'codTipoConteudo' => 1,
        'codProfissionalSaude' => 6,
        'statusConteudo' => 'rascunho',
        'dataCriacao' => '2026-09-20 18:05:42',
        'dataAtualizacao' => '2026-09-20 18:05:42',
    ),
));
        
        
    }
}