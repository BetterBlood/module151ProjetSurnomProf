-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 18 Décembre 2020 à 09:41
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_nickname_jersteiner`
--

create database db_nickname_jersteiner;
use db_nickname_jersteiner;

-- --------------------------------------------------------

--
-- Structure de la table `t_section`
--

CREATE TABLE `t_section` (
  `idSection` int(11) NOT NULL,
  `secName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_section`
--

INSERT INTO `t_section` (`idSection`, `secName`) VALUES
(1, 'INF'),
(2, 'Bois'),
(3, 'Elec'),
(13, 'Méca');

-- --------------------------------------------------------

--
-- Structure de la table `t_teacher`
--

CREATE TABLE `t_teacher` (
  `idTeacher` int(11) NOT NULL,
  `teaLastName` varchar(50) NOT NULL,
  `teaFirstName` varchar(50) NOT NULL,
  `teaGender` char(1) NOT NULL,
  `teaNickname` varchar(50) NOT NULL,
  `teaNicknameOrigin` varchar(280) NOT NULL,
  `teaIsDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `teaVotes` int(11) DEFAULT NULL,
  `idSection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_teacher`
--

INSERT INTO `t_teacher` (`idTeacher`, `teaLastName`, `teaFirstName`, `teaGender`, `teaNickname`, `teaNicknameOrigin`, `teaIsDeleted`, `teaVotes`, `idSection`) VALUES
(1, 'testnameId1', 'testFirstnameId1', 'w', 'testnicknameId1', 'testorigineId1', 0, 12, 1),
(2, 'test2lastname', 'test2firstname', 'w', 'test2nickname', 'test2origine', 0, 6, 1),
(3, 'test3_name', 'test3_firstname', 'o', 'test3_nickname', 'test3_origine', 0, 2, 2),
(14, '<h1>testId14</h1>', '<h1>testId14</h1>', 'm', '<h1>testId14</h1>', '<h1>OrigineId14</h1>', 0, 15, 1),
(17, 'gdergId17', 'ergergId17', 'w', 'rgergeId17', 'gergerId17', 0, NULL, 3),
(18, 'leprofsupprimeId18', 'leprofsupprimeId18', 'm', 'leprofsuppriméId18', 'leprofsuppriméId18', 1, 3, 3),
(19, 'fgewbf regexcheked', 'arnaux', 'w', 'gerberngt', 'dkfgjernbg\'ergkjbenrgkjerge\'rger\'g\'er\'gergfe""sdlkjfslkdf"<<<<<\\\\\\kdjhfbd\\\'fwsedfwebf', 0, 7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int(11) NOT NULL,
  `useUsername` varchar(50) NOT NULL,
  `usePassword` varchar(255) NOT NULL,
  `useAdminRight` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_user`
--

INSERT INTO `t_user` (`idUser`, `useUsername`, `usePassword`, `useAdminRight`) VALUES
(1, 'peter', '$2y$10$OTJf05B81bn1u3vrT3fcWe/iOihSablos5RLqXRu098D.Fm7w8Qia', 100),
(7, 'Lawand', '$2y$10$/3Gq7mVgFotfxaLJ08jRpefZQ..U4d95JXKjEEeVXXDzmNfPPALK.', 50),
(10, '25', '$2y$10$o1Hub/8dLmzZCNLBpq6ndOLeq5DVJxwBRptrlJkP7fNvf4fthmgwG', 25),
(12, '1', '$2y$10$A.0WDG9zJLB5TSSkfIdFk.py6yf7q4DwGOJxg7iQLevWmbQlrwd2S', 1),
(13, 'etml', '$2y$10$5zyFiau.NiYpDfS.13FYnOopqP2VwV.Kc5y5s/YITIcLitcHSwcUq', 75);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_section`
--
ALTER TABLE `t_section`
  ADD PRIMARY KEY (`idSection`),
  ADD UNIQUE KEY `ID_t_section_IND` (`idSection`);

--
-- Index pour la table `t_teacher`
--
ALTER TABLE `t_teacher`
  ADD PRIMARY KEY (`idTeacher`),
  ADD UNIQUE KEY `ID_t_teacher_IND` (`idTeacher`),
  ADD KEY `FKbelong_IND` (`idSection`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `ID_t_user_IND` (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_section`
--
ALTER TABLE `t_section`
  MODIFY `idSection` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `t_teacher`
--
ALTER TABLE `t_teacher`
  MODIFY `idTeacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_teacher`
--
ALTER TABLE `t_teacher`
  ADD CONSTRAINT `FKbelong_FK` FOREIGN KEY (`idSection`) REFERENCES `t_section` (`idSection`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
