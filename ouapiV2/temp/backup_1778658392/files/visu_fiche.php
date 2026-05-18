<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$template->set_filenames(array(
	$_GET["type"] => 'fiche_'.$_GET["type"].'.tpl',			
  ));

$affichage = '';

/**
 * Return all custom pfield columns for a given table.
 */
function get_table_pfield_columns(string $table): array
{
    global $req1;

    if (!isset($req1) || !isset($req1->connection) || $req1->connection === null) {
        if (isset($req1) && method_exists($req1, 'connection')) {
            $req1->connection();
        }
    }

    $columns = [];
    if (isset($req1->connection) && $req1->connection instanceof mysqli) {
        $query = "SHOW COLUMNS FROM {$table} LIKE 'pfield_%'";
        $result = $req1->connection->query($query);
        if ($result instanceof mysqli_result) {
            while ($row = $result->fetch_assoc()) {
                if (isset($row['Field'])) {
                    $columns[] = $row['Field'];
                }
            }
            $result->free();
        }
    }

    return $columns;
}

$aff_fiches = new fiche($lang);

$applications = array(
	'pdf' => 'pdf',
	'txt' => 'txt',
	'jpg' => 'jpg',
/*	'odt' => 'vnd.oasis.opendocument.text',
	'ods' => 'vnd.oasis.opendocument.spreadsheet',
	'odp' => 'vnd.oasis.opendocument.presentation',
	'doc' => 'msword',
	'docx' => 'msword',
	'xls' => 'vnd.ms-excel',
	'xlsx' => 'vnd.ms-excel',
	'ppt' => 'vnd.ms-powerpoint',
	'pptx' => 'vnd.ms-powerpoint',
	'' => '',*/
);

$height = array (
	'pdf' => array('100%','500'),
	'txt' => array('100%','500'),
	'jpg' => array('75%',''),
);
/*********************************/
/*            Mat�riels          */
/*********************************/
if (isset($_GET['type']) && $_GET['type'] == 'hard')
{
	
	// D�tail du mat�riel
	$requete = "SELECT ".TAB_HARD.".*,
	  ".TAB_HARD.".".HA_ID." AS hard_id,	  
	  ".TAB_AGENCES.".".AG_LIBELLE." AS site_libelle,
	  ".TAB_HARD_TYPE.".".HA_TY_LIBELLE." AS type_libelle,
	  ".TAB_HARD_TYPE.".".HA_TY_VNCCONNECTION." AS connex_vnc,
	  ".TAB_HARD_TYPE.".".HA_TY_HTTPCONNECTION." AS connex_http,
	  ".TAB_EMPL.".".EM_LIBELLE." AS empl_libelle,
	  ".TAB_HARD_MARQUE.".".HA_MA_LIBELLE." AS marque_libelle,
	  ".TAB_HARD_MODELE.".".HA_MO_LIBELLE." AS modele_libelle,
	  ".TAB_HARD_OS.".".HA_OS_LIBELLE." AS os_libelle,
	  ".TAB_REF_CPU.".".REF_CPU_LIBELLE." AS cpu_libelle,
	  ".TAB_REF_RAM_TYPE.".".REF_RAM_TYPE_LIBELLE." AS ram_type_libelle,
	  ".TAB_REF_DISQUE_TYPE.".".REF_DISQUE_TYPE_LIBELLE." AS disque_type_libelle,
	  ".TAB_USERS.".".US_ID." AS id_user,
	  ".TAB_USERS.".".US_LNAME." AS nom_user,
	  ".TAB_USERS.".".US_FNAME." AS prenom_user
	  FROM ".TAB_HARD." 
		LEFT JOIN ".TAB_AGENCES." ON ".TAB_HARD.".".HA_SITEID." = ".TAB_AGENCES.".".AG_ID."
		LEFT JOIN ".TAB_HARD_TYPE." ON ".TAB_HARD.".".HA_TYPEID." = ".TAB_HARD_TYPE.".".HA_TY_ID."
		LEFT JOIN ".TAB_EMPL." ON ".TAB_HARD.".".HA_LOCATIONID." = ".TAB_EMPL.".".EM_ID."
		LEFT JOIN ".TAB_HARD_MARQUE." ON ".TAB_HARD.".".HA_MARQUEID." = ".TAB_HARD_MARQUE.".".HA_MA_ID."
		LEFT JOIN ".TAB_HARD_MODELE." ON ".TAB_HARD.".".HA_MODELEID." = ".TAB_HARD_MODELE.".".HA_MO_ID."
		LEFT JOIN ".TAB_HARD_OS." ON ".TAB_HARD.".".HA_OSID." = ".TAB_HARD_OS.".".HA_OS_ID."
		LEFT JOIN ".TAB_REF_CPU." ON ".TAB_HARD.".".HA_CPUID." = ".TAB_REF_CPU.".".REF_CPU_ID."
		LEFT JOIN ".TAB_REF_RAM_TYPE." ON ".TAB_HARD.".".HA_RAMTYPEID." = ".TAB_REF_RAM_TYPE.".".REF_RAM_TYPE_ID."
		LEFT JOIN ".TAB_REF_DISQUE_TYPE." ON ".TAB_HARD.".".HA_DISQUETYPEID." = ".TAB_REF_DISQUE_TYPE.".".REF_DISQUE_TYPE_ID."
		LEFT JOIN ".TAB_USERS." ON ".TAB_HARD.".".HA_USERID." = ".TAB_USERS.".".US_ID."
	  WHERE ".TAB_HARD.".".HA_ID."='".intval($_GET["id"])."'";		
	$tab = $req1->db_use_query($requete);				

	if (count($tab) > 0)
	{
		$template->assign_block_vars('infos', array(
		  'NAME' => txt_to_na($tab[0]["nom"]),
		  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
		  'MARQUEMODELE' => $lang["fiche_hard_infomm"].txt_to_na($tab[0]["marque_libelle"]).'&nbsp;=>&nbsp;'.txt_to_na($tab[0]["modele_libelle"]),
		  'USER' => $lang["fiche_hard_infouser"].txt_to_na($tab[0]["nom_user"].' '.$tab[0]["prenom_user"]),
		  'SERIAL' => $lang["fiche_hard_infoserial"].txt_to_na($tab[0]["num_serie"]),
		));	
		
		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["fiche_hard_harddetail"],
		  'ID' => 'button_hard_details',
		  'CLASS' => 'fiche_button_selected',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/hard_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'hard_details\').style.display=\'block\';
					 javascript:document.getElementById(\'button_hard_details\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'hard_periph\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_periph\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_network\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_network\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_docs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_docs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_softocs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_ocs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_hardocs\').style.display=\'none\';
					 javascript:document.getElementById(\'hard_ldap\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_ldap\').className=\'fiche_button\';',
		));	
			
		$template->assign_block_vars('hard_details', array(
		  'IMG_HARDICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/hard_icon.gif',
		  'L_HARD' => $lang["fiche_hard_harddetail"],
		  'L_NAME' => $lang["name"],
		  'L_USER' => $lang["user"],
		  'L_SITE' => $lang["place_3"],
		  'L_PLACE' => $lang["place_2"],
		  'L_MARQUE' => $lang["marque"],
		  'L_MODELE' => $lang["modele"],
		  'L_SERIAL' => $lang["serial"],
		  'L_OS' => $lang["os"],
		  'L_CPU' => $lang["s_".TAB_HARD.".".HA_CPUID],
		  'L_RAMCAPACITE' => $lang["s_".TAB_HARD.".".HA_RAMCAPACITE],
		  'L_RAMTYPE' => $lang["s_".TAB_HARD.".".HA_RAMTYPEID],
		  'L_DISQUECAPACITE' => $lang["s_".TAB_HARD.".".HA_DISQUECAPACITE],
		  'L_DISQUETYPE' => $lang["s_".TAB_HARD.".".HA_DISQUETYPEID],
		  'L_IP' => $lang["hard_ip"],
		  'L_BOOKABLE' => $lang["hard_reserv"],
		  'L_CREATIONDATE' => $lang["f_hard_date"],
		  'L_COMMENT' => $lang["comment"],
		  'NAME' => txt_to_na($tab[0]["nom"]),
		  'USER' => txt_to_na($tab[0]["nom_user"].' '.$tab[0]["prenom_user"]),
		  'SITE' => $tab[0]["site_libelle"],
		  'PLACE' => txt_to_na($tab[0]["empl_libelle"]),
		  'MARQUE' => txt_to_na($tab[0]["marque_libelle"]),
		  'MODELE' => txt_to_na($tab[0]["modele_libelle"]),
		  'SERIAL' => txt_to_na($tab[0]["num_serie"]),
		  'OS' => txt_to_na($tab[0]["os_libelle"]),
		  'CPU' => txt_to_na($tab[0]["cpu_libelle"]),
		  'RAMCAPACITE' => txt_to_na($tab[0]["ram_capacite"]),
		  'RAMTYPE' => txt_to_na($tab[0]["ram_type_libelle"]),
		  'DISQUECAPACITE' => txt_to_na($tab[0]["disque_capacite"]),
		  'DISQUETYPE' => txt_to_na($tab[0]["disque_type_libelle"]),
		  'IP' => txt_to_na($tab[0]["ip"]),
		  'BOOKABLE' => bin_to_yn($tab[0]["reservable"] ?? 0),
		  'CREATIONDATE' => txt_to_na(format_date_to_aff($tab[0]["creation_date"] ?? '')),
		  'COMMENT' => txt_to_na($tab[0]["commentaire"]),
		));

		// Colonnes perso
		$pfieldColumns = get_table_pfield_columns(TAB_HARD);

		foreach ($pfieldColumns as $index => $fieldName) {
			// Nouvelle ligne
			if ($index === 0 || $index % 2 === 0) {
				$template->assign_block_vars('hard_details.line', array());
			}

			if (isset($lang["s_" . TAB_HARD . "." . $fieldName])) {
				$displayTitle = $lang["s_" . TAB_HARD . "." . $fieldName];
			} else {
				$cleanName = str_replace('pfield_', '', $fieldName);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}

			$template->assign_block_vars('hard_details.line.info', array(
			  'VALUE' => txt_to_na($tab[0][$fieldName] ?? ''),
			  'TITLE' => $displayTitle,
			));
		}
	}
	
	// Periphs li�s
	if (preg_match('`;'.RGHT_PERIPH.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
	{
		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["fiche_hard_periphlinked"],
		  'ID' => 'button_hard_periph',
		  'CLASS' => 'fiche_button',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/periph_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'hard_details\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_details\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_periph\').style.display=\'block\';
					 javascript:document.getElementById(\'button_hard_periph\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'hard_network\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_network\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_docs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_docs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_softocs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_ocs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_hardocs\').style.display=\'none\';
					 javascript:document.getElementById(\'hard_ldap\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_ldap\').className=\'fiche_button\';',
		));
		
		$requete = "SELECT ".TAB_PERIPH.".*,
		".TAB_PERIPH_MARQUE.".".PE_MA_LIBELLE." AS l_marque,
		".TAB_PERIPH_MODELE.".".PE_MO_LIBELLE." AS l_modele,
    ".TAB_PERIPH.".".PE_NAME." AS l_name,
		".TAB_PERIPH_TYPE.".".PE_TY_LIBELLE." AS l_type
		FROM ".TAB_PERIPH." 
		  LEFT JOIN ".TAB_PERIPH_MARQUE." ON ".TAB_PERIPH_MARQUE.".".PE_MA_ID." = ".TAB_PERIPH.".marque_id
		  LEFT JOIN ".TAB_PERIPH_MODELE." ON ".TAB_PERIPH_MODELE.".".PE_MO_ID." = ".TAB_PERIPH.".modele_id
		  LEFT JOIN ".TAB_PERIPH_TYPE." ON ".TAB_PERIPH_TYPE.".".PE_TY_ID." = ".TAB_PERIPH.".type_id
		WHERE ".TAB_PERIPH.".hard_id='".intval($_GET["id"])."'";
		$tab = $req1->db_use_query($requete);
		
		$template->assign_block_vars('hard_periph', array(
		  'IMG_HARDICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/periph_icon.gif',
		  'L_PERIPH' => $lang["fiche_hard_periphlinked"],	
		));
			
		if (count($tab) != 0)
		{
			$template->assign_block_vars('button.nb', array(
			  'TEXT' => count($tab),
			));
			
			$i = 0;
			while ($i < count($tab))
			{
				if ($tab[$i][HA_REBUT] != '')
					$class = 'row_spec';
				else
					$class = 'row1';
				$template->assign_block_vars('hard_periph.list', array(
				  'TYPE' => txt_to_na($tab[$i]["l_type"]),
				  'MARQUE' => '<font color=#999>'.$lang["marque"].': '.'&nbsp;'.'</font>'.txt_to_na($tab[$i]["l_marque"]),
				  'MODELE' => '<font color=#999>'.$lang["modele"].': '.'&nbsp;'.'</font>'.txt_to_na($tab[$i]["l_modele"]),
          		  'NAME' => '<font color=#999>'.$lang["name"].': '.'&nbsp;'.'</font>'.txt_to_na($tab[$i]["l_name"]),
				  'SERIAL' => '<font color=#999>'.$lang["serial"].': '.'&nbsp;'.'</font>'.txt_to_na($tab[$i]["num_serie"]),
				  'CLASS' => $class,
				));
				
				//Fiche p�riph
				if (preg_match('`;'.RGHT_PERIPH.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
				{
					$template->assign_block_vars('hard_periph.list.tools', array(
					  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
					  'LINK' => 'index.php?page=visu_fiche.php&amp;type=periph&amp;id='.$tab[$i]["id"].'&amp;agence_id='.intval(intval($_GET["agence_id"])).'&amp;action=visu',
					  'TITLE' => $lang["gen_view"],
					));
				}	

				//Deconnecter periph
				if (preg_match('`;'.RGHT_PERIPH_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
				{
					$template->assign_block_vars('hard_periph.list.tools', array(
					  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/unlink.gif',
					  'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=unlink_elmt&amp;p_id='.$tab[$i][PE_ID],
					  'TITLE' => $lang["gen_unlink"],
					));
				}		
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('hard_periph.no_list', array(
			  'TEXT' => $lang["fiche_noperiph"],
			));
		}
		
		if (preg_match('`;'.RGHT_PERIPH_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('hard_periph.add', array(
			  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/addlink.gif',
			  'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=add_elmt&amp;h_id='.$_GET["id"].'&amp;agence_id='.$_GET["agence_id"],
			  'TEXT' => '<font color=#9899C5>'.$lang["fiche_addperiph"].'</font>',
			));
		}	
	}

	// Liaisons r�seau
	if (preg_match('`;'.RGHT_NETW.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
	{
		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["fiche_hard_netwlink"],
		  'ID' => 'button_hard_network',
		  'CLASS' => 'fiche_button',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/netw_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'hard_details\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_details\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_periph\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_periph\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_network\').style.display=\'block\';
					 javascript:document.getElementById(\'button_hard_network\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'hard_docs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_docs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_softocs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_ocs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_hardocs\').style.display=\'none\';
					 javascript:document.getElementById(\'hard_ldap\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_ldap\').className=\'fiche_button\';',
		));
		
		$requete = "SELECT ".TAB_RESEAU.".*,
		".TAB_HARD.".".HA_NAME." AS hardname
		FROM ".TAB_RESEAU." 
		  LEFT JOIN ".TAB_HARD." ON ".TAB_HARD.".".HA_ID." = ".TAB_RESEAU.".".RE_NETWORKHARDID."
		WHERE ".TAB_RESEAU.".".RE_HARDWAREID."='".intval($_GET["id"])."'";
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('hard_network', array(
		  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/netw_icon.gif',
		  'L_NETWORK' => $lang["fiche_hard_netwlink"],	
		));
			
		if (count($tab) != 0)
		{
			$template->assign_block_vars('button.nb', array(
			  'TEXT' => count($tab),
			));
			
			$i = 0;
			while ($i < count($tab))
			{
				$template->assign_block_vars('hard_network.list', array(
				  'L_PLUG' => $lang["fiche_netw_prise"],
				  'PLUG' => $tab[$i]["num_prise"],
				  'L_NETWORKHARD' => $lang["fiche_netw_hard"],
				  'NETWORKHARD' => txt_to_na($tab[$i]["hardname"]).'<i>('.$lang["fiche_netw_port"].': '.num_to_na($tab[$i]["port_id"]).')</i>',
				));
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('hard_network.no_list', array(
			  'TEXT' => $lang["fiche_nonetw"],
			));
		}
			
		if (preg_match('`;'.RGHT_NETW_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('hard_network.add', array(
			  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/addlink.gif',
			  'LINK' => 'index.php?page=adm_reseau.php&amp;action=Ajouter&amp;h_id='.intval($_GET["id"]).'&amp;agence_id='.$_GET["agence_id"],
			  'TEXT' => '<font color=#9899C5>'.$lang["fiche_addnetwconnex"].'</font>',
			));
		}
	}
			
	// Documents li�s
	if (preg_match('`;'.RGHT_DOCS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
	{
		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["fiche_hard_docslinked"],
		  'ID' => 'button_hard_docs',
		  'CLASS' => 'fiche_button',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/docs_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'hard_details\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_details\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_periph\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_periph\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_network\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_network\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_docs\').style.display=\'block\';
					 javascript:document.getElementById(\'button_hard_docs\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'hard_softocs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_ocs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_hardocs\').style.display=\'none\';
					 javascript:document.getElementById(\'hard_ldap\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_ldap\').className=\'fiche_button\';',
		));
		
		$template->assign_block_vars('hard_docs', array(
		  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/docs_icon.gif',
		  'L_DOCS' => $lang["fiche_hard_docslinked"],	
		));
	
		$requete = "SELECT ".TAB_LIAISON_DOCS.".*,
		".TAB_DOCS.".*,
		".TAB_ENTREPRISE.".".EN_COMPANYNAME.",
		".TAB_DOCS_TYPE.".".DO_TY_LIBELLE."
		FROM ".TAB_LIAISON_DOCS." 
		  LEFT JOIN ".TAB_DOCS." ON ".TAB_LIAISON_DOCS.".".DO_LI_DOCID." = ".TAB_DOCS.".".DO_ID."
		  LEFT JOIN ".TAB_ENTREPRISE." ON ".TAB_ENTREPRISE.".".EN_ID." = ".TAB_DOCS.".".DO_COMPANYID." 
		  LEFT JOIN ".TAB_DOCS_TYPE." ON ".TAB_DOCS_TYPE.".".DO_TY_ID." = ".TAB_DOCS.".".DO_TYPEID."
		WHERE ".DO_LI_HARDID."='".intval($_GET["id"])."' 
		ORDER BY ".DO_DATE." DESC";
		$tab = $req1->db_use_query($requete);
		
		if (count($tab) != 0)
		{		
			$template->assign_block_vars('button.nb', array(
			  'TEXT' => count($tab),
			));

			$i = 0;
			while ($i < count($tab))
			{
				if ($tab[$i][DO_DATEARCHIVE] < time() && $tab[$i][DO_DATEARCHIVE] != '')
					$class = "row_spec";
				else
					$class = "row1";
					
				$template->assign_block_vars('hard_docs.list', array(
				  'DATE' => '<font color=#999>'.$lang["fiche_hard_date"].'</font>'.format_date_to_aff($tab[$i][DO_DATE] ?? ''),
				  'L_DOCTYPE' => '<font color=#999>'.$lang["fiche_docs_type"].'</font>',
				  'DOCTYPE' => txt_to_na($tab[$i][DO_TY_LIBELLE]),
				  'L_DOCEMET' => '<font color=#999>'.$lang["fiche_docs_emet"].'</font>',
				  'DOCEMET' => txt_to_na($tab[$i][EN_COMPANYNAME]),
				  'L_DOCREF' => '<font color=#999>'.$lang["fiche_docs_ref"].'</font>',
				  'DOCREF' => txt_to_na($tab[$i][DO_REFERENCE]),
				  'L_COMMENT' => '<font color=#999>'.$lang["f_docs_comment"].'</font>',
				  'COMMENT' => txt_to_na($tab[$i][DO_COMMENT]),
				  'CLASS' => $class,
				));
					
				if (is_file('data/'.$tab[$i][DO_SITEID].'/'.$tab[$i]["path"]))
				{
					$ext = strtolower(substr(strrchr($tab[$i]["path"], '.'), 1));

					$template->assign_block_vars('hard_docs.list.tools', array(
						'LINK' => 'data/'.$tab[$i][DO_SITEID].'/'.$tab[$i][DO_PATH],		
						'IMG' => (is_file('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'))?('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'):('templates/'.DEFAULT_TEMPLATE.'/images/file_.png'),		
					));
				}
				
				$template->assign_block_vars('hard_docs.list.tools', array(
				  'LINK' => 'index.php?page=visu_fiche.php&amp;type=docs&amp;id='.intval($tab[$i]["id"]).'&amp;action=visu',
				  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
				  'IMG_TITLE' => $lang["docs_detail"],
				));
				
				$template->assign_block_vars('hard_docs.list.tools', array(
				  'LINK' => 'index.php?page=adm_docs.php&amp;action=del_elmt&amp;doc_id='.$tab[$i]["id"].'&amp;type=hardware_id&amp;id='.$_GET["id"],
				  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/unlink.gif',
				  'IMG_TITLE' => $lang["fiche_hard_deldoclink"],
				));
				

					
								
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('hard_docs.no_list', array(
			  'TEXT' => $lang["f_hard_nodocs"],
			));
		}

		$template->assign_block_vars('hard_docs.add', array(
		  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/addlink.gif',
		  'LINK' => 'index.php?page=adm_docs.php&amp;action=add_elmt&amp;agence_id='.$_GET["agence_id"].'&amp;hard_id='.$_GET["id"],
		  'TEXT' => '<font color=#9899C5>'.$lang["fiche_adddocs"].'</font>',		
		));
	}

	/*            OCS             */
	if (OCS_INSTALL == "Oui")
	{
		if (preg_match('`;'.RGHT_OCS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$requete = "SELECT * FROM ".TAB_HARD." WHERE id='".$_GET["id"]."'";
			$tab = $req1->db_use_query($requete);
			
			$connect_ocs = new db_connect();
			$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

			if (isset($connect_ocs->connection) && $connect_ocs->connection->error === '' && CONSTANT("OCS_CRIT_OCS".$_GET["agence_id"]) != '')
			{								
				$requete = "SELECT ".TAB_OCS_HARD.".*,
				".TAB_OCS_BIOS.".".COL_OCS_BIOS_SNUM."
				FROM ".TAB_OCS_HARD." 
				  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
				WHERE ".CONSTANT("OCS_CRIT_OCS".$_GET["agence_id"])."='".addslashes($tab[0][constant("OCS_CRIT_BASE".$_GET["agence_id"])])."'";
				$tab_ocs = $req1->db_use_query($requete);
				
				// Infos du poste
				if (count($tab_ocs) != 0)
				{					
					$template->assign_block_vars('button', array(
					  'TEXT' => $lang["fiche_hard_ocsinfos"],
					  'ID' => 'button_hard_ocs',
					  'CLASS' => 'fiche_button',
						'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/ocs_icon.gif',
					  'LINK' => 'javascript:document.getElementById(\'hard_details\').style.display=\'none\';
								 javascript:document.getElementById(\'button_hard_details\').className=\'fiche_button\';
								 javascript:document.getElementById(\'hard_periph\').style.display=\'none\';
								 javascript:document.getElementById(\'button_hard_periph\').className=\'fiche_button\';
								 javascript:document.getElementById(\'hard_network\').style.display=\'none\';
								 javascript:document.getElementById(\'button_hard_network\').className=\'fiche_button\';
								 javascript:document.getElementById(\'hard_docs\').style.display=\'none\';
								 javascript:document.getElementById(\'button_hard_docs\').className=\'fiche_button\';
								 javascript:document.getElementById(\'hard_softocs\').style.display=\'block\';
								 javascript:document.getElementById(\'button_hard_ocs\').className=\'fiche_button_selected\';
								 javascript:document.getElementById(\'hard_hardocs\').style.display=\'block\';
								 javascript:document.getElementById(\'hard_ldap\').style.display=\'none\';
								 javascript:document.getElementById(\'button_hard_ldap\').className=\'fiche_button\';',
					));
										
					$template->assign_block_vars('hard_ocsdetails', array(
					  'PROC_IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/icon_processor.png',
					  'L_PROCTYPE' => $lang["fiche_ocs_hard_processt"],
					  'PROCTYPE' => txt_to_na($tab_ocs[0][COL_OCS_PROCESST]),
					  'L_PROCSPECN' => $lang["fiche_ocs_hard_processn"],
					  'PROCSPECN' => txt_to_na($tab_ocs[0][COL_OCS_PROCESSN]),
					  'L_PROCSPEC' => $lang["fiche_ocs_hard_processs"],
					  'PROCSPEC' => txt_to_na(round($tab_ocs[0][COL_OCS_PROCESSS]/1024,2)),
					  'MEM_IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/icon_memory.png',
					  'L_MEMORY' => $lang["fiche_ocs_hard_memory"],
					  'L_MEMORY_RAM' => $lang["fiche_ocs_hard_memory_ram"],
					  'L_MEMORY_SWAP' => $lang["fiche_ocs_hard_memory_swap"],
					  'MEMORY' => txt_to_na(round($tab_ocs[0][COL_OCS_MEMORY]/1024,2)),
					  'SWAP' => txt_to_na(round($tab_ocs[0][COL_OCS_SWAP]/1024,2)),

					  'OS_TITLE' => $lang["fiche_ocs_hard_os_title"],
					  'OS_IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/icon_os.png',
					  'L_OS' => $lang["fiche_ocs_hard_os"],
					  'SP' => txt_to_na($tab_ocs[0][COL_OCS_OSSP]),
					  'OSVERSION' => txt_to_na($tab_ocs[0][COL_OCS_OSVERSION]),
					  'OSNAME' => txt_to_na($tab_ocs[0][COL_OCS_OSNAME]),
					  'L_OSVERSION' => $lang["fiche_ocs_hard_osversion"],					  
					  'L_WORKGROUP' => $lang["fiche_ocs_hard_workgroup"],
					  'WORKGROUP' => txt_to_na($tab_ocs[0][COL_OCS_WORKG]),
					  'WORKGROUP_IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/icon_workgroup.png',					  
					  'L_WINOWNER' => $lang["fiche_ocs_hard_winowner"],
					  'WINOWNER_IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/icon_licence.png',					  
					  'WINOWNER' => txt_to_na($tab_ocs[0][COL_OCS_WINOWNER]),
					  
					  'L_LASTUPDATE' => $lang["fiche_ocs_lastupdate"],
					  'LASTUPDATE' => txt_to_na(format_date_to_aff($tab_ocs[0][COL_OCS_LASTDATE])),
					  'L_LASTUSER' => $lang["fiche_ocs_lastuser"],
					  'LASTUSER' => txt_to_na($tab_ocs[0][COL_OCS_USERID]),
					  'PROCMEM_TITLE' => $lang["fiche_ocs_hard_procmem_title"],
					  'OTHER_TITLE' => $lang["fiche_ocs_hard_other_title"],
					));

					// Disques
					$requete = "SELECT ".TAB_OCS_DRIVES.".*
					FROM ".TAB_OCS_DRIVES." 
					WHERE ".TAB_OCS_DRIVES.".".COL_OCS_DRV_HARDID." = '".$tab_ocs[0][COL_OCS_HARD_ID]."'";
					$tab_drives = $req1->db_use_query($requete);
					
					if (count($tab_drives) != 0)
					{	
						$template->assign_block_vars('hard_ocsdetails.drives', array(
						  'TITLE' => $lang["fiche_ocs_hard_drives_title"],
						));
						
						$i = 0;
						while ($i < count($tab_drives))
						{
							$img = strtolower($tab_drives[$i][COL_OCS_DRV_TYPE]);
							$img = str_replace(' ','', $img);
							
							if ($tab_drives[$i][COL_OCS_DRV_TOTAL] != 0)
							{
								$free_gb = round($tab_drives[$i][COL_OCS_DRV_FREE]/1024,1);
								$total_gb = round($tab_drives[$i][COL_OCS_DRV_TOTAL]/1024,1);
								$prct = round(($tab_drives[$i][COL_OCS_DRV_TOTAL]-$tab_drives[$i][COL_OCS_DRV_FREE])/$tab_drives[$i][COL_OCS_DRV_TOTAL]*100,2);
								$text = $free_gb.' GB / '.$total_gb.' GB';
							}
							else
							{
								$prct = 0;
								$text = txt_to_na('');
							}
							
							$template->assign_block_vars('hard_ocsdetails.drives.list', array(
							  'LETTER' => $tab_drives[$i][COL_OCS_DRV_LETTER],
							  'VOLUMN' => $tab_drives[$i][COL_OCS_DRV_VOLUMN],
							  'TYPE' => $tab_drives[$i][COL_OCS_DRV_TYPE],
							  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/icon_'.$img.'.png',
							  'BGIMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/vline_light.png',
							  'PRCT' => $prct,
							  'TEXT' => $text,
							));
						
							$i++;
						}
					}


					// Logiciels install�s			
				
					$template->assign_block_vars('hard_softocs', array(				
					));
					
					$template->assign_block_vars('hard_softocs.auto', array(
					  'L_DETAILS' => $lang["fiche_ocs_soft_title"],					
					));
					
					if (defined("OCS_FILTRE_OCS".$_GET["agence_id"]))
						$filtre = ' AND ('.COL_OCS_SOFT_NAME.' NOT LIKE \''.str_replace(';','\' AND '.COL_OCS_SOFT_NAME.' NOT LIKE \'',substr(constant("OCS_FILTRE_OCS".$_GET["agence_id"]),0,-1)).'\')';
					else
						$filtre = '';
						
					$requete = "SELECT * 
					FROM ".TAB_OCS_SOFT." WHERE ".COL_OCS_SOFT_HARDID."='".$tab_ocs[0]["ID"]."' AND ".COL_OCS_SOFT_NAME."<>''".$filtre." 
					GROUP BY ".COL_OCS_SOFT_NAME."
					ORDER BY ".COL_OCS_SOFT_NAME;
					$tab_ocs = $req1->db_use_query($requete);
					
					$connect_ocs->connection();
					if (count($tab_ocs) > 0)
					{
						$i = 0;
						while ($i < count($tab_ocs))
						{
							if ($i%2 == 0)
								$template->assign_block_vars('hard_softocs.auto.line', array());
							
							$template->assign_block_vars('hard_softocs.auto.line.col', array(
							  'OCSNAME' => $tab_ocs[$i][COL_OCS_SOFT_NAME],
							  'L_VERSION' => $lang["fiche_soft_version"],
							  'VERSION' => $tab_ocs[$i][COL_OCS_SOFT_VERSION],
							));
							
							$i++;
						}					
					}
					
				}
				else
				{
					$template->assign_block_vars('button', array(
					  'TEXT' => $lang["fiche_hard_ocsinfos"],
					  'ID' => 'button_hard_ocs_disabled',
					  'CLASS' => 'fiche_button_disabled',
					));
				}

			}
		}
	}
	/* PAS d'OCS */
	else
	{
		// Logiciels install�s
		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["fiche_hard_softlinked"],
		  'ID' => 'button_hard_ocs',
		  'CLASS' => 'fiche_button',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/soft_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'hard_details\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_details\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_periph\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_periph\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_network\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_network\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_docs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_docs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'hard_softocs\').style.display=\'block\';
					 javascript:document.getElementById(\'button_hard_ocs\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'hard_hardocs\').style.display=\'none\';
					 javascript:document.getElementById(\'hard_ldap\').style.display=\'none\';
					 javascript:document.getElementById(\'button_hard_ldap\').className=\'fiche_button\';',
		));
		
		$tab_hard = $req1->db_use_query("SELECT ".HA_TYPEID." FROM ".TAB_HARD." WHERE ".HA_ID."='".$_GET["id"]."'");
		$tab_mht = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE ".CO_NAME."='maj_hardtype'");
		
		$types = explode(';',$tab_mht[0]["valeur"]);
		$type_ok = in_array($tab_hard[0]["type_id"],$types);
	
		if($type_ok != FALSE)
		{
			// On cherche tous les logiciels install� sur la machine sauf l'OS
			$requete = "SELECT ".TAB_HARDSOFT.".software_id, 
			  ".TAB_HARDSOFT.".user_maj_id, 
			  MAX(".TAB_HARDSOFT.".version_date_maj) AS version_date_maj ,
			  ".TAB_HARDSOFT.".version_num,
			  ".TAB_USERS.".id AS id_user,
			  ".TAB_USERS.".nom AS nom_user,
			  ".TAB_USERS.".prenom AS prenom_user,
			  ".TAB_SOFT.".nom AS nom_soft,
			  ".TAB_SOFT.".dern_version_num,
			  ".TAB_SOFT.".dern_version_date
			FROM ".TAB_HARDSOFT." 
			  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_HARDSOFT.".user_maj_id
			  LEFT JOIN ".TAB_SOFT." ON ".TAB_SOFT.".id = ".TAB_HARDSOFT.".software_id
			WHERE hardware_id='".$_GET["id"]."' AND software_id < '9999999' 
			GROUP BY software_id ORDER BY nom_soft";
			$tab = $req1->db_use_query($requete);


			$template->assign_block_vars('hard_softocs', array(
			));

			$template->assign_block_vars('hard_softocs.manual', array(
			  'L_SOFTINSTALLED' => $lang["fiche_hard_softlinked"].'</font>',	
			  'L_NAME' => $lang["f_hard_softname"].'</font>',
			  'L_VERSIONNUM' => $lang["f_hard_softversnum"].'</font>',
			  'L_VERSIONDATE' => $lang["f_hard_softversdate"].'</font>',
			  'L_MAJVERS' => $lang["f_hard_softmajnum"].'</font>',
			  'L_VERSION' => '<font color=#999>'.$lang["gen_version"].'</font>',
			  'L_MAJDATE' => '<font color=#999>'.$lang["f_hard_softmajdate"].'</font>',
			  'L_MAJUSER' => '<font color=#999>'.$lang["f_hard_softmajuser"].'</font>',
			));	
						
			if (count($tab) != 0)
			{
				$template->assign_block_vars('button.nb', array(
				  'TEXT' => count($tab),
				));
				
				$i = 0;
				while ($i < count($tab))
				{
					$user = aff_users($tab[$i]["nom_user"].' '.$tab[$i]["prenom_user"],$tab[$i]["id_user"],$lang["hard_user_noref"],'[ '.$lang["none"].' ]');

					$template->assign_block_vars('hard_softocs.manual.list', array(
					  'NAME' => $tab[$i]["nom_soft"],			
					  'VERSION' => txt_to_na($tab[$i]["dern_version_num"]),	
					  'DATE' =>	txt_to_na(format_date_to_aff($tab[$i]["dern_version_date"])),
					  'DATEMAJ' => format_date_to_aff($tab[$i]["version_date_maj"],'/'),
					  'VERSIONMAJ' => txt_to_na($tab[$i]["version_num"],'/'),
					  'USER' => $user,
					));	

					$i++;
				}
			}
			else
			{
				$template->assign_block_vars('hard_softocs.manual.no_soft', array(
					'L_NOSOFT' => $lang["fiche_nosoft"],
				));
			}

			$template->assign_block_vars('hard_softocs.manual.add', array(
			  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/addlink.gif',
			  'LINK' => 'index.php?page=adm_logiciels.php&amp;action=MAJ_hard&amp;agence_id='.$_GET["agence_id"].'&amp;h_id='.$_GET["id"],
			  'TEXT' => '<font color=#9899C5>'.$lang["fiche_addsoft"].'</font>',		
			));
			
		}
	}

	if (LDAP_INSTALL == "Oui" && $fp = @fsockopen(LDAP_HOST, LDAP_PORT, $errno, $errstr, 5))
	{				
		$connect->test_cnx();	
		
		$requete = "SELECT * FROM ".TAB_HARD." WHERE ".TAB_HARD.".".HA_ID."='".intval($_GET["id"])."'";		
		$tab = $req1->db_use_query($requete);
		
		if (preg_match('`;'.RGHT_LDAP.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			// Cl� primaire de comparaison des 2 bases
			if (defined("LDAP_KEY_HARD"))
				$key = explode(";",LDAP_KEY_HARD);
			else
				$key = array('nom','name');
			
			// Racine de recherche LDAP du site
			$requete = "SELECT ".CO_VALUE." FROM ".TAB_CONFIG." WHERE nom='ldap_mask_hard".intval($_GET["agence_id"])."'";
			$tab_racine = $req1->db_use_query($requete);
			
			if (count($tab_racine) > 0)
				$racine = $tab_racine[0]["valeur"];
			else
				$racine = LDAP_MASK_HARD;
				
			$ds=ldap_connect(LDAP_HOST, LDAP_PORT);				
			$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);
			$sr=@ldap_search($ds, $racine, $key[1]."=".$tab[0][$key[0]]);	
			$info = @ldap_get_entries($ds, $sr);

			if (isset($info[0][$key[1]][0]))
			{	
				$template->assign_block_vars('button', array(
				  'TEXT' => $lang["fiche_hard_ldapinfos"],
				  'ID' => 'button_hard_ldap',
				  'CLASS' => 'fiche_button',
					'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/ldap_icon.gif',
				  'LINK' => 'javascript:document.getElementById(\'hard_details\').style.display=\'none\';
						 javascript:document.getElementById(\'button_hard_details\').className=\'fiche_button\';
						 javascript:document.getElementById(\'hard_periph\').style.display=\'none\';
						 javascript:document.getElementById(\'button_hard_periph\').className=\'fiche_button\';
						 javascript:document.getElementById(\'hard_network\').style.display=\'none\';
						 javascript:document.getElementById(\'button_hard_network\').className=\'fiche_button\';
						 javascript:document.getElementById(\'hard_docs\').style.display=\'none\';
						 javascript:document.getElementById(\'button_hard_docs\').className=\'fiche_button\';
						 javascript:document.getElementById(\'hard_softocs\').style.display=\'none\';
						 javascript:document.getElementById(\'button_hard_ocs\').className=\'fiche_button\';
						 javascript:document.getElementById(\'hard_hardocs\').style.display=\'none\';
						 javascript:document.getElementById(\'hard_ldap\').style.display=\'block\';
						 javascript:document.getElementById(\'button_hard_ldap\').className=\'fiche_button_selected\';'
				));	
				
				$template->assign_block_vars('hard_ldap', array(
					 'L_DETAILS' => $lang["fiche_hard_ldapinfos"],				
				));
				
				// Champs � ne pas afficher
				$banned_cols = array('objectguid','objectsid','lastlogontimestamp','instancetype','userparameters','sidhistory','logonhours');
							
				$i = 0;
				$aff=0;
				while($i < $info[0]["count"])
				{ 
					if (!in_array($info[0][$i],$banned_cols))
					{
						if ($aff%2 == 0)
							$template->assign_block_vars('hard_ldap.line', array());

						if (isset($lang["f_users_ldap_".$info[0][$i]]) && $lang["f_users_ldap_".$info[0][$i]] != '')
							$label = $lang["f_users_ldap_".$info[0][$i]];
						else
							$label = $info[0][$i];
						
						// Cas particulier du timestamp
						if ($info[0][$i] == 'badpasswordtime' || $info[0][$i] == 'pwdlastset' || $info[0][$i] == 'lastlogon')
						{
							$dateLargeInt=$info[0][$info[0][$i]][0]; // nano seconds (yes, nano seconds) since jan 1st 1601
							$secsAfterADEpoch = $dateLargeInt / (10000000); // seconds since jan 1st 1601
							$ADToUnixConvertor=((1970-1601) * 365.242190) * 86400; // unix epoch - AD epoch * number of tropical days * seconds in a day
							$unixTsLastLogon=intval($secsAfterADEpoch-$ADToUnixConvertor); // unix Timestamp version of AD timestamp
							$lastlogon=date("d/m/Y", $unixTsLastLogon); // formatted date
							
							$value = $lastlogon;
						}					
						// Cas particulier des dates
						elseif ($info[0][$i] == 'whencreated' || $info[0][$i] == 'whenchanged' || $info[0][$i] == 'dscorepropagationdata')
						{
							$value = format_date_to_aff($info[0][$info[0][$i]][0]);
						}
						else
							$value = $info[0][$info[0][$i]][0];
							
						$template->assign_block_vars('hard_ldap.line.col', array(
							'NAME' => $label,
							'VALUE' => cut_str($value,50),
						));
						
						$aff++;
					}
					$i++;
					
				}

			}
			else
			{
				$template->assign_block_vars('button', array(
				  'TEXT' => $lang["fiche_hard_ldapinfos"],
				  'ID' => 'button_hard_ocs_disabled',
				  'CLASS' => 'fiche_button_disabled',
				));
			}

		}
	}

}
/*********************************/
/*          P�riph�riques        */
/*********************************/
elseif (isset($_GET['type']) && $_GET['type'] == 'periph')
{
	$requete = "SELECT ".TAB_PERIPH.".*,
	".TAB_AGENCES.".".AG_LIBELLE." AS libelle_site,
	".TAB_PERIPH_MARQUE.".".PE_MA_LIBELLE." AS libelle_marque,
	".TAB_PERIPH_MODELE.".".PE_MO_LIBELLE." AS libelle_modele,
	".TAB_HARD.".".HA_NAME." AS nom_hard
	FROM ".TAB_PERIPH." 
	  LEFT JOIN ".TAB_AGENCES." ON ".TAB_AGENCES.".".AG_ID." = ".TAB_PERIPH.".".PE_SITEID."
	  LEFT JOIN ".TAB_HARD." ON ".TAB_HARD.".".HA_ID." = ".TAB_PERIPH.".".PE_HARDID."
	  LEFT JOIN ".TAB_PERIPH_MARQUE." ON ".TAB_PERIPH_MARQUE.".".PE_MA_ID." = ".TAB_PERIPH.".".PE_MARQUEID."
	  LEFT JOIN ".TAB_PERIPH_MODELE." ON ".TAB_PERIPH_MODELE.".".PE_MO_ID." = ".TAB_PERIPH.".".PE_MODELEID."
	WHERE ".TAB_PERIPH.".".PE_ID."='".intval($_GET["id"])."'";
	$tab = $req1->db_use_query($requete);

	if (count($tab) > 0)
	{
		/** Si l'utilisateur a les droits de visualiser le HW **/
		((preg_match('`;'.RGHT_HARD.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)) ?	$LinkToHW = $tab[0]["hard_id"] :$LinkToHW = "0";

		/**Si HW li�**/
		($LinkToHW != "0") ? 
		$template->assign_block_vars('infos', array(
				'NAME' => txt_to_na($tab[0]["nom"]),
				'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
				'MARQUEMODELE' => $lang["fiche_periph_infomm"].txt_to_na($tab[0]["libelle_marque"]).'&nbsp;=>&nbsp;'.txt_to_na($tab[0]["libelle_modele"]),
				'TXTLINKEDTO' => $lang["fiche_periph_hardlinked"],
				'HWNAME' => txt_to_na($tab[0]["nom_hard"]),
				'LINK' => 'index.php?page=visu_fiche.php&amp;type=hard&amp;id='.$tab[0]["hard_id"].'&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=visu',		
				'SERIAL' => $lang["fiche_periph_infoserial"].txt_to_na($tab[0]["num_serie"]),
			))

		/**Si aucun HW li�**/
		:
			$template->assign_block_vars('infos', array(
				'NAME' => txt_to_na($tab[0]["nom"]),
				'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
				'MARQUEMODELE' => $lang["fiche_periph_infomm"].txt_to_na($tab[0]["libelle_marque"]).'&nbsp;=>&nbsp;'.txt_to_na($tab[0]["libelle_modele"]),
				'TXTLINKEDTO' => $lang["fiche_periph_hardlinked"],
				'HWNAME' => txt_to_na($tab[0]["nom_hard"]),
				'LINK' => 'index.php?page=visu_fiche.php&amp;type=periph&amp;id='.$tab[0]["id"].'&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=visu',		
				'SERIAL' => $lang["fiche_periph_infoserial"].txt_to_na($tab[0]["num_serie"]),
			));	

		
		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["fiche_periph_periphdetail"],
		  'ID' => 'button_periph_details',
		  'CLASS' => 'fiche_button_selected',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/periph_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'periph_details\').style.display=\'block\';
					 javascript:document.getElementById(\'button_periph_details\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'periph_docs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_periph_docs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'button_periph_ocs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'periph_periphocs\').style.display=\'none\';',
		));

		$template->assign_block_vars('periph_details',array(
		  'L_TITLE' => $lang["fiche_periph_title"],
		  'L_PERIPH_TITLE' => $lang["gen_periph"],
		  'L_PLACE' => $lang["place_3"],
		  'L_MARQUE' => $lang["marque"],
		  'L_NAME' => $lang["name"],
		  'L_MODELE' => $lang["modele"],
		  'L_SERIAL' => $lang["serial"],
		  'L_RESERV' => $lang["hard_reserv"],
		  'L_DATE' => $lang["f_periph_date"],
		  'L_HARDLINK' => $lang["f_periph_hardlink"],
		  'L_COMMENT' => $lang["comment"],
		  'PLACE' => txt_to_na($tab[0]["libelle_site"]),
		  'MARQUE' => txt_to_na($tab[0]["libelle_marque"]),
		  'NAME' => txt_to_na($tab[0]["nom"]),
		  'MODELE' => txt_to_na($tab[0]["libelle_modele"]),
		  'SERIAL' => txt_to_na($tab[0]["num_serie"]),
		  'RESERV' => bin_to_yn($tab[0]["reservable"] ?? 0),
		  'DATE' => txt_to_na(format_date_to_aff($tab[0]["creation_date"] ?? '')),
		  'HARDLINK' => txt_to_na($tab[0]["nom_hard"]),
		  'COMMENT' => txt_to_na(nl2br($tab[0]["commentaire"])),
		));

		
		// Colonnes perso
		$pfieldColumns = get_table_pfield_columns(TAB_PERIPH);

		foreach ($pfieldColumns as $index => $fieldName) {
			// Nouvelle ligne
			if ($index === 0 || $index % 2 === 0) {
				$template->assign_block_vars('periph_details.line', array());
			}

			if (isset($lang["s_" . TAB_PERIPH . "." . $fieldName])) {
				$displayTitle = $lang["s_" . TAB_PERIPH . "." . $fieldName];
			} else {
				$cleanName = str_replace('pfield_', '', $fieldName);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}
			
			$template->assign_block_vars('periph_details.line.info', array(
			  'VALUE' => txt_to_na($tab[0][$fieldName] ?? ''),
			  'TITLE' => $displayTitle,
			));
		}
	}

	// Documents li�s
	if (preg_match('`;'.RGHT_DOCS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
	{
		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["fiche_periph_docslinked"],
		  'ID' => 'button_periph_docs',
		  'CLASS' => 'fiche_button',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/docs_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'periph_details\').style.display=\'none\';
					 javascript:document.getElementById(\'button_periph_details\').className=\'fiche_button\';
					 javascript:document.getElementById(\'periph_docs\').style.display=\'block\';
					 javascript:document.getElementById(\'button_periph_docs\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'button_periph_ocs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'periph_periphocs\').style.display=\'none\';',
		));

		// $requete = "SELECT * FROM ".TAB_LIAISON_DOCS." WHERE periph_id='".$_GET["id"]."' ORDER BY doc_id DESC";
		// $tab = $req1->db_use_query($requete);
		
		$requete = "SELECT ".TAB_LIAISON_DOCS.".*,
		".TAB_DOCS.".*,
		".TAB_ENTREPRISE.".".EN_COMPANYNAME.",
		".TAB_DOCS_TYPE.".".DO_TY_LIBELLE."
		FROM ".TAB_LIAISON_DOCS." 
		  LEFT JOIN ".TAB_DOCS." ON ".TAB_LIAISON_DOCS.".".DO_LI_DOCID." = ".TAB_DOCS.".".DO_ID."
		  LEFT JOIN ".TAB_ENTREPRISE." ON ".TAB_ENTREPRISE.".".EN_ID." = ".TAB_DOCS.".".DO_COMPANYID." 
		  LEFT JOIN ".TAB_DOCS_TYPE." ON ".TAB_DOCS_TYPE.".".DO_TY_ID." = ".TAB_DOCS.".".DO_TYPEID."
		WHERE ".DO_LI_PERIPHID."='".intval($_GET["id"])."' 
		ORDER BY ".DO_DATE." DESC";
		$tab = $req1->db_use_query($requete);
				
		$template->assign_block_vars('docs', array(
			'L_TITLE' => $lang["fiche_periph_docslinked"],
			'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/docs_icon.gif',
		));	
		
		if (count($tab) != 0)
		{		
			$template->assign_block_vars('button.nb', array(
			  'TEXT' => count($tab),
			));

			$i = 0;
			while ($i < count($tab))
			{
				if ($tab[$i][DO_DATEARCHIVE] < time() && $tab[$i][DO_DATEARCHIVE] != '')
					$class = "row_spec";
				else
					$class = "row1";
					
				$template->assign_block_vars('docs.tab', array(
					'DATE' => format_date_to_aff($tab[$i]["date"] ?? ''),
					'TYPE' => '<font color=#999>'.$lang["fiche_docs_type"].' '.'</font>'.txt_to_na($tab[$i][DO_TY_LIBELLE]),
					'EMETTEUR' => '<font color=#999>'.$lang["fiche_docs_emet"].' '.'</font>'.txt_to_na($tab[$i][EN_COMPANYNAME]),
					'REF' => '<font color=#999>'.$lang["fiche_docs_ref"].' '.'</font>'.txt_to_na($tab[$i][DO_REFERENCE]),
					'COMMENT' => '<font color=#999>'.$lang["f_docs_comment"].': '.'&nbsp;'.'</font>'.txt_to_na($tab[$i][DO_COMMENT]),
					'CLASS' => $class,
				));
				
				if (preg_match('`;'.RGHT_DOCS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
				{
					if (is_file('data/'.$tab[$i][DO_SITEID].'/'.$tab[$i]["path"]))
					{
						$ext = strtolower(substr(strrchr($tab[$i]["path"], '.'), 1));

						$template->assign_block_vars('docs.tab.tools', array(
							'LINK' => 'data/'.$tab[$i][DO_SITEID].'/'.$tab[$i][DO_PATH],		
							'IMAGE' => (is_file('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'))?('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'):('templates/'.DEFAULT_TEMPLATE.'/images/file_.png'),		
						));
					}
					
					$template->assign_block_vars('docs.tab.tools', array(
						'LINK' => 'index.php?page=visu_fiche.php&amp;type=docs&amp;id='.intval($tab[$i]["id"]).'&amp;action=visu',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
						'TITLE' => $lang["docs_detail"]
					));
					
					$template->assign_block_vars('docs.tab.tools', array(
						'LINK' => 'index.php?page=adm_docs.php&amp;action=del_elmt&amp;doc_id='.$tab[$i]["id"].'&amp;type=periph_id&amp;id='.$_GET["id"],
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/unlink.gif',
						'TITLE' => $lang["fiche_periph_deldoclink"],
					));
				}
							
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('docs.no_tab', array(
				'TEXT' => $lang["fiche_nodocs"],
			));
		}
		
		if (preg_match('`;'.RGHT_DOCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('docs.adddoc', array(
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/addlink.gif',
				'LINK' => 'index.php?page=adm_docs.php&amp;action=add_elmt&amp;agence_id='.$_GET["agence_id"].'&amp;periph_id='.$_GET["id"],
				'TITLE' => $lang["f_periph_adddoc"],
			));				
		}
	}
	
	/*            OCS             */
	if (OCS_INSTALL == "Oui")
	{
		if (preg_match('`;'.RGHT_OCS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$requete = "SELECT * FROM ".TAB_PERIPH." WHERE id='".$_GET["id"]."'";
			$tab = $req1->db_use_query($requete);
			
			$connect_ocs = new db_connect();
			$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

			if (isset($connect_ocs->connection) && $connect_ocs->connection->error === '' && CONSTANT("OCS_CRIT_OCS".$_GET["agence_id"]) != '' && $tab[0][PE_OCSID] != 0)
			{
				$requete = "SELECT *
				FROM ".CONSTANT("TAB_OCS_".strtoupper($tab[0][PE_OCSTYPE]))." 
				WHERE ID='".addslashes($tab[0][PE_OCSID])."'";
				$tab_ocs = $req1->db_use_query($requete);
				
				// Infos du poste
				if (count($tab_ocs) != 0)
				{
					$template->assign_block_vars('button', array(
					  'TEXT' => $lang["fiche_periph_ocsinfos"],
					  'ID' => 'button_periph_ocs',
					  'CLASS' => 'fiche_button',
						'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/ocs_icon.gif',
					  'LINK' => 'javascript:document.getElementById(\'periph_details\').style.display=\'none\';
								 javascript:document.getElementById(\'button_periph_details\').className=\'fiche_button\';
								 javascript:document.getElementById(\'periph_docs\').style.display=\'none\';
								 javascript:document.getElementById(\'button_periph_docs\').className=\'fiche_button\';
								 javascript:document.getElementById(\'button_periph_ocs\').className=\'fiche_button_selected\';
								 javascript:document.getElementById(\'periph_periphocs\').style.display=\'block\';',
					));
					
					$template->assign_block_vars('periph_ocsdetails', array(
					  'L_DETAILS' => $lang["fiche_periph_ocsinfos"],
					));
					
					$i = 0;
					while (list($key,$val) = each($tab_ocs[0]))
					{
						if ($i%2 == 0)
							$template->assign_block_vars('periph_ocsdetails.line', array());
						
						$template->assign_block_vars('periph_ocsdetails.line.col', array(
						  'NAME' => $lang["s_OCS_".CONSTANT("TAB_OCS_".strtoupper($tab[0][PE_OCSTYPE])).".".$key],
						  'VALUE' => txt_to_na($val),
						));
						
						$i++;
					}					

				}
				else
				{
					$template->assign_block_vars('button', array(
					  'TEXT' => $lang["fiche_periph_ocsinfos"],
					  'ID' => 'button_periph_ocs_disabled',
					  'CLASS' => 'fiche_button_disabled',
					));
				}

			}
		}
	}

}
/*********************************/
/*            Logiciels          */
/*********************************/
elseif (isset($_GET['type']) && $_GET['type'] == 'soft')
{
	$requete = "SELECT ".TAB_SOFT.".*,
	  ".TAB_SOFT_MARQUE.".libelle AS l_marque
	FROM ".TAB_SOFT." 
	  LEFT JOIN ".TAB_SOFT_MARQUE." ON ".TAB_SOFT.".marque_id = ".TAB_SOFT_MARQUE.".id
	WHERE ".TAB_SOFT.".id='".intval($_GET["id"])."'";
	$tab = $req1->db_use_query($requete);

	if (count($tab) > 0)
	{
		$template->assign_block_vars('infos', array(
		  'NAME' => txt_to_na($tab[0]["nom"]),
		  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
		  'PUB' => txt_to_na($tab[0]["l_marque"]),
		));	

		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["f_soft_main_title"],
		  'ID' => 'button_soft_details',
		  'CLASS' => 'fiche_button_selected',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/soft_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'soft_details\').style.display=\'block\';
					 javascript:document.getElementById(\'button_soft_details\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'soft_docs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_soft_docs\').className=\'fiche_button\';
					 javascript:document.getElementById(\'soft_ocs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_soft_ocs\').className=\'fiche_button\';',
		));	
		
		$template->assign_vars(array(
		  'L_TITLE' => $lang["f_soft_main_title"],
		  'SOFT_LANG_NAME' => $lang["f_soft_name"],
		  'SOFT_LANG_PUBLISHER' => $lang["f_soft_publisher"],
		  'SOFT_LANG_VNUM' => $lang["f_soft_vnum"],
		  'SOFT_LANG_VDATE' => $lang["f_soft_vdate"],
		  'SOFT_LANG_COMMENT' => $lang["f_soft_comment"],
		  'SOFT_NAME' => txt_to_na($tab[0]["nom"]),
		  'SOFT_PUBLISHER' => txt_to_na($tab[0]["l_marque"]),
		  'SOFT_VNUM' => txt_to_na($tab[0]["dern_version_num"]),
		  'SOFT_VDATE' => txt_to_na(format_date_to_aff($tab[0]["dern_version_date"])),
		  'SOFT_COMMENT' => txt_to_na(nl2br($tab[0]["commentaire"])),
		));
		
		// Colonnes perso
		$pfieldColumns = get_table_pfield_columns(TAB_SOFT);

		foreach ($pfieldColumns as $index => $fieldName) {
			// Nouvelle ligne
			if ($index === 0 || $index % 2 === 0) {
				$template->assign_block_vars('line', array());

			}

			if (isset($lang["s_" . TAB_SOFT . "." . $fieldName])) {
				$displayTitle = $lang["s_" . TAB_SOFT . "." . $fieldName];
			} else {
				$cleanName = str_replace('pfield_', '', $fieldName);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}
			
			$template->assign_block_vars('line.info', array(
			  'VALUE' => txt_to_na($tab[0][$fieldName] ?? ''),
			  'TITLE' => $displayTitle,
			));
		}
	}

	
	// Documents attach�s
	if (preg_match('`;'.RGHT_DOCS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
	{
		$requete = "SELECT ".TAB_LIAISON_DOCS.".*,
		".TAB_DOCS.".*,
		".TAB_ENTREPRISE.".".EN_COMPANYNAME.",
		".TAB_DOCS_TYPE.".".DO_TY_LIBELLE."
		FROM ".TAB_LIAISON_DOCS." 
		  LEFT JOIN ".TAB_DOCS." ON ".TAB_LIAISON_DOCS.".".DO_LI_DOCID." = ".TAB_DOCS.".".DO_ID."
		  LEFT JOIN ".TAB_ENTREPRISE." ON ".TAB_ENTREPRISE.".".EN_ID." = ".TAB_DOCS.".".DO_COMPANYID." 
		  LEFT JOIN ".TAB_DOCS_TYPE." ON ".TAB_DOCS_TYPE.".".DO_TY_ID." = ".TAB_DOCS.".".DO_TYPEID."
		WHERE ".DO_LI_SOFTID."='".intval($_GET["id"])."' 
		ORDER BY ".DO_DATE." DESC";
		$tab = $req1->db_use_query($requete);
		
		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["f_soft_docslinked"],
		  'ID' => 'button_soft_docs',
		  'CLASS' => 'fiche_button',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/docs_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'soft_details\').style.display=\'none\';
					 javascript:document.getElementById(\'button_soft_details\').className=\'fiche_button\';
					 javascript:document.getElementById(\'soft_docs\').style.display=\'block\';
					 javascript:document.getElementById(\'button_soft_docs\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'soft_ocs\').style.display=\'none\';
					 javascript:document.getElementById(\'button_soft_ocs\').className=\'fiche_button\';',
		));	
		
		$template->assign_block_vars('docs', array(
			'L_TITLE' => $lang["f_soft_docslinked"],
		));	
		
		if (count($tab) != 0)
		{		
			$template->assign_block_vars('button.nb', array(
			  'TEXT' => count($tab),
			));
			
			$i = 0;
			while ($i < count($tab))
			{
				if ($tab[$i][DO_DATEARCHIVE] < time() && $tab[$i][DO_DATEARCHIVE] != '')
					$class = "row_spec";
				else
					$class = "row1";
				
				$template->assign_block_vars('docs.tab', array(
					'DOC' => $lang["f_soft_doc"],
					'DATE' => '<font color=#999>'.$lang["fiche_periph_date"].'</font>'.format_date_to_aff($tab[$i]["date"] ?? ''),
					'TYPE' => '<font color=#999>'.$lang["fiche_docs_type"].' '.'</font>'.txt_to_na($tab[$i][DO_TY_LIBELLE]),
					'EMETTEUR' => '<font color=#999>'.$lang["fiche_docs_emet"].' '.'</font>'.txt_to_na($tab[$i][EN_COMPANYNAME]),
					'REF' => '<font color=#999>'.$lang["fiche_docs_ref"].' '.'</font>'.txt_to_na($tab[$i][DO_REFERENCE]),
					'COMMENT' => '<font color=#999>'.$lang["f_docs_comment"].' '.'</font>'.txt_to_na($tab[$i][DO_COMMENT]),
					'CLASS' => $class,
				));
				
				if (preg_match('`;'.RGHT_DOCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
				{
					
					if (is_file('data/'.$tab[$i][DO_SITEID].'/'.$tab[$i]["path"]))
					{
						$ext = strtolower(substr(strrchr($tab[$i]["path"], '.'), 1));

						$template->assign_block_vars('docs.tab.tools', array(
							'LINK' => 'data/'.$tab[$i][DO_SITEID].'/'.$tab[$i][DO_PATH],		
							'IMAGE' => (is_file('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'))?('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'):('templates/'.DEFAULT_TEMPLATE.'/images/file_.png'),		
						));
					}
					
					$template->assign_block_vars('docs.tab.tools', array(
						'LINK' => 'index.php?page=visu_fiche.php&amp;type=docs&amp;id='.intval($tab[$i][DO_ID]).'&amp;action=visu',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
						'TITLE' => $lang["docs_detail"]
					));
					
					$template->assign_block_vars('docs.tab.tools', array(
						'LINK' => 'index.php?page=adm_docs.php&amp;action=del_elmt&amp;doc_id='.$tab[$i][DO_ID].'&amp;type=software_id&amp;id='.$_GET["id"],
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/unlink.gif',
						'TITLE' => $lang["fiche_docs_delelmtlink"],
					));
				}
							
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('docs.no_tab', array(
				'TEXT' => $lang["fiche_nodocs"],
			));
		}

		if (preg_match('`;'.RGHT_DOCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('docs.adddoc', array(
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/addlink.gif',
				'LINK' => 'index.php?page=adm_docs.php&amp;action=add_elmt&amp;agence_id='.$_GET["agence_id"].'&amp;soft_id='.$_GET["id"],
				'TITLE' => '<font color=#9899C5>'.$lang["f_soft_adddoc"].'</font>',
			));				
		}	
	}
	
	// Alias OCS
	if (OCS_INSTALL == "Oui")
	{
		if (preg_match('`;'.RGHT_OCS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('button', array(
			  'TEXT' => $lang["f_soft_ocs"],
			  'ID' => 'button_soft_ocs',
			  'CLASS' => 'fiche_button',
				'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/ocs_icon.gif',
			  'LINK' => 'javascript:document.getElementById(\'soft_details\').style.display=\'none\';
						 javascript:document.getElementById(\'button_soft_details\').className=\'fiche_button\';
						 javascript:document.getElementById(\'soft_docs\').style.display=\'none\';
						 javascript:document.getElementById(\'button_soft_docs\').className=\'fiche_button\';
						 javascript:document.getElementById(\'soft_ocs\').style.display=\'block\';
						 javascript:document.getElementById(\'button_soft_ocs\').className=\'fiche_button_selected\';',
			));	
			
			$template->assign_block_vars('s_alias', array(
				'L_TITLE' => $lang["f_soft_aliasocs"],
			));	
			
			if (defined("OCS_CRIT_BASE".intval(intval($_GET["agence_id"]))))
			{
				// Cherche les alias OCS du logiciel
				$requete = "SELECT *
				FROM ".TAB_SOFT_OCS_ALIAS."
				WHERE ouapi_soft_id='".intval($_GET["id"])."'";
				$tab_alias = $req1->db_use_query($requete);	
				
				if (count($tab_alias) > 0)
				{
					$i = 0;
					while ($i < count($tab_alias))
					{
						$template->assign_block_vars('s_alias.tab', array(
							'NAME' => $tab_alias[$i]["ocs_soft_name"],
						));	
									
						$i++;
					}
				}
				else
				{
					$template->assign_block_vars('s_alias.no_tab', array(
						'TEXT' => $lang["fiche_soft_noalias"],
					));				
				}

			}
		}
	}


}

// Historique des install / MAJ d'un logiciel precis sur un materiel
elseif (isset($_GET['type']) && $_GET['type'] == 'histo_soft')
{
	$affichage .= '<br/>'.$aff_fiches->aff_histo_soft($_GET["s_id"],$_GET["h_id"]);
}

// Affichage des materiels ou le logiciel $s_id est install� (tous alias)
elseif (isset($_GET['type']) && $_GET['type'] == 'hardinstalled_soft')
{
	$aff_gen = $aff_site = '';
	$total = 0;
	
	$affichage = '<br/><table width="99%" align="center">
	<tr>
		<td class="titre2" colspan="4"><img src="templates/'.DEFAULT_TEMPLATE.'/images/soft_icon.gif" style="vertical-align:middle" height="16">&nbsp;'.$lang["fiche_hardinstall_title"].'</td>
	</tr>';
	
	if (OCS_INSTALL == "Oui" && (preg_match('`;'.RGHT_OCS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
	{
		// Cherche les alias OCS du logiciel
		$requete = "SELECT ".TAB_SOFT_OCS_ALIAS.".*,
		".TAB_SOFT.".dern_version_num AS VNUM,
		".TAB_SOFT.".dern_version_date AS VDATE
		FROM ".TAB_SOFT_OCS_ALIAS." 
		  LEFT JOIN ".TAB_SOFT." ON ".TAB_SOFT.".id = ".TAB_SOFT_OCS_ALIAS.".ouapi_soft_id
		WHERE ouapi_soft_id='".$_GET["s_id"]."'";
		$tab_alias = $req1->db_use_query_inv($requete);	

		if (count($tab_alias["id"]) > 0)
		{
			$liste_alias = TAB_OCS_SOFT.".".COL_OCS_SOFT_NAME."='".implode("' OR ".TAB_OCS_SOFT.".".COL_OCS_SOFT_NAME."='",$tab_alias["ocs_soft_name"])."'";

			$connect->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

			$requete = "SELECT ".TAB_OCS_SOFT.".".COL_OCS_SOFT_HARDID.",
			".TAB_OCS_HARD.".".CONSTANT(OCS_MASK_TYPE.$_GET["agence_id"])." AS crit_ocs,
			".TAB_OCS_HARD.".".COL_OCS_LASTDATE." AS lastupdate,
			".TAB_OCS_SOFT.".".COL_OCS_SOFT_VERSION." AS version,
			".TAB_OCS_SOFT.".".COL_OCS_SOFT_NAME." AS softname
			FROM ".TAB_OCS_SOFT."
			  LEFT JOIN ".TAB_OCS_HARD." ON ".TAB_OCS_HARD.".".COL_OCS_HARD_ID." = ".TAB_OCS_SOFT.".".COL_OCS_SOFT_HARDID."						
			WHERE ".$liste_alias."
			ORDER BY ".TAB_OCS_HARD.".".CONSTANT(OCS_MASK_TYPE.$_GET["agence_id"]);
			$tab_soft_ocs = $req1->db_use_query_inv($requete);

			if (MULTISITE == "Oui")
			{
				$requete = "SELECT ".CONSTANT(OCS_MASK_TYPE.$_GET["agence_id"])." AS crit				
				FROM ".TAB_OCS_HARD." 
				WHERE ".CONSTANT(OCS_MASK_TYPE.$_GET["agence_id"])." LIKE '".str_replace('*','%',CONSTANT(OCS_MASK.$_GET["agence_id"]))."'";
				$tab_hard = $req1->db_use_query_inv($requete);
			}
			else
			{
				$tab_hard = array();
			}
			
			$j = 0;
			while ($j < count($tab_soft_ocs["crit_ocs"]))
			{		
				if (in_array($tab_soft_ocs["crit_ocs"][$j],$tab_hard["crit"]))
				{
					$aff_site .= '<tr>
						<td class="row1">'.$tab_soft_ocs["crit_ocs"][$j].'</td>
						<td class="row1">'.format_date_to_aff($tab_soft_ocs["lastupdate"][$j]).'</td>
						<td class="row1">'.$lang["ocs_version"].': '.txt_to_na($tab_soft_ocs["version"][$j]).'</td>
						<td class="row1">'.$lang["fiche_hardsoft_lastv"].' '.txt_to_na($tab_alias["VNUM"][0]).' <i>('.format_date_to_aff($tab_alias["VDATE"][0]).')</i></td>
					</tr>';
					$total++;
				}
				else
				{
					$aff_gen .= '<tr>
						<td class="row1">'.$tab_soft_ocs["crit_ocs"][$j].'</td>
						<td class="row1">'.format_date_to_aff($tab_soft_ocs["lastupdate"][$j]).'</td>
						<td class="row1">'.$lang["ocs_version"].': '.txt_to_na($tab_soft_ocs["version"][$j]).'</td>
						<td class="row1">'.$lang["fiche_hardsoft_lastv"].' '.txt_to_na($tab_alias["VNUM"][0]).' <i>('.format_date_to_aff($tab_alias["VDATE"][0]).')</i></td>
					</tr>';
					$total++;
				}
				
				$j++;
			}

		}
	}
	else
	{				
		$requete = "SELECT ".TAB_HARDSOFT.".*,
		".TAB_SOFT.".dern_version_num AS VNUM,
		".TAB_SOFT.".dern_version_date AS VDATE,
		".TAB_HARD.".nom,
		".TAB_HARD.".agence_id,
		".TAB_HARD.".suivi_rebus
		FROM ".TAB_HARDSOFT."
		  LEFT JOIN ".TAB_SOFT." ON ".TAB_SOFT.".id = ".TAB_HARDSOFT.".software_id
		  LEFT JOIN ".TAB_HARD." ON ".TAB_HARD.".id = ".TAB_HARDSOFT.".hardware_id
		WHERE software_id = '".$_GET["s_id"]."' AND ".TAB_HARD.".suivi_rebus = ''
		GROUP BY hardware_id
		ORDER BY version_date_maj DESC, version_num DESC";		
		$tab = $req1->db_use_query_inv($requete);

		$i = 0;
		while ($i < count($tab["nom"]))
		{
			if ($tab["agence_id"][$i] == $_GET["agence_id"])
			{
				$aff_site .= '<tr>
					<td class="row1">'.$tab["nom"][$i].'</td>
					<td class="row1" colspan="2">'.$lang["fiche_soft_lastversion"].' '.num_to_na($tab["version_num"][$i]).' 
					'.$lang["fiche_soft_lastdate"].' '.format_date_to_aff($tab["version_date_maj"][$i],'/').'</td>
					<td class="row1">'.$lang["fiche_hardsoft_lastv"].' '.num_to_na($tab["VNUM"][$i]).' 
					'.$lang["fiche_soft_lastdate"].' '.format_date_to_aff($tab["VDATE"][$i],'/').'</td>
				</tr>';
			}
			else
			{
				$aff_gen .= '<tr>
					<td class="row1">'.$tab["nom"][$i].'</td>
					<td class="row1" colspan="2">'.$lang["fiche_soft_lastversion"].' '.num_to_na($tab["version_num"][$i]).' 
					'.$lang["fiche_soft_lastdate"].' '.format_date_to_aff($tab["version_date_maj"][$i],'/').'</td>
					<td class="row1">'.$lang["fiche_hardsoft_lastv"].' '.num_to_na($tab["VNUM"][$i]).' 
					'.$lang["fiche_soft_lastdate"].' '.format_date_to_aff($tab["VDATE"][$i],'/').'</td>
				</tr>';
			}
			$total++;
			$i++;
		}

	}
	
	if ($total > 0)	
	{
		$affichage .= '<tr>
			<td class="titre3">'.$lang["hard"].'</td>';
			if (!OCS_INSTALL == "Oui" && (preg_match('`;'.RGHT_OCS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))		
			{
				$affichage .= '<td class="titre3">'.$lang["fiche_ocs_lastupdate"].'</td>';
				$affichage .= '<td class="titre3">'.$lang["ocs_version"].'</td>';
			}
			else
			{
				$affichage .= '<td class="titre3" colspan="2">'.$lang["fiche_last_install"] .'</td>';
			}
			$affichage .= '<td class="titre3">'.$lang["fiche_ouapi_version"].'</td>
		</tr>';

		if (MULTISITE == "Oui")
		{
			$affichage .= '<tr>
				<td class="titre4" colspan="4">'.$lang["soft_title_thissite"].'</td>
			</tr>';
			
			if ($aff_site != '')
				$affichage .= $aff_site;
			else
				$affichage .= '<tr><td class="row1" colspan="4">'.$lang["none"].'</td></tr>';
			
			$affichage .= '<tr>
				<td class="titre4" colspan="4">'.$lang["soft_title_allsite"].'</td>
			</tr>';
		}
		
		if ($aff_gen != '')
			$affichage .= $aff_gen;
		else
			$affichage .= '<tr><td class="row1" colspan="4">'.$lang["none"].'</td></tr>';
	}
	else		
	{
		$affichage .= '<tr>
			<td class="row_aucun" colspan="4">'.$lang["fiche_hardinstall_nohard"].'</td>
		</tr>';
	}
	$affichage .= '</table>';
}
/*********************************/
/*            DOCUMENTS          */
/*********************************/
elseif (isset($_GET['type']) && $_GET['type'] == 'docs')
{
	$requete = "SELECT ".TAB_DOCS.".*,
	  ".TAB_DOCS.".id AS id_doc,
	  ".TAB_ENTREPRISE.".raison_sociale,
	  ".TAB_DOCS_TYPE.".libelle AS l_type
	  FROM ".TAB_DOCS." 
		LEFT JOIN ".TAB_ENTREPRISE." ON ".TAB_DOCS.".entreprise_id = ".TAB_ENTREPRISE.".id
		LEFT JOIN ".TAB_DOCS_TYPE." ON ".TAB_DOCS.".type_id = ".TAB_DOCS_TYPE.".id
	  WHERE ".TAB_DOCS.".id='".$_GET["id"]."'";
	$tab = $req1->db_use_query($requete);

	if (count($tab) > 0)
	{
		$template->assign_block_vars('infos', array(
		  'NAME' => txt_to_na($tab[0]["reference"]),
		  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
		  'TYPE' => $lang["f_docs_type"].':&nbsp;'.txt_to_na($tab[0]["l_type"]),
		  'DATE' => format_date_to_aff($tab[0]["date"] ?? ''),
		  'ENTREPRISE' => $lang["f_docs_company"].':&nbsp;'.txt_to_na($tab[0]["raison_sociale"]),
		));	

		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["f_docs_details"],
		  'ID' => 'button_doc_details',
		  'CLASS' => 'fiche_button_selected',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/docs_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'doc_details\').style.display=\'block\';
					 javascript:document.getElementById(\'button_doc_details\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'doc_links\').style.display=\'none\';
					 javascript:document.getElementById(\'button_doc_links\').className=\'fiche_button\';
					 javascript:document.getElementById(\'doc_view\').style.display=\'none\';
					 javascript:document.getElementById(\'button_doc_view\').className=\'fiche_button\';',
		));	
		
		// D�tail du document
		$template->assign_vars(array(
			'L_TITLE' => $lang["f_docs_details"],
			'L_TYPE' => $lang["f_docs_type"],
			'TYPE' => txt_to_na($tab[0]["l_type"]),
			'L_REF' => $lang["f_docs_ref"],
			'REF' => txt_to_na($tab[0]["reference"]),
			'L_ENTREPRISE' => $lang["f_docs_company"],
			'ENTREPRISE' => txt_to_na($tab[0]["raison_sociale"]),
			'L_DATE' => $lang["f_docs_date"],
			'DATE' => format_date_to_aff($tab[0]["date"] ?? ''),
			'L_DATE_ARCHIVE' => $lang["f_docs_datearchive"],
			'DATE_ARCHIVE' => txt_to_na(format_date_to_aff($tab[0]["date_archive"] ?? '')),
			'L_COMMENT' => $lang["f_docs_comment"],
			'COMMENT' => txt_to_na($tab[0]["commentaire"]),
		));

		// Colonnes perso
		$pfieldColumns = get_table_pfield_columns(TAB_DOCS);

		foreach ($pfieldColumns as $index => $fieldName) {
			// Nouvelle ligne
			if ($index === 0 || $index % 2 === 0) {
				$template->assign_block_vars('line', array());

			}

			if (isset($lang["s_" . TAB_DOCS . "." . $fieldName])) {
				$displayTitle = $lang["s_" . TAB_DOCS . "." . $fieldName];
			} else {
				$cleanName = str_replace('pfield_', '', $fieldName);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}
			
			$template->assign_block_vars('line.info', array(
			  'VALUE' => txt_to_na($tab[0][$fieldName] ?? ''),
			  'TITLE' => $displayTitle,
			));
		}
	}
	
	/*********** ELEMENTS LIES **********/
	if (count($tab) > 0)
	{
		$template->assign_block_vars('button', array(
		  'TEXT' => $lang["f_docs_elmts_title"],
		  'ID' => 'button_doc_links',
		  'CLASS' => 'fiche_button',
			'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/link_icon.gif',
		  'LINK' => 'javascript:document.getElementById(\'doc_details\').style.display=\'none\';
					 javascript:document.getElementById(\'button_doc_details\').className=\'fiche_button\';
					 javascript:document.getElementById(\'doc_links\').style.display=\'block\';
					 javascript:document.getElementById(\'button_doc_links\').className=\'fiche_button_selected\';
					 javascript:document.getElementById(\'doc_view\').style.display=\'none\';
					 javascript:document.getElementById(\'button_doc_view\').className=\'fiche_button\';',
		));	

		$requete = "SELECT ".TAB_LIAISON_DOCS.".doc_id,
		  ".TAB_LIAISON_DOCS.".hardware_id,		
		  ".TAB_LIAISON_DOCS.".periph_id,		
		  ".TAB_LIAISON_DOCS.".software_id,	
		  ".TAB_HARD.".nom AS hardname,
		  ".TAB_HARD.".".HA_REBUT." AS hard_rebut,
		  ".TAB_PERIPH.".nom AS periphname,
		  ".TAB_PERIPH.".".PE_REBUT." AS periph_rebut,
		  ".TAB_SOFT.".nom AS softname
		FROM ".TAB_LIAISON_DOCS." 
		  LEFT JOIN ".TAB_HARD." ON ".TAB_LIAISON_DOCS.".hardware_id = ".TAB_HARD.".id
		  LEFT JOIN ".TAB_PERIPH." ON ".TAB_LIAISON_DOCS.".periph_id = ".TAB_PERIPH.".id
		  LEFT JOIN ".TAB_SOFT." ON ".TAB_LIAISON_DOCS.".software_id = ".TAB_SOFT.".id
		WHERE ".TAB_LIAISON_DOCS.".doc_id='".$_GET["id"]."'
		ORDER BY hardname,periphname,softname";
		$tab_liaison = $req1->db_use_query($requete);

		$template->assign_block_vars('doc_links', array(
		  'L_TITLE_ELMTS' => $lang["f_docs_elmts_title"],	
		));

		if (count($tab_liaison) != 0)
		{						
			$template->assign_block_vars('button.nb', array(
			  'TEXT' => count($tab_liaison),
			));
			
			
			$j = 0;
			while ($j < count($tab_liaison))
			{				
				if ($tab_liaison[$j]["hardware_id"] != 0)
				{
					if ($tab_liaison[$j]['hard_rebut'] != '')
						$class = 'row_spec';
					else
						$class = 'row1';
						
					$template->assign_block_vars('doc_links.list', array(
					  'NAME'  => $tab_liaison[$j]["hardname"],
					  'TYPE' => $lang["fiche_elmttype_hard"],
					  'CLASS' => $class,
					));
					$type = 'hardware_id';
				}
				elseif ($tab_liaison[$j]["software_id"] != 0)
				{
					$class = 'row1';
					$type = 'software_id';
					
					$template->assign_block_vars('doc_links.list', array(
					  'NAME'  => $tab_liaison[$j]["softname"],
					  'TYPE' => $lang["fiche_elmttype_soft"],
					  'CLASS' => $class,
					));
				}
				else
				{
					if ($tab_liaison[$j]['periph_rebut'] != '')
						$class = 'row_spec';
					else
						$class = 'row1';
						
					$template->assign_block_vars('doc_links.list', array(
					  'NAME'  => $tab_liaison[$j]["periphname"],
					  'TYPE' => $lang["fiche_elmttype_periph"],
					  'CLASS' => $class,
					));
					$type = 'periph_id';
				}

				$template->assign_block_vars('doc_links.list.tools', array(
					'LINK' => 'index.php?page=adm_docs.php&amp;action=del_elmt&amp;doc_id='.$_GET["id"].'&amp;type='.$type.'&amp;id='.$tab_liaison[$j][$type],
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/unlink.gif',
					'TITLE' => $lang["fiche_docs_delelmtlink"],
				));
				
				$j++;
			}
		}
		else
		{
			$template->assign_block_vars('doc_links.no_contr', array(
			  'TEXT'  => $lang["f_docs_noelmts"],
			));
		}

		if (preg_match('`;'.RGHT_DOCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('doc_links.elmts', array());
			
			$template->assign_block_vars('doc_links.elmts.tools', array(
				'LINK' => 'index.php?page=adm_docs.php&amp;action=add_elmt&amp;agence_id='.$tab[0]["agence_id"].'&amp;doc_id='.$_GET["id"].'&amp;hard_id=0',
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_hard.gif',
				'TITLE' => '<font color=#9899C5>'.$lang["docs_addhard"].'</font>'
			));							
			$template->assign_block_vars('doc_links.elmts.tools', array(
				'LINK' => 'index.php?page=adm_docs.php&amp;action=add_elmt&amp;agence_id='.$tab[0]["agence_id"].'&amp;doc_id='.$_GET["id"].'&amp;periph_id=0',
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_periph.gif',
				'TITLE' => '<font color=#9899C5>'.$lang["docs_addperiph"].'</font>'
			));							
			$template->assign_block_vars('doc_links.elmts.tools', array(
				'LINK' => 'index.php?page=adm_docs.php&amp;action=add_elmt&amp;agence_id='.$tab[0]["agence_id"].'&amp;doc_id='.$_GET["id"].'&amp;soft_id=0',
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_soft.gif',
				'TITLE' => '<font color=#9899C5>'.$lang["docs_addsoft"].'</font>'
			));							
		}

		if (is_file('data/'.$tab[0]["agence_id"].'/'.$tab[0]["path"]))
		{
			$template->assign_block_vars('button', array(
			  'TEXT' => $lang["f_docs_view_title"],
			  'ID' => 'button_doc_view',
			  'CLASS' => 'fiche_button',
				'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/preview.gif',
		  'LINK' => 'javascript:document.getElementById(\'doc_details\').style.display=\'none\';
					 javascript:document.getElementById(\'button_doc_details\').className=\'fiche_button\';
					 javascript:document.getElementById(\'doc_links\').style.display=\'block\';
					 javascript:document.getElementById(\'button_doc_links\').className=\'fiche_button\';
					 javascript:document.getElementById(\'doc_view\').style.display=\'block\';
					 javascript:document.getElementById(\'button_doc_view\').className=\'fiche_button_selected\';',
		));
		}	
		
		$ext = strtolower(substr(strrchr($tab[0]["path"], '.'), 1));

		if (isset($applications[$ext]))
		{
			$template->assign_block_vars('document', array(
				'L_TITLE' => $lang["f_docs_document_title"],
				'SHORT_PATH' => $tab[0]["path"],
				'PATH' => 'data/'.$tab[0]["agence_id"].'/'.$tab[0]["path"],
				'EXT' => $applications[$ext],
				'WIDTH' => $height[$ext][0],
				'HEIGHT' => $height[$ext][1],
			));		
		}
		
		$template->assign_block_vars('download', array(
			'L_TITLE' => $lang["f_docs_download_title"],		
			'FILE' => $tab[0]["reference"],		
			'PATH' => $tab[0]["path"],		
			'LINK' => 'data/'.$tab[0]["agence_id"].'/'.$tab[0]["path"],		
			'L_DOWNLOAD' => $lang["f_docs_download"],		
			'IMAGE' => (is_file('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'))?('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'):('templates/'.DEFAULT_TEMPLATE.'/images/file_.png'),		
		));
	}
}
/*********************************/
/*              RESEAU           */
/*********************************/
elseif (isset($_GET['type']) && $_GET['type'] == 'netw')
{
    $requete = "SELECT ".TAB_RESEAU.".*,
      ".TAB_EMPL.".".EM_LIBELLE.",
      ".TAB_HARD.".".HA_NAME.",
      tab_networkhard.".HA_NAME." AS netwname
      FROM ".TAB_RESEAU." 
        LEFT JOIN ".TAB_EMPL." ON ".TAB_EMPL.".".EM_ID." = ".TAB_RESEAU.".".RE_LOCATIONID."
        LEFT JOIN ".TAB_HARD." ON ".TAB_HARD.".".HA_ID." = ".TAB_RESEAU.".".RE_HARDWAREID."
        LEFT JOIN ".TAB_HARD." tab_networkhard ON tab_networkhard.".HA_ID." = ".TAB_RESEAU.".".RE_NETWORKHARDID."
      WHERE ".TAB_RESEAU.".id='".intval($_GET["id"])."'";
    $tab = $req1->db_use_query($requete, 1);

    // Nettoyage des clés (enlève les "1." ou les préfixes de table selon le moteur SQL)
    $cleaned_tab = [];
    foreach ($tab as $i => $ligne) {
        foreach ($ligne as $cle => $valeur) {
            // On nettoie le '1.' mais on garde à l'esprit que les alias comme 'netwname' restent tels quels
            $cle_nettoyee = str_replace('1.', '', $cle);
            $cleaned_tab[$i][$cle_nettoyee] = $valeur;
        }
    }
    $tab = $cleaned_tab;
    
    // On récupère les noms de colonnes simples sans les noms de table
    $col_num_prise = RE_PLUGNUMBER; 
    $col_libelle   = EM_LIBELLE;
    $col_ha_name   = HA_NAME;
    $col_port_id   = RE_PORTID;

    $template->assign_block_vars('infos', array(
      'NAME' => txt_to_na($tab[0][$col_num_prise] ?? ''),
      'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
      'LOCATION' => $lang["f_netw_plugnumber"].': '.txt_to_na($tab[0][$col_libelle] ?? ''),
    )); 

    $template->assign_block_vars('button', array(
      'TEXT' => $lang["f_netw_title"],
      'ID' => 'button_netw_details',
      'CLASS' => 'fiche_button_selected',
      'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/netw_icon.gif',
      'LINK' => "javascript:document.getElementById('netw_details').style.display='block';
                 javascript:document.getElementById('button_netw_details').className='fiche_button_selected';",
    )); 
    
    // Détail de la prise
    $template->assign_vars(array(
        'L_TITLE' => $lang["f_netw_title"],
        'L_PLUGNB' => $lang["f_netw_plugnumber"],
        'PLUGNB' => txt_to_na($tab[0][$col_num_prise] ?? ''),
        'L_LOCATION' => $lang["f_netw_location"] ?? 'Emplacement', // Vérifie la clé de langue
        'LOCATION' => txt_to_na($tab[0][$col_libelle] ?? ''),
        'L_HARDNAME' => $lang["f_netw_hardname"],
        'HARDNAME' => txt_to_na($tab[0][$col_ha_name] ?? ''),
        'L_NETWHARDNAME' => $lang["f_netw_netwhardname"],
        'NETWHARDNAME' => txt_to_na($tab[0]["netwname"] ?? ''), // Utilisation de l'alias direct
        'L_PORT' => $lang["f_netw_port"],
        'PORT' => txt_to_na($tab[0][$col_port_id] ?? ''),
    ));

    // Colonnes perso
    $pfieldColumns = get_table_pfield_columns(TAB_RESEAU);

    foreach ($pfieldColumns as $index => $fieldName) {
        if ($index === 0 || $index % 2 === 0) {
            $template->assign_block_vars('line', array());
        }

        if (isset($lang["s_" . TAB_RESEAU . "." . $fieldName])) {
            $displayTitle = $lang["s_" . TAB_RESEAU . "." . $fieldName];
        } else {
            $cleanName = str_replace('pfield_', '', $fieldName);
            $cleanName = str_replace('_', ' ', $cleanName);
            $displayTitle = ucfirst($cleanName);
        }
        
        $template->assign_block_vars('line.info', array(
          'VALUE' => txt_to_na($tab[0][$fieldName] ?? ''),
          'TITLE' => $displayTitle,
        ));
    }
}
/*********************************/
/*          Utilisateurs         */
/*********************************/
elseif (isset($_GET['type']) && $_GET['type'] == 'users')
{
	$requete = "SELECT ".TAB_USERS.".*,
	  ".TAB_USERS_GRP.".libelle AS groupe
	FROM ".TAB_USERS."
	  LEFT JOIN ".TAB_USERS_GRP." ON ".TAB_USERS_GRP.".id = ".TAB_USERS.".groupe_id
	WHERE ".TAB_USERS.".id='".$_GET["id"]."'";
	$tab = $req1->db_use_query($requete);


	// Bloc d'infos sup�rieur
	$template->assign_block_vars('infos', array(
	  'NAME' => txt_to_na($tab[0]["nom"]).'&nbsp;'.txt_to_na($tab[0]["prenom"]),
	  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
	  'MAIL' => txt_to_na($tab[0]["mail"]),
	  'GROUP' => $lang["f_users_group"].':&nbsp;'.txt_to_na($tab[0]["groupe"]),
	));	

	$template->assign_block_vars('button', array(
	  'TEXT' => $lang["f_users_title"],
	  'ID' => 'button_user_details',
	  'CLASS' => 'fiche_button_selected',
		'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/users_icon.gif',
	  'LINK' => 'javascript:document.getElementById(\'user_details\').style.display=\'block\';
				 javascript:document.getElementById(\'button_user_details\').className=\'fiche_button_selected\';
				 javascript:document.getElementById(\'user_ldap\').style.display=\'none\';
				 javascript:document.getElementById(\'button_user_ldap\').className=\'fiche_button\';',
	));	
	
	$template->assign_vars(array(
	  'L_TITLE' => $lang["f_users_title"],
	  'USER_LANG_FIRSTNAME' => $lang["f_users_firstname"],
	  'USER_LANG_LASTNAME' => $lang["f_users_lastname"],
	  'USER_LANG_MAIL' => $lang["f_users_mail"],
	  'USER_LANG_GROUP' => $lang["f_users_group"],
	  'USER_LANG_OUAPILOGIN' => $lang["f_users_ouapilogin"],
	  'USER_LANG_WINLOGIN' => $lang["f_users_winlogin"],
	  //'USER_LANG_LANGUAGE' => $lang["f_users_language"],
	  'USER_FIRSTNAME' => txt_to_na($tab[0]["prenom"]),
	  'USER_LASTNAME' => txt_to_na($tab[0]["nom"]),
	  'USER_MAIL' => txt_to_na($tab[0]["mail"]),
	  'USER_GROUP' => txt_to_na($tab[0]["groupe"]),
	  'USER_OUAPILOGIN' => txt_to_na($tab[0]["login"]),
	  'USER_WINLOGIN' => txt_to_na($tab[0]["login_win"]),
	));

	
	
	// Colonnes perso
	$pfieldColumns = get_table_pfield_columns(TAB_USERS);

	foreach ($pfieldColumns as $index => $fieldName) {
		// Nouvelle ligne
		if ($index === 0 || $index % 2 === 0) {
			$template->assign_block_vars('line', array());

		}

		if (isset($lang["s_" . TAB_USERS . "." . $fieldName])) {
			$displayTitle = $lang["s_" . TAB_USERS . "." . $fieldName];
		} else {
			$cleanName = str_replace('pfield_', '', $fieldName);
			$cleanName = str_replace('_', ' ', $cleanName);
			$displayTitle = ucfirst($cleanName);
		}
		
		$template->assign_block_vars('line.info', array(
		  'VALUE' => txt_to_na($tab[0][$fieldName]),
		  'TITLE' => $displayTitle,
		));
	}
	

	/***************** Infos LDAP *************************/
	if (LDAP_INSTALL == "Oui" && $fp = @fsockopen(LDAP_HOST, LDAP_PORT, $errno, $errstr, 5))
	{				
		if (preg_match('`;'.RGHT_LDAP.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			fclose($fp);			
			
			$template->assign_block_vars('ldap', array(
				'TITLE' => $lang["f_users_ldapinfo_title"],
			));
			
			// Racine de recherche LDAP du site
			$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask".$_GET["agence_id"]."'";
			$tab_racine = $req1->db_use_query($requete);
			
			if (count($tab_racine) > 0)
				$racine = $tab_racine[0]["valeur"];
			else
				$racine = LDAP_MASK;

			if (defined("LDAP_KEY"))
				$key_ldap = explode(";",LDAP_KEY);
			else
				$key_ldap = array('mail','mail');
				

			$ds=ldap_connect(LDAP_HOST, LDAP_PORT);				
			$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);
			$sr=@ldap_search($ds, $racine, constant("LDAP_ATTR_".strtoupper($key_ldap[1])).'='.$tab[0][$key_ldap[0]]);
			$info = @ldap_get_entries($ds, $sr);

			if (isset($info[0]) && count($info[0]) > 0)
			{
				$template->assign_block_vars('button', array(
				  'TEXT' => $lang["f_users_ldapinfo_title"],
				  'ID' => 'button_user_ldap',
				  'CLASS' => 'fiche_button',
					'IMG_ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/ldap_icon.gif',
				  'LINK' => 'javascript:document.getElementById(\'user_details\').style.display=\'none\';
						 javascript:document.getElementById(\'button_user_details\').className=\'fiche_button\';
						 javascript:document.getElementById(\'user_ldap\').style.display=\'block\';
						 javascript:document.getElementById(\'button_user_ldap\').className=\'fiche_button_selected\';'
				));	
				
				$template->assign_block_vars('ldap.infos', array());
				
				// Champs � ne pas afficher
				$banned_cols = array('objectguid','objectsid','lastlogontimestamp','instancetype','userparameters','sidhistory','logonhours');
							
				$i = 0;
				$aff=0;
				while($i < $info[0]["count"])
				{ 
					if (!in_array($info[0][$i],$banned_cols))
					{
						if ($aff%2 == 0)
							$template->assign_block_vars('ldap.infos.line', array());

						if (isset($lang["f_users_ldap_".$info[0][$i]]) && $lang["f_users_ldap_".$info[0][$i]] != '')
							$label = $lang["f_users_ldap_".$info[0][$i]];
						else
							$label = $info[0][$i];
						
						// Cas particulier du timestamp
						if ($info[0][$i] == 'badpasswordtime' || $info[0][$i] == 'pwdlastset' || $info[0][$i] == 'lastlogon')
						{
							$dateLargeInt=$info[0][$info[0][$i]][0]; // nano seconds (yes, nano seconds) since jan 1st 1601
							$secsAfterADEpoch = $dateLargeInt / (10000000); // seconds since jan 1st 1601
							$ADToUnixConvertor=((1970-1601) * 365.242190) * 86400; // unix epoch - AD epoch * number of tropical days * seconds in a day
							$unixTsLastLogon=intval($secsAfterADEpoch-$ADToUnixConvertor); // unix Timestamp version of AD timestamp
							$lastlogon=date("d/m/Y", $unixTsLastLogon); // formatted date
							
							$value = $lastlogon;
						}					
						// Cas particulier des dates
						elseif ($info[0][$i] == 'whencreated' || $info[0][$i] == 'whenchanged')
						{
							$value = format_date_to_aff($info[0][$info[0][$i]][0]);
						}
						else
							$value = $info[0][$info[0][$i]][0];
							
						$template->assign_block_vars('ldap.infos.line.info', array(
							'LABEL' => $label,
							'VALUE' => cut_str($value,50),
						));
						
						$aff++;
					}
					$i++;
					
				}
			}
			else
			{
				$template->assign_block_vars('button', array(
				  'TEXT' => $lang["fiche_hard_ldapinfos"],
				  'ID' => 'button_hard_ocs_disabled',
				  'CLASS' => 'fiche_button_disabled',
				));
			}
		}
	}

}

$template->pparse($_GET["type"]);

echo $affichage;
?>