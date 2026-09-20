<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbdenunciaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbdenuncia')->delete();
        
        \DB::table('tbdenuncia')->insert(array (
            0 => 
            array (
                'codDenuncia' => 1,
                'tipoAlvo' => 'forum_publicacao',
                'codAlvo' => 1,
                'codUsuarioDenunciante' => 1,
                'motivoDenuncia' => 'Informacao de saude possivelmente incorreta',
                'comentarioDenuncia' => 'A publicacao sugere interromper medicacao sem orientacao medica.',
                'gravidade' => 'alta',
                'statusDenuncia' => 'resolvida',
                'dataDenuncia' => '2026-09-17 18:19:08',
            ),
            1 =>
            array (
                'codDenuncia' => 2,
                'tipoAlvo' => 'forum_resposta',
                'codAlvo' => 2,
                'codUsuarioDenunciante' => 2,
                'motivoDenuncia' => 'Conteudo ofensivo',
                'comentarioDenuncia' => 'A resposta utiliza linguagem ofensiva e desrespeitosa contra outros usuarios.',
                'gravidade' => 'media',
                'statusDenuncia' => 'pendente',
                'dataDenuncia' => '2026-09-18 09:25:14',
            ),
            2 =>
            array (
                'codDenuncia' => 3,
                'tipoAlvo' => 'mensagem_chat',
                'codAlvo' => 3,
                'codUsuarioDenunciante' => 3,
                'motivoDenuncia' => 'Assedio ou comportamento inadequado',
                'comentarioDenuncia' => 'O usuario enviou mensagens insistentes e inadequadas durante a conversa.',
                'gravidade' => 'alta',
                'statusDenuncia' => 'em_analise',
                'dataDenuncia' => '2026-09-18 14:42:33',
            ),
            3 =>
            array (
                'codDenuncia' => 4,
                'tipoAlvo' => 'forum_publicacao',
                'codAlvo' => 4,
                'codUsuarioDenunciante' => 1,
                'motivoDenuncia' => 'Divulgacao de informacao falsa',
                'comentarioDenuncia' => 'A publicacao apresenta informacoes sem fontes confiaveis sobre saude.',
                'gravidade' => 'alta',
                'statusDenuncia' => 'pendente',
                'dataDenuncia' => '2026-09-19 10:15:27',
            ),
            4 =>
            array (
                'codDenuncia' => 5,
                'tipoAlvo' => 'perfil_chat',
                'codAlvo' => 5,
                'codUsuarioDenunciante' => 4,
                'motivoDenuncia' => 'Perfil suspeito',
                'comentarioDenuncia' => 'O perfil apresenta comportamento suspeito e possivel tentativa de enganar outros usuarios.',
                'gravidade' => 'media',
                'statusDenuncia' => 'resolvida',
                'dataDenuncia' => '2026-09-19 16:38:49',
            ),
            5 =>
            array (
                'codDenuncia' => 6,
                'tipoAlvo' => 'forum_resposta',
                'codAlvo' => 6,
                'codUsuarioDenunciante' => 2,
                'motivoDenuncia' => 'Discurso de odio',
                'comentarioDenuncia' => 'A resposta contem comentarios discriminatorios direcionados a outros participantes.',
                'gravidade' => 'alta',
                'statusDenuncia' => 'em_analise',
                'dataDenuncia' => '2026-09-20 11:22:05',
            ),
        ));
        
        
    }
}