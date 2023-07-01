-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01-Jul-2023 às 18:38
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessonegado`
--

DROP TABLE IF EXISTS `acessonegado`;
CREATE TABLE IF NOT EXISTS `acessonegado` (
  `tag` varchar(200) NOT NULL,
  `nome_local` varchar(200) NOT NULL,
  `id_local` int(50) NOT NULL,
  `datatime` datetime NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario` (`id_usuario`),
  KEY `fk_local` (`id_local`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

DROP TABLE IF EXISTS `acessos`;
CREATE TABLE IF NOT EXISTS `acessos` (
  `nome` varchar(200) NOT NULL,
  `cpf` varchar(200) NOT NULL,
  `tag` varchar(200) NOT NULL,
  `nome_local` varchar(200) NOT NULL,
  `id_local` int(50) NOT NULL,
  `datatime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario2` (`id_usuario`),
  KEY `fk_local3` (`id_local`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

DROP TABLE IF EXISTS `agendamento`;
CREATE TABLE IF NOT EXISTS `agendamento` (
  `nome` varchar(200) NOT NULL,
  `tag` varchar(200) NOT NULL,
  `cpf` varchar(200) NOT NULL,
  `nome_local` varchar(200) NOT NULL,
  `id_local` int(50) NOT NULL,
  `data` date NOT NULL,
  `dia` varchar(200) NOT NULL,
  `hora_inicial` time NOT NULL,
  `hora_Final` time NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario4` (`id_usuario`),
  KEY `fk_local5` (`id_local`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ambiente`
--

DROP TABLE IF EXISTS `ambiente`;
CREATE TABLE IF NOT EXISTS `ambiente` (
  `id_local` int(11) NOT NULL,
  `nome_local` varchar(200) NOT NULL,
  PRIMARY KEY (`id_local`),
  UNIQUE KEY `nome_local` (`nome_local`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ambiente`
--

INSERT INTO `ambiente` (`id_local`, `nome_local`) VALUES
(28655, 'laboratorio_2x'),
(3410, 'laboratorio_3xx'),
(13049, 'laboratorio_4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

DROP TABLE IF EXISTS `arquivos`;
CREATE TABLE IF NOT EXISTS `arquivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `path` varchar(200) NOT NULL,
  `data_upload` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_usuario5` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `arquivos`
--

INSERT INTO `arquivos` (`id`, `id_usuario`, `nome`, `path`, `data_upload`) VALUES
(9, 15, 'A importancia do ato de ler.pdf', 'arquivos/6343066176986.pdf', '2022-10-09 14:35:29'),
(14, 20, 'Edital 16 de 2023 - Retificado.pdf', 'arquivos/6464bd60463c9.pdf', '2023-05-17 08:41:20'),
(15, 21, '6464bd60463c9.pdf', 'arquivos/64675f1ab77f9.pdf', '2023-05-19 08:35:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `cpf` varchar(200) NOT NULL,
  `sexo` varchar(200) NOT NULL,
  `tag` varchar(200) NOT NULL,
  `nome_local` varchar(200) NOT NULL,
  `id_local` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario3` (`id_usuario`),
  KEY `fk_local4` (`id_local`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `nome` varchar(200) NOT NULL,
  `cpf` varchar(200) NOT NULL,
  `rg` varchar(200) NOT NULL,
  `sexo` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `tag` varchar(200) NOT NULL,
  `nivel` int(11) NOT NULL,
  `telefone` varchar(200) NOT NULL,
  `id` int(100) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `rg` (`rg`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`nome`, `cpf`, `rg`, `sexo`, `email`, `tag`, `nivel`, `telefone`, `id`) VALUES
('Natalia Ferreira de Alcantara', '965.652.541-01', '7894561236621', 'Feminino', 'NataliaFerreira@gmail.com', '1B1840U', 2, '63984276325', 15),
('CRISTIANE SOUZA LIMA', '857.676.767-67', '46464646464', 'Masculino', 'alexsandroekassandra@outlook.com', '2222', 1, '63992915398', 20),
('Ralison Luiz Alves de  Oliveira', '456.564.565-65', '8989899', 'Masculino', 'ralison.rl19@gmail.com', '1111', 1, '63985178500', 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_externo`
--

DROP TABLE IF EXISTS `usuario_externo`;
CREATE TABLE IF NOT EXISTS `usuario_externo` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `nivel` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario_externo`
--

INSERT INTO `usuario_externo` (`id_usuario`, `nome`, `email`, `senha`, `nivel`, `status`) VALUES
(23, 's', 's@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '2', 'ativo'),
(25, 'maroa', 'maroa@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '2', 'ativo'),
(27, 'w', 'w@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '1', 'ativo'),
(28, 'ralison Luiz Alves de oliveira', 'ralison.rl19@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '1', 'ativo');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `fk_local5` FOREIGN KEY (`id_local`) REFERENCES `ambiente` (`id_local`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario4` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD CONSTRAINT `fk_usuario5` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `fk_local4` FOREIGN KEY (`id_local`) REFERENCES `ambiente` (`id_local`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
