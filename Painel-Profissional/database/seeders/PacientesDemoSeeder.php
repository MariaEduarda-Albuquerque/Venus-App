<?php

namespace Database\Seeders;

use App\Models\AvaliacaoConsulta;
use App\Models\Consulta;
use App\Models\User;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// php artisan db:seed --class=PacientesDemoSeeder
class PacientesDemoSeeder extends Seeder
{
    public function run(): void
    {
        $nomes = ['Ana Beatriz', 'Juliana Santos', 'Mariana Lima', 'Helena Souza'];
        $usuarias = [];
        foreach ($nomes as $i => $nome) {
            $usuarias[] = Usuario::firstOrCreate(['emailUsuario' => 'paciente' . $i . '.demo@venus.test'], [
                'nomeUsuario' => $nome,
                'senhaUsuario' => Hash::make('12345678'),
                'dataNascimentoUsuario' => '1994-06-20',
            ]);
        }

        $hoje = Carbon::now('America/Sao_Paulo')->startOfDay();

        $atendimentos = [
            [0, 3, '09:00', 'agendada', 5, 'Orientação sobre saúde menstrual'],
            [0, 10, '09:00', 'agendada', 5, 'Orientação sobre saúde menstrual'],
            [1, 5, '12:00', 'duvida_rapida', 5, 'Dúvida sobre método contraceptivo'],
            [2, 8, '15:30', 'agendada', 4, 'Acompanhamento de ciclo irregular'],
            [2, 40, '10:00', 'agendada', 5, 'Primeira consulta'],
            [3, 120, '10:00', 'agendada', 5, 'Retorno com exames'],
        ];

        $profissionais = User::where('statusConta', 'Ativa')->where('statusVerificacao', 'Aprovado')->get();

        foreach ($profissionais as $p) {
            if (Consulta::where('codProfissionalSaude', $p->codProfissionalSaude)->where('statusConsulta', 'encerrada')->exists()) {
                continue;
            }

            foreach ($atendimentos as $a) {
                $consulta = Consulta::create([
                    'nomeConsulta' => 'Atendimento - ' . $usuarias[$a[0]]->nomeUsuario,
                    'tipoConsulta' => $a[3],
                    'statusConsulta' => 'encerrada',
                    'dataHoraAgendada' => $hoje->copy()->subDays($a[1])->format('Y-m-d') . ' ' . $a[2] . ':00',
                    'historicoConsulta' => $a[5],
                    'codUsuario' => $usuarias[$a[0]]->codUsuario,
                    'codProfissionalSaude' => $p->codProfissionalSaude,
                ]);

                AvaliacaoConsulta::create(['codConsulta' => $consulta->codConsulta, 'nota' => $a[4]]);
            }
        }
    }
}
