
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Base de données : `wiki_gestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idcategory` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `idtag` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `motpasse` varchar(255) NOT NULL,
  `roleuser` enum('Admin','author') DEFAULT 'author'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wiki`
--

CREATE TABLE `wiki` (
  `id_wiki` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `nom` varchar(255) NOT NULL,
  `content` varchar(600) NOT NULL,
  `idcat` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `isdisable` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wiki_tag`
--

CREATE TABLE `wiki_tag` (
  `wiki_id` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idcategory`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`idtag`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `wiki`
--
ALTER TABLE `wiki`
  ADD PRIMARY KEY (`id_wiki`),
  ADD KEY `fk_cat` (`idcat`),
  ADD KEY `fk_user` (`iduser`);

--
-- Index pour la table `wiki_tag`
--
ALTER TABLE `wiki_tag`
  ADD PRIMARY KEY (`wiki_id`,`id_tag`),
  ADD KEY `fk_tag` (`id_tag`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idcategory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `idtag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `wiki`
--
ALTER TABLE `wiki`
  MODIFY `id_wiki` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `wiki`
--
ALTER TABLE `wiki`
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`idcat`) REFERENCES `categorie` (`idcategory`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `wiki_tag`
--
ALTER TABLE `wiki_tag`
  ADD CONSTRAINT `fk_tag` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`idtag`),
  ADD CONSTRAINT `fk_wiki` FOREIGN KEY (`wiki_id`) REFERENCES `wiki` (`id_wiki`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
