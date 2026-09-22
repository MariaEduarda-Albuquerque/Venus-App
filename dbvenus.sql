-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/09/2026 às 21:01
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbvenus`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `codtipocategoria`
--

CREATE TABLE `codtipocategoria` (
  `codTipoCategoria` int(10) UNSIGNED NOT NULL,
  `nomeTipoCategoria` varchar(60) NOT NULL,
  `descricaoTipoCategoria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbadmin`
--

CREATE TABLE `tbadmin` (
  `codAdmin` int(10) UNSIGNED NOT NULL,
  `nomeAdmin` varchar(120) NOT NULL,
  `emailAdmin` varchar(150) NOT NULL,
  `telAdmin` varchar(14) DEFAULT NULL,
  `paisAdmin` varchar(60) DEFAULT NULL,
  `cidadeAdmin` varchar(100) DEFAULT NULL,
  `ufAdmin` char(2) DEFAULT NULL,
  `cepAdmin` varchar(10) DEFAULT NULL,
  `nrFiscalAdmin` varchar(20) DEFAULT NULL,
  `temaAdmin` enum('claro','escuro','sistema') NOT NULL DEFAULT 'sistema',
  `senhaAdmin` varchar(255) NOT NULL,
  `codPapel` tinyint(3) UNSIGNED NOT NULL,
  `duasEtapasAtiva` tinyint(1) NOT NULL DEFAULT 0,
  `statusConta` enum('ativa','suspensa') NOT NULL DEFAULT 'ativa',
  `dataCadastro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbavaliacaoconsulta`
--

CREATE TABLE `tbavaliacaoconsulta` (
  `codConsulta` int(10) UNSIGNED NOT NULL,
  `nota` tinyint(3) UNSIGNED NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `dataAvaliacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbavaliacaounidade`
--

CREATE TABLE `tbavaliacaounidade` (
  `codAvaliacao` int(10) UNSIGNED NOT NULL,
  `codUnidade` int(10) UNSIGNED NOT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `nota` tinyint(3) UNSIGNED NOT NULL,
  `lotacaoPercebida` enum('livre','moderado','cheio') NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `dataAvaliacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbbloqueioagenda`
--

CREATE TABLE `tbbloqueioagenda` (
  `codBloqueio` int(10) UNSIGNED NOT NULL,
  `codProfissionalSaude` int(10) UNSIGNED NOT NULL,
  `dataBloqueio` date NOT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFim` time DEFAULT NULL,
  `motivoBloqueio` varchar(150) DEFAULT NULL,
  `dataCriacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbchamadosuporte`
--

CREATE TABLE `tbchamadosuporte` (
  `codChamado` int(10) UNSIGNED NOT NULL,
  `codProfissionalSaude` int(10) UNSIGNED NOT NULL,
  `assuntoChamado` varchar(150) NOT NULL,
  `descricaoChamado` text NOT NULL,
  `anexoChamado` varchar(255) DEFAULT NULL,
  `statusChamado` enum('aberto','em_atendimento','resolvido') NOT NULL DEFAULT 'aberto',
  `dataAbertura` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbciclomenstrual`
--

CREATE TABLE `tbciclomenstrual` (
  `codCiclo` int(10) UNSIGNED NOT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `dataInicio` date NOT NULL,
  `duracaoDias` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbconselho`
--

CREATE TABLE `tbconselho` (
  `codConselho` int(11) NOT NULL,
  `codProfissionalSaude` int(10) UNSIGNED NOT NULL,
  `ufConselho` char(2) DEFAULT NULL,
  `numConselho` char(6) DEFAULT NULL,
  `registroConselho` blob DEFAULT NULL,
  `documentoComplementarConselho` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbconsulta`
--

CREATE TABLE `tbconsulta` (
  `codConsulta` int(10) UNSIGNED NOT NULL,
  `nomeConsulta` varchar(120) NOT NULL,
  `tipoConsulta` enum('agendada','duvida_rapida') NOT NULL DEFAULT 'agendada',
  `idTipoAtendimento` int(11) DEFAULT NULL,
  `statusConsulta` enum('aguardando','em_andamento','encerrada','cancelada') NOT NULL DEFAULT 'aguardando',
  `dataHoraAgendada` datetime DEFAULT NULL,
  `historicoConsulta` text DEFAULT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `codProfissionalSaude` int(10) UNSIGNED NOT NULL,
  `dataCriacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbconteudo`
--

CREATE TABLE `tbconteudo` (
  `codConteudo` int(10) UNSIGNED NOT NULL,
  `tituloConteudo` varchar(150) NOT NULL,
  `corpoConteudo` mediumtext NOT NULL,
  `capaConteudo` varchar(255) DEFAULT NULL,
  `tempoLeituraMinutos` smallint(5) UNSIGNED DEFAULT NULL,
  `codTipoCategoria` int(10) UNSIGNED NOT NULL,
  `codTipoConteudo` int(10) UNSIGNED NOT NULL,
  `codProfissionalSaude` int(10) UNSIGNED DEFAULT NULL,
  `statusConteudo` enum('rascunho','em_revisao','publicado','recusado') NOT NULL DEFAULT 'rascunho',
  `dataCriacao` datetime NOT NULL DEFAULT current_timestamp(),
  `dataAtualizacao` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbconteudoadmin`
--

CREATE TABLE `tbconteudoadmin` (
  `codConteudoAdmin` int(10) UNSIGNED NOT NULL,
  `codConteudo` int(10) UNSIGNED NOT NULL,
  `codAdmin` int(10) UNSIGNED NOT NULL,
  `decisao` enum('aprovado','recusado','ajuste_solicitado') NOT NULL,
  `motivoDecisao` varchar(255) DEFAULT NULL,
  `dataDecisao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbconteudosalvo`
--

CREATE TABLE `tbconteudosalvo` (
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `codConteudo` int(10) UNSIGNED NOT NULL,
  `dataSalvo` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbdenuncia`
--

CREATE TABLE `tbdenuncia` (
  `codDenuncia` int(10) UNSIGNED NOT NULL,
  `tipoAlvo` enum('forum_publicacao','forum_resposta','mensagem_chat','perfil_profissional') NOT NULL,
  `codAlvo` int(10) UNSIGNED NOT NULL,
  `codUsuarioDenunciante` int(10) UNSIGNED DEFAULT NULL,
  `motivoDenuncia` varchar(255) NOT NULL,
  `comentarioDenuncia` varchar(255) DEFAULT NULL,
  `gravidade` enum('baixa','media','alta') NOT NULL DEFAULT 'media',
  `statusDenuncia` enum('pendente','em_analise','resolvida','arquivada') NOT NULL DEFAULT 'pendente',
  `dataDenuncia` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbdenunciaacao`
--

CREATE TABLE `tbdenunciaacao` (
  `codDenunciaAcao` int(10) UNSIGNED NOT NULL,
  `codDenuncia` int(10) UNSIGNED NOT NULL,
  `codAdmin` int(10) UNSIGNED NOT NULL,
  `acaoTomada` enum('remover_conteudo','advertir','suspender_conta','arquivar_sem_acao') NOT NULL,
  `justificativa` varchar(255) NOT NULL,
  `dataAcao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbdiario`
--

CREATE TABLE `tbdiario` (
  `codDiario` int(10) UNSIGNED NOT NULL,
  `tituloDiario` varchar(120) NOT NULL,
  `descricaoDiario` text DEFAULT NULL,
  `arquivoDiario` varchar(255) DEFAULT NULL,
  `dataDiario` date NOT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `codTipoDiario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbdisponibilidadeprofissional`
--

CREATE TABLE `tbdisponibilidadeprofissional` (
  `codDisponibilidade` int(10) UNSIGNED NOT NULL,
  `codProfissionalSaude` int(10) UNSIGNED NOT NULL,
  `diaSemana` tinyint(3) UNSIGNED NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFim` time NOT NULL,
  `tipoAtendimento` enum('chat','duvida_rapida','presencial') NOT NULL,
  `idTipoAtendimento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbevento`
--

CREATE TABLE `tbevento` (
  `codEvento` int(10) UNSIGNED NOT NULL,
  `tituloEvento` varchar(150) NOT NULL,
  `descricaoEvento` text DEFAULT NULL,
  `bannerEvento` varchar(255) DEFAULT NULL,
  `formatoEvento` enum('online','presencial') NOT NULL,
  `linkOuEndereco` varchar(255) DEFAULT NULL,
  `dataHoraEvento` datetime NOT NULL,
  `duracaoMinutos` smallint(5) UNSIGNED DEFAULT NULL,
  `vagasTotais` int(10) UNSIGNED DEFAULT NULL,
  `codProfissionalSaude` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbexame`
--

CREATE TABLE `tbexame` (
  `codExame` int(10) UNSIGNED NOT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `nomeExame` varchar(150) NOT NULL,
  `arquivoExame` varchar(255) NOT NULL,
  `dataExame` date NOT NULL,
  `statusExame` enum('salvo','analisado') NOT NULL DEFAULT 'salvo',
  `observacaoExame` varchar(255) DEFAULT NULL,
  `dataUpload` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbfeedback`
--

CREATE TABLE `tbfeedback` (
  `codFeedback` int(10) UNSIGNED NOT NULL,
  `autorTipo` enum('usuaria','profissional') NOT NULL,
  `codUsuario` int(10) UNSIGNED DEFAULT NULL,
  `codProfissionalSaude` int(10) UNSIGNED DEFAULT NULL,
  `nota` tinyint(3) UNSIGNED NOT NULL,
  `categoriaFeedback` enum('sugestao','problema_tecnico','elogio','outro') NOT NULL,
  `assuntoFeedback` varchar(150) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `statusFeedback` enum('enviado','em_analise','respondido') NOT NULL DEFAULT 'enviado',
  `dataFeedback` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbforumpublicacao`
--

CREATE TABLE `tbforumpublicacao` (
  `codForumPublicacao` int(10) UNSIGNED NOT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `codTipoCategoria` int(10) UNSIGNED DEFAULT NULL,
  `tituloPublicacao` varchar(150) NOT NULL,
  `textoPublicacao` text NOT NULL,
  `anexoPublicacao` varchar(255) DEFAULT NULL,
  `publicadoAnonimo` tinyint(1) NOT NULL DEFAULT 0,
  `dataPublicacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbforumreacao`
--

CREATE TABLE `tbforumreacao` (
  `codForumPublicacao` int(10) UNSIGNED NOT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `tipoReacao` enum('apoio') NOT NULL DEFAULT 'apoio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbforumresposta`
--

CREATE TABLE `tbforumresposta` (
  `codForumResposta` int(10) UNSIGNED NOT NULL,
  `codForumPublicacao` int(10) UNSIGNED NOT NULL,
  `autorTipo` enum('usuaria','profissional') NOT NULL,
  `codUsuario` int(10) UNSIGNED DEFAULT NULL,
  `codProfissionalSaude` int(10) UNSIGNED DEFAULT NULL,
  `textoResposta` text NOT NULL,
  `dataResposta` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbhumordiario`
--

CREATE TABLE `tbhumordiario` (
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `dataRegistro` date NOT NULL,
  `humor` enum('otimo','bom','neutro','ruim','pessimo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbinscricaoevento`
--

CREATE TABLE `tbinscricaoevento` (
  `codEvento` int(10) UNSIGNED NOT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `dataInscricao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbinteresseusuario`
--

CREATE TABLE `tbinteresseusuario` (
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `codTipoCategoria` int(10) UNSIGNED NOT NULL,
  `dataSelecionado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tblembreteremedio`
--

CREATE TABLE `tblembreteremedio` (
  `codLembreteRemedio` int(10) UNSIGNED NOT NULL,
  `nomeLembreteRemedio` varchar(100) NOT NULL,
  `dosagemLembreteRemedio` varchar(60) NOT NULL,
  `horarioLembreteRemedio` time NOT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmensagem`
--

CREATE TABLE `tbmensagem` (
  `codMensagem` bigint(20) UNSIGNED NOT NULL,
  `codConsulta` int(10) UNSIGNED NOT NULL,
  `remetenteTipo` enum('usuaria','profissional') NOT NULL,
  `textoMensagem` text DEFAULT NULL,
  `anexoMensagem` varchar(255) DEFAULT NULL,
  `lidaEm` datetime DEFAULT NULL,
  `dataEnvio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbnotificacao`
--

CREATE TABLE `tbnotificacao` (
  `codNotificacao` bigint(20) UNSIGNED NOT NULL,
  `destinatarioTipo` enum('usuaria','profissional','admin') NOT NULL,
  `codDestinatario` int(10) UNSIGNED NOT NULL,
  `tipoNotificacao` varchar(50) NOT NULL,
  `tituloNotificacao` varchar(150) NOT NULL,
  `corpoNotificacao` varchar(255) DEFAULT NULL,
  `lida` tinyint(1) NOT NULL DEFAULT 0,
  `dataEnvio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbpapel`
--

CREATE TABLE `tbpapel` (
  `codPapel` tinyint(3) UNSIGNED NOT NULL,
  `nomePapel` varchar(30) NOT NULL,
  `descricaoPapel` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbprofissionalsaude`
--

CREATE TABLE `tbprofissionalsaude` (
  `codProfissionalSaude` int(10) UNSIGNED NOT NULL,
  `nomeProfissionalSaude` varchar(120) NOT NULL,
  `emailProfissionalSaude` varchar(150) NOT NULL,
  `telProfissionalSaude` varchar(14) DEFAULT NULL,
  `senhaProfissionalSaude` varchar(255) NOT NULL,
  `duasEtapasAtiva` tinyint(1) NOT NULL DEFAULT 0,
  `provedorLoginProfissional` enum('local','google') NOT NULL DEFAULT 'local',
  `googleIdProfissional` varchar(255) DEFAULT NULL,
  `categoriaProfissional` enum('medico','enfermeiro','psicologo','assistente_social','outro') NOT NULL,
  `especialidadeProfissionalSaude` varchar(25) DEFAULT NULL,
  `apresentacaoProfissional` varchar(400) DEFAULT NULL,
  `paisProfissional` varchar(60) DEFAULT NULL,
  `cidadeProfissional` varchar(100) DEFAULT NULL,
  `ufProfissional` char(2) DEFAULT NULL,
  `cepProfissional` varchar(10) DEFAULT NULL,
  `nrFiscalProfissional` varchar(20) DEFAULT NULL,
  `fotoPerfilProfissional` varchar(255) DEFAULT NULL,
  `statusVerificacao` enum('em_analise','aprovado','pendencia') NOT NULL DEFAULT 'em_analise',
  `statusConta` enum('ativa','suspensa','excluida') NOT NULL DEFAULT 'ativa',
  `dataCadastro` datetime NOT NULL DEFAULT current_timestamp(),
  `dataAtualizacao` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbprogressotrilha`
--

CREATE TABLE `tbprogressotrilha` (
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `codTrilha` int(10) UNSIGNED NOT NULL,
  `codConteudo` int(10) UNSIGNED NOT NULL,
  `concluidoEm` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbpublicacao`
--

CREATE TABLE `tbpublicacao` (
  `codPublicacao` int(10) UNSIGNED NOT NULL,
  `tituloPublicacao` varchar(150) NOT NULL,
  `descricaoPublicacao` varchar(255) DEFAULT NULL,
  `codConteudo` int(10) UNSIGNED NOT NULL,
  `dataPublicacao` datetime NOT NULL DEFAULT current_timestamp(),
  `visualizacoes` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `tempoMedioLeituraSeg` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbservicounidade`
--

CREATE TABLE `tbservicounidade` (
  `codServico` int(10) UNSIGNED NOT NULL,
  `nomeServico` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbsintomaciclo`
--

CREATE TABLE `tbsintomaciclo` (
  `codCiclo` int(10) UNSIGNED NOT NULL,
  `dataRegistro` date NOT NULL,
  `sintoma` enum('colica','fluxo_leve','fluxo_moderado','fluxo_intenso','humor','enxaqueca','dor_de_cabeca','inchaco','irritabilidade','cansaco','nausea','secrecao','outro') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbtipoatendimento`
--

CREATE TABLE `tbtipoatendimento` (
  `idTipoAtendimento` int(11) NOT NULL,
  `descricaoTipoAtendimento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbtipoconteudo`
--

CREATE TABLE `tbtipoconteudo` (
  `codTipoConteudo` int(10) UNSIGNED NOT NULL,
  `descricaoTipoConteudo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbtipodiario`
--

CREATE TABLE `tbtipodiario` (
  `codTipoDiario` int(10) UNSIGNED NOT NULL,
  `descricaoTipoDiario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbtrilhaaprendizado`
--

CREATE TABLE `tbtrilhaaprendizado` (
  `codTrilha` int(10) UNSIGNED NOT NULL,
  `nomeTrilha` varchar(100) NOT NULL,
  `descricaoTrilha` varchar(255) DEFAULT NULL,
  `codTipoCategoria` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbtrilhaconteudo`
--

CREATE TABLE `tbtrilhaconteudo` (
  `codTrilha` int(10) UNSIGNED NOT NULL,
  `codConteudo` int(10) UNSIGNED NOT NULL,
  `ordem` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbunidadesaude`
--

CREATE TABLE `tbunidadesaude` (
  `codUnidade` int(10) UNSIGNED NOT NULL,
  `nomeUnidade` varchar(150) NOT NULL,
  `tipoUnidade` enum('UBS','UPA','CAPS','CRAS','Farmacia_Popular') NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `horarioFuncionamento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbunidadeservico`
--

CREATE TABLE `tbunidadeservico` (
  `codUnidade` int(10) UNSIGNED NOT NULL,
  `codServico` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `nomeUsuario` varchar(120) NOT NULL,
  `apelidoUsuario` varchar(60) DEFAULT NULL,
  `biografiaUsuario` varchar(255) DEFAULT NULL,
  `pronomesUsuario` varchar(30) DEFAULT NULL,
  `linkUsuario` varchar(255) DEFAULT NULL,
  `emailUsuario` varchar(150) DEFAULT NULL,
  `telUsuario` varchar(14) DEFAULT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  `provedorLoginUsuario` enum('local','google') NOT NULL DEFAULT 'local',
  `googleIdUsuario` varchar(255) DEFAULT NULL,
  `dataNascimentoUsuario` date NOT NULL,
  `cidadeUsuario` varchar(100) DEFAULT NULL,
  `bairroUsuario` varchar(100) DEFAULT NULL,
  `ufUsuario` char(2) DEFAULT NULL,
  `fotoPerfilUsuario` varchar(255) DEFAULT NULL,
  `temaUsuario` enum('claro','escuro') NOT NULL DEFAULT 'claro',
  `idiomaUsuario` varchar(10) NOT NULL DEFAULT 'pt-BR',
  `anonimaPadraoUsuario` tinyint(1) NOT NULL DEFAULT 0,
  `statusUsuario` enum('ativa','suspensa','excluida') NOT NULL DEFAULT 'ativa',
  `dataCadastro` datetime NOT NULL DEFAULT current_timestamp(),
  `dataAtualizacao` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbvacina`
--

CREATE TABLE `tbvacina` (
  `codVacina` int(10) UNSIGNED NOT NULL,
  `codUsuario` int(10) UNSIGNED NOT NULL,
  `nomeVacina` varchar(100) NOT NULL,
  `dataAplicacao` date DEFAULT NULL,
  `doseVacina` varchar(30) DEFAULT NULL,
  `comprovanteVacina` varchar(255) DEFAULT NULL,
  `dataRegistro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Índices de tabela `codtipocategoria`
--
ALTER TABLE `codtipocategoria`
  ADD PRIMARY KEY (`codTipoCategoria`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`codAdmin`),
  ADD UNIQUE KEY `uq_admin_email` (`emailAdmin`),
  ADD KEY `codPapel` (`codPapel`);

--
-- Índices de tabela `tbavaliacaoconsulta`
--
ALTER TABLE `tbavaliacaoconsulta`
  ADD PRIMARY KEY (`codConsulta`);

--
-- Índices de tabela `tbavaliacaounidade`
--
ALTER TABLE `tbavaliacaounidade`
  ADD PRIMARY KEY (`codAvaliacao`),
  ADD KEY `codUnidade` (`codUnidade`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Índices de tabela `tbbloqueioagenda`
--
ALTER TABLE `tbbloqueioagenda`
  ADD PRIMARY KEY (`codBloqueio`),
  ADD KEY `idx_bloqueio_profissional_data` (`codProfissionalSaude`,`dataBloqueio`);

--
-- Índices de tabela `tbchamadosuporte`
--
ALTER TABLE `tbchamadosuporte`
  ADD PRIMARY KEY (`codChamado`),
  ADD KEY `codProfissionalSaude` (`codProfissionalSaude`);

--
-- Índices de tabela `tbciclomenstrual`
--
ALTER TABLE `tbciclomenstrual`
  ADD PRIMARY KEY (`codCiclo`),
  ADD KEY `idx_ciclo_usuario` (`codUsuario`,`dataInicio`);

--
-- Índices de tabela `tbconselho`
--
ALTER TABLE `tbconselho`
  ADD PRIMARY KEY (`codConselho`),
  ADD UNIQUE KEY `uq_conselho_profissional` (`codProfissionalSaude`),
  ADD UNIQUE KEY `uq_conselho_uf_numero` (`ufConselho`,`numConselho`);

--
-- Índices de tabela `tbconsulta`
--
ALTER TABLE `tbconsulta`
  ADD PRIMARY KEY (`codConsulta`),
  ADD KEY `codUsuario` (`codUsuario`),
  ADD KEY `idx_consulta_profissional_status` (`codProfissionalSaude`,`statusConsulta`),
  ADD KEY `idx_consulta_tipoatendimento` (`idTipoAtendimento`);

--
-- Índices de tabela `tbconteudo`
--
ALTER TABLE `tbconteudo`
  ADD PRIMARY KEY (`codConteudo`),
  ADD KEY `codTipoCategoria` (`codTipoCategoria`),
  ADD KEY `codTipoConteudo` (`codTipoConteudo`),
  ADD KEY `codProfissionalSaude` (`codProfissionalSaude`),
  ADD KEY `idx_conteudo_status` (`statusConteudo`);

--
-- Índices de tabela `tbconteudoadmin`
--
ALTER TABLE `tbconteudoadmin`
  ADD PRIMARY KEY (`codConteudoAdmin`),
  ADD KEY `codConteudo` (`codConteudo`),
  ADD KEY `codAdmin` (`codAdmin`);

--
-- Índices de tabela `tbconteudosalvo`
--
ALTER TABLE `tbconteudosalvo`
  ADD PRIMARY KEY (`codUsuario`,`codConteudo`),
  ADD KEY `codConteudo` (`codConteudo`);

--
-- Índices de tabela `tbdenuncia`
--
ALTER TABLE `tbdenuncia`
  ADD PRIMARY KEY (`codDenuncia`),
  ADD KEY `codUsuarioDenunciante` (`codUsuarioDenunciante`),
  ADD KEY `idx_denuncia_status_gravidade` (`statusDenuncia`,`gravidade`);

--
-- Índices de tabela `tbdenunciaacao`
--
ALTER TABLE `tbdenunciaacao`
  ADD PRIMARY KEY (`codDenunciaAcao`),
  ADD KEY `codDenuncia` (`codDenuncia`),
  ADD KEY `codAdmin` (`codAdmin`);

--
-- Índices de tabela `tbdiario`
--
ALTER TABLE `tbdiario`
  ADD PRIMARY KEY (`codDiario`),
  ADD KEY `codTipoDiario` (`codTipoDiario`),
  ADD KEY `idx_diario_usuario_data` (`codUsuario`,`dataDiario`);

--
-- Índices de tabela `tbdisponibilidadeprofissional`
--
ALTER TABLE `tbdisponibilidadeprofissional`
  ADD PRIMARY KEY (`codDisponibilidade`),
  ADD KEY `codProfissionalSaude` (`codProfissionalSaude`),
  ADD KEY `idx_disponibilidade_tipoatendimento` (`idTipoAtendimento`);

--
-- Índices de tabela `tbevento`
--
ALTER TABLE `tbevento`
  ADD PRIMARY KEY (`codEvento`),
  ADD KEY `codProfissionalSaude` (`codProfissionalSaude`);

--
-- Índices de tabela `tbexame`
--
ALTER TABLE `tbexame`
  ADD PRIMARY KEY (`codExame`),
  ADD KEY `idx_exame_usuario` (`codUsuario`,`dataExame`);

--
-- Índices de tabela `tbfeedback`
--
ALTER TABLE `tbfeedback`
  ADD PRIMARY KEY (`codFeedback`),
  ADD KEY `codUsuario` (`codUsuario`),
  ADD KEY `codProfissionalSaude` (`codProfissionalSaude`);

--
-- Índices de tabela `tbforumpublicacao`
--
ALTER TABLE `tbforumpublicacao`
  ADD PRIMARY KEY (`codForumPublicacao`),
  ADD KEY `codUsuario` (`codUsuario`),
  ADD KEY `codTipoCategoria` (`codTipoCategoria`);

--
-- Índices de tabela `tbforumreacao`
--
ALTER TABLE `tbforumreacao`
  ADD PRIMARY KEY (`codForumPublicacao`,`codUsuario`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Índices de tabela `tbforumresposta`
--
ALTER TABLE `tbforumresposta`
  ADD PRIMARY KEY (`codForumResposta`),
  ADD KEY `codForumPublicacao` (`codForumPublicacao`),
  ADD KEY `codUsuario` (`codUsuario`),
  ADD KEY `codProfissionalSaude` (`codProfissionalSaude`);

--
-- Índices de tabela `tbhumordiario`
--
ALTER TABLE `tbhumordiario`
  ADD PRIMARY KEY (`codUsuario`,`dataRegistro`);

--
-- Índices de tabela `tbinscricaoevento`
--
ALTER TABLE `tbinscricaoevento`
  ADD PRIMARY KEY (`codEvento`,`codUsuario`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Índices de tabela `tbinteresseusuario`
--
ALTER TABLE `tbinteresseusuario`
  ADD PRIMARY KEY (`codUsuario`,`codTipoCategoria`),
  ADD KEY `codTipoCategoria` (`codTipoCategoria`);

--
-- Índices de tabela `tblembreteremedio`
--
ALTER TABLE `tblembreteremedio`
  ADD PRIMARY KEY (`codLembreteRemedio`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Índices de tabela `tbmensagem`
--
ALTER TABLE `tbmensagem`
  ADD PRIMARY KEY (`codMensagem`),
  ADD KEY `idx_mensagem_consulta` (`codConsulta`,`dataEnvio`);

--
-- Índices de tabela `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  ADD PRIMARY KEY (`codNotificacao`),
  ADD KEY `idx_notificacao_destinatario` (`destinatarioTipo`,`codDestinatario`,`lida`);

--
-- Índices de tabela `tbpapel`
--
ALTER TABLE `tbpapel`
  ADD PRIMARY KEY (`codPapel`),
  ADD UNIQUE KEY `uq_papel_nome` (`nomePapel`);

--
-- Índices de tabela `tbprofissionalsaude`
--
ALTER TABLE `tbprofissionalsaude`
  ADD PRIMARY KEY (`codProfissionalSaude`),
  ADD UNIQUE KEY `uq_profissional_email` (`emailProfissionalSaude`);

--
-- Índices de tabela `tbprogressotrilha`
--
ALTER TABLE `tbprogressotrilha`
  ADD PRIMARY KEY (`codUsuario`,`codTrilha`,`codConteudo`),
  ADD KEY `codTrilha` (`codTrilha`),
  ADD KEY `codConteudo` (`codConteudo`);

--
-- Índices de tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD PRIMARY KEY (`codPublicacao`),
  ADD UNIQUE KEY `uq_publicacao_conteudo` (`codConteudo`);

--
-- Índices de tabela `tbservicounidade`
--
ALTER TABLE `tbservicounidade`
  ADD PRIMARY KEY (`codServico`);

--
-- Índices de tabela `tbsintomaciclo`
--
ALTER TABLE `tbsintomaciclo`
  ADD PRIMARY KEY (`codCiclo`,`dataRegistro`,`sintoma`);

--
-- Índices de tabela `tbtipoatendimento`
--
ALTER TABLE `tbtipoatendimento`
  ADD PRIMARY KEY (`idTipoAtendimento`);

--
-- Índices de tabela `tbtipoconteudo`
--
ALTER TABLE `tbtipoconteudo`
  ADD PRIMARY KEY (`codTipoConteudo`);

--
-- Índices de tabela `tbtipodiario`
--
ALTER TABLE `tbtipodiario`
  ADD PRIMARY KEY (`codTipoDiario`);

--
-- Índices de tabela `tbtrilhaaprendizado`
--
ALTER TABLE `tbtrilhaaprendizado`
  ADD PRIMARY KEY (`codTrilha`),
  ADD KEY `codTipoCategoria` (`codTipoCategoria`);

--
-- Índices de tabela `tbtrilhaconteudo`
--
ALTER TABLE `tbtrilhaconteudo`
  ADD PRIMARY KEY (`codTrilha`,`codConteudo`),
  ADD KEY `codConteudo` (`codConteudo`);

--
-- Índices de tabela `tbunidadesaude`
--
ALTER TABLE `tbunidadesaude`
  ADD PRIMARY KEY (`codUnidade`),
  ADD KEY `idx_unidade_geo` (`latitude`,`longitude`);

--
-- Índices de tabela `tbunidadeservico`
--
ALTER TABLE `tbunidadeservico`
  ADD PRIMARY KEY (`codUnidade`,`codServico`),
  ADD KEY `codServico` (`codServico`);

--
-- Índices de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`codUsuario`),
  ADD UNIQUE KEY `uq_usuario_email` (`emailUsuario`),
  ADD KEY `idx_usuario_cidade_uf` (`cidadeUsuario`,`ufUsuario`),
  ADD KEY `idx_usuario_bairro` (`bairroUsuario`);

--
-- Índices de tabela `tbvacina`
--
ALTER TABLE `tbvacina`
  ADD PRIMARY KEY (`codVacina`),
  ADD KEY `idx_vacina_usuario` (`codUsuario`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `codtipocategoria`
--
ALTER TABLE `codtipocategoria`
  MODIFY `codTipoCategoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `codAdmin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbavaliacaounidade`
--
ALTER TABLE `tbavaliacaounidade`
  MODIFY `codAvaliacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbbloqueioagenda`
--
ALTER TABLE `tbbloqueioagenda`
  MODIFY `codBloqueio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbchamadosuporte`
--
ALTER TABLE `tbchamadosuporte`
  MODIFY `codChamado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbciclomenstrual`
--
ALTER TABLE `tbciclomenstrual`
  MODIFY `codCiclo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbconselho`
--
ALTER TABLE `tbconselho`
  MODIFY `codConselho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbconsulta`
--
ALTER TABLE `tbconsulta`
  MODIFY `codConsulta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbconteudo`
--
ALTER TABLE `tbconteudo`
  MODIFY `codConteudo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbconteudoadmin`
--
ALTER TABLE `tbconteudoadmin`
  MODIFY `codConteudoAdmin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdenuncia`
--
ALTER TABLE `tbdenuncia`
  MODIFY `codDenuncia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdenunciaacao`
--
ALTER TABLE `tbdenunciaacao`
  MODIFY `codDenunciaAcao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdiario`
--
ALTER TABLE `tbdiario`
  MODIFY `codDiario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbdisponibilidadeprofissional`
--
ALTER TABLE `tbdisponibilidadeprofissional`
  MODIFY `codDisponibilidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbevento`
--
ALTER TABLE `tbevento`
  MODIFY `codEvento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbexame`
--
ALTER TABLE `tbexame`
  MODIFY `codExame` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfeedback`
--
ALTER TABLE `tbfeedback`
  MODIFY `codFeedback` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbforumpublicacao`
--
ALTER TABLE `tbforumpublicacao`
  MODIFY `codForumPublicacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbforumresposta`
--
ALTER TABLE `tbforumresposta`
  MODIFY `codForumResposta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tblembreteremedio`
--
ALTER TABLE `tblembreteremedio`
  MODIFY `codLembreteRemedio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbmensagem`
--
ALTER TABLE `tbmensagem`
  MODIFY `codMensagem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbnotificacao`
--
ALTER TABLE `tbnotificacao`
  MODIFY `codNotificacao` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbpapel`
--
ALTER TABLE `tbpapel`
  MODIFY `codPapel` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbprofissionalsaude`
--
ALTER TABLE `tbprofissionalsaude`
  MODIFY `codProfissionalSaude` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  MODIFY `codPublicacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbservicounidade`
--
ALTER TABLE `tbservicounidade`
  MODIFY `codServico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbtipoatendimento`
--
ALTER TABLE `tbtipoatendimento`
  MODIFY `idTipoAtendimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbtipoconteudo`
--
ALTER TABLE `tbtipoconteudo`
  MODIFY `codTipoConteudo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbtipodiario`
--
ALTER TABLE `tbtipodiario`
  MODIFY `codTipoDiario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbtrilhaaprendizado`
--
ALTER TABLE `tbtrilhaaprendizado`
  MODIFY `codTrilha` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbunidadesaude`
--
ALTER TABLE `tbunidadesaude`
  MODIFY `codUnidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `codUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbvacina`
--
ALTER TABLE `tbvacina`
  MODIFY `codVacina` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD CONSTRAINT `tbadmin_ibfk_1` FOREIGN KEY (`codPapel`) REFERENCES `tbpapel` (`codPapel`);

--
-- Restrições para tabelas `tbavaliacaoconsulta`
--
ALTER TABLE `tbavaliacaoconsulta`
  ADD CONSTRAINT `tbavaliacaoconsulta_ibfk_1` FOREIGN KEY (`codConsulta`) REFERENCES `tbconsulta` (`codConsulta`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbavaliacaounidade`
--
ALTER TABLE `tbavaliacaounidade`
  ADD CONSTRAINT `tbavaliacaounidade_ibfk_1` FOREIGN KEY (`codUnidade`) REFERENCES `tbunidadesaude` (`codUnidade`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbavaliacaounidade_ibfk_2` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbbloqueioagenda`
--
ALTER TABLE `tbbloqueioagenda`
  ADD CONSTRAINT `tbbloqueioagenda_ibfk_1` FOREIGN KEY (`codProfissionalSaude`) REFERENCES `tbprofissionalsaude` (`codProfissionalSaude`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbchamadosuporte`
--
ALTER TABLE `tbchamadosuporte`
  ADD CONSTRAINT `tbchamadosuporte_ibfk_1` FOREIGN KEY (`codProfissionalSaude`) REFERENCES `tbprofissionalsaude` (`codProfissionalSaude`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbciclomenstrual`
--
ALTER TABLE `tbciclomenstrual`
  ADD CONSTRAINT `tbciclomenstrual_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbconselho`
--
ALTER TABLE `tbconselho`
  ADD CONSTRAINT `tbconselho_ibfk_1` FOREIGN KEY (`codProfissionalSaude`) REFERENCES `tbprofissionalsaude` (`codProfissionalSaude`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tbconsulta`
--
ALTER TABLE `tbconsulta`
  ADD CONSTRAINT `tbconsulta_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbconsulta_ibfk_2` FOREIGN KEY (`codProfissionalSaude`) REFERENCES `tbprofissionalsaude` (`codProfissionalSaude`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbconsulta_ibfk_3` FOREIGN KEY (`idTipoAtendimento`) REFERENCES `tbtipoatendimento` (`idTipoAtendimento`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `tbconteudo`
--
ALTER TABLE `tbconteudo`
  ADD CONSTRAINT `tbconteudo_ibfk_1` FOREIGN KEY (`codTipoCategoria`) REFERENCES `codtipocategoria` (`codTipoCategoria`),
  ADD CONSTRAINT `tbconteudo_ibfk_2` FOREIGN KEY (`codTipoConteudo`) REFERENCES `tbtipoconteudo` (`codTipoConteudo`),
  ADD CONSTRAINT `tbconteudo_ibfk_3` FOREIGN KEY (`codProfissionalSaude`) REFERENCES `tbprofissionalsaude` (`codProfissionalSaude`) ON DELETE SET NULL;

--
-- Restrições para tabelas `tbconteudoadmin`
--
ALTER TABLE `tbconteudoadmin`
  ADD CONSTRAINT `tbconteudoadmin_ibfk_1` FOREIGN KEY (`codConteudo`) REFERENCES `tbconteudo` (`codConteudo`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbconteudoadmin_ibfk_2` FOREIGN KEY (`codAdmin`) REFERENCES `tbadmin` (`codAdmin`);

--
-- Restrições para tabelas `tbconteudosalvo`
--
ALTER TABLE `tbconteudosalvo`
  ADD CONSTRAINT `tbconteudosalvo_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbconteudosalvo_ibfk_2` FOREIGN KEY (`codConteudo`) REFERENCES `tbconteudo` (`codConteudo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbdenuncia`
--
ALTER TABLE `tbdenuncia`
  ADD CONSTRAINT `tbdenuncia_ibfk_1` FOREIGN KEY (`codUsuarioDenunciante`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE SET NULL;

--
-- Restrições para tabelas `tbdenunciaacao`
--
ALTER TABLE `tbdenunciaacao`
  ADD CONSTRAINT `tbdenunciaacao_ibfk_1` FOREIGN KEY (`codDenuncia`) REFERENCES `tbdenuncia` (`codDenuncia`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbdenunciaacao_ibfk_2` FOREIGN KEY (`codAdmin`) REFERENCES `tbadmin` (`codAdmin`);

--
-- Restrições para tabelas `tbdiario`
--
ALTER TABLE `tbdiario`
  ADD CONSTRAINT `tbdiario_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbdiario_ibfk_2` FOREIGN KEY (`codTipoDiario`) REFERENCES `tbtipodiario` (`codTipoDiario`);

--
-- Restrições para tabelas `tbdisponibilidadeprofissional`
--
ALTER TABLE `tbdisponibilidadeprofissional`
  ADD CONSTRAINT `tbdisponibilidadeprofissional_ibfk_1` FOREIGN KEY (`codProfissionalSaude`) REFERENCES `tbprofissionalsaude` (`codProfissionalSaude`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbdisponibilidadeprofissional_ibfk_2` FOREIGN KEY (`idTipoAtendimento`) REFERENCES `tbtipoatendimento` (`idTipoAtendimento`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `tbevento`
--
ALTER TABLE `tbevento`
  ADD CONSTRAINT `tbevento_ibfk_1` FOREIGN KEY (`codProfissionalSaude`) REFERENCES `tbprofissionalsaude` (`codProfissionalSaude`) ON DELETE SET NULL;

--
-- Restrições para tabelas `tbexame`
--
ALTER TABLE `tbexame`
  ADD CONSTRAINT `tbexame_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbfeedback`
--
ALTER TABLE `tbfeedback`
  ADD CONSTRAINT `tbfeedback_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbfeedback_ibfk_2` FOREIGN KEY (`codProfissionalSaude`) REFERENCES `tbprofissionalsaude` (`codProfissionalSaude`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbforumpublicacao`
--
ALTER TABLE `tbforumpublicacao`
  ADD CONSTRAINT `tbforumpublicacao_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbforumpublicacao_ibfk_2` FOREIGN KEY (`codTipoCategoria`) REFERENCES `codtipocategoria` (`codTipoCategoria`) ON DELETE SET NULL;

--
-- Restrições para tabelas `tbforumreacao`
--
ALTER TABLE `tbforumreacao`
  ADD CONSTRAINT `tbforumreacao_ibfk_1` FOREIGN KEY (`codForumPublicacao`) REFERENCES `tbforumpublicacao` (`codForumPublicacao`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbforumreacao_ibfk_2` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbforumresposta`
--
ALTER TABLE `tbforumresposta`
  ADD CONSTRAINT `tbforumresposta_ibfk_1` FOREIGN KEY (`codForumPublicacao`) REFERENCES `tbforumpublicacao` (`codForumPublicacao`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbforumresposta_ibfk_2` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbforumresposta_ibfk_3` FOREIGN KEY (`codProfissionalSaude`) REFERENCES `tbprofissionalsaude` (`codProfissionalSaude`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbhumordiario`
--
ALTER TABLE `tbhumordiario`
  ADD CONSTRAINT `tbhumordiario_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbinscricaoevento`
--
ALTER TABLE `tbinscricaoevento`
  ADD CONSTRAINT `tbinscricaoevento_ibfk_1` FOREIGN KEY (`codEvento`) REFERENCES `tbevento` (`codEvento`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbinscricaoevento_ibfk_2` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbinteresseusuario`
--
ALTER TABLE `tbinteresseusuario`
  ADD CONSTRAINT `tbinteresseusuario_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbinteresseusuario_ibfk_2` FOREIGN KEY (`codTipoCategoria`) REFERENCES `codtipocategoria` (`codTipoCategoria`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tblembreteremedio`
--
ALTER TABLE `tblembreteremedio`
  ADD CONSTRAINT `tblembreteremedio_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbmensagem`
--
ALTER TABLE `tbmensagem`
  ADD CONSTRAINT `tbmensagem_ibfk_1` FOREIGN KEY (`codConsulta`) REFERENCES `tbconsulta` (`codConsulta`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbprogressotrilha`
--
ALTER TABLE `tbprogressotrilha`
  ADD CONSTRAINT `tbprogressotrilha_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbprogressotrilha_ibfk_2` FOREIGN KEY (`codTrilha`) REFERENCES `tbtrilhaaprendizado` (`codTrilha`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbprogressotrilha_ibfk_3` FOREIGN KEY (`codConteudo`) REFERENCES `tbconteudo` (`codConteudo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbpublicacao`
--
ALTER TABLE `tbpublicacao`
  ADD CONSTRAINT `tbpublicacao_ibfk_1` FOREIGN KEY (`codConteudo`) REFERENCES `tbconteudo` (`codConteudo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbsintomaciclo`
--
ALTER TABLE `tbsintomaciclo`
  ADD CONSTRAINT `tbsintomaciclo_ibfk_1` FOREIGN KEY (`codCiclo`) REFERENCES `tbciclomenstrual` (`codCiclo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbtrilhaaprendizado`
--
ALTER TABLE `tbtrilhaaprendizado`
  ADD CONSTRAINT `tbtrilhaaprendizado_ibfk_1` FOREIGN KEY (`codTipoCategoria`) REFERENCES `codtipocategoria` (`codTipoCategoria`) ON DELETE SET NULL;

--
-- Restrições para tabelas `tbtrilhaconteudo`
--
ALTER TABLE `tbtrilhaconteudo`
  ADD CONSTRAINT `tbtrilhaconteudo_ibfk_1` FOREIGN KEY (`codTrilha`) REFERENCES `tbtrilhaaprendizado` (`codTrilha`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbtrilhaconteudo_ibfk_2` FOREIGN KEY (`codConteudo`) REFERENCES `tbconteudo` (`codConteudo`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbunidadeservico`
--
ALTER TABLE `tbunidadeservico`
  ADD CONSTRAINT `tbunidadeservico_ibfk_1` FOREIGN KEY (`codUnidade`) REFERENCES `tbunidadesaude` (`codUnidade`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbunidadeservico_ibfk_2` FOREIGN KEY (`codServico`) REFERENCES `tbservicounidade` (`codServico`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbvacina`
--
ALTER TABLE `tbvacina`
  ADD CONSTRAINT `tbvacina_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tbusuario` (`codUsuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
