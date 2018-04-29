-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 16 avr. 2018 à 21:29
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

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `preparation` time NOT NULL,
  `cuisson` time NOT NULL,
  `difficulte` tinyint(3) UNSIGNED NOT NULL,
  `prix` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `auteur` tinyint(3) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `note` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `recettesingredients`
--

CREATE TABLE `recettesingredients` (
  `id` int(10) UNSIGNED NOT NULL,
  `recette` mediumint(8) UNSIGNED NOT NULL,
  `ingredient` int(10) UNSIGNED NOT NULL,
  `unite` tinyint(3) UNSIGNED NOT NULL,
  `quantite` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `recettesustensiles`
--

CREATE TABLE `recettesustensiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `recette` mediumint(8) UNSIGNED NOT NULL,
  `ustensile` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

CREATE TABLE `unites` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantifiable` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `pseudo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Index pour la table `recettesustensiles`
--
ALTER TABLE `recettesustensiles`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `recettesingredients`
--
ALTER TABLE `recettesingredients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `recettesustensiles`
--
ALTER TABLE `recettesustensiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `unites`
--
ALTER TABLE `unites`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ustensiles`
--
ALTER TABLE `ustensiles`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
