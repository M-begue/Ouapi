<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2012 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use;
$affichage = '';

// Configurer OCS pour ce site
if (isset($_POST['soumettre']))
{
	if (isset($_GET['action']) && $_GET['action'] == 'conf')
	{
		// Critere de comparaison des bases
		$crit = explode(';',$_POST["crit"]);
		
		// Filtres logiciels
		$chaine = '';
		$i = 0;
		while ($i < 3)
		{
			if (isset($_POST["t_".$i]) && $_POST["t_".$i] != NULL)
				$chaine .= $_POST["t_".$i].';';
			$i++;
		}
	
		// Options periphériques
		$periph_double = $_POST["periph_double"];		
		
		// Preparation des requetes
		$param = array(0 => 'ocs_filtre_ocs'.$_GET["agence_id"], 
		1 => 'ocs_mask'.$_GET["agence_id"],
		2 => 'ocs_mask_type'.$_GET["agence_id"], 
		3 => 'ocs_crit_ocs'.$_GET["agence_id"], 
		4 => 'ocs_crit_base'.$_GET["agence_id"],
		5 => 'ocs_periph_dbl'.$_GET["agence_id"]);
		
		$values = array(0 => $chaine, 
		1 => format_string_db($_POST["mask"]),
		2 => $_POST["mask_type"], 
		3 => $crit[1], 
		4 => $crit[0],
		5 => $periph_double);
		
		$libelle = array(0 => $lang["ocs_conf_param_filtre"], 
		1 => $lang["ocs_conf_param_mask"],
		2 => $lang["ocs_conf_param_masktype"], 
		3 => $lang["ocs_conf_param_critocs"], 
		4 => $lang["ocs_conf_param_critbase"],
		5 => $lang["adm_ocs_periph_doublons"]);
		
		$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom='".$param[0]."' OR nom='".$param[1]."' OR nom='".$param[2]."' OR nom='".$param[3]."' OR nom='".$param[4]."' OR nom='".$param[5]."'";
		$tab = $req1->db_use_query_inv($requete);
		
		$i = 0;
		while ($i < count($param))
		{
			if (count($tab) != 0 && in_array($param[$i],$tab["nom"]))
				$requete = "UPDATE ".TAB_CONFIG." SET valeur='".$values[$i]."' WHERE nom='".$param[$i]."'";
			else
				$requete = "INSERT INTO ".TAB_CONFIG." (nom,libelle,valeur,globale) VALUES ('".$param[$i]."','".$libelle[$i].' '.$_GET["agence_id"]."','".$values[$i]."','1')";
	
			$tab_save = $req1->db_use_query($requete);
	
			$i++;
		}

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["return_conf_ok"], 					// OK
			'CLOSE' => $lang["close"]					// Fermer
		));
	}
}
else
{
	if (isset($_GET['action']) && $_GET['action'] == 'conf')
	{
		$template->assign_block_vars('form', array(
			'ACTION' => 'index.php?page=adm_ocs.php&action=conf&agence_id='.$_GET["agence_id"], 			// Action du formulaire
			'CONFIG_TITLE' => $lang["ocs_conf_title"], 					// Titre général
			'CONFIG_HARD_TITLE' => $lang["adm_ocs_conf_hard"],			// Sous titre matériel
			'CONFIG_COMP_CRIT_LABEL' => $lang["ocs_conf_comp-base"], 	// Label critère clé OCS<->Ouapi
			'CONFIG_PERIPH_TITLE' => $lang["adm_ocs_conf_periph"], 			// Sout titre soft
			'CONFIG_SOFT_TITLE' => $lang["adm_ocs_conf_soft"], 			// Sout titre soft
			'CONFIG_SOFT_FILTER' => $lang["adm_ocs_filter_title"] ,		// Label Filtre
			'CONFIG_SAVE_BUTTON' => $lang["gen_save"]					// Bouton Sauvegarde
		));

		// Aide
		if (PARAM_HELP == 1)
		{
			$template->assign_block_vars('form.help', array(
				'LANG_HELP' => $lang["gen_help"],
				'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
				'HELP_MESSAGE' => $lang["help"][12]
			));
		}

		if (MULTISITE == "Oui")
		{	
			if (defined("OCS_MASK".$_GET["agence_id"]))
				$mask = constant("OCS_MASK".$_GET["agence_id"]);
			else
				$mask = '';
			
			$template->assign_block_vars('form.multisite', array(
				'CONF_DIFF_SITE' => $lang["ocs_conf_diff_site"],
				'CONF_DS_MASK_NAME' => $lang["ocs_conf_ds_mask"],
				'CONF_DS_MASK_VALUE' => $mask // Masque de différenciation				
			));
			
			// Critère de différenciation du site
			$select_ds["name"] = array($lang["ocs_conf_ds_name"],$lang["ocs_conf_ds_workgroup"],$lang["ocs_conf_ds_domain"],
				$lang["ocs_conf_ds_ipaddr"],$lang["ocs_conf_ds_userid"],$lang["ocs_conf_ds_winowner"],$lang["ocs_conf_ds_wincompany"]);
			
			$select_ds["value"] = array(COL_OCS_HARD_NAME,COL_OCS_WORKG,COL_OCS_DOMAIN,COL_OCS_IPADDR,COL_OCS_USERID,COL_OCS_WINOWNER,COL_OCS_WINCOMPANY);
			
			$i = 0;
			while ($i < count($select_ds["value"]))
			{
				if (defined("OCS_MASK_TYPE".$_GET["agence_id"]) && $select_ds["value"][$i] == constant("OCS_MASK_TYPE".$_GET["agence_id"]))
					$selected = 'selected';
				else
					$selected = '';
					
				$template->assign_block_vars('form.multisite.select_ds', array(
					'CONF_DS_NAME' => $select_ds["name"][$i],
					'CONF_DS_VALUE' => $select_ds["value"][$i],
					'CONF_DS_SELECTED' => $selected
				));

				$i++;
			}	

		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
				'CONF_DS_NAME' => COL_OCS_HARD_NAME,
				'CONF_DS_MASK_VALUE' => '*'
			));
		}
								
		// Critère clé
		$select_crit["name"] = array($lang["ocs_conf_ds_name"],$lang["ocs_conf_ds_ipaddr"],$lang["ocs_conf_ds_ssn"]);		
		$select_crit["value"] = array('nom;'.TAB_OCS_HARD.'.'.COL_OCS_HARD_NAME,'ip;'.TAB_OCS_HARD.'.'.COL_OCS_IPADDR,'num_serie;'.TAB_OCS_BIOS.'.'.COL_OCS_BIOS_SNUM);
		
		$i = 0;
		while ($i < count($select_crit["value"]))
		{
			$value = explode(';',$select_crit["value"][$i]);
			if (defined("OCS_CRIT_OCS".$_GET["agence_id"]) && $value[1] == constant("OCS_CRIT_OCS".$_GET["agence_id"]))
				$selected = 'selected';
			else
				$selected = '';
				
			$template->assign_block_vars('form.select_crit', array(
				'CONF_CRIT_NAME' => $select_crit["name"][$i],
				'CONF_CRIT_VALUE' => $select_crit["value"][$i],
				'CONF_CRIT_SELECTED' => $selected
			));

			$i++;
		}	

		// Periphs
		if (defined("OCS_PERIPH_DBL".$_GET["agence_id"]) && constant("OCS_PERIPH_DBL".$_GET["agence_id"]) == 1)
		{
			$template->assign_block_vars('form.periph_options_yn', array(
				'LABEL' => $lang["adm_ocs_periph_doublons"],
				'YES' => $lang["gen_yes"],
				'NO' => $lang["gen_no"],
				'NAME' => 'periph_double',
				'Y_CHECK' => 'checked',
			));
		}
		else
		{
			$template->assign_block_vars('form.periph_options_yn', array(
				'LABEL' => $lang["adm_ocs_periph_doublons"],
				'YES' => $lang["gen_yes"],
				'NO' => $lang["gen_no"],
				'NAME' => 'periph_double',
				'N_CHECK' => 'checked',
			));
		}

		// Filtres softs		
		$filtre['value'] = array('%KB%','%update%','%microsoft%');
		$filtre['name'] = array($lang["adm_ocs_filter_kb"],$lang["adm_ocs_filter_update"],$lang["adm_ocs_filter_microsoft"]);

		if (defined("OCS_FILTRE_OCS".$_GET["agence_id"]))
			$filtre_ocs = explode(';',constant("OCS_FILTRE_OCS".$_GET["agence_id"]));
		else
			$filtre_ocs = array();
				
		$i = 0;
		while ($i < count($filtre['value']))
		{
			if (in_array($filtre['value'][$i],$filtre_ocs))
				$checked = 'checked';
			else
				$checked = '';
				
			$template->assign_block_vars('form.soft_filter', array(
				'CONF_SOFT_FILTER_LABEL' => $filtre["name"][$i],
				'CONF_SOFT_FILTER_NAME' => 't_'.$i,
				'CONF_SOFT_FILTER_VALUE' => $filtre["value"][$i],
				'CONF_SOFT_FILTER_CHECK' => $checked
			));
			
			$i++;
		}
	}
	
}



echo $affichage;

?>