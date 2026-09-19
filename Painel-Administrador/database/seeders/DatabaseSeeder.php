<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

            $this->call([
        AdmSeeder::class,
    ]);
        $this->call(CodtipocategoriaTableSeeder::class);
        $this->call(TbadminTableSeeder::class);
        $this->call(TbavaliacaoconsultaTableSeeder::class);
        $this->call(TbavaliacaounidadeTableSeeder::class);
        $this->call(TbbloqueioagendaTableSeeder::class);
        $this->call(TbchamadosuporteTableSeeder::class);
        $this->call(TbciclomenstrualTableSeeder::class);
        $this->call(TbconselhoTableSeeder::class);
        $this->call(TbconsultaTableSeeder::class);
        $this->call(TbconteudoTableSeeder::class);
        $this->call(TbconteudoadminTableSeeder::class);
        $this->call(TbconteudosalvoTableSeeder::class);
        $this->call(TbdenunciaTableSeeder::class);
        $this->call(TbdenunciaacaoTableSeeder::class);
        $this->call(TbdiarioTableSeeder::class);
        $this->call(TbdisponibilidadeprofissionalTableSeeder::class);
        $this->call(TbeventoTableSeeder::class);
        $this->call(TbfeedbackTableSeeder::class);
        $this->call(TbforumpublicacaoTableSeeder::class);
        $this->call(TbforumreacaoTableSeeder::class);
        $this->call(TbforumrespostaTableSeeder::class);
        $this->call(TbhumordiarioTableSeeder::class);
        $this->call(TbinscricaoeventoTableSeeder::class);
        $this->call(TblembreteremedioTableSeeder::class);
        $this->call(TbmensagemTableSeeder::class);
        $this->call(TbnotificacaoTableSeeder::class);
        $this->call(TbpapelTableSeeder::class);
        $this->call(TbprofissionalsaudeTableSeeder::class);
        $this->call(TbprogressotrilhaTableSeeder::class);
        $this->call(TbpublicacaoTableSeeder::class);
        $this->call(TbservicounidadeTableSeeder::class);
        $this->call(TbsintomacicloTableSeeder::class);
        $this->call(TbtipoatendimentoTableSeeder::class);
        $this->call(TbtipoconteudoTableSeeder::class);
        $this->call(TbtipodiarioTableSeeder::class);
        $this->call(TbtrilhaaprendizadoTableSeeder::class);
        $this->call(TbtrilhaconteudoTableSeeder::class);
        $this->call(TbunidadesaudeTableSeeder::class);
        $this->call(TbunidadeservicoTableSeeder::class);
        $this->call(TbusuarioTableSeeder::class);
    }
}
