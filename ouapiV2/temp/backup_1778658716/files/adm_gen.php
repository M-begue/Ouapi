<?php

declare(strict_types=1);

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use;
$affichage = '';

// Ajouter un groupe
if (isset($_GET['action']) && $_GET['action'] == 'add_grp')
{
	$err = array();
	$grpname = format_string_db($_POST["grp_name"]);
	
	$requete = "SELECT * FROM ".TAB_USERS_GRP." WHERE libelle='".$grpname."'";
	$tab = $req1->db_use_query($requete);
	
	if (trim($grpname) == '')
		array_push($err,$lang["adm_gen_grpadd_error_empty"]);
	if (count($tab) != 0)
		array_push($err,$lang["adm_gen_grpadd_error_exist"]);
	
	if (count($err) == 0)
	{		
		$requete = "INSERT INTO ".TAB_USERS_GRP." (libelle)	VALUES ('".$grpname."')";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_gen_grpadd_ok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));		
	}
	else
	{
		$errors = $lang["adm_gen_grpadd_nok"].'<br/><br/>';
		
		while(list($key, $val) = each($err))
		{ 
			$aff_key = $key+1;
			$errors .= $aff_key.') '.$val.'<br/>';
		}
			
		$template->assign_block_vars('form_post', array(
			'OK' => $errors, 					
			'CLOSE' => $lang["close"],	
			'ID' => 'alert'
		));
	
	}
}
// Supprimer un groupe
elseif (isset($_GET['action']) && $_GET['action'] == 'del_grp')
{
	$requete = "DELETE FROM ".TAB_USERS_GRP." WHERE id='".$_GET["grp_id"]."'";
	$tab = $req1->db_use_query($requete);
	
	$requete = "UPDATE ".TAB_USERS." SET groupe_id='".$_POST["grp_new"]."' WHERE groupe_id='".$_GET["grp_id"]."'";
	$tab = $req1->db_use_query($requete);
	
	$affichage = '<br/><p class="contenu" id="mess_retour">'.$lang["adm_gen_grpdel_ok"].'<br/><br/>
	<a href="#" onclick="RefreshAndClose()">'.$lang["close"].'</a></p><br/>';
}
/*************************************/
/*		    Config G�n�rale          */
/*************************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'param' && isset($_POST['soumettre']))
{
	$warning = array();
	
	$requete = "SELECT * FROM ".TAB_CONFIG." WHERE ".CO_NAME." LIKE 'param_%' OR ".CO_NAME." LIKE 'activrub_%' ORDER BY ".CO_SUBCAT.", ".CO_NAME;
	$tab = $req1->db_use_query($requete);

	$requete_update = "";

	// Cas particulier: langue par d�faut
	$requete_update = "UPDATE ".TAB_CONFIG." SET valeur='".$_POST["langue_defaut"]."' WHERE nom='default_language'";
	$tab_update = $req1->db_use_query($requete_update);
	
	// Cas particulier: template par d�faut
	$requete_update = "UPDATE ".TAB_CONFIG." SET valeur='".$_POST["template_defaut"]."' WHERE nom='default_template'";
	$tab_update = $req1->db_use_query($requete_update);

	// Autres cas
	$i = 0;
	while ($i < count($tab))
	{
		$requete_update = "UPDATE ".TAB_CONFIG." SET valeur='".format_string_db($_POST[$tab[$i]["nom"]])."' WHERE id='".$tab[$i]["id"]."'";
		$tab_update = $req1->db_use_query($requete_update);
		$i++;
	}

	// Activation / D�sactivation OCS/LDAP/Multisite
	$contenu_new=@file_get_contents("config/connect.php");
	
	$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom='db_ocs_host' OR nom='db_ocs_user' OR nom='db_ocs_mdp' OR nom='db_ocs_transm' ORDER BY id,nom";
	$tab = $req1->db_use_query($requete);
	
	if (!stripos($contenu_new,'"OCS_INSTALL","Oui"') && count($tab) == 0)
	{
		$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) 
		VALUES ('db_ocs_host', '".$lang["adm_gen_instocs_l_host"]."', '".$lang["adm_gen_instocs_d_host"]."' , 'localhost', 'text', '1')");
		
		$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) 
		VALUES ('db_ocs_user', '".$lang["adm_gen_instocs_l_user"]."', '".$lang["adm_gen_instocs_d_user"]."' , 'ocs', 'text', '1')");
		
		$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) 
		VALUES ('db_ocs_mdp', '".$lang["adm_gen_instocs_l_mdp"]."', '".$lang["adm_gen_instocs_d_mdp"]."' , 'ocs', 'text', '1')");
		
		$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) 
		VALUES ('db_ocs_transm', '".$lang["adm_gen_instocs_l_base"]."', '".$lang["adm_gen_instocs_d_base"]."' , 'ocsweb', 'text', '1')");
	}
	
	$contenu_new=str_ireplace('"OCS_INSTALL","Oui"', '"OCS_INSTALL","#"', $contenu_new);
	$contenu_new=str_ireplace('"OCS_INSTALL","Non"', '"OCS_INSTALL","#"', $contenu_new);
	$contenu_new=str_ireplace('"OCS_INSTALL","#"', '"OCS_INSTALL","'.$_POST["ocs"].'"', $contenu_new);					
			
	// Activation LDAP
	if (extension_loaded("ldap") || $_POST["ldap"] == "Non")
	{
		$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom='ldap_host' OR nom='ldap_user' OR nom='ldap_mdp' OR nom='ldap_port' OR nom='ldap_mask' ORDER BY id,nom";
		$tab = $req1->db_use_query($requete);
		
		// LDAP n'a jamais �t� activ�, on cr�e les variables
		if (!stripos($contenu_new,'"LDAP_INSTALL","Oui"') && count($tab) == 0)
		{
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_host', 'general', '".$lang["adm_gen_instldap_l_host"]."', '".$lang["adm_gen_instldap_d_host"]."' , 'localhost', 'text', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_user', 'general', '".$lang["adm_gen_instldap_l_user"]."', '".$lang["adm_gen_instldap_d_user"]."' , 'root', 'text', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_mdp', 'general', '".$lang["adm_gen_instldap_l_mdp"]."', '".$lang["adm_gen_instldap_d_mdp"]."' , '', 'text', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_port', 'general', '".$lang["adm_gen_instldap_l_port"]."', '".$lang["adm_gen_instldap_d_port"]."' , '389', 'text', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_mask', 'users', '".$lang["adm_gen_instldap_l_root"]."', '".$lang["adm_gen_instldap_d_root"]."' , 'OU=Utilisateurs,dc=mycompany,dc=com', 'text', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_mask_hard', 'hard', '".$lang["adm_gen_instldap_l_root_hard"]."', '".$lang["adm_gen_instldap_d_root_hard"]."' , 'OU=Ordinateurs,dc=mycompany,dc=com', 'text', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_attr_fname', 'users', '".$lang["adm_gen_instldap_attrfname"]."', '".$lang["adm_gen_instldap_attrfnamedesc"]."' , 'givenname', 'list', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_attr_lname', 'users', '".$lang["adm_gen_instldap_attrlname"]."', '".$lang["adm_gen_instldap_attrlnamedesc"]."'  , 'sn', 'list', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_attr_mail', 'users', '".$lang["adm_gen_instldap_attrmail"]."', '".$lang["adm_gen_instldap_attrmaildesc"]."'  , 'mail', 'list', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_attr_loginwin', 'users', '".$lang["adm_gen_instldap_attrloginwin"]."', '".$lang["adm_gen_instldap_attrloginwindesc"]."'  , 'samaccountname', 'list', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_key', 'users', '".$lang["adm_gen_instldap_key"]."', '".$lang["adm_gen_instldap_keydesc"]."' , 'mail', 'list', '1')");			
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_attr_hard_name', 'hard', '".$lang["adm_gen_instldap_attrhardname"]."', '".$lang["adm_gen_instldap_attrhardnamedesc"]."'  , 'name', 'list', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_attr_hard_description', 'hard', '".$lang["adm_gen_instldap_attrharddescription"]."', '".$lang["adm_gen_instldap_attrharddescriptiondesc"]."'  , 'description', 'list', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_attr_hard_created', 'hard', '".$lang["adm_gen_instldap_attrhardcreated"]."', '".$lang["adm_gen_instldap_attrhardcreateddesc"]."'  , 'whencreated', 'list', '1')");
			$tab = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` (`".CO_NAME."` ,`".CO_SUBCAT."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) VALUES ('ldap_key_hard', 'hard', '".$lang["adm_gen_instldap_keyhard"]."', '".$lang["adm_gen_instldap_keyharddesc"]."' , 'nom;name', 'list', '1')");
		}
		
		$contenu_new=str_ireplace('"LDAP_INSTALL","Oui"', '"LDAP_INSTALL","#"', $contenu_new);
		$contenu_new=str_ireplace('"LDAP_INSTALL","Non"', '"LDAP_INSTALL","#"', $contenu_new);
		$contenu_new=str_ireplace('"LDAP_INSTALL","#"', '"LDAP_INSTALL","'.$_POST["ldap"].'"', $contenu_new);
	}
	else
	{
		array_push($warning,$lang["adm_gen_ldapexterror"]);
	}
	
	$contenu_new=str_ireplace('"MULTISITE","Oui"', '"MULTISITE","#"', $contenu_new);
	$contenu_new=str_ireplace('"MULTISITE","Non"', '"MULTISITE","#"', $contenu_new);
	$contenu_new=str_ireplace('"MULTISITE","#"', '"MULTISITE","'.$_POST["multi"].'"', $contenu_new);
	
	//ouverture en �criture
	$text=fopen("config/connect.php",'w+') or die("Fichier config.php manquant");
	fwrite($text,$contenu_new);
	fclose($text); 

	
	//Aucun warning
	if (count($warning) == 0)
	{
		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_gen_param_majok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{
		$retour = $lang["adm_gen_param_majwarn"].'<br/><br/>';
		while(list($key, $val) = each($warning))
		{ 
			$aff_key = $key+1;
			$retour .= $aff_key.') '.$val.'<br>';
		}

		$template->assign_block_vars('form_post', array(
			'OK' => $retour, 					
			'CLOSE' => $lang["close"],	
			'ID' => 'warning'
		));			
	}
}
// parametrage des droits
elseif (isset($_GET['action']) && $_GET['action'] == 'param_rights')
{
	$rights = 'RGT;'.implode(';',$_POST).';';
	$requete = "UPDATE ".TAB_USERS_GRP." SET rights='".$rights."' WHERE id ='".$_GET["grp_id"]."'";
	$tab_update = $req1->db_use_query($requete);	
	
	$template->assign_block_vars('form_post', array(
		'OK' => $lang["adm_gen_param_majok"], 					
		'CLOSE' => $lang["close"],	
		'ID' => 'mess_retour'
	));			

}
elseif (isset($_GET['action']) && $_GET['action'] == 'param_ldap' && isset($_POST['soumettre']))
{
	$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom LIKE 'ldap_%' ORDER BY nom,id";
	$tab = $req1->db_use_query_inv($requete);

	$post_values = array(
		'ldap_attr_fname' => $_POST["ldap_attr_fname"], 
		'ldap_attr_lname' => $_POST["ldap_attr_lname"], 
		'ldap_attr_mail' => $_POST["ldap_attr_mail"], 
		'ldap_attr_loginwin' => $_POST["ldap_attr_loginwin"],
		'ldap_host' => format_string_db($_POST["ldap_host"]),
		'ldap_user' => format_string_db($_POST["ldap_user"]),
		'ldap_mdp' => format_string_db($_POST["ldap_mdp"]),
		'ldap_port' => format_string_db($_POST["ldap_port"]),
		'ldap_mask' => format_string_db($_POST["ldap_mask"]),
		'ldap_mask_hard' => format_string_db($_POST["ldap_mask_hard"]),
		'ldap_attr_hard_name' => format_string_db($_POST["ldap_attr_hard_name"]),
		'ldap_attr_hard_description' => format_string_db($_POST["ldap_attr_hard_description"]),
		'ldap_attr_hard_created' => format_string_db($_POST["ldap_attr_hard_created"]),
		'ldap_attr_hard_os' => format_string_db($_POST["ldap_attr_hard_os"]),
	);
	
	$requete = "SELECT * FROM ".TAB_CONFIG." WHERE ".CO_NAME." LIKE 'ldap_mask%'";
	$tab_mask = $req1->db_use_query($requete);
	
	$i = 0;
	while ($i < count($tab_mask))
	{
		$post_values[$tab_mask[$i][CO_NAME]] = format_string_db($_POST[$tab_mask[$i][CO_NAME]]);
		$i++;
	}
	
	while (list($key, $val) = each($post_values)) 
	{	
		if (is_array($tab["nom"]) && in_array($key,$tab["nom"]))
			$requete = "UPDATE ".TAB_CONFIG." SET valeur='".$val."' WHERE nom ='".$key."'";
		else
			$requete = "INSERT INTO ".TAB_CONFIG." (nom,valeur) VALUES ('".$key."','".$val."')";
		$tab_update = $req1->db_use_query($requete);	
		// echo $requete.'<br/>';
	}	

	$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom LIKE 'ldap_key'";
	$tab = $req1->db_use_query_inv($requete);
	
	if (count($tab) > 0)
		$requete = "UPDATE ".TAB_CONFIG." SET valeur='".$_POST["ldap_key"]."' WHERE nom ='ldap_key'";
	else
		$requete = "INSERT INTO ".TAB_CONFIG." (nom,valeur) VALUES ('ldap_key','".$_POST["ldap_key"]."')";
	$tab_update = $req1->db_use_query($requete);		
	
	$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom LIKE 'ldap_key_hard'";
	$tab = $req1->db_use_query_inv($requete);
	
	if (count($tab) > 0)
		$requete = "UPDATE ".TAB_CONFIG." SET valeur='".$_POST["ldap_key_hard"]."' WHERE nom ='ldap_key_hard'";
	else
		$requete = "INSERT INTO ".TAB_CONFIG." (nom,valeur) VALUES ('ldap_key_hard','".$_POST["ldap_key_hard"]."')";
	$tab_update = $req1->db_use_query($requete);		
	
	$template->assign_block_vars('form_post', array(
		'OK' => $lang["adm_gen_param_majok"], 					
		'CLOSE' => $lang["close"],	
		'ID' => 'mess_retour'
	));			
}
elseif (isset($_GET['action']) && $_GET['action'] == 'param_ocs' && isset($_POST['soumettre']))
{
	$connect_ocs = new db_connect();			
	$err = $connect_ocs->test_cnx($_POST["db_ocs_host"],$_POST["db_ocs_user"],$_POST["db_ocs_mdp"],$_POST["db_ocs_transm"]);
	
	if (count($err) == 0)
	{
		$connect_ocs->connection();
				
		$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom LIKE 'db_ocs_%' ORDER BY nom,id";
		$tab = $req1->db_use_query_inv($requete);

		$post_values = array('db_ocs_host' => format_string_db($_POST["db_ocs_host"]),
			'db_ocs_user' => format_string_db($_POST["db_ocs_user"]),
			'db_ocs_mdp' => format_string_db($_POST["db_ocs_mdp"]),
			'db_ocs_transm' => format_string_db($_POST["db_ocs_transm"]),
		);
		
		while (list($key, $val) = each($post_values)) 
		{	
			if (is_array($tab["nom"]) && in_array($key,$tab["nom"]))
				$requete = "UPDATE ".TAB_CONFIG." SET valeur='".$val."' WHERE nom ='".$key."'";
			else
				$requete = "INSERT INTO ".TAB_CONFIG." (nom,valeur) VALUES ('".$key."','".$val."')";
			$tab_update = $req1->db_use_query($requete);		
		}
	
		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_gen_param_majok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));		
	}
	else
	{
		$errors = $lang["error_mysql_cnx_title"].'<br/><br/>';
		
		while(list($key, $val) = each($err))
		{ 
			$aff_key = $key+1;
			$errors .= $val.') '.txt_to_na($lang["error_mysql_cnx_".$val]).'<br/>';
		}
			
		$template->assign_block_vars('form_post', array(
			'OK' => $errors, 					
			'CLOSE' => $lang["close"],	
			'ID' => 'alert'
		));					
	}

}
/***************************************************/
/*		    Ajouter un champ personnalis�          */
/***************************************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'addfield' && isset($_POST['soumettre']))
{
	$table = $_POST["table"];
	$fieldname = $_POST["fieldname"];
	$fieldname_nospecchar = 'pfield_'.preg_replace("#[^a-zA-Z0-9]#", "",strtolower($fieldname));
	$fieldtype = $_POST["fieldtype"];
	
	$error = '';

	if (trim($fieldname) != '')
	{
		$requete = "ALTER TABLE ".$table." ADD ".$fieldname_nospecchar." ".$fieldtype;
		$tab_update = $req1->db_use_query($requete);
	}
	else
	{
		$error .= $lang["adm_gen_errorempty"];
	}
	
	//Traitement des erreurs
	if ($req1->connection->error)
	{
		if (isset($lang["error_mysql_cnx_".$req1->connection->errno]))
			$error .= $lang["error_mysql_cnx_".$req1->connection->errno];
		else
			$error .= $req1->connection->error;
	}
	
	if ($error == '')
	{
		$tab_confname = $req1->db_use_query("INSERT INTO `".TAB_CONFIG."` 
		(`".CO_NAME."` ,`".CO_LIBELLE."` ,`".CO_DESCRIPTION."` ,`".CO_VALUE."` ,`".CO_FORMTYPE."` ,`".CO_GLOBAL."`) 
		VALUES ('pfparam_".$table.".".$fieldname_nospecchar."', '".$table.'.'.$fieldname_nospecchar."', '' , '".format_string_db($fieldname)."', '', '0')");
		
		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_gen_addfieldok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));	
	}
	else
	{
		$template->assign_block_vars('form_post', array(
			'OK' => $lang["error_mysql_cnx_title"].'<br/>'.$error, 					
			'CLOSE' => $lang["close"],	
			'ID' => 'alert'
		));
	}

	
}
/***************************************************/
/*		   Supprimer un champ personnalis�         */
/***************************************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'delfield')
{
	$table = $_GET["table"];
	$fieldname = $_GET["fieldname"];
	
	$error = '';

	$requete = "ALTER TABLE ".$table." DROP ".$fieldname;
	$tab_update = $req1->db_use_query($requete);
	
	//Traitement des erreurs
	if ($req1->connection->error)
	{
		if (isset($lang["error_mysql_cnx_".$req1->connection->errno]))
			$error .= $lang["error_mysql_cnx_".$req1->connection->errno];
		else
			$error .= $req1->connection->error;
	}
	
	if ($error == '')
	{
		$requete = "DELETE FROM ".TAB_CONFIG." WHERE libelle='".$table.".".$fieldname."'";
		$tab_confname = $req1->db_use_query($requete);
		
		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_gen_delfieldok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));	
	}
	else
	{
		$template->assign_block_vars('form_post', array(
			'OK' => $lang["error_mysql_cnx_title"].'<br/>'.$error, 					
			'CLOSE' => $lang["close"],	
			'ID' => 'alert'
		));
	}

	
}

echo $affichage;




?>