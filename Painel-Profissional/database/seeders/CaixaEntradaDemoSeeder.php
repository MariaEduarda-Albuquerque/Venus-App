<?php

namespace Database\Seeders;

use App\Models\Mensagem;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class CaixaEntradaDemoSeeder extends Seeder
{
    public function run(): void
    {
        $ana = Usuario::firstOrCreate(['emailUsuario' => 'ana.demo@venus.test'], [
            'nomeUsuario' => 'Ana Souza',
            'apelidoUsuario' => 'Ana',
            'senhaUsuario' => Hash::make('12345678'),
            'dataNascimentoUsuario' => '1998-05-10',
            'cidadeUsuario' => 'São Paulo',
            'ufUsuario' => 'SP',
        ]);

        $anonima = Usuario::firstOrCreate(['emailUsuario' => 'anonima.demo@venus.test'], [
            'nomeUsuario' => 'Maria Teste',
            'apelidoUsuario' => 'Maria',
            'senhaUsuario' => Hash::make('12345678'),
            'dataNascimentoUsuario' => '2001-03-22',
        ]);

        $profissionais = User::where('statusConta', 'Ativa')
            ->where('statusVerificacao', 'Aprovado')
            ->get();

        foreach ($profissionais as $p) {
            $this->conversa($ana, $p, [
                ['usuario', 'Oi, doutora! Minha menstruação está atrasada há 10 dias, posso ficar preocupada?'],
                ['profissional', 'Olá, Ana! Atraso pode ter várias causas. Você fez algum teste de gravidez?'],
                ['usuario', 'Ainda não fiz.'],
            ]);

            $this->conversa($anonima, $p, [
                ['usuario', 'Boa tarde. Posso tirar uma dúvida sobre métodos contraceptivos?'],
            ]);
        }
    }

    private function conversa($usuaria, $profissional, $mensagens)
    {
        $jaExiste = Mensagem::where('codUsuario', $usuaria->codUsuario)
            ->where('codProfissionalSaude', $profissional->codProfissionalSaude)
            ->exists();

        if ($jaExiste) {
            return;
        }

        foreach ($mensagens as $m) {
            Mensagem::create([
                'codUsuario' => $usuaria->codUsuario,
                'codProfissionalSaude' => $profissional->codProfissionalSaude,
                'remetenteMensagem' => $m[0],
                'textoMensagem' => $m[1],
                'lidaMensagem' => false,
            ]);
        }
    }
}
