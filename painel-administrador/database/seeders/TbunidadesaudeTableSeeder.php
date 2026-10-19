<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbunidadesaudeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbunidadesaude')->delete();
        
        \DB::table('tbunidadesaude')->insert(array (
            0 => 
            array (
                'codUnidade' => 1,
                'nomeUnidade' => 'UBS Jardim Sao Paulo',
                'tipoUnidade' => 'UBS',
                'endereco' => 'Rua Deputado Emilio Carlos, 1200 - Jardim Sao Paulo, Sao Paulo - SP',
                'latitude' => '-23.4921000',
                'longitude' => '-46.6425000',
                'telefone' => '(11)3981-4455',
                'horarioFuncionamento' => 'Segunda a sexta, das 07h as 19h',
            ),
            1 => 
            array (
                'codUnidade' => 2,
                'nomeUnidade' => 'UBS Cidade Tiradentes II',
                'tipoUnidade' => 'UBS',
                'endereco' => 'Rua Ibiapaba, 85 - Cidade Tiradentes, Sao Paulo - SP',
                'latitude' => '-23.5876000',
                'longitude' => '-46.4075000',
                'telefone' => '(11)2285-1010',
                'horarioFuncionamento' => 'Segunda a sexta, das 07h as 19h',
            ),
            2 => 
            array (
                'codUnidade' => 3,
                'nomeUnidade' => 'UBS Capao Redondo',
                'tipoUnidade' => 'UBS',
                'endereco' => 'Estrada do Campo Limpo, 4300 - Capao Redondo, Sao Paulo - SP',
                'latitude' => '-23.6620000',
                'longitude' => '-46.7790000',
                'telefone' => '(11)5515-2020',
                'horarioFuncionamento' => 'Segunda a sexta, das 07h as 18h',
            ),
            3 => 
            array (
                'codUnidade' => 4,
                'nomeUnidade' => 'UBS Brasilandia',
                'tipoUnidade' => 'UBS',
                'endereco' => 'Avenida Deputado Cantidio Sampaio, 900 - Brasilandia, Sao Paulo - SP',
                'latitude' => '-23.4560000',
                'longitude' => '-46.6850000',
                'telefone' => '(11)3975-3030',
                'horarioFuncionamento' => 'Segunda a sexta, das 07h as 19h',
            ),
            4 => 
            array (
                'codUnidade' => 5,
                'nomeUnidade' => 'UBS Itaquera Norte',
                'tipoUnidade' => 'UBS',
                'endereco' => 'Rua Augusto Carlos Bauman, 310 - Itaquera, Sao Paulo - SP',
                'latitude' => '-23.5420000',
                'longitude' => '-46.4570000',
                'telefone' => '(11)2205-4040',
                'horarioFuncionamento' => 'Segunda a sexta, das 07h as 17h',
            ),
            5 => 
            array (
                'codUnidade' => 6,
                'nomeUnidade' => 'UPA Jardim Angela',
                'tipoUnidade' => 'UPA',
                'endereco' => 'Estrada do M\'Boi Mirim, 5200 - Jardim Angela, Sao Paulo - SP',
                'latitude' => '-23.7180000',
                'longitude' => '-46.7690000',
                'telefone' => '(11)5834-5050',
                'horarioFuncionamento' => 'Atendimento 24 horas',
            ),
            6 => 
            array (
                'codUnidade' => 7,
                'nomeUnidade' => 'UPA Guaianases',
                'tipoUnidade' => 'UPA',
                'endereco' => 'Rua Salvador Gianetti, 450 - Guaianases, Sao Paulo - SP',
                'latitude' => '-23.5400000',
                'longitude' => '-46.4100000',
                'telefone' => '(11)2557-6060',
                'horarioFuncionamento' => 'Atendimento 24 horas',
            ),
            7 => 
            array (
                'codUnidade' => 8,
                'nomeUnidade' => 'CAPS III Sapopemba',
                'tipoUnidade' => 'CAPS',
                'endereco' => 'Avenida Sapopemba, 7100 - Sapopemba, Sao Paulo - SP',
                'latitude' => '-23.6130000',
                'longitude' => '-46.5290000',
                'telefone' => '(11)2701-7070',
                'horarioFuncionamento' => 'Segunda a sexta, das 08h as 18h; acolhimento 24 horas',
            ),
            8 => 
            array (
                'codUnidade' => 9,
                'nomeUnidade' => 'CAPS Rochdale',
                'tipoUnidade' => 'CAPS',
                'endereco' => 'Rua Ana Maria Almeida, 220 - Rochdale, Osasco - SP',
                'latitude' => '-23.5200000',
                'longitude' => '-46.7900000',
                'telefone' => '(11)3608-8080',
                'horarioFuncionamento' => 'Segunda a sexta, das 08h as 17h',
            ),
            9 => 
            array (
                'codUnidade' => 10,
                'nomeUnidade' => 'CRAS Pimentas',
                'tipoUnidade' => 'CRAS',
                'endereco' => 'Rua Vitoria Regia, 75 - Pimentas, Guarulhos - SP',
                'latitude' => '-23.4500000',
                'longitude' => '-46.4000000',
                'telefone' => '(11)2408-9090',
                'horarioFuncionamento' => 'Segunda a sexta, das 08h as 17h',
            ),
            10 => 
            array (
                'codUnidade' => 11,
                'nomeUnidade' => 'CRAS Eldorado',
                'tipoUnidade' => 'CRAS',
                'endereco' => 'Avenida Piraporinha, 640 - Eldorado, Diadema - SP',
                'latitude' => '-23.7300000',
                'longitude' => '-46.6200000',
                'telefone' => '(11)4057-1111',
                'horarioFuncionamento' => 'Segunda a sexta, das 08h as 17h',
            ),
            11 => 
            array (
                'codUnidade' => 12,
                'nomeUnidade' => 'Farmacia Popular Paraisopolis',
                'tipoUnidade' => 'Farmacia_Popular',
                'endereco' => 'Rua Silvio Bussadori, 130 - Paraisopolis, Sao Paulo - SP',
                'latitude' => '-23.6240000',
                'longitude' => '-46.7260000',
                'telefone' => '(11)3743-1212',
                'horarioFuncionamento' => 'Segunda a sabado, das 08h as 18h',
            ),
        ));
        
        
    }
}