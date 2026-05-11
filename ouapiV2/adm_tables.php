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

/************************************************************************/
/*                               AJOUTER                                */
/************************************************************************/
if (isset($_GET['action']) && $_GET['action'] == 'Ajouter')
{
	if (isset($_POST['soumettre']))
	{
		$err = array();
		$table = $_GET["table"];
		$libelle = format_string_db($_POST['libelle']);


/*		AJOUT DE LA FONCTIONNALITE D4IMAGE DANS models of system
		//Traitement du fichier envoyé (s'il y en a un)
		if(isset($_FILES['doc']) && $_FILES['doc']['name'] != "")
		{  
			$extensions_ok = array('JPG','PNG','GIF');
			$taille_max = 250000;  
			
			$dest_dossier = 'images/models/system/';
			
			// Controles
			if ( !in_array( strtoupper(substr(strrchr($_FILES['doc']['name'], '.'), 1)), $extensions_ok ) )
				array_push($err,$lang["adm_docs_add_typeerror"]);    
			if ( file_exists($_FILES['doc']['tmp_name']) && filesize($_FILES['doc']['tmp_name']) > $taille_max)
				array_push($err,$lang["adm_docs_add_sizeerror"]);
			if (!is_dir('data/'.$agence_id))
			{
				$retour = mkdir('images/models/system');
				if ($retour == FALSE)
					array_push($err,$lang["adm_docs_add_mkdirerror"]);
			}				
		}*/

		// Si la table est liée a un site
		if (isset($_POST['site_id']))
		{
			if ($_POST["site_id"] == 'all')
			{
				$requete_sites = "SELECT * FROM ".TAB_AGENCES;
				$tab_sites = $req1->db_use_query($requete_sites);

				$requete_verif = "SELECT libelle FROM ".constant(strtoupper('tab_'.$_GET["table"]))." WHERE libelle='$libelle' ORDER BY libelle";
				$tab_verif = $req1->db_use_query($requete_verif);

				// Si le libelle n'existe pas déjà
				if (count($tab_verif) == 0)
				{		
					$i = 0;
					while ($i < count($tab_sites))
					{
						$requete = "INSERT INTO ".constant(strtoupper('tab_'.$_GET["table"]))." (agence_id,libelle) VALUES ('".$tab_sites[$i]["id"]."','".$libelle."')";
						$tab = $req1->db_use_query($requete);									
						$i++;
					}
				}
				else
					array_push($err,$lang["adm_table_err_libellesite"]);

			}
			else
			{
				$requete_verif = "SELECT libelle FROM ".constant(strtoupper('tab_'.$_GET["table"]))." WHERE libelle='$libelle' AND agence_id='".$_POST['site_id']."'";
				$tab_verif = $req1->db_use_query($requete_verif);

				// Si le libelle n'existe pas déjà
				if (count($tab_verif) == 0)
				{							
					$requete = "INSERT INTO ".constant(strtoupper('tab_'.$_GET["table"]))." (agence_id,libelle) VALUES ('".$_POST['site_id']."','".$libelle."')";
					$tab = $req1->db_use_query($requete);
				}
				else
					array_push($err,$lang["adm_table_err_libelle"]);
			}
		}
		// Sinon
		else
		{
			$requete_verif = "SELECT libelle FROM ".constant(strtoupper('tab_'.$_GET["table"]))." WHERE libelle='$libelle'";
			$tab_verif = $req1->db_use_query($requete_verif);

			// Si le libelle n'existe pas déjà
			if (count($tab_verif) == 0)
			{			
				// Cas particulier de l'ajout de type de matériel
				if(isset($_POST['vnc']) || isset($_POST['http']))
				{
					if (isset($_POST['vnc']))
						$vnc = $_POST['vnc'];
					else
						$vnc = '0';
					if (isset($_POST['http']))
						$http = $_POST['http'];
					else
						$http = '0';
						
					$requete = "INSERT INTO ".constant(strtoupper('tab_'.$_GET["table"]))." (libelle,connex_vnc,connex_http) 
					VALUES ('".$libelle."','".$vnc."','".$http."')";
				}
				else
				{
					if (isset($_POST["marque_id"]))
					{
						$marque_id = $_POST["marque_id"];
						$requete = "INSERT INTO ".constant(strtoupper('tab_'.$_GET["table"]))." (marque_id,libelle) VALUES ('".$marque_id."','".$libelle."')";						
					}
					// Sinon, cas général
					else
						$requete = "INSERT INTO ".constant(strtoupper('tab_'.$_GET["table"]))." (libelle) VALUES ('".$libelle."')";
				}	
				
				$tab = $req1->db_use_query($requete);				
			}
			// Sinon >> Message d'erreur
			else
				array_push($err,$lang["adm_table_err_libelle"]);
		}
			
		// Affichage
		if (count($err) == 0)
		{
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_table_addok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));
			
			$template->assign_block_vars('form_post.back', array(
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["gen_back"]	,
			));			
		}
		else
		{
			$errors = $lang["adm_table_adderror"].'<br/><br/>';
			while(list($key, $val) = each($err))
			{ 
				$aff_key = $key+1;
				$errors .= $aff_key.') '.$val.'<br>';
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
		if (isset($_GET["valeur"]))
			$valeur = $_GET["valeur"];
		else
			$valeur = '';

		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_add_title"],
		  'ACTION' => 'index.php?page=adm_tables.php&table='.$_GET["table"].'&action=Ajouter',
		  'ONSUBMIT' => 'return verifErrors()',
		));
			
		if ($valeur != '')
		{
			$template->assign_block_vars('form.libelle', array(
			  'TITLE' => $lang["adm_table_libelle"],
			  'KEYUP' => 'verifLong(this);',
			  'VALUE' => $valeur,
			  'ID' => 'ok',
			));
		}
		else
		{
			$template->assign_block_vars('form.libelle', array(
			  'TITLE' => $lang["adm_table_libelle"],
			  'KEYUP' => 'verifLong(this);',
			  'ID' => 'required',
			));
		}
		
		// Cas particulier des tables liée à une agence
		if (isset($_GET['slct_site']) && MULTISITE == 'Oui')
		{
			$template->assign_block_vars('form.multisite', array(
			  'TITLE' => $lang["adm_table_site"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
			
			$i = -1;
			$tab[-1] = array('id' => 'all', 'libelle' => $lang["gen_all"]);
			while ($i < count($tab)-1)
			{
				if (isset($_GET["agence_id"]) && $_GET["agence_id"] == $tab[$i]['id'])
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
		elseif (isset($_GET['slct_site']) && MULTISITE != 'Oui')
		{
			$template->assign_block_vars('form.monosite', array(
			  'AGENCE_ID' => 1,
			));			
		}
		
		// Cas particulier de la table des type de matériel >> Connexions possibles
		if ($_GET["table"] == "hard_type")
		{
			$template->assign_block_vars('form.connex', array(
			  'TITLE' => $lang["adm_table_possible_connex"],
			));

			$i = 0;
			$type[0] = array('libelle' => $lang["gen_http"],'name' => 'http', 'value' => 1,'checked' => '');
			$type[1] = array('libelle' => $lang["gen_vnc"],'name' => 'vnc', 'value' => 1,'checked' => '');
			while ($i < count($type))
			{
				$template->assign_block_vars('form.connex.list', array(
				  'LIBELLE' => $type[$i]["libelle"],
				  'NAME' => $type[$i]["name"],
				  'VALUE' => $type[$i]["value"],
				));
			
				$i++;
			}
		}
		
		// Cas particulier des tables modeles liées à une marque
		if ($_GET["table"] == "hard_modele" || $_GET["table"] == "periph_modele")
		{
			$template->assign_block_vars('form.marque', array(
			  'TITLE' => $lang["adm_table_marque"],
				'IMAGE' => $lang["main"][2],
			));
				
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MARQUE." ORDER BY libelle");
			
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["none"]);
			while ($i < count($tab)-1)
			{
				if (isset($_GET["parent"]) && $_GET["parent"] == $tab[$i]['id'])
				{
					$template->assign_block_vars('form.marque.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					  'SELECTED' => 'selected',
					));
				}
				else
				{
					$template->assign_block_vars('form.marque.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => $tab[$i]['libelle'],
					));
				}
				
				$i++;
			}
		}

		// Bouton
		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));		
	}
}
else
{
	/************************************************************************/
	/*                             SUPPRESSION                              */
	/************************************************************************/
	if (isset($_GET['action']) && $_GET['action'] == 'delete')
	{
		if (isset($_GET['table']) && $_GET['table'] == 'agences')
		{
			if (isset($_POST['soumettre']))
			{
				$requete = "DELETE ".TAB_EMPL." WHERE ".EM_SITEID."='".$_POST['site_id']."'";
				$tab = $req1->db_use_query($requete);
				$requete = "UPDATE ".TAB_DOCS." SET ".DO_SITEID."='".$_POST['site_replace']."' WHERE ".DO_SITEID."='".$_POST['site_id']."'";
				$tab = $req1->db_use_query($requete);
				$requete = "UPDATE ".TAB_HARD." SET ".HA_SITEID."='".$_POST['site_replace']."' WHERE ".HA_SITEID."='".$_POST['site_id']."'";
				$tab = $req1->db_use_query($requete);
				$requete = "UPDATE ".TAB_PERIPH." SET ".PE_SITEID."='".$_POST['site_replace']."' WHERE ".PE_SITEID."='".$_POST['site_id']."'";
				$tab = $req1->db_use_query($requete);
				$requete = "UPDATE ".TAB_RESEAU." SET ".RE_SITEID."='".$_POST['site_replace']."' WHERE ".RE_SITEID."='".$_POST['site_id']."'";
				$tab = $req1->db_use_query($requete);
				$requete = "UPDATE ".TAB_SOFT." SET ".SO_SITEID."='".$_POST['site_replace']."' WHERE ".SO_SITEID."='".$_POST['site_id']."'";
				$tab = $req1->db_use_query($requete);
				$requete = "UPDATE ".TAB_USERS." SET ".US_SITE_ID."='".$_POST['site_replace']."' WHERE ".US_SITE_ID."='".$_POST['site_id']."'";
				$tab = $req1->db_use_query($requete);
				$requete = "DELETE FROM ".TAB_AGENCES." WHERE ".AG_ID."='".$_POST['site_id']."'";
				$tab = $req1->db_use_query($requete);
				
				$post_result = $lang["adm_table_delsite_ok"];
				$post_class = 'table_success';
				$post_icon = 'templates/'.DEFAULT_TEMPLATE.'/images/ok.png';
			}
			else
			{
				$siteid = intval($_GET['id']);

				$template->assign_block_vars('form_prepost', array());
				
				if ($siteid != 1)
				{
					$template->assign_block_vars('form_prepost.button', array(	
					  'TEXT' => $lang["delete"],
					));
					
					$template->assign_block_vars('form_prepost.warning', array(	
						'TEXT' => $lang["adm_table_delsite_warning"],
					));
					
					//ID du site
					$template->assign_block_vars('form_prepost.hidden_field', array(	
						'NAME' => 'site_id',
						'VALUE' => intval($_GET["id"]),
					));
					
					// Matériels sur le site
					$requete = "SELECT * FROM ".TAB_HARD." WHERE ".HA_SITEID."='".$siteid."'";
					$tab_hard = $req1->db_use_query($requete);
					
					$template->assign_block_vars('form_prepost.info', array(
						'NB' => count($tab_hard),
						'TEXT' => $lang["adm_table_delsite_nbhard"],
					));
					
					// Périphs sur le site
					$requete = "SELECT * FROM ".TAB_PERIPH." WHERE ".PE_SITEID."='".$siteid."'";
					$tab_periph = $req1->db_use_query($requete);
					
					$template->assign_block_vars('form_prepost.info', array(
						'NB' => count($tab_periph),
						'TEXT' => $lang["adm_table_delsite_nbperiph"],
					));
					
					// Softs sur le site
					$requete = "SELECT * FROM ".TAB_SOFT." WHERE ".SO_SITEID."='".$siteid."'";
					$tab_soft = $req1->db_use_query($requete);
					
					$template->assign_block_vars('form_prepost.info', array(
						'NB' => count($tab_soft),
						'TEXT' => $lang["adm_table_delsite_nbsoft"],
					));
					
					// Documents sur le site
					$requete = "SELECT * FROM ".TAB_DOCS." WHERE ".DO_SITEID."='".$siteid."'";
					$tab_docs = $req1->db_use_query($requete);
					
					$template->assign_block_vars('form_prepost.info', array(
						'NB' => count($tab_docs),
						'TEXT' => $lang["adm_table_delsite_nbdocs"],
					));
					
					// Prises réseau sur le site
					$requete = "SELECT * FROM ".TAB_RESEAU." WHERE ".RE_SITEID."='".$siteid."'";
					$tab_netw = $req1->db_use_query($requete);
					
					$template->assign_block_vars('form_prepost.info', array(
						'NB' => count($tab_netw),
						'TEXT' => $lang["adm_table_delsite_nbnetw"],
					));
					
					// Utilisateurs sur le site
					$requete = "SELECT * FROM ".TAB_USERS." WHERE ".US_SITE_ID."='".$siteid."'";
					$tab_users = $req1->db_use_query($requete);
					
					$template->assign_block_vars('form_prepost.info', array(
						'NB' => count($tab_users),
						'TEXT' => $lang["adm_table_delsite_nbusers"],
					));
					
					// Tout est supprimé, le site peut être supprimé (sauf si site 1)
					if (count($tab_hard)+count($tab_periph)+count($tab_docs)+count($tab_netw)+count($tab_users) == 0 && $siteid != 1)
					{
						$template->assign_block_vars('form_prepost.hidden_field', array(	
							'NAME' => 'site_replace',
							'VALUE' => 1,
						));
					
					}
					// Tout n'est pas supprimé, on propose un site de remplacement
					elseif (count($tab_hard)+count($tab_periph)+count($tab_docs)+count($tab_netw)+count($tab_users) != 0 && $siteid != 1)
					{
						$requete = "SELECT * FROM ".TAB_AGENCES." WHERE ".AG_ID."<>'".$siteid."'";
						$tab = $req1->db_use_query($requete);
						
						$template->assign_block_vars('form_prepost.list_field', array(
						  'TITLE' => $lang["adm_table_delsite_replacesite"],
						  'NAME' => 'site_replace',
						));
						
						$i = 0;
						while ($i < count($tab))
						{
							$template->assign_block_vars('form_prepost.list_field.list', array(
								'ID' => $tab[$i][AG_ID],
								'LIBELLE' => $tab[$i][AG_LIBELLE],
							));
							$i++;
						}
										
					}
				}
				else
				{
					$template->assign_block_vars('form_prepost.warning', array(	
						'TEXT' => $lang["adm_table_delsite_impossible"],
					));				
				}
			}
		}
		else
		{
			$requete = "SELECT * FROM ".constant(strtoupper('tab_'.$_GET["table"]))." WHERE id='".$_GET['id']."'";
			$tab_element = $req1->db_use_query($requete);
			
			$requete = "DELETE FROM ".constant(strtoupper('tab_'.$_GET["table"]))." WHERE id='".$_GET['id']."'";
			$tab = $req1->db_use_query($requete);

			$post_result = str_ireplace('L\'élément', strtoupper($tab_element[0]["libelle"]), $lang["adm_table_delok"]);
			$post_class = 'table_success';
			$post_icon = 'templates/'.DEFAULT_TEMPLATE.'/images/ok.png';
		}
	}

	/************************************************************************/
	/*                               EDITION                                */
	/************************************************************************/
	if (isset($_POST['table']))
	{
		$err = array();
		$table = $_POST["table"];
		$libelle = format_string_db($_POST['libelle']);

		// Si la table est liée a un site
		if (isset($_POST['site_id']))
		{
			$requete_verif = "SELECT libelle FROM ".constant(strtoupper('tab_'.$table))." WHERE libelle='$libelle' AND agence_id='".$_POST['site_id']."' AND id<>'".$_POST["id"]."'";
			$tab_verif = $req1->db_use_query($requete_verif);

			// Si le libelle n'existe pas déjà
			if (count($tab_verif) == 0)
			{	
				$requete = "UPDATE ".constant(strtoupper('tab_'.$table))." SET agence_id='".$_POST['site_id']."', libelle='".$libelle."' WHERE id='".$_POST["id"]."'";
				$tab = $req1->db_use_query($requete);
				
				$post_result = str_ireplace('L\'élément', strtoupper($libelle), $lang["adm_table_editok"]);
				$post_class = 'table_success';
				$post_icon = 'templates/'.DEFAULT_TEMPLATE.'/images/ok.png';
			}
			else
				array_push($err,$lang["adm_table_err_libelle"]);
		}
		// Sinon
		else
		{
			$requete_verif = "SELECT libelle FROM ".constant(strtoupper('tab_'.$table))." WHERE libelle='$libelle' AND id<>'".$_POST["id"]."'";
			$tab_verif = $req1->db_use_query($requete_verif);

			// Si le libelle n'existe pas déjà
			if (count($tab_verif) == 0)
			{			
				// Cas particulier de l'ajout de type de matériel
				if($_POST["table"] == "hard_type")
				{
					if (isset($_POST['vnc']))
						$vnc = $_POST['vnc'];
					else
						$vnc = '0';
					if (isset($_POST['http']))
						$http = $_POST['http'];
					else
						$http = '0';
						
					$requete = "UPDATE ".constant(strtoupper('tab_'.$table))." SET libelle='".$libelle."', connex_vnc='".$vnc."',
					connex_http='".$http."' WHERE id='".$_POST["id"]."'";
				}
				elseif (isset($_POST["marque_id"]))
				{
					$marque_id = $_POST["marque_id"];
					$requete = "UPDATE ".constant(strtoupper('tab_'.$table))." SET marque_id='".$marque_id."', libelle='".$libelle."'  WHERE id='".$_POST["id"]."'";						
				}
				// Sinon, cas général
				else
					$requete = "UPDATE ".constant(strtoupper('tab_'.$table))." SET libelle='".$libelle."' WHERE id='".$_POST["id"]."'";
				
				$tab = $req1->db_use_query($requete);

				$post_result = str_ireplace('[ELEMENT]', strtoupper($libelle), $lang["adm_table_editok"]);
				$post_class = 'table_success';
				$post_icon = 'templates/'.DEFAULT_TEMPLATE.'/images/ok.png';
			}
			// Sinon >> Message d'erreur
			else
				array_push($err,$lang["adm_table_err_libelle"]);
		}
			
		// Affichage
		if (count($err) > 0)
		{
			$post_result = str_ireplace('L\'élément', strtoupper($libelle), $lang["adm_table_editerror"]);
			$post_class = 'table_error';
			$post_icon = 'templates/'.DEFAULT_TEMPLATE.'/images/nok.png';
			
			while(list($key, $val) = each($err))
			{ 
				$post_result .= '&nbsp;'.$val;
			}
		}

	}

	/************************************************************************/
	/*                                                                      */
	/*                       AFFICHAGE DE LA LISTE                          */
	/*                                                                      */
	/************************************************************************/
	$requete= "SELECT * FROM ".constant(strtoupper('tab_'.$_GET["table"]))." ORDER BY libelle";
	$tab = $req1->db_use_query($requete);

	$current_page = 'index.php?page=adm_tables.php&amp;table='.$_GET["table"];

	$template->assign_block_vars('select', array(
	  'TITLE' => $lang["adm_table_edit_title"],
	  'ACTION' => $current_page,
	  'ONSUBMIT' => 'return verifErrors()',
	  'TABLE_NAME' => $_GET["table"],
	));

	// On affiche les en tete de colonne s'il y a au moins 1 résultat
	if (count($tab) > 0)
	{
		$template->assign_block_vars('select.records', array(
		  'L_LIBELLE' => $lang["gen_libelle"],
		  'L_TOOLS' => $lang["tools"],
		));
		  
		/****************** DEBUT Gestion des colonnes particulières ***********************/
		if ($_GET["table"] == "hard_type")
		{
			$template->assign_block_vars('select.records.connex', array(
			  'L_CONNEX' => $lang["adm_table_possible_connex"],
			));	
		}
		
		if (isset($tab[0]["agence_id"]))
		{
			$template->assign_block_vars('select.records.place', array(
			  'L_PLACE' => $lang["place_3"],
			));
		}
		
		if (isset($tab[0]["marque_id"]))
		{
			$template->assign_block_vars('select.records.marque', array(
			  'L_MARQUE' => $lang["adm_table_marque"],
			));
		}
		/******************** FIN Gestion des colonnes particulières ***********************/
		  
		$i = 0;
		while ($i < count($tab))
		{
			$template->assign_block_vars('select.records.list', array(
			  'LIBELLE' => format_string_input($tab[$i]["libelle"]),
			  'ID' => $tab[$i]["id"],
			));
			
			/****************** DEBUT Gestion des colonnes particulières ***********************/
			if ($_GET["table"] == "hard_type")
			{
				$template->assign_block_vars('select.records.list.connex', array());
				
				$j = 0;
				$type[0] = array('libelle' => $lang["gen_http"],'name' => 'http', 'value' => 1,'checked' => form_bintochecked($tab[$i][HA_TY_HTTPCONNECTION]) );
				$type[1] = array('libelle' => $lang["gen_vnc"],'name' => 'vnc', 'value' => 1,'checked' => form_bintochecked($tab[$i][HA_TY_VNCCONNECTION]));				
				while ($j < count($type))
				{
					$template->assign_block_vars('select.records.list.connex.option', array(
					  'LIBELLE' => $type[$j]["libelle"],
					  'NAME' => $type[$j]["name"],
					  'VALUE' => $type[$j]["value"],
					  'CHECKED' => $type[$j]["checked"],
					));
				
					$j++;
				}
			}
			
			if (isset($tab[$i]["agence_id"]))
			{
				if (MULTISITE == 'Oui')
				{
					$template->assign_block_vars('select.records.list.place', array());
					
					$requete = "SELECT * FROM ".TAB_AGENCES;
					$tab_site = $req1->db_use_query($requete);
					
					$j = 0;
					while ($j < count($tab_site))
					{
						if ($tab[$i]["agence_id"] == $tab_site[$j][AG_ID])
						{
							$template->assign_block_vars('select.records.list.place.option', array(
							  'NAME' => $tab_site[$j][AG_LIBELLE],
							  'ID' => $tab_site[$j][AG_ID],
							  'SELECTED' => 'selected="selected"',
							));
						}
						else
						{
							$template->assign_block_vars('select.records.list.place.option', array(
							  'NAME' => $tab_site[$j][AG_LIBELLE],
							  'ID' => $tab_site[$j][AG_ID],
							));
						}
					
						$j++;
					}
				}
				else
				{
					$template->assign_block_vars('select.records.list.monosite', array());				
				}
			}

			if ($_GET["table"] == "hard_modele" || $_GET["table"] == "periph_modele")
			{
				$template->assign_block_vars('select.records.list.marque', array());
				
				$tab_marque = $req1->db_use_query("SELECT * FROM ".TAB_HARD_MARQUE." ORDER BY libelle");
				
				$j = -1;
				$tab_marque[-1] = array('id' => '0', 'libelle' => $lang["none"]);
				while ($j < count($tab_marque)-1)
				{
					if ($tab[$i]["marque_id"] == $tab_marque[$j]["id"])
					{
						$template->assign_block_vars('select.records.list.marque.option', array(
						  'ID' => $tab_marque[$j]['id'],
						  'LIBELLE' => $tab_marque[$j]['libelle'],
						  'SELECTED' => 'selected="selected"',
						));
					}
					else
					{
						$template->assign_block_vars('select.records.list.marque.option', array(
						  'ID' => $tab_marque[$j]['id'],
						  'LIBELLE' => $tab_marque[$j]['libelle'],
						));
					}
					
					$j++;
				}						
			}
			/****************** FIN Gestion des colonnes particulières ***********************/

			/* Outil d'édition */
			$template->assign_block_vars('select.records.list.tools', array(
			  'LINK' => $current_page.'&amp;id='.$tab[$i]["id"],
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/save.gif',
			  'TITLE' => $lang["gen_save"],
			));

			/* Outil de suppression */
			if ((!isset($tab[$i]["verrou"]) || (isset($tab[$i]["verrou"]) && $tab[$i]["verrou"] == 0)))
			{
				$template->assign_block_vars('select.records.list.tools', array(
				  'LINK' => $current_page.'&amp;action=delete&amp;id='.$tab[$i]["id"],
				  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
				  'TITLE' => $lang["delete"],
				));
			}
				
			$i++;
		}
	}
	else
	{
		$template->assign_block_vars('select.no_record', array(
		  'MESSAGE' => $lang["adm_table_no_libelle"],
		));
	}
	
	/****************** DEBUT Gestion des messages de retour ***********************/
	if (isset($post_result))
	{
		$template->assign_block_vars('select.post_result', array(
		  'MESSAGE' => $post_result,
		  'CLASS' => $post_class,
		  'ICON' => $post_icon,
		));	
	}
	/******************* FIN Gestion des messages de retour ************************/
}

echo $affichage;




?>