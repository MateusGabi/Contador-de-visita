-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 20-Fev-2015 às 18:08
-- Versão do servidor: 5.6.14
-- versão do PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `contador_visita`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitas_online`
--

CREATE TABLE IF NOT EXISTS `visitas_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteID` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `identificador` varchar(40) NOT NULL,
  `hora` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificador` (`identificador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `visitas_online`
--

INSERT INTO `visitas_online` (`id`, `siteID`, `ip`, `identificador`, `hora`) VALUES
(12, '', '::1', 'e35958e0fe8a3e13242a46a6a0db5f7400acd5dc', '2015-02-20 13:56:43'),
(11, '', '::1', '52bfdec14b655580f5e45bcb0f13ffcefad5899e', '2015-02-20 13:52:44'),
(10, '', '::1', '8fc7e896e88915059a1baf98bd5396d5b604f0a6', '2015-02-20 13:10:46'),
(9, '12', '::1', 'b270676f8df5a87ec478fe89ae07b3cc43301493', '2015-02-20 14:08:10'),
(8, '12', '::1', '894be4a5b7d148dbc00f668eefc13234952581c3', '2015-02-20 13:10:40'),
(13, '', '::1', '0b42f58efb02e550a2a77a216c580131b1360e33', '2015-02-20 14:06:38'),
(14, '', '::1', '3fc68d3df7e9a1906f79c4f87159f49cbce26ca2', '2015-02-20 14:06:42'),
(15, '', '::1', 'b413b454ed3f725ac194acf8fe1ff90304fb70e4', '2015-02-20 14:06:45'),
(16, '', '::1', '27a2ba136efba850a138d6a4962e463ae77eb55b', '2015-02-20 14:06:49'),
(17, '', '::1', 'b946f2b5f145fef2d4132a296c80a3cb2ca1ed41', '2015-02-20 14:06:52'),
(18, '', '::1', '4336c22b6af921c934c7fe30fbb45ba8367c0679', '2015-02-20 14:06:56'),
(19, '', '::1', 'bbca56bf10ae7a08fa5c8103e3b7a2cbc40cad68', '2015-02-20 14:06:59');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
