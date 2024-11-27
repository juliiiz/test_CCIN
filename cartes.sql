-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 27 nov. 2024 à 12:10
-- Version du serveur : 10.8.8-MariaDB-1:10.8.8+maria~ubu2204
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cartes`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241124193252', '2024-11-24 19:33:02', 44),
('DoctrineMigrations\\Version20241124200151', '2024-11-24 20:02:00', 62),
('DoctrineMigrations\\Version20241124204629', '2024-11-24 20:46:40', 225);

-- --------------------------------------------------------

--
-- Structure de la table `energie`
--

CREATE TABLE `energie` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `energie`
--

INSERT INTO `energie` (`id`, `type`) VALUES
(1, 'plante'),
(2, 'electrique'),
(3, 'obscurite'),
(4, 'feu'),
(5, 'eau'),
(6, 'psy'),
(7, 'combat'),
(8, 'fee'),
(9, 'metal'),
(10, 'dragon'),
(11, 'incolore');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon`
--

CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `pv` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `energie_id` int(11) DEFAULT NULL,
  `serie_id` int(11) DEFAULT NULL,
  `commande_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pokemon`
--

INSERT INTO `pokemon` (`id`, `nom`, `pv`, `type`, `photo`, `energie_id`, `serie_id`, `commande_id`) VALUES
(1, 'Bulbizarre', 70, 'Pokemon', NULL, 1, 1, NULL),
(2, 'Salamèche', 60, 'Pokemon', NULL, 4, 1, NULL),
(3, 'Carapuce', 60, 'Pokemon', NULL, 5, 1, NULL),
(4, 'Électrode', 90, 'pokemon', NULL, 2, 2, NULL),
(5, 'M. Mime', 40, 'pokemon', NULL, 6, 2, NULL),
(6, 'Insécateur', 70, 'pokemon', NULL, 1, 2, NULL),
(7, 'Tauros', 130, 'pokemon', NULL, 7, 3, NULL),
(8, 'Altaria', 120, 'pokemon', NULL, 10, 3, NULL),
(9, 'Évoli', 50, 'pokemon', NULL, 11, 3, NULL),
(10, 'Coatox', 110, 'pokemon', NULL, 3, 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

CREATE TABLE `serie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `date_sortie` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`id`, `nom`, `date_sortie`) VALUES
(1, 'Set de base', '1999-11-18'),
(2, 'Jungle', '2000-07-01'),
(3, 'Étincelles Déferlantes', '2024-11-08'),
(4, 'Épée et bouclier', '2020-02-07');

-- --------------------------------------------------------

--
-- Structure de la table `tournoi`
--

CREATE TABLE `tournoi` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tournoi`
--

INSERT INTO `tournoi` (`id`, `nom`, `date`) VALUES
(1, 'tournoi d\'hiver', '2024-12-25'),
(2, 'tournoi d\'été', '2024-08-20'),
(3, 'tournoi Halloween', '2024-10-31'),
(4, 'tournoi du nouvel an', '2025-01-01'),
(5, 'test', '2024-11-26'),
(6, 'test', '2024-11-26'),
(7, 'tournoi de fin d\'année', '2024-11-26');

-- --------------------------------------------------------

--
-- Structure de la table `tournoi_pokemon`
--

CREATE TABLE `tournoi_pokemon` (
  `tournoi_id` int(11) NOT NULL,
  `pokemon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tournoi_pokemon`
--

INSERT INTO `tournoi_pokemon` (`tournoi_id`, `pokemon_id`) VALUES
(1, 1),
(1, 2),
(1, 6),
(2, 7),
(2, 9),
(3, 8),
(4, 3),
(4, 9),
(4, 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `energie`
--
ALTER TABLE `energie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62DC90F3B732A364` (`energie_id`),
  ADD KEY `IDX_62DC90F3D94388BD` (`serie_id`),
  ADD KEY `IDX_62DC90F382EA2E54` (`commande_id`);

--
-- Index pour la table `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tournoi`
--
ALTER TABLE `tournoi`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tournoi_pokemon`
--
ALTER TABLE `tournoi_pokemon`
  ADD PRIMARY KEY (`tournoi_id`,`pokemon_id`),
  ADD KEY `IDX_4F282CD0F607770A` (`tournoi_id`),
  ADD KEY `IDX_4F282CD02FE71C3E` (`pokemon_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `energie`
--
ALTER TABLE `energie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `serie`
--
ALTER TABLE `serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tournoi`
--
ALTER TABLE `tournoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pokemon`
--
ALTER TABLE `pokemon`
  ADD CONSTRAINT `FK_62DC90F382EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_62DC90F3B732A364` FOREIGN KEY (`energie_id`) REFERENCES `energie` (`id`),
  ADD CONSTRAINT `FK_62DC90F3D94388BD` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`);

--
-- Contraintes pour la table `tournoi_pokemon`
--
ALTER TABLE `tournoi_pokemon`
  ADD CONSTRAINT `FK_4F282CD02FE71C3E` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4F282CD0F607770A` FOREIGN KEY (`tournoi_id`) REFERENCES `tournoi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
