<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TbdiarioTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tbdiario')->delete();
        
        \DB::table('tbdiario')->insert(array (
            0 => 
            array (
                'codDiario' => 1,
                'tituloDiario' => 'Semana puxada no trabalho',
                'descricaoDiario' => 'Me senti sobrecarregada, mas consegui manter a rotina de sono.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-12',
                'codUsuario' => 1,
                'codTipoDiario' => 1,
            ),
            1 => 
            array (
                'codDiario' => 2,
                'tituloDiario' => 'Dia leve',
                'descricaoDiario' => 'Hoje consegui respirar fundo e fazer uma caminhada depois do almoco.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-23',
                'codUsuario' => 1,
                'codTipoDiario' => 1,
            ),
            2 => 
            array (
                'codDiario' => 3,
                'tituloDiario' => 'Pensamentos acelerados',
                'descricaoDiario' => 'Fiquei ansiosa a noite e demorei a dormir. Tentei a respiracao 4-6.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-30',
                'codUsuario' => 1,
                'codTipoDiario' => 1,
            ),
            3 => 
            array (
                'codDiario' => 4,
                'tituloDiario' => 'Conversa que ajudou',
                'descricaoDiario' => 'Falei com uma amiga sobre o que ando sentindo e me senti acolhida.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-06',
                'codUsuario' => 1,
                'codTipoDiario' => 1,
            ),
            4 => 
            array (
                'codDiario' => 5,
                'tituloDiario' => 'Colica forte',
                'descricaoDiario' => 'Colica forte logo cedo, precisei de bolsa de agua quente. Passou a tarde.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-06',
                'codUsuario' => 2,
                'codTipoDiario' => 2,
            ),
            5 => 
            array (
                'codDiario' => 6,
                'tituloDiario' => 'Dor de cabeca',
                'descricaoDiario' => 'Dor de cabeca leve o dia todo. Bebi mais agua e melhorou a noite.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-10',
                'codUsuario' => 2,
                'codTipoDiario' => 2,
            ),
            6 => 
            array (
                'codDiario' => 7,
                'tituloDiario' => 'Cansaco no corpo',
                'descricaoDiario' => 'Muito cansaco apos o estagio. Dormi cedo.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-23',
                'codUsuario' => 2,
                'codTipoDiario' => 2,
            ),
            7 => 
            array (
                'codDiario' => 8,
                'tituloDiario' => 'Inchaco',
                'descricaoDiario' => 'Barriga inchada e seios sensiveis, deve ser TPM chegando.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-27',
                'codUsuario' => 2,
                'codTipoDiario' => 2,
            ),
            8 => 
            array (
                'codDiario' => 9,
                'tituloDiario' => 'Acordei sem dormir',
                'descricaoDiario' => 'Dormi mal por conta do calor. Acordei varias vezes.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-09',
                'codUsuario' => 3,
                'codTipoDiario' => 2,
            ),
            9 => 
            array (
                'codDiario' => 10,
                'tituloDiario' => 'Rotina organizada',
                'descricaoDiario' => 'Consegui dormir antes da meia-noite pela primeira vez na semana.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-10',
                'codUsuario' => 3,
                'codTipoDiario' => 4,
            ),
            10 => 
            array (
                'codDiario' => 11,
                'tituloDiario' => 'Dia de sol',
                'descricaoDiario' => 'Sai para caminhar com minha irma, me fez bem.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-07',
                'codUsuario' => 3,
                'codTipoDiario' => 6,
            ),
            11 => 
            array (
                'codDiario' => 12,
                'tituloDiario' => 'Duvidas na escola',
                'descricaoDiario' => 'Fiquei pensando muito nas provas e senti o coracao acelerado.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-03',
                'codUsuario' => 4,
                'codTipoDiario' => 1,
            ),
            12 => 
            array (
                'codDiario' => 13,
                'tituloDiario' => 'Conversa com a professora',
                'descricaoDiario' => 'Conversei com a professora e ela me orientou a procurar a UBS.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-15',
                'codUsuario' => 4,
                'codTipoDiario' => 1,
            ),
            13 => 
            array (
                'codDiario' => 14,
                'tituloDiario' => 'Rotina corrida',
                'descricaoDiario' => 'Entre trabalho e filhos nao sobrou tempo para mim. Preciso reservar 15 minutos por dia.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-08',
                'codUsuario' => 5,
                'codTipoDiario' => 4,
            ),
            14 => 
            array (
                'codDiario' => 15,
                'tituloDiario' => 'Terapia',
                'descricaoDiario' => 'Primeira sessao com a psicologa. Chorei, mas senti alivio.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-07',
                'codUsuario' => 5,
                'codTipoDiario' => 3,
            ),
            15 => 
            array (
                'codDiario' => 16,
                'tituloDiario' => 'Pequena conquista',
                'descricaoDiario' => 'Consegui dizer nao a uma tarefa extra no trabalho.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-13',
                'codUsuario' => 5,
                'codTipoDiario' => 6,
            ),
            16 => 
            array (
                'codDiario' => 17,
                'tituloDiario' => 'Dia dificil',
                'descricaoDiario' => 'Briguei com minha mae e fiquei triste. Escrever me ajudou a organizar os pensamentos.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-14',
                'codUsuario' => 6,
                'codTipoDiario' => 1,
            ),
            17 => 
            array (
                'codDiario' => 18,
                'tituloDiario' => 'Dia tranquilo',
                'descricaoDiario' => 'Fui para a aula e depois encontrei as amigas. Dia leve.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-15',
                'codUsuario' => 6,
                'codTipoDiario' => 1,
            ),
            18 => 
            array (
                'codDiario' => 19,
                'tituloDiario' => 'Consulta marcada',
                'descricaoDiario' => 'Marquei o preventivo na UBS para a semana que vem.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-05',
                'codUsuario' => 7,
                'codTipoDiario' => 3,
            ),
            19 => 
            array (
                'codDiario' => 20,
                'tituloDiario' => 'Agua e rotina',
                'descricaoDiario' => 'Estou tentando beber dois litros de agua por dia. Hoje consegui.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-14',
                'codUsuario' => 7,
                'codTipoDiario' => 5,
            ),
            20 => 
            array (
                'codDiario' => 21,
                'tituloDiario' => 'Resultado dos testes',
                'descricaoDiario' => 'Retirei o resultado dos testes na UBS. Tudo certo, fiquei aliviada.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-14',
                'codUsuario' => 8,
                'codTipoDiario' => 3,
            ),
            21 => 
            array (
                'codDiario' => 22,
                'tituloDiario' => 'Treino',
                'descricaoDiario' => 'Voltei a treinar tres vezes na semana e o humor melhorou.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-08',
                'codUsuario' => 8,
                'codTipoDiario' => 6,
            ),
            22 => 
            array (
                'codDiario' => 23,
                'tituloDiario' => 'Pre-natal',
                'descricaoDiario' => 'Consulta do pre-natal hoje: bebe com batimentos otimos. Estou muito emocionada.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-04',
                'codUsuario' => 9,
                'codTipoDiario' => 3,
            ),
            23 => 
            array (
                'codDiario' => 24,
                'tituloDiario' => 'Enjoo',
                'descricaoDiario' => 'Enjoo logo cedo, comi bolacha de agua e sal antes de levantar.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-27',
                'codUsuario' => 9,
                'codTipoDiario' => 2,
            ),
            24 => 
            array (
                'codDiario' => 25,
                'tituloDiario' => 'Sono',
                'descricaoDiario' => 'Dormi muito mal, barriga incomoda. Tentei dormir de lado com travesseiro.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-20',
                'codUsuario' => 9,
                'codTipoDiario' => 4,
            ),
            25 => 
            array (
                'codDiario' => 26,
                'tituloDiario' => 'Respiracao',
                'descricaoDiario' => 'Usei o 5-4-3-2-1 no onibus lotado e senti a ansiedade diminuir.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-09',
                'codUsuario' => 10,
                'codTipoDiario' => 1,
            ),
            26 => 
            array (
                'codDiario' => 27,
                'tituloDiario' => 'Dia pesado',
                'descricaoDiario' => 'Acordei com o peito apertado. Passei o dia em alerta.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-22',
                'codUsuario' => 10,
                'codTipoDiario' => 1,
            ),
            27 => 
            array (
                'codDiario' => 28,
                'tituloDiario' => 'Gratidao',
                'descricaoDiario' => 'Agradeci por ter uma rede de amigos que me escuta.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-23',
                'codUsuario' => 10,
                'codTipoDiario' => 6,
            ),
            28 => 
            array (
                'codDiario' => 29,
                'tituloDiario' => 'Alimentacao',
                'descricaoDiario' => 'Comecei a planejar as refeicoes da semana para economizar e comer melhor.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-29',
                'codUsuario' => 11,
                'codTipoDiario' => 5,
            ),
            29 => 
            array (
                'codDiario' => 30,
                'tituloDiario' => 'Exame de rotina',
                'descricaoDiario' => 'Fiz exames de sangue de rotina e guardei os resultados no app.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-23',
                'codUsuario' => 11,
                'codTipoDiario' => 3,
            ),
            30 => 
            array (
                'codDiario' => 31,
                'tituloDiario' => 'Atraso',
                'descricaoDiario' => 'Minha menstruacao atrasou e fiquei preocupada. Pretendo fazer o teste.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-04',
                'codUsuario' => 12,
                'codTipoDiario' => 1,
            ),
            31 => 
            array (
                'codDiario' => 32,
                'tituloDiario' => 'Alivio',
                'descricaoDiario' => 'Menstruou hoje. Aprendi que atrasos podem acontecer por estresse.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-20',
                'codUsuario' => 12,
                'codTipoDiario' => 1,
            ),
            32 => 
            array (
                'codDiario' => 33,
                'tituloDiario' => 'Peso nos ombros',
                'descricaoDiario' => 'Dia dificil em casa. Me senti sozinha, mas li sobre onde buscar apoio.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-11',
                'codUsuario' => 13,
                'codTipoDiario' => 1,
            ),
            33 => 
            array (
                'codDiario' => 34,
                'tituloDiario' => 'Um passo',
                'descricaoDiario' => 'Salvei o telefone do 180 no celular, so por precaucao.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-05',
                'codUsuario' => 13,
                'codTipoDiario' => 6,
            ),
            34 => 
            array (
                'codDiario' => 35,
                'tituloDiario' => 'Sono ruim',
                'descricaoDiario' => 'Madrugada em claro pensando no trabalho.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-11',
                'codUsuario' => 14,
                'codTipoDiario' => 4,
            ),
            35 => 
            array (
                'codDiario' => 36,
                'tituloDiario' => 'Caminhada',
                'descricaoDiario' => 'Voltei a caminhar na orla de manha. Cabeca mais leve.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-30',
                'codUsuario' => 14,
                'codTipoDiario' => 4,
            ),
            36 => 
            array (
                'codDiario' => 37,
                'tituloDiario' => 'Ultrassom',
                'descricaoDiario' => 'Fiz o ultrassom e vimos o coracaozinho. Chorei de alegria.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-26',
                'codUsuario' => 16,
                'codTipoDiario' => 3,
            ),
            37 => 
            array (
                'codDiario' => 38,
                'tituloDiario' => 'Enjoos fortes',
                'descricaoDiario' => 'Enjoo o dia inteiro, so consegui comer frutas.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-02',
                'codUsuario' => 16,
                'codTipoDiario' => 2,
            ),
            38 => 
            array (
                'codDiario' => 39,
                'tituloDiario' => 'Faculdade',
                'descricaoDiario' => 'Semana de provas e muita ansiedade. Estou tentando dormir 7 horas.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-09-28',
                'codUsuario' => 18,
                'codTipoDiario' => 1,
            ),
            39 => 
            array (
                'codDiario' => 40,
                'tituloDiario' => 'Conquista',
                'descricaoDiario' => 'Terminei o trabalho em grupo no prazo.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-01',
                'codUsuario' => 18,
                'codTipoDiario' => 6,
            ),
            40 => 
            array (
                'codDiario' => 41,
                'tituloDiario' => 'Escola',
                'descricaoDiario' => 'Dia cansativo, mas conversei com minha psicologa sobre o que sinto.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-01',
                'codUsuario' => 19,
                'codTipoDiario' => 1,
            ),
            41 => 
            array (
                'codDiario' => 42,
                'tituloDiario' => 'Gratidao',
                'descricaoDiario' => 'Dia bom em casa, jantar em familia.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-15',
                'codUsuario' => 19,
                'codTipoDiario' => 6,
            ),
            42 => 
            array (
                'codDiario' => 43,
                'tituloDiario' => 'Maternar sozinha',
                'descricaoDiario' => 'Cansaco extremo hoje, mas minha filha sorriu e isso me renovou.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-02',
                'codUsuario' => 20,
                'codTipoDiario' => 1,
            ),
            43 => 
            array (
                'codDiario' => 44,
                'tituloDiario' => 'Rede de apoio',
                'descricaoDiario' => 'Fui ao CRAS e conheci um grupo de maes. Me senti menos sozinha.',
                'arquivoDiario' => NULL,
                'dataDiario' => '2026-10-13',
                'codUsuario' => 20,
                'codTipoDiario' => 6,
            ),
        ));
        
        
    }
}