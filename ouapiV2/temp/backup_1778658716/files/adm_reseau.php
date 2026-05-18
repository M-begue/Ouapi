<?php declare(strict_types=1);

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$affichage = '';

/**
 * Return the list of network custom field columns for TAB_RESEAU.
 */
function get_reseau_pfield_columns(db_use $db): array
{
    if ($db->connection === null) {
        $db->connection();
    }

    $columns = [];
    $query = "SHOW COLUMNS FROM " . TAB_RESEAU . " LIKE 'pfield_%'";
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

if (isset($_POST['soumettre']))
{
	$err = array();

	if (isset($_POST['numero']))
	{
		$num_prise = format_string_db($_POST['numero']);
		$emplacement_id = $_POST['emplacement_id'];
		$agence_id = $_GET['agence_id'];
		$hardware_id = $_POST['hardware_id'];
		$switch_id = $_POST['switch_id'];
		$port_id = format_string_db($_POST['port_id']);
	
	
		if (isset($_GET['r_id']))
			$r_id = $_GET['r_id'];
		else
			$r_id = '';

		// Controle si port existe d�j�
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_RESEAU." 
		WHERE agence_id='".$agence_id."' AND equipement_id='".$switch_id."' AND port_id='".$port_id."' AND port_id<>'0' AND id<>'".$r_id."'");
		
		if (count($tab) != 0)
			array_push($err,$lang["adm_netw_addporterror"]);
			
		//Controle si prise existe d�j�
		if (isset($_GET['action']) && $_GET['action'] != 'Editer')
		{
			$tab = $req1->db_use_query("SELECT id,agence_id, num_prise FROM ".TAB_RESEAU." 
			WHERE agence_id='".$agence_id."' AND num_prise='".$num_prise."' AND id<>'".$r_id."'");

			if (count($tab) != 0)
				array_push($err,$lang["adm_netw_addpriseerror"]);
		}
	}
		
	if (count($err) == 0)
	{
		if (isset($_GET['action']) && $_GET['action'] == 'Ajouter')
		{
			// Colonnes perso
			$pfields_names = '';
			$pfields_values = '';
			
			$pfieldColumns = get_reseau_pfield_columns($req1);
			foreach ($pfieldColumns as $fieldName) {
				$pfields_names .= ',' . $fieldName;
				$pfields_values .= ",'" . format_string_db($_POST[$fieldName]) . "'";
			}
			
			$requete = "INSERT INTO ".TAB_RESEAU." (".RE_PLUGNUMBER.",".RE_LOCATIONID.",".RE_SITEID.",".RE_HARDWAREID.",".RE_NETWORKHARDID.",".RE_PORTID." ".$pfields_names.")
			VALUES ('".$num_prise."','".$emplacement_id."','".$agence_id."','".$hardware_id."','".$switch_id."','".$port_id."'".$pfields_values.")";

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_netw_addok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));			
			
			$template->assign_block_vars('form_post.back', array(
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["gen_back"]	,
			));			
		}
		elseif (isset($_GET['action']) && $_GET['action'] == 'Editer')
		{
			// Colonnes perso
			$pfields_update = '';
			
			$pfieldColumns = get_reseau_pfield_columns($req1);
			foreach ($pfieldColumns as $fieldName) {
				$pfields_update .= "," . $fieldName . "='" . format_string_db($_POST[$fieldName]) . "'";
			}

			$requete = "UPDATE ".TAB_RESEAU." SET num_prise='$num_prise',emplacement_id='$emplacement_id',agence_id='$agence_id',
			hardware_id='$hardware_id',equipement_id='$switch_id',port_id='$port_id'".$pfields_update." WHERE id='".$_GET['r_id']."'";

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_netw_editok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));			
		}
		elseif (isset($_GET['action']) && $_GET['action'] == 'addelmt')
		{
			$requete = "UPDATE ".TAB_RESEAU." SET hardware_id='".$_GET["h_id"]."' WHERE id='$num_prise'";

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_netw_connexok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));			
		}
		elseif (isset($_GET['action']) && $_GET['action'] == 'Supprimer')
		{
			$requete = "DELETE FROM ".TAB_RESEAU." WHERE id='".$_GET['r_id']."'";

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_netw_delok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));			
		}
		elseif (isset($_GET['config']) && $_GET['config'] == 'assoc')
		{
			$chaine = '';
			$i = 0;
			while ($i < $_POST["nb_type"])
			{
				if (isset($_POST["t_".$i]) && $_POST["t_".$i] != NULL)
					$chaine .= $_POST["t_".$i].';';
				$i++;
			}
					
			$requete = "UPDATE ".TAB_CONFIG." SET valeur='$chaine' WHERE nom='netw_hardtype'";
			
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_netw_confhtok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));			

		}
		$tab = $req1->db_use_query($requete);
	}
	else
	{
		$errors = $lang["adm_netw_adderror"].'<br/><br/>';
			foreach ($err as $key => $val) {
				$aff_key = $key + 1;
			}
		$template->assign_block_vars('form_post', array(
			'OK' => $errors, 					
			'CLOSE' => $lang["close"],	
			'ID' => 'alert'
		));
		
		$template->assign_block_vars('form_post.back', array(
			'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
			'BACK' => $lang["gen_back"]	,
		));			
	}
}
else
{
	/**************************************************/
	/*               Ajouter / editer / Supprimer              */
	/**************************************************/

	if (isset($_GET['action']))
	{
		if (isset($_GET['action']) && $_GET['action'] == 'Ajouter')
		{			
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_netw_add"],
			  'ACTION' => 'index.php?page=adm_reseau.php&amp;action=Ajouter&amp;agence_id='.$_GET["agence_id"],
			  'ONSUBMIT' => 'return verifErrors()',
			));

			// Num�ro de prise
			$template->assign_block_vars('form.numero', array(
			  'TITLE' => $lang["adm_netw_prisen"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'required',
			));
			
			if (isset($_GET["h_id"]))
			{
				$mat = $_GET["h_id"];
				$tab_mat = $req1->db_use_query("SELECT ".TAB_HARD.".id,
				".TAB_HARD.".emplacement_id,
				".TAB_EMPL.".id AS empl_id
				FROM ".TAB_HARD." 
				  LEFT JOIN ".TAB_EMPL." ON ".TAB_EMPL.".id = ".TAB_HARD.".emplacement_id
				WHERE ".TAB_HARD.".id='".$mat."'");
				
				$empl = $tab_mat[0]["empl_id"];
			}

			// Mat�riel connect�
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY nom");
			$template->assign_block_vars('form.hard', array(
			  'TITLE' => $lang["adm_netw_hardlink"],
			));

			$i = -1;
			$tab[-1] = array('id' => '-1', 'nom' => $lang["gen_select"]);
			while ($i < count($tab)-1)
			{
				if (isset($mat) && $mat == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.hard.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.hard.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom']
					));
				}
				$i++;
			}
			
			// Emplacement
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY libelle");
			$template->assign_block_vars('form.empl', array(
			  'TITLE' => $lang["adm_netw_place"],
			));

			$i = -1;
			$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
			while ($i < count($tab)-1)
			{
				if (isset($empl) && $empl == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.empl.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.empl.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle']
					));
				}
				$i++;
			}

			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.empl.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=empl&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;slct_site=1',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["add"],
				));
			}
			
			// Equipement r�seau
			$tab_nht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='netw_hardtype'");
			$type_id = '(type_id=\''.substr($tab_nht[0]["valeur"],0,-1).'\')';
			$type_id = str_replace(';','\' OR type_id=\'',$type_id);
			
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH." WHERE ".$type_id." AND agence_id='".$_GET["agence_id"]."' ORDER BY nom");

			$template->assign_block_vars('form.netw', array(
			  'TITLE' => $lang["adm_netw_hardnlink"],
			));

			$i = -1;
			$tab[-1] = array('id' => '-1', 'nom' => $lang["gen_select"]);
			while ($i < count($tab)-1)
			{
				$template->assign_block_vars('form.netw.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['nom']
				));
				$i++;
			}
			
			// Num�ro de port
			$template->assign_block_vars('form.port', array(
			  'TITLE' => $lang["adm_netw_portnum"],
			));

			// Champs perso
		$pfieldColumns = get_reseau_pfield_columns($req1);
		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $lang['s_'.TAB_RESEAU.'.'.$fieldName],
			));
		}
			
			$template->assign_block_vars('form.button', array(
			  'TITLE' => $lang["add"],
			));

		}
		// EDITER
		elseif (isset($_GET['action']) && $_GET['action'] == 'Editer')
		{
			$requete = "SELECT * FROM ".TAB_RESEAU." WHERE id='".$_GET["id"]."'";
			$tab_gen = $req1->db_use_query($requete);

			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_netw_edit"],
			  'ACTION' => 'index.php?page=adm_reseau.php&amp;action=Editer&amp;r_id='.$_GET['id']."&amp;agence_id=".$_GET["agence_id"],
			  'ONSUBMIT' => 'return verifErrors()',
			));

			// Num�ro de prise
			$template->assign_block_vars('form.numero', array(
			  'TITLE' => $lang["adm_netw_prisen"],
			  'KEYUP' => 'verifLong(this);',
			  'VALUE' => $tab_gen[0]['num_prise'],
			  'ID' => 'ok',
			));

			// Mat�riel connect�
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY nom");
			$template->assign_block_vars('form.hard', array(
			  'TITLE' => $lang["adm_netw_hardlink"],
			));

			$i = -1;
			$tab[-1] = array('id' => '-1', 'nom' => $lang["none"]);
			while ($i < count($tab)-1)
			{
				if ($tab_gen[0]['hardware_id'] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.hard.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom'],
					  'SELECTED' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('form.hard.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom']
					));
				}
				$i++;
			}
			
			// Emplacement
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY libelle");
			$template->assign_block_vars('form.empl', array(
			  'TITLE' => $lang["adm_netw_place"],
			));

			$i = -1;
			$tab[-1] = array('id' => '-1', 'libelle' => $lang["none"]);
			while ($i < count($tab)-1)
			{
				if ($tab_gen[0]['emplacement_id'] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.empl.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('form.empl.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle']
					));
				}
				$i++;
			}

			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.empl.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=empl&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;slct_site=1',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["add"],
				));
			}
			
			// Equipement r�seau
			$tab_nht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='netw_hardtype'");
			$type_id = '(type_id=\''.substr($tab_nht[0]["valeur"],0,-1).'\')';
			$type_id = str_replace(';','\' OR type_id=\'',$type_id);
			
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH." WHERE ".$type_id." AND agence_id='".$_GET["agence_id"]."' ORDER BY nom");

			$template->assign_block_vars('form.netw', array(
			  'TITLE' => $lang["adm_netw_hardnlink"],
			));

			$i = -1;
			$tab[-1] = array('id' => '-1', 'nom' => $lang["none"]);
			while ($i < count($tab)-1)
			{
				if ($tab_gen[0]['equipement_id'] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.netw.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom'],
					  'SELECTED' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('form.netw.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom']
					));
				}
				$i++;
			}
			
			// Num�ro de port
			$template->assign_block_vars('form.port', array(
			  'TITLE' => $lang["adm_netw_portnum"],
			  'VALUE' => $tab_gen[0]['port_id'],
			));

			// Colonnes perso
			$pfieldColumns = get_reseau_pfield_columns($req1);
			foreach ($pfieldColumns as $fieldName) {
				$template->assign_block_vars('form.pfield_text', array(
				  'NAME' => $fieldName,
				  'VALUE' => $tab_gen[0][$fieldName],
				  'TITLE' => $lang['s_'.TAB_RESEAU.'.'.$fieldName],
				));
			}
			
			$template->assign_block_vars('form.button', array(
			  'TITLE' => $lang["edit"],
			));
			
		}
		elseif (isset($_GET['action']) && $_GET['action'] == 'Supprimer')
		{
			$requete = "SELECT * FROM ".TAB_RESEAU." WHERE id='".$_GET["id"]."'";
			$tab_gen = $req1->db_use_query($requete);
			
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_netw_del"],
			  'ACTION' => 'index.php?page=adm_reseau.php&amp;action=Supprimer&amp;r_id='.$_GET['id']."&amp;agence_id=".$_GET["agence_id"],
			));
			
			// Num�ro de prise
			$template->assign_block_vars('form.numero', array(
			  'TITLE' => $lang["adm_netw_prisen"],
			  'DISABLED' => 'disabled',
			  'VALUE' => $tab_gen[0]['num_prise'],
			));

			// Mat�riel connect�
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY nom");
			$template->assign_block_vars('form.hard', array(
			  'TITLE' => $lang["adm_netw_hardlink"],
			  'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab[-1] = array('id' => '-1', 'nom' => $lang["none"]);
			while ($i < count($tab)-1)
			{
				if ($tab_gen[0]['hardware_id'] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.hard.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.hard.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom']
					));
				}
				$i++;
			}
			
			// Emplacement
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY libelle");
			$template->assign_block_vars('form.empl', array(
			  'TITLE' => $lang["adm_netw_place"],
			  'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab[-1] = array('id' => '-1', 'libelle' => $lang["none"]);
			while ($i < count($tab)-1)
			{
				if ($tab_gen[0]['emplacement_id'] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.empl.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.empl.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle']
					));
				}
				$i++;
			}
			
			// Equipement r�seau
			$tab_nht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='netw_hardtype'");
			$type_id = '(type_id=\''.substr($tab_nht[0]["valeur"],0,-1).'\')';
			$type_id = str_replace(';','\' OR type_id=\'',$type_id);
			
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH." WHERE ".$type_id." AND agence_id='".$_GET["agence_id"]."' ORDER BY nom");

			$template->assign_block_vars('form.netw', array(
			  'TITLE' => $lang["adm_netw_hardnlink"],
			  'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab[-1] = array('id' => '-1', 'nom' => $lang["none"]);
			while ($i < count($tab)-1)
			{
				if ($tab_gen[0]['equipement_id'] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.netw.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.netw.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['nom']
					));
				}
				$i++;
			}
			
			// Num�ro de port
			$template->assign_block_vars('form.port', array(
			  'TITLE' => $lang["adm_netw_portnum"],
			  'VALUE' => $tab_gen[0]['port_id'],
			  'DISABLED' => 'disabled',
			));
			
			$template->assign_block_vars('form.button', array(
			  'TITLE' => $lang["delete"],
			));

		}				
	}
	/**************************************************/
	/*               Association type de materiel           */
	/**************************************************/

	elseif (isset($_GET['config']) && $_GET['config'] == "assoc")
	{
		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_netw_typeassoc"],
		  'ACTION' => 'index.php?page=adm_reseau.php&config='.$_GET["config"],
		));

		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_TYPE." ORDER BY libelle");
		$tab_nht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='netw_hardtype'");
		$nht = explode(';',$tab_nht[0]["valeur"]);

		$template->assign_block_vars('form.hard_assoc', array(
		  'NB_TYPE' => count($tab),
		));

		$i = 0;
		while ($i < count($tab))
		{					
			if (in_array($tab[$i]['id'],$nht))
			{
				$template->assign_block_vars('form.hard_assoc.list', array(
				  'TITLE' => $tab[$i]["libelle"],
				  'NAME' => 't_'.$i,
				  'VALUE' => $tab[$i]["id"],
				  'CHECKED' => 'checked'
				));
			}
			else
			{
				$template->assign_block_vars('form.hard_assoc.list', array(
				  'TITLE' => $tab[$i]["libelle"],
				  'NAME' => 't_'.$i,
				  'VALUE' => $tab[$i]["id"],
				));
			}
			$i++;
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["edit"],
		));

		if (PARAM_HELP == 1)
		{
			$template->assign_block_vars('help', array(
				'IMG_TITLE' => $lang["gen_help"],
				'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
				'GENERAL_HELP' => $lang["help"][3]
			));	
		}
		
	}
}

echo $affichage;




?>