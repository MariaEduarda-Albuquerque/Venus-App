<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Ordem de execução construída a partir das FOREIGN KEYs reais
     * do dump `dbvenus.sql` (seção ALTER TABLE ... ADD CONSTRAINT).
     * Entidades fortes (sem FK, "tabelas pai") são populadas primeiro;
     * em seguida as entidades fracas, respeitando cada nível de
     * dependência, para nunca violar uma constraint ao inserir.
     *
     * OBS.: as tabelas de infraestrutura do Laravel (cache, jobs,
     * sessions, password_reset_tokens, job_batches, failed_jobs)
     * não entram aqui, pois normalmente não são "seedadas".
     */
    public function run(): void
    {
        // ---------------------------------------------------------
        // Nível 0 — Entidades fortes: nenhuma FK (tabelas raiz/domínio)
        // ---------------------------------------------------------
        $this->call([
            CodtipocategoriaTableSeeder::class,     // codtipocategoria
            TbpapelTableSeeder::class,              // tbpapel
            TbprofissionalsaudeTableSeeder::class,  // tbprofissionalsaude
            TbtipoatendimentoTableSeeder::class,    // tbtipoatendimento
            TbtipoconteudoTableSeeder::class,       // tbtipoconteudo
            TbtipodiarioTableSeeder::class,         // tbtipodiario
            TbunidadesaudeTableSeeder::class,       // tbunidadesaude
            TbservicounidadeTableSeeder::class,     // tbservicounidade
            TbusuarioTableSeeder::class,            // tbusuario
        ]);

        // ---------------------------------------------------------
        // Nível 1 — Dependem apenas de tabelas do Nível 0
        // ---------------------------------------------------------
        $this->call([
            TbadminTableSeeder::class,                       // FK: tbpapel
            TbavaliacaounidadeTableSeeder::class,             // FK: tbunidadesaude, tbusuario
            TbbloqueioagendaTableSeeder::class,               // FK: tbprofissionalsaude
            TbchamadosuporteTableSeeder::class,               // FK: tbprofissionalsaude
            TbciclomenstrualTableSeeder::class,               // FK: tbusuario
            TbconselhoTableSeeder::class,                     // FK: tbprofissionalsaude
            TbconsultaTableSeeder::class,                     // FK: tbusuario, tbprofissionalsaude, tbtipoatendimento
            TbconteudoTableSeeder::class,                     // FK: codtipocategoria, tbtipoconteudo, tbprofissionalsaude
            TbdenunciaTableSeeder::class,                     // FK: tbusuario
            TbdiarioTableSeeder::class,                       // FK: tbusuario, tbtipodiario
            TbdisponibilidadeprofissionalTableSeeder::class,  // FK: tbprofissionalsaude, tbtipoatendimento
            TbeventoTableSeeder::class,                       // FK: tbprofissionalsaude
            TbexameTableSeeder::class,                        // FK: tbusuario
            TbfeedbackTableSeeder::class,                     // FK: tbusuario, tbprofissionalsaude
            TbforumpublicacaoTableSeeder::class,              // FK: tbusuario, codtipocategoria
            TbhumordiarioTableSeeder::class,                  // FK: tbusuario
            TbinteresseusuarioTableSeeder::class,             // FK: tbusuario, codtipocategoria
            TblembreteremedioTableSeeder::class,              // FK: tbusuario
            TbtrilhaaprendizadoTableSeeder::class,            // FK: codtipocategoria
            TbunidadeservicoTableSeeder::class,               // FK: tbunidadesaude, tbservicounidade
            TbvacinaTableSeeder::class,                       // FK: tbusuario
        ]);

        // ---------------------------------------------------------
        // Nível 2 — Dependem de tabelas do Nível 1
        // ---------------------------------------------------------
        $this->call([
            TbavaliacaoconsultaTableSeeder::class,  // FK: tbconsulta
            TbconteudoadminTableSeeder::class,      // FK: tbconteudo, tbadmin
            TbconteudosalvoTableSeeder::class,      // FK: tbusuario, tbconteudo
            TbdenunciaacaoTableSeeder::class,       // FK: tbdenuncia, tbadmin
            TbforumreacaoTableSeeder::class,        // FK: tbforumpublicacao, tbusuario
            TbforumrespostaTableSeeder::class,      // FK: tbforumpublicacao, tbusuario, tbprofissionalsaude
            TbinscricaoeventoTableSeeder::class,    // FK: tbevento, tbusuario
            TbmensagemTableSeeder::class,           // FK: tbconsulta
            TbprogressotrilhaTableSeeder::class,    // FK: tbusuario, tbtrilhaaprendizado, tbconteudo
            TbpublicacaoTableSeeder::class,         // FK: tbconteudo
            TbsintomacicloTableSeeder::class,       // FK: tbciclomenstrual
            TbtrilhaconteudoTableSeeder::class,     // FK: tbtrilhaaprendizado, tbconteudo
            TbnotificacaoTableSeeder::class,        // sem FK declarada, mas referencia usuário/profissional/admin (codDestinatario polimórfico) — mantida por último por segurança
        ]);
    }
}