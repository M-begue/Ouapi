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
 * Return the list of document custom field columns for TAB_DOCS.
 */
function get_docs_pfield_columns(db_use $db): array
{
    if ($db->connection === null) {
        $db->connection();
    }

    $columns = [];
    $query = "SHOW COLUMNS FROM " . TAB_DOCS . " LIKE 'pfield_%'";
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


/*********************************************/
/*                  AJOUTER                  */
/*********************************************/
if (isset($_GET['action']) && $_GET['action'] == 'add')
{
	if (isset($_POST['soumettre']))
	{
		$err = array();
		
		$ref = format_string_db($_POST['ref']);
		$type = $_POST['type'];
		$entreprise = $_POST['entreprise'];
		$date = (isset($_POST['date']) && $_POST['date'] != '') ? date('Y-m-d', mktime(
    			0, 
    			0, 
    			0, 
    			(int)substr($_POST['date'], 3, 2), // Mois
    			(int)substr($_POST['date'], 0, 2), // Jour
    			(int)substr($_POST['date'], 6, 4)  // Année
			)) : date('Y-m-d');
		$date_archive = (isset($_POST['date_archive']) && $_POST['date_archive'] != '') ? date('Y-m-d', mktime(
    			0, 
    			0, 
    			0, 
    			(int)substr($_POST['date_archive'], 3, 2), // Mois
    			(int)substr($_POST['date_archive'], 0, 2), // Jour
    			(int)substr($_POST['date_archive'], 6, 4)  // Année
			)) : date('Y-m-d');
		$agence_id = $_POST['agence_id'];
		$commentaire = format_text_db($_POST['commentaire']);
		
		// Colonnes perso
		$pfields_names = '';
		$pfields_values = '';
		
		$pfieldColumns = get_docs_pfield_columns($req1);
		foreach ($pfieldColumns as $fieldName) {
			$pfields_names .= ',' . $fieldName;
			$pfields_values .= ",'" . format_string_db($_POST[$fieldName]) . "'";
		}

		/*********************** Verifications **************************/
		$requete_verif = "SELECT reference FROM ".TAB_DOCS." WHERE reference='".$ref."'";
		$tab_verif = $req1->db_use_query($requete_verif);

		
		if (count($tab_verif) > 0)
			array_push($err,$lang["adm_docs_add_referror"]);


		//Traitement du fichier envoy� (s'il y en a un)
		if(isset($_FILES['doc']) && $_FILES['doc']['name'] != "")
		{  
			$extensions_ok = array('PDF','DOC','DOCX','RTF','XLS','XLSX','PPT','PPTX','TXT','CSV','ODS','ODT','ODP','JPG','GIF','RAR','ZIP','XML','BMP', 'MSG', 'KEY');
			$taille_max = 10000000;  
			
			$dest_dossier = 'data/'.$agence_id.'/'; 
			
			// Controles
			if ( !in_array( strtoupper(substr(strrchr($_FILES['doc']['name'], '.'), 1)), $extensions_ok ) )
				array_push($err,$lang["adm_docs_add_typeerror"]);    
			if ( file_exists($_FILES['doc']['tmp_name']) && filesize($_FILES['doc']['tmp_name']) > $taille_max)
				array_push($err,$lang["adm_docs_add_sizeerror"]);
			if (!is_dir('data/'.$agence_id))
			{
				$retour = mkdir('data/'.$agence_id);
				if ($retour == FALSE)
					array_push($err,$lang["adm_docs_add_mkdirerror"]);
			}				
		}
		
		// Traitement si aucune erreur de verif
		if(count($err) == 0)  
		{  
			if(isset($_FILES['doc']) && $_FILES['doc']['name'] != "")  
			{    
				// formatage nom fichier 
				$dest_fichier = time().'.'.strtolower(substr(strrchr($_FILES['doc']['name'], '.'), 1));				
				move_uploaded_file($_FILES['doc']['tmp_name'], $dest_dossier.$dest_fichier);  
			}
			else
				$dest_fichier = '';

			$requete = "INSERT INTO ".TAB_DOCS." (".DO_REFERENCE.",".DO_COMPANYID.",".DO_TYPEID.",".DO_DATE.",".DO_DATEARCHIVE.",".DO_SITEID.",".DO_COMMENT.",".DO_PATH."".$pfields_names.") 
			VALUES ('".$ref."','".$entreprise."','".$type."','".$date."','".$date_archive."','".$agence_id."','".$commentaire."','".$dest_fichier."'".$pfields_values.")";

			$tab = $req1->db_use_query($requete);

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_docs_addok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));
		}
		else
		{
			$errors = $lang["adm_docs_adderror"].'<br/><br/>';
			
			foreach ($err as $key => $val) {
				$aff_key = $key + 1;
				$errors .= $aff_key.') '.$val.'<br/>';
			}
				
			$template->assign_block_vars('form_post', array(
				'OK' => $errors, 					
				'CLOSE' => $lang["close"],	
				'ID' => 'alert'
			));			
			
			$template->assign_block_vars('form_post.back', array(
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["return"]	,
			));			
		}
	}
	else
	{
		$template->assign_block_vars('form', array(
			'TITLE' => $lang["adm_docs_add_title"],
			'ACTION' => 'index.php?page=adm_docs.php&amp;action=add',
		));

		// Type
		$tab_type = $req1->db_use_query("SELECT * FROM ".TAB_DOCS_TYPE." ORDER BY libelle ASC");
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_docs_type"],
		));

		$i = -1;
		$tab_type[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab_type)-1)
		{
			$template->assign_block_vars('form.type.list', array(
			  'ID' => $tab_type[$i]['id'],
			  'LIBELLE' => $tab_type[$i]['libelle'],
			));
			$i++;
		}

		if (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=docs_type&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		
		// Entreprise
		$tab_entreprise = $req1->db_use_query("SELECT * FROM ".TAB_ENTREPRISE." ORDER BY raison_sociale");
		$template->assign_block_vars('form.entreprise', array(
		  'TITLE' => $lang["adm_docs_company"],
		));

		$i = -1;
		$tab_entreprise[-1] = array('id' => '-1', 'raison_sociale' => $lang["gen_select"]);
		while ($i < count($tab_entreprise)-1)
		{
			$template->assign_block_vars('form.entreprise.list', array(
			  'ID' => $tab_entreprise[$i]['id'],
			  'LIBELLE' => $tab_entreprise[$i]['raison_sociale'],
			));
			$i++;
		}

		if (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.entreprise.action', array(
			  'LINK' => 'index.php?page=adm_externes.php&amp;action=add',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}

		// Reference
		$template->assign_block_vars('form.ref', array(
		  'TITLE' => $lang["adm_docs_ref"],
		  'KEYUP' => 'verifLong(this);',
		  'ID' => 'required',
		));
		
		// Date
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_docs_date"],
		  'VALUE' => date("d-m-Y").' ',
		  'DISABLED' => 'readonly',
		));
		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));

		// Date de validit�
		$template->assign_block_vars('form.date_archive', array(
		  'TITLE' => $lang["adm_docs_date_archive"],
		  'VALUE' => '31-12-2035 ',
		  'DISABLED' => 'readonly',
		));
		
		$template->assign_block_vars('form.date_archive.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date_archive\', document.form.date_archive.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));

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

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["adm_docs_comm"],
		));
		
		// Fichier
		$template->assign_block_vars('form.file', array(
		  'TITLE' => $lang["adm_docs_file"],
		));

		// Champs perso
		$pfieldColumns = get_docs_pfield_columns($req1);
		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'TITLE' => $lang['s_'.TAB_DOCS.'.'.$fieldName],
			));
		}

		// Bouton
		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["add"],
		));		
	}
}
/*********************************************/
/*                  EDITER                   */
/*********************************************/
if (isset($_GET['action']) && $_GET['action'] == 'edit')
{
	if (isset($_POST['soumettre']))
	{
		$requete = "SELECT * FROM ".TAB_DOCS." WHERE ".DO_ID."='".intval($_GET["id"])."'";
		$tab_actuel = $req1->db_use_query($requete);
		
		$err = array();
		
		$ref = format_string_db($_POST['ref']);
		$type = $_POST['type'];
		$entreprise = $_POST['entreprise'];
		$date = mktime(
    			0, 
    			0, 
    			0, 
    			(int)substr($_POST['date'], 3, 2), // Mois
    			(int)substr($_POST['date'], 0, 2), // Jour
    			(int)substr($_POST['date'], 6, 4)  // Année
			);
		$date_archive = mktime(
    			0, 
    			0, 
    			0, 
    			(int)substr($_POST['date_archive'], 3, 2), // Mois
    			(int)substr($_POST['date_archive'], 0, 2), // Jour
    			(int)substr($_POST['date_archive'], 6, 4)  // Année
			);
		$agence_id = $_POST['agence_id'];
		$commentaire = format_text_db($_POST['commentaire']);

		// Colonnes perso
		$pfields_update = '';
		
		$pfieldColumns = get_docs_pfield_columns($req1);
		foreach ($pfieldColumns as $fieldName) {
			$pfields_update .= "," . $fieldName . "='" . format_string_db($_POST[$fieldName]) . "'";
		}

		/*********************** Verifications **************************/
		$requete_verif = "SELECT ".DO_REFERENCE." FROM ".TAB_DOCS." WHERE ".DO_REFERENCE."='".$ref."' AND ".DO_ID."<>'".intval($_GET["id"])."'";
		$tab_verif = $req1->db_use_query($requete_verif);
		
		if (count($tab_verif) > 0)
			array_push($err,$lang["adm_docs_add_referror"]);
		
		// Si il y a u n fichier associ�
		if ($tab_actuel[0]["path"] != '')
		{
			if (!is_dir('data/'.$agence_id))
			{
				$retour = @mkdir('data/'.$agence_id);
				if ($retour == FALSE)
					array_push($err,$lang["adm_docs_add_mkdirerror"]);
			}

			$retour = @rename('data/'.$tab_actuel[0][DO_SITEID].'/'.$tab_actuel[0][DO_PATH],'data/'.$agence_id.'/'.$tab_actuel[0][DO_PATH]);
			if ($retour == FALSE)
				array_push($err,$lang["adm_docs_edit_renameerror"]);
		}

		// Traitement si aucune erreur de verif
		if(count($err) == 0)  
		{  
			$requete = "UPDATE ".TAB_DOCS." SET ".DO_REFERENCE."='".$ref."', ".DO_COMPANYID."='".$entreprise."', ".DO_TYPEID."='".$type."', 
			".DO_DATE."='".$date."', ".DO_DATEARCHIVE."='".$date_archive."', ".DO_SITEID."='".$agence_id."',".DO_COMMENT."='".$commentaire."'".$pfields_update." WHERE ".DO_ID."='".intval($_GET["id"])."'";

			$tab = $req1->db_use_query($requete);

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_docs_editok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));
		}
		else
		{
			$errors = $lang["adm_docs_adderror"].'<br/><br/>';
			
			foreach ($err as $key => $val) {
				$aff_key = $key + 1;
				$errors .= $aff_key.') '.$val.'<br/>';
			}
				
			$template->assign_block_vars('form_post', array(
				'OK' => $errors, 					
				'CLOSE' => $lang["close"],	
				'ID' => 'alert'
			));			
			
			$template->assign_block_vars('form_post.back', array(
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["return"]	,
			));			
		}
	}
	else
	{
		$tab_doc = $req1->db_use_query("SELECT * FROM ".TAB_DOCS." WHERE ".DO_ID."='".intval($_GET["id"])."'");
		
		$template->assign_block_vars('form', array(
			'TITLE' => $lang["adm_docs_edit_title"],
			'ACTION' => 'index.php?page=adm_docs.php&amp;action=edit&id='.$tab_doc[0][DO_ID],
		));

		// Type
		$tab_type = $req1->db_use_query("SELECT * FROM ".TAB_DOCS_TYPE." ORDER BY ".DO_TY_LIBELLE." ASC");
		
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_docs_type"],
		));

		$i = -1;
		$tab_type[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab_type)-1)
		{
			if ($tab_type[$i][DO_TY_ID] == $tab_doc[0][DO_TYPEID])
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab_type[$i]['id'],
				  'LIBELLE' => $tab_type[$i]['libelle'],
				  'SELECTED' => 'selected="selected"',
				));
			}
			else
			{
				$template->assign_block_vars('form.type.list', array(
				  'ID' => $tab_type[$i]['id'],
				  'LIBELLE' => $tab_type[$i]['libelle'],
				));
			}
			$i++;
		}

		if (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.type.action', array(
			  'LINK' => 'index.php?page=adm_tables.php&amp;table=docs_type&amp;action=Ajouter',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}
		
		// Entreprise
		$tab_entreprise = $req1->db_use_query("SELECT * FROM ".TAB_ENTREPRISE." ORDER BY ".EN_COMPANYNAME);
		$template->assign_block_vars('form.entreprise', array(
		  'TITLE' => $lang["adm_docs_company"],
		));

		$i = -1;
		$tab_entreprise[-1] = array('id' => '-1', 'raison_sociale' => $lang["gen_select"]);
		while ($i < count($tab_entreprise)-1)
		{
			if ($tab_entreprise[$i][EN_ID] == $tab_doc[0][DO_COMPANYID])
			{
				$template->assign_block_vars('form.entreprise.list', array(
				  'ID' => $tab_entreprise[$i]['id'],
				  'LIBELLE' => $tab_entreprise[$i]['raison_sociale'],
				  'SELECTED' => 'selected="selected"',
				));
			}
			else
			{
				$template->assign_block_vars('form.entreprise.list', array(
				  'ID' => $tab_entreprise[$i]['id'],
				  'LIBELLE' => $tab_entreprise[$i]['raison_sociale'],
				));
			}
			$i++;
		}

		if (preg_match('`;'.RGHT_GEN_TABLEEDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form.entreprise.action', array(
			  'LINK' => 'index.php?page=adm_externes.php&amp;action=add',
			  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/arrow_add.gif',
			  'LIBELLE' => $lang["add"],
			));
		}

		// Reference
		$template->assign_block_vars('form.ref', array(
		  'TITLE' => $lang["adm_docs_ref"],
		  'KEYUP' => 'verifLong(this);',
		  'VALUE' => $tab_doc[0][DO_REFERENCE],
		  'ID' => 'ok',
		));
		
		// Date
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_docs_date"],
		  'VALUE' => date("d-m-Y", (int)$tab_doc[0][DO_DATE])." ",
		  'DISABLED' => 'readonly',
		));
		$template->assign_block_vars('form.date.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date\', document.form.date.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));
		
		// Date de validit�
		if (trim($tab_doc[0][DO_DATEARCHIVE]) != '')
			$date_archive = date("d-m-Y", (int)$tab_doc[0][DO_DATEARCHIVE])." ";
		else
			$date_archive = '31-12-2035 ';
		$template->assign_block_vars('form.date_archive', array(
		  'TITLE' => $lang["adm_docs_date_archive"],
		  'VALUE' => $date_archive,
		  'DISABLED' => 'readonly',
		));
		$template->assign_block_vars('form.date_archive.action', array(
		  'LINK' => 'javascript:show_calendar(\'document.form.date_archive\', document.form.date_archive.value,0);',
		  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		  'LIBELLE' => $lang["add"],
		));

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
				if ($tab_doc[0][DO_SITEID] == $tab[$i][AG_ID])
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
			  'AGENCE_ID' => $tab_doc[0][DO_SITEID],
			));	
		}

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["adm_docs_comm"],
		  'VALUE' => $tab_doc[0][DO_COMMENT],
		));

		// Colonnes perso
		$pfieldColumns = get_docs_pfield_columns($req1);
		foreach ($pfieldColumns as $fieldName) {
			$template->assign_block_vars('form.pfield_text', array(
			  'NAME' => $fieldName,
			  'VALUE' => $tab_doc[0][$fieldName],
			  'TITLE' => $lang['s_'.TAB_DOCS.'.'.$fieldName],
			));
		}
		
		// Bouton
		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["edit"],
		));		
	}
}
/*********************************************/
/*       LIER UN ELEMENT A UN DOCUMENT       */
/*********************************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'add_elmt')
{
	if (isset($_POST['soumettre']))
	{
		$doc_id = $_POST['doc_id'];
		$elmt_id = $_POST['elmt_id'];
		$add_type = $_POST['add_type'];
		
		$tab = $req1->db_use_query("INSERT INTO ".TAB_LIAISON_DOCS." (doc_id,".$add_type.")	VALUES ('".$doc_id."','".$elmt_id."')");
		
		$template->assign_block_vars('form_post', array(
			'OK' => $lang["adm_docs_addelmtok"], 					
			'CLOSE' => $lang["close"],	
			'ID' => 'mess_retour'
		));
	}
	else
	{
		// Si l'on est sur le site g�n�ral
		if ($_GET["agence_id"] == 0)
			$sql_agence = "agence_id LIKE '%'";
		else
			$sql_agence = "(agence_id='".$_GET['agence_id']."' OR agence_id='0') ";
		
		// On d�fini ce que l'on veut rattacher
		if (isset($_GET["hard_id"]))
		{
			$requete = "SELECT * FROM ".TAB_HARD." WHERE ".$sql_agence." AND suivi_rebus='' ORDER BY nom";
			$type = $lang["adm_docs_addhard"];			
			$add_type = 'hardware_id';			
			$get = 'hard_id';			
		}
		elseif (isset($_GET["periph_id"]))
		{
			$requete = "SELECT * FROM ".TAB_PERIPH." WHERE ".$sql_agence." AND suivi_rebus='' ORDER BY nom";
			$type = $lang["adm_docs_addperiph"];			
			$add_type = 'periph_id';
			$get = 'periph_id';
		}
		elseif (isset($_GET["soft_id"]))
		{
			$requete = "SELECT * FROM ".TAB_SOFT." WHERE ".$sql_agence." ORDER BY nom";
			$type = $lang["adm_docs_addsoft"];			
			$add_type = 'software_id';			
			$get = 'soft_id';			
		}
		
		$template->assign_block_vars('select', array(
			'TITLE' => $lang["adm_docs_link_title"],
			'ACTION' => 'index.php?page=adm_docs.php&amp;action=add_elmt',
		));
		
		$compteur = 0;
			
		// Adm_docs >> HARD/SOFT/PERIPH
		if (isset($_GET['doc_id']))
		{
			$tab_liaison = $req1->db_use_query_inv("SELECT * FROM ".TAB_LIAISON_DOCS." WHERE doc_id='".$_GET['doc_id']."'");
			$tab = $req1->db_use_query($requete);

			$i = 0;
			while ($i < count($tab))
			{
				if (count($tab_liaison) == 0 || !in_array($tab[$i]["id"],$tab_liaison[$add_type]))
				{
					if ($compteur == 0)
					{
						$template->assign_block_vars('select.elmt_select', array(
						  'TITLE' => $type,
						  'ID' => 'large',
						));
					}

					if ($add_type != 'software_id')
					{
						$template->assign_block_vars('select.elmt_select.list', array(
						  'ID' => $tab[$i]['id'],
						  'LIBELLE' => $tab[$i]['nom'].' - '.txt_to_na($tab[$i]['num_serie']),
						));
					}
					else
					{
						$template->assign_block_vars('select.elmt_select.list', array(
						  'ID' => $tab[$i]['id'],
						  'LIBELLE' => $tab[$i]['nom'],
						));
					}
					
					$compteur ++;
				}
				$i++;
			}
				
			if ($compteur > 0)
			{			
				$template->assign_block_vars('select.doc', array(
				  'ID' => $_GET['doc_id']
				));

				$template->assign_block_vars('select.type', array(
				  'ID' => $add_type
				));	

				// Bouton
				$template->assign_block_vars('select.button', array(
				  'TITLE' => $lang["add"],
				));				
			}
			else
			{
				$template->assign_block_vars('no_select', array(
				  'TEXT' => $lang["adm_docs_noelement"],
				));					
			}
		}
		// Fiche HARD/SOFT/PERIPH >> Document
		else
		{
			$tab_liaison = $req1->db_use_query_inv("SELECT * FROM ".TAB_LIAISON_DOCS." WHERE ".$add_type."='".$_GET[$get]."'");
			$tab = $req1->db_use_query("SELECT ".TAB_DOCS.".*,
			".TAB_ENTREPRISE.".id AS id_entreprise,
			".TAB_ENTREPRISE.".raison_sociale			
			FROM ".TAB_DOCS." 
			  LEFT JOIN ".TAB_ENTREPRISE." ON ".TAB_ENTREPRISE.".id=".TAB_DOCS.".entreprise_id
			WHERE agence_id='".$_GET['agence_id']."' OR agence_id='0' ORDER BY date DESC");

			$template->assign_block_vars('select.javascript', array());

			$i = 0;
			while ($i < count($tab))
			{
				if (count($tab_liaison) == 0 || !in_array($tab[$i]["id"],$tab_liaison["doc_id"]))
				{		
					if ($compteur == 0)
					{
						$template->assign_block_vars('select.doc_select', array(
						  'TITLE' => $lang["adm_docs_doc"],
						  'ID' => 'large',
						  'CHANGE' => 'var docind = document.form.doc_id.options[doc_id.selectedIndex].value; 
										document.form.commentaire.value=Comment[docind];document.form.rs.value=RS[docind];'
						));				
					}
					
					if ($tab[$i][DO_DATEARCHIVE] != '' && $tab[$i][DO_DATEARCHIVE] < time())
						$style = 'color:red;';
					else
						$style = '';

					$template->assign_block_vars('select.doc_select.list', array(
					  'ID' => $tab[$i]['id'],
					  'LIBELLE' => '[ '.txt_to_na($tab[$i]['reference'])." ] ".date("d/m/Y", (int)$tab[$i]['date']),
					  'STYLE' => $style,
					));
					$compteur ++;
				
					$template->assign_block_vars('select.javascript.list', array(
						'TEXT' => 'RS['.$tab[$i]['id'].'] = "'.txt_to_na($tab[$i]['raison_sociale']).'";
						Comment['.$tab[$i]['id'].'] = "'.txt_to_na($tab[$i]['commentaire']).'";',
					));
					
				}
				$i++;
			}
			
			if ($compteur > 0)
			{				
				// R�f�rence
				$template->assign_block_vars('select.rs', array(
				  'TITLE' => $lang["adm_docs_company"],
				  'VALUE' => txt_to_na($tab[0]['raison_sociale']),
				  'DISABLED' => 'disabled="disabled"',
				));

				// Commentaire
				$template->assign_block_vars('select.comment', array(
				  'TITLE' => $lang["adm_docs_comm"],
				  'VALUE' => $tab[0]['commentaire'],
				  'DISABLED' => 'disabled="disabled"',
				));
				
				$template->assign_block_vars('select.elmt', array(
				  'ID' => $_GET[$get]
				));
				
				$template->assign_block_vars('select.type', array(
				  'ID' => $add_type
				));		
				
				// Bouton
				$template->assign_block_vars('select.button', array(
				  'TITLE' => $lang["add"],
				));		
			}
			else
			{
				$template->assign_block_vars('no_select', array(
				  'TEXT' => $lang["adm_docs_noelement"],
				));		
			
			}
		}			
	}
}
/*********************************************/
/*      DELIER UN ELEMENT A UN DOCUMENT      */
/*********************************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'del_elmt')
{
	$doc_id = $_GET['doc_id'];
	$elmt_id = $_GET['id'];
	$del_type = $_GET['type'];
	
	$tab = $req1->db_use_query("DELETE FROM ".TAB_LIAISON_DOCS." WHERE doc_id='".$doc_id."' AND ".$del_type." = '".$elmt_id."'");
	
	$template->assign_block_vars('form_post', array(
		'OK' => $lang["adm_docs_delelmtok"], 					
		'CLOSE' => $lang["close"],	
		'ID' => 'mess_retour'
	));
}
/*********************************************/
/*                 SUPPRIMER                 */
/*********************************************/
elseif (isset($_GET['action']) && $_GET['action'] == 'del')
{
	if (isset($_POST['soumettre']))
	{
		$id = intval($_GET['id']);
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_DOCS." WHERE id='".$id."'");
		
		$warning = array();
		
		if (is_file('data/'.$tab[0]["agence_id"].'/'.$tab[0]["path"]))
		{
			if (is_writable('data/'.$tab[0]["agence_id"].'/'.$tab[0]["path"]))
			{
				unlink('data/'.$tab[0]["agence_id"].'/'.$tab[0]["path"]);
			}
			else
			{
				array_push($warning,$lang["adm_docs_delfilenok"]);	
			}
		}
		
		if (count($warning) != 0)
		{
			$warn_mess = $lang["adm_docs_warnings"].'<br/><br/>';
			
			foreach ($warning as $key => $val) {
				$aff_key = $key + 1;
				$warn_mess .= $aff_key.') '.$val.'<br/>';
			}
				
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_docs_delok"].'<br/><br/>'.$warn_mess, 					
				'CLOSE' => $lang["close"],	
				'ID' => 'warning'
			));			
			
		}
		else
		{
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_docs_delok"], 					
				'CLOSE' => $lang["close"],	
				'ID' => 'mess_retour'
			));		
		}
		
		$tab = $req1->db_use_query("DELETE FROM ".TAB_DOCS." WHERE id='".$id."'");
		$tab = $req1->db_use_query("DELETE FROM ".TAB_LIAISON_DOCS." WHERE doc_id='".$id."'");
		
	}
	else
	{		
		$tab_docs = $req1->db_use_query("SELECT ".TAB_DOCS.".*,
		  ".TAB_ENTREPRISE.".raison_sociale,
		  ".TAB_DOCS_TYPE.".libelle AS l_type
		FROM ".TAB_DOCS." 
		  LEFT JOIN ".TAB_ENTREPRISE." ON ".TAB_ENTREPRISE.".id = ".TAB_DOCS.".entreprise_id
		  LEFT JOIN ".TAB_DOCS_TYPE." ON ".TAB_DOCS_TYPE.".id = ".TAB_DOCS.".type_id
		WHERE ".TAB_DOCS.".id='".$_GET['id']."'");

		$template->assign_block_vars('form', array(
			'TITLE' => $lang["adm_docs_del_title"],
			'ACTION' => 'index.php?page=adm_docs.php&amp;action=del&amp;id='.$_GET['id'],
		));

		// Type
		$template->assign_block_vars('form.type', array(
		  'TITLE' => $lang["adm_docs_type"],
		  'DISABLED' => 'disabled',
		));

		$template->assign_block_vars('form.type.list', array(
		  'LIBELLE' => txt_to_na($tab_docs[0]['l_type']),
		));
		
		// Entreprise
		$template->assign_block_vars('form.entreprise', array(
		  'TITLE' => $lang["adm_docs_company"],
		  'DISABLED' => 'disabled',
		));
		
		$template->assign_block_vars('form.entreprise.list', array(
		  'LIBELLE' => txt_to_na($tab_docs[0]['raison_sociale']),
		));

		// Reference
		$template->assign_block_vars('form.ref', array(
		  'TITLE' => $lang["adm_docs_ref"],
		  'VALUE' => $tab_docs[0]['reference'],
		  'DISABLED' => 'disabled',
		));
		
		// Date
		$template->assign_block_vars('form.date', array(
		  'TITLE' => $lang["adm_docs_date"],
		  'VALUE' => date("d/m/Y", (int)$tab_docs[0]['date']),
		  'DISABLED' => 'disabled',
		));

		// Commentaire
		$template->assign_block_vars('form.comment', array(
		  'TITLE' => $lang["adm_docs_comm"],
		  'VALUE' => $tab_docs[0]['commentaire'],
		  'DISABLED' => 'disabled',
		));
		
		// Bouton
		$template->assign_block_vars('form.button', array(
		  'TITLE' => $lang["delete"],
		));		
		
	}
}
echo $affichage;
?>