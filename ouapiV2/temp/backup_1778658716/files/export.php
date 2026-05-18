<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2014 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

// Export excel
if (!isset($_GET["special"]) && !isset($_POST["sendstats"]) && !isset($_POST["nosendstats"]))
{
	exp_csv($_POST["nom"], unserialize(base64_decode($_POST["export_data"])));
}

// Export des stats d'utilisation de OUAPI
if (isset($_POST["sendstats"]))
{
	include('common_includes.php');
	include('config/declare.php');

	$connect = new db_connect();
	$connect->connection();
	$req1 = new db_use;

	$requete = "UPDATE ".TAB_CONFIG." SET ".CO_VALUE."='".time()."' WHERE ".CO_NAME."='gen_statsdate'";
	$tab = $req1->db_use_query($requete);
	$requete = "UPDATE ".TAB_CONFIG." SET ".CO_VALUE."='1' WHERE ".CO_NAME."='gen_statsyn'";
	$tab = $req1->db_use_query($requete);
	
	if (!isset($_POST["lastupdate"]))
	{
		$company = $_POST["company"];
		$website = $_POST["website"];
		$comment = $_POST["comment"];
		$suggest = $_POST["suggest"];
		$contact = $_POST["contact"];
	}
	
	$version = $_POST["version"];
	$date_install = $_POST["install"];
	$date_maj = $_POST["maj"];
	$nb_users = $_POST["users"];
	$nb_periph = $_POST["periph"];
	$nb_hard = $_POST["hard"];
	
	echo '<form name="stats" action="http://www.ouapi.org/recup_stats.php" method="post">';
	
	while (list($key,$val) = each($_POST))
	{
		echo '<input type="hidden" name="'.$key.'" value="'.addslashes(htmlspecialchars($val)).'" />';
	}
	echo '</form>
	<script type="text/javascript" language="javascript">
	document.stats.submit();
	</script>';
	

}
elseif (isset($_POST["nosendstats"]))
{
	include('common_includes.php');
	include('config/declare.php');

	$connect = new db_connect();
	$connect->connection();
	$req1 = new db_use;

	$requete = "UPDATE ".TAB_CONFIG." SET ".CO_VALUE."='".time()."' WHERE ".CO_NAME."='gen_statsdate'";
	$tab = $req1->db_use_query($requete);
	$requete = "UPDATE ".TAB_CONFIG." SET ".CO_VALUE."='0' WHERE ".CO_NAME."='gen_statsyn'";
	$tab = $req1->db_use_query($requete);
	
}

?>