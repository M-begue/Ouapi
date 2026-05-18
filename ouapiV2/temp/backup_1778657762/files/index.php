<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2014 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

// Paramètrage à la volée du PHP.ini
if (defined("PARAM_DEBUG_MODE") && PARAM_DEBUG_MODE == 1)
{
	ini_set("error_reporting", E_ALL);
	ini_set("display_errors", "On");
}

function get_microtime()
{   
	list($tps_usec, $tps_sec) = explode(" ",microtime());   
	return ((float)$tps_usec + (float)$tps_sec);   
}   
$tps_start = get_microtime();  

session_start();
$affichage = '';
$titre = '';

// On vérifie si l'installation est correcte
if (is_file("config/connect.php"))
{
	include('common_includes.php');
	include('config/declare.php');

	$connect = new db_connect();
	$connect->connection();
	$req1 = new db_use;

	// Définition de la langue
	if (!isset($_SESSION["int_lang"]))
		$_SESSION["int_lang"] = DEFAULT_LANGUAGE;
	
	include('lang/lang_'.$_SESSION["int_lang"].'.php');

	//Fichiers de langue des plugins
	$requete = "SELECT * FROM ".TAB_PLUGIN." ORDER BY id";
	$tab_plg = $req1->db_use_query($requete);

	$i = 0;
	while ($i < count($tab_plg))
	{	
		if (is_file('lang/plg_'.$tab_plg[$i]["name"].'_lang_'.$_SESSION["int_lang"].'.php'))
			include('lang/plg_'.$tab_plg[$i]["name"].'_lang_'.$_SESSION["int_lang"].'.php');
		$i++;
	}
	
	// On vérifie que le répertoire install n'existe plus
	if (is_dir("install/") && isset($_GET["action"]) && $_GET["action"] == "maj_ouapi") 
		header('location:install/index.php');
	elseif (is_dir("install/") && !isset($_GET["action"]))
		die (utf8_decode($lang["error_installdir"]));

	

	// Init du template
	$template = new Template('templates/'.DEFAULT_TEMPLATE);
	$template->set_filenames(array(
		'page_head' => 'overall_header.tpl',			
		'page_tail' => 'overall_footer.tpl'
	  ));
	
	// Template de la page
	if (isset($_GET["page"]))
	{
		$page = explode('.',$_GET["page"]);
		$template->set_filenames(array(
			$page[0] => $page[0].'.tpl',			
		  ));
	}
	elseif (isset($_GET["plugin"]))
	{
		$page = explode('.',$_GET["plugin"]);
		$template->set_filenames(array(
			$page[0] => $page[0].'.tpl',			
		  ));
	}
	else
	{
		header('location:'.$_SESSION["page_defaut"]);
	}
	
	// Template et class de la rubrique
	if (isset($_GET["rubrique"]))
	{
		if (isset($_GET["rubrique"]) && $fp = @fopen('includes/class_'.$_GET["rubrique"].'.php',"r"))
		{
			include('includes/class_'.$_GET["rubrique"].'.php');		
		}

		$template->set_filenames(array(
			$_GET["rubrique"] => 'rub_'.$_GET["rubrique"].'.tpl',			
		  ));
	}

	// Si la session n'est pas encore ouverte
	if (!isset($_SESSION["user_grp"]) && $_GET["page"] != "login_form.php")
	{	
		// CAS 1 : Connexion depuis le serveur
		if (gethostbyname($_SERVER["REMOTE_ADDR"]) == "127.0.0.1")
		{
			$localhost = '1';
			
			$requete = "SELECT ".TAB_USERS.".*,
			".TAB_USERS_GRP.".rights AS grp_rights
			FROM ".TAB_USERS."
			  LEFT JOIN ".TAB_USERS_GRP." ON ".TAB_USERS_GRP.".id = ".TAB_USERS.".groupe_id
			WHERE ".TAB_USERS.".id='1'";
			$tab_user = $req1->db_use_query($requete);	
		
			if (count($tab_user) > 0)
			{
				$_SESSION["nom_comp"] = $tab_user[0]["prenom"]." ".$tab_user[0]["nom"];
				$_SESSION["user_grp"] = $tab_user[0]["groupe_id"];
				$_SESSION["grp_rights"] = $tab_user[0]["grp_rights"];
				$_SESSION["user_agence"] = $tab_user[0]["agence_id"];
				$_SESSION["user_id"] = $tab_user[0]["id"];
				$_SESSION["int_lang"] = $tab_user[0]["langue"];
				$_SESSION["page_defaut"] = 'index.php?page=accueil.php&agence_id='.$_SESSION["user_agence"];
				
				header('location:'.$_SESSION["page_defaut"]); 
			}
			else
				header('location:index.php?page=login_form.php&amp;err=user_mdp_wrong');

		}
		// CAS 2 : Si profil "Invité" est activé
		elseif (PARAM_ENABLE_GUEST == 1)
		{
			$requete = "SELECT * FROM ".TAB_USERS_GRP."	WHERE id='100'";
			$tab = $req1->db_use_query($requete);
			
			$_SESSION["nom_comp"] = $lang["gen_guest"];
			$_SESSION["user_grp"] = 100;
			$_SESSION["grp_rights"] = $tab[0]["rights"];
			$_SESSION["user_agence"] = 1;
			$_SESSION["user_id"] = 9999999;
			$_SESSION["int_lang"] = DEFAULT_LANGUAGE;
			$_SESSION["page_defaut"] = 'index.php?page=accueil.php&agence_id='.$_SESSION["user_agence"];
			
			header('location:'.$_SESSION["page_defaut"]); 		
		}
		// CAS 3 : LOGIN Type DNS - Verif du niveau de l'utilisateur
		elseif (LOGIN_TYPE == "dns")
		{
			$remote_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$remote_host = explode('.',$remote_host);

			$requete = "SELECT * FROM ".TAB_HARD." WHERE nom LIKE '".$remote_host[0]."%'";
			$req1 = new db_use;
			$tab = $req1->db_use_query($requete);
			
			if (count($tab) > 0 || isset($localhost))
			{
				$requete = "SELECT ".TAB_USERS.".*,
				".TAB_USERS_GRP.".rights AS grp_rights
				FROM ".TAB_USERS."
 				  LEFT JOIN ".TAB_USERS_GRP." ON ".TAB_USERS_GRP.".id = ".TAB_USERS.".groupe_id
				WHERE ".TAB_USERS.".id='".$tab[0]["user_id"]."'";
				$tab_user = $req1->db_use_query($requete);	
			
				if (count($tab_user) > 0)
				{
					$_SESSION["nom_comp"] = $tab_user[0]["prenom"]." ".$tab_user[0]["nom"];
					$_SESSION["user_grp"] = $tab_user[0]["groupe_id"];
					$_SESSION["grp_rights"] = $tab_user[0]["grp_rights"];
					$_SESSION["user_agence"] = $tab_user[0]["agence_id"];
					$_SESSION["user_id"] = $tab_user[0]["id"];
					$_SESSION["int_lang"] = $tab_user[0]["langue"];
					$_SESSION["page_defaut"] = 'index.php?page=accueil.php&agence_id='.$_SESSION["user_agence"];
					header('location:'.$_SESSION["page_defaut"]); 
				}
				else
					header('location:index.php?page=login_form.php&amp;err=user_mdp_wrong');
			}
			else
				header('location:index.php?page=login_form.php&amp;err=user_mdp_wrong');	
		}
		// CAS 4 : Login Type User/MDP
		else
			header('location:index.php?page=login_form.php');	
	}
	
	// Vérification que l'utilisateur a bien les droits d'accès à la rubrique demandée
	if (isset($_GET["rubrique"]) && !preg_match('`;'.constant("RGHT_".strtoupper($_GET["rubrique"])).';`',$_SESSION["grp_rights"]) && $_SESSION["user_grp"] != 10)	
		header('location:'.$_SESSION["page_defaut"]);
		
	// Vérification que l'utilisateur a bien les droits d'accès au site demandé
	if (isset($_GET["agence_id"]) && $_SESSION["user_agence"] != $_GET["agence_id"] && !preg_match('`;'.RGHT_GEN_MULTISITE.';`',$_SESSION["grp_rights"]) && $_SESSION["user_grp"] != 10)
		header('location:'.$_SESSION["page_defaut"]);


	// MODE DEBUG
	if (defined("PARAM_DEBUG_MODE") && PARAM_DEBUG_MODE == 1)
	{
		echo '<div class="debug_box">POST ARRAY :<br/>';
		@print_r($_POST);
		echo '</div>';
		echo '<div class="debug_box">GET ARRAY :<br/>';
		@print_r($_GET);
		echo '</div>';
		echo '<div class="debug_box">SESSION ARRAY :<br/>';
		@print_r($_SESSION);
		echo '</div>';
	}
		
	/* TEMPLATE */
	$help_home_button = '';		
	$help_admin_button = '';		
	$help_site_button = '';		
	$help_search_button = '';		
	$help_help_button = '';	
	$help_addshorcut_button = '';
	$help_rub_button = '';
	$help_test = '';

	
	if ((isset($_GET["page"]) && $_GET["page"] == 'accueil.php') || isset($_GET["show_toolbar"]) || isset($_GET["plugin"]))
	{
		$template->assign_block_vars('head', array());
		
		// Aide
		if (PARAM_HELP == 1)
		{
			$help_home_button = 'tooltip.show(\''.addslashes(format_string_input($lang["help"][14])).'\')';
			$help_admin_button = 'tooltip.show(\''.addslashes(format_string_input($lang["help"][15])).'\')';
			$help_site_button = 'tooltip.show(\''.addslashes(format_string_input($lang["help"][16])).'\')';
			$help_search_button = 'tooltip.show(\''.addslashes(format_string_input($lang["help"][17])).'\')';
			$help_help_button = 'tooltip.show(\''.addslashes(format_string_input($lang["help"][18])).'\')';
			$help_addshorcut_button = 'tooltip.show(\''.addslashes(format_string_input($lang["help"][21])).'\')';
			//$help_rub_button = 'tooltip.show(\''.addslashes(format_string_input($lang["help"][22])).'\')';
			//$help_test = 'tooltip.show(\''.addslashes(format_string_input('<img src=\'data/test.jpg\'/>')).'\')';
		}
			
		$template->assign_block_vars('head.welcome', array(
			'WELCOME' => $lang["header"][3].' '.$_SESSION["nom_comp"]
		));

		if ($_SESSION["user_grp"] != 100)
		{
			$template->assign_block_vars('head.switch_log', array(
				'TEXT' => '[ '.$lang["header"][9].' ]',
				'LINK' => 'config/login.php?action=logout',
			));
		}
		else
		{
			$template->assign_block_vars('head.switch_log', array(
				'TEXT' => '[ '.$lang["gen_login"].' ]',
				'LINK' => 'config/login.php?action=logout',
			));
		}

		// BARRE DES SITES
		if (isset($_SESSION["user_grp"]) && MULTISITE == "Oui" && (preg_match('`;'.RGHT_GEN_MULTISITE.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$titre = $lang["header"][4];
			
			$template->assign_block_vars('head.switch_multisite', array());

			$requete = 'SELECT * FROM '.TAB_AGENCES.' ORDER BY libelle';
			$tab = $req1->db_use_query($requete);
			
			$tab[count($tab)] = array("id" => 0, "libelle" => $lang["admin_site"]);
			
			$i = 0;
			while ($i < count($tab))
			{
				if ((isset($_GET["agence_id"]) && $_GET["agence_id"] == $tab[$i]["id"]) || (!isset($_GET["agence_id"]) && $tab[$i]["id"] == 0))
				{
					$template->assign_block_vars('head.switch_multisite.switch_sites', array(
						'SITE_ID' => $tab[$i]["id"],
						'LIBELLE' => $tab[$i]["libelle"],
						'SELECT' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('head.switch_multisite.switch_sites', array(
						'SITE_ID' => $tab[$i]["id"],
						'LIBELLE' => $tab[$i]["libelle"],
						'SELECT' => ''
					));					
				}					
				$i++;
			}
		}

		// Administration
		if (preg_match('`;'.RGHT_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('head.admin', array(
				'LANG_GEN_ADMIN' => $lang["gen_admin"],
				'IMG_ADMIN' => 'templates/'.DEFAULT_TEMPLATE.'/images/admin.gif',
			));					
		}

		// Barre de Recherche
		if ((preg_match('`;'.RGHT_SEARCH.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && isset($_GET["agence_id"]))
		{
			if (isset($_POST["keywords"]))
				$search_text = format_string_input($_POST["keywords"]);
			else
				$search_text = '';
						
			$template->assign_block_vars('head.search', array(
				'AGENCE_ID' => $_GET["agence_id"],
				'LANG_SEARCH' => $lang["gen_search"],
				'IMG_SEARCH' => 'templates/'.DEFAULT_TEMPLATE.'/images/search_icon.png',
				'TEXT' => $search_text,
			));
		}

		// BARRE DE MENU
		if (isset($_SESSION["user_grp"]) && ((MULTISITE == "Non" && isset($_GET["agence_id"]) && $_GET["agence_id"] == 1) ||
		(MULTISITE == "Oui" && isset($_GET["agence_id"]) && ($_GET["agence_id"] == $_SESSION["user_agence"] || 
		preg_match('`;'.RGHT_GEN_MULTISITE.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))))
		{
			$num = 1;
			$hide_sscat = '';
			
			// OCS
			if (OCS_INSTALL == "Oui")
			{
				$rub["alias"][$num] = "ocs";
				$rub["default_subcat"][$num] = "hard";
				$rub["global"][$num] = 0;
				
				$rub["sspart"][$num][0] = "hard";
				$rub["sspart"][$num][1] = "monitor";
				$rub["sspart"][$num][2] = "modem";
				$rub["sspart"][$num][3] = "printer";
				$rub["sspart"][$num][4] = "input";
				$rub["sspart"][$num][5] = "soft";
				$hide_sscat .= 'document.getElementById(\''.$rub["alias"][$num].'\').style.display=\'none\';';
				
				$num++;
			}
			
			// LDAP
			if (LDAP_INSTALL == "Oui")
			{
				$rub["alias"][$num] = "ldap";
				$rub["default_subcat"][$num] = "user";
				$rub["global"][$num] = 0;
				
				$rub["sspart"][$num][0] = "hard";
				$rub["sspart"][$num][1] = "user";
				$hide_sscat .= 'document.getElementById(\''.$rub["alias"][$num].'\').style.display=\'none\';';
				
				$num++;
			}

			// Evenements
			/*$rub["alias"][$num] = "even";		
			$rub["global"][$num] = 1;	
			$num++;*/

			// Réservations
			$rub["alias"][$num] = "resa";
			$rub["default_subcat"][$num] = "hard";
			$rub["global"][$num] = 1;
			
			$rub["sspart"][$num][0] = "hard";
			$rub["sspart"][$num][1] = "periph";
			$hide_sscat .= 'document.getElementById(\''.$rub["alias"][$num].'\').style.display=\'none\';';

			$num++;

			// Utilisateurs
			$rub["alias"][$num] = "users";		
			$rub["global"][$num] = 0;	
			$num++;

			// Réseau
			$rub["alias"][$num] = "netw";
			$rub["global"][$num] = 1;
			$num++;
			
			// Documents
			$rub["alias"][$num] = "docs";
			$rub["global"][$num] = 0;
			$num++;
		
			// Logiciels
			$rub["alias"][$num] = "soft";
			$rub["global"][$num] = 1;
			$num++;

			// Périphériques
			$rub["alias"][$num] = "periph";
			$rub["global"][$num] = 0;
			$num++;

			// Matériels
			$rub["alias"][$num] = "hard";
			$rub["global"][$num] = 0;				// Si 0 >> apparait dans le site général et dans les sites, 1 uniquement sites
			$num++;

			// Summary
			$rub["alias"][$num] = "sum";
			$rub["global"][$num] = 0;				
			$num++;

			// Plugins Rubriques
			$requete = "SELECT * FROM ".TAB_PLUGIN." WHERE type='rubrique' ORDER BY id";
			$tab_plg = $req1->db_use_query($requete);

			$i = 0;
			while ($i < count($tab_plg))
			{
				if (preg_match('`;'.constant("RGHT_PLG_".strtoupper($tab_plg[$i]["name"])).';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
				{
					$template->assign_block_vars('head.categories', array(
						'RUBRIQUE_LINK' => 'index.php?plugin=plg_'.$tab_plg[$i]["name"].'_body.php&amp;agence_id='.$_GET["agence_id"],
						'RUBRIQUE_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/plg_'.$tab_plg[$i]["name"].'_icon.gif',
						'RUBRIQUE_TITLE' => $tab_plg[$i]["name"]
					));	
				}
				
				include('lang/plg_'.$tab_plg[$i]["name"].'_lang_'.$_SESSION["int_lang"].'.php');

				$i++;
			}
			
			// Rubriques classiques
			$i = 1;
			while ($i <= count($rub["alias"]))
			{
				if ((preg_match('`;'.constant("RGHT_".strtoupper($rub["alias"][$i])).';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && $_GET["agence_id"] >= $rub["global"][$i] && constant("ACTIVRUB_".strtoupper($rub["alias"][$i])) == 1 )
				{			
					if (isset($rub["default_subcat"][$i]))
						$rub_link = 'index.php?page=accueil.php&amp;agence_id='.$_GET["agence_id"].'&amp;rubrique='.$rub["alias"][$i].'&amp;sscat='.$rub["default_subcat"][$i];
					else
						$rub_link = 'index.php?page=accueil.php&amp;agence_id='.$_GET["agence_id"].'&amp;rubrique='.$rub["alias"][$i];

            if ("SUM" === (strtoupper($rub["alias"][$i])))
              $rub_link = 'index.php?page=accueil.php&amp;agence_id='.$_GET["agence_id"];

            $template->assign_block_vars('head.categories', array(
              'RUBRIQUE_LINK' => $rub_link,
              'RUBRIQUE_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/'.$rub["alias"][$i].'_icon.gif',
              'RUBRIQUE_TITLE' => $lang['rub_'.$rub["alias"][$i]],
              'ONMOUSEOVER' => $hide_sscat.'document.getElementById(\''.$rub["alias"][$i].'\').style.display=\'block\';',
            ));

					if (isset($rub["sspart"][$i]))
					{
						$template->assign_block_vars('head.sscategorie', array(
							'TITLE' => $lang['rub_'.$rub["alias"][$i]],
							'ALIAS' => $rub["alias"][$i],
						));
						
						$j = 0;
						while ($j < count($rub["sspart"][$i]))
						{
							$template->assign_block_vars('head.sscategorie.button', array(
								'LINK' => 'index.php?page=accueil.php&amp;agence_id='.$_GET["agence_id"].'&amp;rubrique='.$rub["alias"][$i].'&amp;sscat='.$rub["sspart"][$i][$j],
								'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/booking_icon_small'.$j.'.gif',
								'TITLE' => $lang['rub_sscat_'.$rub["alias"][$i].'_'.$rub["sspart"][$i][$j]]
							));
							$j++;
						}
					}
				}
				$i++;
			}

		}
		
		if (isset($_GET["rubrique"]))
		{
			$template->assign_block_vars('cat_title', array(
				'TITLE' => $lang['rub_'.$_GET["rubrique"]]
			));	
			if (isset($_GET["sscat"]))
			{
				$template->assign_block_vars('cat_title.sscat_title', array(
					'TITLE' => $lang['sscat_'.$_GET["rubrique"].'_'.$_GET["sscat"]]
				));	
			}

		}
		elseif (isset($_GET["plugin"]))
		{
			$pl_name = explode("_",$_GET["plugin"]);
			
			$requete = "SELECT * FROM ".TAB_PLUGIN." WHERE ".PL_NAME."='".$pl_name[1]."'";
			$tab_plg = $req1->db_use_query($requete);
			
			$template->assign_block_vars('cat_title', array(
				'TITLE' => $tab_plg[0][PL_TITLE]
			));	
		}
		
	}

	if (!isset($_GET["full_page"]))
	{
		$bodyclass = '';
		$conteneurclass = 'body';
	}
	else
	{
		$bodyclass = 'fullpage';
		$conteneurclass = '';
	}
	
	// Variables ne se trouvant pas dans un block
	$template->assign_vars(array(
		'LANG_MAIN_TITLE' => $lang["header"][1],
		'STYLESHEET' => 'templates/'.DEFAULT_TEMPLATE.'/style.css',
		'SESSION_PAGE_DEFAULT' => str_replace("&","&amp;",$_SESSION["page_defaut"] ?? ''),
		'IMG_HOME' => 'templates/'.DEFAULT_TEMPLATE.'/images/home.gif',
		'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help.gif',
		'LANG_BAN_TITLE'  => $lang["header"][2],
		'GET_RUBRIQUE'  => @$_GET["rubrique"],
		'RUBRIQUE_TITRE'  => $titre,
		'LANG_ONLINE_HELP' => $lang["gen_online_help"],
		'BODY_CLASS' => $bodyclass,
		'CONTENEUR_CLASS' => $conteneurclass,
		'HELP_HOME_BUTTON' => $help_home_button,
		'HELP_ADMIN_BUTTON' => $help_admin_button,
		'HELP_SITE_BUTTON' => $help_site_button,
		'HELP_SEARCH_BUTTON' => $help_search_button,
		'HELP_HELP_BUTTON' => $help_help_button,
		'HELP_ADDSHORTCUT_BUTTON' => $help_addshorcut_button,
		'HELP_RUB_BUTTON' => $help_rub_button,
		'HELP_TEST' => $help_test,
	  ));

	// Scripts javascript
	foreach ($lang["js"] as $name => $val) {
		$template->assign_block_vars('opt_js_var', array(
			'NAME' => $name,
			'VALUE' => $val,
		));
	}

	if (isset($_GET["page"]) && $fp = @fopen("scripts/script_".$page[0].'.js',"r"))
	{
		$template->assign_block_vars('opt_script', array(
		  'SRC' => 'scripts/script_'.$page[0].'.js'
		));
	}
	
	if (isset($_GET["page"]) && $fp = @fopen('templates/'.DEFAULT_TEMPLATE.'/style_'.$page[0].'.css',"r"))
	{
		$template->assign_block_vars('opt_css', array(
		  'HREF' => 'templates/'.DEFAULT_TEMPLATE.'/style_'.$page[0].'.css'
		));
	}

	// Affichage du template
	if (!isset($_GET["export"]))
		$template->pparse('page_head');


	/***********************************************************************************/
	/*                                     BODY                                        */
	/***********************************************************************************/
	if(isset($_GET['page']) && !preg_match("{http://(.*)}i",$_GET['page']))
	{
		include($_GET['page']);
		$template->pparse($page[0]);
	}
	elseif(isset($_GET['plugin']) && !preg_match("{http://(.*)}i",$_GET['plugin']))
	{
		include($_GET['plugin']);
		$template->pparse($page[0]);
	}
	else
	{
		include('accueil.php');
		$template->pparse('accueil');		  
	}
	
	if ((isset($_GET["rubrique"]) && defined("ACTIVRUB_".strtoupper($_GET["rubrique"])) && constant("ACTIVRUB_".strtoupper($_GET["rubrique"])) == 1) || (isset($_GET["rubrique"]) && !defined("ACTIVRUB_".strtoupper($_GET["rubrique"]))))
	{
		$template->pparse($_GET["rubrique"]);	
	}		
	/***********************************************************************************/
	/***********************************************************************************/

	$tps_end = get_microtime();   
	$tps = $tps_end - $tps_start;    
	
	if (!isset($_GET["full_page"]))
	{
		$template->assign_block_vars('foot', array(
			'COPYRIGHT'  => $lang["foot_copy"],
			'VERSION'  => $lang["foot_version"].' '.GEN_VERSION,
			'CONTACT'  => $lang["contacts"],
			'TIME' => $lang["foot_time"].round($tps,2).'s',
			'DATABASE'  => $lang["foot_database"].DB_TRANSM,
		));
	}
	
	if (!isset($_GET["export"]))
		$template->pparse('page_tail');

}
else
{
	$affichage .= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	   "http://www.w3.org/TR/html4/loose.dtd">
	<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<TITLE>Erreur d\'installation - Installation error !</TITLE>	
	<link rel="stylesheet" type="text/css" href="install/templates/default/style.css" />	
	</HEAD>
	
	<BODY>
	<div class="body">
		<div style="width:600px;margin-left:auto;margin-right:auto;margin-bottom:120px;text-align:center;"><img src="images/logo.png"><br/>
		<p class="titre3" style="margin-top:80px;padding:25px;">OUAPI non installé ! Merci de l\'installer:<br/>OUAPI installation error ! Please install it:<br/><br/>	
		<a href="install/"><< Installation >></a></p>
		</div>
	</div>';
		
	$affichage .= '</body>
	</html>';
	echo $affichage;
}

?>