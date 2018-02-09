-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Fev-2018 às 18:15
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boletim`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso`
--

CREATE TABLE `acesso` (
  `id` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modulo_id` int(11) DEFAULT NULL,
  `criar` tinyint(1) DEFAULT NULL,
  `visualizar` tinyint(1) DEFAULT NULL,
  `atualizar` tinyint(1) DEFAULT NULL,
  `apagar` tinyint(1) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `acesso`
--

INSERT INTO `acesso` (`id`, `data_registro`, `modulo_id`, `criar`, `visualizar`, `atualizar`, `apagar`, `grupo_id`) VALUES
(1, '2017-12-28 22:40:48', 3, 1, 1, 1, 1, 1),
(2, '2017-12-28 22:44:07', 1, 1, 1, 1, 1, 1),
(3, '2017-12-28 22:44:07', 2, 1, 1, 1, 1, 1),
(4, '2017-12-28 22:44:07', 4, 1, 1, 1, 1, 1),
(5, '2017-12-29 05:58:10', 5, 1, 1, 1, 1, 1),
(6, '2017-12-29 06:17:22', 1, 0, 0, 0, 0, 2),
(7, '2017-12-29 06:17:23', 2, 0, 0, 0, 0, 2),
(8, '2017-12-29 06:17:23', 3, 0, 0, 0, 0, 2),
(9, '2017-12-29 06:17:23', 4, 0, 0, 0, 0, 2),
(10, '2017-12-29 06:17:23', 5, 1, 1, 1, 1, 2),
(11, '2017-12-29 20:12:49', 6, 1, 1, 1, 1, 1),
(12, '2017-12-29 21:26:26', 7, 1, 1, 1, 1, 1),
(13, '2017-12-30 01:17:07', 8, 1, 1, 1, 1, 1),
(14, '2018-01-18 19:04:31', 1, 0, 0, 0, 0, 3),
(15, '2018-01-18 19:04:31', 2, 0, 0, 0, 0, 3),
(16, '2018-01-18 19:04:31', 3, 0, 0, 0, 0, 3),
(17, '2018-01-18 19:04:31', 4, 1, 1, 1, 1, 3),
(18, '2018-01-18 19:04:32', 5, 0, 0, 0, 0, 3),
(19, '2018-01-18 19:04:32', 6, 0, 0, 0, 0, 3),
(20, '2018-01-18 19:04:32', 7, 0, 0, 0, 0, 3),
(21, '2018-01-18 19:04:32', 8, 0, 0, 0, 0, 3),
(22, '2018-01-18 19:29:06', 9, 1, 1, 1, 1, 1),
(23, '2018-01-23 21:21:22', 1, 0, 0, 0, 0, 4),
(24, '2018-01-23 21:21:22', 2, 0, 0, 0, 0, 4),
(25, '2018-01-23 21:21:22', 3, 0, 1, 0, 0, 4),
(26, '2018-01-23 21:21:22', 4, 0, 0, 1, 0, 4),
(27, '2018-01-23 21:21:22', 5, 0, 0, 0, 0, 4),
(28, '2018-01-23 21:21:23', 6, 0, 0, 0, 0, 4),
(29, '2018-01-23 21:21:23', 7, 0, 0, 0, 0, 4),
(30, '2018-01-23 21:21:23', 8, 0, 0, 0, 0, 4),
(31, '2018-01-23 21:21:23', 9, 0, 0, 0, 0, 4),
(32, '2018-02-06 16:09:29', 10, 1, 1, 1, 1, 1),
(33, '2018-02-08 15:55:36', 11, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `matricula` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `numero_chamada` int(11) DEFAULT NULL,
  `turma_id` int(11) DEFAULT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id`, `ativo`, `data_registro`, `matricula`, `nome`, `sexo`, `data_nascimento`, `numero_chamada`, `turma_id`, `curso_id`) VALUES
(6, 1, '2017-12-18 11:57:04', 13567, 'Tadeu', '1', '2017-12-17', 1, 19, 1),
(7, 1, '2017-12-18 11:57:25', 111123, 'Bruno', '1', '2017-12-29', 2, 17, 1),
(8, 1, '2017-12-18 14:05:33', 1, 'yyy', '1', '2017-12-27', 2, 17, 1),
(9, 1, '2017-12-18 18:27:22', 445, 'uu', '1', '2017-12-30', 555, 22, 21),
(10, 1, '2017-12-29 22:16:40', 123123, '1231', '1', '2017-12-27', 112312312, NULL, 34),
(11, 1, '2018-01-24 04:19:41', 123, 'lol', '1', '2018-01-25', 123, NULL, 1),
(12, 1, '2018-02-06 04:23:35', 123, 'lolzin', '1', '2018-02-16', 3, NULL, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `boletim`
--

CREATE TABLE `boletim` (
  `id` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nota1` double DEFAULT NULL,
  `falta1` int(11) DEFAULT NULL,
  `nota2` double DEFAULT NULL,
  `falta2` int(11) DEFAULT NULL,
  `nota3` double DEFAULT NULL,
  `falta3` int(11) DEFAULT NULL,
  `nota4` double DEFAULT NULL,
  `falta4` int(11) DEFAULT NULL,
  `bimestre` int(11) DEFAULT NULL,
  `aluno_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  `nota_final` double DEFAULT NULL,
  `status` varchar(11) NOT NULL,
  `exame` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `boletim`
--

INSERT INTO `boletim` (`id`, `ativo`, `data_registro`, `nota1`, `falta1`, `nota2`, `falta2`, `nota3`, `falta3`, `nota4`, `falta4`, `bimestre`, `aluno_id`, `disciplina_id`, `turma_id`, `nota_final`, `status`, `exame`) VALUES
(39, 1, '2018-02-07 21:07:24', 20, 2, 20, 5, 10, 2, 12, 10, 1, 9, 9, 22, 50, 'Aprovado', 60),
(40, 1, '2018-02-07 21:07:46', 20, 51, 25, 50, 25, 50, 1, 50, 1, 12, 9, 22, 71, 'Reprovado', 55);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Matérias Técnicas'),
(2, 'Matérias do ensino médio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes_geral`
--

CREATE TABLE `configuracoes_geral` (
  `id` int(11) NOT NULL,
  `media` double NOT NULL,
  `total_faltas` int(11) NOT NULL,
  `primeiro_bimestre` int(11) NOT NULL,
  `segundo_bimestre` int(11) NOT NULL,
  `terceiro_bimestre` int(11) NOT NULL,
  `quarto_bimestre` int(11) NOT NULL,
  `itens_por_pagina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `configuracoes_geral`
--

INSERT INTO `configuracoes_geral` (`id`, `media`, `total_faltas`, `primeiro_bimestre`, `segundo_bimestre`, `terceiro_bimestre`, `quarto_bimestre`, `itens_por_pagina`) VALUES
(1, 60, 200, 20, 25, 25, 30, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `ativo`, `data_registro`, `nome`) VALUES
(1, 1, '2017-12-17 02:19:09', 'Eletrônica'),
(2, 1, '2017-12-17 02:19:09', 'Informática'),
(21, 1, '2017-12-18 01:58:06', 'Logística'),
(26, 0, '2017-12-18 10:46:55', 'iii'),
(27, 0, '2017-12-18 11:31:22', 'sdfsd'),
(28, 0, '2017-12-18 11:31:43', 'dfgfd'),
(29, 0, '2017-12-18 11:32:19', 'ggg'),
(30, 0, '2017-12-18 11:32:34', 'dfgd'),
(31, 1, '2017-12-20 06:41:10', 'io'),
(32, 1, '2017-12-29 20:32:37', 'vvv'),
(33, 1, '2017-12-29 21:00:16', 'ooooodoggg'),
(34, 1, '2017-12-29 21:05:57', 'ddd'),
(35, 1, '2018-01-23 20:55:01', 'gggggggg'),
(36, 1, '2018-02-08 14:44:32', 'xcvcxxcvxcvxc'),
(37, 1, '2018-02-08 14:45:39', 'dfgdgdfgdfgd'),
(38, 1, '2018-02-08 14:47:30', 'dfgdgdfgdfgdf'),
(39, 1, '2018-02-08 14:49:45', 'dfgdgdfgdfgd'),
(40, 1, '2018-02-08 14:50:05', 'dfgdgdfgdfgd'),
(41, 1, '2018-02-08 14:50:39', 'dfgdgdfgdfgd'),
(42, 1, '2018-02-08 14:50:59', 'dfgdgdfgdfgd'),
(43, 1, '2018-02-08 14:51:01', 'dfgdgdfgdfgd'),
(44, 1, '2018-02-08 14:52:28', 'dfgdgdfgdfgd'),
(45, 1, '2018-02-08 14:52:49', 'dfgdgdfgdfgd'),
(46, 1, '2018-02-08 14:53:19', 'sdfssfsdfsf'),
(47, 1, '2018-02-08 14:53:26', 'sdfssfsdfsf'),
(48, 1, '2018-02-08 15:00:14', 'sdfssfsdfsf'),
(49, 1, '2018-02-08 15:13:16', 'sdfssfsdfsf'),
(50, 1, '2018-02-08 15:15:13', 'sdfssfsdfsf'),
(51, 1, '2018-02-08 15:15:39', 'sdfssfsdfsf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id`, `nome`, `ativo`, `data_registro`, `categoria_id`) VALUES
(1, 'Eletrônica', 1, '2017-12-17 02:02:57', 2),
(2, 'Eletrônica Analógica', 1, '2017-12-17 02:03:15', 1),
(5, 'Matemática', 0, '2017-12-17 02:31:02', 2),
(6, 'Desenhp Técnico', 0, '2017-12-17 02:31:02', 1),
(7, 'História', 1, '2017-12-18 01:12:33', 2),
(8, 'yyyy', 1, '2017-12-18 10:09:21', 1),
(9, '8888888', 1, '2017-12-18 10:36:33', 1),
(10, 'lll', 0, '2017-12-18 10:40:13', 1),
(11, 'yyy', 1, '2017-12-20 06:40:56', 1),
(13, 'bbb', 1, '2017-12-29 19:41:32', 1),
(16, 'bbb', 1, '2017-12-29 19:43:57', 2),
(17, 'bbb', 1, '2017-12-29 19:44:22', 1),
(18, 'dfgdfgdfgdfg', 1, '2017-12-29 19:44:41', 2),
(19, 'sdf', 1, '2018-02-08 14:21:14', 1),
(21, 'dfg', 1, '2018-02-08 14:24:36', 1),
(22, 'sdfs', 1, '2018-02-08 14:25:29', 1),
(23, 'dfgfd', 1, '2018-02-08 14:25:58', 1),
(24, 'xcvx', 1, '2018-02-08 14:27:10', 1),
(25, 'sfsd', 1, '2018-02-08 14:33:39', 2),
(26, 'dgddfggd', 1, '2018-02-08 14:34:47', 1),
(27, 'sdfsd', 1, '2018-02-08 14:38:06', 1),
(28, 'ffffff', 1, '2018-02-08 14:40:33', 1),
(29, 'gghfhghfghh', 1, '2018-02-08 14:40:52', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_curso`
--

CREATE TABLE `disciplina_curso` (
  `disciplina_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina_curso`
--

INSERT INTO `disciplina_curso` (`disciplina_id`, `curso_id`) VALUES
(2, 31),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(7, 1),
(7, 31),
(7, 36),
(7, 38),
(8, 1),
(8, 21),
(9, 1),
(9, 21),
(9, 46),
(11, 31),
(11, 47),
(16, 34),
(16, 35),
(17, 32),
(17, 33),
(17, 34),
(21, 48),
(25, 37),
(27, 49),
(28, 36),
(28, 37),
(28, 50),
(28, 51);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id`, `data_registro`, `ativo`, `nome`) VALUES
(1, '2017-12-28 22:40:46', 1, 'Administrador'),
(2, '2017-12-29 06:17:22', 1, 'Professor'),
(3, '2018-01-18 19:04:31', 1, 'Coordenador'),
(4, '2018-01-23 21:21:22', 1, 'ddddJd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `menu`
--

INSERT INTO `menu` (`id`, `data_registro`, `ativo`, `nome`, `ordem`) VALUES
(1, '2017-12-28 22:40:47', 1, 'Gestão', 1),
(2, '2018-01-18 21:22:24', 1, 'Acadêmico', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulo`
--

CREATE TABLE `modulo` (
  `id` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) DEFAULT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `url` varchar(20) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modulo`
--

INSERT INTO `modulo` (`id`, `data_registro`, `ativo`, `nome`, `descricao`, `url`, `ordem`, `icone`, `menu_id`) VALUES
(1, '2017-12-28 22:40:47', 1, 'Módulos', 'Lista de módulos', 'Modulo', 1, 'fa fa-list-alt', 1),
(2, '2017-12-28 22:40:47', 1, 'Menus', 'Lista de menus', 'Menu', 1, 'fa fa-navicon', 1),
(3, '2017-12-28 22:40:47', 1, 'Grupos', 'Lista de grupos', 'Grupo', 1, 'fa fa-th-large', 1),
(4, '2017-12-28 22:40:48', 1, 'Usuários', 'Lista de usuários', 'Usuario', 1, 'glyphicon glyphicon-user', 1),
(5, '2017-12-29 05:55:14', 1, 'Disciplina', 'Disciplinas', 'Disciplina', 1, ' glyphicon glyphicon-paperclip', 2),
(6, '2017-12-29 20:09:51', 1, 'Curso', 'Curso', 'Curso', 2, 'glyphicon glyphicon-folder-open', 2),
(7, '2017-12-29 21:25:48', 1, 'Aluno', 'Alunos', 'Aluno', 3, 'glyphicon glyphicon-user', 2),
(8, '2017-12-30 01:15:48', 1, 'Turma', 'Turma', 'Turma', 4, 'glyphicon glyphicon-book', 2),
(9, '2018-01-18 19:28:13', 1, 'Notas', 'Notas', 'Nota', 5, 'glyphicon glyphicon-file', 2),
(10, '2018-02-06 16:08:54', 1, 'Boletim', 'Boletim', 'boletim', 6, 'glyphicon glyphicon-list-alt', 2),
(11, '2018-02-08 15:53:33', 0, 'Conselho  de classe', 'Conselho de classe', 'Conselho', 7, 'glyphicon glyphicon-folder-close', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `teste`
--

CREATE TABLE `teste` (
  `id` int(11) NOT NULL,
  `campo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `teste`
--

INSERT INTO `teste` (`id`, `campo`) VALUES
(1, '13'),
(2, '13'),
(3, '0'),
(4, '16'),
(5, '0'),
(6, '0'),
(7, '0'),
(8, '18'),
(9, '18'),
(10, '0'),
(11, '0'),
(12, '0'),
(13, '19'),
(14, '0'),
(15, '0'),
(16, '0'),
(17, '0'),
(18, '23'),
(19, '23'),
(20, '23'),
(21, '23'),
(22, '23'),
(23, '23'),
(24, '23'),
(25, '23'),
(26, '23'),
(27, '23'),
(28, '23'),
(29, '23'),
(30, '22'),
(31, '23'),
(32, '23'),
(33, '0'),
(34, '22'),
(35, '24'),
(36, '0'),
(37, '25'),
(38, '25'),
(39, '25'),
(40, '25'),
(41, '25'),
(42, '25'),
(43, '25'),
(44, 'sdfssfsdfsf'),
(45, 'sdfssfsdfsf'),
(46, ''),
(47, 'ff');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` varchar(100) DEFAULT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id`, `ativo`, `data_registro`, `nome`, `curso_id`) VALUES
(17, 1, '2017-12-18 11:57:52', 'xx', 1),
(18, 1, '2017-12-18 12:02:01', 'xx2', 1),
(19, 1, '2018-01-24 17:17:55', 'uuu', 1),
(20, 1, '2017-12-18 18:27:43', 'ii', 21),
(21, 1, '2017-12-18 18:28:23', 'iii', 21),
(22, 1, '2017-12-20 06:42:17', 'OOO2', 21),
(23, 1, '2017-12-28 01:02:36', 'ateste', 1),
(24, 1, '2017-12-31 06:52:08', 'Administrador', 34),
(25, 1, '2017-12-31 06:52:24', 'hhhhh', 33),
(26, 1, '2018-01-18 22:27:39', 'NOVO ANO', 21),
(27, 1, '2018-01-24 18:07:26', 'uuu', 1),
(28, 1, '2018-01-24 18:08:15', 'ateste', 1),
(29, 1, '2018-02-06 04:23:52', 'OOO2', 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_aluno`
--

CREATE TABLE `turma_aluno` (
  `turma_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma_aluno`
--

INSERT INTO `turma_aluno` (`turma_id`, `aluno_id`, `data_registro`) VALUES
(17, 6, '2017-12-18 17:57:01'),
(17, 7, '2017-12-18 17:57:01'),
(17, 8, '2017-12-18 17:57:01'),
(19, 6, '2018-01-23 23:15:27'),
(22, 9, '2017-12-20 06:42:43'),
(22, 12, '2018-02-06 04:26:48'),
(23, 8, '2018-01-23 23:24:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_disciplina`
--

CREATE TABLE `turma_disciplina` (
  `turma_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma_disciplina`
--

INSERT INTO `turma_disciplina` (`turma_id`, `disciplina_id`) VALUES
(17, 7),
(17, 8),
(17, 9),
(18, 9),
(19, 7),
(19, 8),
(19, 9),
(21, 8),
(22, 9),
(23, 7),
(23, 8),
(23, 9),
(26, 8),
(26, 9),
(29, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultimo_acesso` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `grupo_id` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `nome` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `data_registro`, `ultimo_acesso`, `grupo_id`, `ativo`, `nome`, `email`, `senha`) VALUES
(1, '2017-12-28 22:40:46', '2018-02-08 14:34:20', 1, 1, 'Admin3', 'admin@dominio.com.br', 'admin123'),
(2, '2018-01-18 19:02:38', '0000-00-00 00:00:00', 2, 1, 'nomed2', 'example@example.com', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acesso`
--
ALTER TABLE `acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_modulo_acesso` (`modulo_id`),
  ADD KEY `fk_grupo_acesso` (`grupo_id`);

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_turmaAluno` (`turma_id`),
  ADD KEY `fk_CursoAluno` (`curso_id`);

--
-- Indexes for table `boletim`
--
ALTER TABLE `boletim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_AlunoBoletim` (`aluno_id`),
  ADD KEY `fk_DisciplinaBoletim` (`disciplina_id`),
  ADD KEY `turma_id` (`turma_id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuracoes_geral`
--
ALTER TABLE `configuracoes_geral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Categoria` (`categoria_id`);

--
-- Indexes for table `disciplina_curso`
--
ALTER TABLE `disciplina_curso`
  ADD PRIMARY KEY (`disciplina_id`,`curso_id`),
  ADD KEY `fk_Curso_Disciplina_Curso` (`curso_id`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_modulo` (`menu_id`);

--
-- Indexes for table `teste`
--
ALTER TABLE `teste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Curso` (`curso_id`);

--
-- Indexes for table `turma_aluno`
--
ALTER TABLE `turma_aluno`
  ADD PRIMARY KEY (`turma_id`,`aluno_id`),
  ADD KEY `fk_aluno_turma_aluno` (`aluno_id`);

--
-- Indexes for table `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  ADD PRIMARY KEY (`turma_id`,`disciplina_id`),
  ADD KEY `fk_Disciplina` (`disciplina_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grupo_usuario` (`grupo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acesso`
--
ALTER TABLE `acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `boletim`
--
ALTER TABLE `boletim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `configuracoes_geral`
--
ALTER TABLE `configuracoes_geral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teste`
--
ALTER TABLE `teste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `acesso`
--
ALTER TABLE `acesso`
  ADD CONSTRAINT `fk_grupo_acesso` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`),
  ADD CONSTRAINT `fk_modulo_acesso` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`);

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_CursoAluno` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  ADD CONSTRAINT `fk_turmaAluno` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`);

--
-- Limitadores para a tabela `boletim`
--
ALTER TABLE `boletim`
  ADD CONSTRAINT `boletim_ibfk_1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`),
  ADD CONSTRAINT `fk_AlunoBoletim` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `fk_DisciplinaBoletim` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`);

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_Categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);

--
-- Limitadores para a tabela `disciplina_curso`
--
ALTER TABLE `disciplina_curso`
  ADD CONSTRAINT `fk_Curso_Disciplina_Curso` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  ADD CONSTRAINT `fk_Disciplina_Curso` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`);

--
-- Limitadores para a tabela `modulo`
--
ALTER TABLE `modulo`
  ADD CONSTRAINT `fk_menu_modulo` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_Curso` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`);

--
-- Limitadores para a tabela `turma_aluno`
--
ALTER TABLE `turma_aluno`
  ADD CONSTRAINT `fk_aluno_turma_aluno` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`),
  ADD CONSTRAINT `fk_turma_turma_aluno` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`);

--
-- Limitadores para a tabela `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  ADD CONSTRAINT `fk_Disciplina` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`),
  ADD CONSTRAINT `fk_turma` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_grupo_usuario` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
