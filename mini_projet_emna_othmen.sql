-- Base de données pour le projet Film Management Application
-- Auteur: Emna Othmen
-- Date: 2026-01-03

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Base de données: `mini_projet_emna_othmen`
CREATE DATABASE IF NOT EXISTS `mini_projet_emna_othmen` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mini_projet_emna_othmen`;

-- --------------------------------------------------------

-- Structure de la table `films`
CREATE TABLE `films` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `realisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_sortie` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` int(11) NOT NULL,
  `langue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Données de la table `films`
INSERT INTO `films` (`id`, `titre`, `realisateur`, `pays`, `date_sortie`, `description`, `poster`, `duree`, `langue`, `created_at`, `updated_at`) VALUES
(1, 'Inception', 'Christopher Nolan', 'États-Unis', '2010-07-16', 'Un voleur qui s\'infiltre dans les rêves des autres pour voler leurs secrets.', 'inception.jpg', 148, 'Anglais', '2026-01-03 12:42:07', '2026-01-03 12:42:07'),
(2, 'The Matrix', 'Lana et Lilly Wachowski', 'États-Unis', '1999-03-31', 'Un programmeur découvre que la réalité qu\'il connaît n\'est qu\'une simulation.', 'matrix.jpg', 136, 'Anglais', '2026-01-03 12:42:07', '2026-01-03 12:42:07'),
(3, 'Amélie', 'Jean-Pierre Jeunet', 'France', '2001-04-25', 'Une jeune femme décide d\'aider les autres à trouver le bonheur.', 'amelie.jpg', 122, 'Français', '2026-01-03 12:42:07', '2026-01-03 12:42:07'),
(4, 'Parasite', 'Bong Joon-ho', 'Corée du Sud', '2019-05-30', 'Une famille pauvre s\'infiltre dans la vie d\'une famille riche.', 'parasite.jpg', 132, 'Coréen', '2026-01-03 12:42:07', '2026-01-03 12:42:07'),
(5, 'Interstellar', 'Christopher Nolan', 'États-Unis', '2014-11-07', 'Un groupe d\'explorateurs voyage à travers un trou de ver dans l\'espace.', 'interstellar.jpg', 169, 'Anglais', '2026-01-03 12:42:07', '2026-01-03 12:42:07');

-- --------------------------------------------------------

-- Structure de la table `migrations`
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Index pour les tables déchargées

-- Index pour la table `films`
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

-- Index pour la table `migrations`
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT pour les tables déchargées

-- AUTO_INCREMENT pour la table `films`
ALTER TABLE `films`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

-- AUTO_INCREMENT pour la table `migrations`
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

COMMIT;