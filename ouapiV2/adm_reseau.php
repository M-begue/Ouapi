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
		$type_reseau_materiel_id = $_POST['type_reseau_materiel_id'] ?? '0';
		$type_reseau_equipement_id = $_POST['type_reseau_equipement_id'] ?? '0';
		$poe_materiel = isset($_POST['POE_materiel']) ? 1 : 0;
		$brancher_poe_materiel = isset($_POST['Brancher_POE_materiel']) ? 1 : 0;
		$poe_reseau = isset($_POST['POE_reseau']) ? 1 : 0;
		$brancher_poe_reseau = isset($_POST['Brancher_POE_reseau']) ? 1 : 0;
		if (isset($_GET['r_id']))
			$r_id = $_GET['r_id'];
		else
			$r_id = '';

		// Controle si port existe déjà�j�
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
			
			$requete = "INSERT INTO ".TAB_RESEAU." (".RE_PLUGNUMBER.",".RE_LOCATIONID.",".RE_SITEID.",".RE_HARDWAREID.",".RE_NETWORKHARDID.",".RE_PORTID.",type_reseau_materiel_id,type_reseau_equipement_id,POE_materiel,Brancher_POE_materiel,POE_reseau,Brancher_POE_reseau".$pfields_names.") VALUES ('".$num_prise."','".$emplacement_id."','".$agence_id."','".$hardware_id."','".$switch_id."','".$port_id."','".$type_reseau_materiel_id."','".$type_reseau_equipement_id."',".$poe_materiel.",".$brancher_poe_materiel.",".$poe_reseau.",".$brancher_poe_reseau."".$pfields_values.")";

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
			hardware_id='$hardware_id',equipement_id='$switch_id',port_id='$port_id',type_reseau_materiel_id='$type_reseau_materiel_id',type_reseau_equipement_id='$type_reseau_equipement_id',POE_materiel=".$poe_materiel.",Brancher_POE_materiel=".$brancher_poe_materiel.",POE_reseau=".$poe_reseau.",Brancher_POE_reseau=".$brancher_poe_reseau."".$pfields_update." WHERE id='".$_GET['r_id']."'";

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
			// Construire le paramètre de redirection pour revenir à cette page après ajout d'un élément
			$redirect_page = urlencode('page=adm_reseau.php&action=Ajouter&agence_id='.$_GET['agence_id']);
			
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_netw_add"],
			  'ACTION' => 'index.php?page=adm_reseau.php&amp;action=Ajouter&amp;agence_id='.$_GET["agence_id"],
			  'ONSUBMIT' => 'return verifErrors()',
			  'AGENCE_ID' => $_GET["agence_id"],
			  'RETURN' => $lang["gen_back"],
			));

			// ====== SECTION EQUIPEMENT CONNECTE ======
			$template->assign_block_vars('form.equipement_connecte', array());

			// Récupération des données matériel connecté
			$tab_hard = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET["agence_id"]."' AND suivi_rebus='' ORDER BY nom");
			
			$mat = isset($_GET["h_id"]) ? $_GET["h_id"] : '-1';
			$empl = null;
			if (isset($_GET["h_id"]))
			{
				$tab_mat = $req1->db_use_query("SELECT ".TAB_HARD.".id,
				".TAB_HARD.".emplacement_id,
				".TAB_EMPL.".id AS empl_id
				FROM ".TAB_HARD." 
				  LEFT JOIN ".TAB_EMPL." ON ".TAB_EMPL.".id = ".TAB_HARD.".emplacement_id
				WHERE ".TAB_HARD.".id='".$mat."'");
				
				$empl = $tab_mat[0]["empl_id"];
			}

			// Matériel connecté (select)
			$template->assign_block_vars('form.equipement_connecte.hard', array(
			  'TITLE' => $lang["adm_netw_hardlink"],
			));

			$i = -1;
			$tab_hard[-1] = array('id' => '-1', 'nom' => $lang["gen_select"], 'emplacement_id' => '-1');
			while ($i < count($tab_hard)-1)
			{
				if ($mat == $tab_hard[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_connecte.hard.list', array(
					  'ID' => $tab_hard[$i]['id'],
					  'LIBELLE' => $tab_hard[$i]['nom'],
					  'SELECTED' => 'selected',
					  'EMPLACEMENT_ID' => $tab_hard[$i]['emplacement_id']
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_connecte.hard.list', array(
					  'ID' => $tab_hard[$i]['id'],
					  'LIBELLE' => $tab_hard[$i]['nom'],
					  'EMPLACEMENT_ID' => $tab_hard[$i]['emplacement_id']
					));
				}
				$i++;
			}

			// Emplacement du matériel connecté (disabled, synchronisé avec hardware_id)
			$tab_empl_all = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY libelle");
			$template->assign_block_vars('form.equipement_connecte.empl_connecte', array(
			  'TITLE' => $lang["adm_netw_place"],
			  'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab_empl_all[-1] = array('id' => '-1', 'libelle' => '-');
			while ($i < count($tab_empl_all)-1)
			{
				if (isset($empl) && $empl == $tab_empl_all[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_connecte.empl_connecte.list', array(
					  'ID' => $tab_empl_all[$i]['id'],
					  'LIBELLE' => $tab_empl_all[$i]['libelle'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_connecte.empl_connecte.list', array(
					  'ID' => $tab_empl_all[$i]['id'],
					  'LIBELLE' => $tab_empl_all[$i]['libelle']
					));
				}
				$i++;
			}

			// Numéro de prise
			$template->assign_block_vars('form.equipement_connecte.numero', array(
			  'TITLE' => $lang["adm_netw_prisen"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'required',
			));

			// POE Materiel
			$template->assign_block_vars('form.equipement_connecte.poe_checkbox_materiel', array(
			  'TITLE' => $lang["adm_netw_poe"],
			));

			// Brancher POE Materiel
			$template->assign_block_vars('form.equipement_connecte.brancher_poe_checkbox_materiel', array(
			  'TITLE' => $lang["adm_netw_brancher_poe"],
			));

			// Type Réseau Matériel
			$tab_type_reseau_mat = $req1->db_use_query("SELECT * FROM ".TAB_TYPE_RESEAU." ORDER BY libelle");
			$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel', array(
			  'TITLE' => $lang["adm_netw_type_reseau_materiel"],
			));

			$i = -1;
			$tab_type_reseau_mat[-1] = array('id' => '0', 'libelle' => $lang["gen_select"]);
			while ($i < count($tab_type_reseau_mat)-1)
			{
				$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel.list', array(
				  'ID' => $tab_type_reseau_mat[$i]['id'],
				  'LIBELLE' => $tab_type_reseau_mat[$i]['libelle']
				));
				$i++;
			}

			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=type_reseau&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;redirect_page='.$redirect_page,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["add"],
				));
			}

			// ====== SECTION EQUIPEMENT RÉSEAU ======
			$template->assign_block_vars('form.equipement_reseau', array());

			// Récupération des équipements réseau
			$tab_nht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='netw_hardtype'");
			$type_id = '(type_id=\''.substr($tab_nht[0]["valeur"],0,-1).'\')';
			$type_id = str_replace(';','\' OR type_id=\'',$type_id);
			
			$tab_netw = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH." WHERE ".$type_id." AND agence_id='".$_GET["agence_id"]."' ORDER BY nom");

			$netw_selected = isset($_GET["n_id"]) ? $_GET["n_id"] : '-1';
			$empl_netw = null;
			if (isset($_GET["n_id"]))
			{
    			$tab_netw_selected = $req1->db_use_query("SELECT id, emplacement_id FROM ".TAB_PERIPH." WHERE id='".$netw_selected."'");
    			if (count($tab_netw_selected) > 0) {
        			$empl_netw = $tab_netw_selected[0]["emplacement_id"];
    			}
			}

			// Équipement réseau (select)
			$template->assign_block_vars('form.equipement_reseau.netw', array(
			  'TITLE' => $lang["adm_netw_hardnlink"],
			));

			$i = -1;
			$tab_netw[-1] = array('id' => '-1', 'nom' => $lang["gen_select"], 'emplacement_id' => '-1');
			while ($i < count($tab_netw)-1)
			{
				if ($netw_selected == $tab_netw[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_reseau.netw.list', array(
					  'ID' => $tab_netw[$i]['id'],
					  'LIBELLE' => $tab_netw[$i]['nom'],
					  'SELECTED' => 'selected',
					  'EMPLACEMENT_ID' => $tab_netw[$i]['emplacement_id']
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_reseau.netw.list', array(
					  'ID' => $tab_netw[$i]['id'],
					  'LIBELLE' => $tab_netw[$i]['nom'],
					  'EMPLACEMENT_ID' => $tab_netw[$i]['emplacement_id']
					));
				}
				$i++;
			}

			// Emplacement
			$tab_empl_all = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY libelle");
			$template->assign_block_vars('form.equipement_reseau.empl', array(
			  'TITLE' => $lang["adm_netw_place"],
			  'DISABLED' => 'disabled',
			  'HIDDEN_VALUE' => isset($empl_netw) ? $empl_netw : ''
			));

			$i = -1;
			$tab_empl_all[-1] = array('id' => '-1', 'libelle' => '-');
			while ($i < count($tab_empl_all)-1)
			{
				if (isset($empl_netw) && $empl_netw == $tab_empl_all[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_reseau.empl.list', array(
					  'ID' => $tab_empl_all[$i]['id'],
					  'LIBELLE' => $tab_empl_all[$i]['libelle'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_reseau.empl.list', array(
					  'ID' => $tab_empl_all[$i]['id'],
					  'LIBELLE' => $tab_empl_all[$i]['libelle']
					));
				}
				$i++;
			}

			// Numéro de port
			$template->assign_block_vars('form.equipement_reseau.port', array(
			  'TITLE' => $lang["adm_netw_portnum"],
			));

			// Type Réseau Équipement
			$tab_type_reseau_eq = $req1->db_use_query("SELECT * FROM ".TAB_TYPE_RESEAU." ORDER BY libelle");
			$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement', array(
			  'TITLE' => $lang["adm_netw_type_reseau_equipement"],
			));

			$i = -1;
			$tab_type_reseau_eq[-1] = array('id' => '0', 'libelle' => $lang["gen_select"]);
			while ($i < count($tab_type_reseau_eq)-1)
			{
				$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement.list', array(
				  'ID' => $tab_type_reseau_eq[$i]['id'],
				  'LIBELLE' => $tab_type_reseau_eq[$i]['libelle']
				));
				$i++;
			}

			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=type_reseau&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;redirect_page='.$redirect_page,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["add"],
				));
			}

			// POE Reseau
			$template->assign_block_vars('form.equipement_reseau.poe_checkbox_reseau', array(
			  'TITLE' => $lang["adm_netw_poe_reseau"],
			));

			// Brancher POE Reseau
			$template->assign_block_vars('form.equipement_reseau.brancher_poe_checkbox_reseau', array(
			  'TITLE' => $lang["adm_netw_brancher_poe_reseau"],
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
			// Construire le paramètre de redirection pour revenir à cette page après modification d'un élément
			$redirect_page = urlencode('page=adm_reseau.php&action=Editer&agence_id='.$_GET['agence_id'].'&id='.$_GET['id']);
			
			$requete = "SELECT * FROM ".TAB_RESEAU." WHERE id='".$_GET["id"]."'";
			$tab_gen = $req1->db_use_query($requete);

			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_netw_edit"],
			  'ACTION' => 'index.php?page=adm_reseau.php&amp;action=Editer&amp;r_id='.$_GET['id']."&amp;agence_id=".$_GET["agence_id"],
			  'ONSUBMIT' => 'return verifErrors()',
			  'AGENCE_ID' => $_GET["agence_id"],
			  'RETURN' => $lang["gen_back"],
			));

			// ====== SECTION EQUIPEMENT CONNECTE ======
			$template->assign_block_vars('form.equipement_connecte', array());

			// Récupération des données matériel connecté
			$tab_hard = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET["agence_id"]."' AND suivi_rebus='' ORDER BY nom");
			
			// Matériel connecté (select)
			$template->assign_block_vars('form.equipement_connecte.hard', array(
			  'TITLE' => $lang["adm_netw_hardlink"],
			));

			$i = -1;
			$tab_hard[-1] = array('id' => '-1', 'nom' => $lang["none"], 'emplacement_id' => '-1');
			while ($i < count($tab_hard)-1)
			{
				if ($tab_gen[0]['hardware_id'] == $tab_hard[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_connecte.hard.list', array(
					  'ID' => $tab_hard[$i]['id'],
					  'LIBELLE' => $tab_hard[$i]['nom'],
					  'SELECTED' => 'selected="selected"',
					  'EMPLACEMENT_ID' => $tab_hard[$i]['emplacement_id']
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_connecte.hard.list', array(
					  'ID' => $tab_hard[$i]['id'],
					  'LIBELLE' => $tab_hard[$i]['nom'],
					  'EMPLACEMENT_ID' => $tab_hard[$i]['emplacement_id']
					));
				}
				$i++;
			}

			// Emplacement du matériel connecté (disabled, synchronisé avec hardware_id)
			$tab_empl_all = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY libelle");
			$template->assign_block_vars('form.equipement_connecte.empl_connecte', array(
			  'TITLE' => $lang["adm_netw_place"],
			  'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab_empl_all[-1] = array('id' => '-1', 'libelle' => '-');
			while ($i < count($tab_empl_all)-1)
			{
				// On cherche l'emplacement du matériel connecté sélectionné
				$emplacement_id_connecte = null;
				foreach ($tab_hard as $hard_item) {
					if ($hard_item['id'] == $tab_gen[0]['hardware_id']) {
						$emplacement_id_connecte = $hard_item['emplacement_id'];
						break;
					}
				}
				
				if ($emplacement_id_connecte && $emplacement_id_connecte == $tab_empl_all[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_connecte.empl_connecte.list', array(
					  'ID' => $tab_empl_all[$i]['id'],
					  'LIBELLE' => $tab_empl_all[$i]['libelle'],
					  'SELECTED' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_connecte.empl_connecte.list', array(
					  'ID' => $tab_empl_all[$i]['id'],
					  'LIBELLE' => $tab_empl_all[$i]['libelle']
					));
				}
				$i++;
			}

			// Numéro de prise
			$template->assign_block_vars('form.equipement_connecte.numero', array(
			  'TITLE' => $lang["adm_netw_prisen"],
			  'KEYUP' => 'verifLong(this);',
			  'VALUE' => $tab_gen[0]['num_prise'],
			  'ID' => 'ok',
			));

			// POE Materiel
			$template->assign_block_vars('form.equipement_connecte.poe_checkbox_materiel', array(
			  'TITLE' => $lang["adm_netw_poe"],
			  'CHECKED' => ($tab_gen[0]['POE_materiel'] == 1) ? 'checked' : '',
			));

			// Brancher POE Materiel
			$template->assign_block_vars('form.equipement_connecte.brancher_poe_checkbox_materiel', array(
			  'TITLE' => $lang["adm_netw_brancher_poe"],
			  'CHECKED' => ($tab_gen[0]['Brancher_POE_materiel'] == 1) ? 'checked' : '',
			));

			// Type Réseau Matériel
			$tab_type_reseau_mat = $req1->db_use_query("SELECT * FROM ".TAB_TYPE_RESEAU." ORDER BY libelle");
			$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel', array(
			  'TITLE' => $lang["adm_netw_type_reseau_materiel"],
			));

			$i = -1;
			$tab_type_reseau_mat[-1] = array('id' => '0', 'libelle' => $lang["none"]);
			while ($i < count($tab_type_reseau_mat)-1)
			{
				if ($tab_gen[0]['type_reseau_materiel_id'] == $tab_type_reseau_mat[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel.list', array(
					  'ID' => $tab_type_reseau_mat[$i]['id'],
					  'LIBELLE' => $tab_type_reseau_mat[$i]['libelle'],
					  'SELECTED' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel.list', array(
					  'ID' => $tab_type_reseau_mat[$i]['id'],
					  'LIBELLE' => $tab_type_reseau_mat[$i]['libelle']
					));
				}
				$i++;
			}

			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=type_reseau&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;redirect_page='.$redirect_page,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["add"],
				));
			}

			// ====== SECTION EQUIPEMENT RÉSEAU ======
			$template->assign_block_vars('form.equipement_reseau', array());

			// Récupération des équipements réseau
			$tab_nht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='netw_hardtype'");
			$type_id = '(type_id=\''.substr($tab_nht[0]["valeur"],0,-1).'\')';
			$type_id = str_replace(';','\' OR type_id=\'',$type_id);
			
			$tab_netw = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH." WHERE ".$type_id." AND agence_id='".$_GET["agence_id"]."' ORDER BY nom");

			// Équipement réseau (select)
			$template->assign_block_vars('form.equipement_reseau.netw', array(
			  'TITLE' => $lang["adm_netw_hardnlink"],
			));

			$i = -1;
			$tab_netw[-1] = array('id' => '-1', 'nom' => $lang["none"], 'emplacement_id' => '-1');
			while ($i < count($tab_netw)-1)
			{
				if ($tab_gen[0]['equipement_id'] == $tab_netw[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_reseau.netw.list', array(
					  'ID' => $tab_netw[$i]['id'],
					  'LIBELLE' => $tab_netw[$i]['nom'],
					  'SELECTED' => 'selected="selected"',
					  'EMPLACEMENT_ID' => $tab_netw[$i]['emplacement_id']
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_reseau.netw.list', array(
					  'ID' => $tab_netw[$i]['id'],
					  'LIBELLE' => $tab_netw[$i]['nom'],
					  'EMPLACEMENT_ID' => $tab_netw[$i]['emplacement_id']
					));
				}
				$i++;
			}

			// Emplacement
			$tab_empl = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY libelle");
			$template->assign_block_vars('form.equipement_reseau.empl', array(
			  'TITLE' => $lang["adm_netw_place"],
			  'DISABLED' => 'disabled',
              'HIDDEN_VALUE' => isset($tab_gen[0]['emplacement_id']) ? $tab_gen[0]['emplacement_id'] : ''
			));

			$i = -1;
			$tab_empl[-1] = array('id' => '-1', 'libelle' => $lang["none"]);
			while ($i < count($tab_empl)-1)
			{
				if ($tab_gen[0]['emplacement_id'] == $tab_empl[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_reseau.empl.list', array(
					  'ID' => $tab_empl[$i]['id'],
					  'LIBELLE' => $tab_empl[$i]['libelle'],
					  'SELECTED' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_reseau.empl.list', array(
					  'ID' => $tab_empl[$i]['id'],
					  'LIBELLE' => $tab_empl[$i]['libelle']
					));
				}
				$i++;
			}

			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.equipement_reseau.empl.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=empl&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;slct_site=1&amp;redirect_page='.$redirect_page,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["add"],
				));
			}

			// Numéro de port
			$template->assign_block_vars('form.equipement_reseau.port', array(
			  'TITLE' => $lang["adm_netw_portnum"],
			  'VALUE' => $tab_gen[0]['port_id'],
			));

			// Type Réseau Équipement
			$tab_type_reseau_eq = $req1->db_use_query("SELECT * FROM ".TAB_TYPE_RESEAU." ORDER BY libelle");
			$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement', array(
			  'TITLE' => $lang["adm_netw_type_reseau_equipement"],
			));

			$i = -1;
			$tab_type_reseau_eq[-1] = array('id' => '0', 'libelle' => $lang["none"]);
			while ($i < count($tab_type_reseau_eq)-1)
			{
				if ($tab_gen[0]['type_reseau_equipement_id'] == $tab_type_reseau_eq[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement.list', array(
					  'ID' => $tab_type_reseau_eq[$i]['id'],
					  'LIBELLE' => $tab_type_reseau_eq[$i]['libelle'],
					  'SELECTED' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement.list', array(
					  'ID' => $tab_type_reseau_eq[$i]['id'],
					  'LIBELLE' => $tab_type_reseau_eq[$i]['libelle']
					));
				}
				$i++;
			}

			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=type_reseau&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;redirect_page='.$redirect_page,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["add"],
				));
			}

			// POE Reseau
			$template->assign_block_vars('form.equipement_reseau.poe_checkbox_reseau', array(
			  'TITLE' => $lang["adm_netw_poe_reseau"],
			  'CHECKED' => ($tab_gen[0]['POE_reseau'] == 1) ? 'checked' : '',
			));

			// Brancher POE Reseau
			$template->assign_block_vars('form.equipement_reseau.brancher_poe_checkbox_reseau', array(
			  'TITLE' => $lang["adm_netw_brancher_poe_reseau"],
			  'CHECKED' => ($tab_gen[0]['Brancher_POE_reseau'] == 1) ? 'checked' : '',
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
		// SUPPRIMER
		elseif (isset($_GET['action']) && $_GET['action'] == 'Supprimer')
		{
			// Construire le paramètre de redirection pour revenir à cette page après suppression
			$redirect_page = urlencode('page=adm_reseau.php&action=Supprimer&agence_id='.$_GET['agence_id'].'&id='.$_GET['id']);
			
			$requete = "SELECT * FROM ".TAB_RESEAU." WHERE id='".$_GET["id"]."'";
			$tab_gen = $req1->db_use_query($requete);
			
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_netw_del"],
			  'ACTION' => 'index.php?page=adm_reseau.php&amp;action=Supprimer&amp;r_id='.$_GET['id']."&amp;agence_id=".$_GET["agence_id"],
			  'AGENCE_ID' => $_GET["agence_id"],
			  'RETURN' => $lang["gen_back"],
			));

			// ====== SECTION EQUIPEMENT CONNECTE ======
			$template->assign_block_vars('form.equipement_connecte', array());

			// Récupération des données matériel connecté
			$tab_hard = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET["agence_id"]."' AND suivi_rebus='' ORDER BY nom");
			
			// Matériel connecté (select)
			$template->assign_block_vars('form.equipement_connecte.hard', array(
			  'TITLE' => $lang["adm_netw_hardlink"],
			  'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab_hard[-1] = array('id' => '-1', 'nom' => $lang["none"], 'emplacement_id' => '-1');
			while ($i < count($tab_hard)-1)
			{
				if ($tab_gen[0]['hardware_id'] == $tab_hard[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_connecte.hard.list', array(
					  'ID' => $tab_hard[$i]['id'],
					  'LIBELLE' => $tab_hard[$i]['nom'],
					  'SELECTED' => 'selected',
					  'EMPLACEMENT_ID' => $tab_hard[$i]['emplacement_id']
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_connecte.hard.list', array(
					  'ID' => $tab_hard[$i]['id'],
					  'LIBELLE' => $tab_hard[$i]['nom'],
					  'EMPLACEMENT_ID' => $tab_hard[$i]['emplacement_id']
					));
				}
				$i++;
			}

			// Emplacement du matériel connecté (disabled)
			$tab_empl_all = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY libelle");
			$template->assign_block_vars('form.equipement_connecte.empl_connecte', array(
			  'TITLE' => $lang["adm_netw_place"],
			  'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab_empl_all[-1] = array('id' => '-1', 'libelle' => '-');
			while ($i < count($tab_empl_all)-1)
			{
				// On cherche l'emplacement du matériel connecté sélectionné
				$emplacement_id_connecte = null;
				foreach ($tab_hard as $hard_item) {
					if ($hard_item['id'] == $tab_gen[0]['hardware_id']) {
						$emplacement_id_connecte = $hard_item['emplacement_id'];
						break;
					}
				}
				
				if ($emplacement_id_connecte && $emplacement_id_connecte == $tab_empl_all[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_connecte.empl_connecte.list', array(
					  'ID' => $tab_empl_all[$i]['id'],
					  'LIBELLE' => $tab_empl_all[$i]['libelle'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_connecte.empl_connecte.list', array(
					  'ID' => $tab_empl_all[$i]['id'],
					  'LIBELLE' => $tab_empl_all[$i]['libelle']
					));
				}
				$i++;
			}

			// Numéro de prise
			$template->assign_block_vars('form.equipement_connecte.numero', array(
			  'TITLE' => $lang["adm_netw_prisen"],
			  'DISABLED' => 'disabled',
			  'VALUE' => $tab_gen[0]['num_prise'],
			));

			// POE Materiel
			$template->assign_block_vars('form.equipement_connecte.poe_checkbox_materiel', array(
			  'TITLE' => $lang["adm_netw_poe"],
			  'CHECKED' => ($tab_gen[0]['POE_materiel'] == 1) ? 'checked' : '',
			  'DISABLED' => 'disabled',
			));

			// Brancher POE Materiel
			$template->assign_block_vars('form.equipement_connecte.brancher_poe_checkbox_materiel', array(
		  	'TITLE' => $lang["adm_netw_brancher_poe"],
		  	'CHECKED' => ($tab_gen[0]['Brancher_POE_materiel'] == 1) ? 'checked' : '',
			'DISABLED' => 'disabled',
			));

			// Type Réseau Matériel
			$tab_type_reseau_mat = $req1->db_use_query("SELECT * FROM ".TAB_TYPE_RESEAU." ORDER BY libelle");
			$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel', array(
		  	'TITLE' => $lang["adm_netw_type_reseau_materiel"],
		  	'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab_type_reseau_mat[-1] = array('id' => '0', 'libelle' => $lang["none"]);
			while ($i < count($tab_type_reseau_mat)-1)
			{
				if ($tab_gen[0]['type_reseau_materiel_id'] == $tab_type_reseau_mat[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel.list', array(
				  	'ID' => $tab_type_reseau_mat[$i]['id'],
				  	'LIBELLE' => $tab_type_reseau_mat[$i]['libelle'],
				  	'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel.list', array(
				  	'ID' => $tab_type_reseau_mat[$i]['id'],
				  	'LIBELLE' => $tab_type_reseau_mat[$i]['libelle']
					));
				}
				$i++;
			}

			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.equipement_connecte.type_reseau_materiel.action', array(
			  	'LINK' => 'index.php?page=adm_tables.php&amp;table=type_reseau&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;redirect_page='.$redirect_page,
			  	'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  	'LIBELLE' => $lang["add"],
				));
			}

			// ====== SECTION EQUIPEMENT RÉSEAU ======
			$template->assign_block_vars('form.equipement_reseau', array());

			// Récupération des équipements réseau
			$tab_nht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='netw_hardtype'");
			$type_id = '(type_id=\''.substr($tab_nht[0]["valeur"],0,-1).'\')';
			$type_id = str_replace(';','\' OR type_id=\'',$type_id);
	
			$tab_netw = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH." WHERE ".$type_id." AND agence_id='".$_GET["agence_id"]."' ORDER BY nom");

			$template->assign_block_vars('form.equipement_reseau.netw', array(
  				'TITLE' => $lang["adm_netw_hardnlink"],
  				'DISABLED' => 'disabled',
			));
			// Équipement réseau
			$i = -1;
			$tab_netw[-1] = array('id' => '-1', 'nom' => $lang["none"], 'emplacement_id' => '-1');
			while ($i < count($tab_netw)-1)	{
				if ($tab_gen[0]['equipement_id'] == $tab_netw[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_reseau.netw.list', array(
					'ID' => $tab_netw[$i]['id'],
					'LIBELLE' => $tab_netw[$i]['nom'],
					'SELECTED' => 'selected',
					'EMPLACEMENT_ID' => $tab_netw[$i]['emplacement_id']
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_reseau.netw.list', array(
					'ID' => $tab_netw[$i]['id'],
					'LIBELLE' => $tab_netw[$i]['nom'],
					'EMPLACEMENT_ID' => $tab_netw[$i]['emplacement_id']
					));
				}
				$i++;
			}

			// Emplacement
			$tab_empl = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY libelle");
			$template->assign_block_vars('form.equipement_reseau.empl', array(
			  'TITLE' => $lang["adm_netw_place"],
			  'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab_empl[-1] = array('id' => '-1', 'libelle' => $lang["none"]);
			while ($i < count($tab_empl)-1)
			{
				if ($tab_gen[0]['emplacement_id'] == $tab_empl[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_reseau.empl.list', array(
					  'ID' => $tab_empl[$i]['id'],
					  'LIBELLE' => $tab_empl[$i]['libelle'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_reseau.empl.list', array(
					  'ID' => $tab_empl[$i]['id'],
					  'LIBELLE' => $tab_empl[$i]['libelle']
					));
				}
				$i++;
			}

			// Numéro de port
			$template->assign_block_vars('form.equipement_reseau.port', array(
			  'TITLE' => $lang["adm_netw_portnum"],
			  'VALUE' => $tab_gen[0]['port_id'],
			  'DISABLED' => 'disabled',
			));

			// Type Réseau Équipement
			$tab_type_reseau_eq = $req1->db_use_query("SELECT * FROM ".TAB_TYPE_RESEAU." ORDER BY libelle");
			$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement', array(
			  'TITLE' => $lang["adm_netw_type_reseau_equipement"],
			  'DISABLED' => 'disabled',
			));

			$i = -1;
			$tab_type_reseau_eq[-1] = array('id' => '0', 'libelle' => $lang["none"]);
			while ($i < count($tab_type_reseau_eq)-1)
			{
				if ($tab_gen[0]['type_reseau_equipement_id'] == $tab_type_reseau_eq[$i]['id'])
				{
					$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement.list', array(
					  'ID' => $tab_type_reseau_eq[$i]['id'],
					  'LIBELLE' => $tab_type_reseau_eq[$i]['libelle'],
					  'SELECTED' => 'selected'
					));
				}
				else
				{
					$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement.list', array(
					  'ID' => $tab_type_reseau_eq[$i]['id'],
					  'LIBELLE' => $tab_type_reseau_eq[$i]['libelle']
					));
				}
				$i++;
			}

			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.equipement_reseau.type_reseau_equipement.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=type_reseau&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;redirect_page='.$redirect_page,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["add"],
				));
			}

			// POE Reseau
			$template->assign_block_vars('form.equipement_reseau.poe_checkbox_reseau', array(
			  'TITLE' => $lang["adm_netw_poe_reseau"],
			  'CHECKED' => ($tab_gen[0]['POE_reseau'] == 1) ? 'checked' : '',
			  'DISABLED' => 'disabled',
			));

			// Brancher POE Reseau
			$template->assign_block_vars('form.equipement_reseau.brancher_poe_checkbox_reseau', array(
			  'TITLE' => $lang["adm_netw_brancher_poe_reseau"],
			  'CHECKED' => ($tab_gen[0]['Brancher_POE_reseau'] == 1) ? 'checked' : '',
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
		  'ACTION' => 'index.php?page=adm_reseau.php&config='.$_GET["config"].'&agence_id='.$_GET["agence_id"],
		  'AGENCE_ID' => $_GET["agence_id"],
		  'RETURN' => $lang["gen_back"],
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