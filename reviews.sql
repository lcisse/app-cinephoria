-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 06 nov. 2024 à 22:11
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
-- Base de données : `lc_cinephoria`
--

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `review_text` text,
  `rating` int DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `submission_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `movie_id`, `customer_id`, `review_text`, `rating`, `status`, `submission_date`) VALUES
(1, 6, 1, 'Qui molestiae asperiores dolores consectetur omnis. Quia modi est eos aut atque et minima nesciunt. Aut provident consequuntur odit earum. Iure voluptatem quibusdam voluptatem minus eos deleniti.', 2, 'approved', '2024-07-05 16:13:03'),
(2, 2, 2, 'Autem blanditiis velit ipsa et rerum ipsa. In quam natus sed.', 3, 'pending', '2024-01-19 18:15:17'),
(3, 9, 3, 'Non quo ipsa facilis ut qui. Quidem vel aut autem. Explicabo iure vero repellendus.', 1, 'approved', '2024-03-15 11:05:18'),
(4, 6, 4, 'Rem porro saepe voluptatem ducimus omnis. Porro reiciendis et non aspernatur velit. Qui odio alias autem et qui accusantium.', 3, 'pending', '2024-08-29 03:59:09'),
(5, 10, 5, 'Eos omnis tempora assumenda sapiente perspiciatis esse. Sunt blanditiis aliquid aspernatur voluptatem. Fuga neque corporis consequuntur consequuntur eaque delectus.', 5, 'approved', '2024-07-20 06:26:06'),
(6, 10, 5, 'Saepe facere beatae ut fuga repellendus. Culpa laudantium impedit beatae est id quis sequi. Illum consequatur harum labore accusamus est ea neque.', 2, 'pending', '2024-06-06 18:14:30'),
(7, 7, 6, 'Similique expedita a ab ab. Ut ut nihil dolore.', 2, 'approved', '2024-01-03 14:40:18'),
(9, 10, 8, 'Harum dolore commodi molestias dolore non et. Neque vitae voluptas dolorem veniam impedit vel id. Ea expedita adipisci dolore excepturi suscipit atque odit.', 2, 'approved', '2024-07-09 09:48:08'),
(10, 7, 9, 'Enim error sed tempore aliquid unde. Deserunt eum aliquid facere perferendis et possimus voluptatum. Et laborum facere delectus. Qui nulla voluptatem excepturi perspiciatis.', 2, 'approved', '2024-08-19 21:24:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
