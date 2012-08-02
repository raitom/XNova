-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 06 Mai 2012 à 15:31
-- Version du serveur: 5.1.53
-- Version de PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `xnova`
--

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `config`
--

INSERT INTO `config` (`id`, `parameter`, `value`) VALUES
(1, 'LAST_PLANET', '12'),
(2, 'LAST_SYSTEM', '2'),
(3, 'LAST_GALAXY', '1'),
(4, 'METAL', '500'),
(5, 'DIAMOND', '500'),
(6, 'GOLD', '50'),
(7, 'ANTIMATTER', '100'),
(8, 'PRODUCTION_SPEED', '1'),
(9, 'ENERGY_FACTOR', '1'),
(10, 'BUILDING_SPEED', '2500');

-- --------------------------------------------------------

--
-- Structure de la table `planet`
--

DROP TABLE IF EXISTS `planet`;
CREATE TABLE IF NOT EXISTS `planet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPlayer` int(11) NOT NULL,
  `planet` int(11) NOT NULL,
  `system` int(11) NOT NULL,
  `galaxy` int(11) NOT NULL,
  `name` longtext,
  `lastUpdate` int(11) DEFAULT NULL,
  `metal` double NOT NULL,
  `diamond` double NOT NULL,
  `gold` double NOT NULL,
  `antimatter` double NOT NULL,
  `energy` double DEFAULT NULL,
  `metalFactory` int(11) DEFAULT NULL,
  `diamondFactory` int(11) DEFAULT NULL,
  `goldFactory` int(11) DEFAULT NULL,
  `antimatterFactory` int(11) DEFAULT NULL,
  `solarPowerPlant` int(11) DEFAULT NULL,
  `antimatterPowerPlant` int(11) DEFAULT NULL,
  `shipyard` int(11) DEFAULT NULL,
  `robotFactory` int(11) DEFAULT NULL,
  `naniteFactory` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `planet`
--

INSERT INTO `planet` (`id`, `idPlayer`, `planet`, `system`, `galaxy`, `name`, `lastUpdate`, `metal`, `diamond`, `gold`, `antimatter`, `energy`, `metalFactory`, `diamondFactory`, `goldFactory`, `antimatterFactory`, `solarPowerPlant`, `antimatterPowerPlant`, `shipyard`, `robotFactory`, `naniteFactory`) VALUES
(1, 1, 9, 2, 1, 'troll', 1336318270, 1488.7166666667, 965.28666666662, 50, 100, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(2, 2, 12, 2, 1, NULL, 1336157940, 500, 500, 50, 100, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idCurrentPlanet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `player`
--

INSERT INTO `player` (`id`, `idUser`, `idCurrentPlanet`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `technology`
--

DROP TABLE IF EXISTS `technology`;
CREATE TABLE IF NOT EXISTS `technology` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPlayer` int(11) NOT NULL,
  `idPlanet` int(11) NOT NULL,
  `energy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `technology`
--

INSERT INTO `technology` (`id`, `idPlayer`, `idPlanet`, `energy`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `idCurrentPlanet` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA1797792FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_2DA17977A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `idCurrentPlanet`) VALUES
(1, 'test', 'test', 'test@test.com', 'test@test.com', 1, '9lcxf19vqjwo4sksoc8o0c4s44wc4ww', 'J/sXEVvtSsCKBI2rm9n/mW6AOFmwUfDcwEQ37hWOM3qAiZD6XTtWIpLjr87P3Y6IEfP5FbMFrAuhUA8sjrifyw==', '2012-05-06 14:26:48', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL),
(2, 'sfdsdfdsf', 'sfdsdfdsf', 'sdfsdf@sdfsdf.com', 'sdfsdf@sdfsdf.com', 1, 'l16j7idz7z4g80w8sgs0k0g48soosow', '0GfAOalfUE9kIT6fwR4sjzkms5oEWvA9OoL79Ke6R4Cxzi7clx/xtFJu8mNx73kRk8FbVjQh2RYl8YfWrafaig==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL);
