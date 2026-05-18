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

// Selection des colonnes � afficher
if (isset($_GET['action']) && $_GET['action'] == 'col_conf')
{
	// Sauvegarde des donn�es
	if (isset($_POST["col_order"]))
	{
		$col_order = $_POST["col_order"].';';
		if (isset($_POST["groupby"]))
			$col_groupby = $_POST["groupby"];
		else
			$col_groupby = '';
		$col_sortby = $_POST["sortby"];
	
		// Suppression colonne
		if (isset($_POST["del_col"]))
		{
			$col_order = preg_replace('`'.$_POST["del_col"].';`','',$col_order);
		}
		// Ajout colonne
		elseif (isset($_POST["add_col"]))
		{
			$col_order .= $_POST["add_col"].';';
		}

		$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE ".UT_PS_USERID."='".$_SESSION["user_id"]."' AND ".UT_PS_CATEGORY."='".$_GET["rub"]."' 
		AND ".UT_PS_SUBCATEGORY."='".$_POST["subcategory"]."'";
		$tab = $req1->db_use_query($requete);
	
		if (count($tab) > 0)
		{
			$requete = "UPDATE ".TAB_USERS_PS." SET ".UT_PS_USERID."='".$_SESSION["user_id"]."', ".UT_PS_CATEGORY."='".$_GET["rub"]."', 
			".UT_PS_DISPLAY."='".$col_order."', ".UT_PS_DISPLAYGROUPCOL."='".$col_groupby."', ".UT_PS_DISPLAYSORTCOL."='".$col_sortby."' WHERE id='".$tab[0]["id"]."'";
			$tab = $req1->db_use_query($requete);		
		}
		else
		{
			$requete = "INSERT INTO ".TAB_USERS_PS." (".UT_PS_USERID.",".UT_PS_CATEGORY.",".UT_PS_SUBCATEGORY.",".UT_PS_DISPLAY.",".UT_PS_DISPLAYGROUPCOL.",".UT_PS_DISPLAYSORTCOL.") 
			VALUES ('".$_SESSION["user_id"]."','".$_GET["rub"]."','".$_POST["subcategory"]."','".$col_order."','".$col_groupby."','".$col_sortby."')";
			$tab = $req1->db_use_query($requete);	
		}
		//echo $requete;
	}

	/************** MATERIELS ***************/
	
	// Colonnes disponibles
	if (OCS_INSTALL == "Oui")
	{
		$cols_availables["hard"][""] = array(TAB_HARD.".".HA_NAME, 
			TAB_EMPL.".".EM_LIBELLE, 
			TAB_USERS.".".US_LNAME, 
			TAB_USERS.".".US_FNAME,
			TAB_HARD_MARQUE.".".HA_MA_LIBELLE, 
			TAB_HARD_MODELE.".".HA_MO_LIBELLE, 
			TAB_HARD_OS.".".HA_OS_LIBELLE, 
			TAB_HARD.".".HA_SERIALNUMBER,
			TAB_HARD.".".HA_COMMENT, 
			TAB_HARD.".".HA_CREATIONDATE,
			TAB_HARD_TYPE.".".HA_TY_LIBELLE,
			TAB_HARD.".".HA_IP,
			TAB_HARD.".".HA_CPUID,
			TAB_HARD.".".HA_RAMCAPACITE,
			TAB_HARD.".".HA_RAMTYPEID,
			TAB_HARD.".".HA_DISQUECAPACITE,
			TAB_HARD.".".HA_DISQUETYPEID,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_DOMAIN,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_IPADDR,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_USERID,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_WORKG,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_PROCESST,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_PROCESSS,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_PROCESSN,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_MEMORY,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_SWAP,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_WINOWNER,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_WINCOMPANY,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_OSNAME,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_OSVERSION,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_OSSP,
			"OCS_".TAB_OCS_HARD.".".COL_OCS_LASTDATE,
			"OCS_".TAB_OCS_BIOS.".".COL_OCS_BIOS_SNUM,
			);
	}
	else
	{
		$cols_availables["hard"][""] = array(TAB_HARD.".".HA_NAME, 
			TAB_EMPL.".".EM_LIBELLE, 
			TAB_USERS.".".US_LNAME, 
			TAB_USERS.".".US_FNAME,
			TAB_HARD_MARQUE.".".HA_MA_LIBELLE, 
			TAB_HARD_MODELE.".".HA_MO_LIBELLE, 
			TAB_HARD_OS.".".HA_OS_LIBELLE, 
			TAB_HARD.".".HA_SERIALNUMBER,
			TAB_HARD.".".HA_COMMENT, 
			TAB_HARD.".".HA_CREATIONDATE,
			TAB_HARD_TYPE.".".HA_TY_LIBELLE,
			TAB_HARD.".".HA_IP,
			TAB_HARD.".".HA_CPUID,
			TAB_HARD.".".HA_RAMCAPACITE,
			TAB_HARD.".".HA_RAMTYPEID,
			TAB_HARD.".".HA_DISQUECAPACITE,
			TAB_HARD.".".HA_DISQUETYPEID,
			);
	}
	
	// Colonnes perso
	$pfieldColumns = get_table_pfield_columns(TAB_HARD);
	foreach ($pfieldColumns as $fieldName) {
		array_push($cols_availables["hard"][""], TAB_HARD . '.' . $fieldName);
	}
		
	/************** PERIPHS ***************/
	$cols_availables["periph"][""] = array(TAB_HARD.".".HA_NAME,
		TAB_PERIPH.".".PE_NAME, 
		TAB_PERIPH_TYPE.".".PE_TY_LIBELLE,
		TAB_PERIPH_MARQUE.".".PE_MA_LIBELLE,
		TAB_PERIPH_MODELE.".".PE_MO_LIBELLE,
		TAB_PERIPH.".".PE_SERIALNUMBER,
		TAB_PERIPH.".".PE_COMMENT,
		TAB_PERIPH.".".PE_CREATIONDATE,
	);

	// Colonnes perso
	$pfieldColumns = get_table_pfield_columns(TAB_PERIPH);
	foreach ($pfieldColumns as $fieldName) {
		array_push($cols_availables["periph"][""], TAB_PERIPH . '.' . $fieldName);
	}
		
	/***************** Logiciels ****************/
	$cols_availables["soft"][""] = array(TAB_SOFT.".".SO_NAME,
		TAB_SOFT_MARQUE.".".SO_MA_LIBELLE,
		TAB_SOFT.".".SO_LASTVERSIONNUM,
		TAB_SOFT.".".SO_LASTVERSIONDATE,
		TAB_SOFT.".".SO_COMMENT,
		TAB_AGENCES.".".AG_LIBELLE,
	);

	// Colonnes perso
	$pfieldColumns = get_table_pfield_columns(TAB_SOFT);
	foreach ($pfieldColumns as $fieldName) {
		array_push($cols_availables["soft"][""], TAB_SOFT . '.' . $fieldName);
	}

	$cols_availables["resa"]["hard"] = array(TAB_HARD.".".HA_NAME, 
		TAB_EMPL.".".EM_LIBELLE, 
		TAB_HARD_MARQUE.".".HA_MA_LIBELLE, 
		TAB_HARD_MODELE.".".HA_MO_LIBELLE, 
		TAB_HARD_OS.".".HA_OS_LIBELLE, 
		TAB_HARD.".".HA_SERIALNUMBER,
		TAB_HARD.".".HA_COMMENT, 
		TAB_HARD.".".HA_CREATIONDATE,
		TAB_HARD_TYPE.".".HA_TY_LIBELLE
	);
	
	$cols_availables["resa"]["periph"] = array(TAB_HARD.".".HA_NAME,
		TAB_PERIPH.".".PE_NAME, 
		TAB_PERIPH_MARQUE.".".PE_MA_LIBELLE,
		TAB_PERIPH_MODELE.".".PE_MO_LIBELLE,
		TAB_PERIPH.".".PE_SERIALNUMBER,
		TAB_PERIPH.".".PE_COMMENT,
		TAB_PERIPH.".".PE_CREATIONDATE,
		TAB_PERIPH_TYPE.".".PE_TY_LIBELLE,
		);
	
	/*************** Documents ***************/
	$cols_availables["docs"][""] = array(TAB_DOCS.".".DO_REFERENCE,
	  TAB_DOCS.".".DO_DATE,
	  TAB_DOCS.".".DO_DATEARCHIVE,
	  TAB_DOCS.".".DO_COMMENT,
	  TAB_DOCS.".".DO_PATH,
	  TAB_ENTREPRISE.".".EN_COMPANYNAME,
	  TAB_DOCS_TYPE.".".DO_TY_LIBELLE
	);

	// Colonnes perso
	$pfieldColumns = get_table_pfield_columns(TAB_DOCS);
	foreach ($pfieldColumns as $fieldName) {
		array_push($cols_availables["docs"][""], TAB_DOCS . '.' . $fieldName);
	}
	
	/*************** R�seau ***************/
	$cols_availables["netw"][""] = array(TAB_RESEAU.".".RE_PLUGNUMBER,
	  TAB_RESEAU.".".RE_PORTID,
	  "alias_switchname.".HA_NAME,
	  TAB_EMPL.".".EM_LIBELLE,
	  TAB_HARD.".".HA_NAME,
	);

	// Colonnes perso
	$pfieldColumns = get_table_pfield_columns(TAB_RESEAU);
	foreach ($pfieldColumns as $fieldName) {
		array_push($cols_availables["netw"][""], TAB_RESEAU . '.' . $fieldName);
	}
	
	/*************** Utilisateurs ***************/
	$cols_availables["users"][""] = array(TAB_USERS.".".US_LNAME,
	  TAB_USERS.".".US_FNAME,
	  TAB_USERS.".".US_MAIL,
	  TAB_USERS.".".US_LOGIN,
	  TAB_USERS.".".US_LOGINWIN,
	  TAB_USERS_GRP.".".UT_GR_LIBELLE,
	  TAB_USERS.".".US_LANGUAGE,
	);

	// if (LDAP_INSTALL == "Oui")
	// {
		// $cols_availables["users"][""][] = "LDAP_ATTR_LNAME";
		// $cols_availables["users"][""][] = "LDAP_ATTR_FNAME";
		// $cols_availables["users"][""][] = "LDAP_ATTR_MAIL";
		// $cols_availables["users"][""][] = "LDAP_ATTR_LOGINWIN";
	// }

	// Colonnes perso
	$pfieldColumns = get_table_pfield_columns(TAB_USERS);
	foreach ($pfieldColumns as $fieldName) {
		array_push($cols_availables["users"][""], TAB_USERS . '.' . $fieldName);
	}
	
	$cols_availables["ldap"]["user"] = array("LDAP_ATTR_LNAME",
	  "LDAP_ATTR_FNAME",
	  "LDAP_ATTR_MAIL",
	  "LDAP_ATTR_LOGINWIN",
	);
	
	$cols_availables["ldap"]["hard"] = array("LDAP_ATTR_HARD_NAME",
	  "LDAP_ATTR_HARD_DESCRIPTION",
	  "LDAP_ATTR_HARD_CREATED",
	  "LDAP_ATTR_HARD_OS",
	);
	
	$cols_availables["accueil"][""] = array("MY_PARAMS",
	"MY_ACTIONS",
	"MY_LINKS",
	"MY_TASKS",
	);

	/************** OCS ***************/
	// Materiel
	$cols_availables["ocs"]["hard"] = array(TAB_OCS_HARD.'.'.COL_OCS_HARD_NAME,
		TAB_OCS_HARD.'.'.COL_OCS_DOMAIN,
		TAB_OCS_HARD.'.'.COL_OCS_IPADDR,
		TAB_OCS_HARD.'.'.COL_OCS_USERID,
		TAB_OCS_HARD.'.'.COL_OCS_WORKG,
		TAB_OCS_HARD.'.'.COL_OCS_PROCESST,
		TAB_OCS_HARD.'.'.COL_OCS_PROCESSS,
		TAB_OCS_HARD.'.'.COL_OCS_PROCESSN,
		TAB_OCS_HARD.'.'.COL_OCS_MEMORY,
		TAB_OCS_HARD.'.'.COL_OCS_SWAP,
		TAB_OCS_HARD.'.'.COL_OCS_WINOWNER,
		TAB_OCS_HARD.'.'.COL_OCS_WINCOMPANY,
		TAB_OCS_HARD.'.'.COL_OCS_OSNAME,
		TAB_OCS_HARD.'.'.COL_OCS_OSVERSION,
		TAB_OCS_HARD.'.'.COL_OCS_OSSP,
		TAB_OCS_HARD.'.'.COL_OCS_LASTDATE,
		TAB_OCS_BIOS.'.'.COL_OCS_BIOS_SNUM,
		TAB_OCS_BIOS.'.'.COL_OCS_BIOS_MARQUE,
		TAB_OCS_BIOS.'.'.COL_OCS_BIOS_MODELE,
		TAB_OCS_BIOS.'.'.COL_OCS_BIOS_TYPE,
	);
	
	// Softs
	$cols_availables["ocs"]["soft"] = array(TAB_OCS_SOFT.'.'.COL_OCS_SOFT_NAME,
		TAB_OCS_SOFT.'.'.COL_OCS_SOFT_VERSION,
		TAB_OCS_SOFT.'.'.COL_OCS_SOFT_PUBLISHER,
	);
	
	// Ecrans
	$cols_availables["ocs"]["monitor"] = array(TAB_OCS_MONITOR.'.'.COL_OCS_MON_NAME,
		TAB_OCS_MONITOR.'.'.COL_OCS_MON_MARQUE,
		TAB_OCS_MONITOR.'.'.COL_OCS_MON_DESC,
		TAB_OCS_MONITOR.'.'.COL_OCS_MON_TYPE,
		TAB_OCS_MONITOR.'.'.COL_OCS_MON_SERIAL,
		TAB_OCS_HARD.'.'.COL_OCS_HARD_NAME,
	);
	
	// Modems
	$cols_availables["ocs"]["modem"] = array(TAB_OCS_MODEM.'.'.COL_OCS_MODEM_NAME,
		TAB_OCS_MODEM.'.'.COL_OCS_MODEM_MODELE,
		TAB_OCS_MODEM.'.'.COL_OCS_MODEM_DESC,
		TAB_OCS_MODEM.'.'.COL_OCS_MODEM_TYPE,
		TAB_OCS_HARD.'.'.COL_OCS_HARD_NAME,
	);
	
	// Imprimantes
	$cols_availables["ocs"]["printer"] = array(TAB_OCS_PRINTER.'.'.COL_OCS_LPT_NAME,
		TAB_OCS_PRINTER.'.'.COL_OCS_LPT_DRIVER,
		TAB_OCS_PRINTER.'.'.COL_OCS_LPT_PORT,
		TAB_OCS_PRINTER.'.'.COL_OCS_LPT_DESC,
		TAB_OCS_HARD.'.'.COL_OCS_HARD_NAME,
	);
	
	// Inputs
	$cols_availables["ocs"]["input"] = array(TAB_OCS_INPUT.'.'.COL_OCS_IPT_TYPE,
		TAB_OCS_INPUT.'.'.COL_OCS_IPT_MARQUE,
		TAB_OCS_INPUT.'.'.COL_OCS_IPT_NAME,
		TAB_OCS_INPUT.'.'.COL_OCS_IPT_DESC,
		TAB_OCS_INPUT.'.'.COL_OCS_IPT_INTERFACE,
		TAB_OCS_HARD.'.'.COL_OCS_HARD_NAME,
	);

	$template->assign_vars( array(
	  'TITLE' => $lang["adm_display_title"],
	  'BUTTON' => $lang["adm_display_buttonsave"],
	));

	// On cherche le nombre de r�sultats (sous categories)
	$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='0' AND category='".$_GET["rub"]."'";
	$tab_subcats = $req1->db_use_query($requete);

	if (isset($_GET["subcat"]))
		$subcat = $_GET["subcat"];
	else
		$subcat = $tab_subcats[0][UT_PS_SUBCATEGORY];
	
	// Traitement des sous categories
	if (count($tab_subcats) > 1)
	{
		$k = 0;
		while ($k < count($tab_subcats))
		{
			if ($subcat == $tab_subcats[$k][UT_PS_SUBCATEGORY])
			{		
				$template->assign_block_vars('subcats', array(
				  'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rub"].'&amp;subcat='.$tab_subcats[$k][UT_PS_SUBCATEGORY],
				  'STYLE' => 'font-weight:bold;font-size:12px;',
				  'NAME' => $lang[$tab_subcats[$k][UT_PS_SUBCATEGORY]],
				));
			}
			else
			{		
				$template->assign_block_vars('subcats', array(
				  'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rub"].'&amp;subcat='.$tab_subcats[$k][UT_PS_SUBCATEGORY],
				  'NAME' => $lang[$tab_subcats[$k][UT_PS_SUBCATEGORY]],
				));
			}
			
			$k++;
		}
	}

	// Pr�paration colonnes non affich�e mais dispos
	$not_displayed = implode(';',$cols_availables[$_GET["rub"]][$subcat]).';';
	
	// On cherche si un param perso existe
	$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='".$_SESSION["user_id"]."' AND category='".$_GET["rub"]."' 
	AND ".UT_PS_SUBCATEGORY."='".$subcat."'";
	$tab = $req1->db_use_query($requete);

	// Si aucun parametrage perso
	if (count($tab) == 0 || $tab[0][UT_PS_DISPLAY] == '')
	{
		// On utilise le param par defaut
		$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='0' AND category='".$_GET["rub"]."' 
		AND ".UT_PS_SUBCATEGORY."='".$subcat."'";
		$tab = $req1->db_use_query($requete);
	}

	$personal_setting = explode(";",preg_replace('`;$`','',$tab[0][UT_PS_DISPLAY]));	

	
	$template->assign_block_vars('cols', array(
	  'FORM_ACTION' => str_replace("&","&amp;",$_SERVER["REQUEST_URI"]),
	  'SUBCATEGORY' => $subcat,
	  'TITLE_DISPLAY' => $lang["adm_display_displayedcols"],
	  'TITLE_NOTDISPLAY' => $lang["adm_display_notdisplayedcols"],
	  'TITLE_PARAM' => $lang["adm_display_groupbytitle"],
	));

	// Colonne de groupement
	if ($_GET["rub"] != 'ldap' && $_GET["rub"] != 'ocs')
	{
		$template->assign_block_vars('cols.groupby', array(
			'TEXT' => $lang["adm_display_groupbycol"],
		));

		$i = 0;
		if ($tab[0][UT_PS_DISPLAYGROUPCOL] == '')
		{
			$template->assign_block_vars('cols.groupby.list', array(
				'LABEL' => $lang["adm_display_nogroupby"],
				'VALUE' => '',
				'SELECTED' => 'selected="selected"',
			));
		}
		else
		{
			$template->assign_block_vars('cols.groupby.list', array(
				'LABEL' => $lang["adm_display_nogroupby"],
				'VALUE' => '',
			));
		}
		while ($i < count($cols_availables[$_GET["rub"]][$subcat]))
		{
			// On exclut la possibilit� de regrouper par des colonnes provenant d'une BDD externe (LDAP ou OCS) sans dans les rubriques ocs et ldap
			if ((substr($cols_availables[$_GET["rub"]][$subcat][$i],0,4) != 'OCS_' &&  substr($cols_availables[$_GET["rub"]][$subcat][$i],0,5) != 'LDAP_') || $_GET["rub"] == 'ocs' || $_GET["rub"] == 'ldap')
			{
				// V�rifier si c'est un pfield et appliquer la transformation si la cl� de langue n'existe pas
				$colKey = $cols_availables[$_GET["rub"]][$subcat][$i];
				$colParts = explode('.', $colKey);
				if (isset($colParts[1]) && substr($colParts[1], 0, 7) == 'pfield_') {
					if (isset($lang["s_" . $colKey])) {
						$colLabel = $lang["s_" . $colKey];
					} else {
						$cleanName = str_replace('pfield_', '', $colParts[1]);
						$cleanName = str_replace('_', ' ', $cleanName);
						$colLabel = ucfirst($cleanName);
					}
				} else {
					$colLabel = $lang["s_" . $colKey];
				}
				
				if ($cols_availables[$_GET["rub"]][$subcat][$i] == $tab[0][UT_PS_DISPLAYGROUPCOL])
				{
					$template->assign_block_vars('cols.groupby.list', array(
						'LABEL' => $colLabel,
						'VALUE' => $cols_availables[$_GET["rub"]][$subcat][$i],
						'SELECTED' => 'selected="selected"',
					));
				}
				else
				{
					$template->assign_block_vars('cols.groupby.list', array(
						'LABEL' => $colLabel,
						'VALUE' => $cols_availables[$_GET["rub"]][$subcat][$i],
					));
				}
			}
			$i++;
		}
	}
	
	// Colonne de tri
	$template->assign_block_vars('cols.sortby', array(
		'TEXT' => $lang["adm_display_sortbycol"],
	));

	$i = 0;
	while ($i < count($cols_availables[$_GET["rub"]][$subcat]))
	{
		// On exclut la possibilit� de regrouper par des colonnes provenant d'une BDD externe (LDAP ou OCS) sans dans les rubriques ocs et ldap
		if ((substr($cols_availables[$_GET["rub"]][$subcat][$i],0,4) != 'OCS_' &&  substr($cols_availables[$_GET["rub"]][$subcat][$i],0,5) != 'LDAP_') || $_GET["rub"] == 'ocs' || $_GET["rub"] == 'ldap')
		{
			// V�rifier si c'est un pfield et appliquer la transformation si la cl� de langue n'existe pas
			$colKey = $cols_availables[$_GET["rub"]][$subcat][$i];
			$colParts = explode('.', $colKey);
			if (isset($colParts[1]) && substr($colParts[1], 0, 7) == 'pfield_') {
				if (isset($lang["s_" . $colKey])) {
					$colLabel = $lang["s_" . $colKey];
				} else {
					$cleanName = str_replace('pfield_', '', $colParts[1]);
					$cleanName = str_replace('_', ' ', $cleanName);
					$colLabel = ucfirst($cleanName);
				}
			} else {
				$colLabel = $lang["s_" . $colKey];
			}
			
			if ($cols_availables[$_GET["rub"]][$subcat][$i] == $tab[0][UT_PS_DISPLAYSORTCOL])
			{
				$template->assign_block_vars('cols.sortby.list', array(
					'LABEL' => $colLabel,
					'VALUE' => $cols_availables[$_GET["rub"]][$subcat][$i],
					'SELECTED' => 'selected="selected"',
				));
			}
			else
			{
				$template->assign_block_vars('cols.sortby.list', array(
					'LABEL' => $colLabel,
					'VALUE' => $cols_availables[$_GET["rub"]][$subcat][$i],
				));
			}
		}
		$i++;
	}
	
	

	$i = 0;
	while ($i < count($personal_setting))
	{
		$verif_perso = explode('.',$personal_setting[$i]);
		
		if (isset($verif_perso[1]) && substr($verif_perso[1],0,7) == 'pfield_')
		{
			$class = 'dbox_perso';
			// Appliquer la transformation du nom si la clé de langue n'existe pas
			if (isset($lang["s_".$personal_setting[$i]])) {
				$displayTitle = $lang["s_".$personal_setting[$i]];
			} else {
				$cleanName = str_replace('pfield_', '', $verif_perso[1]);
				$cleanName = str_replace('_', ' ', $cleanName);
				$displayTitle = ucfirst($cleanName);
			}
			$texte = $lang["adm_display_pfield"].'&nbsp;'.$displayTitle;
		}
		else
		{
			$class = 'dbox';
			$texte = $lang["s_".$personal_setting[$i]];
		}
		
		$template->assign_block_vars('cols.displayed', array(
		  'TEXT' => $texte,
		  'ID' => $personal_setting[$i],
		  'CLASS' => $class,
		  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/del_circle.gif',
		  'DEL_TEXT' => $lang["delete"],
		));
		
		$not_displayed = preg_replace('`'.$personal_setting[$i].';`','',$not_displayed);
		
		$i++;
	}

	if (trim($not_displayed) != '')
	{
		$not_d = explode(";",preg_replace('`;$`','',$not_displayed));

		
		$i = 0;
		while ($i < count($not_d))
		{
			$verif_perso = explode('.',$not_d[$i]);
			
			if (isset($verif_perso[1]) && substr($verif_perso[1],0,7) == 'pfield_')
			{
				$class = 'dbox_perso';
				// Appliquer la transformation du nom si la clé de langue n'existe pas
				if (isset($lang["s_".$not_d[$i]])) {
					$displayTitle = $lang["s_".$not_d[$i]];
				} else {
					$cleanName = str_replace('pfield_', '', $verif_perso[1]);
					$cleanName = str_replace('_', ' ', $cleanName);
					$displayTitle = ucfirst($cleanName);
				}
				$texte = $lang["adm_display_pfield"].'&nbsp;'.$displayTitle;
			}
			else
			{
				$class = 'dbox';
				$texte = $lang["s_".$not_d[$i]];
			}
				
			$template->assign_block_vars('cols.not_displayed', array(
			  'TEXT' => $texte,
			  'ID' => $not_d[$i],
			  'CLASS' => $class,
			  'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_circle.gif',
			  'ADD_TEXT' => $lang["add"],
			));
			
			$i++;
		}
	}
	else
	{
		$template->assign_block_vars('cols.no_record', array(
		  'TEXT' => '<font color=orange>'.$lang["adm_display_norecord"].'</font>',
		));
	}
	
}
