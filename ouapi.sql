-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 18 mai 2026 à 12:47
-- Version du serveur : 8.0.45-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ouapi`
--

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_config`
--

CREATE TABLE `ouapi_config` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subcategory` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `valeur` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `form_type` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `globale` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_config`
--

INSERT INTO `ouapi_config` (`id`, `nom`, `subcategory`, `libelle`, `description`, `valeur`, `form_type`, `globale`) VALUES
(1, 'param_help', '', 'Affichage de l\'aide', 'Affiche les bulles d\'aide dans les rubriques', '1', 'radio_yn', 1),
(2, 'rght_sum', '', 'Affiche le bouton Résumé', 'Affiche le bouton Résumé', 'SUM1', 'radio_yn', 1),
(3, 'rght_gen_multisite', '', '[Multisite] Accès à tous les sites', NULL, 'GENM1', '', 1),
(4, 'rght_hard', '', '[Rubrique Matériels] Niv. 1 : Consultation', NULL, 'HARD1', '', 1),
(5, 'rght_hard_edit', '', '[Rubrique Matériels] Niv. 2 : Edition', NULL, 'HARD2', '', 1),
(6, 'rght_hard_admin', '', '[Rubrique Matériels] Niv. 3 : Administration', NULL, 'HARD3', '', 1),
(7, 'rght_periph', '', '[Rubrique Périphériques] Niv. 1 : Consultation', NULL, 'PERI1', '', 1),
(8, 'rght_periph_edit', '', '[Rubrique Périphériques] Niv. 2 : Edition', NULL, 'PERI2', '', 1),
(9, 'rght_periph_admin', '', '[Rubrique Périphériques] Niv. 3 : Administration', NULL, 'PERI3', '', 1),
(10, 'rght_soft', '', '[Rubrique Logiciels] Niv. 1 : Consultation', NULL, 'SOFT1', '', 1),
(11, 'rght_soft_edit', '', '[Rubrique Logiciels] Niv. 2 : Edition', NULL, 'SOFT2', '', 1),
(12, 'rght_soft_admin', '', '[Rubrique Logiciels] Niv. 3 : Administration', NULL, 'SOFT3', '', 1),
(13, 'rght_users', '', '[Rubrique Utilisateurs] Niv. 1 : Consultation', NULL, 'USER1', '', 1),
(14, 'rght_users_edit', '', '[Rubrique Utilisateurs] Niv. 2 : Edition', NULL, 'USER2', '', 1),
(15, 'rght_users_admin', '', '[Rubrique Utilisateurs] Niv. 3 : Administration', NULL, 'USER3', '', 1),
(16, 'rght_netw', '', '[Rubrique Réseau] Niv. 1 : Consultation', NULL, 'NETW1', '', 1),
(17, 'rght_netw_edit', '', '[Rubrique Réseau] Niv. 2 : Edition', NULL, 'NETW2', '', 1),
(18, 'rght_netw_admin', '', '[Rubrique Réseau] Niv. 3 : Administration', NULL, 'NETW3', '', 1),
(19, 'rght_resa', '', '[Rubrique Réservations] Niv. 1 : Consultation', NULL, 'RESA1', '', 1),
(20, 'rght_resa_edit', '', '[Rubrique Réservations] Niv. 2 : Edition', NULL, 'RESA2', '', 1),
(21, 'rght_resa_admin', '', '[Rubrique Réservations] Niv. 3 : Administration', NULL, 'RESA3', '', 1),
(22, 'rght_docs', '', '[Rubrique Documents] Niv. 1 : Consultation', NULL, 'DOCS1', '', 1),
(23, 'rght_docs_edit', '', '[Rubrique Documents] Niv. 2 : Edition', NULL, 'DOCS2', '', 1),
(24, 'rght_docs_admin', '', '[Rubrique Documents] Niv. 3 : Administration', NULL, 'DOCS3', '', 1),
(25, 'rght_even', '', '[Rubrique Evenements] Niv. 1 : Consultation', NULL, 'EVEN1', '', 1),
(26, 'rght_even_edit', '', '[Rubrique Evenements] Niv. 2 : Edition', NULL, 'EVEN2', '', 1),
(27, 'rght_even_admin', '', '[Rubrique Evenements] Niv. 3 : Administration', NULL, 'EVEN3', '', 1),
(28, 'rght_admin', '', '[Outils Administration] Niv. 1 : Consultation', NULL, 'ADMI1', '', 1),
(29, 'rght_gen_tableedit', '', '[Général] Gestion des tables secondaires', NULL, 'GENT1', '', 1),
(30, 'rght_my', '', '[Mon espace] Consultation', NULL, 'MYSP1', '', 1),
(31, 'netw_hardtype', '', 'Type de matériels associés au réseau', NULL, '6;9;', '', 0),
(32, 'maj_hardtype', '', 'Type de matériels pouvant être mis à jour', NULL, '1;2;7;', '', 0),
(33, 'gen_version', '', 'Version du logiciel', NULL, '1.5', '', 1),
(34, 'gen_dateinstall', '', 'Date d\'installation de OUAPI', NULL, '1778008753', '', 1),
(35, 'gen_datelastmaj', '', 'Date de dernière MAJ de OUAPI', NULL, '1778008753', '', 1),
(36, 'gen_statsdate', '', 'Date d\'envoi des stats', NULL, '', '', 1),
(37, 'gen_statsyn', '', 'Activation de l\'envoi des stats', NULL, '1', '', 1),
(38, 'default_language', 'default_userparam', 'Langue par défaut', NULL, 'FR', '', 1),
(39, 'default_template', 'default_userparam', 'Template par défaut', NULL, 'default', '', 1),
(40, 'param_debug_mode', '', 'Activer le mode debug', 'Affiche les requètes SQL, les erreurs PHP et SQL', '0', 'radio_yn', 1),
(41, 'param_enable_guest', '', 'Activer le profil invité', 'Permet d\'utiliser OUAPI sans authentification', '0', 'radio_yn', 1),
(42, 'activrub_users', 'rub', 'Activer la rubrique Utilisateurs', 'Active ou désative la rubrique utilisateurs de OUAPI', '1', 'radio_yn', 1),
(43, 'activrub_netw', 'rub', 'Activer la rubrique Réseau', 'Active ou désative la rubrique réseau de OUAPI', '1', 'radio_yn', 1),
(44, 'activrub_docs', 'rub', 'Activer la rubrique Documents', 'Active ou désative la rubrique documents de OUAPI', '1', 'radio_yn', 1),
(45, 'activrub_resa', 'rub', 'Activer la rubrique Réservation', 'Active ou désative la rubrique réservation de OUAPI', '1', 'radio_yn', 1),
(46, 'activrub_soft', 'rub', 'Activer la rubrique Logiciels', 'Active ou désative la rubrique logiciels de OUAPI', '1', 'radio_yn', 1),
(47, 'activrub_periph', 'rub', 'Activer la rubrique Périphériques', 'Active ou désative la rubrique périphériques de OUAPI', '1', 'radio_yn', 1),
(48, 'activrub_hard', 'rub', 'Activer la rubrique Matériels', 'Active ou désative la rubrique matériels de OUAPI', '1', 'radio_yn', 1),
(49, 'activrub_sum', 'rub', 'Affiche le bouton Résumé', 'Affiche le bouton Résumé', '1', 'radio_yn', 1),
(50, 'activrub_even', 'rub', 'Activer la rubrique Evenements', 'Active ou désative la rubrique événements de OUAPI', '0', 'radio_yn', 1),
(51, 'rght_search', '', '[Moteur de recherche] Accès', NULL, 'SEAR1', '', 1),
(52, 'rght_ocs', '', '[Module OCS] Niv. 1 : Consultation', NULL, 'OCS1', '', 1),
(53, 'rght_ocs_edit', '', '[Module OCS] Niv. 2 : Edition', NULL, 'OCS2', '', 1),
(54, 'rght_ocs_admin', '', '[Module OCS] Niv. 3 : Administration', NULL, 'OCS3', '', 1),
(55, 'rght_ldap', '', '[Module LDAP] Niv. 1 : Consultation', NULL, 'LDAP1', '', 1),
(56, 'rght_ldap_edit', '', '[Module LDAP] Niv. 2 : Edition', NULL, 'LDAP2', '', 1),
(57, 'rght_ldap_admin', '', '[Module LDAP] Niv. 3 : Administration', NULL, 'LDAP3', '', 1),
(58, 'activrub_ocs', 'rub', 'Activer la rubrique OCS', 'Active ou désative la rubrique OCS de OUAPI', '0', 'radio_yn', 1),
(59, 'activrub_ldap', 'rub', 'Activer la rubrique LDAP', 'Active ou désative la rubrique LDAP de OUAPI', '0', 'radio_yn', 1),
(60, 'db_ocs_host', NULL, 'Serveur OCS', 'Nom ou adresse IP du serveur OCS', 'localhost', 'text', 1),
(61, 'db_ocs_user', NULL, 'Utilisateur OCS', 'Login de connexion au serveur OCS', 'ocs', 'text', 1),
(62, 'db_ocs_mdp', NULL, 'Mot de passe OCS', 'Mot de passe de connexion au serveur OCS', 'ocs', 'text', 1),
(63, 'db_ocs_transm', NULL, 'Base OCS', 'Nom de la base MySQL OCS', 'ocsweb', 'text', 1),
(64, 'ldap_host', 'general', 'Serveur LDAP', 'Nom ou adresse IP du serveur LDAP', 'localhost', 'text', 1),
(65, 'ldap_user', 'general', 'Utilisateur LDAP', 'Login de connexion au serveur LDAP', 'root', 'text', 1),
(66, 'ldap_mdp', 'general', 'Mot de passe LDAP', 'Mot de passe de connexion au serveur LDAP', '', 'text', 1),
(67, 'ldap_port', 'general', 'Port LDAP', 'Port de connexion au serveur LDAP', '389', 'text', 1),
(68, 'ldap_mask', 'users', 'Racine LDAP Utilisateurs', 'Racine de recherche des Utilisateurs de votre annuaire (Ex: OU=Users,DC=monentreprise,DC=com).', 'OU=Utilisateurs,dc=mycompany,dc=com', 'text', 1),
(69, 'ldap_mask_hard', 'hard', 'Racine LDAP Ordinateurs', 'Racine de recherche des Ordinateurs de votre annuaire (Ex: OU=Computers,DC=monentreprise,DC=com).', 'OU=Ordinateurs,dc=mycompany,dc=com', 'text', 1),
(70, 'ldap_attr_fname', 'users', 'Attribut Prénom', 'Champ LDAP contenant le prénom de vos utilisateurs (GIVENNAME par défaut).', 'givenname', 'list', 1),
(71, 'ldap_attr_lname', 'users', 'Attribut Nom', 'Champ LDAP contenant le nom de vos utilisateurs (SN par défaut).', 'sn', 'list', 1),
(72, 'ldap_attr_mail', 'users', 'Attribut Mail', 'Champ LDAP contenant le mail de vos utilisateurs (MAIL par défaut).', 'mail', 'list', 1),
(73, 'ldap_attr_loginwin', 'users', 'Attribut Login Windows', 'Champ LDAP contenant le login de vos utilisateurs (SAMACCOUNTNAME par défaut).', 'samaccountname', 'list', 1),
(74, 'ldap_key', 'users', 'Clé LDAP <-> OUAPI', 'Champ faisant le lien entre OUAPI et LDAP.', 'mail', 'list', 1),
(75, 'ldap_attr_hard_name', 'hard', 'Attribut Nom de machine', 'Champ LDAP contenant le nom de vos machines (NAME par défaut).', 'name', 'list', 1),
(76, 'ldap_attr_hard_description', 'hard', 'Attribut Description', 'Champ LDAP contenant la description de vos machines (DESCRIPTION par défaut)', 'description', 'list', 1),
(78, 'pfparam_ouapi_peripherique.pfield_garantit', NULL, 'ouapi_peripherique.pfield_garantit', '', 'Garantit', '', 0),
(79, 'pfparam_ouapi_software.pfield_oprateur', NULL, 'ouapi_software.pfield_oprateur', '', 'Opérateur', '', 0),
(80, 'pfparam_ouapi_docs.pfield_pages', NULL, 'ouapi_docs.pfield_pages', '', 'Pages', '', 0),
(81, 'pfparam_ouapi_utilisateur.pfield_pseudo', NULL, 'ouapi_utilisateur.pfield_pseudo', '', 'Pseudo', '', 0),
(82, 'pfparam_ouapi_reseau.pfield_ping', NULL, 'ouapi_reseau.pfield_ping', '', 'Ping', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_docs`
--

CREATE TABLE `ouapi_docs` (
  `id` int NOT NULL,
  `entreprise_id` int NOT NULL,
  `reference` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `date_archive` date DEFAULT NULL,
  `agence_id` int NOT NULL,
  `commentaire` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_docs`
--

INSERT INTO `ouapi_docs` (`id`, `entreprise_id`, `reference`, `type_id`, `date`, `date_archive`, `agence_id`, `commentaire`, `path`) VALUES
(1, -1, 'Configuration reseau', 3, '2014-12-03', '2035-12-30', 12, '', '1417620714.odt'),
(2, -1, 'Configuration Areha', 3, '2016-09-07', '2035-12-30', 11, '', '1473339460.odt'),
(4, 1, 'TestFacture', 1, '2026-04-20', '2035-12-30', 48, '', '1776773983.xlsx'),
(5, 1, 'TestContrat', 2, '2026-04-20', '2035-12-30', 48, '', '1776774076.pdf'),
(6, 1, 'TestGarantie', 4, '2026-04-20', '2035-12-30', 48, '', '1776774106.doc'),
(7, 1, 'TestBon', 5, '2026-04-20', '2035-12-30', 48, '', '1776774154.csv'),
(8, 1, 'TestManuel', 3, '2026-04-20', '2035-12-30', 48, '', '1776774193.txt'),
(9, 1, 'TestFacturePérimée', 1, '2026-04-20', '2023-12-30', 48, '', '1776777216.csv');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_docs_type`
--

CREATE TABLE `ouapi_docs_type` (
  `id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_docs_type`
--

INSERT INTO `ouapi_docs_type` (`id`, `libelle`) VALUES
(1, 'Facture'),
(2, 'Contrat'),
(3, 'Manuel'),
(4, 'Garantie'),
(5, 'Bon d\'intervention');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_emplacement`
--

CREATE TABLE `ouapi_emplacement` (
  `id` int NOT NULL,
  `agence_id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_emplacement`
--

INSERT INTO `ouapi_emplacement` (`id`, `agence_id`, `libelle`) VALUES
(89, 14, 'Le Dorat'),
(5, 2, 'CCYF'),
(6, 2, 'AAGDV'),
(7, 2, 'Les Tourterelles'),
(8, 2, 'OT LA SOUT'),
(9, 2, 'Pepiniere'),
(10, 4, 'Bonnac'),
(11, 4, 'Colondannes'),
(54, 11, 'Administration'),
(53, 11, 'MAS'),
(22, 11, 'Foyer Cerisier'),
(23, 11, 'Foyer Tilleul'),
(24, 11, 'Foyer Lilas'),
(25, 11, 'Ferme'),
(55, 7, 'La Brionne'),
(46, 12, 'Atelier'),
(49, 12, 'Expedition'),
(50, 12, 'Salle Info'),
(51, 6, 'DUN RAM'),
(52, 5, 'CDR'),
(56, 1, 'Atelier'),
(57, 1, 'Accueil'),
(58, 1, 'Etage'),
(59, 2, 'SMDLF'),
(60, 12, 'Administratif'),
(61, 14, 'La Gerafie'),
(62, 14, 'La Prade'),
(63, 2, 'Centre Aquatique'),
(64, 2, 'Mediatheque'),
(65, 7, 'Algeco'),
(66, 2, 'POC Les Tourterelles'),
(87, 14, 'Polyvalent'),
(73, 21, 'Administration'),
(74, 21, 'Dechets'),
(75, 21, 'Voirie'),
(76, 21, 'Spanc'),
(77, 6, 'DUN GARE'),
(78, 6, 'OT DUN'),
(79, 29, 'Maison de Pays'),
(80, 15, 'Etage'),
(81, 15, 'RDC'),
(82, 6, 'Fursac ALSH'),
(131, 2, 'Pitchounets'),
(85, 29, 'OT Benevent'),
(88, 12, 'Famille'),
(90, 6, 'FRESSELINES EMR'),
(91, 14, 'Gouzon'),
(92, 12, 'Labo'),
(93, 29, 'Microcreche'),
(94, 16, 'Inergys'),
(95, 1, 'Dun'),
(96, 10, 'Grand Bourg'),
(132, 2, 'RAM'),
(100, 2, 'ALSH LGB'),
(99, 7, 'Bureau 1er'),
(111, 6, 'HOTEL LEPINAT'),
(98, 5, 'ALSH'),
(101, 14, 'Lourdoueix'),
(102, 14, 'Janailhac'),
(103, 16, 'Methodes'),
(104, 16, 'BE'),
(105, 16, 'Atelier'),
(106, 23, 'Ecole'),
(107, 1, 'PRET'),
(119, 42, 'ECOLE PRIMAIRE'),
(109, 40, 'BUREAU'),
(110, 2, 'POC - Aubusson'),
(112, 29, 'ALSH'),
(116, 29, 'SCENOVISION'),
(117, 2, 'CIAS'),
(118, 2, 'Bibliotheque'),
(120, 42, 'RAM'),
(121, 42, 'BIBLIOTHEQUE'),
(122, 12, 'Fromagerie'),
(123, 12, 'Emballage'),
(124, 12, 'Pasto'),
(125, 6, 'TUILERE POULIGNY'),
(134, 42, 'ECOLE MATERNELLE'),
(127, 8, 'Service Technique'),
(128, 8, 'Accueil'),
(129, 8, 'Secrétariat'),
(133, 12, 'ECRAN Salle de Réunion'),
(135, 42, 'MAIRIE'),
(136, 42, 'RESTO SCOLAIRE'),
(137, 21, 'Communication'),
(138, 48, 'Bibliothèque'),
(140, 48, 'Bureau'),
(141, 48, 'Atelier'),
(142, 42, 'ELUS'),
(143, 42, 'CTM');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_entreprise`
--

CREATE TABLE `ouapi_entreprise` (
  `id` int NOT NULL,
  `raison_sociale` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `adresse` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `cpostal` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `telephone` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `num_client` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `note` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_entreprise`
--

INSERT INTO `ouapi_entreprise` (`id`, `raison_sociale`, `adresse`, `cpostal`, `ville`, `telephone`, `num_client`, `note`) VALUES
(1, 'Test', '2 Rue du test', '23000', 'La Souterraine', 'test', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_event`
--

CREATE TABLE `ouapi_event` (
  `id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `creation_date` date DEFAULT NULL,
  `creation_user_id` int NOT NULL,
  `end_date` date DEFAULT NULL,
  `parent_id` int NOT NULL,
  `status_id` int NOT NULL,
  `auto_realize` int NOT NULL,
  `remind_date` date DEFAULT NULL,
  `remind_status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ev_link`
--

CREATE TABLE `ouapi_ev_link` (
  `id` int NOT NULL,
  `even_id` int NOT NULL,
  `hard_id` int NOT NULL,
  `user_id` int NOT NULL,
  `periph_id` int NOT NULL,
  `soft_id` int NOT NULL,
  `doc_id` int NOT NULL,
  `reseau_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ev_status`
--

CREATE TABLE `ouapi_ev_status` (
  `id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_hardware`
--

CREATE TABLE `ouapi_hardware` (
  `id` int NOT NULL,
  `num_serie` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `marque_id` int NOT NULL,
  `modele_id` int NOT NULL,
  `type_id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `os_id` int NOT NULL,
  `cpu_id` int NOT NULL,
  `ram_capacite` int DEFAULT NULL,
  `ram_type_id` int NOT NULL,
  `disque_capacite` int DEFAULT NULL,
  `disque_type_id` int NOT NULL,
  `service_pack` int DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `agence_id` int DEFAULT NULL,
  `emplacement_id` int NOT NULL,
  `ip` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `reservable` int NOT NULL DEFAULT '0',
  `suivi_rebus` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `commentaire` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `pfield_garantie` int DEFAULT NULL,
  `pfield_utilisateurprinc` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `creation_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_hardware`
--

INSERT INTO `ouapi_hardware` (`id`, `num_serie`, `marque_id`, `modele_id`, `type_id`, `nom`, `os_id`, `cpu_id`, `ram_capacite`, `ram_type_id`, `disque_capacite`, `disque_type_id`, `service_pack`, `user_id`, `agence_id`, `emplacement_id`, `ip`, `reservable`, `suivi_rebus`, `commentaire`, `pfield_garantie`, `pfield_utilisateurprinc`, `creation_date`) VALUES
(1, '', 5, 7, 1, 'ACCUEIL', 3, 0, NULL, 0, NULL, 0, NULL, 1, 1, 57, '192.168.0.101', 0, '11', '', 0, 'Cédric', '2011-06-20'),
(2, '', 6, 9, 1, 'POSTE ATELIER', 7, 0, NULL, 0, NULL, 0, NULL, 1, 1, 1, '', 0, 'fin de vie\r\n', '', NULL, NULL, '2011-06-20'),
(3, 'S109414840001', 5, 10, 1, 'Poste chargee de mission', 1, 0, NULL, 0, NULL, 0, NULL, 2, 2, 9, '', 0, 'HS', 'Garantie 3 ans', 3, 'Candie Guerinet', '2008-02-13'),
(4, 'S109414800005', 5, 10, 1, 'PEPS-2', 18, 0, NULL, 0, NULL, 0, NULL, 0, 2, 9, '192.168.1.10', 0, '. obsolète', 'Carte mere remplacee', 3, 'Frederique (Accueil/comcom)', '2008-02-12'),
(181, 'YLLJ010116', 1, 116, 2, 'N532', 3, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, 'HS', '', 3, 'Intermitant 1', '2013-09-25'),
(7, 'YL3M011987', 1, 11, 1, 'P2550-PC', 3, 0, NULL, 0, NULL, 0, NULL, 35, 2, 7, '', 0, 'en secour', '', 3, 'Franck Carry', '2009-12-30'),
(8, 'MAPM1955-01', 8, 12, 1, 'AAGDV', 4, 0, NULL, 0, NULL, 0, NULL, 0, 2, 6, '', 0, '.', '', 1, '', '2011-04-06'),
(9, 'MAPM1955-04', 8, 12, 1, 'TEK1-201104', 22, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, 'HS', 'Intel Celeron E3400 @ 2,6GHz\r\nRAM 3Go\r\nDD 500 Go', 1, 'Président', '2011-04-06'),
(10, 'S100193071006', 5, 13, 2, 'Portable PEP\'S', 1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 9, '', 0, 'y a longtemps', '', 3, '', '2007-12-20'),
(233, 'YL9P004945', 1, 113, 2, 'PC-Christophe', 3, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 0, 'Trop vieux', '', NULL, NULL, '2010-05-10'),
(12, '', 9, 15, 2, 'Portable regie 2', 8, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, 'Disparu', 'Garantie 3 ans', 3, 'Romain Janvier', '2009-10-06'),
(13, 'ZLMW93BSB00335K', 2, 16, 2, 'R519', 6, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, 'HS', '', 3, 'Julien', '2009-12-30'),
(14, 'L50SHASM30K', 10, 17, 1, 'GED', 1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, 'En stock\r\n', 'Garantie 1 an', NULL, NULL, '2004-08-03'),
(15, 'PSPM6E6F0562102C53EL00', 11, 97, 1, 'Poste-Spanc', 1, 0, NULL, 0, NULL, 0, NULL, 37, 2, 7, '', 0, 'c', 'Garantie 3 ans', NULL, NULL, '2006-09-30'),
(17, 'YLDA008454', 1, 81, 1, 'P700 (PC Secretariat)', 3, 0, NULL, 0, NULL, 0, NULL, 7, 2, 7, '', 0, 'Le 23/01/2017', '', 3, 'Isabelle Pagneux', '2011-09-16'),
(18, 'PSPF6E6F06644906667EL00', 11, 19, 1, 'PC Secrétariat Spanc', 1, 0, NULL, 0, NULL, 0, NULL, 38, 2, 7, '', 0, 'c', 'Garantie 3 ans', NULL, NULL, '2007-03-01'),
(19, 'PSPF6E6F06644906660EL00', 11, 19, 1, 'PC Communication', 1, 0, NULL, 0, NULL, 0, NULL, 42, 2, 5, '', 0, 'Sorti', '', 3, 'Sylvain Tudo', '2007-03-01'),
(20, '', 6, 20, 1, 'PC aire des gens du voyage', 2, 0, NULL, 0, NULL, 0, NULL, 0, 2, 6, '', 0, 'en stock', 'Garantie 3 ans\r\n', NULL, NULL, '2003-10-28'),
(21, 'ZOKT93GZ300167', 2, 21, 2, 'Portable Direction', 6, 0, NULL, 0, NULL, 0, NULL, 36, 2, 7, '', 0, 'v', '', 5, 'Jean Philippe Labregere', '2010-06-23'),
(22, 'LX5505A8660308E7CEM00', 11, 22, 2, 'Portable Acer', 2, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, 'Sorti', '', 3, '', '2006-05-12'),
(23, '806483090008', 5, 23, 5, 'SERVEUR', 9, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, 'Retraite', '', 3, 'Administrateur', '2008-02-19'),
(24, 's111176340002', 5, 24, 1, 'GillesPC', 1, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, ' .', '', 3, 'Gilles Prout', '2009-03-12'),
(25, 'YKQB112765', 1, 1, 1, 'P2540 - PC bungalo AT', 1, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', '', 3, 'Atelier', '2009-10-09'),
(26, 'YL4W007546', 1, 25, 5, 'Sage-Serveur ', 10, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, 'Virtualisé', 'Garantie 3 ans', NULL, NULL, '2011-01-20'),
(27, 'B97505J', 13, 26, 5, 'Serveur Dell', -1, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '16/01/2018', 'Garantie 3 ans', NULL, NULL, '2011-03-18'),
(30, '21AV2H23074', 14, 28, 3, 'OKI', -1, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Garantie 2 ans', 0, 'Magasin', '2007-09-19'),
(29, 'D8G588691', 7, 27, 3, 'Brother', -1, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Garantie 1 an', 0, 'Magasin', '2008-07-02'),
(657, 'Q162B19891', 28, 201, 11, 'NAS-MARIDAT', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '172.21.18.51', 0, '', 'Intel Celeron J1800 @ 2.41GHz\r\n1Go DDR3\r\n2 x 2To RAID1', 1, 'admin / Maridat-23', '2016-06-24'),
(634, 'YLLD028144', 1, 25, 5, 'S18_002', 32, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '172.21.18.2', 0, 'Changement de serveur', 'Intel Xeon E3-1220 V2 @ 3.10GHz\r\n16,00 Go  @ 1600MHz\r\nATI ES1000 \r\n499,00 Go (LSI MegaSR   SCSI Disk Device)', 3, 'Administrateur / Maridat-23', '2014-10-29'),
(38, '', 13, 30, 1, 'W18_013', 1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '3/03/2023', 'Garantie 3 ans', 0, '', '2006-11-28'),
(41, 'S209197040008', 5, 10, 1, 'NEC', 1, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, 'rebus', 'Garantie 1 an', NULL, NULL, '2007-12-19'),
(777, 'YM3P041086', 1, 133, 2, 'A514', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '172.21.19.102', 0, '', 'Intel Core i3-4005U @ 1.70GHz\r\n8,00 Go  @ 1600MHz\r\nIntel HD Graphics Family\r\n500,00 Go (TOSHIBA MQ01ABF050 SCSI Disk Device)', 1, 'Fabrice Perrot - Maridat (commercial)', '2015-11-09'),
(641, 'YLRR041718', 1, 118, 1, 'W19_003', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '24/03/2023', 'Intel Core i5-4590 @ 3.30GHz\r\n4,00 Go @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6A SCSI Disk Device)\r\nGarantie 3 ans sur site J 1', 3, 'Cédric - Comptoir', '2014-09-08'),
(635, 'QNV01202', 41, 194, 3, 'CLF32184N', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '172.21.18.35', 0, '', '', 0, 'Administration', '2015-01-01'),
(748, 'YMED009856', 1, 218, 1, 'D757-201801', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '192.168.1.189', 0, '', 'Intel Core i5-6500 @ 3.20GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 530\r\n256 GoMicron_1100_MTFDDAV256TBN', 3, ' Bungalow chaufferie', '2018-01-23'),
(632, 'YLNC230577', 1, 126, 2, 'A512-ATELIER1', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-3110M @ 2.40GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4000\r\n500,00 Go (WDC WD5000LPVX-16V0TT3)\r\nGarantie 3 ans', 3, 'Utilisateur', '2014-11-20'),
(50, 'YKLK167136', 1, 36, 2, '?Commercial', 1, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '.', 'Garantie 3 ans', 0, '', '2009-10-27'),
(51, 'YKLK167249', 1, 36, 2, '?Commercial', 1, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '.', 'Garantie 3 ans', 0, '', '2009-10-27'),
(52, 'YKLK167251', 1, 36, 2, '?Commercial', 1, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '.', 'Garantie 3 ans', 0, '', '2009-10-27'),
(53, 'YKLK167259', 1, 36, 2, '?Commercial', 1, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '.', 'Garantie 3 ans', 0, '', '2009-10-27'),
(54, 'A5300MXYC1FR', 1, 37, 2, 'Atelier', 4, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '', 'Garantie 3 ans', 3, '', '2011-02-11'),
(55, '', 7, 38, 3, 'Comptabilite', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, 'rebus\r\n', 'Garantie 3 ans', 0, '', '2006-10-02'),
(56, '', 15, 39, 3, 'Comptoir', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, 'rebus\r\n', 'Garantie 3 ans', NULL, NULL, '2004-01-13'),
(60, '', 9, 42, 1, 'Animateur CDR', 8, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Garantie 1 an', NULL, NULL, '2009-08-24'),
(58, 'AE9A039296A0', 14, 41, 3, 'OKI-C5650-7B05A5', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '172.21.18.99', 0, '', 'Garantie 3 ans', 0, 'Commercial', '2010-04-21'),
(59, 'EB9B322160A0', 14, 40, 3, 'Atelier', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, 'rebus', 'Garantie 3 ans', NULL, NULL, '2010-04-21'),
(61, 'S211719870000', 5, 24, 1, 'PC-CLSH', 1, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, ';', 'Garantie 3 ans', NULL, NULL, '2009-01-30'),
(62, '', 6, 43, 1, 'Cyber1', 1, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'Trop vieux', 'Garantie 3 ans', NULL, NULL, '2007-09-27'),
(63, '', 6, 43, 1, 'Cyber 3', 1, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'ccpd', 'Garantie 3 ans', NULL, NULL, '2007-09-27'),
(64, 'YLCM125278', 1, 102, 1, 'Cyber2', 3, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '192.168.0.112', 0, 'Remplacé', 'Garantie 3 ans', NULL, NULL, '2012-05-11'),
(65, '', 6, 43, 1, 'Cyber 4', 1, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'ccpd', 'Garantie 3 ans', NULL, NULL, '2007-09-27'),
(66, 'YKQB040000', 1, 1, 1, 'Cyber-Autoform', 4, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '192.168.0.122', 0, 'Remplacé', 'Garantie 1 an', NULL, NULL, '2009-08-31'),
(67, 'YKQB049281', 1, 1, 1, 'Cyber5', 4, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'Remplacé', 'Garantie 1 an', NULL, NULL, '2009-08-31'),
(204, '', 1, 102, 1, 'P400-4', 3, 0, NULL, 0, NULL, 0, NULL, 0, 6, 97, '', 0, '01/03/2023', 'Poste en attente (ancien de Marie)', 3, '', '2012-03-23'),
(69, 'YKQB049305', 1, 1, 1, 'Cyber7', 4, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'Remplacé', 'Garantie 1 an', NULL, NULL, '2009-08-31'),
(70, 'YKQB049419', 1, 1, 1, 'Cyber8', 4, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'Remplacé', 'Garantie 1 an', NULL, NULL, '2009-08-31'),
(71, 'YKQB040004', 1, 1, 1, 'Compta', 4, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, ' le 15/12/2017', 'Garantie 1 an', 0, 'Virginie / 1ap0st3', '2009-08-31'),
(72, '', 9, 44, 1, 'Cyber Mac', 8, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Garantie 1 an', NULL, NULL, '2009-08-31'),
(73, 'EX705-245FRA09002000692', 16, 45, 2, 'Portable MSI', 4, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'Remplacé', 'Garantie 2 ans', NULL, NULL, '2009-08-31'),
(74, 'ZYRH93AB202414', 2, 5, 2, 'Portable Samsung', 23, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'Rebut', 'Garantie 3 ans', 0, '', '2011-04-05'),
(75, '', 5, -1, 5, 'Serveur Cyber Base', 9, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '.', 'Garantie 3 ans', NULL, NULL, '2009-08-31'),
(76, '54PM048435', 17, 47, 1, 'ASUS', 1, 0, NULL, 0, NULL, 0, NULL, 0, 6, -1, '', 0, '. ', 'Garantie 3 ans', NULL, NULL, '2005-09-05'),
(77, 'S209773420002', 5, 10, 1, 'PC Nec', 1, 0, NULL, 0, NULL, 0, NULL, 0, 6, -1, '', 0, ' .', 'Garantie 3 ans', NULL, NULL, '2008-04-16'),
(78, '209773350002', 5, 10, 1, 'SN209773350002', 1, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, 'vieux', 'Intel Core 2 Duo E4500 @ 2.20GHz', 3, 'President / comco', '2008-04-16'),
(79, 'S11117630001', 5, 24, 1, 'PC Nec', 1, 0, NULL, 0, NULL, 0, NULL, 0, 6, -1, '', 0, '. ', 'Garantie 3 ans', NULL, NULL, '2009-03-12'),
(80, 'YL4Q318324', 1, 3, 1, 'P2560-RAM', 3, 0, NULL, 0, NULL, 0, NULL, 0, 6, 51, '', 0, 'Remplacé', 'Garantie 3 ans', 0, 'Flore', '2011-04-05'),
(81, 'LXTES0603864414FBC1601', 11, 48, 2, 'Portable Acer', 1, 0, NULL, 0, NULL, 0, NULL, 0, 6, -1, '', 0, '. ', 'Garantie 3 ans', NULL, NULL, '2006-12-19'),
(82, 'JV01ROJ', 13, 49, 1, 'PC DELL', 1, 0, NULL, 0, NULL, 0, NULL, 0, 7, -1, '', 0, 'cad?', 'Garantie 3 ans', NULL, NULL, '2003-07-28'),
(83, 'PS680E6F0260301B3AEL00', 11, 50, 1, 'PC Acer', 1, 0, NULL, 0, NULL, 0, NULL, 0, 7, -1, '', 0, 'cad?', 'Garantie 3 ans', NULL, NULL, '2006-03-03'),
(84, 'PS680E6F0260301B5AEL00', 11, 50, 1, 'PC Acer', 1, 0, NULL, 0, NULL, 0, NULL, 0, 7, -1, '', 0, 'cad?', 'Garantie 3 ans', NULL, NULL, '2006-03-03'),
(85, 'S210580830007', 5, 10, 1, 'PC Nec', 1, 0, NULL, 0, NULL, 0, NULL, 0, 7, -1, '', 0, 'hs', 'Garantie 3 ans', NULL, NULL, '2008-07-18'),
(87, '', 6, 9, 1, 'PC Secrétariat', 2, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, '', 0, '20/07/2011', 'Garantie 1 an', NULL, NULL, '2002-02-05'),
(88, '', 11, 51, 1, 'Comptabilité', 1, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, ' .', 'Garantie 3 ans', NULL, NULL, '2005-05-16'),
(89, 'PS780E6F0161201160EL00', 11, 52, 1, 'Poste Accueil', -1, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, ' .', 'Garantie 3 ans', NULL, NULL, '2006-09-12'),
(90, 'GV8KR1J', 13, 53, 5, 'Ancien serveur', 9, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, 'r', 'Garantie 3 ans', NULL, NULL, '2005-09-23'),
(91, 'YKHK005069', 1, 54, 5, 'Serveur Fujitsu', 12, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '.', 'Garantie 4 ans', NULL, NULL, '2011-02-09'),
(92, 'S99302087Q', 3, -1, 2, 'Portable Toshiba', 1, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Garantie 3 ans', NULL, NULL, '2009-10-27'),
(93, 'ZNC593CZ300157', 2, 55, 2, 'Portable Samsung', 6, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Garantie 3 ans', NULL, NULL, '2010-04-29'),
(94, 'ZOJD93BZ300086', 2, 55, 2, 'Portable Samsung', 6, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Garantie 3 ans', NULL, NULL, '2010-06-29'),
(95, 'T61G0447D01263', 18, 56, 1, 'SHUTTLE', 1, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 0, 'remplacé par P400-4', 'Garantie 3 ans', NULL, NULL, '2005-03-24'),
(96, 'YL4Q309679', 1, 3, 1, 'P2560-ACCUEIL', 3, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 0, '.', 'Garantie 3 ans', NULL, NULL, '2011-05-26'),
(97, 'DG1C12J', 13, 57, 2, 'PORTABLE', 2, 0, NULL, 0, NULL, 0, NULL, 0, 11, 53, '', 0, '.', '', NULL, NULL, '2011-07-04'),
(98, '', 15, 58, 1, 'Atelier3', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, '', 0, 'rebus', '', 0, '', '2011-07-03'),
(99, '', 6, 9, 1, 'Areha-bn7185769', 2, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, '10.87.9.100', 0, ' .', '', NULL, NULL, '2011-07-04'),
(100, '', 21, 59, 2, 'HP-AREHA', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, '', 0, '', 'Intel Core 2 Duo T7250 @ 2 GHz\r\nRAM 3 Go\r\nEcran 15\"', 0, '', '2011-07-03'),
(101, '', 15, 60, 1, 'HP2234', 1, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, '10.87.9.101', 0, '.', '', NULL, NULL, '2011-07-04'),
(102, '', 15, 61, 1, 'Atelier2', 21, 0, NULL, 0, NULL, 0, NULL, 5, 11, 25, '', 0, 'rebus', '', 0, '', '2011-07-03'),
(103, '', 19, -1, 1, 'Comptabilité', 13, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, '10.87.9.2', 0, ' .', '', NULL, NULL, '2011-07-04'),
(104, '', 15, 62, 2, 'Compaq-47e431e2', 1, 0, NULL, 0, NULL, 0, NULL, 0, 11, 19, '', 0, ' .', '', NULL, NULL, '2011-07-04'),
(105, '', 3, 63, 2, 'Atelier4', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, 'DHCP', 0, '', 'Intel Core 2 Duo T5870 @ 2 Ghz\r\nDDR 4 Go\r\n', 0, '', '2011-07-03'),
(106, '', 6, 9, 1, 'Areha-a326a3210', 1, 0, NULL, 0, NULL, 0, NULL, 0, 11, 53, '', 0, ' .', '', NULL, NULL, '2011-07-04'),
(107, '', 20, 64, 1, 'AREHAFAV1-PC', 5, 0, NULL, 0, NULL, 0, NULL, 0, 11, 22, 'DHCP', 0, '', 'AMD Athlon II x2 215 @ 2.70GHz\r\nRam 4Go\r\nEcran 17\" Imprimante HP DJ 1050', 0, '', '2011-07-03'),
(108, '', 20, 65, 1, 'FAV2-PC', 5, 0, NULL, 0, NULL, 0, NULL, 0, 11, 23, '10.87.9.32', 0, '', 'Intel Pentium E5300 @ 2.60 GHz\r\nRam 4Go\r\nEcran 23\" Imp HP DJ 1050', 0, '', '2011-07-03'),
(109, '', 20, 64, 1, 'AREHAFAV3-PC', 5, 0, NULL, 0, NULL, 0, NULL, 0, 11, 24, 'DHCP', 0, '', 'AMD Athlon II x2 215 @ 2.70Ghz\r\nRam 4 Go\r\nEcran 24\" LG 24EN43 @ Imp HP DJ F2420', 0, '', '2011-07-03'),
(110, '', 1, 66, 1, 'PC FUJITSU', 2, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, '', 0, ' .', '', NULL, NULL, '2011-07-04'),
(111, '', 15, 67, 1, 'Atelier1', 23, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, 'DHCP', 0, '', 'Intel Core 2 Duo E7400 @ 2.80 GHz\r\nRam 4 Go', 0, '', '2011-07-03'),
(112, '', 6, 9, 1, 'Areha 3', 2, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, '10.87.9.35', 0, ' .', '', NULL, NULL, '2011-07-04'),
(113, '', 21, 86, 1, 'HP-APPARTS', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, 'DHCP', 0, '', 'Intel Pentium E5500 @ 2.8 GHz\r\nRam 2 Go\r\nEcran 19\" Acer P193W @ Imp Canon Pixma MG5350', 0, '', '2011-07-03'),
(114, '', 15, 69, 5, 'SRV-GESTION', 10, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, '10.87.9.1', 0, '', 'Intel Xeon E5-2609 @ 2,40GHz\r\nRam 20Go', 0, '', '2011-07-03'),
(115, 'S209961000009', 5, 7, 2, 'PC MAIRE', 1, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, '', 0, '20/12/2016', 'Garantie 3 ans', NULL, NULL, '2008-06-30'),
(116, 'YL8H103590', 1, 70, 1, 'SECRETARIAT1-SP', 3, 0, NULL, 0, NULL, 0, NULL, 0, 8, 129, 'DHCP', 0, '', 'Intel I3 9100, Ram 8Go, HDD 250Go', 3, 'Secrétaire', '2011-07-06'),
(117, 'YL8T010421', 1, 71, 5, 'TX200S6', 7, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.203', 0, 'Fin de vie', 'Serveur VMWARE secondaire', 3, '', '2011-07-08'),
(118, 'YKHL015732', 1, 72, 5, 'TX150S7', 12, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.201', 0, '08/04/2026', 'Contr', 3, 'Administrateur', '2011-07-07'),
(119, '', 2, 73, 2, 'Samsung-NP300', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, '', 0, '', 'Intel Core i3-2320M @ 2.20GHz\r\nRam 4Go\r\nEcran 17\"', 0, '', '2011-12-05'),
(120, '2bd5175e00f34', -1, -1, 8, 'WN604 - netgear332892', -1, 0, NULL, 0, NULL, 0, NULL, 0, 11, -1, '192.168.0.100', 0, '', 'MdP Wifi : areha87300\r\nSSID: Ferme_AREHA\r\nadmin/password', 0, '', '2011-12-05'),
(121, '', -1, -1, 3, 'Epson SX610FW', -1, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, '10.87.9.210', 0, '', '', NULL, NULL, '2011-12-29'),
(122, 'AS13556883A0', 14, 74, 3, 'OKI B710dn', -1, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Garantie 3 ans', 0, 'Christiane Cuvillier', '2011-06-15'),
(123, 'YLDS024959', 1, 75, 2, 'PC Fujitsu', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '27/05/2024\r\n', 'Core i5 2430M\r\n4Go', 3, 'Vincent Rul', '2011-12-16'),
(124, 'DSCC018985', 1, 76, 2, 'S761-201112', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, 'Destruction', 'Core i5-2520M 2,50 GHz\r\n500Go SATA 7 200 tr/min,\r\n4Go DDR3\r\n', 3, 'Julien Mauchaussat', '2011-12-16'),
(125, 'YL5J125749', 1, 77, 1, 'PC CINEMA', 4, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Garantie 3 années', NULL, NULL, '2011-11-17'),
(126, 'YLDN128287', 1, 78, 2, 'PC Fujitsu', 5, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Garantie 1 année', NULL, NULL, '2012-01-13'),
(127, 'YL4Q481777', 1, 3, 1, 'P2560-Accueil', 4, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'Remplacé', '', 3, '', '2012-01-30'),
(128, '', 6, 79, 1, 'INTEL V4', 2, 0, NULL, 0, NULL, 0, NULL, 0, 5, 30, '', 0, ';', 'Garantie 2 années', NULL, NULL, '2007-06-29'),
(129, 'YL5J112385', 1, 77, 1, 'PC-COMPTOIRE', 4, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, '18/04/2024', '', 3, 'Remplacé par nuc ?', '2011-09-05'),
(130, '', 6, 9, 1, 'PPAYE-old', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 33, '', 0, ' .', '', NULL, NULL, '2012-03-08'),
(131, '', 11, 97, 1, 'ACERPOWERM6', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 49, '', 0, 'rebut', 'Quai Expe Gauche', 0, 'Emballage', '2012-03-12'),
(161, '', 6, 9, 1, 'LTC-Jean-Philip', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 47, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(132, '', 6, 9, 1, 'le-6e01e8f8c6cb', 1, 0, NULL, 0, NULL, 0, NULL, 9, 12, -1, '', 0, 'rebut', 'Stagiaire Qualite', 0, 'St01 / stagiaire', '2012-03-12'),
(744, 'YLDA008133', 1, 81, 1, 'P700-A', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '192.168.1.118', 0, ' .', 'Intel Core i5-2400 @ 3.10GHz\r\n4,00 Go  @ 1333MHz\r\nIntel HD Graphics\r\n500,00 Go (ATA ST3500413AS SCSI Disk Device)', 3, 'Patricia Galliot (Prod05/ labo)', '2011-09-22'),
(134, '', 1, 3, 1, 'P2560-C', 4, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ' ,', 'Garantie 3 années', NULL, NULL, '2011-02-09'),
(135, 'YLQ214708', 1, 3, 1, 'P2560-FEV-B', 4, 0, NULL, 0, NULL, 0, NULL, 14, 12, -1, '', 0, 'Le 31/07/2018 Carte réseau HS carte mère douteuse', '', 3, 'Stephane (Prod07/maintenance)', '2011-02-09'),
(137, 'YL8F008747', 1, 80, 11, 'NAS-Q700', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.202', 0, 'innutilisé', 'reb', 3, '', '2011-07-08'),
(139, 'YLDA008127', 1, 81, 1, 'P700-B', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'vieux', '', 3, 'Guy Faivre (Com01 / gregory)', '2011-09-22'),
(140, 'YLDA008133', 1, 81, 1, 'P700-C', 3, 0, NULL, 0, NULL, 0, NULL, 20, 12, -1, '', 0, 'vieux', '', 3, 'Chantal Penot (RH01 / chantal)', '2011-09-22'),
(141, 'YLDA008143', 1, 81, 1, 'P700-D', 3, 0, NULL, 0, NULL, 0, NULL, 17, 12, -1, '', 0, 'Retrait', '', 3, 'Aurelie (Prod04 / Aurelie)', '2011-09-22'),
(142, 'YLDA008156', 1, 81, 1, 'P700-E', 3, 0, NULL, 0, NULL, 0, NULL, 13, 12, -1, '', 0, 'vieux', '', 3, 'RETRAIT (com05 / nadia)', '2011-09-21'),
(145, 'YLTH540284', 1, 124, 1, 'P420-EXPE', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, 49, '', 0, '16/03/2023', '', 3, '', '2015-07-05'),
(144, '', 1, 82, 5, 'SERVEUR 2003', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ' ,', '', NULL, NULL, '2012-03-12'),
(146, '', 1, 85, 1, 'EDI', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(147, 'CZC01269ZH', 21, 86, 1, 'HP500B-Vache', 4, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'HS', '', 0, 'Prod08 / fromvache', '2012-03-12'),
(148, '', 13, 87, 1, 'DELL-H2A', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(149, '84700248923', 11, 88, 2, 'FAIVRE', 1, 0, NULL, 0, NULL, 0, NULL, 12, 12, 42, '', 0, 'fin', '', NULL, NULL, '2012-03-12'),
(150, '', 5, 10, 1, 'M1BUREAU', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 39, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(151, '100066501043', 5, 90, 1, 'MARLENE', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(152, '109937920006', 5, 10, 1, 'NEC-VL260-B', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ' .', 'Prod07/maintenance', 0, 'St', '2012-03-12'),
(153, '3CXDL3J', 13, 91, 2, 'PJEANCLAUDE', 1, 0, NULL, 0, NULL, 0, NULL, 15, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(743, 'YL4Q241916', 1, 3, 1, 'P2560-H2A', 4, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.126', 0, 'Retrait', 'Intel Core 2 Duo E7500 @ 2.93GHz\r\n3,00 Go DDR2 @ 1067MHz\r\nIntel G41 Express Chipset\r\n500,00 Go (Hitachi HDS721050CLA362 ATA Device)', 3, 'Sylvie Chevin (Com03 / sylvie)', '2011-02-08'),
(156, '', 6, 92, 1, 'LABO', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(157, 'CZC0012FJV', 15, 93, 1, 'Pc_Prepa', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2010-01-02'),
(158, 'CZC0126B78', 21, -1, 1, 'PASTO', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'Retrait', 'Franck Chavegrand (Prod09 @ pasto)', 0, 'Franck Chavegrand (Prod09 @ pasto)', '2012-03-11'),
(160, '100066211041', 5, 90, 1, 'ATELIER', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 46, '', 0, '.', '', 0, 'Daniel Sourty', '2012-03-12'),
(162, '', 6, 9, 1, 'CLAIQUAI', 13, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(163, '', 5, 96, 1, 'PC-Chavegrand', 16, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(164, '', 6, 9, 1, 'CLAIQUAI_1', 17, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(165, '', 6, 9, 1, 'Bureau-expd', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'rebut', '', 0, 'expedition \\ ', '2012-03-12'),
(166, '', 6, 9, 1, 'EMB. Droit', 13, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(167, '', 6, 9, 1, 'expdd', 13, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(168, '', 6, 9, 1, 'B1Q2H7', 17, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'ancien poste pompe', '', NULL, NULL, '2012-03-12'),
(169, '', 6, 9, 1, 'chavegra-dacqlr.', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 48, '', 0, ',', '', NULL, NULL, '2012-03-12'),
(170, 'YL4Q461024', 1, 3, 1, 'P2560-2011_12', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 6, '', 0, 'Brulé', 'Intel Pentium E5800 @ 3.2GHz\r\n4Go DDR3 pc3-8500 @533MHz\r\nDD 500 Go', 3, 'AAGDV', '2011-12-28'),
(171, 'PSPF6E6F06644906665EL00', 11, 19, 1, 'PC AAGDV', 1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 6, '', 0, 'sorti', '', 3, '', '2007-03-01'),
(172, '', 22, -1, 1, 'PC BUREAUTIQUE', 2, 0, NULL, 0, NULL, 0, NULL, 0, 13, -1, '', 0, 'Hors circuit', '', NULL, NULL, '2004-03-31'),
(173, 'L70SPSBS51E02830', 22, -1, 1, 'COMPTA', 2, 0, NULL, 0, NULL, 0, NULL, 0, 13, -1, '', 0, 'Hors circuit', '', NULL, NULL, '2005-03-25'),
(178, 'YLDA060043', 1, 81, 1, 'P700-B (PC Habitat)', 21, 0, NULL, 0, NULL, 0, NULL, 8, 2, 7, '', 0, 'rebut', '', 3, 'Jeanne MOYA AGURTO', '2012-03-16'),
(175, 'Z5R93BB102525', 2, 6, 2, 'R730', 6, 0, NULL, 0, NULL, 0, NULL, 0, 13, -1, '', 0, '', 'Garantie 3 années', NULL, NULL, '2011-06-20'),
(176, 'PSPM8C6F0264009A422701', 11, 98, 1, 'ACERPOWER-M8', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '', 0, '.', 'Poste pompe', NULL, NULL, '2012-03-12'),
(177, 'YKQB032375', 1, 1, 1, 'PC Christophe', 3, 0, NULL, 0, NULL, 0, NULL, 0, 13, -1, '', 0, 'Hors circuit', 'Garantie 3 années', 0, '', '2009-06-04'),
(179, 'PSPM6E6F0562102C79EL00', 11, 97, 1, 'PC Habitat-old', 1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, 'c', 'Garantie 3 ans', NULL, NULL, '2006-09-30'),
(180, 'YKQB019353', 1, 1, 1, 'Serveur billetterie', 1, 0, NULL, 0, NULL, 0, NULL, 38, 2, 5, '192.168.1.20', 0, 'Vieillesse\r\n', '', 3, 'Zoe Gognet', '2009-06-22'),
(222, '', 1, 25, 5, 'SERVEUR-TX100', 19, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '192.168.0.100', 0, '00', '', 0, '', '2012-02-27'),
(184, '', 7, 101, 3, 'BROTHER QL-560', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '', 0, '.', '', 0, '', '2012-03-27'),
(185, '108665180003', 5, 10, 1, 'NEC-VL260-A', 1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 49, '192.168.1.76', 0, ',', 'PC LTC - Jean Philippe Detosse', NULL, NULL, '2012-03-12'),
(186, '', -1, -1, 10, 'Netgear DGN2000', -1, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, '10.87.9.254', 0, '', 'MdP Wifi : bellac87\r\nSSID : AREHA\r\nadmin/password', 0, '', '2011-12-05'),
(187, 'YLCM105255', 1, 102, 1, 'PC', 3, 0, NULL, 0, NULL, 0, NULL, 0, 6, -1, '', 0, 'HS', '', 3, '??', '2012-05-11'),
(191, 'YLDS051530', 1, 75, 2, 'PC Fujitsu', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, ' .', 'Core i5 2430M\r\n4Go', 3, 'Jean Lhermite', '2012-05-03'),
(192, 'YLDS051551', 1, 75, 2, 'PC Fujitsu', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', 'ORDI HS - Core i5 2430M\r\n4Go', 3, 'Guillaume Pottier', '2012-05-03'),
(193, 'YL9P274754', 1, 37, 2, 'PC', 3, 0, NULL, 0, NULL, 0, NULL, 0, 7, 55, '', 0, 'hs', 'Garantie 3 ans', NULL, NULL, '2012-02-16'),
(194, 'HRZK91KC300783', 2, 73, 2, 'Portable-Cyb', 5, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', '', NULL, NULL, '2012-07-17'),
(195, 'YLDA081449', 1, 81, 1, 'Poste-Spanc', 22, 0, NULL, 0, NULL, 0, NULL, 37, 2, 7, '', 0, '20/12/2023', '', 3, 'Maud Presinat', '2012-08-16'),
(196, 'YLDA081451', 1, 81, 1, 'Spanc-Secretariat ', 4, 0, NULL, 0, NULL, 0, NULL, 38, 2, 7, '', 0, '20/12/2023', '', 3, 'Zoe Gognet', '2012-08-17'),
(197, '', 14, -1, 3, 'MB451', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '10.10.0.45', 0, '', '', 0, '', '2012-08-17'),
(198, '', -1, -1, 4, 'REXROTARY DSM627', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '10.10.0.27', 0, '.', '', 0, '', '2012-08-17'),
(199, '', -1, -1, 4, 'Konica Minolta Bizhub C220', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '10.10.0.60', 0, '.', '', 0, 'admin / 12345678', '2012-08-17'),
(200, 'YLCM119757', 1, 102, 1, 'Cyber3', 3, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '192.168.0.113', 0, 'Remplacé', 'Garantie 3 ans', NULL, NULL, '2012-05-11'),
(201, 'YLCM119794', 1, 102, 1, 'Cyber4', 3, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '192.168.0.114', 0, 'Remplacé', 'Garantie 3 ans', NULL, NULL, '2012-05-11'),
(202, 'YKQB049282', 1, 1, 1, 'Cyber6', 4, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'Remplacé', 'Garantie 1 an', NULL, NULL, '2009-08-31'),
(205, '', 2, 73, 2, 'NP355', 18, 0, NULL, 0, NULL, 0, NULL, 0, 6, 97, '', 0, 'HS', 'Garantie 1 an', 0, '', '2012-12-20'),
(206, '', 20, 103, 1, 'OT3LACS-PC', 3, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 0, '2017', 'Garantie 1 an', NULL, NULL, '2011-03-24'),
(207, '', 15, -1, 1, 'OT3LACS', 3, 0, NULL, 0, NULL, 0, NULL, 0, 6, -1, '', 0, 'HS', 'Garantie 1 an', 0, '', '2011-11-09'),
(208, '', 27, -1, 10, 'ZyXEL P-660HNT1 - Supprimé', -1, 0, NULL, 0, NULL, 0, NULL, 0, 6, 97, '192.168.1.1', 0, '01/03/2023', 'SSID : OT_Vallee_des_peintres\r\nMdP : OTSIDUN23$', 0, '', '2013-01-07'),
(209, '', -1, -1, 4, 'Aficio MP C5501 - PC-39', -1, 0, NULL, 0, NULL, 0, NULL, 0, 6, 97, '192.168.1.51', 0, 'hs', 'Ricoh Aficio MP C5501', 0, 'admin / n.a.', '2013-01-07'),
(210, '', 24, 105, 11, 'IX2-47', -1, 0, NULL, 0, NULL, 0, NULL, 0, 6, 78, '', 0, 'hs', '', 0, '', '2013-01-07'),
(249, '', 13, -1, 2, 'Dell XPS 1330', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, 'hs', 'ORDI HS', 0, 'Yves Prévot', '2012-10-31'),
(212, 'YLCM129929', 1, 102, 1, 'P400-AT', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '16/01/2018', 'Intel Core i3 2120 @ 3.3GHz\r\n4Go DDR3\r\n500Go', 3, '(Alexandre Demaison)', '2012-07-04'),
(213, 'YLCM246038', 1, 102, 1, 'P400-1', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '16/01/2018', 'Intel Core i5 2320 @ 3 GHz\r\n4 Go DDR3 - 1333 MHz\r\n500 Go - SATA III', 3, 'Marine Blanchon', '2012-09-27'),
(215, '', 1, 110, 1, 'P710-201208', 21, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '', 1, 'Vendu', '', 0, '', '2012-08-21'),
(216, '', 5, 7, 1, 'AIM-SAGE', 18, 0, NULL, 0, NULL, 0, NULL, 1, 1, 58, '', 0, '00', '', 0, 'Marie Laure', '2011-06-20'),
(217, '', 26, -1, 10, 'FVS318N', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '192.168.0.1', 0, '00', 'Routeur Netgear', NULL, NULL, '2012-08-27'),
(218, '', 24, 105, 11, 'STORAGE', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '192.168.0.12', 0, 'Vendu Simon', '', NULL, NULL, '2012-02-27'),
(219, '', 1, 80, 11, 'CELVIN-Q700', 19, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '192.168.0.70', 0, 'Vendu', '', 1, '', '2012-07-27'),
(220, '', 7, 111, 3, 'BRN_90DBD6', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '192.168.0.20', 0, 'HS', '', NULL, NULL, '2011-02-27'),
(221, '', 14, 100, 3, 'OKI C310', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '192.168.0.31', 0, 'rebut', '', NULL, NULL, '2012-03-28'),
(223, '', -1, -1, 7, 'AIM-XP', 1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '192.168.0.99', 0, '00', '', NULL, NULL, '2013-02-27'),
(225, '', 1, 123, 1, 'A525-L', 21, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '', 0, '14/03/2023', '', 0, '', NULL),
(226, '', 25, -1, 12, 'Camera DCS-6113', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '192.168.0.254:1025', 0, '', '', 0, '', '2013-02-27'),
(228, 'YL8T010421', 1, 71, 5, 'TX200S7', 25, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.200', 0, '01/03/2024', 'Serveur VMWARE principal', 3, 'root', '2012-09-09'),
(229, 'YLCN084520', 1, 102, 1, 'P400-Emballage', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'hs', '', 3, '', '2013-03-11'),
(230, 'CCN0AS02993349H', 17, -1, 2, 'N76VZ', 18, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, 'recyclé', '', 2, 'Alexandre Chavegrand', '2013-03-06'),
(231, 'YLDA080675', 1, 81, 1, 'P700-H2A', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'Retrait', '', 3, 'Céline Réjaud (com02 / celine)', '2012-07-11'),
(232, ' YLKW007587', 1, 109, 2, 'A532-HELENE', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '08/04/2026', 'RH02 / helene\r\n', 0, 'Helene Faivre', '2012-08-19'),
(234, 'YKQB019350', 1, 1, 1, 'Client Billetterie 1', 1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 8, '', 0, 'VIEILLESSE', '', 3, '', '2009-06-22'),
(235, 'YLLT013300', 1, 114, 2, 'AH552SL', 21, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 1, 'vendu?', 'Intel Core i5-3230M @ 2.60GHz\r\nRAM 8Go\r\n1 To DD', 1, '', '2013-03-28'),
(236, 'Q132B05063', 28, 158, 11, 'NAS', 19, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '192.168.0.70', 0, 'Flambé', '', 1, '', '2016-05-01'),
(237, 'YLLT014652', 1, 114, 2, 'AH552', 3, 0, NULL, 0, NULL, 0, NULL, 39, 2, 5, '', 0, 'Remisé', 'Core i5-3230M @ 2.60GHz\r\n4Go DDR3', 3, 'Romain Janvier', '2013-07-21'),
(238, ' YLHW060674', 1, 110, 1, 'P710-2013_06', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '192.168.1.11', 0, 'sorti', 'Garantie 3 ans', 3, 'GED', '2013-06-19'),
(239, 'YLHW067500', 1, 110, 1, 'PC-COM', 3, 0, NULL, 0, NULL, 0, NULL, 42, 2, 5, '', 0, '04/03/24', '', 3, 'Sylvain Tudo', '2013-07-21'),
(240, '', 7, -1, 3, 'Fax 2845', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 6, '', 0, '', '', 1, '', '2013-12-01'),
(241, 'YGLS007792', 1, 72, 5, 'SERVEUR', 20, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '192.168.0.254', 0, '10/01/2025', 'Version foundation', 3, 'Administrateur', '2014-01-14'),
(242, 'YL8F014609', 1, 80, 11, 'CELVIN-Q700', 19, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '192.168.1.254', 0, 'Brulé', '', 3, 'admin / admin', '2012-06-18'),
(243, 'YLKW018842', 1, 109, 2, 'A532', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, 'Desctruction', '', 3, 'Loraine Copley', '2012-10-30'),
(246, 'YLRR009502', 1, 118, 1, 'LORRAINEC', 4, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', 'Core i3 4130 3.4GHz\r\n4 Go\r\nLorraineC @ lorraine7', 3, 'Lorraine Coppley', '2014-05-13'),
(245, 'DSDE008176', 1, 117, 2, 'LBE753', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', 'Core i5 3230M @ 2.6 GHz\r\n4 Go', 3, 'Christian Pellé', '2014-05-22'),
(247, 'DSCC010185', 1, 76, 2, 'LBS761', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'ORDI HS - Core i5-2520M 2,50 GHz\r\n500Go SATA 7 200 tr/min,\r\n4Go DDR3\r\n', 2, 'Frédéric Noël', '2011-09-01'),
(248, 'YLJK014621', 1, 106, 1, 'Q510-CC', 18, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, 'Destruction', 'Core i3 2120T 2.6 GHz\r\n4 Go DDR3 1600 MHz PC3-12800\r\n500 Go 2,5\"', 3, 'Christiane Cuvillier', '2013-02-06'),
(250, ' DSCW500665', 1, 119, 2, 'Fujitsu-S782', 18, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', 'Core i5 3320M @ 2.6 GHz\r\n4Go DDR3\r\n500 Go HDD', 3, 'Mathias Spilmont', '2013-06-24'),
(251, 'DSDE008176', 1, 120, 2, 'LBE733', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', ' Core i5 3230M @ 2.6 GHz\r\n500 Go SATA \r\n4Go DDR3 1600 MHz @ PC3-12800', 3, 'Ex Claude Boulet', '2014-05-22'),
(252, 'YLHQ021621', 1, 121, 1, 'E710', 18, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', 'Intel Core i5 3470 3.2 GHz\r\n4 Go - DDR3 1600 MHz - PC3-12800\r\n500 Go - SATA-600', 3, 'Naseem Bonem', '2013-03-12'),
(253, '', -1, -1, 1, 'KEP-CHEVRE', 4, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, '', 'Poste tactile etanche\r\nSebastien Chambellant ( Prod06 @ fromchevre )', 0, 'Sebastien Chambellant', '2014-05-08'),
(254, 'YLUA040333', 1, 122, 2, 'A544-AQUA', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 63, '', 0, '', ' i3 4000M\r\n500 Go\r\n4Go DDR3 - 1600 MHz / PC3-12800', 3, 'AquaTech (<- Maud) GTC', '2014-11-12'),
(640, 'YLCM361186', 1, 102, 1, 'AT-COMPT-BONNAC', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '24/03/2023', 'Intel Core i5-2310 @ 2.90GHz\r\n4,00 Go DDR3 @ 1333MHz\r\nIntel HD Graphics\r\n500,00 Go (ST500DM002-1BD142)\r\nGarantie 3 ans sur site J 1', 3, 'Utilisateur', '2013-02-19'),
(633, 'YLNC051233', 1, 126, 2, 'A512-1303', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-2348M @ 2.30GHz\r\n4,00 Go  @ 1333MHz\r\nIntel HD Graphics 3000\r\n480,00 Go (SSD PNY)\r\nGarantie 3 ans', 3, 'Atelier', '2013-06-17'),
(259, 'YLRX011580', 1, 127, 1, 'Q520_14-02', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '03/06/2025', 'Intel Core i3-4130T @ 2,90GHz\r\n4 Go', 3, 'Jean Claude Chavegrand', '2014-02-11'),
(260, '', 26, -1, 8, 'NETGEAR', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 62, 'DHCP', 0, '', '', 0, '', '2014-12-16'),
(898, '039353582553', 40, 244, 13, 'SURFACE-201901A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '192.168.0.50', 0, '16/10/2025', 'Intel Core m3-7Y30 CPU @ 1.00GHz\r\n4.00 Go  @ 1867MHz\r\nDisplayLink USB Device\r\n128.00 Go (INTEL SSDPEBKF128G7)', 3, 'Utilisateur44 (Emmanuel Briat)', '2019-01-11'),
(264, 'YLNC146220', 1, 126, 2, 'A512-fam2', 3, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Intel® Core i3 3110M / 2.4 GHz\r\n320Go SATA 300\r\n4Go DDR3 - 1600 MHz - PC3-12800', 1, 'Stock', '2014-06-10'),
(265, 'YLNC269506', 1, 126, 2, 'A512-2', 3, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Intel® Core i3 3110M / 2.4 GHz\r\n320Go SATA 300\r\n4Go DDR3 - 1600 MHz - PC3-12800', 1, 'Stock', '2014-12-21'),
(266, 'YLVS004599', 1, 123, 1, 'A525L-Emballage', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'hs', 'AMD serie G GX-217GA\r\n4 Go de DDRIII PC3-10600 1333 MHz\r\nDD 320 Go - SATA II 2.5', 3, 'Xavier Chevron (Emb01 / xavier)', '2015-01-10'),
(267, 'YLUA068173', 1, 122, 2, 'A544-PePs23', 3, 0, NULL, 0, NULL, 0, NULL, 0, 2, 9, '', 0, 'Dalle cassée', 'Core i3 4000M\r\n4 Go DDR3 PC3-12800', 3, 'Candie G.', '2015-01-08'),
(268, '', 1, 25, 5, 'TX100S2', 20, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '192.168.0.254', 0, 'Remplacé', '', 1, '', '2015-01-11'),
(269, 'YLUA071852', 1, 122, 2, 'A544-ALSH', 3, 0, NULL, 0, NULL, 0, NULL, 0, 5, 98, '', 0, '', 'Intel', 3, 'Anim / 4n1m17@', '2015-01-05'),
(270, '', 1, 129, 11, 'Q703', 19, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '192.168.0.73', 0, 'Remplacé', 'Connexion sur port 8080', 1, 'admin / admin', '2015-01-05'),
(271, 'YLTH331570', 1, 124, 1, 'PCRI003', 3, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, 'UC HS', '', 3, 'Maurice (Magasin Atelier)', '2014-10-25'),
(272, 'YLPU084050', 1, 131, 1, 'P720-2015_02', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 63, '', 0, '15/01/2026', 'Intel Core i5-4590 @ 3.30Ghz\r\n4Go DDRIII', 3, 'Infirmerie', '2015-02-24'),
(273, 'YLTH283895', 1, 124, 1, 'ATELIER', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, 46, '', 0, '', 'Intel Core i3-4160 @ 3.6 GHz\r\n4 Go de DDRIII PC3-10600 1333 MHz\r\nDD 500 Go - SATA III 600Gb\r\n', 1, 'Stéphane Chavegrand (Daniel)', '2014-11-11'),
(274, 'YLVS001579', 1, 123, 1, 'A525L-BALANCE', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, '05/09/2023\r\n', 'AMD serie G GX-217GA\r\n4 Go de DDRIII PC3-10600 1333 MHz\r\nDD 320 Go - SATA II 2.5', 1, 'Balance', '2014-07-02'),
(275, 'YLVS001604', 1, 123, 1, 'PROD-A525L-SEL', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, 122, '', 0, '19/12/2025', 'AMD serie G GX-217GA\r\n4 Go de DDRIII PC3-10600 1333 MHz\r\nDD 320 Go - SATA II 2.5', 1, 'Prod08', '2014-07-02'),
(276, '13W0812', 13, 274, 2, 'DELL Latitude 3340', 18, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, '', '', 1, 'Robin Chavegrand', '2014-11-05'),
(277, '2CE34908VH', 15, -1, 2, 'HP ProBook 470 G0', 18, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, 'Hors garantie', '', 1, 'Mme Chavegrand', '2014-02-11'),
(278, ' YLKW086699', 1, 109, 2, 'A532-ERIC', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'Récupéré par Eric', 'Intel Core i5 3230M @ 3.2 GHz\r\nDD 500 Go HDD SATAIII\r\n4Go DDR3 1600MHz\r\nUtilisateur local : eric\r\n', 3, 'Eric Marchand (Com06 / eric)', '2013-11-21'),
(279, 'DSDU001266', 1, -1, 13, 'Q584', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'hs', '', 2, 'Guy Faivre (Com01 / gregory)', '2015-02-12'),
(280, 'YLPU012405', 1, 131, 1, 'P720-01-14', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, '08/02/2023', 'Intel Core i5 4570 @ 3.2 GHz\r\n4 Go DDR3 1600MHz - PC3-12800\r\nDD 500 Go - SATA III 600Gb\r\n', 3, 'Fromagerie (Prod08)', '2014-02-04'),
(281, 'YLST108473', 1, 132, 1, 'E420-2015-03', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '12/06/2025', 'Intel Core i5-4460 @ 3.20GHz\r\n4 Go de DDRIII PC3-12800 1600 MHz\r\nDD 500Go - SATA III', 3, 'Helene Faivre (RH02)', '2015-03-17'),
(282, 'YLVS00516', 1, 123, 1, 'A525-L', 18, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'AMD GX-217GA SOC\r\n4,00 Go DDR3 @ 800MHz\r\nAMD Radeon HD 8280E\r\n320,00 Go (TOSHIBA MQ01ABD032 SATA)\r\nGarantie 1 an', 1, 'Showroom', '2015-04-14'),
(283, '', 1, 122, 2, 'A544', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, 'Donné à Grazziano', '', 3, 'Grazziano Tonel', '2015-02-24'),
(284, 'YM3P004387', 1, 133, 2, 'A514', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, 'hs', 'Intel Core i3 4005U @ 1.7 GHz\r\n500 Go SATA 300\r\n4Go DDR3 1600 MHz @ PC3-12800', 1, 'JCC ', '2015-06-02'),
(285, '', 26, -1, 10, 'ProSafe FVS318N', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '192.168.1.2', 0, 'ne dépasse pas les 40 Mb / s en téléchargement', 'admin / password', 0, '', '2015-06-15'),
(286, 'YM3M002523', 1, 134, 2, 'A555-201505', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5 5200 @ 2.4GHz\r\n1To Sata\r\n4Go DDR3L PC3-12800', 3, 'Clémence Eymery (<-Isabelle Pagneux)', '2015-05-06'),
(287, 'YLTH573742', 1, 124, 1, 'P420-2015-08', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5 4460 @ 3.2 GHz\r\n8 Go de DDRIII PC3-12800 1600 MHz\r\nSSD 250 Go - SATA III \r\n', 3, 'Alexandra Lavillonière (RH03)', '2015-08-23'),
(288, 'YM3M010830', 1, 134, 2, ' DESKTOP-V8FRT82 (A555-AQUA)', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5 5200 @ 2.4GHz\r\n1To Sata\r\n4Go DDR3L PC3-12800', 3, 'Prévention', '2015-08-31'),
(289, 'YLTH548659', 1, 124, 1, 'BASCULE-PC', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i3  4160 @ 3.6 GHz\r\n4 Go de DDRIII PC3-12800 1600 MHz\r\n500 Go - SATA III 600Gb', 3, 'Utilisateur', '2015-09-22'),
(290, 'YLTH600289', 1, 124, 1, 'P420-OT-Billet', 3, 0, NULL, 0, NULL, 0, NULL, 0, 2, 8, '', 0, '10/04/2024', 'Core i3 4160 @ 3.6GHz\r\n4Go DDR3 1600\r\nDD 500 Go', 3, '', '2015-09-28'),
(291, 'YLTH601108', 1, 124, 1, 'PC-Secretariat', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '192.168.1.20', 0, 'HS', 'Intel Core i5 4460 @ 3.4 GHz\r\n4 Go DDR3 1600\r\nDD 500 Go', 3, 'Zoe Cognet', '2015-09-28'),
(292, 'YLTH538368', 1, 124, 1, 'P420-TRANSPORT', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 49, '', 0, '21/02/2023', 'Intel Core i3-4160 @ 3.60GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nCarte vidéo de base Microsoft\r\n500,00 Go (ST500DM0 02-1BD142 SCSI Disk Device)', 3, 'Roseline (Emb03)', '2015-11-07'),
(293, 'Q158I02370', 28, 135, 11, 'NAS-453', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.202', 0, 'hs', '4x4To Raid 5 (WD40EFRX) (10.89 To)\r\nIntel Celeron J1900 @ 2GHz (4 cœurs)\r\n8 Go DDR3L', 1, 'admin / Chavegrand23800!', '2015-11-07'),
(294, '', 1, 131, 1, 'PCRI001', 22, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'Mémoire 8Go DDR3\r\nSSD 480Go\r\nPCRI007/0', 0, 'Nathalie RICARD', '2019-06-19'),
(295, '', 13, 136, 1, 'PCRI002', 1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '.', 'PCRI002/0', 0, 'Jacqueline Mathieu', NULL),
(296, '', 1, 124, 1, 'PCRI004', 3, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'PCRI004/0', 0, 'Jeremiah Antona', NULL),
(297, '', 6, 9, 1, 'PCRI005', 1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'PCRI005/0', 0, ' Clement Blenchant', '2015-11-26'),
(298, '', 13, 137, 1, 'PCRI006', 1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, 'retraite', 'PCRI006/0', 0, 'Menut Philippe', NULL),
(301, '', 1, 139, 1, 'PCRI010', 3, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'PCRI010/0', 0, 'Veronique Cottereau', '2015-11-26'),
(299, '', 13, 138, 1, 'PCRI007 (old)', 16, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, 'rebut', 'PCRI007/0', 0, 'Cindy Loriot', NULL),
(300, '', 1, 126, 2, 'PCRI008', 3, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'PCRI008/0\r\n', 0, 'Patrick Ricard', NULL),
(302, '', 1, 130, 1, 'PCRI014', 22, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'PCRI014/0\r\n', 0, 'Celine Choplain', '2015-11-26'),
(303, '', 13, 140, 2, 'DELL', 3, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'PCRI011/X\r\n', 0, 'Maxime Jorroul', '2015-11-26'),
(304, '', 13, 138, 1, 'Dell - Moto - Culture', 1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'Dell-PCRI011/0\r\n', 0, 'Nicolas Desarmenien', '2015-11-26'),
(305, 'YLPS037616', 1, 142, 1, 'PCPORT03', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'Intel Core i7 4790 @ 3.6 GHz ( 4 GHz ) \r\n8 Go - DDR3 SDRAM - 1600 MHz\r\nSSD 250Go EVO850 + 1 To - SATA', 3, 'Remy Ricard', '2015-10-08'),
(306, '', 13, 143, 2, 'PCPORT05', 3, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'PCPORT05/0', 0, '', NULL),
(307, '', 7, 144, 3, 'BRN001BA964DEA9', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.42', 0, '', '', 0, 'Menut Philippe', NULL),
(308, '', 29, 145, 3, 'ET0021B720B450', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.44', 0, '', '', 0, '', NULL),
(309, '', 30, 146, 3, 'KMBT90CB5B', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.43', 0, '', '', 0, '', NULL),
(310, '', 30, 147, 3, 'BH4700PD9942E', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.45', 0, '', '', 0, 'Jacqueline Mathieu', NULL),
(311, '', 30, 148, 3, 'KMBT8A5751', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.48', 0, '', '', 0, '', NULL),
(312, '', 13, 149, 5, 'SVRI01', 12, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.1', 0, '', 'administrateur/hhh000', 0, '', NULL),
(313, '', 26, 150, 6, 'GS105EV2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'password', 0, '', NULL),
(314, '', 25, 151, 8, 'DAP-3310', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.60', 0, '', 'ID : admin/vide\r\nSSID: RICARD\r\nPASS: Ricard23300', 0, '', NULL),
(315, '', 25, 151, 8, 'DAP-3310 Magasin', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.61', 0, '', 'ID : admin/vide\r\nSSID: RICARD_MAGASIN\r\nPASS: Ricard23300', 0, '', NULL),
(316, '', 31, 152, 8, 'TLWN841N', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'IP LAN: 192.128.0/24\r\nSSID: RICARD_REUNION \r\nPASS: Ricard23300\r\nIP WAN : DHCP', 0, '', NULL),
(317, '', -1, -1, 10, 'CISCO 800', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.254', 0, '', 'Mode bridge', 0, '', NULL),
(318, '', -1, -1, 10, 'TP-LINK TLWN841N', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '10.128.32.5', 0, '', '', 0, '', NULL),
(319, '', -1, -1, 10, 'CISCO 800 Bouygues', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', '', 0, '', NULL),
(320, '', -1, -1, 10, 'CISCO 800 (SDSL 4M) Bouygues', -1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '192.168.1/24', 0, '', 'SDSL 4M', 0, '', NULL),
(321, 'YLTH635597', 1, 124, 1, 'Fujitsu-P420', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '06-09-2024', 'Core i5 4460 @ 3.20Ghz\r\n4 Go DDR3-1600\r\nDD 500Go', 3, 'Carole Marceron (Administration / )', '2015-12-10'),
(322, 'YM3P055964', 1, 133, 2, 'A514-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '06-09-2024\r\n', 'Core i3 4005U @ 1.70Ghz\r\n4Go DDR3-1600\r\nDD 500Go ', 3, 'Cap3 / LSA050958 (Liliane)', '2015-12-10'),
(996, '4XT178EJ00ADF', 26, -1, 8, 'WAC505', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '192.168.0.100', 0, '17/04/2026', '', 0, '', '2019-05-16'),
(325, 'YM3M036176', 1, 134, 2, 'LAPTOP-COMPTA', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '15/02/2024', 'Intel Core i5-5200U @ 2.2GHz\r\nHDD 1To  sata\r\n4 Go DDR3 PC3-12800', 3, 'Utilisateur / mamoune36', '2016-02-17'),
(900, '039270782553', 40, 244, 13, 'FUJITSU-A530-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '192.168.0.63', 0, '', 'Intel Core m3-7Y30 CPU @ 1.00GHz\r\n4.00 Go  @ 1867MHz\r\nDisplayLink USB Device\r\n128.00 Go (INTEL SSDPEBKF128G7)', 3, 'utilisateur29 (Pierre Desvillette)', '2019-01-09'),
(327, '', -1, -1, 3, 'Canon i-SENSYS MF8280Cw', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 6, '', 0, '.', '', 3, '', '2015-02-02'),
(329, 'E69742L2N759968', 7, -1, 3, 'Brother DCP 7055', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', 'Agence La Souterraine', 0, '', '2013-03-07'),
(330, 'E69742L2N825826', 7, -1, 3, 'Brother DCP 7055', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', 'Agence Aubusson', 0, '', '2013-03-07'),
(331, 'YL8F019433', 1, 80, 11, 'NASD014CE (ancien)', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '2021-12-03', '2 x 1 To', 3, 'admin \\ P3rsp3ct1ves', '2013-03-06'),
(332, 'YLUA034449', 1, 122, 2, 'A544-201403-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '06-09-2024', 'Core i5 4200M @ 2.5GHz\r\n4Go DDR3-1600\r\nDD 500Go ', 3, 'session / HL230488 (Henri)', '2014-03-27'),
(994, '', 1, 122, 2, 'PC-SAMETH ', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 80, '', 0, '06-09-2024\r\n', 'Core i5 4200M @ 2.5GHz\r\n4Go DDR3-1600\r\nDD 500Go ', 3, 'Sameth / VL240775 (Virginie)', '2014-03-27'),
(334, ' CCQ18070XU1', -1, -1, 10, 'Cisco RV110W', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, 'Remplacé', '', 0, 'cisco / cisco', '2014-03-27'),
(335, '', 25, -1, 10, 'DIR-600', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, 80, '192.168.1.1', 0, '', '', 0, 'admin / password', '2014-04-08'),
(336, 'YLUA040348', 1, 122, 2, 'Conseiller2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '???', 'Core i3 4000M\r\n4Go DDR3-1600\r\nDD 500Go ', 3, '', '2014-09-14'),
(337, '', -1, -1, 3, 'Sharp MX-2651', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '192.168.0.100', 0, '23/12/2024', '', 0, ' / admin', '2019-05-14'),
(338, '', -1, -1, 3, 'Sharp MX-C300W', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, 80, '192.168.0.207', 0, '23/12/2024', '', 0, ' / 00000', '2019-05-17'),
(339, '', 6, -1, 1, 'Poste-Secretariat', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '06-09-2024', 'AMD Sempron 145 @ 2,80Ghz\r\nRam 4Go\r\nWindows 7 HP x32 SP1\r\nOffice Pro 2003', 0, '', '2017-05-15'),
(340, 'E71793F5J806269', 7, 155, 3, 'BRWC48E8F980A6F', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '192.168.0.21', 0, '', '', 0, '', '2016-06-09'),
(341, ' E5Z566888', 7, 156, 3, 'BRW008092D90AC9', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '192.168.0.22', 0, '', '', 0, '', NULL),
(342, 'YM9D002177', 1, 157, 2, 'A556-AIM', 41, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '', 1, '', 'Intel Core i5 6200U @ 2.30GHz\r\n8 Go DDR4 - 2133 MHz\r\n1 To SSD Samsung Evo\r\nRadeon R7 M360', 1, 'Portable atelier', '2016-04-10'),
(343, '', 1, 127, 1, 'Q520', 18, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '', 0, 'Vendu à Christophe PLAT', '', 1, 'Cédric', '2016-06-09'),
(344, '', 1, -1, 1, 'Esprimo X923T', 21, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '', 0, '09/04/2026', '', 1, '', '2014-12-10'),
(345, '2BD74C5L00CFE', 26, -1, 8, 'WN604', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 107, '192.168.0.100', 0, '17/04/2026', '', 0, '', '2019-05-17'),
(346, '', 1, -1, 5, 'Serveur VMWare RX-200', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '192.168.0.250', 0, '', '', 0, '', '2012-02-05'),
(347, '', -1, -1, 12, 'Camera PTZ', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '192.168.0.253', 0, 'hs', '', 0, '', '2019-04-02'),
(348, 'YLUA035307', 1, 122, 2, 'A544', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 24, '', 0, '', 'Intel Core i3 4000-M @ 2.40GHz\r\nRam 4 Go\r\nEcran 15.6\"', 0, '', '2014-05-11'),
(349, '', 15, -1, 1, 'Poste002', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 53, 'DHCP', 0, '', 'Intel Core i3-3240 @ 3.40 GHz\r\nRam 4 Go\r\nEcran 20\"  HP Prodisplay P201', 0, '', '2016-09-03'),
(350, '', 13, 161, 1, 'AREHA-PC-MF', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 53, 'DHCP', 0, '', 'Intel Core i3-4170 @ 3.70 GHz\r\nRam 4 Go\r\nEcran 22\"  ACER KA220HQ @ Imp Canon MP 240', 0, '', NULL),
(351, '', 15, 162, 1, 'A5777-P005', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 53, 'DHCP', 0, '', 'Intel Core i3-4130 @ 3.40 GHz\r\nRam 4 Go\r\nEcran 20\"  HP Prodisplay P201', 0, '', NULL),
(352, 'YLTH600234', 1, 124, 1, 'P420-INFIRM', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 53, '', 0, '', 'Intel Core i3-4160 @ 3.6 GHz\r\nRam 4 Go\r\n', 1, 'Infirmerie', '2015-10-05'),
(353, 'YLTH187235', 1, 124, 1, 'AREHA-ASSO', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, '', 0, '', 'Intel Core i3-4130 @ 3.40 GHz\r\nRam 4 Go\r\nEcran Fujitsu 24\" B24T-7\r\nImprimante Canon MG5550', 1, '', '2014-07-06');
INSERT INTO `ouapi_hardware` (`id`, `num_serie`, `marque_id`, `modele_id`, `type_id`, `nom`, `os_id`, `cpu_id`, `ram_capacite`, `ram_type_id`, `disque_capacite`, `disque_type_id`, `service_pack`, `user_id`, `agence_id`, `emplacement_id`, `ip`, `reservable`, `suivi_rebus`, `commentaire`, `pfield_garantie`, `pfield_utilisateurprinc`, `creation_date`) VALUES
(354, '', 1, 124, 1, 'VERONIQUE', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, '', 0, '', 'Intel Core i5 2460 @ 3.1 GHz\r\nRam 4 Go\r\nEcran L22T-3\r\nCanon MP 210', 1, 'Veronique / chaleur', '2016-09-03'),
(355, '', 13, 163, 1, 'COMPTA1', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, 'DHCP', 0, '', 'Intel Core i3-4150 @ 3.50 GHz\r\nRam 4 Go\r\nEcran 22\" LG W2240', 0, 'Isabelle', '2016-09-03'),
(356, '', 15, 164, 1, 'Poste3-A5777', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, 'DHCP', 0, '', 'Intel Core i3-3240 @ 3.40 GHz\r\nRam 4 Go\r\nEcran 20\" HP Prodisplay P201\r\nImprimante Epson SX400', 0, '', '2016-09-03'),
(357, '', 11, -1, 1, 'ASFAVE', 5, 0, NULL, 0, NULL, 0, NULL, 0, 11, -1, '', 0, '', 'AMD Athlon II x2 215 @ 2.70GHz\r\nRam 3 Go\r\nEcran 17\" Hyundai B70A', 0, '', NULL),
(358, '', 15, 162, 1, 'PC-Qualiticienne', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 53, 'DHCP', 0, '', 'Intel Core i3-4130 @ 3.40 GHz\r\nRam 4 Go\r\nEcran 20\"  HP Prodisplay P201', 0, '', NULL),
(359, '', 15, 164, 1, 'Poste001', 3, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, 'DHCP', 0, '', 'Intel Core i3-3240 @ 3.40 GHz\r\nRam 4 Go\r\nEcran 17\" Hyundai X73S\r\nImprimante Canon MG3550', 0, 'Pierre', '2016-09-03'),
(360, '', 15, -1, 1, 'Poste003', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 54, 'DHCP', 0, '', 'Intel Core i3-3240 @ 3.40 GHz\r\nRam 4 Go\r\nEcran 20\"  HP Prodisplay P201\r\nImprimante Canon MG3550', 0, 'Laurent', '2016-09-03'),
(361, 'YM3M010786', 1, 134, 2, 'A555', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', 'Core i5 5200U @ 2.2 GHz\r\n4Go DDR3\r\n1To HDD\r\n', 3, 'Guillaume Tabiteau', '2015-01-01'),
(362, 'DSDN018677', 1, 165, 2, 'LBE744', 3, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '14/11/2023\r\n', 'Core i5 4210M @ 2.6 GHz\r\n8 Go\r\n500Go SSHD', 3, 'Céline Gutierrez', '2015-10-25'),
(363, 'YLNC275592', 1, 126, 2, 'A512', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Core i3 3110 @ 2.4GHz\r\n4Go\r\n256Go SSD WD Green', 3, 'XENTRY / bellequipment.fr', '2015-02-25'),
(364, ' YM4X173004', 1, 166, 1, 'PEPS-1', 21, 0, NULL, 0, NULL, 0, NULL, 2, 2, 9, '192.168.1.11', 0, '09/07/2024', 'Core i5-6400 @ 2.7 GHz\r\n4GB DDR4-2133\r\n500GB SATA III', 3, 'Candie Guerinet', '2016-12-02'),
(365, 'YM4X173006', 1, 166, 1, 'PEPS-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 9, '192.168.1.10', 0, '13/04/2024', 'Core i5-6400 @ 2.7 GHz\r\n4GB DDR4-2133\r\n500GB SATA III', 3, 'Corine Burdon', '2016-12-01'),
(366, 'YM4X244169', 1, 166, 1, 'P556-2017_01-A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '30/12/2025', 'Core i5 6400 @ 3.7 MHz\r\n4Go DDR4 2133\r\nDD 500 Go SATA3 7.2k', 3, '??? (ex Flavie Pergaud)', '2017-01-01'),
(367, 'YM4X244167', 1, 166, 1, 'P556-1701B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', 'Core i5 6400 @ 3.7 MHz\r\n4Go DDR4 2133\r\nDD 500 Go SATA3 7.2k', 3, 'Utilisateur (Compta 2)', '2016-12-31'),
(368, 'YM4X244176', 1, 166, 1, 'P556-1701', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 63, '', 0, '', 'Core i5 6400 @ 3.7 MHz\r\n4Go DDR4 2133\r\nDD 500 Go SATA3 7.2k', 3, 'Utilistateur (Aquasost) - Infirmerie', '2017-01-01'),
(369, 'YM4X244166', 1, 166, 1, 'P556-2017_01-C', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '20/12/2023', 'Core i5 6400 @ 3.7 MHz\r\n4Go DDR4 2133\r\nDD 500 Go SATA3 7.2k', 3, 'GED (<-Franck Carry)', '2017-01-01'),
(370, ' YM9C031672', 1, 157, 2, 'A556', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', 'Core i5  6200U @ 2.3 GHz\r\n4 Go DDR4\r\nDD 500Go', 3, 'Jean Lhermitte', '2016-11-23'),
(371, 'YLQK022197', 1, 167, 5, 'TX2540_M1', 25, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '192.168.0.250', 0, '', 'ESXi 6.0\r\nVFY:T2541SX310FR', 3, 'root / hyacinthe31', '2017-01-08'),
(372, '', -1, -1, 3, 'Canon iP7200', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '192.168.1.117 (dhcp)', 0, '.', 'Imprimante Wifi', 1, 'Maude Présinat', '2017-01-08'),
(373, 'YM3M130567', 1, 134, 2, 'A555-2017_01-FL', 21, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Core i3 5005U @ 2GHz\r\n4Go DDR3L 1600MHz\r\n500Go SATA', 1, 'Maria', '2017-01-08'),
(374, 'YM3M130680', 1, 134, 2, 'A555-1701', 21, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Core i3 5005U @ 2GHz\r\n8Go DDR3L 1600MHz\r\n250Go SSD', 1, 'Stock', '2017-01-09'),
(375, 'DSEP016581', 1, 168, 2, 'E736', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, 'DHCP', 0, '20/05/2025', 'Core i5  6200U @ 2.3 GHz\r\n8 Go DDR4\r\nSSD 500Go', 3, 'Frédéric Noël', '2017-01-10'),
(376, ' YM9C029062', 1, 157, 2, 'A556', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, 'DHCP', 0, '20/05/2025', 'Core i5  6200U @ 2.3 GHz\r\n4 Go DDR4\r\nDD 500Go', 3, 'Guillaume Pottier', '2017-01-10'),
(379, 'YM4X173516', 1, 154, 1, 'SERVICE-TECHNIQUE', 21, 0, NULL, 0, NULL, 0, NULL, 0, 8, 127, 'DHCP', 0, '', 'Intel(R) Core(TM) i3-6100 CPU @ 3.70GHz, DDR4 4Go, SSD KINGSTON 480 Go', 3, 'Service technique / Samuel Lejeune', '2016-12-19'),
(380, '', 1, 171, 1, 'ATELIER', 21, 0, NULL, 0, NULL, 0, NULL, 1, 1, 56, '', 0, '19/04/2023', '', 0, '', '2016-12-13'),
(381, 'YM4X208597', 1, 166, 1, 'P556-201702', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '20/08/2025', 'Intel Core i7 6700 @ 3.4 GHz\r\n8 Go de DDR4 PC4-17000 2133 MHz\r\nDD 256 Go SSD SATA III\r\n', 3, 'Alexandre Chavegrand (Alexandre)', '2017-01-31'),
(382, 'YM4X267293', 1, 166, 1, 'PCRI007', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, 'DHCP', 0, '', 'Intel Core i5 6400 @ 2.7 GHz\r\n8 Go DDR4 PC4-17000\r\n256 Go SSD SATA', 3, 'Cindy Loriot', '2017-02-08'),
(383, 'YM4X294071', 1, 166, 1, 'P556-201703', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i7 6700 @ 3.4 GHz\r\n8 Go DDR4 PC4-17000 2133 MHz\r\n256 Go SSD SATA III\r\n8XN2B-V3CXF-CX37F-HTDXV-WK8YK', 3, 'Stagiaire (ancien Mickaël)', '2017-03-11'),
(384, 'YM4P120054', 1, 154, 1, 'D556-2017-03', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 97, '', 0, '08/03/2023', 'Intel Pentium G4500 @ 3.5 GHz\r\n4 Go DDR4 SDRAM PC4-17000\r\n128 Go SSD SATA\r\n', 3, 'MARIE-LINE / momoforever', '2017-03-11'),
(385, 'R3CM1E4000011', 25, -1, 6, 'DES-3200-52P', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.5', 0, '', 'admin / admin', 0, '', '2023-02-20'),
(386, 'YM5U028529', 1, 172, 1, 'W550-201703', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '', 0, '', 'Intel Xeon E3-1275 v5 @ 3.60GHz\r\n8Go DDR4-2400 (1200 MHz)\r\n256 Go SSD SATA\r\nNVIDIA Quadro M2000 4Go DDR5', 3, 'BE', '2017-03-25'),
(387, '', 5, -1, 1, 'WI1520-ATELIER', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 105, '', 0, 'Rebut', 'Intel Core 2 Duo E8400@ 3.00GHz\r\n4Go DDR2 PC2-6400 (400 MHz) ECC\r\nNVIDIA Quadro FX 1700 (512Mo DDR2)\r\n', 0, 'Olivier (Atelier/Montage) (GPAO / somac)', '2017-03-28'),
(388, 'YMCQ021842', 1, 170, 2, 'A557-2017-03', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 105, '', 0, '', 'Intel Core i5 7200U @ 2.5 Ghz\r\n8Go DDR4\r\n256 Go SSD', 3, 'ATELIER (Jean BOURCY)', '2017-03-27'),
(389, '', 13, 173, 2, 'DELL-GEST', 23, 0, NULL, 0, NULL, 0, NULL, 0, 2, 66, '', 0, 'Obsolète', '4Go\r\n', 0, 'Marie Robichon', '2014-11-09'),
(393, '', 11, 175, 2, 'POC-NUMÉRIQUE', 23, 0, NULL, 0, NULL, 0, NULL, 0, 2, 66, '', 0, 'rebut', '4Go', 0, 'Divers', '2016-09-04'),
(390, '', 6, 9, 1, 'COMPTA-PC', 5, 0, NULL, 0, NULL, 0, NULL, 0, 2, 66, '', 0, '01/01/2022', '8Go', 0, 'Ellie Lesure', '2014-11-17'),
(391, '', 3, 174, 2, 'GESTIONDCT', 23, 0, NULL, 0, NULL, 0, NULL, 0, 2, 66, '', 0, 'rebut', '4Go', 0, 'Marie Dehertog', '2016-09-29'),
(392, '', 11, 175, 2, 'POC-CULTURE', 23, 0, NULL, 0, NULL, 0, NULL, 0, 2, 66, '', 0, 'rebut', '4Go', 0, 'Divers', '2016-10-08'),
(394, '', 13, 173, 2, 'DELL-ANIM', 23, 0, NULL, 0, NULL, 0, NULL, 0, 2, 66, '', 0, 'Obsolete', '4Go', 0, 'Ellie', '2014-11-10'),
(395, '', 3, 176, 2, 'PAYSOUESTCREUSE', 3, 0, NULL, 0, NULL, 0, NULL, 0, 2, 66, '', 0, 'Vieux', '4Go', 0, 'Juliette', '2011-10-03'),
(400, 'ZND493GZ301557H', 2, 6, 2, 'NP-R730', 23, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 1, '19-04-2023\r\n', 'Intel Pentium Dual-Core T440 @ 2.2GHz\r\n4Go RAM\r\n300Go DD', 0, '', '2017-04-02'),
(397, 'YLPU004058', 1, 129, 11, 'Q703-201411-1', -1, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', 'Marvell 2.0GHz\r\n1 Go DDR3\r\n2x1To HDD (RAID 1)\r\n', 3, '', '2014-11-24'),
(398, 'YLPU004075', 1, 129, 11, 'Q703-201411-2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', 'Marvell 2.0GHz\r\n1 Go DDR3\r\n2x1To HDD (RAID 1)\r\n', 3, '', '2014-11-24'),
(399, 'YM5U028522', 1, 172, 1, 'W550-201704', 21, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', 'Intel Xeon E3-1275 v5 @ 3.60GHz\r\n8Go DDR4 2133MHz ECC\r\n256 Go SSD SATA\r\nNVIDIA Quadro M2000 4Go DDR5\r\n1 To HDD SATA\r\nIntel HD Graphics P530', 3, 'Julien Laclemence (DAO / l)', '2017-03-30'),
(401, 'LXPCR0212900600BB12300', 11, 177, 2, 'AS3810T', 22, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 1, '19-04-2023', 'Intel Core 2 Solo U3500 @ 1.4GHz\r\n3Go RAM\r\n250Go SSD', 0, '', '2017-04-02'),
(402, 'YMCQ015695', 1, 170, 2, 'A557-201704', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, '', 'Intel Core i5 7200U @ 2.5 Ghz\r\n4Go DDR4 PC4-2133\r\n500Go HDD', 3, 'Figuline', '2017-04-03'),
(403, 'YMCQ006987', 1, 170, 2, 'A557-201704', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '20/05/2025', 'Intel Core i5 7200U @ 2.9GHz\r\n4Go DDR4 SDRAM 2133MHz\r\n500Go SATA\r\nIntel HD Graphics 620', 3, 'Yves Prévot', '2017-04-05'),
(470, 'YM4X294124', 1, 166, 1, 'P556-201704', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, '', 'Intel Core i7 6700 @ 3.4GHz\r\n8Go DDR4 PC4-17000 2133MHz\r\n256Go SSD SATA\r\n1To HDD SATA\r\nIntel HD Graphics 530', 3, 'Marc Chavegrand (Prod01)', '2017-04-12'),
(471, 'YM3P055229', 1, 133, 2, 'A514-201601', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '', 'Intel Core i3-4005U @ 1.70GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics Family\r\n500,00 Go (WDC WD5000LPCX-16VHAT1)\r\nGarantie 3 ans', 3, 'Utilisateur (commercial)', '2016-04-28'),
(665, 'YLTH132139', 1, 124, 1, 'PC-COMCOM', 3, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '192.168.2.2', 0, '01/03/2023', 'Intel Core i5-4430 @ 3.00GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6A SCSI Disk Device)', 3, 'Nathalie / danses', '2014-06-10'),
(464, 'YMCQ006992', 1, 170, 2, 'A557-201704', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n4,00 Go  @ 2133MHz\r\n500,00 Go (WDC WD5000LPCX-16VHAT1)\r\nGarantie 3 ans sur site J 1', 3, 'reffamille / 4m3l1e18@ (Amélie)', '2017-04-12'),
(465, '', 17, -1, 2, 'ASUS X751M', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 1, '19-04-2023\r\n', 'Pentium\r\n4Go\r\n256Go SSD', 0, '', '2017-04-12'),
(466, 'S140F50002148', 27, -1, 8, 'WAP3205 v2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 1, 'Vendu à Epic Scenovision', 'Point d\'accès Wifi Zyxel WAP3205 v2', 0, '', '2017-04-12'),
(475, 'YM3M160625', 1, 134, 2, 'A555-201704-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n500,00 Go (TOSHIBA MQ01ABF050)\r\nGarantie 3 ans sur site', 3, 'Utilisateur', '2017-04-28'),
(474, '5CD7042DS3', 15, 185, 2, ' FUJITSU-A530-D', 23, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', 'Intel Core i3-7100U @ 2.40GHz\r\n4,00 Go  @ 2133MHz\r\nNVIDIA GeForce 930MX\r\n1Â 000,00 Go (WDC WD10JPVX-60JC3T0)\r\nGarantie 3 ans sur site J 1', 3, 'Stock salle info', '2017-04-27'),
(476, 'YM3M160624', 1, 134, 2, 'A555-201704-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '', 'Intel) Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n500,00 Go (TOSHIBA MQ01ABF050)\r\nGarantie 3 ans sur site', 3, 'Utilisateur', '2017-04-28'),
(577, 'YLPU005420', 1, 131, 1, 'ACCUEIL', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur2 (Alexandra Jingeaud)', '2013-11-28'),
(578, 'YLP056684', 1, 131, 1, 'ATELIER1', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '21/06/2023', '4 096 Mio', 0, 'Utilisateur28 (David Marcadier)', '2014-08-31'),
(579, 'YLRR076193', 1, 118, 1, 'C720-COMPTA', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '21/06/2023', '4 096 Mio', 0, 'Utilisateur34 (Isabelle Dumazet)', '2016-02-15'),
(580, 'YLNF059549', 1, 253, 1, 'W530-Design-Com', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '8 192 Mio', 0, 'Utilisateur51 (Pauline Jay)', '2015-06-07'),
(581, 'YM4P021315', 1, 154, 1, 'D556-201604', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '21/06/2023', '4 096 Mio', 0, 'Utilisateur25 (Alexandre Picard)', '2016-04-04'),
(582, 'YM4P037449', 1, 154, 1, 'D556-05-16-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '21/06/2023', '4 096 Mio', 0, 'Utilisateur17 (Guillaume Assimon)', '2016-05-25'),
(583, 'YM4P029868', 1, 154, 1, 'D556-05-16-3', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, '21/06/2023', '4 096 Mio', 0, 'Utilisateur10 (Julie Audebert)', '2016-05-25'),
(584, 'YM4P021945', 1, 154, 1, 'D556-10-16', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, 'rebut', '4 000 Mio', 0, 'Utilisateur8 (Caroline Chambraud)', '2016-10-16'),
(585, 'YM4P029870', 1, 154, 1, 'D556-SECURITE', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur12 (Sécurité Hygiène)', '2016-05-25'),
(586, 'YL3M137687', 1, 11, 1, 'FUJI-P2550-W7-B', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, 'pour revente 07/07/2017', '4 096 Mio', 0, 'Revente', '2010-05-01'),
(587, 'YL9P178525', 1, 37, 2, 'A530-201707-4', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'Mise en vente', '2 048 Mio', 0, 'Stagiaire', '2011-05-10'),
(588, 'YL9P178517', 1, 37, 2, 'A530-201707-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, 'rebut', '2 048 Mio\r\n', 0, 'Déclassé', '2011-05-10'),
(589, 'YL9P178526', 1, 37, 2, 'A530-201707-3', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '2 048 Mio', 0, 'Stagiaire', '2011-05-10'),
(590, 'YL9P178523', 1, 37, 2, 'A530-201707-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '2 048 Mio', 0, 'Stagiaire', '2011-05-10'),
(591, 'YL4Q252959', 1, 3, 1, 'FUJITSU-P2560-B', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, NULL, 0, 'rebut', '4 096 Mio', NULL, 'Evolis23', '2011-04-01'),
(592, 'YL3M137688', 1, 11, 1, 'FUJITSU-W7-A', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'pour revente 07/07/2017', '2 048 Mio', 0, 'Revente', '2010-05-01'),
(593, 'YL3M137691', 1, 11, 1, 'Interne atelier', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, NULL, 0, 'A revendre', '2 048 Mio', NULL, 'Michel Cellas', '2010-05-01'),
(594, 'PC318', 5, 24, 1, 'NEC-VL280-W7-2', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, NULL, 0, 'Obselete', '4 096 Mio', NULL, 'Sylvie Debard', '2012-04-27'),
(595, 'PC285', 1, 187, 2, 'NH751', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '6 144 Mio', 0, 'Utilisateur 5 (Magali Wilmot)', '2012-05-09'),
(596, 'YL3M137694', 1, 11, 1, 'P2550_SECOUR', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, NULL, 0, 'rebut', '4 096 Mio', NULL, 'Equipe Voirie', '2009-11-24'),
(597, 'YL3M137699', 1, 11, 1, 'P2550-04-10-B', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, NULL, 0, 'A vendre', '4 096 Mio', NULL, 'Nicolas Boos', '2010-05-01'),
(598, 'YL4Q252958', 1, 3, 1, 'P2560-03-11-A', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur19 (Lilian Brunaud)', '2011-03-31'),
(599, 'YL8E038300', 1, 3, 1, 'P2760-03-11', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, NULL, 0, 'A vendre', '6 144 Mio', NULL, 'Murielle Yvernault', '2011-04-01'),
(600, 'YKQB019353', 1, 131, 1, 'P700-0512-1', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, NULL, 0, 'rebut', '1 920 Mio', NULL, 'EVOLIS 23 - Service Compta', '2017-01-01'),
(601, 'YLDA067889', 1, 81, 1, 'P700-0512-1 (POUR PIECES)', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, NULL, 0, 'pour pièce', '4 096 Mio', NULL, 'EVOLIS 23 - POUR PIECES', '2012-05-10'),
(602, 'YLDA067895', 1, 81, 1, 'P700-0512-2', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '21/06/2023', '8 192 Mio', 0, 'Utilisateur54 (Ligne Info Dechets)', '2012-05-09'),
(603, 'YLDA067888', 1, 81, 1, 'P700-0512-3', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, 'rebut', '4 096 Mio', 0, 'Ex Marie Beaubrun', '2012-05-10'),
(604, 'YLDA067892', 1, 81, 1, 'P700-0512-4', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'Fin de vie', '6 144 Mio', 0, 'Utilisateur37 (Vincent Fortineau)', '2012-05-09'),
(605, 'YLDA067893', 1, 81, 1, 'P700-0512-5', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, 'rebut', '6 144 Mio', 0, 'Utilisateur18 (Didier Pouzeaud)', '2012-05-09'),
(606, 'YLDA067894', 1, 81, 1, 'P700-0512-6', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur57 (Evelyne Macedo)', '2012-05-09'),
(607, 'YLHW052064', 1, 110, 1, 'P710-05-13', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur27  (Cinthia Zambrano-Bastard)', '2013-05-26'),
(608, 'YLHW078515', 1, 110, 1, 'P710-09-13-A', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur21 (Michel Aubard)', '2013-09-29'),
(609, 'YLHW078513', 1, 110, 1, 'P710-09-13-B', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur10 (Julie Audebert)', '2013-09-29'),
(610, 'YLHW078516', 1, 110, 1, 'P710-09-13-C', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '21/06/2024', '4 096 Mio', 0, 'Utilisateur33 (Sylvie Debard)', '2013-09-29'),
(611, 'YLHW078507', 1, 110, 1, 'P710-09-13-D', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur38 (Aurélie Hélias)', '2013-09-29'),
(612, 'YLHW078511', 1, 110, 1, 'P710-09-13-E', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, 'rebus', '4 096 Mio', 0, 'Utilisateur24 (Nathalie Guillot)', '2013-09-29'),
(613, 'YLHW078512', 1, 110, 1, 'P710-09-13-F', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '19/01/2024', '4 096 Mio', 0, 'Utilisateur7 (Sévrine Cairon)', '2013-09-29'),
(614, 'YLHW004781', 1, 110, 1, 'P710-A-REYS', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur32 (Denis Mausset)', '2012-08-20'),
(615, 'YLPU029550', 1, 131, 1, 'P720-1404-CHAL', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '16/10/2025', '4 096 Mio', 0, 'Utilisateur46 (Olivier Lory)', '2014-04-15'),
(616, 'YLPU029548', 1, 131, 1, 'P720-1404-DECH', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur8 (Caroline Chambraud)', '2014-04-15'),
(617, 'YLPU029551', 1, 131, 1, 'P720-1404-DRH', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '19/01/2024', '4 096 Mio', 0, 'Utilisateur14 (Anne-Gaelle Burban)', '2014-04-15'),
(618, 'YLPU029543', 1, 131, 1, 'P720-1404-SVCOM', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'ex pauline', '4 096 Mio', 0, 'Déclassé', '2014-04-16'),
(619, 'YLPU029549', 1, 131, 1, 'P720-1404-TRI', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur46 (Olivier Lory)', '2014-04-15'),
(620, 'YLPU096101', 1, 131, 1, 'P720-GESTION-PE', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebus', '4 096 Mio', 0, 'Utilisateur11 (Dominique Cochin)', '2015-05-31'),
(621, 'YLHW052055', 1, 110, 1, 'P720-TECH', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '8 192 Mio', 0, 'Utilisateur13 (Eric Dupeux)', '2013-05-26'),
(622, 'YL9P112198', 1, 37, 2, 'PORTABLE 3', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'rebut', '4 096 Mio', 0, 'Utilisateur39 (Accueil Chalet)', '2011-01-18'),
(623, 'YLAQ015409', 1, 188, 5, 'PRIMERGY RX200 S7', 25, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, NULL, 0, 'Fin de vie', '', NULL, 'Evolis 23', '2013-08-19'),
(624, 'YL4Q065100', 1, 11, 1, 'REUNION', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, NULL, 0, 'rebut', '4 096 Mio', NULL, 'Evolis 23', '2010-08-01'),
(625, 'RF2F208WLWB', 2, 189, 14, 'Samsung GALAXY Note PRO', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '', 0, 'Service Commnunication', '2015-01-18'),
(626, 'ZQQX93KZ7000016F', 2, 190, 2, 'SAMSUNG N230', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, NULL, 0, 'rebut', '2 048 Mio', NULL, 'Lilian Brunaud', '2011-05-18'),
(627, 'YL4Q252956', 1, 3, 1, 'P2560-201104', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, 'A vendre', '2 048 Mio', 0, 'Evolis23', '2011-04-01'),
(628, '00330-61662-75154-AAOEM', 4, 191, 13, 'Thinkpad-201701', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '19/01/2024', '4 000 Mio', 0, 'Utilisateur56 / cs575 (Controleur Spanc)', '2017-01-08'),
(902, 'YLTH017972', 1, 124, 1, 'SECRETARIAT1-SE', 3, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, 'DHCP', 0, 'rebut', 'Intel Core i3-4130 3Ghz\r\n4 Go de DDRIII PC3-10600 1333 MHz\r\n500 Go - SATA III 600Gb', 3, 'Secrétaire', '2014-01-20'),
(630, '008518671053', 40, 192, 13, 'FUJITSU-A530-C', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, 'HS', 'Intel Core m3-6Y30 @ 0.90GHz\r\n4,00 Go  @ 1867MHz\r\nIntel HD Graphics 515\r\n128,00 Go (SAMSUNG MZFLV128HCGR-000MV)\r\nGarantie 3 ans', 3, 'Utilisateur6 (Carine Lassence)', '2017-05-01'),
(631, 'YLNC198314', 1, 126, 2, 'A512', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-3110M @ 2.40GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4000\r\n500,00 Go (TOSHIBA MQ01ABF050)\r\nGarantie 3 ans', 3, 'Utilisateur', '2014-09-24'),
(780, 'HCNXCV12L74151C', -1, -1, 2, 'P1700UV-201802', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 105, '', 0, '', 'Intel Core i5-8250U @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nNVIDIA GeForce 920MX\r\n256,00 Go (HFS256G39TND-N210A)', 2, 'GPAO (Olivier Montage)', '2018-02-13'),
(636, 'E69760L1N323703', 7, 195, 3, 'BRN001BA998CCC3', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '172.21.18.114', 0, '', '', 0, 'Arnaud Maridat', '2011-01-01'),
(637, 'E75331C6N215407', 7, 196, 3, 'BRN30055CB984F9', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '172.21.18.17', 0, '', '', 0, 'Comptoire', '2015-01-01'),
(638, 'YLVS003451', 1, 123, 1, 'A525-L', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '172.21.18.118', 0, '24/03/2023', 'AMD GX-217GA SOC\r\n4,00 Go DDR3 @ 800MHz\r\nAMD Radeon HD 8280E\r\n320,00 Go (TOSHIBA MQ01ABD032 SATA)\r\nGarantie 1 an', 1, 'Michel', '2014-09-24'),
(639, 'YL8E001301          ', 1, 4, 1, 'W19_002', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, 'rebut', 'Intel Core i3  530  @ 2.93GHz\r\n4,00 Go SDRAM @ 1333MHz\r\nIntel HD Graphics\r\n1 000 Go (Hitachi DT721010SLA360)', 3, 'Pascal', '2010-08-31'),
(642, 'E73436L5J235782', 7, 197, 3, 'BRN30055C8841DA', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', '', 1, 'Atelier', '2016-06-14'),
(643, '', 42, 198, 3, 'SP 3600SF', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', '', 0, 'Magasin', '2015-01-01'),
(644, 'YLCM274028', 1, 102, 1, 'W18_007', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, 'récup par manu', 'Intel Core i5-2320 @ 3.00GHz\r\n4,00 Go  @ 1333MHz\r\nIntel HD Graphics\r\n500,00 Go (WDC WD5000AAKX-07U6AA0)\r\nGarantie 3 ans sur site J 1', 3, 'Manu - Comptoire', '2012-10-23'),
(645, 'YLPV003360', 1, 199, 1, 'FUJITSU-P410', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '24-03-2023', 'Intel Core i3-3220 @ 3.30GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics\r\n500,00 Go (WDC WD5000AAKX-07U6A)\r\nGarantie 3 ans sur site J+1', 3, 'Ancien Arnaud', '2013-07-22'),
(646, 'YLRR041716', 1, 118, 1, 'W18_009', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '23/04/2021', 'Intel Core i5-4590 @ 3.30GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6A SCSI Disk Device)\r\nGarantie 3 ans sur site J 1', 3, 'Philippe (Chef Atelier)', '2014-09-08'),
(647, 'YLCM274031', 1, 102, 1, 'W18_006', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-2320 @ 3.00GHz\r\n4,00 Go  @ 1333MHz\r\nIntel HD Graphics\r\n500,00 Go (WDC WD5000AAKX-07U6AA0)\r\nGarantie 3 ans sur site J 1', 3, 'Utilisatur', '2012-10-22'),
(648, 'YL3M011465          ', 1, 11, 1, 'W18_012', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '23/03/2023', 'Pentium Dual-Core       E5300  @ 2.60GHz\r\n2,00 Go DDR2 @ 667MHz\r\nNVIDIA GeForce 7100 @ NVIDIA nForce 630i\r\n320,00 Go (Hitachi HDT721032SLA SCSI Disk Device)\r\nGarantie 3 ans sur site J 1', 3, 'Magasinier', '2009-11-06'),
(649, 'YLCM274026', 1, 102, 1, 'W18_008', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '23/03/23\r\n', 'Intel Core i5-2320 @ 3.00GHz\r\n4,00 Go  @ 1333MHz\r\nIntel HD Graphics\r\n500,00 Go (WDC WD5000AAKX-07U6AA0)\r\nGarantie 3 ans sur site J 1', 3, 'Utilisateur', '2012-10-22'),
(650, '', 7, -1, 3, 'DCP-L8400CDN', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Pas en réseau\r\nConnexion USB', 0, 'Virginie Maridat', '2017-05-04'),
(651, '', 30, 200, 3, 'PAGEPRO 1490MF', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', '', 0, 'Administration', '2014-01-01'),
(652, 'YLRR041717', 1, 118, 1, 'W18_003', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, ' 	23/04/2021', 'Intel Core i5-4590 @ 3.30GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6A SCSI Disk Device)\r\nGarantie 3 ans sur site J 1', 3, 'Jose', '2014-09-09'),
(653, 'YLRR041719', 1, 118, 1, 'W18_005', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, ' 	23/04/2021', 'Intel Core i5-4590 @ 3.30GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6A SCSI Disk Device)\r\nGarantie 3 ans sur site J 1', 3, 'Fabienne', '2014-09-09'),
(654, '', 13, 30, 1, 'JJP', 1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '12/12/2017', 'Pentium D @ 2,80 GHz\r\n1Go', 0, 'Jean Jacques', '2005-05-04'),
(655, 'YLRR041715', 1, 118, 1, 'W18_004', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, ' 	23/04/2021', 'Intel Core i5-4590 @ 3.30GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6A SCSI Disk Device)\r\nGarantie 3 ans sur site J 1', 3, 'Sylvie', '2014-09-09'),
(656, '', 13, 30, 1, 'MIKAEL', 1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '.', 'Pentium D @ 2,80 GHz\r\n1Go', 0, 'Mikael', '2005-05-04'),
(660, 'YLNC139944', 1, 126, 2, 'A512', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-3110M @ 2.40GHz\r\n4,00 Go  DDR3 @ 1600MHz\r\nIntel HD Graphics 4000\r\n320,00 Go\r\nGarantie 3 ans sur site + LCD', 3, 'Utilisateur', '2014-03-14'),
(778, 'YL9P117406', 1, 37, 2, 'DESKTOP-LMSG5T1', 22, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '', 'Intel Core i3 M 370  @ 2.40GHz\r\n3,00 Go  @ 667MHz\r\nIntel HD Graphics\r\n320,00 Go (ST9320325AS)', 1, 'atelier', '2018-02-13'),
(661, 'YLNC059564', 1, 126, 2, 'A512', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-2348M @ 2.30GHz\r\n4,00 Go  @ 1333MHz\r\nIntel HD Graphics 3000\r\n500,00 Go (TOSHIBA MQ01ABD050)\r\nGarantie 3 ans + LCD', 3, 'Utilisateur', '2013-08-07'),
(662, 'Q131I12099', 1, 204, 11, 'Q802', -1, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '192.168.0.250', 0, '', 'Intel(R) Atom(TM) D2701  @ 2.13GHz\r\n1Go DDR3\r\n', 0, 'admin / 3v0lis23', '2013-07-16'),
(663, 'Q152I23549', 28, 203, 11, 'NAS-Sauvegarde', -1, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '192.168.0.251', 0, '', 'Intel(R) Celeron(R) J1900  @ 2.00GHz (4 cœurs)\r\n4 Go DDR3 (1/2)', 0, 'admin / 3v0lis23', '2017-05-05'),
(666, 'YLTH132365', 1, 124, 1, 'P420-201406', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 90, '', 0, '', 'Intel Core i5-4430 @ 3.00GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6A)', 3, 'Accueil', '2014-06-09'),
(1057, 'YMKT067176', 1, 269, 1, 'Q558E-85-201912', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, '05/09/2023\r\n', 'Intel Core i3-9100 CPU @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Guy', '2019-12-16'),
(667, 'YLUA017024', 1, 122, 2, 'A544', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '01/03/2023', 'Intel Core i3-4000M @ 2.40GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000LPVX-16V0T)', 1, 'CCPD', '2017-05-10'),
(668, '2509824200', -1, -1, 4, 'MX-2610N - SCC3F266', -1, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '192.168.2.162', 0, 'hs', '', 0, 'Administrateur / admin', '2017-05-10'),
(669, 'YLCM237627', 1, 102, 1, 'PC-COMPTA', 4, 0, NULL, 0, NULL, 0, NULL, 0, 6, 111, '', 0, '', 'Intel Pentium G860 @ 3.00GHz\r\n3.00 Go  @ 1333MHz\r\nIntel HD Graphics\r\n500.00 Go (WDC WD5000AAKX-07U6A)', 1, 'Tifaine (AgentOT2)', '2014-06-10'),
(670, 'YLTH132255', 1, 124, 1, 'P420-HABITAT', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 125, '', 0, '', 'Intel Core i5-4430 @ 3.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6A)', 3, 'Sabrina / comcom (Pierre)', '2014-06-09'),
(671, 'ZYSJ93BB100060', 2, 5, 2, 'R730', 6, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '26/096/2025\r\n', 'Intel Core i3 M 380 @ 2.53GHz\r\n3,00 Go  @ 533MHz\r\nNVIDIA GeForce 310M\r\n500,00 Go (TOSHIBA MK5065GSX)', 1, 'Session (ALRD)', '2017-05-11'),
(672, '2CE4120X2M', 15, 206, 2, 'PC-SCETECH', 21, 0, NULL, 0, NULL, 0, NULL, 0, 29, 116, '', 0, '', 'Intel Core i3-4000M @ 2.40GHz\r\n4,00 Go  @ 1600MHz\r\nAMD Radeon HD 8750M\r\n500,00 Go (HGST  HTS545050A7E680)\r\n', 1, 'Accueil (Sandrine)', '2017-05-10'),
(673, 'CND43447BQ', 15, 260, 2, 'PROBOOK-ACCUEIL', 23, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '26/09/2025\r\n', 'Intel Core i3-4030U @ 1.90GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics Family\r\n500,00 Go (TOSHIBA MQ01ABF050)', 3, 'Nathalie (Nathalie Leroux)', '2014-11-27'),
(674, 'YLTH169656', 1, 124, 1, 'P420-ADC', 3, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '26/09/2025\r\n', 'Intel Core i3-4130 @ 3.40GHz\r\n4.00 Go  @ 1600MHz\r\nIntel HD Graphics 4400\r\n500.00 Go (ST500DM0 02-1BD142)', 1, 'Nadege', '2017-05-11'),
(675, '', 9, 15, 2, 'MACBOOKPRO-DB6D', 8, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '26/09/2025\r\n', 'Poste DGA', 0, 'Jean Michel Devaux', '2017-05-11'),
(676, 'YLLH017083', 1, 116, 2, 'N532-HABITAT', 3, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, 'Sorti', 'Intel Core i5-3230M @ 2.60GHz\r\n4,00 Go  @ 1600MHz\r\nNVIDIA GeForce GT 620M\r\n500,00 Go (ST500LT012-9WS142)', 1, 'mission.havitat2 / comcom (Cecile Mavigner)', '2017-05-11'),
(995, '', 26, -1, 12, 'Camera Arlo Ultra', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '', 0, '', '', 0, '', '2019-04-30'),
(681, '2CE4120X8R', 15, 206, 2, 'PC-ALSH-FUR', 3, 0, NULL, 0, NULL, 0, NULL, 0, 29, 112, '', 0, '26/09/2025', 'Intel Core i3-4000M @ 2.40GHz\r\n4,00 Go  @ 1600MHz\r\nAMD Radeon HD 8750M\r\n500,00 Go (HGST  HTS545050A7E680 SCSI Disk Device)', 1, 'ALSH / comcom (Sylvain Ducourtioux)', '2017-05-22'),
(682, 'YMEB006704', 1, 208, 1, 'D556-201705-01', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, '19/01/2024', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Stagiaire', '2017-05-23'),
(683, 'YMEB006705', 1, 208, 1, 'D556-201705-02', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '21/06/2023', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Utilisateur32 (Denis Mausset)', '2017-05-23'),
(684, 'P1KB39C000145', 25, -1, 11, 'DNS-323', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '', 1, 'rebut', 'MAC 00:26:5A:86:72:BB', 0, '', '2017-06-07'),
(686, 'YMCQ027923', 1, 170, 2, 'A557-201706-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 29, 116, '', 0, '26/09/2025', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7TY256HDHP-00000)', 3, 'Justine / epic', '2017-06-12'),
(687, 'YM3M170580', 1, 134, 2, 'A555-201706-3', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, -1, '', 0, '10/03/2025', 'Intel Core i3-5005U @ 2.00GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n256,00 Go (SAMSUNG MZ7TY256HDHP-00000)', 3, 'Poste Epic (David\\epic)', '2017-06-12'),
(688, 'YM3M170562', 1, 134, 2, 'A555-201706-5', 21, 0, NULL, 0, NULL, 0, NULL, 0, 29, 116, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n256,00 Go (SAMSUNG MZ7TY256HDHP-00000)', 3, 'Julien  / epic', '2017-06-13'),
(689, 'YL4Q253006', 1, 3, 1, 'P2560-201203', 4, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, 'Retrait', 'Intel Core 2 Duo E7500 @ 2.93GHz\r\n3,00 Go DDR2 @ 1067MHz\r\nNVIDIA GeForce GT 730\r\n500,00 Go (ST3500418AS ATA Device)', 1, 'RETRAIT (st01/stagiaire)', '2012-03-11'),
(691, 'YM3M170549', 1, 134, 2, 'A555-201706-4', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 8, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n256,00 Go (SAMSUNG MZ7TY256HDHP-00000)', 3, 'Lionel Védrine / epic', '2017-06-13'),
(692, 'UGZY071448', 43, -1, 3, 'Epson XP-760', -1, 0, NULL, 0, NULL, 0, NULL, 0, 29, 116, '192.168.1.76', 0, '', '', 1, '', '2017-06-25'),
(693, 'UGZY071453', 43, -1, 3, 'Epson XP-760', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 84, '192.168.1.76', 0, '', '', 1, '', '2017-06-25'),
(694, 'UGZY071480', 43, -1, 3, 'Epson XP-760', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 84, '192.168.1.76', 0, '', '', 1, '', '2017-06-25'),
(695, '', -1, -1, 4, 'Copieur Develop Ineo+ 224e', -1, 0, NULL, 0, NULL, 0, NULL, 0, 29, 116, '192.168.1.5', 0, '', '', 0, 'OT / 1', '2017-06-25'),
(696, 'YMCQ030939', 1, 170, 2, 'A557-201706', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 8, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HMJP-00000)', 3, 'David Marchegay', '2017-06-25'),
(697, 'YM4X299883', 1, 166, 1, 'PCRI015', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500,00 Go (TOSHIBA DT01ACA050)\r\n250,00 Go (Samsung SSD 850 EVO 250GB)', 3, 'Vincent Meirone', '2017-07-04'),
(699, '', -1, -1, 4, 'SHARP MX-2314N', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '10.10.0.23', 0, '26/02/2026', '', 0, 'admin / admin', NULL),
(700, '', 44, -1, 11, 'DISKSTATION211', 19, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '10.10.0.249', 0, 'Inutilisable (500Go)', '2 x 500 Go Raid 1', 0, 'admin / admin', '2017-07-16'),
(701, 'YM4X286301', 1, 166, 1, 'PC-CHRISTOPHE', 21, 0, NULL, 0, NULL, 0, NULL, 0, 13, 0, '', 0, '', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500,00 Go (TOSHIBA DT01ACA050)\r\n250,00 Go (Samsung SSD 850 EVO 250GB)', 3, 'Christophe', '2017-07-19'),
(702, 'YMCQ031274', 1, 170, 2, 'A557-201707', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Core i5-7200U @ 2.5GHz\r\n8 Go DDR4 2133MHz @ PC4-17000\r\nSSD 256 Go\r\n', 3, 'Yannick (LTC01)', '2017-07-20'),
(703, 'YMCQ031282', 1, 170, 2, 'A557-201707-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '13/01/2021', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HMJP-00000)', 3, 'Christophe Haloup', '2017-07-27'),
(704, 'YMCQ031278', 1, 170, 2, 'A557-201707-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '13/01/2021', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HMJP-00000)', 3, 'Didier Lucas', '2017-07-27'),
(705, 'YMCQ039674', 1, 170, 2, 'A557-1709', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', 'Intel Core i5 7200U @ 2.5GHz\r\n8 Go DDR4\r\n256 Go SSD\r\n', 3, 'Florian (AgentOT3)', '2017-09-10'),
(706, 'NXVBQEF008729007146600', 11, 209, 2, 'ACER-201709-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i5-6200U @ 2.30GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nNVIDIA GeForce 920M\r\n1Â 000,00 Go (WDC WD10JPVX-22JC3T0)\r\n128,00 Go (LITEON CV1-8B128)', 3, 'Martine', '2017-09-13'),
(707, 'YMEA063123', 1, 210, 1, 'ATELIER-INFO-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, '', 0, '', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2400MHz\r\nIntel HD Graphics 530\r\n500,00 Go (TOSHIBA DT01ACA050)', 1, '', '2017-09-14'),
(950, 'DTSQYEF018340009E31800', 11, 256, 1, 'CYBER-POSTE2', 23, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Intel Core i7-4770 @ 3.40GHz\r\n8Go DDR3-1600\r\n250Go SSD + 2To HDD\r\nNVIDIA GeForce GTX 760', 3, 'gamer / mjc3680 | PointCyb3680', '2013-12-13'),
(951, 'NXVBQEF0087290072D6600', 11, 209, 2, 'ACER-201709-3', 21, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '192.168.1.112', 0, '30/09/2025', 'Intel Core i5-6200U @ 2.30GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nNVIDIA GeForce 920M\r\n1Â 000,00 Go (WDC WD10JPVX-22JC3T0)\r\n128,00 Go (LITEON CV1-8B128)', 3, 'Nicolas', '2017-10-05'),
(709, 'YMEA063119', 1, 210, 1, 'ATELIER-INFO-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, '', 0, '', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2400MHz\r\nIntel HD Graphics 530\r\n500,00 Go (TOSHIBA DT01ACA050)', 1, '', '2017-09-14'),
(710, 'YMEA058283', 1, 210, 1, 'P556-201709', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 53, '', 0, '', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2400MHz\r\nIntel HD Graphics 530\r\n500,00 Go (TOSHIBA DT01ACA050)', 1, 'Educateurs MAS', '2017-09-14'),
(958, 'DTSQYEF018340009D91800', 11, 256, 1, 'CYBER-POSTE1', 23, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i7-4770 @ 3.40GHz\r\n8Go DDR3-1600\r\n250Go SSD + 2To HDD\r\nNVIDIA GeForce GTX 760', 3, 'gamer / mjc3680 | PointCyb3680', '2013-12-13'),
(813, '1S80XF002JFRP202AZDS', 4, 230, 13, 'Miix-2018-06', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2018-06-13'),
(712, 'YM3M190604', 1, 134, 2, 'PCPORT03', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n250,00 Go (WDC WDS250G2B0A-00SM50)', 1, 'Remy Ricard', '2017-09-25'),
(713, 'YM3M190603', 1, 134, 2, 'PCRI017', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n250,00 Go (WDC WDS250G2B0A-00SM50)', 1, 'Atelier', '2017-09-26'),
(714, 'YM3M190602', 1, 134, 2, 'PCRI016', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n250,00 Go (WDC WDS250G2B0A-00SM50)', 1, 'Garanties', '2017-09-26'),
(715, 'LR-8ACCF', 4, -1, 2, 'L520', -1, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i3-2350M @ 2.3GHz\r\n2x2 Go DDR3\r\nDD 500Go', 0, 'Sylvain Vizières', '2005-12-01'),
(716, 'R9-9W5R4', -1, -1, 2, 'T510i', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, 'Destruction', 'Intel Core i5-450M @ 2,4 GHz\r\n2x4Go DDR3\r\n250Go Sata', 0, 'Frédéric Wozna', '2012-10-01'),
(717, 'JHMB91TD900270', 2, 211, 2, 'NP270', 23, 0, NULL, 0, NULL, 0, NULL, 0, 6, 97, '', 0, 'HS', 'Intel Core i3-3110M @ 2.40GHz\r\n4,00 Go DDR3 @ 1333MHz\r\nIntel HD Graphics 4000\r\n500,00 Go (TOSHIBA MQ01ABD050)', 0, '', '2017-10-18'),
(718, 'JFNY98FD8A1246', 2, 213, 2, 'NP350', 23, 0, NULL, 0, NULL, 0, NULL, 0, 6, 97, '', 0, 'HS', 'Intel Core i5-3230M @ 2.60GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4000\r\n1Â 000,00 Go (TOSHIBA MQ01ABD100)', 0, 'Laetitia / mdp: vallee23', '2019-03-07'),
(719, 'YMEB013739', 1, 208, 1, 'D556-201710', 21, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, '', 0, '', 'Intel Pentium G4400 @ 3.3 GHz\r\n4Go - DDR4 - PC4-17000 2133 MHz\r\n500 Go - HDD - SATA\r\nIntel HD Graphics 530\r\n', 1, 'Bibliothèque', '2017-10-24'),
(720, 'Q1172I11235', 28, 214, 11, 'StockAIM-1-old', 19, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '192.168.0.71', 0, '19-04-23\r\n', '', 1, '', '2017-09-30'),
(723, 'YMEB044539', 1, 208, 1, 'D556-201711', 21, 0, NULL, 0, NULL, 0, NULL, 0, 9, 0, '', 0, '07/11/2025', 'Intel Core i5-6400 @ 2.70GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'NadineL', '2017-11-30'),
(725, 'YMEB047460', 1, 208, 1, 'D556-1712', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '24/06/2024', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Alexandre Demaison', '2017-12-07'),
(726, 'DS1L006193', 1, 265, 2, 'MathiasS', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '192.168.0.118', 0, '31/05/2022', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SanDisk SD8SB8U-256G-1016)', 3, 'Mathias Spilmont', '2017-12-08'),
(727, 'YMEA108947', 1, 210, 1, 'P556-201712', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2400MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Jean Jacques', '2017-12-12'),
(728, 'YMEA108936', 1, 210, 1, 'P556-1712', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '192.168.0.75', 0, '', 'Intel Core i3  6100 @ 3.7 GHz\r\n4 Go de DDR4 PC4-17000 2133 MHz\r\n256 Go SSD - SATA III \r\n', 3, 'Compta / Ges!ion', '2017-12-14'),
(729, 'YM3M195069', 1, 134, 2, 'A555-201712', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, 'Portable HS', 'Intel® Core i3-5005U @ 2.0 GHz\r\n500 Go - SATA III SMART\r\n4 Go DDR3L 1600 MHz @ PC3-12800\r\n', 1, 'Audrey / 4udr3y', '2017-12-15'),
(730, 'SC02V91GCJ1GG', 9, 216, 1, 'iMac de Marie', 8, 0, NULL, 0, NULL, 0, NULL, 0, 6, 78, '', 0, '', ' Intel Core i5 quadricœur de 7e géné. 3,5 GHz ( 4,1GHz)\r\n16 Go de mémoire DDR4 à 2 400 MHz\r\n Fusion Drive de 1 To\r\n Radeon Pro 570 avec 4 Go', 3, '?/ 1234', '2017-12-14'),
(731, 'SC02V94S2J1GG', 9, 216, 1, 'iMac de Laëtitia', 8, 0, NULL, 0, NULL, 0, NULL, 0, 6, 78, '', 0, '', ' Intel Core i5 quadricœur de 7e géné. 3,5 GHz ( 4,1GHz)\r\n16 Go de mémoire DDR4 à 2 400 MHz\r\n Fusion Drive de 1 To\r\n Radeon Pro 570 avec 4 Go', 3, '?/ 1234', '2017-12-14'),
(732, 'C02VT056HV2H', 9, 15, 2, 'MacBook d\'Hélène', 8, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, '', 'Intel Core i5 (7ème génération) 2.3 GHz (3.6 GHz)\r\n8 Go LPDDR3\r\n512 Go - soudé SSD\r\n', 1, 'Hélène / 23Creuse', '2017-12-14'),
(734, '', 30, 217, 3, 'KONICA MINOLTA C35', -1, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '172.21.19.16', 0, '', '', 0, '', '2017-12-20'),
(736, 'YMEA115067', 1, 210, 1, 'W19_004', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '172.21.19.4', 0, '', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2400MHz\r\nIntel HD Graphics 530\r\nSSD 256 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Commun (Comtoire 2)', '2017-12-19'),
(737, 'Q173I20065', 28, 203, 11, 'NAS-BIB', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', '2 x 2 To (WD20EFZX) Raid 1', 0, 'admin ', '2017-09-19'),
(738, 'YL9P245327', 1, 37, 2, 'A530', 3, 0, NULL, 0, NULL, 0, NULL, 0, 22, 0, '', 0, '', 'Intel Core i3       M 370  @ 2.40GHz\r\n4,00 Go  @ 667MHz\r\nIntel HD Graphics\r\n500,00 Go (ST950032 5AS SCSI Disk Device)', 1, '', '2018-01-09'),
(739, 'YMEB006778', 1, 208, 1, 'MARINEB', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '172.18.167.61', 0, '', 'Intel Core i7-7700 @ 3.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 630\r\n512,00 Go (Micron_1100_MTFDDAK512TBN)', 3, 'Delphine Tack', '2018-01-15'),
(740, 'YL6K010960', 1, 95, 1, 'P9900', 3, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, 'Retrait', 'Intel Core i5 650@3.20GHz\r\n4,00 Go  @ 1333MHz\r\nNVIDIA GeForce 9300 GE\r\n320,00 Go (Hitachi HDT721032SLA360)', 3, 'RETRAIT (com07/ stage)', '2012-03-11'),
(742, 'YL4Q252979', 1, 3, 1, 'QUALITE', 4, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '192.168.1.135', 0, 'Retrait', 'Intel Core 2 Duo E7500 @ 2.93GHz\r\n3,00 Go DDR2 @ 1067MHz\r\nIntel G41 Express Chipset\r\n500,00 Go (ST3500418AS ATA Device)', 1, 'RETRAIT (Prod10\\xavier)', '2012-03-11'),
(746, 'C02W1124HV2H', 9, 15, 2, 'MacBook Alexandre', 8, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, '', 'Intel Core i5 (7ème génération) 2.3 GHz (3.6 GHz)\r\n8 Go LPDDR3\r\n512 Go - soudé SSD\r\n', 1, 'Alexandre / AlexChav', '2018-01-18'),
(747, 'YLGW014021', 1, 112, 1, 'Q910', 21, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '192.168.0.98', 1, '09/04/2026', 'Intel Core i5-3470T @ 2.90GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics\r\n500,00 Go (TOSHIBA MQ01ABD050)', 1, 'AIM', '2013-02-04'),
(760, 'YMCQ054076', 1, 170, 2, 'A557-201802-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HMJP-00000)', 3, 'Franck Carry', '2018-02-04'),
(761, 'YMCQ054072', 1, 170, 2, 'A557-201802-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n1 To (WD Blue 3D N°213552806444)', 3, 'Pierre', '2018-02-04'),
(762, 'YMEB040422', 1, 208, 1, 'D556-201802', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 123, '', 0, '', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Xavier Chevron (Emb01)', '2018-02-04'),
(763, 'YMCQ054713', 1, 170, 2, 'A557-201712', 21, 0, NULL, 0, NULL, 0, NULL, 0, 18, 0, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nDisplayLink USB Device\r\n256,00 Go (SAMSUNG MZ7LN256HMJP-00000)', 3, '', '2018-02-05'),
(764, '', 15, 220, 3, 'HP Officejet Pro 8616', -1, 0, NULL, 0, NULL, 0, NULL, 0, 18, -1, '192.168.1.12', 0, '', '', 0, '', NULL),
(765, 'YLLJ005757', 1, 221, 2, 'FRANCIS-PC', 3, 0, NULL, 0, NULL, 0, NULL, 0, 18, 0, '', 0, '', 'Intel Core i3-2348M @ 2.30GHz\r\n4.00 Go  @ 1333MHz\r\nNVIDIA GeForce GT 620M\r\n500.00 Go (TOSHIBA MK5076GSX)', 3, 'Francis', '2013-05-15'),
(766, 'M6Z403464', 7, 222, 3, 'BRW28565A8B4BB2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '192.168.0.23', 0, '', '', 0, '', '2017-02-05'),
(767, 'YMER008097', 1, 223, 1, 'Desktop-0KPFCFKS', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '', 0, '', 'Intel Xeon E3-1275 v6 @ 3.80GHz\r\n16,00 Go  @ 2400MHz\r\nNVIDIA Quadro P2000\r\n256,00 Go (SAMSUNG MZVPW256HEGL-00000)\r\n2Â 000,00 Go (TOSHIBA DT01ACA200)', 3, 'GP3 (Olivier CANON)', '2018-02-06'),
(955, 'YLNC269495', 1, 126, 2, 'A512-1', 3, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Intel® Core i3 3110M / 2.4 GHz\r\n320Go SATA 300\r\n4Go DDR3 - 1600 MHz - PC3-12800', 1, 'Stock', '2014-12-21'),
(814, '20775771353', 40, 192, 13, 'SURFACE-2018-03', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', 'Intel Core m3-6Y30 @ 0.90GHz\r\n4,00 Go  @ 1867MHz\r\nIntel HD Graphics 515\r\n128,00 Go (SAMSUNG MZFLV128HCGR-000MV)\r\nGarantie 3 ans', 3, 'Utilisateur19 (Lilian Brunaud)', '2017-05-01'),
(776, 'YLNC291488', 1, 126, 2, 'A512-ATBONNAC', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '172.21.19.101', 0, '', 'Intel Pentium 2020M @ 2.40GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics\r\n500,00 Go (ATA TOSHIBA MQ01ABF0 SCSI Disk Device)\r\nEx Lifebook-A512', 3, 'Utilisateur', '2015-11-09'),
(779, 'YLNC230546', 1, 126, 2, 'A512', 3, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '172.21.19.107', 0, '', 'Intel Core i3-3110M @ 2.40GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4000\r\n500,00 Go (ATA WDC WD5000LPVX-1 SCSI Disk Device)', 3, 'Utilisateur Atelier', '2014-11-20'),
(781, 'YLTH475035', 1, 124, 1, 'P420', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 78, '', 0, '08/03/2023', 'Intel Core i3-4160 @ 3.60GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4400\r\n500,00 Go (WDC WD5000AAKX-07U6AA1)', 1, 'Secours (OTVP / kandinsky)', '2015-07-19'),
(782, 'CUR06MC04153', 33, -1, 10, 'DUN23-001 - WRT160NL', -1, 0, NULL, 0, NULL, 0, NULL, 0, 6, 78, '', 0, '', 'Modèle : WRT160NL :  Portail Hotspot\r\nSSID : WIFI_OT_PUBLIC\r\nMdP : peintres\r\n', 0, 'Fourni par 2isr', '2018-02-28'),
(783, 'E71793J7J411193', 7, 155, 3, 'HL-3150CDW', -1, 0, NULL, 0, NULL, 0, NULL, 0, 6, 97, '192.168.1.50', 0, 'remplacé', 'Nœud wifi : BRWF8DA0C47C6DC', 0, '', '2018-02-28'),
(787, '4CE7503WP9', 15, -1, 1, 'PAVPOWER580-201803', 23, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, '', 'Intel Core i5-7400 @ 3.00GHz\r\n8,00 Go  @ 2400MHz\r\nNVIDIA GeForce GTX 1050\r\n1 To (ST1000DM003-1SB102)', 1, 'Marlène Chavegrand (Utilisateur)', '2018-03-28'),
(786, 'YMGK032194', 1, 226, 1, 'P557-201803', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '17/06/2025', 'Intel Core i7-7700 @ 3.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Sabrina Chavegrand (Prod03)', '2018-03-21'),
(788, 'YMCQ061139', 1, 170, 2, 'A557-201804', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Formation', '2018-04-02'),
(789, 'YMEB079325', 1, 208, 1, 'P556-201803', 21, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, '', 0, '', 'Intel Core i3 @ 3.7 GHz\r\n4Go - DDR4 - PC4-17000 2133 MHz\r\n250 Go - SSD - SATA\r\nIntel HD Graphics 530\r\n', 3, 'DGS', '2018-03-30'),
(931, 'YL1N008173', 1, 252, 1, 'W380-10-07', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 103, '192.9.200.171', 0, '', 'Intel Core i5 660  @ 3.33GHz\r\n4,00 Go  @ 1333MHz\r\nNVIDIA Quadro FX 370\r\n500,00 Go (Hitachi HDS721050CLA362 ATA Device)', 3, 'GPAO (Pierre Marie)', '2010-12-31'),
(791, 'YMDC077880', 1, 227, 1, 'Q556', 21, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '', 0, '01/07/2025', 'Intel Core i5-6400T @ 2.20GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Marie Laure', '2018-04-04'),
(792, 'DS1G019437', 1, 0, 2, 'U747-201804', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 0, '', 0, 'Rebut', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n512,00 Go (SanDisk SD8TN8U-512G-1016)', 1, 'Thierry', '2018-04-10'),
(793, 'YM3M203734', 1, 134, 2, 'A555-201804', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n250,00 Go (WDC WDS250G2B0A-00SM50)', 1, '', '2018-04-16'),
(794, 'YMEA087677', 1, 210, 1, 'P556-201804', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Pentium G4400 @ 3.30GHz\r\n4,00 Go  @ 2400MHz\r\nIntel HD Graphics 510\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, '', '2018-04-16'),
(796, 'YM3M210963', 1, 134, 2, 'A555-1804-3', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 0, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n500,00 Go (WDC WD5000LPCX-16VHAT1)', 1, 'Utilisateur', '2018-04-26'),
(797, 'YM3M210937', 1, 134, 2, 'A555-1804-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, -1, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n500,00 Go (WDC WD5000LPCX-16VHAT1)', 1, 'Utilisateur', '2018-04-26'),
(798, 'YM3M210950', 1, 134, 2, 'A555-1804-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, -1, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n500,00 Go (WDC WD5000LPCX-16VHAT1)', 1, 'Utilisateur', '2018-04-26');
INSERT INTO `ouapi_hardware` (`id`, `num_serie`, `marque_id`, `modele_id`, `type_id`, `nom`, `os_id`, `cpu_id`, `ram_capacite`, `ram_type_id`, `disque_capacite`, `disque_type_id`, `service_pack`, `user_id`, `agence_id`, `emplacement_id`, `ip`, `reservable`, `suivi_rebus`, `commentaire`, `pfield_garantie`, `pfield_utilisateurprinc`, `creation_date`) VALUES
(799, 'YM3M210948', 1, 134, 2, 'A555-1804-4', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, -1, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n500,00 Go (WDC WD5000LPCX-16VHAT1)', 1, 'Utilisateur', '2018-04-26'),
(800, 'YMCQ066579', 1, 170, 2, 'A557-201804-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 80, '', 0, '06-09-2024', 'Intel Corei5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'CapSam1 / KV240185 (Karine)', '2018-04-26'),
(801, 'YMEB072305', 1, 208, 1, 'P556-1804-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '06-09-2024', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2018-05-02'),
(802, 'YMEB040415', 1, 208, 1, 'P556-1804-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 0, '', 0, '06-09-2024', 'Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2018-05-02'),
(803, 'HCNXCV16C05252C', -1, -1, 2, 'ASUS-201805', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-8250U @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nNVIDIA GeForce 920MX\r\n256,00 Go (HFS256G39TND-N210A)', 1, 'Stock salle info', '2018-05-03'),
(805, 'YM3M218134', 1, 134, 2, 'A555-201806', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 62, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n500,00 Go (WDC WD5000LPCX-16VHAT1)', 1, 'Guillaume', '2018-05-28'),
(806, 'DSAL003659', 1, 228, 2, 'U758-1805', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 80, '192.168.0.50', 0, '06-09-2024', 'Intel Core i5-8250U @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (Micron_1100_MTFDDAV256TBN5)', 2, 'Direction / AG081076 (Aurélie Gainant)', '2018-05-31'),
(928, 'YM5U033994', 1, 172, 1, 'W550-201709', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 103, '192.9.200.155', 0, '', 'Intel Xeon CPU E3-1240 v5 @ 3.50GHz\r\n16.00 Go  @ 2133MHz\r\nNVIDIA Quadro K1200\r\n256.00 Go (Micron_1100_MTFDDAK256TBN)\r\n500.00 Go (TOSHIBA MQ02ABF050H)', 1, 'GPAO (Hugo)', '2017-09-14'),
(808, 'YMCQ051429', 1, 170, 2, 'PCPORT07', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 89, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HMJP-00000)', 3, 'pcport07  (Fabien DRIEUX)', '2018-06-05'),
(809, 'DSAL003658', 1, 228, 2, 'U758-201806', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i5-8250U @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (Micron_1100_MTFDDAV256TBN5)', 3, 'Antoine Staut', '2018-06-24'),
(810, 'YM3M214598', 1, 134, 2, 'A555-201806', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 53, '', 0, '', 'Intel Core i3-5005U @ 2.00GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n250,00 Go (WDC WDS250G2B0A-00SM50)', 1, 'Utilisateur', '2018-06-25'),
(812, 'YMKU007513', 1, 229, 2, 'A357-201806', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 90, '', 0, 'Ordinateur réinitialisé et restitué à CCPD pour revente au personnel.\r\n17/03/2026', 'Intel Core i3-6006U @ 2.00GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Pauline (AgentOT)', '2018-06-24'),
(815, 'YMGK040463', 1, 226, 1, 'P557-201802-3', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '26/06/2024', 'Intel Core i5-7400 CPU @ 3.00GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur54 (Ligne Info Dechets)', '2018-06-28'),
(816, 'YMGK040468', 1, 226, 1, 'P557-201802-01', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-7400 CPU @ 3.00GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Stock salle info', '2018-06-28'),
(817, 'YMGK040314', 1, 226, 1, 'P557-201802-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-7400 CPU @ 3.00GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Stock salle info', '2018-06-27'),
(818, '1S80XF0019FRP201RK4Z', 4, 230, 13, 'Miix-2018-02-01', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2018-06-13'),
(819, '1S80XF0019FRP201RK5K', 4, 230, 13, 'Miix-2018-02-02', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2018-06-13'),
(820, '1S80XF0019FRP201RK7N', 4, 230, 13, 'Miix-2018-02-03', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2018-06-13'),
(821, '1S80XF0019FRP201RKB5', 4, 230, 13, 'Miix-2018-02-04', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2018-06-13'),
(822, 'SYE00R5K3', 4, 230, 13, 'Miix-2017-05-01', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '27/06/2023', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(823, 'SYE00R5HU', 4, 230, 13, 'Miix-2017-05-02', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '21/06/2023', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(824, 'SYE00R5K0', 4, 230, 13, 'Miix-2017-05-03', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '21/06/2023', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(825, 'SYE00R5K1', 4, 230, 13, 'Miix-2017-05-04', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(826, 'SYE00R5KV', 4, 230, 13, 'Miix-2017-05-05', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(827, 'SYE00R5JJ', 4, 230, 13, 'Miix-2017-05-06', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(828, 'SYE00R5JM', 4, 230, 13, 'Miix-2017-05-07', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '27/06/2023', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(829, 'SYE00R5KC', 4, 230, 13, 'Miix-2017-05-08', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '27/06/2023', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(830, 'SYE00R5JG', 4, 230, 13, 'Miix-2017-05-09', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(831, 'SYE00R5KR', 4, 230, 13, 'Miix-2017-05-10', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '21/06/2023', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(832, 'SYE00R5JN', 4, 230, 13, 'Miix-2017-05-11', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(833, 'SYE00R5JP', 4, 230, 13, 'Miix-2017-05-12', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '21/06/2023', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(834, 'SYE00R5JK', 4, 230, 13, 'Miix-2017-05-13', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(835, 'SYE00R5KG', 4, 230, 13, 'Miix-2017-05-14', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '21/06/2023', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(836, 'SYE00R5JA', 4, 230, 13, 'Miix-2017-05-15', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '21/06/2023', 'Atom x5 Z8350\r\n4Go DDR3L\r\nSSD 64Go', 1, '', '2017-05-05'),
(837, 'YMGK124581', 1, 226, 1, 'P557-201807', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '192.168.1.158', 0, '', 'Intel Core i3-7100 @ 3.90GHz\r\n4,00 Go  @ 2667MHz\r\nIntel(R) HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Benoît Massako (Prod11)', '2018-07-30'),
(838, 'YLHW004781', 1, 110, 1, 'P710-201208', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '192.168.0.128', 0, '19/01/2024', 'Intel Core i3-2120 @ 3.30GHz\r\n4,00 Go DDR3 @ 1333MHz\r\nIntel HD Graphics\r\n500,00 Go (ST500DM002-1BD142)', 1, 'Utilisateur53 (Frédéric Petit)', '2012-08-20'),
(840, 'YMGK134328', 1, 226, 1, 'P557-201808', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i5-7400 @ 3.00GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Atelier', '2018-08-28'),
(841, 'YMGK125329', 1, 226, 1, 'P557-201809', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 63, '', 0, '', 'Intel Core i3-7100 @ 3.90GHz\r\n4,00 Go  @ 2667MHz\r\nIntel HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Maitres Nageurs', '2018-09-04'),
(842, 'YMDL003838', 1, 231, 5, 'S18_002', 24, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '172.21.18.2', 0, '', ' Intel Xeon E3-1220v6 (4C/4T @ 3GHz)\r\n32Go DDR4 ECC @ 2400MHz\r\n2 x SSD 480 Go Sata 2,5\" RAID1\r\n2 x DD 1To Sata 2,5\" - RAID1', 5, 'Administrateur / Maridat-23', '2018-04-27'),
(843, 'YM6D014802', 1, 232, 5, 'RX2540', 25, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.210', 0, '', 'Serveur VMWARE principal\r\n2 Intel Xeon Silver 4110 / 2.1 GHz (2.4 GHz) (8 cœurs)\r\n64Go DDR4 ECC', 5, 'root', '2018-08-31'),
(844, 'Q177I04325', 28, 135, 11, 'StockAIM-2', 43, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '10.12.71.73', 0, '', '3x2To Raid 5 (WD2002FFSX)\r\n2x256Go Raid1 SSD M2 NVMe\r\n(WDS256G1X0C)\r\nIntel Apollo Lake J3455 (quadricœur)\r\n8 Go DDR3L', 1, '', '2018-08-31'),
(846, 'Q191B20908', 28, 286, 11, 'NAS-DATA', 43, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.205', 0, '', '4x4To Raid 5 (WD40EFRX) (10.89 To)\r\nIntel Apollo Lake J3455 (quadricœur)\r\n8 Go DDR3L', 1, 'admin', '2018-08-31'),
(847, 'YMGK134506', 1, 226, 1, 'P557-201810', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 92, '', 0, '', 'Intel Core i5-7400 @ 3.00GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Patricia Galliot (Prod05)', '2018-10-17'),
(848, '5CG8275WPX', 15, 233, 2, 'HP470G5-201810', 23, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i3-7020U @ 2.30GHz\r\n4,00 Go  @ 2400MHz\r\nIntel HD Graphics 620\r\n250,00 Go (WDC WDS250G2B0A-00SM50)', 1, 'Formation', '2018-10-28'),
(849, 'YMLE023499', 1, 234, 1, 'D558-201811', 21, 0, NULL, 0, NULL, 0, NULL, 0, 29, 93, '', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Maéva ?', '2018-11-20'),
(850, 'YMKU018745', 1, 229, 2, 'PCRI017', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Maxime', '2018-11-21'),
(851, 'YMGK134413', 1, 226, 1, 'P557-201811', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 92, '', 0, '', 'Intel Core i5-7400 @ 3.00GHz\r\n8,00 Go  @ 2400MHz\r\nIntel HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Labo (Prod05)', '2018-11-27'),
(852, 'YMKV025667', 1, 229, 2, 'A357-201811', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '192.168.0.149', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Christelle Dubreuil (<-Archi)', '2018-11-26'),
(853, 'YMLE026150', 1, 234, 1, 'P558-201812', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Nadia Chavegrand (COM05)', '2018-12-04'),
(854, 'DSAF012633', 1, 235, 2, 'E458-201812', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '03/06/2023', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SanDisk SD8SN8U-256G-1016)', 3, 'Eric Marchand (COM06)', '2018-12-10'),
(855, 'DSAF012627', 1, 235, 2, 'E458-201812', 21, 0, NULL, 0, NULL, 0, NULL, 0, 38, -1, '', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SanDisk SD8SN8U-256G-1016)', 3, 'ADantzer / ADludine23$', '2018-12-18'),
(856, 'DSAF012632', 1, 235, 2, 'E458-201812', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SanDisk SD8SN8U-256G-1016)', 3, 'Arnaud Maridat (perso)', '2018-12-10'),
(857, 'YMKU008820', 1, 229, 2, 'A357-201810', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 25, '', 0, '', 'Intel Core i3 6006U / 2 GHz\r\n4,00 Go DDR4\r\nIntel HD Graphics 520\r\n256 Go SSD', 1, 'Utilisateur', '2018-12-17'),
(899, '008541371053', 40, 192, 13, 'SPANC1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '192.168.0.60', 0, '', 'Intel Core m3-6Y30 CPU @ 0.90GHz\r\n4.00 Go  @ 1867MHz\r\nIntel HD Graphics 515\r\n128.00 Go (SAMSUNG MZFLV128HCGR-000MV)', 3, 'utilisateur4 (Alexandre - Carlos Afonso)', '2017-05-01'),
(901, 'YL4Q345522', 1, 3, 1, 'MAIRE-SE', 21, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, '', 0, 'retrait', 'Intel Core2 Duo CPU     E7500  @ 2.93GHz\r\n4.00 Go DDR2 @ 1067MHz\r\nIntel G41 Express Chipset (Microsoft Corporation - WDDM 1.1)\r\n500.00 Go (Hitachi HDS721050CLA362 ATA Device)', 1, 'Accueil', '2019-03-22'),
(860, 'YMLK013817', 1, 236, 1, 'D538-201901', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 103, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'GP1 (Mathilde)', '2019-01-13'),
(883, 'YMKU033210', 1, 229, 2, 'A357-201903', 23, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Direction ecole', '2019-03-08'),
(862, 'YMKU025575', 1, 229, 2, 'PCGO002', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 91, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'pcgo002 (Emmanuel Niveau)', '2019-01-15'),
(863, 'YMKU010470', 1, 229, 2, 'A357-201901', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (TOSHIBA MQ01ABF050)', 3, 'Marine / M@r1n304! (Audrey / 4udr3y)', '2019-01-15'),
(864, 'G6AY84900XXS', 47, 237, 1, 'NUC-201901-A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '30/12/2025', 'Intel Celeron J3455 @ 1.50GHz\r\n10,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics\r\n120,00 Go (PNY CS900 120GB SSD)\r\n31,00 Go (SanDisk DF4032)', 3, 'stock', '2019-01-17'),
(865, 'G6AY84800G23', 47, 237, 1, 'NUC-201901-B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, '', 'Intel Celeron J3455 @ 1.50GHz\r\n10,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics\r\n120,00 Go (PNY CS900 120GB SSD)\r\n31,00 Go (SanDisk DF4032)', 3, 'Billetterie', '2019-01-17'),
(866, 'DSAF012946', 1, 235, 2, 'SylvainV-1901', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SanDisk SD8SN8U-256G-1016)', 3, 'Poste secours', '2019-01-20'),
(867, 'DSAF012952', 1, 235, 2, 'LoraineC-1901', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SanDisk SD8SN8U-256G-1016)', 3, 'Loraine Copley', '2019-01-22'),
(877, 'Q132B05063', 28, 115, 11, 'OUAPI', 43, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '10.12.71.72', 0, '', '', 1, '', '2014-04-30'),
(878, 'YMMW003456', 1, 238, 2, 'H780-201902', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '', 0, '', 'Intel Core i7-8750H CPU @ 2.20GHz\r\n32,00 Go  @ 2400MHz\r\nNVIDIA Quadro P2000\r\n512,00 Go (SAMSUNG MZVLB512HAJQ-00000)', 3, 'Mickael', '2019-02-26'),
(869, 'YMDC166601', 1, 227, 1, 'Q556-1901B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '24/06/2024', 'Intel Core i5-6400T CPU @ 2.20GHz\r\n8,00 Go  @ 2667MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Fanny PERGAUD', '2019-01-22'),
(870, 'YMDC166595', 1, 227, 1, 'Q556-1901A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '24/06/2024', 'Intel Core i5-6400T CPU @ 2.20GHz\r\n8,00 Go  @ 2667MHz\r\nIntel HD Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Christiane Cuvillier', '2019-01-22'),
(871, 'YMKV036645', 1, 229, 2, 'A357-201901', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Formation', '2019-01-23'),
(872, 'DSAF012932', 1, 235, 2, 'JulienM-1901', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SanDisk SD8SN8U-256G-1016)', 3, 'Rémi PERRONE', '2019-01-21'),
(879, 'YMKU035522', 1, 229, 2, 'A357-201903', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '08/04/2026', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Marlène (Com04)', '2019-03-03'),
(880, 'YMKU014500', 1, 229, 2, 'A357-201902-A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 91, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n250,00 Go (Micron_1100_MTFDDAK256TBN)', 3, '', '2019-03-04'),
(881, 'YMKU014501', 1, 229, 2, 'A357-201902-B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 91, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n250,00 Go (Micron_1100_MTFDDAK256TBN)', 3, '', '2019-03-04'),
(884, 'YM4P037395', 1, 208, 1, 'PC-COMMUN', 21, 0, NULL, 0, NULL, 0, NULL, 0, 7, 99, '', 0, '', 'Intel Core i5-6400 CPU @ 2.70GHz\r\n4.00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500.00 Go (TOSHIBA DT01ACA050 SCSI Disk Device)', 3, 'Gloria', '2016-08-31'),
(896, '4L1166560067F', 26, 243, 6, 'GS116Ev2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 7, 99, '192.168.1.239', 0, '', '<vide>/password', 0, '', '2017-01-24'),
(885, '', 48, 239, 4, 'SC60F18D', -1, 0, NULL, 0, NULL, 0, NULL, 0, 7, 99, '192.168.1.207', 0, '', '', 0, 'admin', NULL),
(886, 'Q161I06121', 28, 240, 11, 'NAS-PLASTI23', -1, 0, NULL, 0, NULL, 0, NULL, 0, 7, 99, '192.168.1.199', 0, '', 'Capacité : 2 x 4To RAID1\r\nCPU : Intel Celeron N3150 1.60GHz (4 cœurs)\r\nMémoire totale : 4 Go\r\nDisque 1 : WD40EFRX-68N32N0 (Numéro de série : WD-WCC7K2SFZD0U)\r\nDisque 2 : WD40EFRX-68N32N0 (Numéro de série : WD-WCC7K3PD45A6)', 1, 'Superviseur', '2016-04-14'),
(887, '', 49, 241, 3, 'RNPB35F1F', -1, 0, NULL, 0, NULL, 0, NULL, 0, 7, 65, 'http://192.168.1.210', 0, '', '', 0, 'admin/<vide>', NULL),
(892, 'YL3M040877', 1, 11, 1, 'PC-ATELIER', 4, 0, NULL, 0, NULL, 0, NULL, 0, 7, 65, '', 0, 'Rebut', 'Intel Core2 Duo CPU     E7500  @ 2.93GHz\r\n2.00 Go DDR2 @ 800MHz\r\nNVIDIA GeForce 7100 / NVIDIA nForce 630i\r\n500.00 Go (WDC WD5000AAKX-08U6AA0 ATA Device)', 3, 'Atelier', '2010-03-02'),
(890, 'YLTQ046957', 1, 242, 5, 'PLASTI23SERVEUR', 35, 0, NULL, 0, NULL, 0, NULL, 0, 7, 99, '192.168.1.2', 0, '15/09/2025', 'Intel Xeon CPU E3-1226 v3 @ 3.30GHz\r\n8.00 Go  @ 1600MHz\r\nIntel HD Graphics P4600/P4700\r\n999.00 Go (LSI MegaSR   SCSI Disk Device)', 3, 'Administrateur', '2016-09-28'),
(891, 'YMCQ012047', 1, 170, 2, 'pc-portable', 21, 0, NULL, 0, NULL, 0, NULL, 0, 7, 65, '', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n4.00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n500.00 Go (TOSHIBA MQ01ABF050)', 3, 'Plasti23', '2017-01-21'),
(893, 'YM4P114834', 1, 208, 1, 'PC-DAVID', 21, 0, NULL, 0, NULL, 0, NULL, 0, 7, 65, '', 0, '19/04/2024', 'Intel Core i5-6400 CPU @ 2.70GHz\r\n4.00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500.00 Go (TOSHIBA DT01ACA050)', 3, 'Utilisateur', '2017-01-22'),
(894, 'YLTH376349', 1, 124, 1, 'PC-SECRETARIAT', 3, 0, NULL, 0, NULL, 0, NULL, 0, 7, 65, '', 0, '14/10/2025', 'Intel Core i5-4440 CPU @ 3.10GHz\r\n4.00 Go  @ 1600MHz\r\nIntel HD Graphics 4600\r\n500.00 Go (ST500DM0 02-1BD142 SCSI Disk Device)', 3, '', '2014-12-16'),
(895, 'YM4P004764', 1, 208, 1, 'PC-QUALITE', 21, 0, NULL, 0, NULL, 0, NULL, 0, 7, 65, '', 0, '', 'Intel Core i5-6400 CPU @ 2.70GHz\r\n4.00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500.00 Go (ST500DM0 02-1BD142 SCSI Disk Device)', 3, 'Utilisateur', '2016-03-22'),
(903, '2CE4120X7B', 15, -1, 2, 'PO-ALSH-GB', 21, 0, NULL, 0, NULL, 0, NULL, 0, 29, 112, '192.168.1.16', 0, '', 'Intel Core i3-4000M CPU @ 2.40GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4600\r\n250,00 Go (WDC WDS250G2B0A-00SM50)', 1, 'ALSH', '2019-03-26'),
(904, '', 2, 128, 14, 'GalaxiTab A', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '', 0, 'Sophie (Com02)', '2019-03-28'),
(905, 'D2N0BC029977056', -1, -1, 2, 'MARC-PC', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 123, '', 0, '', 'Intel Core i5-3230M CPU @ 2.60GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4000\r\n750,00 Go (WDC WD7500BPKT-80PK4 SCSI Disk Device)', 2, 'Filets', '2019-03-28'),
(906, '5CG8041L1V', 15, 225, 2, 'HP-XAVIER', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZVLW256HEHP-000H1)', 3, 'Xavier Courboin (Prod10)', '2019-03-28'),
(908, 'YM3P009800', 1, 133, 2, 'AGRI23-PORT1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 62, '10.128.37.201', 0, '', 'Intel Core i3-4005U CPU @ 1.70GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics Family\r\n250,00 Go (WDC WDS250G2B0A)', 3, 'pcso002', '2014-12-11'),
(909, 'YLTH316474', 1, 124, 1, 'AGRI23-ACCUEIL', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 62, '10.128.37.101', 0, '', 'Intel Core i3-4160 CPU @ 3.60GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4400\r\n500,00 Go (WDC WD5000AAKX-07U6A SCSI Disk Device)', 1, 'pcso001', '2014-12-11'),
(929, 'YL1N004823', 1, 252, 1, 'W380-10-04', 3, 0, NULL, 0, NULL, 0, NULL, 0, 16, 103, '192.9.200.164', 0, 'Rebut', 'Intel Core i5 660  @ 3.33GHz\r\n8,00 Go  @ 1333MHz\r\nNVIDIA Quadro FX 1800\r\n500,00 Go (Hitachi HDT721050SLA360)', 3, 'gpao (Patrick Thomas)', '2011-01-01'),
(911, 'YMKV016947', 1, 229, 2, 'A357-201808', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 91, '10.128.36.159', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'Utilisateur (Salome Dhulster)', '2018-08-27'),
(923, '8X903M1', 13, -1, 2, 'DELL', 3, 0, NULL, 0, NULL, 0, NULL, 0, 14, 102, '10.128.35.97', 0, '', 'Intel Core2 Duo CPU     P8800  @ 2.66GHz\r\n4,00 Go DDR2 @ 800MHz\r\nMobile Intel 4 Series Express Chipset Family\r\n0 octects (Ricoh SD/MMC Disk Device)\r\n250,00 Go (WDC WD2500BJKT-75F4T SCSI Disk Device)', 1, 'utilisateur (RAMIREZ Nathan)', '2019-04-15'),
(913, 'YLTH679635', 1, 124, 1, 'PCDO001', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 89, '10.128.33.220', 0, '', 'Intel Core i3-4170 CPU @ 3.70GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4400\r\n500,00 Go (WDC WD5000AAKX-07U6AA1)', 1, 'pcdo001 (RESTOUEIX Loic)', '2019-04-15'),
(914, '4PT995J', 13, 246, 1, 'PCGO001', 4, 0, NULL, 0, NULL, 0, NULL, 0, 14, 91, '10.128.36.158', 0, '', 'Intel Pentium G850 @ 2.90GHz\r\n3,00 Go  @ 1333MHz\r\nIntel HD Graphics Family\r\n250,00 Go (ST3250312AS ATA Device)', 1, 'pcgo001 (LISSANDRE François)', '2019-04-15'),
(922, '', 13, 136, 1, 'pcri002', 1, 0, NULL, 0, NULL, 0, NULL, 0, 14, 102, '', 0, '', 'AMD Athlon X2 4200+\r\n1,5 Go', 0, 'VIGIER Kévin', '2019-04-15'),
(921, 'C5Z9MX1', 13, 143, 2, 'pcport05', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 101, '10.128.34.214', 0, '', 'Intel Core i3-3120M\r\n4 Go\r\nHDD 500 Go', 1, 'pcport05 (AGEORGES Pascal)', '2019-04-15'),
(916, 'FB6F84J', 13, 248, 1, 'PC-DE-PCJA101', 16, 0, NULL, 0, NULL, 0, NULL, 0, 14, 89, '10.128.33.217', 0, '', 'Pentium Dual-Core  CPU      E5200  @ 2.50GHz\r\n2,00 Go DDR2 @ 800MHz\r\nIntel G33/G31 Express Chipset Family\r\n160,00 Go (WDC WD1600AAJS-75M0A0 ATA Device)', 1, 'Utilisateur (THEVENOT Sebastien)', '2019-04-15'),
(917, 'G7XT4S1', 13, 250, 2, 'PCPORT04', 3, 0, NULL, 0, NULL, 0, NULL, 0, 14, 91, '10.128.36.151', 0, '', 'Intel Core i3-2330M CPU @ 2.20GHz\r\n4,00 Go  @ 1333MHz\r\nIntel HD Graphics Family\r\n250,00 Go (Hitachi HTS723225A7A364)', 1, 'pcport04 (Florian Maingoutaud)', '2019-04-15'),
(918, 'LRBZGWH', 4, 249, 2, 'PCDO003', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 89, '10.128.33.215', 0, '', 'Intel Core i5 CPU       M 450  @ 2.40GHz\r\n2,00 Go DDR3 @ 667MHz\r\nIntel HD Graphics\r\n320,00 Go (ST9320325AS)', 1, 'pcdo003 (ALBERT Jordan)', '2019-04-15'),
(919, 'YMCQ051432', 1, 170, 2, 'PCPORT02', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 89, '10.128.33.213', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HMJP-00000)', 3, 'pcport02 (ALBERT Cedric)', '2018-06-01'),
(924, 'YM4P037284', 1, 208, 1, 'PCJA002', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 102, '10.128.35.96', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500,00 Go (TOSHIBA DT01ACA050)', 1, 'pcja002 (LANNAUD Thomas)', '2019-04-15'),
(925, 'YMGK141720', 1, 226, 1, 'P557-201810', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 102, '10.128.35.92', 0, '', 'Intel Core i3-7100 CPU @ 3.90GHz\r\n4,00 Go  @ 2667MHz\r\nIntel HD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 1, 'PCJA001 (CHOPLIN Baptiste)', '2019-04-15'),
(926, 'YLCM112536', 1, 102, 1, 'PCRI301', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 101, '10.128.34.212', 0, '', 'Intel Core i3-2120 CPU @ 3.30GHz\r\n4,00 Go DDR3 @ 1333MHz\r\nIntel HD Graphics\r\n500,00 Go (WDC WD5000AAKX-001CA0)', 1, 'pcri301 (MERCIER Anthony)', '2019-04-15'),
(927, 'YMHQ001562', 1, 251, 1, 'W580-201904', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 103, '192.9.200.163', 0, '', 'Intel Core i7-8700 CPU @ 3.20GHz\r\n32,00 Go  @ 2667MHz\r\nNVIDIA Quadro P2000\r\n1Â 000,00 Go (TOSHIBA HDWD110)\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'GPAO (Jerome COURTY)', '2019-04-14'),
(930, 'YLNF053232', 1, 253, 1, 'W530-15-04', 18, 0, NULL, 0, NULL, 0, NULL, 0, 16, 103, '192.9.200.185', 0, '', 'Intel Core i7-4790 @ 3.60GHz\r\n8.00 Go  @ 1600MHz\r\nNVIDIA Quadro K620\r\n240.00 Go (KINGSTON SV300S37A240G)\r\n1Â 000.00 Go (WDC WD10EZEX-07M2NA1)', 1, 'GPAO', '2015-04-21'),
(932, 'YLNF088350', 1, 253, 1, 'W530-16-02-C', 3, 0, NULL, 0, NULL, 0, NULL, 0, 16, 103, '192.9.200.178', 0, '', 'Intel Xeon E3-1271 v3 @ 3.60GHz\r\n16.00 Go  @ 1600MHz\r\nNVIDIA Quadro K2200\r\n128.00 Go (Micron_M 600_MTFDDAK128MB SCSI Disk Device)\r\n1Â 000.00 Go (WDC WD10EZEX-07M2NA1 SCSI Disk Device)', 3, 'BE (Fabrice JOYEUX)', '2016-02-09'),
(933, 'YLTH685699', 1, 124, 1, 'P420-16-02-B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '192.168.174.1', 0, '', 'Intel Core i5-4460  @ 3.20GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6AA1)', 1, 'GPAO (Julien)', '2016-02-09'),
(944, 'YL8E033564', 1, 3, 1, 'P2560', 1, 0, NULL, 0, NULL, 0, NULL, 0, 16, 105, '', 0, '01/02/2023', 'Intel Core i3 550 3.2 GHz\r\n2 Go de DDRIII PC3-8500 1066 MHz\r\n500 Go - SATA II 300Gb\r\nIntel GMA 4500 HD', 3, 'BE', '2011-03-14'),
(935, 'YKSN007412', 1, 254, 1, 'W370-BE', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '192.9.200.157', 0, '', 'Intel Core2 Duo E8500  @ 3.16GHz\r\n5,00 Go DDR2 @ 667MHz\r\nNVIDIA Quadro FX 580\r\n320,00 Go (ATA Hitachi HDT72103 SCSI Disk Device)\r\n250,00 Go (ATA WDC WDS250G2B0A- SCSI Disk Device)', 3, 'BE (Philippe BORE)', '2010-12-31'),
(936, 'YLNF060429', 1, 253, 1, 'W530-06-14', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '192.9.200.179', 0, '', 'Intel Xeon E3-1271 v3 @ 3.60GHz\r\n16,00 Go  @ 1600MHz\r\nNVIDIA Quadro K2200\r\n128,00 Go (Micron_M 600_MTFDDAK128MB SCSI Disk Device)\r\n1Â 000,00 Go (WDC WD10EZEX-07M2NA1 SCSI Disk Device)', 1, 'BE (Alexandre)', '2015-06-28'),
(937, 'YLTH349533', 1, 124, 1, 'P420-BE', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '192.9.200.153', 0, '', 'Intel Core i5-4440 @ 3.10GHz\r\n4,00 Go  @ 1600MHz\r\nNVIDIA Quadro K420\r\n500,00 Go (WDC WD5000AAKX-07U6A SCSI Disk Device)', 1, 'GPAO (Secours)', '2014-12-03'),
(938, 'YLNF089318', 1, 253, 1, 'W530-16-02-B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '192.9.200.194', 0, '', 'Intel Xeon E3-1271 v3 @ 3.60GHz\r\n16,00 Go DDR3 @ 1600MHz\r\nNVIDIA Quadro K2200\r\n1Â 000,00 Go (WDC WD10EZEX-07M2NA1 SCSI Disk Device)\r\n128,00 Go (Micron_M 600_MTFDDAK128MB SCSI Disk Device)', 1, 'BE (Sebastien NEDAUD)', '2016-02-10'),
(939, 'YLTH685676', 1, 124, 1, 'P420-16-02-A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '192.168.80.1', 0, '', 'Intel Core i5-4460  @ 3.20GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000AAKX-07U6AA1)', 1, 'GPAO (Christophe)', '2016-02-09'),
(940, 'YLNF088341', 1, 253, 1, 'W530-16-02-A', 3, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '192.9.200.159', 0, '', 'Intel Xeon E3-1271 v3 @ 3.60GHz\r\n16,00 Go  @ 1600MHz\r\nNVIDIA Quadro K2200\r\n128,00 Go (Micron_M 600_MTFDDAK128MB SCSI Disk Device)\r\n1Â 000,00 Go (WDC WD10EZEX-07M2NA1 SCSI Disk Device)', 3, 'BE', '2016-02-09'),
(941, 'YLNF065172', 1, 253, 1, 'W530-CAO7', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '192.9.200.195', 0, '', 'Intel Xeon E3-1271 v3 @ 3.60GHz\r\n16,00 Go DDR3 @ 1600MHz\r\nNVIDIA Quadro K2200\r\n1Â 000,00 Go (WDC WD10EZEX-07M2NA1 SCSI Disk Device)\r\n128,00 Go (Micron_M 600_MTFDDAK128MB SCSI Disk Device)', 3, 'BE (Benjamin)', '2015-10-14'),
(943, 'YLNF039111', 1, 253, 1, 'Desktop-30PVRA5', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 105, '', 0, '', 'Intel Xeon E3-1246v3 / 3.5 GHz\r\n16 Go DDR3 SDRAM - ECC - 1600 MHz\r\nNVIDIA Quadro K2000  2 Go GDDR5 \r\nDisque Dur SSD 2,5\" 240Go\r\n1 To - SATA 6Gb/s ', 3, 'BE (Atelier)', '2014-10-15'),
(945, 'YLTH093403', 1, 124, 1, 'ACCUEIL-P420', 3, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '192.168.1.99', 0, '30/09/2025', 'Intel Core i5-4430 @ 3.00GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (ST500DM0 02-1BD142 SCSI Disk Device)', 3, 'Jean-MichelJ', '2014-03-26'),
(946, 'YLNC146223', 1, 126, 2, 'A512-FAMILLE', 3, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '192.168.10.65', 0, '30/09/2025', 'Intel Core i3-3110M @ 2.40GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4000\r\n320,00 Go (WDC WD3200LPVX-16V0TT0)', 1, 'Stock', '2014-06-10'),
(957, 'YMKU010752', 1, 229, 2, 'a357', 21, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i3 6006U / 2 GHz\r\n8 Go DDR4\r\n256 Go - 2.5\"SSD', 1, 'Portable Nadine', '2018-07-30'),
(948, 'JHMB91TD900160', 2, 255, 2, 'SAMSUNG_2014_2', 23, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '192.168.1.105', 0, '30/09/2025', 'Intel Core i3-3110M @ 2.40GHz\r\n4,00 Go DDR3 @ 1333MHz\r\nIntel HD Graphics 4000\r\n500,00 Go (TOSHIBA MQ01ABD050)', 1, 'Utilisateur (Carole Ladrat)', '2014-01-17'),
(949, 'NXVBQEF008729007256600', 11, 209, 2, 'ACER-201709-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '192.168.1.109', 0, '30/09/2025', 'Intel Core i5-6200U @ 2.30GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nNVIDIA GeForce 920M\r\n1 To (WDC WD10JPVX-22JC3T0)\r\n128,00 Go (LITEON CV1-8B128)', 3, 'MarieDominiqueB', '2017-07-29'),
(952, 'YLLH013382', 1, 221, 2, 'N532', 3, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Intel Core i5 3230M\r\n500Go SATA 150\r\n 4 Go DDR3', 3, 'Sandrine Lacourarie', '2013-09-27'),
(953, 'JHMB91TD900106', 2, 255, 2, 'SAMSUNG_2014_1', 23, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '192.168.1.105', 0, '30/09/2025', 'Intel Core i3-3110M @ 2.40GHz\r\n4,00 Go DDR3 @ 1333MHz\r\nIntel HD Graphics 4000\r\n500,00 Go (TOSHIBA MQ01ABD050)', 1, 'Utilisateur ', '2014-01-17'),
(954, 'JFNY98FD8A11MX', 2, 213, 2, 'NP350', 3, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Intel® Core i5 3230M 2.6GHz\r\n1 To SATA 300\r\n4Go DDR3-1600/PC3-12800\r\n17.3\" HD+', 1, '', '2014-01-17'),
(956, 'YM4B004345', 1, 231, 5, 'MJCSERVER', 24, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '192.168.1.50', 0, '', 'Intel Xeon E3-1220 v5 @ 3.00GHz\r\n16,00 Go  @ 2133MHz\r\nMatrox G200e (Emulex) WDDM 2.0\r\n959,00 Go (FTS PRAID CP400i SCSI Disk Device)', 3, 'Adminnet', '2019-04-19'),
(959, 'DTSQYEF018340009D51800', 11, 256, 1, 'PREADATOR-1312B', 22, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '07/11/2025', 'Intel Core i7-4770 @ 3.40GHz\r\n8Go DDR3-1600\r\n250Go SSD + 2To HDD\r\nNVIDIA GeForce GTX 760', 3, 'Accueil', '2013-12-12'),
(960, 'DTSQYEF018340009D31800', 11, 256, 1, 'CYBER-POSTE4', 23, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Intel Core i7-4770 @ 3.40GHz\r\n8Go DDR3-1600\r\n250Go SSD + 2To HDD\r\nNVIDIA GeForce GTX 760', 3, 'gamer / mjc3680 | PointCyb3680', '2013-12-13'),
(961, 'DTSQYEG29050700BDE1800', 11, 256, 1, 'PREDATOR-1312A', 23, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '07/11/2025', 'Intel Core i7-4770 @ 3.40GHz\r\n8Go DDR3-1600\r\n250Go SSD + 2To HDD\r\nNVIDIA GeForce GTX 760', 3, 'Compta (Christelle)', '2013-12-12'),
(962, 'DTSQYEF018340009E11800', 11, 256, 1, 'CYBER-POSTE6', 23, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Intel Core i7-4770 @ 3.40GHz\r\n8Go DDR3-1600\r\n250Go SSD + 2To HDD\r\nNVIDIA GeForce GTX 760', 3, 'gamer / mjc3680 | PointCyb3680', '2013-12-13'),
(963, 'YMKU036892', 1, 229, 2, 'A357-201904-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '192.168.0.113', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-04-23'),
(964, 'YMKU036886', 1, 229, 2, 'A357-201904-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '192.168.0.113', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-04-23'),
(965, 'YMKU036889', 1, 229, 2, 'A357-201904-3', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '', 0, 'Accident', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Eleve', '2019-04-24'),
(966, 'YMKU036888', 1, 229, 2, 'A357-201904-4', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '192.168.0.122', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Eleve', '2019-04-24'),
(967, 'YMKU036890', 1, 229, 2, 'A357-201904-5', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '192.168.0.125', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-04-24'),
(968, 'YMKU036887', 1, 229, 2, 'A357-201904-6', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '192.168.0.138', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-04-24'),
(970, 'YMKU036881', 1, 229, 2, 'A357-201904-7', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '192.168.0.146', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-04-24'),
(971, 'YMKU036882', 1, 229, 2, 'A357-201904-8', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '192.168.0.142', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-04-24'),
(972, 'YMKU036875', 1, 229, 2, 'A357-201904-9', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-04-24'),
(973, 'YMKU036879', 1, 229, 2, 'A357-201904-10', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '192.168.0.118', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-04-24'),
(974, 'YMKU036885', 1, 229, 2, 'A357-201904-11', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '192.168.0.148', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-04-24'),
(975, 'YMKU036876', 1, 229, 2, 'A357-201904-12', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, 106, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n500,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Eleve', '2019-04-24'),
(976, 'YMLK018305', 1, 236, 1, 'D538-201904', 21, 0, NULL, 0, NULL, 0, NULL, 0, 19, 0, '', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n4,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n500,00 Go (WDC WD5000AZLX-07K2TA0)\r\n480,00 Go (WDC WDS480G2G0A-00JH30)', 3, 'Utilisateur', '2019-04-25'),
(977, 'YMLK028669', 1, 236, 1, 'D538-201904', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur53 (Frederic Petit) Chalet', '2019-04-24'),
(978, '038725391253', 40, 244, 13, 'SURFACE-201904', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '16/10/2025', 'Intel Core m3-7Y30 CPU @ 1.00GHz\r\n4,00 Go  @ 1867MHz\r\nIntel HD Graphics 615\r\n128,00 Go (INTEL SSDPEBKF128G7)', 3, 'Utilisateur30 / cp1008 (Coralie Philippon)', '2019-04-25'),
(1000, '', 42, -1, 4, 'RICOH IM C3500', -1, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '192.168.0.200', 0, '', 'RNP583879206CE1', 0, 'admin / Rex-Rot@ry', '2019-06-26'),
(1001, '', 42, -1, 4, 'RICOH IM 300', -1, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '192.168.0.201', 0, '16/10/2025', '', 0, 'admin / Rex-Rot@ry', '2019-06-26'),
(980, 'YMCQ042570', 1, 170, 2, 'DESKTOP-V5EUNKK', 21, 0, NULL, 0, NULL, 0, NULL, 0, 38, -1, '192.168.1.9', 0, 'rebus le 01/02/2024', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n250,00 Go (WDC WDS250G2B0A-00SM50)', 1, 'Marketing', '2019-04-29'),
(981, 'YMKV042375', 1, 229, 2, 'A357-201904', 23, 0, NULL, 0, NULL, 0, NULL, 0, 38, -1, '192.168.1.73', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nDisplayLink USB Device\r\n500,00 Go (Samsung SSD 860 QVO 1TB)', 3, 'Utilisateur', '2019-04-29'),
(982, 'YMLK018305', 1, 236, 1, 'D538-201904', 21, 0, NULL, 0, NULL, 0, NULL, 0, 19, 0, '192.168.1.10', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n4,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n500,00 Go (WDC WD5000AZLX-07K2TA0)\r\n480,00 Go (WDC WDS480G2G0A-00JH30)', 3, 'Utilisateur / assat', '2019-04-30'),
(983, 'PTNCJE2072049029049600', 11, 0, 1, 'ASSAT-PC', 5, 0, NULL, 0, NULL, 0, NULL, 0, 19, 0, '', 0, '', 'Pentium Dual-Core  CPU      E5700  @ 3.00GHz\r\n3,00 Go DDR2 @ 800MHz\r\nIntel G33/G31 Express Chipset Family\r\n1Â 000,00 Go (WDC WD10EZEX-00BN5A0 ATA Device)', 1, 'ASSAT / assat', '2019-04-30'),
(984, 'B9N0AS26735037C', 46, 0, 2, 'ASSAT', 21, 0, NULL, 0, NULL, 0, NULL, 0, 19, 0, '', 0, '', 'Intel Core i3-2330M CPU @ 2.20GHz\r\n4,00 Go DDR3 @ 1333MHz\r\nIntel HD Graphics 3000\r\n320,00 Go (WDC WD3200BPVT-80ZEST0)', 1, 'assatcommunication', '2019-04-30'),
(985, '5CD725G0SK', 15, 257, 2, 'PB470G3-201709', 21, 0, NULL, 0, NULL, 0, NULL, 0, 19, 0, '', 0, '', 'Intel Core i3-6100U CPU @ 2.30GHz\r\n4,00 Go  @ 2133MHz\r\nAMD Radeon R7 M340\r\n500,00 Go (WDC WD5000LPLX-60ZNTT1)', 1, 'Utilisateur', '2019-04-30'),
(986, '5CD5516NPG', 15, 257, 2, 'ASSAT-HP', 23, 0, NULL, 0, NULL, 0, NULL, 0, 19, 0, '', 0, '', 'Intel Core i3-6100U CPU @ 2.30GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 520\r\n1Â 000,00 Go (HGST HTS541010A9E680)', 1, 'ASSAT', '2019-04-30'),
(988, 'YMKU037690', 1, 229, 2, 'A357-201905', 23, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-6006U @ 2.00GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Utilisateur', '2019-05-16'),
(989, 'YMHP002229', 1, 258, 1, 'W580-201905', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '192.168.0.119', 0, '', 'Intel Core i5-8500 @ 3.00GHz\r\n8,00 Go  @ 2667MHz\r\nNVIDIA Quadro P620\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Stock salle info', '2019-05-08'),
(990, 'YM3P055951', 1, 133, 2, 'A514-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '192.168.0.30', 0, '06-09-2024', 'Intel Core i3-4005U CPU @ 1.70GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics Family\r\n500,00 Go (TOSHIBA MQ01ABF050)', 3, 'Cap2 / CG100677 (Carole)', '2015-12-10'),
(991, 'YMCQ066580', 1, 170, 2, 'A557-201804-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '192.168.0.33', 0, '06-09-2024', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, 'Cap1 / VV270770 (Valérie)', '2019-05-17'),
(992, 'YLUA031249', 1, 122, 2, 'A544-201403-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '192.168.0.16', 0, '06-09-2024', 'Intel Core i5-4200M CPU @ 2.50GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (HGST  HTS545050A7E680 SCSI Disk Device)', 3, 'Session (poste secours)', '2019-05-17'),
(993, 'YLUA040344', 1, 122, 2, 'A544-201409-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '192.168.0.31', 0, '06-09-2024', 'Intel Core i3-4000M CPU @ 2.40GHz\r\n4,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (WDC WD5000LPVX-16V0T SCSI Disk Device)', 3, 'Cap4 / PP181277 (Patrice)', '2014-09-14'),
(997, 'E75374H7N521676', 7, 259, 3, 'BRN3C2AF4298A55', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '192.168.0.31', 0, '', '', 2, '', '2018-03-16'),
(998, '526177D9A03BA', 26, -1, 6, 'GS750E', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '192.168.0.10', 0, '', '', 0, '', '2019-05-17'),
(999, '2CE3502CWH', 15, 206, 2, 'HP470', 3, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, 'recyclé', 'Intel Core i3-4000M @ 2.40GHz\r\n4,00 Go  @ 1600MHz\r\nAMD Radeon HD 8750M\r\nIntel HD Graphics 4600\r\n500,00 Go (ST500LT0 ST500LT012-9WS14 SCSI Disk Device)', 3, 'enfance / comcom (Valeen Barrraud)', '2014-02-07'),
(1002, 'Q186I13911', 28, 261, 11, 'NAS-DATA', 19, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '192.168.0.252', 0, '', 'Intel(R) Celeron(R) J3455 @ 1.50GHz (4 cœurs)\r\n8Go (2/2)\r\n', 0, 'admin / 3v0lis23', '2019-01-26'),
(1003, 'CN785CM084', 15, -1, 3, 'HP DesignJet T520 ePrinter', -1, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '192.168.0.202', 0, '', '', 0, '', '2017-10-20'),
(1004, 'YMEJ006047', 1, 262, 1, 'PC-PREPA', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 124, '192.168.7.50', 0, '', 'Intel Core i7-7700 CPU @ 3.60GHz\r\n16,00 Go  @ 2400MHz\r\nIntel HD Graphics 630\r\n500,00 Go (ST500DM009-2F110A)\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)\r\n\r\nFourni par Alpma pour le pasto', 1, 'Pasto', '2019-07-10'),
(1005, 'YMLE065325', 1, 234, 1, 'P558-201905', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 24, '', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n4,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n500,00 Go (TOSHIBA DT01ACA050)', 1, 'Utilisateur/cidy87300', '2019-07-17'),
(1006, 'YMLE116248', 1, 234, 1, 'PCRI010', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n4,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n240,00 Go (WDC WDS240G2G0A-00JH30)', 1, 'pcri010/0', '2019-07-24'),
(1007, 'YMLE116247', 1, 234, 1, 'PCRI016', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n4,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n240,00 Go (WDC WDS240G2G0A-00JH30)', 1, 'pcri016/0', '2019-07-24'),
(1008, 'YMLE116247', 1, 234, 1, 'PCRI016', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n4,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n240,00 Go (WDC WDS240G2G0A-00JH30)', 1, 'pcri016/0', '2019-07-24'),
(1009, 'YMKU038702', 1, 229, 2, 'A357-201909', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n240,00 Go (WDC WDS240G2G0A-00JH30)', 1, 'Atelier', '2019-09-03'),
(1010, 'YMNK003767', 1, 263, 1, 'W18_007', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Emmanuel (Magasin)', '2019-09-02'),
(1011, 'DSAD054952', 1, 264, 2, 'E558-201909', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SAMSUNG MZNLN256HAJQ-00000)', 3, 'Franck / maridat', '2019-09-04'),
(1012, 'YM3M184383', 1, 134, 2, 'A555-201704', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i3-5005U CPU @ 2.00GHz\r\n8,00 Go DDR3 @ 1600MHz\r\nIntel HD Graphics 5500\r\n256,00 Go (SAMSUNG MZ7LN256HMJP-00000)', 1, 'Nicolas Chavegrand (ADV02)', '2017-04-11'),
(1013, 'YMKU038733', 1, 229, 2, 'A357-201909-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n240,00 Go (SATA SSD)', 1, 'Logan', '2019-09-16'),
(1014, 'YMKU038732', 1, 229, 2, 'A357-201909-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 101, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n240,00 Go (SATA SSD)', 1, 'Jerome', '2019-09-16'),
(1015, 'YMKU038735', 1, 229, 2, 'A357-201909-3', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 102, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n240,00 Go (SATA SSD)', 1, 'Brice', '2019-09-16'),
(1016, 'YMKU041230', 1, 229, 2, 'A357-201909', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, '', 'Intel Core i3-6006U @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n240,00 Go (WDC WDS240G2G0A-00JH30)', 1, 'Zoé Cognet (<-Diffusion)', '2019-09-16'),
(1018, 'YMHP008004', 1, 251, 1, 'W580-201909', 21, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', 'Intel Xeon E-2134 CPU @ 3.50GHz\r\n16,00 Go  @ 2667MHz\r\nNVIDIA Quadro P2000\r\n1 000,00 Go (TOSHIBA DT01ACA100)\r\n256,00 Go (SAMSUNG MZVPW256HEGL-00000)', 3, 'DAO / l', '2019-09-26'),
(1019, '', 51, -1, 10, 'EdgeRouter X SFP', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 46, '192.168.1.2', 0, '06/08/2024', 'ubnt/ ubnt', 1, '', '2019-09-25'),
(1021, 'YMLE157099', 1, 234, 1, 'P558-201910', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n240,00 Go (SATA SSD)', 3, 'Stock Salle info', '2019-10-01'),
(1022, 'YMLJ003438', 1, 266, 1, 'PC-STEPHANE', 41, 0, NULL, 0, NULL, 0, NULL, 0, 7, 99, '', 0, '', 'Intel Core i5-8500 CPU @ 3.00GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Stéphane', '2019-10-02'),
(1023, 'DSAD051154', 1, 264, 2, 'GUILLAUMET-1910', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n16,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SanDisk SD9SN8W-256G-1016)', 1, 'Guillaume Tabiteau', '2019-10-06'),
(1024, 'YMLE098977', 1, 234, 1, 'PCRI003', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 61, '', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n4,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n240,00 Go (SATA SSD)', 1, 'Maurice (Magasin Atelier)', '2019-10-09'),
(1025, 'YM6B012515', 1, 267, 5, 'PRIMERGY RX2540 M2', 25, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '192.168.0.249', 0, '', '', 5, '', '2019-02-24'),
(1026, 'YMJL003100', 1, 231, 5, 'SERVEUR', 24, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '192.168.0.253', 0, '', 'Intel Xeon E-2124 CPU @ 3.30GHz\r\n16,00 Go  @ 2667MHz\r\nMatrox G200e (Emulex) WDDM 2.0\r\n999,00 Go (LSI MegaSR   SCSI Disk Device)', 3, 'administrateur / C4pd23800!', '2019-10-14'),
(1027, 'DSAH009064', 1, 268, 2, 'CHRISTIANP-2019', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SAMSUNG MZNLN256HAJQ-00007)', 2, 'Christian Pellé', '2019-10-17'),
(1028, 'DSAH009065', 1, 268, 2, 'YvesP-PC', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '18/11/2025', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SAMSUNG MZNLN256HAJQ-00007)', 2, 'Yves Prevost', '2019-10-17'),
(1029, 'YMKV055151', 1, 229, 2, 'A357-201910-A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '06-09-2024', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 3, '', '2019-10-20'),
(1030, 'YMKV055152', 1, 229, 2, 'A357-201910-B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '06-09-2024', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 3, '', '2019-10-20'),
(1033, 'YMKV055149', 1, 229, 2, 'A357-201910-D', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 3, 'Carole Marceron', '2019-10-20'),
(1032, 'YMKV055153', 1, 229, 2, 'A357-201910-C', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '06-09-2024', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 3, '', '2019-10-20'),
(1034, 'YMKU038778', 1, 229, 2, 'A357-201910', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n240,00 Go (SATA SSD)', 1, 'Utilisateur', '2019-10-21'),
(1035, 'YMLE100745', 1, 234, 1, 'P558-201910', 21, 0, NULL, 0, NULL, 0, NULL, 0, 40, 109, '192.168.0.128', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n4,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n240,00 Go (SATA SSD)', 1, 'Utilisateur', '2019-10-22'),
(1036, 'YMLJ003439', 1, 266, 1, 'D738-201910', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', 'Intel Core i5-8500 @ 3.00GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Utilisateur66 (Margot Lacelle)', '2019-10-23'),
(1041, 'YMJR009965', 1, 271, 1, 'K558-201912-A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 63, '192.168.0.114', 0, '', 'Intel Core i3-8100 @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (MTFDDAK256TDL-1AW1ZABFA)', 3, 'Caisse 2', '2019-11-29');
INSERT INTO `ouapi_hardware` (`id`, `num_serie`, `marque_id`, `modele_id`, `type_id`, `nom`, `os_id`, `cpu_id`, `ram_capacite`, `ram_type_id`, `disque_capacite`, `disque_type_id`, `service_pack`, `user_id`, `agence_id`, `emplacement_id`, `ip`, `reservable`, `suivi_rebus`, `commentaire`, `pfield_garantie`, `pfield_utilisateurprinc`, `creation_date`) VALUES
(1038, 'NHQ5EEF006929011233400', 11, 270, 2, 'NITRO-201911', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '', 0, '', 'Intel Core i7-9750H CPU @ 2.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (NVMe HFM256GDJTNG-831)\r\n1Â 000,00 Go (WDC WD10SPZX-21Z10T0)', 2, 'GPAO (Jean BOURCY)', '2019-11-17'),
(1039, 'YLDS022436', 1, 75, 2, 'UTILISATEUR-PC', 3, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, 'rebut', 'Intel Core i3-2330M CPU @ 2.20GHz\r\n4,00 Go  @ 1333MHz\r\nIntel HD Graphics Family\r\n500,00 Go (ST9500325AS)', 0, 'utilisateur21 (Michel Aubard)', '2012-01-02'),
(1040, 'BTDN932004G9', 47, 293, 1, 'NUC-201911', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 110, '', 0, 'Perdu', 'Intel Core i3-7100U @ 2.40GHz\r\n8,00 Go @ 2400MHz\r\nIntel HD Graphics 620\r\n256,00 Go (WDC WDS256G1X0C-00ENX0)', 3, 'Agent GalSocl', '2019-11-17'),
(1042, 'YMJR009966', 1, 271, 1, 'K558-201912-B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 63, '192.168.0.132', 0, '', 'Intel Core i3-8100 @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (MTFDDAK256TDL-1AW1ZABFA)', 3, 'Caisse 1', '2019-11-28'),
(1043, 'YMKV056304', 1, 229, 2, 'A357-2019-12', 23, 0, NULL, 0, NULL, 0, NULL, 0, 13, 0, '', 0, '', 'Intel Core i5-7200U CPU @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 1, 'Utilisateur (Jean FranÃ§ois Tessier)', '2019-12-02'),
(1044, 'YMLE208554', 1, 234, 1, 'P558-201912-A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-8400 @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Franck Carry', '2019-12-01'),
(1045, 'YMLE208553', 1, 234, 1, 'P558-201912-B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-8400 @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Isabelle Pagneux', '2019-12-01'),
(1046, 'YMLK071869', 1, 236, 1, 'D538-201912-A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', 'Intel Core i5-8400 @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Président', '2019-12-04'),
(1047, 'YMLK071867', 1, 236, 1, 'D538-201912-B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', 'Intel Core i5-8400 @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Repas à domicile (RAD) - bureau 1', '2019-12-04'),
(1048, 'YMLK071856', 1, 236, 1, 'D538-201912', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Flavie', '2019-12-04'),
(1138, '1J462D3', 13, 382, 2, 'VOSTRO3500-2106', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (NVMe KBG40ZNS512G NVMe KIOXIA 512GB)', 3, 'Fabrice', '2021-06-01'),
(1050, 'YMLD032072', 1, 272, 1, 'P758-201912-2', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-8500 CPU @ 3.00GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Marlène Chavegrand (Com04)', '2019-12-10'),
(1051, 'YMLD032071', 1, 272, 1, 'P758-201912-3', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-8500 CPU @ 3.00GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Chantal Penot (RH01)', '2019-12-10'),
(1054, 'YMLD032078', 1, 272, 1, 'P758-201912-5', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-8500 CPU @ 3.00GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Cécile Gasnet (Com02)', '2019-12-10'),
(1053, 'YMLD032069', 1, 272, 1, 'P758-201912-4', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-8500 CPU @ 3.00GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Aurélie Kachel (Prod04)', '2019-12-10'),
(1055, 'YMLD032073', 1, 272, 1, 'P758-201912-6', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-8500 CPU @ 3.00GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Nicolas Chavegrand (ADV02)', '2019-12-10'),
(1056, 'YMLK051936', 1, 236, 1, 'D538-201912', 21, 0, NULL, 0, NULL, 0, NULL, 0, 8, 0, '', 0, '', 'Intel Core i3-9100 CPU @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, '', '2019-12-11'),
(1058, 'YMKU039690', 1, 229, 2, 'A357-201912', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-6006U CPU @ 2.00GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\n240,00 Go (SATA SSD)', 1, 'Utilisateur', '2019-12-16'),
(1059, 'YMLK051448', 1, 236, 1, 'D538-201912', 21, 0, NULL, 0, NULL, 0, NULL, 0, 14, 62, '', 0, '', 'Intel Core i3-9100 CPU @ 3.60GHz\r\n4,00 Go  @ 2667MHz\r\nCarte vidÃ©o de base Microsoft\r\n240,00 Go (SATA SSD)', 1, 'pcso002', '2019-12-20'),
(1060, '', 33, -1, 8, 'WAP54G', -1, 0, NULL, 0, NULL, 0, NULL, 0, 11, 24, 'DHCP', 0, '', 'MdP Wifi : areha87300\r\nSSID: AREHA\r\nna/admin', 0, '', '2020-01-01'),
(1061, '8CG9445914', 15, 0, 1, 'DESKTOP-7R28L4R', 21, 0, NULL, 0, NULL, 0, NULL, 0, 11, 22, '', 0, '', 'Intel Core i3-8100 CPU @ 3.60GHz\r\n4,00 Go  @ 2666MHz\r\nIntel UHD Graphics 630\r\n500,00 Go (TOSHIBA DT01ACA050)', 1, 'Utilisateur', '2020-01-03'),
(1062, 'Q199B05108', 28, 273, 11, 'NAS-DATA', 19, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '10.2.0.200', 0, '', '', 3, 'admin / admin23', '2019-12-31'),
(1063, 'YMJL006456', 1, 231, 5, 'TX1330M4', 25, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '10.2.0.250', 0, '', '', 5, 'root / ', '2019-12-31'),
(1064, 'YL1N002037', 1, 252, 1, 'CELCIUS-W380', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 105, '', 0, '', 'Intel Core i5 660  @ 3.33GHz\r\n4,00 Go DDR3 @ 1333MHz\r\nNVIDIA Quadro FX 580\r\n500,00 Go (Hitachi HDT721050SLA360 ATA Device)', 0, 'ATELIER', '2011-01-09'),
(1065, 'Q199B05104', 28, 273, 11, 'NAS-DATA', 19, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', '', 3, 'admin/admin23', '2019-12-31'),
(1066, 'DKRFL33', 13, 274, 2, 'LATITUDE7200-20', 21, 0, NULL, 0, NULL, 0, NULL, 0, 41, -1, '', 0, '', 'Intel Core i7-8665U CPU @ 1.90GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (PC SN730 NVMe WDC 256GB)', 3, 'Utilisateur (Mme Le Maire)', '2020-08-27'),
(1067, 'DSAD053600', 1, 264, 2, 'E558-201908', 21, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '', 0, '09/04/2026', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n1 000,00 Go (Samsung SSD 970 EVO 1TB)', 1, 'Christophe', '2019-08-18'),
(1068, 'YMLK092623', 1, 236, 1, 'W19_002', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '', 'Intel Core i3-9100 CPU @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Pascal', '2020-08-29'),
(1069, 'EIBA010834', 1, 269, 1, 'Q558-2007', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'Fabienne Maridat', '2020-07-28'),
(1070, 'EIBD008735', 1, 275, 2, 'A359-202006A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-8130U CPU @ 2.20GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 1, 'Atelier', '2020-06-23'),
(1071, 'EIBD008732', 1, 275, 2, 'A359-202006B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i3-8130U CPU @ 2.20GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 1, 'Atelier', '2020-06-23'),
(1072, 'YMLK092899', 1, 236, 1, 'D538-202009', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'W18006 (Patrick Laverdant)', '2020-09-23'),
(1073, 'EIBD008364', 1, 275, 2, 'A359-202008A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 1, 'Christophe Rouet', '2020-09-03'),
(1074, 'EIBD008421', 1, 275, 2, 'A359-202008B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 1, 'Benjamin ( pas de panda)', '2020-09-03'),
(1075, 'EIBD008445', 1, 275, 2, 'A359-202008C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n1To (SAMSUNG QVO 24-03-2023)', 1, 'Mickaël', '2020-09-03'),
(1076, 'EIBD008415', 1, 275, 2, 'A359-202008D', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 1, 'Mikaël (Mécano itinérant)', '2020-09-03'),
(1077, 'EIBD008414', 1, 275, 2, 'A359-202008E', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (SAMSUNG MZ7LN256HAJQ-00000)', 1, 'Fabrice', '2020-09-03'),
(1078, 'DSAS018797', 1, 276, 2, 'E459-202006', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (MTFDDAV256TDL-1AW1ZABFA)', 3, 'Grazziano Tonel', '2020-07-22'),
(1079, 'DSBR061070', 1, 277, 2, 'E559-202006', 21, 0, NULL, 0, NULL, 0, NULL, 36, 2, 7, '', 0, '', 'Intel Core i5-8265U @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n500,00 Go (WDC WDS500G2B0C-00PXH0)', 3, 'Jean Philippe Labregere', '2020-06-29'),
(1080, 'DSAS018771', 1, 276, 2, 'E459-202007-1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (MTFDDAV256TDL-1AW1ZABFA)', 3, 'Bastien LE NAOUR', '2020-07-08'),
(1081, 'DSAS021866', 1, 276, 2, 'E459-202009', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (MTFDDAV256TDL-1AW1ZABFA)', 3, 'Baptiste Raynaud', '2020-09-29'),
(1082, 'YMLK089549', 1, 236, 1, 'D538-202010', 21, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go', 3, 'Mairie / FURSAC1 (Dominique)', '2020-10-18'),
(1083, 'YMLK089743', 1, 236, 1, 'D538-202010A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, -1, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'Utilisateur', '2020-10-25'),
(1084, 'YMLK089742', 1, 236, 1, 'D538-202010B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, -1, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'Utilisateur', '2020-10-25'),
(1085, 'EIBP028941', 1, 234, 1, 'P558-202010A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, -1, '', 0, '', 'Intel Core i3-9100 CPU @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'Utilisateur', '2020-10-25'),
(1086, 'EIBP035432', 1, 234, 1, 'P558-202010A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-9400 CPU @ 2.90GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Utilisateur', '2020-10-29'),
(1087, 'EIBP035443', 1, 234, 1, 'P558-202010B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-9400 CPU @ 2.90GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Utilisateur', '2020-10-29'),
(1088, 'EIBP035440', 1, 234, 1, 'P558-202010C', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-9400 CPU @ 2.90GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Utilisateur', '2020-10-29'),
(1089, 'EIBP035441', 1, 234, 1, 'P558-202010D', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-9400 CPU @ 2.90GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Utilisateur', '2020-10-29'),
(1090, 'EIBP035439', 1, 234, 1, 'P558-202010E', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-9400 CPU @ 2.90GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Utilisateur', '2020-10-29'),
(1092, 'NHQ7MEF002040088EB3400', 11, 270, 2, 'NitroAN515-202011A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-10300H CPU @ 2.50GHz\r\n8,00 Go  @ 3200MHz\r\nNVIDIA GeForce GTX 1650\r\n512,00 Go (HFM512GDJTNI-82A0A)', 2, 'La Palette', '2020-11-12'),
(1093, 'NHQ7MEF002040089143400', 11, 270, 2, 'NitroAN515-202011B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-10300H CPU @ 2.50GHz\r\n8,00 Go  @ 3200MHz\r\nNVIDIA GeForce GTX 1650\r\n512,00 Go (HFM512GDJTNI-82A0A)', 2, 'La Palette', '2020-11-12'),
(1094, '2JCQ5Y2', 13, 278, 2, 'DELL-202002', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '', 0, '', 'Intel(R) Core(TM) i7-9750H @ 2.60GHz\r\n8 Go DDR4\r\nPM981a NVMe Samsung 256GB', 1, 'GP2 (Mathieu GRANDJEAN)', '2020-03-10'),
(1095, 'YLCM124417', 1, 102, 1, 'P400-1205', 21, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '30/09/2025', 'Intel Core i3-2120 @ 3.30GHz\r\n4,00 Go  @ 1600MHz\r\nIntel HD Graphics 4600\r\n500,00 Go (ST500DM0 02-1BD142 SCSI Disk Device)', 3, 'Sandrine', '2012-05-29'),
(1096, 'L6NXCV12M949259', 17, -1, 2, 'P3540-2011', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '', 'Asus P3540FA857R\r\nIntel Core i7-8565U CPU @ 1.80GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n512,00 Go (INTEL SSDPEKNW512G8)', 1, 'Maxence', '2020-11-26'),
(1097, 'EIBP028908', 1, 234, 1, 'P558-202011', 21, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', 'Intel Core i3-9100 CPU @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nCarte vidéo de base Microsoft\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 0, 'Zoé', '2020-11-26'),
(1098, 'YMLE258878', 1, 234, 1, 'P558-202008', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-8400 @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n500 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Adélaïde Pailler', '2020-08-23'),
(1099, 'PF2JWSQ3', 4, 279, 2, 'IDEAPAD3-2101', 44, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'AMD Ryzen 5 3500U with Radeon Vega Mobile Gfx  \r\n6,00 Go  @ 2400MHz\r\nAMD Radeon Vega 8 Graphics\r\n128,00 Go (WDC PC SN520 SDAPMUW-128G-1101)\r\n1 000,00 Go (ST1000LM035-1RK172)', 2, 'Jeunesse Direction', '2021-01-14'),
(1100, 'EQAB027829', 1, 280, 2, 'A3510-2101D', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'Intel Core i3-1005G1 @ 1.20GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Biblio3 (Utilisateur)', '2021-01-20'),
(1101, 'EQAB028785', 1, 280, 2, 'A3510-2101C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 66, '', 0, '', 'Intel Core i5-1035G1 @ 1.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Christophe Desenfants', '2021-01-20'),
(1102, 'EQAB028526', 1, 280, 2, 'A3510-2101A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'Intel Core i5-1035G1 @ 1.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-1016)', 3, 'Corine Parotin', '2021-01-20'),
(1103, 'EQAB028532', 1, 280, 2, 'A3510-2101B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'Intel Core i5-1035G1 @ 1.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-1016)', 3, 'Biblio2 (Sabine)', '2021-01-20'),
(1164, 'G6FN136001CP', 47, 292, 1, 'NUCI7-2112', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, '', 'Intel Core i7-10710U CPU @ 1.10GHz\r\n16,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n1 000,00 Go (KINGSTON SNVS1000G)', 3, 'Marc Chavegrand', '2021-12-21'),
(1104, 'EQAB028825', 1, 280, 2, 'A3510-2101F', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, '', 'Intel Core I5-1035G1 @ 1.00GHz\r\n8.00 Go @ 3200MHz\r\nIntel UHD Graphics\r\n256.00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Romain Janvier', '2021-01-24'),
(1105, 'EQAB028832', 1, 280, 2, 'A3510-2101E', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, '', 'Intel Core I5-1035G1 @ 1.00GHz\r\n8.00 Go @ 3200MHz\r\nIntel UHD Graphics\r\n256.00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Regie', '2021-01-24'),
(1106, 'EIBP066937', 1, 234, 1, 'P558-2102', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, '', 'Intel Core i5-9400 @ 2.90GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Zoe Gognet', '2021-02-04'),
(1107, 'R52N80SS0CE ', 2, 281, 14, 'Galaxy Tab A', 40, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'bibliolasout@gmail.com\r\nbiblio*23300', 2, '', '2021-01-28'),
(1108, 'R52N80SWZXJ ', 2, 281, 14, 'Galaxy Tab A', 40, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'bibliolasout@gmail.com\r\nbiblio*23300', 2, '', '2021-01-28'),
(1109, 'R52N80SS0FK ', 2, 281, 14, 'Galaxy Tab A', 40, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'bibliolasout@gmail.com\r\nbiblio*23300', 2, '', '2021-01-28'),
(1110, 'R52N80SS16M ', 2, 281, 14, 'Galaxy Tab A', 40, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'bibliolasout@gmail.com\r\nbiblio*23300', 2, '', '2021-01-28'),
(1111, 'R52N107FS0E', 2, 281, 14, 'Galaxy Tab A', 40, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'bibliolasout@gmail.com\r\nbiblio*23300', 2, '', '2021-01-28'),
(1112, 'EQAB019352', 1, 280, 2, 'A3510-2102', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', 'Intel Core i5-1035G1 CPU @ 1.00GHz\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (SAMSUNG MZVLQ512HALU-00007)', 3, 'Cécile Mavigner (Partie)', '2021-02-07'),
(1113, 'KBNXCV165148487', 17, -1, 2, 'P17-202001-1', 23, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i3 8145U / 2.1 GHz (3.9 GHz)\r\n256 Go SSD\r\n4 Go DDR4', 2, 'Sandra (Session Anne Gaelle)', '2020-02-02'),
(1114, 'KBNXCV165120484', 17, -1, 2, 'P17-202001-2', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i3 8145U / 2.1 GHz (3.9 GHz)\r\n256 Go SSD\r\n4 Go DDR4', 2, 'Utilisateur14 (Anne-Gaelle Burban)', '2020-02-02'),
(1115, 'GEFN02300XH9', 47, 293, 1, 'NUC-2103', 21, 0, NULL, 0, NULL, 0, NULL, 60, 4, 10, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n8.00 Go @ 2667MHz\r\nIntel UHD Graphics\r\n250.00 Go (CT250P5SSD8)', 3, 'Comptoir', '2021-03-02'),
(1116, 'EIBP067377', 1, 234, 1, 'P558-2103A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '', 'Intel Core i5-9400 CPU @ 2.90GHz\r\n8.00 Go @ 2667MHz\r\nIntel UHD Graphics 630\r\n256.00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Carole Marceron', '2021-03-03'),
(1117, 'EIBP067382', 1, 234, 1, 'P558-2103B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '', 'Intel Core i5-9400 CPU @ 2.90GHz\r\n8.00 Go @ 2667MHz\r\nIntel UHD Graphics 630\r\n256.00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Christine Quintanet (Accueil)', '2021-03-04'),
(1118, 'DSFG023990', 1, -1, 2, 'U7510-2103A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n256,00 Go (KBG4AZNV256G KIOXIA)', 3, '', '2021-03-11'),
(1119, 'DSFG024043', 1, -1, 2, 'U7510-2103B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n256,00 Go (KBG4AZNV256G KIOXIA)\r\n', 3, '', '2021-03-11'),
(1120, 'DSFG024042', 1, -1, 2, 'U7510-2103C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n256,00 Go (KBG4AZNV256G KIOXIA)', 3, '', '2021-03-11'),
(1121, 'EQAB040898', 1, 280, 2, 'A3510-2103', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '', 'Intel Core i5-1035G1 CPU @ 1.00GHz\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (SAMSUNG MZVLQ512HALU-00007)', 3, 'Utilisateur', '2021-03-11'),
(1122, 'EQAB054307', 1, 280, 2, 'A3510-2103', 21, 0, NULL, 0, NULL, 0, NULL, 0, 23, -1, '', 0, '', 'Intel Core i3-1005G1 CPU @ 1.20GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 1, 'Eleve', '2021-03-25'),
(1123, 'EQAB053693', 1, 280, 2, 'A3510-2103', 21, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', 'Intel Core i3-1005G1 CPU @ 1.20GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Marie Robichon', '2021-03-25'),
(1124, '9S717F412251ZKC000002', 16, -1, 2, 'GF75-2103', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 103, '', 0, '', 'Intel Core i7-10750H CPU @ 2.60GHz\r\n16,00 Go  @ 3200MHz\r\nNVIDIA GeForce GTX 1650 Ti\r\n512,00 Go (WDC PC SN530 SDBPNPZ-512G-1032)', 2, 'GP8 (Patrick Thomas)', '2021-03-26'),
(1273, 'YMCQ027926', 1, 170, 2, 'DESKTOP-J8DABPF', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 78, '', 0, '', 'Intel Core i5-7200U @ 2.50GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 620\r\n256,00 Go (SAMSUNG MZ7TY256HDHP-00000)', 3, 'Anne Guillon (AgentOT1)', '2017-06-26'),
(1125, 'EICE004576', 1, -1, 1, 'Q7010-2104A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-10400T CPU @ 2.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'José', '2021-04-19'),
(1126, 'EICE004560', 1, -1, 1, ' Q7010-2104B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-10400T CPU @ 2.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'Sandra (Fabienne)', '2021-04-22'),
(1127, 'EICE004588', 1, -1, 1, 'Q7010-2104D', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-10400T CPU @ 2.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'Philippe (Chef Atelier)', '2021-04-22'),
(1128, 'EICE004557', 1, -1, 1, 'Q7010-2104C', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core i5-10400T CPU @ 2.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'Sylvie', '2021-04-22'),
(1129, '055550110353', 40, 244, 13, 'SURFACE-2104', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '11th Gen Intel Core i3-1115G4 @ 3.00GHz\r\n8.00 Go  @ 4267MHz\r\nIntel Iris Xe Graphics\r\n128.00 Go (KBG40ZNS128G BG4A KIOXIA)', 3, 'Utilisateur56 (Controleur Spanc)', '2021-04-26'),
(1130, 'EICP007885', 1, 313, 1, 'P5010-2104', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Sophie Boulert (Prod02)', '2021-04-26'),
(1131, 'EICK002540', 1, -1, 1, 'D7010-2104', 21, 0, NULL, 0, NULL, 0, NULL, 0, 8, 128, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'Utilisateur (Dominique)', '2021-04-28'),
(1132, 'DSFG049388', 1, 378, 2, 'U7510-2104', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i7-10510U CPU @ 1.80GHz\r\n16,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n512,00 Go (KBG4AZNV512G KIOXIA)', 3, 'Utilisateur55 (Laura Bruyère)', '2021-04-28'),
(1133, 'EICK002541', 1, -1, 1, 'D7010-2104', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN720 SDAPNTW-256G-1016)', 3, 'Utilisateur2 (Mathilde Mathez)', '2021-04-28'),
(1134, 'EQAB053977', 1, 280, 2, ' A3510-2104', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i3-1005G1 CPU @ 1.20GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Cécile Gasnet (Com02)', '2021-05-02'),
(1135, 'YMHP016632', 1, 258, 1, 'CELSIUS-2105', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i7-9700 CPU @ 3.00GHz\r\n16,00 Go  @ 2667MHz\r\nNVIDIA Quadro P2200\r\n512,00 Go (WDC PC SN720 SDAPNTW-512G-1016)\r\n1 000,00 Go (TOSHIBA HDWD110)', 3, 'Utilisateur51 (Pauline Jay)', '2021-05-04'),
(1136, 'YMLD032070', 1, 272, 1, 'P758-201912-1', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-8500 CPU @ 3.00GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Mélanie Tixier (Com03)', '2019-12-09'),
(1137, 'DSFD072976', 1, 282, 2, 'E5510-2105', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 66, '', 0, '', 'Intel Core i5-10210U @ 1.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n256,00 Go (KBG4AZNV256G KIOXIA)', 3, 'Laurent Rayon => Jennifer Josse', '2021-05-19'),
(1139, 'NXVLLEF0051040519D7600', 11, 369, 2, 'P215-52-2105', 41, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (SAMSUNG MZVLQ512HALU-000AC)', 1, 'Jeunesse Ado', '2021-06-15'),
(1141, 'NXVLLEF0051040513B7600', 11, 369, 2, 'P215-52-2106', 41, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (SAMSUNG MZVLQ512HALU-000AC)', 1, 'Stock', '2021-06-15'),
(1145, 'EQAB121078', 1, 280, 2, 'A3510-2107', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-1035G1 CPU @ 1.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Utilisateur27 (Cinthia  Zambrano-Bastard)', '2021-07-07'),
(1143, 'MSACD3L1S0102549', 16, -1, 1, 'PRO22X-202106A', 23, 0, NULL, 0, NULL, 0, NULL, 0, 6, 111, '', 0, '', 'Intel Core i3-10100 @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n1 000,00 Go (ST1000LM049-2GH172)\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-1032)', 2, 'Utilisateur', '2021-06-22'),
(1144, 'MSACD3L1S0102856', 16, -1, 1, 'PRO22X-202106B', 23, 0, NULL, 0, NULL, 0, NULL, 0, 6, 111, '', 0, '', 'Intel Core i3-10100 @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n1 000,00 Go (ST1000LM049-2GH172)\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-1032)', 2, 'Utilisateur', '2021-06-22'),
(1146, 'DSFG050673', 1, -1, 2, 'U7510-2107', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '06-09-2024', 'Intel Core i7-10510U CPU @ 1.80GHz\r\n16,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n256,00 Go (KBG4AZNV256G KIOXIA)', 3, 'Cap5 / PPi280721 (Patrick PICCOT)', '2021-07-19'),
(1147, 'DSAX002528', 1, 340, 13, ' Q7310-2108', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n8,00 Go  @ 2133MHz\r\nIntel UHD Graphics\r\n256,00 Go (WDC PC SN530 SDBQNPZ-256G-1016)', 2, 'Utilisateur21 (Patrick Lardy)', '2021-08-11'),
(1148, '9S716R4121631ZL5000280', 16, -1, 2, 'GF63-2109', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-10500H CPU @ 2.50GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (Micron_2210_MTFDHBA512QFD)', 2, 'Utilisateur', '2021-09-28'),
(1149, '9S716R4121631ZL5000408', 16, -1, 2, 'GF63-2109B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel Core i5-10500H CPU @ 2.50GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (Micron_2210_MTFDHBA512QFD)', 2, 'Utilisateur', '2021-09-28'),
(1150, '', 1, 25, 5, 'SERVEUR-2K8', 10, 0, NULL, 0, NULL, 0, NULL, 0, 23, -1, '192.168.1.254', 0, '26/11/2021', 'Intel Xeon X3220\r\n4 Go', 0, '', '2021-10-06'),
(1151, 'EQAB151866', 1, 280, 2, 'A3510-2110', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, '08/04/2026', 'Intel Core i3-1005G1 CPU @ 1.20GHz\r\n	       8,00 Go  @ 3200MHz\r\n	       Intel UHD Graphics\r\n               256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 1, 'Utilisateur', '2021-10-28'),
(1152, 'Q212I09263W', 28, 283, 11, 'NAS', 43, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '10.12.71.70', 0, '', 'Intel Celeron J4125 2 GHz (double cœur)\r\nMemoire : 4Go DDR4\r\n', 2, '', '2021-08-23'),
(1153, 'Q217B12527', 28, 284, 11, 'NAS-VM', 43, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.215', 0, '08/04/2026', '4x2To Raid 10 (ST2000VN004) 3.62To\r\nAnnapurna Labs Alpine AL-314 \r\n2Go DDR3\r\n', 3, '', '2021-11-17'),
(1154, 'W-1100195', 52, 285, 5, 'Serveur', 42, 0, NULL, 0, NULL, 0, NULL, 0, 23, -1, '192.168.1.250', 0, '', 'Intel Xeon E-2236 / 3.4 GHz\r\n16 Go Mémoire interne\r\n3.4 GHz Fréquence du processeur\r\n\r\nCapacité disque dur 2x 480GB SSD\r\n', 5, 'Administrateur', '2021-11-25'),
(1155, 'Q19AB15894', 28, 286, 11, 'NAS-SAUV', 43, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.205', 0, '', '4x4To Raid 5 (HDWQ140) (10.89 To)\r\nIntel Apollo Lake J3455 (quadricœur)\r\n2 Go DDR3L', 1, 'admin', '2018-08-31'),
(1156, 'EIDF002742', 1, 287, 1, 'P5011-2111', 21, 0, NULL, 0, NULL, 0, NULL, 0, 40, -1, '', 0, '', 'Intel Core i5 10400 / 2.9 GHz\r\n8 Go DDR4 SDRAM\r\nSSD 256 Go - PCI Express - M.2 - NVM Express', 1, '', '2021-11-29'),
(1157, 'TEQAB153577', 1, 280, 2, 'A3510-2110', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 9, '', 0, '', 'Intel Core i3-1005G1 @ 1.00GHz\r\n8.00 Go @ 3200MHz\r\nIntel UHD Graphics\r\n256.00 Go', 1, 'PeP\'s', '2021-10-27'),
(1158, 'Q213B16549P', 28, 290, 11, 'NAS-DATA', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '10.10.0.248', 0, '', '4 x 4 To (ST4000VN)  Raid 5 (10,89To)\r\nIntel Celeron J4125 2 GHz\r\n4 Go DDR4', 1, 'admin ', '2021-09-29'),
(1159, 'Q213B10908V', 28, 289, 11, 'CELVIN-Q700', 19, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '10.10.1.254', 0, '', '2 x 2 To (WD20EFZX) Raid 1\r\nIntel Celeron J4125 2 GHz\r\n2 Go DDR3', 1, 'admin', '2021-09-07'),
(1160, 'Q213B10789B', 28, 289, 11, 'NAS-AQUA', 19, 0, NULL, 0, NULL, 0, NULL, 0, 2, 63, '192.168.1.254', 0, '', '2 x 2 To (WD20EFZX) Raid 1\r\nIntel Celeron J4125 2 GHz\r\n2 Go DDR3', 1, 'admin', '2021-08-15'),
(1161, 'Q205I07920', 28, 291, 11, 'NAS-OTLS', 19, 0, NULL, 0, NULL, 0, NULL, 0, 2, 8, '10.10.5.254', 0, '', '2 x 2 To (WD20EFZX) Raid 1\r\nAnnapurna Labs Alpine AL-314 1.7 GHz\r\n4 Go DDR3', 1, 'admin', '2020-08-30'),
(1162, 'Q212B00910', 28, 288, 11, 'NAS-PALETTE', 43, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '192.168.0.73', 0, '', '2x2To Raid 1 (ST2000VN004)\r\nIntel Celeron J4005 2 GHz (2 cœurs)\r\n2 Go', 1, 'admin', '2021-12-02'),
(1163, 'Q20AB13346', 28, 288, 11, 'NASD014CE', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '192.168.0.70', 0, '', '2x2To Raid 1 (ST2000VN004) \r\nIntel Celeron J4005 2 GHz (2 cœurs)\r\n2 Go', 1, 'admin', '2021-12-02'),
(1466, 'R8204567', 52, 359, 2, 'T1610-2507', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', '12th Gen Intel Core i5-1235U\r\n16,00 Go  @ 3200MHz\r\n512,00 Go (HighRel 512GB SSD)', 2, 'Margot Levaslot', '2025-07-06'),
(1441, 'R8361971', 52, 312, 1, 'T6000-2510', 41, 0, NULL, 0, NULL, 0, NULL, 0, 7, 65, '', 0, '', 'Intel Core Ultra 5 125H\r\n15,00 Go  @ 4800MHz\r\nIntel Arc Graphics\r\n500,00 Go (WD Blue SN5000 500GB)', 3, '', '2025-10-13'),
(1165, '2010JNAT3S340', 53, 314, 1, 'TPV HIFIVE 14', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 78, '', 0, '', 'Intel Celeron J1900 - 2.4 GHz\r\nSSD 64 Go - RAM 4 Go SODIMM', 3, '', '2021-06-16'),
(1167, 'EIBP010944', 1, 234, 1, 'P558-2007', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 51, '', 0, '17/02/2026', 'Intel Core i3-9100 @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go', 3, ' Rebut ?', '2020-07-16'),
(1168, 'EQAB164005', 1, 280, 2, 'A3510-2201A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', 'Intel Core i5-1035G1 CPU @ 1.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Utilisateur formation', '2022-01-10'),
(1169, 'EQAB121243', 1, 280, 2, 'A3510-2201B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 112, '', 0, '', 'Intel Core i5-1035G1 CPU @ 1.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)\r\n', 3, 'ALSH Fursac', '2022-01-10'),
(1170, 'EQAB164401', 1, 280, 2, 'A3510-2201C', 21, 0, NULL, 0, NULL, 0, NULL, 0, 29, 93, '', 0, '', 'Intel Core i5-1035G1 CPU @ 1.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)\r\n', 3, 'Crèche Marsac', '2022-01-11'),
(1171, 'YLQK016126', 1, 167, 5, 'PRIMERGY TX2540 M1', 25, 0, NULL, 0, NULL, 0, NULL, 0, 16, -1, '192.9.200.1', 0, '', '', 5, '', '2016-02-09'),
(1172, 'Q231B028006', 28, 316, 11, 'NAS-DATA', 43, 0, NULL, 0, NULL, 0, NULL, 0, 16, -1, '192.9.200.013', 0, '', '', 1, '', '2023-05-04'),
(1173, 'Q15AI02686', 28, 203, 11, 'NAS-SAUV', 43, 0, NULL, 0, NULL, 0, NULL, 0, 16, -1, '192.9.200.014', 0, '', '', 1, '', '2016-02-09'),
(1174, 'EIDF004201', 1, 287, 1, 'P5011-2201', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 123, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-1016)', 3, 'Xavier Chevron (Emb01) Emballage', '2022-01-17'),
(1175, 'G6BE019008HA', 47, 293, 1, 'NUC-202008B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 8, '', 0, '', 'Intel Core i3-8109U CPU @ 3.00GHz\r\n8,00 Go  @ 2400MHz\r\nIntel Iris Plus Graphics 655\r\n250,00 Go (WDC WDS250G2B0C-00PXH0)', 3, 'Françoise (Utilisateur)', '2020-08-30'),
(1176, 'G6BE019008AG', 47, 293, 1, 'NUC-202008A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 8, '', 0, '', 'Intel Core i3-8109U CPU @ 3.00GHz\r\n8,00 Go  @ 2400MHz\r\nIntel Iris Plus Graphics 655\r\n250,00 Go (WDC WDS250G2B0C-00PXH0)', 3, 'Maxime Accueil (Utilisateur)', '2020-08-30'),
(1177, 'YM4P037224', 1, 154, 1, 'BIBLI2016-A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500,00 Go (TOSHIBA DT01ACA050)\r\n256,00 Go (EMTEC X200 SCSI Disk Device)', 3, ' PC Corrine', '2016-12-06'),
(1178, 'YM4P074202', 1, 154, 1, 'BIBLI2016-B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n250,00 Go (SSD SAMSUNG 870EVO S6PENM0W902347 20/10/23)', 3, 'PC Accueil', '2016-10-20'),
(1179, 'YM4P037247', 1, 154, 1, 'BIBLI2016-C', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n250,00 Go (SSD SAMSUNG 870 EVO S6PENM0W902397Z 20/10/23)', 3, 'PC 1er étage', '2016-10-20'),
(1180, 'YM4P074196', 1, 154, 1, 'BIBLI2016-D', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\nSSD 256 Go', 3, 'PC public gauche', '2016-10-20'),
(1181, 'YM4P074207', 1, 154, 1, 'CAPS-2503', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 63, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n8,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\nSSD 120Go\r\nVM Windows 7 pour affichage\r\nReconditionné en 03/25', 0, 'Utilisateur / comcom (pour TV)', '2016-10-20'),
(1182, 'MSB183L9S0107522', 16, 294, 1, 'CUBI-2201B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5 10210 / 1.6 GHz\r\n8 Go DDR4 2666 MHz\r\nSSD 500 Go - PCI Express - M.2 - NVM Express\r\nIntel UHD Graphics 615\r\n', 2, 'Céline Weiss (RessourcesH)', '2022-01-30'),
(1183, 'MSB183L9S0107559', 16, 294, 1, 'CUBI-2201A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 117, '', 0, '', 'Intel Core i5 10210 / 1.6 GHz\r\n8 Go DDR4 2666 MHz\r\nSSD 500 Go - PCI Express - M.2 - NVM Express\r\nIntel UHD Graphics 615', 2, 'Virginie Vesvres (CIAS)', '2022-02-01'),
(1385, 'R7904448', 52, 347, 1, 'T3000-2410A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Celeron N4505 @ 2.00GHz 4,00 Go  @ 3200MHz Intel UHD Graphics 128,00 Go (SSD_M.2_PCIe3_128GB_InnovationIT)', 3, 'tv_visio', '2024-10-10'),
(1184, 'YMKT044580', 1, 269, 1, 'Q558-201911', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'GED', '2019-11-26'),
(1185, 'YM4P037244', 1, 154, 1, 'D5562016', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 118, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500,00 Go', 3, 'St Germain Beaupré', '2016-10-20'),
(1186, 'YM4P037240', 1, 154, 1, 'BIBLI2016-J', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 118, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500,00 Go', 3, 'St Agnant de Versillat', '2016-10-20'),
(1187, 'YM4P037238', 1, 154, 1, 'D5562016', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 118, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500,00 Go', 3, 'Azérables', '2016-10-20'),
(1188, 'YM4P037239', 1, 154, 1, 'D5562016-R', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 64, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n8,00 Go  @ 2133MHz (+4Go 03/25)\r\nIntel HD Graphics 530\r\nSSD Samsung 870 EVO 250Go (03/25)', 3, 'PC public droite', '2016-10-20'),
(1189, 'YM4P074200', 1, 154, 1, 'BIBLI2016-G', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 118, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\n500,00 Go', 3, 'Saint Priest la Feuille', '2016-10-20'),
(1190, 'YM4P074205', 1, 154, 1, 'BIBLI2016-F', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 118, '', 0, '', 'Intel Core i3-6100 CPU @ 3.70GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 530\r\nSSD SAMSUNG 250 GB \r\nS/N S6PENF0X103690', 3, '(ST-MAURICE)', '2016-10-20'),
(1191, 'R7011266', 52, 295, 2, 'T1716-2202A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 19, -1, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WDC WDS500G2B0C-00PXH0)', 2, '', '2022-02-08'),
(1192, 'R7011177', 52, 295, 2, 'T1716-2202B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 19, -1, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WDC WDS500G2B0C-00PXH0)', 2, '', '2022-02-08'),
(1193, 'R7048595', 52, 296, 1, 'T5000-2202', 21, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, '', 0, '', 'Intel Core i3-10100 CPU @ 3.60GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)', 3, 'Utilisateur', '2022-02-23'),
(1194, 'DSFT018498', 1, 297, 2, 'U7511-2202A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (KBG4AZNV256G KIOXIA)', 3, 'N/A', '2022-01-31'),
(1195, 'DSFT018292', 1, 297, 2, 'U7511-2202B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (KBG4AZNV256G KIOXIA)', 3, 'N/A', '2022-01-31'),
(1196, 'DSFT018278', 1, 297, 2, 'U7511-2202C', 21, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (KBG4AZNV256G KIOXIA)', 3, '', NULL),
(1197, 'DSFW006401', 1, 298, 13, 'Q7311-2202A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 4267MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Utilisateur13 (Eric Dupeux)', '2022-03-07'),
(1198, 'DSFW006400', 1, 298, 13, 'Q7311-2202B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 4267MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)\r\n', 3, 'Utilisateur18 (Didier Pouzeaud)', '2022-03-07'),
(1199, '035635615053', 40, 299, 13, ' FUJITSU-A530-C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 4267MHz\r\nIntel Iris Xe Graphics\r\n128,00 Go (SAMSUNG MZ9LQ128HBHQ-00000)', 3, 'Utilisateur6 (Carine Lassence)', '2022-03-14'),
(1200, 'Q219I00558B', 28, 301, 11, 'StockAIM-1', 43, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '192.168.0.71', 0, '', '', 1, '', '2022-04-12'),
(1201, 'EQAB168816', 1, 280, 2, 'A3510-2204', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', 'Intel Core i5-1035G1 @ 1.00GHz\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (SAMSUNG MZVLQ512HALU-00007)', 3, 'Stagiaire', '2022-04-18'),
(1298, 'R7423357', 47, 293, 1, 'NUCI5-2306', 21, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Céline LAMINE', '2023-06-04'),
(1202, '', 1, -1, 5, 'Serveur VMWare RX1330M4', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '10.12.71.250', 0, '', 'Intel Xeon E E-2236 3.4 GHz\r\n48 GB 2RX8 DDR4-2666 U ECC MEMBULKWARE\r\n2 x SSD SATA 6G 960GB MIXED-USE 2.5INTH-P EP\r\nSSD SATA 6G 240GB M.2 N H-P FORINTVMWARE\r\nPLAN EP X710-DA2 2X10GB SFP+ PERP. IN\r\n2 x 450 W', 0, '', '2012-02-04'),
(1203, 'MBM0KS013861N4Z', 22, -1, 1, 'AIMR7-2204', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 8, '', 0, '', 'AMD Ryzen 7 3800X 8-Core Processor             \r\n16,00 Go  @ 2400MHz\r\nNVIDIA GeForce GT 1030\r\n1 000,00 Go (WD Blue SN570 1TB)', 3, 'Maxime Amato (Utilisateur)', '2022-04-28'),
(1204, 'DSFV012565', 1, 302, 2, 'E5511-2204A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (WDC PC SN530 SDBQNPZ-512G-1016)', 3, 'Utilisateur38 (Aurélie Helias)', '2022-05-02'),
(1205, 'DSFV012840', 1, 302, 2, 'E5511-2204B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (WDC PC SN530 SDBQNPZ-512G-1016)', 3, 'Utilisateur8 (Caroline Chambraud)', '2022-05-02'),
(1206, 'DSFV012841', 1, 302, 2, 'E5511-2204C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (WDC PC SN530 SDBQNPZ-512G-1016)', 3, 'Utilisateur37 (Vincent Fortineau)', '2022-05-02'),
(1207, 'EIDF020104', 1, 287, 1, 'P5011-2204C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n512,00 Go (WDC PC SN530 SDBPNPZ-512G-1016)', 3, 'Stock Salle info', '2022-05-08'),
(1208, 'EIDF020070', 1, 287, 1, 'P5011-2204A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n512,00 Go (WDC PC SN530 SDBPNPZ-512G-1016)', 3, 'Utilisateur11 (Dominique Cochin)', '2022-05-12'),
(1209, 'EIDF020067', 1, 287, 1, 'P5011-2204B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n512,00 Go (WDC PC SN530 SDBPNPZ-512G-1016)', 3, 'Utilisateur12 (Sécurité Hygiène)', '2022-05-08'),
(1210, 'EIDF020103', 1, 287, 1, 'P5011-2204D', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n512,00 Go (WDC PC SN530 SDBPNPZ-512G-1016)', 3, 'Utilisateur24 (Nathalie Guillot)', '2022-05-12'),
(1211, 'E79024E1N468811', -1, -1, 3, 'MFC-L3710CW', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 6, '10.10.0.61', 0, '', '', 2, '', '2022-05-03'),
(1212, 'K9NXCV11M291396', 17, 205, 2, 'LAPTOP-DK2H577U', 41, 0, NULL, 0, NULL, 0, NULL, 0, 7, 99, '', 0, '', 'Intel Core i3 8145U / 2.1 GHz \r\n256 Go SSD NVMe\r\n4 Go DDR4 2400MHz\r\nIntel UHD Graphics 520', 2, 'Gloria', '2020-03-22'),
(1213, 'EQAB121363', 1, 280, 2, 'A3510-2206', 41, 0, NULL, 0, NULL, 0, NULL, 0, 6, 78, '', 0, '', 'Intel Core i5-1035G1 @ 1.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Manon HAMY (Manon)', '2022-07-04'),
(1214, 'EIDA004339', 1, 303, 1, 'D6011-2207A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-1016)', 3, 'Stéphanie Deschamps', '2022-07-17'),
(1215, 'EIDA004292', 1, 303, 1, 'D6011-2207B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-10', 3, 'Eric', '2022-07-17'),
(1216, 'EIDA004347', 1, 303, 1, 'D6011-2207C', 21, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-1016)', 3, 'Jacqueline BRUZAT', '2022-07-17'),
(1217, 'EIDA004314', 1, 303, 1, 'D6011-2207D', 21, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-1016)', 3, 'Stéphanie Aubert', '2022-07-17'),
(1218, 'EQAA032590', 1, 304, 2, 'A3511-2207A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 135, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Nathalie Roche', '2022-07-18'),
(1219, 'EQAA032172', 1, 304, 2, 'A3511-2207B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 136, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Pierre Blanchard', '2022-07-18'),
(1220, 'EQAA032568', 1, 304, 2, 'A3511-2207C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 120, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Julie Beyrand', '2022-07-18'),
(1221, 'EIDF023638', 1, 287, 1, 'P5011-2207A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 43, -1, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLQ256HBJD-00B00)', 3, '', '2022-07-18'),
(1222, 'EIDF023637', 1, 287, 1, 'P5011-2207B', 21, 0, NULL, 0, NULL, 0, NULL, 0, 43, -1, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLQ256HBJD-00B00)', 3, '', '2022-07-19'),
(1223, 'DSFV027459', 1, 302, 2, 'E5511-2207', 21, 0, NULL, 0, NULL, 0, NULL, 0, 43, -1, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (WDC PC SN530 SDBQNPZ-512G-1016)', 3, '', '2022-07-19'),
(1224, 'DSFV084786', 1, 302, 2, 'E5511-2207', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (SAMSUNG MZVLQ512HBLU-00B07)', 3, 'Christophe Blondeau', '2022-07-20'),
(1226, 'EQAB122128', 1, 280, 2, 'A3510-2207', 21, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-1035G1 CPU @ 1.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Richard Cerezo-Lahiani (<-Clément Magnaval)', '2022-07-27'),
(1227, 'EWAG013452', 1, 306, 5, 'PRIMERGY RX2530 M5', 25, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '', 5, 'Evolis 23', '2022-08-04'),
(1228, '', 42, -1, 4, 'RICOH IM 550', -1, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '', 0, '', NULL),
(1229, 'EICK007887', 1, -1, 1, 'D7010-2109', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630', 3, 'Utilisateur5 (Jeanne Verdier)', '2021-09-09'),
(1230, 'EQAB040900', 1, 280, 2, 'A3510-2104', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Core i5-1035G1 CPU @ 1.00GHz\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n500,00 Go SSD M.2 NVMe PCIe', 3, 'Utilisateur14 (Anne-Gaêlle Burban)', '2021-04-27'),
(1231, 'EIDA004537', 1, 303, 1, 'D6011-2208A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLQ256HBJD-00B00)', 3, 'Utilisateur24 (Nathalie Guillot)', '2022-08-22'),
(1232, 'EIDA004528', 1, 303, 1, 'D6011-2208B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLQ256HBJD-00B00)', 3, 'Stock Salle info', '2022-08-22'),
(1233, 'EICE068099', 1, 307, 1, 'Q7010-2208A', 21, 0, NULL, 0, NULL, 0, NULL, 0, 42, 121, '', 0, '', 'Intel Core i5-10400T CPU @ 2.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN730 SDBPNTY-256G-1016)', 1, 'Bibliothéquaires', '2022-08-22'),
(1234, 'EICE068103', 1, 307, 1, 'Q7010-2208B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 121, '', 0, '', 'Intel Core i5-10400T CPU @ 2.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN730 SDBPNTY-256G-1016)', 1, 'Bibliothéquaires', '2022-08-22'),
(1235, 'EICE068084', 1, 307, 1, 'Q7010-2208C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', 'Intel Core i5-10400T CPU @ 2.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (WDC PC SN730 SDBPNTY-256G-1016)', 1, 'Elisabeth Perichon - Sophia Sadeg', '2022-08-22'),
(1236, 'R7222154', 52, 308, 2, 'TERRA1516-2209A', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)', 2, 'Utilisateur / 1234', '2022-09-27'),
(1237, 'R7222150', 52, 308, 2, 'TERRA1516-2209B', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)', 2, 'Utilisateur / 1234', '2022-09-27'),
(1238, 'R7222146', 52, 308, 2, 'TERRA1516-2209C', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)', 2, 'Utilisateur / 1234', '2022-09-27'),
(1239, 'R7222141', 52, 308, 2, 'TERRA1516-2209D', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)', 2, 'Utilisateur / 1234', '2022-09-27');
INSERT INTO `ouapi_hardware` (`id`, `num_serie`, `marque_id`, `modele_id`, `type_id`, `nom`, `os_id`, `cpu_id`, `ram_capacite`, `ram_type_id`, `disque_capacite`, `disque_type_id`, `service_pack`, `user_id`, `agence_id`, `emplacement_id`, `ip`, `reservable`, `suivi_rebus`, `commentaire`, `pfield_garantie`, `pfield_utilisateurprinc`, `creation_date`) VALUES
(1240, 'R7221965', 52, 308, 2, 'TERRA1516-2209E', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)', 2, 'Utilisateur / 1234', '2022-09-27'),
(1241, '0F00X3L222301J', 40, 309, 13, 'SURFACE-2209', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', '11th Gen Intel Core i5-1145G7 @ 2.60GHz\r\n8,00 Go  @ 4267MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (KBG40ZNS256G BG4A KIOXIA)', 3, 'utilisateur49 (Steve Naudin)', '2022-09-13'),
(1242, 'R7221940', 52, 308, 2, 'TERRA1516-2209F', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1243, 'R7221963', 52, 308, 2, 'TERRA1516-2209G', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1244, 'R7222155', 52, 308, 2, 'TERRA1516-2209H', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1245, 'R7222149', 52, 308, 2, 'TERRA1516-2209I', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1246, 'R7221964', 52, 308, 2, 'TERRA1516-2209J', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1247, 'R7222151', 52, 308, 2, 'TERRA1516-2209K', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1248, 'R7222152', 52, 308, 2, 'TERRA1516-2209L', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1249, 'R7222144', 52, 308, 2, 'TERRA1516-2209M', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1250, 'R7222147', 52, 308, 2, 'TERRA1516-2209N', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1251, 'R7222148', 52, 308, 2, 'TERRA1516-2209P', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 119, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SSD_M.2_256GB_InnovationIT)\r\n0 octects (CR SCSI Disk Device)', 2, 'Utilisateur / 1234', '2022-09-19'),
(1252, 'EWAH007265', 1, 310, 5, 'S18-002', 42, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '172.21.18.2', 0, '', 'ntel Xeon Silver 4215 / 2.5 GHz (3.5 GHz) (8 cœurs/16 threads)\r\n64 Go DDR4 ECC @ 2400MHz\r\n3 x SSD 960Go Sata 2,5\" RAID5\r\n1 x SSD M.2 Sata 256Go VMWare', 5, 'Administrateur / Maridat-23', '2022-09-30'),
(1253, 'EIDA003460', 1, 303, 1, 'D6011-2210', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 2666MHz\r\nIntel UHD Graphics 630', 3, 'Xavier Chevron (Emb01)', '2022-10-18'),
(1254, 'EQAA082836', 1, 304, 2, 'A3511-2210', 21, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics', 3, '', '2022-10-18'),
(1255, 'EQAA032998', 1, 304, 2, 'A3511-2210', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 2, 'utilisateur39 (Frédéric  Gbedande)', '2022-10-24'),
(1256, 'EQAA078976', 1, 304, 2, 'A3511-2210A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 134, '', 0, '', '11th Gen Intel Core i3-1115G4 @ 3.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Maternelle 1', '2022-10-24'),
(1257, 'EQAA078981', 1, 304, 2, 'A3511-2210B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 134, '', 0, '', '11th Gen Intel Core i3-1115G4 @ 3.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 3, 'Maternelle 2', '2022-10-24'),
(1258, 'EIDF034737', 1, 287, 1, 'P5011-2211', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nCarte vidéo de base Microsoft\r\n256,00 Go (WDC PC SN530 SDBPNPZ-256G-1016)', 3, 'Stock Salle info', '2022-11-23'),
(1259, 'NXVLLEF005038024E27600', 11, 326, 2, 'TMP2-2011A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '13/01/2021', 0, '02/07/2024', 'Intel Core i5-10210U @ 1.60GHz\r\n16,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n512,00 Go (WDC PC SN520 SDAPNUW-512G-1014)', 3, 'Christophe Haloup', '2021-01-12'),
(1260, 'NXVLLEF005038024C47600', 11, 326, 2, 'TMP2-2011B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '13/01/2021', 0, '', 'Intel Core i5-10210U @ 1.60GHz\r\n16,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n512,00 Go (WDC PC SN520 SDAPNUW-512G-1014)', 3, 'Didier Lucas', '2021-01-12'),
(1261, 'R7307765', 52, 296, 1, '5000-2212', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 51, '', 0, '', '11th Gen Intel Core i3-1115G4 @ 3.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n250,00 Go (WD Blue SN570 250GB)', 3, 'Utilisateur (Flore Thevenot)', '2022-12-12'),
(1262, 'EIDF008478', 1, 287, 1, 'P5011-2212', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, 105, '', 0, '', 'Intel Core i5-10400 CPU @ 2.90GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n256,00 Go (SAMSUNG MZVLQ256HBJD-00B00)\r\n', 3, 'ATELIER', '2022-12-12'),
(1263, 'EIDK004398', 1, 311, 1, 'W5011-2212', 21, 0, NULL, 0, NULL, 0, NULL, 0, 16, -1, '', 0, '', '11th Gen Intel Core i9-11900 @ 2.50GHz\r\n32,00 Go  @ 3200MHz\r\nIntel UHD Graphics 750\r\n512,00 Go (SAMSUNG MZVL2512HCJQ-00B07)', 3, 'Chez Toto', '2022-12-12'),
(1265, 'R7332984', 52, 312, 1, '6000-2301A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Clémence Eymery (RespCim)', '2023-01-23'),
(1266, 'R7332979', 52, 312, 1, '6000-2301B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Christelle Dubreuil (InstrCim)', '2023-01-23'),
(1268, 'R7320939', 52, 312, 1, 'T6000-2302A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 122, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Fromagerie (Prod08)', '2023-02-07'),
(1269, 'R7320875', 52, 312, 1, 'T6000-2302B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 49, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Expédition (Emb03)', '2023-02-20'),
(1270, 'R7320892', 52, 312, 1, 'T6000-2302C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 124, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Pasto (Prod09)', '2023-02-20'),
(1271, '2110INAT30584', 53, 314, 1, 'TPV HIFIVE 14', 21, 0, NULL, 0, NULL, 0, NULL, 0, 6, 125, '', 0, '', 'Intel Celeron J1900 - 2.4 GHz\r\nSSD 64 Go - RAM 4 Go SODIMM', 3, '', '2023-01-01'),
(1272, 'BTTN23700K8V', 47, 293, 1, 'NUCi5-2303', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, 10, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go Autre @ \r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Antoine (Chef Atelier)', '2023-03-05'),
(1274, 'R7373877', 52, 295, 2, '1716T-2303', 41, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (SAMSUNG MZVL4512HBLU-00B07)', 2, 'Nadege', '2023-03-12'),
(1275, 'EQAA030594', 1, 304, 2, 'A3511-2303', 41, 0, NULL, 0, NULL, 0, NULL, 0, 45, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HAJD-00007)', 1, '', '2023-03-26'),
(1276, ' YL9P165039', 1, 37, 2, 'A530-MARC', 21, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '08/04/2026', 'Intel Core i3 M380 @2.53 GHz\r\n4 Go\r\n\r\n', 0, 'Utilisateur / marc23 (Marc)', '2011-03-17'),
(1277, 'R7344786', 52, 366, 2, 'sports-nature-23', 41, 0, NULL, 0, NULL, 0, NULL, 62, 29, 85, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (SAMSUNG MZVL2512HCJQ-00B00)', 3, 'Theo', '2023-04-13'),
(1278, 'R7373088', 52, 295, 2, '1716T-2304B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', '11th Gen Intel Core i3-1115G4 @ 3.00GHz\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Nathalie', '2023-04-13'),
(1279, 'MSB183N2S0102390', 16, 294, 1, 'CUBI-2304', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 117, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n500,00 Go (CT500P3SSD8)', 2, 'Cristina (Repas à domicile)', '2023-04-18'),
(1280, 'BTTN24100PSY', 47, 293, 1, 'NUC-2304', 41, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '', 1, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n1 000,00 Go (WD Blue SN570 1TB)', 3, 'AIM', '2023-04-18'),
(1281, 'DS1G019437', 1, 315, 2, 'U747', 21, 0, NULL, 0, NULL, 0, NULL, 0, 1, -1, '192.168.144.23', 0, '09/04/2026', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n1 000,00 Go (Micron Crucial X8 SSD SCSI Disk Device)\r\n1 000,00 Go (WD Blue SN570 1TB)', 0, 'Utilisateur', '2023-04-18'),
(1282, '51217B7C80251', 26, -1, 6, 'GC728X', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '', 0, '', '\r\n', 5, '', '2018-08-30'),
(1283, '5WU928DJ50A0B', 26, -1, 6, 'GS752TPv2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 46, '', 0, '', '', 5, '', '2019-06-26'),
(1284, '5WU194DWA04C3', 26, -1, 6, 'GS752TPv2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '', 5, '', '2019-06-26'),
(1285, '5WU194DDA0516', 26, -1, 6, 'GS752TPv2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 123, '', 0, '', '', 5, '', '2019-06-26'),
(1286, '5WW194D3A00C1', 26, -1, 6, 'GS728TPv2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, '', 'Hall9', 5, '', '2019-06-26'),
(1287, '5WW194DTA0412', 26, -1, 6, 'GS728TPv2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 124, '', 0, '', '', 5, '', '2019-06-26'),
(1288, '', 31, 320, 8, 'OC200', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '', 0, '', '2022-08-28'),
(1289, '4XT491EU0021E', 26, -1, 8, 'WAC505', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '', 0, '', '2019-10-29'),
(1290, '', 31, 317, 8, 'AP Secours', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '', 0, '12/03/2025', '', 2, '', '2021-01-28'),
(1291, '', 31, 317, 8, 'Expé Frigo G', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 49, '', 0, '12/03/2025', '', 2, '', '2021-01-28'),
(1292, '', 31, 317, 8, 'ADV', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '12/03/2025', '', 2, '', '2021-01-28'),
(1293, '', 31, 317, 8, 'Expé Quais', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 49, '', 0, '12/03/2025', '', 2, '', '2021-01-28'),
(1294, '221A2W9000796', 31, 318, 8, 'Accueil', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 49, '', 0, '', '', 2, '', '2022-07-25'),
(1295, 'EQAA101523', 1, 304, 2, 'A3511-2306', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, -1, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HBJD-00B00)', 1, 'Angélique (Com03)', '2023-05-30'),
(1296, 'BTWS24500JU3', 47, 293, 1, 'PC-ACCUEIL', 41, 0, NULL, 0, NULL, 0, NULL, 0, 1, 57, '', 0, '', '12th Gen Intel Core i5-1240P\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVL2256HCHQ-00B00)', 3, 'Accueil', '2023-06-01'),
(1297, 'GB23FS3', 13, 319, 2, 'L3520-2306', 41, 0, NULL, 0, NULL, 0, NULL, 63, 12, 60, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (NVMe PC SN740 NVMe WD 256GB)', 1, 'Eric Marchand (Com06)', '2023-06-02'),
(1299, 'R7423345', 52, 312, 1, 'T6000-2306A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Utilisateur10 (Nina Mannequin)', '2023-06-06'),
(1300, 'R7423349', 52, 312, 1, 'T6000-2306B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Utilisateur34 (Isabelle Dumazet)', '2023-06-06'),
(1301, 'R7423307', 52, 312, 1, 'T6000-2306C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Utilisateur61 (Ludovic Bonnaud)', '2023-06-06'),
(1302, 'R7423316', 52, 312, 1, 'T6000-2306D', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Utilisateur46 (Olivier Lory)', '2023-06-06'),
(1303, 'R7423319', 52, 312, 1, 'T6000-2306E', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Utilisateur25 (Alexandre Picard)', '2023-06-06'),
(1304, 'R7423342', 52, 312, 1, 'T6000-2306F', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Utilisateur19 (Lilian Brunaud)', '2023-06-06'),
(1305, 'R7423340', 52, 312, 1, 'T6000-2306G', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Utilisateur54 (Ligne infos déchets)', '2023-06-06'),
(1306, 'R7423332', 52, 312, 1, 'T6000-2306H', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Utilisateur53 (Frederic Petit)', '2023-06-06'),
(1307, 'R7423357', 52, 312, 1, 'TERRA-MAG', 21, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Thierry Barlaud', '2023-06-07'),
(1308, 'R7471513', 52, 295, 2, '1716T-2306', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (SAMSUNG MZVL4512HBLU-00B07)', 3, 'Céline PASQUET', '2023-06-12'),
(1309, 'R7471458', 52, 295, 2, '1716T-2306A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (SAMSUNG MZVL4512HBLU-00B07)', 3, 'Utilisateur17 (Guillaume Assimon)', '2023-06-12'),
(1310, 'R7471460', 52, 295, 2, '1716T-2306B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (SAMSUNG MZVL4512HBLU-00B07)', 3, 'Utilisateur32 (Denis Mausset)', '2023-06-12'),
(1311, 'R7476054', 52, 295, 2, '1716T-2306', 41, 0, NULL, 0, NULL, 0, NULL, 0, 16, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (SAMSUNG MZVL2512HCJQ-00B00)', 2, 'Utilisateur', '2023-06-26'),
(1312, '9S717L541050ZMC000006', 16, -1, 2, 'KATANA17-2307', 41, 0, NULL, 0, NULL, 0, NULL, 0, 16, 104, '', 0, '', '13th Gen Intel Core i7-13620H\r\n16,00 Go  @ 5600MHz\r\nIntel UHD Graphics\r\n1 024,00 Go (Micron_2400_MTFDKBA1T0QFM)', 2, 'Fred', '2023-07-25'),
(1313, '22A0QNRVBKVN8', 44, 321, 11, 'SYN1', 43, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '', 0, '', '8To Raid 10 + Hot Spare (2x5 disques)\r\n8To Raid 5 + Hot Spare (2x4 disques)\r\nIntel Xeon D-1531\r\n8 Go DDR3L', 5, '', '2023-07-26'),
(1314, '22A0QNRF9ZSMW', 44, 321, 11, 'SYN2', 43, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '', 0, '', '8To Raid 10 + Hot Spare (2x5 disques)\r\n8To Raid 5 + Hot Spare (2x4 disques)\r\nIntel Xeon D-1531\r\n8 Go DDR3L', 5, '', '2023-07-26'),
(1315, '66RE287GD0005', 26, 322, 6, 'SW1', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '', 0, '', 'Superviseur / Chave-23800', 0, '', '2023-07-26'),
(1316, '66RE287PD000C', 26, 322, 6, 'SW2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '', 0, '', 'Superviseur / Chave-23800', 0, '', '2023-07-26'),
(1317, '21A0P3N677500', 44, 323, 10, 'RT2600AC', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '192.168.1.3', 0, '', '', 2, '', '2022-12-21'),
(1318, 'EWAB010000', 1, 325, 5, 'RX1', 45, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '10.10.0.2', 0, '', 'Serveur principal du cluster Hyper-V\r\n\r\n2 x Intel Xeon Silver 4314 2.40 GHz (16 coeurs)\r\n192Go DDR4-3200 R ECC\r\n3 x SSD SATA 6G 480GB 2.5\" H-P EP (Raid 5) + 1 x SSD SATA 6G 240GB M.2 H-P \r\n2x PLAN CP 4x1Gb Intel I350-T4\r\n2x PLAN EP X710-T2L Quad port 10GBASE-T RJ45\r\n2x Modular PSU 900W titanium\r\n\r\n', 5, 'Administrateur', '2023-07-26'),
(1319, 'EWAB010001', 1, 325, 5, 'RX2', 45, 0, NULL, 0, NULL, 0, NULL, 0, 12, 50, '10.10.0.3', 0, '', 'Serveur secondaire du cluster Hyper-V\r\n\r\n2 x Intel Xeon Silver 4314 2.40 GHz (16 coeurs)\r\n192Go DDR4-3200 R ECC\r\n3 x SSD SATA 6G 480GB 2.5\" H-P EP (Raid 5) + 1 x SSD SATA 6G 240GB M.2 H-P \r\n2x PLAN CP 4x1Gb Intel I350-T4\r\n2x PLAN EP X710-T2L Quad port 10GBASE-T RJ45\r\n2x Modular PSU 900W titanium\r\n\r\n', 5, 'Administrateur', '2023-07-26'),
(1320, '14410A84600186', 33, -1, 10, 'Linksys LRT214', -1, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', '', 2, '', '2016-10-02'),
(1321, '14210S0C500912', 33, -1, 8, 'LAPN600', -1, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', '', 0, '', '2016-10-02'),
(1322, '3UH67355016B1', 26, -1, 6, 'ProSafe GS108', -1, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', '', 0, '', '2017-10-17'),
(1323, 'YMLK073920 ', 1, 236, 1, 'D538-202001', 41, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', 'Intel Core i3-9100 CPU @ 3.60GHz\r\n8,00 Go  @ 2667MHz\r\nNVIDIA GeForce GT 1030\r\n256,00 Go (SAMSUNG MZVLB256HAHQ-00000)', 3, 'Magazin', '2020-02-11'),
(1324, 'R7530861', 52, 312, 1, 'T6000-2309C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Nathalie JABLONSKI', '2023-09-06'),
(1325, 'R7530781', 52, 312, 1, 'T6000-2309A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Tanita WIBAUT', '2023-09-06'),
(1326, 'R7530842', 52, 312, 1, 'T6000-2309B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nCarte vidéo de base Microsoft\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Patrick BORDERIE', '2023-09-06'),
(1327, 'DSGS002445', 1, 328, 2, 'E4512-2310', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '', '12th Gen Intel Core i5-1235U\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (Micron_MTFDKBA512TFK-1BC15ABFA)', 3, 'Virginie', '2023-10-08'),
(1328, 'R7561965', 52, 312, 1, 'T6000-2310', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB SSD)', 3, 'M. le maire', '2023-10-22'),
(1329, 'EQAA127048', 1, 304, 2, 'A3511-2310', 41, 0, NULL, 0, NULL, 0, NULL, 0, 6, 111, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (SSSTC CL1-8D512)', 1, 'Tifaine (Hotel Lepinat)', '2023-10-30'),
(1330, 'R7606546', 52, 295, 2, 'T1716U-2311', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, -1, '', 0, '', 'Intel Core i5-1235U  @ 4.40GHz\r\n8,00 Go  DDR4\r\nIntel XE Graphics\r\n512 Go Nvme M2', 3, 'technicien SPANC', '2023-11-19'),
(1331, 'R7606563', 52, 295, 2, 'T1716U-2312', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '12th Gen Intel Core i5-1235U\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (SAMSUNG MZVL4512HBLU-00B07)', 0, 'utilisateur59 (Emilie Coutant)', '2023-12-05'),
(1332, 'R7661249', 52, 329, 2, 'T1717-2312', 41, 0, NULL, 0, NULL, 0, NULL, 19, 12, -1, '', 0, '', 'Intel® i5-1235U\r\nSSD M.2 500 Go NVMe\r\n16 Go DDR4\r\nEcran 17,3\" FHD\r\nWindows 11 Pro \r\nIntel® Iris® XE Graphics\r\n', 3, 'Yves Chavegrand', '2023-12-21'),
(1333, 'BTTN33600APG', 47, 330, 1, 'NUC11-2401', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 49, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 2667MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (SAMSUNG MZVLQ256HBJD-00B00)', 3, 'Expédition (Emb03)', '2024-01-16'),
(1334, '155507504953', 40, 299, 13, 'TAB-CS-SIG-LL', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '10th Gen Intel Core i5-1035G4 @ 1.10GHz\r\n8,00 Go @ 3700MHz\r\nIntel® Iris® Plus Graphics\r\n256,00 Go (TOSHIBA KBG40ZPZ256G)', 0, ' Utilisateur31 (Kevin Philippon)', '2024-01-18'),
(1335, '030798104753', 40, 299, 13, 'TAB-CS-SIG-SG', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '10th Gen Intel Core i5-1035G4 @ 1.10GHz\r\n8,00 Go @ 3700MHz\r\nIntel® Iris® Plus Graphics\r\n256,00 Go (TOSHIBA KBG40ZPZ256G)', 0, ' Utilisateur22 (Sébastien Givernaud)', '2024-01-18'),
(1336, 'EQAB040948', 1, 280, 2, 'A3510-2104A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '10th Gen Intel Core i5-1035G1 @ 1.00GHz\r\n16,00 Go @ 3200MHz\r\nIntel UHD Graphics\r\n500,00G Go (SAMSUNG MZVLQ512HALU-00007)', 1, ' Utilisateur7 (Séverine Cairon)', '2021-05-09'),
(1337, 'YMEB006705', 1, 154, 1, 'D556-201705-02', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '16/05/2025', '6th Gen Intel Core i3-6100 @ 3.70GHz\r\n4,00 Go @ 2100MHz\r\nIntel Graphics 530\r\n256,00 Go (Micron_1100_MTFDDAK256TBN)', 3, '', '2024-01-18'),
(1338, '002775793551', 40, 331, 13, 'SURFACE-202001-2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Pentium 4415Y @ 1.60GHz\r\n4,00 Go @ 1900MHz\r\nIntel® HD Graphics 615\r\n64,00 Go (Hynix hC8aP>)', 2, 'Stock bureau pauline', '2024-01-18'),
(1339, 'YMLE108182', 1, 234, 1, 'P558-202001', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 118, '', 0, '', ' Intel Core i3-8100 / 2.8 GHz - 4 Go DDR4 SDRAM -  2666 MHz - 1To SATA HDD - DVD - \r\n', 0, 'NOTH', '2020-01-06'),
(1340, 'NXB04EF002341067507600', 11, 332, 2, 'TMP4-2401', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', '13th Gen Intel Core i7-1355U\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (NVMe WD PC SN740 SDDQNQD-512G-1014)', 2, 'Rachel Pugnere', '2024-01-18'),
(1341, 'R7502244', 52, 312, 1, 'T6000-2401', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', 'Intel Core i5-10210U CPU @ 1.60GHz\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Elsa MONTAUDON', '2024-01-25'),
(1342, 'YLNF007688', 1, 253, 1, 'IE-BE2', 21, 0, NULL, 0, NULL, 0, NULL, 0, 38, -1, '', 0, '', 'Intel Xeon E3-1270v3 / 3.5 GHz ( 3.8 GHz ) \r\n8 Go DDR3 ECC - 1600 MHz - PC3-12800\r\n1 x SSD 128 Go - SATA 6Gb/s\r\n1 To - SATA 6Gb/s III\r\n', 0, '', '2014-01-02'),
(1343, 'YLNF007687', 1, 253, 1, 'IE-BE1', 21, 0, NULL, 0, NULL, 0, NULL, 0, 38, -1, '', 0, '', 'Intel Xeon E3-1270v3 / 3.5 GHz ( 3.8 GHz ) \r\n8 Go DDR3 ECC - 1600 MHz - PC3-12800\r\n1 x SSD 128 Go - SATA 6Gb/s\r\n1 To - SATA 6Gb/s III\r\n', 0, '', '2014-01-02'),
(1347, 'R7679227', 52, 329, 2, 'T1717-2402', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 75, '', 0, '', 'Intel® Core™ i5-1235U, SSD M.2 500Go NVMe, 8Go DDR4', 2, 'utilisateur45 (Sylvain Huguet)', '2024-02-01'),
(1345, 'EQAB122150', 1, 280, 2, 'A3510-2203', 23, 0, NULL, 0, NULL, 0, NULL, 0, 38, -1, '', 0, '21/06/24', 'Intel Core i5-1035G1  @ 1 GHz\r\n8,00 Go  @ 2133MHz\r\n256,00 Go NVMe', 1, 'Thierry Lamidieux', '2022-03-24'),
(1346, 'DSDA525053', 1, 333, 2, 'IE-BE3', 23, 0, NULL, 0, NULL, 0, NULL, 0, 38, -1, '', 0, '', 'Intel Core i5-3337U @ 1.8GHz\r\n4,00 Go   PC3-12800\r\n128,00 Go ', 1, 'Utilisateur', '2022-03-24'),
(1348, 'EQAA032893', 1, 304, 2, 'A3511-2302', 41, 0, NULL, 0, NULL, 0, NULL, 0, 38, -1, '', 0, '', 'Intel(R) Core(TM) i5-1135G7 @ 2.40GHz, 8Go DDR4, \r\nSamsung SSD 970 EVO Plus 1TB\r\n', 0, '', '2024-02-06'),
(1349, '', 54, -1, 1, 'MAIRE-SP2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, '', 0, '', 'PC du Maire / pas de Panda', 0, '', '2024-02-09'),
(1350, '', 1, 334, 1, 'DESKTOP-JKH6ICG', -1, 0, NULL, 0, NULL, 0, NULL, 0, 8, 129, '', 0, '', 'Intel Core i5-8400 CPU @ 2.80GHz\r\n8.00 Go  @ 2667MHz\r\nIntel UHD Graphics 630\r\n250.00 Go (Samsung SSD 870 EVO 250GB)', 0, '', '2024-02-09'),
(1351, '', 13, 335, 2, 'PORTABLE-MAIRIE', 41, 0, NULL, 0, NULL, 0, NULL, 0, 8, 129, '', 0, '', 'AMD Ryzen 3 3250 U, DDR4 8Go, SSD 250 GO', 0, 'Elus / Agents', '2024-02-09'),
(1352, 'J21WPZ3', 13, 336, 2, 'V3520-2402', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '12th Gen Intel Core i5-1235U\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (NVMe 2400A NVMe Micron 512GB)', 1, 'Mickaël (RH00)', '2024-02-14'),
(1353, '5CD6271CTY', 15, 337, 2, 'DESKTOP-IRPH932', 21, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '04/09/2025\r\n', 'Intel Core i5-6200U CPU @ 2.30GHz\r\n4,00 Go  @ 2133MHz\r\nIntel HD Graphics 520\r\nSSD Crucial BX500 240,00 Go S/N 2402E88DB1B2', 0, '', '2024-02-14'),
(1354, 'R7692291', 52, 312, 1, 'T6000-2403', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 5, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Sylvain Tudo', '2024-03-03'),
(1355, 'R7723730', 52, 329, 2, 'T1717-2403', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, -1, '', 0, '', '12th Gen Intel Core i5-1235U\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 0, 'Flavie', '2024-03-12'),
(1356, 'R7728131', 52, 312, 1, 'T6000-2403A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Yves Chavegrand', '2024-03-13'),
(1357, 'R7714820', 52, 312, 1, 'T6000-2403B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Angélique Petit-Pierre (Com03)', '2024-03-13'),
(1358, '6BJCGX3', 13, 339, 2, 'D5540-2403A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', '13th Gen Intel Core i5-1335U\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (NVMe PC SN740 NVMe WD 256GB)', 3, 'Céline', '2024-03-19'),
(1359, 'GLJCGX3', 13, 339, 2, 'D5540-2403B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', '13th Gen Intel Core i5-1335U\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (NVMe PC SN740 NVMe WD 256GB)', 3, 'Nathalie', '2024-03-19'),
(1360, 'K90Y32XRFW', 9, 15, 2, 'MacBook Pro Alexandre', 8, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, '', 'Apple M3\r\n8 Go DDR4\r\n512 Go ', 2, 'Alexandre / AlexChav', '2024-03-24'),
(1361, 'Y55604EF30163', 56, 385, 1, 'SER5-2403B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', 'AMD Ryzen 5 5560U\r\n8,00 Go  DDR4\r\nRADEON Graphic\r\n512 Go SSD', 3, 'Estelle (Accueil)', '2024-04-09'),
(1362, 'R7753263', 52, 312, 1, 'T6000-2404B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 9, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Corine Burdon', '2024-04-09'),
(1363, 'R7753265', 52, 312, 1, 'T6000-2404A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 8, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n8,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Billetterie', '2024-04-09'),
(1364, 'M4PTCJ00P522177', 17, 342, 1, 'ZenAIO-Pitch-2209', 44, 0, NULL, 0, NULL, 0, NULL, 0, 2, 131, '', 0, '', 'Intel Core i3-10110U CPU @ 2.10GHz\r\n4,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n256,00 Go (NVMe HFM256GDJTNG-8310A)', 0, 'Laurence Lagrange', '2022-08-31'),
(1365, '838CZ04', 13, 343, 2, 'D3540-2405', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '', '12th Gen Intel Core i5-1235U\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (NVMe P41PL NVMe SOLIDIGM 512GB)', 1, '', '2024-05-02'),
(1366, 'CND92369BM', -1, -1, 2, 'LAPTOP-TD98L3I1', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 131, '', 0, '', 'Intel Core i3-8145U CPU @ 2.10GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n1 000,00 Go (TOSHIBA MQ04ABF100)\r\n128,00 Go (SanDisk SD9SN8W-128G-1006)', 0, 'Sandy', '2024-05-05'),
(1367, 'PF26AR7Y', 4, 344, 2, 'LenovoS145-RPE-2003', 23, 0, NULL, 0, NULL, 0, NULL, 0, 2, 132, '', 0, '', 'AMD Ryzen 7 3700U with Radeon Vega Mobile Gfx  \r\n6,00 Go  @ 2400MHz\r\nAMD Radeon RX Vega 10 Graphics\r\n128,00 Go (WDC PC SN520 SDAPMUW-128G-1101)\r\n1 000,00 Go (ST1000LM035-1RK172)', 0, '', '2020-02-29'),
(1368, 'GM0GNVPC', 4, 345, 1, 'M70Q-2405A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', '13th Gen Intel Core i5-13400T\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics 730\r\n512,00 Go (SAMSUNG MZVL4512HBLU-00BL7)', 3, '', '2024-05-16'),
(1369, 'GM0GNVKW', 4, 345, 1, 'M70Q-2405B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', '13th Gen Intel Core i5-13400T\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics 730\r\n512,00 Go (SAMSUNG MZVL4512HBLU-00BL7)', 3, '', '2024-05-16'),
(1370, 'GM0GNVQ0', 4, 345, 1, 'M70Q-2405C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', '13th Gen Intel Core i5-13400T\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics 730\r\n512,00 Go (SAMSUNG MZVL4512HBLU-00BL7)', 3, '', '2024-05-16'),
(1371, 'BK33K8R23443BF', 40, 346, 13, 'SURFACE-2406', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '12th Gen Intel Core i5-1235U\r\n8,00 Go  @ 6400MHz\r\nIntel Iris Xe Graphics\r\n256,00 Go (MZ9L4256HCJQ-00BMV-SAMSUNG)', 2, 'utilisateur4 (Carlos Afonso)', '2024-06-11'),
(1372, 'R7755330', 52, 312, 1, 'T6000-2406B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '12th Gen Intel Core i5-1250P\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Utilisateur34 (Danielle Gay)', '2024-06-11'),
(1373, 'R7755318', 52, 312, 1, 'T6000-2406C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '12th Gen Intel Core i5-1250P\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Utilisateur1 (Maxime Juret)', '2024-06-11'),
(1374, 'R7796301', 52, 312, 1, 'T6000-2406A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 74, '', 0, '', '12th Gen Intel Core i5-1250P\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Utilisateur54 (Ligne Info Dechet)', '2024-06-11'),
(1375, 'BFP9Y14', 13, 336, 2, 'D3520-2406', 41, 0, NULL, 0, NULL, 0, NULL, 0, 38, -1, '', 0, '', '12th Gen Intel Core i5-1235U\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (NVMe P41PL NVMe SOLIDIGM 512GB)', 1, '', '2024-06-20'),
(1376, 'FK60F14', 13, 343, 2, 'L3540-2407', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 92, '', 0, '', 'Intel Core i5-1235U 4.4GHz 8 Go DDR4 3200MHz SSD M2 2230 512Go', 3, 'Labo ou Sabrina', '2024-07-08'),
(1377, '4PPQ824', 13, 343, 2, 'L3540-2407A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', '12th Gen Intel Core i5-1235U\r\n8,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (NVMe BM9C1 Samsung 512GB)', 3, 'utilisateur63 (Cecile Jean)', '2024-07-08'),
(1378, 'FZ8RZ24', 13, 343, 2, 'L3540-2407B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', '12th Gen Intel Core i5-1235U\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (NVMe P41PL NVMe SOLIDIGM 512GB)', 3, 'utilisateur64 (Emeline Geoffre)', '2024-07-08'),
(1379, 'DKPQ824', 13, 343, 2, 'L3540-2407', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 9, '', 0, '', 'Intel Core i5-1235U@4.4GHz 8Go DDR4 3200MHz 512Go SSD M2 2230', 3, 'Candie Guérinet', '2024-07-08'),
(1380, 'NHQM0EF019409115633400', 11, 270, 2, 'NITRO15-2409', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 88, '', 0, '', '12th Gen Intel Core i5-12450H\r\n16,00 Go  @ 4800MHz\r\nIntel UHD Graphics\r\n512,00 Go (NVMe HFS512GEJ9X125N)', 2, 'Marlène', '2024-09-01'),
(1381, '7Z2WWV3', 13, 373, 1, 'D7010-2402', 41, 0, NULL, 0, NULL, 0, NULL, 0, 7, 65, '', 0, '', 'Intel Core i5 13500 / 2.5 GHz, \r\n16 Go DDR4 SDRAM\r\nSSD 512 Go', 3, 'David (algéco)', '2024-04-18'),
(1382, 'BTTN33600AVJ', 47, 330, 1, 'NUCB11-2310', 41, 0, NULL, 0, NULL, 0, NULL, 0, 46, -1, '', 0, '', '11th Gen Intel Core i5-1135G7 @ 2.40GHz\r\n32,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n1 024,00 Go (KINGSTON SKC3000S1024G)', 3, '', '2024-09-03'),
(1394, 'PF0BBR8C', 4, 356, 2, 'DESKTOP-A9K178M', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel i5-5200U\r\n8Go RAM', 0, 'France Service', '2024-12-05'),
(1383, 'R7866930', 52, 312, 1, 'T6000-2409', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '12th Gen Intel Core i5-1240P\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Mickaël Rousseau (RH00)', '2024-09-12'),
(1384, 'YM3M131711', 1, 134, 2, 'A555-201612', 21, 0, NULL, 0, NULL, 0, NULL, 0, 5, 52, '', 0, '', 'Intel® Core i3-5005U @ 2.0 GHz\r\n500 Go - SATA III SMART\r\n4 Go DDR3L 1600 MHz @ PC3-12800\r\n', 1, '', '2016-12-14'),
(1386, 'R7904443', 52, 347, 1, 'T3000-2410B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'Intel Celeron N4505 @ 2.00GHz\r\n4,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n128,00 Go (SSD_M.2_PCIe3_128GB_InnovationIT)', 3, 'tv_visio', '2024-10-10'),
(1387, 'SH1402150803059', 55, -1, 2, 'N15C4SL128', -1, 0, NULL, 0, NULL, 0, NULL, 47, 2, 131, '', 0, '', 'Intégration CCPS le 17/10/2024\r\nIntel Celeron N4020 @1.10GHz\r\n4,00Go ram @2133MHz\r\nIntel UHD 600\r\nStockage SD 128Go Biwin', 0, '', '2021-06-15'),
(1540, 'HN2512147901701', 52, 393, 14, 'TERRA_PAD_1007', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 6789 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2030-04-06'),
(1388, 'CNJ6P34', 13, 348, 2, 'D3550-2411B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', '13th Gen Intel Core i5-1335U\r\n16,00 Go  @ 5600MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (NVMe P41PL NVMe SOLIDIGM 512GB)', 3, 'Valérie Valadeau', '2024-11-06'),
(1389, 'GLJ6P34', 13, 348, 2, 'D3550-2411A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', '13th Gen Intel Core i5-1335U\r\n16,00 Go  @ 5600MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (NVMe P41PL NVMe SOLIDIGM 512GB)', 3, 'Bruno Sinapah', '2024-11-06'),
(1390, ' YLTH330057', 1, 124, 1, 'FUJITSU-P420-3', 3, 0, NULL, 0, NULL, 0, NULL, 0, 43, -1, '', 0, '', 'Intel I5-4440\r\n4Go RAM\r\n500 Go Stockage', 0, '', '2024-11-11'),
(1391, ' R7186606', -1, -1, 5, 'SERVEUR', 45, 0, NULL, 0, NULL, 0, NULL, 0, 43, -1, '', 0, '', 'Intel(R) Xeon(R) E-2224G CPU @ 3.50GHz\r\n16Go RAM\r\n500 Go Stockage', 0, '', '2024-11-11'),
(1392, '3LZCL44', 13, 349, 2, 'D7350-2411', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, -1, '', 0, '', 'Intel Core Ultra 5 135U\r\n15,00 Go  @ 6400MHz\r\nIntel Graphics\r\n512,00 Go (NVMe PM9C1a Samsung 512GB)', 3, 'Aurélie Gainant', '2024-11-13'),
(1393, 'R7949363', 52, 350, 2, 'T1778R-2411', 41, 0, NULL, 0, NULL, 0, NULL, 0, 16, -1, '', 0, '', '13th Gen Intel Core i7-13700H\r\n16,00 Go  @ 3200MHz\r\nNVIDIA GeForce RTX 3050 Laptop GPU\r\n1 000,00 Go (Samsung SSD 980 PRO 1TB)', 3, 'Jean Bourcy', '2024-11-27'),
(1395, 'CNC1RX3', 13, 348, 2, 'L3550-2412', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', '13th Gen Intel Core i5-1335U\r\n16,00 Go  @ 5600MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (NVMe 2400A NVMe Micron 512GB)', 3, '', '2024-12-11'),
(1396, '', 48, 351, 3, 'Sharp MX-4071', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '', '', 0, '', '2024-12-22'),
(1397, '', 3, 352, 3, 'Toshiba 339CS', -1, 0, NULL, 0, NULL, 0, NULL, 0, 15, 80, '', 0, '', '', 0, '', '2024-12-22'),
(1398, 'BK334XH24403M4', 40, 353, 13, 'SURFACE-2501', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core Ultra 5 135U\r\n8,00 Go  @ 7467MHz\r\nIntel Graphics\r\n256,00 Go (SDDPTQD-256G-1124-WD)\r\n62,00 Go (USB  SanDisk 3.2Gen1 SCSI Disk Device)', 2, '', '2025-01-03'),
(1399, 'QFDWL00423G', 28, 354, 11, 'NAS-STRATEGE', -1, 0, NULL, 0, NULL, 0, NULL, 0, 47, -1, '192.168.1.144', 0, '', 'NAS STOCKAGE', 3, '', '2024-12-18'),
(1400, 'Q219B07767', 28, 201, 11, 'NAS5CD126', -1, 0, NULL, 0, NULL, 0, NULL, 0, 47, -1, '192.168.1.143', 0, '', 'Nas de Sauvegarde', 1, '', '2022-05-05'),
(1401, 'R7990776', 52, 347, 1, 'T3000-2501', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 133, '', 0, '', 'Intel Celeron N4505 @ 2.00GHz\r\n4,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n128,00 Go (SSD_M.2_PCIe3_128GB_InnovationIT_MAP)', 3, 'Hélène Faivre', '2025-01-19'),
(1402, '4B1KY64', 13, 348, 2, 'L3550-2501', 41, 0, NULL, 0, NULL, 0, NULL, 0, 6, 77, '', 0, '', '13th Gen Intel Core i5-1335U\r\n16,00 Go  @ 5600MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (NVMe EG6 KIOXIA 512GB)', 3, 'Vincent', '2025-01-29'),
(1403, '3B1KY64', 13, 348, 2, 'D3550-2502', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', '13th Gen Intel Core i5-1335U\r\n16,00 Go  @ 5600MHz\r\nIntel Iris Xe Graphics\r\n62,00 Go (USB  SanDisk 3.2Gen1 SCSI Disk Device)\r\n512,00 Go (NVMe EG6 KIOXIA 512GB)', 3, 'Magasin', '2025-02-04'),
(1404, '7DSRY64', 13, 348, 2, 'D3550-2502', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '13th Gen Intel Core i5-1335U\r\n16,00 Go  @ 5600MHz\r\nIntel Iris Xe Graphics\r\n62,00 Go (USB  SanDisk 3.2Gen1 SCSI Disk Device)\r\n512,00 Go (NVMe EG6 KIOXIA 512GB)', 3, 'utilisateur65 (Aude Lefebvre)', '2025-02-09'),
(1407, 'R7914274', 52, 312, 1, 'T6000-2503', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', 'Intel Core i5-1135G7 @ 2.40GHz\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN570 500GB)', 3, 'Jennifer Josse  (AgentPoc)', '2025-03-18'),
(1405, 'R7912835', 52, 358, 5, 'SERVER 7220 G3', 25, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '10.10.0.240', 0, '', 'Intel Xeon Silver 4214R, 12 Coeurs à 2.4GHz, 24VCPU\r\nMémoire : 64 Go (4x16 Go DDR4)\r\nStockage : 3xSSD 960Gb SAMSUNG Entreprise en RAID 5 (utile : 1,7 To)\r\nRéseau : LAN Intel 1 Gigabit 4 ports\r\n', 5, 'root / ', '2024-12-05'),
(1406, 'R7919317', 52, 358, 5, 'SERVER 7220 G3', 25, 0, NULL, 0, NULL, 0, NULL, 0, 16, -1, '', 0, '', 'Processeur : Intel Xeon Silver 4210R, 10 Coeurs à 2.4GHz, 20VCPU\r\nMémoire : 128 Go (4x32 Go DDR4)\r\nStockage : 3xSSD 1.92To SAMSUNG Entreprise en RAID 5 (utile 3,5 To)', 5, '', '2025-02-26'),
(1408, 'R8078433', 52, 359, 2, 'T1610-2503', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', '12th Gen Intel Core i5-1235U\r\n16,00 Go  @ 4267MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (AirDisk 512GB SSD)\r\n62,00 Go (USB  SanDisk 3.2Gen1 SCSI Disk Device)', 2, 'Sylvain', '2025-03-27'),
(1409, ' JM4MN64', 13, 348, 2, 'D3550-2504', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', '13th Gen Intel Core i5-1335U\r\n16,00 Go  @ 5600MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (NVMe 2500 Micron 512GB)\r\n62,00 Go (USB  SanDisk 3.2Gen1 SCSI Disk Device)', 3, '', '2025-04-01'),
(1410, 'DSAS018772', 1, 276, 2, 'GILLESB-PC', 21, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core i5-8250U CPU @ 1.60GHz\r\n16 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (MTFDDAV256TDL-1AW1ZABFA)', 3, 'MarineB', '2020-07-08'),
(1424, 'R8182309', 52, 312, 1, 'T6000C-2506A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', '13th Gen Intel Core i5-1335U\r\n16,00 Go  @ 5200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)\r\n', 2, 'Conseil', '2025-06-15'),
(1411, 'R8160756', 52, 360, 13, 'PAD1162-2505', 41, 0, NULL, 0, NULL, 0, NULL, 0, 8, -1, '', 0, '', 'Intel Celeron N5100 @ 1.10GHz\r\n4,00 Go  @ 3733MHz\r\nIntel UHD Graphics\r\n128,00 Go (BIWIN SA42W2M10-128)\r\n62,00 Go (USB  SanDisk 3.2Gen1 SCSI Disk Device)', 2, 'Cantine', '2025-05-25'),
(1412, 'R8175484', 52, 312, 1, 'T6000-2505A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1340P\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Jean Claude Chavegrand', '2025-05-26'),
(1413, 'R8175515', 52, 312, 1, 'T6000-2505B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1340P\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Helene Faivre (RH02)', '2025-05-26'),
(1414, 'R8175520', 52, 312, 1, 'T6000-2505C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1340P\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Sabrina Chavegrand (Prod03)', '2025-05-26'),
(1415, 'R8078361', 52, 362, 2, 'T1551-2505A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 135, '', 0, '', '13th Gen Intel Core i7-1355U\r\n16,00 Go  @ 5200MHz\r\nIntel UHD Graphics\r\n512,00 Go (SAMSUNG MZVL2512HCJQ-00B00)', 2, 'Joë Pouget', '2025-05-27'),
(1416, 'R8078366', 52, 362, 2, 'T1551-2505B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 135, '', 0, '', '13th Gen Intel Core i7-1355U\r\n16,00 Go  @ 5200MHz\r\nIntel UHD Graphics\r\n512,00 Go (SAMSUNG MZVL2512HCJQ-00B00)', 2, 'DST', '2025-05-27'),
(1418, 'R8175511', 52, 312, 1, 'T6000-2505D', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1340P\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Alexandre Chavegrand (Alexandre)', '2025-05-26'),
(1419, 'R8175482', 52, 312, 1, 'T6000-2505E', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1340P\r\n16,00 Go  @ 3200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 3, 'Yannick (LTC01)', '2025-05-26'),
(1420, 'R8118383', 52, 296, 1, 'T5000-2506', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core 3 100U\r\n8,00 Go  @ 5600MHz\r\nIntel Graphics\r\n500,00 Go (WD Blue SN580 500GB)\r\n62,00 Go (USB  SanDisk 3.2Gen1 SCSI Disk Device)', 3, 'Stagiaire', '2025-06-01'),
(1421, 'R8171709', 52, 359, 2, 'T1610-2506A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 135, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (HighRel 512GB SSD)', 2, 'Isabelle Pradeau', '2025-06-05'),
(1422, 'R8207780', 52, 361, 2, 'T1500-2506A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 134, '', 0, '', 'AMD Ryzen 5 7430U with Radeon Graphics \r\n15,00 Go  @ 3200MHz\r\nAMD Radeon  Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 2, 'Mme Canard', '2025-06-05'),
(1423, 'R8207753', 52, 361, 2, 'T1500-2506B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 134, '', 0, '', 'AMD Ryzen 5 7430U with Radeon Graphics         \r\n15,00 Go  @ 3200MHz\r\nAMD Radeon  Graphics\r\n500,00 Go (WD Blue SN580 500GB)\r\n62,00 Go (USB  SanDisk 3.2Gen1 SCSI Disk Device)', 2, 'Mme Michaudon', '2025-06-09'),
(1425, 'R8182292', 52, 312, 1, 'T6000C-2506B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, -1, '', 0, '', '13th Gen Intel Core i5-1335U\r\n16,00 Go  @ 5200MHz\r\nIntel Iris Xe Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 2, 'Tiphanie GOURINCHAS', '2025-06-15'),
(1426, 'R8171745', 52, 359, 2, 'T1610-2506B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 135, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n512,00 Go (HighRel 512GB SSD)', 2, 'Frédéric Chabernaud', '2025-06-05'),
(1427, 'R8249733', 52, 363, 2, 'T1471-2508', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', 'Intel Core Ultra 5 125U\r\n15,00 Go  @ 5600MHz\r\nIntel Graphics\r\n500,00 Go (WD Blue SN580 500GB)', 2, 'Hélène Faivre', '2025-08-21'),
(1428, 'YMLE209058', 1, 234, 1, 'P558-202001', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 85, '', 0, '', 'Intel Core i5 8400 / 2.8 GHz (4 GHz) (6 cœurs)\r\n8 Go DDR4 SDRAM 2666 MHz\r\nSSD 256 Go M.2 - NVMe\r\nIntel HD Graphics 630\r\n', 1, 'Sandrine ?', '2020-01-22'),
(1429, 'R8265861', 52, 364, 1, 'T6000C-2507', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', '13th Gen Intel Core i5-1334U\r\nDDR5 16,00 Go  @ 5200MHz\r\n500,00 Go (WD Blue SN580 500GB)', 2, 'Nadege', '2025-07-16'),
(1430, 'R8131768', 52, 365, 2, 'T1516R-2507', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 85, '', 0, '', '3th Gen Intel Core i5-1334U\r\n16,00 Go  @ 3200MHz\r\n1 To (SAMSUNG MZVL21T0HCLR-00B00)', 2, 'Justine', '2025-07-17'),
(1431, 'R7797074', 52, 367, 2, 'T1517-2406B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 112, '', 0, '', 'i5-1235U 12th Gen Intel(R) Core(TM)\r\n8 Go DDR4\r\n500 Go SSD - M.2 NVMe', 2, 'ALSH', '2025-09-25'),
(1432, 'R8335992', 52, 312, 1, 'T6000-2509', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', 'Intel Core Ultra 5 125H\r\n16,00 Go  @ 4800MHz\r\nIntel Arc Graphics\r\n500,00 Go (WD Blue SN5000 500GB)', 3, 'Mickael Jingeaud (Magasin)', '2025-09-25'),
(1433, 'R8394186', 52, 368, 2, 'T1517R-2509A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n1 024,00 Go (SAMSUNG MZVMX1T0HCLD-00B00)', 2, 'Jordan Ribault', '2025-09-28'),
(1434, 'R8394129', 52, 368, 2, 'T1517R-2509B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, 11, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n1 024,00 Go (SAMSUNG MZVMX1T0HCLD-00B00)', 2, 'Alexandre richard', '2025-09-28'),
(1435, 'CZC2017LNL', 15, 370, 1, 'DESKTOP-8D0BS8R', 44, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i7-10700 CPU @ 2.90GHz \r\n32,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n512,00 Go (SAMSUNG MZVLQ512HBLU-00BH1)', 0, 'gamer / mjc3680 | PointCyb3680', '2025-09-29'),
(1436, 'CZC2017LNM', 15, 370, 1, 'DESKTOP-AOI9KDS', 44, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i7-10700 CPU @ 2.90GHz \r\n32,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n512,00 Go (SAMSUNG MZVLQ512HBLU-00BH1)', 0, 'gamer / mjc3680 | PointCyb3680', '2025-09-29'),
(1437, 'CZC2017LPT', 15, 370, 1, 'DESKTOP-EVM8KID', 44, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i7-10700 CPU @ 2.90GHz \r\n32,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n512,00 Go (SAMSUNG MZVLQ512HBLU-00BH1)', 0, 'gamer / mjc3680 | PointCyb3680', '2025-09-29'),
(1438, 'CZC2017LQ0', 15, 370, 1, 'DESKTOP-OS58HLS', 44, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i7-10700 CPU @ 2.90GHz \r\n32,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n512,00 Go (SAMSUNG MZVLQ512HBLU-00BH1)', 0, 'gamer / mjc3680 | PointCyb3680', '2025-09-29'),
(1439, 'CZC2017LR6', 15, 370, 1, 'DESKTOP-OS58HLS', 44, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', 'Intel Core i7-10700 CPU @ 2.90GHz \r\n32,00 Go  @ 3200MHz\r\nIntel UHD Graphics 630\r\n512,00 Go (SAMSUNG MZVLQ512HBLU-00BH1)', 0, 'gamer / mjc3680 | PointCyb3680', '2025-09-29'),
(1440, 'YL8F006214', 1, 80, 11, 'NAS-MJC', 43, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', '', 0, '', '2011-02-08'),
(1442, '2Q660B4', 13, 371, 2, 'D16250-2510A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '', 'Intel Core 5 120U\r\n16,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (NVMe PC SN5000S WD 512GB)', 3, 'Virginie Loulergue', '2025-10-09'),
(1443, '7P660B4', 13, 371, 2, 'D16250-2510B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '', 'Intel Core 5 120U\r\n16,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (NVMe PC SN5000S WD 512GB)', 3, 'Marion Texier', '2025-10-09'),
(1444, '6L660B4', 13, 371, 2, 'D16250-2510C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '', 'Intel Core 5 120U\r\n16,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (NVMe PC SN5000S WD 512GB)', 3, 'Jude Peltreau', '2025-10-09'),
(1445, '3K2KW94', 13, 371, 2, 'D16250-2510D', 41, 0, NULL, 0, NULL, 0, NULL, 0, 15, 81, '', 0, '', 'Intel Core 5 120U\r\n16,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (NVMe PC SN5000S WD 512GB)', 3, 'Florent Pailler', '2025-10-09'),
(1446, 'R8097016', 52, 372, 5, 'Plasti23SRV', 46, 0, NULL, 0, NULL, 0, NULL, 0, 7, 99, '10.15.10.128', 0, '', 'Intel Xeon E-2434 (4x 3.4 GHz)\r\n32 Go DDR5 PC4800 ECC\r\nIntel HD Graphics P4600\r\n2 x SSD 2.5\" SATA3 960GB / TLC RAID1', 3, 'Administrateur', '2025-09-14'),
(1447, 'R8213818', 52, 374, 13, 'PAD1262-2507A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '12th Gen Intel Core i5-1230U\r\n8,00 Go  @ 6400MHz\r\n512,00 Go (FORESEE XP2000G512G)', 2, 'Utilisateur29 (Pierre Desvilette)', '2025-07-28'),
(1448, ' R8213819', 52, 374, 13, 'PAD1262-2507B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '12th Gen Intel Core i5-1230U\r\n8,00 Go  @ 6400MHz\r\n512,00 Go (FORESEE XP2000G512G)', 2, 'Utilisateur56 (Alex - Controleur Spanc)', '2025-07-28'),
(1449, ' R8213741', 52, 374, 13, 'PAD1262-2507C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '12th Gen Intel Core i5-1230U\r\n8,00 Go  @ 6400MHz\r\n512,00 Go (FORESEE XP2000G512G)', 2, 'Utilisateur30 (Coralie Philippon)', '2025-07-28');
INSERT INTO `ouapi_hardware` (`id`, `num_serie`, `marque_id`, `modele_id`, `type_id`, `nom`, `os_id`, `cpu_id`, `ram_capacite`, `ram_type_id`, `disque_capacite`, `disque_type_id`, `service_pack`, `user_id`, `agence_id`, `emplacement_id`, `ip`, `reservable`, `suivi_rebus`, `commentaire`, `pfield_garantie`, `pfield_utilisateurprinc`, `creation_date`) VALUES
(1450, 'R8213776', 52, 374, 13, 'PAD1262-2507D', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '12th Gen Intel Core i5-1230U\r\n8,00 Go  @ 6400MHz\r\n512,00 Go (FORESEE XP2000G512G)', 2, 'Utilisateur44 ( Emmanuel Briat)', '2025-07-28'),
(1451, 'R8243167', 52, 375, 2, 'T1717R-2507A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 76, '', 0, '', '13th Gen Intel Core i7-1355U\r\n16,00 Go  @ 3200MHz\r\n1To (WD Blue SN580 1TB)', 2, 'Utilisateur26 (Paméla Guionie)', '2025-07-03'),
(1452, 'R8243166', 52, 375, 2, 'T1717R-2507B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, -1, '', 0, '', '13th Gen Intel Core i7-1355U\r\n16,00 Go  @ 3200MHz\r\n1To (WD Blue SN580 1TB)', 2, 'Utilisateur35 (Laurence Dalageteiton)', '2025-07-03'),
(1453, 'R8192566', 52, 364, 1, 'T6000C-2506A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '13th Gen Intel(R) Core(TM) i5-1335U\r\n16 Go - DDR5 5600MHz\r\nSSD 512 Go - M.2 NVMe ', 2, 'Utilisateur20 (Marie Beaubrun)', '2025-06-06'),
(1454, 'R8192707', 52, 364, 1, 'T6000C-2506B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '13th Gen Intel(R) Core(TM) i5-1335U\r\n16 Go - DDR5 5600MHz\r\nSSD 512 Go - M.2 NVMe ', 2, 'Utilisateur16 (Chloé Montagnac)', '2025-06-06'),
(1455, 'R8210608', 52, 376, 1, ' T7000-2506', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', '13th Gen Intel(R) Core(TM) i7-1360P\r\n16 Go - DDR4 3200MHz\r\nSSD 500 Go - M.2 NVMe ', 3, 'Utilisateur36 (Joanne l\'Huguenot)', '2025-07-10'),
(1456, 'R8359806', 52, 377, 1, 'TSTATION-2509', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'AMD Ryzen 5 9600X\r\n32 Go DDR5 PC5600\r\n1 To SSD M.2 NVMe\r\n', 3, 'Utilisateur15 (Victor  Montigny)', '2025-09-29'),
(1457, 'R8322214', 52, 364, 1, 'T6000C-2510A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (Phison ESO512GHLCA1-E9C)', 2, 'Nadine', '2025-10-31'),
(1458, 'R8322077', 52, 364, 1, 'T6000C-2510B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (Phison ESO512GHLCA1-E9C)', 2, 'Compta (Christelle)', '2025-10-31'),
(1459, 'R8321554', 52, 364, 1, 'T6000C-2510C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 9, -1, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (Phison ESO512GHLCA1-E9C)', 2, 'Accueil', '2025-10-31'),
(1460, 'R8356013', 52, 364, 1, 'T6000C-2511', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (Phison ESO512GHLCA1-E9C)', 2, 'Marc Chavegrand (Prod01)', '2025-11-14'),
(1461, 'PF52YLGB', 4, 379, 2, 'LE16-2507A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core Ultra 7 155H\r\n15,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (SAMSUNG MZAL8512HDLU-00BLL)', 3, '', '2025-07-23'),
(1462, 'PF52Z1GA', 4, 379, 2, 'LE16-2507B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core Ultra 7 155H\r\n15,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (SAMSUNG MZAL8512HDLU-00BLL)', 3, '', '2025-07-23'),
(1463, 'PF52YEKK', 4, 379, 2, 'LE16-2507C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core Ultra 7 155H\r\n15,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (SAMSUNG MZAL8512HDLU-00BLL)', 3, 'Yves Prevot', '2025-07-23'),
(1464, 'QT3YW07615C', 28, 380, 11, 'NAS-PLASTI23', 43, 0, NULL, 0, NULL, 0, NULL, 0, 7, 99, '192.168.1.199', 0, '', 'CPU : Intel Celeron J6412\r\nMémoire : 8 Go\r\nCapacité : 2 x 4To RAID1\r\nDD1 : WD40EFRX-68N32N0 (No  série : WD-WCC7K2SFZD0U)\r\nDD2 : WD40EFRX-68N32N0 (No  série : WD-WCC7K3PD45A6)', 2, 'Superviseur', '2025-11-25'),
(1465, 'R8469482', 52, 361, 2, 'T1500P-2511', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 6, '', 0, '', 'AMD Ryzen 5 7430U with Radeon Graphics         \r\n15,00 Go  @ 3200MHz\r\nAMD Radeon  Graphics\r\n500,00 Go (WD Blue SN5000 500GB)', 2, 'AAGDV', '2025-11-19'),
(1467, 'R8491036', 52, 381, 2, 'T1551R-2512', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WD Blue SN5100 500GB)', 2, 'Coline (Prod12)', '2025-12-22'),
(1468, 'YMLE210153', 1, 234, 1, 'P558-202003', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', ' Intel Core  i5 8400 / 2.8 GHz - 8 Go DDR4 SDRAM -  2666 MHz - 256 Go SDD - DVD - \r\n', 0, 'Florian', '2020-03-05'),
(1469, 'QU94800288W', 28, 380, 11, 'NAS-Peps', 43, 0, NULL, 0, NULL, 0, NULL, 0, 2, 9, '', 0, '', '2 x 4To Raid 1\r\nIntel Celeron J6412 (double cœur)', 1, '', '2025-10-16'),
(1470, 'QWTS408317R', 28, 383, 11, 'NAS-Sauv', 43, 0, NULL, 0, NULL, 0, NULL, 0, 2, 63, '', 0, '', '2 x 4 To Raid 1\r\nIntel Celeron N5095 (quadricœur)', 3, '', '2025-06-03'),
(1471, 'R8512291', 52, 365, 2, 'T1516R-2601', 41, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n1 000,00 Go (WD Blue SN5100 1TB)', 2, 'Didier Lucas', '2026-01-08'),
(1472, 'R8389311', 52, 364, 1, 'T6000C-2601A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (Phison ESO512GHLCA1-E9C)', 2, 'Jeremy Cagnet (Prod 14)', '2026-01-14'),
(1473, 'R83893330', 52, 364, 1, 'T6000C-2601B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel Iris Xe Graphics\r\n512,00 Go (Phison ESO512GHLCA1-E9C)', 2, 'Carole Christophe (Prod13)', '2026-01-14'),
(1474, 'R8491016', 52, 381, 2, 'T1551R-2602', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WD Blue SN5100 500GB)', 2, 'Adélaïde Pailler', '2026-02-09'),
(1475, 'R8573614', 52, 384, 1, 'T7610-2602', 41, 0, NULL, 0, NULL, 0, NULL, 0, 17, -1, '', 0, '', 'AMD Ryzen 5 9600X 6-Core Processor             \r\n31,00 Go  @ 5600MHz\r\nNVIDIA RTX 2000 Ada Generation\r\n1 000,00 Go (WD_BLACK SN8100 1000GB)', 3, 'François', '2026-02-11'),
(1476, 'R8491053', 52, 381, 2, 'T1551R-2602', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 112, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WD Blue SN5100 500GB)', 2, 'Laetitia CHARRIER', '2026-02-13'),
(1477, 'PF5X0K2Q', 4, 379, 2, 'LTE16-2602A', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core Ultra 5 225U\r\n15,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (UMIS RPJYJ512MML1QWQ)', 3, '', '2026-02-18'),
(1478, 'PF5XF21N', 4, 379, 2, 'LTE16-2602B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core Ultra 5 225U\r\n15,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (UMIS RPJYJ512MML1QWQ)', 3, '', '2026-02-18'),
(1479, 'PF5X0RL7', 4, 379, 2, 'LTE16-2602C', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core Ultra 5 225U\r\n15,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (UMIS RPJYJ512MML1QWQ)', 3, '', '2026-02-18'),
(1480, 'PF5X3GG5', 4, 379, 2, 'LTE16-2602D', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core Ultra 5 225U\r\n15,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (UMIS RPJYJ512MML1QWQ)', 3, '', '2026-02-18'),
(1481, 'PF5WXMGN', 4, 379, 2, 'LTE16-2602E', 41, 0, NULL, 0, NULL, 0, NULL, 0, 3, -1, '', 0, '', 'Intel Core Ultra 5 225U\r\n15,00 Go  @ 5600MHz\r\nIntel Graphics\r\n512,00 Go (UMIS RPJYJ512MML1QWQ)', 3, '', '2026-02-18'),
(1482, 'R8490986', 52, 381, 2, 'T1551R-2602B', 41, 0, NULL, 0, NULL, 0, NULL, 0, 2, 7, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WD Blue SN5100 500GB)', 2, 'Victor Fleury (Sce communication)', '2026-02-19'),
(1483, 'R8490988', 52, 381, 2, 'T1551R-2603', 41, 0, NULL, 0, NULL, 0, NULL, 0, 12, 60, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WD Blue SN5100 500GB)', 2, 'Valérie Rahon (Prod00)', '2026-02-23'),
(1484, 'R8580927', 52, 386, 2, 'T1610M-2602', 41, 0, NULL, 0, NULL, 0, NULL, 0, 6, -1, '', 0, '', 'Intel Core Ultra 5 125U\r\n16,00 Go  @ 4800MHz\r\nIntel Graphics\r\n512,00 Go (BIWIN NA80S1M21-512G)', 2, 'Pauline', '2026-02-24'),
(1485, 'E81437A3H262452 ', -1, -1, 3, 'MFC-J5740DW', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 132, '', 0, '', '', 2, '', '2023-06-29'),
(1486, 'E77439L8J328663', -1, -1, 3, 'MFC-L8690CDW', -1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 131, '10.10.0.62', 0, '', '', 2, '', '2019-02-04'),
(1487, 'R8561201', 52, 361, 2, 'T1500P-2602', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '', 'AMD Ryzen 5 7430U with Radeon Graphics         \r\n15,00 Go  @ 3200MHz\r\nAMD Radeon  Graphics\r\n500,00 Go (WD Blue SN5100 500GB)', 2, 'Vendeur Seilhac', '2026-02-26'),
(1488, 'R8557774', 52, 375, 2, 'T1717R-2602', 41, 0, NULL, 0, NULL, 0, NULL, 0, 4, -1, '', 0, '', '13th Gen Intel Core i7-1355U\r\n16,00 Go  @ 3200MHz\r\nIntel UHD Graphics\r\n1 000,00 Go (WD Blue SN5100 1TB)', 2, 'Arnaud Maridat', '2026-02-26'),
(1489, 'R8617569', 52, 377, 1, 'TSTATION-2603', 41, 0, NULL, 0, NULL, 0, NULL, 0, 21, 73, '', 0, '', 'AMD Ryzen 7 8700G w/ Radeon 780M Graphics      \r\n31,00 Go  @ 5600MHz\r\nAMD Radeon PRO W7500\r\n1 000,00 Go (WD Blue SN5100 1TB)\r\n', 3, 'Utilisateur51 (Pauline Jay)', '2026-03-25'),
(1490, '', 31, -1, 10, 'ER707-M2', -1, 0, NULL, 0, NULL, 0, NULL, 0, 12, 46, '192.168.1.2', 0, '', '', 2, 'Omada', '2024-08-05'),
(1491, 'Q217B12527', 28, 284, 11, 'StockAIM-3', 43, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '10.12.71.74', 0, '', '4x2To Raid 10 (ST2000VN004) 3.62To\r\nAnnapurna Labs Alpine AL-314 \r\n2Go DDR3\r\n', 3, '', '2021-11-17'),
(1492, 'R8597496', 52, 381, 2, 'T1551R-2604', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 135, '', 0, '', '13th Gen Intel Core i5-1334U\r\n16,00 Go  @ 5200MHz\r\nIntel UHD Graphics\r\n500,00 Go (WD Blue SN5100 500GB)', 2, 'Karine Berthier', '2026-04-07'),
(1493, 'R8210576', 52, 376, 1, 'T7000-2507', 41, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '', 0, '', '13th Gen Intel(R) Core(TM) i7-1360P\r\n16 Go DDR4 3,2 GHz\r\nSN580 500GB', 2, 'Marie', '2026-04-08'),
(1494, ' R8473235', 52, 387, 2, 'T1671L-2601', 41, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '', 0, '', 'Intel(R) Core(TM) Ultra 7 258V\r\n32 Go DDR5 8500Ghz\r\nWD Blue SN5100 1TB', 2, 'Christophe', '2026-04-08'),
(1496, 'R8601577', 52, 361, 2, 'T1500P-2604', 41, 0, NULL, 0, NULL, 0, NULL, 0, 29, 79, '', 0, '', 'AMD Ryzen 5 7430U with Radeon Graphics\r\n\r\n15.00 Go @3200MHz\r\nAMD Radeon Graphics\r\n500.00 Go (WD Blue SN5100 500GB)', 2, 'Zoé', '2026-04-14'),
(1497, '224C230007793', 31, 388, 8, 'EAP653 - ATELIER', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 56, '', 0, '', '', 2, '', '2026-04-16'),
(1498, '', 31, 388, 8, 'EAP653 - ETAGE', -1, 0, NULL, 0, NULL, 0, NULL, 0, 1, 58, '', 0, '', '', 2, '', '2026-04-16'),
(1499, '2172527', 40, 244, 13, 'Blablabla', 46, 0, NULL, 0, NULL, 0, NULL, 0, 48, 138, '', 0, '', 'Intel Core.....', 2, 'Moi', '2026-04-20'),
(1500, 'R8601577', 56, 385, 1, 'WAC505', 19, 0, NULL, 0, NULL, 0, NULL, 0, 48, 140, '', 0, '', 'Blablabla', 0, 'Moi', '2026-04-20'),
(1505, '567898UYGHY', 15, 61, 3, 'HP DJ-SNAKE', 17, 0, NULL, 0, NULL, 0, NULL, 0, 48, 140, '192.168.0.1', 0, '', 'Biblibli', 0, 'Moi', '2026-04-21'),
(1502, '2345T6Y7UI', 25, 151, 5, 'Serveur', -1, 0, NULL, 0, NULL, 0, NULL, 0, 48, 140, '192.168.0.0', 0, '', '', 0, 'Moi', '2026-04-20'),
(1503, '456789O', 11, 97, 11, 'NAS', -1, 0, NULL, 0, NULL, 0, NULL, 0, 48, -1, '192.168.0.100', 0, '', '', 0, '', '2026-04-20'),
(1504, '4XT178EJ00ADF', 9, 15, 1, 'AdminPoste', 8, 0, NULL, 0, NULL, 0, NULL, 0, 48, 141, '192.168.0.0', 1, '', 'Bloubloublou', 1, 'Pas moi', '2026-04-20'),
(1506, 'HN2412140600096', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1507, 'NXEFREF0049520BBE93400', 11, 390, 2, 'PCA2', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 135, '', 0, '', 'Intel Core i5-8265U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (HFM256GDJTNG-8310A)', 2, 'PC Adjoints', '2019-12-25'),
(1508, '2YLML73', 13, 391, 2, 'INSPIRON3593-2011A ', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 143, '', 0, '', 'Intel Core i3-1005G1 CPU @ 1.20GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n256,00 Go (IM2P33F3 NVMe ADATA 256GB)', 2, 'CTM', '2020-10-31'),
(1509, 'GW4PK73', 13, 391, 2, 'INSPIRON3593-2011B', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 143, '', 0, '', 'Intel Core i3-1005G1 CPU @ 1.20GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n256,00 Go (IM2P33F3 NVMe ADATA 256GB)', 2, 'CTM', '2020-10-31'),
(1510, 'KCNXCV013342499', 17, 392, 2, 'PCA11 ', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 135, '', 0, '', 'Intel Core i5-8265U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (KINGSTON RBUSNS8154P3256GJ3)', 2, 'PC prêt', '2019-05-31'),
(1511, 'KCNXCV013332496', 17, 392, 2, ' X512FA-1906', 41, 0, NULL, 0, NULL, 0, NULL, 0, 42, 135, '', 0, '', 'Intel Core i5-8265U CPU @ 1.60GHz\r\n8,00 Go  @ 2400MHz\r\nIntel UHD Graphics 620\r\n256,00 Go (KINGSTON RBUSNS8154P3256GJ3)', 2, 'PC prêt', '2019-05-31'),
(1512, '', 13, 391, 2, 'INSPIRON3593-2011C', 44, 0, NULL, 0, NULL, 0, NULL, 0, 42, 143, '', 0, '', 'Intel Core i3-1005G1 CPU @ 1.20GHz\r\n8,00 Go  @ 2667MHz\r\nIntel UHD Graphics\r\n256,00 Go (IM2P33F3 NVMe ADATA 256GB)', 2, 'CTM', '2020-10-31'),
(1514, 'HN2412140600379', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1515, 'HN2412140600703', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1516, 'HN2412140600753', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1517, 'HN2412140600824', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1519, 'HN2412140600850', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1520, 'HN2412140600860', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1521, 'HN2412140600865', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1522, 'HN2412140600868', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1523, 'HN2412140600887', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1524, 'HN2412140600826', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1525, 'HN2412140600895', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1526, 'HN2412140600899', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1527, 'HN2412140600913', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1528, 'HN2412140600931', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1529, 'HN2412140600934', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1530, 'HN2412140600948', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1531, 'HN2412140600956', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1532, 'HN2412140600971', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1533, 'HN2412140600973', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1534, 'HN2412140600979', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1535, 'HN2412140600990', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1536, 'HN2412140601002', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1537, 'HN2502011200362', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1538, 'HN2502011200521', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1539, 'HN2502011200607', 52, 389, 14, 'TERRA_PAD_1201', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 8781 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2026-03-31'),
(1541, 'HN2512147901702', 52, 393, 14, 'TERRA_PAD_1007', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 6789 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2030-04-06'),
(1542, 'HN2512147901706', 52, 393, 14, 'TERRA_PAD_1007', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 6789 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2030-04-06'),
(1543, 'HN2512147901710', 52, 393, 14, 'TERRA_PAD_1007', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 6789 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2030-04-06'),
(1544, 'HN2512147901935', 52, 393, 14, 'TERRA_PAD_1007', 40, 0, NULL, 0, NULL, 0, NULL, 0, 42, 142, '', 0, '', 'MTK 6789 G99, Octa Core\r\n8 Go\r\n256 Go', 2, '', '2030-04-06');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_hard_soft`
--

CREATE TABLE `ouapi_hard_soft` (
  `id` int NOT NULL,
  `hardware_id` int NOT NULL,
  `software_id` int NOT NULL,
  `version_date_maj` date DEFAULT NULL,
  `version_num` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_maj_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_hard_soft`
--

INSERT INTO `ouapi_hard_soft` (`id`, `hardware_id`, `software_id`, `version_date_maj`, `version_num`, `user_maj_id`) VALUES
(2, 1504, 1, '1970-01-01', '123456', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ha_marque`
--

CREATE TABLE `ouapi_ha_marque` (
  `id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_ha_marque`
--

INSERT INTO `ouapi_ha_marque` (`id`, `libelle`) VALUES
(1, 'FUJITSU'),
(2, 'SAMSUNG'),
(3, 'TOSHIBA'),
(4, 'LENOVO'),
(5, 'NEC'),
(6, 'Assembleur divers'),
(7, 'BROTHER'),
(8, 'TEK1'),
(9, 'APPLE'),
(10, 'SOLTEK'),
(11, 'ACER'),
(12, 'HYUNDAI'),
(13, 'DELL'),
(14, 'OKI'),
(15, 'HP'),
(16, 'MSI'),
(17, 'ASUS'),
(18, 'SHUTTLE'),
(19, 'IBM'),
(20, 'PACKARD BELL'),
(21, 'COMPAQ'),
(22, 'A.I.M.'),
(23, 'ORANGE'),
(24, 'IOMEGA'),
(25, 'D-LINK'),
(26, 'NETGEAR'),
(27, 'ZYXEL'),
(28, 'QNAP'),
(29, 'LEXMARK'),
(30, 'KONIKA MINOLTA'),
(31, 'TP-LINK'),
(32, 'OPTOMA'),
(33, 'LINKSYS'),
(34, 'KYOCERA'),
(35, 'SAGEMCOM'),
(36, 'EATON'),
(53, 'NCPI'),
(43, 'EPSON'),
(40, 'MICROSOFT'),
(41, 'CANON'),
(42, 'RICOH'),
(44, 'SYNOLOGY'),
(48, 'SHARP'),
(54, 'ELITEGROUP'),
(47, 'INTEL'),
(49, 'NRG'),
(51, 'UBIQUITI'),
(52, 'TERRA'),
(55, 'THOMSON'),
(56, 'AMAZON');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ha_modele`
--

CREATE TABLE `ouapi_ha_modele` (
  `id` int NOT NULL,
  `marque_id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'Image path'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_ha_modele`
--

INSERT INTO `ouapi_ha_modele` (`id`, `marque_id`, `libelle`, `img_path`) VALUES
(1, 1, 'P2540', NULL),
(2, 1, 'P2440', NULL),
(3, 1, 'P2560', NULL),
(4, 1, 'P2760', NULL),
(5, 2, 'R540', NULL),
(6, 2, 'R730', NULL),
(7, 5, 'VL360', NULL),
(8, 5, 'VL480', NULL),
(9, 6, 'Poste divers', NULL),
(10, 5, 'VL260', NULL),
(11, 1, 'P2550', NULL),
(12, 8, 'MINI-K', NULL),
(13, 5, 'Versa M370', NULL),
(14, 3, 'Satellite Pro P300-272', NULL),
(15, 9, 'MacBoock Pro', NULL),
(16, 2, 'R519', NULL),
(17, 10, 'QBIC EQ3505', NULL),
(101, 7, 'QL-560', NULL),
(19, 11, 'AcerPower F6', NULL),
(20, 18, 'Yatoo SN41G2', NULL),
(21, 2, 'R780', NULL),
(22, 11, 'Aspire 3005 WLMI', NULL),
(23, 5, 'Si1310', NULL),
(24, 5, 'VL280', NULL),
(25, 1, 'Primergy TX100', NULL),
(26, 13, 'PowerEdge R510', NULL),
(27, 7, 'QL-1060N', NULL),
(28, 14, 'B411D', NULL),
(29, 11, 'AcerPower F5', NULL),
(30, 13, 'Optiplex GX520', NULL),
(31, 13, 'Optiplex 745 MT', NULL),
(32, 13, 'PowerEdge SC440', NULL),
(33, 13, 'Latitude D520', NULL),
(34, 5, 'Latitude 630', NULL),
(35, 5, 'VersaOne', NULL),
(36, 1, 'Esprimo Mobile V6535', NULL),
(37, 1, 'Lifebook A530', NULL),
(38, 7, 'HL-5270dn & LT5300', NULL),
(39, 15, 'LaserJet 2300dtn', NULL),
(40, 14, 'MC160n', NULL),
(41, 14, 'C5650n', NULL),
(42, 9, 'iMac 24\'', NULL),
(43, 6, 'Intel Value v5 Pro', NULL),
(44, 9, 'iMac 20\"', NULL),
(45, 16, 'EX705-245', NULL),
(46, 5, 'Si1520', NULL),
(47, 17, 'VINTAGE PE1', NULL),
(48, 11, 'TravelMate 4233WLMi', NULL),
(49, 13, 'Optiplex GX260', NULL),
(50, 11, 'Veriton 6800', NULL),
(51, 11, 'Veriton 7700G', NULL),
(52, 11, 'Veriton 7800', NULL),
(53, 13, 'PowerEdge SC1420 SCSI', NULL),
(54, 1, 'Primergy TX300', NULL),
(55, 2, 'R580', NULL),
(56, 18, 'ST61G4', NULL),
(57, 13, 'Inspiron 1300', NULL),
(58, 15, 'DC 7500', NULL),
(59, 21, '6710b', NULL),
(60, 15, 'DX2000 MT', NULL),
(61, 15, 'DC 5700', NULL),
(62, 15, 'NC6120', NULL),
(63, 3, 'Satellite Pro A300-2C8', NULL),
(64, 20, 'Imedia S1300', NULL),
(65, 20, 'Imedia S3720', NULL),
(66, 1, 'Scaleo 600', NULL),
(67, 15, 'P6138FR', NULL),
(68, 15, '5008 MT', NULL),
(69, 15, 'Prolian ML110', NULL),
(70, 1, 'Lifebook E5731', NULL),
(71, 1, 'Primergy TX200', NULL),
(72, 1, 'Primergy TX150', NULL),
(73, 2, 'Serie 3', NULL),
(74, 14, 'B710dn', NULL),
(75, 1, 'Lifebook A531', NULL),
(76, 1, 'Lifebook S761', NULL),
(77, 1, 'E3521', NULL),
(78, 1, 'Lifebook AH531', NULL),
(79, 6, 'VALUE INTEL V4', NULL),
(80, 1, 'Celvin Q700', NULL),
(81, 1, 'P700', NULL),
(82, 1, 'Primergy Econel 50', NULL),
(123, 1, 'A525-L', NULL),
(84, 15, 'Pro 3015MT', NULL),
(85, 1, 'P5905', NULL),
(86, 21, '500B MT', NULL),
(87, 13, 'Optiplex 170L', NULL),
(88, 11, 'TravelMate 6293', NULL),
(100, 14, 'C310', NULL),
(90, 5, 'D5001', NULL),
(91, 13, 'Vostro 1700', NULL),
(92, 52, 'Terra Computer', NULL),
(93, 15, 'Pro 3010 MT', NULL),
(95, 1, 'P9900', NULL),
(96, 5, 'P9110', NULL),
(97, 11, 'AcerPower M6', NULL),
(98, 11, 'AcerPower M8', NULL),
(102, 1, 'P400', NULL),
(103, 20, 'Imedia S3840', NULL),
(104, 23, 'Livebox Residentielle', NULL),
(105, 24, 'StoreCenter', NULL),
(106, 1, 'Q510', NULL),
(109, 1, 'Lifebook A532', NULL),
(110, 1, 'P710', NULL),
(111, 7, 'MFC-9420CN', NULL),
(112, 1, 'Q910', NULL),
(119, 1, 'Lifebook S782', NULL),
(114, 1, 'Lifebook AH552/SL', NULL),
(115, 28, 'TS-419P II', NULL),
(116, 1, 'Lifebook N(H)532', NULL),
(117, 1, 'Lifebook E753', NULL),
(118, 1, 'C720', NULL),
(120, 1, 'Lifebook E733', NULL),
(121, 1, 'E710', NULL),
(122, 1, 'Lifebook A544', NULL),
(124, 1, 'P420', NULL),
(127, 1, 'Q520', NULL),
(126, 1, 'Lifebook A512', NULL),
(128, 2, 'Galaxy Tab 4', NULL),
(129, 1, 'Celvin Q703', NULL),
(130, 1, 'E720', NULL),
(131, 1, 'P720', NULL),
(132, 1, 'E420', NULL),
(133, 1, 'Lifebook A514', NULL),
(134, 1, 'Lifebook A555', NULL),
(135, 28, 'TS-453', NULL),
(136, 13, 'Optiplex 740', NULL),
(137, 13, 'Optiplex GX745', NULL),
(250, 13, 'Latitude E5520', NULL),
(139, 1, 'P2511', NULL),
(140, 13, 'Latitude E6400', NULL),
(142, 1, 'P920', NULL),
(143, 13, 'Latitude E5530', NULL),
(144, 7, 'HL-2250DN', NULL),
(145, 29, 'E260dn', NULL),
(146, 30, 'Bizhub c223', NULL),
(147, 30, 'Bizhub 4700P', NULL),
(148, 30, 'Bizhub c224e', NULL),
(149, 13, 'PowerEdge T420', NULL),
(150, 26, 'GS105EV2', NULL),
(151, 25, 'DAP-3310', NULL),
(152, 31, 'TLWN841N', NULL),
(154, 1, 'D556', NULL),
(155, 7, 'HL-3150CDW', NULL),
(156, 7, 'QL-710W', NULL),
(157, 1, 'Lifebook A556', NULL),
(158, 28, 'TS-453U', NULL),
(159, 15, 'Compaq 6710b', NULL),
(162, 15, 'ProDesk 400 G1 MT', NULL),
(161, 13, 'Vostro 3900', NULL),
(163, 13, 'Optiplex 3020', NULL),
(164, 15, 'Pro 3500', NULL),
(165, 1, 'Lifebook E744', NULL),
(166, 1, 'P556', NULL),
(167, 1, 'Primergy TX2540', NULL),
(168, 1, 'Lifebook E736', NULL),
(169, 1, 'Lifebook E557', NULL),
(170, 1, 'Lifebook A557', NULL),
(171, 1, 'Q556', NULL),
(172, 1, 'CELSIUS W550', NULL),
(173, 13, 'Inspiron 5748', NULL),
(174, 3, 'Satellite C875-13E', NULL),
(175, 11, 'Aspire E5-771', NULL),
(176, 3, 'Satellite Pro L770-10W', NULL),
(177, 11, 'Aspire 3810T', NULL),
(359, 52, 'Mobile 1610', NULL),
(182, 11, 'Aspire F5-571G', NULL),
(205, 17, 'All Series', NULL),
(184, 17, 'P53E', NULL),
(185, 15, 'ProBook 470 G4', NULL),
(254, 1, 'CELSIUS W370', NULL),
(187, 1, 'LifeBook NH751', NULL),
(188, 1, 'RX200 S7', NULL),
(189, 2, 'Galaxy Note SM-P900', NULL),
(190, 2, 'N230', NULL),
(191, 4, 'ThinkPad 10 20E3', NULL),
(192, 40, 'Surface Pro 4', NULL),
(232, 1, 'Primergy RX2540', NULL),
(194, 41, 'iR-ADV C351', NULL),
(195, 7, 'DCP-7065DN', NULL),
(196, 7, 'HL-L5100DN', NULL),
(197, 7, 'HL-L8250CDN', NULL),
(198, 42, 'SP 3600SF', NULL),
(199, 1, 'P410', NULL),
(200, 30, 'PagePRO 1490MF', NULL),
(201, 28, 'TS-251', NULL),
(203, 28, 'TS-253 Pro', NULL),
(204, 1, 'Celvin Q802', NULL),
(206, 15, 'ProBook 470 G1', NULL),
(207, 15, 'HP ProBook 470 G1', NULL),
(208, 1, 'D556/2', NULL),
(209, 11, 'TravelMate P278-MG', NULL),
(210, 1, 'P556/2', NULL),
(211, 2, '270E', NULL),
(212, 2, 'NP270', NULL),
(213, 2, '350E', NULL),
(214, 28, 'TS-451U', NULL),
(215, 15, 'HP ProBook 470 G5', NULL),
(216, 9, 'iMac 27\"', NULL),
(217, 30, 'C35', NULL),
(218, 1, 'D757', NULL),
(220, 15, 'Officejet Pro 8616', NULL),
(221, 1, 'Lifebook N532', NULL),
(222, 7, 'QL-810W', NULL),
(223, 1, 'CELSIUS W570', NULL),
(224, 17, 'X705UVR', NULL),
(225, 15, 'HP ProBook 650 G3', NULL),
(226, 1, 'P557', NULL),
(227, 1, 'Q556/2', NULL),
(228, 1, 'Lifebook U758', NULL),
(229, 1, 'Lifebook A357', NULL),
(230, 4, 'MIIX', NULL),
(231, 1, 'Primergy TX1330', NULL),
(233, 15, 'HP Laptop 17-by0xxx', NULL),
(234, 1, 'P558', NULL),
(235, 1, 'Lifebook E458', NULL),
(236, 1, 'D538', NULL),
(237, 47, 'NUC6CAYS', NULL),
(238, 1, 'CELSIUS H780', NULL),
(239, 48, 'MX-2314N', NULL),
(240, 28, 'TS-253A', NULL),
(241, 49, 'SP C410DN', NULL),
(242, 1, 'Primergy TX1310 M1', NULL),
(243, 26, 'GS116Ev2', NULL),
(244, 40, 'Surface Pro', NULL),
(252, 1, 'CELSIUS W380', NULL),
(246, 13, 'OptiPlex 390', NULL),
(248, 13, 'OptiPlex 360', NULL),
(249, 4, '44034LG', NULL),
(251, 1, 'CELSIUS W580', NULL),
(253, 1, 'CELSIUS W530', NULL),
(255, 2, '270E5G/270E5U', NULL),
(256, 11, 'Aspire Predator G3605', NULL),
(257, 15, 'HP ProBook 470 G3', NULL),
(258, 1, 'CELSIUS W580 Power', NULL),
(259, 7, 'DCP-L5500DN', NULL),
(260, 15, 'ProBook 470 G2', NULL),
(261, 28, 'TS-453BU-RP', NULL),
(262, 1, 'CELSIUS J550/2', NULL),
(263, 1, 'G558', NULL),
(264, 1, 'Lifebook E558', NULL),
(265, 1, 'Lifebook E547', NULL),
(266, 1, 'D738', NULL),
(267, 1, 'Primergy RX2540 M2', NULL),
(268, 1, 'Lifebook U938', NULL),
(269, 1, 'Q558/E85 ', NULL),
(270, 11, 'Nitro', NULL),
(271, 1, 'K558', NULL),
(272, 1, 'P758', NULL),
(273, 28, 'TS-253Be', NULL),
(274, 13, 'Latitude ', NULL),
(275, 1, 'Lifebook A359', NULL),
(276, 1, 'Lifebook E459', NULL),
(277, 1, 'Lifebook E559', NULL),
(278, 13, 'Precision Mobile Workstation', NULL),
(279, 4, 'IdeaPad 3', NULL),
(280, 1, 'Lifebook A3510', NULL),
(281, 2, 'Galaxy Tab A', NULL),
(282, 1, 'Lifebook E5510', NULL),
(283, 28, 'TS-453DU', NULL),
(284, 28, 'TS-431XeU', NULL),
(285, 52, 'MINISERVER G4', NULL),
(286, 28, 'TS-453Be', NULL),
(287, 1, 'P5011', NULL),
(288, 28, 'TS-251D', NULL),
(289, 28, 'TS-253D', NULL),
(290, 28, 'TS-453D', NULL),
(291, 28, 'TS-231P2', NULL),
(292, 47, 'NUC10FNK', NULL),
(293, 47, 'NUC', NULL),
(294, 16, 'Cubi 5', NULL),
(295, 52, 'Mobile 1716', NULL),
(296, 52, 'PC-MICRO 5000', NULL),
(297, 1, 'Lifebook U7511', NULL),
(298, 1, 'Q7311', NULL),
(299, 40, 'Surface Pro 7', NULL),
(300, 1, 'Q7310', NULL),
(301, 28, 'TS-432PXU', NULL),
(302, 1, 'Lifebook E5511', NULL),
(303, 1, 'D6011', NULL),
(304, 1, 'Lifebook A3511', NULL),
(306, 1, 'Primergy RX2530 M5', NULL),
(307, 1, 'Q7010', NULL),
(308, 52, 'Mobile 1516', NULL),
(309, 40, 'Surface Pro 8', NULL),
(310, 1, 'Primergy TX2550', NULL),
(311, 1, 'CELSIUS W5011', NULL),
(312, 52, 'PC-MICRO 6000', NULL),
(313, 1, 'P5010', NULL),
(315, 1, 'U747', NULL),
(314, 53, 'HiFive14', NULL),
(316, 28, 'TS-464eU', NULL),
(317, 31, 'EAP110', NULL),
(318, 31, 'EAP245', NULL),
(319, 13, 'Latitude 3520', NULL),
(320, 31, 'OC200', NULL),
(321, 44, 'RS3618xs', NULL),
(322, 26, 'M4300-16X', NULL),
(323, 44, 'RT2600ac', NULL),
(324, 1, 'RX2530 M6', NULL),
(325, 1, 'Primergy RX2530 M6', NULL),
(326, 11, 'TravelMate P2', NULL),
(327, 1, 'E4512', NULL),
(328, 1, 'Lifebook E4512', NULL),
(329, 52, 'Mobile 1717', NULL),
(330, 47, 'NUC 11', NULL),
(331, 40, 'Surface Go', NULL),
(332, 11, 'TravelMate P4', NULL),
(333, 1, 'Lifebook U772', NULL),
(334, 1, 'ESPRIMO', NULL),
(335, 13, 'Vostro 3515', NULL),
(336, 13, 'Vostro 3520', NULL),
(337, 15, 'Probook 450 G3', NULL),
(338, 13, 'Latitude 5450', NULL),
(339, 13, 'Latitude 5540', NULL),
(340, 1, 'Q7390', NULL),
(342, 17, 'All In One PC', NULL),
(343, 13, 'Latitude 3540', NULL),
(344, 4, 'Ideapad S145-15API', NULL),
(345, 4, 'ThinkCentre M70q', NULL),
(346, 40, 'Surface Pro 9', NULL),
(347, 52, 'PC-MICRO 3000', NULL),
(348, 13, 'Latitude 3550', NULL),
(349, 13, 'Latitude 7350', NULL),
(350, 52, 'Mobile 1778R', NULL),
(351, 48, 'MX-4071', NULL),
(352, 3, 'e-STUDIO 339CS', NULL),
(353, 40, 'Surface Pro 10', NULL),
(354, 28, 'TS-262-4G', NULL),
(355, 13, 'Latitude 3950', NULL),
(356, 4, 'E550 (ThinkPad) - Type 20DF', NULL),
(358, 52, 'SERVER 7220 G3', NULL),
(360, 52, 'PAD 1162', NULL),
(361, 52, 'Mobile 1500P', NULL),
(362, 52, 'Mobile 1551', NULL),
(363, 52, 'Mobile 1471', NULL),
(364, 52, 'PC-MICRO 6000C', NULL),
(365, 52, 'Mobile 1516R', NULL),
(366, 52, 'Mobile 1716T', NULL),
(367, 52, 'Mobile 1517', NULL),
(368, 52, 'Mobile 1517R', NULL),
(369, 11, 'TravelMate P215-52', NULL),
(370, 15, 'Z1 G6', NULL),
(371, 13, 'Pro PC16250', NULL),
(372, 52, 'MINISERVER G6', NULL),
(373, 13, 'Optiplex 7010', NULL),
(374, 52, 'PAD 1262', NULL),
(375, 52, 'Mobile 1717R', NULL),
(376, 52, 'PC-MICRO 7000', NULL),
(377, 52, 'Terra Workstation', NULL),
(378, 1, 'Lifebook U7510', NULL),
(379, 4, 'ThinkPad E16', NULL),
(380, 28, 'TS-253E', NULL),
(381, 52, 'Mobile 1551R', NULL),
(382, 13, 'Vostro 3500', NULL),
(383, 28, 'TS-464-8G', NULL),
(384, 52, 'Workstation 7610', NULL),
(385, 56, 'SER5', NULL),
(386, 52, 'Mobile 1610M', NULL),
(387, 52, 'Mobile 1671L', NULL),
(388, 31, 'EAP653', NULL),
(389, 52, 'PAD 1201', NULL),
(390, 11, 'EXTENSA 215-51', NULL),
(391, 13, 'Inspiron 3593', NULL),
(392, 17, 'Business P1504FA', NULL),
(393, 52, 'PAD 1007', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ha_os`
--

CREATE TABLE `ouapi_ha_os` (
  `id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_ha_os`
--

INSERT INTO `ouapi_ha_os` (`id`, `libelle`) VALUES
(1, 'Windows XP Professionel'),
(2, 'Windows XP Famillial'),
(3, 'Windows 7 Professionnel x64'),
(4, 'Windows 7 Professionnel x86'),
(5, 'Windows 7 Home Premium x64'),
(6, 'Windows 7 Home Premium x86'),
(7, 'Mixte WindowsUbuntu'),
(8, 'MacOs'),
(9, 'Windows Small Business Server 2003 R2'),
(10, 'Windows Serveur 2008 R2'),
(11, 'Windows 2000 serveur'),
(12, 'Windows Serveur 2008 Standard R2 64 bits'),
(13, 'Windows 98 Se'),
(14, 'Windows Vista Home 64 bits'),
(15, 'Windows Serveur 2003'),
(16, 'Windows Vista Pro 32 bits'),
(18, 'Windows 8 Professionnel x64'),
(17, 'Windows 98'),
(19, 'Linux'),
(20, 'Windows Serveur 2012'),
(21, 'Windows 10 Professionnel x64'),
(22, 'Windows 10 Professionnel x86'),
(23, 'Windows 10 Famille x64'),
(24, 'Windows Serveur 2016'),
(25, 'VMware'),
(46, 'Windows Serveur 2025'),
(28, 'Windows 8.1 Home x64'),
(31, 'Windows 8.1 Professionnel x64'),
(32, 'Windows Server 2008 R2 Standard x64'),
(33, 'Windows 7 Home Premium x64'),
(35, 'Windows Server 2012 R2 Foundation x64'),
(40, 'Android'),
(41, 'Windows 11 Professionnel'),
(42, 'Windows Serveur 2019'),
(43, 'QTS'),
(44, 'Windows 11 Famille'),
(45, 'Windows Serveur 2022');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ha_type`
--

CREATE TABLE `ouapi_ha_type` (
  `id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `connex_http` int NOT NULL DEFAULT '0',
  `connex_vnc` int NOT NULL DEFAULT '0',
  `verrou` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_ha_type`
--

INSERT INTO `ouapi_ha_type` (`id`, `libelle`, `connex_http`, `connex_vnc`, `verrou`) VALUES
(1, 'PC Bureau', 0, 1, 1),
(2, 'PC Portable', 0, 1, 1),
(3, 'Imprimante reseau', 1, 0, 1),
(4, 'Copieur', 1, 0, 0),
(5, 'Serveur', 0, 0, 0),
(6, 'Switch', 1, 0, 0),
(7, 'PC Virtuel', 0, 1, 0),
(8, 'AP Wifi', 1, 0, 0),
(9, 'Hub', 1, 0, 0),
(10, 'Routeur & Modem Routeur', 1, 0, 0),
(11, 'NAS', 1, 0, 0),
(12, 'Camera IP', 1, 0, 0),
(13, 'Tablette PC', 0, 0, 0),
(14, 'Tablette Android', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_liaison_docs`
--

CREATE TABLE `ouapi_liaison_docs` (
  `id` int NOT NULL,
  `doc_id` int NOT NULL,
  `hardware_id` int NOT NULL,
  `periph_id` int NOT NULL,
  `software_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_liaison_docs`
--

INSERT INTO `ouapi_liaison_docs` (`id`, `doc_id`, `hardware_id`, `periph_id`, `software_id`) VALUES
(1, 4, 1504, 0, 0),
(4, 7, 0, 45, 0),
(5, 7, 1504, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_peripherique`
--

CREATE TABLE `ouapi_peripherique` (
  `id` int NOT NULL,
  `num_serie` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `marque_id` int NOT NULL,
  `modele_id` int NOT NULL,
  `type_id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `hard_id` int NOT NULL DEFAULT '0',
  `agence_id` int DEFAULT NULL,
  `reservable` int NOT NULL DEFAULT '0',
  `suivi_rebus` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `commentaire` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `creation_date` date DEFAULT NULL,
  `ocs_id` int NOT NULL DEFAULT '0',
  `ocs_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_peripherique`
--

INSERT INTO `ouapi_peripherique` (`id`, `num_serie`, `marque_id`, `modele_id`, `type_id`, `nom`, `hard_id`, `agence_id`, `reservable`, `suivi_rebus`, `commentaire`, `creation_date`, `ocs_id`, `ocs_type`) VALUES
(2, '', 12, 2, 1, 'Ecran Ged', 14, 2, 0, '', '', '2004-08-03', 0, ''),
(3, 'ETL780C00163304F24000', 11, 3, 1, 'Ecran Maud', 15, 2, 0, '', '', '2006-09-30', 0, ''),
(4, 'ETL780C0016330479B400', 11, 3, 1, 'Ecran Habitat', 16, 2, 0, '', '', '2006-09-30', 0, ''),
(5, 'ETL5209126642013436321', 11, 4, 1, 'Ecran secretariat', 17, 2, 0, '', '', '2007-03-01', 0, ''),
(6, 'ETL5209126642013606321', 11, 4, 1, 'Ecran SPANC', 18, 2, 0, '', '', '2007-03-01', 0, ''),
(7, 'ETL5209126642013706321', 11, 4, 1, 'Ecran CCYF', 19, 2, 0, '', '', '2007-03-01', 0, ''),
(8, '', 12, 5, 1, 'Ecran aire gens du voyage', 20, 2, 0, '', '', '2003-10-28', 0, ''),
(9, 'N220WAP0B7903130', 12, 6, 1, 'Ecran serveur', 23, 2, 0, '', 'Garantie 3 ans', '2008-02-19', 0, ''),
(10, 'N22112A 02AF96033167A0', 14, 7, 5, 'Comptabilité', 35, 4, 0, '', 'Garantie 3 ans', '2010-01-12', 0, ''),
(11, '', -1, -1, 5, 'Pixma iP8750', 0, 11, 0, '', '', '2016-05-11', 0, ''),
(12, 'ME22HSDP913798D', 2, -1, 1, 'SAMSUNG 223BW', 0, 1, 1, '', 'DVI, VGA', '2017-03-20', 0, ''),
(13, '0003007572', 25, -1, 7, 'D-LINK DUB-H4', 0, 1, 1, '', 'HUB USB 1.0\r\n4 ports', '2017-03-20', 0, ''),
(14, 'LK15214DP140023', 35, -1, 11, 'Livebox Pro v3', 0, 1, 1, '', '', '2017-03-20', 0, ''),
(15, 'E63217C7J305361', 7, -1, 5, 'Brother DCP7025', 0, 1, 1, '', '', '2017-03-20', 0, ''),
(16, '', 15, -1, 5, 'HP PSC1610', 0, 1, 1, '', '', '2017-03-20', 0, ''),
(17, '', 34, -1, 5, 'Kyocera Ecosys FS-1010', 0, 1, 1, '', '', '2017-03-20', 0, ''),
(18, 'Q8VG---AAAAAC0201', 32, -1, 10, 'Optoma W301', 0, 1, 1, '', 'VGA, HDMI, S-Vidéo, CINCH, RS232', '2013-03-20', 0, ''),
(20, 'DR89257012278', 25, -1, 9, 'D-Link DES-1005D (rev J2)', 0, 1, 1, '', 'Switch 5 ports', '2017-03-20', 0, ''),
(21, 'DG8713CSA048839', 26, -1, 11, 'Netgear DG834', 0, 1, 1, '', 'ADSL Firewall Router\r\nMAC 00:09:5B:B0:48:C8\r\n', '2017-03-20', 0, ''),
(22, 'MDG20E919068', 33, -1, 11, 'Linksys WAP54G v2', 0, 1, 1, '', 'Wireless-G Access Point\r\nMAC 00:12:17:69:43:E5', '2017-03-20', 0, ''),
(23, '1EP376B70230B', 26, -1, 11, 'Netgear DG834G v3', 0, 1, 1, '', 'Wireless ADSL Modem Router\r\nMAC 00:1B:2F:7B:02:4C\r\n', '2017-03-20', 0, ''),
(24, '1PL489BS02C6B', 26, -1, 11, 'Netgear DG834G v4', 0, 1, 1, '', 'Wireless ADSL2+ Modem Router\r\nMAC 00:22:3F:4A:54:12\r\n', '2017-03-20', 0, ''),
(25, 'RE022D1022894', 26, -1, 11, 'D-Link DIR-615', 0, 1, 1, '', 'Routeur Wireless N 300\r\nMAC C8:D3:A3:06:25:49\r\n', '2017-03-20', 0, ''),
(26, 'S3J3900067', 27, -1, 9, 'ZyXEL GS-1016', 0, 1, 1, '', 'Switch 16 ports', '2017-03-20', 0, ''),
(27, '22320C54007F1', 26, -1, 9, 'Netgear JGS524 v2', 0, 1, 1, '', 'Switch 24 ports', '2017-03-20', 0, ''),
(28, '2TN124B400CA3', 26, -1, 11, 'Netgear DGN2200-100PES', 0, 1, 1, '', 'Routeur ADSL\r\nMAC 2C:B0:5D:64:A0:4C', '2017-03-20', 0, ''),
(29, '22320C51007A8', 26, -1, 9, 'Netgear JGS524 v2 (2)', 0, 1, 1, '', 'ProSafe 24 port Gigabit Switch\r\n', '2017-03-20', 0, ''),
(32, 'CCQ1746208D', -1, -1, 11, 'CISCO RV110W', 0, 1, 1, '', '', '2017-04-12', 0, ''),
(30, '14410A84600186', 33, -1, 11, 'LRT214-201610', 0, 17, 0, '', '', '2016-10-02', 0, ''),
(31, '', 36, 8, 14, 'EATON_3S_201411', 0, 17, 0, '', '330W\r\n550 VA\r\n', '2014-11-24', 0, ''),
(33, '2A820C5600B43 - 2A820C5500B42', 26, -1, 9, 'XAV2501 - Paire CPL', 0, 1, 1, '', 'Powerline AV +200 Kit XAV2501', '2017-04-18', 0, ''),
(34, 'S140F50002148', 27, -1, 11, 'WAP3205 v2', 0, 1, 1, '', 'Routeur Wifi', '2017-04-23', 0, ''),
(37, 'QH3X033AAAAAC0574 ', 32, -1, 10, 'DH350 - 1', 0, 5, 0, '', '', '2020-11-01', 0, ''),
(38, 'QH3X033AAAAAC0578', 32, -1, 10, 'DH350 - 2', 0, 5, 0, '', '', '2020-11-01', 0, ''),
(39, 'TH081751NP', 15, -1, 5, 'HP Officejet 250 ', 0, 5, 0, '', '', '2020-11-01', 0, ''),
(40, 'E75262F0G510217', 7, -1, 5, 'ScanNCut CM300', 0, 5, 0, '', '', '2020-11-01', 0, ''),
(41, '1155103322431', -1, -1, 1, 'XB3270QS-B1', 0, 5, 0, '', '', '2020-11-01', 0, ''),
(42, '12345RTGHJI87', 17, -1, 3, 'AdminPériph', 1504, 48, 0, '', 'Bloubloublou', '2026-04-20', 0, ''),
(43, '3EDCVBHYTRF', 7, 1, 5, 'T15-2704', 0, 48, 0, '', '', '2026-04-20', 0, ''),
(44, '12345T6YGBNJU', 15, -1, 2, 'HG6-098', 0, 48, 0, '', '', '2026-04-20', 0, ''),
(45, '34567876TGHYT', 7, 1, 6, 'AdminCléUSB', 1504, 48, 1, '', '', '2026-04-20', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_pe_modele`
--

CREATE TABLE `ouapi_pe_modele` (
  `id` int NOT NULL,
  `marque_id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'Image path'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_pe_modele`
--

INSERT INTO `ouapi_pe_modele` (`id`, `marque_id`, `libelle`, `img_path`) VALUES
(1, 7, 'QL560', NULL),
(2, 12, '15\" TFT L50s', NULL),
(3, 11, '1906AS', NULL),
(4, 11, 'AL1916WAS', NULL),
(5, 12, 'QV 770', NULL),
(6, 12, 'N220W', NULL),
(7, 14, 'B430D', NULL),
(8, 36, 'EATON 3S', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_pe_type`
--

CREATE TABLE `ouapi_pe_type` (
  `id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `verrou` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_pe_type`
--

INSERT INTO `ouapi_pe_type` (`id`, `libelle`, `verrou`) VALUES
(1, 'Ecran', 1),
(2, 'Souris', 1),
(3, 'Clavier', 1),
(4, 'Pavé numérique', 1),
(5, 'Imprimante USB', 1),
(6, 'Clé USB', 1),
(7, 'HUB USB', 0),
(9, 'Switch', 0),
(10, 'Video Projecteur', 0),
(11, 'Routeur et Modem Routeur', 0),
(14, 'Onduleur', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_plugin`
--

CREATE TABLE `ouapi_plugin` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `install_date` date DEFAULT NULL,
  `version` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ref_cpu`
--

CREATE TABLE `ouapi_ref_cpu` (
  `id` int NOT NULL,
  `libelle` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ref_disque_type`
--

CREATE TABLE `ouapi_ref_disque_type` (
  `id` int NOT NULL,
  `libelle` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ref_ram_type`
--

CREATE TABLE `ouapi_ref_ram_type` (
  `id` int NOT NULL,
  `libelle` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_reseau`
--

CREATE TABLE `ouapi_reseau` (
  `id` int NOT NULL,
  `agence_id` int NOT NULL,
  `num_prise` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `emplacement_id` int NOT NULL,
  `hardware_id` int NOT NULL,
  `equipement_id` int NOT NULL,
  `port_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_reseau`
--

INSERT INTO `ouapi_reseau` (`id`, `agence_id`, `num_prise`, `emplacement_id`, `hardware_id`, `equipement_id`, `port_id`) VALUES
(1, 48, '1234567', 141, 1504, 45, 2),
(2, 48, '89010', 140, 1499, 45, 6);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_reservation`
--

CREATE TABLE `ouapi_reservation` (
  `id` int NOT NULL,
  `site_id` int NOT NULL COMMENT 'site-id',
  `user_id` int NOT NULL,
  `hard_id` int NOT NULL,
  `periph_id` int NOT NULL,
  `object` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_deb` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_reservation`
--

INSERT INTO `ouapi_reservation` (`id`, `site_id`, `user_id`, `hard_id`, `periph_id`, `object`, `date_deb`, `date_fin`) VALUES
(2, 1, 1, 215, 0, '', '1970-01-01', '2017-03-24'),
(7, 1, 1, 0, 33, 'Pret pour tel election MJC', '1970-01-01', '2017-05-15'),
(6, 1, 1, 465, 0, 'Pret Mairie Folles', '1970-01-01', '2017-08-01'),
(13, 1, 1, 465, 0, 'Pret Mairie Folles', '1970-01-01', '2018-01-26'),
(9, 1, 1, 0, 12, 'Clinique Woot', '1970-01-01', '2017-06-16'),
(12, 1, 1, 400, 0, 'Maridat - Fabrice', '1970-01-01', '2017-09-05'),
(14, 1, 1, 400, 0, 'ADC DECORHOME', '1970-01-01', '2017-12-12'),
(16, 1, 1, 465, 0, 'Euroreservoir', '1970-01-01', '2018-11-28'),
(17, 1, 1, 465, 0, '', '1970-01-01', '2019-06-17'),
(18, 1, 1, 400, 0, 'AEM', '1970-01-01', '2019-06-17'),
(20, 1, 1, 401, 0, 'DESALOIS', '1970-01-01', '2019-07-05'),
(23, 48, 68, 1504, 0, 'TestRéservation', '1970-01-01', '2026-04-28');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_sites`
--

CREATE TABLE `ouapi_sites` (
  `id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_sites`
--

INSERT INTO `ouapi_sites` (`id`, `libelle`) VALUES
(1, 'AIM'),
(2, 'CCOC - CCPS'),
(3, 'BELL FRANCE'),
(4, 'MARIDAT'),
(5, 'LA PALETTE'),
(6, 'CCOC - CCPD'),
(7, 'PLASTI 23'),
(8, 'COMMUNE DE FURSAC'),
(9, 'MJC'),
(11, 'AREHA'),
(12, 'CHAVEGRAND SE'),
(13, 'SMIPAC'),
(14, 'RICARD & FILS'),
(15, 'PERSPECTIVES 23'),
(16, 'SOMAC'),
(17, 'EURO RESERVOIR'),
(18, 'ADC'),
(19, 'ASSAT'),
(20, 'BETF'),
(21, 'EVOLIS'),
(22, 'FLORANIMAL'),
(23, 'COMMUNE DE ST AGNANT DE VERSILLAT'),
(46, 'CHAPUT SAS'),
(29, 'CCOC - CCBGB'),
(40, 'RENAULT LES PEUPLIERS'),
(38, 'INERGYS'),
(41, 'COMMUNE DE ST GERMAIN BEAUPRE'),
(42, 'COMMUNE DE FEYTIAT'),
(43, 'CPP'),
(45, 'SYNDICAT MIXTE DE LA FOT'),
(47, 'STRATEGE'),
(48, 'TEST');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_software`
--

CREATE TABLE `ouapi_software` (
  `id` int NOT NULL,
  `marque_id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dern_version_num` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dern_version_date` date DEFAULT NULL,
  `agence_id` int NOT NULL DEFAULT '0',
  `commentaire` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_software`
--

INSERT INTO `ouapi_software` (`id`, `marque_id`, `nom`, `dern_version_num`, `dern_version_date`, `agence_id`, `commentaire`) VALUES
(1, 22, 'Passbolt', '123456', NULL, 48, ''),
(2, 22, 'Kutner', '3.0', NULL, 48, '');

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_soft_ocs_alias`
--

CREATE TABLE `ouapi_soft_ocs_alias` (
  `id` int NOT NULL,
  `ocs_soft_name` varchar(255) NOT NULL,
  `ouapi_soft_id` int NOT NULL,
  `visible` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_so_licence`
--

CREATE TABLE `ouapi_so_licence` (
  `id` int NOT NULL,
  `hardware_id` int NOT NULL,
  `software_id` int NOT NULL,
  `serial` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_utilisateur`
--

CREATE TABLE `ouapi_utilisateur` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `groupe_id` int NOT NULL,
  `agence_id` int NOT NULL,
  `login` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `login_win` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `langue` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rights` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `locked` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_utilisateur`
--

INSERT INTO `ouapi_utilisateur` (`id`, `nom`, `prenom`, `mail`, `groupe_id`, `agence_id`, `login`, `mdp`, `login_win`, `langue`, `rights`, `locked`) VALUES
(1, 'Admin', 'General', 'direction@aim23.fr', 10, 1, 'admin', '$2y$10$8kSYI585KkegEm7bFC1.cOJh5hWRBwyqB/UIzlbCh/4zDjcaQjRCK', '', 'FR', '', 1),
(2, 'GUERINET', 'Candy', '', 30, 2, 'ccps', 'cce7a47b73c5800b5ac58d8d47f190c2', '', 'FR', '', 0),
(6, 'CHAVEGRAND', 'Isabelle', '', 30, 12, '', 'n0', 'Com06', 'FR', '', 0),
(48, 'Areha', '87', '', 100, 11, 'areha', '6133da506cb739894e706675b9d3ea6d', '', 'FR', '', 0),
(7, 'PAGNEUX', 'Isabelle', '', 30, 2, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', '', 'FR', '', 0),
(8, 'MOYA AGURTO', 'Jeanne', '', 30, 2, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', '', 'FR', '', 0),
(9, 'CHAVEGRAND', 'Marc', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod01', 'FR', '', 0),
(10, 'JAUBOIS', 'Magali', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Com03', 'FR', '', 0),
(11, 'LEGAY', 'Adeline', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Com02', 'FR', '', 0),
(12, 'FAIVRE', 'Guy', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Com01', 'FR', '', 0),
(13, 'CHAVEGRAND', 'Nadia', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Com05', 'FR', '', 0),
(14, 'CHAVEGRAND', 'Marlène', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Com04', 'FR', '', 0),
(15, 'CHAVEGRAND', 'Jean-Claude', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Jean Claude', 'FR', '', 0),
(19, 'CHAVEGRAND', 'Yves', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'YC', 'FR', '', 0),
(17, 'KACHEL', 'Aurélie', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod04', 'FR', '', 0),
(18, 'DETOSSE', 'Jean-Philippe', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', '', 'FR', '', 0),
(20, 'PENOT', 'Chantal', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'RH01', 'FR', '', 0),
(21, 'Qualité', 'Responsable', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod02', 'FR', '', 0),
(22, 'DUFAYET-GALLIOT', 'Paticia', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod05', 'FR', '', 0),
(23, 'CHAMBELLANT', 'Sébastien', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod06', 'FR', '', 0),
(24, 'CHAVEGRAND', 'Stéphane', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod07', 'FR', '', 0),
(25, 'JEANNEROT', 'Emilie', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod05', 'FR', '', 0),
(26, 'CAILLAT', 'Jean-Pierre', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod08', 'FR', '', 0),
(27, 'BARRAY', 'Philippe', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod08', 'FR', '', 0),
(28, 'LAUNAY', 'Stéphane', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod08', 'FR', '', 0),
(29, 'CHAVEGRAND', 'Franck', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod09', 'FR', '', 0),
(30, 'MARTIN', 'Frédéric', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod09', 'FR', '', 0),
(31, 'HENNBERT', 'Marie', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod09', 'FR', '', 0),
(32, 'POUFFARY', 'Jean-Claude', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod10', 'FR', '', 0),
(33, 'ARONDEAU', 'Patrice', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod10', 'FR', '', 0),
(34, 'GALLIOT', 'Patricia', '', 30, 12, 'admin', 'bdefa98cf3f006ca11e047ea5f39a307', 'Prod05', 'FR', '', 0),
(58, '', '', '', 100, 4, '', 'n0', '', 'FR', '', 0),
(36, 'LABREGERE', 'Jean-Philippe', '', 25, 2, 'jpl', '4243a686b5d8b6441dda1abe3dd07732', '', 'FR', '', 0),
(67, 'Jay', 'Pauline', '', 100, 21, 'admin', '020b3de04dcfc054626dc638fe83a74d', '', 'FR', '', 0),
(57, 'W19@003', '', '', 100, 4, '', 'n0', '', 'FR', '', 0),
(39, 'JANVIER', 'Romain', '', 30, 2, '', 'n0', '', 'FR', '', 0),
(59, 'W19_19', '', '', 100, 4, '', 'n0', '', 'FR', '', 0),
(60, 'W19_008', '', '', 100, 4, '', 'n0', '', 'FR', '', 0),
(43, 'DUBREUIL', 'Christelle', '', 30, 2, '', 'n0', '', 'FR', '', 0),
(47, 'CCPS', '', '', 25, 2, 'CCPS', 'c3e112ee04357831f37808ae0119a7b1', '', 'FR', '', 0),
(45, 'Denis', 'Christophe', 'direction@aim23.fr', 10, 1, 'traise', 'c217a21fc5f36aaf7b88c71510a79b64', '', 'FR', '', 0),
(46, 'adminCVG', 'Administrateur', '', 20, 12, 'adminCVG', 'eedad4ffc0e2443a0470b316f04a5c0c', '', 'FR', '', 0),
(52, 'Noël', 'Frédéric', '', 30, 3, 'fredericn', '7d9a4bbf80629ba04eda33eabb5600a1', '', 'FR', '', 0),
(54, 'Perspectives', 'Emplois', '', 25, 15, 'Perspectiv', '6b97737b23bad502ab1f9d978b35574c', '', 'FR', '', 0),
(55, 'GRANDJEAN', 'Mathieu', '', 30, 16, 'somac23', 'd0e31aee65a5eb8a28503c858b29dcda', '', 'FR', '', 0),
(56, 'Pays Dunois', 'ComCom', '', 100, 6, 'CCPD', 'b1cc392e7e824bd7434a7136663428f9', '', 'FR', '', 0),
(61, '', 'Théo', '', 100, 29, '', 'n0', '', 'FR', '', 0),
(62, 'Theo', '', '', 100, 29, '', 'n0', '', 'FR', '', 0),
(63, 'MARCHAND', 'Eric', '', 100, 12, '', 'n0', 'Com06', 'FR', '', 0),
(64, 'Maire', '', '', 100, 8, '', 'n0', '', 'FR', '', 0),
(65, 'Elus', '', '', 100, 8, '', 'n0', '', 'FR', '', 0),
(66, 'Flavie', '', '', 100, 29, '', 'n0', '', 'FR', '', 0),
(68, 'test', 'test', 'test.test@gmail.com', 101, 48, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test_win', 'FR', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ut_groupe`
--

CREATE TABLE `ouapi_ut_groupe` (
  `id` int NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rights` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `locked` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_ut_groupe`
--

INSERT INTO `ouapi_ut_groupe` (`id`, `libelle`, `rights`, `locked`) VALUES
(10, 'Administrateur', '', 1),
(20, 'Editeur', 'RGT;27;22;23;24;10;11;12;3;4;6;7;8;9;16;17;18;19;20;21;13;14;15;', 0),
(25, 'Lecteur', 'RGT;27;35;22;10;3;7;16;19;13;EVEN1;', 0),
(30, 'Utilisateur', 'RGT;27;35;22;23;10;11;3;4;7;8;16;17;19;20;13;14;EVEN1;EVEN2;', 0),
(100, 'Invité', '', 1),
(101, 'Test', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ut_personallinks`
--

CREATE TABLE `ouapi_ut_personallinks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `target` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouapi_ut_personalsettings`
--

CREATE TABLE `ouapi_ut_personalsettings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `subcategory` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `display_settings` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `display_groupcol` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `display_sortcol` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `ouapi_ut_personalsettings`
--

INSERT INTO `ouapi_ut_personalsettings` (`id`, `user_id`, `category`, `subcategory`, `display_settings`, `display_groupcol`, `display_sortcol`) VALUES
(1, 0, 'hard', '', 'ouapi_hardware.nom;ouapi_emplacement.libelle;ouapi_utilisateur.nom;ouapi_utilisateur.prenom;ouapi_ha_marque.libelle;ouapi_ha_modele.libelle;ouapi_ha_os.libelle;ouapi_hardware.num_serie;ouapi_hardware.commentaire;ouapi_hardware.creation_date', 'ouapi_ha_type.libelle', 'ouapi_hardware.nom'),
(2, 0, 'periph', '', 'ouapi_hardware.nom;ouapi_peripherique.nom;ouapi_ha_marque.libelle;ouapi_pe_modele.libelle;ouapi_peripherique.num_serie;ouapi_peripherique.commentaire;ouapi_peripherique.creation_date;', 'ouapi_pe_type.libelle', 'ouapi_peripherique.nom'),
(3, 0, 'soft', '', 'ouapi_software.nom;ouapi_ha_marque.libelle;ouapi_software.dern_version_num;ouapi_software.dern_version_date;ouapi_software.commentaire;', '', 'ouapi_software.nom'),
(4, 0, 'resa', 'hard', 'ouapi_hardware.nom;ouapi_ha_marque.libelle;ouapi_ha_modele.libelle;', 'ouapi_ha_type.libelle', 'ouapi_hardware.nom'),
(5, 0, 'resa', 'periph', 'ouapi_peripherique.nom;ouapi_ha_marque.libelle;ouapi_pe_modele.libelle;', 'ouapi_pe_type.libelle', 'ouapi_peripherique.nom'),
(6, 0, 'docs', '', 'ouapi_entreprise.raison_sociale;ouapi_docs.reference;ouapi_docs.date;ouapi_docs.commentaire;', 'ouapi_docs_type.libelle', 'ouapi_docs.date'),
(7, 0, 'netw', '', 'ouapi_reseau.num_prise;alias_switchname.nom;ouapi_reseau.port_id;ouapi_hardware.nom;ouapi_emplacement.libelle;', '', 'ouapi_reseau.num_prise'),
(8, 0, 'ldap', 'user', 'LDAP_ATTR_LNAME;LDAP_ATTR_FNAME;LDAP_ATTR_MAIL;LDAP_ATTR_LOGINWIN;', '', '{LDAP_ATTR_MAIL}'),
(9, 0, 'users', '', 'ouapi_utilisateur.nom;ouapi_utilisateur.prenom;ouapi_utilisateur.mail;ouapi_utilisateur.login_win;ouapi_ut_groupe.libelle;', '', 'ouapi_utilisateur.nom'),
(10, 0, 'accueil', '', 'MY_PARAMS;MY_ACTIONS;MY_LINKS;MY_TASKS;', '', ''),
(11, 0, 'ldap', 'hard', 'LDAP_ATTR_HARD_NAME;LDAP_ATTR_HARD_DESCRIPTION;', '', '{LDAP_ATTR_HARD_NAME}'),
(12, 1, 'hard', '', 'ouapi_hardware.nom;ouapi_emplacement.libelle;ouapi_ha_marque.libelle;ouapi_ha_modele.libelle;ouapi_hardware.num_serie;ouapi_ha_os.libelle;ouapi_hardware.pfield_utilisateurprinc;ouapi_hardware.pfield_garantie;ouapi_hardware.commentaire;ouapi_hardware.creation_date;ouapi_hardware.cpu_id;ouapi_hardware.ram_capacite;ouapi_hardware.ram_type_id;ouapi_hardware.disque_capacite;ouapi_hardware.disque_type_id;', 'ouapi_ha_type.libelle', 'ouapi_hardware.nom'),
(13, 0, 'ocs', 'hard', 'hardware.NAME;bios.TYPE;hardware.IPADDR;hardware.USERID;bios.SSN;hardware.LASTDATE;', '', 'hardware.NAME'),
(14, 0, 'ocs', 'soft', 'softwares.NAME;softwares.VERSION;softwares.PUBLISHER;', '', 'softwares.NAME'),
(15, 0, 'ocs', 'monitor', 'hardware.NAME;monitors.CAPTION;monitors.MANUFACTURER;monitors.SERIAL;', '', 'monitors.CAPTION'),
(16, 0, 'ocs', 'modem', 'hardware.NAME;modems.NAME;modems.MODEL;', '', 'modems.NAME'),
(17, 0, 'ocs', 'printer', 'hardware.NAME;printers.NAME;printers.DRIVER;printers.PORT;', '', 'printers.NAME'),
(18, 0, 'ocs', 'input', 'hardware.NAME;inputs.CAPTION;inputs.TYPE;inputs.INTERFACE;', '', 'inputs.CAPTION'),
(19, 47, 'hard', '', 'ouapi_hardware.nom;ouapi_emplacement.libelle;ouapi_ha_marque.libelle;ouapi_ha_modele.libelle;ouapi_ha_os.libelle;ouapi_hardware.num_serie;ouapi_hardware.pfield_utilisateurprinc;ouapi_hardware.commentaire;ouapi_hardware.creation_date;', 'ouapi_ha_type.libelle', 'ouapi_hardware.nom'),
(20, 54, 'hard', '', 'ouapi_hardware.nom;ouapi_emplacement.libelle;ouapi_ha_marque.libelle;ouapi_ha_modele.libelle;ouapi_ha_os.libelle;ouapi_hardware.num_serie;ouapi_hardware.commentaire;ouapi_hardware.creation_date;ouapi_hardware.pfield_utilisateurprinc;ouapi_hardware.pfield_garantie;', 'ouapi_ha_type.libelle', 'ouapi_hardware.nom'),
(21, 1, 'periph', '', 'ouapi_peripherique.nom;ouapi_ha_marque.libelle;ouapi_pe_modele.libelle;ouapi_peripherique.num_serie;ouapi_peripherique.commentaire;ouapi_peripherique.creation_date;', 'ouapi_pe_type.libelle', 'ouapi_peripherique.nom'),
(22, 52, 'hard', '', 'ouapi_hardware.nom;ouapi_emplacement.libelle;ouapi_ha_marque.libelle;ouapi_ha_modele.libelle;ouapi_ha_os.libelle;ouapi_hardware.num_serie;ouapi_hardware.commentaire;ouapi_hardware.creation_date;ouapi_hardware.pfield_utilisateurprinc;ouapi_hardware.pfield_garantie;', 'ouapi_ha_type.libelle', 'ouapi_hardware.nom'),
(23, 46, 'hard', '', 'ouapi_hardware.nom;ouapi_emplacement.libelle;ouapi_ha_marque.libelle;ouapi_ha_modele.libelle;ouapi_ha_os.libelle;ouapi_hardware.num_serie;ouapi_hardware.pfield_utilisateurprinc;ouapi_hardware.commentaire;ouapi_hardware.creation_date;ouapi_hardware.pfield_garantie;', 'ouapi_ha_type.libelle', 'ouapi_hardware.nom'),
(24, 55, 'hard', '', 'ouapi_hardware.nom;ouapi_emplacement.libelle;ouapi_utilisateur.nom;ouapi_utilisateur.prenom;ouapi_ha_marque.libelle;ouapi_ha_modele.libelle;ouapi_ha_os.libelle;ouapi_hardware.num_serie;ouapi_hardware.commentaire;ouapi_hardware.creation_date;ouapi_hardware.pfield_utilisateurprinc;ouapi_hardware.ip;', 'ouapi_ha_type.libelle', 'ouapi_hardware.nom'),
(25, 7, 'hard', '', 'ouapi_hardware.nom;ouapi_emplacement.libelle;ouapi_ha_marque.libelle;ouapi_ha_modele.libelle;ouapi_ha_os.libelle;ouapi_hardware.num_serie;ouapi_hardware.commentaire;ouapi_hardware.creation_date;ouapi_hardware.pfield_garantie;ouapi_hardware.pfield_utilisateurprinc;', 'ouapi_ha_type.libelle', 'ouapi_hardware.nom');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ouapi_config`
--
ALTER TABLE `ouapi_config`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_docs`
--
ALTER TABLE `ouapi_docs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_docs_type`
--
ALTER TABLE `ouapi_docs_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_emplacement`
--
ALTER TABLE `ouapi_emplacement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_entreprise`
--
ALTER TABLE `ouapi_entreprise`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_event`
--
ALTER TABLE `ouapi_event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ev_link`
--
ALTER TABLE `ouapi_ev_link`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ev_status`
--
ALTER TABLE `ouapi_ev_status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_hardware`
--
ALTER TABLE `ouapi_hardware`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_hard_soft`
--
ALTER TABLE `ouapi_hard_soft`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ha_marque`
--
ALTER TABLE `ouapi_ha_marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ha_modele`
--
ALTER TABLE `ouapi_ha_modele`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ha_os`
--
ALTER TABLE `ouapi_ha_os`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ha_type`
--
ALTER TABLE `ouapi_ha_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_liaison_docs`
--
ALTER TABLE `ouapi_liaison_docs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_peripherique`
--
ALTER TABLE `ouapi_peripherique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_pe_modele`
--
ALTER TABLE `ouapi_pe_modele`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_pe_type`
--
ALTER TABLE `ouapi_pe_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_plugin`
--
ALTER TABLE `ouapi_plugin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ref_cpu`
--
ALTER TABLE `ouapi_ref_cpu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ref_disque_type`
--
ALTER TABLE `ouapi_ref_disque_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ref_ram_type`
--
ALTER TABLE `ouapi_ref_ram_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_reseau`
--
ALTER TABLE `ouapi_reseau`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_reservation`
--
ALTER TABLE `ouapi_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_sites`
--
ALTER TABLE `ouapi_sites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_software`
--
ALTER TABLE `ouapi_software`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_soft_ocs_alias`
--
ALTER TABLE `ouapi_soft_ocs_alias`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_so_licence`
--
ALTER TABLE `ouapi_so_licence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_utilisateur`
--
ALTER TABLE `ouapi_utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ut_groupe`
--
ALTER TABLE `ouapi_ut_groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ut_personallinks`
--
ALTER TABLE `ouapi_ut_personallinks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouapi_ut_personalsettings`
--
ALTER TABLE `ouapi_ut_personalsettings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ouapi_config`
--
ALTER TABLE `ouapi_config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT pour la table `ouapi_docs`
--
ALTER TABLE `ouapi_docs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `ouapi_docs_type`
--
ALTER TABLE `ouapi_docs_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ouapi_emplacement`
--
ALTER TABLE `ouapi_emplacement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT pour la table `ouapi_entreprise`
--
ALTER TABLE `ouapi_entreprise`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ouapi_event`
--
ALTER TABLE `ouapi_event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouapi_ev_link`
--
ALTER TABLE `ouapi_ev_link`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouapi_ev_status`
--
ALTER TABLE `ouapi_ev_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouapi_hardware`
--
ALTER TABLE `ouapi_hardware`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1545;

--
-- AUTO_INCREMENT pour la table `ouapi_hard_soft`
--
ALTER TABLE `ouapi_hard_soft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ouapi_ha_marque`
--
ALTER TABLE `ouapi_ha_marque`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `ouapi_ha_modele`
--
ALTER TABLE `ouapi_ha_modele`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT pour la table `ouapi_ha_os`
--
ALTER TABLE `ouapi_ha_os`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `ouapi_ha_type`
--
ALTER TABLE `ouapi_ha_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `ouapi_liaison_docs`
--
ALTER TABLE `ouapi_liaison_docs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ouapi_peripherique`
--
ALTER TABLE `ouapi_peripherique`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `ouapi_pe_modele`
--
ALTER TABLE `ouapi_pe_modele`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ouapi_pe_type`
--
ALTER TABLE `ouapi_pe_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `ouapi_plugin`
--
ALTER TABLE `ouapi_plugin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouapi_ref_cpu`
--
ALTER TABLE `ouapi_ref_cpu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouapi_ref_disque_type`
--
ALTER TABLE `ouapi_ref_disque_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouapi_ref_ram_type`
--
ALTER TABLE `ouapi_ref_ram_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouapi_reseau`
--
ALTER TABLE `ouapi_reseau`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ouapi_reservation`
--
ALTER TABLE `ouapi_reservation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `ouapi_sites`
--
ALTER TABLE `ouapi_sites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `ouapi_software`
--
ALTER TABLE `ouapi_software`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ouapi_soft_ocs_alias`
--
ALTER TABLE `ouapi_soft_ocs_alias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouapi_so_licence`
--
ALTER TABLE `ouapi_so_licence`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ouapi_utilisateur`
--
ALTER TABLE `ouapi_utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `ouapi_ut_groupe`
--
ALTER TABLE `ouapi_ut_groupe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT pour la table `ouapi_ut_personallinks`
--
ALTER TABLE `ouapi_ut_personallinks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ouapi_ut_personalsettings`
--
ALTER TABLE `ouapi_ut_personalsettings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
