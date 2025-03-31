-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 31 mars 2025 à 12:05
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `survey_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `required` tinyint(1) NOT NULL,
  `type_input` varchar(50) NOT NULL,
  `options` text NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`question_id`, `survey_id`, `question`, `required`, `type_input`, `options`, `points`) VALUES
(11, 16, 'wowo', 1, 'Multi Choice', '[\\\"test\\\",\\\"poo\\\"]', 4),
(7, 14, 'wowo', 1, 'Text', '[\\\"\\\"]', 8),
(12, 16, 'wowo', 0, 'Text', '[\\\"\\\"]', 0),
(15, 17, 'what was your first job ?', 1, 'Text', '[\\\"\\\"]', 4),
(16, 18, 'what is your first name ? ', 1, 'Text', '[\\\"\\\"]', 2),
(17, 18, 'what country do you reside in now ? ', 1, 'Text', '[\\\"\\\"]', 5),
(18, 19, 'Q', 1, 'Multi Choice', '[\\\"B\\\"]', 5),
(19, 20, 'are u ok', 0, 'Multi Choice', '[\\\"yes\\\",\\\"no\\\"]', 9),
(20, 21, 'are you staying at U residence ?', 0, 'Text', '[\\\"\\\"]', 6),
(21, 21, 'are u s', 0, 'Multi Choice', '[\\\"yes\\\",\\\"no\\\"]', 5),
(22, 21, 'where', 0, 'Text', '[\\\"\\\"]', 5);

-- --------------------------------------------------------

--
-- Structure de la table `reward`
--

CREATE TABLE `reward` (
  `reward_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reward`
--

INSERT INTO `reward` (`reward_id`, `title`, `points`) VALUES
(1, '5$ apple store credit', 10),
(2, '5$ amazon card', 9);

-- --------------------------------------------------------

--
-- Structure de la table `survey`
--

CREATE TABLE `survey` (
  `survey_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `intro` varchar(250) NOT NULL,
  `thankyou` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `lat` decimal(12,8) DEFAULT NULL,
  `lng` decimal(12,8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `survey`
--

INSERT INTO `survey` (`survey_id`, `title`, `intro`, `thankyou`, `location`, `lat`, `lng`) VALUES
(16, 'basic knowledge', 'this is usefull introduction to the survey you will be doing', 'we thank you for completing the survey your reward points will be set to', 'Kuala Lumpur City Centre Kuala Lumpur Federal Territory of Kuala Lumpur Malaysia', '3.14664200', '101.69584490'),
(14, 'general information', 'this is usefull introduction to the survey you will be doing', 'we thank you for completing the survey your reward points will be set to', 'Kuala Lumpur City Centre Kuala Lumpur Federal Territory of Kuala Lumpur Malaysia', '3.14664200', '99.99999999'),
(17, 'what is your location trip ?', 'this is usefull introduction to the survey you will be doing', 'we thank you for completing the survey your reward points will be set to', 'Ampang Park Kuala Lumpur Federal Territory of Kuala Lumpur Malaysia', '3.15987000', '101.71910000'),
(18, 'Dusk Till Dawn', 'this is my introduction', 'thank you ;)', 'Sunway Pyramid Subang Jaya Selangor Malaysia', '3.07365900', '99.99999999'),
(19, 'Ready For It?', 'this is my introduction', 'thank you ;)', 'Sunway Pyramid Jalan PJS 11/15 Bandar Sunway Subang Jaya Selangor Malaysia', '3.07287850', '99.99999999'),
(20, 'Look What You Made Me Do', 'this is my introduction', 'thank you ;)', 'Sunway Medical Centre Jalan Lagoon Selatan Bandar Sunway Petaling Jaya Selangor Malaysia', '3.06621710', '101.60955020'),
(21, 'taylors', 'student', 'thank you ;)', 'Taylor\'s University - Lakeside Campus Jalan Taylors Subang Jaya Selangor Malaysia', '3.06469900', '101.61615300');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `uAddress1` varchar(100) NOT NULL,
  `uAddress2` varchar(100) DEFAULT NULL,
  `uState` varchar(30) NOT NULL,
  `uZipCode` varchar(10) NOT NULL,
  `uCountry` varchar(30) NOT NULL,
  `uMobNum` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `uAddress1`, `uAddress2`, `uState`, `uZipCode`, `uCountry`, `uMobNum`, `username`, `password`) VALUES
(1, 'Cliff', 'Guan', '123', 'Road', 'Selangor', '12345', 'Malaysua', 12345678, 'Cliff', '1234'),
(8, 'test', 'test', 'test', '', 'test', '32788', 'Malaysia', 0, 'root', 'root'),
(9, 'aa', 'bb', 'klff', '', 'Selangor', '13465', 'Malaysia', 122456789, 'test2', 'test2');

-- --------------------------------------------------------

--
-- Structure de la table `user_response`
--

CREATE TABLE `user_response` (
  `response_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_response`
--

INSERT INTO `user_response` (`response_id`, `question_id`, `user_id`, `data`) VALUES
(11, 11, 1, 'test'),
(14, 12, 1, 'de'),
(15, 15, 1, 'web dev'),
(16, 16, 1, 'aa'),
(17, 7, 0, 'ihb'),
(18, 17, 8, 'malaysia'),
(19, 20, 8, 'yes');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Index pour la table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`reward_id`);

--
-- Index pour la table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`survey_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Index pour la table `user_response`
--
ALTER TABLE `user_response`
  ADD PRIMARY KEY (`response_id`),
  ADD UNIQUE KEY `question_id` (`question_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `reward`
--
ALTER TABLE `reward`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `survey`
--
ALTER TABLE `survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user_response`
--
ALTER TABLE `user_response`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
