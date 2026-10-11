<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbconteudoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbconteudo')->delete();
        
        \DB::table('tbconteudo')->insert(array (
            0 => 
            array (
                'codConteudo' => 1,
                'tituloConteudo' => 'Como identificar sinais de ansiedade no dia a dia',
                'corpoConteudo' => 'A ansiedade se manifesta de formas diferentes em cada pessoa. Neste artigo reunimos sinais fisicos e emocionais mais comuns e quando procurar ajuda profissional.',
                'capaConteudo' => 'capas/conteudo/1.jpg',
                'tempoLeituraMinutos' => 6,
                'codTipoCategoria' => 1,
                'codTipoConteudo' => 1,
                'codProfissionalSaude' => 1,
                'statusConteudo' => 'publicado',
                'dataCriacao' => '2026-09-17 18:19:08',
                'dataAtualizacao' => '2026-09-17 18:19:08',
            ),
        ));
        
        
    }
}