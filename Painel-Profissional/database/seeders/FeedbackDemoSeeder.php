<?php

namespace Database\Seeders;

use App\Models\Conteudo;
use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use App\Models\User;
use Illuminate\Database\Seeder;

// Dados de teste para a página "Feedback da moderação".
//   php artisan db:seed --class=FeedbackDemoSeeder
// Pode rodar mais de uma vez: cada item é atualizado pelo título, sem duplicar.
class FeedbackDemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ConteudoSeeder::class); // garante categorias e formatos

        $artigo = TipoConteudo::where('descricaoTipoConteudo', 'Artigo')->value('codTipoConteudo');
        $video = TipoConteudo::where('descricaoTipoConteudo', 'Vídeo')->value('codTipoConteudo');
        $info = TipoConteudo::where('descricaoTipoConteudo', 'Infográfico')->value('codTipoConteudo');

        $cat = function (string $nome) {
            return TipoCategoria::firstOrCreate(['nomeTipoCategoria' => $nome])->codTipoCategoria;
        };

        $corpo = "Texto de exemplo para testar a tela de feedback.\n\n"
            . "Aqui entram as orientações práticas sobre o tema, com linguagem simples e referências "
            . "para quem quiser se aprofundar.";

        // [título, formato, categoria, status, motivo da recusa, revisado há (dias), atualizado há (dias)]
        $itens = [
            // ---- Recusados ----
            [
                'Como identificar sinais de ansiedade', $artigo, 'Saúde mental', 'recusado',
                "O texto afirma que a ansiedade \"tem cura rápida\", o que não é recomendado.\n"
                . "Ajuste a linguagem, inclua a fonte dos dados citados e reforce a orientação de procurar ajuda profissional.",
                2, 2,
            ],
            [
                'Mitos sobre o uso da pílula anticoncepcional', $video, 'Contraceptivos', 'recusado',
                'O vídeo cita marcas comerciais. Remova as menções e envie novamente.',
                9, 9,
            ],
            [
                'Autoexame das mamas passo a passo', $info, 'Prevenção de câncer', 'recusado',
                null, // sem motivo: testa a mensagem "A moderação não informou o motivo."
                15, 15,
            ],

            // ---- Em revisão ----
            ['Alimentação saudável na gravidez', $artigo, 'Gravidez', 'em_revisao', null, null, 1],
            ['Direitos da mulher no pré-natal', $artigo, 'Direitos', 'em_revisao', null, null, 4],

            // ---- Aprovados ----
            ['Como funciona o ciclo menstrual', $artigo, 'Ciclo menstrual', 'publicado', null, 20, 20],
            ['Prevenção de ISTs: o que você precisa saber', $info, 'ISTs', 'publicado', null, 35, 35],
        ];

        $profissionais = User::where('statusConta', 'Ativa')->where('statusVerificacao', 'Aprovado')->get();
        if ($profissionais->isEmpty()) {
            $profissionais = User::all();
        }

        foreach ($profissionais as $p) {
            foreach ($itens as [$titulo, $formato, $categoria, $status, $motivo, $revisadoHa, $atualizadoHa]) {
                $c = Conteudo::firstOrNew([
                    'codProfissionalSaude' => $p->codProfissionalSaude,
                    'tituloConteudo' => $titulo,
                ]);

                // forceFill: motivo e data da revisão são gravados pelo Admin, por isso não estão no $fillable
                $c->forceFill([
                    'corpoConteudo' => $corpo,
                    'tempoLeituraMinutos' => Conteudo::calcularTempoLeitura($corpo),
                    'codTipoCategoria' => $cat($categoria),
                    'codTipoConteudo' => $formato,
                    'statusConteudo' => $status,
                    'motivoRecusaConteudo' => $motivo,
                    'dataRevisaoConteudo' => $revisadoHa === null ? null : now()->subDays($revisadoHa),
                    'dataPublicacao' => $status === 'publicado' ? now()->subDays($revisadoHa) : null,
                    'dataCriacao' => now()->subDays($atualizadoHa + 3),
                    'dataAtualizacao' => now()->subDays($atualizadoHa),
                ])->save();
            }
        }
    }
}
