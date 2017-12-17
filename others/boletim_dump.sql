-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Dez-2017 às 23:23
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
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `Id` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `DataRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Matricula` int(11) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `DataNascimento` date DEFAULT NULL,
  `NumeroChamada` int(11) DEFAULT NULL,
  `TurmaId` int(11) DEFAULT NULL,
  `CursoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`Id`, `ativo`, `DataRegistro`, `Matricula`, `Nome`, `Sexo`, `DataNascimento`, `NumeroChamada`, `TurmaId`, `CursoId`) VALUES
(1, 1, '2017-12-17 21:50:40', 1, 'teste', '1', '2017-12-15', 1, NULL, 1),
(2, 1, '2017-12-17 21:51:24', 1123123, 'NomeAluno', '1', '2017-12-17', 44444, NULL, 1),
(3, 1, '2017-12-17 21:51:46', 12, 'NomeAluno', '0', '2017-12-17', 22, NULL, 1),
(4, 1, '2017-12-17 22:22:30', 22, 'NomeAluno', '0', '2017-12-17', 11, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `boletim`
--

CREATE TABLE `boletim` (
  `Id` int(11) NOT NULL,
  `Nota` float DEFAULT NULL,
  `Falta` int(11) DEFAULT NULL,
  `Bimestre` int(11) DEFAULT NULL,
  `AlunoId` int(11) NOT NULL,
  `DisciplinaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`Id`, `Nome`) VALUES
(1, 'Matérias técnicas'),
(2, 'Matérias do ensino médio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `Id` int(11) NOT NULL,
  `Ativo` tinyint(1) NOT NULL,
  `DataRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`Id`, `Ativo`, `DataRegistro`, `Nome`) VALUES
(1, 1, '2017-12-17 02:19:09', 'Eletrônica'),
(2, 1, '2017-12-17 02:19:09', 'Informática');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Ativo` tinyint(1) DEFAULT NULL,
  `DataRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CategoriaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`Id`, `Nome`, `Ativo`, `DataRegistro`, `CategoriaId`) VALUES
(1, 'Eletrônica', 1, '2017-12-17 02:02:57', 2),
(2, 'Eletrônica Analógica', 1, '2017-12-17 02:03:15', 1),
(5, 'Matemática', 0, '2017-12-17 02:31:02', 2),
(6, 'Desenhp Técnico', 0, '2017-12-17 02:31:02', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_curso`
--

CREATE TABLE `disciplina_curso` (
  `DisciplinaId` int(11) NOT NULL,
  `CursoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina_curso`
--

INSERT INTO `disciplina_curso` (`DisciplinaId`, `CursoId`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `CursoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_disciplina`
--

CREATE TABLE `turma_disciplina` (
  `Id` int(11) NOT NULL,
  `TurmaId` int(11) NOT NULL,
  `DisciplinaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'teste', 'teste@teste.com', 'b123e9e19d217169b981a61188920f9d28638709a5132201684d792b9264271b7f09157ed4321b1c097f7a4abecfc0977d40a7ee599c845883bd1074ca23c4af');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_turmaAluno` (`TurmaId`),
  ADD KEY `fk_CursoAluno` (`CursoId`);

--
-- Indexes for table `boletim`
--
ALTER TABLE `boletim`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_AlunoBoletim` (`AlunoId`),
  ADD KEY `fk_DisciplinaBoletim` (`DisciplinaId`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_Categoria` (`CategoriaId`);

--
-- Indexes for table `disciplina_curso`
--
ALTER TABLE `disciplina_curso`
  ADD PRIMARY KEY (`DisciplinaId`,`CursoId`),
  ADD KEY `fk_Curso_Disciplina_Curso` (`CursoId`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_Curso` (`CursoId`);

--
-- Indexes for table `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_turma` (`TurmaId`),
  ADD KEY `fk_Disciplina` (`DisciplinaId`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `boletim`
--
ALTER TABLE `boletim`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_CursoAluno` FOREIGN KEY (`CursoId`) REFERENCES `curso` (`Id`),
  ADD CONSTRAINT `fk_turmaAluno` FOREIGN KEY (`TurmaId`) REFERENCES `turma` (`Id`);

--
-- Limitadores para a tabela `boletim`
--
ALTER TABLE `boletim`
  ADD CONSTRAINT `fk_AlunoBoletim` FOREIGN KEY (`AlunoId`) REFERENCES `aluno` (`Id`),
  ADD CONSTRAINT `fk_DisciplinaBoletim` FOREIGN KEY (`DisciplinaId`) REFERENCES `disciplina` (`Id`);

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_Categoria` FOREIGN KEY (`CategoriaId`) REFERENCES `categoria` (`Id`);

--
-- Limitadores para a tabela `disciplina_curso`
--
ALTER TABLE `disciplina_curso`
  ADD CONSTRAINT `fk_Curso_Disciplina_Curso` FOREIGN KEY (`CursoId`) REFERENCES `curso` (`Id`),
  ADD CONSTRAINT `fk_Disciplina_Curso` FOREIGN KEY (`DisciplinaId`) REFERENCES `disciplina` (`Id`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_Curso` FOREIGN KEY (`CursoId`) REFERENCES `curso` (`Id`);

--
-- Limitadores para a tabela `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  ADD CONSTRAINT `fk_Disciplina` FOREIGN KEY (`DisciplinaId`) REFERENCES `disciplina` (`Id`),
  ADD CONSTRAINT `fk_turma` FOREIGN KEY (`TurmaId`) REFERENCES `turma` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
