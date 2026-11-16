<?php

namespace Database\Seeders;

use App\Models\Consulta;
use App\Models\NotaClinica;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=ProntuarioDemoSeeder
// Cria notas clínicas de exemplo nos atendimentos já realizados (encerrada) que ainda não têm nota.
class ProntuarioDemoSeeder extends Seeder
{
    public function run(): void
    {
        $textos = [
            'Paciente relata ciclo irregular nos últimos 3 meses. Orientada sobre registro do ciclo e solicitados exames de rotina.',
            'Retorno: sintomas melhoraram após as orientações. Mantida a conduta e combinado novo acompanhamento.',
            'Dúvida sobre método contraceptivo. Explicadas as opções disponíveis; paciente vai avaliar e retornar.',
            'Queixa de cólicas intensas. Orientada a procurar atendimento presencial caso a dor persista.',
        ];

        $i = 0;
        foreach (Consulta::where('statusConsulta', 'encerrada')->doesntHave('notas')->get() as $c) {
            NotaClinica::create([
                'codConsulta' => $c->codConsulta,
                'codUsuario' => $c->codUsuario,
                'codProfissionalSaude' => $c->codProfissionalSaude,
                'textoNota' => $textos[$i++ % count($textos)],
            ]);
        }
    }
}
