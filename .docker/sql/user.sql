-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le :  Dim 20 mai 2018 à 12:39
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
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `lastname`, `firstname`, `role`, `email`, `password`, `creationDate`, `status`, `token`) VALUES
(1, 'admin', 'HARANG', 'Louis', 4, 'vundaboy@gmail.com', '$2y$10$QZMproJZoNGvY8DjRA4uSuAr/SoCAjHHsAxybHZmxa1vL9bqWmRvO', '2018-05-17 22:51:26', 1, '36abf7c7d1'),
(2, 'admin2', 'HARANG', 'Louis', 3, 'lharang@gmail.com', '$2y$10$QZMproJZoNGvY8DjRA4uSuAr/SoCAjHHsAxybHZmxa1vL9bqWmRvO', '2018-05-17 22:51:26', 1, '1c2cfa377d'),
(3, 'admin2z', 'HARANG', 'Louis', 4, 'lharang@gmzail.com', '$2y$10$QZMproJZoNGvY8DjRA4uSuAr/SoCAjHHsAxybHZmxa1vL9bqWmRvO', '2018-05-17 22:51:26', 1, '1c2cfa377d'),
(8, 'admin2zzz\r\n', 'HARANG', 'Louis', 1, 'lharang@gzzmail.com', '$2y$10$QZMproJZoNGvY8DjRA4uSuAr/SoCAjHHsAxybHZmxa1vL9bqWmRvO', '2018-05-17 22:51:26', 1, '1c2cfa377d'),
(9, 'admin2zz', 'HARANG', 'Louis', 4, 'lharanzg@gmzzail.com', '$2y$10$QZMproJZoNGvY8DjRA4uSuAr/SoCAjHHsAxybHZmxa1vL9bqWmRvO', '2018-05-17 22:51:26', 1, '1c2cfa377d');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
