-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 mai 2026 à 09:11
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ouapi`
--

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_docs`
--

DROP TABLE IF EXISTS `ouapi_docs`;
CREATE TABLE IF NOT EXISTS `ouapi_docs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entreprise_id` int NOT NULL,
  `reference` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `date_archive` date DEFAULT NULL,
  `agence_id` int NOT NULL,
  `commentaire` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_docs`
--

INSERT INTO `ouapi_docs` (`id`, `entreprise_id`, `reference`, `type_id`, `date`, `date_archive`, `agence_id`, `commentaire`, `path`) VALUES
(1, -1, 'Configuration reseau', 3, '2014-12-03', '2035-12-30', 12, '', '1417620714.odt'),
(2, -1, 'Configuration Areha', 3, '2016-09-07', '2035-12-30', 11, '', '1473339460.odt'),
(4, 1, 'TestFacture', 1, '2026-04-20', '2035-12-30', 48, '', '1776773983.xlsx'),
(5, 1, 'TestContrat', 2, '2026-04-20', '2035-12-30', 48, '', '1776774076.pdf'),
(6, 1, 'TestGarantie', 4, '2026-04-20', '2035-12-30', 48, '', '1776774106.doc'),
(7, 1, 'TestBon', 5, '2026-04-20', '2035-12-30', 48, '', '1776774154.csv'),
(8, 1, 'TestManuel', 3, '2026-04-20', '2035-12-30', 48, '', '1776774193.txt'),
(9, 1, 'TestFacturePérimée', 1, '2026-04-20', '2023-12-30', 48, '', '1776777216.csv');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
