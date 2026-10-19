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
            1 => 
            array (
                'codDisponibilidade' => 2,
                'codProfissionalSaude' => 1,
                'diaSemana' => 4,
                'horaInicio' => '14:00:00',
                'horaFim' => '17:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            2 => 
            array (
                'codDisponibilidade' => 3,
                'codProfissionalSaude' => 1,
                'diaSemana' => 1,
                'horaInicio' => '08:00:00',
                'horaFim' => '10:00:00',
                'tipoAtendimento' => 'duvida_rapida',
                'idTipoAtendimento' => 2,
            ),
            3 => 
            array (
                'codDisponibilidade' => 4,
                'codProfissionalSaude' => 2,
                'diaSemana' => 1,
                'horaInicio' => '18:00:00',
                'horaFim' => '21:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            4 => 
            array (
                'codDisponibilidade' => 5,
                'codProfissionalSaude' => 2,
                'diaSemana' => 3,
                'horaInicio' => '18:00:00',
                'horaFim' => '21:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            5 => 
            array (
                'codDisponibilidade' => 6,
                'codProfissionalSaude' => 2,
                'diaSemana' => 2,
                'horaInicio' => '12:00:00',
                'horaFim' => '14:00:00',
                'tipoAtendimento' => 'duvida_rapida',
                'idTipoAtendimento' => 2,
            ),
            6 => 
            array (
                'codDisponibilidade' => 7,
                'codProfissionalSaude' => 3,
                'diaSemana' => 2,
                'horaInicio' => '17:00:00',
                'horaFim' => '20:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            7 => 
            array (
                'codDisponibilidade' => 8,
                'codProfissionalSaude' => 3,
                'diaSemana' => 4,
                'horaInicio' => '09:00:00',
                'horaFim' => '12:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            8 => 
            array (
                'codDisponibilidade' => 9,
                'codProfissionalSaude' => 4,
                'diaSemana' => 4,
                'horaInicio' => '09:00:00',
                'horaFim' => '12:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            9 => 
            array (
                'codDisponibilidade' => 10,
                'codProfissionalSaude' => 4,
                'diaSemana' => 3,
                'horaInicio' => '14:00:00',
                'horaFim' => '17:00:00',
                'tipoAtendimento' => 'duvida_rapida',
                'idTipoAtendimento' => 2,
            ),
            10 => 
            array (
                'codDisponibilidade' => 11,
                'codProfissionalSaude' => 5,
                'diaSemana' => 2,
                'horaInicio' => '09:00:00',
                'horaFim' => '12:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            11 => 
            array (
                'codDisponibilidade' => 12,
                'codProfissionalSaude' => 5,
                'diaSemana' => 1,
                'horaInicio' => '13:00:00',
                'horaFim' => '17:00:00',
                'tipoAtendimento' => 'duvida_rapida',
                'idTipoAtendimento' => 2,
            ),
            12 => 
            array (
                'codDisponibilidade' => 13,
                'codProfissionalSaude' => 5,
                'diaSemana' => 5,
                'horaInicio' => '13:00:00',
                'horaFim' => '17:00:00',
                'tipoAtendimento' => 'duvida_rapida',
                'idTipoAtendimento' => 2,
            ),
            13 => 
            array (
                'codDisponibilidade' => 14,
                'codProfissionalSaude' => 6,
                'diaSemana' => 4,
                'horaInicio' => '18:00:00',
                'horaFim' => '21:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            14 => 
            array (
                'codDisponibilidade' => 15,
                'codProfissionalSaude' => 6,
                'diaSemana' => 6,
                'horaInicio' => '09:00:00',
                'horaFim' => '12:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            15 => 
            array (
                'codDisponibilidade' => 16,
                'codProfissionalSaude' => 7,
                'diaSemana' => 2,
                'horaInicio' => '14:00:00',
                'horaFim' => '17:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            16 => 
            array (
                'codDisponibilidade' => 17,
                'codProfissionalSaude' => 7,
                'diaSemana' => 5,
                'horaInicio' => '09:00:00',
                'horaFim' => '12:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            17 => 
            array (
                'codDisponibilidade' => 18,
                'codProfissionalSaude' => 8,
                'diaSemana' => 3,
                'horaInicio' => '14:00:00',
                'horaFim' => '17:00:00',
                'tipoAtendimento' => 'presencial',
                'idTipoAtendimento' => 3,
            ),
            18 => 
            array (
                'codDisponibilidade' => 19,
                'codProfissionalSaude' => 8,
                'diaSemana' => 4,
                'horaInicio' => '19:00:00',
                'horaFim' => '21:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            19 => 
            array (
                'codDisponibilidade' => 20,
                'codProfissionalSaude' => 8,
                'diaSemana' => 1,
                'horaInicio' => '12:00:00',
                'horaFim' => '14:00:00',
                'tipoAtendimento' => 'duvida_rapida',
                'idTipoAtendimento' => 2,
            ),
            20 => 
            array (
                'codDisponibilidade' => 21,
                'codProfissionalSaude' => 9,
                'diaSemana' => 5,
                'horaInicio' => '16:00:00',
                'horaFim' => '19:00:00',
                'tipoAtendimento' => 'chat',
                'idTipoAtendimento' => 1,
            ),
            21 => 
            array (
                'codDisponibilidade' => 22,
                'codProfissionalSaude' => 9,
                'diaSemana' => 2,
                'horaInicio' => '08:00:00',
                'horaFim' => '11:00:00',
                'tipoAtendimento' => 'presencial',
                'idTipoAtendimento' => 3,
            ),
        ));
        
        
    }
}