<?php // English

/****************************************************************************
*                                                                           *
*       Copyright (c) 2008-2014 Nicolas BIDET / Christophe Toussaint			  *
*                           OUAPI install pack                              *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$lang = array();

// Header
$lang["language"] = 'Language';
$lang["title"] = 'OUAPI - Installation';

// index.php
$lang["index_select"] = 'Please select the type of installation';
$lang["index_first"] = 'First installation';
$lang["index_maj"] = 'Update';

//Etapes
$lang["e1_title"] = 'Step 1: Introduction';
$lang["e1_subtitle"] = 'Welcome in OUAPI !';
$lang["e1_intro"] = '<b>OUAPI</b> 
(<b>OU</b>til d\'<b>A</b>dministration de <b>P</b>arc <b>I</b>nformatique / IT fleet management tool) 
is free software under the terms of the GNU General Public License as published by the Free Software Foundation. This is an easy-to-use tool, able to manage efficiently all your IT fleet or your customer systems.
Easy to install and configure, only a simple computer with a common web server installed supporting PHP (Apache / IIS) and MySQL is needed.
OUAPI can be easily connected to a LDAP server and/or to an OCS server in order to facilitate data\'s retrieval!<br/><br/>
OUAPI has been tested on these following configurations:
<ul>
<li> Wampserver 1.7.0 and higher</li>
<li> WampMSS 1.1.1</li>
<li> Xamp 1.6.6a</li>
</ul>
OUAPI is also compatible with these following web browser:
<ul>
<li> Firefox 3 and higher</li>
<li> Internet Explorer 7 and higher</li>
<li> Opera 10.5 and higher</li>
<li> Chrome 7.0 and higher</li>
<li> Safari 5.1 and higher (Iphone)</li>
<li> Samsung default web browser (Galaxy S...)</li>
</ul>

You will be guided through the installation... ';
$lang["e2_title"] = 'Step 2: License';
$lang["e2_intro"] = 'Before you can begin installing and using this program, thank you to read the license below and accept it:';
$lang["e2_rightserror"] = '<u>Error:</u> The system does not have the necessary rights to access the license file. Please check the read rights to the directory ouapi/docs/ and files it contains.';
$lang["e3_title"] = 'Step 3: Basics';
$lang["e3_intro"] = 'Instructions: Answer these questions carefully, it will determine the type of installation according to your IT infrastructure and your needs.';
$lang["e4_title"] = 'Step 4: SQL / OCS / LDAP settings';
$lang["e5_title"] = 'Step 5: Other settings';
$lang["e6_title"] = 'Step 6: Check settings';
$lang["e6_intro"] = 'This step checks if the settings you entered are correct.';
$lang["e7_title"] = 'Last step: Creation / End';
$lang["e7_ss_titre"] = 'The installation have been done successfully!';
$lang["e7_intro"] = 'To use OUAPI, go to <a href="../">Home page</a>.
For security reasons, do not forget to rename or remove the install/ folder.<br/><br/>Go to <a href="http://forum.ouapi.org">Ouapi Forum</a> to signal any problem, bug, to support us or to receive help.<br/><br/>
Thanks for using OUAPI !';
$lang["accept"] = 'I accept';
$lang["refuse"] = 'I DO NOT accept';
$lang["etape_suiv"] = 'Next step';
$lang["etape_prec"] = 'Previous step';
$lang["reset"] = 'Reset';

$lang["install_tabstart"] = 'Start';
$lang["install_tab1"] = '1';
$lang["install_tab2"] = '2';
$lang["install_tab3"] = '3';
$lang["install_tab4"] = '4';
$lang["install_tab5"] = '5';
$lang["install_tab6"] = '6';
$lang["install_tabend"] = 'End';

// Général
$lang["yes"] = 'Yes';
$lang["no"] = 'No';
$lang["retry"] = 'Retry';
$lang["parameters"] = 'Settings';
$lang["answers"] = 'Replies';
$lang["result"] = 'Result';
$lang["test"] = 'Test';
$lang["multisite"] = 'Multi-customer management?';
$lang["check_sites"] = 'Check "yes" if you will have to manage several customers, "No" otherwise.';
$lang["login_type"] = 'Connection type to OUAPI?';
$lang["check_login"] = 'Check "Reverse DNS" if you want to be authenticated by your computer name: before the connection, OUAPI will check the computer name and will search the associated user name and will give the privileges accordingly (Warning, does not work on all networks!) otherwise it will redirect to the standard authentication by USER/PW. 
For a standard authentication, check "User/Pass".';
$lang["ocs"] = 'Will you use OCS Inventory ?';
$lang["check_ocs"] = 'Check "Yes" if you use OCS Inventory, "No" otherwise.';
$lang["dns_rev"] = 'Reverse DNS';
$lang["user_pass"] = 'User/Pass';
$lang["ldap"] = 'Will you use LDAP ?';
$lang["check_ldap"] = 'Check "Yes" if you have a LDAP server, "No" otherwise.';
$lang["mysql_param"] = 'MySQL settings';
$lang["mysql_server"] = 'MySQL server';
$lang["mysql_server_desc"] = 'MySQL host name or IP address.';
$lang["mysql_login"] = 'MySQL login';
$lang["mysql_login_desc"] = 'MySQL user name';
$lang["mysql_pass"] = 'MySQL password';
$lang["mysql_pass_desc"] = 'Password for the MySQL server access.';
$lang["mysql_database"] = 'MySQL database name (collation: UTF8_unicode_ci)';
$lang["mysql_database_desc"] = 'MySQL database name for OUAPI datas. Note: You must create it manually.';
$lang["mysql_prefixe"] = 'MySQL tables\' prefix';
$lang["mysql_prefixe_desc"] = 'MySQL tables\' prefix of the OUAPI database. To be used if the database is shared with other software.';
$lang["ocs_mysql_param"] = 'MySQL settings for OCS';
$lang["ocs_mysql_server"] = 'MySQL server for OCS';
$lang["ocs_mysql_server_desc"] = 'MySQL host name or IP address containing OCS datas.';
$lang["ocs_mysql_login"] = 'MySQL login for OCS';
$lang["ocs_mysql_login_desc"] = 'Usernanme for the MySQL server access (containing the OCS datas)';
$lang["ocs_mysql_pass"] = 'MySQL password for OCS';
$lang["ocs_mysql_pass_desc"] = 'Password for the MySQL server access (containing the OCS datas).';
$lang["ocs_mysql_database"] = 'MySQL database name for OCS';
$lang["ocs_mysql_database_desc"] = 'MySQL database name (containing OCS datas).';
$lang["admin_param"] = 'Administration settings';
$lang["admin_param_desc"] = 'Administration settings';
$lang["admin_login"] = 'Administrator\'s login';
$lang["admin_login_desc"] = 'Define the OUAPI Administrator login.';
$lang["admin_mail"] = 'Administrator\'s email';
$lang["admin_mail_desc"] = 'Enter the OUAPI Administrator\'s email';
$lang["admin_pass"] = 'Administrator\'s password';
$lang["admin_pass_desc"] = 'Enter the OUAPI Administrator\'s password';
$lang["admin_pass_confirm"] = 'Confirm password';
$lang["admin_pass_confirm_desc"] = 'Confirm OUAPI Administrator\'s password';
$lang["ldap_param"] = 'LDAP settings';
$lang["ldap_server"] = 'LDAP server';
$lang["ldap_server_desc"] = 'LDAP server host name or IP address.';
$lang["ldap_port"] = 'LDAP server port';
$lang["ldap_port_desc"] = 'LDAP server port';
$lang["ldap_root"] = 'LDAP root for Users';
$lang["ldap_root_desc"] = 'Computer search root (Eg: OU=Computers,DC=mycompany,DC=com).';
$lang["ldap_root_hard"] = 'LDAP root Computers';
$lang["ldap_root_hard_desc"] = 'Computer search root (Eg: OU=Computers,DC=mycompany,DC=com).';
$lang["ldap_user"] = 'LDAP user name';
$lang["ldap_user_desc"] = 'Login for the connection to LDAP server';
$lang["ldap_pass"] = 'LDAP password';
$lang["ldap_pass_desc"] = 'Password for the connection to LDAP server';
$lang["main_site"] = 'Main';
$lang["general_param"] = 'General settings';
$lang["principal_site_name"] = 'Your company\'s name';
$lang["principal_site_name_desc"] = 'Your company\'s name (if you have activated the multi-customer management).';
$lang["param_help"] = 'Show help';
$lang["param_help_desc"] = 'Show tooltips.';

$lang["admin_test"] = 'Checking info about OUAPI Administrator.';
$lang["admin_ok"] = 'Username/password correct.';
$lang["admin_nok"] = 'Username/password NOT correct. Check if both passwords are identical and not empty.';
$lang["serveur_test"] = 'Test: MySQL server connection.';
$lang["serveur_ok"] = 'Connection to MySQL server established.';
$lang["serveur_nok"] = 'Connection to MySQL server failed. - Check the server\'s name, username and password.';
$lang["bdd_test"] = 'Test: database access.';
$lang["bdd_ok"] = 'Connection to the database established.';
$lang["bdd_nok"] = 'Connection to the database failed. - Check if the database exists and its name.';
$lang["tables_test"] = 'Test: check if the MySQL database is empty.';
$lang["tables_ok"] = 'No table found. OUAPI will create them.';
$lang["tables_nok"] = 'Table found. Please remove tables or modify the table\'s prefix.';
$lang["ocs_serveur_test"] = 'Test: OCS server connection.';
$lang["ocs_serveur_ok"] = 'Connection to OCS server established.';
$lang["ocs_serveur_nok"] = 'Connection to OCS server failed. - Check the server\'s address, login and password.';
$lang["ldap_serveur_test"] = 'Test: LDAP server connection';
$lang["ldap_serveur_ok"] = 'Connection to LDAP server established.';
$lang["ldap_serveur_nok"] = 'Connection to LDAP server failed. - Check the server\'s address, login and password.';
$lang["ldap_ext_test"] = 'Test: activation LDAP extension in PHP.';
$lang["ldap_ext_ok"] = 'LDAP extension activated.';
$lang["ldap_ext_nok"] = 'Connection to LDAP server failed. - The LDAP extension is NOT activated.';
$lang["ldap_ext_nok_text"] = 'Edit your PHP.ini file to activate the extension (Uncomment the line "extension=php_ldap.dll").';
$lang["ocs_bdd_test"] = 'Test: OCS database connection.';
$lang["ocs_bdd_ok"] = 'Connection to OCS database established.';
$lang["ocs_bdd_nok"] = 'Connection to the OCS database failed. - Check if the database exists and its name.';
$lang["conf_file_test"] = 'Test: creation file config/config.php.';
$lang["conf_file_ok"] = 'Config file created successfully.';
$lang["conf_file_nok"] = 'Error: Config file NOT created. - Check the rights to the folder config/';
$lang["install_nok"] = 'General error, please close your web browser, create again you database and retry installation.';
$lang["install_ok"] = 'All settings are correct.';

// Install OCS
$lang["install_ocs_server"] = 'OCS server';
$lang["install_ocs_serverdesc"] = 'Host name or IP address for the connection to OCS server';
$lang["install_ocs_user"] = 'OCS user';
$lang["install_ocs_userdesc"] = 'Login for the connection to OCS server';
$lang["install_ocs_pass"] = 'OCS password';
$lang["install_ocs_passdesc"] = 'Password for the connection to OCS server';
$lang["install_ocs_base"] = 'OCS database';
$lang["install_ocs_basedesc"] = 'Database name for MySQL OCS';
$lang["install_ocs_activrub"] = 'Activate the OCS section';
$lang["install_ocs_activrubdesc"] = 'Activate / Deactivate the OCS section in OUAPI';
$lang["install_ocs_"] = '';


// Install LDAP
$lang["install_ldap_server"] = 'LDAP server';
$lang["install_ldap_serverdesc"] = 'LDAP servername or IP address';
$lang["install_ldap_user"] = 'LDAP user';
$lang["install_ldap_userdesc"] = 'Login for the connection to LDAP server';
$lang["install_ldap_pass"] = 'LDAP password';
$lang["install_ldap_passdesc"] = 'Password for the connection to LDAP server';
$lang["install_ldap_port"] = 'LDAP port';
$lang["install_ldap_portdesc"] = 'Port number for the connection to LDAP server';
$lang["install_ldap_root"] = 'LDAP root for Users';
$lang["install_ldap_rootdesc"] = 'Users search root (Eg: OU=Users,DC=mycompany,DC=com).';
$lang["install_ldap_root_hard"] = 'LDAP root for Computers';
$lang["install_ldap_rootdesc_hard"] = 'Computer search root (Eg: OU=Computers,DC=mycompany,DC=com).';
$lang["install_ldap_attrfname"] = 'Firstname attribute';
$lang["install_ldap_attrfnamedesc"] = 'LDAP field containing the users\' firstname (GIVENNAME by default).';
$lang["install_ldap_attrlname"] = 'Name Attribute';
$lang["install_ldap_attrlnamedesc"] = 'LDAP field containing the users\' lastname (SN by default).';
$lang["install_ldap_attrmail"] = 'EMail attribute';
$lang["install_ldap_attrmaildesc"] = 'LDAP field containing the users\' email (MAIL by default).';
$lang["install_ldap_attrloginwin"] = 'Windows login attribute';
$lang["install_ldap_attrloginwindesc"] = 'LDAP field containing the users\' login (SAMACCOUNTNAME by default).';
$lang["install_ldap_attrhardname"] = 'Computer name attribute';
$lang["install_ldap_attrhardnamedesc"] = 'LDAP field containing the users\' computer name (NAME by default).';
$lang["install_ldap_attrharddescription"] = 'Description attribute';
$lang["install_ldap_attrharddescriptiondesc"] = 'LDAP field containing the computer\'s description (DESCRIPTION by default)';
$lang["install_ldap_attrhardcreated"] = 'Creation attribute';
$lang["install_ldap_attrhardcreateddesc"] = 'LDAP field containing the creation date in the AD (WHENCREATED by default)';
$lang["install_ldap_key"] = 'Key LDAP <-> OUAPI';
$lang["install_ldap_keydesc"] = 'Linking field between OUAPI and LDAP for Users';
$lang["install_ldap_key_hard"] = 'Key LDAP <-> OUAPI';
$lang["install_ldap_keydesc_hard"] = 'Linking field between OUAPI and LDAP for Computers.';
$lang["install_ldap_activrub"] = 'Activate the LDAP section';
$lang["install_ldap_activrubdesc"] = 'Activate / Deactivate the LDAP section in OUAPI';

$lang["install_ldap_"] = '';

// Bas de page
$lang["copyright"] = 'Copyright &copy; Nicolas BIDET & Christophe Toussaint 2007-2014';
$lang[""] = '';

// MAJ
$lang["maj_title"] = 'Update';
$lang["maj_title"] = 'Ouapi update';
$lang["maj_title1"] = 'Step 1: Check settings';
$lang["maj_title2"] = 'Step 2: Modify the files';
$lang["maj_title3"] = 'Step 3: Queries control';
$lang["maj_title4"] = 'End of update: queries result';
$lang["maj_disclamer"] = 'WARNING ! Do a backup of your MySQL database and save your files before starting the update!';
$lang["maj_paramcheck"] = 'Check the following parameters:';
$lang["maj_ouapibase"] = 'Ouapi database:';
$lang["maj_currentversion"] = 'Ouapi version number to be updated (eg: 1.4):';
$lang["maj_etape1"] = 'Step 1 >';
$lang["maj_etape2"] = 'Step 2 >';
$lang["maj_etape3"] = 'Step 3 >';
$lang["maj_button"] = 'Update!';
$lang["maj_choosever"] = 'Choose the update script:';
$lang["maj_nomajauto"] = 'No compatible script found. Your version can NOT be updated.';
$lang["maj_invalidbase"] = 'The database is NOT valid.';
$lang["maj_invalidversion"] = 'The version does NOT match.';
$lang["maj_validbase"] = 'The database is valid.';
$lang["maj_validversion"] = 'The specified version is consistent.';
$lang["maj_back"] = '< Back';
$lang["maj_tabstart"] = 'Start';
$lang["maj_tab1"] = '1';
$lang["maj_tab2"] = '2';
$lang["maj_tab3"] = '3';
$lang["maj_tabend"] = 'End';
$lang["maj_ok"] = 'OK';
$lang["maj_nofilemaj"] = 'There is no file to edit for this version.<br/>You can go to the next step.';
$lang["maj_filename"] = 'File: ';
$lang["maj_after"] = 'After the lines:';
$lang["maj_add"] = 'Add the following code:';
$lang["maj_fileedit"] = 'This step have to be done manually: edit the files using the following instructions (if no instructions given then you have nothing to do)';
$lang["maj_deleteif"] = 'If the following lines exist, delete them:';
$lang["maj_reqcontrol"] = 'The following queries will be executed on your database:';
$lang["maj_homepage"] = 'Home page';
$lang["maj_success"] = 'Update done!';
$lang["maj_"] = '';
?>