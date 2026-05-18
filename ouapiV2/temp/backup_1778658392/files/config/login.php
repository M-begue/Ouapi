<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2012 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

session_start();
$_SESSION["lang"] = "FR";

require('connect.php');
require('param_ouapi.php');
include('../includes/class_sql.php');


$connect = new db_connect();
$db_handle = $connect->connection();

if (isset($_GET['action']) && $_GET['action']=='login' && !isset($_SESSION['user_id']))
{
	$login = mysqli_real_escape_string($db_handle, $_POST['login']);
	$password = mysqli_real_escape_string($db_handle, $_POST['password']);
	
	$req1 = new db_use;
	$tab_user = $req1->db_use_query("SELECT ".TAB_USERS.".*,
	".TAB_USERS_GRP.".rights AS grp_rights
	FROM ".TAB_USERS."
	  LEFT JOIN ".TAB_USERS_GRP." ON ".TAB_USERS_GRP.".id = ".TAB_USERS.".groupe_id
	WHERE login='$login'");

	
	if (count($tab_user) > 0 && $_POST['login'] != '' && $_POST['password'] != '' && password_verify($password, $tab_user[0]['mdp']))
	{
		$_SESSION["nom_comp"] = $tab_user[0]["prenom"]." ".$tab_user[0]["nom"];
		$_SESSION["user_grp"] = $tab_user[0]["groupe_id"];
		$_SESSION["grp_rights"] = $tab_user[0]["grp_rights"];
		$_SESSION["user_agence"] = $tab_user[0]["agence_id"];
		$_SESSION["user_id"] = $tab_user[0]["id"];
		$_SESSION["lang"] = $tab_user[0]["langue"];

		$_SESSION["page_defaut"] = 'index.php?page=accueil.php&agence_id='.$_SESSION["user_agence"];
		header('location:../'.$_SESSION["page_defaut"]); 
	}
	else
		header('location:../index.php?page=login_form.php&err=user_mdp_wrong');
}
elseif (isset($_GET['action']) && $_GET['action']=='logout')
{
		session_unset(); 
		session_destroy();
		header('location:../index.php?page=login_form.php');
}
?>