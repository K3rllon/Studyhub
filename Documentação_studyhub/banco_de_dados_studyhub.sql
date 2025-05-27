CREATE DATABASE studyhub;
USE studyhub;

CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(140) NOT NULL,
  `senha` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `aluno` (`id`, `email`, `senha`) VALUES
(1, 'francisco.silva9654@aluno.ce.gov.br', '12345678');

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
);

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id_categoria`)
);

CREATE TABLE IF NOT EXISTS `pastas` (
  `id_pastas` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `serie_ou_ano` int NOT NULL,
  `id_categoria` int NOT NULL,
  PRIMARY KEY (`id_pastas`),
  KEY `id_categoria` (`id_categoria`)
); 

ALTER TABLE `arquivos`
  ADD CONSTRAINT `arquivos_ibfk_1` FOREIGN KEY (`id_pastas`) REFERENCES `pastas` (`id_pastas`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `arquivos_ibfk_2` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `pastas`
  ADD CONSTRAINT `pastas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;