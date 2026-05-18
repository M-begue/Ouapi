<?php
/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2011 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use;
$affichage = '';
$errors = array();

/*********************************/
/*       Ajouter un plugin       */
/*********************************/
if (isset($_GET['action']) && $_GET['action'] == 'add' )
{
	$directory = 'plugins';
	$plg_path = $_GET["path"];
	
	if (isset($_GET["etape"]) && $_GET["etape"] == 1)
	{
		if ( is_file($directory.'/'.$plg_path.'/param.ini')) 
		{
			$fichier = fopen($directory.'/'.$plg_path.'/param.ini','r');
			while (!feof($fichier)) 
			{
				$ligne = fgets($fichier); 
				$temp = explode('=',$ligne);
				$param[$temp[0]] = $temp[1];
			}				
			fclose($fichier);
						
			$template->assign_block_vars('inst_etape1', array(
				'L_TITLE' => $lang["adm_plg_instetape1_title"].$param["plg_name"],
				'DESC' => $lang["adm_plg_instetape1_desc"],
				'FORM_LINK' => 	preg_replace("{&etape=".@$_GET["etape"]."}","",$_SERVER['REQUEST_URI']).'&etape=2',
				'BUTTON' => $lang["adm_plg_buttonnext"],
			));
			
			// Modifs base de données
			if ( is_file($directory.'/'.$plg_path.'/install/base_'.DEFAULT_LANGUAGE.'.sql')) 
			{
				$template->assign_block_vars('inst_etape1.sql', array(
					'L_TITLE' => $lang["adm_plg_instetape1_title_basesql"], 					
					'DESC' => $lang["adm_plg_instetape1_title_basesql_desc"], 					
				));
				
				$pagea = '';
				$fp = fopen($directory.'/'.$plg_path.'/install/base_'.DEFAULT_LANGUAGE.'.sql',"r"); 
				while (!feof($fp)) { 
				  $pagea .= fgets($fp, 4096); 
				}
				fclose($fp);
				
				$requetes = explode('[END]', $pagea);
				
				foreach($requetes as $requete){
					$template->assign_block_vars('inst_etape1.sql.list', array(
						'TEXT' => nl2br($requete),
					));
				}
			}
		}
		else
		{
			array_push($errors,$lang["adm_plg_error_ini"]);
			$retour = $lang["adm_plg_addnok"].'<br/><br/>';
			
			while(list($key, $val) = each($errors))
			{ 
				$aff_key = $key+1;
				$retour .= $aff_key.') '.$val.'<br/>';
			}
				
			$template->assign_block_vars('form_post', array(
				'OK' => $retour, 					
				'CLOSE' => $lang["close"],	
				'ID' => 'alert'
			));					
		}
		
		
	}
	elseif (isset($_GET["etape"]) && $_GET["etape"] == 2)
	{
		// Paramètres du plugin
		if ( is_file($directory.'/'.$plg_path.'/param.ini')) 
		{
			$fichier = fopen($directory.'/'.$plg_path.'/param.ini','r');
			while (!feof($fichier)) 
			{
				$ligne = fgets($fichier); 
				$temp = explode('=',$ligne);
				$param[$temp[0]] = trim($temp[1]);
			}				
			fclose($fichier);

			if (isset($param["plg_desc"]))
				$desc = $param["plg_desc"];
			else
				$desc = '';
		}	
		else
			array_push($errors,$lang["adm_plg_error_ini"]);

		// Modifs base de données
		if ( is_file($directory.'/'.$plg_path.'/install/base_'.DEFAULT_LANGUAGE.'.sql')) 
		{			
			$pagea = '';
			$fp = fopen($directory.'/'.$plg_path.'/install/base_'.DEFAULT_LANGUAGE.'.sql',"r"); 
			while (!feof($fp)) { 
			  $pagea .= fgets($fp, 4096); 
			}
			fclose($fp);
			
			$pagea = preg_replace('#CREATE TABLE [^a-zA-Z0-9]([a-zA-Z0-9_-]*)[^a-zA-Z0-9]#','CREATE TABLE `'.strtolower(DB_PREFIX.'plg_'.trim($param["plg_name"]).'_$1').'`',$pagea);			
			
			// Remplacement des constantes {} dans les requetes
			$nb = preg_match_all("`\{([A-Za-z0-9_]*)\}`",$pagea,$constantes);
			
			$i = 0;
			while ($i < $nb)
			{
				if (defined($constantes[1][$i]))
					$pagea = str_replace($constantes[0][$i],constant($constantes[1][$i]),$pagea);
				$i++;
			}
			$requetes_sql = explode('[END]', $pagea);

		}
		
		// Déplacement des fichiers PHP
		$CopieRecursive=new FileRecursive();
		$CopieRecursive->copie($directory.'/'.$plg_path, '.', 'php', 0,'plg_'.$param["plg_name"].'_');
		
		// Déplacement des fichiers Templates
		$CopieRecursive->copie($directory.'/'.$plg_path.'/templates', './templates/'.DEFAULT_TEMPLATE, '', 1, 'plg_'.$param["plg_name"].'_');
		
		// Déplacement du fichier lang
		$CopieRecursive->copie($directory.'/'.$plg_path.'/lang', './lang', 'php', 0, 'plg_'.$param["plg_name"].'_');
		
		if (count($errors) == 0)
		{
			foreach($requetes_sql as $requete)
			{
				if (trim($requete) != '')
				{
					$tab = @$req1->db_use_query($requete);
					//echo $requete.'<br/>';
					$error = mysql_error();
					
					if ($error == '')
					{
						// Creation de la constante de la table si c'est une requete CREATE TABLE
						if (preg_match('#^CREATE TABLE#',trim($requete)))
						{
							preg_match('#'.DB_PREFIX.'plg_'.trim($param["plg_name"]).'_(.+)#i',$requete,$nom_temp);
							$nom = preg_replace('#\W#','',$nom_temp[1]);

							if (!defined(strtoupper("$nom")))
							{
								preg_match('#CREATE TABLE(.+)#i',$requete,$valeur_temp);
								$valeur = preg_replace('#\W#','',$valeur_temp[1]);
								
								$const = "INSERT INTO ".TAB_CONFIG." (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) 
								VALUES ('".$nom."', NULL , NULL , '".$valeur."', 'text', '1')";
								//echo $const.'<br/>';
								$tab = $req1->db_use_query($const);
							}
							else
								array_push($errors, $lang["adm_plg_error_const_table"]);			
							
						}
					}
					else
					{
						array_push($errors, $error);			
					}
				}
			}

			$requete = "INSERT INTO ".TAB_PLUGIN." (name,title,type,path,description,install_date,version,active) VALUES ('".format_string_db($param["plg_name"])."','".format_string_db($param["plg_title"])."','".$param["plg_type"]."','".$plg_path."','".format_string_db($desc)."','".time()."','".$param["plg_version"]."','1')";
			$tab = $req1->db_use_query($requete);
			$requete = "INSERT INTO ".TAB_CONFIG." (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('rght_plg_".strtolower($param["plg_name"])."', '[ Plugin ".$param["plg_name"]." ] ".$lang["adm_plg_rght"]."' , NULL , '10', 'text', '1')";
			$tab = $req1->db_use_query($requete);
			$requete = "INSERT INTO ".TAB_CONFIG." (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('rght_plg_".strtolower($param["plg_name"])."_edit', '[ Plugin ".$param["plg_name"]." ] ".$lang["adm_plg_rght_edit"]."' , NULL , '10', 'text', '1')";
			$tab = $req1->db_use_query($requete);
			$requete = "INSERT INTO ".TAB_CONFIG." (`nom` ,`libelle` ,`description` ,`valeur` ,`form_type` ,`globale`) VALUES ('rght_plg_".strtolower($param["plg_name"])."_admin', '[ Plugin ".$param["plg_name"]." ] ".$lang["adm_plg_rght_admin"]."' , NULL , '10', 'text', '1')";
			$tab = $req1->db_use_query($requete);
			
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_plg_installok"], 					
				'CLOSE' => $lang["close"],			
				'ID' => 'mess_retour',
			));
		}
		else
		{
			$retour = $lang["adm_plg_addnok"].'<br/><br/>';
			
			while(list($key, $val) = each($errors))
			{ 
				$aff_key = $key+1;
				$retour .= $aff_key.') '.$val.'<br/>';
			}
				
			$template->assign_block_vars('form_post', array(
				'OK' => $retour, 					
				'CLOSE' => $lang["close"],	
				'ID' => 'alert'
			));			
			
			$template->assign_block_vars('form_post.back', array(
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["return"]	,
			));			
		
		}

		
	}
	
}
/*********************************/
/*       Supprimer un plugin     */
/*********************************/
if (isset($_GET['action']) && $_GET['action'] == 'del' )
{
	$id_plg = $_GET["id"];
	$directory = 'plugins';
	
	$requete = "SELECT * FROM ".TAB_PLUGIN." WHERE ".PL_ID."='".$id_plg."'";
	$tab_plg = $req1->db_use_query($requete);
	
	$plg_path = $tab_plg[0][PL_PATH];

	// Modifs base de données
	$requetes_sql = NULL;
	if ( is_file($directory.'/'.$plg_path.'/uninstall/base_'.DEFAULT_LANGUAGE.'.sql')) 
	{			
		$pagea = '';
		$fp = fopen($directory.'/'.$plg_path.'/uninstall/base_'.DEFAULT_LANGUAGE.'.sql',"r"); 
		while (!feof($fp)) { 
		  $pagea .= fgets($fp, 4096); 
		}
		fclose($fp);
		
		$pagea = preg_replace('#CREATE TABLE [^a-zA-Z0-9]([a-zA-Z0-9_-]*)[^a-zA-Z0-9]#','CREATE TABLE `'.strtolower(DB_PREFIX.'plg_'.trim($tab_plg[0][PL_NAME]).'_$1').'`',$pagea);			
		
		// Remplacement des constantes {} dans les requetes
		$nb = preg_match_all("`\{([A-Za-z0-9_]*)\}`",$pagea,$constantes);
		
		$i = 0;
		while ($i < $nb)
		{
			if (defined($constantes[1][$i]))
				$pagea = str_replace($constantes[0][$i],constant($constantes[1][$i]),$pagea);
			$i++;
		}
		$requetes_sql = explode('[END]', $pagea);
	}
	if (count($requetes_sql) > 0)
	{
		foreach($requetes_sql as $requete)
		{
			if (trim($requete) != '')
			{
				$tab = @$req1->db_use_query($requete);
				echo $requete.'<br/>';
				$error = mysql_error();
			}
		}
	}
	
	// Suppression des droits
	$requete = "DELETE FROM ".TAB_CONFIG." WHERE nom LIKE 'rght_plg_".strtolower($tab_plg[0]["name"])."%'";
	$tab = $req1->db_use_query($requete);

	$requete = "SHOW TABLES LIKE '".DB_PREFIX.'plg_'.strtolower($tab_plg[0]["name"])."_%'";
	$result = mysql_query($requete);	
	
	while ($row = mysql_fetch_array($result))	
	{
		// Suppression des Tables
		$requete = "DROP TABLE ".$row[0];
		$tab = $req1->db_use_query($requete);
		// Suppression des constantes des nom de tables
		$requete = "DELETE FROM ".TAB_CONFIG." WHERE valeur='".$row[0]."'";
		$tab = $req1->db_use_query($requete);
	}
	
	// Suppression du plugin
	$requete = "DELETE FROM ".TAB_PLUGIN." WHERE id='".$id_plg."'";
	$tab = $req1->db_use_query($requete);

	// Suppression des fichiers PHP
	$CopieRecursive=new FileRecursive();
	$CopieRecursive->delete('.', 'php', 0,'plg_'.$tab_plg[0]["name"].'_');

	// Suppression des fichiers Templates
	$CopieRecursive->delete('./templates/'.DEFAULT_TEMPLATE, '', 1, 'plg_'.$tab_plg[0]["name"].'_');

	// Suppression du fichier lang
	$CopieRecursive->delete('./lang', 'php', 0,'plg_'.$tab_plg[0]["name"].'_');

	$template->assign_block_vars('form_post', array(
		'OK' => $lang["adm_plg_uninstallok"], 					
		'CLOSE' => $lang["close"],			
		'ID' => 'mess_retour',
	));
}
?>