-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2023 at 12:32 PM
-- Server version: 8.0.32
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_stoire`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `story_id` int NOT NULL,
  `pseudo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`id`, `title`, `story_id`, `pseudo`, `content`, `created_at`, `author_id`) VALUES
(13, 'L\'organisation', 10, 'Erika', 'Pour les 80 ans de leur mamie Juliette, Anna, Léa et Camille souhaitent lui organiser une belle surprise. \r\nElles ont décidé de cuisiner un repas digne du chef mamie Mathilde.', '2023-05-10 11:31:34', 1),
(14, 'A Paris', 11, 'Estelle', 'Paris, boulevard Montparnasse à l’Urban Gallery.\r\nSaverio Agostino, célèbre peintre italien, est de passage dans la capitale pour exposer ses œuvres d’art. Trente tableaux seront examinés pendant une semaine par les peintres amateurs, les touristes, les acheteurs...\r\nIl est 18 h lorsqu’il aperçut cette jeune femme à la chevelure rousse devant le « Memoria », célèbre tableau cher à son cœur, car il représente les bons moments qu’il a passés auprès de sa mère resté en Italie.', '2023-05-10 11:39:10', 1),
(15, 'Le départ', 11, 'Esther', 'Il voulut lui parler, mais ses pas furent régulièrement stoppés par le public venu rencontrer le peintre italien.\r\nLorsqu’il arriva devant le « Memoria », elle n’était plus là.\r\nIl chercha la jeune femme entre ses tableaux mais elle avait disparu.', '2023-05-10 11:40:55', 1),
(16, 'What is it?', 12, 'Estelle', 'What is it?\r\nChapitre 1\r\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2023-05-10 11:47:14', 1),
(17, 'Pico is...', 12, 'Léa', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2023-05-10 11:50:04', 1),
(18, 'I don\'t like pico', 12, 'Vincent', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2023-05-10 11:51:38', 1),
(19, 'I love pico !', 12, 'Esther', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2023-05-10 11:52:20', 1),
(20, 'Je m\'éclate avec SQL', 13, 'Vincent Pendragon', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', '2023-05-10 12:02:01', 1),
(21, 'Mes boucles', 14, 'Ester', 'Qu\'est-ce qu\'un type de boucles ? Habituellement les types de cheveux bouclés sont répartis en trois groupes principaux : ondulé, bouclé et crépu.', '2023-05-10 12:11:30', 1),
(22, 'Mon style', 14, 'Lionel', 'Qu\'est-ce qu\'un type de boucles ? Habituellement les types de cheveux bouclés sont répartis en trois groupes principaux : ondulé, bouclé et crépu.', '2023-05-10 12:12:56', 1),
(23, 'La boîte', 15, 'Erika', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat nam at lectus urna duis convallis convallis tellus. Feugiat sed lectus vestibulum mattis. Varius morbi enim nunc faucibus a pellentesque sit amet. Diam vel quam elementum pulvinar etiam non.', '2023-05-10 12:22:48', 1),
(24, 'Les mots', 15, 'Erika', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat nam at lectus urna duis convallis convallis tellus. Feugiat sed lectus vestibulum mattis. Varius morbi enim nunc faucibus a pellentesque sit amet. Diam vel quam elementum pulvinar etiam non.', '2023-05-10 12:23:37', 1),
(25, 'The PHP', 16, 'Micka', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat nam at lectus urna duis convallis convallis tellus. Feugiat sed lectus vestibulum mattis. Varius morbi enim nunc faucibus a pellentesque sit amet. Diam vel quam elementum pulvinar etiam non.', '2023-05-10 12:25:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE `story` (
  `id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `nbchapter` int DEFAULT NULL,
  `ended` tinyint(1) DEFAULT NULL,
  `description` text,
  `picture` text,
  `creator_id` int DEFAULT NULL,
  `pseudo` varchar(100) NOT NULL,
  `genre` text NOT NULL,
  `lectorat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`id`, `title`, `nbchapter`, `ended`, `description`, `picture`, `creator_id`, `pseudo`, `genre`, `lectorat`) VALUES
(10, 'On est des quiches', 3, NULL, '', '645b643a71e5e2.32094852.jpg', 1, 'Erika', 'fantastique', '12-18'),
(11, 'La tour Eiffel en Italie', 2, 1, 'Paris, boulevard Montparnasse à l’Urban Gallery. \r\nSaverio Agostino, célèbre peintre italien, est de passage dans la capitale pour exposer ses œuvres d’art.', '645b65ea1356e6.15262742.jpg', 1, 'Estelle', 'romance', '18+'),
(12, 'Vive Pico', 4, 1, 'What is it? Chapitre 1 At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', '645b67b67dfbf9.78995604.jpg', 1, 'Léa', 'aventure', '18+'),
(13, 'Base de données & co', 1, 1, 'e SQL (Structured Query Language) est un langage permettant de communiquer avec une base de données. Ce langage informatique est notamment très utilisé par les développeurs web pour communiquer avec les données d’un site web.', '645b6b362cfa16.05505724.jpg', 1, 'Vincent', 'romance', '12-18'),
(14, 'Les boucles ma passion', 2, 1, 'Les boucles de chaussures sont des accessoires de mode portés par les hommes et les femmes du milieu du xviie siècle au xixe siècle, en passant par le xviiie siècle.', '645b6da9a785e4.86376945.jpg', 1, 'Ester', 'aventure', '12-18'),
(15, 'La boîte aux mots interdits', 2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '645b6f7b226151.96245056.jpg', 1, 'Erika', 'scienceFiction', '12-18'),
(16, 'PHP forever', 3, NULL, 'PHP (officiellement, ce sigle est un acronyme récursif pour PHP Hypertext Preprocessor) est un langage de scripts généraliste et Open Source, spécialement conçu pour le développement d\'applications web. Il peut être intégré facilement au HTML.', '645b7106897063.34672367.jpg', 1, 'Micka', 'aventure', '12-18'),
(18, 'La violette ma passion', 3, NULL, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', '645b74ad768b14.76753603.jpg', 1, 'Loic', 'aventure', '12-18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `pseudo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`) VALUES
(1, 'Wilder1', 'wilder1'),
(2, 'Wilder2', 'wilder2'),
(5, 'Wilder3', 'wilder3'),
(6, 'Wilder4', 'wilder4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liaison5` (`story_id`);

--
-- Indexes for table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_stories` (`creator_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `liaison5` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `creator_id` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;