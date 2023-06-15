-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 15 Juin 2023 à 21:59
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

-- --------------------------------------------------------

--
-- Structure de la table `capteur`
--

CREATE TABLE IF NOT EXISTS `capteur` (
`id-capteur` int(3) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `id-batiment` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Structure de la table `mesure`
--

CREATE TABLE IF NOT EXISTS `mesure` (
`id-mesure` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` varchar(30) NOT NULL,
  `valeur` float NOT NULL,
  `id-capteur` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

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
 ADD PRIMARY KEY (`id-batiment`), ADD UNIQUE KEY `id-batiment` (`id-batiment`);

--
-- Index pour la table `capteur`
--
ALTER TABLE `capteur`
 ADD PRIMARY KEY (`id-capteur`), ADD UNIQUE KEY `id-capteur` (`id-capteur`), ADD KEY `id-batiment` (`id-batiment`);

--
-- Index pour la table `mesure`
--
ALTER TABLE `mesure`
 ADD PRIMARY KEY (`id-mesure`), ADD KEY `id-capteur` (`id-capteur`), ADD KEY `id-capteur_2` (`id-capteur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `capteur`
--
ALTER TABLE `capteur`
MODIFY `id-capteur` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `mesure`
--
ALTER TABLE `mesure`
MODIFY `id-mesure` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `capteur`
--
ALTER TABLE `capteur`
ADD CONSTRAINT `capteur_ibfk_1` FOREIGN KEY (`id-batiment`) REFERENCES `batiment` (`id-batiment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mesure`
--
ALTER TABLE `mesure`
ADD CONSTRAINT `mesure_ibfk_1` FOREIGN KEY (`id-capteur`) REFERENCES `capteur` (`id-capteur`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
