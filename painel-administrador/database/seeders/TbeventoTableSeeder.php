<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbeventoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbevento')->delete();
        
        \DB::table('tbevento')->insert(array (
            0 => 
            array (
                'codEvento' => 1,
                'tituloEvento' => 'Roda de conversa: saude menstrual',
                'descricaoEvento' => 'Encontro online para tirar duvidas sobre ciclo menstrual e autocuidado.',
                'bannerEvento' => 'banners/eventos/1.jpg',
                'formatoEvento' => 'online',
                'linkOuEndereco' => 'https://meet.venus.com.br/roda-saude-menstrual',
                'dataHoraEvento' => '2026-10-05 19:00:00',
                'duracaoMinutos' => 90,
                'vagasTotais' => 100,
                'codProfissionalSaude' => 1,
            ),
            1 => 
            array (
                'codEvento' => 2,
                'tituloEvento' => 'Palestra: metodos contraceptivos sem mitos',
                'descricaoEvento' => 'Conversa presencial com ginecologista sobre metodos contraceptivos, direitos e acesso pelo SUS.',
                'bannerEvento' => 'banners/eventos/2.jpg',
                'formatoEvento' => 'presencial',
                'linkOuEndereco' => 'Casa de Cultura da Cidade Tiradentes - Rua Ibiapaba, 400, Sao Paulo - SP',
                'dataHoraEvento' => '2026-09-26 15:00:00',
                'duracaoMinutos' => 120,
                'vagasTotais' => 40,
                'codProfissionalSaude' => 1,
            ),
            2 => 
            array (
                'codEvento' => 3,
                'tituloEvento' => 'Oficina de autocuidado e saude mental',
                'descricaoEvento' => 'Oficina online com tecnicas de respiracao, aterramento e organizacao da rotina.',
                'bannerEvento' => 'banners/eventos/3.jpg',
                'formatoEvento' => 'online',
                'linkOuEndereco' => 'https://meet.venus.com.br/oficina-autocuidado',
                'dataHoraEvento' => '2026-10-22 19:30:00',
                'duracaoMinutos' => 90,
                'vagasTotais' => 80,
                'codProfissionalSaude' => 3,
            ),
            3 => 
            array (
                'codEvento' => 4,
                'tituloEvento' => 'Pre-natal sem medo: tire suas duvidas',
                'descricaoEvento' => 'Roda online com enfermagem obstetrica e obstetra sobre exames, consultas e plano de parto.',
                'bannerEvento' => 'banners/eventos/4.jpg',
                'formatoEvento' => 'online',
                'linkOuEndereco' => 'https://meet.venus.com.br/pre-natal-sem-medo',
                'dataHoraEvento' => '2026-10-29 19:00:00',
                'duracaoMinutos' => 90,
                'vagasTotais' => 60,
                'codProfissionalSaude' => 5,
            ),
            4 => 
            array (
                'codEvento' => 5,
                'tituloEvento' => 'Mutirao de prevencao de ISTs',
                'descricaoEvento' => 'Testagem rapida gratuita, orientacao e distribuicao de preservativos com equipe de infectologia.',
                'bannerEvento' => 'banners/eventos/5.jpg',
                'formatoEvento' => 'presencial',
                'linkOuEndereco' => 'UBS Jardim Sao Paulo - Rua Deputado Emilio Carlos, 1200, Sao Paulo - SP',
                'dataHoraEvento' => '2026-11-07 09:00:00',
                'duracaoMinutos' => 240,
                'vagasTotais' => 30,
                'codProfissionalSaude' => 8,
            ),
            5 => 
            array (
                'codEvento' => 6,
                'tituloEvento' => 'Conversa aberta: adolescencia, corpo e direitos',
                'descricaoEvento' => 'Encontro online para adolescentes e responsaveis sobre puberdade, sigilo e acesso a saude.',
                'bannerEvento' => 'banners/eventos/6.jpg',
                'formatoEvento' => 'online',
                'linkOuEndereco' => 'https://meet.venus.com.br/adolescencia-corpo-direitos',
                'dataHoraEvento' => '2026-11-12 18:30:00',
                'duracaoMinutos' => 75,
                'vagasTotais' => 100,
                'codProfissionalSaude' => 2,
            ),
            6 => 
            array (
                'codEvento' => 7,
                'tituloEvento' => 'Acolhimento: reconhecendo e enfrentando a violencia',
                'descricaoEvento' => 'Roda de acolhimento com assistente social sobre sinais de violencia e rede de protecao.',
                'bannerEvento' => 'banners/eventos/7.jpg',
                'formatoEvento' => 'online',
                'linkOuEndereco' => 'https://meet.venus.com.br/acolhimento-violencia',
                'dataHoraEvento' => '2026-10-08 19:00:00',
                'duracaoMinutos' => 90,
                'vagasTotais' => 60,
                'codProfissionalSaude' => 7,
            ),
            7 => 
            array (
                'codEvento' => 8,
                'tituloEvento' => 'Roda de conversa: climaterio e menopausa',
                'descricaoEvento' => 'Conversa sobre sintomas, cuidados e direitos de mulheres no climaterio.',
                'bannerEvento' => 'banners/eventos/8.jpg',
                'formatoEvento' => 'online',
                'linkOuEndereco' => 'https://meet.venus.com.br/climaterio-menopausa',
                'dataHoraEvento' => '2026-11-19 19:00:00',
                'duracaoMinutos' => 90,
                'vagasTotais' => 80,
                'codProfissionalSaude' => 1,
            ),
            8 => 
            array (
                'codEvento' => 9,
                'tituloEvento' => 'Alimentacao nutritiva e acessivel',
                'descricaoEvento' => 'Dicas praticas de alimentacao saudavel com baixo custo, com enfermagem em saude da familia.',
                'bannerEvento' => 'banners/eventos/9.jpg',
                'formatoEvento' => 'online',
                'linkOuEndereco' => 'https://meet.venus.com.br/alimentacao-acessivel',
                'dataHoraEvento' => '2026-09-30 19:00:00',
                'duracaoMinutos' => 60,
                'vagasTotais' => 50,
                'codProfissionalSaude' => 9,
            ),
        ));
        
        
    }
}