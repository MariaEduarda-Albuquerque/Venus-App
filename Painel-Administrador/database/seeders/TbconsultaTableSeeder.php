<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbconsultaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbconsulta')->delete();
        
        \DB::table('tbconsulta')->insert(array (
            0 => 
            array (
                'codConsulta' => 1,
                'nomeConsulta' => 'Acompanhamento de ciclo menstrual',
                'tipoConsulta' => 'agendada',
                'idTipoAtendimento' => 1,
                'statusConsulta' => 'encerrada',
                'dataHoraAgendada' => '2026-09-10 14:00:00',
                'historicoConsulta' => 'Paciente relatou colicas intensas no primeiro dia do ciclo. Orientada quanto a registro de sintomas no app.',
                'codUsuario' => 1,
                'codProfissionalSaude' => 1,
                'dataCriacao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}