UPDATE `{TAB_CONFIG}` SET `valeur` = '1.5' WHERE `{TAB_CONFIG}`.`nom` = 'gen_version';[END]
INSERT INTO `{TAB_CONFIG}` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('rght_sum', '', 'Show summary button', 'Show summary button', 'SUM1', 'radio_yn', '1');[END]
INSERT INTO `{TAB_CONFIG}` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('activrub_sum', '', 'Show summary button', 'Show summary button', '1', 'radio_yn', '1');[END]
INSERT INTO `{TAB_CONFIG}` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_hard_os', 'hard', 'Operating System attribute', 'LDAP field containing the computers\' Operating System' , 'operatingsystem', 'list', '1');[END]
ALTER TABLE `{TAB_HARD_MODELE}` ADD `img_path` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT  'Image path';[END]
ALTER TABLE `{TAB_PERIPH_MODELE}` ADD `img_path` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT  'Image path';[END]
ALTER TABLE `{TAB_RESA}` ADD `site_id` INT(4)  NOT NULL COMMENT  'site-id' AFTER `id`;[END]
ALTER TABLE `{TAB_USERS_PS}` ADD `display_groupcol` VARCHAR( 255 ) NOT NULL;[END]
ALTER TABLE `{TAB_USERS_PS}` ADD `display_sortcol` VARCHAR( 255 ) NOT NULL;[END]
UPDATE `{TAB_USERS_PS}` SET `subcategory` = 'user' WHERE `{UT_PS_CATEGORY}` = 'ldap' AND `{UT_PS_SUBCATEGORY}` = 'users';[END]
UPDATE `{TAB_USERS_PS}` SET `display_settings` = '{TAB_PERIPH}.{PE_NAME};{TAB_PERIPH_MARQUE}.{PE_MA_LIBELLE};{TAB_PERIPH_MODELE}.{PE_MO_LIBELLE};' WHERE `{UT_PS_USERID}` = 0 AND `{UT_PS_CATEGORY}` = 'resa' AND `{UT_PS_SUBCATEGORY}` = 'periph';[END]
UPDATE `{TAB_USERS_PS}` SET `display_groupcol` = '{TAB_DOCS_TYPE}.{DO_TY_LIBELLE}' WHERE `{TAB_USERS_PS}`.`{UT_PS_CATEGORY}` = 'docs';[END]
UPDATE `{TAB_USERS_PS}` SET `display_groupcol` = '{TAB_HARD_TYPE}.{HA_TY_LIBELLE}' WHERE `{TAB_USERS_PS}`.`{UT_PS_CATEGORY}` = 'hard';[END]
UPDATE `{TAB_USERS_PS}` SET `display_groupcol` = '{TAB_PERIPH_TYPE}.{PE_TY_LIBELLE}' WHERE `{TAB_USERS_PS}`.`{UT_PS_CATEGORY}` = 'periph';[END]
UPDATE `{TAB_USERS_PS}` SET `display_groupcol` = '{TAB_HARD_TYPE}.{HA_TY_LIBELLE}' WHERE `{UT_PS_CATEGORY}` = 'resa' AND `{UT_PS_SUBCATEGORY}` = 'hard';[END]
UPDATE `{TAB_USERS_PS}` SET `display_groupcol` = '{TAB_PERIPH_TYPE}.{PE_TY_LIBELLE}' WHERE `{UT_PS_CATEGORY}` = 'resa' AND `{UT_PS_SUBCATEGORY}` = 'periph';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{TAB_HARD}.{HA_NAME}' WHERE `{UT_PS_CATEGORY}` = 'hard';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{TAB_PERIPH}.{PE_NAME}' WHERE `{UT_PS_CATEGORY}` = 'periph';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{TAB_SOFT}.{SO_NAME}' WHERE `{UT_PS_CATEGORY}` = 'soft';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{TAB_DOCS}.{DO_DATE}' WHERE `{UT_PS_CATEGORY}` = 'docs';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{TAB_RESEAU}.{RE_PLUGNUMBER}' WHERE `{UT_PS_CATEGORY}` = 'netw';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{TAB_USERS}.{US_LNAME}' WHERE `{UT_PS_CATEGORY}` = 'users';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{TAB_HARD}.{HA_NAME}' WHERE `{UT_PS_CATEGORY}` = 'resa' AND `{UT_PS_SUBCATEGORY}` = 'hard';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{TAB_PERIPH}.{PE_NAME}' WHERE `{UT_PS_CATEGORY}` = 'resa' AND `{UT_PS_SUBCATEGORY}` = 'periph';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{LDAP_ATTR_MAIL}' WHERE `{UT_PS_CATEGORY}` = 'ldap' AND `{UT_PS_SUBCATEGORY}` = 'user';[END]
UPDATE `{TAB_USERS_PS}` SET `display_sortcol` = '{LDAP_ATTR_HARD_NAME}' WHERE `{UT_PS_CATEGORY}` = 'ldap' AND `{UT_PS_SUBCATEGORY}` = 'hard';[END]
ALTER TABLE `{TAB_DOCS}` ADD `date_archive` VARCHAR( 25 ) NOT NULL AFTER `date`;[END]
INSERT INTO `{TAB_USERS_PS}` (`user_id` ,`category` ,`subcategory` ,`display_settings`, `display_sortcol`) VALUES ('0', 'ocs', 'hard', 'hardware.NAME;bios.TYPE;hardware.IPADDR;hardware.USERID;bios.SSN;hardware.LASTDATE;','hardware.NAME');[END]
INSERT INTO `{TAB_USERS_PS}` (`user_id` ,`category` ,`subcategory` ,`display_settings`, `display_sortcol`) VALUES ('0', 'ocs', 'soft', 'softwares.NAME;softwares.VERSION;softwares.PUBLISHER;','softwares.NAME');[END]
INSERT INTO `{TAB_USERS_PS}` (`user_id` ,`category` ,`subcategory` ,`display_settings`, `display_sortcol`) VALUES ('0', 'ocs', 'monitor', 'hardware.NAME;monitors.CAPTION;monitors.MANUFACTURER;monitors.SERIAL;','monitors.CAPTION');[END]
INSERT INTO `{TAB_USERS_PS}` (`user_id` ,`category` ,`subcategory` ,`display_settings`, `display_sortcol`) VALUES ('0', 'ocs', 'modem', 'hardware.NAME;modems.NAME;modems.MODEL;','modems.NAME');[END]
INSERT INTO `{TAB_USERS_PS}` (`user_id` ,`category` ,`subcategory` ,`display_settings`, `display_sortcol`) VALUES ('0', 'ocs', 'printer', 'hardware.NAME;printers.NAME;printers.DRIVER;printers.PORT;','printers.NAME');[END]
INSERT INTO `{TAB_USERS_PS}` (`user_id` ,`category` ,`subcategory` ,`display_settings`, `display_sortcol`) VALUES ('0', 'ocs', 'input', 'hardware.NAME;inputs.CAPTION;inputs.TYPE;inputs.INTERFACE;','inputs.CAPTION');[END]

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;[END]

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

INSERT INTO `{TAB_CONFIG}` (`id` ,`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES (NULL , 'rght_even', '', '[Section Events] Niv. 1 : Read', NULL , 'EVEN1', '', '1');[END]
INSERT INTO `{TAB_CONFIG}` (`id` ,`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES (NULL , 'rght_even_edit', '', '[Section Events] Niv. 2 : Write', NULL , 'EVEN2', '', '1');[END]
INSERT INTO `{TAB_CONFIG}` (`id` ,`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES (NULL , 'rght_even_admin', '', '[Section Events] Niv. 3 : Administration', NULL , 'EVEN3', '', '1');[END]
INSERT INTO `{TAB_CONFIG}` (`id` ,`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES (NULL , 'activrub_even', 'rub', 'Activate Events section', 'Active / deactive the Events section', '1', 'radio_yn', '1');[END]

ALTER DATABASE CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_AGENCES}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_EMPL}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_ENTREPRISE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_CONFIG}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_DOCS}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_DOCS_TYPE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_HARD}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_HARD_TYPE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_HARD_MARQUE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_HARD_MODELE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_HARD_OS}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_PERIPH}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_PERIPH_TYPE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_PERIPH_MARQUE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_PERIPH_MODELE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_PLUGIN}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_RESEAU}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_RESA}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_SOFT}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_SOFT_MARQUE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_SOFT_OCS_ALIAS}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_SOFT_LICENCE}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_LIAISON_DOCS}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_HARDSOFT}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_USERS}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_USERS_GRP}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_USERS_PS}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_USERS_PL}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_EVEN}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_EVEN_STATUS}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]
ALTER TABLE `{TAB_EVEN_LINK}` CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;[END]