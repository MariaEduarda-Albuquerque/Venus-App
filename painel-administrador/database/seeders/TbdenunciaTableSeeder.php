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
                'codAlvo' => 7,
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
                'codAlvo' => 21,
                'codUsuarioDenunciante' => 8,
                'motivoDenuncia' => 'Linguagem ofensiva',
                'comentarioDenuncia' => 'O comentario desqualifica quem vive com ansiedade.',
                'gravidade' => 'media',
                'statusDenuncia' => 'resolvida',
                'dataDenuncia' => '2026-09-28 13:00:00',
            ),
            2 => 
            array (
                'codDenuncia' => 3,
                'tipoAlvo' => 'perfil_profissional',
                'codAlvo' => 11,
                'codUsuarioDenunciante' => 14,
                'motivoDenuncia' => 'Divulgacao de produtos fora da plataforma',
                'comentarioDenuncia' => 'O perfil oferece venda de suplementos fora do Venus.',
                'gravidade' => 'media',
                'statusDenuncia' => 'em_analise',
                'dataDenuncia' => '2026-10-12 15:20:00',
            ),
            3 => 
            array (
                'codDenuncia' => 4,
                'tipoAlvo' => 'mensagem_chat',
                'codAlvo' => 47,
                'codUsuarioDenunciante' => 19,
                'motivoDenuncia' => 'Atendimento considerado frio',
                'comentarioDenuncia' => 'A resposta me pareceu muito direta.',
                'gravidade' => 'baixa',
                'statusDenuncia' => 'arquivada',
                'dataDenuncia' => '2026-10-11 09:00:00',
            ),
            4 => 
            array (
                'codDenuncia' => 5,
                'tipoAlvo' => 'forum_resposta',
                'codAlvo' => 34,
                'codUsuarioDenunciante' => 3,
                'motivoDenuncia' => 'Recomendacao de planta potencialmente perigosa',
                'comentarioDenuncia' => 'O comentario indica uma planta como se fosse tratamento para regular o ciclo.',
                'gravidade' => 'alta',
                'statusDenuncia' => 'pendente',
                'dataDenuncia' => '2026-10-14 18:10:00',
            ),
        ));
        
        
    }
}