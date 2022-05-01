-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : Dim 01 mai 2022 à 22:11
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `aiu12_world_of_sapologie`
--

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_character`
--

DROP TABLE IF EXISTS `aiu12_character`;
CREATE TABLE IF NOT EXISTS `aiu12_character` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fk` varchar(255) NOT NULL,
  `character_name` varchar(255) NOT NULL,
  `classe` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_character_image`
--

DROP TABLE IF EXISTS `aiu12_character_image`;
CREATE TABLE IF NOT EXISTS `aiu12_character_image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `character_fk` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_comment`
--

DROP TABLE IF EXISTS `aiu12_comment`;
CREATE TABLE IF NOT EXISTS `aiu12_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `character_image_fk` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_mail_validate`
--

DROP TABLE IF EXISTS `aiu12_mail_validate`;
CREATE TABLE IF NOT EXISTS `aiu12_mail_validate` (
  `id` int(11) NOT NULL,
  `validate` int(11) NOT NULL,
  `user_fk` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_fk_UNIQUE` (`user_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_messages`
--

DROP TABLE IF EXISTS `aiu12_messages`;
CREATE TABLE IF NOT EXISTS `aiu12_messages` (
  `id` int(11) NOT NULL,
  `author_fk` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `destinataire` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_role`
--

DROP TABLE IF EXISTS `aiu12_role`;
CREATE TABLE IF NOT EXISTS `aiu12_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aiu12_role`
--

INSERT INTO `aiu12_role` (`id`, `role`) VALUES
(1, 'user'),
(2, 'modo'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_user`
--

DROP TABLE IF EXISTS `aiu12_user`;
CREATE TABLE IF NOT EXISTS `aiu12_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aiu12_user`
--

INSERT INTO `aiu12_user` (`id`, `username`, `mail`, `password`, `date`) VALUES
(2, 'admin', 'admin@admin.org', '$2y$10$Nvve5ixpZoMZw9KsXXlBCezoQcQyusx3KZxYRiEa5x3eOK0wZEWk2', '2022-04-29 12:37:50');

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_user_role`
--

DROP TABLE IF EXISTS `aiu12_user_role`;
CREATE TABLE IF NOT EXISTS `aiu12_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fk` int(11) NOT NULL,
  `role_fk` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_view_publication`
--

DROP TABLE IF EXISTS `aiu12_view_publication`;
CREATE TABLE IF NOT EXISTS `aiu12_view_publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `view` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aiu12_view_publication`
--

INSERT INTO `aiu12_view_publication` (`id`, `view`) VALUES
(1, 'privé'),
(2, 'profil'),
(3, 'public');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
