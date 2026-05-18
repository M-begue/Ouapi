<?php declare(strict_types=1);

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use();
$affichage = '';

/**
 * Return the list of peripheral custom field columns for TAB_PERIPH.
 */
function get_periph_pfield_columns($db): array
{
    if (!isset($db->connection) || $db->connection === null) {
        $db->connection();
    }

    $columns = [];
    $query = "SHOW COLUMNS FROM " . TAB_PERIPH . " LIKE 'pfield_%'";
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


// D�connecter d'un mat�riel
if (isset($_GET['action']) && $_GET['action'] == 'unlink_elmt')
{
	$requete = "UPDATE ".TAB_PERIPH." SET ".PE_HARDID."='0' WHERE ".PE_ID."='".$_GET['p_id']."'";
	$tab = $req1->db_use_query($requete);

	$template->assign_block_vars('form_post', array(
		'OK' => $lang["return_unlink_ok"], 					
		'CLOSE' => $lang["close"],			
		'ID' => 'mess_retour',			
	));
}
	
if (isset($_POST['soumettre']))
{
	// Mise au rebus
	if (isset($_GET['action']) && $_GET['action'] == 'rebus')
	{
		$p_id = $_GET['p_id'];
		$suivi = format_text_db($_POST['suivi']);
		
		$tab = $req1->db_use_query("UPDATE ".TAB_PERIPH." SET suivi_rebus='$suivi' WHERE id='$p_id'");

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["return_update_ok"], 					
			'CLOSE' => $lang["close"],			
			'ID' => 'mess_retour',			
		));
	}
	// Lier a un mat�riel
	elseif (isset($_GET['action']) && $_GET['action'] == 'add_elmt')
	{
		$requete = "UPDATE ".TAB_PERIPH." SET hard_id='".$_GET['h_id']."' WHERE id='".$_POST['periph_id']."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["return_update_ok"], 					
			'CLOSE' => $lang["close"],			
			'ID' => 'mess_retour',			
		));
	}
	// Supprimer
	elseif (isset($_GET['action']) && $_GET['action'] == 'supprimer')
	{
		$p_id = $_GET['p_id'];
		
		$requete = "DELETE FROM ".TAB_PERIPH." WHERE id='$p_id'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_RESA." WHERE periph_id='$p_id'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_LIAISON_DOCS." WHERE periph_id='$p_id'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_periph_delok"], 					
			'CLOSE' => $lang["close"],			
			'ID' => 'mess_retour',			
		));
	}
	// Edition ou ajout
	else
	{
		$nom = format_string_db($_POST['nom']);
		$num_serie = format_string_db($_POST['num_serie']);
		$agence_id = $_POST['agence_id'];
		$type = $_POST['type'];
		$marque = $_POST['marque'];
		$modele = $_POST['modele'];
		$hard = $_POST['hard'];
		$reservable = $_POST['reservable'];
		$commentaire = format_text_db($_POST['commentaire']);
		
		if (isset($_POST['ocs_id']))
			$ocs_id = $_POST['ocs_id'];
		else
			$ocs_id = 0;
			
		if (isset($_POST['ocs_type']))
			$ocs_type = $_POST['ocs_type'];
		else
			$ocs_type = "";
		
		if (isset($_POST['date']) && $_POST['date'] != '')
			$date = date('Y-m-d', mktime(
    			0, 
    			0, 
    			0, 
    			(int)substr($_POST['date'], 3, 2), // Mois
    			(int)substr($_POST['date'], 0, 2), // Jour
    			(int)substr($_POST['date'], 6, 4)  // Année
			));
		else
			$date = date('Y-m-d');
		
		// Ajout
		if (isset($_GET['action']) && $_GET['action'] == 'add')
		{
			// Colonnes perso
			$pfields_names = '';
			$pfields_values = '';
			
			$pfieldColumns = get_periph_pfield_columns($req1);
			foreach ($pfieldColumns as $fieldName) {
				$pfields_names .= ',' . $fieldName;
				$pfields_values .= ",'" . format_string_db($_POST[$fieldName]) . "'";
			}
			
			$requete = "INSERT INTO ".TAB_PERIPH." (nom,num_serie,type_id,marque_id,modele_id,hard_id,agence_id,reservable,commentaire,suivi_rebus,creation_date,ocs_id,ocs_type".$pfields_names.")
				VALUES ('".$nom."','".$num_serie."','".$type."','".$marque."','".$modele."','".$hard."','".$agence_id."','".$reservable."','".$commentaire."','','".$date."','".$ocs_id."','".$ocs_type."'".$pfields_values.")";

			$tab = $req1->db_use_query($requete);
			
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_periph_addok"], 					
				'CLOSE' => $lang["close"],			
				'ID' => 'mess_retour',
			));
		}
		// Edition
		elseif (isset($_GET['action']) && $_GET['action'] == 'editer')
		{
			$p_id = $_GET['p_id'];

			// Colonnes perso
			$pfields_update = '';
			
$pfieldColumns = get_periph_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$pfields_update .= "," . $fieldName . "='" . format_string_db($_POST[$fieldName]) . "'";
			}
			
			$requete = "UPDATE ".TAB_PERIPH." SET nom='$nom',num_serie='$num_serie',type_id='$type',marque_id='$marque',
			modele_id='$modele',hard_id='$hard',agence_id='$agence_id',reservable='$reservable',commentaire='$commentaire',creation_date='$date'".$pfields_update." WHERE id='$p_id'";
			$tab = $req1->db_use_query($requete);
	
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["return_change_ok"], 					
				'CLOSE' => $lang["close"],			
				'ID' => 'mess_retour',			
			));
		}
	}

}
else
{
	//Ajouter
	if (isset($_GET['action']) && $_GET['action'] == 'add')
	{
		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_periph_title_add"],
		  'ACTION' => 'index.php?page=adm_peripheriques.php&amp;action=add',
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));

		$template->assign_block_vars('form.periphname', array(
		  'TITLE' => $lang["adm_periph_name"],
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'required',
		));
		
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["periph_serial"],
		));
		
		// Type de mat�riel 
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_TYPE." ORDER BY libelle");
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["periph_type"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.type.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));
			$i++;
		}

		// Marque du mat�riel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["periph_marque"],
		  'ONCLICK' => 'getDynliste(this.value,\'periph_modele\');',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.marque.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));
			$i++;
		}
		
		// Mod�le du mat�riel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MODELE." ORDER BY libelle");
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["periph_modele"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.modele.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));
			$i++;
		}

		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["place_3"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
			
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
			while ($i < count($tab)-1)
			{
				if ($_GET["agence_id"] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected="selected"',
					));
				}
				else
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					));
				}
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'AGENCE_ID' => $_GET["agence_id"]
			));	
		}
		
		// Mat�riel li�
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET['agence_id']."' ORDER BY nom");

		$template->assign_block_vars('form.linkhard', array(
		  'TITLE' => $lang["periph_hardlink"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.linkhard.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['nom']
			));
			$i++;
		}
		
		// R�servable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_periph_reserv"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0), 'checked' => array('','checked="checked"'));
		$i =0;
		while ($i < count($options["libelle"]))
		{
			$template->assign_block_vars('form.reservable.list', array(
			  'VALUE' => $options['value'][$i],
			  'LIBELLE' => $options['libelle'][$i],
			  'CHECKED' => $options['checked'][$i]
			));
			$i++;
		}

		// Date de cr�ation
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_periph_creationdate"],
		  'VALUE' => date("d-m-Y").' ',
		  'DISABLED' => 'readonly="readonly"',
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		));

		// Champs perso
		$pfieldColumns = get_periph_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $lang["s_" . TAB_PERIPH . "." . $fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));
		
		
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_type&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.marque.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_marque&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.modele.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_modele&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));
	}
	// Ajouter avec OCS
	if (isset($_GET['action']) && $_GET['action'] == 'add_ocs')
	{
		// Connexion � la base OCS
		$connect_ocs = new db_connect();
		$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

		$type_periph = $_GET["type"];
		$table = array("monitor" => TAB_OCS_MONITOR, "modem" => TAB_OCS_MODEM, "input" => TAB_OCS_INPUT, "printer" => TAB_OCS_PRINTER);
		$table_id = array("monitor" => COL_OCS_MON_ID, "modem" => COL_OCS_MODEM_ID, "input" => COL_OCS_IPT_ID, "printer" => COL_OCS_LPT_ID);
		$table_hardid = array("monitor" => COL_OCS_MON_HARDID, "modem" => COL_OCS_MODEM_HARDID, "input" => COL_OCS_IPT_HARDID, "printer" => COL_OCS_LPT_HARDID);
		
		$tab_ocs = $req1->db_use_query("SELECT ".$table[$type_periph].".*,
		  ".TAB_OCS_HARD.".".COL_OCS_HARD_NAME.",
		  ".constant("OCS_CRIT_OCS".$_GET["agence_id"])."
		FROM ".$table[$type_periph]." 
		  LEFT JOIN ".TAB_OCS_HARD." ON ".$table[$type_periph].".".$table_hardid[$type_periph]." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
		  LEFT JOIN ".TAB_OCS_BIOS." ON ".$table[$type_periph].".".$table_hardid[$type_periph]." = ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID."
		WHERE ".$table[$type_periph].".".$table_id[$type_periph]."='".$_GET["ocs_id"]."'",1);	

		$col_serial = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_SERIAL);
		$col_name = array("printer" => $table[$type_periph].'.'.COL_OCS_LPT_NAME);
		$col_type = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_TYPE, "modem" => $table[$type_periph].'.'.COL_OCS_MODEM_TYPE, "input" => $table[$type_periph].'.'.COL_OCS_IPT_TYPE);
		$col_marque = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_MARQUE, "modem" => $table[$type_periph].'.'.COL_OCS_MODEM_NAME, "input" => $table[$type_periph].'.'.COL_OCS_IPT_MARQUE);
		$col_modele = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_NAME, "modem" => $table[$type_periph].'.'.COL_OCS_MODEM_MODELE, "input" => $table[$type_periph].'.'.COL_OCS_IPT_NAME);
		$col_desc = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_DESC, "modem" => $table[$type_periph].'.'.COL_OCS_MODEM_DESC, "input" => $table[$type_periph].'.'.COL_OCS_IPT_DESC, "printer" => $table[$type_periph].'.'.COL_OCS_LPT_DRIVER);
		
		$connect_ocs->connection();

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_periph_title_add"],
		  'ACTION' => 'index.php?page=adm_peripheriques.php&amp;action=add',
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));
		
		$template->assign_block_vars('form.source_head', array(
		  'L_BASEINFO' => $lang["adm_periph_baseinfo"],
		  'L_OCSINFO' => $lang["adm_periph_ocsinfo"],
		));

		// Nom
		if (isset($col_name[$type_periph]))
		{
			$pname = txt_to_na(utf8_decode($tab_ocs[0][$col_name[$type_periph]]));
			$template->assign_block_vars('form.periphname', array(
			  'TITLE' => $lang["adm_periph_name"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'ok',
			  'VALUE' => $pname,
			));

			$template->assign_block_vars('form.periphname.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
			
			$template->assign_block_vars('form.periphname.ocs', array(
			  'VALUE' => $pname,
			));
		}
		else
		{
			$template->assign_block_vars('form.periphname', array(
			  'TITLE' => $lang["adm_periph_name"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'required',
			));
		}
		
		
		// Num�ro de s�rie
		if (isset($col_serial[$type_periph]))
			$serial = txt_to_na(utf8_decode($tab_ocs[0][$col_serial[$type_periph]]));
		else
			$serial = txt_to_na('');
			
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["periph_serial"],
		  'VALUE' => $serial,
		));

		$template->assign_block_vars('form.serial.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		  'LIBELLE' => $lang["ocs_syncok"],
		));

		$template->assign_block_vars('form.serial.ocs', array(
		  'VALUE' => $serial,
		));
		
		// Type de mat�riel 
		if (isset($col_type[$type_periph]))
			$typemat = txt_to_na(utf8_decode($tab_ocs[0][$col_type[$type_periph]]));
		else
			$typemat = txt_to_na('');
			
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_TYPE." ORDER BY libelle");
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["periph_type"],
		));
		
		$template->assign_block_vars('form.type.ocs', array(
		  'VALUE' => $typemat,
		));
		
		$i = -1;
		$type_exist = 0;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($typemat))
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected',
				));
				$type_exist++;
			}
			else
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			
			$i++;
		}

		if ($type_exist > 0)
		{
			$template->assign_block_vars('form.type.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.type.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_type&amp;action=Ajouter&amp;valeur='.utf8_decode($typemat),
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.type.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}

		// Marque du mat�riel
		if (isset($col_marque[$type_periph]))
			$marquemat = txt_to_na(utf8_decode($tab_ocs[0][$col_marque[$type_periph]]));
		else
			$marquemat = txt_to_na('');

		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["periph_marque"],
		  'ONCLICK' => 'getDynliste(this.value,\'periph_modele\'); if (document.images[\'imglink_marque\']) { document.images[\'imglink_marque\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' };  if (document.images[\'imglink_modele\']) { document.images[\'imglink_modele\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' };',
		));

		$template->assign_block_vars('form.marque.ocs', array(
		  'VALUE' => $marquemat,
		));
		
		$i = -1;
		$marque_exist = 0;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($marquemat))
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
				$marque_exist = $tab[$i]['id'];
			}
			else
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		if ($marque_exist > 0)
		{
			$template->assign_block_vars('form.marque.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.marque.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_marque&amp;action=Ajouter&amp;valeur='.$marquemat,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.marque.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}
		
		// Mod�le du mat�riel
		if (isset($col_marque[$type_periph]))
			$modelemat = txt_to_na(utf8_decode($tab_ocs[0][$col_modele[$type_periph]]));
		else
			$modelemat = txt_to_na('');
			
		if ($marque_exist > 0)
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MODELE." WHERE ".PE_MO_MARQUEID."='".$marque_exist."' ORDER BY ".PE_MO_LIBELLE);
		else
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MODELE." ORDER BY ".PE_MO_LIBELLE);
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["periph_modele"],
		));

		$template->assign_block_vars('form.modele.ocs', array(
		  'VALUE' => $modelemat,
		));
		
		$i = -1;
		$modele_exist = 0;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($modelemat))
			{
				$template->assign_block_vars('form.modele.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected',
				));
				$modele_exist++;
			}
			else
			{
				$template->assign_block_vars('form.modele.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			
			$i++;
		}

		if ($modele_exist > 0)
		{
			$template->assign_block_vars('form.modele.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.modele.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_modele&amp;action=Ajouter&amp;valeur='.$modelemat.'&amp;parent='.$marque_exist,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.modele.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}

		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["place_3"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
			
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
			while ($i < count($tab)-1)
			{
				if ($_GET["agence_id"] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected',
					));
				}
				else
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					));
				}
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'AGENCE_ID' => $_GET["agence_id"]
			));	
		}
		
		// Mat�riel li�
		$tab = $req1->db_use_query("SELECT ".TAB_HARD.".*,
		  ".TAB_HARD.".".constant("OCS_CRIT_BASE".$_GET["agence_id"])."	
		FROM ".TAB_HARD." 
		WHERE agence_id='".$_GET['agence_id']."' 
		ORDER BY nom");

		$template->assign_block_vars('form.linkhard', array(
		  'TITLE' => $lang["periph_hardlink"],
		));

		$template->assign_block_vars('form.linkhard.ocs', array(
		  'VALUE' => $tab_ocs[0][TAB_OCS_HARD.".".COL_OCS_HARD_NAME],
		));
		
		$i = -1;
		$hardlink_exist = 0;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"], constant("OCS_CRIT_BASE".$_GET["agence_id"]) => $lang["none"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i][constant("OCS_CRIT_BASE".$_GET["agence_id"])]) == strtoupper($tab_ocs[0][constant("OCS_CRIT_OCS".$_GET["agence_id"])]))
			{
				$template->assign_block_vars('form.linkhard.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['nom'],
				  'SELECTED' => 'selected',
				));
				$hardlink_exist++;
			}
			else
			{
				$template->assign_block_vars('form.linkhard.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['nom']
				));
			}
			$i++;
		}

		if ($hardlink_exist > 0)
		{
			$template->assign_block_vars('form.linkhard.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if (preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('form.linkhard.action', array(
				  'LINK' => 'index.php?page=adm_materiels.php&amp;action=add_ocs&amp;agence_id='.$_GET["agence_id"].'&amp;ocs_id='.$tab_ocs[0][$table[$type_periph].".".$table_hardid[$type_periph]],
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/templates/'.DEFAULT_TEMPLATE.'/images/arrow_add_ocs.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.linkhard.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}
		
		// R�servable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_periph_reserv"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0), 'checked' => array('','checked'));
		$i =0;
		while ($i < count($options["libelle"]))
		{
			$template->assign_block_vars('form.reservable.list', array(
			  'VALUE' => $options['value'][$i],
			  'LIBELLE' => $options['libelle'][$i],
			  'CHECKED' => $options['checked'][$i]
			));
			$i++;
		}

		// Date de cr�ation
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_periph_creationdate"],
		  'VALUE' => date("d-m-Y").' ',
		  'DISABLED' => 'readonly',
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => utf8_decode($tab_ocs[0][$col_desc[$type_periph]]),
		));
		
		$template->assign_block_vars('form.comment.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		  'LIBELLE' => $lang["ocs_syncok"],
		));
		
		$template->assign_block_vars('form.comment.ocs', array(
		  'VALUE' => utf8_decode($tab_ocs[0][$col_desc[$type_periph]]),
		));

		// Champs perso
		$pfieldColumns = get_periph_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $lang["s_" . TAB_PERIPH . "." . $fieldName],
			));
		}

		// ID OCS
		$template->assign_block_vars('form.ocs_id', array(
		  'VALUE' => $_GET["ocs_id"],
		));
		
		// Type OCS
		$template->assign_block_vars('form.ocs_type', array(
		  'VALUE' => $_GET["type"],
		));

		// Legende
		$template->assign_block_vars('form.key', array(
		  'TEMPLATE_DIR' => 'templates/'.DEFAULT_TEMPLATE.'/',
		  'L_TITLE' => $lang["gen_legende"],
		  'L_OK' => $lang["ocs_legendeok"],
		  'L_TRANS' => $lang["ocs_legendetrans"],
		  'L_ADD' => $lang["ocs_legendeadd"],
		  'L_ADD_OCS' => $lang["ocs_legendeaddocs"],
		  'L_USER' => $lang["ocs_legendeuser"],
		  'L_FORBID' => $lang["ocs_legendeforbid"],
		 ));	

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));
		
		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));
	}
	// Editer
	elseif (isset($_GET['action']) && $_GET['action'] == 'editer')
	{
		$requete = "SELECT * FROM ".TAB_PERIPH." WHERE id='".$_GET["p_id"]."'";
		$main_tab = $req1->db_use_query($requete);

		$nom = $main_tab[0]["nom"];
		$num_serie = $main_tab[0]["num_serie"];
		$agence = $main_tab[0]["agence_id"];
		$type = $main_tab[0]["type_id"];
		$marque = $main_tab[0]["marque_id"];
		$modele = $main_tab[0]["modele_id"];
		$hard = $main_tab[0]["hard_id"];
		$reservable = $main_tab[0]["reservable"];
		$commentaire = $main_tab[0]["commentaire"];

		if (!empty($main_tab[0]["creation_date"]) && $main_tab[0]["creation_date"] != '0000-00-00') {
    		$timestamp = strtotime((string)$main_tab[0]["creation_date"]);
    
    		// On vérifie si strtotime a bien réussi à convertir la date
    		if ($timestamp !== false) {
        		$creation_date = date("d-m-Y", $timestamp) . ' ';
    		} else {
        		// Si la date en BDD est bizarre (ex: 0000-00-00), on met la date du jour
        		$creation_date = date("d-m-Y") . ' ';
    		}
		} else {
    		$creation_date = date("d-m-Y") . ' ';
		}

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_periph_title_edit"],
		  'ACTION' => 'index.php?page=adm_peripheriques.php&amp;action=editer&amp;p_id='.$_GET["p_id"],
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));

		$template->assign_block_vars('form.periphname', array(
		  'TITLE' => $lang["adm_periph_name"],
		  'KEYUP' => 'verifLong(this);',
		  'VALUE' => $nom,
		  'ID' => 'ok',
		));
		
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["periph_serial"],
		  'VALUE' => $num_serie,
		));
		
		// Type de mat�riel 
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_TYPE." ORDER BY libelle");
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["periph_type"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $type)
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Marque du mat�riel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["periph_marque"],
		  'ONCLICK' => 'getDynliste(this.value,\'periph_modele\');',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $marque)
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}
		
		// Mod�le du mat�riel
		if ($marque < 1)
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MODELE." ORDER BY ".PE_MO_LIBELLE);
		else
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MODELE." WHERE ".PE_MO_MARQUEID."='".$marque."' ORDER BY ".PE_MO_LIBELLE);
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["periph_modele"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $modele)
			{
				$template->assign_block_vars('form.modele.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.modele.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["place_3"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
			
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
			while ($i < count($tab)-1)
			{
				if ($_GET["agence_id"] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected',
					));
				}
				else
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					));
				}
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'AGENCE_ID' => $_GET["agence_id"]
			));	
		}
		
		// Mat�riel li�
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET['agence_id']."' ORDER BY nom");

		$template->assign_block_vars('form.linkhard', array(
		  'TITLE' => $lang["periph_hardlink"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $hard)
			{
				$template->assign_block_vars('form.linkhard.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['nom'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.linkhard.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['nom']
				));
			}
			$i++;
		}
		
		// R�servable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_periph_reserv"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0), 'checked' => array('','checked'));
		$i =0;
		while ($i < count($options["libelle"]))
		{
			if ($options['value'][$i] == $reservable)
			{
				$template->assign_block_vars('form.reservable.list', array(
				  'VALUE' => $options['value'][$i],
				  'LIBELLE' => $options['libelle'][$i],
				  'CHECKED' => 'checked'
				));
			}
			else
			{
				$template->assign_block_vars('form.reservable.list', array(
				  'VALUE' => $options['value'][$i],
				  'LIBELLE' => $options['libelle'][$i],
				));
			}
			$i++;
		}

		// Date de cr�ation
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_periph_creationdate"],
		  'VALUE' => date("d-m-Y").' ',
		  'DISABLED' => 'readonly',
		  'VALUE' => $creation_date,
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $commentaire,
		));

		// Colonnes perso
		$pfieldColumns = get_periph_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'VALUE' => $main_tab[0][$fieldName],
			  'TITLE' => $lang["s_" . TAB_PERIPH . "." . $fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["edit"],
		));
		
		
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_type&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.marque.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_marque&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.modele.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_modele&amp;action=Ajouter&amp;parent='.$marque,
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));
	}
	// Synchro avec OCS
	elseif (isset($_GET['action']) && $_GET['action'] == 'sync_ocs')
	{
		// Connexion � la base OCS
		$connect_ocs = new db_connect();
		$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

		$type_periph = $_GET["type"];
		$table = array("monitor" => TAB_OCS_MONITOR, "modem" => TAB_OCS_MODEM, "input" => TAB_OCS_INPUT, "printer" => TAB_OCS_PRINTER);
		$table_id = array("monitor" => COL_OCS_MON_ID, "modem" => COL_OCS_MODEM_ID, "input" => COL_OCS_IPT_ID, "printer" => COL_OCS_LPT_ID);
		$table_hardid = array("monitor" => COL_OCS_MON_HARDID, "modem" => COL_OCS_MODEM_HARDID, "input" => COL_OCS_IPT_HARDID, "printer" => COL_OCS_LPT_HARDID);
		
		$tab_ocs = $req1->db_use_query("SELECT ".$table[$type_periph].".*,
		  ".TAB_OCS_HARD.".".COL_OCS_HARD_NAME.",
		  ".constant("OCS_CRIT_OCS".$_GET["agence_id"])."
		FROM ".$table[$type_periph]." 
		  LEFT JOIN ".TAB_OCS_HARD." ON ".$table[$type_periph].".".$table_hardid[$type_periph]." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
		  LEFT JOIN ".TAB_OCS_BIOS." ON ".$table[$type_periph].".".$table_hardid[$type_periph]." = ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID."
		WHERE ".$table[$type_periph].".".$table_id[$type_periph]."='".$_GET["ocs_id"]."'",1);	

		$col_serial = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_SERIAL);
		$col_name = array("printer" => $table[$type_periph].'.'.COL_OCS_LPT_NAME);
		$col_type = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_TYPE, "modem" => $table[$type_periph].'.'.COL_OCS_MODEM_TYPE, "input" => $table[$type_periph].'.'.COL_OCS_IPT_TYPE);
		$col_marque = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_MARQUE, "modem" => $table[$type_periph].'.'.COL_OCS_MODEM_NAME, "input" => $table[$type_periph].'.'.COL_OCS_IPT_MARQUE);
		$col_modele = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_NAME, "modem" => $table[$type_periph].'.'.COL_OCS_MODEM_MODELE, "input" => $table[$type_periph].'.'.COL_OCS_IPT_NAME);
		$col_desc = array("monitor" => $table[$type_periph].'.'.COL_OCS_MON_DESC, "modem" => $table[$type_periph].'.'.COL_OCS_MODEM_DESC, "input" => $table[$type_periph].'.'.COL_OCS_IPT_DESC, "printer" => $table[$type_periph].'.'.COL_OCS_LPT_DRIVER);
		
		$connect_ocs->connection();
		
		$requete = "SELECT ".TAB_PERIPH.".*,
		  ".TAB_PERIPH_TYPE.".libelle AS type_libelle,
		  ".TAB_PERIPH_MARQUE.".libelle AS marque_libelle,
		  ".TAB_PERIPH_MODELE.".libelle AS modele_libelle,
		  ".TAB_HARD.".".constant("OCS_CRIT_BASE".$_GET["agence_id"])."
		FROM ".TAB_PERIPH." 
		  LEFT JOIN ".TAB_PERIPH_TYPE." ON ".TAB_PERIPH_TYPE.".id = ".TAB_PERIPH.".type_id
		  LEFT JOIN ".TAB_PERIPH_MARQUE." ON ".TAB_PERIPH_MARQUE.".id = ".TAB_PERIPH.".marque_id
		  LEFT JOIN ".TAB_PERIPH_MODELE." ON ".TAB_PERIPH_MODELE.".id = ".TAB_PERIPH.".modele_id
		  LEFT JOIN ".TAB_HARD." ON ".TAB_HARD.".id = ".TAB_PERIPH.".hard_id
		WHERE ".TAB_PERIPH.".id='".$_GET["p_id"]."'";
		$main_tab = $req1->db_use_query($requete,1);

		$nom = $main_tab[0][TAB_PERIPH.".nom"];
		$num_serie = $main_tab[0][TAB_PERIPH.".num_serie"];
		$agence = $main_tab[0][TAB_PERIPH.".agence_id"];
		$type = $main_tab[0][TAB_PERIPH.".type_id"];
		$type_libelle = $main_tab[0][TAB_PERIPH_TYPE.".type_libelle"];
		$marque = $main_tab[0][TAB_PERIPH.".marque_id"];
		$marque_libelle = $main_tab[0][TAB_PERIPH_MARQUE.".marque_libelle"];
		$modele = $main_tab[0][TAB_PERIPH.".modele_id"];
		$modele_libelle = $main_tab[0][TAB_PERIPH_MODELE.".modele_libelle"];
		$hard = $main_tab[0][TAB_PERIPH.".hard_id"];
		$hard_crit = $main_tab[0][TAB_HARD.".".constant("OCS_CRIT_BASE".$_GET["agence_id"])];
		$reservable = $main_tab[0][TAB_PERIPH.".reservable"];
		$commentaire = $main_tab[0][TAB_PERIPH.".commentaire"];

		if ($main_tab[0][TAB_PERIPH.".creation_date"] != '')
			$creation_date = date("d-m-Y",$main_tab[0][TAB_PERIPH.".creation_date"]).' ';
		else
			$creation_date = date("d-m-Y").' ';

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_periph_title_syncocs"],
		  'ACTION' => 'index.php?page=adm_peripheriques.php&amp;action=editer&amp;p_id='.$_GET["p_id"],
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));
		
		$template->assign_block_vars('form.source_head', array(
		  'L_BASEINFO' => $lang["adm_periph_baseinfo"],
		  'L_OCSINFO' => $lang["adm_periph_ocsinfo"],
		));

		// Nom
		if (isset($col_name[$type_periph]))
		{
			$pname = txt_to_na(utf8_decode($tab_ocs[0][$col_name[$type_periph]]));

			$template->assign_block_vars('form.periphname', array(
			  'TITLE' => $lang["adm_periph_name"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'ok',
			  'VALUE' => $nom,
			));

			if (strtoupper($nom) == strtoupper($pname))
			{
				$template->assign_block_vars('form.periphname.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
				  'LIBELLE' => $lang["ocs_syncok"],
				));
			}
			else
			{
				$template->assign_block_vars('form.periphname.valid', array(
				  'ONCLICK' => 'document.form.nom.value=\''.$pname.'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}
			
			
			$template->assign_block_vars('form.periphname.ocs', array(
			  'VALUE' => $pname,
			));
		}
		else
		{
			$template->assign_block_vars('form.periphname', array(
			  'TITLE' => $lang["adm_periph_name"],
			  'KEYUP' => 'verifLong(this);',
			  'VALUE' => $nom,
			  'ID' => 'ok',
			));
		}
		
		
		// Num�ro de s�rie
		if (isset($col_serial[$type_periph]))
			$serial_ocs = txt_to_na(utf8_decode($tab_ocs[0][$col_serial[$type_periph]]));
		else
			$serial_ocs = txt_to_na('');
			
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["periph_serial"],
		  'VALUE' => $num_serie,
		));

		if (strtoupper($num_serie) == strtoupper($serial_ocs))
		{
			$template->assign_block_vars('form.serial.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			$template->assign_block_vars('form.serial.valid', array(
			  'ONCLICK' => 'document.form.num_serie.value=\''.$serial_ocs.'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			  'LIBELLE' => $lang["ocs_syncnok"],
			));
		}

		$template->assign_block_vars('form.serial.ocs', array(
		  'VALUE' => $serial_ocs,
		));
		
		// Type de mat�riel 
		if (isset($col_type[$type_periph]))
			$type_ocs = txt_to_na(utf8_decode($tab_ocs[0][$col_type[$type_periph]]));
		else
			$type_ocs = txt_to_na('');

		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_TYPE." ORDER BY libelle");
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["periph_type"],
		));

		$template->assign_block_vars('form.type.ocs', array(
		  'VALUE' => $type_ocs,
		));
		
		$i = -1;
		$type_exist = $type_ok = 0;
		
		if (strtoupper($type_libelle) == strtoupper($type_ocs))
			$type_ok = 1;

		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $type)
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}

			if (strtoupper($tab[$i]["libelle"]) == strtoupper($type_ocs))
				$type_exist++;
			$i++;
		}

		if ($type_ok > 0)
		{
			$template->assign_block_vars('form.type.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ($type_exist > 0)
			{
				$template->assign_block_vars('form.type.valid', array(
				  'ONCLICK' => 'ChangeListe(document.form.type,\''.$type_ocs.'\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($type_exist == 0 && (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.type.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_type&amp;action=Ajouter&valeur='.$type_ocs,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.type.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}

		// Marque du mat�riel
		if (isset($col_type[$type_periph]))
			$marque_ocs = txt_to_na(utf8_decode($tab_ocs[0][$col_marque[$type_periph]]));
		else
			$marque_ocs = txt_to_na('');
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["periph_marque"],
		  'ONCLICK' => 'getDynliste(this.value,\'periph_modele\'); if (document.images[\'imglink_marque\']) { document.images[\'imglink_marque\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' };  if (document.images[\'imglink_modele\']) { document.images[\'imglink_modele\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' };',
		));

		$template->assign_block_vars('form.marque.ocs', array(
		  'VALUE' => $marque_ocs,
		));

		$marque_exist = $marque_ok = 0;
		
		if (strtoupper($marque_libelle) == strtoupper($marque_ocs))
			$marque_ok = 1;
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $marque)
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($marque_ocs))
				$marque_exist = $tab[$i]["id"];

			$i++;
		}

		if ($marque_ok > 0)
		{
			$template->assign_block_vars('form.marque.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ($marque_exist > 0)
			{
				$template->assign_block_vars('form.marque.valid', array(
				  'ONCLICK' => 'ChangeListe(document.form.marque,\''.$marque_ocs.'\'); getDynliste(document.form.marque.value,\'periph_modele\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($marque_exist == 0 && (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.marque.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_marque&amp;action=Ajouter&amp;valeur='.$marque_ocs,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.marque.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}
		
		// Mod�le du mat�riel
		if (isset($col_type[$type_periph]))
			$modele_ocs = txt_to_na(utf8_decode($tab_ocs[0][$col_modele[$type_periph]]));
		else
			$modele_ocs = txt_to_na('');

		if ($marque < 1)
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MODELE." ORDER BY ".PE_MO_LIBELLE);
		else
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MODELE." WHERE ".PE_MO_MARQUEID."='".$marque."' ORDER BY ".PE_MO_LIBELLE);
					
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["periph_modele"],
		));

		$template->assign_block_vars('form.modele.ocs', array(
		  'VALUE' => $modele_ocs,
		));
		
		$i = -1;

		$modele_exist = $modele_ok = 0;
		
		if (strtoupper($modele_libelle) == strtoupper($modele_ocs))
			$modele_ok = 1;

		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $modele)
			{
				$template->assign_block_vars('form.modele.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.modele.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($modele_ocs))
				$modele_exist++;

			$i++;
		}

		if ($modele_ok > 0)
		{
			$template->assign_block_vars('form.modele.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ($modele_exist > 0)
			{
				$template->assign_block_vars('form.modele.valid', array(
				  'ONCLICK' => 'ChangeListe(document.form.modele,\''.$modele_ocs.'\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($modele_exist == 0 && (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.modele.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_modele&amp;action=Ajouter&amp;valeur='.$modele_ocs.'&amp;parent='.$marque_exist,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.modele.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}

		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["place_3"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
			
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
			while ($i < count($tab)-1)
			{
				if ($_GET["agence_id"] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected',
					));
				}
				else
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					));
				}
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'AGENCE_ID' => $_GET["agence_id"]
			));	
		}
		
		// Mat�riel li�
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET['agence_id']."' ORDER BY nom");

		$template->assign_block_vars('form.linkhard', array(
		  'TITLE' => $lang["periph_hardlink"],
		));

		$template->assign_block_vars('form.linkhard.ocs', array(
		  'VALUE' => $tab_ocs[0][TAB_OCS_HARD.'.'.COL_OCS_HARD_NAME],
		));
		
		$i = -1;
		
		$hard_exist = $hard_ok = 0;
		
		if (strtoupper($hard_crit) == strtoupper($tab_ocs[0][constant("OCS_CRIT_OCS".$_GET["agence_id"])]))
			$hard_ok = 1;
			
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"], constant("OCS_CRIT_BASE".$_GET["agence_id"]) => $lang["none"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i][constant("OCS_CRIT_BASE".$_GET["agence_id"])]) == strtoupper($hard_crit))
			{
				$template->assign_block_vars('form.linkhard.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['nom'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.linkhard.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['nom']
				));
			}
			
			if (strtoupper($tab[$i][constant("OCS_CRIT_BASE".$_GET["agence_id"])]) == strtoupper($tab_ocs[0][constant("OCS_CRIT_OCS".$_GET["agence_id"])]))
				$hard_exist = 1;
				
			$i++;
		}

		if ($hard_ok > 0)
		{
			$template->assign_block_vars('form.linkhard.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ($hard_exist > 0)
			{
				$template->assign_block_vars('form.linkhard.valid', array(
				  'ONCLICK' => 'ChangeListe(document.form.hard,\''.utf8_decode($tab_ocs[0][TAB_OCS_HARD.'.'.COL_OCS_HARD_NAME]).'\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($hard_exist == 0 && (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.linkhard.action', array(
				  'LINK' => 'index.php?page=adm_materiels.php&amp;action=add_ocs&amp;agence_id='.$_GET["agence_id"].'&amp;ocs_id='.$tab_ocs[0][$table[$type_periph].".".$table_hardid[$type_periph]],
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add_ocs.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.linkhard.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}
		
		// R�servable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_periph_reserv"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0), 'checked' => array('','checked'));
		$i =0;
		while ($i < count($options["libelle"]))
		{
			if ($options['value'][$i] == $reservable)
			{
				$template->assign_block_vars('form.reservable.list', array(
				  'VALUE' => $options['value'][$i],
				  'LIBELLE' => $options['libelle'][$i],
				  'CHECKED' => 'checked'
				));
			}
			else
			{
				$template->assign_block_vars('form.reservable.list', array(
				  'VALUE' => $options['value'][$i],
				  'LIBELLE' => $options['libelle'][$i],
				));
			}
			$i++;
		}

		// Date de cr�ation
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_periph_creationdate"],
		  'VALUE' => date("d-m-Y").' ',
		  'DISABLED' => 'readonly',
		  'VALUE' => $creation_date,
		));
		
		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $commentaire,
		));
		
		if (strtoupper($commentaire) == strtoupper(utf8_decode($tab_ocs[0][$col_desc[$type_periph]])))
		{
			$template->assign_block_vars('form.comment.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			$template->assign_block_vars('form.comment.valid', array(
			  'ONCLICK' => 'document.form.commentaire.value=\''.utf8_decode($tab_ocs[0][$col_desc[$type_periph]]).'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			  'LIBELLE' => $lang["ocs_syncnok"],
			));
		}

		$template->assign_block_vars('form.comment.ocs', array(
		  'VALUE' => utf8_decode($tab_ocs[0][$col_desc[$type_periph]]),
		));

		// Colonnes perso
		$pfieldColumns = get_periph_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'VALUE' => $main_tab[0][TAB_PERIPH . "." . $fieldName],
			  'TITLE' => $lang["s_" . TAB_PERIPH . "." . $fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["edit"],
		));
		
		
		// Legende
		$template->assign_block_vars('form.key', array(
		  'TEMPLATE_DIR' => 'templates/'.DEFAULT_TEMPLATE.'/',
		  'L_TITLE' => $lang["gen_legende"],
		  'L_OK' => $lang["ocs_legendeok"],
		  'L_TRANS' => $lang["ocs_legendetrans"],
		  'L_ADD' => $lang["ocs_legendeadd"],
		  'L_ADD_OCS' => $lang["ocs_legendeaddocs"],
		  'L_USER' => $lang["ocs_legendeuser"],
		  'L_FORBID' => $lang["ocs_legendeforbid"],
		 ));	

	}
	// Copier
	elseif (isset($_GET['action']) && $_GET['action'] == 'copy')
	{
		$requete = "SELECT * FROM ".TAB_PERIPH." WHERE id='".$_GET["p_id"]."'";
		$main_tab = $req1->db_use_query($requete);

		$nom = $main_tab[0]["nom"];
		$num_serie = $main_tab[0]["num_serie"];
		$agence = $main_tab[0]["agence_id"];
		$type = $main_tab[0]["type_id"];
		$marque = $main_tab[0]["marque_id"];
		$modele = $main_tab[0]["modele_id"];
		$hard = $main_tab[0]["hard_id"];
		$reservable = $main_tab[0]["reservable"];
		$commentaire = $main_tab[0]["commentaire"];

		if (!empty($main_tab[0]["creation_date"]) && $main_tab[0]["creation_date"] != '0000-00-00') {
    		$timestamp = strtotime((string)$main_tab[0]["creation_date"]);
    
    		// On vérifie si strtotime a bien réussi à convertir la date
    		if ($timestamp !== false) {
        		$creation_date = date("d-m-Y", $timestamp) . ' ';
    		} else {
        		// Si la date en BDD est bizarre (ex: 0000-00-00), on met la date du jour
        		$creation_date = date("d-m-Y") . ' ';
    		}
		} else {
    		$creation_date = date("d-m-Y") . ' ';
		}

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_periph_title_copy"],
		  'ACTION' => 'index.php?page=adm_peripheriques.php&amp;action=add',
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));

		$template->assign_block_vars('form.periphname', array(
		  'TITLE' => $lang["adm_periph_name"],
		  'KEYUP' => 'verifLong(this);',
		  'VALUE' => $nom,
		  'ID' => 'ok',
		));
		
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["periph_serial"],
		  'VALUE' => $num_serie,
		));
		
		// Type de mat�riel 
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_TYPE." ORDER BY libelle");
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["periph_type"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $type)
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Marque du mat�riel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["periph_marque"],
		  'ONCLICK' => 'getDynliste(this.value,\'periph_modele\');',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $marque)
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}
		
		// Mod�le du mat�riel
		if ($marque < 1)
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MODELE." ORDER BY ".PE_MO_LIBELLE);
		else
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_PERIPH_MODELE." WHERE ".PE_MO_MARQUEID."='".$marque."' ORDER BY ".PE_MO_LIBELLE);
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["periph_modele"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $modele)
			{
				$template->assign_block_vars('form.modele.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.modele.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["place_3"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
			
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
			while ($i < count($tab)-1)
			{
				if ($_GET["agence_id"] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected',
					));
				}
				else
				{
					$template->assign_block_vars('form.multisite.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					));
				}
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'AGENCE_ID' => $_GET["agence_id"]
			));	
		}
		
		// Mat�riel li�
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE agence_id='".$_GET['agence_id']."' ORDER BY nom");

		$template->assign_block_vars('form.linkhard', array(
		  'TITLE' => $lang["periph_hardlink"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $hard)
			{
				$template->assign_block_vars('form.linkhard.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['nom'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.linkhard.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['nom']
				));
			}
			$i++;
		}
		
		// R�servable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_periph_reserv"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0), 'checked' => array('','checked'));
		$i =0;
		while ($i < count($options["libelle"]))
		{
			if ($options['value'][$i] == $reservable)
			{
				$template->assign_block_vars('form.reservable.list', array(
				  'VALUE' => $options['value'][$i],
				  'LIBELLE' => $options['libelle'][$i],
				  'CHECKED' => 'checked'
				));
			}
			else
			{
				$template->assign_block_vars('form.reservable.list', array(
				  'VALUE' => $options['value'][$i],
				  'LIBELLE' => $options['libelle'][$i],
				));
			}
			$i++;
		}

		// Date de cr�ation
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_periph_creationdate"],
		  'VALUE' => date("d-m-Y").' ',
		  'DISABLED' => 'readonly',
		  'VALUE' => $creation_date,
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $commentaire,
		));

		// Colonnes perso
		$pfieldColumns = get_periph_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'VALUE' => $main_tab[0][$fieldName],
			  'TITLE' => $lang["s_" . TAB_PERIPH . "." . $fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));
		
		
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_type&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.marque.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_marque&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.modele.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=periph_modele&amp;action=Ajouter&amp;parent='.$marque,
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));
	}
	//Rebus
 	elseif (isset($_GET['action']) && $_GET['action'] == 'rebus')
	{
		$requete = "SELECT * FROM ".TAB_PERIPH." WHERE id='".$_GET["p_id"]."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_periph_title_rebus"],
		  'ACTION' => 'index.php?page=adm_peripheriques.php&amp;action=rebus&amp;p_id='.$_GET['p_id'],
		));
		
		$template->assign_block_vars('form.periphname', array(
		  'TITLE' => $lang["adm_periph_name"],
		  'VALUE' => $tab[0]["nom"],
		  'DISABLED' => 'disabled',
		));
		
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["periph_serial"],
		  'VALUE' => $tab[0]["num_serie"],
		  'DISABLED' => 'disabled',
		));
		
		// Suivi rebus
		$template->assign_block_vars('form.suivi_rebus', array(
		  'TITLE' => $lang["adm_periph_rebus"],
		  'VALUE' => $tab[0]["suivi_rebus"],
		));
		
		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["gen_send"],
		));
	}
	// Ajout d'une liaison 
 	elseif (isset($_GET['action']) && $_GET['action'] == 'add_elmt')
	{
		$requete = "SELECT ".TAB_PERIPH.".*,
		".TAB_PERIPH_TYPE.".libelle AS l_type,
		".TAB_PERIPH_MARQUE.".libelle AS l_marque,
		".TAB_PERIPH_MODELE.".libelle AS l_modele
		FROM ".TAB_PERIPH." 
		  LEFT JOIN ".TAB_PERIPH_TYPE." ON ".TAB_PERIPH_TYPE.".id = ".TAB_PERIPH.".type_id
		  LEFT JOIN ".TAB_PERIPH_MARQUE." ON ".TAB_PERIPH_MARQUE.".id = ".TAB_PERIPH.".marque_id
		  LEFT JOIN ".TAB_PERIPH_MODELE." ON ".TAB_PERIPH_MODELE.".id = ".TAB_PERIPH.".modele_id
		WHERE ".TAB_PERIPH.".agence_id='".$_GET["agence_id"]."' AND ".TAB_PERIPH.".hard_id='0'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('addlink', array(
		  'L_TITLE' => $lang["adm_periph_title_addelmt"],
		  'ACTION' => 'index.php?page=adm_peripheriques.php&action=add_elmt&h_id='.$_GET['h_id'],
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));

			if (count($tab) > 0)
			{
				$template->assign_block_vars('addlink.periph', array(
				  'TITLE' => $lang["adm_periph_periph"],
				));
				
				$i = 0;
				while ($i < count($tab))
				{
					$template->assign_block_vars('addlink.periph.list', array(
					  'LIBELLE' => $tab[$i]['l_type'].' ('.$tab[$i]['l_marque'].' '.$tab[$i]['l_modele'].') - '.$tab[$i]['num_serie'],
					  'ID' => $tab[$i]['id'],
					));

					$i++;
				}
				
				$template->assign_block_vars('addlink.button', array(
				  'TITLE' => $lang["gen_send"],
				));
			}
			else
			{
				$template->assign_block_vars('addlink.no_link', array(
				  'TEXT' => $lang["adm_periph_noperiph"],
				));
			}
	}
	// Suppression
 	elseif (isset($_GET['action']) && $_GET['action'] == 'supprimer')
	{
		$requete = "SELECT * FROM ".TAB_PERIPH." WHERE id='".$_GET["p_id"]."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_periph_title_del"],
		  'ACTION' => 'index.php?page=adm_peripheriques.php&amp;action=supprimer&amp;p_id='.$_GET['p_id'],
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));
		
		$template->assign_block_vars('form.periphname', array(
		  'TITLE' => $lang["adm_periph_name"],
		  'VALUE' => $tab[0]["nom"],
		  'DISABLED' => 'disabled',
		));
		
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["periph_serial"],
		  'VALUE' => txt_to_na($tab[0]["num_serie"]),
		  'DISABLED' => 'disabled',
		));
				
		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["delete"],
		));
	}
}

echo $affichage;

?>