-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le :  jeu. 17 mai 2018 à 10:02
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

INSERT INTO `setting` (`id`, `type`, `value`) VALUES
('datetype', 1, '1'),
('default-cat', 2, '1'),
('default-format', 2, '1'),
('display-post', 3, '1'),
('email', 1, 'lharang.pro@gmail.com'),
('favicon', 1, 'public/storage/favicon.png'),
('homepage', 3, '0'),
('links-bloc', 4, '1'),
('mail-login', 2, 'wesic.corporate@gmail.com'),
('mail-password', 2, 'wesic2018'),
('mail-port', 2, '587'),
('mail-server', 2, 'smtp.gmail.com'),
('pagination-posts', 3, '1'),
('pagination-rss', 3, '1'),
('signup', 2, '1'),
('slogan', 1, 'TROP BIEN LE SLOGAN LOLILOL'),
('timetype', 1, '1'),
('timezone', 2, '1'),
('title', 1, 'Wesic Dev.'),
('url', 1, 'http://docker.local'),
('welcome-bloc', 4, '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
