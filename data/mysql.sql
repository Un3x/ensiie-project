-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  mysql.iiens.net
-- Généré le :  Jeu 09 Mai 2019 à 09:39
-- Version du serveur :  5.7.26
-- Version de PHP :  7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e_hovi2018`
--

-- --------------------------------------------------------

--
-- Structure de la table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `text` varchar(300) NOT NULL,
  `icon` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `choice`
--

CREATE TABLE `choice` (
  `id` int(11) NOT NULL,
  `content` varchar(300) DEFAULT NULL,
  `next_node` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `choice`
--

INSERT INTO `choice` (`id`, `content`, `next_node`) VALUES
(1, 'Oui ! ', 2),
(1, 'Non !', 3),
(2, 'Bon ben salut alors !', 1);

-- --------------------------------------------------------

--
-- Structure de la table `completed`
--

CREATE TABLE `completed` (
  `pseudo` varchar(300) NOT NULL,
  `end_id` bigint(20) UNSIGNED NOT NULL,
  `ghost` int(11) NOT NULL,
  `alcohol` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `bar` int(11) NOT NULL,
  `baka` int(11) NOT NULL,
  `diese` int(11) NOT NULL,
  `is_bar` tinyint(1) NOT NULL,
  `is_baka` tinyint(1) NOT NULL,
  `is_diese` tinyint(1) NOT NULL,
  `date_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `current_story`
--

CREATE TABLE `current_story` (
  `pseudo` varchar(300) NOT NULL,
  `step` int(11) NOT NULL,
  `date_current` date NOT NULL,
  `ghost` int(11) NOT NULL,
  `alcohol` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `bar` int(11) NOT NULL,
  `baka` int(11) NOT NULL,
  `diese` int(11) NOT NULL,
  `is_bar` tinyint(1) NOT NULL,
  `is_baka` tinyint(1) NOT NULL,
  `is_diese` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `current_story`
--

INSERT INTO `current_story` (`pseudo`, `step`, `date_current`, `ghost`, `alcohol`, `attendance`, `bar`, `baka`, `diese`, `is_bar`, `is_baka`, `is_diese`) VALUES
('Kat', 2, '2019-04-28', 50, 50, 50, 60, 50, 50, 0, 0, 0),
('Polio', 1, '2019-04-28', 50, 50, 50, 50, 50, 50, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `link_achievement_user`
--

CREATE TABLE `link_achievement_user` (
  `pseudo` varchar(300) NOT NULL,
  `achievement` int(11) NOT NULL,
  `date_acquired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `requirement`
--

CREATE TABLE `requirement` (
  `node_id` int(11) NOT NULL,
  `variable` enum('alcohol','ghost','attendance','bar','baka','diese','is_bar','is_baka','is_diese') NOT NULL,
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `requirement`
--
/*
INSERT INTO `requirement` (`node_id`, `variable`, `min`, `max`) VALUES
(2, 'bar', 60, NULL);
*/
-- --------------------------------------------------------

--
-- Structure de la table `story_node`
--

CREATE TABLE `story_node` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modif_alcohol` int(11) DEFAULT NULL,
  `modif_attendance` int(11) DEFAULT NULL,
  `modif_ghost` int(11) DEFAULT NULL,
  `modif_bar` int(11) DEFAULT NULL,
  `modif_baka` int(11) DEFAULT NULL,
  `modif_diese` int(11) DEFAULT NULL,
  `join_bar` int(11) DEFAULT NULL,
  `join_baka` int(11) DEFAULT NULL,
  `join_diese` int(11) DEFAULT NULL,
  `ach_id` int(11) DEFAULT NULL,
  `content` varchar(1000) NOT NULL,
  `bg_picture` varchar(300) NOT NULL,
  `fg_picture` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `story_node`
--

INSERT INTO `story_node` (`id`, `modif_alcohol`, `modif_attendance`, `modif_ghost`, `modif_bar`, `modif_baka`, `modif_diese`, `join_bar`, `join_baka`, `join_diese`, `ach_id`, `content`, `bg_picture`, `fg_picture`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'Veux-tu rejoindre Le Bar (c) ?', 'facade.png', 'chara-test.png'),
(2, 0, 0, -20, 30, 0, -20, 1, 0, 0, 1, 'Bienvenue !', 'bar_encours.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_bis`
--

CREATE TABLE `user_bis` (
  `pseudo` varchar(300) NOT NULL,
  `hash_bis` varchar(300) NOT NULL,
  `gender` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user_bis`
--

INSERT INTO `user_bis` (`pseudo`, `hash_bis`, `gender`) VALUES
('Bob', 'x', 'Hélicoptère Apache'),
('Kat', 'motdepasse', 'f'),
('Kubat', 'x', 'm'),
('Polio', 'x', 'm'),
('Sun', 'x', 'Hélicoptère Apache');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `choice`
--
ALTER TABLE `choice`
  ADD PRIMARY KEY (`id`,`next_node`),
  ADD UNIQUE KEY `next_node` (`next_node`);

--
-- Index pour la table `completed`
--
ALTER TABLE `completed`
  ADD PRIMARY KEY (`pseudo`,`end_id`,`ghost`,`alcohol`,`attendance`,`bar`,`baka`,`diese`,`is_bar`,`is_baka`,`is_diese`),
  ADD UNIQUE KEY `end_id` (`end_id`);

--
-- Index pour la table `current_story`
--
ALTER TABLE `current_story`
  ADD PRIMARY KEY (`pseudo`);

--
-- Index pour la table `link_achievement_user`
--
ALTER TABLE `link_achievement_user`
  ADD PRIMARY KEY (`pseudo`,`achievement`);

--
-- Index pour la table `requirement`
--
ALTER TABLE `requirement`
  ADD PRIMARY KEY (`node_id`,`variable`);

--
-- Index pour la table `story_node`
--
ALTER TABLE `story_node`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `user_bis`
--
ALTER TABLE `user_bis`
  ADD PRIMARY KEY (`pseudo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `choice`
--
ALTER TABLE `choice`
  MODIFY `next_node` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `completed`
--
ALTER TABLE `completed`
  MODIFY `end_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `story_node`
--
ALTER TABLE `story_node`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
