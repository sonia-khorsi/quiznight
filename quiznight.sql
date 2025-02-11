-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 11 fév. 2025 à 10:36
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiznight`
--

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `thème` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `questions` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `choix de réponses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `réponses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre d'essais` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id`, `thème`, `questions`, `choix de réponses`, `réponses`, `nombre d'essais`) VALUES
(1, 'cinema', 'Qui à réalisé Inception ?', 'Christopher Nolan, Steven Spielberg, Quentin Tarantino', 'Christopher Nolan', 0),
(2, 'cinema', 'Quel film a remporté l’Oscar du meilleur film en 2020 ?', 'Parasite, 1917, Joker\r\n', 'Parasite', 0),
(3, 'musique', 'Quel est le nom de l\'album le plus vendu de Michael Jackson ?', ' Thriller, Bad, Dangerous', 'Thriller', 0),
(4, 'musique', ' Qui a chanté \"Like a Rolling Stone\"?', 'Bob Dylan, Elvis Presley, John Lennon', 'Bob Dylan', 0),
(5, 'football', 'Quel pays a remporté la Coupe du Monde de football en 2018 ?', 'France, Brésil, Allemagne', 'France', 0),
(6, 'football', 'Qui est le meilleur buteur de l\'histoire de la Ligue des Champions ?', 'Cristiano Ronaldo, Lionel Messi, Raul', 'Cristiano Ronaldo', 0),
(7, 'animaux', 'Quel est l\'animal le plus rapide ?', 'Guépard, Aigle royal, Autruche', 'Guépard', 0),
(8, 'animaux', 'Combien de cœurs a un poulpe ?', '2,3,4', '3', 0),
(9, 'art', 'Qui a peint \"La Joconde\" ?', 'Leonardo da Vinci, Pablo Picasso, Vincent van Gogh', 'Leonardo da Vinci', 0),
(10, 'art', 'Quel mouvement artistique est associé à Salvador Dali?', 'Surréalisme, Cubisme, Impressionnisme', 'Surréalisme', 0),
(11, 'manga', 'Qui est le créateur de \"Naruto\"?', 'Masashi Kishimoto, Eiichiro Oda, Akira Toriyama', 'Masashi Kishimoto', 0),
(12, 'manga', 'Dans \"One Piece\", quel est le rêve de Luffy ?', 'Devenir le roi des pirates, Trouver le Trésor, Devenir le plus fort', 'Devenir le roi des pirates ', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom _utilisateur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mot _de _passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `droits_ d'administrateur` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom _utilisateur`, `mot _de _passe`, `droits_ d'administrateur`) VALUES
(1, 'sonia khorsi', 'sonia-admin', 0),
(2, 'anissa ourdjini', 'anissa-admin', 0),
(3, 'réda yahyaoui', 'réda-admin', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
