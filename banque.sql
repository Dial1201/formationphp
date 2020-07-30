-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2020 at 10:29 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banque`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_user` varchar(250) NOT NULL,
  `texte` varchar(250) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `partenaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `texte`, `date_creation`, `partenaire`) VALUES
(1, 'dial01', 'test commentaires article 1', '2020-07-17 15:51:04', 1),
(2, 'dial01', 'test commentaires article 2', '2020-07-17 15:51:04', 2),
(3, 'dial01', 'test commentaires article 3', '2020-07-17 15:51:04', 3),
(4, 'dial01', 'test commentaires article 4', '2020-07-17 15:51:04', 4);

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `id_article`, `id_user`) VALUES
(1, 4, 0),
(2, 4, 0),
(3, 4, 0),
(4, 4, 0),
(5, 4, 0),
(6, 2, 0),
(7, 2, 0),
(8, 2, 0),
(9, 2, 0),
(10, 2, 0),
(11, 2, 0),
(12, 2, 0),
(13, 2, 0),
(14, 2, 0),
(15, 2, 0),
(16, 2, 0),
(17, 2, 0),
(18, 2, 0),
(19, 2, 0),
(20, 2, 0),
(21, 2, 0),
(37, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `id_article`, `id_user`) VALUES
(1, 4, 0),
(2, 4, 0),
(3, 4, 0),
(4, 4, 0),
(5, 4, 0),
(14, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `partenaire`
--

CREATE TABLE `partenaire` (
  `id` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `extrait` varchar(200) NOT NULL,
  `texte` text NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partenaire`
--

INSERT INTO `partenaire` (`id`, `logo`, `titre`, `extrait`, `texte`, `join_date`) VALUES
(1, 'formation_co.png', 'Formation&co ', 'Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé...', 'Formation&co est une association française présente sur tout le territoire.\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\nNotre proposition : \r\nun financement jusqu’à 30 000€ ;\r\nun suivi personnalisé et gratuit ;\r\nune lutte acharnée contre les freins sociétaux et les stéréotypes.\r\n\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.\r\n', '2020-07-14'),
(2, 'protectpeople.png', 'Protectpeople', 'Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale...', 'Protectpeople finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\nNous garantissons un accès aux soins et une retraite.\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.\r\nNotre mission est double :\r\nsociale : nous garantissons la fiabilité des données sociales ;\r\néconomique : nous apportons une contribution aux activités économiques.\r\n', '2020-07-15'),
(3, 'Dsa_france.png', 'Dsa France ', 'Nous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s’adapter à chaque entreprise...', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s’adapter à chaque entreprise.\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises\r\n', '2020-07-16'),
(4, 'CDE.png', ' CDE ', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation... ', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. \r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.\r\n', '2020-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `question` varchar(200) NOT NULL,
  `reponse` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `username`, `password`, `question`, `reponse`) VALUES
(1, 'diallo', 'issa', 'dial', '$2y$10$oe/LCOEz1auYPlBFlY49ruTqCTNmEEP2uzeSh0SMHMPE/h1caLUhm', 'club catalan', 'barcelone'),
(2, 'diallo', 'issa', 'dialtest2', 'lilyadiallo', 'club catalan', 'barcelone'),
(3, 'diallo', 'issa', 'dialtest3', '$2y$10$moO1H/V.UTgAXo2Iq0i28.XXa8AUhcI2rHC5lZ/Qa9n6OdDgOFRZm', 'club catalan', 'barcelone'),
(4, 'diallo', 'issa', 'dialtest4', '$2y$10$6oYjjsK2dBSX8Mbl5Zh74O2ffCm7qND4cK1NSfAdEhai86pB8RXgm', 'club catalan', 'barcelone'),
(5, 'issa', 'diallo', 'testfrance', '$2y$10$RAiIWtZP0FO4ks8cGN/TWOpeiOCc7UEN6zGYV7IbwO9aWnJATqrvq', 'testquestion5', 'reponsequestion5'),
(6, 'diallo', 'issa', 'test6', '$2y$10$7XZ03sUlnq26Ol0Z3UOmyutCZRkjmLz8YyGA5sz6KrXhTrmb3NyMK', 'question secrete', 'reponse secrete'),
(7, 'diallo', 'issa', 'test6', '$2y$10$MZrcXkVtgK3arcH2EVOXTO10Luqe7xzAMqvK.YhqaJ6kaZKBygiai', 'question secrete', 'reponse secrete'),
(8, 'diallo', 'issa', 'test6', '$2y$10$ARFVJ12iIzLhGs.SCk0iw.neyM6erSbiQTNW9tPeqRlkCgfqlpdUa', 'question secrete', 'reponse secrete'),
(9, 'diallo', 'issa', 'dial01', '$2y$10$cOTJ0pq5HTEHTdGIqnZW0.ogKtBs4hBTwwS2OGLE8B0vGqAeUBkji', 'question', 'reponse'),
(10, 'diallo', 'lilya', 'lili', '$2y$10$mdre5btKLbb4lnmgrTmLpefQ5TLoOHFaALinia.OlF0FpP3nlzjDu', 'ville', 'cergy'),
(11, 'diallo', 'mayana', 'nana', '$2y$10$LjJ5dAAfwQz2U5QIdCZqperwqmRe03GavR6wOpHy0XYYl6gKx1s3u', 'couleur', 'rose');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index` (`partenaire`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `partenaire`
--
ALTER TABLE `partenaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `partenaire`
--
ALTER TABLE `partenaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`partenaire`) REFERENCES `partenaire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
