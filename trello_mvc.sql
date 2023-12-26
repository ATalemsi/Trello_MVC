-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 26 déc. 2023 à 23:39
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `trello_mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`),
  KEY `created_by` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `created_by`, `created_at`) VALUES
(1, 'TRELLO_MVC', 5, '2023-12-26 22:08:25'),
(2, 'MVC_POO', 4, '2023-12-26 22:09:25');

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) NOT NULL,
  `debut_date` date DEFAULT NULL,
  `fin_date` date DEFAULT NULL,
  `project_id` int NOT NULL,
  `create_by` int DEFAULT NULL,
  `status` varchar(50) DEFAULT 'To Do',
  `Archive` tinyint NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `project_id` (`project_id`),
  KEY `create_by` (`create_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `Phone` varchar(60) NOT NULL,
  `user_role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `Nom`, `Prenom`, `email`, `password_hash`, `Phone`, `user_role`) VALUES
(3, 'John', 'doe', 'johndoe@gmail.com', '$2y$10$LQhAWb.XTVmaTxfNEuWhKueSOtv6aQjN0jtn04vmFukdrWEzuh6.O', '0325457595', 'user'),
(4, 'abdellah', 'Talemsi', 'mohamadtalemsi@gmail.com', '$2y$10$P6hQ2OmrzZ/S9dEamiw3EeBXTvwJGL8KJzvJUOs5uMH11jUFPIrCC', '0623251245', 'user'),
(5, 'zakaria', 'loulida', 'zakarialoulida@gmail.com', '$2y$10$65ExWae3legla.sX00AR3.9hZwN2fNgYiXJylVkRTgCHb/m4fbHoa', '0625457895', 'user'),
(6, 'fitahy', 'mohamed', 'fitahymohamed@gmail.com', '$2y$10$bUSbaWCg4zUzIZ4unaSL2Oyec.3Ityb8dMNucUKDh.sOz9giWpLS.', '0623254595', 'user'),
(7, 'samire', 'hakcton', 'samirehakathon@gmail.com', '$2y$10$bhLmAniKogo65jnvCVsGzutKWdjSuhU96MZDf2xmUHvYWogsvZqPy', '0625458795', 'user'),
(8, 'abdellah', 'Talemsi', 'taleabdellah@gmail.com', '$2y$10$ckLV4MghW40Mdo49qnjPSu1mDEjfYeSqIC5nwWo6eRI2x/n.OVTW6', '0625232548', 'user'),
(9, 'naouari', 'karim', 'naouarikarim@gmail.com', '$2y$10$Z8cLNfn2G/qybk.MpukPeujfZbqoxN1PGfI2mSsmmdw8ty3jl26mK', '0625458575', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
