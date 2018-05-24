-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 24 mai 2018 à 14:16
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cookblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `etapes`
--

CREATE TABLE `etapes` (
  `id` int(10) UNSIGNED NOT NULL,
  `recette` mediumint(8) UNSIGNED NOT NULL,
  `numero` tinyint(3) UNSIGNED NOT NULL,
  `instruction` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etapes`
--

INSERT INTO `etapes` (`id`, `recette`, `numero`, `instruction`) VALUES
(1, 1, 1, 'Coupez les tomates en 4, mélangez tout, salez, poivrez et versez un filet d’huile d’olive.'),
(2, 1, 2, 'Salez, poivrez et versez un filet d’huile d’olive.'),
(3, 1, 3, 'Décorez avec quelques feuilles de basilic.'),
(4, 2, 1, 'Faites revenir les échalotes dans la margarine jusqu&#39;à ce qu&#39;elles soient dorées.'),
(5, 2, 2, 'Ajoutez ensuite les lardons, faites les cuire jusqu&#39;à ce qu&#39;ils soient bien bruns.\r\n'),
(6, 2, 3, 'Ajoutez une petite tasse d&#39;eau.'),
(7, 2, 4, 'Ajoutez le vinaigre puis liez avec le miel.'),
(8, 2, 5, 'Préparez sur une assiette un peu de laitue.'),
(9, 2, 6, 'Ajoutez quelques lamelles de poivrons et quelques croûtons.'),
(10, 2, 7, 'Versez la préparation dessus et servez.'),
(11, 3, 1, 'Zzzzzzzzzzzzzzzzzzzz'),
(12, 3, 2, 'Zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz'),
(13, 3, 3, 'Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`id`, `nom`) VALUES
(1, 'Farine'),
(2, 'Eau'),
(3, 'Poivre'),
(4, 'Oeufs'),
(5, 'Tomates cerise'),
(6, 'Billes de mozzarella'),
(7, 'Basilic'),
(8, 'Câpres'),
(9, 'Huile d&#39;olive'),
(10, 'Sel'),
(11, 'Laitues'),
(12, 'Poivrons rouge'),
(13, 'Echalotes'),
(14, 'Margarine'),
(15, 'Vinaigre de framboises'),
(16, 'Miel liquide d&#39;acacia'),
(17, 'Lardons'),
(18, 'Croûtons'),
(19, 'Lait');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duree` time NOT NULL,
  `difficulte` tinyint(3) UNSIGNED NOT NULL,
  `prix` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `ajout` datetime NOT NULL,
  `auteur` tinyint(3) UNSIGNED NOT NULL,
  `note` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id`, `nom`, `description`, `duree`, `difficulte`, `prix`, `type`, `ajout`, `auteur`, `note`) VALUES
(1, 'Roulement entre tomate et mozzarella', 'Petite salade à base de tomates cerise et de billes de mozzarella', '00:10:00', 1, 1, 4, '2018-05-24 09:49:59', 1, 2),
(2, 'Mélange d&#39;été', 'Petite salade composée', '00:20:00', 1, 1, 4, '2018-05-24 11:22:40', 1, 1),
(3, 'Aaaaaaaaaaaaaaa', 'Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '00:10:00', 2, 2, 3, '2018-05-24 14:00:41', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `recettesingredients`
--

CREATE TABLE `recettesingredients` (
  `id` int(10) UNSIGNED NOT NULL,
  `recette` mediumint(8) UNSIGNED NOT NULL,
  `ingredient` int(10) UNSIGNED NOT NULL,
  `unite` tinyint(3) UNSIGNED NOT NULL,
  `quantite` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recettesingredients`
--

INSERT INTO `recettesingredients` (`id`, `recette`, `ingredient`, `unite`, `quantite`) VALUES
(1, 1, 5, 3, 8750),
(2, 1, 6, 3, 6250),
(3, 1, 7, 5, 25),
(4, 1, 8, 5, 25),
(5, 1, 9, 6, 25),
(6, 1, 10, 1, 0),
(7, 1, 3, 1, 0),
(8, 2, 11, 1, 0),
(9, 2, 12, 1, 0),
(10, 2, 13, 2, 50),
(11, 2, 14, 1, 0),
(12, 2, 15, 5, 75),
(13, 2, 16, 1, 0),
(14, 2, 17, 3, 7500),
(15, 2, 18, 1, 0),
(16, 3, 1, 3, 7500),
(17, 3, 4, 2, 50),
(18, 3, 19, 4, 1250);

-- --------------------------------------------------------

--
-- Structure de la table `recettesustensiles`
--

CREATE TABLE `recettesustensiles` (
  `recette` mediumint(8) UNSIGNED NOT NULL,
  `ustensile` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

CREATE TABLE `unites` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nomBase` varchar(255) NOT NULL,
  `nomPlus` varchar(255) DEFAULT NULL,
  `charniere` smallint(5) UNSIGNED DEFAULT NULL,
  `quantifiable` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `unites`
--

INSERT INTO `unites` (`id`, `nomBase`, `nomPlus`, `charniere`, `quantifiable`) VALUES
(4, 'cl', 'l', 100, 1),
(3, 'g', 'kg', 1000, 1),
(5, 'c. à soupe', NULL, NULL, 1),
(6, 'c. à café', NULL, NULL, 1),
(7, 'Une pincée', NULL, NULL, 0),
(2, 'Unité', NULL, NULL, 1),
(1, 'Sans', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pseudo`, `role`, `date`) VALUES
(1, 'oliviagometz@gmail.com', '$2y$10$HYZ1nZCaUrzEYZ19Rv01DOmZDnXCTc9OJUBi2mjaL1BgrLAPqnd3G', 'Olivia', 2, '2018-05-15 16:49:49'),
(2, 'mail@gmail.com', '$2y$10$97fgIshajrN8mDWst0iO8Ov8fveUBtDncuGbIO2R8kwEVQH8lo9yi', 'Zaher', 2, '2018-05-24 11:54:49');

-- --------------------------------------------------------

--
-- Structure de la table `ustensiles`
--

CREATE TABLE `ustensiles` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etapes`
--
ALTER TABLE `etapes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recettesingredients`
--
ALTER TABLE `recettesingredients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `unites`
--
ALTER TABLE `unites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ustensiles`
--
ALTER TABLE `ustensiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etapes`
--
ALTER TABLE `etapes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `recettesingredients`
--
ALTER TABLE `recettesingredients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `unites`
--
ALTER TABLE `unites`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `ustensiles`
--
ALTER TABLE `ustensiles`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
