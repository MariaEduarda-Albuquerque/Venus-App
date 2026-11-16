<?php

namespace Database\Seeders;

use App\Models\Conteudo;
use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use App\Models\User;
use Illuminate\Database\Seeder;

// php artisan db:seed --class=PublicacoesDemoSeeder
class PublicacoesDemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ConteudoSeeder::class);

        $categorias = TipoCategoria::pluck('codTipoCategoria')->values();
        $artigo = TipoConteudo::where('descricaoTipoConteudo', 'Artigo')->value('codTipoConteudo');
        $video = TipoConteudo::where('descricaoTipoConteudo', 'Vídeo')->value('codTipoConteudo');
        $campanha = TipoConteudo::where('descricaoTipoConteudo', 'Campanha')->value('codTipoConteudo');

        $texto = "Este é um texto de exemplo para o histórico de publicações.\n\nEle descreve o tema, traz orientações práticas e referências para quem quiser saber mais.";

        // [título, tipo, status, publicado há (dias), views, curtidas, inscritas, motivo da recusa]
        $itens = [
            ['Como funciona o ciclo menstrual', $artigo, 'publicado', 40, 1280, 214, 0, null],
            ['Métodos contraceptivos: guia rápido', $video, 'publicado', 12, 860, 130, 0, null],
            ['Campanha Outubro Rosa', $campanha, 'publicado', 20, 2410, 389, 156, null],
            ['Saúde mental na gravidez', $artigo, 'em_revisao', null, 0, 0, 0, null],
            ['Direitos da gestante no trabalho', $artigo, 'rascunho', null, 0, 0, 0, null],
            ['Campanha de prevenção às ISTs', $campanha, 'recusado', null, 0, 0, 0, 'O texto cita dados sem fonte. Inclua as referências e envie novamente para revisão.'],
        ];

        foreach (User::where('statusConta', 'Ativa')->where('statusVerificacao', 'Aprovado')->get() as $p) {
            if (Conteudo::where('codProfissionalSaude', $p->codProfissionalSaude)->count() >= 6) {
                continue;
            }

            foreach ($itens as $k => $i) {
                $c = Conteudo::create([
                    'tituloConteudo' => $i[0],
                    'corpoConteudo' => $texto,
                    'tempoLeituraMinutos' => 3,
                    'codTipoCategoria' => $categorias[$k % max(1, $categorias->count())],
                    'codTipoConteudo' => $i[1],
                    'codProfissionalSaude' => $p->codProfissionalSaude,
                    'statusConteudo' => $i[2],
                    'motivoRecusaConteudo' => $i[7],
                    'dataPublicacao' => $i[3] === null ? null : now()->subDays($i[3]),
                    'visualizacoesConteudo' => $i[4],
                    'curtidasConteudo' => $i[5],
                    'inscritasConteudo' => $i[6],
                ]);
            }
        }
    }
}
