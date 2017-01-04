-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Client :  db655083596.db.1and1.com
-- Généré le :  Mar 03 Janvier 2017 à 18:04
-- Version du serveur :  5.5.52-0+deb7u1-log
-- Version de PHP :  5.4.45-0+deb7u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db655083596`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `content` varchar(512) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_project` (`id_project`),
  KEY `id_author` (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(512) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

--
-- Contenu de la table `notes`
--

INSERT INTO `notes` (`id`, `content`, `active`) VALUES
(16, '"Les notes", c''est quoi ?\r\nUne note est une information d''actualité me concernant, pouvant vous intéresser.', 0),
(17, 'Vous recrutez ?\r\nContactez-moi, je cherche un emploi !', 1);

-- --------------------------------------------------------

--
-- Structure de la table `prods`
--

CREATE TABLE IF NOT EXISTS `prods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(63) COLLATE utf8_bin NOT NULL,
  `description` varchar(4095) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'default.png',
  `date` date NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `client` varchar(63) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Contenu de la table `prods`
--

INSERT INTO `prods` (`id`, `title`, `description`, `image`, `date`, `url`, `client`) VALUES
(9, 'Puzzle', 'Puzzle en JavaScript Natif (sans jQuery ou autre bibliothèque) réalisé au cours de ma formation. Ma priorité pour ce projet était la légèreté ; je n''ai donc qu''une seule image en Background, et je joue avec sa position (background-position) pour le placer dans chaque pièce. Spécificités : Drag & Drop.', 'puzzle.png', '2016-08-22', 'http://doudoupike.fr/public/prods/puzzle/index.html', 'Perso'),
(10, 'Carrousel', 'Carrousel en JavaScript Natif (sans jQuery ou autre bibliothèque) réalisé au cours de ma formation. Il s''agit de ma première réalisation dans ce langage.', 'carousel.png', '2016-08-11', 'http://doudoupike.fr/public/prods/carousel/index.html', 'Perso');

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(63) COLLATE utf8_bin NOT NULL,
  `content` varchar(4095) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'default.png',
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `last_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `title`, `content`, `image`, `url`, `date`, `last_date`) VALUES
(4, 'Réseau Social Débat', 'Plateforme adaptée aux débats : Mix entre un réseau social et un forum. 1/Créer un débat, 2/Intégrer les sources, des graphiques et autres fichiers joints, 3/Inviter des contacts à le rejoindre, 4/Administrer le débat.', 'debat.png', '', '2016-12-28', '2016-12-28 06:10:30');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `title` varchar(63) COLLATE utf8_bin NOT NULL,
  `content` varchar(4095) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_project` (`id_project`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `reviews`
--

INSERT INTO `reviews` (`id`, `id_project`, `title`, `content`, `date`) VALUES
(4, 4, 'Phase de réflexion', 'Pour le moment je réfléchis au projet dans son ensemble.', '2016-12-28 06:07:59');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(31) COLLATE utf8_bin NOT NULL,
  `email` varchar(63) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=23 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `admin`, `active`) VALUES
(5, 'Chowsurique', 'alienor.plantard@gmail.com', '$2y$12$4EOMJybU1Ei9Yo1uKUBOb.cwIvoipx7ksj.s3AAl1EVATV7gE5Ime', 0, 1),
(7, 'DoudouPike', 'doudoupike@hotmail.fr', '$2y$10$QfSbCFtpL43Os9CaOFqyZ.UR.D5d3dZjXPeZ5x7L15aL18AEoVGBa', 1, 1),
(22, 'Monsieur Test', 'keke.doudoupike@gmail.com', '$2y$10$vplmChqh3.PEG8mDdb560eZ1rZBHyAKZUmS21UvERg6TMVfzbmJry', 0, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
