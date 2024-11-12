-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 nov. 2024 à 15:37
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
-- Structure de la table `cinemas`
--

DROP TABLE IF EXISTS `cinemas`;
CREATE TABLE IF NOT EXISTS `cinemas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cinema_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cinemas`
--

INSERT INTO `cinemas` (`id`, `cinema_name`, `location`) VALUES
(1, 'nantes', 'nantes'),
(2, 'bordeaux', 'bordeaux'),
(3, 'paris', 'paris'),
(4, 'liege', 'liege'),
(5, 'charleroi', 'charleroi'),
(6, 'lille', 'lille'),
(7, 'toulouse', 'toulouse'),
(26, 'Bashirian PLC', 'Pollichshire'),
(27, 'Sporer and Sons', 'Hammesburgh'),
(28, 'Walter, Cruickshank and Hettinger', 'Port Guiseppe'),
(29, 'Yundt-Kilback', 'Dickiview'),
(30, 'Hyatt and Sons', 'North Percivalmouth'),
(31, 'Nolan PLC', 'New Wendy'),
(32, 'Schuster Inc', 'Jerodfurt'),
(33, 'Daugherty Ltd', 'South Britney'),
(34, 'Bogan LLC', 'Dachstad'),
(35, 'Homenick-Langworth', 'Port Colbyville'),
(36, 'Roberts PLC', 'New Idellastad'),
(37, 'Considine and Sons', 'New Clotildefurt'),
(38, 'Dare-Pacocha', 'West Santinaside'),
(39, 'Schumm, Zemlak and Rau', 'West Stuart'),
(40, 'Marvin Group', 'Schusterstad'),
(41, 'Johnson-Feeney', 'North Lenoratown'),
(42, 'Hauck-Blick', 'New Macie'),
(43, 'Trantow and Sons', 'New Lacey'),
(44, 'Schultz PLC', 'Riceborough'),
(45, 'Johnson, Hessel and Greenholt', 'Robertoside'),
(46, 'Langworth-Konopelski', 'Port Robbieberg'),
(47, 'Jenkins, Fahey and Bogan', 'North Jaylanberg'),
(48, 'Reilly-Funk', 'Lemkestad'),
(49, 'Zboncak, Kunde and Dooley', 'Langoshton'),
(50, 'Wyman PLC', 'Port Eveside');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `genre_name`) VALUES
(1, 'Action'),
(2, 'Comédie'),
(3, 'Drame'),
(4, 'Thriller'),
(5, 'Science-fiction'),
(6, 'Horreur'),
(7, 'Comédie-dramatique'),
(26, 'Comédie'),
(27, 'Drame'),
(28, 'Thriller'),
(29, 'Science-fiction'),
(30, 'Horreur'),
(31, 'Action'),
(32, 'Comédie'),
(33, 'Drame'),
(34, 'Thriller'),
(35, 'Science-fiction'),
(36, 'Horreur'),
(37, 'Action'),
(38, 'Comédie'),
(39, 'Drame'),
(40, 'Thriller'),
(41, 'Science-fiction'),
(42, 'Horreur'),
(43, 'Action'),
(44, 'Comédie'),
(45, 'Drame'),
(46, 'Thriller'),
(47, 'Science-fiction'),
(48, 'Horreur'),
(49, 'Action'),
(50, 'Comédie'),
(51, 'Drame'),
(52, 'Thriller'),
(53, 'Science-fiction'),
(54, 'Horreur'),
(55, 'Action'),
(56, 'Comédie'),
(57, 'Drame'),
(58, 'Thriller'),
(59, 'Science-fiction'),
(60, 'Horreur');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `age_minimum` int DEFAULT NULL,
  `favorite` tinyint(1) DEFAULT '0',
  `poster` varchar(255) NOT NULL,
  `publication_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `age_minimum`, `favorite`, `poster`, `publication_date`) VALUES
(1, 'Blanditiis fuga eos facilis.', 'Atque sit alias omnis et voluptatem debitis distinctio. In molestias aperiam amet corrupti aut ratione. Aliquid quo tempora saepe reiciendis at. Fugit fuga quis cumque est doloribus nisi quod.', 0, 1, 'https://via.placeholder.com/200x300.png/003355?text=movies+distinctio', NULL),
(2, 'Repellat molestiae ullam.', 'Quis saepe adipisci qui illum. Aperiam illum provident officiis ut. Sequi quis delectus rem possimus unde enim. Cumque dolorem quasi quia earum minus.', 18, 0, 'https://via.placeholder.com/200x300.png/00aa77?text=movies+explicabo', NULL),
(3, 'Aut magnam minima id.', 'Eius qui sunt qui aut nulla. Vel doloribus et quia est repellendus non sed reprehenderit. Deleniti ut possimus sed eum. Distinctio dolorum quis eveniet blanditiis quae quia vero.', 0, 0, 'https://via.placeholder.com/200x300.png/0011aa?text=movies+facilis', NULL),
(4, 'Sed facere eum commodi.', 'Odit dolores quibusdam sit. Aut voluptatum qui exercitationem omnis minus sint facilis. Adipisci officia ratione qui corporis ut culpa quia.', 7, 0, 'https://via.placeholder.com/200x300.png/004477?text=movies+repudiandae', NULL),
(5, 'Omnis quia laudantium repudiandae.', 'Id delectus ducimus illum quo numquam alias voluptas. Architecto repellendus voluptates earum reprehenderit. Illum aut quia earum magnam aut et molestiae.', 15, 0, 'https://via.placeholder.com/200x300.png/009922?text=movies+consequatur', NULL),
(6, 'Expedita ea sit.', 'Totam repudiandae in ut sunt cupiditate commodi. Nihil voluptatem nulla et quia nihil. Nostrum itaque quo occaecati. Ex beatae nulla sit nobis aut. Veniam necessitatibus dignissimos temporibus sint itaque quas.', 16, 1, 'https://via.placeholder.com/200x300.png/00cc55?text=movies+cupiditate', NULL),
(7, 'Blanditiis hic dolorem.', 'Quae dolores amet architecto ut velit ullam eveniet. Sit ipsa recusandae qui nobis nemo. Est enim tenetur ut at fugiat aliquam. Accusantium soluta repellendus repudiandae numquam.', 17, 1, 'https://via.placeholder.com/200x300.png/0099ff?text=movies+id', NULL),
(8, 'Sed occaecati eos omnis.', 'Omnis temporibus illo occaecati quod doloremque. Et eum ab laborum. Qui consequuntur doloribus qui ea.', 17, 0, 'https://via.placeholder.com/200x300.png/00eebb?text=movies+amet', NULL),
(9, 'Itaque dicta sint nam.', 'Libero quia voluptas fuga. In et error quidem hic. Suscipit sequi harum praesentium non. Hic aut voluptas alias corrupti quos qui eaque.', 15, 1, 'https://via.placeholder.com/200x300.png/0088bb?text=movies+consequatur', NULL),
(10, 'Molestiae iusto sit quisquam.', 'Accusantium architecto modi ut dignissimos. Fuga assumenda deserunt dolorem et aut. Possimus expedita ut suscipit nostrum.', 17, 1, 'https://via.placeholder.com/200x300.png/0033aa?text=movies+deserunt', '2024-11-01'),
(29, 'Il était une fois... Mommy', '(Re)découvrez dans les cinémas Pathé ce grand classique Xavier Dolan : Mommy ! La séance sera présentée par le journaliste et critique de cinéma Philippe Rouyer. Synopsis : Une veuve mono-parentale hérite de la garde de son fils, un adolescent TDAH impulsif et violent. Au coeur de leurs emportements et difficultés, ils tentent de joindre les deux bouts, notamment grâce à l’aide inattendue de l’énigmatique voisine d’en face, Kyla. Tous les trois, ils retrouvent une forme d’équilibre et, bientôt, d’espoir.', 12, 0, 'uploads/6712bceb6420c.jpg', '2024-11-01'),
(30, 'Smile 2', 'À l’aube d’une nouvelle tournée mondiale, la star de la pop Skye Riley (Naomi Scott) se met à vivre des événements aussi terrifiants qu’inexplicables. Submergée par la pression de la célébrité et devant un quotidien qui bascule de plus en plus dans l’horreur, Skye est forcée de se confronter à son passé obscur pour tenter de reprendre le contrôle de sa vie avant qu’il ne soit trop tard.', 16, 1, 'uploads/6712be0647dae.webp', '2024-11-01'),
(31, 'L\'Amour ouf', 'Les années 80, dans le nord de la France. Jackie et Clotaire grandissent entre les bancs du lycée et les docks du port. Elle étudie, il traîne. Et puis leurs destins se croisent et c\'est l\'amour fou. La vie s\'efforcera de les séparer mais rien n\'y fait, ces deux-là sont comme les deux ventricules du même cœur...', 0, 1, 'uploads/6712bed77b0ff.webp', '2024-11-04'),
(32, 'Grounded (Metropolitan Opera)', 'Jess est une pilote de chasse F-16 accomplie, jusqu\'à ce que sa grossesse l’oblige à faire des missions au sol : cibler les ennemis par le biais de drones depuis une caravane à Las Vegas. Cette situation semble idéale au départ car elle permet à Jess de concilier son sens du devoir et sa vie de famille. Si elle est à l’abri du danger physique, elle n’est en rien protégée du traumatisme psychologique de la guerre par procuration… ', 0, 0, 'uploads/6712bfd2387bc.webp', '2024-11-08'),
(33, 'C\'est le monde à l\'envers !', 'C\'est la crise, tout s\'arrête : plus d\'eau, plus d\'électricité, plus de réseau... Stanislas, homme d\'affaire parisien, perd tout y compris sa fortune. Lui qui déteste la campagne est contraint de partir se réfugier avec sa femme et son fils dans une des exploitations agricoles qu\'il avait acquise dans un but spéculatif. Mais à son arrivée, il se retrouve face à Patrick et sa famille, agriculteurs exploitants des lieux, qui n\'ont pas l\'intention de quitter la ferme... ', 0, 1, 'uploads/6712c0f4b941e.webp', '2024-11-09'),
(34, 'Barbès, Little Algérie', 'Malek, la quarantaine, célibataire, vient d’emménager à Montmartre et accueille bientôt chez lui son neveu Ryiad fraîchement arrivé d’Algérie. Ensemble ils découvrent Barbès, le quartier de la communauté algérienne, très vivant, malgré la crise sanitaire en cours. Ses rencontres avec les figures locales vont permettre à Malek de retrouver une part de lui qu’il avait enfouie, et de se réconcilier avec ses origines.', 0, 0, 'uploads/6712c185634e3.jpg', '2024-11-09'),
(35, 'Lee Miller', 'L’incroyable vie de LEE MILLER, ex-modèle pour Vogue et muse de Man Ray devenue l’une des premières femmes photographes de guerre. Partie sur le front et prête à tout pour témoigner des horreurs de la Seconde Guerre, elle a, par son courage et son refus des conventions, changé la façon de voir le monde.', 0, 1, 'uploads/6712c25c5c90f.jpg', '2024-11-09'),
(36, 'Transformers : le commencement', 'Le premier film d’animation Transformers depuis l’original de 1986. Ce film se déroule entièrement sur Cybertron et raconte comment deux frères d’armes, Optimus Prime et Megatron, sont devenus ennemis jurés, menant au plus grand des combats entre les Autobots et les Decepticons.', 0, 0, 'uploads/6712c3001ea04.webp', '2024-11-09'),
(37, 'Venom: The Last Dance', 'Dans VENOM: THE LAST DANCE, ultime opus de la trilogie, Tom Hardy est de retour sous les traits de Venom, l’un des personnages le plus complexes de l’univers Marvel. Eddie et Venom sont en cavale. Chacun est traqué par ses semblables et alors que l’étau se resserre, le duo doit prendre une décision dévastatrice qui annonce la conclusion des aventures d’Eddie & Venom.', 12, 0, 'uploads/6712c3b7e10cf.jpg', '2024-11-10'),
(38, '37 : l\'ombre et la proie', 'Le trajet anxiogène de Vincent, chauffeur-routier, menacé par une jeune femme enceinte qu’il a prise en stop. La passagère, au tempérament instable, détient un pistolet automatique et ordonne à Vincent de continuer à rouler sans s’arrêter. Quand il n’aura plus d’essence, elle le tuera.', 0, 0, 'uploads/6712c49507f24.jpg', '2024-11-10'),
(45, 'Gladiator II', 'L\'histoire de Lucius, le fils de Lucilla (Connie Nielsen dans Gladiator) et neveu de Commode (Joaquin Phoenix). Lucius est très admiratif du parcours de Maximus et devrait suivre ses traces..', 12, 1, 'uploads/6730e364a849f.webp', '2024-11-10');

-- --------------------------------------------------------

--
-- Structure de la table `movie_genres`
--

DROP TABLE IF EXISTS `movie_genres`;
CREATE TABLE IF NOT EXISTS `movie_genres` (
  `movie_id` int NOT NULL,
  `genre_id` int NOT NULL,
  PRIMARY KEY (`movie_id`,`genre_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `movie_genres`
--

INSERT INTO `movie_genres` (`movie_id`, `genre_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 4),
(4, 7),
(5, 1),
(5, 2),
(5, 3),
(5, 5),
(5, 6),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(7, 3),
(7, 4),
(8, 1),
(8, 2),
(8, 3),
(8, 5),
(8, 6),
(9, 1),
(9, 3),
(9, 5),
(9, 6),
(10, 1),
(10, 3),
(10, 4),
(10, 6),
(29, 3),
(30, 4),
(30, 6),
(31, 7),
(32, 1),
(33, 7),
(34, 3),
(35, 3),
(36, 5),
(37, 1),
(38, 3),
(38, 4),
(45, 1),
(45, 3);

-- --------------------------------------------------------

--
-- Structure de la table `movie_schedule`
--

DROP TABLE IF EXISTS `movie_schedule`;
CREATE TABLE IF NOT EXISTS `movie_schedule` (
  `movie_id` int NOT NULL,
  `cinema_id` int NOT NULL,
  `screening_day` date NOT NULL,
  PRIMARY KEY (`movie_id`,`cinema_id`,`screening_day`),
  KEY `cinema_id` (`cinema_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `movie_schedule`
--

INSERT INTO `movie_schedule` (`movie_id`, `cinema_id`, `screening_day`) VALUES
(1, 4, '1994-03-02'),
(1, 5, '2004-07-16'),
(1, 5, '2024-10-20'),
(2, 3, '2000-01-16'),
(2, 5, '1977-12-07'),
(2, 5, '1985-03-01'),
(3, 1, '2013-02-06'),
(3, 2, '2017-04-11'),
(3, 3, '2024-02-19'),
(3, 4, '2008-09-25'),
(3, 4, '2023-12-26'),
(3, 5, '1981-12-25'),
(4, 1, '2022-06-26'),
(4, 3, '1996-03-14'),
(4, 5, '1995-08-05'),
(4, 5, '2009-08-01'),
(5, 2, '1971-04-18'),
(5, 3, '2005-08-04'),
(5, 3, '2017-04-10'),
(5, 5, '1978-08-11'),
(5, 5, '2016-11-06'),
(5, 5, '2024-10-20'),
(6, 2, '2024-09-21'),
(6, 3, '2024-09-22'),
(6, 3, '2024-09-24'),
(6, 3, '2024-09-25'),
(6, 4, '1989-02-27'),
(7, 1, '2005-08-21'),
(7, 4, '1998-03-08'),
(7, 5, '1997-01-14'),
(7, 5, '2020-12-09'),
(7, 5, '2022-02-26'),
(8, 1, '1981-12-24'),
(8, 4, '1996-04-15'),
(9, 1, '1974-07-23'),
(9, 1, '2011-03-23'),
(9, 3, '2011-02-28'),
(9, 3, '2019-03-21'),
(10, 3, '2005-12-07'),
(10, 3, '2006-03-21'),
(36, 2, '2024-11-06'),
(38, 1, '2024-10-20'),
(38, 2, '2024-10-23'),
(38, 2, '2024-11-06'),
(38, 3, '2024-10-23'),
(38, 4, '2024-10-23');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `movie_id` int DEFAULT NULL,
  `screening_id` int DEFAULT NULL,
  `seats` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `reservation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('confirmed','pending','cancelled') DEFAULT 'pending',
  `qr_code` varchar(255) DEFAULT NULL,
  `scanned` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `movie_id` (`movie_id`),
  KEY `screening_id` (`screening_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `movie_id`, `screening_id`, `seats`, `price`, `reservation_date`, `status`, `qr_code`, `scanned`) VALUES
(1, 8, 8, 4, '3', 19.76, '2024-09-24 15:04:34', 'confirmed', 'cc10609a-eb2c-3b68-ae69-ab5e6edfb03c', 0),
(2, 9, 4, 6, '4', 16.63, '2024-09-24 15:04:34', 'cancelled', '8c007f56-d3af-31df-a8bb-82c9f0013600', 0),
(3, 1, 1, 28, '3', 42.62, '2024-09-24 15:04:34', 'confirmed', 'beada704-2101-3d88-865f-108f31837e95', 0),
(4, 1, 4, 21, '3', 12.40, '2024-09-24 15:04:34', 'cancelled', '0edb2cf2-b21a-3cb0-94e3-f802435ee9cf', 0),
(5, 6, 9, 25, '5', 22.33, '2024-09-24 15:04:34', 'cancelled', 'fedebfed-1847-3fc5-b8fd-986ea4785eeb', 1),
(6, 1, 8, 9, '3', 27.52, '2024-09-24 15:04:34', 'cancelled', 'b510620a-e9a6-3b0f-b9aa-fd98568703be', 1),
(7, 2, 3, 17, '1', 37.73, '2024-09-24 15:04:34', 'confirmed', '87873b03-7679-3e9c-9cc9-a6839cce0aaa', 0),
(8, 9, 2, 18, '2', 32.36, '2024-09-24 15:04:34', 'cancelled', 'eb113f43-8228-3c9a-8557-4ba7b0228cb0', 0),
(9, 1, 5, 27, '2', 9.54, '2024-09-24 15:04:34', 'confirmed', 'a50f1ebd-3ffb-33a0-9ec9-7c14d5b66770', 0),
(10, 7, 9, 29, '4', 41.11, '2024-09-24 15:04:34', 'cancelled', 'b88329e5-5540-3307-99a7-31d58054132b', 0),
(11, 8, 10, 1, '3', 37.76, '2024-09-24 15:04:34', 'confirmed', 'a3120958-cf63-31e4-81a0-3c5e9cfde5aa', 1),
(12, 7, 9, 1, '1', 23.91, '2024-09-24 15:04:34', 'cancelled', 'bc0f6726-0df7-3893-8374-3bf5013a0163', 0),
(13, 4, 5, 29, '3', 36.95, '2024-09-24 15:04:34', 'pending', '5cd44aca-60c1-3db5-84a3-85b3111cd27f', 0),
(14, 2, 1, 21, '5', 38.93, '2024-09-24 15:04:34', 'cancelled', '8f460596-e9ec-3984-ae58-7c47357c4a99', 0),
(15, 1, 1, 19, '1', 21.02, '2024-09-24 15:04:34', 'cancelled', '78664b26-cfa7-35e0-b510-5dd2282459c6', 0),
(16, 1, 5, 6, '5', 19.57, '2024-09-24 15:04:34', 'confirmed', 'bf8663a8-2f33-372d-a8af-61d7da061278', 0),
(17, 6, 1, 5, '1', 33.40, '2024-09-24 15:04:34', 'confirmed', '2fc3f421-8cf0-3a79-8827-345db204786d', 0),
(18, 3, 9, 23, '3', 14.60, '2024-09-24 15:04:34', 'confirmed', '35cb8eb5-21a4-304a-a8c4-0f8c551af0fc', 0),
(19, 5, 8, 25, '4', 10.28, '2024-09-24 15:04:34', 'confirmed', '4c5a97d9-3ab8-306b-ae96-d45177e09d75', 0),
(20, 1, 4, 7, '4', 13.67, '2024-09-24 15:04:34', 'confirmed', '29fe64ff-ef03-31dd-b60a-01fe65810a0c', 0),
(21, 10, 8, 27, '2', 48.00, '2024-09-24 15:04:34', 'pending', 'caf34954-7bd4-301c-8491-7960f8326f7b', 0),
(22, 10, 9, 14, '4', 20.98, '2024-09-24 15:04:34', 'pending', 'd7160e35-961a-31e5-a6c1-1717cd4ff9b6', 0),
(23, 5, 4, 27, '5', 35.34, '2024-09-24 15:04:34', 'cancelled', '4e906c37-51d5-3ebf-b3a8-6fbd6577c154', 0),
(24, 7, 2, 4, '4', 46.42, '2024-09-24 15:04:34', 'cancelled', '511073cb-c225-33c0-9e3e-163fde2c60c5', 0),
(25, 2, 7, 17, '1', 14.80, '2024-09-24 15:04:34', 'pending', '42b1f490-661f-3e0d-b519-38d41a4a57b3', 0),
(26, 8, 9, 21, '2', 31.14, '2024-09-24 15:04:34', 'pending', 'b38b0dfd-0092-30ee-a778-1252ab05b3d2', 0),
(27, 1, 3, 25, '5', 9.06, '2024-09-24 15:04:34', 'pending', '463cc94b-a66d-30be-b730-aec097702146', 0),
(28, 4, 3, 17, '1', 47.32, '2024-09-24 15:04:34', 'pending', '110f4a6a-f3e3-3e3b-a0f7-fcbf38c0dc4e', 0),
(29, 8, 10, 22, '4', 44.94, '2024-09-24 15:04:34', 'pending', '4b45ec89-67ab-39a2-bac0-e50436926eff', 0),
(30, 5, 4, 9, '3', 29.91, '2024-09-24 15:04:34', 'confirmed', '055bc878-608a-3174-9c15-862d4821f154', 0),
(31, 1, 9, 9, '5', 46.42, '2024-09-24 15:04:34', 'pending', '4bf044d9-2711-3d68-b812-038861ca994c', 0),
(32, 3, 6, 1, '5', 44.77, '2024-09-24 15:04:34', 'pending', 'ad493d79-9680-3e5a-b6ce-4b12ff8e3aee', 0),
(33, 7, 9, 8, '5', 41.98, '2024-09-24 15:04:34', 'confirmed', '51c0c816-7e99-3392-a5ae-a7f24e5d32e8', 0),
(34, 8, 7, 9, '1', 11.37, '2024-09-24 15:04:34', 'cancelled', '938fb662-52cf-310f-96ed-5b172af8ac59', 1),
(35, 8, 1, 12, '2', 37.05, '2024-09-24 15:04:34', 'pending', '2621e7d2-8cb0-3e32-a59a-c25de76f4dc3', 0),
(36, 10, 1, 21, '5', 45.13, '2024-09-24 15:04:34', 'pending', 'faed5280-b69e-3af6-9707-28144322e10b', 0),
(37, 2, 5, 30, '1', 39.44, '2024-09-24 15:04:34', 'cancelled', '1ca5d4ec-e435-3163-a0c5-8d8c3722dd2c', 0),
(38, 3, 10, 3, '5', 40.61, '2024-09-24 15:04:34', 'pending', '082ecd2b-2f0f-317d-b575-c3ef162fc6b4', 0),
(39, 10, 4, 14, '1', 12.54, '2024-09-24 15:04:34', 'pending', '5a88c422-0141-30aa-9250-adf4cb1a9c36', 0),
(40, 7, 8, 19, '2', 37.94, '2024-09-24 15:04:34', 'pending', '82181a52-a569-322c-b948-89e1fbfc5b8b', 0),
(41, 6, 10, 7, '3', 48.83, '2024-09-24 15:04:34', 'cancelled', 'd21689da-0936-356e-a94d-eaecf499fa46', 0),
(42, 4, 5, 16, '4', 31.49, '2024-09-24 15:04:34', 'pending', '1fe9906e-336c-30f3-a13e-1ef57dac8a1a', 0),
(43, 5, 4, 27, '5', 32.78, '2024-09-24 15:04:34', 'cancelled', '10c92131-e791-3116-b056-cb5de0ba5028', 1),
(44, 8, 3, 2, '4', 21.86, '2024-09-24 15:04:34', 'confirmed', '83aaddd3-2d7b-3b95-ba59-b1ffe9341133', 0),
(45, 5, 10, 15, '5', 22.99, '2024-09-24 15:04:34', 'pending', '1ddcbff5-fe09-31f3-abed-fb6f355902a8', 0),
(46, 2, 4, 18, '4', 12.41, '2024-09-24 15:04:34', 'pending', '7a782853-a88f-3d75-a133-9b3633d0d564', 0),
(47, 8, 3, 16, '5', 16.58, '2024-09-24 15:04:34', 'pending', '154accf8-aae9-3a74-b6f6-0ab973b5d7b5', 1),
(48, 9, 3, 26, '5', 45.52, '2024-09-24 15:04:34', 'cancelled', '2b0eff62-5ecb-3d8a-b440-2a5a250ce7eb', 0),
(49, 3, 2, 19, '5', 31.39, '2024-09-24 15:04:34', 'pending', 'bbcc1d52-ac5b-336a-8e65-de68ffa11707', 0),
(50, 10, 1, 3, '3', 25.33, '2024-09-24 15:04:34', 'confirmed', 'a6ebc685-a3f4-339d-bb74-3b7927ee3c8a', 0),
(51, 5, 2, 25, '4', 47.69, '2024-09-24 15:04:34', 'confirmed', '4e77fd5f-755d-3a7a-9e44-232914f93e55', 0),
(52, 4, 6, 25, '2', 20.71, '2024-09-24 15:04:34', 'pending', 'dff60ae9-2d3d-3579-b50a-b4f8d46826a2', 0),
(53, 3, 4, 28, '2', 28.05, '2024-09-24 15:04:34', 'confirmed', '3cfca775-0178-37d8-ac45-423ce1cd5ad9', 0),
(54, 10, 9, 12, '4', 26.12, '2024-09-24 15:04:34', 'confirmed', '2d14cb57-fc35-3e13-85e0-4ddd780fdf86', 0),
(55, 4, 6, 7, '3', 49.04, '2024-09-24 15:04:34', 'confirmed', 'd0c69f80-1b8b-31db-91c3-e033ecfb665c', 0),
(56, 7, 1, 14, '5', 45.33, '2024-09-24 15:04:34', 'pending', 'f2d725c3-2a33-3c41-8962-c2d87e1f6a04', 0),
(57, 6, 1, 12, '1', 39.79, '2024-09-24 15:04:34', 'confirmed', '7eae9665-c99c-3662-8e94-19c576bd64f4', 1),
(58, 6, 9, 16, '2', 43.45, '2024-09-24 15:04:34', 'cancelled', 'c6400f2b-97c9-31ca-b970-c1b1f33e064c', 0),
(59, 1, 6, 25, '5', 10.47, '2024-09-24 15:04:34', 'cancelled', 'd331f320-6c81-3e1d-b8ca-3e0ebaafc349', 0),
(60, 7, 10, 3, '4', 41.77, '2024-09-24 15:04:34', 'pending', 'c0dcded9-61f4-3725-b892-e816baf5811d', 0),
(61, 2, NULL, 6, '17', 12.50, '2024-10-07 20:50:20', 'confirmed', 'QR_67042d6c95e31', 0),
(62, 2, NULL, 6, '8', 37.50, '2024-10-07 21:14:57', 'confirmed', 'QR_67043331b68ee', 0),
(63, 2, NULL, 6, '8', 37.50, '2024-10-07 21:18:22', 'confirmed', 'QR_670433feb6557', 0),
(64, 2, 6, 6, '8', 37.50, '2024-10-07 21:33:20', 'confirmed', 'QR_670437803414b', 0),
(65, 2, 6, 6, '18', 37.50, '2024-10-07 21:37:44', 'confirmed', 'QR_670438880bc9a', 0),
(66, 2, 6, 6, '08, 07', 25.00, '2024-10-07 21:44:57', 'confirmed', 'QR_67043a395705b', 0),
(67, 2, 6, 6, '08, 17', 25.00, '2024-10-08 09:04:26', 'confirmed', 'QR_6704d97a5b612', 0),
(68, 2, 6, 6, '02, 13, 14', 37.50, '2024-10-08 11:29:30', 'confirmed', 'QR_6704fb7a5dd40', 0),
(69, 2, 6, 6, '06', 12.50, '2024-10-08 11:30:41', 'confirmed', 'QR_6704fbc1afa85', 0),
(70, 5, 6, 6, '20', 12.50, '2024-10-08 11:33:45', 'confirmed', 'QR_6704fc79bb7c7', 0),
(71, 5, 6, 6, '02', 12.50, '2024-10-08 13:36:12', 'confirmed', 'QR_6705192c21e5a', 0),
(72, 5, 6, 6, '02', 12.50, '2024-10-08 13:39:01', 'confirmed', 'QR_670519d588df5', 0),
(73, 5, 6, 6, '02', 12.50, '2024-10-08 13:43:00', 'confirmed', 'QR_67051ac44003d', 0),
(74, 5, 6, 6, '10, 20', 25.00, '2024-10-08 13:45:21', 'confirmed', 'QR_67051b518a9f3', 0),
(75, 2, 6, 6, '18', 12.50, '2024-10-08 14:48:32', 'confirmed', 'QR_67052a2009469', 0),
(80, 2, 6, 6, '09, 17', 25.00, '2024-10-09 13:18:57', 'confirmed', 'QR_670666a1e9302', 0),
(81, 2, 6, 6, '14, 15', 25.00, '2024-11-06 14:06:06', 'confirmed', 'QR_670e5aae24bac', 0),
(82, 2, 38, 24, '10', 15.00, '2024-10-21 22:09:44', 'confirmed', 'QR_6716b5087a601', 0),
(83, 2, 38, 24, '03', 15.00, '2024-10-21 22:12:13', 'confirmed', 'QR_6716b59da9e63', 0),
(84, 2, 38, 43, '11', 12.50, '2024-11-04 22:09:11', 'confirmed', 'QR_672937f7e4bc0', 0),
(85, 2, 38, 43, '01', 12.50, '2024-11-04 22:19:04', 'confirmed', 'QR_67293a482054b', 0),
(86, 2, 38, 43, '16', 12.50, '2024-11-04 22:22:24', 'confirmed', 'QR_67293b109efec', 0),
(87, 7, 38, 16, '10', 15.00, '2024-11-05 09:09:47', 'confirmed', 'QR_6729d2cbea85a', 0),
(88, 7, 38, 16, '11', 15.00, '2024-11-05 09:18:27', 'confirmed', 'QR_6729d4d3a35d0', 0),
(89, 7, 36, 45, '01, 02', 25.00, '2024-11-05 11:04:19', 'confirmed', 'QR_6729eda357a08', 0),
(90, 5, 38, 43, '03', 12.50, '2024-11-11 14:59:24', 'confirmed', 'QR_67320dbc91ea9', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `movie_id`, `customer_id`, `review_text`, `rating`, `status`, `submission_date`) VALUES
(1, 6, 1, 'Qui molestiae asperiores dolores consectetur omnis. Quia modi est eos aut atque et minima nesciunt. Aut provident consequuntur odit earum. Iure voluptatem quibusdam voluptatem minus eos deleniti.', 2, 'approved', '2024-07-05 16:13:03'),
(2, 2, 2, 'Autem blanditiis velit ipsa et rerum ipsa. In quam natus sed.', 3, 'approved', '2024-01-19 18:15:17'),
(3, 9, 3, 'Non quo ipsa facilis ut qui. Quidem vel aut autem. Explicabo iure vero repellendus.', 1, 'approved', '2024-03-15 11:05:18'),
(4, 6, 4, 'Rem porro saepe voluptatem ducimus omnis. Porro reiciendis et non aspernatur velit. Qui odio alias autem et qui accusantium.', 3, 'pending', '2024-08-29 03:59:09'),
(5, 10, 5, 'Eos omnis tempora assumenda sapiente perspiciatis esse. Sunt blanditiis aliquid aspernatur voluptatem. Fuga neque corporis consequuntur consequuntur eaque delectus.', 5, 'approved', '2024-07-20 06:26:06'),
(6, 10, 5, 'Saepe facere beatae ut fuga repellendus. Culpa laudantium impedit beatae est id quis sequi. Illum consequatur harum labore accusamus est ea neque.', 2, 'pending', '2024-06-06 18:14:30'),
(7, 7, 6, 'Similique expedita a ab ab. Ut ut nihil dolore.', 2, 'approved', '2024-01-03 14:40:18'),
(20, 38, 2, 'Cool !!!', 4, 'pending', '2024-11-09 15:24:40'),
(9, 10, 8, 'Harum dolore commodi molestias dolore non et. Neque vitae voluptas dolorem veniam impedit vel id. Ea expedita adipisci dolore excepturi suscipit atque odit.', 2, 'approved', '2024-07-09 09:48:08'),
(10, 7, 9, 'Enim error sed tempore aliquid unde. Deserunt eum aliquid facere perferendis et possimus voluptatum. Et laborum facere delectus. Qui nulla voluptatem excepturi perspiciatis.', 2, 'approved', '2024-08-19 21:24:46'),
(19, 38, 2, 'Super film !!!', 4, 'approved', '2024-11-09 15:24:21');

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cinema_id` int DEFAULT NULL,
  `room_number` varchar(10) DEFAULT NULL,
  `seat_capacity` int DEFAULT NULL,
  `projection_quality` varchar(50) DEFAULT NULL,
  `incident_notes` text,
  PRIMARY KEY (`id`),
  KEY `cinema_id` (`cinema_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `cinema_id`, `room_number`, `seat_capacity`, `projection_quality`, `incident_notes`) VALUES
(1, 5, '1', 188, '4K', 'Quia consequuntur ipsam qui et maiores.'),
(2, 5, '6', 56, 'IMAX', 'Quis saepe atque et nulla ut.'),
(3, 5, '4', 186, '3D', 'Qui excepturi aspernatur et voluptatem.'),
(4, 2, '7', 51, '3D', 'Tenetur distinctio iure alias commodi quisquam amet nisi.'),
(5, 3, '1', 20, '3D', 'Qui quibusdam odio quod similique est.'),
(6, 1, '4', 106, 'IMAX', 'Incidunt in eos sapiente.'),
(7, 2, '1', 133, '3D', 'Modi magnam suscipit rerum repellendus.'),
(8, 5, '1', 124, '3D', 'Distinctio est eligendi iure esse sunt.'),
(9, 4, '4', 50, 'IMAX', 'Fugiat voluptates consequatur ducimus laborum et qui.'),
(10, 5, '1', 66, 'IMAX', 'Ducimus qui consequatur quasi sint..');

-- --------------------------------------------------------

--
-- Structure de la table `screenings`
--

DROP TABLE IF EXISTS `screenings`;
CREATE TABLE IF NOT EXISTS `screenings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `screening_day` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`),
  KEY `room_id` (`room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `screenings`
--

INSERT INTO `screenings` (`id`, `movie_id`, `room_id`, `start_time`, `end_time`, `screening_day`) VALUES
(1, 5, 1, '17:53:02', '09:08:55', '2024-10-20'),
(2, 2, 6, '21:12:52', '22:49:24', '2024-09-27'),
(3, 7, 4, '04:11:12', '19:09:43', '2024-09-25'),
(4, 10, 2, '12:47:33', '09:29:07', '2024-09-27'),
(5, 1, 3, '10:30:38', '19:34:52', '2024-10-20'),
(6, 6, 5, '12:46:46', '00:40:51', '2024-10-20'),
(7, 4, 3, '00:10:54', '23:35:51', '2024-09-28'),
(8, 6, 7, '19:41:53', '23:03:17', '2024-11-06'),
(9, 6, 9, '16:45:04', '14:10:05', '2024-11-05'),
(10, 6, 8, '16:17:22', '21:01:58', '2024-11-06'),
(43, 38, 5, '15:13:00', '16:13:00', '2024-11-12'),
(16, 38, 6, '20:12:00', '22:12:00', '2024-11-05'),
(44, 38, 4, '12:33:00', '13:30:00', '2024-11-06'),
(45, 36, 4, '15:01:00', '16:01:00', '2024-11-06');

-- --------------------------------------------------------

--
-- Structure de la table `seats`
--

DROP TABLE IF EXISTS `seats`;
CREATE TABLE IF NOT EXISTS `seats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int DEFAULT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `reserved` tinyint DEFAULT '0',
  `is_accessible` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `seats`
--

INSERT INTO `seats` (`id`, `room_id`, `seat_number`, `reserved`, `is_accessible`) VALUES
(1, 5, '01', 1, 1),
(2, 5, '02', 1, 1),
(3, 5, '03', 1, 0),
(4, 5, '04', 0, 0),
(5, 5, '05', 1, 0),
(6, 5, '06', 0, 0),
(7, 5, '07', 0, 0),
(8, 5, '08', 0, 0),
(9, 5, '09', 1, 1),
(10, 5, '10', 1, 1),
(11, 5, '11', 1, 0),
(12, 5, '12', 0, 0),
(13, 5, '13', 0, 0),
(14, 5, '14', 1, 0),
(15, 5, '15', 1, 0),
(16, 5, '16', 1, 0),
(17, 5, '17', 1, 0),
(18, 5, '18', 1, 0),
(19, 5, '19', 0, 0),
(20, 5, '20', 1, 0),
(21, 2, '01', 0, 0),
(22, 2, '02', 0, 0),
(23, 2, '03', 1, 0),
(24, 2, '04', 0, 0),
(25, 2, '05', 0, 0),
(26, 2, '06', 0, 0),
(27, 2, '07', 0, 0),
(28, 2, '08', 0, 0),
(29, 2, '09', 0, 0),
(30, 2, '10', 1, 0),
(31, 2, '11', 0, 0),
(32, 2, '12', 0, 1),
(33, 2, '13', 0, 0),
(34, 2, '14', 0, 0),
(35, 2, '15', 0, 0),
(36, 2, '16', 0, 0),
(37, 2, '17', 0, 0),
(38, 2, '18', 0, 0),
(39, 2, '19', 0, 0),
(40, 2, '20', 0, 0),
(41, 3, '01', 0, 0),
(42, 3, '02', 0, 0),
(43, 3, '03', 0, 0),
(44, 3, '04', 0, 0),
(45, 3, '05', 0, 1),
(46, 3, '06', 0, 0),
(47, 3, '07', 0, 0),
(48, 3, '08', 0, 0),
(49, 3, '09', 0, 0),
(50, 3, '10', 0, 0),
(51, 3, '11', 0, 0),
(52, 3, '12', 0, 0),
(53, 3, '13', 0, 0),
(54, 3, '14', 0, 0),
(55, 3, '15', 0, 0),
(56, 3, '16', 0, 0),
(57, 3, '17', 0, 0),
(58, 3, '18', 0, 0),
(59, 3, '19', 0, 1),
(60, 3, '20', 0, 0),
(61, 4, '01', 1, 0),
(62, 4, '02', 1, 0),
(63, 4, '03', 0, 0),
(64, 4, '04', 0, 0),
(65, 4, '05', 0, 0),
(66, 4, '06', 0, 0),
(67, 4, '07', 0, 0),
(68, 4, '08', 0, 0),
(69, 4, '09', 0, 0),
(70, 4, '10', 0, 0),
(71, 4, '11', 0, 0),
(72, 4, '12', 0, 0),
(73, 4, '13', 0, 0),
(74, 4, '14', 0, 0),
(75, 4, '15', 0, 0),
(76, 4, '16', 0, 0),
(77, 4, '17', 0, 0),
(78, 4, '18', 0, 0),
(79, 4, '19', 0, 0),
(80, 4, '20', 0, 0),
(81, 6, '01', 0, 1),
(82, 6, '02', 0, 0),
(83, 6, '03', 0, 0),
(84, 6, '04', 0, 0),
(85, 6, '05', 0, 0),
(86, 6, '06', 0, 0),
(87, 6, '07', 0, 0),
(88, 6, '08', 0, 1),
(89, 6, '09', 0, 0),
(90, 6, '10', 1, 0),
(91, 6, '11', 1, 0),
(92, 6, '12', 0, 0),
(93, 6, '13', 0, 0),
(94, 6, '14', 0, 0),
(95, 6, '15', 0, 0),
(96, 6, '16', 0, 0),
(97, 6, '17', 0, 0),
(98, 6, '18', 0, 0),
(99, 6, '19', 0, 0),
(100, 6, '20', 0, 0),
(101, 1, '01', 0, 0),
(102, 1, '02', 0, 0),
(103, 1, '03', 0, 0),
(104, 1, '04', 0, 0),
(105, 1, '05', 0, 1),
(106, 1, '06', 0, 0),
(107, 1, '07', 0, 0),
(108, 1, '08', 0, 0),
(109, 1, '09', 0, 0),
(110, 1, '10', 0, 0),
(111, 1, '11', 0, 1),
(112, 1, '12', 0, 0),
(113, 1, '13', 0, 0),
(114, 1, '14', 0, 0),
(115, 1, '15', 0, 0),
(116, 1, '16', 0, 0),
(117, 1, '17', 0, 0),
(118, 1, '18', 0, 0),
(119, 1, '19', 0, 0),
(120, 1, '20', 0, 0),
(121, 2, '01', 0, 0),
(122, 2, '02', 0, 0),
(123, 2, '03', 1, 0),
(124, 2, '04', 0, 0),
(125, 2, '05', 0, 0),
(126, 2, '06', 0, 0),
(127, 2, '07', 0, 1),
(128, 2, '08', 0, 1),
(129, 2, '09', 0, 0),
(130, 2, '10', 1, 0),
(131, 2, '11', 0, 0),
(132, 2, '12', 0, 0),
(133, 2, '13', 0, 0),
(134, 2, '14', 0, 0),
(135, 2, '15', 0, 0),
(136, 2, '16', 0, 0),
(137, 2, '17', 0, 0),
(138, 2, '18', 0, 0),
(139, 2, '19', 0, 0),
(140, 2, '20', 0, 1),
(141, 3, '01', 0, 0),
(142, 3, '02', 0, 0),
(143, 3, '03', 0, 0),
(144, 3, '04', 0, 0),
(145, 3, '05', 0, 0),
(146, 3, '06', 0, 1),
(147, 3, '07', 0, 0),
(148, 3, '08', 0, 0),
(149, 3, '09', 0, 0),
(150, 3, '10', 0, 0),
(151, 3, '11', 0, 0),
(152, 3, '12', 0, 0),
(153, 3, '13', 0, 0),
(154, 3, '14', 0, 0),
(155, 3, '15', 0, 0),
(156, 3, '16', 0, 0),
(157, 3, '17', 0, 0),
(158, 3, '18', 0, 0),
(159, 3, '19', 0, 0),
(160, 3, '20', 0, 0),
(161, 4, '01', 1, 0),
(162, 4, '02', 1, 0),
(163, 4, '03', 0, 0),
(164, 4, '04', 0, 0),
(165, 4, '05', 0, 0),
(166, 4, '06', 0, 0),
(167, 4, '07', 0, 1),
(168, 4, '08', 0, 0),
(169, 4, '09', 0, 0),
(170, 4, '10', 0, 0),
(171, 4, '11', 0, 0),
(172, 4, '12', 0, 0),
(173, 4, '13', 0, 0),
(174, 4, '14', 0, 0),
(175, 4, '15', 0, 0),
(176, 4, '16', 0, 0),
(177, 4, '17', 0, 0),
(178, 4, '18', 0, 0),
(179, 4, '19', 0, 0),
(180, 4, '20', 0, 0),
(181, 5, '01', 1, 0),
(182, 5, '02', 1, 0),
(183, 5, '03', 1, 0),
(184, 5, '04', 0, 0),
(185, 5, '05', 0, 0),
(186, 5, '06', 0, 0),
(187, 5, '07', 0, 0),
(188, 5, '08', 1, 0),
(189, 5, '09', 1, 0),
(190, 5, '10', 1, 0),
(191, 5, '11', 1, 0),
(192, 5, '12', 0, 0),
(193, 5, '13', 0, 0),
(194, 5, '14', 1, 0),
(195, 5, '15', 1, 0),
(196, 5, '16', 1, 0),
(197, 5, '17', 1, 0),
(198, 5, '18', 1, 0),
(199, 5, '19', 0, 0),
(200, 5, '20', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('administrator','employee','user') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `role`) VALUES
(1, 'Lamine', 'CISSE', 'lamine67', 'sotiness67@gmail.com', '$2y$10$3HbfhGNaBFdYIh95sxgz2urV7loIFE2r9ISQ7uOjoR2KXhBNYzuh2', 'user'),
(2, 'lam', 'ciss', 'lam67', 'lam67@gmail.com', '$2y$10$TifMo2wnrTf87xX8BmoYOumu11BuKkVOnTpmmCHAi/twEbklbP2o6', 'user'),
(3, 'lami', 'lami', 'lami67', 'lami67@gmail.com', '$2y$10$MqKKND7eAH.dpC8FJUbqY.eDPo5MLVNQOu9PzSdVO1ZEL81MgfDVq', 'user'),
(4, 'lamin', 'lamin', 'lamin67', 'lamin67@gmail.com', '$2y$10$YbNBI78WIM1vw6ouzLefb.vIUAbDl2kAfLd2CEu45asoAihmJbnKe', 'user'),
(5, 'test2', 'test2', 'test2', 'test2@gmail.com', '$2y$10$DBLaVhteSWClauOrvfouIezZWf/Gv8Yn8dXMoljy7/qfGZ0B6Z4hG', 'user'),
(7, 'Sam', 'SAMO', 'sam67', 'sam67@gmail.com', '$2y$10$YCchpCcbgg17BIfBLa48TuAxycJwon7XRIUAtUi5hDFY41JcT7hLC', 'administrator'),
(8, 'Eric', 'ERICO', 'eric68', 'eric68@gmail.com', '$2y$10$NsP0GLt/yVBukoyEhvbcAOEmpdOpmTv02wBjgyvNfL6EANgfnqca2', 'employee'),
(11, 'Thomas', 'SABO', 'thomas23', 'thomas23@gmail.com', '$2y$10$suarCCzowuw/nfOqfoOmvevaqaRpunChq2nbNQwFvIdKP9CJCpPPa', 'employee');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
