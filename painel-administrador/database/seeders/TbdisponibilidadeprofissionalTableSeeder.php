<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbdisponibilidadeprofissionalTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbdisponibilidadeprofissional')->delete();
        
        \DB::table('tbdisponibilidadeprofissional')->insert(array (
            0 => 
            array (
                'codDisponibilidade' => 1,
                'codProfissionalSaude' => 1,
                'diaSemana' => 3,
                'horaInicio' => '09:00:00',
                'horaFim' => '12:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
        ));
        
        
    }
}