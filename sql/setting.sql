-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le :  jeu. 17 mai 2018 à 07:57
-- Version du serveur :  10.2.13-MariaDB-10.2.13+maria~jessie
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wesic`
--

--
-- Déchargement des données de la table `setting`
--

INSERT INTO `setting` (`type`, `id`, `value`) VALUES
( 1, 'title', 'Wesic Inc.'),
( 1, 'slogan', NULL),
( 1, 'url', 'http://www.docker.local'),
( 1, 'email', 'lharang.pro@gmail.com'),
( 2, 'timezone', '1'),
( 1, 'datetype', '1'),
( 1, 'timetype', '1'),
( 1, 'favicon', 'public/storage/favicon.png'),
( 2, 'signup', '1'),
( 2, 'mail-server', 'smtp.gmail.com'),
( 2, 'mail-port', '587'),
( 2, 'mail-login', 'wesic.corporate@gmail.com'),
( 2, 'mail-password', 'wesic2018'),
( 2, 'default-cat', '1'),
( 2, 'default-format', '1'),
( 3, 'homepage', '0'),
( 3, 'pagination-posts', '1'),
( 3, 'pagination-rss', '1'),
( 3, 'display-post', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
