<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                           OUAPI install pack                              *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$affichage = '';
session_start();
if (isset($_SESSION["install_lang"]))
	include("lang/install_".$_SESSION["install_lang"].".php");

// Si la licence est refusée
if (isset($_POST["refuse"]))
	header('location:http://www.ouapi.org');

include("templates/default/overall_header.php");

$etape = (int)($_GET["etape"] ?? 1);
$affichage .= '<form name="form" action="install.php?etape='.($etape+1).'" method="post">';
$affichage .= '<div class="cat_title">'.$lang["e".$etape."_title"] .'</div><br/>';

if ($etape == 1)
{
	// Init des valeurs par défaut d'installation
	$_SESSION["install_serveur_sql"] = 'localhost';
	$_SESSION["install_login_sql"] = 'root';
	$_SESSION["install_pass_sql"] = '';
	$_SESSION["install_nombase_sql"] = 'ouapi';
	$_SESSION["install_prefixe_sql"] = 'ouapi_';			
	$_SESSION["install_ocs_serveur_sql"] = 'localhost';
	$_SESSION["install_ocs_login_sql"] = 'ocs';
	$_SESSION["install_ocs_pass_sql"] = 'ocs';
	$_SESSION["install_ocs_nombase_sql"] = 'ocsweb';
	$_SESSION["install_ldap_serveur"] = 'localhost';
	$_SESSION["install_ldap_user"] = 'root';
	$_SESSION["install_ldap_pass"] = '';
	$_SESSION["install_ldap_port"] = '389';
	$_SESSION["install_ldap_ok"] = 'Non';
	$_SESSION["install_ldap_root"] = 'OU=Utilisateurs,dc=mycompany,dc=com';
	$_SESSION["install_ldap_root_hard"] = 'OU=Ordinateurs,dc=mycompany,dc=com';
	$_SESSION["install_multisite"] = 'Oui';
	$_SESSION["install_login_type"] = 'dns';
	$_SESSION["install_ocs"] = 'Non';
	$_SESSION["install_login_admin"] = 'admin';
	$_SESSION["install_mail_admin"] = 'administrator@mycompany.com';
	$_SESSION["install_pass_admin"] = '';
	$_SESSION["install_pass_admin_confirm"] = '';
	$_SESSION["install_mainsite"] = $lang["main_site"];
	$_SESSION["install_param_help"] = 1;

	$affichage .= $lang["e1_subtitle"].'<br/><br/>'.$lang["e1_intro"].'
	<div style="text-align:center;margin-top:20px;"><input type="submit" name="soumettre" value="'.$lang["etape_suiv"].'" class="non_form"></div>';
}
elseif ($etape == 2)
{
	if (is_readable('../docs/COPYING_'.$_SESSION["install_lang"]))
	{
		$affichage .= $lang["e2_intro"].'
		<div align="center" style="margin-top:20px;">
		<object data="../docs/COPYING_'.strtoupper($_SESSION["install_lang"]).'" title="licence" style="border:1px solid black;background-color:white;width:650px;height:250px;padding:5px;">
		Licence Error !</object>
		<br/><br/>
		<input type="submit" name="refuse" value="'.$lang["refuse"].'" class="non_form">&nbsp;&nbsp;
		<input type="submit" name="accept" value="'.$lang["accept"].'" class="non_form"></div></form>';		
	}
	else
	{
		$affichage .= $lang["e2_rightserror"].'<br/><br/>
		<div align="center" onclick="refresh()"><a href="">'.$lang["retry"].'</a>';
	}
}
elseif ($etape == 3)
{
	$affichage .= $lang["e3_intro"].'<table class="table" style="margin-top:20px;">
	<tr>
		<td class="titre3">'.$lang["parameters"].'</td>
		<td class="titre3">'.$lang["answers"].'</td>
	</tr>';
	// Multisite
	if ($_SESSION["install_multisite"] == "Oui")
	{
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["multisite"].'</b><br/><i>'.$lang["check_sites"].'</i></td> 
			<td class="row1" style="padding:10px;" width="200">'.$lang["yes"].'&nbsp;<input type="radio" name="multisite" value="Oui" class="non_form" checked="checked" />&nbsp;&nbsp;
			'.$lang["no"].'&nbsp;<input type="radio" name="multisite" value="Non" class="non_form" /></td>
		</tr>';	
	}
	else
	{
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["multisite"].'</b><br/><i>'.$lang["check_sites"].'</i></td> 
			<td class="row1"  style="padding:10px;" width="200">'.$lang["yes"].'&nbsp;<input type="radio" name="multisite" class="non_form" value="Oui">&nbsp;&nbsp;
			'.$lang["no"].'&nbsp;<input type="radio" name="multisite" class="non_form" value="Non"  checked="checked"></td>
		</tr>';	
	}

	
	// OCS
	if ($_SESSION["install_ocs"] == "Oui")
	{
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ocs"].'</b><br/><i>'.$lang["check_ocs"].'</i></td> 
			<td class="row1" style="padding:10px;">'.$lang["yes"].'&nbsp;<input type="radio" name="ocs" class="non_form" value="Oui"  checked="checked" />&nbsp;&nbsp;
			'.$lang["no"].'&nbsp;<input type="radio" name="ocs" class="non_form" value="Non" /></td>
		</tr>';	
	}
	else
	{
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ocs"].'</b><br/><i>'.$lang["check_ocs"].'</i></td> 
			<td class="row1" style="padding:10px;">'.$lang["yes"].'&nbsp;<input type="radio" name="ocs" class="non_form" value="Oui" />&nbsp;&nbsp;
			'.$lang["no"].'&nbsp;<input type="radio" name="ocs" class="non_form" value="Non"  checked="checked" /></td>
		</tr>';	
	}

	// LDAP
	if ($_SESSION["install_ldap_ok"] == "Oui")
	{
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ldap"].'</b><br/><i>'.$lang["check_ldap"].'</i></td> 
			<td class="row1" style="padding:10px;">'.$lang["yes"].'&nbsp;<input type="radio" name="ldap_ok" class="non_form" value="Oui"  checked="checked" />&nbsp;&nbsp;
			'.$lang["no"].'&nbsp;<input type="radio" name="ldap_ok" class="non_form" value="Non" /></td>
		</tr>';
	}
	else
	{
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ldap"].'</b><br/><i>'.$lang["check_ldap"].'</i></td> 
			<td class="row1" style="padding:10px;">'.$lang["yes"].'&nbsp;<input type="radio" class="non_form" name="ldap_ok" value="Oui" />&nbsp;&nbsp;
			'.$lang["no"].'&nbsp;<input type="radio" name="ldap_ok" class="non_form" value="Non"  checked="checked" /></td>
		</tr>';
	}

	// Type de login
	if ($_SESSION["install_login_type"] == "dns")
	{
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["login_type"].'</b><br/><i>'.$lang["check_login"].'</i></td>
			<td class="row1" style="padding:10px;">'.$lang["dns_rev"].'&nbsp;<input type="radio" name="log" value="dns" class="non_form"  checked="checked" />&nbsp;&nbsp;
			'.$lang["user_pass"].'&nbsp;<input type="radio" name="log" class="non_form" value="user" /></td>
		</tr>';	
	}
	else
	{
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["login_type"].'</b><br/><i>'.$lang["check_login"].'</i></td>
			<td class="row1" style="padding:10px;">'.$lang["dns_rev"].'&nbsp;<input type="radio" name="log" class="non_form" value="dns" />&nbsp;&nbsp;
			'.$lang["user_pass"].'&nbsp;<input type="radio" name="log" class="non_form" value="user"  checked="checked" /></td>
		</tr>';	
	}
	
	$affichage .= '</table><br/><br/>
	<div align="center"><input type="hidden" name="etape_prec" value="2">
	<input type="submit" name="soumettre" value="'.$lang["etape_suiv"].'" class="non_form"></div>';
}
elseif ($etape == 4)
{
	// Si on vient de l'étape 2, on affecte le résultat des questions dans des variables de session
	if (isset($_POST["etape_prec"]) && $_POST["etape_prec"] == 2)
	{
		$_SESSION["install_ldap_ok"] = $_POST["ldap_ok"];
		$_SESSION["install_multisite"] = $_POST["multisite"];
		$_SESSION["install_login_type"] = $_POST["log"];
		$_SESSION["install_ocs"] = $_POST["ocs"];
	}
				
	$affichage .= '<table cellspacing="2" width="99%">';
	// PARAMETRES SQL
	$affichage .= '<tr>
		<td colspan="2" class="titre2">'.$lang["mysql_param"].'</td>
	</tr>
	<tr>
		<td class="titre3">'.$lang["parameters"].'</td>
		<td class="titre3">'.$lang["answers"].'</td>
	</tr>';


	// Serveur MySQL
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["mysql_server"].'</b><br/><i>'.$lang["mysql_server_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="text" name="serveur_sql" class="non_form" value="'.$_SESSION["install_serveur_sql"].'"></td>
	</tr>';	

	// Login MySQL
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["mysql_login"].'</b><br/><i>'.$lang["mysql_login_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="text" name="login_sql" class="non_form" value="'.$_SESSION["install_login_sql"].'"></td>
	</tr>';	

	// Password MySQL
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["mysql_pass"].'</b><br/><i>'.$lang["mysql_pass_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="text" name="pass_sql" class="non_form" value="'.$_SESSION["install_pass_sql"].'"></td>
	</tr>';	

	// Base MySQL
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["mysql_database"].'</b><br/><i>'.$lang["mysql_database_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="text" name="nombase_sql" class="non_form" value="'.$_SESSION["install_nombase_sql"].'"></td>
	</tr>';	
	
	// Prefixe des tables
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["mysql_prefixe"].'</b><br/><i>'.$lang["mysql_prefixe_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="text" name="prefixe_sql" class="non_form" value="'.$_SESSION["install_prefixe_sql"].'"></td>
	</tr>';	
	
	// Si on utilise OCS
	if ($_SESSION["install_ocs"] == "Oui")
	{
		$affichage .= '<tr>
			<td colspan="2" class="titre2">'.$lang["ocs_mysql_param"].'</td>
		</tr>
		<tr>
			<td class="titre3">'.$lang["parameters"].'</td>
			<td class="titre3">'.$lang["answers"].'</td>
		</tr>';


		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ocs_mysql_server"].'</b><br/><i>'.$lang["ocs_mysql_server_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="text" name="ocs_serveur_sql" class="non_form" value="'.$_SESSION["install_ocs_serveur_sql"].'" /></td>
		</tr>';	

		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ocs_mysql_login"].'</b><br/><i>'.$lang["ocs_mysql_login_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="text" name="ocs_login_sql" class="non_form" value="'.$_SESSION["install_ocs_login_sql"].'" /></td>
		</tr>';	

		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ocs_mysql_pass"].'</b><br/><i>'.$lang["ocs_mysql_pass_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="text" name="ocs_pass_sql" class="non_form" value="'.$_SESSION["install_ocs_pass_sql"].'" /></td>
		</tr>';	

		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ocs_mysql_database"].'</b><br/><i>'.$lang["ocs_mysql_database_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="text" name="ocs_nombase_sql" class="non_form" value="'.$_SESSION["install_ocs_nombase_sql"].'" /></td>
		</tr>';				
	}
	
	// SI existe serveur LDAP
	if ($_SESSION["install_ldap_ok"] == "Oui")
	{
		$affichage .= '<tr>
			<td colspan="2" class="titre2">'.$lang["ldap_param"].'</td>
		</tr>	
		<tr>
			<td class="titre3">'.$lang["parameters"].'</td>
			<td class="titre3">'.$lang["answers"].'</td>
		</tr>';

		
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ldap_server"].'</b><br/><i>'.$lang["ldap_server_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="text" name="ldap_serveur" class="non_form" value="'.$_SESSION["install_ldap_serveur"].'" /></td>
		</tr>';	
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ldap_port"].'</b><br/><i>'.$lang["ldap_port_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="text" name="ldap_port" class="non_form" value="'.$_SESSION["install_ldap_port"].'" /></td>
		</tr>';	
		
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ldap_user"].'</b><br/><i>'.$lang["ldap_user_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="text" name="ldap_user" class="non_form" value="'.$_SESSION["install_ldap_user"].'" /></td>
		</tr>';	
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ldap_pass"].'</b><br/><i>'.$lang["ldap_pass_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="password" name="ldap_pass" class="non_form" value="'.$_SESSION["install_ldap_pass"].'" /></td>
		</tr>';	
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ldap_root"].'</b><br/><i>'.$lang["ldap_root_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="text" name="ldap_root" class="non_form" value="'.$_SESSION["install_ldap_root"].'" /></td>
		</tr>';	
		$affichage .= '<tr>
			<td class="row1" style="padding:10px;"><b>'.$lang["ldap_root_hard"].'</b><br/><i>'.$lang["ldap_root_hard_desc"].'</i></td>
			<td class="row1" style="padding:10px;"><input type="text" name="ldap_root_hard" class="non_form" value="'.$_SESSION["install_ldap_root_hard"].'" /></td>
		</tr>';	
	}

	$affichage .= '</table><br/><br/>
	<div align="center"><input type="submit" name="soumettre" value="'.$lang["etape_suiv"].'"  class="non_form" /></div>';
}
elseif ($etape == 5)
{
	$_SESSION["install_serveur_sql"] = $_POST["serveur_sql"];
	$_SESSION["install_login_sql"] = $_POST["login_sql"];
	$_SESSION["install_pass_sql"] = $_POST["pass_sql"];
	$_SESSION["install_nombase_sql"] = $_POST["nombase_sql"];
	$_SESSION["install_prefixe_sql"] = $_POST["prefixe_sql"];			
	
	if ($_SESSION["install_ocs"] == "Oui")
	{
		$_SESSION["install_ocs_serveur_sql"] = $_POST["ocs_serveur_sql"];
		$_SESSION["install_ocs_login_sql"] = $_POST["ocs_login_sql"];
		$_SESSION["install_ocs_pass_sql"] = $_POST["ocs_pass_sql"];
		$_SESSION["install_ocs_nombase_sql"] = $_POST["ocs_nombase_sql"];
	}
	
	if ($_SESSION["install_ldap_ok"] == "Oui")
	{
		$_SESSION["install_ldap_serveur"] = $_POST["ldap_serveur"];
		$_SESSION["install_ldap_user"] = $_POST["ldap_user"];
		$_SESSION["install_ldap_pass"] = $_POST["ldap_pass"];
		$_SESSION["install_ldap_port"] = $_POST["ldap_port"];
		$_SESSION["install_ldap_root"] = $_POST["ldap_root"];
		$_SESSION["install_ldap_root_hard"] = $_POST["ldap_root_hard"];
	}

	$affichage .= '<table cellspacing="2" width="99%">';

	// Si login type user/password
	$affichage .= '<tr>
		<td colspan="2" class="titre2">'.$lang["admin_param"].'</td>
	</tr>
	<tr>
		<td class="titre3">'.$lang["parameters"].'</td>
		<td class="titre3">'.$lang["answers"].'</td>
	</tr>';


	// User/Pass Admin
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["admin_login"].'</b><br/><i>'.$lang["admin_login_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="text" name="login_admin" class="non_form" value="'.$_SESSION["install_login_admin"].'" /></td>
	</tr>';	
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["admin_mail"].'</b><br/><i>'.$lang["admin_mail_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="text" name="mail_admin" class="non_form" value="'.$_SESSION["install_mail_admin"].'" /></td>
	</tr>';	
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["admin_pass"].'</b><br/><i>'.$lang["admin_pass_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="password" name="pass_admin" class="non_form" value="'.$_SESSION["install_pass_admin"].'" /></td>
	</tr>';	
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["admin_pass_confirm"].'</b><br/><i>'.$lang["admin_pass_confirm_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="password" name="pass_admin_confirm" class="non_form" value="'.$_SESSION["install_pass_admin_confirm"].'" /></td>
	</tr>';	
	
	// Site principal
	$affichage .= '<tr>
		<td colspan="2" class="titre2">'.$lang["general_param"].'</td>
	</tr>	<tr>
		<td class="titre3">'.$lang["parameters"].'</td>
		<td class="titre3">'.$lang["answers"].'</td>
	</tr>
	<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["principal_site_name"].'</b><br/><i>'.$lang["principal_site_name_desc"].'</i></td>
		<td class="row1" style="padding:10px;"><input type="text" name="site_principal" class="non_form"value="'.$_SESSION["install_mainsite"].'" /></td>
	</tr>';

	// Affichage de l'Aide
	if ($_SESSION["install_param_help"] == 1)
	{
		$yes = ' checked="checked"';
		$no = '';
	}
	else
	{
		$yes = '';
		$no = ' checked="checked"';
	}
	
	$affichage .= '<tr>
		<td class="row1" style="padding:10px;"><b>'.$lang["param_help"].'</b><br/><i>'.$lang["param_help_desc"].'</i></td>
		<td class="row1" style="padding:10px;">'.$lang["yes"].'&nbsp;<input type="radio" name="param_help" value="1" class="non_form" '.$yes.' />&nbsp;&nbsp;
		'.$lang["no"].'&nbsp;<input type="radio" name="param_help" class="non_form" value="0" '.$no.' /></td>
	</tr>
	</table><br/><br/>
	<div align="center"><input type="submit" name="soumettre" value="'.$lang["etape_suiv"].'"  class="non_form" /></div>';
}
elseif ($etape == 6)
{
	$_SESSION["install_mainsite"] = $_POST["site_principal"];
	$_SESSION["install_mail_admin"] = $_POST["mail_admin"];
	$_SESSION["install_login_admin"] = $_POST["login_admin"];
	$_SESSION["install_param_help"] = $_POST["param_help"];
	$erreurs = 0;
	
	$array_test = array();
	
	$affichage .= $lang["e6_intro"].'<table class="table" style="margin-top:20px;">';

	$affichage .= '<tr>
		<td class="titre3" width="35%">'.$lang["test"].'</td>
		<td class="titre3">'.$lang["result"].'</td>
	</tr>';	

	// Verif fichier de config		
	if ($inf = fopen("../config/connect.php","w"))
	{
		$array_test[] = array('name' => 'conf_file', 'result' => 1);
		fwrite($inf,'');
		fclose($inf);
	}
	else
	{
		$array_test[] = array('name' => 'conf_file', 'result' => 0);
		$erreurs++;
	}
	
	// Verif de la connexion au serveur MySQL		
	$serveur_sql = @mysqli_connect($_SESSION["install_serveur_sql"],$_SESSION["install_login_sql"],$_SESSION["install_pass_sql"]);
	if ($serveur_sql)
	{
		$array_test[] = array('name' => 'serveur', 'result' => 1);
	}
	else
	{
		$array_test[] = array('name' => 'serveur', 'result' => 0, 'message' => mysqli_connect_error());
		$erreurs++;
	}
	
	// Verif de l'existance de la BDD
	if ($serveur_sql && @mysqli_select_db($serveur_sql, $_SESSION["install_nombase_sql"]))
	{
		$array_test[] = array('name' => 'bdd', 'result' => 1);
	}
	else
	{
		$array_test[] = array('name' => 'bdd', 'result' => 0, 'message' => $serveur_sql ? mysqli_error($serveur_sql) : 'Connexion impossible');
		$erreurs++;
	}
	
	// Verification que les tables n'existent pas
	$requete = "SELECT * FROM ".$_SESSION["install_prefixe_sql"]."config";
	
	try {
		$result = mysqli_query($serveur_sql, $requete);
		
		if ($result && mysqli_num_rows($result) > 0)
		{
			// Les tables existent déjà
			$array_test[] = array('name' => 'tables', 'result' => 0);
			$erreurs++;
		}
		else
		{
			// Les tables n'existent pas (bon signe)
			$array_test[] = array('name' => 'tables', 'result' => 1);
		}
	} catch (mysqli_sql_exception $e) {
		// La table n'existe pas (c'est ce qu'on veut pour une nouvelle installation)
		$array_test[] = array('name' => 'tables', 'result' => 1);
	}
	
	// Verif de la connexion au serveur MySQL OCS
	if ($_SESSION["install_ocs"] == "Oui")
	{
		$serveur_ocs = @mysqli_connect($_SESSION["install_ocs_serveur_sql"],$_SESSION["install_ocs_login_sql"],$_SESSION["install_ocs_pass_sql"]);
		if ($serveur_ocs)
		{
			$array_test[] = array('name' => 'ocs_serveur', 'result' => 1);
		}
		else
		{
			$array_test[] = array('name' => 'ocs_serveur', 'result' => 0, 'message' => mysqli_connect_error());
			$erreurs++;
		}
		
		// Verif de l'existance de la BDD d'OCS
		if ($serveur_ocs && @mysqli_select_db($serveur_ocs, $_SESSION["install_ocs_nombase_sql"]))
		{
			$array_test[] = array('name' => 'ocs_bdd', 'result' => 1);
		}
		else
		{
			$array_test[] = array('name' => 'ocs_bdd', 'result' => 0, 'message' => $serveur_ocs ? mysqli_error($serveur_ocs) : 'Connexion impossible');
			$erreurs++;
		}
	}

	// Vérif du nom d'utilisateur admin si besoin
	if ($_SESSION["install_login_admin"] != "" && $_POST["pass_admin"] == $_POST["pass_admin_confirm"] && $_POST["pass_admin"] != "")
	{
		$_SESSION["install_pass_admin"] = $_POST["pass_admin"];
		$_SESSION["install_pass_admin_confirm"] = $_POST["pass_admin"];
		$array_test[] = array('name' => 'admin', 'result' => 1);
	}
	else
	{
		$_SESSION["install_pass_admin"] = $_POST["pass_admin"];
		$_SESSION["install_pass_admin_confirm"] = $_POST["pass_admin_confirm"];
		$array_test[] = array('name' => 'admin', 'result' => 0);
		$erreurs++;
	}

	// Verif du serveur LDAP
	if ($_SESSION["install_ldap_ok"] == "Oui")
	{
		if (extension_loaded("ldap"))
		{
			$array_test[] = array('name' => 'ldap_ext', 'result' => 1);
			
			$server = $_SESSION["install_ldap_serveur"];
			$port = $_SESSION["install_ldap_port"];
			$rootdn = $_SESSION["install_ldap_user"];
			$rootpw = $_SESSION["install_ldap_pass"];
			
			$ds = @ldap_connect($server);
			$r = @ldap_bind($ds,$rootdn,$rootpw);

			$res_connect = ldap_error($ds);

			if ($res_connect == '' || $res_connect == 'Success')
			{
				$array_test[] = array('name' => 'ldap_serveur', 'result' => 1);
			}
			else
			{
				$array_test[] = array('name' => 'ldap_serveur', 'result' => 0, 'message' => $res_connect);
				$erreurs++;

			}
		}
		else
		{
			$array_test[] = array('name' => 'ldap_ext', 'result' => 0);
			$erreurs++;
		}
	}
	
	$i = 0;
	while ($i < count($array_test))
	{
		if ($array_test[$i]["result"] == 1)
		{
			$class = 'table_success';
			$image = 'ok';
		}
		else
		{
			$class = 'table_error';
			$image = 'nok';
		}

		if (isset($array_test[$i]["message"]))
			$message = '<p style="margin:0;padding-left:30px"><i>'.$array_test[$i]["message"].'</i></p>';
		else
			$message = '';
		
		
		$affichage .= '<tr>
			<td class="row1">'.$lang[$array_test[$i]["name"].'_test'].'</td>
			<td style="margin:0;padding:0;border:0" colspan="2"><div class="'.$class.'" style="padding:5px;font-size:8pt;"><img src="images/'.$image.'.png" alt="" style="vertical-align:middle;margin-right:10px;" />'.$lang[$array_test[$i]["name"].'_'.$image].''.$message.'</div></td>
		</tr>';	
		
		$i++;
	}
	
	
	if ($erreurs == 0)
	{
		$affichage .= '<tr>
			<td style="margin:0;padding:0;border:0" colspan="2"><div class="table_success" style="padding:5px;font-size:10pt;"><img src="images/ok.png"alt="" style="vertical-align:middle;margin-right:10px;" /><b>'.strtoupper($lang["install_ok"]).'</b></td>
		</tr>';	
	}

	$affichage .= '</table>';	
	
	if ($erreurs != 0)
	{
		$affichage .= '<div align="center" style="margin:20px;"><form name="form" action="install.php" method="post">
		<input type="submit" name="soumettre" value="'.$lang["reset"].'" class="non_form" />
		</form><br/><br/>
		
		<form name="form" action="install.php?etape=3" method="post">
		<input type="submit" name="soumettre" value="'.$lang["etape_prec"].'" class="non_form" />&nbsp;
		</form></div>';
	}
	else
	{
		$affichage .= '<br/><div align="center"><input type="submit" name="soumettre" value="'.$lang["etape_suiv"].'" class="non_form" /></div>';
	}
	
}
elseif ($etape == 7)
{			
	$erreur = '';
	
	// Création du fichier connect.php
	$inF = fopen("../config/connect.php","w");
	
	$texte = '<?php
// Paramètres SQL
define("DB_HOST","'.$_SESSION["install_serveur_sql"].'");
define("DB_USER","'.$_SESSION["install_login_sql"].'");
define("DB_MDP","'.$_SESSION["install_pass_sql"].'");
define("DB_TRANSM","'.$_SESSION["install_nombase_sql"].'");

// Prefixe des tables
define("DB_PREFIX","'.$_SESSION["install_prefixe_sql"].'");
  
// Type de login
define("LOGIN_TYPE","'.$_SESSION["install_login_type"].'");

// Multisite
define("MULTISITE","'.$_SESSION["install_multisite"].'");';

	if ($_SESSION["install_ldap_ok"] == "Oui")
	{
		$texte .= '
		
// Configuration LDAP		
define("LDAP_INSTALL","Oui");';
		
	}
	else
	{
		$texte .= '

define("LDAP_INSTALL","Non");';
	}

	if ($_SESSION["install_ocs"] == "Oui")
	{
		$texte .= '
		
// Paramètres SQL pour OCS
define("OCS_INSTALL","Oui");';

	}
	else
	{
		$texte .= '
define("OCS_INSTALL","Non");
';
	}
		
	
	$texte .= '
	?>';

	fwrite($inF,$texte);
	fclose($inF);
	
	// Creation des tables
	include('../config/connect.php');
	include('../config/param_ouapi.php');
	include('../includes/class_sql.php');
	
	// Connexion à la base
	$connect_db = @mysqli_connect(DB_HOST, DB_USER, DB_MDP, DB_TRANSM);
	
	// Lecture de fichier de requetes SQL
	$page = '';
	$fp = fopen("base_sql/base_".$_SESSION["install_lang"].".sql","r"); 
	while (!feof($fp)) { 
	  $page .= fgets($fp, 4096); 
	}
	fclose($fp);
	
	$nb = preg_match_all("`\{([A-Za-z0-9_]*)\}`",$page,$constantes);

	$j = 0;
	while ($j < $nb)
	{
		if (defined($constantes[1][$j]))
			$page = str_replace($constantes[0][$j],constant($constantes[1][$j]),$page);
		$j++;
	}
	
	$page = str_replace("{DEF_LANGUAGE}",$_SESSION["install_lang"],$page);
	$page = str_replace("{DB_PREFIX}",$_SESSION["install_prefixe_sql"],$page);
	$page = str_replace("{PARAM_HELP}",$_SESSION["install_param_help"],$page);

	$requetes = explode('[END]', $page);

	foreach($requetes as $requete){
		if (!empty(trim($requete))) {
			$result = mysqli_query($connect_db, $requete);
		}
	}

	// PARAM OCS
	if ($_SESSION["install_ocs"] == "Oui")
	{
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('db_ocs_host', '".$lang["install_ocs_server"]."', '".$lang["install_ocs_serverdesc"]."' , '".$_SESSION["install_ocs_serveur_sql"]."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('db_ocs_user', '".$lang["install_ocs_user"]."', '".$lang["install_ocs_userdesc"]."' , '".$_SESSION["install_ocs_login_sql"]."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('db_ocs_mdp', '".$lang["install_ocs_pass"]."', '".$lang["install_ocs_passdesc"]."' , '".$_SESSION["install_ocs_pass_sql"]."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('db_ocs_transm', '".$lang["install_ocs_base"]."', '".$lang["install_ocs_basedesc"]."' , '".$_SESSION["install_ocs_nombase_sql"]."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` , `subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('activrub_ocs', 'rub', '".$lang["install_ocs_activrub"]."', '".$lang["install_ocs_activrubdesc"]."' , '1', 'radio_yn', '1')");
	}	
	else
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` , `subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('activrub_ocs', 'rub', '".$lang["install_ocs_activrub"]."', '".$lang["install_ocs_activrubdesc"]."' , '0', 'radio_yn', '1')");

	
	
	//PARAM LDAP
	if ($_SESSION["install_ldap_ok"] == "Oui")
	{
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_host', 'general', '".$lang["install_ldap_server"]."', '".$lang["install_ldap_serverdesc"]."' , '".$_SESSION["install_ldap_serveur"]."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory`, `libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_user', 'general', '".$lang["install_ldap_user"]."', '".$lang["install_ldap_userdesc"]."' , '".addslashes($_SESSION["install_ldap_user"])."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_mdp', 'general', '".$lang["install_ldap_pass"]."', '".$lang["install_ldap_passdesc"]."' , '".$_SESSION["install_ldap_pass"]."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_port', 'general', '".$lang["install_ldap_port"]."', '".$lang["install_ldap_portdesc"]."' , '".$_SESSION["install_ldap_port"]."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_mask', 'users', '".$lang["install_ldap_root"]."', '".$lang["install_ldap_rootdesc"]."' , '".$_SESSION["install_ldap_root"]."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_mask_hard', 'hard', '".$lang["install_ldap_root_hard"]."', '".$lang["install_ldap_rootdesc_hard"]."' , '".$_SESSION["install_ldap_root_hard"]."', 'text', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_fname', 'users', '".$lang["install_ldap_attrfname"]."', '".$lang["install_ldap_attrfnamedesc"]."' , 'givenname', 'list', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_lname', 'users', '".$lang["install_ldap_attrlname"]."', '".$lang["install_ldap_attrlnamedesc"]."'  , 'sn', 'list', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_mail', 'users', '".$lang["install_ldap_attrmail"]."', '".$lang["install_ldap_attrmaildesc"]."'  , 'mail', 'list', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_loginwin', 'users', '".$lang["install_ldap_attrloginwin"]."', '".$lang["install_ldap_attrloginwindesc"]."'  , 'samaccountname', 'list', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_key', 'users', '".$lang["install_ldap_key"]."', '".$lang["install_ldap_keydesc"]."' , 'mail;mail', 'list', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_key_hard', 'hard', '".$lang["install_ldap_key_hard"]."', '".$lang["install_ldap_keydesc_hard"]."' , 'nom;name', 'list', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_hard_name', 'hard', '".$lang["install_ldap_attrhardname"]."', '".$lang["install_ldap_attrhardnamedesc"]."' , 'name', 'list', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_hard_description', 'hard', '".$lang["install_ldap_attrharddescription"]."', '".$lang["install_ldap_attrharddescriptiondesc"]."' , 'description', 'list', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('ldap_attr_hard_created', 'hard', '".$lang["install_ldap_attrhardcreated"]."', '".$lang["install_ldap_attrhardcreateddesc"]."' , 'whencreated', 'list', '1')");
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('activrub_ldap', 'rub', '".$lang["install_ldap_activrub"]."', '".$lang["install_ldap_activrubdesc"]."' , '1', 'radio_yn', '1')");
	}
	else
		$result = mysqli_query($connect_db, "INSERT INTO `".TAB_CONFIG."` (`nom` ,`subcategory` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('activrub_ldap', 'rub', '".$lang["install_ldap_activrub"]."', '".$lang["install_ldap_activrubdesc"]."' , '0', 'radio_yn', '1')");

	
	// 
	// Création de l'utilisateur admin
	//
	$result = mysqli_query($connect_db, "INSERT INTO ".TAB_USERS." (id,nom,prenom,mail,agence_id,groupe_id,login,mdp,langue) VALUES 
	('1','Admin','General','".$_SESSION["install_mail_admin"]."','1','10','".$_SESSION["install_login_admin"]."','".password_hash($_SESSION["install_pass_admin"], PASSWORD_BCRYPT)."','".$_SESSION["install_lang"]."')");
	
	// 
	// Création du site principal
	//
	$result = mysqli_query($connect_db, "INSERT INTO ".TAB_AGENCES." (id,libelle) VALUES ('1','".$_SESSION["install_mainsite"]."')");
				
	if ($erreur == '')
	{
		$affichage .= ''.$lang["e7_ss_titre"].'<br/><br/>'.$lang["e7_intro"].'<br/>';
	}
	else
	{
		$affichage .= '<div style="color:red"><b>'.$lang["install_nok"].'</div>';
	}

	session_destroy();
}
$affichage .= '</form>';


include("templates/default/overall_footer.php");

echo $affichage;

?>