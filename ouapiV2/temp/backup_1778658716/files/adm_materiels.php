<?php

declare(strict_types=1);

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use;
$affichage = '';

function get_hard_pfield_columns($db): array
{
    if (!isset($db->connection) || $db->connection === null) {
        $db->connection();
    }

    $columns = [];
    $query = "SHOW COLUMNS FROM " . TAB_HARD . " LIKE 'pfield_%'";
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

/*********************************************************************************************/
/*                               TRAITEMENT DU FORMULAIRE                                             */
/*********************************************************************************************/

if (isset($_POST['soumettre']))
{
	// Mise au rebus
	if (isset($_GET['action']) && $_GET['action'] == 'rebus')
	{
		$h_id = $_GET['h_id'];
		$suivi = format_text_db($_POST['suivi']);
		
		$requete = "UPDATE ".TAB_HARD." SET suivi_rebus='$suivi' WHERE id='$h_id'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["return_update_ok"], 					
			'CLOSE' => $lang["close"]			
		));
	}
	// Supprimer
	elseif (isset($_GET['action']) && $_GET['action'] == 'supprimer')
	{
		$h_id = $_GET['h_id'];
		
		$requete = "DELETE FROM ".TAB_HARD." WHERE id='$h_id'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_HARDSOFT." WHERE hardware_id='$h_id'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_RESA." WHERE hard_id='$h_id'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_RESEAU." WHERE hardware_id='$h_id'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_LIAISON_DOCS." WHERE hardware_id='$h_id'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_hard_del"], 					
			'CLOSE' => $lang["close"]			
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
		$os = $_POST['os'];
		$cpu = $_POST['cpu'];
		$ram_capacite = isset($_POST['ram_capacite']) ? intval($_POST['ram_capacite']) : 0;
		$ram_type = $_POST['ram_type'];
		$disque_capacite = isset($_POST['disque_capacite']) ? intval($_POST['disque_capacite']) : 0;
		$disque_type = $_POST['disque_type'];
		$user = $_POST['user'];
		$emplacement = $_POST['emplacement'];
		$ip = format_string_db($_POST['ip']);
		$reservable = $_POST['reservable'];
		$commentaire = format_text_db($_POST['commentaire']);
		
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
			
		/*************** Ajout **************/
		if (isset($_GET['action']) && $_GET['action'] == 'Ajouter')
		{
			// Colonnes perso
			$pfields_names = '';
			$pfields_values = '';
			
			$pfieldsColumns = get_hard_pfield_columns($req1);

			foreach ($pfieldsColumns as $fieldName) {
				$pfields_names .= ',' . $fieldName;
				$pfields_values .= ",'" . format_string_db($_POST[$fieldName]) . "'";
			}
			
			$requete = "INSERT INTO ".TAB_HARD." (nom,num_serie,type_id,marque_id,modele_id,os_id,cpu_id,ram_capacite,ram_type_id,disque_capacite,disque_type_id,user_id,agence_id,emplacement_id,ip,reservable,commentaire,suivi_rebus,creation_date".$pfields_names.")
				VALUES ('".$nom."','".$num_serie."','".$type."','".$marque."','".$modele."','".$os."','".$cpu."','".$ram_capacite."','".$ram_type."','".$disque_capacite."','".$disque_type."','".$user."','".$agence_id."','".$emplacement."','".$ip."','".$reservable."','".$commentaire."','','".$date."'".$pfields_values.")";

			$tab = $req1->db_use_query($requete);

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_hard_add"], 					
				'CLOSE' => $lang["close"]			
			));
		}
		/***************** Edition ****************/
		elseif (isset($_GET['action']) && $_GET['action'] == 'editer')
		{
			$h_id = $_GET['h_id'];

			// Colonnes perso
			$pfields_update = '';
			
			$pfieldsColumns = get_hard_pfield_columns($req1);

			foreach ($pfieldsColumns as $fieldName) {
				$pfields_update .= "," . $fieldName . "='" . format_string_db($_POST[$fieldName]) . "'";
			}
			
			$requete = "UPDATE ".TAB_HARD." SET nom='$nom',num_serie='$num_serie',type_id='$type',marque_id='$marque',
			modele_id='$modele',os_id='$os',cpu_id='$cpu',ram_capacite='$ram_capacite',ram_type_id='$ram_type',disque_capacite='$disque_capacite',disque_type_id='$disque_type',user_id='$user',agence_id='$agence_id',emplacement_id='$emplacement',ip='$ip',reservable='$reservable',commentaire='$commentaire',creation_date='$date'".$pfields_update." WHERE id='$h_id'";
			$tab = $req1->db_use_query($requete);
			
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["return_change_ok"],
				'CLOSE' => $lang["close"]			
			));
		}
	}

}
/*********************************************************************************************/
/*                                             FORMULAIRE                                                        */
/*********************************************************************************************/
else
{
	$bouton = '';
	
	/****************************/
	/*            Ajouter             */
	/****************************/
	if (isset($_GET['action']) && $_GET['action'] == 'Ajouter')
	{
		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_hard_title_add"],
		  'ACTION' => 'index.php?page=adm_materiels.php&amp;action=Ajouter',
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));

		$template->assign_block_vars('form.hardname', array(
		  'TITLE' => $lang["adm_hard_hardname"],
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'required',
		));
		
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["serial"],
		));

		// Type de matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_TYPE." ORDER BY libelle");
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_hard_type"],
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

		// Marque du matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MARQUE." ORDER BY libelle");
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_hard_marque"],
		  'ONCHANGE' => 'getDynliste(this.value,\'hard_modele\');',
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

		// Modèle du matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." ORDER BY libelle");
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["adm_hard_modele"],
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

		// OS
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_OS." ORDER BY libelle");

		$template->assign_block_vars('form.os', array(
		  'TITLE' => $lang["adm_hard_os"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.os.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));
			$i++;
		}

		// CPU
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_REF_CPU." ORDER BY libelle");

		$template->assign_block_vars('form.cpu', array(
		  'TITLE' => $lang["adm_hard_cpu"] ?? 'Processeur',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.cpu.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));
			$i++;
		}

		// RAM Capacite
		$template->assign_block_vars('form.ram_capacite', array(
		  'TITLE' => $lang["adm_hard_ram_capacite"] ?? 'Capacité RAM (Go)',
		));

		// RAM Type
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_REF_RAM_TYPE." ORDER BY libelle");

		$template->assign_block_vars('form.ram_type', array(
		  'TITLE' => $lang["adm_hard_ram_type"] ?? 'Type RAM',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.ram_type.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));
			$i++;
		}

		// Disque Capacite
		$template->assign_block_vars('form.disque_capacite', array(
		  'TITLE' => $lang["adm_hard_disque_capacite"] ?? 'Capacité Disque (Go)',
		));

		// Disque Type
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_REF_DISQUE_TYPE." ORDER BY libelle");

		$template->assign_block_vars('form.disque_type', array(
		  'TITLE' => $lang["adm_hard_disque_type"] ?? 'Type Disque',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.disque_type.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));
			$i++;
		}

		// Utilisateur
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE (agence_id='".$_GET['agence_id']."' || agence_id='0') ORDER BY nom,prenom");

		$template->assign_block_vars('form.user', array(
		  'TITLE' => $lang["adm_hard_user"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"], 'login_win' => '');
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.user.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
			));
			$i++;
		}

		// Emplacement
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET['agence_id']."' ORDER BY libelle");

		$template->assign_block_vars('form.emplacement', array(
		  'TITLE' => $lang["adm_hard_place"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.emplacement.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));
			$i++;
		}

		$template->assign_block_vars('form.ip', array(
		  'TITLE' => $lang["adm_hard_ipaddr"],
		));

		// Réservable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_hard_reserv"],
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

		// Installation date / datepicker
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_hard_creationdate"],
		  'VALUE' => date("d-m-Y").' ',
		  'DISABLED' => 'readonly',
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		));

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));

		// Champs perso
		$pfieldsColumns = get_hard_pfield_columns($req1);

		foreach ($pfieldsColumns as $fieldName) {
			if (isset($lang["s_".TAB_HARD.".". $fieldName])) {
				$displayTitle = $lang["s_".TAB_HARD.".". $fieldName];
			} else {
				$cleanName = str_replace('pfield_', '', $fieldName);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $displayTitle,
			));
		}

		
		// BOUTONS
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
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_modele&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.os.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_os&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_type&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if (preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.user.action', array(
			  'LINK' => 'index.php?page=adm_utilisateurs.php&amp;agence_id='.$_GET["agence_id"].'&amp;action=add',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}		
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.emplacement.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=empl&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&amp;slct_site=1',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.cpu.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=ref_cpu&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.ram_type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=ref_ram_type&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.disque_type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=ref_disque_type&amp;action=Ajouter',
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
	/****************************/
	/*            Editer               */
	/****************************/
	elseif (isset($_GET['action']) && $_GET['action'] == 'editer')
	{
		$main_tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE ".HA_ID."='".$_GET["h_id"]."'");
		
		if ($main_tab[0]["creation_date"] != '')
			$creation_date = date("d-m-Y",(int)$main_tab[0]["creation_date"]).' ';
		else
			$creation_date = date("d-m-Y").' ';
		
		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_hard_title_edit"],
		  'ACTION' => 'index.php?page=adm_materiels.php&amp;action=editer&amp;h_id='.$_GET['h_id'],
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));

		$template->assign_block_vars('form.hardname', array(
		  'TITLE' => $lang["adm_hard_hardname"],
		  'VALUE' => $main_tab[0]["nom"],
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'ok',
		));
		
		// Numéro de série
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["serial"],
		  'VALUE' => $main_tab[0]["num_serie"],
		));

		// Type de matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_TYPE." ORDER BY libelle");
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_hard_type"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["type_id"])
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

		// Marque du matériel
		$tab_marque = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MARQUE." ORDER BY ".HA_MA_LIBELLE);
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_hard_marque"],
		  'ONCHANGE' => 'getDynliste(this.value,\'hard_modele\');',
		));
		
		$i = -1;
		$tab_marque[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab_marque)-1)
		{
			if ($tab_marque[$i]["id"] == $main_tab[0]["marque_id"])
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab_marque[$i]['id'],
				  'LIBELLE' => $tab_marque[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab_marque[$i]['id'],
				  'LIBELLE' => $tab_marque[$i]['libelle']
				));
			}
			$i++;
		}

		// Modèle du matériel
		if ($main_tab[0]["marque_id"] < 1)
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." ORDER BY ".HA_MO_LIBELLE);
		else
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." WHERE ".HA_MO_MAQUEID."='".$main_tab[0]["marque_id"]."' ORDER BY ".HA_MO_LIBELLE);
				
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["adm_hard_modele"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["modele_id"])
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
				if ($main_tab[0]["agence_id"] == $tab[$i]['id'])
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

		// OS
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_OS." ORDER BY libelle");

		$template->assign_block_vars('form.os', array(
		  'TITLE' => $lang["adm_hard_os"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["os_id"])
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// CPU
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_REF_CPU." ORDER BY libelle");

		$template->assign_block_vars('form.cpu', array(
		  'TITLE' => $lang["adm_hard_cpu"] ?? 'Processeur',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["cpu_id"])
			{
				$template->assign_block_vars('form.cpu.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.cpu.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// RAM Capacite
		$template->assign_block_vars('form.ram_capacite', array(
		  'TITLE' => $lang["adm_hard_ram_capacite"] ?? 'Capacité RAM (Go)',
		  'VALUE' => $main_tab[0]["ram_capacite"],
		));

		// RAM Type
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_REF_RAM_TYPE." ORDER BY libelle");

		$template->assign_block_vars('form.ram_type', array(
		  'TITLE' => $lang["adm_hard_ram_type"] ?? 'Type RAM',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["ram_type_id"])
			{
				$template->assign_block_vars('form.ram_type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.ram_type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Disque Capacite
		$template->assign_block_vars('form.disque_capacite', array(
		  'TITLE' => $lang["adm_hard_disque_capacite"] ?? 'Capacité Disque (Go)',
		  'VALUE' => $main_tab[0]["disque_capacite"],
		));

		// Disque Type
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_REF_DISQUE_TYPE." ORDER BY libelle");

		$template->assign_block_vars('form.disque_type', array(
		  'TITLE' => $lang["adm_hard_disque_type"] ?? 'Type Disque',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["disque_type_id"])
			{
				$template->assign_block_vars('form.disque_type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.disque_type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Utilisateur
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE (agence_id='".$_GET['agence_id']."' || agence_id='0') ORDER BY nom,prenom");

		$template->assign_block_vars('form.user', array(
		  'TITLE' => $lang["adm_hard_user"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"], 'login_win' => '');
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["user_id"])
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				));
			}
			$i++;
		}

		// Emplacement
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET['agence_id']."' ORDER BY libelle");

		$template->assign_block_vars('form.emplacement', array(
		  'TITLE' => $lang["adm_hard_place"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["emplacement_id"])
			{
				$template->assign_block_vars('form.emplacement.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.emplacement.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		$template->assign_block_vars('form.ip', array(
		  'TITLE' => $lang["adm_hard_ipaddr"],
		  'VALUE' => $main_tab[0]["ip"],
		));

		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_hard_reserv"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0));
		$i =0;
		while ($i < count($options["libelle"]))
		{
			if ($options['value'][$i] == $main_tab[0]["reservable"])
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

		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_hard_creationdate"],
		  'VALUE' => $creation_date,
		  'DISABLED' => 'readonly',
		));


		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $main_tab[0]["commentaire"],
		));

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["edit"],
		));

		// Colonnes perso
		$pfieldsColumns = get_hard_pfield_columns($req1);

		foreach ($pfieldsColumns as $fieldName) {
			if (isset($lang["s_".TAB_HARD.".". $fieldName])) {
				$displayTitle = $lang["s_".TAB_HARD.".". $fieldName];
			} else {
				$cleanName = str_replace('pfield_', '', $fieldName);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'VALUE' => $main_tab[0][$fieldName],
			  'TITLE' => $displayTitle,
			));
		}

		
		/******* BOUTONS *********/
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.marque.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_marque&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.modele.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_modele&action=Ajouter&parent='.$main_tab[0]["marque_id"],
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.os.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_os&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_type&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if (preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.user.action', array(
			  'LINK' => 'index.php?page=adm_utilisateurs.php&agence_id='.$_GET["agence_id"].'&action=add',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}		
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.emplacement.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=empl&agence_id='.$_GET["agence_id"].'&action=Ajouter&slct_site=1',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.cpu.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=ref_cpu&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.ram_type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=ref_ram_type&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.disque_type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=ref_disque_type&action=Ajouter',
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
	/***********************************/
	/*              Copier             */
	/***********************************/
	elseif (isset($_GET['action']) && $_GET['action'] == 'copy')
	{
		$main_tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE id='".$_GET["h_id"]."'");

		$ip = $main_tab[0]["ip"];
		$reservable = $main_tab[0]["reservable"];
		$commentaire = $main_tab[0]["commentaire"];
		
		if ($main_tab[0]["creation_date"] != '')
			$creation_date = date("d-m-Y",(int)$main_tab[0]["creation_date"]).' ';
		else
			$creation_date = date("d-m-Y").' ';
		
		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_hard_title_copy"],
		  'ACTION' => 'index.php?page=adm_materiels.php&action=Ajouter',
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));

		$template->assign_block_vars('form.hardname', array(
		  'TITLE' => $lang["adm_hard_hardname"],
		  'VALUE' => $main_tab[0]["nom"],
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'ok',
		));
		
		// Numéro de série
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["serial"],
		  'VALUE' => $main_tab[0]["num_serie"],
		));

		// Type de matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_TYPE." ORDER BY libelle");
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_hard_type"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["type_id"])
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

		// Marque du matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_hard_marque"],
		  'ONCHANGE' => 'getDynliste(this.value,\'hard_modele\');',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["marque_id"])
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

		// Modèle du matériel
		if ($main_tab[0]["marque_id"] < 1)
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." ORDER BY ".HA_MO_LIBELLE);
		else
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." WHERE ".HA_MO_MAQUEID."='".$main_tab[0]["marque_id"]."' ORDER BY ".HA_MO_LIBELLE);
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["adm_hard_modele"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["modele_id"])
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
				if ($main_tab[0]["agence_id"] == $tab[$i]['id'])
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

		// OS
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_OS." ORDER BY libelle");

		$template->assign_block_vars('form.os', array(
		  'TITLE' => $lang["adm_hard_os"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["os_id"])
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// CPU
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_REF_CPU." ORDER BY libelle");

		$template->assign_block_vars('form.cpu', array(
		  'TITLE' => $lang["adm_hard_cpu"] ?? 'Processeur',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["cpu_id"])
			{
				$template->assign_block_vars('form.cpu.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.cpu.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// RAM Capacite
		$template->assign_block_vars('form.ram_capacite', array(
		  'TITLE' => $lang["adm_hard_ram_capacite"] ?? 'Capacité RAM (Go)',
		  'VALUE' => $main_tab[0]["ram_capacite"],
		));

		// RAM Type
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_REF_RAM_TYPE." ORDER BY libelle");

		$template->assign_block_vars('form.ram_type', array(
		  'TITLE' => $lang["adm_hard_ram_type"] ?? 'Type RAM',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["ram_type_id"])
			{
				$template->assign_block_vars('form.ram_type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.ram_type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Disque Capacite
		$template->assign_block_vars('form.disque_capacite', array(
		  'TITLE' => $lang["adm_hard_disque_capacite"] ?? 'Capacité Disque (Go)',
		  'VALUE' => $main_tab[0]["disque_capacite"],
		));

		// Disque Type
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_REF_DISQUE_TYPE." ORDER BY libelle");

		$template->assign_block_vars('form.disque_type', array(
		  'TITLE' => $lang["adm_hard_disque_type"] ?? 'Type Disque',
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["disque_type_id"])
			{
				$template->assign_block_vars('form.disque_type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.disque_type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Utilisateur
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE (agence_id='".$_GET['agence_id']."' || agence_id='0') ORDER BY nom,prenom");

		$template->assign_block_vars('form.user', array(
		  'TITLE' => $lang["adm_hard_user"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"], 'login_win' => '');
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["user_id"])
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				));
			}
			$i++;
		}

		// Emplacement
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET['agence_id']."' ORDER BY libelle");

		$template->assign_block_vars('form.emplacement', array(
		  'TITLE' => $lang["adm_hard_place"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $main_tab[0]["emplacement_id"])
			{
				$template->assign_block_vars('form.emplacement.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.emplacement.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Adresse IP
		$template->assign_block_vars('form.ip', array(
		  'TITLE' => $lang["adm_hard_ipaddr"],
		  'VALUE' => $ip,
		));

		// Réservable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_hard_reserv"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0));
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

		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_hard_creationdate"],
		  'VALUE' => $creation_date,
		  'DISABLED' => 'readonly',
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $main_tab[0]["commentaire"],
		));

		// Colonnes perso
		$pfieldsColumns = get_hard_pfield_columns($req1);

		foreach ($pfieldsColumns as $fieldName) {
			if (isset($lang["s_".TAB_HARD.".". $fieldName])) {
				$displayTitle = $lang["s_".TAB_HARD.".". $fieldName];
			} else {
				$cleanName = str_replace('pfield_', '', $fieldName);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'VALUE' => $main_tab[0][$fieldName],
			  'TITLE' => $displayTitle,
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));

		/************ BOUTONS *************/
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.marque.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_marque&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.modele.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_modele&action=Ajouter&parent='.$main_tab[0]["marque_id"],
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.os.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_os&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_type&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if (preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.user.action', array(
			  'LINK' => 'index.php?page=adm_utilisateurs.php&agence_id='.$_GET["agence_id"].'&action=add',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}		
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.emplacement.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=empl&agence_id='.$_GET["agence_id"].'&action=Ajouter&slct_site=1',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.cpu.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=ref_cpu&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.ram_type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=ref_ram_type&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.disque_type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=ref_disque_type&action=Ajouter',
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
	/****************************/
	/*       Ajouter par OCS     */
	/****************************/
	if (isset($_GET['action']) && $_GET['action'] == 'add_ocs')
	{
		// Connexion à la base OCS
		$connect_ocs = new db_connect();
		$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

		$tab_ocs = $req1->db_use_query("SELECT * FROM ".TAB_OCS_HARD." WHERE ".COL_OCS_HARD_ID."='".$_GET["ocs_id"]."'");	
		$nom = $tab_ocs[0][COL_OCS_HARD_NAME];
		$ip = $tab_ocs[0][COL_OCS_IPADDR];
				
		$tab_bios = $req1->db_use_query("SELECT * FROM ".TAB_OCS_BIOS." WHERE ".COL_OCS_BIOS_HARDID."='".$_GET["ocs_id"]."'");	
		$num_serie = $tab_bios[0][COL_OCS_BIOS_SNUM];

		$connect->connection();

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_hard_title_add"],
		  'ACTION' => 'index.php?page=adm_materiels.php&amp;action=Ajouter',
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));
		
		$template->assign_block_vars('form.source_head', array(
		  'L_BASEINFO' => $lang["adm_hard_baseinfo"],
		  'L_OCSINFO' => $lang["adm_hard_ocsinfo"],
		));

		$template->assign_block_vars('form.hardname', array(
		  'TITLE' => $lang["adm_hard_hardname"],
		  'VALUE' => $nom,
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'ok',
		));

		$template->assign_block_vars('form.hardname.ocs', array(
		  'VALUE' => $nom,
		));

		// Numéro de série
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["serial"],
		  'VALUE' => $num_serie,
		));

		$template->assign_block_vars('form.serial.ocs', array(
		  'VALUE' => $num_serie,
		));

		// Type de matériel
		$alias = array('NOTEBOOK', 'DESKTOP', 'LOW PROFILE DESKTOP', 'MINI TOWER'); 
		$alias_id = array(2,1,1,1); 
		
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_TYPE." ORDER BY libelle");
		
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_hard_type"],
		));

		$template->assign_block_vars('form.type.ocs', array(
		  'VALUE' => $tab_bios[0][COL_OCS_BIOS_TYPE],
		));
		
		$i = -1;
		$type_exist = 0;
		$alias_exist = array_search(strtoupper($tab_bios[0][COL_OCS_BIOS_TYPE]),$alias);
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($tab_bios[0][COL_OCS_BIOS_TYPE]))
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
				$type_exist++;
			}
			elseif ($alias_exist !== FALSE && $tab[$i]['id'] == $alias_id[$alias_exist])
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
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

		// Marque du matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_hard_marque"],
		  'ONCHANGE' => 'getDynliste(this.value,\'hard_modele\'); if (document.images[\'imglink_marque\']) { document.images[\'imglink_marque\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' }; if (document.images[\'imglink_modele\']) { document.images[\'imglink_modele\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' }',
		));
	
		$template->assign_block_vars('form.marque.ocs', array(
		  'VALUE' => $tab_bios[0][COL_OCS_BIOS_MARQUE],
		));
	
		$i = -1;
		$marque_exist = 0;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($tab_bios[0][COL_OCS_BIOS_MARQUE]))
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

		// Modèle du matériel
		if ($marque_exist > 0)
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." WHERE marque_id='".$marque_exist."' ORDER BY libelle");
		else
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." ORDER BY libelle");
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["adm_hard_modele"],
		));

		$template->assign_block_vars('form.modele.ocs', array(
		  'VALUE' => $tab_bios[0][COL_OCS_BIOS_MODELE],
		));
		
		$i = -1;
		$modele_exist = 0;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($tab_bios[0][COL_OCS_BIOS_MODELE]))
			{
				$template->assign_block_vars('form.modele.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
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

		// OS
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_OS." ORDER BY libelle");

		$template->assign_block_vars('form.os', array(
		  'TITLE' => $lang["adm_hard_os"],
		));

		$template->assign_block_vars('form.os.ocs', array(
		  'VALUE' => $tab_ocs[0][COL_OCS_OSNAME],
		));
		
		$i = -1;
		$os_exist = 0;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($tab_ocs[0][COL_OCS_OSNAME]))
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
				$os_exist++;
			}
			else
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			$i++;
		}

		// Utilisateur
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE (agence_id='".$_GET['agence_id']."' || agence_id='0') ORDER BY nom,prenom");

		$template->assign_block_vars('form.user', array(
		  'TITLE' => $lang["adm_hard_user"],
		));
		
		$template->assign_block_vars('form.user.ocs', array(
		  'VALUE' => $tab_ocs[0][COL_OCS_USERID],
		));

		$i = -1;
		$user_exist = 0;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"], 'login_win' => '');
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i]["login_win"]) == strtoupper($tab_ocs[0][COL_OCS_USERID]))
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				  'SELECTED' => 'selected'
				));
				$user_exist++;
			}
			else
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				));
			}
			$i++;
		}
		
		// Emplacement
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET['agence_id']."' ORDER BY libelle");

		$template->assign_block_vars('form.emplacement', array(
		  'TITLE' => $lang["adm_hard_place"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.emplacement.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));

			$i++;
		}

		// Adresse IP
		$template->assign_block_vars('form.ip', array(
		  'TITLE' => $lang["adm_hard_ipaddr"],
		  'VALUE' => $ip,
		));
		
		$template->assign_block_vars('form.ip.ocs', array(
		  'VALUE' => $ip,
		));

		// Réservable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_hard_reserv"],
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

		// Date de mise en service
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_hard_creationdate"],
		  'VALUE' => date("d-m-Y").' ',
		  'DISABLED' => 'readonly',
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		));

		// Colonnes perso
		$pfieldsColumns = get_hard_pfield_columns($req1);

		foreach ($pfieldsColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $lang["s_".TAB_HARD.".". $fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));

		/////////////////////////////
		//     BOUTONS ACTIONS     //
		/////////////////////////////
		
		$template->assign_block_vars('form.hardname.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		  'LIBELLE' => $lang["ocs_syncok"],
		));
		
		$template->assign_block_vars('form.serial.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		  'LIBELLE' => $lang["ocs_syncok"],
		));

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
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_type&action=Ajouter&valeur='.$tab_bios[0][COL_OCS_BIOS_TYPE],
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
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_marque&action=Ajouter&valeur='.$tab_bios[0][COL_OCS_BIOS_MARQUE],
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
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_modele&action=Ajouter&valeur='.$tab_bios[0][COL_OCS_BIOS_MODELE].'&parent='.$marque_exist,
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
		
		if ($os_exist > 0)
		{
			$template->assign_block_vars('form.os.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.os.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_os&action=Ajouter&valeur='.$tab_ocs[0][COL_OCS_OSNAME],
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.os.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}
		
		if ($user_exist > 0)
		{
			$template->assign_block_vars('form.user.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if (preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('form.user.action', array(
				  'LINK' => 'index.php?page=adm_utilisateurs.php&agence_id='.$_GET["agence_id"].'&action=add&login_win='.$tab_ocs[0][COL_OCS_USERID],
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.user.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}

		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.emplacement.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=empl&agence_id='.$_GET["agence_id"].'&action=Ajouter&slct_site=1',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}

		$template->assign_block_vars('form.ip.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		  'LIBELLE' => $lang["ocs_syncok"],
		));

		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));		

		// Legende
		$template->assign_block_vars('form.key', array(
		  'L_TITLE' => $lang["gen_legende"],
		  'L_OK' => $lang["ocs_legendeok"],
		  'L_TRANS' => $lang["ocs_legendetrans"],
		  'L_ADD' => $lang["ocs_legendeadd"],
		  'L_USER' => $lang["ocs_legendeuser"],
		  'L_FORBID' => $lang["ocs_legendeforbid"],
		 ));	
	}
	/******************************/
	/*       Ajouter par LDAP     */
	/******************************/
	if (isset($_GET['action']) && $_GET['action'] == 'add_ldap')
	{
		// Clé primaire de comparaison des 2 bases
		if (defined("LDAP_KEY_HARD"))
			$key = explode(";",LDAP_KEY_HARD);
		else
			$key = array('mail','mail');
			
		// Racine de recherche LDAP du site
		$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask_hard".intval($_GET["agence_id"])."'";
		$tab_racine = $req1->db_use_query($requete);
		
		if (count($tab_racine) > 0)
			$racine = $tab_racine[0]["valeur"];
		else
			$racine = LDAP_MASK_HARD;

		$ds=ldap_connect(LDAP_HOST, LDAP_PORT);				
		$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);
		$sr=@ldap_search($ds, $racine, $key[1]."=".unserialize(urldecode($_GET[$key[1]])));
		
		$info = @ldap_get_entries($ds, $sr);
				
		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_hard_title_add"],
		  'ACTION' => 'index.php?page=adm_materiels.php&action=Ajouter',
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));
		
		$template->assign_block_vars('form.source_head', array(
		  'L_BASEINFO' => $lang["adm_hard_baseinfo"],
		  'L_OCSINFO' => $lang["adm_hard_ldapinfo"],
		));

		// Nom
		if (isset($info[0][LDAP_ATTR_HARD_NAME][0]))
			$nom = $info[0][LDAP_ATTR_HARD_NAME][0];
		else
			$nom = txt_to_na('');
			
		$template->assign_block_vars('form.hardname', array(
		  'TITLE' => $lang["adm_hard_hardname"],
		  'VALUE' => $nom,
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'ok',
		));

		$template->assign_block_vars('form.hardname.ocs', array(
		  'VALUE' => $nom,
		));

		// Numéro de série
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["serial"],
		));

		// Type de matériel		
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_TYPE." ORDER BY libelle");
		
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_hard_type"],
		));

		$i = -1;
		$type_exist = 0;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.type.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));
			$i++;
		}

		// Marque du matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_hard_marque"],
		  'ONCHANGE' => 'getDynliste(this.value,\'hard_modele\'); if (document.images[\'imglink_marque\']) { document.images[\'imglink_marque\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' }; if (document.images[\'imglink_modele\']) { document.images[\'imglink_modele\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' }',
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

		// Modèle du matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." ORDER BY libelle");
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["adm_hard_modele"],
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

		// OS
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_OS." ORDER BY libelle");

		if (isset($info[0][LDAP_ATTR_HARD_OS][0]))
			$os = $info[0][LDAP_ATTR_HARD_OS][0];
		else
			$os = txt_to_na('');

		$template->assign_block_vars('form.os', array(
		  'TITLE' => $lang["adm_hard_os"],
		));

		$i = -1;
		$os_exist = 0;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($os))
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected="selected"'
				));
				$os_exist++;
			}
			else
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			
			$i++;
		}

		$template->assign_block_vars('form.os.ocs', array(
		  'VALUE' => $os,
		));

		// Utilisateur
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE (agence_id='".$_GET['agence_id']."' || agence_id='0') ORDER BY nom,prenom");

		$template->assign_block_vars('form.user', array(
		  'TITLE' => $lang["adm_hard_user"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"], 'login_win' => '');
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.user.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
			));
			$i++;
		}
		
		// Emplacement
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET['agence_id']."' ORDER BY libelle");

		$template->assign_block_vars('form.emplacement', array(
		  'TITLE' => $lang["adm_hard_place"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			$template->assign_block_vars('form.emplacement.list', array(
			  'ID' => $tab[$i]['id'],
			  'LIBELLE' => $tab[$i]['libelle']
			));

			$i++;
		}

		// Adresse IP
		$template->assign_block_vars('form.ip', array(
		  'TITLE' => $lang["adm_hard_ipaddr"],
		));
		
		// Réservable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_hard_reserv"],
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

		// Date de mise en service
		if (isset($info[0][LDAP_ATTR_HARD_CREATED][0]))
			$date =  format_date_to_aff($info[0][LDAP_ATTR_HARD_CREATED][0],'-',0);
		else
			$date = '';
		
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_hard_creationdate"],
		  'VALUE' => $date.' ',
		  'DISABLED' => 'readonly',
		));
		
		$template->assign_block_vars('form.date.ocs', array(
		  'VALUE' => $date,
		));

		// Commentaire
		if (isset($info[0][LDAP_ATTR_HARD_DESCRIPTION][0]))
			$commentaire = $info[0][LDAP_ATTR_HARD_DESCRIPTION][0];
		else
			$commentaire = txt_to_na('');
			
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $commentaire,
		));

		// Colonnes perso
		$pfieldsColumns = get_hard_pfield_columns($req1);

		foreach ($pfieldsColumns as $fieldName) {
			if (isset($lang["s_".TAB_HARD.".". $fieldName])) {
				$displayTitle = $lang["s_".TAB_HARD.".". $fieldName];
			} else {
				$cleanName = str_replace('pfield_', '', $fieldName);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $displayTitle,
			));
		}

		$template->assign_block_vars('form.comment.ocs', array(
		  'VALUE' => $info[0][LDAP_ATTR_HARD_DESCRIPTION][0],
		));

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));

		/////////////////////////////
		//     BOUTONS ACTIONS     //
		/////////////////////////////
		
		$template->assign_block_vars('form.hardname.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		  'LIBELLE' => $lang["ocs_syncok"],
		));
		
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_type&action=Ajouter',
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

		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.marque.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_marque&action=Ajouter',
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
		
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.modele.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_modele&action=Ajouter',
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

		if ($os_exist > 0)
		{
			$template->assign_block_vars('form.os.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.os.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_os&action=Ajouter&valeur='.$os,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.os.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}
				
		if (preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.user.action', array(
			  'LINK' => 'index.php?page=adm_utilisateurs.php&agence_id='.$_GET["agence_id"].'&action=add',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["ocs_syncadd"],
			));
		}		
		else
		{
			$template->assign_block_vars('form.user.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
			  'LIBELLE' => $lang["gen_addforbid"],
			));
		}

		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.emplacement.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=empl&agence_id='.$_GET["agence_id"].'&action=Ajouter&slct_site=1',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}

		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));		

		$template->assign_block_vars('form.comment.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		  'LIBELLE' => $lang["ocs_syncok"],
		));

		// Legende
		$template->assign_block_vars('form.key', array(
		  'L_TITLE' => $lang["gen_legende"],
		  'L_OK' => $lang["ocs_legendeok"],
		  'L_TRANS' => $lang["ocs_legendetrans"],
		  'L_ADD' => $lang["ocs_legendeadd"],
		  'L_USER' => $lang["ocs_legendeuser"],
		  'L_FORBID' => $lang["ocs_legendeforbid"],
		 ));	
	}
	/****************************/
	/*     Synchro par OCS     */
	/****************************/
	if (isset($_GET['action']) && $_GET['action'] == 'sync_ocs')
	{
		$requete = "SELECT ".TAB_HARD.".*,
		  ".TAB_HARD_TYPE.".libelle AS l_type,
		  ".TAB_HARD_MARQUE.".libelle AS l_marque,
		  ".TAB_HARD_MODELE.".libelle AS l_modele,
		  ".TAB_HARD_OS.".libelle AS l_os,
		  ".TAB_USERS.".login_win AS l_user
		FROM ".TAB_HARD."
		  LEFT JOIN ".TAB_HARD_TYPE." ON ".TAB_HARD_TYPE.".id = ".TAB_HARD.".type_id
		  LEFT JOIN ".TAB_HARD_MARQUE." ON ".TAB_HARD_MARQUE.".id = ".TAB_HARD.".marque_id
		  LEFT JOIN ".TAB_HARD_MODELE." ON ".TAB_HARD_MODELE.".id = ".TAB_HARD.".modele_id
		  LEFT JOIN ".TAB_HARD_OS." ON ".TAB_HARD_OS.".id = ".TAB_HARD.".os_id
		  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_HARD.".user_id
		WHERE ".TAB_HARD.".id='".$_GET["h_id"]."'";
		$main_tab = $req1->db_use_query($requete);

		$nom = $main_tab[0]["nom"];
		$num_serie = $main_tab[0]["num_serie"];
		$agence = $main_tab[0]["agence_id"];
		$type = $main_tab[0]["type_id"];
		$type_libelle = $main_tab[0]["l_type"];
		$marque = $main_tab[0]["marque_id"];
		$marque_libelle = $main_tab[0]["l_marque"];
		$modele = $main_tab[0]["modele_id"];
		$modele_libelle = $main_tab[0]["l_modele"];
		$os = $main_tab[0]["os_id"];
		$os_libelle = $main_tab[0]["l_os"];
		$user = $main_tab[0]["user_id"];
		$user_libelle = $main_tab[0]["l_user"];
		$emplacement = $main_tab[0]["emplacement_id"];
		$ip = $main_tab[0]["ip"];
		$reservable = $main_tab[0]["reservable"];
		$commentaire = $main_tab[0]["commentaire"];
		
		if ($main_tab[0]["creation_date"] != '')
			$creation_date = date("d-m-Y",(int)$main_tab[0]["creation_date"]).' ';
		else
			$creation_date = date("d-m-Y").' ';
		
		
		
		// Connexion à la base OCS
		$connect_ocs = new db_connect();
		$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

		$tab_ocs = $req1->db_use_query("SELECT * FROM ".TAB_OCS_HARD." WHERE ".COL_OCS_HARD_ID."='".$_GET["ocs_id"]."'");					
		$tab_bios = $req1->db_use_query("SELECT * FROM ".TAB_OCS_BIOS." WHERE ".COL_OCS_BIOS_HARDID."='".$_GET["ocs_id"]."'");	

		$connect->connection();

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_hard_title_syncocs"],
		  'ACTION' => 'index.php?page=adm_materiels.php&amp;action=editer&amp;h_id='.$_GET['h_id'],
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));
		
		$template->assign_block_vars('form.source_head', array(
		  'L_BASEINFO' => $lang["adm_hard_baseinfo"],
		  'L_OCSINFO' => $lang["adm_hard_ocsinfo"],
		));

		// Nom du matériel
		$template->assign_block_vars('form.hardname', array(
		  'TITLE' => $lang["adm_hard_hardname"],
		  'VALUE' => $nom,
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'ok',
		));

		$template->assign_block_vars('form.hardname.ocs', array(
		  'VALUE' => $tab_ocs[0][COL_OCS_HARD_NAME],
		));
		
		$name_ok = 0;
		if (strtoupper($nom) == strtoupper($tab_ocs[0][COL_OCS_HARD_NAME]))
			$name_ok = 1;

		// Numéro de série
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["serial"],
		  'VALUE' => $num_serie,
		));

		$template->assign_block_vars('form.serial.ocs', array(
		  'VALUE' => $tab_bios[0][COL_OCS_BIOS_SNUM],
		));

		$serial_ok = 0;
		if (strtoupper($num_serie) == strtoupper($tab_bios[0][COL_OCS_BIOS_SNUM]))
			$serial_ok = 1;

		// Type de matériel
		$alias = array('NOTEBOOK', 'DESKTOP', 'MINI TOWER'); 
		$alias_id = array(2,1,1); 

		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_TYPE." ORDER BY libelle");
		
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_hard_type"],
		));

		$template->assign_block_vars('form.type.ocs', array(
		  'VALUE' => $tab_bios[0][COL_OCS_BIOS_TYPE],
		));
		
		$i = -1;
		$type_exist = $type_ok = 0;
		$alias_exist = array_search(strtoupper($tab_bios[0][COL_OCS_BIOS_TYPE]),$alias);
		
		// Le libelle selectionné correspond au libéllé OCS
		if (strtoupper($type_libelle) == strtoupper($tab_bios[0][COL_OCS_BIOS_TYPE]))
			$type_ok = 1;
			
		// L'alias existe et correspond bien au type actuellement selectionné
		elseif ($alias_exist !== FALSE && $type == $alias_id[$alias_exist])
			$type_ok++;

		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($type == $tab[$i]["id"])
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

			
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($tab_bios[0][COL_OCS_BIOS_TYPE]))
				$type_exist++;
			// L'alias existe mais le type actuellement selectionné ne correspond pas
			elseif ($alias_exist !== FALSE && $tab[$i]["id"] == $alias_id[$alias_exist])
			{
				$type_exist++;
				$tab_bios[0]["TYPE"] = $tab[$i]["libelle"];
			}
			
			$i++;
		}

		// Marque du matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_hard_marque"],
		  'ONCHANGE' => 'getDynliste(this.value,\'hard_modele\'); if (document.images[\'imglink_marque\']) { document.images[\'imglink_marque\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' }; if (document.images[\'imglink_modele\']) { document.images[\'imglink_modele\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' }',
		));
	
		$template->assign_block_vars('form.marque.ocs', array(
		  'VALUE' => $tab_bios[0][COL_OCS_BIOS_MARQUE],
		));
	
		$i = -1;
		$marque_exist = $marque_ok = 0;
		
		if (strtoupper($marque_libelle) == strtoupper($tab_bios[0][COL_OCS_BIOS_MARQUE]))
			$marque_ok = $marque;

		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($marque == $tab[$i]["id"])
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
			
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($tab_bios[0][COL_OCS_BIOS_MARQUE]))
				$marque_exist = $tab[$i]["id"];
				
			$i++;
		}

		// Modèle du matériel
		if ($main_tab[0]["marque_id"] < 1)
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." ORDER BY ".HA_MO_LIBELLE);
		else
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." WHERE ".HA_MO_MAQUEID."='".$main_tab[0]["marque_id"]."' ORDER BY ".HA_MO_LIBELLE);
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["adm_hard_modele"],
		));

		$template->assign_block_vars('form.modele.ocs', array(
		  'VALUE' => $tab_bios[0][COL_OCS_BIOS_MODELE],
		));
		
		$i = -1;
		$modele_exist = $modele_ok = 0;
		
		if (strtoupper($modele_libelle) == strtoupper($tab_bios[0][COL_OCS_BIOS_MODELE]))
			$modele_ok = 1;

		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($modele == $tab[$i]["id"])
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
			
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($tab_bios[0][COL_OCS_BIOS_MODELE]))
				$modele_exist = 1;
				
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

		// OS
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_OS." ORDER BY libelle");

		$template->assign_block_vars('form.os', array(
		  'TITLE' => $lang["adm_hard_os"],
		));

		$template->assign_block_vars('form.os.ocs', array(
		  'VALUE' => utf8_encode($tab_ocs[0][COL_OCS_OSNAME]),
		));
		
		$i = -1;
		$os_exist = $os_ok = 0;
		
		if (strtoupper($os_libelle) == strtoupper($tab_ocs[0][COL_OCS_OSNAME]))
			$os_ok = 1;

		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($os == $tab[$i]["id"])
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($tab_ocs[0][COL_OCS_OSNAME]))
				$os_exist = 1;
				
			$i++;
		}

		// Utilisateur
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE (agence_id='".$_GET['agence_id']."' || agence_id='0') ORDER BY nom,prenom");

		$template->assign_block_vars('form.user', array(
		  'TITLE' => $lang["adm_hard_user"],
		));
		
		$template->assign_block_vars('form.user.ocs', array(
		  'VALUE' => $tab_ocs[0][COL_OCS_USERID],
		));

		$i = -1;
		$user_exist = $user_ok = 0;

		if (strtoupper($user_libelle) == strtoupper($tab_ocs[0][COL_OCS_USERID]))
			$user_ok = 1;

		$tab[-1] = array('id' => '0', 'nom' => $lang["none"], 'login_win' => '');
		while ($i < count($tab)-1)
		{
			if ($user == $tab[$i]["id"])
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				));
			}
			
			if (strtoupper($tab[$i]["login_win"]) == strtoupper($tab_ocs[0][COL_OCS_USERID]))
				$user_exist = 1;
				
			$i++;
		}
		
		// Emplacement
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET['agence_id']."' ORDER BY libelle");

		$template->assign_block_vars('form.emplacement', array(
		  'TITLE' => $lang["adm_hard_place"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($emplacement == $tab[$i]["id"])
			{
				$template->assign_block_vars('form.emplacement.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.emplacement.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}

			$i++;
		}

		// Adresse IP
		$template->assign_block_vars('form.ip', array(
		  'TITLE' => $lang["adm_hard_ipaddr"],
		  'VALUE' => $ip,
		));
		
		$template->assign_block_vars('form.ip.ocs', array(
		  'VALUE' => $tab_ocs[0][COL_OCS_IPADDR],
		));

		$ip_ok = 0;
		if (strtoupper($ip) == strtoupper($tab_ocs[0][COL_OCS_IPADDR]))
			$ip_ok = 1;

		// Réservable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_hard_reserv"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0));
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

		// Date de mise en service
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_hard_creationdate"],
		  'VALUE' => $creation_date,
		  'DISABLED' => 'readonly',
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $commentaire,
		));

		// Colonnes perso
		$pfieldsColumns = get_hard_pfield_columns($req1);

		foreach ($pfieldsColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'VALUE' => $main_tab[0][$fieldName],
			  'TITLE' => $lang["s_".TAB_HARD.".". $fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["edit"],
		));

		/////////////////////////////
		//     BOUTONS ACTIONS     //
		/////////////////////////////
		
		if ($name_ok > 0)
		{
			$template->assign_block_vars('form.hardname.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			$template->assign_block_vars('form.hardname.valid', array(
			  'ONCLICK' => 'document.form.nom.value=\''.$tab_ocs[0][COL_OCS_HARD_NAME].'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			  'LIBELLE' => $lang["ocs_syncnok"],
			));
		}		
		
		if ($serial_ok > 0)
		{
			$template->assign_block_vars('form.serial.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			$template->assign_block_vars('form.serial.valid', array(
			  'ONCLICK' => 'document.form.num_serie.value=\''.$tab_bios[0]["SSN"].'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			  'LIBELLE' => $lang["ocs_syncnok"],
			));
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
				  'ONCLICK' => 'ChangeListe(document.form.type,\''.$tab_bios[0]["TYPE"].'\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($type_exist == 0 && (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.type.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_type&action=Ajouter&valeur='.$tab_bios[0][COL_OCS_BIOS_TYPE],
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
				  'ONCLICK' => 'ChangeListe(document.form.marque,\''.$tab_bios[0][COL_OCS_BIOS_MARQUE].'\'); getDynliste(document.form.marque.value,\'hard_modele\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($marque_exist == 0 && (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.marque.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_marque&action=Ajouter&marque_id=&valeur='.$tab_bios[0][COL_OCS_BIOS_MARQUE],
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
				  'ONCLICK' => 'ChangeListe(document.form.modele,\''.$tab_bios[0][COL_OCS_BIOS_MODELE].'\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($modele_exist == 0 && (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.modele.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_modele&action=Ajouter&valeur='.$tab_bios[0][COL_OCS_BIOS_MODELE].'&parent='.$marque,
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
		
		if ($os_ok > 0)
		{
			$template->assign_block_vars('form.os.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ($os_exist > 0)
			{
				$template->assign_block_vars('form.os.valid', array(
				  'ONCLICK' => 'ChangeListe(document.form.os,\''.$tab_ocs[0]["OSNAME"].'\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($os_exist == 0 && (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.os.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_os&action=Ajouter&valeur='.$tab_ocs[0]["OSNAME"],
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.os.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}
		
		if ($user_ok > 0)
		{
			$template->assign_block_vars('form.user.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ($user_exist > 0)
			{
				$template->assign_block_vars('form.user.valid', array(
				  'ONCLICK' => 'ChangeListe(document.form.user,\''.$tab_ocs[0]["USERID"].'\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($user_exist == 0 && (preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.user.action', array(
				  'LINK' => 'index.php?page=adm_utilisateurs.php&agence_id='.$_GET["agence_id"].'&action=add&login_win='.$tab_ocs[0]["USERID"],
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.user.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}

		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.emplacement.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=empl&agence_id='.$_GET["agence_id"].'&action=Ajouter&slct_site=1',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}

		if ($ip_ok > 0)
		{
			$template->assign_block_vars('form.ip.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			$template->assign_block_vars('form.ip.valid', array(
			  'ONCLICK' => 'document.form.ip.value=\''.$tab_ocs[0]["IPADDR"].'\';this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			  'LIBELLE' => $lang["ocs_syncnok"],
			));
		}

		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));		

		// Legende
		$template->assign_block_vars('form.key', array(
		  'L_TITLE' => $lang["gen_legende"],
		  'L_OK' => $lang["ocs_legendeok"],
		  'L_TRANS' => $lang["ocs_legendetrans"],
		  'L_ADD' => $lang["ocs_legendeadd"],
		  'L_USER' => $lang["ocs_legendeuser"],
		  'L_FORBID' => $lang["ocs_legendeforbid"],
		 ));	
	}
	/****************************/
	/*     Synchro par LDAP     */
	/****************************/
	if (isset($_GET['action']) && $_GET['action'] == 'sync_ldap')
	{
		$requete = "SELECT ".TAB_HARD.".*,
		  ".TAB_HARD_TYPE.".libelle AS l_type,
		  ".TAB_HARD_MARQUE.".libelle AS l_marque,
		  ".TAB_HARD_MODELE.".libelle AS l_modele,
		  ".TAB_HARD_OS.".libelle AS l_os,
		  ".TAB_USERS.".login_win AS l_user
		FROM ".TAB_HARD."
		  LEFT JOIN ".TAB_HARD_TYPE." ON ".TAB_HARD_TYPE.".id = ".TAB_HARD.".type_id
		  LEFT JOIN ".TAB_HARD_MARQUE." ON ".TAB_HARD_MARQUE.".id = ".TAB_HARD.".marque_id
		  LEFT JOIN ".TAB_HARD_MODELE." ON ".TAB_HARD_MODELE.".id = ".TAB_HARD.".modele_id
		  LEFT JOIN ".TAB_HARD_OS." ON ".TAB_HARD_OS.".id = ".TAB_HARD.".os_id
		  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_HARD.".user_id
		WHERE ".TAB_HARD.".id='".$_GET["h_id"]."'";
		$main_tab = $req1->db_use_query($requete);

		$nom = $main_tab[0]["nom"];
		$num_serie = $main_tab[0]["num_serie"];
		$agence = $main_tab[0]["agence_id"];
		$type = $main_tab[0]["type_id"];
		$type_libelle = $main_tab[0]["l_type"];
		$marque = $main_tab[0]["marque_id"];
		$marque_libelle = $main_tab[0]["l_marque"];
		$modele = $main_tab[0]["modele_id"];
		$modele_libelle = $main_tab[0]["l_modele"];
		$os = $main_tab[0]["os_id"];
		$os_libelle = $main_tab[0]["l_os"];
		$user = $main_tab[0]["user_id"];
		$user_libelle = $main_tab[0]["l_user"];
		$emplacement = $main_tab[0]["emplacement_id"];
		$ip = $main_tab[0]["ip"];
		$reservable = $main_tab[0]["reservable"];
		$commentaire = $main_tab[0]["commentaire"];
		
		if ($main_tab[0]["creation_date"] != '')
			$creation_date = date("d-m-Y",(int)$main_tab[0]["creation_date"]).' ';
		else
			$creation_date = date("d-m-Y").' ';
				
		// Clé primaire de comparaison des 2 bases
		if (defined("LDAP_KEY_HARD"))
			$key = explode(";",LDAP_KEY_HARD);
		else
			$key = array('mail','mail');
			
		// Racine de recherche LDAP du site
		$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask_hard".intval($_GET["agence_id"])."'";
		$tab_racine = $req1->db_use_query($requete);
		
		if (count($tab_racine) > 0)
			$racine = $tab_racine[0]["valeur"];
		else
			$racine = LDAP_MASK_HARD;

		$ds=ldap_connect(LDAP_HOST, LDAP_PORT);				
		$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);
		$sr=@ldap_search($ds, $racine, $key[1]."=".unserialize(urldecode($_GET[$key[1]])));
		
		$info = @ldap_get_entries($ds, $sr);

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_hard_title_syncldap"],
		  'ACTION' => 'index.php?page=adm_materiels.php&action=editer&h_id='.$_GET['h_id'],
		  'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/images',
		));
		
		$template->assign_block_vars('form.source_head', array(
		  'L_BASEINFO' => $lang["adm_hard_baseinfo"],
		  'L_OCSINFO' => $lang["adm_hard_ldapinfo"],
		));

		// Nom du matériel
		$template->assign_block_vars('form.hardname', array(
		  'TITLE' => $lang["adm_hard_hardname"],
		  'VALUE' => $nom,
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'ok',
		));

		if (isset($info[0][LDAP_ATTR_HARD_NAME][0]))
			$nom_ldap = $info[0][LDAP_ATTR_HARD_NAME][0];
		else
			$nom_ldap = txt_to_na('');
		
		$template->assign_block_vars('form.hardname.ocs', array(
		  'VALUE' => $nom_ldap,
		));
		
		$name_ok = 0;
		if (strtoupper($nom) == strtoupper($nom_ldap))
			$name_ok = 1;

		// Numéro de série
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["serial"],
		  'VALUE' => $num_serie,
		));

		// Type de matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_TYPE." ORDER BY libelle");
		
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_hard_type"],
		));

		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($type == $tab[$i]["id"])
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

		// Marque du matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_hard_marque"],
		  'ONCHANGE' => 'getDynliste(this.value,\'hard_modele\'); if (document.images[\'imglink_marque\']) { document.images[\'imglink_marque\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' }; if (document.images[\'imglink_modele\']) { document.images[\'imglink_modele\'].src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_useredit.gif\' }',
		));
	
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($marque == $tab[$i]["id"])
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

		// Modèle du matériel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MODELE." ORDER BY libelle");
		
		$template->assign_block_vars('form.modele', array(
		  'TITLE' => $lang["adm_hard_modele"],
		));

		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($modele == $tab[$i]["id"])
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

		// OS
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_OS." ORDER BY libelle");

		if (isset($info[0][LDAP_ATTR_HARD_OS][0]))
			$os_ldap = $info[0][LDAP_ATTR_HARD_OS][0];
		else
			$os_ldap = txt_to_na('');

		$template->assign_block_vars('form.os', array(
		  'TITLE' => $lang["adm_hard_os"],
		));

		$i = -1;
		$os_exist = $os_ok = 0;	
		
		if (strtoupper($os_libelle) == strtoupper($os_ldap))
			$os_ok = 1;
		
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($os == $tab[$i]["id"])
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.os.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}
			
			if (strtoupper($tab[$i]["libelle"]) == strtoupper($os_ldap))
				$os_exist = 1;
			
			$i++;
		}

		$template->assign_block_vars('form.os.ocs', array(
		  'VALUE' => $os_ldap,
		));

		// Utilisateur
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE (agence_id='".$_GET['agence_id']."' || agence_id='0') ORDER BY nom,prenom");

		$template->assign_block_vars('form.user', array(
		  'TITLE' => $lang["adm_hard_user"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '0', 'nom' => $lang["none"], 'login_win' => '');
		while ($i < count($tab)-1)
		{
			if ($user == $tab[$i]["id"])
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.user.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => txt_to_na($tab[$i]['nom']).' ('.txt_to_na($tab[$i]['login_win']).')',
				));
			}
				
			$i++;
		}
		
		// Emplacement
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_EMPL." WHERE agence_id='".$_GET['agence_id']."' ORDER BY libelle");

		$template->assign_block_vars('form.emplacement', array(
		  'TITLE' => $lang["adm_hard_place"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($emplacement == $tab[$i]["id"])
			{
				$template->assign_block_vars('form.emplacement.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form.emplacement.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle']
				));
			}

			$i++;
		}

		// Adresse IP
		$template->assign_block_vars('form.ip', array(
		  'TITLE' => $lang["adm_hard_ipaddr"],
		  'VALUE' => $ip,
		));
		
		// Réservable
		$template->assign_block_vars('form.reservable', array(
		  'TITLE' => $lang["adm_hard_reserv"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0));
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

		// Date de mise en service
		if (isset($info[0][LDAP_ATTR_HARD_CREATED][0]))
			$date = format_date_to_aff($info[0][LDAP_ATTR_HARD_CREATED][0],'-',0);
		else
			$date = '';
		
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_hard_creationdate"],
		  'VALUE' => $creation_date,
		  'DISABLED' => 'readonly',
		));
		
		$template->assign_block_vars('form.date.ocs', array(
		  'VALUE' => $date,
		));
		
		$date_ok = 0;
		if ($creation_date == $date.' ')
			$date_ok = 1;
		
		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $commentaire,
		));

		if (isset($info[0][LDAP_ATTR_HARD_DESCRIPTION][0]))
			$comment_ldap = $info[0][LDAP_ATTR_HARD_DESCRIPTION][0];
		else
			$comment_ldap = txt_to_na('');
			
		$template->assign_block_vars('form.comment.ocs', array(
		  'VALUE' => $comment_ldap,
		));
		
		$comment_ok = 0;
		if (strtoupper($commentaire) == strtoupper($comment_ldap))
			$comment_ok = 1;

		// Colonnes perso
		$pfieldsColumns = get_hard_pfield_columns($req1);

		foreach ($pfieldsColumns as $fieldName) {
			if (isset($lang["s_".TAB_HARD.".". $fieldName])) {
				$displayTitle = $lang["s_".TAB_HARD.".". $fieldName];
			} else {
				$cleanName = str_replace('pfield_', '', $fieldName);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'VALUE' => $main_tab[0][$fieldName],
			  'TITLE' => $displayTitle,
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["edit"],
		));

		/////////////////////////////
		//     BOUTONS ACTIONS     //
		/////////////////////////////
		
		if ($name_ok > 0)
		{
			$template->assign_block_vars('form.hardname.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			$template->assign_block_vars('form.hardname.valid', array(
			  'ONCLICK' => 'document.form.nom.value=\''.$info[0][LDAP_ATTR_HARD_NAME][0].'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			  'LIBELLE' => $lang["ocs_syncnok"],
			));
		}		
		
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_type&amp;action=Ajouter',
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
		

		if (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.marque.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_marque&amp;action=Ajouter',
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
		
		if (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.modele.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_modele&amp;action=Ajouter&amp;parent='.$marque,
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

		if ($os_ok > 0)
		{
			$template->assign_block_vars('form.os.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			if ($os_exist > 0)
			{
				$template->assign_block_vars('form.os.valid', array(
				  'ONCLICK' => 'ChangeListe(document.form.os,\''.$os_ldap.'\'); this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
				  'LIBELLE' => $lang["ocs_syncnok"],
				));
			}		
			elseif ($os_exist == 0 && (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
			{
				$template->assign_block_vars('form.os.action', array(
				  'LINK' => 'index.php?page=adm_tables.php&table=hard_os&action=Ajouter&valeur='.$os_ldap,
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
				  'LIBELLE' => $lang["ocs_syncadd"],
				));
			}		
			else
			{
				$template->assign_block_vars('form.os.valid', array(
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
				  'LIBELLE' => $lang["gen_addforbid"],
				));
			}
		}
		
		
		if (preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.user.action', array(
			  'LINK' => 'index.php?page=adm_utilisateurs.php&amp;agence_id='.$_GET["agence_id"].'&amp;action=add',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["ocs_syncadd"],
			));
		}		
		else
		{
			$template->assign_block_vars('form.user.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_forbid.gif',
			  'LIBELLE' => $lang["gen_addforbid"],
			));
		}

		// Emplacement
		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.emplacement.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=empl&amp;agence_id='.$_GET["agence_id"].'&amp;action=Ajouter&slct_site=1',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}

		// Date
		if ($date_ok > 0)
		{
			$template->assign_block_vars('form.date.action', array(
			  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
			  'LIBELLE' => $lang["add"],
			));		
		}
		else
		{
			$template->assign_block_vars('form.date.valid', array(
			  'ONCLICK' => 'document.form.date.value=\''.$date.'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			  'LIBELLE' => $lang["ocs_syncnok"],
			));
		}		

		// Commentaire
		if ($comment_ok > 0)
		{
			$template->assign_block_vars('form.comment.valid', array(
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
			  'LIBELLE' => $lang["ocs_syncok"],
			));
		}
		else
		{
			$template->assign_block_vars('form.comment.valid', array(
			  'ONCLICK' => 'comment_textarea.innerHTML=\''.addslashes($info[0][LDAP_ATTR_HARD_DESCRIPTION][0]).'\'; this.src=\'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif\'',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow.gif',
			  'LIBELLE' => $lang["ocs_syncnok"],
			));
		}		

		// Legende
		$template->assign_block_vars('form.key', array(
		  'L_TITLE' => $lang["gen_legende"],
		  'L_OK' => $lang["ocs_legendeok"],
		  'L_TRANS' => $lang["ocs_legendetrans"],
		  'L_ADD' => $lang["ocs_legendeadd"],
		  'L_USER' => $lang["ocs_legendeuser"],
		  'L_FORBID' => $lang["ocs_legendeforbid"],
		 ));	
	}
	/****************************/
	/*            Rebus              */
	/****************************/
 	elseif (isset($_GET['action']) && $_GET['action'] == 'rebus')
	{
		$requete = "SELECT * FROM ".TAB_HARD." WHERE id='".$_GET["h_id"]."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_hard_title_rebus"],
		  'ACTION' => 'index.php?page=adm_materiels.php&action=rebus&h_id='.$_GET['h_id'],
		));

		$template->assign_block_vars('form.hardname', array(
		  'TITLE' => $lang["adm_hard_hardname"],
		  'VALUE' => $tab[0]["nom"],
		  'DISABLED' => 'disabled',
		));

		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["adm_hard_serial"],
		  'VALUE' => txt_to_na($tab[0]["num_serie"]),
		  'DISABLED' => 'disabled',
		));

		$template->assign_block_vars('form.rebus', array(
		  'TITLE' => $lang["adm_hard_rebus"],
		  'VALUE' => $tab[0]["suivi_rebus"],
		  'DISABLED' => 'disabled',
		));

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["gen_send"],
		));
	}
	/****************************/
	/*         Suppression         */
	/****************************/
 	elseif (isset($_GET['action']) && $_GET['action'] == 'supprimer')
	{
		$requete = "SELECT * FROM ".TAB_HARD." WHERE id='".$_GET["h_id"]."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form', array(
		  'L_TITLE' => $lang["adm_hard_title_del"],
		  'ACTION' => 'index.php?page=adm_materiels.php&action=supprimer&h_id='.$_GET['h_id'],
		));

		$template->assign_block_vars('form.hardname', array(
		  'TITLE' => $lang["adm_hard_hardname"],
		  'VALUE' => $tab[0]["nom"],
		  'DISABLED' => 'disabled',
		));
		
		$template->assign_block_vars('form.serial', array(
		  'TITLE' => $lang["adm_hard_serial"],
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