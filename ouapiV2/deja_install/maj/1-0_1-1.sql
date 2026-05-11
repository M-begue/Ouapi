INSERT INTO `{TAB_CONFIG}` (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('db_prefix', 'Prefixe des table SQL Ouapi', NULL , 'ouapi_', 'text', '1');[END]

UPDATE `{TAB_CONFIG}` SET `valeur` = '1.1' WHERE `{TAB_CONFIG}`.`nom` = 'gen_version';[END]
DELETE FROM `{TAB_CONFIG}` WHERE `nom` = 'rght_contr';[END]
DELETE FROM `{TAB_CONFIG}` WHERE `nom` = 'rght_contr_edit';[END]
DELETE FROM `{TAB_CONFIG}` WHERE `nom` = 'rght_contr_admin';[END]			   
DELETE FROM `{TAB_CONFIG}` WHERE `nom` = 'rght_bill';[END]
DELETE FROM `{TAB_CONFIG}` WHERE `nom` = 'rght_bill_edit';[END]
DELETE FROM `{TAB_CONFIG}` WHERE `nom` = 'rght_bill_admin';[END]			   

INSERT INTO `{TAB_CONFIG}` (`nom`, `libelle`, `description`, `valeur`, `form_type`, `globale`) VALUES ('rght_docs', '[Documents] Accès', NULL, '15', '', 1), ('rght_docs_edit', '[Documents] Ajout/Edition', NULL, '10', '', 1), ('rght_docs_admin', '[Documents] Suppression/Administration', NULL, '10', '', 1);[END]

CREATE TABLE `{DB_PREFIX}docs` (`id` int( 10 ) NOT NULL AUTO_INCREMENT ,`entreprise_id` int( 5 ) NOT NULL ,`reference` varchar( 100 ) NOT NULL ,`type_id` int( 3 ) NOT NULL ,`date` varchar( 25 ) NOT NULL ,`agence_id` int( 3 ) NOT NULL ,`commentaire` text,`path` varchar( 255 ) NOT NULL ,PRIMARY KEY ( `id` )) ENGINE = MYISAM DEFAULT CHARSET = latin1;[END]

CREATE TABLE `{DB_PREFIX}docs_type` (`id` int( 3 ) NOT NULL AUTO_INCREMENT ,`libelle` varchar( 255 ) default NULL , PRIMARY KEY ( `id` )) ENGINE = MYISAM DEFAULT CHARSET = latin1;[END]

INSERT INTO `{DB_PREFIX}docs_type` ( `id` , `libelle` ) VALUES ( 1, 'Facture' ) , ( 2, 'Contrat' ) , ( 3, 'Manuel' ) , ( 4, 'Garantie' ) , ( 5, 'Bon d\'intervention' ) ;[END]

CREATE TABLE `{DB_PREFIX}liaison_docs` (`id` int(10) NOT NULL auto_increment, `doc_id` int(10) NOT NULL, `hardware_id` int(10) NOT NULL, `periph_id` int(10) NOT NULL, `software_id` int(10) NOT NULL, PRIMARY KEY  (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1;[END]

INSERT INTO {DB_PREFIX}docs(id, entreprise_id, reference, type_id, date, agence_id, commentaire, path ) SELECT id, entreprise_id, reference, 1, UNIX_TIMESTAMP( date ) , agence_id, CONCAT(commentaire,' (Montant: ',montant,')'), CONCAT( reference, '_', date, '.pdf' ) FROM {TAB_FACTURE};[END]

INSERT INTO {DB_PREFIX}docs(id, entreprise_id, reference, type_id, date, agence_id, commentaire, path ) SELECT CONCAT('100', id), entreprise_id, reference, 2, UNIX_TIMESTAMP( date_debut ) , agence_id, CONCAT(commentaire,' (Loyer: ',loyer,' - ','Loyer sur ',loyer_duree_mois,' moi(s) - ','Durée: ',duree_mois,' moi(s) - ','Durée préavis: ',duree_preavis_mois,'moi(s) ) '), CONCAT( reference, '_', date_debut, '.pdf' ) FROM {TAB_CONTRAT};[END]

DROP TABLE `{TAB_CONTRAT}`, `{TAB_CONTRAT_TYPE}`, `{TAB_FACTURE}`, `{TAB_FACTURE_TYPE}`;[END]

INSERT INTO {DB_PREFIX}liaison_docs(doc_id, hardware_id, periph_id, software_id ) SELECT CONCAT('100', contrat_id), hardware_id, periph_id, software_id FROM {TAB_LIAISON_CO_FAC} WHERE contrat_id<>'0';[END]

INSERT INTO {DB_PREFIX}liaison_docs( doc_id, hardware_id, periph_id, software_id ) SELECT facture_id, hardware_id, periph_id, software_id FROM {TAB_LIAISON_CO_FAC} WHERE facture_id<>'0';[END]

DROP TABLE `{TAB_LIAISON_CO_FAC}`;[END]

CREATE TABLE `{TAB_PLUGIN}` (`id` INT( 3 ) NOT NULL AUTO_INCREMENT PRIMARY KEY , `name` VARCHAR( 255 ) NOT NULL , `type` VARCHAR( 25 ) NOT NULL , `path` VARCHAR( 255 ) NOT NULL , `description` VARCHAR( 255 ) NOT NULL , `install_date` VARCHAR( 255 ) NOT NULL , `version` VARCHAR( 255 ) NOT NULL , `active` INT( 1 ) NOT NULL) ENGINE = MYISAM ;[END]

ALTER TABLE `{TAB_ENTREPRISE}` ADD `num_client` VARCHAR( 100 ) NOT NULL , ADD `note` LONGTEXT NOT NULL ;[END]

ALTER TABLE `{TAB_SOFT}` ADD `marque_id` INT( 3 ) NOT NULL AFTER `id`;[END]

INSERT INTO `{TAB_CONFIG}` ( `nom` , `libelle` , `description` , `valeur` , `form_type` , `globale` ) VALUES ('param_debug_mode', 'Activer le mode debug', 'Affiche les requètes SQL, les erreurs PHP et SQL' , 0, 'radio_yn', 1);[END]
