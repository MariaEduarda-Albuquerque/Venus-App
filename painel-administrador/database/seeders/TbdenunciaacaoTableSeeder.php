<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbdenunciaacaoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbdenunciaacao')->delete();
        
        \DB::table('tbdenunciaacao')->insert(array (
            0 => 
            array (
                'codDenunciaAcao' => 1,
                'codDenuncia' => 1,
                'codAdmin' => 1,
                'acaoTomada' => 'advertir',
                'justificativa' => 'Autora advertida e orientada sobre as regras da comunidade.',
                'dataAcao' => '2026-09-17 18:19:08',
            ),
            1 => 
            array (
                'codDenunciaAcao' => 2,
                'codDenuncia' => 2,
                'codAdmin' => 1,
                'acaoTomada' => 'suspender_conta',
                'justificativa' => 'Reincidencia de comportamento desrespeitoso apos advertencia anterior.',
                'dataAcao' => '2026-09-29 10:00:00',
            ),
            2 => 
            array (
                'codDenunciaAcao' => 3,
                'codDenuncia' => 4,
                'codAdmin' => 4,
                'acaoTomada' => 'arquivar_sem_acao',
                'justificativa' => 'Mensagem dentro dos padroes de atendimento da plataforma.',
                'dataAcao' => '2026-10-12 09:30:00',
            ),
        ));
        
        
    }
}