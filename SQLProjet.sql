-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  sqletud.u-pem.fr
-- Généré le :  Dim 12 Janvier 2020 à 23:20
-- Version du serveur :  5.5.62-0+deb8u1-log
-- Version de PHP :  7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `vdomin01_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `ORGANISME`
--

CREATE TABLE `ORGANISME` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `raisonSociale` varchar(40) NOT NULL,
  `type` varchar(30) NOT NULL
);

--
-- Contenu de la table `ORGANISME`
--

INSERT INTO `ORGANISME` (`raisonSociale`, `type`) VALUES
('VetAlliance', 'entreprise'),
('Equidia', 'association');

-- --------------------------------------------------------

--
-- Structure de la table `PARTICULIERS`
--

CREATE TABLE `PARTICULIERS` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `codePostal` varchar(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `telephone` varchar(10),
  `email` varchar(255) NOT NULL
);

--
-- Contenu de la table `PARTICULIERS`
--

INSERT INTO `PARTICULIERS` (`nom`, `prenom`, `adresse`, `codePostal`, `ville`, `telephone`, `email`) VALUES
('Albert', 'William', '7 avenue de la Croix', '94130', 'Nogent-sur-Marne', '0619141611', 'william.albert94@gmail.com'),
('Niska', 'Bob', '9 avenue Saint-Germain', '75001', 'Paris', NULL, 'niska.bob91@gmail.com'),
('Donatien', 'Olaf', '16 rue Faubourg Saint-Martin', '93200', 'Saint-Denis', '0685429132', 'Olaf.donat.haches@yahoo.fr');

-- --------------------------------------------------------

--
-- Structure de la table `ANIMAUX_TRAITES`
--

CREATE TABLE `ANIMAUX_TRAITES` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(40) NOT NULL,
  `espece` VARCHAR(30) NOT NULL,
  `race` VARCHAR(30) NOT NULL,
  `taille` SMALLINT,
  `genre` VARCHAR(8) NOT NULL,
  `castre` TINYINT(1) NOT NULL,
  `poids` FLOAT,
  `id_particulier` INT,
  `id_organisme` INT,
  FOREIGN KEY (`id_particulier`) REFERENCES `PARTICULIERS`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_organisme`) REFERENCES `ORGANISME`(`id`) ON DELETE CASCADE
);

--
-- Contenu de la table `ANIMAUX_TRAITES`
--

INSERT INTO `ANIMAUX_TRAITES` (`nom`, `espece`, `race`, `taille`, `genre`, `castre`, `poids`, `id_particulier`, `id_organisme`) VALUES
('Dubsky', 'Chien', 'Chihuahua', 17, 'Mâle', 1, 3.5, 1, NULL),
('Vanille', 'Chat', 'Siamois', 23, 'Femelle', 1, 2.1, 2, NULL),
('Pyro', 'Hamster', 'Doré', 50, 'Mâle', 0, 0.5, 3, NULL),
('Ava', 'Chien', 'Husky', 100, 'Femelle', 0, 21.0, 3, NULL),
('Marco', 'Cheval', 'Poney', 150, 'Mâle', 0, 525, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `MEDICAMENTS`
--

CREATE TABLE `MEDICAMENTS` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL DEFAULT '',
  `dilutions` varchar(40) NOT NULL,
  `conditionnement` varchar(15)
);

--
-- Contenu de la table `MEDICAMENTS`
--

INSERT INTO `MEDICAMENTS` (`nom`, `dilutions`, `conditionnement`) VALUES
('Ocryl', '1 portion', NULL),
('Vaccin', '1 portion', 'Lots');

-- --------------------------------------------------------

--
-- Structure de la table `VACCINATIONS`
--

CREATE TABLE `VACCINATIONS` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `maladies` VARCHAR(100) NOT NULL,
  `date` DATE NOT NULL,
  `id_animal` INT NOT NULL,
  `id_medicament` INT NOT NULL,
  FOREIGN KEY (`id_animal`) REFERENCES `ANIMAUX_TRAITES`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_medicament`) REFERENCES `MEDICAMENTS`(`id`) ON DELETE CASCADE
);

--
-- Contenu de la table `ANIMAUX_TRAITES`
--

INSERT INTO `VACCINATIONS` (`maladies`, `date`, `id_animal`, `id_medicament`) VALUES
('Rage', '2015-06-15', 1, 2),
('Rage, Legionellose, Leptospirose', '2017-01-01', 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `CONSULTATION`
--

CREATE TABLE `CONSULTATION` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `duree` INT NOT NULL,
  `anamnese` VARCHAR(1000) NOT NULL,
  `diagnostic` VARCHAR(1000) NOT NULL,
  `manipulation` VARCHAR(1000),
  `suivi` VARCHAR(500) NOT NULL,
  `prix` INT NOT NULL,
  `id_rendezvous` INT NOT NULL,
  FOREIGN KEY (`id_rendezvous`) REFERENCES `RENDEZ_VOUS`(`id`) ON DELETE CASCADE
);

--
-- Contenu de la table `CONSULTATION`
--

INSERT INTO `CONSULTATION` (`duree`, `anamnese`, `diagnostic`, `manipulation`, `suivi`, `prix`, `id_rendezvous`) VALUES
(30, 'Dubsky a du mal a marcher avec sa patte gauche. C''est un problème qui est, à priori, fonctionnel, provenant de sa patte arrière gauche. L''animal a souvent aboyé selon le propriétaire. Le patient attend une manipulation sur l''os de sa patte gauche.', 'Os de la patte gauche déplacé.', 'Replacement de l''os de la patte gauche.', 'Retour sur cabinet pour dans 3 semaines pour consulter l''état du chien.', 40, 1),
(15, 'Le chat éternue; tousse et présente des mauvais signes depuis un certain temps, selon son propriétaire. Il attend un qu''on lui fournisse un traitement afin de régler le soucis.', 'les voies respiratoires sont infectées (écoulement des yeux et du nez), le chat éternue, tousse, est fiévreux : c''est une rhinotrachéite.', NULL, 'Traitement numéro 1. Retour du chat en cabinet d''ici 1 semaine.', 25, 2),
(15, 'Écoulements et éternuements répétitifs du Hamster. Le patient ne comprend pas ce qu''il lui arrive, il indique que cela se produit depuis quelques jours déjà. Il attend un traitement.', 'Le hamster a attrapé froid à la cage thoracique. Il a attrapé un rhume.', NULL, 'Après traitement, revenir dans un mois au cabinet.', 15, 3);

-- --------------------------------------------------------

--
-- Structure de la table `traitement`
--

CREATE TABLE `traitement` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `dilution` varchar(30),
  `frequence` varchar(50) NOT NULL,
  `doses` INT NOT NULL,
  `duree` INT NOT NULL,
  `id_animal` INT NOT NULL,
  `id_consultation` INT NOT NULL,
  `id_medicament` INT NOT NULL,
  FOREIGN KEY (`id_animal`) REFERENCES `ANIMAUX_TRAITES`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_consultation`) REFERENCES `CONSULTATION`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_medicament`) REFERENCES `MEDICAMENTS`(`id`) ON DELETE CASCADE
);

--
-- Contenu de la table `traitement`
--

INSERT INTO `traitement` (`dilution`, `frequence`, `doses`, `duree`, `id_animal`, `id_consultation`, `id_medicament`) VALUES
(NULL, '1 fois', 1, 1, 2, 2, 2),
('5CH', 'Tous les soirs', 1, 21, 3, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `fonction` varchar(60) NOT NULL,
  `id_organisme` INT NOT NULL,
  `id_particulier` INT NOT NULL,
  FOREIGN KEY (`id_organisme`) REFERENCES `ORGANISME`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_particulier`) REFERENCES `PARTICULIERS`(`id`) ON DELETE CASCADE
);

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`fonction`, `id_organisme`, `id_particulier`) VALUES
('Éleveur', 1, 2),
('Intermittent', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `LOGIN`
--

CREATE TABLE `LOGIN` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `utilisateur` varchar(255) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `dateInscription` DATETIME NOT NULL,
  `role` VARCHAR(30) NOT NULL DEFAULT 'user',
  `id_particulier` INT,
  FOREIGN KEY (`id_particulier`) REFERENCES `PARTICULIERS`(`id`) ON DELETE CASCADE
);

--
-- Contenu de la table `LOGIN`
--

INSERT INTO `LOGIN` (`utilisateur`, `motDePasse`, `dateInscription`, `role`, `id_particulier`) VALUES
('albert8', 'albert24', '2020-05-01 12:35:00', 'user', 1),
('niska93', 'lacite', '2020-01-01 15:15:00', 'user', 2),
('donat45', 'jaimeleshaches', '2020-03-07 00:00:00', 'user', 3);

-- --------------------------------------------------------

--
-- Structure de la table `RENDEZ_VOUS`
--

CREATE TABLE `RENDEZ_VOUS` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(20) NOT NULL,
  `lieu` VARCHAR(30) NOT NULL,
  `date` DATETIME NOT NULL,
  `id_particulier` INT NOT NULL,
  `id_animal` INT NOT NULL,
  FOREIGN KEY (`id_particulier`) REFERENCES `PARTICULIERS`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id_animal`) REFERENCES `ANIMAUX_TRAITES`(`id`) ON DELETE CASCADE
);

--
-- Contenu de la table `RENDEZ_VOUS`
--
INSERT INTO `RENDEZ_VOUS` (`type`, `lieu`, `date`, `id_particulier`, `id_animal`) VALUES
('Osthéopathique', 'Cabinet', '2019-12-19 11:30:00', 1, 1),
('Homéopathique', 'Chez le propriétaire', '2019-12-20 09:00:00', 2, 2),
('Homéopathique', 'Cabinet', '2019-12-22 10:00:00', 3, 3);
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
