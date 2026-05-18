<?php

declare(strict_types=1);

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2014 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use;
$affichage = '';

/**
 * Return the list of software custom field columns for TAB_SOFT.
 */
function get_soft_pfield_columns($db): array
{
    if (!isset($db->connection) || $db->connection === null) {
        $db->connection();
    }

    $columns = [];
    $query = "SHOW COLUMNS FROM " . TAB_SOFT . " LIKE 'pfield_%'";
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

// Mise � jour d'un logiciel sur un poste
if (isset($_GET['action']) && $_GET['action'] == 'MAJ_hard' )
{
	if (isset($_POST['soumettre']))
	{
		$s_id = $_POST['s_id'];
		$h_id = $_GET['h_id'];
		
		// Si une version d'installation a �t� pr�cis�e
		if (isset($_POST['soft_version']) &&  $_POST['soft_version'] != '')
		{
			$version = format_string_db($_POST['soft_version']);
			$date = date("Y-m-d");

		}
		//Sinon on prends le num�ro de la derni�re version
		else
		{
			$requete = "SELECT * FROM ".TAB_SOFT." WHERE id='".$s_id."'";
			$tab_soft = $req1->db_use_query($requete);
			
			if (count($tab_soft > 0))
				$version = $tab_soft[0]["dern_version_num"];
			else
				$version = 0;			
				$date = date("Y-m-d");
		}

		$requete = "INSERT INTO ".TAB_HARDSOFT." (hardware_id,software_id,version_date_maj,version_num,user_maj_id)
		VALUES ('".$h_id."','".$s_id."','".$date."','".$version."','".$_SESSION["user_id"]."')";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["return_update_ok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
		
		$template->assign_block_vars('form_post.back', array(
			'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
			'BACK' => $lang["return"]	,
		));			
	}
	else
	{
		// On affiche seulement les mat�riels concern�s par les mises � jour
		// $tab_mht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='maj_hardtype'");
		// $type_id = str_replace(';','\' OR '.TAB_HARD.'.type_id=\'','('.TAB_HARD.'.type_id=\''.substr($tab_mht[0]["valeur"],0,-1).'\')');
		
		// $requete = "SELECT ".TAB_HARD.".nom,
		  // ".TAB_HARD.".id AS id_hard,
		  // ".TAB_HARD.".user_id,
		  // ".TAB_USERS.".id AS id_user,
		  // ".TAB_USERS.".nom AS nom_user,
		  // ".TAB_USERS.".prenom AS prenom_user,
		  // ".TAB_HARD_TYPE.".libelle AS type_libelle
		// FROM ".TAB_HARD." 
		  // LEFT JOIN ".TAB_USERS." ON ".TAB_HARD.".user_id = ".TAB_USERS.".id
		  // LEFT JOIN ".TAB_HARD_TYPE." ON ".TAB_HARD.".type_id = ".TAB_HARD_TYPE.".id
		// WHERE ".TAB_HARD.".agence_id='".$_GET['agence_id']."'  AND ".$type_id." AND suivi_rebus=''
		// ORDER BY type_libelle, nom";
		// $tab_hard = $req1->db_use_query($requete);
		
		// $template->assign_block_vars('select', array(
		  // 'L_TITLE' => $lang["adm_soft_title"],
		// ));
		
		// if (count($tab_hard) > 0)
		// {	
			// $template->assign_block_vars('select.tab_hard', array(
			  // 'TITLE_HARDTYPE' => $lang["adm_soft_hardtype"],
			  // 'TITLE_HARDNAME' => $lang["adm_soft_hardname"],
			  // 'TITLE_USERNAME' => $lang["adm_soft_username"],
			  // 'TITLE_VNUMINST' => $lang["adm_soft_vnuminstalled_title"],
			  // 'TITLE_LASTVNUM' => $lang["adm_soft_lastvnuminouapi_title"],
			  // 'TITLE_ADDTOOLS' => $lang["adm_soft_addupdatetools"],
			  // 'TITLE_TOOLS' => $lang["adm_soft_othertools"],
			// ));

		// }
		// else
		// {
			// $template->assign_block_vars('select.no_hard', array(
			  // 'TEXT' => $lang["adm_soft_nohard"],
			// ));
		// }


		// Seul le logiciel est pr�cis�, pas le mat�riel
		if (isset($_GET["s_id"]))
		{
			$requete = "SELECT ".TAB_SOFT.".* FROM ".TAB_SOFT." WHERE id='".$_GET['s_id']."'";
			$tab_soft = $req1->db_use_query($requete);
			
			$j = 0;
			while ($j < count($tab_hard))
			{
				$requete = "SELECT ".TAB_HARDSOFT.".* FROM ".TAB_HARDSOFT." 
				WHERE software_id='".$_GET['s_id']."' AND hardware_id='".$tab_hard[$j]["id_hard"]."'
				ORDER BY version_num DESC, version_date_maj DESC";
				$tab_liaison = $req1->db_use_query($requete);					

				$template->assign_block_vars('select.tab_hard.list', array(
				  'HARDTYPE' => $tab_hard[$j]["type_libelle"],
				  'HARDNAME' => $tab_hard[$j]["nom"],
				  'USERNAME' => txt_to_na($tab_hard[$j]["nom_user"].' '.$tab_hard[$j]["prenom_user"]),
				  'L_VNUMTOINST' => $lang["adm_soft_vnuminstall"],
				  'VNUMTOINST' => $tab_soft[0]["dern_version_num"],
				  'IMG_DEL' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
				  'H_ID' => $tab_hard[$j]["id_hard"],
				  'S_ID' => $_GET['s_id'],
				  'L_INSTALL' => $lang["gen_install"],
				  'TITLE_DEL' => $lang["adm_soft_uninst"],
				  'LINK_DEL' => 'index.php?page=adm_logiciels.php&action=reset&h_id='.$tab_hard[$j]["id_hard"].'&s_id='.$_GET["s_id"],
				));
				
				// Version a jour (Install�e = Derni�re dispo)
				if (count($tab_liaison) > 0 && $tab_liaison[0]["version_num"] == $tab_soft[0]["dern_version_num"])
				{
					$template->assign_block_vars('select.tab_hard.list.status', array(
					  'VNUM' => $lang["adm_soft_vnuminstalled"].' '.txt_to_na($tab_liaison[0]["version_num"]),
					  'VDATE' => format_date_to_aff($tab_liaison[0]["version_date_maj"]),
					  'LASTVNUM' => $lang["adm_soft_lastvnuminouapi"].' '.txt_to_na($tab_soft[0]["dern_version_num"]),
					  'LASTVDATE' => format_date_to_aff($tab_soft[0]["dern_version_date"]),
					  'STYLE' => 'color:green',
					));
				}
				// Version install�e plus r�cente que derni�re dispo (Install�e > Derni�re dispo)
				elseif (count($tab_liaison) > 0 && $tab_liaison[0]["version_num"] > $tab_soft[0]["dern_version_num"])
				{
					$template->assign_block_vars('select.tab_hard.list.status', array(
					  'VNUM' => $lang["adm_soft_vnuminstalled"].' '.txt_to_na($tab_liaison[0]["version_num"]),
					  'VDATE' => format_date_to_aff($tab_liaison[0]["version_date_maj"]),
					  'LASTVNUM' => $lang["adm_soft_lastvnuminouapi"].' '.txt_to_na($tab_soft[0]["dern_version_num"]),
					  'LASTVDATE' => format_date_to_aff($tab_soft[0]["dern_version_date"]),
					  'STYLE' => 'color:violet',
					));
				}
				// Version pas � jour (Install�e < Derni�re dispo)
				elseif (count($tab_liaison) > 0 && $tab_liaison[0]["version_num"] < $tab_soft[0]["dern_version_num"])
				{
					$template->assign_block_vars('select.tab_hard.list.status', array(
					  'VNUM' => $lang["adm_soft_vnuminstalled"].' '.txt_to_na($tab_liaison[0]["version_num"]),
					  'VDATE' => format_date_to_aff($tab_liaison[0]["version_date_maj"]),
					  'LASTVNUM' => $lang["adm_soft_lastvnuminouapi"].' '.txt_to_na($tab_soft[0]["dern_version_num"]),
					  'LASTVDATE' => format_date_to_aff($tab_soft[0]["dern_version_date"]),
					  'STYLE' => 'color:red',
					));
				}
				// Non install�e
				else
				{
					$template->assign_block_vars('select.tab_hard.list.status', array(
					  'VNUM' => '<font color=#D00>'.$lang["adm_soft_noinstall"].'</font>',
					  'VDATE' => txt_to_na(''),
					  'LASTVNUM' => $lang["adm_soft_lastvnuminouapi"].' '.txt_to_na($tab_soft[0]["dern_version_num"]),
					  'LASTVDATE' => format_date_to_aff($tab_soft[0]["dern_version_date"]),
					  'STYLE' => 'color:red',
					));
				}			
				$j++;
			}
		
		}
		else
		{
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_soft_title"],
			));

			$requete_hard = "SELECT * FROM ".TAB_HARD." WHERE id='".$_GET["h_id"]."'";
			$tab_hard = $req1->db_use_query($requete_hard);
		
			$requete = "SELECT * FROM ".TAB_SOFT." WHERE (agence_id='0' OR agence_id='".$tab_hard[0]["agence_id"]."') ORDER BY nom";
			$tab_soft2 = $req1->db_use_query($requete);
			
			// Selection du logiciel � installer
			
			$i = 0;
			$compteur = 0;
			while ($i < count($tab_soft2))
			{
				$requete = "SELECT * FROM ".TAB_HARDSOFT." WHERE hardware_id='".$_GET["h_id"]."' AND software_id='".$tab_soft2[$i]["id"]."'";
				$tab_liaison = $req1->db_use_query($requete);

				// On ne r�affiche pas les logiciels d�j� install�s
				if (count($tab_liaison) == 0)
				{
					if ($compteur == 0)
					{
						$template->assign_block_vars('form.soft_select', array(
						  'TITLE' => $lang["soft"],
						));				
					}
					
					if (num_to_empty($tab_soft2[$i]["dern_version_num"]) != '')
						$version = ' - '.$lang["gen_version"].': '.$tab_soft2[$i]["dern_version_num"];
					else
						$version = '';
						
						$softname = $tab_soft2[$i]["nom"].$version;
						
						$template->assign_block_vars('form.soft_select.list', array(
							'ID' => $tab_soft2[$i][SO_ID],
							'LIBELLE' => $softname,
						));

					$compteur++;
				}
				$i++;
			}

			if ($compteur != 0)
			{
				$template->assign_block_vars('form.button', array(
				  'TITLE' => $lang["gen_install"],
				));
			}
			// Aucun logiciel
			else
			{
				$template->assign_block_vars('no_select', array(
				  'TEXT' => $lang["adm_soft_nosoftinstall"],
				));					

			}

		}							
		
		// if (isset($_GET["s_id"]) && isset($_GET["h_id"]))
		// {
			// $aff_fiches = new fiche($lang);	
			// $affichage .= $aff_fiches->aff_histo_soft($id_soft,$id_hard);
		// }
	}
}

// D�sinstaller un ou plusieurs logiciels
elseif (isset($_GET['action']) && $_GET['action'] == 'reset')
{
	if (isset($_GET['s_id']))
		$requete = "DELETE FROM ".TAB_HARDSOFT." WHERE hardware_id='".$_GET['h_id']."' AND software_id='".$_GET['s_id']."'";
	else
		$requete = "DELETE FROM ".TAB_HARDSOFT." WHERE hardware_id='".$_GET['h_id']."'";
	$tab = $req1->db_use_query($requete);

	$template->assign_block_vars('form_post', array(
		'OK' => $lang["adm_soft_resetreturn"], 					
		'CLOSE' => $lang["close"],	
		'ID' => 'mess_retour'
	));			
}

/*****************************/
/*      Ajout d'un logiciel      */
/*****************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'Ajouter')
{
	if (isset($_POST['soumettre']))
	{
		$nom = format_string_db($_POST['nom']);
		$marque_id = $_POST['marque_id'];
		$dern_version_num = format_string_db($_POST['dern_version_num']);
		$site = $_POST['site_id'];
		$commentaire = format_text_db($_POST['commentaire']);		
		$dern_version_date = substr($_POST['date_version'],6,4).'-'.substr($_POST['date_version'],3,2).'-'.substr($_POST['date_version'],0,2);

		// Colonnes perso
		$pfields_names = '';
		$pfields_values = '';

		$pfieldColumns = get_soft_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$pfields_names .= ',' . $fieldName;
			$pfields_values .= ",'" . format_string_db($_POST[$fieldName]) . "'";
		}
		
		$requete = "INSERT INTO ".TAB_SOFT." (nom,marque_id,dern_version_num,dern_version_date,agence_id,commentaire".$pfields_names.")
		VALUES ('".$nom."','".$marque_id."','".$dern_version_num."','".$dern_version_date."','".$site."','".$commentaire."'".$pfields_values.")";

		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_soft_addok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{		
		$requete = "SELECT * FROM ".TAB_AGENCES." WHERE id='".$_GET["agence_id"]."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_soft_add"],
		  'ACTION' => 'index.php?page=adm_logiciels.php&action=Ajouter'
		));

		// Nom
		$template->assign_block_vars('form.softname', array(
		  'TITLE' => $lang["adm_soft_name"],
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'required',
		));

		// Editeur du logiciel
		$tab_publ = $req1->db_use_query("SELECT * FROM ".TAB_SOFT_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_soft_publisher"],
		));
		
		$i = -1;
		$tab_publ[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab_publ)-1)
		{
			$template->assign_block_vars('form.marque.list', array(
			  'ID' => $tab_publ[$i]['id'],
			  'LIBELLE' => $tab_publ[$i]['libelle']
			));
			$i++;
		}

		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.marque.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&table=hard_marque&action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		
		// Version
		$template->assign_block_vars('form.vnum', array(
		  'TITLE' => $lang["adm_soft_lastvnum"],
		  'NAME' => 'dern_version_num'
		));
		
		// Date de version
		$template->assign_block_vars('form.vdate', array(
		  'TITLE' => $lang["adm_soft_lastvdate"],
		  'NAME' => 'date_version'
		));

		$template->assign_block_vars('form.vdate.action', array(
		  'IMG_CALENDAR' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		));
					
		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["adm_soft_site"],
			));

			$options = array('libelle' => array($lang["adm_soft_allsites"],$tab[0]["libelle"]), 'value' => array(0,$_GET["agence_id"]), 'checked' => array('checked',''));
			$i =0;
			while ($i < count($options["libelle"]))
			{
				$template->assign_block_vars('form.multisite.list', array(
				  'VALUE' => $options['value'][$i],
				  'LIBELLE' => $options['libelle'][$i],
				  'CHECKED' => $options['checked'][$i]
				));
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'SITE_ID' => $_GET["agence_id"]
			));	
		}
			
		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		));
		
		// Colonnes perso
		$pfieldColumns = get_soft_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $lang["s_".TAB_SOFT.".". $fieldName],
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));
		
		if (PARAM_HELP == 1)
		{
			$template->assign_block_vars('form.help', array(
				'TITLE' => $lang["gen_help"],
				'TEXT' => $lang["help"][4]
			));
		}

	}
}
/*****************************************/
/*      Ajout d'un logiciel par OCS      */
/*****************************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'add_ocs') 
{
	if (isset($_POST['soumettre']))
	{
		$nom = format_string_db($_POST['nom']);
		$marque_id = $_POST['marque_id'];
		$dern_version_num = format_string_db($_POST['dern_version_num']);
		$site = $_POST['site_id'];
		$commentaire = format_text_db($_POST['commentaire']);		
		$dern_version_date = substr($_POST['date_version'],6,4).'-'.substr($_POST['date_version'],3,2).'-'.substr($_POST['date_version'],0,2);

		// Colonnes perso
		$pfields_names = '';
		$pfields_values = '';

		$pfieldColumns = get_soft_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$pfields_names .= ',' . $fieldName;
			$pfields_values .= ",'" . format_string_db($_POST[$fieldName]) . "'";
		}

		$requete = "INSERT INTO ".TAB_SOFT." (nom,marque_id,dern_version_num,dern_version_date,agence_id,commentaire".$pfields_names.")
		VALUES ('".$nom."','".$marque_id."','".$dern_version_num."','".$dern_version_date."','".$site."','".$commentaire."'".$pfields_values.")";

		$tab = $req1->db_use_query($requete);

		// Connexion � la base OCS
		$ouapi_soft_id = mysqli_insert_id($req1->connection);
		
		$connect_ocs = new db_connect();
		$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

		$tab_ocs = $req1->db_use_query("SELECT * FROM ".TAB_OCS_SOFT." WHERE ".COL_OCS_SOFT_ID."='".intval($_GET["ocs_id"])."'");	
		$nom = $tab_ocs[0][COL_OCS_SOFT_NAME];
		$visible = 1;

		$connect->connection();
		
		$requete = "INSERT INTO ".TAB_SOFT_OCS_ALIAS." (ocs_soft_name,ouapi_soft_id,visible)
		VALUES ('".$nom."','".$ouapi_soft_id."','".$visible."')";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_soft_addok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{		
		// Connexion � la base OCS
		$connect_ocs = new db_connect();
		$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

		$tab_ocs = $req1->db_use_query("SELECT * FROM ".TAB_OCS_SOFT." WHERE ".COL_OCS_SOFT_ID."='".intval($_GET["ocs_id"])."'");	
		$nom = $tab_ocs[0][COL_OCS_SOFT_NAME];
		$version = $tab_ocs[0][COL_OCS_SOFT_VERSION];
		$editeur = $tab_ocs[0][COL_OCS_SOFT_PUBLISHER];

		$connect->connection();

		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_soft_add"],
		  'ACTION' => 'index.php?page=adm_logiciels.php&action=add_ocs&ocs_id='.intval($_GET["ocs_id"]),
		));
		
		$template->assign_block_vars('form.source_head', array(
		  'L_BASEINFO' => $lang["adm_soft_baseinfo"],
		  'L_OCSINFO' => $lang["adm_soft_ocsinfo"],
		));

		$template->assign_block_vars('form.softname', array(
		  'TITLE' => $lang["adm_soft_name"],
		  'VALUE' => $nom,
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'ok',
		));

		$template->assign_block_vars('form.softname.ocs', array(
		  'VALUE' => $nom,
		));

		// Editeur du mat�riel
		$tab_publ = $req1->db_use_query("SELECT * FROM ".TAB_SOFT_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_soft_publisher"],
		));
		
		$i = -1;
		$marque_exist = 0;
		$tab_publ[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab_publ)-1)
		{
			if (strtoupper($tab_publ[$i]["libelle"]) == strtoupper($editeur))
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab_publ[$i]['id'],
				  'LIBELLE' => $tab_publ[$i]['libelle'],
				  'SELECTED' => 'selected'
				));
				$marque_exist = $tab_publ[$i]['id'];
			}
			else
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab_publ[$i]['id'],
				  'LIBELLE' => $tab_publ[$i]['libelle']
				));
			}
			$i++;
		}

		$template->assign_block_vars('form.marque.ocs', array(
		  'VALUE' => $editeur,
		));

		// Version
		$template->assign_block_vars('form.vnum', array(
		  'TITLE' => $lang["adm_soft_lastvnum"],
		  'NAME' => 'dern_version_num',
		  'VALUE' => $version,
		));
		
		// Version
		$template->assign_block_vars('form.vnum.ocs', array(
		  'VALUE' => txt_to_na($version),
		));

		//Date de version
		$template->assign_block_vars('form.vdate', array(
		  'TITLE' => $lang["adm_soft_lastvdate"],
		  'NAME' => 'date_version'
		));
		
		$template->assign_block_vars('form.vdate.action', array(
		  'IMG_CALENDAR' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		));
		
		$template->assign_block_vars('form.vdate.action', array());

		// Agence
		$requete = "SELECT * FROM ".TAB_AGENCES." WHERE id='".$_GET["agence_id"]."'";
		$tab = $req1->db_use_query($requete);
		
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["adm_soft_site"],
			));

			$options = array('libelle' => array($lang["adm_soft_allsites"],$tab[0]["libelle"]), 'value' => array(0,$_GET["agence_id"]), 'checked' => array('checked',''));
			$i =0;
			while ($i < count($options["libelle"]))
			{
				$template->assign_block_vars('form.multisite.list', array(
				  'VALUE' => $options['value'][$i],
				  'LIBELLE' => $options['libelle'][$i],
				  'CHECKED' => $options['checked'][$i]
				));
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('form.monosite', array(
			  'SITE_ID' => $_GET["agence_id"]
			));	
		}
			
		//Commentaires
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		));

		// Colonnes perso
		$pfieldColumns = get_soft_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $lang["s_".TAB_SOFT.".". $fieldName],
			));
		}
		
		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));
			
		if (PARAM_HELP == 1)
		{
			$template->assign_block_vars('form.help', array(
				'TITLE' => $lang["gen_help"],
				'TEXT' => $lang["help"][4]
			));
		}

		/////////////////////////////
		//     BOUTONS ACTIONS     //
		/////////////////////////////
		
		$template->assign_block_vars('form.softname.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		  'LIBELLE' => $lang["ocs_syncok"],
		));

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
				  'LINK' => 'index.php?page=adm_tables.php&table=soft_marque&action=Ajouter&valeur='.$tab_ocs[0][COL_OCS_SOFT_PUBLISHER],
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
		
		$template->assign_block_vars('form.vnum.valid', array(
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_ok.gif',
		  'LIBELLE' => $lang["ocs_syncok"],
		));

	}
}

/***************************************/
/*      Suppression d'un logiciel      */
/***************************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'suppr')
{
	if (isset($_POST['soumettre']))
	{
		$s_id = $_GET['s_id'];
		
		$requete = "DELETE FROM ".TAB_SOFT." WHERE ".SO_ID."='".$s_id."'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_HARDSOFT." WHERE ".HS_SOFTID."='".$s_id."'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_SOFT_OCS_ALIAS." WHERE ".SO_AL_OUAPISOFTID."='".$s_id."'";
		$tab = $req1->db_use_query($requete);
		$requete = "DELETE FROM ".TAB_LIAISON_DOCS." WHERE ".DO_LI_SOFTID."='".$s_id."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_soft_delok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{			
		$requete = "SELECT * FROM ".TAB_SOFT." WHERE id='".$_GET['s_id']."'";
		$tab_soft = $req1->db_use_query($requete);
						
		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_soft_del"],
		  'ACTION' => 'index.php?page=adm_logiciels.php&action=suppr&s_id='.$_GET['s_id'],
		));

		$template->assign_block_vars('form.softname', array(
		  'TITLE' => $lang["adm_soft_name"],
		  'VALUE' => $tab_soft[0]["nom"],
		  'DISABLED' => 'disabled',
		));
					
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $tab_soft[0]["commentaire"],
		  'DISABLED' => 'disabled',
		));
		
		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["delete"],
		));
			
	}
}

/*******************************/
/*      Edition d'un logiciel  */
/*******************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'Edit')
{
	if (isset($_POST['soumettre']))
	{
		$nom = format_string_db($_POST['nom']);
		$marque_id = $_POST['marque_id'];
		$commentaire = format_text_db($_POST['commentaire']);

		// Colonnes perso
		$pfields_update = '';

		$pfieldColumns = get_soft_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$pfields_update .= "," . $fieldName . "='" . format_string_db($_POST[$fieldName]) . "'";
		}

		$requete = "UPDATE ".TAB_SOFT." SET nom='".$nom."', marque_id='".$marque_id."', commentaire='".$commentaire."'".$pfields_update." WHERE id='".$_GET['id']."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_soft_editok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{
		$requete = "SELECT * FROM ".TAB_SOFT." WHERE id='".$_GET['s_id']."'";
		$tab_soft = $req1->db_use_query($requete);

		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_soft_title_edit"],
		  'ACTION' => 'index.php?page=adm_logiciels.php&amp;action=Edit&amp;id='.$_GET['s_id'],
		));

		// Editeur du logiciel
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_SOFT_MARQUE." ORDER BY libelle");
		
		$template->assign_block_vars('form.marque', array(
		  'TITLE' => $lang["adm_soft_publisher"],
		));
		
		$i = -1;
		$tab[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab)-1)
		{
			if ($tab[$i]["id"] == $tab_soft[0]["marque_id"])
			{
				$template->assign_block_vars('form.marque.list', array(
				  'ID' => $tab[$i]['id'],
				  'LIBELLE' => $tab[$i]['libelle'],
				  'SELECTED' => 'selected="selected"'
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

		if ((preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
		{
			$template->assign_block_vars('form.marque.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=hard_marque&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}

		$template->assign_block_vars('form.softname', array(
		  'TITLE' => $lang["adm_soft_name"],
		  'VALUE' => $tab_soft[0]["nom"],
		  'ID' => 'ok',
		));
		
		$requete = "SELECT * FROM ".TAB_AGENCES." WHERE id='".$_GET["agence_id"]."'";
		$tab_agence = $req1->db_use_query($requete);

		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["adm_soft_site"],
			));

			if (count($tab_agence) == 0 && $tab_soft[0]["agence_id"] == 0)
				$options = array('libelle' => array($lang["adm_soft_allsites"]), 'value' => array(0), 'checked' => array('checked="checked" disabled="disabled"'));
			elseif ($tab_soft[0]["agence_id"] == 0)
				$options = array('libelle' => array($lang["adm_soft_allsites"],$tab_agence[0]["libelle"]), 'value' => array(0,$_GET["agence_id"]), 'checked' => array('checked="checked" disabled="disabled"','disabled="disabled"'));
			else
				$options = array('libelle' => array($lang["adm_soft_allsites"],$tab_agence[0]["libelle"]), 'value' => array(0,$_GET["agence_id"]), 'checked' => array('disabled','checked="checked" disabled="disabled"'));
			
			$i =0;
			while ($i < count($options["libelle"]))
			{
				$template->assign_block_vars('form.multisite.list', array(
				  'VALUE' => $options['value'][$i],
				  'LIBELLE' => $options['libelle'][$i],
				  'CHECKED' => $options['checked'][$i]
				));
				$i++;
			}
		}

		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["comment"],
		  'VALUE' => $tab_soft[0]["commentaire"],
		));

		// Colonnes perso
		$pfieldColumns = get_soft_pfield_columns($req1);

		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'VALUE' => format_string_input($tab_soft[0][$fieldName] ?? ''),
			  'TITLE' => $lang["s_".TAB_SOFT.".". $fieldName] ?? $fieldName,
			));
		}

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["edit"],
		));
	}
}
/*******************************/
/*      Signaler une MAJ         */
/*******************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'maj')
{
	if (isset($_POST['soumettre']))
	{
		$vdate = substr($_POST['vdate'],6,4).'-'.substr($_POST['vdate'],3,2).'-'.substr($_POST['vdate'],0,2);
		
		$requete = "UPDATE ".TAB_SOFT." SET dern_version_num='".$_POST['vnum']."', dern_version_date='".$vdate."' WHERE id='".$_GET['id']."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_soft_majok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{		
		$requete = "SELECT ".TAB_SOFT.".*, 			  
		  ".TAB_SOFT_MARQUE.".libelle AS l_marque
		FROM ".TAB_SOFT."
		  LEFT JOIN ".TAB_SOFT_MARQUE." ON ".TAB_SOFT.".marque_id = ".TAB_SOFT_MARQUE.".id
		WHERE ".TAB_SOFT.".id='".$_GET['s_id']."'";
		$tab_soft = $req1->db_use_query($requete);

		$template->assign_block_vars('soft_infos', array(
		  'NAME' => $tab_soft[0]["nom"],
		  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
		  'MARQUE' => $lang["adm_hardsoft_publisher"].txt_to_na($tab_soft[0]["l_marque"]),
		  'VERSION' => $lang["adm_hardsoft_vers"].txt_to_na($tab_soft[0]["dern_version_num"])
		  .$lang["adm_hardsoft_versdate"].txt_to_na(format_date_to_aff($tab_soft[0]["dern_version_date"])),
		));	

		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_soft_title_maj"],
		  'ACTION' => 'index.php?page=adm_logiciels.php&action=maj&id='.$_GET['s_id'],
		));
				
		$template->assign_block_vars('form.vnum', array(
		  'TITLE' => $lang["adm_soft_lastvnum"],
		  'VALUE' => txt_to_na($tab_soft[0]["dern_version_num"]),
		  'NAME' => 'dern_version_num',
		  'DISABLED' => 'disabled'
		));
		
		$template->assign_block_vars('form.vdate', array(
		  'TITLE' => $lang["adm_soft_lastvdate"],
		  'VALUE' => format_date_to_aff($tab_soft[0]["dern_version_date"],"/"),
		  'NAME' => 'dern_version_date',
		  'DISABLED' => 'disabled'
		));
		
		$template->assign_block_vars('form.vnum', array(
		  'TITLE' => $lang["adm_soft_vnum"],
		  'NAME' => 'vnum',
		));
		
		$template->assign_block_vars('form.vdate', array(
		  'TITLE' => $lang["adm_soft_vdate"],
		  'NAME' => 'vdate',
		  'VALUE' => date("d-m-Y").' ',
		));
		
		$template->assign_block_vars('form.vdate.action', array(
		  'IMG_CALENDAR' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		));

		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["gen_send"],
		));
	}
}
/**************************************/
/*      Masquer un logiciel OCS       */
/**************************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'hide_ocs_alias' )
{
	$ocs_soft_name = urldecode($_GET['ocs_name']);
	$ouapi_soft_id = 0;
	$visible = 0;
					
	$requete = "INSERT INTO ".TAB_SOFT_OCS_ALIAS." (ocs_soft_name,ouapi_soft_id,visible)
	VALUES ('".$ocs_soft_name."','".$ouapi_soft_id."','".$visible."')";
	$tab = $req1->db_use_query($requete);

	$template->assign_block_vars('form_post', array(
		'OK' => $lang["adm_soft_aliashide"], 					
		'CLOSE' => $lang["close"],	
		'ID' => 'mess_retour'
	));					
}
// Ajouter un alias OCS
elseif (isset($_GET['action']) && $_GET['action'] == 'add_ocs_soft_alias' )
{
	if (isset($_POST['soumettre']))
	{	
		$ocs_soft_name = $_POST['ocs_soft_name'];
		if (isset($_POST['soft_id']))
			$ouapi_soft_id = $_POST['soft_id'];
		else
			$ouapi_soft_id = 0;
		$visible = $_POST['visible'];
						
		$requete = "INSERT INTO ".TAB_SOFT_OCS_ALIAS." (ocs_soft_name,ouapi_soft_id,visible)
		VALUES ('".$ocs_soft_name."','".$ouapi_soft_id."','".$visible."')";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_soft_aliasok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));					
	}
	else
	{
		// Connexion � la base OCS
		$connect_ocs = new db_connect();
		$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);
		
		$requete = "SELECT * FROM ".TAB_OCS_SOFT." WHERE ".COL_OCS_SOFT_ID."='".$_GET["ocs_id"]."'";
		$tab_ocs = $req1->db_use_query($requete);		

		$template->assign_block_vars('form_ocs', array(
		  'TITLE' => $lang["adm_soft_title_add_alias"],
		  'ACTION' => 'index.php?page=adm_logiciels.php&action=add_ocs_soft_alias',
		));

		$template->assign_block_vars('form_ocs.softname', array(
		  'TITLE' => $lang["adm_soft_name"],
		  'VALUE' => utf8_decode($tab_ocs[0][COL_OCS_SOFT_NAME]),
		  'DISABLED' => 'disabled',
		  'ID' => 'large'
		));

		$connect_ocs->connection();
		$requete = "SELECT * FROM ".TAB_SOFT." WHERE agence_id='".$_GET["agence_id"]."' OR agence_id='0' ORDER BY nom";
		$tab_softs = $req1->db_use_query($requete);		

		$template->assign_block_vars('form_ocs.soft_alias', array(
		  'TITLE' => $lang["adm_soft_alias_name"],
		));

		$i = 0;
		while ($i < count($tab_softs))
		{
			$template->assign_block_vars('form_ocs.soft_alias.list', array(
			  'ID' => $tab_softs[$i]['id'],
			  'LIBELLE' => txt_to_na($tab_softs[$i]['nom']),
			));
			$i++;
		}

		if (preg_match('`;'.RGHT_SOFT_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form_ocs.soft_alias.action', array(
			  'LINK' => 'index.php?page=adm_logiciels.php&action=Ajouter&agence_id='.$_GET["agence_id"],
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}

		$template->assign_block_vars('form_ocs.visible', array(
		  'TITLE' => $lang["adm_soft_alias_visible"],
		));
		
		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0), 'checked' => array('checked',''),
		'onclick' => array('javascript:document.form.soft_id.disabled=false;document.form.ouapi_soft_version.disabled=false;','javascript:document.form.soft_id.disabled=true;document.form.ouapi_soft_version.disabled=true;'));
		$i =0;
		while ($i < count($options["libelle"]))
		{
			$template->assign_block_vars('form_ocs.visible.list', array(
			  'VALUE' => $options['value'][$i],
			  'LIBELLE' => $options['libelle'][$i],
			  'CHECKED' => $options['checked'][$i],
			  'ONCLICK' => $options['onclick'][$i],
			));
			$i++;
		}

		$template->assign_block_vars('form_ocs.ocs_soft_name', array(
		  'VALUE' => $tab_ocs[0][COL_OCS_SOFT_NAME],
		));

		$template->assign_block_vars('form_ocs.button', array(
		  'TITLE' => $lang["add"],
		));	

	}
}
// Editer un alias OCS
elseif (isset($_GET['action']) && $_GET['action'] == 'edit_ocs_soft_alias' )
{
	if (isset($_POST['soumettre']))
	{	
		$alias_id = $_POST['alias_id'];
		$ouapi_soft_id = $_POST['soft_id'];
		$visible = $_POST['visible'];
		
		$requete = "UPDATE ".TAB_SOFT_OCS_ALIAS." SET ouapi_soft_id='".$ouapi_soft_id."', visible='".$visible."' WHERE id='".$alias_id."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_soft_aliaseditok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));					
	}
	else
	{
		$requete = "SELECT * FROM ".TAB_SOFT_OCS_ALIAS." WHERE id='".$_GET["id"]."'";
		$tab = $req1->db_use_query($requete);		

		$template->assign_block_vars('form_ocs', array(
		  'TITLE' => $lang["adm_soft_title_add_alias"],
		  'ACTION' => 'index.php?page=adm_logiciels.php&action=edit_ocs_soft_alias',
		));

		$template->assign_block_vars('form_ocs.softname', array(
		  'TITLE' => $lang["adm_soft_ocs_name"],
		  'VALUE' => utf8_decode($tab[0]["ocs_soft_name"]),
		  'DISABLED' => 'disabled',
		  'ID' => 'large'
		));

		$template->assign_block_vars('form_ocs.visible', array(
		  'TITLE' => $lang["adm_soft_alias_visible"],
		));
		

		if ($tab[0]["visible"] == 1)
		{
			$status = '';
			$yes = 'checked';
			$no = '';
		}
		else
		{
			$status = 'disabled';
			$yes = '';
			$no = 'checked';
		}

		$options = array('libelle' => array($lang["gen_yes"],$lang["gen_no"]), 'value' => array(1,0), 'checked' => array($yes,$no),
		'onclick' => array('javascript:document.form.soft_id.disabled=false;document.form.ouapi_soft_version.disabled=false;','javascript:document.form.soft_id.disabled=true;document.form.ouapi_soft_version.disabled=true;'));
		$i =0;
		while ($i < count($options["libelle"]))
		{
			$template->assign_block_vars('form_ocs.visible.list', array(
			  'VALUE' => $options['value'][$i],
			  'LIBELLE' => $options['libelle'][$i],
			  'CHECKED' => $options['checked'][$i],
			  'ONCLICK' => $options['onclick'][$i],
			));
			$i++;
		}

		$requete = "SELECT * FROM ".TAB_SOFT." WHERE agence_id='".$_GET["agence_id"]."' OR agence_id='0' ORDER BY nom";
		$tab_softs = $req1->db_use_query($requete);		

		$template->assign_block_vars('form_ocs.soft_alias', array(
		  'TITLE' => $lang["adm_soft_alias_name"],
		  'DISABLED' => $status,
		));

		$i = 0;
		while ($i < count($tab_softs))
		{
			if ($tab[0]["ouapi_soft_id"] == $tab_softs[$i]["id"])
			{
				$template->assign_block_vars('form_ocs.soft_alias.list', array(
				  'ID' => $tab_softs[$i]['id'],
				  'LIBELLE' => txt_to_na($tab_softs[$i]['nom']),
				  'SELECTED' => 'selected'
				));
			}
			else
			{
				$template->assign_block_vars('form_ocs.soft_alias.list', array(
				  'ID' => $tab_softs[$i]['id'],
				  'LIBELLE' => txt_to_na($tab_softs[$i]['nom']),
				));
			}
			$i++;
		}

		if (preg_match('`;'.RGHT_SOFT_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form_ocs.soft_alias.action', array(
			  'LINK' => 'index.php?page=adm_logiciels.php&action=Ajouter&agence_id='.$_GET["agence_id"],
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}

		$template->assign_block_vars('form_ocs.alias_id', array(
		  'VALUE' => $_GET["id"],
		));

		$template->assign_block_vars('form_ocs.button', array(
		  'TITLE' => $lang["edit"],
		));	
	}
}
/***************************************************/
/*   Types de mat�riel possibles � mettre � jour   */
/***************************************************/
elseif (isset($_GET['config']))
{
	if (isset($_POST['soumettre']))
	{	
		$chaine = '';
		$i = 0;
		while ($i < $_POST["nb_type"])
		{
			if (isset($_POST["t_".$i]) && $_POST["t_".$i] != NULL)
				$chaine .= $_POST["t_".$i].';';
			$i++;
		}
				
		$requete = "UPDATE ".TAB_CONFIG." SET valeur='$chaine' WHERE nom='maj_hardtype'";
		$tab = $req1->db_use_query($requete);
		
		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_soft_confhtok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));			
	}
	else
	{
		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_soft_typeassoc"],
		  'ACTION' => 'index.php?page=adm_logiciels.php&config='.$_GET["config"],
		));

		$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_TYPE." ORDER BY libelle");
		$tab_mht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='maj_hardtype'");
		$mht = explode(';',$tab_mht[0]["valeur"]);

		$template->assign_block_vars('form.hard_assoc', array(
		  'NB_TYPE' => count($tab),
		));

		$i = 0;
		while ($i < count($tab))
		{					
			if (in_array($tab[$i]['id'],$mht))
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
			$template->assign_block_vars('form.help', array(
				'TITLE' => $lang["gen_help"],
				'TEXT' => $lang["help"][2]
			));	
		}
	}

}

echo $affichage;



?>