<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbchamadosuporteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbchamadosuporte')->delete();
        
        \DB::table('tbchamadosuporte')->insert(array (
            0 => 
            array (
                'codChamado' => 1,
                'codProfissionalSaude' => 1,
                'assuntoChamado' => 'Erro ao anexar arquivo no chat',
                'descricaoChamado' => 'Ao tentar enviar um PDF de exame na consulta, o sistema retorna erro de upload apos 90 por cento do envio.',
                'anexoChamado' => 'anexos/chamados/1.png',
                'statusChamado' => 'em_atendimento',
                'dataAbertura' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}