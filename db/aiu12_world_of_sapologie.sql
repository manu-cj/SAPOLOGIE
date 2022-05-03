-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 03 mai 2022 à 14:31
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
  `server_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aiu12_character`
--

INSERT INTO `aiu12_character` (`id`, `user_fk`, `character_name`, `classe`, `server_name`) VALUES
(2, '2', 'Bachelor', 'Moine', 'Varimathras'),
(3, '2', 'Bydie', 'Voleur', 'Varimathras'),
(4, '2', 'Bye', 'Pretre', 'Varimathras');

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_character_image`
--

DROP TABLE IF EXISTS `aiu12_character_image`;
CREATE TABLE IF NOT EXISTS `aiu12_character_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `character_fk` int(11) NOT NULL,
  `user_fk` int(11) NOT NULL,
  `view_fk` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aiu12_character_image`
--

INSERT INTO `aiu12_character_image` (`id`, `image`, `character_fk`, `user_fk`, `view_fk`, `description`) VALUES
(1, '57c17a1ee2a38583ce13b81ed22fb3.PNG', 3, 2, 0, '0'),
(2, '60377fff574c2dcc0655f9a77fa801.PNG', 2, 2, 2, '0'),
(3, '7eff27ca0d7c77a521f7259fa5838a.PNG', 3, 2, 2, 'Je suis le grand Bachelor<br />\r\n<br />\r\n<br />\r\nEt je suis un sapologue chevronn&eacute;<br />\r\n<br />\r\n<br />\r\n<br />\r\nJ\'aime la D A'),
(4, '0a913c607f000a95bc03bf49bbb687.PNG', 3, 2, 2, ''),
(5, 'abfbe0b665e4c3c34d8d844081e762.PNG', 4, 2, 2, 'Y a que bye qui baille !');

-- --------------------------------------------------------

--
-- Structure de la table `aiu12_comment`
--

DROP TABLE IF EXISTS `aiu12_comment`;
CREATE TABLE IF NOT EXISTS `aiu12_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fk` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `character_image_fk` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aiu12_comment`
--

INSERT INTO `aiu12_comment` (`id`, `user_fk`, `content`, `date`, `character_image_fk`) VALUES
(1, 2, 'Magnifique le Bachelor !', '2022-05-03 12:13:07', 2),
(3, 2, 'Biddy est un v&eacute;ritable sapologue', '2022-05-03 12:18:56', 3),
(5, 2, 'Magnifique chapeau ! Wahouh !', '2022-05-03 12:21:24', 2),
(7, 2, 'Jolie lunette', '2022-05-03 12:22:15', 3),
(9, 2, 'Y a que bye qui baille', '2022-05-03 12:25:25', 4),
(12, 2, 'Les beaux gar&ccedil;ons ont de beau pr&eacute;nom', '2022-05-03 12:31:37', 2),
(13, 2, 'Vive la sapologie', '2022-05-03 12:33:44', 2),
(14, 2, 'Cette transmo est sublime', '2022-05-03 12:37:43', 3),
(15, 2, 'On dirait Johnny Depp', '2022-05-03 13:27:37', 5),
(16, 2, 'Il a trop la classe', '2022-05-03 13:31:26', 5),
(17, 2, 'Je veux un autographe de Bye !', '2022-05-03 13:34:33', 5),
(18, 2, 'Il est styl&eacute; ce Bye', '2022-05-03 13:35:21', 4),
(19, 2, 'Jhonny Depp', '2022-05-03 13:40:43', 5),
(20, 2, '&agrave; quand le prochain pirate des caraibe ?', '2022-05-03 13:41:43', 5),
(21, 2, 'Un bel homme ', '2022-05-03 13:42:36', 5);

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
(2, 'profil'),
(3, 'public');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
