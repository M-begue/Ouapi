<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use;
$affichage = '';

//Ajout d'un num�ro de licence
if (isset($_POST["add_serial"]))
{
	$s_id = $_GET['s_id'];
	$h_id = $_POST['h_id'];
	$requete = "INSERT INTO ".TAB_SOFT_LICENCE." (hardware_id,software_id,serial)
	VALUES ('".$h_id."','".$s_id."','".$_POST["serial_num"]."')";
	$tab = $req1->db_use_query($requete);
}
// Supprimer un num�ro de licence
if (isset($_POST["del_serial"]))
{
	$serial_id = $_POST['serial_id'];
	$requete = "DELETE FROM ".TAB_SOFT_LICENCE." WHERE id='".$serial_id."'";
	$tab = $req1->db_use_query($requete);
}

// Supprimer le logiciel d'un poste
if (isset($_POST["del_soft"]))
{
	$s_id = $_GET['s_id'];
	$h_id = $_POST['hard_id'];
	$requete = "DELETE FROM ".TAB_HARDSOFT." WHERE software_id='".$s_id."' AND hardware_id='".$h_id."'";
	$tab = $req1->db_use_query($requete);
}

// Ajouter le logiciel sur un poste
if (isset($_POST["add_soft"]))
{
	$s_id = $_GET['s_id'];
	$h_id = $_POST['hard_id'];
	
	$requete = "SELECT * FROM ".TAB_SOFT." WHERE id='".$s_id."'";
	$tab_soft = $req1->db_use_query($requete);
	
	if (count($tab_soft) > 0) {
		$version = $tab_soft[0]["dern_version_num"];
	} else {
		$version = 0;
	}
	$date = date("Y-m-d");
	
	$requete = "INSERT INTO ".TAB_HARDSOFT." (hardware_id,software_id,version_date_maj,version_num,user_maj_id)
	VALUES ('".$h_id."','".$s_id."','".$date."','".$version."','".$_SESSION["user_id"]."')";
	$tab = $req1->db_use_query($requete);
}

/***************************************************/
/*		    Lister les postes et logiciels         */
/***************************************************/
if (isset($_GET['action']) && $_GET['action'] == 'list_version' )
{
	/*		    Lister a partir de la base OUAPI        */
	if (isset($_GET["s_id"]))
	{
		$s_id = intval($_GET["s_id"]);

		// Infos du logiciel
		$requete = "SELECT ".TAB_SOFT.".*, 			  
		".TAB_SOFT_MARQUE.".libelle AS l_marque
		FROM ".TAB_SOFT."
			LEFT JOIN ".TAB_SOFT_MARQUE." ON ".TAB_SOFT.".marque_id = ".TAB_SOFT_MARQUE.".id
		WHERE ".TAB_SOFT.".id='".$s_id."'";
		$tab_soft = $req1->db_use_query($requete);
		
		$template->assign_block_vars('soft_infos', array(
		  'NAME' => $tab_soft[0]["nom"],
		  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
		  'MARQUE' => $lang["adm_hardsoft_publisher"].txt_to_na($tab_soft[0]["l_marque"]),
		  'VERSION' => $lang["adm_hardsoft_vers"].txt_to_na($tab_soft[0]["dern_version_num"])
		  .$lang["adm_hardsoft_versdate"].txt_to_na(format_date_to_aff($tab_soft[0]["dern_version_date"])),
		));	
		
		// MAJ / Install des postes
		$requete = "SELECT ".TAB_HARDSOFT.".*, MAX(version_num) AS lastv FROM ".TAB_HARDSOFT." WHERE software_id='".$s_id."' GROUP BY hardware_id";
		$tab_hardsoft = $req1->db_use_query_inv($requete);
		$template->assign_vars(array(
		  'CAT_TITLE' => $lang["soft_hardinstalldetail"]
		));

		// On affiche seulement les mat�riels concern�s par les mises � jour
		$tab_mht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='maj_hardtype'");
		$type_id = str_replace(';','\' OR '.TAB_HARD.'.type_id=\'','('.TAB_HARD.'.type_id=\''.substr($tab_mht[0]["valeur"],0,-1).'\')');

		$requete = "SELECT ".TAB_HARD.".*,
		  ".TAB_USERS.".nom AS user_lname,
		  ".TAB_USERS.".prenom AS user_fname,
			".TAB_EMPL.".libelle AS empl_libelle,
		  ".TAB_HARD_TYPE.".libelle AS type_libelle
		FROM ".TAB_HARD." 
		  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_HARD.".user_id
			LEFT JOIN ".TAB_EMPL." ON ".TAB_EMPL.".id = ".TAB_HARD.".emplacement_id
		  LEFT JOIN ".TAB_HARD_TYPE." ON ".TAB_HARD_TYPE.".id = ".TAB_HARD.".type_id
		WHERE ".TAB_HARD.".agence_id='".$_GET["agence_id"]."' AND ".$type_id." AND suivi_rebus=''
		ORDER BY type_libelle";
		$tab_hard = $req1->db_use_query_inv($requete);

		// Cas ou OCS est activ�
		if (OCS_INSTALL == "Oui")
		{
			// Cherche les alias OCS du logiciel
			$requete = "SELECT *
			FROM ".TAB_SOFT_OCS_ALIAS."
			WHERE ouapi_soft_id='".$s_id."'";
			$tab_alias = $req1->db_use_query_inv($requete);	
		}

		if (count($tab_hard) != 0)
		{
			$template->assign_block_vars('tab_hard', array());
			
			$i = 0;
			while ($i < count($tab_hard["id"]))
			{
				// En-tetes
				if ($i == 0 || $tab_hard["type_id"][$i] != $tab_hard["type_id"][$i-1])
				{
					if ($tab_hard["type_libelle"][$i] != '')
						$hard_type = $tab_hard["type_libelle"][$i];
					else
						$hard_type = $lang["hard_na"];
																	
					$template->assign_block_vars('tab_hard.header', array(
						'TYPE_NAME' => $hard_type,
						'L_HARDNAME' => $lang["gen_hardname"],
						'L_USER' => $lang["user"],
						'L_EMPL' => $lang["place_2"],
						'L_SERIAL' => $lang["serial"],
						'L_VERSION' => $lang["gen_version"],
					));		
					
					$template->assign_block_vars('tab_hard.header.col_serial', array(
						'L_LICENCE' => $lang["fiche_serial"],
					));						
				}

				// Liste des mat�riels
				$template->assign_block_vars('tab_hard.header.list', array(
					'L_HARDNAME' => $tab_hard["nom"][$i],
					'L_USER' => txt_to_na(trim($tab_hard["user_lname"][$i].' '.$tab_hard["user_fname"][$i])),
					'L_EMPL' => txt_to_na(trim($tab_hard["empl_libelle"][$i])),
					'L_SERIAL' => $tab_hard["num_serie"][$i],
					'HARD_ID' => $tab_hard["id"][$i],
				));	

				// Licences
				$requete = "SELECT * FROM ".TAB_SOFT_LICENCE." WHERE hardware_id='".$tab_hard["id"][$i]."' AND software_id='".$s_id."'";
				$tab_licences = $req1->db_use_query($requete);

				$template->assign_block_vars('tab_hard.header.list.col_serial', array(
					'DEL_SERIAL' => $lang["delete"],
					'DEL_SERIAL_IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/del.gif',
					'ADD_SERIAL' => $lang["add"],
					'ADD_SERIAL_IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/add.gif',
					'ADD_SERIAL_BTN' => $lang["add"],
					'ADD_SERIAL_ID' => 'add_serial'.$i,
				));
			
				if (count($tab_licences) > 0)
				{
					$j = 0;
					while ($j < count($tab_licences))
					{
						$template->assign_block_vars('tab_hard.header.list.col_serial.serial', array(
						  'NUM' => $tab_licences[$j]["serial"],
						  'ID' => $tab_licences[$j]["id"],
						  'DEL_SERIAL_ID' => $i.'del_serial'.$j,
						));
						
						$j++;
					}
				}
				else
				{
						$template->assign_block_vars('tab_hard.header.list.col_serial.no_serial', array(
						  'NUM' => $lang["none"],
						));			
				}
			
				// STATUT
				
				// Cas ou OCS est activ� et ou l'on a des alias
				if (OCS_INSTALL == "Oui" && count($tab_alias) > 0)
				{
					$connect_ocs = new db_connect();
					$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);
					
					// Si OCS configur� et connect�
					if (mysql_error() == '' && defined("OCS_CRIT_BASE".intval(intval($_GET["agence_id"]))))
					{
						//Recherche de l'ID OCS du poste
						$requete = "SELECT ".TAB_OCS_HARD.".*,
						".TAB_OCS_BIOS.".".COL_OCS_BIOS_SNUM."
						FROM ".TAB_OCS_HARD." 
						  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
						WHERE ".CONSTANT("OCS_CRIT_OCS".$_GET["agence_id"])."='".addslashes($tab_hard[constant("OCS_CRIT_BASE".$_GET["agence_id"])][$i])."'";
						$tab_ocs_hard = $req1->db_use_query($requete);
						if (count($tab_ocs_hard) > 0)
						{
							$liste_alias = TAB_OCS_SOFT.".".COL_OCS_SOFT_NAME."='".implode("' OR ".TAB_OCS_SOFT.".".COL_OCS_SOFT_NAME."='",$tab_alias["ocs_soft_name"])."'";
							$requete = "SELECT ".TAB_OCS_SOFT.".*,
							".constant("OCS_CRIT_OCS".$_GET["agence_id"])." AS crit_ocs,
							".TAB_OCS_HARD.".".COL_OCS_LASTDATE."
							FROM ".TAB_OCS_SOFT." 
							  LEFT JOIN ".TAB_OCS_HARD." ON ".TAB_OCS_HARD.".".COL_OCS_HARD_ID." = ".TAB_OCS_SOFT.".".COL_OCS_SOFT_HARDID." 
							  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
							WHERE ".TAB_OCS_SOFT.".".COL_OCS_SOFT_HARDID."='".$tab_ocs_hard[0][COL_OCS_HARD_ID]."' AND (".$liste_alias.")";
							$tab_softs_ocs = $req1->db_use_query($requete);
							
							if (count($tab_softs_ocs) > 0)
							{
								$j = 0;
								while ($j < count($tab_softs_ocs))
								{
									$template->assign_block_vars('tab_hard.header.list.ocs_status', array(
									  'TEXT' => $tab_softs_ocs[$j][COL_OCS_SOFT_NAME].' '.$tab_softs_ocs[$j][COL_OCS_SOFT_VERSION],
									  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/i_ocs.png',
									));			
									
									$j++;
								}
							}
							// Logiciel non install�
							else
							{
								
								$template->assign_block_vars('tab_hard.header.list.ocs_status', array(
								  'TEXT' => '<font color=#D00>'.$lang["adm_soft_noinstall"].'</font>',
								  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/i_ocs_nok.png',
								));	
							}

						}
						// Poste non trouv� dans OCS
						else
						{
								$template->assign_block_vars('tab_hard.header.list.ocs_status', array(
								  'TEXT' => $lang["adm_hardsoft_ocsnohard"],
								  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/i_ocs_warn.png',
								));	
						}
						
						
						$connect_ocs->connection();
					}
					
					$connect_ocs = new db_connect();
					$connect_ocs->connection();

				}
				// Pas d'OCS ou pas d'alias
				else
				{

					if (count($tab_hardsoft) > 0)
						$key = array_search($tab_hard["id"][$i],$tab_hardsoft["hardware_id"]);
					else
						$key = FALSE;

					//Logiciel install�
					if ($key !== FALSE)
					{
						//A jour
						if ($tab_hardsoft["lastv"][$key] == $tab_soft[0]["dern_version_num"])
						{
							$template->assign_block_vars('tab_hard.header.list.status', array(
							  'TEXT' => '<font color=#0B0>'.$lang["adm_hardsoft_installedversion"].txt_to_na($tab_hardsoft["lastv"][$key]).' ('.txt_to_na(format_date_to_aff($tab_hardsoft["version_date_maj"][$key])).')'.'</font>',
							  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/i_ouapi.png',
							));		
							
							//Supprimer
							$template->assign_block_vars('tab_hard.header.list.status.tools', array(
							  'FORM_ID' => 'form_delsoft_'.$tab_hard["id"][$i],
							  'HARD_ID' => $tab_hard["id"][$i],
							  'ACTION_NAME' => 'del_soft',
							  'BUTTON_TEXT' => $lang["delete"],
							  'BUTTON_IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/del.gif',
							));

						}
						// Pas � jour
						elseif ($tab_hardsoft["lastv"][$key] < $tab_soft[0]["dern_version_num"])
						{
							$template->assign_block_vars('tab_hard.header.list.status', array(
							  'TEXT' => '<font color=#FFA500>'.$lang["adm_hardsoft_installedversion"].txt_to_na($tab_hardsoft["lastv"][$key]).' ('.txt_to_na(format_date_to_aff($tab_hardsoft["version_date_maj"][$key])).')'.'</font>',
							  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/i_ouapi.png',
							));							
							
							//Supprimer
							$template->assign_block_vars('tab_hard.header.list.status.tools', array(
							  'FORM_ID' => 'form_delsoft_'.$tab_hard["id"][$i],
							  'HARD_ID' => $tab_hard["id"][$i],
							  'ACTION_NAME' => 'del_soft',
							  'BUTTON_TEXT' => $lang["delete"],
							  'BUTTON_IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/del.gif',
							));

							// MAJ
							$template->assign_block_vars('tab_hard.header.list.status.tools', array(
							  'FORM_ID' => 'form_addsoft_'.$tab_hard["id"][$i],
							  'HARD_ID' => $tab_hard["id"][$i],
							  'ACTION_NAME' => 'add_soft',
							  'BUTTON_TEXT' => $lang["adm_hardsoft_maj"],
							  'BUTTON_IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/maj_mini.gif',
							));
						}

					}
					//Non install�
					else
					{
						$template->assign_block_vars('tab_hard.header.list.status', array(
						  'TEXT' => '<font color=#D00>'.$lang["adm_soft_noinstall"].'</font>',
						  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/i_ouapi_nok.png',
						));		
						
						// Ajouter
						$template->assign_block_vars('tab_hard.header.list.status.tools', array(
						  'FORM_ID' => 'form_addsoft_'.$tab_hard["id"][$i],
						  'HARD_ID' => $tab_hard["id"][$i],
						  'ACTION_NAME' => 'add_soft',
						  'BUTTON_TEXT' => $lang["add"],
						  'BUTTON_IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add.gif',
						));
					}
				}
				
				$i++;
			}
		}
		else
		{
			/******/
			/***************************AFFICHAGE A FAIRE "PAS DE RESULTAT" *******************************/
			/*****/
		}
	}
	/*		    Lister a partir de la base OCS       */
	elseif (isset($_GET["ocs_id"]))
	{
		$template->assign_block_vars('soft_infos', array(
		  'NAME' => urldecode(unserialize($_GET["ocs_id"])),
		  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
		));	
		
		$connect_ocs = new db_connect();
		$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

		// Si OCS configur� et connect�
		if (mysql_error() == '' && defined("OCS_MASK_TYPE".intval(intval($_GET["agence_id"]))))
		{
			$template->assign_vars(array(
			  'CAT_TITLE' => $lang["fiche_ocs_soft_title"],
			));
			
			$template->assign_block_vars('tab_hard', array());
						
			$requete = "SELECT ".TAB_OCS_HARD.".*,
			".TAB_OCS_BIOS.".".COL_OCS_BIOS_SNUM.",
			".TAB_OCS_BIOS.".".COL_OCS_BIOS_TYPE." AS biostype
			FROM ".TAB_OCS_HARD." 
			  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
			WHERE ".CONSTANT("OCS_MASK_TYPE".intval($_GET["agence_id"]))." LIKE '".str_replace('*','%',CONSTANT("OCS_MASK".intval($_GET["agence_id"])))."'";
			$tab = $req1->db_use_query($requete);

			$template->assign_block_vars('tab_hard.header', array(
				'TYPE_NAME' => $lang["fiche_ocs_soft_installed_title"],
				'L_HARDNAME' => $lang["gen_hardname"],
				'L_USER' => $lang["user"],
				'L_SERIAL' => $lang["serial"],
				'L_VERSION' => $lang["gen_version"],
			));						
			
			if (count($tab) > 0)
			{
				$i = 0;
				while ($i < count($tab))
				{
					
					// Liste des mat�riels
					$template->assign_block_vars('tab_hard.header.list', array(
						'L_HARDNAME' => $tab[$i][COL_OCS_HARD_NAME],
						'L_USER' => txt_to_na(trim($tab[$i][COL_OCS_USERID])),
					));	

					$requete = "SELECT ".TAB_OCS_SOFT.".*,
					".TAB_OCS_HARD.".".COL_OCS_HARD_ID.",
					".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID."
					FROM ".TAB_OCS_SOFT." 
					  LEFT JOIN ".TAB_OCS_HARD." ON ".TAB_OCS_HARD.".".COL_OCS_HARD_ID." = ".TAB_OCS_SOFT.".".COL_OCS_SOFT_HARDID." 
					  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
					WHERE ".TAB_OCS_SOFT.".".COL_OCS_SOFT_HARDID."='".$tab[$i][COL_OCS_HARD_ID]."' AND ".TAB_OCS_SOFT.".".COL_OCS_SOFT_NAME."='".urldecode(unserialize($_GET["ocs_id"]))."'";
					$tab_softs_ocs = $req1->db_use_query($requete);
					
					// Logiciel install�
					if (count($tab_softs_ocs) > 0)
					{
						$j = 0;
						while ($j < count($tab_softs_ocs))
						{
							$template->assign_block_vars('tab_hard.header.list.ocs_status', array(
							  'TEXT' => '<font color=#0B0>'.$tab_softs_ocs[$j][COL_OCS_SOFT_NAME].' '.$tab_softs_ocs[$j][COL_OCS_SOFT_VERSION].'</font>',
							  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/i_ocs.png',
							));			
							
							$j++;
						}
					}
					// Logiciel non install�
					else
					{
						
						$template->assign_block_vars('tab_hard.header.list.ocs_status', array(
						  'TEXT' => '<font color=#D00>'.$lang["adm_soft_noinstall"].'</font>',
						  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/i_ocs_nok.png',
						));	
					}
					
					$i++;
				}
			}
			else
			{
				/******/
				/***************************AFFICHAGE A FAIRE "PAS DE RESULTAT" *******************************/
				/*****/
			}
		}
		else
		{
			/******/
			/***************************AFFICHAGE A FAIRE "OCS PAS CONFIGURE" *******************************/
			/*****/
		}
		
	}

}

