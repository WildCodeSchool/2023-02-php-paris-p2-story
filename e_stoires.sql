-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 26 avr. 2023 à 08:00
-- Version du serveur : 8.0.32
-- Version de PHP : 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e_stoires`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
--

CREATE TABLE `chapters` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `chapter_number` int NOT NULL,
  `stories_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `readerships`
--

CREATE TABLE `readerships` (
  `id` int NOT NULL,
  `age` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `readerships`
--

INSERT INTO `readerships` (`id`, `age`) VALUES
(1, '12-18 ans'),
(2, '18 +');

-- --------------------------------------------------------

--
-- Structure de la table `stories`
--

CREATE TABLE `stories` (
  `id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `nbchapters` int DEFAULT NULL,
  `ended` tinyint(1) DEFAULT NULL,
  `description` text,
  `picture` text,
  `users_id` int DEFAULT NULL,
  `types_id` int DEFAULT NULL,
  `readerships_id` int DEFAULT NULL,
  `pseudo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stories`
--

INSERT INTO `stories` (`id`, `title`, `nbchapters`, `ended`, `description`, `picture`, `users_id`, `types_id`, `readerships_id`, `pseudo`) VALUES
(1, 'Test base de données', 3, 0, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', NULL, 1, 1, 2, '');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int NOT NULL,
  `types_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `types_name`) VALUES
(1, 'Science-Fiction'),
(2, 'Romance'),
(5, 'Policier'),
(6, 'Aventure'),
(7, 'Fantastique');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `author` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `author`) VALUES
(1, 'user 1'),
(2, 'user 2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `readerships`
--
ALTER TABLE `readerships`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_stories` (`users_id`),
  ADD KEY `fk_types_stories` (`types_id`),
  ADD KEY `fk_readerships_stories` (`readerships_id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `readerships`
--
ALTER TABLE `readerships`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `fk_readerships_stories` FOREIGN KEY (`readerships_id`) REFERENCES `readerships` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_types_stories` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_users_stories` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
