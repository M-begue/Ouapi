<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use;
$affichage = '';

function get_users_pfield_columns(db_use $db): array
{
    if ($db->connection === null) {
        $db->connection();
    }

    $columns = [];
    $query = "SHOW COLUMNS FROM " . TAB_USERS . " LIKE 'pfield_%'";
    $result = $db->connection->query($query);

    if ($result instanceof mysqli_result) {
        while ($row = $result->fetch_assoc()) {
            if (isset($row['Field'])) {
                $columns[] = $row['Field'];
            }
        }
        $result->free();
    }

    return $columns;
}

/****************************/
/*          Ajouter         */
/****************************/
if (isset($_GET['action']) && $_GET['action'] == 'add')
{
	if (isset($_POST['soumettre']))
	{
		$nom = format_string_db($_POST['nom']);
		$prenom = format_string_db($_POST['prenom']);
		$mail = format_string_db($_POST['mail']);		
		$groupe_id = $_POST['ut_groupe'];		
		$agence_id = $_POST['ut_agence'];
		$login = format_string_db($_POST['login']);
		$login_win = format_string_db($_POST['login_win']);
		$langue = $_POST['ut_langue'];
		
		if ($_POST['mdp'] != '')
			$mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
		else
			$mdp = "n0";

		// Colonnes perso
		$pfields_names = '';
		$pfields_values = '';
		
		$pfieldColumns = get_users_pfield_columns($req1);
		foreach ($pfieldColumns as $fieldName) {
			$pfields_names .= ',' . $fieldName;
			$pfields_values .= ",'" . format_string_db($_POST[$fieldName]) . "'";
		}
			
		$requete = "INSERT INTO ".TAB_USERS." (nom,prenom,mail,groupe_id,agence_id,login,mdp,login_win,langue".$pfields_names.")
		VALUES ('".$nom."','".$prenom."','".$mail."','".$groupe_id."','".$agence_id."','".$login."','".$mdp."','".$login_win."','".$langue."'".$pfields_values.")";

		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_user_addok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{
		// Si donn�es viennent d'une synchro OCS
		if (isset($_GET['login_win']))
		{
			$ldap["nom"] = $ldap["prenom"] = $ldap["mail"] = $ldap["groupe"] = $ldap["login"] = $ldap["mdp"] = '';
			$ldap["agence_id"] = $_GET["agence_id"];
			$ldap["login_win"] = $_GET['login_win'];
		}
		else
		{
			$ldap["nom"] = $ldap["prenom"] = $ldap["mail"] = $ldap["groupe"] = $ldap["login"] = $ldap["mdp"] = $ldap["login_win"] = '';
			$ldap["agence_id"] = $_GET["agence_id"];
		}

		//Formulaire d'ajout
		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_user_title_add"],
		  'ACTION' => 'index.php?page=adm_utilisateurs.php&amp;action=add',
		  'DISPLAY_OUAPIUSER' => 'display:none',
		));
			
		// Nom
		if ($ldap["nom"] != '')
		{
			$template->assign_block_vars('form.name', array(
			  'TITLE' => $lang["adm_user_name"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'ok',
			  'VALUE' => $ldap["nom"],
			));
		}
		else
		{
			$template->assign_block_vars('form.name', array(
			  'TITLE' => $lang["adm_user_name"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'required',
			));
		}
		
		// Prenom
		if ($ldap["prenom"] != '')
		{
			$template->assign_block_vars('form.firstname', array(
			  'TITLE' => $lang["adm_user_firstname"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'ok',
			  'VALUE' => $ldap["prenom"],
			));
		}
		else
		{
			$template->assign_block_vars('form.firstname', array(
			  'TITLE' => $lang["adm_user_firstname"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'required',
			));
		}

		// Mail
		$template->assign_block_vars('form.mail', array(
		  'TITLE' => $lang["adm_user_mail"],
		  'VALUE' => $ldap["mail"],
		));

		// Cr�er l'utilisateur dans OUAPI
		$template->assign_block_vars('form.user_ouapi', array(
		  'TITLE' => $lang["adm_user_addall_ouapi_user"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 
		'value' => array(1,0), 'checked' => array('','checked'),
		'onclick' => array('javascript:document.getElementById(\'ouapi_user\').style.display=\'block\'','javascript:document.getElementById(\'ouapi_user\').style.display=\'none\''));

		$i =0;
		while ($i < count($options["libelle"]))
		{
			$template->assign_block_vars('form.user_ouapi.list', array(
			  'VALUE' => $options['value'][$i],
			  'LIBELLE' => $options['libelle'][$i],
			  'CHECKED' => $options['checked'][$i],
			  'ONCLICK' => $options['onclick'][$i]
			));
			$i++;
		}

		// Groupe
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS_GRP." ORDER BY id DESC");
		$template->assign_block_vars('form.group', array(
		  'TITLE' => $lang["adm_user_group"],
		));

		$i = 0;
		while ($i < count($tab))
		{
			if ($tab[$i]["id"] == $ldap["groupe"])
			{
				$template->assign_block_vars('form.group.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.group.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}
		
		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["adm_user_site"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
			
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
			while ($i < count($tab)-1)
			{
				if ($_GET["agence_id"] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected',
					));
				}
				else
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					));
				}
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'AGENCE_ID' => $_GET["agence_id"]
			));	
		}

		// Login
		if ($ldap["login"] != '')
		{
			$template->assign_block_vars('form.login', array(
			  'TITLE' => $lang["adm_user_login"],
			  'KEYUP' => 'verifLong(this);',
			  'VALUE' => $ldap["login"],
			));
		}
		else
		{
			$template->assign_block_vars('form.login', array(
			  'TITLE' => $lang["adm_user_login"],
			  'KEYUP' => 'verifLong(this);',
			));
		}
		
		// Mot de passe
		if ($ldap["mdp"] != '')
		{
			$template->assign_block_vars('form.pwd', array(
			  'TITLE' => $lang["adm_user_password"],
			  'KEYUP' => 'verifLong(this);',
			  'VALUE' => $ldap["mdp"],
			));
		}
		else
		{
			$template->assign_block_vars('form.pwd', array(
			  'TITLE' => $lang["adm_user_password"],
			  'KEYUP' => 'verifLong(this);',
			));
		}
		
		// Login Windows
		$template->assign_block_vars('form.win_login', array(
		  'TITLE' => $lang["adm_user_winlogin"],
		  'VALUE' => $ldap["login_win"],
		));
			
		// Langue
		$template->assign_block_vars('form.lang', array(
		  'TITLE' => $lang["adm_user_language"],
		));

		$i = 0;
		$dir = "lang/";
		if (is_dir($dir) && $dh = opendir($dir)) 
		{
			while (($file = readdir($dh)) !== false) 
			{
				if ($file[0] != '.')
				{			
					$current = fopen($dir.$file,'r');
					$libelle = trim(str_replace("<?php //","",fgets($current, 4096)));
					$value = str_replace(".php","",substr($file,5));
					
					if ($value == DEFAULT_LANGUAGE)
					{
						$template->assign_block_vars('form.lang.list', array(
						  'ID' => $value,
						  'LIBELLE' => $libelle,
						  'SELECTED' => 'selected'
						));
					}
					else
					{
						$template->assign_block_vars('form.lang.list', array(
						  'ID' => $value,
						  'LIBELLE' => $libelle
						));
					}
					
					fclose($current);
				}
				
			}
			closedir($dh);
		}		

		// Champs perso
		$pfieldColumns = get_users_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $lang["s_".TAB_USERS.".".$fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));
	}
}
/****************************/
/*     Ajouter par LDAP     */
/****************************/
if (isset($_GET['action']) && $_GET['action'] == 'add_ldap')
{
	if (isset($_POST['soumettre']))
	{
		$nom = format_string_db($_POST['nom']);
		$prenom = format_string_db($_POST['prenom']);
		$mail = format_string_db($_POST['mail']);		
		$groupe_id = $_POST['ut_groupe'];		
		$agence_id = $_POST['ut_agence'];
		$login = format_string_db($_POST['login']);
		$login_win = format_string_db($_POST['login_win']);
		$langue = $_POST['ut_langue'];
		
		if ($_POST['mdp'] != '')
			$mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
		else
			$mdp = "n0";

		// Colonnes perso
		$pfields_names = '';
		$pfields_values = '';
		
		$pfieldColumns = get_users_pfield_columns($req1);
		foreach ($pfieldColumns as $fieldName) {
			$pfields_names .= ',' . $fieldName;
			$pfields_values .= ",'" . format_string_db($_POST[$fieldName]) . "'";
		}
			
		$requete = "INSERT INTO ".TAB_USERS." (nom,prenom,mail,groupe_id,agence_id,login,mdp,login_win,langue".$pfields_names.")
		VALUES ('".$nom."','".$prenom."','".$mail."','".$groupe_id."','".$agence_id."','".$login."','".$mdp."','".$login_win."','".$langue."'".$pfields_values.")";

		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_user_addok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{
		if (defined("LDAP_KEY"))
			$key = explode(";",LDAP_KEY);
		else
			$key = array('mail','mail');

		//Formulaire d'ajout
		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_user_title_add"],
		  'ACTION' => 'index.php?page=adm_utilisateurs.php&amp;action=add_ldap',
		  'DISPLAY_OUAPIUSER' => 'display:none',
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));

		// Si connexion OK
		if ($fp = @fsockopen(LDAP_HOST, LDAP_PORT, $errno, $errstr, 5))
		{		
			$template->assign_block_vars('form.ldap_head', array(
			  'L_BASEINFO' => $lang["adm_user_baseinfo"],
			  'L_LDAPINFO' => $lang["adm_user_ldapinfo"],
			));
			
			$recherche = unserialize(urldecode($_GET[constant("LDAP_ATTR_".strtoupper($key[1]))]));
			
			$server = LDAP_HOST;
			$port = LDAP_PORT;
			$rootdn = LDAP_USER;
			$rootpw = LDAP_MDP;

			$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask".$_GET["agence_id"]."'";
			$tab_racine = $req1->db_use_query($requete);
			
			if (count($tab_racine) > 0)
				$racine = $tab_racine[0]["valeur"];
			else
				$racine = LDAP_MASK;
			
			$ds=ldap_connect($server, $port);
			$r=ldap_bind($ds,$rootdn,$rootpw);

			$sr=ldap_search($ds, $racine, constant("LDAP_ATTR_".strtoupper($key[1]))."=".$recherche);
			$info = ldap_get_entries ($ds, $sr);	
			
			if (defined("LDAP_ATTR_LNAME") && isset($info[0][LDAP_ATTR_LNAME][0]))						
				$ldap["nom"] = $info[0][LDAP_ATTR_LNAME][0];
			else
				$ldap["nom"] = $info[0]["sn"][0];
				
			if (defined("LDAP_ATTR_FNAME") && isset($info[0][LDAP_ATTR_FNAME][0]))						
				$ldap["prenom"] = $info[0][LDAP_ATTR_FNAME][0];
			else
				$ldap["prenom"] = $info[0]["givenname"][0];
				
			if (defined("LDAP_ATTR_MAIL") && isset($info[0][LDAP_ATTR_MAIL][0]))						
				$ldap["mail"] = $info[0][LDAP_ATTR_MAIL][0];
			else
				$ldap["mail"] = $info[0]["mail"][0];
			
			$ldap["groupe"] = "30";
			
			$ldap["agence_id"] = $_GET["agence_id"];

			if (defined("LDAP_ATTR_LOGINWIN") && isset($info[0][LDAP_ATTR_LOGINWIN][0]))						
				$ldap["login_win"] = $info[0][LDAP_ATTR_LOGINWIN][0];
			else
				$ldap["login_win"] = $info[0]["samaccountname"][0];
				
			$ldap["login"] = $ldap["login_win"];
			$ldap["mdp"] = '';

			
		}
		else
		{
			$template->assign_block_vars('form.error', array(
				'TEXT' => $lang["user_ldap_error"],
			));	
			
			$ldap["nom"] = $ldap["prenom"] = $ldap["mail"] = $ldap["groupe"] = $ldap["login"] = $ldap["mdp"] = $ldap["login_win"] = '';
			$ldap["agence_id"] = $_GET["agence_id"];
		}

			
		// Nom
		if ($ldap["nom"] != '')
		{
			$template->assign_block_vars('form.name', array(
			  'TITLE' => $lang["adm_user_name"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'ok',
			  'VALUE' => $ldap["nom"],
			));
		}
		else
		{
			$template->assign_block_vars('form.name', array(
			  'TITLE' => $lang["adm_user_name"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'required',
			));
		}

		$template->assign_block_vars('form.name.ldap', array(
		  'VALUE' => $ldap["nom"],
		));
		
		// Prenom
		if ($ldap["prenom"] != '')
		{
			$template->assign_block_vars('form.firstname', array(
			  'TITLE' => $lang["adm_user_firstname"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'ok',
			  'VALUE' => $ldap["prenom"],
			));
		}
		else
		{
			$template->assign_block_vars('form.firstname', array(
			  'TITLE' => $lang["adm_user_firstname"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'required',
			));
		}

		$template->assign_block_vars('form.firstname.ldap', array(
		  'VALUE' => $ldap["prenom"],
		));

		// Mail
		$template->assign_block_vars('form.mail', array(
		  'TITLE' => $lang["adm_user_mail"],
		  'VALUE' => $ldap["mail"],
		));

		$template->assign_block_vars('form.mail.ldap', array(
		  'VALUE' => $ldap["mail"],
		));

		// Cr�er l'utilisateur dans OUAPI
		$template->assign_block_vars('form.user_ouapi', array(
		  'TITLE' => $lang["adm_user_addall_ouapi_user"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 
		'value' => array(1,0), 'checked' => array('','checked'),
		'onclick' => array('javascript:document.getElementById(\'ouapi_user\').style.display=\'block\'','javascript:document.getElementById(\'ouapi_user\').style.display=\'none\''));

		$i =0;
		while ($i < count($options["libelle"]))
		{
			$template->assign_block_vars('form.user_ouapi.list', array(
			  'VALUE' => $options['value'][$i],
			  'LIBELLE' => $options['libelle'][$i],
			  'CHECKED' => $options['checked'][$i],
			  'ONCLICK' => $options['onclick'][$i]
			));
			$i++;
		}

		// Groupe
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS_GRP." ORDER BY id DESC");
		$template->assign_block_vars('form.group', array(
		  'TITLE' => $lang["adm_user_group"],
		));

		$i = 0;
		while ($i < count($tab))
		{
			if ($tab[$i]["id"] == $ldap["groupe"])
			{
				$template->assign_block_vars('form.group.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.group.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}
		
		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["adm_user_site"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
			
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
			while ($i < count($tab)-1)
			{
				if ($_GET["agence_id"] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected',
					));
				}
				else
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					));
				}
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'AGENCE_ID' => $_GET["agence_id"]
			));	
		}

		// Login
		if ($ldap["login"] != '')
		{
			$template->assign_block_vars('form.login', array(
			  'TITLE' => $lang["adm_user_login"],
			  'KEYUP' => 'verifLong(this);',
			  'VALUE' => $ldap["login"],
			));
		}
		else
		{
			$template->assign_block_vars('form.login', array(
			  'TITLE' => $lang["adm_user_login"],
			  'KEYUP' => 'verifLong(this);',
			));
		}
		
		// Mot de passe
		if ($ldap["mdp"] != '')
		{
			$template->assign_block_vars('form.pwd', array(
			  'TITLE' => $lang["adm_user_password"],
			  'KEYUP' => 'verifLong(this);',
			  'VALUE' => $ldap["mdp"],
			));
		}
		else
		{
			$template->assign_block_vars('form.pwd', array(
			  'TITLE' => $lang["adm_user_password"],
			  'KEYUP' => 'verifLong(this);',
			));
		}
		
		// Login Windows
		$template->assign_block_vars('form.win_login', array(
		  'TITLE' => $lang["adm_user_winlogin"],
		  'VALUE' => $ldap["login_win"],
		));

		$template->assign_block_vars('form.win_login.ldap', array(
		  'VALUE' => $ldap["login_win"],
		));
		
		// Langue
		$template->assign_block_vars('form.lang', array(
		  'TITLE' => $lang["adm_user_language"],
		));

		$i = 0;
		$dir = "lang/";
		if (is_dir($dir) && $dh = opendir($dir)) 
		{
			while (($file = readdir($dh)) !== false) 
			{
				if ($file[0] != '.')
				{			
					$current = fopen($dir.$file,'r');
					$libelle = trim(str_replace("<?php //","",fgets($current, 4096)));
					$value = str_replace(".php","",substr($file,5));
					
					if ($value == DEFAULT_LANGUAGE)
					{
						$template->assign_block_vars('form.lang.list', array(
						  'ID' => $value,
						  'LIBELLE' => $libelle,
						  'SELECTED' => 'selected'
						));
					}
					else
					{
						$template->assign_block_vars('form.lang.list', array(
						  'ID' => $value,
						  'LIBELLE' => $libelle
						));
					}
					
					fclose($current);
				}
				
			}
			closedir($dh);
		}		

		// Champs perso
		$pfieldColumns = get_users_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $lang["s_".TAB_USERS.".".$fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));
		
		/////////////////////////////
		//     BOUTONS ACTIONS     //
		/////////////////////////////
		
		$template->assign_block_vars('form.name.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		));
		
		$template->assign_block_vars('form.firstname.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		));
		
		$template->assign_block_vars('form.mail.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		));
		
		$template->assign_block_vars('form.win_login.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		));

		// Legende
		$template->assign_block_vars('form.key', array(
		  'L_TITLE' => $lang["gen_legende"],
		  'L_OK' => $lang["ldap_legendeok"],
		  'L_TRANS' => $lang["ldap_legendetrans"],
		  'L_ADD' => $lang["ldap_legendeadd"],
		  'L_USER' => $lang["ldap_legendeuser"],
		  'L_FORBID' => $lang["ldap_legendeforbid"],
		 ));	

	}
	
	
}
/*********************************/
/*     Synchroniser par LDAP     */
/*********************************/
if (isset($_GET['action']) && $_GET['action'] == 'sync_ldap')
{
	if (isset($_POST['soumettre']))
	{
		$user_id = intval($_POST['user_id']);
		$nom = format_string_db($_POST['nom']);
		$prenom = format_string_db($_POST['prenom']);
		$mail = format_string_db($_POST['mail']);		
		$groupe_id = $_POST['ut_groupe'];		
		$agence_id = $_POST['ut_agence'];
		$login = format_string_db($_POST['login']);
		$login_win = format_string_db($_POST['login_win']);
		$langue = $_POST['ut_langue'];

		// Colonnes perso
		$pfields_update = '';
		$pfieldColumns = get_users_pfield_columns($req1);
		foreach ($pfieldColumns as $fieldName) {
			$pfields_update .= "," . $fieldName . "='" . format_string_db($_POST[$fieldName]) . "'";
		}
		
		$requete = "UPDATE ".TAB_USERS." SET ".US_LNAME."='".$nom."', ".US_FNAME."='".$prenom."', ".US_MAIL."='".$mail."', 
		".US_GROUPEID."='".$groupe_id."', ".US_SITE_ID."='".$agence_id."', ".US_LOGIN."='".$login."', ".US_LOGINWIN."='".$login_win."', 
		".US_LANGUAGE."='".$langue."' ".$pfields_update." WHERE ".US_ID."='".$user_id."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_user_addok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{
		if (defined("LDAP_KEY"))
			$key = explode(";",LDAP_KEY);
		else
			$key = array('mail','mail');

		//Formulaire de synchro
		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_user_title_syncldap"],
		  'ACTION' => 'index.php?page=adm_utilisateurs.php&amp;action=sync_ldap',
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));

		// Si connexion OK
		if ($fp = @fsockopen(LDAP_HOST, LDAP_PORT, $errno, $errstr, 5))
		{		
			$template->assign_block_vars('form.ldap_head', array(
			  'L_BASEINFO' => $lang["adm_user_baseinfo"],
			  'L_LDAPINFO' => $lang["adm_user_ldapinfo"],
			));
			
			$recherche = unserialize(urldecode($_GET[constant("LDAP_ATTR_".strtoupper($key[1]))]));
			
			$server = LDAP_HOST;
			$port = LDAP_PORT;
			$rootdn = LDAP_USER;
			$rootpw = LDAP_MDP;

			$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask".$_GET["agence_id"]."'";
			$tab_racine = $req1->db_use_query($requete);
			
			if (count($tab_racine) > 0)
				$racine = $tab_racine[0]["valeur"];
			else
				$racine = LDAP_MASK;
			
			$ds=ldap_connect($server, $port);
			$r=ldap_bind($ds,$rootdn,$rootpw);

			$sr=ldap_search($ds, $racine, constant("LDAP_ATTR_".strtoupper($key[1]))."=".$recherche);
			$info = ldap_get_entries ($ds, $sr);	
			
			if (defined("LDAP_ATTR_LNAME") && isset($info[0][LDAP_ATTR_LNAME][0]))						
				$ldap["nom"] = $info[0][LDAP_ATTR_LNAME][0];
			else
				$ldap["nom"] = $info[0]["sn"][0];
				
			if (defined("LDAP_ATTR_FNAME") && isset($info[0][LDAP_ATTR_FNAME][0]))						
				$ldap["prenom"] = $info[0][LDAP_ATTR_FNAME][0];
			else
				$ldap["prenom"] = $info[0]["givenname"][0];
				
			if (defined("LDAP_ATTR_MAIL") && isset($info[0][LDAP_ATTR_MAIL][0]))						
				$ldap["mail"] = $info[0][LDAP_ATTR_MAIL][0];
			else
				$ldap["mail"] = $info[0]["mail"][0];
			
			$ldap["groupe"] = "30";
			
			$ldap["agence_id"] = $_GET["agence_id"];

			if (defined("LDAP_ATTR_LOGINWIN") && isset($info[0][LDAP_ATTR_LOGINWIN][0]))						
				$ldap["login_win"] = $info[0][LDAP_ATTR_LOGINWIN][0];
			else
				$ldap["login_win"] = $info[0]["samaccountname"][0];
				
			$ldap["login"] = $ldap["login_win"];
			$ldap["mdp"] = '';

		}
		else
		{
			$template->assign_block_vars('form.error', array(
				'TEXT' => $lang["user_ldap_error"],
			));	
			
			$ldap["nom"] = $ldap["prenom"] = $ldap["mail"] = $ldap["groupe"] = $ldap["login"] = $ldap["mdp"] = $ldap["login_win"] = '';
			$ldap["agence_id"] = $_GET["agence_id"];
		}

		// Infos de OUAPI
		$tab_ouapi = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE ".$key[0]."='".$recherche."'");			
			
		// Nom
		$template->assign_block_vars('form.name', array(
		  'TITLE' => $lang["adm_user_name"],
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'ok',
		  'VALUE' => $tab_ouapi[0][US_LNAME],
		));

		$template->assign_block_vars('form.name.ldap', array(
		  'VALUE' => $ldap["nom"],
		));
		
		// Prenom
		$template->assign_block_vars('form.firstname', array(
		  'TITLE' => $lang["adm_user_firstname"],
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'ok',
		  'VALUE' => $tab_ouapi[0][US_FNAME],
		));

		$template->assign_block_vars('form.firstname.ldap', array(
		  'VALUE' => $ldap["prenom"],
		));

		// Mail
		$template->assign_block_vars('form.mail', array(
		  'TITLE' => $lang["adm_user_mail"],
		  'VALUE' => $tab_ouapi[0][US_MAIL],
		));

		$template->assign_block_vars('form.mail.ldap', array(
		  'VALUE' => $ldap["mail"],
		));

		// Groupe
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS_GRP." ORDER BY ".UT_GR_LIBELLE." DESC");
		$template->assign_block_vars('form.group', array(
		  'TITLE' => $lang["adm_user_group"],
		));

		$i = 0;
		while ($i < count($tab))
		{
			if ($tab[$i]["id"] == $tab_ouapi[0][US_GROUPEID])
			{
				$template->assign_block_vars('form.group.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.group.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}
		
		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["adm_user_site"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY ".AG_LIBELLE);
			
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
			while ($i < count($tab)-1)
			{
				if ($tab_ouapi[0][US_SITE_ID] == $tab[$i][AG_ID])
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected',
					));
				}
				else
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					));
				}
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'AGENCE_ID' => $_GET["agence_id"]
			));	
		}

		// Login
		$template->assign_block_vars('form.login', array(
		  'TITLE' => $lang["adm_user_login"],
		  'VALUE' => $tab_ouapi[0][US_LOGIN],
		));
		
		// Login Windows
		$template->assign_block_vars('form.win_login', array(
		  'TITLE' => $lang["adm_user_winlogin"],
		  'VALUE' => $tab_ouapi[0][US_LOGINWIN],
		));

		$template->assign_block_vars('form.win_login.ldap', array(
		  'VALUE' => $ldap["login_win"],
		));
		
		// Langue
		$template->assign_block_vars('form.lang', array(
		  'TITLE' => $lang["adm_user_language"],
		));

		$i = 0;
		$dir = "lang/";
		if (is_dir($dir) && $dh = opendir($dir)) 
		{
			while (($file = readdir($dh)) !== false) 
			{
				if ($file[0] != '.')
				{			
					$current = fopen($dir.$file,'r');
					$libelle = trim(str_replace("<?php //","",fgets($current, 4096)));
					$value = str_replace(".php","",substr($file,5));
					
					if ($value == DEFAULT_LANGUAGE)
					{
						$template->assign_block_vars('form.lang.list', array(
						  'ID' => $value,
						  'LIBELLE' => $libelle,
						  'SELECTED' => 'selected'
						));
					}
					else
					{
						$template->assign_block_vars('form.lang.list', array(
						  'ID' => $value,
						  'LIBELLE' => $libelle
						));
					}
					
					fclose($current);
				}
				
			}
			closedir($dh);
		}		

		$template->assign_block_vars('form.hidden_param', array(
		  'NAME' => 'user_id',
		  'VALUE' => $tab_ouapi[0][US_ID],
		));

		// Colonnes perso
		$pfieldColumns = get_users_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
		  	'NAME' => $fieldName,
		  	'VALUE' => $tab_ouapi[0][$fieldName],
		  	'TITLE' => $lang["s_".TAB_USERS.".".$fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["edit"],
		));
		
		/////////////////////////////
		//     BOUTONS ACTIONS     //
		/////////////////////////////
		
		if ($tab_ouapi[0][US_LNAME] == $ldap["nom"])
		{
			$template->assign_block_vars('form.name.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			));
		}
		else
		{
			$template->assign_block_vars('form.name.valid', array(
			  'ONCLICK' => 'document.form.nom.value=\''.$ldap["nom"].'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			));				
		}
		
		if ($tab_ouapi[0][US_FNAME] == $ldap["prenom"])
		{
			$template->assign_block_vars('form.firstname.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			));
		}
		else
		{
			$template->assign_block_vars('form.firstname.valid', array(
			  'ONCLICK' => 'document.form.prenom.value=\''.$ldap["prenom"].'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			));				
		}
		
		if ($tab_ouapi[0][US_MAIL] == $ldap["mail"])
		{
			$template->assign_block_vars('form.mail.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			));
		}
		else
		{
			$template->assign_block_vars('form.mail.valid', array(
			  'ONCLICK' => 'document.form.mail.value=\''.$ldap["mail"].'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			));				
		}
		
		if ($tab_ouapi[0][US_LOGINWIN] == $ldap["login_win"])
		{
			$template->assign_block_vars('form.win_login.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			));
		}
		else
		{
			$template->assign_block_vars('form.win_login.valid', array(
			  'ONCLICK' => 'document.form.login_win.value=\''.$ldap["login_win"].'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			));				
		}
		
		// Legende
		$template->assign_block_vars('form.key', array(
		  'L_TITLE' => $lang["gen_legende"],
		  'L_OK' => $lang["ldap_legendeok"],
		  'L_TRANS' => $lang["ldap_legendetrans"],
		  'L_ADD' => $lang["ldap_legendeadd"],
		  'L_USER' => $lang["ldap_legendeuser"],
		  'L_FORBID' => $lang["ldap_legendeforbid"],
		 ));	

	}
	
	
}
// Edition
elseif (isset($_GET['action']) && $_GET['action'] == 'Editer')
{
	if (isset($_POST['soumettre']))
	{
		$user_id = $_GET['user_id'];
		$nom = format_string_db($_POST['nom']);
		$prenom = format_string_db($_POST['prenom']);
		$mail = format_string_db($_POST['mail']);		
		$groupe_id = $_POST['ut_groupe'];		
		$agence_id = $_POST['ut_agence'];
		$login = format_string_db($_POST['login']);
		$login_win = format_string_db($_POST['login_win']);
		$langue = $_POST['ut_langue'];

		// Colonnes perso
		$pfields_update = '';
		$pfieldColumns = get_users_pfield_columns($req1);
		foreach ($pfieldColumns as $fieldName) {
			$pfields_update .= "," . $fieldName . "='" . format_string_db($_POST[$fieldName]) . "'";
		}
		
		$requete = "UPDATE ".TAB_USERS." SET nom='$nom',prenom='$prenom',mail='$mail',groupe_id='$groupe_id',
		agence_id='$agence_id',login='$login',login_win='$login_win',langue='$langue'".$pfields_update." WHERE id='$user_id'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_user_editok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{

		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE id='".$_GET["user_id"]."'");
	
		if ($tab[0][US_LNAME] != 'Demo')
		{
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_user_title_edit"],
			  'ACTION' => 'index.php?page=adm_utilisateurs.php&amp;action=Editer&amp;user_id='.$_GET['user_id'],
			));
			
			$template->assign_block_vars('form.name', array(
			  'TITLE' => $lang["adm_user_name"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'ok',
			  'VALUE' => $tab[0]["nom"],
			));
			
			$template->assign_block_vars('form.firstname', array(
			  'TITLE' => $lang["adm_user_firstname"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'ok',
			  'VALUE' => $tab[0]["prenom"],
			));

			$template->assign_block_vars('form.mail', array(
			  'TITLE' => $lang["adm_user_mail"],
			  'VALUE' => $tab[0]["mail"],
			));

			// Groupe
			$tab_grp = $req1->db_use_query("SELECT * FROM ".TAB_USERS_GRP." ORDER BY id DESC");
			$template->assign_block_vars('form.group', array(
			  'TITLE' => $lang["adm_user_group"],
			));

			$i = 0;
			while ($i < count($tab_grp))
			{
				if ($tab[0]["groupe_id"] == $tab_grp[$i]['id'])
				{
					$template->assign_block_vars('form.group.list', array(
					  'ID' => $tab_grp[$i]['id'],
					  'LIBELLE' => $tab_grp[$i]['libelle'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.group.list', array(
					  'ID' => $tab_grp[$i]['id'],
					  'LIBELLE' => $tab_grp[$i]['libelle']
					));
				}
				$i++;
			}

			// Site
			if (MULTISITE == "Oui")
			{
				$template->assign_block_vars('form.multisite', array(
				  'TITLE' => $lang["adm_user_site"],
				));

				$tab_sites = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
				
				$i = -1;
				$tab_sites[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
				while ($i < count($tab_sites)-1)
				{
					if ($tab[0]["agence_id"] == $tab_sites[$i]['id'])
					{
						$template->assign_block_vars('form.multisite.list', array(
						  'ID' => $tab_sites[$i]['id'],
						  'LIBELLE' => $tab_sites[$i]['libelle'],
						  'SELECTED' => 'selected',
						));
					}
					else
					{
						$template->assign_block_vars('form.multisite.list', array(
						  'ID' => $tab_sites[$i]['id'],
						  'LIBELLE' => $tab_sites[$i]['libelle'],
						));
					}
					$i++;
				}
			}
			else
			{
				$template->assign_block_vars('form.monosite', array(
				  'AGENCE_ID' => $tab[0]["agence_id"]
				));	
			}

			$template->assign_block_vars('form.login', array(
			  'TITLE' => $lang["adm_user_login"],
			  'KEYUP' => 'verifLong(this);',
			  'VALUE' => $tab[0]["login"],
			));

			$template->assign_block_vars('form.win_login', array(
			  'TITLE' => $lang["adm_user_winlogin"],
			  'VALUE' => $tab[0]["login_win"],
			));

			// Langue
			$template->assign_block_vars('form.lang', array(
			  'TITLE' => $lang["adm_user_language"],
			));

			$i = 0;
			$dir = "lang/";
			if (is_dir($dir) && $dh = opendir($dir)) 
			{
				while (($file = readdir($dh)) !== false) 
				{
					if ($file[0] != '.')
					{			
						$current = fopen($dir.$file,'r');
						$libelle = trim(str_replace("<?php //","",fgets($current, 4096)));
						$value = str_replace(".php","",substr($file,5));
						
						if ($tab[0]["langue"] == $value)
						{
							$template->assign_block_vars('form.lang.list', array(
							  'ID' => $value,
							  'LIBELLE' => $libelle,
							  'SELECTED' => 'selected'
							));
						}
						else
						{
							$template->assign_block_vars('form.lang.list', array(
							  'ID' => $value,
							  'LIBELLE' => $libelle
							));
						}
						
						fclose($current);
					}
					
				}
				closedir($dh);
			}		
	
			// Colonnes perso
			$pfieldColumns = get_users_pfield_columns($req1);

			foreach ($pfieldColumns as $fieldName) {
				$template->assign_block_vars('form.pfield_text', array(
		  		'NAME' => $fieldName,
		  		'VALUE' => $tab[0][$fieldName],
		  		'TITLE' => $lang["s_".TAB_USERS.".".$fieldName],
				));
			}
	
			$template->assign_block_vars('form.button', array(
			  'TITLE' => $lang["edit"],
			));
		}
	}
}

// Suppression
elseif (isset($_GET['action']) && $_GET['action'] == 'Supprimer')
{
	if (isset($_POST['soumettre']))
	{
		$requete = "DELETE FROM ".TAB_USERS." WHERE id='".$_GET['user_id']."'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_RESA." WHERE user_id='".$_GET['user_id']."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_user_delok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE id='".$_GET["user_id"]."'");
		
		if ($tab[0][US_LNAME] != 'Demo')
		{
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_user_title_del"],
			  'ACTION' => 'index.php?page=adm_utilisateurs.php&action=Supprimer&user_id='.$_GET['user_id'],
			));
			
			$template->assign_block_vars('form.name', array(
			  'TITLE' => $lang["adm_user_name"],
			  'DISABLED' => 'disabled',
			  'VALUE' => $tab[0]["nom"],
			));
			
			$template->assign_block_vars('form.firstname', array(
			  'TITLE' => $lang["adm_user_firstname"],
			  'DISABLED' => 'disabled',
			  'VALUE' => $tab[0]["prenom"],
			));

			$template->assign_block_vars('form.mail', array(
			  'TITLE' => $lang["adm_user_mail"],
			  'VALUE' => $tab[0]["mail"],
			  'DISABLED' => 'disabled'
			));

			$template->assign_block_vars('form.login', array(
			  'TITLE' => $lang["adm_user_login"],
			  'VALUE' => $tab[0]["login"],
			  'DISABLED' => 'disabled'
			));

			$template->assign_block_vars('form.button', array(
			  'TITLE' => $lang["delete"],
			));
		}
	}
}
// Changer le mot de passe
elseif (isset($_GET['action']) && $_GET['action'] == 'change_mdp')
{
	if (isset($_POST['soumettre']))
	{
		if ($_POST['mdp'] != '' && $_POST['mdp'] == $_POST['confirm_mdp'])
		{
			$requete = "UPDATE ".TAB_USERS." SET mdp='".password_hash($_POST['mdp'], PASSWORD_BCRYPT)."' WHERE id='".$_GET['user_id']."'";
			$tab = $req1->db_use_query($requete);

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_user_changemdpok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));			
		}
		else
		{
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_user_changemdpnok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'alert'
			));			
			
			$template->assign_block_vars('form_post.back', array(
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["return"]	,
			));			
		}


	}
	else
	{
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE id='".$_GET["user_id"]."'");

		if ($tab[0][US_LNAME] != 'Demo')
		{
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_user_title_mdp"],
			  'ACTION' => 'index.php?page=adm_utilisateurs.php&action=change_mdp&user_id='.$_GET['user_id'],
			));
			
			$template->assign_block_vars('form.name', array(
			  'TITLE' => $lang["adm_user_name"],
			  'DISABLED' => 'disabled',
			  'VALUE' => $tab[0]["nom"],
			));
			
			$template->assign_block_vars('form.firstname', array(
			  'TITLE' => $lang["adm_user_firstname"],
			  'DISABLED' => 'disabled',
			  'VALUE' => $tab[0]["prenom"],
			));

			$template->assign_block_vars('form.pwd', array(
			  'TITLE' => $lang["adm_user_password"],
			));
			
			$template->assign_block_vars('form.confirm_pwd', array(
			  'TITLE' => $lang["adm_user_confirm_password"],
			));
			
			$template->assign_block_vars('form.button', array(
			  'TITLE' => $lang["edit"],
			));
		}
	}
}
// Configurer LDAP pour le site
elseif (isset($_GET['action']) && $_GET['action'] == 'conf_ldap')
{
	if (isset($_POST['soumettre']))
	{
		//Utilisateurs
		$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom='ldap_mask".$_GET["agence_id"]."'";
		$tab = $req1->db_use_query($requete);

		if (count($tab) == 0)
		{
			$requete = "INSERT INTO ".TAB_CONFIG." (nom, subcategory, libelle,valeur,form_type,globale) VALUES 
			('ldap_mask".$_GET["agence_id"]."','users', 'Racine LDAP Utilisateurs agence ".$_GET["agence_id"]."','".format_string_db($_POST["mask"])."','text','0')";
		}
		else
		{
			$requete = "UPDATE ".TAB_CONFIG." SET valeur='".format_string_db($_POST["mask"])."', subcategory='users', form_type='text' WHERE nom='ldap_mask".$_GET["agence_id"]."'";
		}
		$tab_save = $req1->db_use_query($requete);
		
		//Mat�riels
		$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom='ldap_mask_hard".$_GET["agence_id"]."'";
		$tab = $req1->db_use_query($requete);

		if (count($tab) == 0)
		{
			$requete = "INSERT INTO ".TAB_CONFIG." (nom, subcategory, libelle,valeur,form_type,globale) VALUES 
			('ldap_mask_hard".$_GET["agence_id"]."','hard', 'Racine LDAP Mat�riel agence ".$_GET["agence_id"]."','".format_string_db($_POST["mask_hard"])."','text','0')";
		}
		else
		{
			$requete = "UPDATE ".TAB_CONFIG." SET valeur='".format_string_db($_POST["mask_hard"])."', subcategory='hard', form_type='text' WHERE nom='ldap_mask_hard".$_GET["agence_id"]."'";
		}
		$tab_save = $req1->db_use_query($requete);
		
		$template->assign_block_vars('form_post', array(
			'OK' => $lang["return_conf_ok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			


	}
	else
	{

		$template->assign_block_vars('form_ldap', array(
		  'TITLE' => $lang["adm_user_conf_ldap_title"],
		  'ACTION' => 'index.php?page=adm_utilisateurs.php&action=conf_ldap&agence_id='.$_GET["agence_id"],
		));

		// Racine Utilisateurs
		$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask".$_GET["agence_id"]."'";
		$tab = $req1->db_use_query($requete);
		
		if (count($tab) != 0)
			$mask = $tab[0]["valeur"];
		else
			$mask = LDAP_MASK;

		$template->assign_block_vars('form_ldap.mask', array(
		  'TITLE' => $lang["user_conf_ldap_mask"],
		  'VALUE' => $mask,
		));
		
		// Racine Ordinateurs
		$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask_hard".$_GET["agence_id"]."'";
		$tab = $req1->db_use_query($requete);
		
		if (count($tab) != 0)
			$mask_hard = $tab[0]["valeur"];
		else
			$mask_hard = LDAP_MASK_HARD;

		$template->assign_block_vars('form_ldap.mask_hard', array(
		  'TITLE' => $lang["user_conf_ldap_mask_hard"],
		  'VALUE' => $mask_hard,
		));
		
		$template->assign_block_vars('form_ldap.button', array(
		  'TITLE' => $lang["gen_save"],
		));

		if (PARAM_HELP == 1)
		{
			$template->assign_block_vars('form_ldap.help', array(
				'GENERAL_HELP' => $lang["help"][13],
			));	
		}

	}
	
}
// Ajout LDAP en masse
elseif (isset($_GET['action']) && $_GET['action'] == 'addall_ldap')
{
	// Racine de recherche LDAP du site
	$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask".intval($_GET["agence_id"])."'";
	$tab_racine = $req1->db_use_query($requete);
	
	if (count($tab_racine) > 0)
		$racine = $tab_racine[0]["valeur"];
	else
		$racine = LDAP_MASK;
		
	// Traitement de la Cr�ation en masse
	if (isset($_POST['soumettre']))
	{

		$ds=ldap_connect(LDAP_HOST, LDAP_PORT);				
		$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);
		$sr=@ldap_search($ds, $racine, "SN=*");
		
		@ldap_sort($ds, $sr, "sn");
		$info = @ldap_get_entries($ds, $sr);
		
		$users = array();
		$users_error = 0;
		
		// Si il y a bien des utilisateurs dans l'annuaire LDAP
		if ($info["count"] != 0)
		{
			if (defined("LDAP_ATTR_LNAME"))						
				$ldap_nom = LDAP_ATTR_LNAME;
			else
				$ldap_nom = 'sn';
				
			if (defined("LDAP_ATTR_FNAME"))						
				$ldap_prenom = LDAP_ATTR_FNAME;
			else
				$ldap_prenom = 'givenname';

			if (defined("LDAP_ATTR_MAIL"))						
				$ldap_mail = LDAP_ATTR_MAIL;
			else
				$ldap_mail = 'mail';

			if (defined("LDAP_ATTR_LOGINWIN"))						
				$ldap_login_win = LDAP_ATTR_LOGINWIN;
			else
				$ldap_login_win = 'samaccountname';
				
			// Verifie si les personnes de l'annuaire sont dans la table utilisateurs
			if (defined("LDAP_KEY"))
				$key = explode(";",LDAP_KEY);
			else
				$key = array('mail','mail');
				
			for ($i=0; $i < $info["count"]; $i++)
			{
				if (isset($info[$i][constant("LDAP_ATTR_".strtoupper($key[1]))][0]) && $info[$i][constant("LDAP_ATTR_".strtoupper($key[1]))][0] != '')
				{
					$tab_bis = $req1->db_use_query("SELECT ".TAB_USERS.".*,
					".TAB_USERS_GRP.".libelle
					FROM ".TAB_USERS." 
					  LEFT JOIN ".TAB_USERS_GRP." ON ".TAB_USERS_GRP.".id = ".TAB_USERS.".groupe_id
					WHERE ".TAB_USERS.".".$key[0]."='".$info[$i][constant("LDAP_ATTR_".strtoupper($key[1]))][0]."'");
				}
				else
					$tab_bis = array();

				// Utilisateur existant dans LDAP mais pas dans OUAPI
				// ou
				// Utilisateur existant dans LDAP et dans OUAPI et option doublons = "Remplacer"
				if ((count($tab_bis) > 0 && $_POST["duplicate"] == 1) || count($tab_bis) == 0)
				{						
					// Champs obligatoires OK
					if (isset($info[$i][$ldap_nom][0]) && isset($info[$i][$ldap_prenom][0]))
					{						
						$agence_id = $_GET["agence_id"];
							
						// AVEC Cr�ation de l'utilisateur OUAPI
						if ($_POST["user_ouapi"] == 1)
						{
							$nom = $info[$i][$ldap_nom][0];
							$prenom = $info[$i][$ldap_prenom][0];
							$mail = @$info[$i][$ldap_mail][0];
							$login_win = @$info[$i][$ldap_login_win][0];
							$langue = DEFAULT_LANGUAGE;
							$login = ${$_POST["default_login"]};
							$mdp = password_hash(${$_POST["default_mdp"]}, PASSWORD_BCRYPT);
							$groupe_id = $_POST["groupe_id"];												
						}
						// SANS Cr�ation de l'utilisateur OUAPI
						else
						{
							$nom = $info[$i][$ldap_nom][0];
							$prenom = $info[$i][$ldap_prenom][0];
							$mail = @$info[$i][$ldap_mail][0];
							$login_win = @$info[$i][$ldap_login_win][0];
							$langue = DEFAULT_LANGUAGE;
							$login = sin(rand());
							$mdp = cos(rand());
							$groupe_id = $_POST["groupe_id"];																		
						}
						
						$requete = "INSERT INTO ".TAB_USERS." (nom,prenom,mail,groupe_id,agence_id,login,mdp,login_win,langue)
						VALUES ('".$nom."','".$prenom."','".$mail."','".$groupe_id."','".$agence_id."','".$login."','".$mdp."','".$login_win."','".$langue."')";

						//echo $requete.'<br/>';
						$tab = $req1->db_use_query($requete);

						// Si on etait dans le cas d'un doublon, supprimer l'ancien et mettre � jour la table resa
						if (count($tab_bis) > 0)
						{						
							$requete = "DELETE FROM ".TAB_USERS." WHERE id='".$tab_bis[0]["id"]."'";
							$tab = $req1->db_use_query($requete);
							$requete = "UPDATE ".TAB_RESA." SET user_id='".mysqli_insert_id($req1->connection)."' WHERE user_id='".$tab_bis[0]["id"]."'";
							$tab = $req1->db_use_query($requete);					
						}
					}
									
				}
				
			}

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_user_addallok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));			

		}
		
	}
	else
	{
		$template->assign_block_vars('addall_ldap', array(
		  'TITLE' => $lang["adm_user_addallldap_title"],
		));
		
		if (LDAP_INSTALL == "Oui" && $fp = @fsockopen(LDAP_HOST, LDAP_PORT, $errno, $errstr, 5))
		{			
			fclose($fp);	
			
			$ds=ldap_connect(LDAP_HOST, LDAP_PORT);				
			$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);
			$sr=@ldap_search($ds, $racine, "SN=*");
			
			@ldap_sort($ds, $sr, "sn");
			$info = @ldap_get_entries($ds, $sr);
			
			$users = array();
			$users_error = 0;
			
			// Si il y a bien des utilisateurs dans l'annuaire LDAP
			if ($info["count"] != 0)
			{
				$template->assign_block_vars('addall_ldap.status', array(
				  'CLASS' => 'information',
				  'TEXT' => $lang["adm_user_addall_status"],
				));
				
				// Verifie si les personnes de l'annuaire sont dans la table utilisateurs
				if (defined("LDAP_KEY"))
					$key = explode(";",LDAP_KEY);
				else
					$key = array('mail','mail');

				if (defined("LDAP_ATTR_LNAME"))						
					$ldap_nom = LDAP_ATTR_LNAME;
				else
					$ldap_nom = 'sn';
					
				if (defined("LDAP_ATTR_FNAME"))						
					$ldap_prenom = LDAP_ATTR_FNAME;
				else
					$ldap_prenom = 'givenname';
					
				for ($i=0; $i < $info["count"]; $i++)
				{
					if (isset($info[$i][constant("LDAP_ATTR_".strtoupper($key[1]))][0]) && $info[$i][constant("LDAP_ATTR_".strtoupper($key[1]))][0] != '')
					{
						$tab_bis = $req1->db_use_query("SELECT ".TAB_USERS.".*,
						".TAB_USERS_GRP.".libelle
						FROM ".TAB_USERS." 
						  LEFT JOIN ".TAB_USERS_GRP." ON ".TAB_USERS_GRP.".id = ".TAB_USERS.".groupe_id
						WHERE ".TAB_USERS.".".$key[0]."='".$info[$i][constant("LDAP_ATTR_".strtoupper($key[1]))][0]."'");
					}
					else
						$tab_bis = array();

					// Utilisateur dans LDAP et dans OUAPI
					if (count($tab_bis) > 0)
					{					
						array_push($users, $tab_bis[0]["id"]);						
					}
					
					// Un des champs obligatoire pour la cr�ation est manquant
					if (!isset($info[$i][$ldap_nom][0]) || !isset($info[$i][$ldap_prenom][0]))
					{
						$users_error++;						
					}
				}

				$template->assign_block_vars('addall_ldap.status.ok', array(
				  'NEWUSERS' => $lang["adm_user_addall_newusers"],
				  'NB_NEWUSERS' => $info["count"] - count($users),
				  'EXISTUSERS' => $lang["adm_user_addall_existusers"],
				  'NB_EXISTUSERS' => count($users),
				));
				
				if (count($users_error) > 0)
				{
					$template->assign_block_vars('addall_ldap.status.ok.error', array(
					  'USERSERROR' => $lang["adm_user_addall_userserror"],
					  'NB_USERSERROR' => $users_error,
					));
				}

				/*$template->assign_block_vars('addall_ldap.status.detail', array(
				  'TEXT' => $lang["gen_plusdetail"],
				));*/
				
				// Gestion des doublons
				$template->assign_block_vars('addall_ldap.duplicate', array(
				  'TITLE' => $lang["adm_user_addall_duplicateentries"],
				));

				$options = array('libelle' => array($lang["adm_user_addall_dupl_ouapiok"],$lang["adm_user_addall_dupl_ldapok"]), 'value' => array(0,1));
				$i = 0;
				while ($i < count($options["libelle"]))
				{
					$template->assign_block_vars('addall_ldap.duplicate.list', array(
					  'ID' =>  $options['value'][$i],
					  'LIBELLE' =>  $options['libelle'][$i]
					));
					$i++;
				}
				
				// Cr�er l'utilisateur dans OUAPI
				$template->assign_block_vars('addall_ldap.user_ouapi', array(
				  'TITLE' => $lang["adm_user_addall_ouapi_user"],
				));
				
				$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 
				'value' => array(1,0), 'checked' => array('','checked'),
				'onclick' => array('javascript:document.getElementById(\'ouapi_user\').style.display=\'block\'','javascript:document.getElementById(\'ouapi_user\').style.display=\'none\''));

				$i =0;
				while ($i < count($options["libelle"]))
				{
					$template->assign_block_vars('addall_ldap.user_ouapi.list', array(
					  'VALUE' => $options['value'][$i],
					  'LIBELLE' => $options['libelle'][$i],
					  'CHECKED' => $options['checked'][$i],
					  'ONCLICK' => $options['onclick'][$i]
					));
					$i++;
				}

				// Groupe
				$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS_GRP." ORDER BY id DESC");
				$template->assign_block_vars('addall_ldap.group', array(
				  'TITLE' => $lang["adm_user_addall_defaultgroup"],
				));

				$i = 0;
				while ($i < count($tab))
				{
					$template->assign_block_vars('addall_ldap.group.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle']
					));
					$i++;
				}
				
				// Login OUAPI par d�faut
				$template->assign_block_vars('addall_ldap.login', array(
				  'TITLE' => $lang["adm_user_addall_defaultlogin"],
				));

				$options = array('libelle' => array($lang["admin_ldap_loginwin"],$lang["admin_ldap_mail"]), 
				'id' => array('login_win','mail'));
				$i = 0;
				while ($i < count($options["libelle"]))
				{
					$template->assign_block_vars('addall_ldap.login.list', array(
					  'ID' =>  $options['id'][$i],
					  'LIBELLE' =>  $options['libelle'][$i]
					));
					$i++;
				}
				
				// MDP OUAPI par d�faut
				$template->assign_block_vars('addall_ldap.mdp', array(
				  'TITLE' => $lang["adm_user_addall_defaultmdp"],
				));

				$options = array('libelle' => array($lang["admin_ldap_fname"],$lang["admin_ldap_lname"],$lang["admin_ldap_loginwin"]),
				'id' => array('prenom','nom','login_win'));
				$i = 0;
				while ($i < count($options["libelle"]))
				{
					$template->assign_block_vars('addall_ldap.mdp.list', array(
					  'ID' =>  $options['id'][$i],
					  'LIBELLE' =>  $options['libelle'][$i]
					));
					$i++;
				}
				
				$template->assign_block_vars('addall_ldap.button', array(
				  'TITLE' => $lang["add"],
				));
			}
			// Aucun utilisateur dans l'annuaire LDAP
			else
			{	
			
			}

		}
		// LDAP non install� ou non disponible
		else
		{
		
		}
	}
}
// Exporter XLS
if (isset($_GET['export']) && $_GET['export'] == 'excel')
{
	$tab = $req1->db_use_query("SELECT nom,prenom,login,login_win FROM ".TAB_USERS ." WHERE agence_id='".$_GET["agence_id"]."'");
	exp_excel('Users',$tab);
}

echo $affichage;



?>