-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Set-2022 às 15:47
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lupaempresa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `senha` varchar(130) DEFAULT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `email`, `data`) VALUES
(16, 'Messi', '736.447.500-17', 'ervin93@example.com', '1999-12-14'),
(17, 'Pele camisa 10', '736.447.500-17', 'pelecamisa10@hotmail.com', '1959-02-14'),
(18, 'Rafildis', '736.447.500-17', 'rafildis.monoasol@hotmail.com', '1998-02-14'),
(19, 'Neymar', '736.447.500-17', 'neymar.barcelona@hotmail.com', '2000-02-14'),
(20, 'Ronaldo', '736.447.500-17', 'ronaldo.angelim@hotmail.com', '2000-02-01'),
(22, 'Denis', '736.447.500-17', 'denis.denis@hotmail.com', '2006-06-14'),
(26, 'Marqueta', '736.447.500-17', 'marco.marco@hotmail.com', '2000-02-17'),
(27, 'Ronaldinho', '736.447.500-17', 'ronaldinho@hotmail.com', '2000-02-14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes_has_corretores`
--

DROP TABLE IF EXISTS `clientes_has_corretores`;
CREATE TABLE IF NOT EXISTS `clientes_has_corretores` (
  `clientes_id` int(10) UNSIGNED NOT NULL,
  `corretores_idcorretores` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`clientes_id`,`corretores_idcorretores`),
  KEY `fk_clientes_has_corretores_corretores1_idx` (`corretores_idcorretores`),
  KEY `fk_clientes_has_corretores_clientes1_idx` (`clientes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `corretores`
--

DROP TABLE IF EXISTS `corretores`;
CREATE TABLE IF NOT EXISTS `corretores` (
  `idcorretores` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcorretores`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
CREATE TABLE IF NOT EXISTS `imoveis` (
  `idimoveis` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `clientes_idclientes` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idimoveis`),
  KEY `fk_imoveis_clientes_idx` (`clientes_idclientes`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `imoveis`
--

INSERT INTO `imoveis` (`idimoveis`, `nome`, `bairro`, `cidade`, `clientes_idclientes`) VALUES
(13, 'Condominio agro', 'Agrônomica', 'Florianópolis', 17),
(14, 'Condominio eve', 'Centro', 'Florianópolis', 18),
(16, 'Apartamento', 'Centro', 'Florianópolis', 20),
(17, 'Bar', 'Centro', 'Florianópolis', 22),
(18, 'Corporate', 'ST lisboa', 'Florianópolis', 26),
(19, 'Park', 'ST lisboa', 'Florianópolis', 26),
(20, 'Office', 'ST lisboa', 'Florianópolis', 26),
(21, 'Primavare', 'ST lisboa', 'Florianópolis', 19),
(22, 'Acate', 'ST lisboa', 'Florianópolis', 20),
(23, 'Apartamento', 'Centro', 'Florianópolis', 17);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `clientes_has_corretores`
--
ALTER TABLE `clientes_has_corretores`
  ADD CONSTRAINT `fk_clientes_has_corretores_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clientes_has_corretores_corretores1` FOREIGN KEY (`corretores_idcorretores`) REFERENCES `corretores` (`idcorretores`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD CONSTRAINT `fk_imoveis_clientes` FOREIGN KEY (`clientes_idclientes`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
