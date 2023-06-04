-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 04 Juin 2023 à 20:06
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `sae23`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

CREATE TABLE IF NOT EXISTS `administration` (
  `login` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `administration`
--

INSERT INTO `administration` (`login`, `mdp`) VALUES
('admin', 'passroot');

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE IF NOT EXISTS `batiment` (
  `id-batiment` varchar(10) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `login` varchar(10) NOT NULL,
  `mdp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `batiment`
--

INSERT INTO `batiment` (`id-batiment`, `nom`, `login`, `mdp`) VALUES
('B212', 'BatimentB212', 'gestB212', 'passB212'),
('E208', 'BatimentE208', 'gestE208', 'passE208');

-- --------------------------------------------------------

--
-- Structure de la table `capteur`
--

CREATE TABLE IF NOT EXISTS `capteur` (
`id-capteur` int(3) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `id-batiment` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `capteur`
--

INSERT INTO `capteur` (`id-capteur`, `nom`, `type`, `id-batiment`) VALUES
(6, 'CAPTtemperatureE208', 'temperature', 'E208'),
(7, 'CAPTco2B212', 'co2', 'B212'),
(8, 'CAPTilluminationB212', 'illumination', 'B212'),
(9, 'CAPTpressureB212', 'pressure', 'B212');

-- --------------------------------------------------------

--
-- Structure de la table `mesure`
--

CREATE TABLE IF NOT EXISTS `mesure` (
`id-mesure` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` varchar(30) NOT NULL,
  `valeur` int(11) NOT NULL,
  `id-capteur` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `mesure`
--

INSERT INTO `mesure` (`id-mesure`, `date`, `heure`, `valeur`, `id-capteur`) VALUES
(6, '2023-06-04', '18:49:22', 31, 7),
(7, '2023-06-04', '18:49:22', 27, 8),
(8, '2023-06-04', '18:49:22', 31, 9),
(9, '2023-06-04', '18:49:24', 26, 6),
(10, '2023-06-04', '18:49:33', 25, 7),
(11, '2023-06-04', '18:49:33', 17, 8),
(12, '2023-06-04', '18:49:33', 41, 9),
(13, '2023-06-04', '18:49:35', 24, 6),
(14, '2023-06-04', '19:07:17', 10, 7),
(15, '2023-06-04', '19:07:17', 26, 8),
(16, '2023-06-04', '19:07:17', 31, 9),
(17, '2023-06-04', '19:07:19', 17, 6);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `administration`
--
ALTER TABLE `administration`
 ADD PRIMARY KEY (`login`);

--
-- Index pour la table `batiment`
--
ALTER TABLE `batiment`
 ADD UNIQUE KEY `id-batiment` (`id-batiment`);

--
-- Index pour la table `capteur`
--
ALTER TABLE `capteur`
 ADD PRIMARY KEY (`id-capteur`), ADD UNIQUE KEY `id-capteur` (`id-capteur`);

--
-- Index pour la table `mesure`
--
ALTER TABLE `mesure`
 ADD PRIMARY KEY (`id-mesure`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `capteur`
--
ALTER TABLE `capteur`
MODIFY `id-capteur` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `mesure`
--
ALTER TABLE `mesure`
MODIFY `id-mesure` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
