-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 23 Mars 2016 à 14:12
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `joggingeneva`
--

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE IF NOT EXISTS `favoris` (
  `idUtilisateur` int(11) NOT NULL,
  `idParcours` int(11) NOT NULL,
  KEY `idUtilisateur` (`idUtilisateur`,`idParcours`),
  KEY `idParcours` (`idParcours`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `favoris`
--

INSERT INTO `favoris` (`idUtilisateur`, `idParcours`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `parcours`
--

CREATE TABLE IF NOT EXISTS `parcours` (
  `idParcours` int(11) NOT NULL AUTO_INCREMENT,
  `NomParcours` varchar(25) NOT NULL,
  `LongueurParcours` float(100,1) NOT NULL,
  `DifficulteParcours` enum('Facile','Moyen','Difficile') NOT NULL,
  `idQuartier` int(11) NOT NULL,
  PRIMARY KEY (`idParcours`),
  KEY `QuartierParcours` (`idQuartier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `parcours`
--

INSERT INTO `parcours` (`idParcours`, `NomParcours`, `LongueurParcours`, `DifficulteParcours`, `idQuartier`) VALUES
(1, 'Parcours de la Plaine', 3.1, 'Facile', 5),
(2, 'Promenade au Jardin', 5.0, 'Moyen', 3),
(3, 'Bras du Lac', 7.2, 'Difficile', 5),
(4, 'Tracé Matinal', 2.5, 'Facile', 2),
(5, 'Course des Eaux-vives', 8.5, 'Moyen', 4),
(6, 'Orée du Rhône', 12.8, 'Difficile', 6),
(7, 'Tour Urbain', 4.2, 'Facile', 5),
(8, 'Asphalte Routinière', 6.3, 'Moyen', 1),
(9, 'Route Brune', 3.7, 'Facile', 1),
(10, 'Grandes Enjambées', 5.9, 'Facile', 6),
(11, 'Orée de l''Arve', 7.4, 'Moyen', 5),
(12, 'Voisinage Verdoyant', 9.9, 'Moyen', 6);

-- --------------------------------------------------------

--
-- Structure de la table `pointsparcours`
--

CREATE TABLE IF NOT EXISTS `pointsparcours` (
  `idPointsParcours` int(11) NOT NULL AUTO_INCREMENT,
  `Latitude` double(100,6) NOT NULL,
  `Longitude` double(100,6) NOT NULL,
  `NumeroEtape` int(11) NOT NULL,
  `idParcours` int(11) NOT NULL,
  PRIMARY KEY (`idPointsParcours`),
  KEY `idParcours` (`idParcours`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Contenu de la table `pointsparcours`
--

INSERT INTO `pointsparcours` (`idPointsParcours`, `Latitude`, `Longitude`, `NumeroEtape`, `idParcours`) VALUES
(1, 46.208480, 6.142607, 1, 1),
(2, 46.218597, 6.149221, 2, 1),
(3, 46.211388, 6.152750, 3, 1),
(4, 46.207022, 6.147536, 4, 1),
(5, 46.208314, 6.143245, 5, 1),
(6, 46.197620, 6.145923, 1, 2),
(7, 46.198920, 6.147736, 2, 2),
(8, 46.199752, 6.147178, 3, 2),
(9, 46.201527, 6.143927, 4, 2),
(10, 46.201281, 6.142586, 5, 2),
(11, 46.199522, 6.143101, 6, 2),
(12, 46.197672, 6.145762, 7, 2),
(13, 46.201197, 6.140349, 1, 3),
(14, 46.205818, 6.139807, 2, 3),
(15, 46.208172, 6.142511, 3, 3),
(16, 46.207749, 6.146470, 4, 3),
(17, 46.208892, 6.148326, 5, 3),
(18, 46.208825, 6.149806, 6, 3),
(19, 46.207058, 6.147907, 7, 3),
(20, 46.204363, 6.149839, 8, 3),
(21, 46.200585, 6.146411, 9, 3),
(22, 46.201090, 6.144050, 10, 3),
(23, 46.199946, 6.141046, 11, 3),
(24, 46.195520, 6.136347, 1, 4),
(25, 46.199753, 6.129094, 2, 4),
(26, 46.198951, 6.128365, 3, 4),
(27, 46.194822, 6.135617, 4, 4),
(28, 46.195520, 6.136347, 5, 4),
(29, 46.200214, 6.164027, 1, 5),
(30, 46.203214, 6.168855, 2, 5),
(31, 46.205857, 6.171623, 3, 5),
(32, 46.206109, 6.179863, 4, 5),
(33, 46.204375, 6.186268, 5, 5),
(34, 46.201583, 6.190131, 6, 5),
(35, 46.198404, 6.185195, 7, 5),
(36, 46.199385, 6.174767, 8, 5),
(37, 46.194483, 6.171291, 9, 5),
(38, 46.196206, 6.166227, 10, 5),
(39, 46.199949, 6.167386, 11, 5),
(40, 46.211146, 6.108806, 1, 6),
(41, 46.212126, 6.105373, 2, 6),
(42, 46.214799, 6.101253, 3, 6),
(43, 46.210641, 6.093872, 4, 6),
(44, 46.208265, 6.094344, 5, 6),
(45, 46.198701, 6.091082, 6, 6),
(46, 46.196087, 6.087778, 7, 6),
(47, 46.193117, 6.091812, 8, 6),
(48, 46.193444, 6.098936, 9, 6),
(49, 46.203008, 6.109021, 10, 6),
(50, 46.201167, 6.118848, 11, 6),
(51, 46.206216, 6.123698, 12, 6),
(52, 46.206929, 6.121252, 13, 6),
(53, 46.208354, 6.116402, 14, 6),
(54, 46.209364, 6.113055, 15, 6),
(55, 46.183072, 6.139716, 1, 7),
(56, 46.183414, 6.135446, 2, 7),
(57, 46.180977, 6.131412, 3, 7),
(58, 46.186875, 6.130811, 4, 7),
(59, 46.185360, 6.135789, 5, 7),
(60, 46.186415, 6.139995, 6, 7),
(61, 46.184156, 6.140531, 7, 7),
(62, 46.209970, 6.155294, 1, 8),
(63, 46.210995, 6.152977, 2, 8),
(64, 46.209599, 6.150767, 3, 8),
(65, 46.207966, 6.148857, 4, 8),
(66, 46.210520, 6.144136, 5, 8),
(67, 46.213578, 6.145552, 6, 8),
(68, 46.212272, 6.149758, 7, 8),
(69, 46.213623, 6.150638, 8, 8),
(70, 46.213831, 6.152183, 9, 8),
(71, 46.211025, 6.153041, 10, 8),
(72, 46.207015, 6.147848, 1, 9),
(73, 46.208812, 6.149951, 2, 9),
(74, 46.208782, 6.147720, 3, 9),
(75, 46.209644, 6.145703, 4, 9),
(76, 46.210490, 6.144029, 5, 9),
(77, 46.208441, 6.142849, 6, 9),
(78, 46.206109, 6.144887, 7, 9),
(79, 46.206926, 6.147505, 8, 9),
(80, 46.204506, 6.109546, 1, 10),
(81, 46.203347, 6.107765, 2, 10),
(82, 46.205203, 6.104890, 3, 10),
(83, 46.202961, 6.101135, 4, 10),
(84, 46.206065, 6.098195, 5, 10),
(85, 46.207193, 6.099440, 6, 10),
(86, 46.206510, 6.102251, 7, 10),
(87, 46.208010, 6.103667, 8, 10),
(88, 46.206837, 6.105920, 9, 10),
(89, 46.205560, 6.108581, 10, 10),
(90, 46.206288, 6.109933, 11, 10),
(91, 46.205382, 6.110018, 12, 10),
(92, 46.179658, 6.143095, 1, 11),
(93, 46.182540, 6.152923, 2, 11),
(94, 46.181649, 6.157987, 3, 11),
(95, 46.180698, 6.161206, 4, 11),
(96, 46.184144, 6.166055, 5, 11),
(97, 46.179212, 6.169960, 6, 11),
(98, 46.178558, 6.173007, 7, 11),
(99, 46.184679, 6.173780, 8, 11),
(100, 46.192196, 6.164167, 9, 11),
(101, 46.185273, 6.156785, 10, 11),
(102, 46.184144, 6.160004, 11, 11),
(103, 46.200751, 6.094730, 1, 12),
(104, 46.204226, 6.099365, 2, 12),
(105, 46.202385, 6.101639, 3, 12),
(106, 46.202860, 6.103141, 4, 12),
(107, 46.201434, 6.104815, 5, 12),
(108, 46.200335, 6.103013, 6, 12),
(109, 46.198018, 6.101425, 7, 12),
(110, 46.199236, 6.097348, 8, 12),
(111, 46.197394, 6.095717, 9, 12),
(112, 46.195820, 6.094558, 10, 12),
(113, 46.197157, 6.089838, 11, 12),
(114, 46.195909, 6.087992, 12, 12);

-- --------------------------------------------------------

--
-- Structure de la table `quartier`
--

CREATE TABLE IF NOT EXISTS `quartier` (
  `idQuartier` int(11) NOT NULL AUTO_INCREMENT,
  `NomQuartier` varchar(30) NOT NULL,
  `Latitude` double(100,6) NOT NULL,
  `Longitude` double(100,6) NOT NULL,
  PRIMARY KEY (`idQuartier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `quartier`
--

INSERT INTO `quartier` (`idQuartier`, `NomQuartier`, `Latitude`, `Longitude`) VALUES
(1, 'Paquis', 46.212789, 6.147405),
(2, 'Jonction', 46.201361, 6.130781),
(3, 'Charmilles', 46.208209, 6.124377),
(4, 'Eaux-Vives', 46.200127, 6.165669),
(5, 'Carouge', 46.183136, 6.139867),
(6, 'Vernier', 46.200018, 6.099888);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `NomUtilisateur` varchar(30) NOT NULL,
  `mdpUtilisateur` varchar(60) NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `NomUtilisateur` (`NomUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `NomUtilisateur`, `mdpUtilisateur`) VALUES
(1, 'Admin', '117ba14f8471e7ec247bb0f7112ebbaf'),
(2, 'test', 'f6889fc97e14b42dec11a8c183ea791c5465b658');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`idParcours`) REFERENCES `parcours` (`idParcours`),
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parcours`
--
ALTER TABLE `parcours`
  ADD CONSTRAINT `parcours_ibfk_1` FOREIGN KEY (`idQuartier`) REFERENCES `quartier` (`idQuartier`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `pointsparcours`
--
ALTER TABLE `pointsparcours`
  ADD CONSTRAINT `pointsparcours_ibfk_1` FOREIGN KEY (`idParcours`) REFERENCES `parcours` (`idParcours`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
