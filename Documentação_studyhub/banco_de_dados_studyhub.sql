-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25/05/2025 às 23:02
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `studyhub`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(140) NOT NULL,
  `senha` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id`, `email`, `senha`) VALUES
(1, 'francisco.silva9654@aluno.ce.gov.br', '12345678');

-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos`
--

DROP TABLE IF EXISTS `arquivos`;
CREATE TABLE IF NOT EXISTS `arquivos` (
  `id_arquivos` int NOT NULL,
  `nome` varchar(45) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `formato` varchar(20) NOT NULL,
  `id_categorias` int NOT NULL,
  `id_pastas` int NOT NULL,
  PRIMARY KEY (`id_arquivos`),
  KEY `id_pastas` (`id_pastas`),
  KEY `id_categorias` (`id_categorias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pastas`
--

DROP TABLE IF EXISTS `pastas`;
CREATE TABLE IF NOT EXISTS `pastas` (
  `id_pastas` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `serie_ou_ano` int NOT NULL,
  `id_categoria` int NOT NULL,
  PRIMARY KEY (`id_pastas`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `arquivos`
--
ALTER TABLE `arquivos`
  ADD CONSTRAINT `arquivos_ibfk_1` FOREIGN KEY (`id_pastas`) REFERENCES `pastas` (`id_pastas`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `arquivos_ibfk_2` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `pastas`
--
ALTER TABLE `pastas`
  ADD CONSTRAINT `pastas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
