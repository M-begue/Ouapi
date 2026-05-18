-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 mai 2026 à 09:30
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

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

DROP TABLE IF EXISTS `ouapi_config`;
CREATE TABLE IF NOT EXISTS `ouapi_config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subcategory` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `valeur` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `form_type` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `globale` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
