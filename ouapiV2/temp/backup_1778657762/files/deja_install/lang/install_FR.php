<?php // Français

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                           OUAPI install pack                              *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$lang = array();

// En tete
$lang["language"] = 'Langue';
$lang["title"] = 'OUAPI - Installation';

// index.php
$lang["index_select"] = 'Sélectionnez votre type d\'installation';
$lang["index_first"] = 'Première installation';
$lang["index_maj"] = 'Mise à jour';

//Etapes
$lang["e1_title"] = 'Etape 1: Introduction à OUAPI';
$lang["e1_subtitle"] = 'Bienvenue dans OUAPI !';
$lang["e1_intro"] = '<b>OUAPI</b> (<b>OU</b>til d\'<b>A</b>dministration de <b>P</b>arc <b>I</b>nformatique)
est une solution libre sous licence GNU/GPL de gestion de parc informatique. Cet outil
qui se veut simple et convivial, permet de gérer efficacement de petits et moyens parcs de
machines. Facile d\'installation, un simple PC équipé d\'un serveur web (Apache / IIS) supportant 
PHP et MySQL suffit à son installation. OUAPI peut également être connecté à un serveur LDAP et/ou à un serveur OCS
pour faciliter la récupération de données !<br/><br/>

OUAPI a été testé sur les plateformes suivantes:
<ul>
<li> Wampserver 1.7.0 et ultérieurs</li>
<li> WampMSS 1.1.1</li>
<li> Xamp 1.6.6a</li>
</ul>
OUAPI est également compatible avec les navigateurs suivants:
<ul>
<li> Firefox 3 et ultérieurs</li>
<li> Internet Explorer 7 et ultérieus</li>
<li> Opera 10.5 et ultérieurs</li>
<li> Chrome 7.0 et ultérieurs</li>
<li> Safari 5.1 et ultérieurs (Iphone)</li>
<li> Samsung web browser (Galaxy S...)</li>
</ul>

Cet utilitaire vous guidera tout au long du processus d\'installation. ';
$lang["e2_title"] = 'Etape 2: Acceptation de la licence';
$lang["e2_intro"] = 'Avant de pouvoir commencer l\'installation et d\'utiliser ce programme, merci de prendre connaissance de la licence ci dessous et de l\'accepter:';
$lang["e2_rightserror"] = '<u>Erreur:</u> le système n\'a pas les droits nécessaires pour accéder au fichier de licence. Veuillez vérifier les droits en lecture du répertoire <b>ouapi/docs/</b> et des fichier qu\'il contient.';
$lang["e3_title"] = 'Etape 3: Questions Générales';
$lang["e3_intro"] = 'Instructions: Répondez à ces questions avec attention: elles vont permettre de déterminer le type
d\'installation du logiciel OUAPI en fonction de l\'organisation de votre structure et de la manière dont vous souhaiter utiliser
le logiciel.';
$lang["e4_title"] = 'Etape 4: Paramètres SQL / OCS / LDAP';
$lang["e5_title"] = 'Etape 5: Autres paramètres';
$lang["e6_title"] = 'Etape 6: Vérification des paramètres';
$lang["e6_intro"] = 'Cette étape vérifie que les paramètres que vous avez saisis lors des étapes précédente sont corrects.
Vous ne pourrez accéder à l\'étape finale tant qu\'il subsistera une erreur.';
$lang["e7_title"] = 'Etape finale: Création / Fin';
$lang["e7_ss_titre"] = 'Votre installation est maintenant terminée !';
$lang["e7_intro"] = 'Vous pouvez utiliser OUAPI en vous rendant à la <a href="../">page d\'accueil</a>.
Avant cela et pour des raisons de sécurité, n\'oubliez pas de supprimer ou renommer le répertoire install/, sans
quoi vous ne pourrez accéder au logiciel.<br/><br/>Rendez vous sur le <a href="http://forum.ouapi.org">Forum Ouapi</a> pour nous signaler
tout bug, nous soutenir ou obtenir un support en cas de problème.<br/><br/>
Merci d\'avoir choisi OUAPI !';
$lang["accept"] = 'J\'accepte';
$lang["refuse"] = 'Je refuse';
$lang["etape_suiv"] = 'Etape suivante';
$lang["etape_prec"] = 'Etape précédente';
$lang["reset"] = 'Reset';

$lang["install_tabstart"] = 'Début';
$lang["install_tab1"] = '1';
$lang["install_tab2"] = '2';
$lang["install_tab3"] = '3';
$lang["install_tab4"] = '4';
$lang["install_tab5"] = '5';
$lang["install_tab6"] = '6';
$lang["install_tabend"] = 'Fin';

// Général
$lang["yes"] = 'Oui';
$lang["no"] = 'Non';
$lang["retry"] = 'Recommencer';
$lang["parameters"] = 'Paramètres';
$lang["answers"] = 'Réponses';
$lang["result"] = 'Résultat';
$lang["test"] = 'Test';
$lang["multisite"] = 'Gérez vous plusieurs sites ?';
$lang["check_sites"] = 'Cochez "Oui" si votre structure est composée de plusieurs sites, "Non" dans le cas contraire.';
$lang["login_type"] = 'Comment souhaitez vous vous connecter ?';
$lang["check_login"] = 'Cochez "Reverse DNS" si vous souhaitez vous authentifier par nom de machine: lors de la connexion, 
le programme reconnaitra le nom du matériel, recherchera l\'utilisateur associé et lui attribuera les droits adéquats 
(Attention, ce type de login ne fonctionne pas sur tous les types de plateforme !) ou à défaut le redirigera vers une identification "Traditionnelle" User/MDP. 
Pour une authentification "traditionnelle", cocher "User/Pass".';
$lang["ocs"] = 'Utilisez vous OCS Inventory ?';
$lang["check_ocs"] = 'Cochez "Oui" si vous utilisez OCS Inventory, "Non" dans le cas contraire.';
$lang["dns_rev"] = 'Reverse DNS';
$lang["user_pass"] = 'User/Pass';
$lang["ldap"] = 'Utilisez vous LDAP ?';
$lang["check_ldap"] = 'Cochez "Oui" si vous possédez un serveur LDAP, "Non" dans le cas contraire.';
$lang["mysql_param"] = 'Paramètres MySQL pour OUAPI';
$lang["mysql_server"] = 'Serveur MySQL';
$lang["mysql_server_desc"] = 'Nom d\'hôte ou adresse IP du serveur MySQL qui contiendra votre base de données.';
$lang["mysql_login"] = 'Login MySQL';
$lang["mysql_login_desc"] = 'Nom d\'utilisateur pour l\'accès à vore serveur MySQL.';
$lang["mysql_pass"] = 'Mot de passe MySQL';
$lang["mysql_pass_desc"] = 'Mot de passe pour l\'accès à votre serveur MySQL.';
$lang["mysql_database"] = 'Nom de la base de données MySQL';
$lang["mysql_database_desc"] = 'Nom de la base de données MySQL qui contiendra les données OUAPI. Note: vous devez la créer manuellement sur votre serveur.';
$lang["mysql_prefixe"] = 'Prefixe des tables MySQL';
$lang["mysql_prefixe_desc"] = 'Prefixe des tables OUAPI dans votre base MySQL. A utiliser surtout si la base est partagée avec d\'autres logiciels.';
$lang["ocs_mysql_param"] = 'Paramètres MySQL pour OCS';
$lang["ocs_mysql_server"] = 'Serveur MySQL OCS';
$lang["ocs_mysql_server_desc"] = 'Nom d\'hôte ou adresse IP du serveur MySQL contenant les données OCS.';
$lang["ocs_mysql_login"] = 'Login MySQL OCS';
$lang["ocs_mysql_login_desc"] = 'Nom d\'utilisateur pour l\'accès à votre serveur MySQL contenant les données OCS';
$lang["ocs_mysql_pass"] = 'Mot de passe MySQL OCS';
$lang["ocs_mysql_pass_desc"] = 'Mot de passe pour l\'accès à votre serveur MySQL contenant les données OCS.';
$lang["ocs_mysql_database"] = 'Nom de la base de données MySQL OCS';
$lang["ocs_mysql_database_desc"] = 'Nom de la base de données MySQL qui contient vos données OCS.';
$lang["admin_param"] = 'Paramètres d\'administration';
$lang["admin_param_desc"] = 'Paramètres d\'administration';
$lang["admin_login"] = 'Login administrateur';
$lang["admin_login_desc"] = 'Définissez le login Administrateur de OUAPI.';
$lang["admin_mail"] = 'Adresse mail de l\'administrateur';
$lang["admin_mail_desc"] = 'Saisissez l\'adresse mail de l\'administrateur de OUAPI';
$lang["admin_pass"] = 'Mot de passe administrateur';
$lang["admin_pass_desc"] = 'Définissez le mot de passe Administrateur de OUAPI';
$lang["admin_pass_confirm"] = 'Confirmation Mot de passe';
$lang["admin_pass_confirm_desc"] = 'Confirmez le mot de passe de l\'Administrateur de OUAPI';
$lang["ldap_param"] = 'Paramètres LDAP';
$lang["ldap_server"] = 'Serveur LDAP';
$lang["ldap_server_desc"] = 'Nom d\'hôte ou adresse IP du serveur LDAP.';
$lang["ldap_port"] = 'Port serveur LDAP';
$lang["ldap_port_desc"] = 'Port du serveur LDAP';
$lang["ldap_root"] = 'Racine LDAP Utilisateurs';
$lang["ldap_root_desc"] = 'Racine de recherche des Utilisateurs de votre annuaire (Ex: OU=Users,DC=monentreprise,DC=com).';
$lang["ldap_root_hard"] = 'Racine LDAP Ordinateurs';
$lang["ldap_root_hard_desc"] = 'Racine de recherche des Ordinateurs de votre annuaire (Ex: OU=Computers,DC=monentreprise,DC=com).';
$lang["ldap_user"] = 'Nom d\'utilisateur LDAP';
$lang["ldap_user_desc"] = 'Nom d\'utilisateur pour l\'accès à votre annuaire LDAP';
$lang["ldap_pass"] = 'Mot de passe LDAP';
$lang["ldap_pass_desc"] = 'Mot de passe pour l\'accès à votre annuaire LDAP';
$lang["main_site"] = 'Siège';
$lang["general_param"] = 'Paramètres généraux';
$lang["principal_site_name"] = 'Nom du site principal';
$lang["principal_site_name_desc"] = 'Nom du premier site (si vous avez activé la gestion multisite) à créer dans OUAPI.';
$lang["param_help"] = 'Affichage de l\'aide';
$lang["param_help_desc"] = 'Affichage des bulles d\'aide dans les différentes rubriques de OUAPI.';

$lang["admin_test"] = 'Vérification des informations Administrateur OUAPI.';
$lang["admin_ok"] = 'Login/Mot de passe administrateur correct.';
$lang["admin_nok"] = 'Login/Mot de passe administrateur incorrect. Vérifiez que les 2 mots de passe correspondent et ne sont pas vides.';
$lang["serveur_test"] = 'Test de connexion au serveur MySQL.';
$lang["serveur_ok"] = 'Connexion au serveur réussie.';
$lang["serveur_nok"] = 'Connexion au serveur échouée - Vérifiez le nom de votre serveur, de l\'utilisateur et le mot de passe de connexion.';
$lang["bdd_test"] = 'Test d\'accès à la base de données.';
$lang["bdd_ok"] = 'Connexion à la base de données réussie.';
$lang["bdd_nok"] = 'Connexion à la base de données échouée. Vérifiez le nom de votre base et que celle ci existe bien.';
$lang["tables_test"] = 'Test de vérification que la base MySQL est vide.';
$lang["tables_ok"] = 'Tables inexistantes.';
$lang["tables_nok"] = 'Tables existantes. Supprimez les tables ou changez le préfixe de celles-ci.';
$lang["ocs_serveur_test"] = 'Test de connexion au serveur OCS.';
$lang["ocs_serveur_ok"] = 'Connexion au serveur OCS réussie.';
$lang["ocs_serveur_nok"] = 'Connexion au serveur OCS échouée. Vérifiez l\'adresse du serveur, le nom d\'utilisateur et mot de passe de connexion.';
$lang["ldap_serveur_test"] = 'Test de connexion au serveur LDAP.';
$lang["ldap_serveur_ok"] = 'Connexion au serveur LDAP réussie.';
$lang["ldap_serveur_nok"] = 'Connexion au serveur LDAP échouée. Vérifiez l\'adresse du serveur, le nom d\'utilisateur et mot de passe de connexion.';
$lang["ldap_ext_test"] = 'Test d\'activation de l\'extension LDAP de PHP.';
$lang["ldap_ext_ok"] = 'L\'extension LDAP est activée.';
$lang["ldap_ext_nok"] = 'Connexion au serveur LDAP échouée. L\'extension LDAP n\'est pas activée.';
$lang["ldap_ext_nok_text"] = 'Modifiez votre fichier PHP.ini pour activer l\'extension (Décommentez la ligne "extension=php_ldap.dll").';
$lang["ocs_bdd_test"] = 'Test de connexion à la base de données OCS réussie.';
$lang["ocs_bdd_ok"] = 'Connexion à la base de données OCS réussie.';
$lang["ocs_bdd_nok"] = 'Connexion à la base de données OCS échouée. Vérifiez le nom de votre base et que celle ci existe bien.';
$lang["conf_file_test"] = 'Test de création du fichier config/config.php.';
$lang["conf_file_ok"] = 'Fichier de configuration créé.';
$lang["conf_file_nok"] = 'Erreur: Fichier de configuration non créé. Vérifiez les droits du répertoire config/';
$lang["install_nok"] = 'Erreur générale, veuillez fermer votre navigateur, recréer votre base et recommencer l\'installation.';
$lang["install_ok"] = 'Tous les paramètres sont corrects.';

// Install OCS
$lang["install_ocs_server"] = 'Serveur OCS';
$lang["install_ocs_serverdesc"] = 'Nom ou adresse IP du serveur OCS';
$lang["install_ocs_user"] = 'Utilisateur OCS';
$lang["install_ocs_userdesc"] = 'Login de connexion au serveur OCS';
$lang["install_ocs_pass"] = 'Mot de passe OCS';
$lang["install_ocs_passdesc"] = 'Mot de passe de connexion au serveur OCS';
$lang["install_ocs_base"] = 'Base OCS';
$lang["install_ocs_basedesc"] = 'Nom de la base MySQL OCS';
$lang["install_ocs_activrub"] = 'Activer la rubrique OCS';
$lang["install_ocs_activrubdesc"] = 'Active ou désative la rubrique OCS de OUAPI';
$lang["install_ocs_"] = '';


// Install LDAP
$lang["install_ldap_server"] = 'Serveur LDAP';
$lang["install_ldap_serverdesc"] = 'Nom ou adresse IP du serveur LDAP';
$lang["install_ldap_user"] = 'Utilisateur LDAP';
$lang["install_ldap_userdesc"] = 'Login de connexion au serveur LDAP';
$lang["install_ldap_pass"] = 'Mot de passe LDAP';
$lang["install_ldap_passdesc"] = 'Mot de passe de connexion au serveur LDAP';
$lang["install_ldap_port"] = 'Port LDAP';
$lang["install_ldap_portdesc"] = 'Port de connexion au serveur LDAP';
$lang["install_ldap_root"] = 'Racine LDAP Utilisateurs';
$lang["install_ldap_rootdesc"] = 'Racine de recherche LDAP Utilisateurs par défaut';
$lang["install_ldap_root_hard"] = 'Racine LDAP Ordinateurs';
$lang["install_ldap_rootdesc_hard"] = 'Racine de recherche LDAP Ordinateurs par défaut';
$lang["install_ldap_attrfname"] = 'Attribut Prénom';
$lang["install_ldap_attrfnamedesc"] = 'Champ LDAP contenant le prénom de vos utilisateurs';
$lang["install_ldap_attrlname"] = 'Attribut Nom';
$lang["install_ldap_attrlnamedesc"] = 'Champ LDAP contenant le nom de vos utilisateurs';
$lang["install_ldap_attrmail"] = 'Attribut Mail';
$lang["install_ldap_attrmaildesc"] = 'Champ LDAP contenant le mail de vos utilisateurs';
$lang["install_ldap_attrloginwin"] = 'Attribut Login Windows';
$lang["install_ldap_attrloginwindesc"] = 'Champ LDAP contenant le login de vos utilisateurs';
$lang["install_ldap_attrhardname"] = 'Attribut Nom de machine';
$lang["install_ldap_attrhardnamedesc"] = 'Champ LDAP contenant le nom de vos machines';
$lang["install_ldap_attrharddescription"] = 'Attribut Description';
$lang["install_ldap_attrharddescriptiondesc"] = 'Champ LDAP contenant la description de vos machines';
$lang["install_ldap_attrhardcreated"] = 'Attribut Création';
$lang["install_ldap_attrhardcreateddesc"] = 'Champ LDAP contenant la date de création de vos machines';
$lang["install_ldap_key"] = 'Clé LDAP <-> OUAPI';
$lang["install_ldap_keydesc"] = 'Champ faisant le lien entre OUAPI et LDAP pour les Utilisateurs';
$lang["install_ldap_key_hard"] = 'Clé LDAP <-> OUAPI';
$lang["install_ldap_keydesc_hard"] = 'Champ faisant le lien entre OUAPI et LDAP pour les PC';
$lang["install_ldap_activrub"] = 'Activer la rubrique LDAP';
$lang["install_ldap_activrubdesc"] = 'Active ou désative la rubrique LDAP de OUAPI';

$lang["install_ldap_"] = '';

// Bas de page
$lang["copyright"] = 'Copyright &copy; Nicolas BIDET 2007-2013';
$lang[""] = '';

// MAJ
$lang["maj_title"] = 'Mise à jour';
$lang["maj_title"] = 'Mise à jour de Ouapi';
$lang["maj_title1"] = 'Etape 1: Vérification des paramètres';
$lang["maj_title2"] = 'Etape 2: Modification de fichiers';
$lang["maj_title3"] = 'Etape 3: Controle des requêtes';
$lang["maj_title4"] = 'Fin de la mise à jour: résultat des requêtes';
$lang["maj_disclamer"] = 'Attention ! Veillez à faire une sauvegarde de votre base SQL et de vos fichiers avant toute mise à jour !';
$lang["maj_paramcheck"] = 'Vérifiez les paramètres suivants:';
$lang["maj_ouapibase"] = 'Base Ouapi:';
$lang["maj_currentversion"] = 'Version actuelle de Ouapi:';
$lang["maj_etape1"] = 'Etape 1 >';
$lang["maj_etape2"] = 'Etape 2 >';
$lang["maj_etape3"] = 'Etape 3 >';
$lang["maj_button"] = 'Mettre à jour !';
$lang["maj_choosever"] = 'Choisissez vers quelle version mettre à jour:';
$lang["maj_nomajauto"] = 'Aucun fichier de mise à jour trouvé pour votre version.';
$lang["maj_invalidbase"] = 'La base spécifiée est invalide.';
$lang["maj_invalidversion"] = 'La version spécifiée ne correspond pas.';
$lang["maj_validbase"] = 'La base spécifiée est correcte.';
$lang["maj_validversion"] = 'La version spécifiée est cohérente.';
$lang["maj_back"] = '< Retour';
$lang["maj_tabstart"] = 'Début';
$lang["maj_tab1"] = '1';
$lang["maj_tab2"] = '2';
$lang["maj_tab3"] = '3';
$lang["maj_tabend"] = 'Fin';
$lang["maj_ok"] = 'OK';
$lang["maj_nofilemaj"] = 'Aucun fichier n\'est a modifier pour cette version.<br/>Vous pouvez passer à l\'étape suivante.';
$lang["maj_filename"] = 'Fichier: ';
$lang["maj_after"] = 'Après les lignes:';
$lang["maj_add"] = 'Ajouter le code suivant:';
$lang["maj_fileedit"] = 'Cette étape est à faire manuellement: modifiez les fichiers spécifiés en suivant les instructions suivantes.';
$lang["maj_deleteif"] = 'Si elles existent, supprimez les lignes suivantes:';
$lang["maj_reqcontrol"] = 'Les requêtes suivantes vont être exécutées sur votre base:';
$lang["maj_homepage"] = 'Page d\'accueil de OUAPI';
$lang["maj_success"] = 'Mise à jour terminée !';
$lang["maj_"] = '';
?>