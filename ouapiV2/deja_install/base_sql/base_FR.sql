ALTER DATABASE CHARACTER SET utf8 COLLATE utf8_general_ci;[END]

CREATE TABLE `{TAB_CONFIG}` (
  `id` int(3) NOT NULL auto_increment,
  `nom` varchar(255) default NULL,
  `subcategory` varchar(255) default NULL,
  `libelle` varchar(255) default NULL,
  `description` text,
  `valeur` varchar(255) default NULL,
  `form_type` varchar(25) NOT NULL default '',
  `globale` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

INSERT INTO `{TAB_CONFIG}` (`nom`, `subcategory`, `libelle`, `description`, `valeur`, `form_type`, `globale`) VALUES 
('param_help', '', 'Affichage de l\'aide', 'Affiche les bulles d\'aide dans les rubriques', '{PARAM_HELP}', 'radio_yn', 1),
('rght_sum', '', 'Affiche le bouton Résumé', 'Affiche le bouton Résumé', 'SUM1', 'radio_yn', 1),
('rght_gen_multisite', '', '[Multisite] Accès à tous les sites', NULL, 'GENM1', '', 1),
('rght_hard', '', '[Rubrique Matériels] Niv. 1 : Consultation', NULL, 'HARD1', '', 1),
('rght_hard_edit', '', '[Rubrique Matériels] Niv. 2 : Edition', NULL, 'HARD2', '', 1),
('rght_hard_admin', '', '[Rubrique Matériels] Niv. 3 : Administration', NULL, 'HARD3', '', 1),
('rght_periph', '', '[Rubrique Périphériques] Niv. 1 : Consultation', NULL, 'PERI1', '', 1),
('rght_periph_edit', '', '[Rubrique Périphériques] Niv. 2 : Edition', NULL, 'PERI2', '', 1),
('rght_periph_admin', '', '[Rubrique Périphériques] Niv. 3 : Administration', NULL, 'PERI3', '', 1),
('rght_soft', '', '[Rubrique Logiciels] Niv. 1 : Consultation', NULL, 'SOFT1', '', 1),
('rght_soft_edit', '', '[Rubrique Logiciels] Niv. 2 : Edition', NULL, 'SOFT2', '', 1),
('rght_soft_admin', '', '[Rubrique Logiciels] Niv. 3 : Administration', NULL, 'SOFT3', '', 1),
('rght_users', '', '[Rubrique Utilisateurs] Niv. 1 : Consultation', NULL, 'USER1', '', 1),
('rght_users_edit', '','[Rubrique Utilisateurs] Niv. 2 : Edition', NULL, 'USER2', '', 1),
('rght_users_admin', '', '[Rubrique Utilisateurs] Niv. 3 : Administration', NULL, 'USER3', '', 1),
('rght_netw', '', '[Rubrique Réseau] Niv. 1 : Consultation', NULL, 'NETW1', '', 1),
('rght_netw_edit', '', '[Rubrique Réseau] Niv. 2 : Edition', NULL, 'NETW2', '', 1),
('rght_netw_admin', '', '[Rubrique Réseau] Niv. 3 : Administration', NULL, 'NETW3', '', 1),
('rght_resa', '', '[Rubrique Réservations] Niv. 1 : Consultation', NULL, 'RESA1', '', 1),
('rght_resa_edit', '', '[Rubrique Réservations] Niv. 2 : Edition', NULL, 'RESA2', '', 1),
('rght_resa_admin', '', '[Rubrique Réservations] Niv. 3 : Administration', NULL, 'RESA3', '', 1),
('rght_docs', '', '[Rubrique Documents] Niv. 1 : Consultation', NULL, 'DOCS1', '', 1),
('rght_docs_edit', '', '[Rubrique Documents] Niv. 2 : Edition', NULL, 'DOCS2', '', 1),
('rght_docs_admin', '', '[Rubrique Documents] Niv. 3 : Administration', NULL, 'DOCS3', '', 1),
('rght_even', '', '[Rubrique Evenements] Niv. 1 : Consultation', NULL, 'EVEN1', '', 1),
('rght_even_edit', '', '[Rubrique Evenements] Niv. 2 : Edition', NULL, 'EVEN2', '', 1),
('rght_even_admin', '', '[Rubrique Evenements] Niv. 3 : Administration', NULL, 'EVEN3', '', 1),
('rght_admin', '', '[Outils Administration] Niv. 1 : Consultation', NULL, 'ADMI1', '', 1),
('rght_gen_tableedit', '', '[Général] Gestion des tables secondaires', NULL, 'GENT1', '', 1),
('rght_my', '', '[Mon espace] Consultation', NULL, 'MYSP1', '', 1),
('netw_hardtype', '', 'Type de matériels associés au réseau', NULL, '6;9;', '', 0),
('maj_hardtype', '', 'Type de matériels pouvant être mis à jour', NULL, '1;2;7;', '', 0),
('gen_version', '', 'Version du logiciel', NULL, '1.5', '', 1),
('gen_dateinstall', '', 'Date d\'installation de OUAPI', NULL, UNIX_TIMESTAMP(), '', 1),
('gen_datelastmaj', '', 'Date de dernière MAJ de OUAPI', NULL, UNIX_TIMESTAMP(), '', 1),
('gen_statsdate', '', 'Date d\'envoi des stats', NULL, '', '', 1),
('gen_statsyn', '', 'Activation de l\'envoi des stats', NULL, 1, '', 1),
('default_language', 'default_userparam', 'Langue par défaut', NULL, '{DEF_LANGUAGE}', '', 1),
('default_template', 'default_userparam', 'Template par défaut', NULL, 'default', '', 1),
('param_debug_mode', '', 'Activer le mode debug', 'Affiche les requètes SQL, les erreurs PHP et SQL', 0, 'radio_yn', 1),
('param_enable_guest', '', 'Activer le profil invité', 'Permet d\'utiliser OUAPI sans authentification', 0, 'radio_yn', 1),
('activrub_users', 'rub', 'Activer la rubrique Utilisateurs', 'Active ou désative la rubrique utilisateurs de OUAPI', 1, 'radio_yn', 1),
('activrub_netw', 'rub', 'Activer la rubrique Réseau', 'Active ou désative la rubrique réseau de OUAPI', 1, 'radio_yn', 1),
('activrub_docs', 'rub', 'Activer la rubrique Documents', 'Active ou désative la rubrique documents de OUAPI', 1, 'radio_yn', 1),
('activrub_resa', 'rub', 'Activer la rubrique Réservation', 'Active ou désative la rubrique réservation de OUAPI', 1, 'radio_yn', 1),
('activrub_soft', 'rub', 'Activer la rubrique Logiciels', 'Active ou désative la rubrique logiciels de OUAPI', 1, 'radio_yn', 1),
('activrub_periph', 'rub', 'Activer la rubrique Périphériques', 'Active ou désative la rubrique périphériques de OUAPI', 1, 'radio_yn', 1),
('activrub_hard', 'rub', 'Activer la rubrique Matériels', 'Active ou désative la rubrique matériels de OUAPI', 1, 'radio_yn', 1),
('activrub_sum', 'rub', 'Affiche le bouton Résumé', 'Affiche le bouton Résumé', '1', 'radio_yn', 1),
('activrub_even', 'rub', 'Activer la rubrique Evenements', 'Active ou désative la rubrique événements de OUAPI', 1, 'radio_yn', 1),
('rght_search', '', '[Moteur de recherche] Accès', NULL, 'SEAR1', '', 1),
('rght_ocs', '', '[Module OCS] Niv. 1 : Consultation', NULL, 'OCS1', '', 1),
('rght_ocs_edit', '', '[Module OCS] Niv. 2 : Edition', NULL, 'OCS2', '', 1),
('rght_ocs_admin', '', '[Module OCS] Niv. 3 : Administration', NULL, 'OCS3', '', 1),
('rght_ldap', '', '[Module LDAP] Niv. 1 : Consultation', NULL, 'LDAP1', '', '1'),
('rght_ldap_edit', '', '[Module LDAP] Niv. 2 : Edition', NULL, 'LDAP2', '', '1'),
('rght_ldap_admin', '', '[Module LDAP] Niv. 3 : Administration', NULL, 'LDAP3', '', '1');[END]

CREATE TABLE `{TAB_AGENCES}` (
  `id` int(3) NOT NULL auto_increment,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_EMPL}` (
  `id` int(10) NOT NULL auto_increment,
  `agence_id` int(3) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_ENTREPRISE}` (
  `id` int(3) NOT NULL auto_increment,
  `raison_sociale` varchar(255) NOT NULL,
  `adresse` text,
  `cpostal` varchar(10) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(25) NOT NULL,
  `num_client` varchar(100) NOT NULL,
  `note` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_DOCS_TYPE}` (
  `id` int(3) NOT NULL auto_increment,
  `libelle` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

INSERT INTO `{TAB_DOCS_TYPE}` (`id`, `libelle`) VALUES 
(1, 'Facture'),
(2, 'Contrat'),
(3, 'Manuel'),
(4, 'Garantie'),
(5, 'Bon d\'intervention');[END]

CREATE TABLE `{TAB_DOCS}` (
  `id` int(10) NOT NULL auto_increment,
  `entreprise_id` int(5) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `type_id` int(3) NOT NULL,
  `date` varchar(25) NOT NULL,
  `date_archive` varchar(25) NOT NULL,
  `agence_id` int(3) NOT NULL,
  `commentaire` text,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_HARD_MARQUE}` (
  `id` int(3) NOT NULL auto_increment,
  `libelle` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_HARD_MODELE}` (
  `id` int(3) NOT NULL auto_increment,
  `marque_id` int(3) NOT NULL,
  `libelle` varchar(255) default NULL,
	`img_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT  'Image path',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_HARD_OS}` (
  `id` int(3) NOT NULL auto_increment,
  `libelle` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_HARD_TYPE}` (
  `id` int(3) NOT NULL auto_increment,
  `libelle` varchar(255) default NULL,
  `connex_http` int(1) NOT NULL default '0',
  `connex_vnc` int(1) NOT NULL default '0',
  `verrou` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

INSERT INTO `{TAB_HARD_TYPE}` (`id`, `libelle`, `connex_http`, `connex_vnc`, `verrou`) VALUES 
(1, 'PC Bureau', 0, 1, 1),
(2, 'PC Portable', 0, 1, 1),
(3, 'Imprimante', 1, 0, 1),
(4, 'Copieur', 1, 0, 0),
(5, 'Serveur', 0, 0, 0),
(6, 'Switch', 1, 0, 0),
(7, 'PC Virtuel', 0, 1, 0),
(8, 'AP Wifi', 1, 0, 0),
(9, 'Hub', 1, 0, 0);[END]

CREATE TABLE `{TAB_HARDSOFT}` (
  `id` int(10) NOT NULL auto_increment,
  `hardware_id` int(10) NOT NULL,
  `software_id` int(10) NOT NULL,
  `version_date_maj` varchar(20) NOT NULL,
  `version_num` varchar(20) default NULL,
  `user_maj_id` int(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_HARD}` (
  `id` int(10) NOT NULL auto_increment,
  `num_serie` varchar(255) NOT NULL,
  `marque_id` int(3) NOT NULL,
  `modele_id` int(3) NOT NULL,
  `type_id` int(3) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `os_id` int(3) NOT NULL,
  `service_pack` int(2) default NULL,
  `user_id` int(5) NOT NULL default '0',
  `agence_id` int(3) default NULL,
  `emplacement_id` int(10) NOT NULL,
  `ip` varchar(25) default NULL,
  `reservable` int(1) NOT NULL default '0',
  `suivi_rebus` text default NULL,
  `commentaire` text default NULL,
  `creation_date` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_PERIPH_MODELE}` (
  `id` int(3) NOT NULL auto_increment,
  `marque_id` int(3) NOT NULL,
  `libelle` varchar(255) default NULL,
	`img_path` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT  'Image path',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_PERIPH_TYPE}` (
  `id` int(3) NOT NULL auto_increment,
  `libelle` varchar(255) default NULL,
  `verrou` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

INSERT INTO `{TAB_PERIPH_TYPE}` (`id`, `libelle`, `verrou`) VALUES 
(1, 'Ecran','1'),
(2, 'Souris','1'),
(3, 'Clavier','1'),
(4, 'Pavé numérique','1'),
(5, 'Imprimante LPT','1'),
(6, 'Clé USB','1');[END]

CREATE TABLE `{TAB_PERIPH}` (
  `id` int(10) NOT NULL auto_increment,
  `num_serie` varchar(255) NOT NULL,
  `marque_id` int(3) NOT NULL,
  `modele_id` int(3) NOT NULL,
  `type_id` int(3) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `hard_id` int(10) NOT NULL default '0',
  `agence_id` int(3) default NULL,
  `reservable` int(1) NOT NULL default '0',
  `suivi_rebus` text NOT NULL,
  `commentaire` text NOT NULL,
  `creation_date` varchar(255) default NULL,
  `ocs_id` INT( 11 ) NOT NULL default '0',
  `ocs_type` VARCHAR( 255 ) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_LIAISON_DOCS}` (
  `id` int(10) NOT NULL auto_increment,
  `doc_id` int(10) NOT NULL,
  `hardware_id` int(10) NOT NULL,
  `periph_id` int(10) NOT NULL,
  `software_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_RESEAU}` (
  `id` int(5) NOT NULL auto_increment,
  `agence_id` int(3) NOT NULL,
  `num_prise` varchar(255) NOT NULL,
  `emplacement_id` int(10) NOT NULL,
  `hardware_id` int(10) NOT NULL,
  `equipement_id` int(10) NOT NULL,
  `port_id` int(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_RESA}` (
  `id` int(11) NOT NULL auto_increment,
  `site_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `hard_id` int(10) NOT NULL,
  `periph_id` int(10) NOT NULL,
  `object` varchar(255) NOT NULL,
  `date_deb` varchar(20) NOT NULL,
  `date_fin` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_SOFT_LICENCE}` (
  `id` int(10) NOT NULL auto_increment,
  `hardware_id` int(3) NOT NULL,
  `software_id` int(10) NOT NULL,
  `serial` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_SOFT}` (
  `id` int(10) NOT NULL auto_increment,
  `marque_id` int(3) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `dern_version_num` varchar(20) default NULL,
  `dern_version_date` varchar(20) default NULL,
  `agence_id` int(1) NOT NULL default '0',
  `commentaire` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_SOFT_OCS_ALIAS}` (
  `id` int(11) NOT NULL auto_increment,
  `ocs_soft_name` varchar(255) NOT NULL,
  `ouapi_soft_id` int(10) NOT NULL,
  `visible` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_USERS_GRP}` (
  `id` int(3) NOT NULL auto_increment,
  `libelle` varchar(255) default NULL,
  `rights` varchar(255) NOT NULL,
  `locked` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

INSERT INTO `{TAB_USERS_GRP}` (`id`, `libelle`, `locked`) VALUES 
(10, 'Administrateur', '1'),
(100, 'Invité', '1');[END]

CREATE TABLE `{TAB_USERS}` (
  `id` int(4) NOT NULL auto_increment,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `groupe_id` int(2) NOT NULL,
  `agence_id` int(3) NOT NULL,
  `login` varchar(10) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `login_win` varchar(255) NOT NULL,
  `langue` varchar(2) NOT NULL,
  `locked` int(1) NOT NULL DEFAULT '0',
  `rights` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_PLUGIN}` (
`id` INT( 3 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 255 ) NOT NULL ,
`title` VARCHAR( 255 ) NOT NULL ,
`type` VARCHAR( 25 ) NOT NULL ,
`path` VARCHAR( 255 ) NOT NULL ,
`description` VARCHAR( 255 ) NOT NULL ,
`install_date` VARCHAR( 255 ) NOT NULL ,
`version` VARCHAR( 255 ) NOT NULL ,
`active` INT( 1 ) NOT NULL
) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_USERS_PS}` (
  `id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `user_id` INT( 4 ) NOT NULL ,
  `category` VARCHAR( 255 ) NOT NULL ,
  `subcategory` VARCHAR( 255 ) NOT NULL ,
  `display_settings` TEXT NOT NULL ,
  `display_groupcol` VARCHAR( 255 ) NOT NULL,
  `display_sortcol` VARCHAR( 255 ) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

INSERT INTO `{TAB_USERS_PS}` (`user_id` ,`category` , `subcategory` ,`display_settings`,`display_groupcol`,`display_sortcol`) VALUES 
('0', 'hard', '', '{DB_PREFIX}hardware.nom;{DB_PREFIX}emplacement.libelle;{DB_PREFIX}utilisateur.nom;{DB_PREFIX}utilisateur.prenom;{DB_PREFIX}ha_marque.libelle;{DB_PREFIX}ha_modele.libelle;{DB_PREFIX}ha_os.libelle;{DB_PREFIX}hardware.num_serie;{DB_PREFIX}hardware.commentaire;{DB_PREFIX}hardware.creation_date', '{TAB_HARD_TYPE}.libelle', '{TAB_HARD}.{HA_NAME}'),
('0', 'periph', '', '{DB_PREFIX}hardware.nom;{DB_PREFIX}peripherique.nom;{DB_PREFIX}ha_marque.libelle;{DB_PREFIX}pe_modele.libelle;{DB_PREFIX}peripherique.num_serie;{DB_PREFIX}peripherique.commentaire;{DB_PREFIX}peripherique.creation_date;', '{TAB_PERIPH_TYPE}.{PE_TY_LIBELLE}', '{TAB_PERIPH}.{PE_NAME}'),
('0', 'soft', '', '{TAB_SOFT}.nom;{DB_PREFIX}ha_marque.libelle;{TAB_SOFT}.dern_version_num;{TAB_SOFT}.dern_version_date;{TAB_SOFT}.commentaire;', '', '{TAB_SOFT}.{SO_NAME}'),
('0', 'resa', 'hard', '{DB_PREFIX}hardware.nom;{DB_PREFIX}ha_marque.libelle;{DB_PREFIX}ha_modele.libelle;', '{TAB_HARD_TYPE}.{HA_TY_LIBELLE}', '{TAB_HARD}.{HA_NAME}'),
('0', 'resa', 'periph', '{TAB_PERIPH}.{PE_NAME};{TAB_PERIPH_MARQUE}.{PE_MA_LIBELLE};{TAB_PERIPH_MODELE}.{PE_MO_LIBELLE};', '{TAB_PERIPH_TYPE}.{PE_TY_LIBELLE}', '{TAB_PERIPH}.{PE_NAME}'),
('0', 'docs', '', '{DB_PREFIX}entreprise.raison_sociale;{DB_PREFIX}docs.reference;{DB_PREFIX}docs.date;{DB_PREFIX}docs.commentaire;', '{TAB_DOCS_TYPE}.{DO_TY_LIBELLE}', '{TAB_DOCS}.{DO_DATE}'),
('0', 'netw', '', '{DB_PREFIX}reseau.num_prise;alias_switchname.nom;{DB_PREFIX}reseau.port_id;{DB_PREFIX}hardware.nom;{DB_PREFIX}emplacement.libelle;', '', '{TAB_RESEAU}.{RE_PLUGNUMBER}'),
('0', 'ldap', 'user', 'LDAP_ATTR_LNAME;LDAP_ATTR_FNAME;LDAP_ATTR_MAIL;LDAP_ATTR_LOGINWIN;', '', '{LDAP_ATTR_MAIL}'),
('0', 'ldap', 'hard', 'LDAP_ATTR_HARD_NAME;LDAP_ATTR_HARD_DESCRIPTION', '', '{LDAP_ATTR_HARD_NAME}'),
('0', 'ocs', 'hard', 'hardware.NAME;bios.TYPE;hardware.IPADDR;hardware.USERID;bios.SSN;hardware.LASTDATE;', '','hardware.NAME'),
('0', 'ocs', 'soft', 'softwares.NAME;softwares.VERSION;softwares.PUBLISHER;', '','softwares.NAME'),
('0', 'ocs', 'monitor', 'hardware.NAME;monitors.CAPTION;monitors.MANUFACTURER;monitors.SERIAL;', '', 'monitors.CAPTION'),
('0', 'ocs', 'modem', 'hardware.NAME;modems.NAME;modems.MODEL;', '', 'modems.NAME'),
('0', 'ocs', 'printer', 'hardware.NAME;printers.NAME;printers.DRIVER;printers.PORT;', '', 'printers.NAME'),
('0', 'ocs', 'input', 'hardware.NAME;inputs.CAPTION;inputs.TYPE;inputs.INTERFACE;', '', 'inputs.CAPTION'),
('0', 'users', '', '{DB_PREFIX}utilisateur.nom;{DB_PREFIX}utilisateur.prenom;{DB_PREFIX}utilisateur.mail;{DB_PREFIX}utilisateur.login_win;{DB_PREFIX}ut_groupe.libelle;', '', '{TAB_USERS}.{US_LNAME}'),
('0', 'accueil', '', 'MY_PARAMS;MY_ACTIONS;MY_LINKS;MY_TASKS;', '', '');[END]

CREATE TABLE `{TAB_USERS_PL}` (
  `id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `user_id` INT( 4 ) NOT NULL ,
  `link` VARCHAR( 255 ) NOT NULL ,
  `libelle` VARCHAR( 255 ) NOT NULL ,
  `image` VARCHAR( 255 ) NOT NULL,
  `color` VARCHAR( 255 ) NOT NULL ,
  `target` VARCHAR( 255 ) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;[END]

CREATE TABLE `{TAB_EVEN}` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creation_user_id` int(10) NOT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(10) NOT NULL,
  `status_id` int(10) NOT NULL,
  `auto_realize` int(1) NOT NULL,
  `remind_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remind_status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;[END]

CREATE TABLE `{TAB_EVEN_STATUS}` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;[END]

CREATE TABLE `{TAB_EVEN_LINK}` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `even_id` int(10) NOT NULL,
  `hard_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `periph_id` int(10) NOT NULL,
  `soft_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `reseau_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;[END]



