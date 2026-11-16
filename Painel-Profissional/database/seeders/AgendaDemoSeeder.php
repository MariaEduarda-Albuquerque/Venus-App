<?php

namespace Database\Seeders;

use App\Models\BloqueioAgenda;
use App\Models\Consulta;
use App\Models\Disponibilidade;
use App\Models\User;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgendaDemoSeeder extends Seeder
{
    public function run(): void
    {
        $nomes = ['Ana Beatriz', 'Ester Reis', 'Camila Ferreira', 'Juliana Santos', 'Mariana Lima', 'Helena Souza'];
        $usuarias = [];
        foreach ($nomes as $i => $nome) {
            $usuarias[] = Usuario::firstOrCreate(['emailUsuario' => 'agenda' . $i . '.demo@venus.test'], [
                'nomeUsuario' => $nome,
                'senhaUsuario' => Hash::make('12345678'),
                'dataNascimentoUsuario' => '1995-01-15',
            ]);
        }

        $segunda = Carbon::now('America/Sao_Paulo')->startOfWeek(Carbon::MONDAY);

        $profissionais = User::where('statusConta', 'Ativa')
            ->where('statusVerificacao', 'Aprovado')
            ->get();

        foreach ($profissionais as $p) {
            if (Disponibilidade::where('codProfissionalSaude', $p->codProfissionalSaude)->exists()) {
                continue;
            }

            foreach ([2, 3, 4, 5, 6] as $dia) {
                foreach ([['08:00', '12:00'], ['14:00', '17:00']] as $janela) {
                    Disponibilidade::create([
                        'codProfissionalSaude' => $p->codProfissionalSaude,
                        'diaSemana' => $dia,
                        'horaInicio' => $janela[0],
                        'horaFim' => $janela[1],
                        'tipoAtendimento' => 'chat',
                    ]);
                }
            }

            $atendimentos = [
                [1, '09:00', 0, 'agendada', 'aguardando'],
                [1, '14:00', 4, 'agendada', 'aguardando'],
                [2, '10:00', 1, 'duvida_rapida', 'aguardando'],
                [2, '09:00', 2, 'agendada', 'aguardando'],
                [3, '11:00', 3, 'duvida_rapida', 'aguardando'],
                [4, '14:00', 5, 'agendada', 'aguardando'],
                [4, '15:00', 2, 'agendada', 'cancelada'],
            ];
            foreach ($atendimentos as $a) {
                Consulta::create([
                    'nomeConsulta' => 'Atendimento - ' . $usuarias[$a[2]]->nomeUsuario,
                    'tipoConsulta' => $a[3],
                    'statusConsulta' => $a[4],
                    'dataHoraAgendada' => $segunda->copy()->addDays($a[0])->format('Y-m-d') . ' ' . $a[1] . ':00',
                    'codUsuario' => $usuarias[$a[2]]->codUsuario,
                    'codProfissionalSaude' => $p->codProfissionalSaude,
                ]);
            }

            $bloqueios = [
                [3, '10:00', '11:00', 'reuniao'],
                [4, '08:00', '09:00', 'compromisso_pessoal'],
                [5, '14:00', '17:00', 'folga'],
            ];
            foreach ($bloqueios as $b) {
                BloqueioAgenda::create([
                    'codProfissionalSaude' => $p->codProfissionalSaude,
                    'dataBloqueio' => $segunda->copy()->addDays($b[0])->format('Y-m-d'),
                    'horaInicio' => $b[1],
                    'horaFim' => $b[2],
                    'motivoBloqueio' => $b[3],
                ]);
            }
        }
    }
}
