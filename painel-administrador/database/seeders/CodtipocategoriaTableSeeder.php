<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CodtipocategoriaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('codtipocategoria')->delete();
        
        \DB::table('codtipocategoria')->insert(array (
            0 => 
            array (
                'codTipoCategoria' => 1,
                'nomeTipoCategoria' => 'Saude mental',
                'descricaoTipoCategoria' => 'Conteudos sobre bem-estar emocional e autocuidado',
            ),
            1 => 
            array (
                'codTipoCategoria' => 2,
                'nomeTipoCategoria' => 'Gravidez na adolescencia',
                'descricaoTipoCategoria' => 'Prevencao, direitos da gestante adolescente, pre-natal, parto humanizado, adocao, maternidade',
            ),
            2 => 
            array (
                'codTipoCategoria' => 3,
                'nomeTipoCategoria' => 'ISTs e prevencao',
                'descricaoTipoCategoria' => 'HIV, HPV, sifilis, clamidia, uso de camisinha, testagem, tratamento e sigilo',
            ),
            3 => 
            array (
                'codTipoCategoria' => 4,
                'nomeTipoCategoria' => 'Meus direitos',
                'descricaoTipoCategoria' => 'Direitos reprodutivos, ECA, acesso ao SUS, sigilo medico, violencia obstetrica',
            ),
            4 => 
            array (
                'codTipoCategoria' => 5,
                'nomeTipoCategoria' => 'Metodos contraceptivos',
                'descricaoTipoCategoria' => 'Camisinha, pilula, injetavel, DIU, implante, contracepcao de emergencia',
            ),
            5 => 
            array (
                'codTipoCategoria' => 6,
                'nomeTipoCategoria' => 'Corpo e puberdade',
                'descricaoTipoCategoria' => 'Menstruacao, higiene intima, exames preventivos, vacinacao HPV',
            ),
            6 => 
            array (
                'codTipoCategoria' => 7,
                'nomeTipoCategoria' => 'Rede de apoio',
                'descricaoTipoCategoria' => 'Como pedir ajuda, CVV, CRAS, CREAS, Conselho Tutelar, abrigos e servicos de protecao',
            ),
        ));
        
        
    }
}