--
-- Structure de la table `#__stage_utilisateurs`
--
CREATE TABLE `#__stage_utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prenom` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT '2020-01-01 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT 0,
  `modified` datetime NOT NULL DEFAULT '2020-01-01 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT 0,
  `hits` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `#__stage_utilisateurs`
--
INSERT INTO `#__stage_utilisateurs` (`id`, `nom`, `prenom`, `email`, `alias`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, '-', '', '', '', 0, '2020-06-18 18:00:00', 0, '2020-06-18 18:00:00', 0, 0);

--
-- Index pour la table `#__stage_utilisateurs`
--
ALTER TABLE `#__stage_utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour la table `#__stage_utilisateurs`
--
ALTER TABLE `#__stage_utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
