<?php
session_start();
/* Paramètres de connexion */
	include('common_includes.php');
	include('config/declare.php');

if (!isset($_SESSION["int_lang"]))
$_SESSION["int_lang"] = DEFAULT_LANGUAGE;
include('lang/lang_'.$_SESSION["int_lang"].'.php');

$connect = new db_connect();
$connect->connection();
$req1 = new db_use;

/* On récupère l'identifiant de la liste "Mère" */
$idelmt = isset($_GET['idelmt']) ? $_GET['idelmt'] : false;

/* Si on a une région, on procède à la requête */
if(false !== $idelmt)
{
	$table_req = array('hard_modele' => TAB_HARD_MODELE, 'periph_modele' => TAB_PERIPH_MODELE);
	$champ_req = array('hard_modele' => 'marque_id', 'periph_modele' => 'marque_id');
	
    /* Cération de la requête pour avoir la liste "Fille" */
	if ($idelmt != '-1')
		$sql2 = "SELECT * FROM ".$table_req[$_GET['type']]." WHERE ".$champ_req[$_GET['type']]." = '". $idelmt ."' ORDER BY libelle";
	else
		$sql2 = "SELECT * FROM ".$table_req[$_GET['type']]." ORDER BY libelle";
		
	$tab = $req1->db_use_query($sql2);
    
	$liste = "";
    $liste .= '<select name="modele">';
	
	$i = -1;
	$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
    while($i < count($tab)-1)
    {
        $liste .= '  <option value="'.$tab[$i]['id'].'">'.$tab[$i]['libelle'].'</option>';
		$i++;
    }
    $liste .= '</select>';
    /* Affichage de la liste déroulante */
    echo($liste);
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Error</p>\n");
}

?>