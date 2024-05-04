-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 02, 2024 at 06:16 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dm`
--

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `status` tinyint NOT NULL COMMENT '0 for not completed, 1 for completed, 2 for hidden',
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `description`, `status`, `date_time`) VALUES
(96, 'Lire et comprendre les spécifications du projet', 1, '0000-00-00 00:00:00'),
(97, 'Concevoir la structure du système en fonction des exigences', 0, '0000-00-00 00:00:00'),
(98, 'Écrire le code pour implémenter les fonctionnalités requises', 0, '0000-00-00 00:00:00'),
(99, 'Effectuer des tests unitaires et d’intégration pour s’assurer que le code fonctionne comme prévu', 0, '0000-00-00 00:00:00'),
(100, ' Identifier et corriger les erreurs dans le code', 0, '0000-00-00 00:00:00'),
(101, 'Rédiger une documentation claire pour le code et le système', 0, '0000-00-00 00:00:00'),
(102, 'Examiner le code des autres développeurs pour s’assurer qu’il est de haute qualité', 0, '0000-00-00 00:00:00'),
(103, 'Améliorer l’efficacité du code et du système', 0, '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
