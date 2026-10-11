<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TbexameTableSeeder extends Seeder
{
    /**
     * Popula a tabela `tbexame`.
     *
     * FK: codUsuario -> tbusuario.codUsuario (ON DELETE CASCADE)
     * Portanto TbusuarioTableSeeder precisa rodar ANTES deste seeder.
     */
    public function run(): void
    {
        $usuarios = DB::table('tbusuario')->pluck('codUsuario');

        if ($usuarios->isEmpty()) {
            $this->command?->warn('Nenhum registro em tbusuario. Rode o TbusuarioTableSeeder antes do TbexameTableSeeder.');
            return;
        }

        $nomesExame = [
            'Hemograma completo',
            'Ultrassonografia pélvica',
            'Papanicolau',
            'Exame de urina tipo I',
            'Dosagem hormonal (FSH/LH)',
            'Beta hCG',
            'Ultrassom transvaginal',
            'Perfil lipídico',
            'Glicemia em jejum',
            'Mamografia',
        ];

        $status = ['salvo', 'analisado'];

        $exames = [];

        foreach ($usuarios as $codUsuario) {
            // Gera de 1 a 3 exames por usuária
            $quantidade = rand(1, 3);

            for ($i = 0; $i < $quantidade; $i++) {
                $dataExame = Carbon::now()->subDays(rand(1, 365));

                $exames[] = [
                    'codUsuario'      => $codUsuario,
                    'nomeExame'       => $nomesExame[array_rand($nomesExame)],
                    'arquivoExame'    => 'exames/exemplo_' . uniqid() . '.pdf',
                    'dataExame'       => $dataExame->format('Y-m-d'),
                    'statusExame'     => $status[array_rand($status)],
                    'observacaoExame' => rand(0, 1)
                        ? 'Resultados dentro dos parâmetros esperados.'
                        : null,
                    'dataUpload'      => $dataExame->copy()->addDays(rand(0, 3)),
                ];
            }
        }

        // Insere em lotes para não estourar o limite de placeholders do driver
        foreach (array_chunk($exames, 200) as $lote) {
            DB::table('tbexame')->insert($lote);
        }

        $this->command?->info(count($exames) . ' registros inseridos em tbexame.');
    }
}