UPDATE `{TAB_CONFIG}` SET `valeur` = '1.4' WHERE `{TAB_CONFIG}`.`nom` = 'gen_version';[END]
INSERT INTO `{TAB_CONFIG}` (nom,libelle,valeur) VALUES ('gen_statsdate','Date d\'envoi des stats','');[END]
INSERT INTO `{TAB_CONFIG}` (nom,libelle,valeur) VALUES ('gen_statsyn','Activation de l\'envoi des stats',1);[END]
INSERT INTO `{TAB_CONFIG}` (nom,libelle,valeur) VALUES ('gen_dateinstall','Date d\'installation de OUAPI',UNIX_TIMESTAMP());[END]
INSERT INTO `{TAB_CONFIG}` (nom,libelle,valeur) VALUES ('gen_datelastmaj','Date de dernière MAJ de OUAPI',UNIX_TIMESTAMP());[END]
INSERT INTO `{TAB_CONFIG}` (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_mask_hard', 'Racine LDAP Ordinateurs', 'Racine de recherche LDAP Ordinateurs par défaut' , '', 'text', '1');[END]
INSERT INTO `{TAB_CONFIG}` (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_key_hard', 'Clé LDAP <-> OUAPI', 'Champ faisant le lien entre OUAPI et LDAP pour les PC' , 'nom;name', 'list', '1');[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'users' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_attr_mail';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'users' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_attr_lname';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'users' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_attr_fname';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'users' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_attr_loginwin';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'users' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_key';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'users' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_mask';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'general' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_host';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'general' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_user';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'general' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_mdp';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'general' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_port';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'hard' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_key_hard';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'hard' WHERE `{TAB_CONFIG}`.`nom` = 'ldap_mask_hard';[END]
UPDATE `{TAB_CONFIG}` SET `form_type` = 'text' WHERE nom LIKE 'ldap_mask%';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'default_userparam', `description` = 'Langue par défaut' WHERE `{TAB_CONFIG}`.`nom` = 'default_language';[END]
UPDATE `{TAB_CONFIG}` SET `subcategory` = 'default_userparam', `description` = 'Thème par défaut' WHERE `{TAB_CONFIG}`.`nom` = 'default_template';[END]
INSERT INTO `{TAB_CONFIG}` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_hard_name', 'hard', 'Attribut Nom de machine', 'Champ LDAP contenant le nom de vos machines' , 'name', 'list', '1');[END]
UPDATE ouapi_ut_personalsettings SET subcategory='users' WHERE category='ldap';[END]
INSERT INTO `ouapi_ut_personalsettings` (`user_id` ,`category` ,`subcategory` ,`display_settings`) VALUES ('0', 'ldap', 'hard', 'LDAP_ATTR_HARD_NAME;LDAP_ATTR_HARD_DESCRIPTION;');[END]
INSERT INTO `{TAB_CONFIG}` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_hard_description', 'hard', 'Attribut Description', 'Champ LDAP contenant la description de vos machines' , 'description', 'list', '1');[END]
INSERT INTO `{TAB_CONFIG}` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_hard_created', 'hard', 'Attribut Création', 'Champ LDAP contenant la date de création de vos machines' , 'whencreated', 'list', '1');[END]
INSERT INTO `{TAB_CONFIG}` (`nom`, `subcategory` , `libelle`, `description`, `valeur`, `form_type`, `globale`) VALUES 
('activrub_users', 'rub' , 'Activer la rubrique Utilisateurs', 'Active ou désative la rubrique utilisateurs de OUAPI', 1, 'radio_yn', 1),
('activrub_netw', 'rub' , 'Activer la rubrique Réseau', 'Active ou désative la rubrique réseau de OUAPI', 1, 'radio_yn', 1),
('activrub_docs', 'rub' , 'Activer la rubrique Documents', 'Active ou désative la rubrique documents de OUAPI', 1, 'radio_yn', 1),
('activrub_resa', 'rub' , 'Activer la rubrique Réservation', 'Active ou désative la rubrique réservation de OUAPI', 1, 'radio_yn', 1),
('activrub_soft', 'rub' , 'Activer la rubrique Logiciels', 'Active ou désative la rubrique logiciels de OUAPI', 1, 'radio_yn', 1),
('activrub_periph', 'rub' , 'Activer la rubrique Périphériques', 'Active ou désative la rubrique périphériques de OUAPI', 1, 'radio_yn', 1),
('activrub_hard', 'rub' , 'Activer la rubrique Matériels', 'Active ou désative la rubrique matériels de OUAPI', 1, 'radio_yn', 1),
('activrub_ocs', 'rub' , 'Activer la rubrique OCS', 'Active ou désative la rubrique OCS de OUAPI', 1, 'radio_yn', 1),
('activrub_ldap', 'rub' , 'Activer la rubrique LDAP', 'Active ou désative la rubrique LDAP de OUAPI', 1, 'radio_yn', 1);[END]
