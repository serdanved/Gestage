-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 13 juin 2022 à 13:46
-- Version du serveur :  5.7.38
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blitzmedia_gestage`
--

-- --------------------------------------------------------

--
-- Structure de la table `ABSENCES`
--

CREATE TABLE `ABSENCES` (
  `ID` int(11) NOT NULL,
  `BY_ID` int(11) NOT NULL,
  `BY_TYPE` int(11) NOT NULL,
  `REPORTDATE` datetime NOT NULL,
  `REASON` text NOT NULL,
  `BLOCK_SCHEDULE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ADMINISTRATORS`
--

CREATE TABLE `ADMINISTRATORS` (
  `ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD_HASH` text NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ADMINISTRATORS`
--

INSERT INTO `ADMINISTRATORS` (`ID`, `EMAIL`, `PASSWORD_HASH`, `NAME`) VALUES
(1, 'support@blitzmedia.io', '$2y$10$gM3zhjZOQIp7SsNDKfsLjO4DoTneWm5Sb7/8Wby7lN.dCwWlCIUj6', 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `BLOCKS`
--

CREATE TABLE `BLOCKS` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `INTERNSHIP_ID` int(11) NOT NULL,
  `DATE_START` date NOT NULL,
  `DATE_END` date NOT NULL,
  `SCHEDULE` text,
  `TOTAL_HOURS` decimal(10,2) DEFAULT '120.00',
  `TEACHER_ID` int(11) NOT NULL,
  `CURRENT` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `BLOCKS`
--

INSERT INTO `BLOCKS` (`ID`, `NAME`, `INTERNSHIP_ID`, `DATE_START`, `DATE_END`, `SCHEDULE`, `TOTAL_HOURS`, `TEACHER_ID`, `CURRENT`) VALUES
(1, 'TEST BLITZ', 1, '2023-01-01', '2023-03-01', NULL, '50.00', 1, 1),
(2, 'hgd', 2, '2022-06-13', '2022-06-17', NULL, '30.00', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `BLOCK_SCHEDULES`
--

CREATE TABLE `BLOCK_SCHEDULES` (
  `ID` int(11) NOT NULL,
  `BLOCK_ID` int(11) NOT NULL,
  `INTERNSHIP_ID` int(11) NOT NULL,
  `VALUE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `BLOCK_SCHEDULES`
--

INSERT INTO `BLOCK_SCHEDULES` (`ID`, `BLOCK_ID`, `INTERNSHIP_ID`, `VALUE`) VALUES
(1, 1, 1, '{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":0,\"DATE\":\"2023-01-01\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(2, 1, 1, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-02\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(3, 1, 1, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-03\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(4, 1, 1, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-04\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(5, 1, 1, '{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-05\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(6, 1, 1, '{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-06\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(7, 1, 1, '{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":0,\"DATE\":\"2023-01-07\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(8, 1, 1, '{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":0,\"DATE\":\"2023-01-08\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(9, 1, 1, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-09\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(10, 1, 1, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-10\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(11, 1, 1, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-11\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(12, 1, 1, '{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-12\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(13, 1, 1, '{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-13\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(14, 1, 1, '{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":0,\"DATE\":\"2023-01-14\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(15, 1, 1, '{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":0,\"DATE\":\"2023-01-15\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(16, 1, 1, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-16\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(17, 1, 1, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-17\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(18, 1, 1, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-18\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(19, 1, 1, '{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-19\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(20, 1, 1, '{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-20\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(21, 1, 1, '{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":0,\"DATE\":\"2023-01-21\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(22, 1, 1, '{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":0,\"DATE\":\"2023-01-22\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(23, 1, 1, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-23\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(24, 1, 1, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-24\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(25, 1, 1, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-25\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(26, 1, 1, '{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-26\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(27, 1, 1, '{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-27\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(28, 1, 1, '{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":0,\"DATE\":\"2023-01-28\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(29, 1, 1, '{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":0,\"DATE\":\"2023-01-29\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(30, 1, 1, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-30\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(31, 1, 1, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-01-31\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(32, 1, 1, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-01\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(33, 1, 1, '{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-02\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(34, 1, 1, '{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-03\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(35, 1, 1, '{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":0,\"DATE\":\"2023-02-04\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(36, 1, 1, '{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":0,\"DATE\":\"2023-02-05\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(37, 1, 1, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-06\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(38, 1, 1, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-07\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(39, 1, 1, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-08\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(40, 1, 1, '{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-09\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(41, 1, 1, '{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-10\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(42, 1, 1, '{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":0,\"DATE\":\"2023-02-11\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(43, 1, 1, '{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":0,\"DATE\":\"2023-02-12\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(44, 1, 1, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-13\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(45, 1, 1, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-14\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(46, 1, 1, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-15\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(47, 1, 1, '{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-16\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(48, 1, 1, '{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-17\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(49, 1, 1, '{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":0,\"DATE\":\"2023-02-18\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(50, 1, 1, '{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":0,\"DATE\":\"2023-02-19\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(51, 1, 1, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-20\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(52, 1, 1, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-21\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(53, 1, 1, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-22\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(54, 1, 1, '{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-23\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(55, 1, 1, '{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-24\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(56, 1, 1, '{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":0,\"DATE\":\"2023-02-25\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(57, 1, 1, '{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":0,\"DATE\":\"2023-02-26\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(58, 1, 1, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-27\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(59, 1, 1, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-02-28\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(60, 1, 1, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":7,\"DATE\":\"2023-03-01\",\"PRESENT\":\"on\",\"REASON\":\"\"}'),
(61, 2, 2, '{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"FROM_EV\":\"17:00\",\"TO_EV\":\"17:00\",\"DATE\":\"2022-06-13\",\"PRESENT\":\"on\",\"TOTAL\":7,\"REASON\":\"\"}'),
(62, 2, 2, '{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"FROM_EV\":\"17:00\",\"TO_EV\":\"17:00\",\"DATE\":\"2022-06-14\",\"TOTAL\":0,\"REASON\":\"Maladie\",\"REASON_BY_ID\":\"1\",\"REASON_BY_TYPE\":3,\"REASON_REPORT_DATE\":\"2022-06-01 01:29:39\"}'),
(63, 2, 2, '{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"FROM_EV\":\"17:00\",\"TO_EV\":\"17:00\",\"DATE\":\"2022-06-15\",\"PRESENT\":\"on\",\"TOTAL\":7,\"REASON\":\"\"}'),
(64, 2, 2, '{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"FROM_EV\":\"17:00\",\"TO_EV\":\"17:00\",\"DATE\":\"2022-06-16\",\"PRESENT\":\"on\",\"TOTAL\":7,\"REASON\":\"\"}'),
(65, 2, 2, '{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"10:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"13:00\",\"FROM_EV\":\"17:00\",\"TO_EV\":\"17:00\",\"DATE\":\"2022-06-17\",\"PRESENT\":\"on\",\"TOTAL\":2,\"REASON\":\"\"}');

-- --------------------------------------------------------

--
-- Structure de la table `CREATOR_TYPES`
--

CREATE TABLE `CREATOR_TYPES` (
  `ID` int(255) NOT NULL,
  `NAME` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `CREATOR_TYPES`
--

INSERT INTO `CREATOR_TYPES` (`ID`, `NAME`) VALUES
(1, 'Étudiant'),
(2, 'Professeur'),
(3, 'Employeur');

-- --------------------------------------------------------

--
-- Structure de la table `DOCUMENTS`
--

CREATE TABLE `DOCUMENTS` (
  `ID` int(11) NOT NULL,
  `UPLOADER_USERID` int(11) DEFAULT NULL,
  `UPLOADER_TYPEID` int(11) NOT NULL,
  `INTERNSHIP_ID` int(11) DEFAULT NULL,
  `BLOCK_ID` int(11) DEFAULT NULL,
  `NAME` text,
  `FILENAME` text,
  `CANSEE_STUDENT` tinyint(4) NOT NULL DEFAULT '0',
  `CANSEE_EMPLOYER` tinyint(4) NOT NULL DEFAULT '0',
  `CANSEE_TEACHER` tinyint(4) NOT NULL DEFAULT '0',
  `DATE` date NOT NULL,
  `FORM_ID` int(11) DEFAULT '0',
  `letter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `DOCUMENT_PDF_PROG`
--

CREATE TABLE `DOCUMENT_PDF_PROG` (
  `ID` int(11) NOT NULL,
  `PROG_ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `TYPE` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `DOCUMENT_PDF_STAGE`
--

CREATE TABLE `DOCUMENT_PDF_STAGE` (
  `ID` int(11) NOT NULL,
  `STAGE_ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `TYPE` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `EMPLOYERS`
--

CREATE TABLE `EMPLOYERS` (
  `ID` int(11) NOT NULL,
  `USERNAME` text NOT NULL,
  `PASSWORD_HASH` text NOT NULL,
  `EMPLOYER_NAME` varchar(500) DEFAULT NULL,
  `CONTACT_NAME` text,
  `CONTACT_NAME_2` text,
  `PHONE` varchar(100) DEFAULT NULL,
  `PHONEHASH` varchar(100) DEFAULT NULL,
  `COUNTRY` varchar(100) DEFAULT NULL,
  `PROVINCE` varchar(100) DEFAULT NULL,
  `CITY` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(500) DEFAULT NULL,
  `POSTAL_CODE` varchar(6) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `NOTE` text,
  `NOTE_2` text,
  `NEQ` text,
  `INACTIVE` tinyint(1) DEFAULT '0',
  `WEB_ADDRESS` text,
  `VISIBLE` int(11) DEFAULT NULL,
  `SEXRESP` text,
  `SEXRESP_2` text,
  `CATEGORY_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `EMPLOYERS`
--

INSERT INTO `EMPLOYERS` (`ID`, `USERNAME`, `PASSWORD_HASH`, `EMPLOYER_NAME`, `CONTACT_NAME`, `CONTACT_NAME_2`, `PHONE`, `PHONEHASH`, `COUNTRY`, `PROVINCE`, `CITY`, `ADDRESS`, `POSTAL_CODE`, `EMAIL`, `NOTE`, `NOTE_2`, `NEQ`, `INACTIVE`, `WEB_ADDRESS`, `VISIBLE`, `SEXRESP`, `SEXRESP_2`, `CATEGORY_ID`) VALUES
(1, '', '$2y$10$LZmyIRu/W3hEoOMioe/ap.w/Nf60/MvWD9ndzeueoKQyxa29DGG0m', 'Employeur Blitz', NULL, NULL, NULL, '5813834747', NULL, 'Québec', 'Jonquière', '3480 rue de la reherche', 'G7X0L1', NULL, 'Test Employeur', NULL, NULL, 0, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `EMPLOYERS_CAT`
--

CREATE TABLE `EMPLOYERS_CAT` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `PROGRAM_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `EMPLOYERS_CAT`
--

INSERT INTO `EMPLOYERS_CAT` (`ID`, `NAME`, `PROGRAM_ID`) VALUES
(1, 'Boutique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `EMPLOYERS_CAT_PROGRAMS`
--

CREATE TABLE `EMPLOYERS_CAT_PROGRAMS` (
  `ID` int(11) NOT NULL,
  `CATEGORY_ID` int(11) NOT NULL,
  `PROGRAM_ID` int(11) NOT NULL,
  `EMPLOYER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `EMPLOYERS_CAT_PROGRAMS`
--

INSERT INTO `EMPLOYERS_CAT_PROGRAMS` (`ID`, `CATEGORY_ID`, `PROGRAM_ID`, `EMPLOYER_ID`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `EMPLOYER_CONTACTS`
--

CREATE TABLE `EMPLOYER_CONTACTS` (
  `ID` int(11) NOT NULL,
  `EMPLOYER_ID` int(11) NOT NULL,
  `CONTACT_NAME` text NOT NULL,
  `CONTACT_PHONE` text,
  `CONTACT_EMAIL` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `EMPLOYER_CONTACTS`
--

INSERT INTO `EMPLOYER_CONTACTS` (`ID`, `EMPLOYER_ID`, `CONTACT_NAME`, `CONTACT_PHONE`, `CONTACT_EMAIL`) VALUES
(1, 1, 'Jean-Paul Smith', '5813834747', 'jpsmith@blitzmedia.io');

-- --------------------------------------------------------

--
-- Structure de la table `EMPLOYER_PROGRAMS`
--

CREATE TABLE `EMPLOYER_PROGRAMS` (
  `ID` int(11) NOT NULL,
  `EMPLOYER_ID` int(11) NOT NULL,
  `PROGRAM_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `EMPLOYER_PROGRAMS`
--

INSERT INTO `EMPLOYER_PROGRAMS` (`ID`, `EMPLOYER_ID`, `PROGRAM_ID`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `FOLLOWUPS`
--

CREATE TABLE `FOLLOWUPS` (
  `ID` int(11) NOT NULL,
  `INTERNSHIP_ID` int(11) DEFAULT NULL,
  `DESCRIPTION` text,
  `CREATOR_ID` int(11) DEFAULT NULL,
  `CREATOR_TYPE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `FORMS`
--

CREATE TABLE `FORMS` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(500) NOT NULL,
  `DATA` text NOT NULL,
  `PROGRAM_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `INTERNSHIPS`
--

CREATE TABLE `INTERNSHIPS` (
  `ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) DEFAULT NULL,
  `EMPLOYER_ID` int(11) DEFAULT NULL,
  `PROGRAM_ID` int(11) DEFAULT NULL,
  `EMPLOYER_CONTACT_ID` int(11) DEFAULT NULL,
  `DATE_START` date DEFAULT NULL,
  `DATE_END` date DEFAULT NULL,
  `DESCRIPTION` text,
  `INACTIVE` tinyint(1) DEFAULT '0',
  `SCHEDULE` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `INTERNSHIPS`
--

INSERT INTO `INTERNSHIPS` (`ID`, `STUDENT_ID`, `EMPLOYER_ID`, `PROGRAM_ID`, `EMPLOYER_CONTACT_ID`, `DATE_START`, `DATE_END`, `DESCRIPTION`, `INACTIVE`, `SCHEDULE`) VALUES
(1, 1, 1, 1, 1, '2023-01-01', '2023-03-01', NULL, 0, '[{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":\"\"},{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":\"\"}]'),
(2, 1, 1, 1, 1, '2022-06-13', '2022-06-17', NULL, 0, '[{\"DAY\":\"LUNDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"MARDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"MERCREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"JEUDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"VENDREDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"TOTAL\":\"\"},{\"DAY\":\"SAMEDI\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"off\",\"TOTAL\":\"\"},{\"DAY\":\"DIMANCHE\",\"FROM_AM\":\"8:00\",\"TO_AM\":\"12:00\",\"FROM_PM\":\"13:00\",\"TO_PM\":\"16:00\",\"CLOSED\":\"on\",\"TOTAL\":\"\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `LETTERS`
--

CREATE TABLE `LETTERS` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `DESC` varchar(255) NOT NULL,
  `CONTENT` text NOT NULL,
  `FAVORITE` tinyint(4) NOT NULL,
  `PROGRAM_ID` int(11) NOT NULL DEFAULT '0',
  `DISABLE` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `LOGS`
--

CREATE TABLE `LOGS` (
  `ID` int(11) NOT NULL,
  `INTERNSHIP_ID` int(11) DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `DESCRIPTION` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `MESSAGES`
--

CREATE TABLE `MESSAGES` (
  `ID` int(11) NOT NULL,
  `INTERNSHIP_ID` int(11) DEFAULT NULL,
  `TITLE` text NOT NULL,
  `DESCRIPTION` text,
  `TO_ID` int(11) DEFAULT NULL,
  `TO_TYPE` int(11) DEFAULT NULL COMMENT '1 = Étudiant 2 = Professeur 3 = Employeur',
  `FROM_ID` int(11) DEFAULT NULL,
  `FROM_TYPE` int(11) DEFAULT NULL COMMENT '1 = Étudiant 2 = Professeur 3 = Employeur',
  `DATE` datetime NOT NULL,
  `READ` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `NOTES`
--

CREATE TABLE `NOTES` (
  `ID` int(11) NOT NULL,
  `INTERNSHIP_ID` int(11) DEFAULT NULL,
  `DESCRIPTION` text,
  `CREATOR_ID` int(11) DEFAULT NULL,
  `CREATOR_TYPE` int(11) DEFAULT NULL,
  `DATE` datetime NOT NULL,
  `PRIVATE` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `OBLIGATIONS`
--

CREATE TABLE `OBLIGATIONS` (
  `ID` int(11) NOT NULL,
  `INTERNSHIP_ID` int(11) DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `DOCUMENT_ID` int(11) DEFAULT NULL,
  `USER_ID` int(11) NOT NULL,
  `USER_TYPE` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '0',
  `SIGNATURE` text,
  `FORM_DATA` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `OPTIONS`
--

CREATE TABLE `OPTIONS` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(64) DEFAULT NULL,
  `VALUE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `OPTIONS`
--

INSERT INTO `OPTIONS` (`ID`, `NAME`, `VALUE`) VALUES
(1, '_SCHOOL_NAME', 'École Blitz Media'),
(2, '_SCHOOL_ADDRESS', '3480D RUE DE LA RECHERCHE<br>SAGUENAY QC<br>G7X 0L1'),
(3, '_SMTP_HOST', 'mail.blitzmedia.io'),
(4, '_SMTP_PORT', '25'),
(5, '_SMTP_USER', 'user@blitzmedia.io'),
(6, '_SMTP_PASS', '1234'),
(7, '_ADOBE_KEY', 'e9103ee23ff2428599d4ace4d17e493f');

-- --------------------------------------------------------

--
-- Structure de la table `PROGRAMS`
--

CREATE TABLE `PROGRAMS` (
  `ID` int(11) NOT NULL,
  `GUID` text,
  `NAME` text,
  `PAVILION` varchar(200) DEFAULT 'BEGIN',
  `LDAP_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `PROGRAMS`
--

INSERT INTO `PROGRAMS` (`ID`, `GUID`, `NAME`, `PAVILION`, `LDAP_ID`) VALUES
(1, NULL, 'Programme Blitz', 'Jonquiere', 0);

-- --------------------------------------------------------

--
-- Structure de la table `SETTINGS`
--

CREATE TABLE `SETTINGS` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(500) NOT NULL,
  `VALUE` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `SETTINGS`
--

INSERT INTO `SETTINGS` (`ID`, `NAME`, `VALUE`) VALUES
(1, 'year_from', '2018'),
(2, 'year_to', '2019');

-- --------------------------------------------------------

--
-- Structure de la table `STUDENTS`
--

CREATE TABLE `STUDENTS` (
  `ID` int(11) NOT NULL,
  `GUID` text,
  `NAME` text,
  `EMAIL_CS` text,
  `PASSWORD_HASH` text NOT NULL,
  `SCHOOL` text NOT NULL,
  `PROGRAM_ID` int(11) DEFAULT NULL,
  `TEACHER_ID` int(11) DEFAULT NULL,
  `GROUP_ID` varchar(255) NOT NULL,
  `ARCHIVE` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `STUDENTS`
--

INSERT INTO `STUDENTS` (`ID`, `GUID`, `NAME`, `EMAIL_CS`, `PASSWORD_HASH`, `SCHOOL`, `PROGRAM_ID`, `TEACHER_ID`, `GROUP_ID`, `ARCHIVE`) VALUES
(1, NULL, 'Etudiant Blitz', 'student@blitzmedia.io', '$2y$10$gM3zhjZOQIp7SsNDKfsLjO4DoTneWm5Sb7/8Wby7lN.dCwWlCIUj6', 'Blitz Media', 1, 1, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `TEACHERS`
--

CREATE TABLE `TEACHERS` (
  `ID` int(11) NOT NULL,
  `GUID` text,
  `NAME` text,
  `EMAIL_CS` text,
  `PASSWORD_HASH` text NOT NULL,
  `DISABLED` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `TEACHERS`
--

INSERT INTO `TEACHERS` (`ID`, `GUID`, `NAME`, `EMAIL_CS`, `PASSWORD_HASH`, `DISABLED`) VALUES
(1, NULL, 'Enseignant Blitz', 'teacher@blitzmedia.io', '$2y$10$gM3zhjZOQIp7SsNDKfsLjO4DoTneWm5Sb7/8Wby7lN.dCwWlCIUj6', 0);

-- --------------------------------------------------------

--
-- Structure de la table `TEACHER_PROGRAMS`
--

CREATE TABLE `TEACHER_PROGRAMS` (
  `ID` int(11) NOT NULL,
  `TEACHER_ID` int(11) NOT NULL,
  `PROGRAM_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `TEACHER_PROGRAMS`
--

INSERT INTO `TEACHER_PROGRAMS` (`ID`, `TEACHER_ID`, `PROGRAM_ID`) VALUES
(1, 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ABSENCES`
--
ALTER TABLE `ABSENCES`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ADMINISTRATORS`
--
ALTER TABLE `ADMINISTRATORS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `BLOCKS`
--
ALTER TABLE `BLOCKS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `BLOCK_SCHEDULES`
--
ALTER TABLE `BLOCK_SCHEDULES`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `CREATOR_TYPES`
--
ALTER TABLE `CREATOR_TYPES`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `DOCUMENTS`
--
ALTER TABLE `DOCUMENTS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `DOCUMENT_PDF_PROG`
--
ALTER TABLE `DOCUMENT_PDF_PROG`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `DOCUMENT_PDF_STAGE`
--
ALTER TABLE `DOCUMENT_PDF_STAGE`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `EMPLOYERS`
--
ALTER TABLE `EMPLOYERS`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `emp__phone_unique` (`PHONE`);

--
-- Index pour la table `EMPLOYERS_CAT`
--
ALTER TABLE `EMPLOYERS_CAT`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index pour la table `EMPLOYERS_CAT_PROGRAMS`
--
ALTER TABLE `EMPLOYERS_CAT_PROGRAMS`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index pour la table `EMPLOYER_CONTACTS`
--
ALTER TABLE `EMPLOYER_CONTACTS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `EMPLOYER_PROGRAMS`
--
ALTER TABLE `EMPLOYER_PROGRAMS`
  ADD PRIMARY KEY (`EMPLOYER_ID`,`PROGRAM_ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `PROGRAM_ID` (`PROGRAM_ID`);

--
-- Index pour la table `FOLLOWUPS`
--
ALTER TABLE `FOLLOWUPS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `FORMS`
--
ALTER TABLE `FORMS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `INTERNSHIPS`
--
ALTER TABLE `INTERNSHIPS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `LETTERS`
--
ALTER TABLE `LETTERS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `LOGS`
--
ALTER TABLE `LOGS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `MESSAGES`
--
ALTER TABLE `MESSAGES`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `NOTES`
--
ALTER TABLE `NOTES`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `OBLIGATIONS`
--
ALTER TABLE `OBLIGATIONS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `OPTIONS`
--
ALTER TABLE `OPTIONS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `PROGRAMS`
--
ALTER TABLE `PROGRAMS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `SETTINGS`
--
ALTER TABLE `SETTINGS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `STUDENTS`
--
ALTER TABLE `STUDENTS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `TEACHERS`
--
ALTER TABLE `TEACHERS`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `TEACHER_PROGRAMS`
--
ALTER TABLE `TEACHER_PROGRAMS`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ABSENCES`
--
ALTER TABLE `ABSENCES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ADMINISTRATORS`
--
ALTER TABLE `ADMINISTRATORS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `BLOCKS`
--
ALTER TABLE `BLOCKS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `BLOCK_SCHEDULES`
--
ALTER TABLE `BLOCK_SCHEDULES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `CREATOR_TYPES`
--
ALTER TABLE `CREATOR_TYPES`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `DOCUMENTS`
--
ALTER TABLE `DOCUMENTS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `DOCUMENT_PDF_PROG`
--
ALTER TABLE `DOCUMENT_PDF_PROG`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `DOCUMENT_PDF_STAGE`
--
ALTER TABLE `DOCUMENT_PDF_STAGE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `EMPLOYERS`
--
ALTER TABLE `EMPLOYERS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `EMPLOYERS_CAT`
--
ALTER TABLE `EMPLOYERS_CAT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `EMPLOYERS_CAT_PROGRAMS`
--
ALTER TABLE `EMPLOYERS_CAT_PROGRAMS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `EMPLOYER_CONTACTS`
--
ALTER TABLE `EMPLOYER_CONTACTS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `EMPLOYER_PROGRAMS`
--
ALTER TABLE `EMPLOYER_PROGRAMS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `FOLLOWUPS`
--
ALTER TABLE `FOLLOWUPS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `FORMS`
--
ALTER TABLE `FORMS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `INTERNSHIPS`
--
ALTER TABLE `INTERNSHIPS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `LETTERS`
--
ALTER TABLE `LETTERS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `LOGS`
--
ALTER TABLE `LOGS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `MESSAGES`
--
ALTER TABLE `MESSAGES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `NOTES`
--
ALTER TABLE `NOTES`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `OBLIGATIONS`
--
ALTER TABLE `OBLIGATIONS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `OPTIONS`
--
ALTER TABLE `OPTIONS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `PROGRAMS`
--
ALTER TABLE `PROGRAMS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `SETTINGS`
--
ALTER TABLE `SETTINGS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `STUDENTS`
--
ALTER TABLE `STUDENTS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `TEACHERS`
--
ALTER TABLE `TEACHERS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `TEACHER_PROGRAMS`
--
ALTER TABLE `TEACHER_PROGRAMS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
