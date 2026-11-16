<?php

namespace Database\Seeders;

use App\Models\DataSaude;
use App\Models\TipoCategoria;
use Illuminate\Database\Seeder;

// Calendário de datas, campanhas e vacinas relevantes para a saúde da mulher (Brasil).
// Pode ser executado várias vezes: cada data é identificada pelo nome (updateOrCreate).
class DataSaudeSeeder extends Seeder
{
    // Cores por tema
    private const ROSA = '#d6336c';
    private const LILAS = '#7c3aed';
    private const VERMELHO = '#c92a2a';
    private const AMARELO = '#d9a406';
    private const AZUL = '#0e7fb8';
    private const VERDE = '#0f9d8a';
    private const LARANJA = '#d9731a';
    private const GRAFITE = '#8a7680';

    public function run(): void
    {
        // Garante que as categorias reais existam (são as mesmas usadas no cadastro de conteúdo)
        $this->call(CategoriasConteudoSeeder::class);

        // [mês, dia (null = mês inteiro), nome, cor, categoria, pauta]
        $datas = [
            // ---------------- JANEIRO ----------------
            [1, null, 'Janeiro Branco', self::GRAFITE, 'Saúde mental', 'Cuidado com a saúde mental: sinais de alerta, rotina de autocuidado e quando buscar ajuda profissional.'],
            [1, null, 'Atualização da caderneta de vacinação', self::AZUL, 'Vacinação e HPV', 'Começo de ano é bom momento para revisar a caderneta: HPV, dTpa, hepatite B, tríplice viral e influenza.'],

            // ---------------- FEVEREIRO ----------------
            [2, 1, 'Semana de Prevenção da Gravidez na Adolescência', self::VERDE, 'Planejamento familiar e contracepção', 'Educação sexual, métodos contraceptivos e acesso ao planejamento familiar para adolescentes (1 a 7 de fevereiro).'],
            [2, 4, 'Dia Mundial contra o Câncer', self::LARANJA, 'Câncer de mama', 'Prevenção e rastreamento: quais exames fazer e a partir de que idade.'],
            [2, 5, 'Dia Nacional da Mamografia', self::ROSA, 'Câncer de mama', 'Mamografia: quando começar, com que frequência repetir e como agendar pelo SUS.'],
            [2, 6, 'Dia Internacional de Tolerância Zero à Mutilação Genital Feminina', self::LILAS, 'Violência contra a mulher', 'Direitos, saúde e acolhimento de mulheres e meninas expostas a essa violência.'],

            // ---------------- MARÇO ----------------
            [3, null, 'Março Lilás', self::LILAS, 'Câncer do colo do útero', 'Câncer do colo do útero: Papanicolau, vacina contra o HPV e a frequência dos exames.'],
            [3, null, 'Março Amarelo', self::AMARELO, 'Endometriose e SOP', 'Endometriose: dor pélvica, diagnóstico tardio e opções de tratamento.'],
            [3, 4, 'Dia Internacional de Conscientização do HPV', self::AZUL, 'Vacinação e HPV', 'Vacina contra o HPV: quem pode tomar pelo SUS, esquema de doses e mitos comuns.'],
            [3, 8, 'Dia Internacional da Mulher', self::LILAS, 'Saúde sexual e reprodutiva', 'Direitos e acesso à saúde da mulher em cada fase da vida.'],
            [3, 13, 'Dia Mundial da Endometriose', self::AMARELO, 'Endometriose e SOP', 'Sintomas que merecem investigação: cólica incapacitante, dor na relação e dificuldade para engravidar.'],
            [3, 26, 'Dia Internacional de Prevenção do Câncer do Colo do Útero', self::LILAS, 'Câncer do colo do útero', 'Papanicolau: quem deve fazer, de quanto em quanto tempo e como se preparar para o exame.'],

            // ---------------- ABRIL ----------------
            [4, null, 'Campanha Nacional de Vacinação contra a Influenza', self::AZUL, 'Vacinação e HPV', 'Gripe: grupos prioritários, incluindo gestantes e puérperas, e onde se vacinar.'],
            [4, 7, 'Dia Mundial da Saúde', self::AZUL, 'Nutrição e bem-estar', 'Um hábito simples de cuidado preventivo para incluir na rotina.'],
            [4, 24, 'Semana Mundial da Imunização', self::AZUL, 'Vacinação e HPV', 'Vacinas na vida da mulher: adolescência, gestação, pós-parto e idade adulta (24 a 30 de abril).'],

            // ---------------- MAIO ----------------
            [5, 5, 'Dia Internacional da Parteira', self::VERDE, 'Gravidez e pré-natal', 'Parto respeitoso, direitos da gestante e o papel de parteiras e enfermeiras obstétricas.'],
            [5, 8, 'Dia Mundial do Câncer de Ovário', self::ROSA, 'Saúde íntima e ginecológica', 'Sinais que passam despercebidos: inchaço persistente, dor pélvica e mudança no apetite.'],
            [5, 19, 'Dia Mundial de Doação de Leite Humano', self::AMARELO, 'Pós-parto e amamentação', 'Como funciona a doação de leite e a importância dos bancos de leite humano.'],
            [5, 28, 'Dia Internacional de Ação pela Saúde da Mulher', self::ROSA, 'Saúde sexual e reprodutiva', 'Consultas de rotina, pré-natal e saúde sexual: direitos e cuidados.'],
            [5, 28, 'Dia da Higiene Menstrual', self::VERMELHO, 'Saúde íntima e ginecológica', 'Ciclo menstrual: o que é esperado e quando procurar ajuda.'],
            [5, 28, 'Dia Nacional de Redução da Mortalidade Materna', self::VERMELHO, 'Gravidez e pré-natal', 'Pré-natal completo, sinais de alerta na gestação e no pós-parto.'],
            [5, 31, 'Dia Mundial sem Tabaco', self::GRAFITE, 'Nutrição e bem-estar', 'Cigarro e saúde da mulher: riscos na gestação, no uso de anticoncepcional e no câncer.'],

            // ---------------- JUNHO ----------------
            [6, 12, 'Dia dos Namorados: sexo seguro', self::ROSA, 'ISTs e prevenção', 'Preservativo, testagem e conversa aberta sobre prevenção de ISTs e gravidez não planejada.'],
            [6, 14, 'Dia Mundial do Doador de Sangue', self::VERMELHO, 'Nutrição e bem-estar', 'Quem pode doar, mitos e a importância da doação regular, incluindo anemia e doação após o parto.'],
            [6, 17, 'Dia Nacional da Vacinação', self::AZUL, 'Vacinação e HPV', 'Importância de manter a caderneta em dia: vacinas recomendadas para mulheres em cada fase.'],
            [6, 27, 'Dia Nacional do Teste de HIV', self::VERMELHO, 'ISTs e prevenção', 'Testagem rápida gratuita, PrEP, PEP e acolhimento sem julgamento.'],

            // ---------------- JULHO ----------------
            [7, null, 'Julho Amarelo', self::AMARELO, 'ISTs e prevenção', 'Hepatites virais: formas de transmissão, testagem e vacinação.'],
            [7, 25, 'Dia Internacional da Mulher Negra Latino-Americana e Caribenha', self::LILAS, 'Saúde sexual e reprodutiva', 'Equidade racial na saúde: mortalidade materna, miomas, anemia falciforme e acesso a atendimento.'],
            [7, 28, 'Dia Mundial das Hepatites', self::AMARELO, 'ISTs e prevenção', 'Hepatites B e C na gestação: testagem no pré-natal, vacina da hepatite B e tratamento.'],

            // ---------------- AGOSTO ----------------
            [8, null, 'Agosto Lilás', self::LILAS, 'Violência contra a mulher', 'Violência contra a mulher: tipos de violência, sinais e canais de apoio (Ligue 180).'],
            [8, null, 'Agosto Dourado', '#b7791f', 'Pós-parto e amamentação', 'Amamentação: benefícios, dificuldades comuns e como buscar apoio.'],
            [8, 1, 'Semana Mundial da Amamentação', '#b7791f', 'Pós-parto e amamentação', 'Pega correta, apoio ao aleitamento e retorno ao trabalho (1 a 7 de agosto).'],
            [8, 7, 'Aniversário da Lei Maria da Penha', self::LILAS, 'Violência contra a mulher', 'Medidas protetivas, como denunciar e a rede de acolhimento disponível.'],

            // ---------------- SETEMBRO ----------------
            [9, null, 'Setembro Amarelo', self::AMARELO, 'Saúde mental', 'Prevenção do suicídio: como acolher, sinais de alerta e onde encontrar ajuda (CVV 188).'],
            [9, null, 'Setembro Vermelho', self::VERMELHO, 'Nutrição e bem-estar', 'Saúde do coração: fatores de risco na mulher, pressão alta, gestação e menopausa.'],
            [9, 4, 'Dia Mundial da Saúde Sexual', self::ROSA, 'Saúde sexual e reprodutiva', 'Sexualidade saudável, consentimento, prazer e queixas que merecem avaliação.'],
            [9, 10, 'Dia Mundial de Prevenção do Suicídio', self::AMARELO, 'Saúde mental', 'Como conversar sobre o assunto, reconhecer sinais de risco e encaminhar para ajuda.'],
            [9, 26, 'Dia Mundial da Contracepção', self::VERDE, 'Planejamento familiar e contracepção', 'Métodos contraceptivos: como funcionam, quais existem e como escolher com acompanhamento.'],

            // ---------------- OUTUBRO ----------------
            [10, null, 'Outubro Rosa', self::ROSA, 'Câncer de mama', 'Câncer de mama: autoconhecimento, mamografia e quando procurar atendimento.'],
            [10, null, 'Campanha de Multivacinação', self::AZUL, 'Vacinação e HPV', 'Atualização de vacinas de crianças e adolescentes, incluindo a vacina do HPV.'],
            [10, 10, 'Dia Mundial da Saúde Mental', self::VERDE, 'Saúde mental', 'Ansiedade e estresse no dia a dia: estratégias práticas de cuidado.'],
            [10, 15, 'Dia Mundial da Lavagem das Mãos', self::AZUL, 'Saúde íntima e ginecológica', 'Higiene das mãos, saúde íntima e prevenção de infecções.'],
            [10, 18, 'Dia Mundial da Menopausa', self::LARANJA, 'Menopausa', 'Sintomas, terapia hormonal, saúde dos ossos e qualidade de vida após os 45.'],
            [10, 20, 'Dia Mundial da Osteoporose', self::LARANJA, 'Menopausa', 'Densitometria óssea, cálcio, vitamina D e atividade física após a menopausa.'],

            // ---------------- NOVEMBRO ----------------
            [11, null, 'Novembro Azul', '#2b6cb0', 'Saúde sexual e reprodutiva', 'Saúde do homem: prevenção do câncer de próstata e check-up de rotina.'],
            [11, null, 'Novembro Roxo', self::LILAS, 'Gravidez e pré-natal', 'Prematuridade: fatores de risco, pré-natal de qualidade e cuidados com o bebê prematuro.'],
            [11, 14, 'Dia Mundial do Diabetes', self::AZUL, 'Gravidez e pré-natal', 'Diabetes gestacional: rastreamento, alimentação e riscos para mãe e bebê.'],
            [11, 17, 'Dia Mundial da Prematuridade', self::LILAS, 'Gravidez e pré-natal', 'Sinais de trabalho de parto prematuro e acolhimento das famílias.'],
            [11, 20, 'Dia da Consciência Negra', self::LILAS, 'Saúde sexual e reprodutiva', 'Racismo e saúde: acesso, mortalidade materna e cuidado equânime.'],
            [11, 25, 'Dia Internacional da Eliminação da Violência contra a Mulher', self::LILAS, 'Violência contra a mulher', 'Como reconhecer relacionamentos abusivos e buscar proteção.'],

            // ---------------- DEZEMBRO ----------------
            [12, null, 'Dezembro Vermelho', self::VERMELHO, 'ISTs e prevenção', 'HIV/Aids e outras ISTs: prevenção, testagem e tratamento.'],
            [12, null, 'Dezembro Laranja', self::LARANJA, 'Nutrição e bem-estar', 'Câncer de pele: proteção solar, autoexame e sinais de alerta.'],
            [12, 1, 'Dia Mundial de Luta contra a Aids', self::VERMELHO, 'ISTs e prevenção', 'Testagem rápida, PrEP e PEP: o que são e onde conseguir.'],
            [12, 6, 'Dia Nacional de Mobilização dos Homens pelo Fim da Violência contra as Mulheres', self::LILAS, 'Violência contra a mulher', 'Papel dos homens na prevenção da violência e na construção de relações respeitosas.'],
        ];

        foreach ($datas as [$mes, $dia, $nome, $cor, $categoria, $pauta]) {
            $cod = TipoCategoria::firstOrCreate(['nomeTipoCategoria' => $categoria])->codTipoCategoria;

            DataSaude::updateOrCreate(
                ['nomeDataSaude' => $nome],
                [
                    'mesDataSaude' => $mes,
                    'diaDataSaude' => $dia,
                    'corDataSaude' => $cor,
                    'pautaDataSaude' => $pauta,
                    'codTipoCategoria' => $cod,
                ]
            );
        }
    }
}
