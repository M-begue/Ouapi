<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2014 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/



$affichage = '';
if (!isset($lang))
{
    $lang = array();
}

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

if (isset($_GET["agence_id"])&& $_SESSION["user_agence"] <= 100)
{
	if (isset($_GET["rubrique"]))
	{
		/********** DEBUT Colonnes à afficher ************/
		// On cherche le nombre de résultats (sous categories)
		$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='0' AND category='".$_GET["rubrique"]."'";
		$tab_subcats = $req1->db_use_query($requete);


		// 1 seul résultat = pas de sous catégorie
		if (count($tab_subcats) == 1)
		{
			// Définition des colonnes à afficher
			$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='0' AND category='".$_GET["rubrique"]."'";
			$tab_cols_default = $req1->db_use_query($requete);
			$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='".$_SESSION["user_id"]."' AND category='".$_GET["rubrique"]."'";
			$tab_cols_user = $req1->db_use_query($requete);

			//Affichage utilisateur
			if (count($tab_cols_user) > 0 && $tab_cols_user[0][UT_PS_DISPLAY] != '')
			{
				$cols_display = explode(";",preg_replace('`;$`','',$tab_cols_user[0][UT_PS_DISPLAY]));
				$cols_groupcol = $tab_cols_user[0][UT_PS_DISPLAYGROUPCOL];
				$cols_sortcol = $tab_cols_user[0][UT_PS_DISPLAYSORTCOL];
			}
			// Affichage Par défaut
			else
			{
				$cols_display = explode(";",preg_replace('`;$`','',$tab_cols_default[0][UT_PS_DISPLAY]));
				$cols_groupcol = $tab_cols_default[0][UT_PS_DISPLAYGROUPCOL];
				$cols_sortcol = $tab_cols_default[0][UT_PS_DISPLAYSORTCOL];
			}

		}
		// Plusieurs résultats = sous catégories
		else
		{
			$i = 0;
			while($i < count($tab_subcats))
			{
				// Définition des colonnes à afficher
				$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='0' AND category='".$_GET["rubrique"]."'
				AND ".UT_PS_SUBCATEGORY."='".$tab_subcats[$i][UT_PS_SUBCATEGORY]."'";
				$tab_cols_default = $req1->db_use_query($requete);

				$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='".$_SESSION["user_id"]."' AND category='".$_GET["rubrique"]."'
				AND ".UT_PS_SUBCATEGORY."='".$tab_subcats[$i][UT_PS_SUBCATEGORY]."'";
				$tab_cols_user = $req1->db_use_query($requete);

				//Affichage utilisateur
				if (count($tab_cols_user) > 0 && $tab_cols_user[0][UT_PS_DISPLAY] != '')
				{
					$cols_display[$tab_subcats[$i][UT_PS_SUBCATEGORY]] = explode(";",preg_replace('`;$`','',$tab_cols_user[0][UT_PS_DISPLAY]));
					$cols_groupcol[$tab_subcats[$i][UT_PS_SUBCATEGORY]] = $tab_cols_user[0][UT_PS_DISPLAYGROUPCOL];
					$cols_sortcol[$tab_subcats[$i][UT_PS_SUBCATEGORY]] = $tab_cols_user[0][UT_PS_DISPLAYSORTCOL];
				}
				// Affichage Par défaut
				else
				{
					$cols_display[$tab_subcats[$i][UT_PS_SUBCATEGORY]] = explode(";",preg_replace('`;$`','',$tab_cols_default[0][UT_PS_DISPLAY]));
					$cols_groupcol[$tab_subcats[$i][UT_PS_SUBCATEGORY]] = $tab_cols_default[0][UT_PS_DISPLAYGROUPCOL];
					$cols_sortcol[$tab_subcats[$i][UT_PS_SUBCATEGORY]] = $tab_cols_default[0][UT_PS_DISPLAYSORTCOL];
				}

				$i++;
			}
		}


		if (isset($_GET["tri"]) && isset($_GET["rubrique"]))
			$tri = $_GET["tri"];
		elseif (!isset($_GET["tri"]) && isset($_GET["rubrique"]) && substr($_GET["rubrique"],0,4) != 'plg_' && $_GET["rubrique"] != 'search')
		{
			if (isset($_GET["sscat"]))
			{
				$tri = $cols_sortcol[$_GET["sscat"]];
			}
			else
				$tri = $cols_sortcol;
		}
		else
			$tri = '';
		/*********** FIN Colonnes à afficher *************/

		/*********************************************/
		/*                  MATERIELS                */
		/*********************************************/
		if ($_GET["rubrique"] == "hard")
		{
			// Init de la rubrique
			$template->assign_block_vars('r_hard', array(
				'LANG_FILTER' => $lang["gen_filters"],
				'IMG_FILTER' => 'templates/'.DEFAULT_TEMPLATE.'/images/filter.png',
			));

			$remote_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$remote_host_bis = explode('.',$remote_host);

			/**************** DEBUT Preparation requete SQL ******************/
			if (isset($_GET["filtre_type"]) && $_GET["filtre_type"] != '') {
        		$filtre_type_id = " AND ".TAB_HARD.".type_id='".intval($_GET["filtre_type"])."'";
    		} else {
        		$filtre_type_id = "";
    		}

    		if (isset($_GET["filtre_cpu"]) && $_GET["filtre_cpu"] != '') {
        		$filtre_cpu_id = " AND ".TAB_HARD.".cpu_id='".intval($_GET["filtre_cpu"])."'";
    		} else {
        		$filtre_cpu_id = "";
    		}

    		if (isset($_GET["filtre_ram_type"]) && $_GET["filtre_ram_type"] != '') {
        		$filtre_ram_type_id = " AND ".TAB_HARD.".ram_type_id='".intval($_GET["filtre_ram_type"])."'";
    		} else {
        		$filtre_ram_type_id = "";
    		}

    		if (isset($_GET["filtre_disque_type"]) && $_GET["filtre_disque_type"] != '') {
        		$filtre_disque_type_id = " AND ".TAB_HARD.".disque_type_id='".intval($_GET["filtre_disque_type"])."'";
    		} else {
        		$filtre_disque_type_id = "";
    		}

    		if (isset($_GET["rebus"]) && $_GET["rebus"] == "ok")
        		$suivi_rebus = "";
    		else
        		$suivi_rebus = " AND ".TAB_HARD.".suivi_rebus=''";

			(trim($cols_groupcol) != '')?($sql_groupcol = $cols_groupcol.','):($sql_groupcol = '');
			$requete = "SELECT ".TAB_HARD.".*,
		  	".TAB_HARD.".".HA_ID." AS hard_id,
		  	".TAB_HARD_TYPE.".".HA_TY_LIBELLE." AS type_libelle,
		  	".TAB_HARD_TYPE.".".HA_TY_VNCCONNECTION." AS connex_vnc,
		  	".TAB_HARD_TYPE.".".HA_TY_HTTPCONNECTION." AS connex_http,
		  	".TAB_EMPL.".".EM_LIBELLE." AS lieu_libelle,
		  	".TAB_HARD_MARQUE.".".HA_MA_LIBELLE." AS marque_libelle,
		  	".TAB_HARD_MODELE.".".HA_MO_LIBELLE." AS modele_libelle,
		  	".TAB_HARD_OS.".".HA_OS_LIBELLE." AS os_libelle,
		  	".TAB_REF_CPU.".".REF_CPU_LIBELLE." AS cpu_libelle,
		  	".TAB_REF_RAM_TYPE.".".REF_RAM_TYPE_LIBELLE." AS ram_type_libelle,
		  	".TAB_REF_DISQUE_TYPE.".".REF_DISQUE_TYPE_LIBELLE." AS disque_type_libelle,
		  	".TAB_USERS.".".US_ID." AS id_user,
		  	".TAB_USERS.".".US_LNAME." AS user_nom,
		  	".TAB_USERS.".".US_FNAME." AS user_prenom
		  	FROM ".TAB_HARD."
		    	LEFT JOIN ".TAB_HARD_TYPE." ON ".TAB_HARD.".".HA_TYPEID." = ".TAB_HARD_TYPE.".".HA_TY_ID."
				LEFT JOIN ".TAB_EMPL." ON ".TAB_HARD.".".HA_LOCATIONID." = ".TAB_EMPL.".".EM_ID."
				LEFT JOIN ".TAB_HARD_MARQUE." ON ".TAB_HARD.".".HA_MARQUEID." = ".TAB_HARD_MARQUE.".".HA_MA_ID."
				LEFT JOIN ".TAB_HARD_MODELE." ON ".TAB_HARD.".".HA_MODELEID." = ".TAB_HARD_MODELE.".".HA_MO_ID."
				LEFT JOIN ".TAB_HARD_OS." ON ".TAB_HARD.".".HA_OSID." = ".TAB_HARD_OS.".".HA_OS_ID."
				LEFT JOIN ".TAB_REF_CPU." ON ".TAB_HARD.".".HA_CPUID." = ".TAB_REF_CPU.".".REF_CPU_ID."
				LEFT JOIN ".TAB_REF_RAM_TYPE." ON ".TAB_HARD.".".HA_RAMTYPEID." = ".TAB_REF_RAM_TYPE.".".REF_RAM_TYPE_ID."
				LEFT JOIN ".TAB_REF_DISQUE_TYPE." ON ".TAB_HARD.".".HA_DISQUETYPEID." = ".TAB_REF_DISQUE_TYPE.".".REF_DISQUE_TYPE_ID."
				LEFT JOIN ".TAB_USERS." ON ".TAB_HARD.".".HA_USERID." = ".TAB_USERS.".".US_ID."
		  	WHERE ".TAB_HARD.".".HA_SITEID."='".intval(intval($_GET["agence_id"]))."'".$suivi_rebus."".$filtre_type_id."".$filtre_cpu_id."".$filtre_ram_type_id."".$filtre_disque_type_id."
			ORDER BY ".$sql_groupcol." ".$tri;

			$prefixe = "1";
			$tab = $req1->db_use_query($requete,$prefixe);
			$tab_brut = $tab;
			$tab = array();

			foreach ($tab_brut as $i => $ligne) {
    			foreach ($ligne as $cle => $valeur) {
        			$cle_nettoyee = str_replace($prefixe . '.', '', $cle);
        			$tab[$i][$cle_nettoyee] = $valeur;
    			}
			}

			/**************** FIN Preparation requete SQL ******************/

			/************** DEBUT Préparation du menu filtre ***************/
			foreach($_GET AS $key => $value)
			{
				if ($key != 'filtre_type' && $key != 'filtre_cpu' && $key != 'filtre_ram_type' && $key != 'filtre_disque_type')
				{
					$template->assign_block_vars('r_hard.hidden_filter', array(
						'NAME' => $key,
						'VALUE' => $value,
					));
				}
			}

			$requete = "SELECT * FROM ".TAB_HARD_TYPE." ORDER BY ".HA_TY_LIBELLE;
			$tab_type = $req1->db_use_query($requete);

			$i = -1;
			$tab_type[-1] = array('id' => '', 'libelle' => $lang["gen_viewall"]);
			while ($i < count($tab_type)-1)
			{
				if (isset($_GET["filtre_type"]) && $tab_type[$i][HA_TY_ID] == $_GET["filtre_type"])
				{
					$template->assign_block_vars('r_hard.type_filters', array(
						'TYPE_ID' => $tab_type[$i]["id"],
						'TYPE_NAME' => $tab_type[$i]["libelle"],
						'SELECTED' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('r_hard.type_filters', array(
						'TYPE_ID' => $tab_type[$i]["id"],
						'TYPE_NAME' => $tab_type[$i]["libelle"],
					));
				}
				$i++;
			}

			/************** FIN Préparation du menu filtre ***************/

			/** AIDE **/
			if (PARAM_HELP == 1)
			{
				$template->assign_block_vars('r_hard.help', array(
					'IMG_TITLE' => $lang["gen_help"],
					'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
					'GENERAL_HELP' => $lang["help"][5]
				));
			}

			// S'il y a au moins un resultat
			if (count($tab) > 0)
			{
				// On récupère l'adresse actuelle d'ou l'on supprime le critère de tri
				$page_tri = str_replace('&','&amp;',preg_replace("{&tri=".@$tri."}","",$_SERVER['REQUEST_URI']));

				// Init du tableau d'export
				$export_data = array();
				$export_data[0][0] = $lang["hard_type"];
				$template->assign_block_vars('r_hard.tab_hard', array(
					'NBCOLS' => count($cols_display)+1,
				));

				// Test OCS
				if ((preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && OCS_INSTALL == "Oui")
				{
					$err_ocs = $connect->test_cnx(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

					if (!DEFINED("OCS_CRIT_OCS".intval(intval($_GET["agence_id"]))) != '')
					{
						array_push($err_ocs,2);
					}

					if (count($err_ocs) == 0)
					{
						$requete = "SELECT ".TAB_OCS_HARD.".*,
						".TAB_OCS_BIOS.".".COL_OCS_BIOS_SNUM."
						FROM ".TAB_OCS_HARD."
						  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
						WHERE ".CONSTANT("OCS_MASK_TYPE".intval($_GET["agence_id"]))." LIKE '".str_replace('*','%',CONSTANT("OCS_MASK".intval($_GET["agence_id"])))."'";
						$tab_ocs = $req1->db_use_query_inv($requete,1);
					}
				}
				else
					$err_ocs = array();

				// Affichage erreurs OCS
				if (count($err_ocs) > 0)
				{
					$errors = $lang["gen_warning"].'<br/>';

					while(list($key, $val) = each($err_ocs))
					{
						$aff_key = $key+1;
						$errors .= txt_to_na($lang["error_mysql_cnx_".$val]).'<br />';
					}

					$template->assign_block_vars('r_hard.tab_hard.ocs_error', array(
					  'TEXT' => $errors
					));
				}

				/******** LDAP ********/
				if (LDAP_INSTALL == "Oui")
				{
					$connect->test_cnx();
					// Clé primaire de comparaison des 2 bases
					if (defined("LDAP_KEY_HARD"))
						$key = explode(";",LDAP_KEY_HARD);
					else
						$key = array('nom','name');

					// Racine de recherche LDAP du site
					$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask_hard".intval($_GET["agence_id"])."'";
					$tab_racine = $req1->db_use_query($requete);

					if (count($tab_racine) > 0)
						$racine = $tab_racine[0]["valeur"];
					else
						$racine = LDAP_MASK_HARD;


					$ds=ldap_connect(LDAP_HOST, LDAP_PORT);
					$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);
				}

				$i = 0;
				while ($i < count($tab))
				{
					// Recherche OCS si nécessaire
					if ((preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && OCS_INSTALL == "Oui" && count($err_ocs) == 0 )
					{
						$cle = array_search(addslashes($tab[$i][CONSTANT("OCS_CRIT_BASE".intval(intval($_GET["agence_id"])))]),
						$tab_ocs[CONSTANT("OCS_CRIT_OCS".intval(intval($_GET["agence_id"])))]);
					}
					else
						$cle = FALSE;

					if ((preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && (preg_match('`;'.RGHT_LDAP_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && LDAP_INSTALL == "Oui")
					{
						$sr=@ldap_search($ds, $racine, $key[1]."=".$tab[$i][$key[0]]);
						$info = @ldap_get_entries($ds, $sr);
					}
					else
						$info = FALSE;

					// 1. On prépare la clé de comparaison (nettoyée de la table SQL)
        			$group_key_raw = substr(strrchr($cols_groupcol, "."), 1) ?: $cols_groupcol;
        			$group_key_raw = str_replace('1.', '', $group_key_raw);

        			// 2. On détermine la valeur actuelle et précédente (fallback sur type_libelle)
        			$valeur_actuelle = $tab[$i][$group_key_raw] ?? ($tab[$i]['type_libelle'] ?? '');
        			$valeur_precedente = ($i > 0) ? ($tab[$i-1][$group_key_raw] ?? ($tab[$i-1]['type_libelle'] ?? '')) : null;

					// En tetes
					if ($i == 0 || (trim($cols_groupcol) != '' && $valeur_actuelle != $valeur_precedente))
        			{
            			$template->assign_block_vars('r_hard.tab_hard.group', array(
                			'LANG_TOOLS' => $lang["tools"]
            			));

            			if (trim($cols_groupcol) != '') {
    						// DEBUG GROUPCOL: ouapi_ha_type.libelle -> on cherche si 'type' est dedans
    						if (strpos($cols_groupcol, 'type') !== false) {
        						$display_title = $tab[$i]['type_libelle'] ?? '';
    						} elseif (strpos($cols_groupcol, 'marque') !== false) {
        						$display_title = $tab[$i]['marque_libelle'] ?? '';
    						} elseif (strpos($cols_groupcol, 'modele') !== false) {
        						$display_title = $tab[$i]['modele_libelle'] ?? '';
    						} elseif (strpos($cols_groupcol, 'lieu') !== false || strpos($cols_groupcol, 'emplacement') !== false) {
        						$display_title = $tab[$i]['lieu_libelle'] ?? '';
    						} elseif (strpos($cols_groupcol, 'os') !== false) {
        						$display_title = $tab[$i]['os_libelle'] ?? '';
    						} elseif (strpos($cols_groupcol, 'cpu') !== false) {
        						$display_title = $tab[$i]['cpu_libelle'] ?? '';
    						} elseif (strpos($cols_groupcol, 'ram_type') !== false) {
        						$display_title = $tab[$i]['ram_type_libelle'] ?? '';
    						} elseif (strpos($cols_groupcol, 'disque_type') !== false) {
        						$display_title = $tab[$i]['disque_type_libelle'] ?? '';
							} else {
								$group_key_clean = substr(strrchr($cols_groupcol, "."), 1) ?: $cols_groupcol;
								$display_title = $tab[$i][$group_key_clean] ?? '';
							}
							$template->assign_block_vars('r_hard.tab_hard.group.head', array(
								'TITLE' => txt_to_na($display_title),
							));
						}

            			$template->assign_block_vars('r_hard.tab_hard.group.head2', array());

						$j = 0;
						while ($j < count($cols_display))
						{
    						$col_brute = $cols_display[$j];
    
    						// 1. On vérifie d'abord si une traduction existe
    						if (isset($lang["s_".$col_brute])) {
        						$display_col_name = $lang["s_".$col_brute];
    						} 
    						// 2. Sinon, on nettoie si c'est un champ perso (pfield_)
    						elseif (strpos($col_brute, 'pfield_') !== false) {
        						$clean = substr(strrchr($col_brute, "."), 1) ?: $col_brute; // récupère après le point
        						$clean = str_replace('pfield_', '', $clean);
        						$clean = str_replace('_', ' ', $clean);
        						$display_col_name = ucfirst($clean);
    						} 
    						// 3. Sinon, on garde le nom brut après le point
    						else {
        						$display_col_name = substr(strrchr($col_brute, "."), 1) ?: $col_brute;
    						}

    						$export_data[0][$j+1] = $display_col_name;
    
    						$template->assign_block_vars('r_hard.tab_hard.group.head2.cols', array(
        						'PAGE_TRI' => $page_tri.'&amp;tri='.$col_brute,
        						'TITLE' => $display_col_name,
    						));
    						$j++;
						}

					}

					$class = ($tab[$i]['suivi_rebus'] != '') ? "row_spec" : "row1";
        			$class_row = (isset($_GET["highlight_id"]) && $_GET["highlight_id"] == $tab[$i]["hard_id"]) ? 'highlight' : 'liste';

        			$export_data[$i+1][0] = txt_to_na($tab[$i]["type_libelle"]);

        			$template->assign_block_vars('r_hard.tab_hard.group.list', array(
            			'CLASS' => $class,
            			'CLASS_ROW' => $class_row,
            			'ANCHOR' => 'anchor'.$tab[$i]["hard_id"],
        			));

					$j = 0;
					while ($j < count($cols_display))
					{
						$col_brute = $cols_display[$j];
						// Cas ou l'on va piocher dans la requete OCS
						if (OCS_INSTALL == "Oui" && substr($cols_display[$j],0,4) == "OCS_")
						{
							if ($cle !== FALSE)
								$export_data[$i+1][$j+1] = col_displaying($cols_display[$j],$tab_ocs[substr($cols_display[$j],4)][$cle]);
							else
								$export_data[$i+1][$j+1] = col_displaying($cols_display[$j],'');
						}
						// Logique de correspondance des noms de colonnes SQL vs Alias du tableau $tab
            			if (strpos($col_brute, 'ha_type.libelle') !== false) {
                			$valeur_brute = $tab[$i]['type_libelle'] ?? '';
            			} elseif (strpos($col_brute, 'ha_marque.libelle') !== false) {
                			$valeur_brute = $tab[$i]['marque_libelle'] ?? '';
            			} elseif (strpos($col_brute, 'ha_modele.libelle') !== false) {
                			$valeur_brute = $tab[$i]['modele_libelle'] ?? '';
						} elseif (strpos($col_brute, 'emplacement.libelle') !== false) {
    						$valeur_brute = $tab[$i]['lieu_libelle'] ?? '';
						} elseif (strpos($col_brute, 'ha_os.libelle') !== false) {
    						$valeur_brute = $tab[$i]['os_libelle'] ?? '';
						} elseif (strpos($col_brute, 'ref_cpu.libelle') !== false) {
    						$valeur_brute = $tab[$i]['cpu_libelle'] ?? '';
						} elseif (strpos($col_brute, 'ref_ram_type.libelle') !== false) {
    						$valeur_brute = $tab[$i]['ram_type_libelle'] ?? '';
						} elseif (strpos($col_brute, 'ref_disque_type.libelle') !== false) {
    						$valeur_brute = $tab[$i]['disque_type_libelle'] ?? '';
						} elseif (strpos($col_brute, 'hardware.cpu_id') !== false || strpos($col_brute, 'cpu_id') !== false) {
    						$valeur_brute = $tab[$i]['cpu_libelle'] ?? '';
						} elseif (strpos($col_brute, 'hardware.ram_type_id') !== false || strpos($col_brute, 'ram_type_id') !== false) {
    						$valeur_brute = $tab[$i]['ram_type_libelle'] ?? '';
						} elseif (strpos($col_brute, 'hardware.disque_type_id') !== false || strpos($col_brute, 'disque_type_id') !== false) {
    						$valeur_brute = $tab[$i]['disque_type_libelle'] ?? '';
						} elseif (strpos($col_brute, 'hardware.ram_capacite') !== false) {
    						$valeur_brute = $tab[$i]['ram_capacite'] ?? '';
						} elseif (strpos($col_brute, 'hardware.disque_capacite') !== false) {
    						$valeur_brute = $tab[$i]['disque_capacite'] ?? '';
						} elseif (strpos($col_brute, 'hardware.utilisateur.nom') !== false || strpos($col_brute, 'hardware.utilisateur.prenom') !== false) {
							$nom = $tab[$i]['user_nom'] ?? '';
							$prenom = $tab[$i]['user_prenom'] ?? '';
							$valeur_brute = trim($prenom.' '.$nom);
						} elseif (strpos($col_brute, 'hardware.nom') !== false) {
							$valeur_brute = $tab[$i]['nom'] ?? '';
						} elseif (strpos($col_brute, 'hardware.ip') !== false) {
							$valeur_brute = $tab[$i]['ip'] ?? '';
						} elseif (strpos($col_brute, 'creation_date') !== false) {
							$valeur_brute = $tab[$i]['creation_date'] ?? '';
						} else {
							$col_nettoyee = substr(strrchr($col_brute, "."), 1) ?: $col_brute;
							$valeur_brute = $tab[$i][$col_nettoyee] ?? '';
						}

						$col_format = substr(strrchr($col_brute, "."), 1) ?: $col_brute;
						$export_data[$i+1][$j+1] = col_displaying($col_format, $valeur_brute);

            			$template->assign_block_vars('r_hard.tab_hard.group.list.cols', array(
                			'CLASS' => $class,
                			'TITLE' => $export_data[$i+1][$j+1],
            			));
            			$j++;
					}

					// Affichage de la fiche
					$template->assign_block_vars('r_hard.tab_hard.group.list.tools', array(
						'LINK' => 'index.php?page=visu_fiche.php&amp;type=hard&amp;id='.$tab[$i]["hard_id"].'&amp;agence_id='.intval(intval($_GET["agence_id"])).'&amp;action=visu',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
						'TITLE' => $lang["see"]
					));

					// Edition
					if (preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_hard.tab_hard.group.list.tools', array(
							'LINK' => 'index.php?page=adm_materiels.php&amp;action=editer&amp;h_id='.$tab[$i]["hard_id"].'&amp;agence_id='.intval(intval($_GET["agence_id"])),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
							'TITLE' => $lang["edit"]
						));
					}

					// Copie du matériel
					if (preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_hard.tab_hard.group.list.tools', array(
							'LINK' => 'index.php?page=adm_materiels.php&amp;action=copy&amp;h_id='.$tab[$i]["hard_id"].'&amp;agence_id='.intval(intval($_GET["agence_id"])),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/copy.gif',
							'TITLE' => $lang["gen_copy"]
						));
					}

					// Gestion des rebus
					if (preg_match('`;'.RGHT_HARD_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_hard.tab_hard.group.list.tools', array(
							'LINK' => 'index.php?page=adm_materiels.php&amp;action=rebus&amp;h_id='.$tab[$i]["hard_id"],
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/rebus.gif',
							'TITLE' => $lang["rebus"]
						));
					}

					// Suppression de matériel
					if (preg_match('`;'.RGHT_HARD_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_hard.tab_hard.group.list.tools', array(
							'LINK' => 'index.php?page=adm_materiels.php&amp;action=supprimer&amp;h_id='.$tab[$i]["hard_id"].'&amp;agence_id='.intval(intval($_GET["agence_id"])),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
							'TITLE' => $lang["delete"]
						));
					}

					// OCS
					if ((preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && OCS_INSTALL == "Oui" && count($err_ocs) == 0)
					{
						if ($cle !== FALSE)
						{
							$template->assign_block_vars('r_hard.tab_hard.group.list.tools', array(
								'LINK' => 'index.php?page=adm_materiels.php&amp;action=sync_ocs&amp;agence_id='.intval(intval($_GET["agence_id"])).'&amp;ocs_id='.$tab_ocs[TAB_OCS_HARD.".".COL_OCS_HARD_ID][$cle].'&amp;h_id='.$tab[$i][TAB_HARD."."."hard_id"],
								'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/ocs_sync.gif',
								'TITLE' => $lang["hard_ocs_sync"],
							));
						}
					}

					// LDAP
					if ((preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && (preg_match('`;'.RGHT_LDAP_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && LDAP_INSTALL == "Oui" && isset($info[0][$key[1]][0]))
					{
						$template->assign_block_vars('r_hard.tab_hard.group.list.tools', array(
							'LINK' => 'index.php?page=adm_materiels.php&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=sync_ldap&amp;h_id='.$tab[$i][TAB_HARD."."."hard_id"].'&amp;'.constant("LDAP_ATTR_HARD_".strtoupper($key[1])).'='.urlencode(serialize($info[0][constant("LDAP_ATTR_HARD_".strtoupper($key[1]))][0])),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/ldap_sync.gif',
							'TITLE' => $lang["user_sync"]
						));
					}

					if (preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						if (isset($tab[$i]["connex_vnc"]) && $tab[$i]["connex_vnc"] != 0)
    					{
        					$template->assign_block_vars('r_hard.tab_hard.group.list.tools', array(
            					'LINK' => 'http://'.($tab[$i]["nom"] ?? '').':5800/',
            					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/vnc.gif',
            					'TITLE' => $lang["vnc_connect"]
        					));
    					}
    
    					if (isset($tab[$i]["connex_http"]) && $tab[$i]["connex_http"] != 0 && ($tab[$i]["ip"] ?? '') != '')
    					{
        					$template->assign_block_vars('r_hard.tab_hard.group.list.tools', array(
            					'LINK' => 'http/'.$tab[$i]["ip"],
            					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/http.gif',
            					'TITLE' => $tab[$i]["ip"]
        					));
    					}
					}

					$i++;
				}

			}
			else
			{
				if (isset($_GET["filtre_type"]))
				{
					$template->assign_block_vars('r_hard.tab_hard', array(
						'LANG_FILTER' => $lang["gen_filters"],
						'LANG_FILTER_VIEWALL' => $lang["gen_viewall"],
					));

					$template->assign_block_vars('r_hard.no_hard', array(
						'TEXT' => $lang["no_hard_filter"]
					));
				}
				else
				{
					$template->assign_block_vars('r_hard.no_hard', array(
						'TEXT' => $lang["no_hard"]
					));
				}
			}

			// Bouton d'affichage des rebuts
			if (isset($_GET["rebus"]) && $_GET["rebus"] == "ok")
			{

				$template->assign_block_vars('r_hard.rebus', array(
					'LINK' => str_replace('&amp;rebus=ok','',str_replace("&","&amp;",$_SERVER['REQUEST_URI'])),
					'TEXT' => $lang["hide_rebus"],
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/no_rebus_small.gif'
				));
			}
			else
			{
				$template->assign_block_vars('r_hard.rebus', array(
					'LINK' => str_replace("&","&amp;",$_SERVER['REQUEST_URI'].'&rebus=ok'),
					'TEXT' => $lang["aff_rebus"],
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/rebus_small.gif'
				));
			}

			// Bouton d'ajout
			if (preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('r_hard.add', array(
					'LINK' => 'index.php?page=adm_materiels.php&amp;action=Ajouter&amp;agence_id='.intval($_GET["agence_id"]),
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add.gif',
					'TEXT' => $lang["add"]
				));
			}

			// Export Excel
			if (count($tab) > 0)
			{
				$serialized_string = base64_encode(serialize($export_data));
				$template->assign_block_vars('r_hard.tab_hard.export', array(
					'NOM' => $lang["hard_list"],
					'LINK' => 'window.document.formexport.submit()',
					'DATA' => $serialized_string,
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/excel.gif',
					'TEXT' => $lang["excel_export"]
				));
			}

			// Bouton de gestion de l'affichage
			$template->assign_block_vars('r_hard.display', array(
				'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"],
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
				'TEXT' => $lang["gen_admindisplay"]
			));

		}

		/*********************************************/
		/*               PERIPHERIQUES               */
		/*********************************************/
		elseif ($_GET["rubrique"] == "periph")
		{
			// Init de la rubrique
			$template->assign_block_vars('r_periph', array(
				'LANG_FILTER' => $lang["gen_filters"],
				'IMG_FILTER' => 'templates/'.DEFAULT_TEMPLATE.'/images/filter.png',
			));

			/* Aide */
			if (PARAM_HELP == 1)
			{
				$template->assign_block_vars('r_periph.help', array(
					'IMG_TITLE' => $lang["gen_help"],
					'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
					'GENERAL_HELP' => $lang["help"][6]
				));
			}

			/**************** DEBUT Preparation requete SQL ******************/
			if (isset($_GET["filtre_type"]) && $_GET["filtre_type"] != '') {
    			// On force en entier (intval) pour la sécurité, plus besoin de mysql_real_escape_string
    			$filtre_type_id = " AND ".TAB_PERIPH.".type_id='".intval($_GET["filtre_type"])."'";
			} else {
    			$filtre_type_id = "";
			}

			if (isset($_GET["rebus"]) && $_GET["rebus"] == "ok")
				$suivi_rebus = "";
			else
				$suivi_rebus = " AND ".TAB_PERIPH.".suivi_rebus=''";

			(trim($cols_groupcol) != '')?($sql_groupcol = $cols_groupcol.','):($sql_groupcol = '');
			$requete = "SELECT ".TAB_PERIPH.".*,
			".TAB_PERIPH_TYPE.".".PE_TY_LIBELLE." AS type_libelle,
			".TAB_PERIPH_MARQUE.".libelle AS marque_libelle,
			".TAB_PERIPH_MODELE.".libelle AS modele_libelle,
			".TAB_HARD.".nom AS hard_nom
			FROM ".TAB_PERIPH."
			  LEFT JOIN ".TAB_PERIPH_TYPE." ON ".TAB_PERIPH_TYPE.".id = ".TAB_PERIPH.".type_id
			  LEFT JOIN ".TAB_PERIPH_MARQUE." ON ".TAB_PERIPH_MARQUE.".id = ".TAB_PERIPH.".marque_id
			  LEFT JOIN ".TAB_PERIPH_MODELE." ON ".TAB_PERIPH_MODELE.".id = ".TAB_PERIPH.".modele_id
			  LEFT JOIN ".TAB_HARD." ON ".TAB_HARD.".id = ".TAB_PERIPH.".hard_id
			WHERE ".TAB_PERIPH.".agence_id='".intval(intval($_GET["agence_id"]))."'".$suivi_rebus."".$filtre_type_id."
			ORDER BY ".$sql_groupcol." ".$tri;

			$prefixe = "1";
			$tab_brut = $req1->db_use_query($requete,$prefixe);
			$tab = array();

			foreach ($tab_brut as $i => $ligne) {
    			foreach ($ligne as $cle => $valeur) {
        			$cle_nettoyee = str_replace($prefixe . '.', '', $cle);
        			$tab[$i][$cle_nettoyee] = $valeur;
    			}
			}


			/**************** FIN Preparation requete SQL ******************/

			/************** DEBUT Préparation du menu filtre ***************/
			foreach($_GET AS $key => $value)
			{
				if ($key != 'filtre_type')
				{
					$template->assign_block_vars('r_periph.hidden_filter', array(
						'NAME' => $key,
						'VALUE' => $value,
					));
				}
			}

			$requete = "SELECT * FROM ".TAB_PERIPH_TYPE." ORDER BY ".PE_TY_LIBELLE;
			$tab_type = $req1->db_use_query($requete);

			$i = -1;
			$tab_type[-1] = array('id' => '', 'libelle' => $lang["gen_viewall"]);
			while ($i < count($tab_type)-1)
			{
				if (isset($_GET["filtre_type"]) && $tab_type[$i][PE_TY_ID] == $_GET["filtre_type"])
				{
					$template->assign_block_vars('r_periph.type_filters', array(
						'TYPE_ID' => $tab_type[$i]["id"],
						'TYPE_NAME' => $tab_type[$i]["libelle"],
						'SELECTED' => 'selected="selected"'
					));
				}
				else
				{
					$template->assign_block_vars('r_periph.type_filters', array(
						'TYPE_ID' => $tab_type[$i]["id"],
						'TYPE_NAME' => $tab_type[$i]["libelle"],
					));
				}
				$i++;
			}
			/************** FIN Préparation du menu filtre ***************/

			// S'il y a au moins un resultat
			if (count($tab) > 0)
			{
				// On récupère l'adresse actuelle d'ou l'on supprime le critère de tri
				$page_tri = str_replace('&','&amp;',preg_replace("{&tri=".@$tri."}","",$_SERVER['REQUEST_URI']));

				// Init du tableau d'export
				$export_data = array();
				$export_data[0][0] = $lang["hard_type"];

				$template->assign_block_vars('r_periph.tab_periph', array(
					'NBCOLS' => count($cols_display)+1,
				));

				// Test OCS
				if ((preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && OCS_INSTALL == "Oui")
				{
					$err_ocs = $connect->test_cnx(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

					if (!DEFINED("OCS_CRIT_OCS".intval(intval($_GET["agence_id"]))) != '')
					{
						array_push($err_ocs,2);
					}

				}

				if (isset($err_ocs) && count($err_ocs) > 0)
				{
					$errors = $lang["gen_warning"].'<br/>';

					foreach ($err_ocs as $key => $val)
					{
						$aff_key = $key+1;
						$errors .= txt_to_na($lang["error_mysql_cnx_".$val]).'<br />';
					}

					$template->assign_block_vars('r_periph.tab_periph.ocs_error', array(
					  'TEXT' => $errors
					));
				}

				// Liste des périphs
				$i = 0;
				while ($i < count($tab))
				{
    
    				// 1. On prépare la clé de comparaison (nettoyée)
    				$group_key_raw = substr(strrchr($cols_groupcol, "."), 1) ?: $cols_groupcol;
    				$group_key_raw = str_replace('1.', '', $group_key_raw);
    
    				// 2. On détermine la valeur actuelle et la valeur précédente pour détecter le changement
    				$valeur_actuelle = $tab[$i][$group_key_raw] ?? ($tab[$i]['type_libelle'] ?? '');
    				$valeur_precedente = ($i > 0) ? ($tab[$i-1][$group_key_raw] ?? ($tab[$i-1]['type_libelle'] ?? '')) : null;

    				// 3. Si c'est le premier passage ou si la valeur a changé, on affiche l'en-tête
    				if ($i == 0 || (trim($cols_groupcol) != '' && $valeur_actuelle != $valeur_precedente))
    				{
        				$template->assign_block_vars('r_periph.tab_periph.group', array(
            				'LANG_TOOLS' => $lang["tools"]
        				));

        				if (trim($cols_groupcol) != '')
						{
    						// On cherche le mot clé dans la colonne de groupage pour choisir le bon libellé
    						if (strpos($cols_groupcol, 'type') !== false) {
        						$display_title = $tab[$i]['type_libelle'] ?? '';
    						} elseif (strpos($cols_groupcol, 'marque') !== false) {
        						$display_title = $tab[$i]['marque_libelle'] ?? '';
    						} elseif (strpos($cols_groupcol, 'modele') !== false) {
        						$display_title = $tab[$i]['modele_libelle'] ?? '';
    						} else {
        						// Pour les autres champs (Nom, SN...), on nettoie la clé SQL pour lire le tableau
        						$group_key_clean = substr(strrchr($cols_groupcol, "."), 1) ?: $cols_groupcol;
        						// On enlève le préfixe si jamais il reste un "1." ou "2."
        						$group_key_clean = str_replace('1.', '', $group_key_clean);
        						$group_key_clean = str_replace('2.', '', $group_key_clean);
        
        						$display_title = $tab[$i][$group_key_clean] ?? '';
    						}

    						$template->assign_block_vars('r_periph.tab_periph.group.head', array(
        						'TITLE' => txt_to_na($display_title),
    						));
						}


        				$template->assign_block_vars('r_periph.tab_periph.group.head2', array());

						$j = 0;
						while ($j < count($cols_display))
						{
							$export_data[0][$j+1] = $lang["s_".$cols_display[$j]] ?? $cols_display[$j];
							$template->assign_block_vars('r_periph.tab_periph.group.head2.cols', array(
								'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display[$j],
								'TITLE' => $export_data[0][$j+1],
							));

							$j++;
						}
					}

					if (($tab[$i]['suivi_rebus'] ?? '') != '')
						$class = "row_spec";
					else
						$class = "row1";

					if (isset($_GET["highlight_id"]) && $_GET["highlight_id"] == ($tab[$i]['id'] ?? ''))
						$class_row = 'highlight';
					else
						$class_row = 'liste';

					$export_data[$i+1][0] = txt_to_na($tab[$i]['type_libelle'] ?? '');

					$template->assign_block_vars('r_periph.tab_periph.group.list', array(
						'CLASS' => $class,
						'CLASS_ROW' => $class_row,
						'ANCHOR' => 'anchor'.($tab[$i]['id'] ?? ''),
					));

					// Affichage des colonnes //
					$j = 0;
					while ($j < count($cols_display))
					{
    					$col_brute = $cols_display[$j];

    					// On détermine quelle clé de $tab utiliser en fonction du nom de la colonne configurer
    					if (strpos($col_brute, 'pe_type.libelle') !== false) {
                			$valeur_brute = $tab[$i]['type_libelle'] ?? '';
						} elseif (strpos($col_brute, 'ha_marque.libelle') !== false) {
        					$valeur_brute = $tab[$i]['marque_libelle'] ?? '';
    					} elseif (strpos($col_brute, 'pe_modele.libelle') !== false) {
        					$valeur_brute = $tab[$i]['modele_libelle'] ?? '';
    					} elseif (strpos($col_brute, 'peripherique.nom') !== false) {
        					$valeur_brute = $tab[$i]['nom'] ?? '';
    					} elseif (strpos($col_brute, 'hardware.nom') !== false) {
        					$valeur_brute = $tab[$i]['hard_nom'] ?? '';
    					} elseif (strpos($col_brute, 'num_serie') !== false) {
        					$valeur_brute = $tab[$i]['num_serie'] ?? '';
    					} elseif (strpos($col_brute, 'commentaire') !== false) {
        					$valeur_brute = $tab[$i]['commentaire'] ?? '';
    					} elseif (strpos($col_brute, 'creation_date') !== false) {
        					$valeur_brute = $tab[$i]['creation_date'] ?? '';
    					} else {
        					// Au cas où : on tente de nettoyer le nom de la table
        					$col_nettoyee = substr(strrchr($col_brute, "."), 1) ?: $col_brute;
        					$valeur_brute = $tab[$i][$col_nettoyee] ?? '';
    					}

    					// On passe le nom court à col_displaying pour qu'il sache comment formater
    					$col_format = substr(strrchr($col_brute, "."), 1) ?: $col_brute;
    					$export_data[$i+1][$j+1] = col_displaying($col_format, $valeur_brute);

    					$template->assign_block_vars('r_periph.tab_periph.group.list.cols', array(
        					'CLASS' => $class,
        					'TITLE' => $export_data[$i+1][$j+1],
    					));

    					$j++;
					}

					// Affichage de la fiche
					$template->assign_block_vars('r_periph.tab_periph.group.list.tools', array(
						'LINK' => 'index.php?page=visu_fiche.php&amp;type=periph&amp;id='.($tab[$i]['id'] ?? '').'&amp;agence_id='.intval(intval($_GET["agence_id"])).'&amp;action=visu',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
						'TITLE' => $lang["see"]
					));

					// Edition / Copie du periph
					if (preg_match('`;'.RGHT_PERIPH_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_periph.tab_periph.group.list.tools', array(
							'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=editer&amp;p_id='.($tab[$i]['id'] ?? '').'&amp;agence_id='.intval(intval($_GET["agence_id"])),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
							'TITLE' => $lang["edit"]
						));

						$template->assign_block_vars('r_periph.tab_periph.group.list.tools', array(
							'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=copy&amp;p_id='.($tab[$i]['id'] ?? '').'&amp;agence_id='.intval(intval($_GET["agence_id"])),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/copy.gif',
							'TITLE' => $lang["gen_copy"]
						));
					}

					// Gestion des rebus
					if (preg_match('`;'.RGHT_PERIPH_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_periph.tab_periph.group.list.tools', array(
							'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=rebus&amp;p_id='.($tab[$i]['id'] ?? ''),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/rebus.gif',
							'TITLE' => $lang["rebus"]
						));
					}

					// Suppression de matériel
					if (preg_match('`;'.RGHT_PERIPH_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_periph.tab_periph.group.list.tools', array(
							'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=supprimer&amp;p_id='.($tab[$i]['id'] ?? '').'&amp;agence_id='.intval(intval($_GET["agence_id"])),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
							'TITLE' => $lang["delete"]
						));
					}
					// Synchro OCS
					if ((preg_match('`;'.RGHT_PERIPH_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && OCS_INSTALL == "Oui" && count($err_ocs) == 0 && $tab[$i][TAB_PERIPH.".".PE_OCSID] != 0)
					{
						$template->assign_block_vars('r_periph.tab_periph.group.list.tools', array(
							'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=sync_ocs&amp;type='.$tab[$i][TAB_PERIPH.".".PE_OCSTYPE].'&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[$i][TAB_PERIPH.".".PE_OCSID].'&amp;p_id='.($tab[$i]['id'] ?? ''),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/ocs_sync.gif',
							'TITLE' => $lang["periph_ocs_sync"]
						));
					}

					$i++;
				}

			}
			else
			{
				$template->assign_block_vars('r_periph.no_periph', array(
					'TEXT' => $lang["periph_noperiph"]
				));
			}

			// Bouton d'affichage des rebus
			if (isset($_GET["rebus"]) && $_GET["rebus"] == "ok")
			{
				$template->assign_block_vars('r_periph.rebus', array(
					'LINK' => str_replace('&amp;rebus=ok','',str_replace("&","&amp;",$_SERVER['REQUEST_URI'])),
					'TEXT' => $lang["hide_rebus"],
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/no_rebus_small.gif'
				));
			}
			else
			{
				$template->assign_block_vars('r_periph.rebus', array(
					'LINK' => str_replace("&","&amp;",$_SERVER['REQUEST_URI'].'&rebus=ok'),
					'TEXT' => $lang["aff_rebus"],
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/rebus_small.gif'
				));
			}

			// Bouton d'ajout
			if (preg_match('`;'.RGHT_PERIPH_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('r_periph.add', array(
					'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=add&amp;agence_id='.intval(intval($_GET["agence_id"])),
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add.gif',
					'TEXT' => $lang["add"]
				));
			}

			// Export Excel
			if (count($tab) > 0)
			{
				$serialized_string = base64_encode(serialize($export_data));
				$template->assign_block_vars('r_periph.tab_periph.export', array(
					'NOM' => $lang["periph_list"],
					'LINK' => 'window.document.formexport.submit()',
					'DATA' => $serialized_string,
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/excel.gif',
					'TEXT' => $lang["excel_export"]
				));
				
			}
			// Bouton de gestion de l'affichage
			$template->assign_block_vars('r_periph.display', array(
				'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"],
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
				'TEXT' => $lang["gen_admindisplay"]
			));
		}

		/*********************************************/
		/*                 LOGICIELS                 */
		/*********************************************/
		elseif ($_GET["rubrique"] == "soft")
		{
			$template->assign_block_vars('r_soft', array());

			if (PARAM_HELP == 1 && OCS_INSTALL == "Oui")
			{
				$template->assign_block_vars('r_soft.help', array(
					'IMG_TITLE' => $lang["gen_help"],
					'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
					'GENERAL_HELP' => $lang["help"][8]
				));
			}
			elseif (PARAM_HELP == 1)
			{
				$template->assign_block_vars('r_soft.help', array(
					'IMG_TITLE' => $lang["gen_help"],
					'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
					'GENERAL_HELP' => $lang["help"][7]
				));
			}
			(trim($cols_groupcol) != '') ? ($sql_groupcol = $cols_groupcol.',') : ($sql_groupcol = '');

			$requete = "SELECT ".TAB_SOFT.".*,
			  ".TAB_SOFT_MARQUE.".".SO_MA_LIBELLE." AS marque_libelle,
			  ".TAB_AGENCES.".".AG_LIBELLE." AS agence_libelle
			FROM ".TAB_SOFT."
				LEFT JOIN ".TAB_SOFT_MARQUE." ON ".TAB_SOFT.".".SO_MARQUEID." = ".TAB_SOFT_MARQUE.".".SO_MA_ID."
				LEFT JOIN ".TAB_AGENCES." ON ".TAB_SOFT.".".SO_SITEID." = ".TAB_AGENCES.".".AG_ID."
			WHERE (".SO_SITEID."='0' OR ".SO_SITEID."='".intval($_GET["agence_id"])."') 
    		ORDER BY ".$sql_groupcol." ".$tri;
			$tab_brut = $req1->db_use_query($requete, TAB_SOFT);
			$tab = array();

			foreach ($tab_brut as $i => $ligne) {
	    		foreach ($ligne as $cle => $valeur) {
	        		$cle_nettoyee = str_replace(TAB_SOFT . '.', '', $cle);
	        		$tab[$i][$cle_nettoyee] = $valeur;
	    		}
			}

			// On affiche les en tete de colonne s'il y a au moins 1 résultat
			if (count($tab) > 0)
			{
				// Init du tableau de données
				$export_data = array();
				$export_data[0][0] = $lang["soft_type"];

				// On récupère l'adresse actuelle d'ou l'on supprime le critère de tri
				$page_tri = str_ireplace("&","&amp;",preg_replace("{&tri=".@$_GET["tri"]."}","",$_SERVER['REQUEST_URI']));

				$template->assign_block_vars('r_soft.tab_soft', array(
					'COL_STATUS' => $lang["soft_linkstatus"],
					'LANG_TOOLS' => $lang["tools"]
				));

				$j = 0;
				while ($j < count($cols_display))
				{
					$export_data[0][$j+1] = $lang["s_".$cols_display[$j]] ?? $cols_display[$j];

					$template->assign_block_vars('r_soft.tab_soft.cols', array(
						'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display[$j],
						'TITLE' => $export_data[0][$j+1],
					));

					$j++;
				}

			}
			else
			{
				$template->assign_block_vars('r_soft.no_soft', array(
					'TEXT' => $lang["no_soft"]
				));
			}

			$i = 0;
			while ($i < count($tab))
			{
				$group_key_raw = substr(strrchr($cols_groupcol, "."), 1) ?: $cols_groupcol;
				$valeur_actuelle = $tab[$i][$group_key_raw] ?? '';
				$valeur_precedente = ($i > 0) ? ($tab[$i-1][$group_key_raw] ?? '') : null;

				if ($i == 0 || (trim($cols_groupcol) != '' && $valeur_actuelle != $valeur_precedente))
				{
    				$display_title = '';
    
    				// Mapping pour afficher les libellés au lieu des IDs
    				if (strpos($cols_groupcol, 'marque') !== false) {
        				$display_title = $tab[$i]['marque_libelle'] ?? '';
    				} elseif (strpos($cols_groupcol, 'site') !== false || strpos($cols_groupcol, 'agence') !== false) {
        				$display_title = ($tab[$i][SO_SITEID] == 0) ? $lang["soft_all_sites"] : $tab[$i]['agence_libelle'];
    				} else {
        				$group_key_clean = substr(strrchr($cols_groupcol, "."), 1) ?: $cols_groupcol;
        				$display_title = $tab[$i][$group_key_clean] ?? '';
    				}

    				$template->assign_block_vars('r_soft.tab_soft.type', array(
        				'NBCOLS' => count($cols_display) + 2,
        				'TITLE' => txt_to_na($display_title)
    				));
				}

				$export_data[$i+1][0] = $display_title;

				// STATUS
				// Cas ou OCS est activé
				if (OCS_INSTALL == "Oui")
				{
					// Cherche les alias OCS du logiciel
					$requete = "SELECT * FROM ".TAB_SOFT_OCS_ALIAS." WHERE ".SO_AL_OUAPISOFTID."='".$tab[$i][SO_ID]."'";
					$tab_alias = $req1->db_use_query($requete);

					if (count($tab_alias) > 0)
					{
						$status = $lang["soft_linkocs"];
						$img_status = 'i_ocs.png';
					}
					else
					{
						$status = $lang["soft_linkouapinoocs"];
						$img_status = 'i_ouapi.png';
					}
				}
				else
				{
					$status = $lang["soft_linkouapi"];
					$img_status = 'i_ouapi.png';

				}

				if (isset($_GET["highlight_id"]) && $_GET["highlight_id"] == $tab[$i][SO_ID])
					$class_row = 'highlight';
				else
					$class_row = 'liste';

				$template->assign_block_vars('r_soft.tab_soft.type.list', array(
					'ANCHOR' => 'anchor'.$tab[$i][SO_ID],
					'IMG_STATUS' => 'templates/'.DEFAULT_TEMPLATE.'/images/'.$img_status,
					'COL_STATUS' => $status,
					'CLASS_ROW' => $class_row,
				));


				$j = 0;
				while ($j < count($cols_display))
				{
    				$col_brute = $cols_display[$j];
    
    				// Gestion des alias pour les logiciels
    				if (strpos($col_brute, 'marque') !== false) {
        				$valeur_brute = $tab[$i]['marque_libelle'] ?? '';
    				} elseif (strpos($col_brute, 'site') !== false) {
        				$valeur_brute = ($tab[$i][SO_SITEID] == 0) ? $lang["soft_all_sites_short"] : $tab[$i]['agence_libelle'];
    				} else {
        				$col_clean = substr(strrchr($col_brute, "."), 1) ?: $col_brute;
        				$valeur_brute = $tab[$i][$col_clean] ?? '';
    				}

    				$export_data[$i+1][$j+1] = col_displaying($col_brute, $valeur_brute);

    				$template->assign_block_vars('r_soft.tab_soft.type.list.cols', array(
        				'TITLE' => $export_data[$i+1][$j+1],
    				));

    				$j++;
				}


				// Postes ou le logiciel est installé
				$template->assign_block_vars('r_soft.tab_soft.type.list.tools', array(
					'LINK' => 'index.php?page=adm_hardsoft.php&amp;s_id='.$tab[$i][SO_ID].'&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=list_version',
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/mat.gif',
					'TITLE' => $lang["soft_hardinstalldetail"]
				));

				// Fiche
				$template->assign_block_vars('r_soft.tab_soft.type.list.tools', array(
					'LINK' => 'index.php?page=visu_fiche.php&amp;type=soft&amp;id='.$tab[$i][SO_ID].'&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=visu',
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
					'TITLE' => $lang["gen_fiche"]
				));

				// MAJ Logiciel
				if (preg_match('`;'.RGHT_SOFT_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
				{
					$template->assign_block_vars('r_soft.tab_soft.type.list.tools', array(
						'LINK' => 'index.php?page=adm_logiciels.php&amp;action=maj&amp;s_id='.$tab[$i][SO_ID].'&amp;agence_id='.intval($_GET["agence_id"]),
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/maj.gif',
						'TITLE' => $lang["soft_addmaj"]
					));
				}
				// Edition logiciel
				if (preg_match('`;'.RGHT_SOFT_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
				{
					$template->assign_block_vars('r_soft.tab_soft.type.list.tools', array(
						'LINK' => 'index.php?page=adm_logiciels.php&amp;action=Edit&amp;s_id='.$tab[$i][SO_ID].'&amp;agence_id='.intval($_GET["agence_id"]),
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
						'TITLE' => $lang["edit"]
					));
				}
				// Suppression logiciel
				if (preg_match('`;'.RGHT_SOFT_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
				{
					$template->assign_block_vars('r_soft.tab_soft.type.list.tools', array(
						'LINK' => 'index.php?page=adm_logiciels.php&amp;action=suppr&amp;s_id='.$tab[$i][SO_ID].'&amp;agence_id='.intval($_GET["agence_id"]),
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
						'TITLE' => $lang["delete"]
					));
				}

				$i++;
			}

			if (preg_match('`;'.RGHT_SOFT_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('r_soft.add', array(
					'LINK' => 'index.php?page=adm_logiciels.php&amp;action=Ajouter&amp;agence_id='.intval($_GET["agence_id"]),
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add.gif',
					'TEXT' => $lang["add"]
				));
			}

			if (preg_match('`;'.RGHT_SOFT_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('r_soft.hardtype', array(
					'LINK' => 'index.php?page=adm_logiciels.php&amp;config=assoc',
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/conf.gif',
					'TEXT' => $lang["soft_maj_assoc"]
				));
			}


			// Export Excel
			if (count($tab) > 0)
			{
				$serialized_string = base64_encode(serialize($export_data));
				$template->assign_block_vars('r_soft.tab_soft.export', array(
					'NOM' => $lang["soft_list"],
					'LINK' => 'window.document.formexport.submit()',
					'DATA' => $serialized_string,
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/excel.gif',
					'TEXT' => $lang["excel_export"]
				));
			}

			// Bouton de gestion de l'affichage
			$template->assign_block_vars('r_soft.display', array(
				'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"],
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
				'TEXT' => $lang["gen_admindisplay"]
			));
		}

		/*********************************************/
		/*                UTILISATEURS               */
		/*********************************************/
		elseif ($_GET["rubrique"] == "users")
		{
			// Init de la rubrique
			$template->assign_block_vars('r_users', array());
			
			if (PARAM_HELP == 1)
			{
				$template->assign_block_vars('r_users.help', array(
					'IMG_TITLE' => $lang["gen_help"],
					'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
					'GENERAL_HELP' => $lang["help"][20]
				));
			}

			$export_data = array();

			/**************** DEBUT Preparation requete SQL ******************/
			(trim($cols_groupcol) != '')?($sql_groupcol = $cols_groupcol.','):($sql_groupcol = '');
			$requete = "SELECT ".TAB_USERS.".*,
			".TAB_USERS_GRP.".libelle
			FROM ".TAB_USERS."
			  LEFT JOIN ".TAB_USERS_GRP." ON ".TAB_USERS_GRP.".id = ".TAB_USERS.".groupe_id
			WHERE ".TAB_USERS.".agence_id='".intval($_GET["agence_id"])."' ORDER BY ".$sql_groupcol." ".$tri;

			$prefixe = "1";
			$tab_brut = $req1->db_use_query($requete,$prefixe);
			$tab = array();

			foreach ($tab_brut as $i => $ligne) {
    			foreach ($ligne as $cle => $valeur) {
        			$cle_nettoyee = str_replace($prefixe . '.', '', $cle);
        			$tab[$i][$cle_nettoyee] = $valeur;
    			}
			}
			/**************** FIN Preparation requete SQL ******************/

			// S'il y a au moins un résultat
			if (count($tab) > 0)
			{
				// On récupère l'adresse actuelle d'ou l'on supprime le critère de tri
				$page_tri = str_ireplace('&','&amp;',preg_replace("{&tri=".$tri."}","",$_SERVER['REQUEST_URI']));

				// Test LDAP
				if ((preg_match('`;'.RGHT_LDAP_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && LDAP_INSTALL == "Oui")
				{
					if (!$fp = @fsockopen(LDAP_HOST, LDAP_PORT, $errno, $errstr, 5))
					{
						$template->assign_block_vars('r_users.error', array(
							'TEXT' => $lang["user_ldap_error"],
						));
						$err_ldap = 1;
					}
				}

				$template->assign_block_vars('r_users.tab_user', array(
					'LANG_TOOLS' => $lang["tools"],
					'NBCOLS' => count($cols_display)+1,
				));

				$i = 0;
				while ($i < count($tab))
				{
					// 1. On prépare la clé de comparaison (nettoyée)
					$group_key_raw = substr(strrchr($cols_groupcol, "."), 1) ?: $cols_groupcol;
					$group_key_raw = str_replace('1.', '', $group_key_raw);
					$group_key_raw = str_replace('2.', '', $group_key_raw);

					// 2. On détermine la valeur actuelle et la valeur précédente pour détecter le changement
					$valeur_actuelle = $tab[$i][$group_key_raw] ?? '';
					$valeur_precedente = ($i > 0) ? ($tab[$i-1][$group_key_raw] ?? '') : null;

					// En tetes
					if ($i == 0 || (trim($cols_groupcol) != '' && $valeur_actuelle != $valeur_precedente))
					{
						$template->assign_block_vars('r_users.tab_user.group', array());

						if (trim($cols_groupcol) != '')
						{
							$template->assign_block_vars('r_users.tab_user.group.head', array(
								'TITLE' => txt_to_na($valeur_actuelle),
							));
						}

						$template->assign_block_vars('r_users.tab_user.group.head2', array());

						$j = 0;
						while ($j < count($cols_display))
						{
							$export_data[0][$j+1] = $lang["s_".$cols_display[$j]] ?? $cols_display[$j];

							$template->assign_block_vars('r_users.tab_user.group.head2.cols', array(
								'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display[$j],
								'TITLE' => $export_data[0][$j+1],
							));

							$j++;
						}
					}

					if (isset($_GET["highlight_id"]) && $_GET["highlight_id"] == ($tab[$i]["id"] ?? ''))
						$class_row = 'highlight';
					else
						$class_row = 'liste';

					$template->assign_block_vars('r_users.tab_user.group.list', array(
						'ANCHOR' => 'anchor'.($tab[$i]["id"] ?? ''),
						'CLASS_ROW' => $class_row,
					));

					$j = 0;
					while ($j < count($cols_display))
					{
						$col_brute = $cols_display[$j];
						$col_nettoyee = substr(strrchr($col_brute, "."), 1) ?: $col_brute;
						
						if (isset($tab[$i][$col_nettoyee]))
							$export_data[$i+1][$j+1] = col_displaying($col_nettoyee,$tab[$i][$col_nettoyee]);
						else
							$export_data[$i+1][$j+1] = txt_to_na('');

						$template->assign_block_vars('r_users.tab_user.group.list.cols', array(
							'TITLE' => $export_data[$i+1][$j+1],
						));

						$j++;
					}

					$template->assign_block_vars('r_users.tab_user.group.list.tools', array(
						'LINK' => 'index.php?page=visu_fiche.php&amp;type=users&amp;agence_id='.$_GET["agence_id"].'&amp;id='.($tab[$i]["id"] ?? '').'&amp;action=visu',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
						'TITLE' => $lang["gen_fiche"]
					));

					if ((preg_match('`;'.RGHT_USERS_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && ($tab[$i][US_LNAME] ?? '') != 'Demo')
					{
						$template->assign_block_vars('r_users.tab_user.group.list.tools', array(
							'LINK' => 'index.php?page=adm_utilisateurs.php&amp;user_id='.($tab[$i]["id"] ?? '').'&amp;action=change_mdp',
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/password.gif',
							'TITLE' => $lang["user_change_mdp"]
						));
					}
					if ((preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && ($tab[$i][US_LNAME] ?? '') != 'Demo')
					{
						$template->assign_block_vars('r_users.tab_user.group.list.tools', array(
							'LINK' => 'index.php?page=adm_utilisateurs.php&amp;user_id='.($tab[$i]["id"] ?? '').'&amp;action=Editer',
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
							'TITLE' => $lang["edit"]
						));
					}
					if ((preg_match('`;'.RGHT_USERS_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && ($tab[$i][US_LNAME] ?? '') != 'Demo')
					{
						$template->assign_block_vars('r_users.tab_user.group.list.tools', array(
							'LINK' => 'index.php?page=adm_utilisateurs.php&amp;user_id='.($tab[$i]["id"] ?? '').'&amp;action=Supprimer',
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
							'TITLE' => $lang["delete"]
						));
					}

					// Synchroniser l'utilisateur avec LDAP
					if ((preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && (preg_match('`;'.RGHT_LDAP_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && LDAP_INSTALL == "Oui" && !isset($err_ldap))
					{
						// Clé primaire de comparaison des 2 bases
						if (defined("LDAP_KEY"))
							$key = explode(";",LDAP_KEY);
						else
							$key = array('mail','mail');

						$recherche = $tab[$i][$key[0]];

						$server = LDAP_HOST;
						$port = LDAP_PORT;
						$rootdn = LDAP_USER;
						$rootpw = LDAP_MDP;

						$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask".$_GET["agence_id"]."'";
						$tab_racine = $req1->db_use_query($requete);

						if (count($tab_racine) > 0)
							$racine = $tab_racine[0]["valeur"];
						else
							$racine = LDAP_MASK;

						$ds=ldap_connect($server, $port);
						$r=ldap_bind($ds,$rootdn,$rootpw);

						$sr=ldap_search($ds, $racine, $key[1]."=".$recherche);
						$info = ldap_get_entries ($ds, $sr);

						if (trim($recherche) != '' && isset($info[0][$key[1]][0]))
						{
							$template->assign_block_vars('r_users.tab_user.group.list.tools', array(
									'LINK' => 'index.php?page=adm_utilisateurs.php&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=sync_ldap&amp;'.$key[1].'='.urlencode(serialize($tab[$i][$key[0]])),
									'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/ldap_sync.gif',
									'TITLE' => $lang["user_sync_ldap"]
								));
						}
					}

					$i++;
				}
			}
			else
			{
				$template->assign_block_vars('r_users.no_user', array(
					'TEXT' => $lang["user_no_user"]
				));
			}


			// Ajout
			if (preg_match('`;'.RGHT_USERS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('r_users.add', array(
					'LINK' => 'index.php?page=adm_utilisateurs.php&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=add',
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add.gif',
					'TEXT' => $lang["add"]
				));
			}

			// Bouton de gestion de l'affichage
			$template->assign_block_vars('r_users.display', array(
				'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"],
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
				'TEXT' => $lang["gen_admindisplay"]
			));

			// Export Excel
			if (count($tab) > 0)
			{
				$serialized_string = base64_encode(serialize($export_data));
				$template->assign_block_vars('r_users.export', array(
					'NOM' => $lang["user_list"],
					'LINK' => 'window.document.formexport.submit()',
					'DATA' => $serialized_string,
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/excel.gif',
					'TEXT' => $lang["excel_export"]
				));
			}

		}

		/*********************************************/
		/*                 Module LDAP               */
		/*********************************************/
		elseif ($_GET["rubrique"] == "ldap")
		{
			// Init de la rubrique
			$export_data = array();
			$aff_num = 0;

			// On récupère l'adresse actuelle d'ou l'on supprime le critère de tri
			$page_tri = str_ireplace('&','&amp;',preg_replace("{&tri=".$tri."}","",$_SERVER['REQUEST_URI']));

			// Si connexion OK
			if ($fp = @fsockopen(LDAP_HOST, LDAP_PORT, $errno, $errstr, 5))
			{
				fclose($fp);
				$errno = 0;

				/**************** Utilisateurs **************/
				if (isset($_GET["sscat"]) && $_GET["sscat"] == 'user')
				{
					$template->assign_block_vars('r_users', array());

					// Clé primaire de comparaison des 2 bases
					if (defined("LDAP_KEY"))
						$key = explode(";",LDAP_KEY);
					else
						$key = array('mail','mail');

					// Racine de recherche LDAP du site
					$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask".intval($_GET["agence_id"])."'";
					$tab_racine = $req1->db_use_query($requete);

					if (count($tab_racine) > 0)
						$racine = $tab_racine[0]["valeur"];
					else
						$racine = LDAP_MASK;

					// Si filtre saisi
					if (isset($_GET["filter_text"]))
						$search_val = '*'.$_GET["filter_text"].'*';
					else
						$search_val = '*';

					$ds=ldap_connect(LDAP_HOST, LDAP_PORT);
					$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);
					$sr=@ldap_search($ds, $racine, $key[1]."=".$search_val,array(),0,500);
					$errno = ldap_errno($ds);

					if ($errno != 0)
					{
						$errors = $lang["ldap_error_text"].'<br />';

						if (isset($lang["ldap_error_no".ldap_errno($ds)]))
							$errors .= $lang["ldap_error_no".ldap_errno($ds)];
						else
							$errors .= '#'.ldap_errno($ds).' '.ldap_error($ds);

						$template->assign_block_vars('r_users.error', array(
						  'TEXT' => $errors,
						));
					}

					@ldap_sort($ds, $sr, constant($tri));
					$info = @ldap_get_entries($ds, $sr);

					$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE agence_id='".intval($_GET["agence_id"])."' AND ".$key[0]." LIKE '%".str_replace("*","",$search_val)."%'");

					if ($errno == 0 && count($info["count"]) != 0)
					{
						/********************** DEBUT En-tetes ***********************/
						$export_data[0][5] = $lang["user_status"];

						$template->assign_block_vars('r_users.tab_user', array(
							'LANG_TOOLS' => $lang["tools"],
							'COL_STATUS' => $export_data[0][5]
						));

						$j = 0;
						while ($j < count($cols_display["user"]))
						{
							$export_data[0][$j+1] = $lang["s_".$cols_display["user"][$j]] ?? $cols_display["user"][$j];

							$template->assign_block_vars('r_users.tab_user.cols', array(
								'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display["user"][$j],
								'TITLE' => $export_data[0][$j+1],
							));

							$j++;
						}
						/*********************** FIN En-tetes ************************/

						/************** DEBUT Préparation du menu filtre ***************/
						$template->assign_block_vars('r_users.tab_user.filters', array(
							'LANG_FILTER' => $lang["user_filter_submit"],
							'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/filter_icon.png',
							'TEXT' => $lang["user_filter_filter"],
						));

						foreach($_GET AS $keyf => $valuef)
						{
							if ($keyf != 'filter_text')
							{
								$template->assign_block_vars('r_users.tab_user.filters.hidden_filter', array(
									'NAME' => $keyf,
									'VALUE' => $valuef,
								));
							}
						}
						/************** FIN Préparation du menu filtre ***************/

						// Verifie si les personnes de l'annuaire sont dans la table utilisateurs
						for ($i=0; $i < $info["count"]; $i++)
						{
							$tab_bis = $req1->db_use_query("SELECT ".TAB_USERS.".*,
							".TAB_USERS_GRP.".libelle
							FROM ".TAB_USERS."
							  LEFT JOIN ".TAB_USERS_GRP." ON ".TAB_USERS_GRP.".id = ".TAB_USERS.".groupe_id
							WHERE ".TAB_USERS.".".$key[0]."='".$info[$i][constant("LDAP_ATTR_".strtoupper($key[1]))][0]."'");

							// Utilisateur dans LDAP et dans OUAPI
							if (count($tab_bis) > 0)
							{
								if ($tab_bis[0]["agence_id"] == intval($_GET["agence_id"]))
								{
									$export_data[$i+1][5] = $lang["user_exist"];
									$status[$i+1] = 'green';
								}
								else
								{
									$export_data[$i+1][5] = $lang["user_existothersite"];
									$status[$i+1] = 'blue';
								}

								// Liste des résultats
								$template->assign_block_vars('r_users.tab_user.list', array(
									'COL_STATUS' => $export_data[$i+1][5],
									'STATUS_COLOR' => $status[$i+1]
								));

								// Synchroniser l'utilisateur
								if (preg_match('`;'.RGHT_LDAP_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
								{
									$template->assign_block_vars('r_users.tab_user.list.tools', array(
										'LINK' => 'index.php?page=adm_utilisateurs.php&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=sync_ldap&amp;'.constant("LDAP_ATTR_".strtoupper($key[1])).'='.urlencode(serialize($info[$i][constant("LDAP_ATTR_".strtoupper($key[1]))][0])),
										'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/ldap_sync.gif',
										'TITLE' => $lang["user_sync"]
									));
								}
							}
							// Utilisateur dans LDAP et pas dans OUAPI
							else
							{
								$export_data[$i+1][5] = $lang["user_not_exist_base"];
								$status[$i+1] = 'red';

								// Liste des résultats
								$template->assign_block_vars('r_users.tab_user.list', array(
									'COL_STATUS' => $export_data[$i+1][5],
									'STATUS_COLOR' => $status[$i+1]
								));

								// Ajouter l'utilisateur
								if (preg_match('`;'.RGHT_LDAP_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
								{
									$template->assign_block_vars('r_users.tab_user.list.tools', array(
										'LINK' => 'index.php?page=adm_utilisateurs.php&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=add_ldap&amp;'.constant("LDAP_ATTR_".strtoupper($key[1])).'='.urlencode(serialize($info[$i][constant("LDAP_ATTR_".strtoupper($key[1]))][0])),
										'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_big.gif',
										'TITLE' => $lang["add"]
									));
								}

							}

							$j = 0;
							while ($j < count($cols_display["user"]))
							{
								if (isset($info[$i][constant($cols_display["user"][$j])][0]))
									$export_data[$i+1][$j+1] = col_displaying(constant($cols_display["user"][$j]),$info[$i][constant($cols_display["user"][$j])][0]);
								else
									$export_data[$i+1][$j+1] = txt_to_na('');

								$template->assign_block_vars('r_users.tab_user.list.cols', array(
									'TITLE' => $export_data[$i+1][$j+1],
								));

								$j++;
							}

						}
					}

					// Ajouter en masse avec LDAP
					if ((preg_match('`;'.RGHT_LDAP_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && LDAP_INSTALL == "Oui")
					{
						$template->assign_block_vars('r_users.addall', array(
							'LINK' => 'index.php?page=adm_utilisateurs.php&amp;action=addall_ldap&amp;agence_id='.intval($_GET["agence_id"]),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/addall.gif',
							'TEXT' => $lang["user_conf_ldap_addall"]
						));
					}

					// Export Excel
					if (count($tab) > 0)
					{
						$serialized_string = base64_encode(serialize($export_data));
						$template->assign_block_vars('r_users.export', array(
							'NOM' => $lang["user_list"],
							'LINK' => 'window.document.formexport.submit()',
							'DATA' => $serialized_string,
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/excel.gif',
							'TEXT' => $lang["excel_export"]
						));
					}

					// Bouton de gestion de l'affichage
					$template->assign_block_vars('r_users.display', array(
						'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"].'&amp;subcat=user',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
						'TEXT' => $lang["gen_admindisplay"]
					));

					// Configurer LDAP
					if ((preg_match('`;'.RGHT_LDAP_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && LDAP_INSTALL == "Oui")
					{
						$template->assign_block_vars('r_users.conf', array(
							'LINK' => 'index.php?page=adm_utilisateurs.php&amp;action=conf_ldap&amp;agence_id='.intval($_GET["agence_id"]),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/conf.gif',
							'TEXT' => $lang["user_conf_ldap"]
						));
					}


				}
				// ----- Matériels -------
				elseif (isset($_GET["sscat"]) && $_GET["sscat"] == 'hard')
				{
					$template->assign_block_vars('r_pc', array());
					// Clé primaire de comparaison des 2 bases
					if (defined("LDAP_KEY_HARD"))
						$key = explode(";",LDAP_KEY_HARD);
					else
						$key = array('nom','name');

					// Racine de recherche LDAP du site
					$requete = "SELECT valeur FROM ".TAB_CONFIG." WHERE nom='ldap_mask_hard".intval($_GET["agence_id"])."'";
					$tab_racine = $req1->db_use_query($requete);

					if (count($tab_racine) > 0)
						$racine = $tab_racine[0]["valeur"];
					else
						$racine = LDAP_MASK_HARD;

					// Si filtre saisi
					if (isset($_GET["filter_text"]))
						$search_val = '*'.$_GET["filter_text"].'*';
					else
						$search_val = '*';

					$ds=@ldap_connect(LDAP_HOST, LDAP_PORT);
					$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);
					$sr=@ldap_search($ds, $racine, '(&(cn=*)('.$key[1]."=".$search_val.'))',array(),0,500);
					$errno = ldap_errno($ds);

					if ($errno != 0)
					{
						$errors = $lang["ldap_error_text"].'<br />';

						if (isset($lang["ldap_error_no".ldap_errno($ds)]))
							$errors .= $lang["ldap_error_no".ldap_errno($ds)];
						else
							$errors .= '#'.ldap_errno($ds).' '.ldap_error($ds);

						$template->assign_block_vars('r_pc.error', array(
						  'TEXT' => $errors,
						));
					}

					@ldap_sort($ds, $sr, constant($tri));
					$info = @ldap_get_entries($ds, $sr);

					$tab = $req1->db_use_query("SELECT * FROM ".TAB_HARD." WHERE ".HA_SITEID."='".intval($_GET["agence_id"])."' AND ".$key[0]." LIKE '%".str_replace("*","",$search_val)."%'");

					if ($errno == 0 && count($info["count"]) != 0)
					{
						/********************** DEBUT En-tetes ***********************/
						$export_data[0][5] = $lang["user_status"];

						$template->assign_block_vars('r_pc.tab_pc', array(
							'LANG_TOOLS' => $lang["tools"],
							'COL_STATUS' => $export_data[0][5]
						));

						$j = 0;
						while ($j < count($cols_display["hard"]))
						{
							$export_data[0][$j+1] = $lang["s_".$cols_display["hard"][$j]] ?? $cols_display["hard"][$j];

							$template->assign_block_vars('r_pc.tab_pc.cols', array(
								'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display["hard"][$j],
								'TITLE' => $export_data[0][$j+1],
							));

							$j++;
						}
						/*********************** FIN En-tetes ************************/

						/************** DEBUT Préparation du menu filtre ***************/
						$template->assign_block_vars('r_pc.filters', array(
							'LANG_FILTER' => $lang["user_filter_submit"],
							'IMG' => 'templates/'.DEFAULT_TEMPLATE.'/images/filter_icon.png',
							'TEXT' => $lang["user_filter_filter"],
						));

						foreach($_GET AS $keyf => $valuef)
						{
							if ($keyf != 'filter_text')
							{
								$template->assign_block_vars('r_pc.filters.hidden_filter', array(
									'NAME' => $keyf,
									'VALUE' => $valuef,
								));
							}
						}
						/************** FIN Préparation du menu filtre ***************/

						// Verifie si les matériels de l'annuaire LDAP sont dans la table matériel de OUAPI
						for ($i=0; $i < $info["count"]; $i++)
						{
							// for ($j=0; $j < $info[$i]["count"]; $j++)
							// {
								// echo $info[$i][$j].' > '.$info[$i][$info[$i][$j]][0].'<br />';
							// }
							// echo '<br />';

							if (isset($info[$i][constant("LDAP_ATTR_HARD_".strtoupper($key[1]))][0]))
							{
								$tab_bis = $req1->db_use_query("SELECT ".TAB_HARD.".*
								FROM ".TAB_HARD."
								WHERE ".TAB_HARD.".".$key[0]."='".$info[$i][constant("LDAP_ATTR_HARD_".strtoupper($key[1]))][0]."'");
							}
							else
								$tab_bis = array();

							// Utilisateur dans LDAP et dans OUAPI
							if (count($tab_bis) > 0)
							{
								if ($tab_bis[0]["agence_id"] == intval($_GET["agence_id"]))
								{
									$export_data[$i+1][5] = $lang["ldap_hard_status_exist"];
									$status[$i+1] = 'green';
								}
								else
								{
									$export_data[$i+1][5] = $lang["ldap_hard_status_existothersite"];
									$status[$i+1] = 'blue';
								}

								// Liste des résultats
								$template->assign_block_vars('r_pc.tab_pc.list', array(
									'COL_STATUS' => $export_data[$i+1][5],
									'STATUS_COLOR' => $status[$i+1]
								));

								// Synchroniser le matériel
								if (preg_match('`;'.RGHT_LDAP_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
								{
									$template->assign_block_vars('r_pc.tab_pc.list.tools', array(
										'LINK' => 'index.php?page=adm_materiels.php&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=sync_ldap&amp;h_id='.$tab_bis[0][HA_ID].'&amp;'.constant("LDAP_ATTR_HARD_".strtoupper($key[1])).'='.urlencode(serialize($info[$i][constant("LDAP_ATTR_HARD_".strtoupper($key[1]))][0])),
										'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/ldap_sync.gif',
										'TITLE' => $lang["user_sync"]
									));
								}
							}
							// Matériel dans LDAP et pas dans OUAPI
							else
							{
								$export_data[$i+1][5] = $lang["user_not_exist_base"];
								$status[$i+1] = 'red';

								// Liste des résultats
								$template->assign_block_vars('r_pc.tab_pc.list', array(
									'COL_STATUS' => $export_data[$i+1][5],
									'STATUS_COLOR' => $status[$i+1]
								));

								// Ajouter le matériel
								if (preg_match('`;'.RGHT_LDAP_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10 && isset($info[$i][constant("LDAP_ATTR_HARD_".strtoupper($key[1]))][0]))
								{
									$template->assign_block_vars('r_pc.tab_pc.list.tools', array(
										'LINK' => 'index.php?page=adm_materiels.php&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=add_ldap&amp;'.constant("LDAP_ATTR_HARD_".strtoupper($key[1])).'='.urlencode(serialize($info[$i][constant("LDAP_ATTR_HARD_".strtoupper($key[1]))][0])),
										'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_big.gif',
										'TITLE' => $lang["user_sync"]
									));
								}

							}

							$j = 0;
							while ($j < count($cols_display["hard"]))
							{
								$export_data[$i+1][$j+1] = @col_displaying(constant($cols_display["hard"][$j]),$info[$i][constant($cols_display["hard"][$j])][0]);

								$template->assign_block_vars('r_pc.tab_pc.list.cols', array(
									'TITLE' => $export_data[$i+1][$j+1],
								));

								$j++;
							}

						}
					}

					// Ajouter en masse avec LDAP
					// if ((preg_match('`;'.RGHT_LDAP_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && LDAP_INSTALL == "Oui")
					// {
						// $template->assign_block_vars('r_pc.addall', array(
							// 'LINK' => 'index.php?page=adm_utilisateurs.php&amp;action=addall_ldap&amp;agence_id='.intval($_GET["agence_id"]),
							// 'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/addall.gif',
							// 'TEXT' => $lang["user_conf_ldap_addall"]
						// ));
					// }

					// Export Excel
					if (count($tab) > 0)
					{
						$serialized_string = base64_encode(serialize($export_data));
						$template->assign_block_vars('r_pc.export', array(
							'NOM' => $lang["user_list"],
							'LINK' => 'window.document.formexport.submit()',
							'DATA' => $serialized_string,
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/excel.gif',
							'TEXT' => $lang["excel_export"]
						));
					}

					// Bouton de gestion de l'affichage
					$template->assign_block_vars('r_pc.display', array(
						'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"].'&amp;subcat=hard',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
						'TEXT' => $lang["gen_admindisplay"]
					));

					// Configurer LDAP
					if ((preg_match('`;'.RGHT_LDAP_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && LDAP_INSTALL == "Oui")
					{
						$template->assign_block_vars('r_pc.conf', array(
							'LINK' => 'index.php?page=adm_utilisateurs.php&amp;action=conf_ldap&amp;agence_id='.intval($_GET["agence_id"]),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/conf.gif',
							'TEXT' => $lang["user_conf_ldap"]
						));
					}

				}
			}
			else
			{
				$template->assign_block_vars('error', array(
					'TEXT' => $lang["pc_ldap_error"],
				));
			}



		}

		/********************************************/
		/*                  RESEAU                  */
		/********************************************/
		elseif ($_GET["rubrique"] == "netw")
		{
			// Init de la rubrique
			$template->assign_block_vars('r_netw', array());

			if (PARAM_HELP == 1)
			{
				$template->assign_block_vars('r_netw.help', array(
					'IMG_TITLE' => $lang["gen_help"],
					'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
					'GENERAL_HELP' => $lang["help"][10]
				));
			}

			// Affichage de l'équipement réseau
			$requete = "SELECT DISTINCT r.equipement_id, h.ip, h.num_serie, h.nom
            			FROM ".TAB_RESEAU." r
            			INNER JOIN ".TAB_HARD." h ON h.id = r.equipement_id
            			WHERE r.agence_id='".intval($_GET["agence_id"])."' 
            			AND r.equipement_id > 0
            			ORDER BY h.nom ASC"; // Tri par nom de switch
			$tab = $req1->db_use_query($requete);

			$i = 0;
			while ($i < count($tab))
			{
				$template->assign_block_vars('r_netw.equipmt', array(
					'NAME' => txt_to_na($tab[$i]["nom"]),
					'SERIAL' => txt_to_na($tab[$i]["num_serie"]),
				));

				if ($tab[$i]["ip"] != '' && (preg_match('`;'.RGHT_NETW_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
					$template->assign_block_vars('r_netw.equipmt.ip', array('VALUE' => $tab[$i]["ip"]));


				// Affichage des ports de l'équipement
				$requete_max = "SELECT MAX(port_id) as max_p FROM ".TAB_RESEAU." WHERE equipement_id='".$tab[$i]["equipement_id"]."' AND agence_id='".intval($_GET["agence_id"])."'";
    			$tab_max = $req1->db_use_query($requete_max);
    			$limit_port = (isset($tab_max[0]["max_p"])) ? intval($tab_max[0]["max_p"]) : 0;

    			// Récupération des données des ports pour CE switch
    			$requete_ports = "SELECT r.*, e.libelle AS l_empl, h.nom AS hardname
                      			FROM ".TAB_RESEAU." r
                      			LEFT JOIN ".TAB_HARD." h ON h.id = r.hardware_id
                      			LEFT JOIN ".TAB_EMPL." e ON e.id = r.emplacement_id
                      			WHERE r.agence_id='".intval($_GET["agence_id"])."' 
                      			AND r.equipement_id='".$tab[$i]["equipement_id"]."' 
                      			AND r.port_id <> '0'
                      			ORDER BY r.port_id ASC";
    			$tab_ports = $req1->db_use_query($requete_ports);

				if ($limit_port > 96)
				{
					$template->assign_block_vars('r_netw.error', array(
						'TEXT' => $lang["netw_numporterror"],
					));
				}


				$curseur = 0;
				$j = 1;
				while ($j <= $limit_port && $j <= 96)
				{
					if (isset($tab_ports[$curseur]) && $j == $tab_ports[$curseur]["port_id"])
					{
						$template->assign_block_vars('r_netw.equipmt.list_port', array(
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/rj45_ok.gif',
							'TITLE' => $lang["port"].' '.$j,
							'NUM' => $lang["netw_1"].': '.addslashes(format_string_input($tab_ports[$curseur]["num_prise"])),
							'NAME' => $lang["netw_hard"].': '.addslashes(format_string_input(txt_to_na($tab_ports[$curseur]["hardname"]))),
							'PLACE' => $lang["place_2"].': '.addslashes(format_string_input(txt_to_na($tab_ports[$curseur]["l_empl"]))),
						));

						$curseur++;
					}
					else
					{
						$template->assign_block_vars('r_netw.equipmt.list_port', array(
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/rj45_nok.gif',
							'TITLE' => $lang["port"].' '.$j,
							'NUM' => $lang["netw_nolink"],
							'NAME' => '-',
							'PLACE' => '-',
						));
					}

					if ($j == ceil($limit_port/2)) {
						$template->assign_block_vars('r_netw.equipmt.list_port.line', array());
					}
					$j++;
				}
				$i++;
			}

			(trim($cols_groupcol) != '') ? ($sql_groupcol = $cols_groupcol.',') : ($sql_groupcol = '');
			// Tableau des prises
			$k = 0;
			$requete_prises = "SELECT ".TAB_RESEAU.".*,
			  ".TAB_PERIPH.".nom AS switch_name,
			  ".TAB_HARD.".".HA_NAME." AS hardware_name,
			  ".TAB_EMPL.".".EM_LIBELLE." AS location_name
			FROM ".TAB_RESEAU."
				LEFT JOIN ".TAB_PERIPH." ON ".TAB_RESEAU.".equipement_id = ".TAB_PERIPH.".id
			  LEFT JOIN ".TAB_HARD." ON ".TAB_RESEAU.".".RE_HARDWAREID." = ".TAB_HARD.".id
			  LEFT JOIN ".TAB_EMPL." ON ".TAB_RESEAU.".".RE_LOCATIONID." = ".TAB_EMPL.".id
			WHERE ".TAB_RESEAU.".".RE_SITEID."='".intval($_GET["agence_id"])."'
			ORDER BY ".$sql_groupcol." ".$tri;
			$tab_prises_brut = $req1->db_use_query($requete_prises,1);

			$tab_prises = [];
			$cleaned_tab = [];
			foreach ($tab_prises_brut as $index => $ligne) {
    			foreach ($ligne as $cle => $valeur) {
        			$cle_nettoyee = str_replace('1.', '', $cle);
        			$tab_prises[$index][$cle_nettoyee] = $valeur;
    			}
			}

			if (count($tab_prises) > 0)
			{
				// On récupère l'adresse actuelle d'ou l'on supprime le critère de tri
				$page_tri = str_replace('&','&amp;',preg_replace("{&tri=".@$_GET["tri"]."}","",$_SERVER['REQUEST_URI']));

				// Init du tableau de données
				$export_data = array();

				$template->assign_block_vars('r_netw.tab_netw', array(
					'PAGE_TRI' => $page_tri,
					'NBCOLS' => count($cols_display)+1,
					'LANG_TOOLS' => $lang["tools"],
				));

				/********* EN TETES **********/
				$j = 0;
				while ($j < count($cols_display))
				{
					$export_data[0][$j+1] = $lang["s_".$cols_display[$j]] ?? $cols_display[$j];

					$template->assign_block_vars('r_netw.tab_netw.cols', array(
						'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display[$j],
						'TITLE' => $export_data[0][$j+1],
					));

					$j++;
				}

				while ($k < count($tab_prises))
				{
					if (isset($_GET["highlight_id"]) && $_GET["highlight_id"] == ($tab_prises[$k]['id'] ?? ''))
						$class_row = 'highlight';
					else
						$class_row = 'liste';

					$template->assign_block_vars('r_netw.tab_netw.list', array(
						'CLASS_ROW' => $class_row,
						'ANCHOR' => 'anchor'.($tab_prises[$k]['id'] ?? ''),
					));

					$j = 0;
					while ($j < count($cols_display))
					{
						$col_brute = $cols_display[$j];
						if (strpos($col_brute, 'equipement') !== false || strpos($col_brute, 'alias_switchname') !== false) {
        					$valeur_brute = txt_to_na($tab_prises[$k]['switch_name'] ?? '');
						} elseif (strpos($col_brute, 'hardware.'.HA_NAME) !== false) {
							$valeur_brute = $tab_prises[$k]['hardware_name'] ?? '';
						} elseif (strpos($col_brute, 'emplacement.'.EM_LIBELLE) !== false) {
							$valeur_brute = $tab_prises[$k]['location_name'] ?? '';
						} else {
							$col_nettoyee = substr(strrchr($col_brute, "."), 1) ?: $col_brute;
							$valeur_brute = $tab_prises[$k][$col_nettoyee] ?? '';
						}

						$export_data[$k+1][$j+1] = col_displaying($col_brute, $valeur_brute);

						$template->assign_block_vars('r_netw.tab_netw.list.cols', array(
							'TITLE' => $export_data[$k+1][$j+1],
						));

						$j++;
					}

					// Affichage de la fiche
					$template->assign_block_vars('r_netw.tab_netw.list.tools', array(
						'LINK' => 'index.php?page=visu_fiche.php&amp;type=netw&amp;id='.($tab_prises[$k]['id'] ?? '').'&amp;agence_id='.intval(intval($_GET["agence_id"])).'&amp;action=visu',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
						'TITLE' => $lang["see"]
					));

					if (preg_match('`;'.RGHT_NETW_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_netw.tab_netw.list.tools', array(
							'LINK' => 'index.php?page=adm_reseau.php&amp;action=Editer&amp;agence_id='.intval($_GET["agence_id"]).'&amp;id='.($tab_prises[$k]['id'] ?? ''),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
							'TITLE' => $lang["edit"]
						));
					}
					if (preg_match('`;'.RGHT_NETW_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_netw.tab_netw.list.tools', array(
							'LINK' => 'index.php?page=adm_reseau.php&amp;action=Supprimer&amp;agence_id='.intval($_GET["agence_id"]).'&amp;id='.($tab_prises[$k]['id'] ?? ''),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
							'TITLE' => $lang["delete"]
						));
					}

					$k++;
				}
			}
			// S'il n'y a aucun résultat
			else
			{
				$template->assign_block_vars('r_netw.no_netw', array(
					'TEXT' => $lang["no_netw"]
				));
			}

			// Ajouter une prise
			if (preg_match('`;'.RGHT_NETW_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('r_netw.add', array(
					'LINK' => 'index.php?page=adm_reseau.php&amp;action=Ajouter&amp;agence_id='.intval($_GET["agence_id"]),
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add.gif',
					'TEXT' => $lang["add"]
				));
			}

			// Export Excel
			if (count($tab) > 0)
			{
				$serialized_string = base64_encode(serialize($export_data));
				$template->assign_block_vars('r_netw.export', array(
					'NOM' => $lang["netw_list"],
					'LINK' => 'window.document.formexport.submit()',
					'DATA' => $serialized_string,
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/excel.gif',
					'TEXT' => $lang["excel_export"]
				));
			}

			// Associer un type de matériel
			if (preg_match('`;'.RGHT_NETW_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('r_netw.hardtype', array(
					'LINK' => 'index.php?page=adm_reseau.php&amp;config=assoc',
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/conf.gif',
					'TEXT' => $lang["netw_assoc"]
				));
			}

			// Bouton de gestion de l'affichage
			$template->assign_block_vars('r_netw.display', array(
				'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"],
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
				'TEXT' => $lang["gen_admindisplay"]
			));
		}

		/**********************************************/
		/*               RESERVATIONS                 */
		/**********************************************/
		elseif ($_GET["rubrique"] == "resa")
		{
			// Init de la rubrique
			$template->assign_block_vars('r_resa', array());

			if (PARAM_HELP == 1)
			{
				$template->assign_block_vars('r_resa.help', array(
					'IMG_TITLE' => $lang["gen_help"],
					'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
					'GENERAL_HELP' => $lang["help"][9]
				));
			}

			$page_tri = str_replace('&','&amp;',preg_replace("{&tri=".$tri."}","",$_SERVER['REQUEST_URI']));

			// MATERIEL
			if (isset($_GET["sscat"]) && $_GET["sscat"] == 'hard')
			{
				/**************** DEBUT Preparation requete SQL ******************/
				(trim($cols_groupcol[$_GET["sscat"]]) != '')?($sql_groupcol = $cols_groupcol[$_GET["sscat"]].','):($sql_groupcol = '');
				$requete = "SELECT ".TAB_HARD.".*,
				".TAB_HARD_TYPE.".libelle AS hard_type_libelle,
				".TAB_HARD_MARQUE.".libelle AS hard_marque_libelle,
				".TAB_HARD_MODELE.".libelle AS hard_modele_libelle,
				".TAB_HARD_OS.".".HA_OS_LIBELLE." AS os_libelle,
				".TAB_EMPL.".".EM_LIBELLE." AS lieu_libelle
				FROM ".TAB_HARD."
				  LEFT JOIN ".TAB_HARD_TYPE." ON ".TAB_HARD_TYPE.".id = ".TAB_HARD.".".HA_TYPEID."
				  LEFT JOIN ".TAB_HARD_MARQUE." ON ".TAB_HARD_MARQUE.".id = ".TAB_HARD.".".HA_MARQUEID."
				  LEFT JOIN ".TAB_HARD_MODELE." ON ".TAB_HARD_MODELE.".id = ".TAB_HARD.".".HA_MODELEID."
				  LEFT JOIN ".TAB_EMPL." ON ".TAB_EMPL.".".EM_ID." = ".TAB_HARD.".".HA_LOCATIONID."
				  LEFT JOIN ".TAB_HARD_OS." ON ".TAB_HARD.".".HA_OSID." = ".TAB_HARD_OS.".".HA_OS_ID."
				  LEFT JOIN ".TAB_USERS." ON ".TAB_HARD.".".HA_USERID." = ".TAB_USERS.".".US_ID."
				WHERE (".TAB_HARD.".".HA_SITEID."='".intval($_GET["agence_id"])."' OR ".TAB_HARD.".".HA_SITEID."='0')
				AND ".TAB_HARD.".reservable<>'0' AND ".TAB_HARD.".suivi_rebus=''
				ORDER BY ".$sql_groupcol." ".$tri;

				$prefixe = "1";
				$tab_brut = $req1->db_use_query($requete,$prefixe);
				$tab = array();

				foreach ($tab_brut as $i => $ligne) {
    				foreach ($ligne as $cle => $valeur) {
        				$cle_nettoyee = str_replace($prefixe . '.', '', $cle);
        				$tab[$i][$cle_nettoyee] = $valeur;
    				}
				}

				// MATERIELS
				if (count($tab) > 0)
				{
					$template->assign_block_vars('r_resa.tab_resa', array(
						'NBCOLS' => count($cols_display["hard"])+13,
					));

					$i = 0;
					while ($i < count($tab))
					{
						// 1. On prépare la clé de comparaison (nettoyée)
    					$group_key_raw = substr(strrchr($cols_groupcol[$_GET["sscat"]], "."), 1) ?: $cols_groupcol[$_GET["sscat"]];
    					$group_key_raw = str_replace('1.', '', $group_key_raw);
    
    					// 2. On détermine la valeur actuelle et la valeur précédente pour détecter le changement
    					$valeur_actuelle = $tab[$i][$group_key_raw] ?? ($tab[$i]['hard_type_libelle'] ?? '');
    					$valeur_precedente = ($i > 0) ? ($tab[$i-1][$group_key_raw] ?? ($tab[$i-1]['hard_type_libelle'] ?? '')) : null;

    					// 3. Si c'est le premier passage ou si la valeur a changé, on affiche l'en-tête
    					if ($i == 0 || (trim($cols_groupcol[$_GET["sscat"]]) != '' && $valeur_actuelle != $valeur_precedente))
    					{
        					$template->assign_block_vars('r_resa.tab_resa.group', array(
            					'LANG_TOOLS' => $lang["tools"]
        					));

        					if (trim($cols_groupcol[$_GET["sscat"]]) != '')
							{
    							// On cherche le mot clé dans la colonne de groupage pour choisir le bon libellé
    							if (strpos($cols_groupcol[$_GET["sscat"]], 'type') !== false) {
        							$display_title = $tab[$i]['hard_type_libelle'] ?? '';
    							} elseif (strpos($cols_groupcol[$_GET["sscat"]], 'marque') !== false) {
        							$display_title = $tab[$i]['hard_marque_libelle'] ?? '';
    							} elseif (strpos($cols_groupcol[$_GET["sscat"]], 'modele') !== false) {
        							$display_title = $tab[$i]['hard_modele_libelle'] ?? '';
    							} elseif (strpos($cols_groupcol[$_GET["sscat"]], 'lieu') !== false || strpos($cols_groupcol[$_GET["sscat"]], 'emplacement') !== false) {
        							$display_title = $tab[$i]['lieu_libelle'] ?? '';
    							} elseif (strpos($cols_groupcol[$_GET["sscat"]], 'os') !== false) {
        							$display_title = $tab[$i]['os_libelle'] ?? '';
    							} else {
        							// Pour les autres champs (Nom, SN...), on nettoie la clé SQL pour lire le tableau
        							$group_key_clean = substr(strrchr($cols_groupcol[$_GET["sscat"]], "."), 1) ?: $cols_groupcol[$_GET["sscat"]];
        							// On enlève le préfixe si jamais il reste un "1." ou "2."
        							$group_key_clean = str_replace('1.', '', $group_key_clean);
        							$group_key_clean = str_replace('2.', '', $group_key_clean);
        
        							$display_title = $tab[$i][$group_key_clean] ?? '';
    							}

    							$template->assign_block_vars('r_resa.tab_resa.group.head', array(
        							'TITLE' => txt_to_na($display_title),
    							));
							}


        					$template->assign_block_vars('r_resa.tab_resa.group.head2', array());

							$j = 0;
							while ($j < count($cols_display['hard']))
							{
								$export_data[0][$j+1] = $lang["s_".$cols_display['hard'][$j]] ?? $cols_display['hard'][$j];
								$template->assign_block_vars('r_resa.tab_resa.group.head2.cols', array(
									'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display['hard'][$j],
									'TITLE' => $export_data[0][$j+1],
								));

								$j++;
							}
						}

						if (isset($_GET["highlight_id"]) && $_GET["highlight_id"] == ($tab[$i]['id'] ?? ''))
							$class_row = 'highlight';
						else
							$class_row = 'liste';

						$export_data[$i+1][0] = txt_to_na($tab[$i]['hard_type_libelle'] ?? '');

						$class = ($i % 2 == 0) ? 'couleur1' : 'couleur2';
						$template->assign_block_vars('r_resa.tab_resa.group.list', array(
							'CLASS' => $class,
							'CLASS_ROW' => $class_row,
							'ANCHOR' => 'anchor'.($tab[$i]['id'] ?? ''),
						));

						// Affichage des colonnes //
						$j = 0;
						while ($j < count($cols_display["hard"]))
						{
    						$col_brute = $cols_display["hard"][$j] ?? '';

							if ($col_brute == '') {
        					$j++;
        					continue;
    						}

    						// On détermine quelle clé de $tab utiliser en fonction du nom de la colonne configurer
    						if (strpos($col_brute, 'ha_type.libelle') !== false) {
                				$valeur_brute = $tab[$i]['hard_type_libelle'] ?? '';
            				} elseif (strpos($col_brute, 'ha_marque.libelle') !== false) {
                				$valeur_brute = $tab[$i]['hard_marque_libelle'] ?? '';
            				} elseif (strpos($col_brute, 'ha_modele.libelle') !== false) {
                				$valeur_brute = $tab[$i]['hard_modele_libelle'] ?? '';
							} elseif (strpos($col_brute, 'emplacement.libelle') !== false) {
    							$valeur_brute = $tab[$i]['lieu_libelle'] ?? '';
							} elseif (strpos($col_brute, 'ha_os.libelle') !== false) {
    							$valeur_brute = $tab[$i]['os_libelle'] ?? '';
							} elseif (strpos($col_brute, 'utilisateur.nom') !== false || strpos($col_brute, 'utilisateur.prenom') !== false) {
    							$nom = $tab[$i]['user_nom'] ?? '';
    							$prenom = $tab[$i]['user_prenom'] ?? '';
    							$valeur_brute = trim($nom . ' ' . $prenom);
            				} elseif (strpos($col_brute, 'hardware.nom') !== false) {
                				$valeur_brute = $tab[$i]['nom'] ?? '';
            				} elseif (strpos($col_brute, 'hardware.ip') !== false) {
                				$valeur_brute = $tab[$i]['ip'] ?? '';
							} elseif (strpos($col_brute, 'creation_date') !== false) {
    							$valeur_brute = $tab[$i]['creation_date'] ?? '';
    						} else {
        						// Au cas où : on tente de nettoyer le nom de la table
        						$res_strr = strrchr($col_brute, ".");
        						$col_nettoyee = ($res_strr !== false) ? substr($res_strr, 1) : $col_brute;
        						$valeur_brute = $tab[$i][$col_nettoyee] ?? '';
    						}

    						// On passe le nom court à col_displaying pour qu'il sache comment formater
    						$res_strr_fmt = strrchr($col_brute, ".");
    						$col_format = ($res_strr_fmt !== false) ? substr($res_strr_fmt, 1) : $col_brute;
    
    						$export_data[$i+1][$j+1] = col_displaying($col_format, $valeur_brute);

    						$template->assign_block_vars('r_resa.tab_resa.group.list.cols', array(
        						'CLASS' => $class,
        						'TITLE' => $export_data[$i+1][$j+1],
    						));
							$j++;
						}

						// Préparation de l'affichage des resa
						$req1 = new db_use;
						$requete = "SELECT ".TAB_RESA.".*,
					  	".TAB_USERS.".nom,
					  	".TAB_USERS.".prenom
						FROM ".TAB_RESA."
					  	LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_RESA.".user_id
						WHERE ".RESA_HARDID."='".($tab[$i]['id'] ?? '')."' AND (
						(date_deb >= ".mktime(0,0,0,date("n"),date("j"),date("Y"))." AND date_deb <= ".mktime(23,59,59,date("n"),date("j")+11,date("Y")).") OR
						(date_fin >= ".mktime(0,0,0,date("n"),date("j"),date("Y"))." AND date_fin <= ".mktime(23,59,59,date("n"),date("j")+11,date("Y")).") OR
						(date_deb < ".mktime(0,0,0,date("n"),date("j"),date("Y"))." AND date_fin > ".mktime(23,59,59,date("n"),date("j")+11,date("Y"))."))
						ORDER BY date_deb ASC";
						$tab_resa = $req1->db_use_query($requete);

						$resa = array();
						$style = array();

						$k = 0;
						while ($k < count($tab_resa))
						{
							$rel = new dateOp(date("d/m/Y 00:00:00"));
							$diff = $rel->DiffenrenceEntreDate(date("d/m/Y H:i:s",$tab_resa[$k]["date_deb"]));
							$diff_deb = ceil(neg_to_zero(-$diff["joursTotal"]));
							$diff = $rel->DiffenrenceEntreDate(date("d/m/Y H:i:s",$tab_resa[$k]["date_fin"]));
							$diff_fin = floor(-$diff["joursTotal"]);

							$a_user = aff_users($tab_resa[$k]["nom"].' '.$tab_resa[$k]["prenom"],$tab_resa[$k]["user_id"],$lang["hard_user_noref"],$lang["none"]);
							$a_object = (($tab_resa[$k]["object"] != '')?('<i>('.addslashes(htmlspecialchars($tab_resa[$k]["object"])).')</i><br />'):('<br />'));

							//Jours incomplets
							// Si resa moins d'une journée
							if ($diff_deb-1 == $diff_fin)
							{
								if (!isset($resa[$diff_deb-1]))
									$resa[$diff_deb-1] = '';

								$resa[$diff_deb-1] .= date("H:i", $tab_resa[$k]["date_deb"]).'>'.date("H:i", $tab_resa[$k]["date_fin"]).': '.$a_user.' '.$a_object;
								$style[$diff_deb-1] = 'background-color:lightblue;';
							}
							else
							{
								if (!isset($resa[$diff_deb-1]))
									$resa[$diff_deb-1] = '';

								if (!isset($resa[$diff_fin]))
									$resa[$diff_fin] = '';

								$resa[$diff_deb-1] .= date("H:i", $tab_resa[$k]["date_deb"]).'>23:59: '.$a_user.' '.$a_object;
								$style[$diff_deb-1] = 'background-color:lightblue;';
								$resa[$diff_fin] .= '00:00>'.date("H:i", $tab_resa[$k]["date_fin"]).': '.$a_user.' '.$a_object;
								$style[$diff_fin] = 'background-color:lightblue;';
							}

							// Jours pleins
							while ($diff_deb < $diff_fin)
							{
								$resa[$diff_deb] = $lang["reserv_complday"].' - '.$a_user.' '.$a_object;
								$style[$diff_deb] = 'background-color:gold;';
								$diff_deb++;
							}


							$k++;
						}

						$k = 0;
						while ($k < 12)
						{
							// S'il n'y a pas de resa sur le jour courant
							if (!isset($resa[$k]))
							{
								$style[$k] = '';
								$resa[$k] = '';
							}

							$template->assign_block_vars('r_resa.tab_resa.group.list.next', array(
								'STYLE' => $style[$k],
								'DAY_BULLE' => day_conv3(date("D", mktime(0,0,0,date("m"),date("j")+$k,date("Y")))),
								'DATE_BULLE' => date("d/m", mktime(0,0,0,date("m"),date("j")+$k,date("Y"))),
								'RESA' => txt_to_na($resa[$k]),
								'DAY' => day_conv3(date("D", mktime(0,0,0,date("m"),date("j")+$k,date("Y")))),
								'DATE' => date("d/m", mktime(0,0,0,date("m"),date("j")+$k,date("Y")))
							));
							$k++;
						}

						$template->assign_block_vars('r_resa.tab_resa.group.list.tools', array(
							'LINK' => 'index.php?page=reservations.php&amp;action=Gerer&amp;agence_id='.intval($_GET["agence_id"]).'&amp;hard_id='.($tab[$i]['id'] ?? '').'&amp;mois='.date('n').'&amp;annee='.date("Y"),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
							'TITLE' => $lang["resa_manage"]
						));

						$template->assign_block_vars('r_resa.tab_resa.group.list.tools', array(
							'LINK' => 'index.php?page=visu_fiche.php&amp;type=hard&amp;id='.($tab[$i]['id'] ?? '').'&amp;action=visu&amp;agence_id='.intval($_GET["agence_id"]),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
							'TITLE' => $lang["see"]
						));

						$template->assign_block_vars('r_resa.tab_resa.group.list.tools', array(
							'LINK' => 'index.php?page=reservations.php&amp;action=view&amp;full_page=yes&amp;agence_id='.intval($_GET["agence_id"]).'&amp;hard_id='.($tab[$i]['id'] ?? '').'&amp;week='.date('W').'&amp;annee='.date("Y"),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/impr.gif',
							'TITLE' => $lang["resa_printable"]
						));

						$i++;
					}
				}
				// Si on a aucun résultat
				else
				{
					$template->assign_block_vars('r_resa.no_resa', array(
						'TEXT' => $lang["no_resa"]
					));
				}

				// Bouton de gestion de l'affichage
				$template->assign_block_vars('r_resa.display', array(
					'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"].'&amp;subcat=hard',
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
					'TEXT' => $lang["gen_admindisplay"]
				));

			}
			elseif (isset($_GET["sscat"]) && $_GET["sscat"] == 'periph')
			{
				(trim($cols_groupcol[$_GET["sscat"]]) != '')?($sql_groupcol = $cols_groupcol[$_GET["sscat"]].','):($sql_groupcol = '');
				$requete = "SELECT ".TAB_PERIPH.".*,
				".TAB_PERIPH_TYPE.".libelle AS periph_type_libelle,
				".TAB_PERIPH_MARQUE.".libelle AS periph_marque_libelle,
				".TAB_PERIPH_MODELE.".libelle AS periph_modele_libelle,
				".TAB_HARD.".".HA_NAME." AS hard_name
				FROM ".TAB_PERIPH."
				  LEFT JOIN ".TAB_PERIPH_TYPE." ON ".TAB_PERIPH_TYPE.".id = ".TAB_PERIPH.".type_id
				  LEFT JOIN ".TAB_PERIPH_MARQUE." ON ".TAB_PERIPH_MARQUE.".id = ".TAB_PERIPH.".marque_id
				  LEFT JOIN ".TAB_PERIPH_MODELE." ON ".TAB_PERIPH_MODELE.".id = ".TAB_PERIPH.".modele_id
				  LEFT JOIN ".TAB_HARD." ON ".TAB_HARD.".".HA_ID." = ".TAB_PERIPH.".".PE_HARDID."
				WHERE ".TAB_PERIPH.".agence_id='".intval($_GET["agence_id"])."' AND ".TAB_PERIPH.".reservable<>'0'
				AND ".TAB_PERIPH.".suivi_rebus=''
				ORDER BY ".$sql_groupcol." ".$tri;

				$prefixe = "1";
				$tab_brut = $req1->db_use_query($requete,$prefixe);
				$tab = array();

				foreach ($tab_brut as $i => $ligne) {
    				foreach ($ligne as $cle => $valeur) {
        				$cle_nettoyee = str_replace($prefixe . '.', '', $cle);
        				$tab[$i][$cle_nettoyee] = $valeur;
    				}
				}

				// PERIPHERIQUE
				if (count($tab) > 0)
				{
					$template->assign_block_vars('r_resa.tab_resa', array(
						'NBCOLS' => count($cols_display["periph"])+13,
					));

					$i = 0;
					while ($i < count($tab))
					{
						// 1. On prépare la clé de comparaison (nettoyée)
    					$group_key_raw = substr(strrchr($cols_groupcol[$_GET["sscat"]], "."), 1) ?: $cols_groupcol[$_GET["sscat"]];
    					$group_key_raw = str_replace('1.', '', $group_key_raw);
    
    					// 2. On détermine la valeur actuelle et la valeur précédente pour détecter le changement
    					$valeur_actuelle = $tab[$i][$group_key_raw] ?? ($tab[$i]['periph_type_libelle'] ?? '');
    					$valeur_precedente = ($i > 0) ? ($tab[$i-1][$group_key_raw] ?? ($tab[$i-1]['periph_type_libelle'] ?? '')) : null;

    					// 3. Si c'est le premier passage ou si la valeur a changé, on affiche l'en-tête
    					if ($i == 0 || (trim($cols_groupcol[$_GET["sscat"]]) != '' && $valeur_actuelle != $valeur_precedente))
    					{
        					$template->assign_block_vars('r_resa.tab_resa.group', array(
            					'LANG_TOOLS' => $lang["tools"]
        					));

        					if (trim($cols_groupcol[$_GET["sscat"]]) != '')
							{
    							// On cherche le mot clé dans la colonne de groupage pour choisir le bon libellé
    							if (strpos($cols_groupcol[$_GET["sscat"]], 'type') !== false) {
        							$display_title = $tab[$i]['periph_type_libelle'] ?? '';
    							} elseif (strpos($cols_groupcol[$_GET["sscat"]], 'marque') !== false) {
        							$display_title = $tab[$i]['periph_marque_libelle'] ?? '';
    							} elseif (strpos($cols_groupcol[$_GET["sscat"]], 'modele') !== false) {
        							$display_title = $tab[$i]['periph_modele_libelle'] ?? '';
    							} else {
        							// Pour les autres champs (Nom, SN...), on nettoie la clé SQL pour lire le tableau
        							$group_key_clean = substr(strrchr($cols_groupcol[$_GET["sscat"]], "."), 1) ?: $cols_groupcol[$_GET["sscat"]];
        							// On enlève le préfixe si jamais il reste un "1." ou "2."
        							$group_key_clean = str_replace('1.', '', $group_key_clean);
        							$group_key_clean = str_replace('2.', '', $group_key_clean);
        
        							$display_title = $tab[$i][$group_key_clean] ?? '';
    							}

    							$template->assign_block_vars('r_resa.tab_resa.group.head', array(
        							'TITLE' => txt_to_na($display_title),
    							));
							}


        					$template->assign_block_vars('r_resa.tab_resa.group.head2', array());

							$j = 0;
							while ($j < count($cols_display['periph']))
							{
								$export_data[0][$j+1] = $lang["s_".$cols_display['periph'][$j]] ?? $cols_display['periph'][$j];
								$template->assign_block_vars('r_resa.tab_resa.group.head2.cols', array(
									'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display['periph'][$j],
									'TITLE' => $export_data[0][$j+1],
								));

								$j++;
							}
						}

						if (isset($_GET["highlight_id"]) && $_GET["highlight_id"] == ($tab[$i]['id'] ?? ''))
							$class_row = 'highlight';
						else
							$class_row = 'liste';

						$export_data[$i+1][0] = txt_to_na($tab[$i]['periph_type_libelle'] ?? '');

						$class = ($i % 2 == 0) ? 'couleur1' : 'couleur2';
						$template->assign_block_vars('r_resa.tab_resa.group.list', array(
							'CLASS' => $class,
							'CLASS_ROW' => $class_row,
							'ANCHOR' => 'anchor'.($tab[$i]['id'] ?? ''),
						));

						// Affichage des colonnes //
						$j = 0;
						while ($j < count($cols_display["periph"]))
						{
    						$col_brute = $cols_display["periph"][$j] ?? '';

							if ($col_brute == '') {
        					$j++;
        					continue;
    						}

    						// On détermine quelle clé de $tab utiliser en fonction du nom de la colonne configurer
    						if (strpos($col_brute, 'pe_type.libelle') !== false) {
                				$valeur_brute = $tab[$i]['periph_type_libelle'] ?? '';
							} elseif (strpos($col_brute, 'ha_marque.libelle') !== false) {
        						$valeur_brute = $tab[$i]['periph_marque_libelle'] ?? '';
    						} elseif (strpos($col_brute, 'pe_modele.libelle') !== false) {
        						$valeur_brute = $tab[$i]['periph_modele_libelle'] ?? '';
    						} elseif (strpos($col_brute, 'peripherique.nom') !== false) {
        						$valeur_brute = $tab[$i]['nom'] ?? '';
    						} elseif (strpos($col_brute, 'hardware.nom') !== false) {
        						$valeur_brute = $tab[$i]['hard_nom'] ?? '';
    						} elseif (strpos($col_brute, 'num_serie') !== false) {
        						$valeur_brute = $tab[$i]['num_serie'] ?? '';
    						} elseif (strpos($col_brute, 'commentaire') !== false) {
        						$valeur_brute = $tab[$i]['commentaire'] ?? '';
    						} elseif (strpos($col_brute, 'creation_date') !== false) {
        						$valeur_brute = $tab[$i]['creation_date'] ?? '';
    						} else {
        						// Au cas où : on tente de nettoyer le nom de la table
        						$res_strr = strrchr($col_brute, ".");
        						$col_nettoyee = ($res_strr !== false) ? substr($res_strr, 1) : $col_brute;
        						$valeur_brute = $tab[$i][$col_nettoyee] ?? '';
    						}

    						// On passe le nom court à col_displaying pour qu'il sache comment formater
    						$res_strr_fmt = strrchr($col_brute, ".");
    						$col_format = ($res_strr_fmt !== false) ? substr($res_strr_fmt, 1) : $col_brute;
    
    						$export_data[$i+1][$j+1] = col_displaying($col_format, $valeur_brute);

    						$template->assign_block_vars('r_resa.tab_resa.group.list.cols', array(
        						'CLASS' => $class,
        						'TITLE' => $export_data[$i+1][$j+1],
    						));
							$j++;
						}

						// Préparation de l'affichage des resa
						$req1 = new db_use;
						$requete = "SELECT ".TAB_RESA.".*,
						  ".TAB_USERS.".nom,
						  ".TAB_USERS.".prenom
						FROM ".TAB_RESA."
						  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_RESA.".user_id
						WHERE ".RESA_PERIPHID."='".($tab[$i]['id'] ?? '')."' AND (
							(date_deb >= ".mktime(0,0,0,date("n"),date("j"),date("Y"))." AND date_deb <= ".mktime(23,59,59,date("n"),date("j")+11,date("Y")).") OR
							(date_fin >= ".mktime(0,0,0,date("n"),date("j"),date("Y"))." AND date_fin <= ".mktime(23,59,59,date("n"),date("j")+11,date("Y")).") OR
							(date_deb < ".mktime(0,0,0,date("n"),date("j"),date("Y"))." AND date_fin > ".mktime(23,59,59,date("n"),date("j")+11,date("Y"))."))
						ORDER BY date_deb ASC";
						$tab_resa = $req1->db_use_query($requete);

						$resa = array();
						$style = array();

						$k = 0;
						while ($k < count($tab_resa))
						{
							$rel = new dateOp(date("d/m/Y 00:00:00"));
							$diff = $rel->DiffenrenceEntreDate(date("d/m/Y H:i:s",$tab_resa[$k]["date_deb"]));
							$diff_deb = ceil(neg_to_zero(-$diff["joursTotal"]));
							$diff = $rel->DiffenrenceEntreDate(date("d/m/Y H:i:s",$tab_resa[$k]["date_fin"]));
							$diff_fin = floor(-$diff["joursTotal"]);

							$a_user = aff_users($tab_resa[$k]["nom"].' '.$tab_resa[$k]["prenom"],$tab_resa[$k]["user_id"],$lang["hard_user_noref"],$lang["none"]);
							$a_object = (($tab_resa[$k]["object"] != '')?('<i>('.addslashes(htmlspecialchars($tab_resa[$k]["object"])).')</i><br />'):('<br />'));

							// Jours incomplets
							// Si resa moins d'une journée
							if ($diff_deb-1 == $diff_fin)
							{
								if (!isset($resa[$diff_deb-1]))
									$resa[$diff_deb-1] = '';

								$resa[$diff_deb-1] .= date("H:i", $tab_resa[$k]["date_deb"]).'>'.date("H:i", $tab_resa[$k]["date_fin"]).': '.$a_user.' '.$a_object;
								$style[$diff_deb-1] = 'background-color:lightblue;';
							}
							else
							{
								if (!isset($resa[$diff_deb-1]))
									$resa[$diff_deb-1] = '';

								if (!isset($resa[$diff_fin]))
									$resa[$diff_fin] = '';

								$resa[$diff_deb-1] .= date("H:i", $tab_resa[$k]["date_deb"]).'>23:59: '.$a_user.' '.$a_object;
								$style[$diff_deb-1] = 'background-color:lightblue;';
								$resa[$diff_fin] .= '00:00>'.date("H:i", $tab_resa[$k]["date_fin"]).': '.$a_user.' '.$a_object;
								$style[$diff_fin] = 'background-color:lightblue;';
							}

							// Jours pleins
							while ($diff_deb < $diff_fin)
							{
								$resa[$diff_deb] = $lang["reserv_complday"].' - '.$a_user.' '.$a_object;
								$style[$diff_deb] = 'background-color:gold;';
								$diff_deb++;
							}


							$k++;
						}

						$k = 0;
						while ($k < 12)
						{
							// S'il n'y a pas de resa sur le jour courant
							if (!isset($resa[$k]))
							{
								$style[$k] = '';
								$resa[$k] = '';
							}

							$template->assign_block_vars('r_resa.tab_resa.group.list.next', array(
								'STYLE' => $style[$k],
								'DAY_BULLE' => day_conv3(date("D", mktime(0,0,0,date("m"),date("j")+$k,date("Y")))),
								'DATE_BULLE' => date("d/m", mktime(0,0,0,date("m"),date("j")+$k,date("Y"))),
								'RESA' => txt_to_na($resa[$k]),
								'DAY' => day_conv3(date("D", mktime(0,0,0,date("m"),date("j")+$k,date("Y")))),
								'DATE' => date("d/m", mktime(0,0,0,date("m"),date("j")+$k,date("Y")))
							));
							$k++;
						}

						$template->assign_block_vars('r_resa.tab_resa.group.list.tools', array(
							'LINK' => 'index.php?page=reservations.php&amp;action=Gerer&amp;agence_id='.intval($_GET["agence_id"]).'&amp;periph_id='.($tab[$i]['id'] ?? '').'&amp;mois='.date('n').'&amp;annee='.date("Y"),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
							'TITLE' => $lang["resa_manage"]
						));

						$template->assign_block_vars('r_resa.tab_resa.group.list.tools', array(
							'LINK' => 'index.php?page=visu_fiche.php&amp;type=periph&amp;id='.($tab[$i]['id'] ?? '').'&amp;action=visu&amp;agence_id='.intval($_GET["agence_id"]),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
							'TITLE' => $lang["see"]
						));

						$template->assign_block_vars('r_resa.tab_resa.group.list.tools', array(
							'LINK' => 'index.php?page=reservations.php&amp;action=view&amp;full_page=yes&amp;agence_id='.intval($_GET["agence_id"]).'&amp;periph_id='.($tab[$i]['id'] ?? '').'&amp;week='.date('W').'&amp;annee='.date("Y"),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/impr.gif',
							'TITLE' => $lang["resa_printable"]
						));

						$i++;
					}
				}
				// Si on a aucun résultat
				else
				{
					$template->assign_block_vars('r_resa.no_resa', array(
						'TEXT' => $lang["no_resa"]
					));
				}
				$template->assign_block_vars('r_resa.display', array(
					'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"].'&amp;subcat=periph',
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
					'TEXT' => $lang["gen_admindisplay"]
				));

			}

		}

		/*********************************************/
		/*           		DOCUMENTS                */
		/*********************************************/
		elseif ($_GET["rubrique"] == "docs")
		{
			// Init de la rubrique
			$template->assign_block_vars('r_docs', array());

			if (PARAM_HELP == 1)
			{
				$template->assign_block_vars('r_docs.help', array(
					'IMG_TITLE' => $lang["gen_help"],
					'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
					'GENERAL_HELP' => $lang["help"][11]
				));
			}

			if (isset($_GET["filtre_type_doc"]) && $_GET["filtre_type_doc"] != '') {
        		$filtre_type_doc = " AND ".TAB_DOCS.".type_id='".intval($_GET["filtre_type_doc"])."'";
    		} else {
        		$filtre_type_doc = "";
    		}
			
			if (isset($_GET["archive"]) && $_GET["archive"] == "1")
				$suivi_archive = "";
			else 
				$suivi_archive = " AND (" . TAB_DOCS . "." . DO_DATEARCHIVE . " = '0000-00-00' 
                       			   OR " . TAB_DOCS . "." . DO_DATEARCHIVE . " IS NULL 
                                   OR " . TAB_DOCS . "." . DO_DATEARCHIVE . " > CURRENT_DATE)";

			(trim($cols_groupcol) != '')?($sql_groupcol = $cols_groupcol.','):($sql_groupcol = '');
			$requete = "SELECT ".TAB_DOCS.".*,
			  ".TAB_ENTREPRISE.".".EN_COMPANYNAME." AS entreprise_name,
			  ".TAB_DOCS_TYPE.".".DO_TY_LIBELLE." AS type_libelle
			  FROM ".TAB_DOCS."
			    LEFT JOIN ".TAB_ENTREPRISE." ON ".TAB_DOCS.".entreprise_id = ".TAB_ENTREPRISE.".id
			    LEFT JOIN ".TAB_DOCS_TYPE." ON ".TAB_DOCS.".type_id = ".TAB_DOCS_TYPE.".id
			  WHERE ".TAB_DOCS.".".DO_SITEID."='".intval($_GET["agence_id"])."'".$suivi_archive."
			  ORDER BY ".$sql_groupcol." ".$tri;
			
			  
			$prefixe = "1";
    		$tab_brut = $req1->db_use_query($requete, $prefixe);
    		$tab = array();

    		// Nettoyage des clés (pour supporter le groupage dynamique comme dans periph)
    		foreach ($tab_brut as $idx => $ligne) {
        		foreach ($ligne as $cle => $valeur) {
            		$cle_nettoyee = str_replace($prefixe . '.', '', $cle);
            		$tab[$idx][$cle_nettoyee] = $valeur;
        		}
    		}

			if (count($tab) > 0)
			{
				// On récupère l'adresse actuelle d'ou l'on supprime le critère de tri
				$page_tri = str_replace('&','&amp;',preg_replace("{&tri=".@$tri."}","",$_SERVER['REQUEST_URI']));

				$template->assign_block_vars('r_docs.tab_docs', array(
					'PAGE_TRI' => $page_tri,
					'NBCOLS' => count($cols_display)+1,
				));

				// Init du tableau d'export
				$export_data = array();
				$export_data[0][0] = $lang["docs_type"];

				$i = 0;
				while ($i < count($tab))
				{
					// 1. Détermination de la clé de groupage
            		$group_key_raw = substr(strrchr($cols_groupcol, "."), 1) ?: $cols_groupcol;
            		$group_key_raw = str_replace('1.', '', $group_key_raw);

            		// 2. Détection du changement de groupe
            		$valeur_actuelle = $tab[$i][$group_key_raw] ?? ($tab[$i]['type_libelle'] ?? '');
            		$valeur_precedente = ($i > 0) ? ($tab[$i-1][$group_key_raw] ?? ($tab[$i-1]['type_libelle'] ?? '')) : null;

            		if ($i == 0 || (trim($cols_groupcol) != '' && $valeur_actuelle != $valeur_precedente))
            		{
                		$template->assign_block_vars('r_docs.tab_docs.group', array(
                    		'LANG_TOOLS' => $lang["tools"]
                		));

                		if (trim($cols_groupcol) != '')
                		{
                    		if (strpos($cols_groupcol, 'type') !== false) {
                        		$display_title = $tab[$i]['type_libelle'] ?? '';
                    		} elseif (strpos($cols_groupcol, 'entreprise') !== false) {
                        		$display_title = $tab[$i]['entreprise_name'] ?? '';
                    		} else {
                        		$group_key_clean = substr(strrchr($cols_groupcol, "."), 1) ?: $cols_groupcol;
                        		$group_key_clean = str_replace(['1.', '2.'], '', $group_key_clean);
                        		$display_title = $tab[$i][$group_key_clean] ?? '';
                    		}

                    		$template->assign_block_vars('r_docs.tab_docs.group.head', array(
                        		'TITLE' => txt_to_na($display_title),
                    		));
                		}

                		$template->assign_block_vars('r_docs.tab_docs.group.head2', array());

                		$j = 0;
                		while ($j < count($cols_display))
                		{
                    		$export_data[0][$j+1] = $lang["s_".$cols_display[$j]] ?? $cols_display[$j];
                    		$template->assign_block_vars('r_docs.tab_docs.group.head2.cols', array(
                        		'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display[$j],
                        		'TITLE' => $export_data[0][$j+1],
                    		));
                    		$j++;
                		}
            		}


					/*************   DEBUT Liste des documents   *************/
					if (isset($_GET["highlight_id"]) && $_GET["highlight_id"] == ($tab[$i]['id'] ?? ''))
						$class_row = 'highlight';
					else
						$class_row = 'liste';

					if (($tab[$i][DO_DATEARCHIVE] ?? '') != '' && ($tab[$i][DO_DATEARCHIVE] ?? 0) < time())
						$class = "row_spec";
					else
						$class = "row1";

					$export_data[$i+1][0] = txt_to_na($tab[$i]['type_libelle'] ?? '');

					$template->assign_block_vars('r_docs.tab_docs.group.list', array(
					  'ANCHOR' => 'anchor'.($tab[$i]['id'] ?? ''),
					  'CLASS_ROW' => $class_row,
					  'CLASS' => $class,
					));

					$j = 0;
					while ($j < count($cols_display))
					{
						$col_brute = $cols_display[$j];
						if (strpos($col_brute, 'docs_type.libelle') !== false) {
							$valeur_brute = $tab[$i]['type_libelle'] ?? '';
						} elseif (strpos($col_brute, 'entreprise.'.EN_COMPANYNAME) !== false) {
							$valeur_brute = $tab[$i]['entreprise_name'] ?? '';
						} else {
							$col_nettoyee = substr(strrchr($col_brute, "."), 1) ?: $col_brute;
							$valeur_brute = $tab[$i][$col_nettoyee] ?? '';
						}

						$export_data[$i+1][$j+1] = col_displaying($col_brute, $valeur_brute);

						$template->assign_block_vars('r_docs.tab_docs.group.list.cols', array(
							'TITLE' => $export_data[$i+1][$j+1],
						));

						$j++;
					}

					/************** Outils ********************/
					if (is_file('data/'.($tab[$i][DO_SITEID] ?? '').'/'.($tab[$i][DO_PATH] ?? '')))
					{
						$ext = strtolower(substr(strrchr($tab[$i][DO_PATH] ?? '', '.'), 1));

						$template->assign_block_vars('r_docs.tab_docs.group.list.tools', array(
							'LINK' => 'data/'.($tab[$i][DO_SITEID] ?? '').'/'.($tab[$i][DO_PATH] ?? ''),
							'IMAGE' => (is_file('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'))?('templates/'.DEFAULT_TEMPLATE.'/images/file_'.$ext.'.png'):('templates/'.DEFAULT_TEMPLATE.'/images/file_.png'),
							'TITLE' => $lang["docs_viewfile"].($tab[$i][DO_PATH] ?? '')
						));
					}

					// Visualiser la fiche
					$template->assign_block_vars('r_docs.tab_docs.group.list.tools', array(
						'LINK' => 'index.php?page=visu_fiche.php&amp;type=docs&amp;id='.($tab[$i]['id'] ?? '').'&amp;action=visu',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
						'TITLE' => $lang["docs_detail"]
					));

					// Edition
					if (preg_match('`;'.RGHT_HARD_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_docs.tab_docs.group.list.tools', array(
							'LINK' => 'index.php?page=adm_docs.php&amp;action=edit&amp;id='.($tab[$i]['id'] ?? '').'&amp;agence_id='.intval(intval($_GET["agence_id"])),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
							'TITLE' => $lang["edit"]
						));
					}
					// Supprimer le document
					if (preg_match('`;'.RGHT_DOCS_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
					{
						$template->assign_block_vars('r_docs.tab_docs.group.list.tools', array(
							'LINK' => 'index.php?page=adm_docs.php&amp;action=del&amp;id='.($tab[$i]['id'] ?? ''),
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
							'TITLE' => $lang["delete"]
						));
					}

					$i++;
				}

			}
			// Si on n'a aucun résultat
			else
			{
					$template->assign_block_vars('r_docs.no_docs', array(
						'TEXT' => $lang["docs_no_doc"]
					));
			}
			/*************   FIN Liste des documents   *************/

			/*************   DEBUT Outils généraux   *************/
			// Ajout de doc
			if (preg_match('`;'.RGHT_DOCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('r_docs.add', array(
					'LINK' => 'index.php?page=adm_docs.php&amp;action=add&amp;agence_id='.intval($_GET["agence_id"]),
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add.gif',
					'TEXT' => $lang["add"]
				));
			}

			// Export Excel
			if (count($tab) > 0)
			{
				$serialized_string = base64_encode(serialize($export_data));
				$template->assign_block_vars('r_docs.export', array(
					'NOM' => $lang["docs_list"],
					'LINK' => 'window.document.formexport.submit()',
					'DATA' => $serialized_string,
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/excel.gif',
					'TEXT' => $lang["excel_export"]
				));
			}
			// Bouton de gestion de l'affichage
			$template->assign_block_vars('r_docs.display', array(
				'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"],
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
				'TEXT' => $lang["gen_admindisplay"]
			));

			// Bouton d'affichage des rebuts
			if (isset($_GET["archive"]) && $_GET["archive"] == "1")
			{

				$template->assign_block_vars('r_docs.archive', array(
					'LINK' => str_replace('&amp;archive=1','',str_replace("&","&amp;",$_SERVER['REQUEST_URI'])),
					'TEXT' => $lang["docs_hide_archive"]
				));
			}
			else
			{
				$template->assign_block_vars('r_docs.archive', array(
					'LINK' => str_replace("&","&amp;",$_SERVER['REQUEST_URI'].'&archive=1'),
					'TEXT' => $lang["docs_show_archive"]
				));
			}

			/*************   FIN Outils généraux   *************/
		}

		/*********************************************/
		/*               Module OCS                  */
		/*********************************************/
		elseif ($_GET["rubrique"] == "ocs" && OCS_INSTALL == "Oui")
		{
			// Init de l'url "basique"
			$page_url = preg_replace("{&sscat=".@$_GET["sscat"]."}","",urldecode($_SERVER['REQUEST_URI']));
			$page_url = str_replace('&','&amp;',preg_replace("{&filtre=".@$_GET["filtre"]."}","",$page_url));

			// On récupère l'adresse actuelle d'ou l'on supprime le critère de tri
			$page_tri = preg_replace("{&tri=".@$_GET["tri"]."}","",$_SERVER['REQUEST_URI']);
			$page_tri = str_replace("&","&amp;",$page_tri);

			// Init de la rubrique
			$template->assign_block_vars('r_ocs', array(
			));

			// Test OCS
			if ((preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && OCS_INSTALL == "Oui")
			{
				$err_ocs = $connect->test_cnx(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

				if (!DEFINED("OCS_CRIT_OCS".intval($_GET["agence_id"])) != '')
				{
					array_push($err_ocs,2);
				}

			}

			if (count($err_ocs) > 0)
			{
				$errors = $lang["gen_warning"].'<br/>';

				while(list($key, $val) = each($err_ocs))
				{
					$aff_key = $key+1;
					$errors .= txt_to_na($lang["error_mysql_cnx_".$val]).'<br />';
				}

				$template->assign_block_vars('r_ocs.ocs_error', array(
				  'TEXT' => $errors
				));
			}
			else
			{

				$connect->connection();

				// Cherche le matériel uniquement dans le site en cours
				// On prépare la table matériel pour comparaison avec ocs
				$requete_hard = "SELECT * FROM ".TAB_HARD." WHERE agence_id='".intval($_GET["agence_id"])."'";
				$tab_hard = $req1->db_use_query($requete_hard);

				$i = 0;
				$comp_ocs = array();
				$comp_id = array();
				while($i < count($tab_hard))
				{
					array_push($comp_ocs,$tab_hard[$i][@constant("OCS_CRIT_BASE".intval($_GET["agence_id"]))]);
					array_push($comp_id,$tab_hard[$i]["id"]);
					$i++;
				}

				if (MULTISITE == "Oui" && defined("OCS_CRIT_BASE".intval($_GET["agence_id"])))
				{
					// Cherche le matériel dans tous les sites
					$requete_hard_all = "SELECT * FROM ".TAB_HARD;
					$tab_hard_all = $req1->db_use_query($requete_hard_all);

					$i = 0;
					$comp_all_ocs = array();
					$comp_all_id = array();
					while($i < count($tab_hard_all))
					{
						array_push($comp_all_ocs,$tab_hard_all[$i][constant("OCS_CRIT_BASE".intval($_GET["agence_id"]))]);
						array_push($comp_all_id,$tab_hard_all[$i]["id"]);
						$i++;
					}
				}

				// Connexion à la base OCS
				$connect_ocs = new db_connect();
				$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

				$requete = "SELECT ".TAB_OCS_HARD.".*,
				".TAB_OCS_BIOS.".".COL_OCS_BIOS_SNUM.",
				".TAB_OCS_BIOS.".".COL_OCS_BIOS_TYPE." AS biostype
				FROM ".TAB_OCS_HARD."
				  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
				WHERE ".CONSTANT("OCS_MASK_TYPE".intval($_GET["agence_id"]))." LIKE '".str_replace('*','%',CONSTANT("OCS_MASK".intval($_GET["agence_id"])))."'";
				$tab = $req1->db_use_query_inv($requete,1);

				if (isset($tab[TAB_OCS_HARD.".".COL_OCS_HARD_ID][0]))
				{
					if ($_GET["sscat"] == 'hard')
					{

						/* Début Menu type de matériel */
						$requete = "SELECT ".TAB_OCS_HARD.".*,
						  ".TAB_OCS_BIOS.".".COL_OCS_BIOS_TYPE." AS biostype,
						  count(*) AS nb
						FROM ".TAB_OCS_HARD."
						  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
						WHERE ".TAB_OCS_BIOS.".".COL_OCS_BIOS_TYPE."<>'' AND ".CONSTANT("OCS_MASK_TYPE".intval($_GET["agence_id"]))." LIKE '".str_replace('*','%',CONSTANT("OCS_MASK".intval($_GET["agence_id"])))."'
						GROUP BY ".TAB_OCS_BIOS.".".COL_OCS_BIOS_TYPE;
						$tab_menu = $req1->db_use_query($requete);

						/* Début affichage liste matériel */
						if (isset($_GET["filtre"]) && $_GET["filtre"] != '')
							$filtre = " AND ".TAB_OCS_BIOS.".".COL_OCS_BIOS_TYPE."='".$req1->connection->real_escape_string(urldecode($_GET["filtre"]))."'";
						else
							$filtre = '';

						$requete = "SELECT ".TAB_OCS_HARD.".*,
						".TAB_OCS_BIOS.".*
						FROM ".TAB_OCS_HARD."
						  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
						WHERE ".CONSTANT("OCS_MASK_TYPE".intval($_GET["agence_id"]))." LIKE '".str_replace('*','%',CONSTANT("OCS_MASK".intval($_GET["agence_id"])))."' ".$filtre."
						ORDER BY ".$tri;
						$tab_filtre = $req1->db_use_query_inv($requete,1);

						/********************** DEBUT En-tetes ***********************/
						$template->assign_block_vars('r_ocs.main', array(
							'PAGE_TRI' => $page_tri,
							'COL_STATUS' => $lang["ocs_status"],
							'COL_TOOLS' => $lang["tools"]
						));

						$j = 0;
						while ($j < count($cols_display["hard"]))
						{
							$export_data[0][$j+1] = $lang["s_".$cols_display["hard"][$j]] ?? $cols_display["hard"][$j];

							$template->assign_block_vars('r_ocs.main.cols', array(
								'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display["hard"][$j],
								'TITLE' => $export_data[0][$j+1],
							));

							$j++;
						}
						/*********************** FIN En-tetes ************************/

						$i = 0;
						while ($i < count($tab_filtre[TAB_OCS_HARD.".".COL_OCS_HARD_ID]))
						{
							$template->assign_block_vars('r_ocs.main.list_hard', array());

							$key = array_isearch($tab_filtre[constant("OCS_CRIT_OCS".intval($_GET["agence_id"]))][$i],$comp_ocs);
							if (MULTISITE == "Oui")
								$key_all = array_isearch($tab_filtre[constant("OCS_CRIT_OCS".intval($_GET["agence_id"]))][$i],$comp_all_ocs);

							$j = 0;
							while ($j < count($cols_display["hard"]))
							{
								if (isset($cols_display["hard"][$j]))
									$export_data[$i+1][$j+1] = col_displaying($cols_display["hard"][$j],$tab_filtre[$cols_display["hard"][$j]][$i]);
								else
									$export_data[$i+1][$j+1] = txt_to_na('');

								$template->assign_block_vars('r_ocs.main.list_hard.cols', array(
									'TITLE' => $export_data[$i+1][$j+1],
								));

								$j++;
							}

							if ($key !== NULL && $key !== FALSE)
							{
								$template->assign_block_vars('r_ocs.main.list_hard.status', array(
									'COLOR' => 'green',
									'TEXT' => $lang["ocs_hard_status_sync"]
								));

								if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
								{
									$template->assign_block_vars('r_ocs.main.list_hard.tools', array(
										'LINK' => 'index.php?page=adm_materiels.php&amp;action=sync_ocs&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab_filtre[TAB_OCS_HARD.'.'.COL_OCS_HARD_ID][$i].'&amp;h_id='.$comp_id[$key],
										'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
										'TITLE' => $lang["ocs_sync"]
									));
								}
							}
							elseif (MULTISITE == "Oui" && $key_all !== NULL && $key_all !== FALSE )
							{
								$template->assign_block_vars('r_ocs.main.list_hard.status', array(
									'COLOR' => 'orange',
									'TEXT' => $lang["ocs_hard_status_other"]
								));

								if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
								{
									$template->assign_block_vars('r_ocs.main.list_hard.tools', array(
										'LINK' => 'index.php?page=adm_materiels.php&amp;action=sync_ocs&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab_filtre[TAB_OCS_HARD.'.'.COL_OCS_HARD_ID][$i].'&amp;h_id='.$comp_all_id[$key_all],
										'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
										'TITLE' => $lang["ocs_sync"]
									));
								}
							}
							else
							{
								$template->assign_block_vars('r_ocs.main.list_hard.status', array(
									'COLOR' => 'red',
									'TEXT' => $lang["ocs_hard_status_new"]
								));

								if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
								{
									$template->assign_block_vars('r_ocs.main.list_hard.tools', array(
										'LINK' => 'index.php?page=adm_materiels.php&amp;action=add_ocs&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab_filtre[TAB_OCS_HARD.'.'.COL_OCS_HARD_ID][$i],
										'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_big.gif',
										'TITLE' => $lang["ocs_syncadd"]
									));
								}
							}

							$i++;
						}
						/* Fin affichage liste matériel */
					}

					// Preparation des requetes annexes
					$requete_soft = COL_OCS_SOFT_HARDID."='".implode("' OR ".COL_OCS_SOFT_HARDID."='",$tab[TAB_OCS_HARD.'.'.COL_OCS_HARD_ID])."'";
					$requete_monitors = COL_OCS_MON_HARDID."='".implode("' OR ".COL_OCS_MON_HARDID."='",$tab[TAB_OCS_HARD.'.'.COL_OCS_HARD_ID])."'";
					$requete_modems = COL_OCS_MODEM_HARDID."='".implode("' OR ".COL_OCS_MODEM_HARDID."='",$tab[TAB_OCS_HARD.'.'.COL_OCS_HARD_ID])."'";
					$requete_printers = COL_OCS_LPT_HARDID."='".implode("' OR ".COL_OCS_LPT_HARDID."='",$tab[TAB_OCS_HARD.'.'.COL_OCS_HARD_ID])."'";
					$requete_inputs = COL_OCS_IPT_HARDID."='".implode("' OR ".COL_OCS_IPT_HARDID."='",$tab[TAB_OCS_HARD.'.'.COL_OCS_HARD_ID])."'";



					/*************** PERIPHS ****************/

					/******* Moniteurs *******/
					if (isset($_GET["sscat"]) && $_GET["sscat"] == 'monitor')
					{
						/********************** DEBUT En-tetes ***********************/
						$template->assign_block_vars('r_ocs.main', array(
							'PAGE_TRI' => $page_tri,
							'COL_STATUS' => $lang["ocs_status"],
							'COL_TOOLS' => $lang["tools"]
						));

						$j = 0;
						while ($j < count($cols_display["monitor"]))
						{
							$export_data[0][$j+1] = $lang["s_".$cols_display["monitor"][$j]] ?? $cols_display["monitor"][$j];

							$template->assign_block_vars('r_ocs.main.cols', array(
								'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display["monitor"][$j],
								'TITLE' => $export_data[0][$j+1],
							));

							$j++;
						}
						/*********************** FIN En-tetes ************************/

						// Afficher / Masquer doublons
						if (defined("OCS_PERIPH_DBL".intval($_GET["agence_id"])) && constant("OCS_PERIPH_DBL".intval($_GET["agence_id"])) == 1)
							$dbl = " GROUP BY ".TAB_OCS_MONITOR.".".COL_OCS_MON_HARDID.", ".TAB_OCS_MONITOR.".".COL_OCS_MON_SERIAL.", ".TAB_OCS_MONITOR.".".COL_OCS_MON_TYPE;
						else
							$dbl = "";

						// Affichage de la liste
						if (!isset($_GET["filtre"]) || isset($_GET["filtre"]) && $_GET["filtre"] == '' || isset($_GET["filtre"]) && $_GET["filtre"] == 'monitor')
						{
							$requete = "SELECT ".TAB_OCS_MONITOR.".*,
							  ".TAB_OCS_HARD.".".COL_OCS_HARD_NAME."
							FROM ".TAB_OCS_MONITOR."
							  LEFT JOIN ".TAB_OCS_HARD." ON ".TAB_OCS_MONITOR.".".COL_OCS_MON_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
							WHERE (".$requete_monitors.")  AND ".COL_OCS_MON_NAME."<>''
							".$dbl."
							ORDER BY ".$tri;
							$tab = $req1->db_use_query_inv($requete,1);

							$connect_ocs->connection();

							$tab_periph = $req1->db_use_query_inv("SELECT * FROM ".TAB_PERIPH." WHERE agence_id='".intval($_GET["agence_id"])."' AND ocs_type='monitor'");
							if (MULTISITE == "Oui")
								$tab_periph_all = $req1->db_use_query_inv("SELECT * FROM ".TAB_PERIPH." WHERE ocs_type='monitor'");

							// Connexion à la base OCS
							$connect_ocs = new db_connect();
							$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

							$i = 0;
							while ($i < count($tab[TAB_OCS_MONITOR.'.'.COL_OCS_MON_ID]))
							{
								$template->assign_block_vars('r_ocs.main.list_periph', array());

								$key = $key_all = NULL;

								if (count($tab_periph) > 0)
									$key = array_isearch($tab[TAB_OCS_MONITOR.'.'.COL_OCS_MON_ID][$i],$tab_periph["ocs_id"]);
								if (MULTISITE == "Oui" && count($tab_periph_all) > 0)
									$key_all = array_isearch($tab[TAB_OCS_MONITOR.'.'.COL_OCS_MON_ID][$i],$tab_periph_all["ocs_id"]);

								$j = 0;
								while ($j < count($cols_display["monitor"]))
								{
									if (isset($cols_display["monitor"][$j]))
										$export_data[$i+1][$j+1] = col_displaying($cols_display["monitor"][$j],$tab[$cols_display["monitor"][$j]][$i]);
									else
										$export_data[$i+1][$j+1] = txt_to_na('');

									$template->assign_block_vars('r_ocs.main.list_periph.cols', array(
										'TITLE' => $export_data[$i+1][$j+1],
									));

									$j++;
								}

								if ($key !== NULL && $key !== FALSE)
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'green',
										'TEXT' => $lang["ocs_periph_status_sync"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=sync_ocs&amp;type=monitor&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[TAB_OCS_MONITOR.'.'.COL_OCS_MON_ID][$i].'&amp;p_id='.$tab_periph["id"][$key],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
											'TITLE' => $lang["ocs_sync"]
										));
									}
								}
								elseif ($key_all !== NULL && $key_all !== FALSE && MULTISITE == "Oui")
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'orange',
										'TEXT' => $lang["ocs_periph_status_other"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=sync_ocs&amp;type=monitor&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[TAB_OCS_MONITOR.'.'.COL_OCS_MON_ID][$i].'&amp;p_id='.$tab_periph_all["id"][$key_all],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
											'TITLE' => $lang["ocs_sync"]
										));
									}
								}
								else
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'red',
										'TEXT' => $lang["ocs_periph_status_new"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=add_ocs&amp;type=monitor&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[TAB_OCS_MONITOR.'.'.COL_OCS_MON_ID][$i],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_big.gif',
											'TITLE' => $lang["ocs_syncadd"]
										));
									}
								}

								$i++;
							}
						}
					}
					/**** Modems ****/
					elseif (isset($_GET["sscat"]) && $_GET["sscat"] == 'modem')
					{
						/********************** DEBUT En-tetes ***********************/
						$template->assign_block_vars('r_ocs.main', array(
							'PAGE_TRI' => $page_tri,
							'COL_STATUS' => $lang["ocs_status"],
							'COL_TOOLS' => $lang["tools"]
						));

						$j = 0;
						while ($j < count($cols_display["modem"]))
						{
							$export_data[0][$j+1] = $lang["s_".$cols_display["modem"][$j]] ?? $cols_display["modem"][$j];

							$template->assign_block_vars('r_ocs.main.cols', array(
								'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display["modem"][$j],
								'TITLE' => $export_data[0][$j+1],
							));

							$j++;
						}
						/*********************** FIN En-tetes ************************/

						// Afficher / Masquer doublons
						if (defined("OCS_PERIPH_DBL".intval($_GET["agence_id"])) && constant("OCS_PERIPH_DBL".intval($_GET["agence_id"])) == 1)
							$dbl = " GROUP BY ".TAB_OCS_MODEM.".".COL_OCS_MODEM_HARDID.", ".TAB_OCS_MODEM.".".COL_OCS_MODEM_NAME.", ".TAB_OCS_MODEM.".".COL_OCS_MODEM_TYPE;
						else
							$dbl = "";

						if (!isset($_GET["filtre"]) || isset($_GET["filtre"]) && $_GET["filtre"] == '' || isset($_GET["filtre"]) && $_GET["filtre"] == 'modem')
						{
							$connect_ocs->connection();

							$tab_periph = $req1->db_use_query_inv("SELECT * FROM ".TAB_PERIPH." WHERE agence_id='".intval($_GET["agence_id"])."' AND ocs_type='modem'");
							if (MULTISITE == "Oui")
								$tab_periph_all = $req1->db_use_query_inv("SELECT * FROM ".TAB_PERIPH." WHERE ocs_type='modem'");

							// Connexion à la base OCS
							$connect_ocs = new db_connect();
							$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

							$requete = "SELECT ".TAB_OCS_MODEM.".*,
							  ".TAB_OCS_HARD.".".COL_OCS_HARD_NAME."
							FROM ".TAB_OCS_MODEM."
							  LEFT JOIN ".TAB_OCS_HARD." ON ".TAB_OCS_MODEM.".".COL_OCS_MODEM_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
							WHERE (".$requete_modems.")  AND ".TAB_OCS_MODEM.".".COL_OCS_MODEM_NAME."<>''
							".$dbl."
							ORDER BY ".$tri;
							$tab = $req1->db_use_query_inv($requete,1);

							$i = 0;
							while ($i < count($tab[TAB_OCS_MODEM.'.'.COL_OCS_MODEM_ID]))
							{
								$template->assign_block_vars('r_ocs.main.list_periph', array());

								$key = $key_all = NULL;
								if (count($tab_periph) > 0)
									$key = array_isearch($tab[TAB_OCS_MODEM.'.'.COL_OCS_MODEM_ID][$i],$tab_periph["ocs_id"]);
								if (MULTISITE == "Oui" && count($tab_periph_all) > 0)
									$key_all = array_isearch($tab[TAB_OCS_MODEM.'.'.COL_OCS_MODEM_ID][$i],$tab_periph_all["ocs_id"]);

								$j = 0;
								while ($j < count($cols_display["modem"]))
								{
									if (isset($cols_display["modem"][$j]))
										$export_data[$i+1][$j+1] = col_displaying($cols_display["modem"][$j],$tab[$cols_display["modem"][$j]][$i]);
									else
										$export_data[$i+1][$j+1] = txt_to_na('');

									$template->assign_block_vars('r_ocs.main.list_periph.cols', array(
										'TITLE' => $export_data[$i+1][$j+1],
									));

									$j++;
								}

								if ($key !== NULL && $key !== FALSE)
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'green',
										'TEXT' => $lang["ocs_periph_status_sync"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=sync_ocs&amp;type=modem&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[TAB_OCS_MODEM.'.'.COL_OCS_MODEM_ID][$i].'&amp;p_id='.$tab_periph["id"][$key],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
											'TITLE' => $lang["ocs_sync"]
										));
									}
								}
								elseif ($key_all !== NULL && $key_all !== FALSE && MULTISITE == "Oui")
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'orange',
										'TEXT' => $lang["ocs_periph_status_other"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=sync_ocs&amp;type=modem&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[TAB_OCS_MODEM.'.'.COL_OCS_MODEM_ID][$i].'&amp;p_id='.$tab_periph_all["id"][$key_all],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
											'TITLE' => $lang["ocs_sync"]
										));
									}
								}
								else
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'red',
										'TEXT' => $lang["ocs_periph_status_new"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=add_ocs&amp;type=modem&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[TAB_OCS_MODEM.'.'.COL_OCS_MODEM_ID][$i],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_big.gif',
											'TITLE' => $lang["ocs_syncadd"]
										));
									}
								}

								$i++;
							}

						}
					}
					// Imprimantes
					elseif (isset($_GET["sscat"]) && $_GET["sscat"] == 'printer')
					{
						/********************** DEBUT En-tetes ***********************/
						$template->assign_block_vars('r_ocs.main', array(
							'PAGE_TRI' => $page_tri,
							'COL_STATUS' => $lang["ocs_status"],
							'COL_TOOLS' => $lang["tools"]
						));

						$j = 0;
						while ($j < count($cols_display["printer"]))
						{
							$export_data[0][$j+1] = $lang["s_".$cols_display["printer"][$j]] ?? $cols_display["printer"][$j];

							$template->assign_block_vars('r_ocs.main.cols', array(
								'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display["printer"][$j],
								'TITLE' => $export_data[0][$j+1],
							));

							$j++;
						}
						/*********************** FIN En-tetes ************************/

						// Afficher / Masquer doublons
						if (defined("OCS_PERIPH_DBL".intval($_GET["agence_id"])) && constant("OCS_PERIPH_DBL".intval($_GET["agence_id"])) == 1)
							$dbl = " GROUP BY ".TAB_OCS_PRINTER.".".COL_OCS_LPT_NAME.", ".TAB_OCS_PRINTER.".".COL_OCS_LPT_PORT.", ".TAB_OCS_PRINTER.".".COL_OCS_LPT_DRIVER;
						else
							$dbl = "";

						if (!isset($_GET["filtre"]) || isset($_GET["filtre"]) && $_GET["filtre"] == '' || isset($_GET["filtre"]) && $_GET["filtre"] == 'printer')
						{
							$connect_ocs->connection();

							$tab_periph = $req1->db_use_query_inv("SELECT * FROM ".TAB_PERIPH." WHERE agence_id='".intval($_GET["agence_id"])."' AND ocs_type='printer'");
							if (MULTISITE == "Oui")
								$tab_periph_all = $req1->db_use_query_inv("SELECT * FROM ".TAB_PERIPH." WHERE ocs_type='printer'");

							// Connexion à la base OCS
							$connect_ocs = new db_connect();
							$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

							$requete = "SELECT ".TAB_OCS_PRINTER.".*,
							  ".TAB_OCS_HARD.".".COL_OCS_HARD_NAME."
							FROM ".TAB_OCS_PRINTER."
							  LEFT JOIN ".TAB_OCS_HARD." ON ".TAB_OCS_PRINTER.".".COL_OCS_LPT_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
							WHERE (".$requete_printers.")  AND ".TAB_OCS_PRINTER.".".COL_OCS_LPT_NAME."<>''
							  ".$dbl."
							ORDER BY ".$tri;
							$tab = $req1->db_use_query_inv($requete,1);

							$i = 0;
							while ($i < count($tab[TAB_OCS_PRINTER.".".COL_OCS_LPT_ID]))
							{
								$template->assign_block_vars('r_ocs.main.list_periph', array());

								$key = $key_all = NULL;
								if (count($tab_periph) > 0)
									$key = array_isearch($tab[TAB_OCS_PRINTER.".".COL_OCS_LPT_ID][$i],$tab_periph["ocs_id"]);
								if (MULTISITE == "Oui" && count($tab_periph_all) > 0)
									$key_all = array_isearch($tab[TAB_OCS_PRINTER.".".COL_OCS_LPT_ID][$i],$tab_periph_all["ocs_id"]);

								$j = 0;
								while ($j < count($cols_display["printer"]))
								{
									if (isset($cols_display["printer"][$j]))
										$export_data[$i+1][$j+1] = col_displaying($cols_display["printer"][$j],$tab[$cols_display["printer"][$j]][$i]);
									else
										$export_data[$i+1][$j+1] = txt_to_na('');

									$template->assign_block_vars('r_ocs.main.list_periph.cols', array(
										'TITLE' => $export_data[$i+1][$j+1],
									));

									$j++;
								}

								if ($key !== NULL && $key !== FALSE)
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'green',
										'TEXT' => $lang["ocs_periph_status_sync"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=sync_ocs&amp;type=printer&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[TAB_OCS_PRINTER.".".COL_OCS_LPT_ID][$i].'&amp;p_id='.$tab_periph["id"][$key],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
											'TITLE' => $lang["ocs_sync"]
										));
									}
								}
								elseif ($key_all !== NULL && $key_all !== FALSE && MULTISITE == "Oui")
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'orange',
										'TEXT' => $lang["ocs_periph_status_other"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=sync_ocs&amp;type=printer&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[TAB_OCS_PRINTER.".".COL_OCS_LPT_ID][$i].'&amp;p_id='.$tab_periph_all["id"][$key_all],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
											'TITLE' => $lang["ocs_sync"]
										));
									}
								}
								else
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'red',
										'TEXT' => $lang["ocs_periph_status_new"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&amp;action=add_ocs&amp;type=printer&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[TAB_OCS_PRINTER.".".COL_OCS_LPT_ID][$i],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_big.gif',
											'TITLE' => $lang["ocs_syncadd"]
										));
									}
								}

								$i++;
							}

						}
					}
					// Inputs
					elseif (isset($_GET["sscat"]) && $_GET["sscat"] == 'input')
					{
						/********************** DEBUT En-tetes ***********************/
						$template->assign_block_vars('r_ocs.main', array(
							'PAGE_TRI' => $page_tri,
							'COL_STATUS' => $lang["ocs_status"],
							'COL_TOOLS' => $lang["tools"]
						));

						$j = 0;
						while ($j < count($cols_display["input"]))
						{
							$export_data[0][$j+1] = $lang["s_".$cols_display["input"][$j]] ?? $cols_display["input"][$j];

							$template->assign_block_vars('r_ocs.main.cols', array(
								'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display["input"][$j],
								'TITLE' => $export_data[0][$j+1],
							));

							$j++;
						}
						/*********************** FIN En-tetes ************************/

						// Afficher / Masquer doublons
						if (defined("OCS_PERIPH_DBL".intval($_GET["agence_id"])) && constant("OCS_PERIPH_DBL".intval($_GET["agence_id"])) == 1)
						{
							$dbl = " GROUP BY ".TAB_OCS_INPUT.".".COL_OCS_IPT_HARDID.", ".TAB_OCS_INPUT.".".COL_OCS_IPT_MARQUE.", ".TAB_OCS_INPUT.".".COL_OCS_IPT_TYPE.", ".TAB_OCS_INPUT.".".COL_OCS_IPT_NAME;
							$dbl_menu = " GROUP BY ".TAB_OCS_INPUT.".".COL_OCS_IPT_HARDID.", ".TAB_OCS_INPUT.".".COL_OCS_IPT_MARQUE.", ".TAB_OCS_INPUT.".".COL_OCS_IPT_TYPE.", ".TAB_OCS_INPUT.".".COL_OCS_IPT_NAME;
						}
						else
						{
							$dbl = "";
							$dbl_menu = "";
						}

						if (!isset($_GET["filtre"]) || isset($_GET["filtre"]) && $_GET["filtre"] == '' || (isset($_GET["filtre"]) && array_isearch(urldecode($_GET["filtre"]),$tab[COL_OCS_IPT_TYPE]) !== FALSE))
						{
							$connect_ocs->connection();

							$tab_periph = $req1->db_use_query_inv("SELECT * FROM ".TAB_PERIPH." WHERE agence_id='".intval($_GET["agence_id"])."' AND ocs_type='input'");
							if (MULTISITE == "Oui")
								$tab_periph_all = $req1->db_use_query_inv("SELECT * FROM ".TAB_PERIPH." WHERE ocs_type='input'");

							// Connexion à la base OCS
							$connect_ocs = new db_connect();
							$connect_ocs->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

							if (isset($_GET["filtre"]))
								$filtre = " AND ".TAB_OCS_INPUT.".".COL_OCS_IPT_TYPE."='".urldecode($_GET["filtre"])."'";
							else
								$filtre = '';

							$requete = "SELECT ".TAB_OCS_INPUT.".*,
							  ".TAB_OCS_HARD.".".COL_OCS_HARD_NAME."
							FROM ".TAB_OCS_INPUT."
							  LEFT JOIN ".TAB_OCS_HARD." ON ".TAB_OCS_INPUT.".".COL_OCS_IPT_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
							WHERE (".$requete_inputs.")  AND ".TAB_OCS_INPUT.".".COL_OCS_IPT_NAME."<>'' ".$filtre."
							".$dbl."
							ORDER BY ".$tri;
							$tab = $req1->db_use_query_inv($requete,1);

							$i = 0;
							while ($i < count($tab[TAB_OCS_INPUT.".".COL_OCS_IPT_ID]))
							{
								$template->assign_block_vars('r_ocs.main.list_periph', array());

								$key = $key_all = NULL;
								if (count($tab_periph) > 0)
									$key = array_isearch($tab[TAB_OCS_INPUT.".".COL_OCS_IPT_ID][$i],$tab_periph["ocs_id"]);
								if (MULTISITE == "Oui" && count($tab_periph_all) > 0)
									$key_all = array_isearch($tab[TAB_OCS_INPUT.".".COL_OCS_IPT_ID][$i],$tab_periph_all["ocs_id"]);

								$j = 0;
								while ($j < count($cols_display["input"]))
								{
									if (isset($cols_display["input"][$j]))
										$export_data[$i+1][$j+1] = col_displaying($cols_display["input"][$j],$tab[$cols_display["input"][$j]][$i]);
									else
										$export_data[$i+1][$j+1] = txt_to_na('');

									$template->assign_block_vars('r_ocs.main.list_periph.cols', array(
										'TITLE' => $export_data[$i+1][$j+1],
									));

									$j++;
								}

								if ($key !== NULL && $key !== FALSE)
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'green',
										'TEXT' => $lang["ocs_periph_status_sync"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&action=sync_ocs&type=input&agence_id='.intval($_GET["agence_id"]).'&ocs_id='.$tab[TAB_OCS_INPUT.".".COL_OCS_MON_ID][$i].'&p_id='.$tab_periph["id"][$key],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
											'TITLE' => $lang["ocs_sync"]
										));
									}
								}
								elseif ($key_all !== NULL && $key_all !== FALSE && MULTISITE == "Oui")
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'orange',
										'TEXT' => $lang["ocs_periph_status_other"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&action=sync_ocs&type=input&agence_id='.intval($_GET["agence_id"]).'&ocs_id='.$tab[TAB_OCS_INPUT.".".COL_OCS_MON_ID][$i].'&p_id='.$tab_periph_all["id"][$key_all],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/sync.gif',
											'TITLE' => $lang["ocs_sync"]
										));
									}
								}
								else
								{
									$template->assign_block_vars('r_ocs.main.list_periph.status', array(
										'COLOR' => 'red',
										'TEXT' => $lang["ocs_periph_status_new"]
									));

									if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
									{
										$template->assign_block_vars('r_ocs.main.list_periph.tools', array(
											'LINK' => 'index.php?page=adm_peripheriques.php&action=add_ocs&type=input&agence_id='.intval($_GET["agence_id"]).'&ocs_id='.$tab[TAB_OCS_INPUT.".".COL_OCS_IPT_ID][$i],
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_big.gif',
											'TITLE' => $lang["ocs_syncadd"]
										));
									}
								}

								$i++;
							}
						}
					}

					/************** LOGICIELS ***************/
					if ($requete_soft != '')
					{
						if (isset($_GET["sscat"]) && $_GET["sscat"] == 'soft')
						{
							if (defined("OCS_FILTRE_OCS".intval($_GET["agence_id"])))
								$filtre = ' AND ('.COL_OCS_SOFT_NAME.' NOT LIKE \''.str_replace(';','\' AND '.COL_OCS_SOFT_NAME.' NOT LIKE \'',substr(constant("OCS_FILTRE_OCS".intval($_GET["agence_id"])),0,-1)).'\')';
							else
								$filtre = '';

							$requete = "SELECT *, count(*) AS nb
							FROM ".TAB_OCS_SOFT."
							WHERE (".$requete_soft.")".$filtre."  AND ".COL_OCS_SOFT_NAME."<>''
							GROUP BY ".COL_OCS_SOFT_NAME."
							ORDER BY ".$tri;
							$tab = $req1->db_use_query($requete,1);

							/********************** DEBUT En-tetes ***********************/
							$template->assign_block_vars('r_ocs.main', array(
								'PAGE_TRI' => $page_tri,
								'COL_STATUS' => $lang["ocs_status"],
								'COL_TOOLS' => $lang["tools"]
							));

							$j = 0;
							while ($j < count($cols_display["soft"]))
							{
								$export_data[0][$j+1] = $lang["s_".$cols_display["soft"][$j]] ?? $cols_display["soft"][$j];

								$template->assign_block_vars('r_ocs.main.cols', array(
									'PAGE_TRI' => $page_tri.'&amp;tri='.$cols_display["soft"][$j],
									'TITLE' => $export_data[0][$j+1],
								));

								$j++;
							}
							/*********************** FIN En-tetes ************************/

							$connect->connection();

							$i = 0;
							while ($i < count($tab))
							{
								$display_soft = 0;

								$requete = "SELECT ".TAB_SOFT_OCS_ALIAS.".*,
								".TAB_SOFT.".id AS ouapi_id,
								".TAB_SOFT.".nom AS ouapi_name
								FROM ".TAB_SOFT_OCS_ALIAS."
								  LEFT JOIN ".TAB_SOFT." ON ".TAB_SOFT.".id = ".TAB_SOFT_OCS_ALIAS.".ouapi_soft_id
								WHERE ".TAB_SOFT_OCS_ALIAS.".ocs_soft_name='".$tab[$i][TAB_OCS_SOFT.'.'.COL_OCS_SOFT_NAME]."'";
								$tab_alias = $req1->db_use_query_inv($requete);

								if (count($tab_alias) > 0 && $tab_alias["visible"][0] == 0 && isset($_GET["aff_hidden_soft"]))
								{
									$template->assign_block_vars('r_ocs.main.list_soft', array(
										'CLASS' => 'row_spec',
									));
									$display_soft++;
								}
								elseif ((count($tab_alias) > 0 && $tab_alias["visible"][0] == 1) || count($tab_alias) == 0)
								{
									$template->assign_block_vars('r_ocs.main.list_soft', array(
										'CLASS' => 'row1',
									));
									$display_soft++;
								}

								if ($display_soft > 0)
								{
									$j = 0;
									while ($j < count($cols_display["soft"]))
									{
										if (isset($cols_display["soft"][$j]))
											$export_data[$i+1][$j+1] = col_displaying($cols_display["soft"][$j],$tab[$i][$cols_display["soft"][$j]]);
										else
											$export_data[$i+1][$j+1] = txt_to_na('');

										$template->assign_block_vars('r_ocs.main.list_soft.cols', array(
											'TITLE' => $export_data[$i+1][$j+1],
										));

										$j++;
									}

									// Pas d'alias -> Nouveau
									if (count($tab_alias) == 0)
									{
										$template->assign_block_vars('r_ocs.main.list_soft.status', array(
											'COLOR' => 'red',
											'TEXT' => $lang["ocs_soft_status_new"]
										));

										if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
										{
											$template->assign_block_vars('r_ocs.main.list_soft.tools', array(
												'LINK' => 'index.php?page=adm_logiciels.php&amp;action=add_ocs&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[$i][TAB_OCS_SOFT.'.'.COL_OCS_SOFT_ID],
												'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_big.gif',
												'TITLE' => $lang["ocs_syncadd"]
											));

											$template->assign_block_vars('r_ocs.main.list_soft.tools', array(
												'LINK' => 'index.php?page=adm_logiciels.php&amp;action=add_ocs_soft_alias&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[$i][TAB_OCS_SOFT.'.'.COL_OCS_SOFT_ID],
												'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/alias.gif',
												'TITLE' => $lang["ocs_syncaddalias"]
											));

											$template->assign_block_vars('r_ocs.main.list_soft.tools', array(
												'LINK' => 'index.php?page=adm_logiciels.php&amp;action=hide_ocs_alias&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[$i][TAB_OCS_SOFT.'.'.COL_OCS_SOFT_ID].'&amp;ocs_name='.urlencode($tab[$i][TAB_OCS_SOFT.'.'.COL_OCS_SOFT_NAME]),
												'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/show.gif',
												'TITLE' => $lang["ocs_soft_hidealias"]
											));
										}

										$template->assign_block_vars('r_ocs.main.list_soft.tools', array(
											'LINK' => 'index.php?page=adm_hardsoft.php&amp;ocs_id='.urlencode(serialize($tab[$i][TAB_OCS_SOFT.'.'.COL_OCS_SOFT_NAME])).'&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=list_version',
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/mat.gif',
											'TITLE' => ''
										));
									}
									// Alias visible
									elseif (count($tab_alias) > 0 && $tab_alias["visible"][0] == 1)
									{
										$template->assign_block_vars('r_ocs.main.list_soft.status', array(
											'COLOR' => 'green',
											'TEXT' => $lang["ocs_soft_status_sync"].' '.$tab_alias["ouapi_name"][0]
										));

										if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
										{
											$template->assign_block_vars('r_ocs.main.list_soft.tools', array(
												'LINK' => 'index.php?page=adm_logiciels.php&amp;action=edit_ocs_soft_alias&amp;agence_id='.intval($_GET["agence_id"]).'&amp;id='.$tab_alias["id"][0],
												'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
												'TITLE' => $lang["edit"]
											));
										}

										$template->assign_block_vars('r_ocs.main.list_soft.tools', array(
											'LINK' => 'index.php?page=visu_fiche.php&amp;type=ocs_soft_installed&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[$i][TAB_OCS_SOFT.'.'.COL_OCS_SOFT_ID].'&amp;action=visu',
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/mat.gif',
											'TITLE' => ''
										));
									}
									// Logiciel invisible mais visu des logiciels cachés activés
									elseif (count($tab_alias) > 0 && $tab_alias["visible"][0] == 0 && isset($_GET["aff_hidden_soft"]))
									{
										$template->assign_block_vars('r_ocs.main.list_soft.status', array(
											'COLOR' => 'grey',
											'TEXT' => $lang["ocs_hidden_soft"]
										));

										if (preg_match('`;'.RGHT_OCS_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
										{
											$template->assign_block_vars('r_ocs.main.list_soft.tools', array(
												'LINK' => 'index.php?page=adm_logiciels.php&amp;action=edit_ocs_soft_alias&amp;agence_id='.intval($_GET["agence_id"]).'&amp;id='.$tab_alias["id"][0],
												'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
												'TITLE' => $lang["edit"]
											));
										}
										$template->assign_block_vars('r_ocs.main.list_soft.tools', array(
											'LINK' => 'index.php?page=visu_fiche.php&amp;type=ocs_soft_installed&amp;agence_id='.intval($_GET["agence_id"]).'&amp;ocs_id='.$tab[$i][TAB_OCS_SOFT.'.'.COL_OCS_SOFT_ID].'&amp;action=visu',
											'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/mat.gif',
											'TITLE' => ''
										));

									}
								}
								$i++;
							}

							// Bouton d'affichage des softs cachés
							if (isset($_GET["aff_hidden_soft"]))
							{
								$template->assign_block_vars('r_ocs.aff_hidden', array(
									'LINK' => str_replace('&','&amp;',preg_replace("{&aff_hidden_soft=".$_GET["aff_hidden_soft"]."}","",$_SERVER['REQUEST_URI'])),
									'TEXT' => $lang["ocs_hidden_soft_hide"]
								));
							}
							else
							{
								$template->assign_block_vars('r_ocs.aff_hidden', array(
									'LINK' => str_replace('&','&amp;',$_SERVER['REQUEST_URI'].'&aff_hidden_soft=1'),
									'TEXT' => $lang["ocs_hidden_soft_show"]
								));
							}

						}
					}
				}
				else
				{
					$template->assign_block_vars('r_ocs.no_ocs', array(
						'TEXT' => $lang["ocs_noresult_hard"]
					));
				}
			}

			// Bouton de gestion de l'affichage
			$template->assign_block_vars('r_ocs.display', array(
				'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub='.$_GET["rubrique"].'&amp;subcat='.$_GET["sscat"],
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
				'TEXT' => $lang["gen_admindisplay"]
			));

			/**************** ADMIN *****************/
			if (preg_match('`;'.RGHT_OCS_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('r_ocs.conf', array(
					'LINK' => 'index.php?page=adm_ocs.php&amp;action=conf&amp;agence_id='.intval($_GET["agence_id"]),
					'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/conf.gif',
					'TEXT' => $lang["ocs_conf_thissite"]
				));
			}


		}
		/*********************************************/
		/*            MOTEUR DE RECHERCHE            */
		/*********************************************/
		elseif ($_GET["rubrique"] == "search")
		{
			if (isset($_POST["keywords"]))
			{
				$keywords = $words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/",format_text_db($_POST["keywords"]), 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

				// Init des tables de recherche
				$search_tables = $alias_tables = $main_col = $search_cols = array();

				if (defined("ACTIVRUB_HARD") && constant("ACTIVRUB_HARD") == 1)
				{
					array_push($search_tables, TAB_HARD);
					array_push($alias_tables, 'hard');
					array_push($main_col, TAB_HARD.'.'.HA_NAME); // Colonne principale des résultats (Sert pour le titre)
					array_push($search_cols, array("num_serie" => NULL, "marque_id" => array(TAB_HARD_MARQUE,"libelle"), "modele_id" => array(TAB_HARD_MODELE,"libelle"),
					  "type_id" => array(TAB_HARD_TYPE,"libelle"), "nom" => NULL, "user_id" => array(TAB_USERS,"nom","prenom"),
					  "emplacement_id" => array(TAB_EMPL,"libelle"), "ip" => NULL, "suivi_rebus" => NULL, "commentaire" => NULL));

					// Colonnes perso
					$pfieldColumns = get_table_pfield_columns(TAB_HARD);
					foreach ($pfieldColumns as $fieldName) {
						$search_cols[0][$fieldName] = NULL;
					}
				}

				if (defined("ACTIVRUB_PERIPH") && constant("ACTIVRUB_PERIPH") == 1)
				{
					array_push($search_tables, TAB_PERIPH);
					array_push($alias_tables, 'periph');
					array_push($main_col, TAB_PERIPH.'.'.PE_NAME);
					array_push($search_cols, array("num_serie" => NULL,"marque_id" => array(TAB_PERIPH_MARQUE,"libelle"), "modele_id" => array(TAB_PERIPH_MODELE,"libelle"),
					  "type_id" => array(TAB_PERIPH_TYPE,"libelle"), "nom" => NULL, "hard_id" => array(TAB_HARD,"nom","num_serie"),
					  "suivi_rebus" => NULL, "commentaire" => NULL));

					// Colonnes perso
					$pfieldColumns = get_table_pfield_columns(TAB_PERIPH);
					foreach ($pfieldColumns as $fieldName) {
						$search_cols[1][$fieldName] = NULL;
					}
				}

				if (defined("ACTIVRUB_SOFT") && constant("ACTIVRUB_SOFT") == 1)
				{
					array_push($search_tables, TAB_SOFT);
					array_push($alias_tables, 'soft');
					array_push($main_col, TAB_SOFT.'.'.SO_NAME);
					array_push($search_cols, array(SO_NAME => NULL, "dern_version_num" => NULL, "dern_version_date" => NULL, "commentaire" => NULL));

					// Colonnes perso
					$pfieldColumns = get_table_pfield_columns(TAB_SOFT);
					foreach ($pfieldColumns as $fieldName) {
						$search_cols[2][$fieldName] = NULL;
					}
				}

				if (defined("ACTIVRUB_DOCS") && constant("ACTIVRUB_DOCS") == 1)
				{
					array_push($search_tables, TAB_DOCS);
					array_push($alias_tables, 'docs');
					array_push($main_col, TAB_DOCS.'.'.DO_REFERENCE);
					array_push($search_cols, array("entreprise_id" => array(TAB_ENTREPRISE,"raison_sociale"), "reference" => NULL,"type_id" => array(TAB_DOCS_TYPE,"libelle"), "path" => NULL,
					 "date" => NULL,"commentaire" => NULL));

					// Colonnes perso
					$pfieldColumns = get_table_pfield_columns(TAB_DOCS);
					foreach ($pfieldColumns as $fieldName) {
						$search_cols[3][$fieldName] = NULL;
					}
				}

				if (defined("ACTIVRUB_NETW") && constant("ACTIVRUB_NETW") == 1)
				{
					array_push($search_tables, TAB_RESEAU);
					array_push($alias_tables, 'netw');
					array_push($main_col, TAB_RESEAU.'.'.RE_PLUGNUMBER);
					array_push($search_cols, array(RE_PLUGNUMBER => NULL, RE_LOCATIONID => array(TAB_EMPL,EM_LIBELLE), RE_HARDWAREID => array(TAB_HARD,HA_NAME),
					RE_PORTID => NULL));

					// Colonnes perso
					$pfieldColumns = get_table_pfield_columns(TAB_RESEAU);
					foreach ($pfieldColumns as $fieldName) {
						$search_cols[4][$fieldName] = NULL;
					}
				}

				if (defined("ACTIVRUB_USERS") && constant("ACTIVRUB_USERS") == 1)
				{
					array_push($search_tables, TAB_USERS);
					array_push($alias_tables, 'users');
					array_push($main_col, TAB_USERS.'.'.US_LNAME);
					array_push($search_cols, array("nom" => NULL, "prenom" => NULL, "mail" => NULL, "groupe_id" => array(TAB_USERS_GRP,"libelle"), "login" => NULL, "login_win" => NULL));

					// Colonnes perso
					$pfieldColumns = get_table_pfield_columns(TAB_USERS);
					foreach ($pfieldColumns as $fieldName) {
						$search_cols[5][$fieldName] = NULL;
					}
				}

				$template->assign_block_vars('r_search', array(
					'AGENCE_ID' => intval($_GET["agence_id"]),
					'LANG_SEARCH' => $lang["gen_search"],
					'KEYWORDS' => htmlspecialchars($_POST["keywords"])
				));

				$i = 0;
				while ($i < count($search_tables))
				{
					// Si l'utilisateur a les droits d'affichage sur la rubrique
					if (!defined("RGHT_".strtoupper($alias_tables[$i])) || (preg_match('`;'.constant("RGHT_".strtoupper($alias_tables[$i])).';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
					{
						$template->assign_block_vars('r_search.header', array(
						  'TABLE_NAME' => $lang["s_".$search_tables[$i]],
						  'TABLE_ALIAS' => $alias_tables[$i],
						  'TABLE_IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/'.$alias_tables[$i].'_icon.gif'
						));

						$select_clause = '';
						$join_clause = '';
						$where_clause = '';
						foreach ($search_cols[$i] as $key => $col_value)
						{
							// Si il la colonne n'est pas une référence à une autre table
							if ($col_value == '')
							{
								foreach ($keywords as $num => $word) {
									$where_clause .= " OR ".$search_tables[$i].".".$key." LIKE '%".$word."%'";
								}

								$select_clause .= $search_tables[$i].".".$key.", ";

							}
							else
							{
								$sel = str_replace("{Table}",$col_value[0].".",str_replace($col_value[0].',',"",implode(",{Table}",$col_value)));

								$select_clause .= $sel.", ";
								$join_clause .= " LEFT JOIN ".$col_value[0]." ON ".$search_tables[$i].".".$key."=".$col_value[0].".id";

								foreach ($keywords as $num => $word) {
									for ($k = 1; $k < count($col_value); $k++) {
                    					$where_clause .= " OR ".$col_value[0].".".$col_value[$k]." LIKE '%".addslashes($word)."%'";
									}
								}
							}
						}

						$requete = "SELECT ".$select_clause."".$search_tables[$i].".id,".$search_tables[$i].".agence_id,".TAB_AGENCES.".libelle as agence_libelle
						FROM ".$search_tables[$i]."
						  ".$join_clause."
						  LEFT JOIN ".TAB_AGENCES." ON ".TAB_AGENCES.".id = ".$search_tables[$i].".agence_id
						WHERE (".$search_tables[$i].".id='0'".$where_clause.") ORDER BY agence_id";

						$tab = $req1->db_use_query($requete,1);

						if (count($tab) > 0)
						{
							$j = 0;
							while($j < count($tab))
							{
								$text = '';
								foreach ($tab[$j] as $key => $val)
								{
									$cleanKey = (strpos($key, '.') !== false) ? substr($key, strrpos($key, '.') + 1) : $key;

									if ($val != '' && !preg_match("`\.id`i",$key) && !preg_match("`_id`i",$key))
									{
										foreach ($keywords as $num => $word)
										{
											$val = ext_str_ireplace($word,'<font color=#00b300><b>$1</b></font>',$val);
										}


										if (isset($lang["s_".$key])) {
											$label = $lang["s_".$cleanKey] ?? $cleanKey;
											$text .= '<font color=#999>'.$lang["s_".$key].':&nbsp;'.'</font>';
										}
										else {
											$text .= '<font color=#999>'.$key.':&nbsp;'.'</font>';
											$text .= $val.', ';
										}
									}
								}

								$row = $tab[$j];
								$current_id = $row[$search_tables[$i].".id"] ?? $row["1.id"] ?? $row["id"] ?? 0;
								$row_agence_id = $row[$search_tables[$i].".agence_id"] ?? $row["1.agence_id"] ?? $row["agence_id"] ?? 0;
								$row_agence_libelle = $row["agence_libelle"] ?? $row["1.agence_libelle"] ?? $row["agence_libelle"] ?? '';

								$template->assign_block_vars('r_search.header.list', array(
								  'TITLE' => $tab[$j][$main_col[$i]] ?? '',
								  'TEXT' => substr($text,0,-2),
								));

								if (intval($row_agence_id) == intval($_GET["agence_id"])) 
								{
    								$template->assign_block_vars('r_search.header.list.site', array(
        								'TITLE' => $lang["search_onthissite"],
        								'CLASS' => 'search_thissite',
    								));
								} 
								else 
								{
    								$template->assign_block_vars('r_search.header.list.site', array(
        								'TITLE' => $lang["search_site"] . txt_to_na($row_agence_libelle),
    									));
								}

								// FICHE
								$template->assign_block_vars('r_search.header.list.tools', array(
								  'LINK' => 'index.php?page=visu_fiche.php&amp;type='.$alias_tables[$i].'&amp;id='.intval($current_id).'&amp;agence_id='.intval($row_agence_id).'&amp;action=visu',
								  'TEXT' => $lang["search_linktofiche"],
								  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
								  'TARGET' => '_blank',
								));

								// EDITER
								$edit_array = array(
								  'hard' => 'index.php?page=adm_materiels.php&amp;action=editer&amp;h_id='.intval($current_id).'&amp;agence_id='.intval($row_agence_id),
								  'periph' => 'index.php?page=adm_peripheriques.php&amp;action=editer&amp;p_id='.intval($current_id).'&amp;agence_id='.intval($row_agence_id),
								  'soft' => 'index.php?page=adm_logiciels.php&amp;action=Edit&amp;s_id='.intval($current_id).'&amp;agence_id='.intval($row_agence_id),
								  'docs' => 'index.php?page=adm_docs.php&amp;action=edit&amp;id='.intval($current_id).'&amp;agence_id='.intval($row_agence_id),
								  'netw' => 'index.php?page=adm_reseau.php&amp;action=Editer&amp;id='.intval($current_id).'&amp;agence_id='.intval($row_agence_id),
								  'users' => 'index.php?page=adm_utilisateurs.php&amp;action=Editer&amp;user_id='.intval($current_id).'&amp;agence_id='.intval($row_agence_id),
								);

								if ((preg_match('`;'.constant("RGHT_".strtoupper($alias_tables[$i])."_EDIT").';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && $edit_array[$alias_tables[$i]] != '')
								{
									$template->assign_block_vars('r_search.header.list.tools', array(
									  'LINK' => $edit_array[$alias_tables[$i]],
									  'TEXT' => $lang["search_linktoedit"],
									  'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
									  'TARGET' => '_blank',
									));
								}

								// RUBRIQUE
								$template->assign_block_vars('r_search.header.list.tools', array(
							  		'LINK' => 'index.php?page=accueil.php&amp;agence_id='.intval($row_agence_id).'&amp;rubrique='.$alias_tables[$i].'&amp;highlight_id='.intval($current_id),
							  		'TEXT' => $lang["search_linktorub"],
							  		'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/all_sections.gif',
							  		'TARGET' => '_self',
									));
								$j++;
							}
						}
						else
							{
								$template->assign_block_vars('r_search.header.no_match', array(
							  	'TEXT' => $lang["search_no_match"]
								));
							}
					}
					$i++;
				}

			}
			else
				header('location:'.$_SESSION["page_defaut"]);
		}
	}
	/***********************************/
	/*             PAGE D'ACCUEIL          */
	/***********************************/
	else
	{
		if (intval($_GET["agence_id"]) == 0 && PARAM_HELP == 1)
		{
			$template->assign_block_vars('help', array(
				'IMG_TITLE' => $lang["gen_help"],
				'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
				'TEXT' => $lang["help"][1]
			));
		}
		elseif (PARAM_HELP == 1)
		{
			$template->assign_block_vars('help', array(
				'IMG_TITLE' => $lang["gen_help"],
				'IMG_HELP' => 'templates/'.DEFAULT_TEMPLATE.'/images/help_big.gif',
				'TEXT' => $lang["help"][22]
			));
			
		}

		// Résumé général du site
		$template->assign_block_vars('sum', array(
		));

		$cat[1]["table"] = "TAB_HARD";
		$cat[2]["table"] = "TAB_PERIPH";
		$cat[1]["type"] = "hard";
		$cat[2]["type"] = "periph";
		$cat[1]["table_type"] = "TAB_HARD_TYPE";
		$cat[2]["table_type"] = "TAB_PERIPH_TYPE";

		$aff_rub = 0;

		$j = 1;
		while ($j <= count($cat))
		{
			if (preg_match('`;'.constant("RGHT_".strtoupper($cat[$j]["type"])).';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
			{
				$template->assign_block_vars('sum.list_mat', array(
					'TITLE' => $lang[$cat[$j]["type"]],
					'IMAGE' => "templates/".DEFAULT_TEMPLATE."/images/".$cat[$j]["type"]."_icon.gif"
				));

				//Affichage du matériel

				$requete = "SELECT * FROM ".CONSTANT($cat[$j]["table_type"])." ORDER BY libelle";
				$tab = $req1->db_use_query($requete);

				$requete = "SELECT COUNT(".CONSTANT($cat[$j]["table"]).".".HA_TYPEID.") AS nb, ".CONSTANT($cat[$j]["table"]).".".HA_TYPEID."
				FROM ".CONSTANT($cat[$j]["table"])."
				WHERE agence_id='".intval($_GET["agence_id"])."' AND suivi_rebus=''
				GROUP BY ".CONSTANT($cat[$j]["table"]).".".HA_TYPEID." ORDER BY ".CONSTANT($cat[$j]["table"]).".".HA_TYPEID."";
				$tab_count = $req1->db_use_query_inv($requete);

				$i = 0;
				while ($i < count($tab))
				{
				    if (count($tab_count) != 0)
						$cle = array_search($tab[$i]["id"],$tab_count["type_id"]);
					else
						$cle = FALSE;

					if ($i%2 == 0)
						$template->assign_block_vars('sum.list_mat.line', array());

					if ($cle !== FALSE)
					{
						$template->assign_block_vars('sum.list_mat.line.mat', array(
							'LABEL' => txt_to_na($tab[$i]["libelle"]),
							'NUM' => $tab_count["nb"][intval($cle)],
							'CLASS' => "row1"
						));
					}
					else
					{
						$template->assign_block_vars('sum.list_mat.line.mat', array(
							'LABEL' => txt_to_na($tab[$i]["libelle"]),
							'NUM' => '0',
							'CLASS' => "row_spec"
						));
					}
					$i++;
				}

				$aff_rub++;
			}

			$j++;
		}

		if (preg_match('`;'.RGHT_USERS.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$tab_users = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE agence_id='".intval($_GET["agence_id"])."'");
			$template->assign_block_vars('sum.users', array(
				'TITLE_SUM' => $lang["header"][5],
				'AGENCE' => $tab[0]["libelle"],
				'L_USERS' => $lang["gen_users"],
				'LANG_USERS' => $lang["gen_user_count"],
				'NB_USERS' => count($tab_users),
				'IMAGE' => "templates/".DEFAULT_TEMPLATE."/images/users_icon.gif"
			));
			$aff_rub++;
		}

		if ($aff_rub > 0)
		{
			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." WHERE id='".intval($_GET["agence_id"])."'");
			if (count($tab) == 0)
				$tab[0]["libelle"] = '';

			$template->assign_block_vars('sum.title', array(
				'TITLE_SUM' => $lang["header"][5],
				'AGENCE' => $tab[0]["libelle"],
			));
		}

		// AFFICHAGE PAGE PERSO UTILISATEUR
		if ($_SESSION["user_agence"] == intval($_GET["agence_id"]))
		{
			// Définition des colonnes à afficher
			$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='0' AND category='accueil'";
			$tab_cols_default = $req1->db_use_query($requete);
			$requete = "SELECT * FROM ".TAB_USERS_PS." WHERE user_id='".$_SESSION["user_id"]."' AND category='accueil'";
			$tab_cols_user = $req1->db_use_query($requete);

			// Affichage utilisateur
			if (count($tab_cols_user) > 0 && $tab_cols_user[0][UT_PS_DISPLAY] != '')
				$cols_display = explode(";",preg_replace('`;$`','',$tab_cols_user[0][UT_PS_DISPLAY]));
			// Affichage par défaut
			if (count($tab_cols_user) == 0 && count($tab_cols_default) > 0)
				$cols_display = explode(";",preg_replace('`;$`','',$tab_cols_default[0][UT_PS_DISPLAY]));
			// Aucun paramètre
			else
				$cols_display = '';


			$requete = "SELECT * FROM ".TAB_AGENCES." WHERE id='".intval($_GET["agence_id"])."'";
			$tab = $req1->db_use_query($requete);

			// Init de la rubrique
			$template->assign_block_vars('r_my', array(
				'TITLE' => $lang["rub_my"],
				'MY_HARD_TITLE' => $lang["my_hard"],
				'MY_PERIPH_TITLE' => $lang["my_periph"],
				'TITLE_PARAM' => $lang["header"][6],
				'TEMPLATE_ROOT' => 'templates/'.DEFAULT_TEMPLATE.'/',
			));



			// Bouton de gestion de l'affichage
			/*$template->assign_block_vars('r_my.display', array(
				'LINK' => 'index.php?page=adm_display.php&amp;action=col_conf&amp;rub=accueil',
				'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/display.gif',
				'TEXT' => $lang["gen_admindisplay"]
			));*/

			// AFFICHAGE DES LIENS
			$requete = "SELECT * FROM ".TAB_USERS_PL." WHERE ".UT_PL_USERID."='".$_SESSION["user_id"]."' OR ".UT_PL_USERID."='0'";
			$tab_links = $req1->db_use_query($requete);

			// Bouton d'affichage des infos
			$template->assign_block_vars('r_my.infos', array(
				'LINK' => 'index.php?page=user_tasks.php&amp;action=change_mdp',
				'IMAGE' => "templates/".DEFAULT_TEMPLATE."/images/gallery/m_infos.png",
				'TEXT' => strtoupper($lang["my_infos"]),
				'CLASS' => 'my_main_button',
				'TARGET' => '_blank',
				'HARD_NAME' => txt_to_na(gethostbyaddr($_SERVER["REMOTE_ADDR"])),
				'IP' => txt_to_na(gethostbyname($_SERVER["REMOTE_ADDR"])),
				'USER_NAME' => txt_to_na($_SESSION["nom_comp"])
			));

			//Bouton de changement de mot de passe
			if ($_SERVER['HTTP_HOST'] != 'www.ouapi.org')
			{
				$template->assign_block_vars('r_my.links', array(
					'LINK' => 'index.php?page=user_tasks.php&amp;action=change_mdp',
					'IMAGE' => "templates/".DEFAULT_TEMPLATE."/images/gallery/m_password.png",
					'TEXT' => strtoupper($lang["user_changepass"]),
					'CLASS' => 'my_password_button',
					'TARGET' => '_blank',
				));
			}

			$i = 0;
			while ($i < count($tab_links))
			{
				$color = $tab_links[$i][UT_PL_COLOR];

				$template->assign_block_vars('r_my.links', array(
					'ID' => $tab_links[$i][UT_PL_ID],
					'LINK' => $tab_links[$i][UT_PL_LINK],
					'IMAGE' => "images/gallery/".$tab_links[$i][UT_PL_IMAGE],
					'TEXT' => strtoupper($tab_links[$i][UT_PL_LIBELLE]),
					'CLASS' => 'my_button',
					'STYLE' => 	' background-color:#'.$color.';
									background-image: -webkit-gradient(linear, left top, right bottom, from(#'.$color.')), to(#000)); 
									background-image: -webkit-linear-gradient(top left, #'.$color.', #000); 
									background-image:    -moz-linear-gradient(top left, #'.$color.', #000); 
									background-image:     -ms-linear-gradient(top left, #'.$color.', #000); 
									background-image:      -o-linear-gradient(top left, #'.$color.', #000); 
									background-image:         linear-gradient(to right bottom, #'.$color.', #000);
								  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.$color.', endColorstr=#000000);
								  -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.$color.', endColorstr=#000000);',
					'TARGET' => $tab_links[$i][UT_PL_TARGET],
				));

				if ($tab_links[$i][UT_PL_USERID] != 0 || ($tab_links[$i][UT_PL_USERID] == 0 && preg_match('`;'.RGHT_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10))
				{
					$template->assign_block_vars('r_my.links.del', array(
					  'TEXT' => $lang["user_delconfirm"],
					  'LINK' => 'index.php?page=user_tasks.php&amp;action=del_link&amp;id='.$tab_links[$i][UT_PL_ID],
					));
				}
				$i++;
			}

			//Bouton d'ajout de lien
			$template->assign_block_vars('r_my.links', array(
				'LINK' => 'index.php?page=user_tasks.php&amp;action=add_link',
				'TEXT' => '+',
				'CLASS' => 'my_add_button',
				'IMAGE' => "templates/".DEFAULT_TEMPLATE."/images/gallery/blank.png",
				'TARGET' => '_blank',
			));

			// Matériels associé à l'utilisateur
			$requete = "SELECT ".TAB_HARD.".id AS hard_id,
			  ".TAB_HARD.".nom,
			  ".TAB_HARD.".num_serie,
			  ".TAB_HARD.".type_id,
			  ".TAB_HARD.".emplacement_id,
			  ".TAB_HARD.".marque_id,
			  ".TAB_HARD.".modele_id,
			  ".TAB_HARD.".os_id,
			  ".TAB_HARD.".suivi_rebus,
			  ".TAB_HARD_TYPE.".libelle AS type_libelle,
			  ".TAB_EMPL.".libelle AS empl_libelle,
			  ".TAB_HARD_MARQUE.".libelle AS marque_libelle,
			  ".TAB_HARD_MODELE.".libelle AS modele_libelle,
			  ".TAB_HARD_OS.".libelle AS os_libelle
			  FROM ".TAB_HARD."
				LEFT JOIN ".TAB_HARD_TYPE." ON ".TAB_HARD.".type_id = ".TAB_HARD_TYPE.".id
				LEFT JOIN ".TAB_EMPL." ON ".TAB_HARD.".emplacement_id = ".TAB_EMPL.".id
				LEFT JOIN ".TAB_HARD_MARQUE." ON ".TAB_HARD.".marque_id = ".TAB_HARD_MARQUE.".id
				LEFT JOIN ".TAB_HARD_MODELE." ON ".TAB_HARD.".modele_id = ".TAB_HARD_MODELE.".id
				LEFT JOIN ".TAB_HARD_OS." ON ".TAB_HARD.".os_id = ".TAB_HARD_OS.".id
			  WHERE user_id='".$_SESSION["user_id"]."' AND suivi_rebus=''
			  ORDER BY type_id, nom";

			$tab = $req1->db_use_query($requete);

			if (count($tab) != 0)
			{
				//On prépare la future requete pour les periphs
				$hard_id_requete = "hard_id='-1'";

				$template->assign_block_vars('r_my.col_hard', array(
					'CLASS' => 'titre3',
					'COL_NAME' => $lang["name"],
					'COL_TYPE' => $lang["type"],
					'COL_PLACE' => $lang["place_2"],
					'COL_MARQUE' => $lang["marque"],
					'COL_MODEL' => $lang["modele"],
					'COL_OS' => $lang["os"],
					'COL_SERIAL' => $lang["serial"],
					'COL_TOOLS' => $lang["tools"]
				));

				$i = 0;
				while ($i < count($tab))
				{
					$hard_id_requete .= " OR hard_id='".$tab[$i]["hard_id"]."'";

					if ($tab[$i]["suivi_rebus"] != '')
						$class = "row_spec";
					else
						$class = "row1";

					$template->assign_block_vars('r_my.list_hard', array(
						'CLASS' => $class,
						'COL_NAME' => txt_to_na($tab[$i]["nom"]),
						'COL_TYPE' => txt_to_na($tab[$i]["type_libelle"]),
						'COL_PLACE' => txt_to_na($tab[$i]["empl_libelle"]),
						'COL_MARQUE' => txt_to_na($tab[$i]["marque_libelle"]),
						'COL_MODEL' => txt_to_na($tab[$i]["modele_libelle"]),
						'COL_OS' => txt_to_na($tab[$i]["os_libelle"]),
						'COL_SERIAL' => txt_to_na($tab[$i]["num_serie"])
					));

					$template->assign_block_vars('r_my.list_hard.tools', array(
						'LINK' => 'index.php?page=visu_fiche.php&amp;type=hard&amp;id='.$tab[$i]["hard_id"].'&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=visu',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
						'TITLE' => $lang["see"],
					));
					$i++;
				}
			}
			// S'il n'y a aucun resultat
			else
			{
				$template->assign_block_vars('r_my.no_hard', array(
					'TEXT' => $lang["my_nohard"]
				));
			}

			// Périph associé à l'utilisateur
			if (count($tab) != 0)
			{
				$requete = "SELECT ".TAB_PERIPH.".*,
				".TAB_PERIPH_TYPE.".libelle AS l_type,
				".TAB_HARD.".nom AS nom_hard,
				".TAB_PERIPH_MARQUE.".libelle AS l_marque,
				".TAB_PERIPH_MODELE.".libelle AS l_modele
				FROM ".TAB_PERIPH."
				  LEFT JOIN ".TAB_PERIPH_TYPE." ON ".TAB_PERIPH_TYPE.".id = ".TAB_PERIPH.".type_id
				  LEFT JOIN ".TAB_HARD." ON ".TAB_HARD.".id = ".TAB_PERIPH.".hard_id
				  LEFT JOIN ".TAB_PERIPH_MARQUE." ON ".TAB_PERIPH_MARQUE.".id = ".TAB_PERIPH.".marque_id
				  LEFT JOIN ".TAB_PERIPH_MODELE." ON ".TAB_PERIPH_MODELE.".id = ".TAB_PERIPH.".modele_id
				WHERE ".$hard_id_requete." AND ".TAB_PERIPH.".suivi_rebus=''  ORDER BY type_id, nom";
				$tab_periph = $req1->db_use_query($requete);
			}

			if (count($tab) != 0 && count($tab_periph) != 0)
			{
				$template->assign_block_vars('r_my.col_periph', array(
					'CLASS' => 'titre3',
					'COL_TYPE' => $lang["type"],
					'COL_NAME' => $lang["name"],
					'COL_HARDLINK' => $lang["periph_hardlink"],
					'COL_MARQUE' => $lang["marque"],
					'COL_MODEL' => $lang["modele"],
					'COL_SERIAL' => $lang["serial"],
					'COL_TOOLS' => $lang["tools"]
				));

				$i = 0;
				while ($i < count($tab_periph))
				{
					if ($tab[$i]["suivi_rebus"] != '')
						$class = "row_spec";
					else
						$class = "row1";

					$template->assign_block_vars('r_my.list_periph', array(
						'CLASS' => $class,
						'COL_TYPE' => txt_to_na($tab_periph[$i]["l_type"]),
						'COL_NAME' => txt_to_na($tab_periph[$i]["nom"]),
						'COL_HARDLINK' => txt_to_na($tab_periph[$i]["nom_hard"]),
						'COL_MARQUE' => txt_to_na($tab_periph[$i]["l_marque"]),
						'COL_MODEL' => txt_to_na($tab_periph[$i]["l_modele"]),
						'COL_SERIAL' => txt_to_na($tab_periph[$i]["num_serie"])
					));

					$template->assign_block_vars('r_my.list_periph.tools', array(
						'LINK' => 'index.php?page=visu_fiche.php&amp;type=periph&amp;id='.$tab_periph[$i]["id"].'&amp;agence_id='.intval($_GET["agence_id"]).'&amp;action=visu',
						'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/fiche.gif',
						'TITLE' => $lang["see"],
					));
					$i++;
				}
			}
			else
			{
				$template->assign_block_vars('r_my.no_periph', array(
					'TEXT' => $lang["my_noperiph"]
				));
			}

		}

	}
}
/*********************************************/
/*                EVENEMENTS                 */
/*********************************************/
elseif ($_GET["rubrique"] == "even")
{

}
/*********************************************/
/*              ADMINISTRATION               */
/*********************************************/
elseif ($_GET["rubrique"] == "admin")
{
	$template->assign_block_vars('r_admin', array(
		'TITLE_ADMIN_GEN' => $lang["admin_gen"],
		'TITLE_ADMIN_OPTMOD' => $lang["admin_optmod"],
		'TITLE_ADMIN_PLUGIN' => $lang["admin_plugin_title"],
		'LANG_GOTO' => $lang["goto"],
		'COL_CATEG' => $lang["admin_categ"],
		'SELF' => 'index.php?page=accueil.php&amp;rubrique=admin',
		'RUB_CONF' => $lang["admin_config"],
		'RUB_CONF_PLUGIN' => $lang["admin_config_plugin"],
		'RUB_RIGHTS' => $lang["admin_menu_rights"],
		'TITLE_ADMIN_TABLE' => $lang["admin_table_admin"],
		'TITLE_ADMIN_TOOLS' => $lang["admin_tools"],
		'TITLE_MAJOUAPI' => $lang["admin_title_majouapi"],
		'TITLE_ADMIN_IMPORT' => $lang["admin_tools_import"],
		'TITLE_ADMIN_ADDFIELD' => $lang["admin_tools_pfields"],
		'TITLE_BACKUP' => $lang["admin_backup"],
	));

	$mod = 0;
	if (LDAP_INSTALL == "Oui")
	{
		$template->assign_block_vars('r_admin.menu_ldap', array(
			'RUB_CONF_LDAP' => $lang["admin_config_ldap"],
		));
		$mod++;
	}

	if (OCS_INSTALL == "Oui")
	{
		$template->assign_block_vars('r_admin.menu_ocs', array(
			'RUB_CONF_OCS' => $lang["admin_config_ocs"],
		));
		$mod++;
	}

	if ($mod == 0)
	{
		$template->assign_block_vars('r_admin.no_mod', array(
			'TEXT' => $lang["none"],
		));
		$mod++;
	}


	// Admin des Tables
	if (isset($_GET["action"]) && $_GET["action"] == 'tables')
	{
		$template->assign_block_vars('r_admin.tables', array(
			'COL_TOOLS' => $lang["tools"],
			'LANG_ADD' => $lang["add"],
			'LANG_EDIT' => $lang["edit"],
			'COL_TABLE' => $lang["table"],
			'RUB_EXT' => $lang["admin_ext"],
			'RUB_PLACES' => $lang["admin_places"],
			'RUB_HARDTYPE' => $lang["admin_hard_type"],
			'RUB_HARDMARQUE' => $lang["admin_hard_marque"],
			'RUB_HARDMODEL' => $lang["admin_hard_model"],
			'RUB_PERTYPE' => $lang["admin_per_type"],
			'RUB_PERMODEL' => $lang["admin_per_model"],
			'RUB_OS' => $lang["admin_os"],
			'RUB_DOCSTYPE' => $lang["admin_docs_type"],
			'RUB_CPU' => $lang["admin_cpu"],
			'RUB_RAMTYPE' => $lang["admin_ram_type"],
			'RUB_DISQUETYPE' => $lang["admin_disque_type"],
			'IMG_ADD' => 'templates/'.DEFAULT_TEMPLATE.'/images/add_big.gif',
			'IMG_EDIT' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
		));

		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('r_admin.tables.sites', array(
				'RUB_SITE' => $lang["admin_sites"]
			));
		}

	}
	// Paramètrage des droits
	elseif (isset($_GET["action"]) && $_GET["action"] == 'param_rights')
	{
		$template->assign_block_vars('r_admin.rights', array(
		  'TITLE_CREATE' => $lang["admin_tools_createrights"],
		  'TITLE_MODIFY' => $lang["admin_tools_modifyrights"],
		  'SELECT_LABEL' => $lang["admin_rights_select_group"],
		  'GRP_TITLE' => $lang["admin_rights_grp_title"],
		  'ADD_LABEL' => $lang["admin_rights_add_title"],
		  'GRPADD_BUTTON' => $lang["admin_rights_add_button"],
		  'GRP_BUTTON' => $lang["admin_rights_grp_button"],
		  'ADDFORM_ACTION' => 'index.php?page=adm_gen.php&amp;action=add_grp',
		));

		// Groupes (sauf super admin)
		$requete = "SELECT * FROM ".TAB_USERS_GRP." WHERE id<>'10' ORDER BY libelle";
		$tab_grp = $req1->db_use_query($requete);

		$i = -1;
		$tab_grp[-1] = array('id' => '-1', 'libelle' => $lang["gen_select"]);
		while ($i < count($tab_grp)-1)
		{
			if (isset($_GET["grp_id"]) && $_GET["grp_id"] == $tab_grp[$i]["id"])
			{
				$template->assign_block_vars('r_admin.rights.grp_list', array(
				  'NAME' => $tab_grp[$i]["libelle"],
				  'ID' => $tab_grp[$i]["id"],
				  'SELECTED' => 'selected="selected"',
				));
			}
			else
			{
				$template->assign_block_vars('r_admin.rights.grp_list', array(
				  'NAME' => $tab_grp[$i]["libelle"],
				  'ID' => $tab_grp[$i]["id"],
				));
			}


			$i++;
		}

		// Droits
		if (isset($_GET["grp_id"]))
		{
			// Modification
			$requete = "SELECT * FROM ".TAB_USERS_GRP." WHERE id='".intval($_GET["grp_id"])."' ORDER BY id DESC";
			$tab = $req1->db_use_query($requete);

			if (count($tab) > 0)
			{

				$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom LIKE 'rght_%' ORDER BY libelle";
				$tab_rghts = $req1->db_use_query($requete);

				$template->assign_block_vars('r_admin.rights.grp', array(
				  'FORM_ACTION' => 'index.php?page=adm_gen.php&amp;action=param_rights&amp;grp_id='.intval($_GET["grp_id"]),
				  'TEXT_EDIT' => $lang["admin_rights_edit_title"],
				  'BUTTON' => $lang["admin_rights_rights_button"],
				));

				$j = 0;
				while($j < count($tab_rghts))
				{
					$tmp[$j] = explode('_',$tab_rghts[$j]["nom"]);

					if (isset($tmp[$j][1]) && ((defined("ACTIVRUB_".strtoupper($tmp[$j][1])) && constant("ACTIVRUB_".strtoupper($tmp[$j][1])) == 1) || !defined("ACTIVRUB_".strtoupper($tmp[$j][1]))))
					{
						preg_match('`\[(.*)\]`',$tab_rghts[$j]["libelle"],$categ);
						$match = preg_match('`;'.$tab_rghts[$j]["valeur"].';`',$tab[0]["rights"]);

						if ($j == 0 || (isset($tmp[$j][0]) && isset($tmp[$j-1][0]) && isset($tmp[$j][1]) && isset($tmp[$j-1][1]) && $tmp[$j][0].$tmp[$j][1] != $tmp[$j-1][0].$tmp[$j-1][1]))
						{
							$template->assign_block_vars('r_admin.rights.grp.category', array(
							  'CAT_NAME' => $categ[1] ?? '',
							));
						}

						if ($_SERVER['HTTP_HOST'] != 'ouapi.org')
						{
							if ($match != 0)
							{
								$template->assign_block_vars('r_admin.rights.grp.category.rghts', array(
									'LIBELLE' => str_replace($categ[0] ?? '','',$tab_rghts[$j]["libelle"]),
									'ID' => $tab_rghts[$j]["valeur"],
									'CHECKED' => 'checked="checked"',
								));
							}
							else
							{
								$template->assign_block_vars('r_admin.rights.grp.category.rghts', array(
									'LIBELLE' => str_replace($categ[0] ?? '','',$tab_rghts[$j]["libelle"]),
									'ID' => $tab_rghts[$j]["valeur"],
								));
							}
						}
						else
						{
							$template->assign_block_vars('r_admin.rights.grp.category.rghts', array(
								'LIBELLE' => str_replace($categ[0] ?? '','',$tab_rghts[$j]["libelle"]),
								'ID' => $tab_rghts[$j]["valeur"],
								'CHECKED' => 'disabled="disabled"',
							));
						}
					}


					$j++;
				}
				// Supression
				if ($tab[0]["locked"] != 1 && $_SERVER['HTTP_HOST'] != 'www.ouapi.org')
				{
					$template->assign_block_vars('r_admin.rights.del_grp', array(
					  'TEXT_DEL' => $lang["admin_rights_del_title"],
					  'TEXT_NEWGRP' => $lang["admin_rights_del_newgrp"],
					  'FORM_ACTION' => 'index.php?page=adm_gen.php&amp;action=del_grp&amp;grp_id='.intval($_GET["grp_id"]),
					  'BUTTON' => $lang["delete"],
					));

					$requete = "SELECT * FROM ".TAB_USERS_GRP." WHERE id<>'".intval($_GET["grp_id"])."' ORDER BY id DESC";
					$tab_grp = $req1->db_use_query($requete);

					$i = 0;
					while ($i < count($tab_grp))
					{
						$template->assign_block_vars('r_admin.rights.del_grp.list', array(
						  'NAME' => $tab_grp[$i]["libelle"],
						  'ID' => $tab_grp[$i]["id"],
						));


						$i++;
					}
				}
			}
		}

	}
	// Imports
	elseif (isset($_GET["action"]) && $_GET["action"] == 'import')
	{
		$template->assign_block_vars('r_admin.import', array(
		  'TITLE' => $lang["admin_import_title"] ,
		  'L_SETTING' => $lang["gen_setting"],
		  'L_SEND' => $lang["gen_send"],
		  'L_VALUE' => $lang["gen_value"],
		  'L_TABLE' => $lang["adm_gen_importtable"],
		  'DESC_TABLE' => $lang["adm_gen_desc_importtable"],
		  'L_SEP' => $lang["adm_gen_importsep"],
		  'DESC_SEP' => $lang["adm_gen_desc_importsep"],
		  'L_FILE' => $lang["adm_gen_importfile"],
		  'DESC_FILE' => $lang["adm_gen_desc_importfile"],
		 ));

		$tables = array(TAB_HARD => $lang["s_".TAB_HARD], TAB_PERIPH => $lang["s_".TAB_PERIPH], TAB_USERS => $lang["s_".TAB_USERS]);
		while (list($key,$val) = each($tables))
		{
			$template->assign_block_vars('r_admin.import.table', array(
			  'VALUE' => $key,
			  'LIBELLE' => $val
			));
		}

		$sep = array('pv' => ';' , 'vir' => ',' , 'dp' => ':' , 'dz' => '#');
		while (list($key,$val) = each($sep))
		{
			$template->assign_block_vars('r_admin.import.sep', array(
			  'VALUE' => $key,
			  'LIBELLE' => $val
			));
		}

		// Site
		if (MULTISITE == "Oui")
		{
			$template->assign_block_vars('r_admin.import.multisite', array(
			  'L_SITE' => $lang["adm_gen_importsite"],
			  'DESC_SITE' => $lang["adm_gen_desc_importsite"],
			));

			$tab = $req1->db_use_query("SELECT * FROM ".TAB_AGENCES." ORDER BY libelle");
			$i = -1;
			$tab[-1] = array('id' => '0', 'libelle' => $lang["admin_site"]);
			while ($i < count($tab)-1)
			{
				$template->assign_block_vars('r_admin.import.multisite.list', array(
				  'VALUE' => $tab[$i]["id"],
				  'LIBELLE' => $tab[$i]["libelle"]
				));
				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('r_admin.import.monosite', array(
			  'AGENCE_ID' => 1
			));
		}

	}
	// Gérer les champs personnalisés
	elseif (isset($_GET["action"]) && $_GET["action"] == 'addfield')
	{
		$template->assign_block_vars('r_admin.pfield', array());

		// Ajout
		$template->assign_block_vars('r_admin.pfield.add', array(
			'TITLE' => $lang["admin_addfield_title"],
			'L_TABLE' => $lang["admin_addfield_table"],
			'L_FIELDNAME' => $lang["admin_addfield_fieldname"],
			'L_FIELDTYPE' => $lang["admin_addfield_fieldtype"],
			'BUTTON' => $lang["add"],
		));

		$tables = array(TAB_HARD,TAB_PERIPH,TAB_SOFT,TAB_DOCS,TAB_USERS,TAB_RESEAU);

		$i = 0;
		while ($i < count($tables))
		{
			$template->assign_block_vars('r_admin.pfield.add.table', array(
			  'VALUE' => $tables[$i],
			  'LABEL' => $lang["s_".$tables[$i]],
			));

			$i++;
		}

		$fieldtype = array('VARCHAR(255)','INT(11)','FLOAT(10)');

		$i = 0;
		while ($i < count($fieldtype))
		{
			$template->assign_block_vars('r_admin.pfield.add.fieldtype', array(
			  'VALUE' => $fieldtype[$i],
			  'LABEL' => $fieldtype[$i],
			));

			$i++;
		}

		// Verif des autorisations
		// $result = mysql_query("SHOW GRANTS FOR CURRENT_USER()");

		// SUPPRESSION
		$tables = array(TAB_HARD,TAB_PERIPH,TAB_SOFT,TAB_DOCS,TAB_USERS,TAB_RESEAU);

		$template->assign_block_vars('r_admin.pfield.del', array(
			'TITLE' => $lang["admin_delfield_title"],
			'L_NAME' => $lang["admin_delfield_fieldname"],
			'L_TABLE' => $lang["admin_delfield_table"],
			'L_TOOLS' => $lang["tools"],
		));

		$i = 0;
		$nb_champs = 0;

		while ($i < count($tables))
		{
			$pfieldColumns = get_table_pfield_columns($tables[$i]);

			foreach ($pfieldColumns as $fieldName) {
				if (isset($lang["s_".$tables[$i].".".$fieldName])) {
            		$displayTitle = $lang["s_".$tables[$i].".".$fieldName];
        		} 
        		// 2. Sinon, on transforme "pfield_ma_donnee" en "Ma donnee"
        		else {
            		$cleanName = str_replace('pfield_', '', $fieldName); // Enlève le préfixe
            		$cleanName = str_replace('_', ' ', $cleanName);      // Remplace les underscores par des espaces
            		$displayTitle = ucfirst($cleanName);                 // Met la première lettre en majuscule
        		}
				$template->assign_block_vars('r_admin.pfield.del.list', array(
				  'TITLE' => $displayTitle,
				  'TABLE' => $lang["s_".$tables[$i]],
				  'LINK' => 'index.php?page=adm_gen.php&amp;action=delfield&amp;fieldname='.$fieldName.'&amp;table='.$tables[$i],
				  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
				));
				$nb_champs++;
			}

			$i++;
		}

		if ($nb_champs == 0)
		{
			$template->assign_block_vars('r_admin.pfield.del.nolist', array(
				'TEXT' => $lang["admin_delfield_nolist"],
			));

		}


	}
	// Paramètrage général
	elseif (isset($_GET["action"]) && $_GET["action"] == 'param_gen')
	{
		if ($_SERVER['HTTP_HOST'] != 'www.ouapi.org')
			$form_action = 'index.php?page=adm_gen.php&amp;action=param';
		else
			$form_action = '';

		$template->assign_block_vars('r_admin.param_gen', array(
		  'TITLE' => $lang["adm_gen_config_title"],
		  'L_SETTING' => $lang["gen_setting"],
		  'L_VALUE' => $lang["gen_value"],
		  'DEFAULT_USERPARAM_TITLE' => $lang["adm_gen_default_userparam_title"],
		  'L_LANGUAGE' => $lang["adm_gen_default_language"],
		  'L_TEMPLATE' => $lang["adm_gen_default_template"],
		  'L_OCSACTIVE' => $lang["adm_gen_ocsactive"],
		  'DESC_OCSACTIVE' => $lang["adm_gen_desc_ocsactive"],
		  'L_LDAPACTIVE' => $lang["adm_gen_ldapactive"],
		  'DESC_LDAPACTIVE' => $lang["adm_gen_desc_ldapactive"],
		  'L_MULTIACTIVE' => $lang["adm_gen_multiactive"],
		  'DESC_MULTIACTIVE' => $lang["adm_gen_desc_multiactive"],
		  'L_YES' => $lang["gen_yes"],
		  'L_NO' => $lang["gen_no"],
		  'L_SEND' => $lang["gen_send"],
		  'FORM_ACTION' => $form_action,
		));

		// Langue
		$i = 0;
		$dir = "lang/";
		if (is_dir($dir) && $dh = opendir($dir))
		{
			while (($file = readdir($dh)) !== false)
			{
				if ($file[0] != '.')
				{
					$current = fopen($dir.$file,'r');
					$libelle = trim(str_replace("<?php //","",fgets($current, 4096)));
					$value = str_replace(".php","",substr($file,5));

					if ($value == DEFAULT_LANGUAGE)
					{
						$template->assign_block_vars('r_admin.param_gen.lang_list', array(
						  'VALUE' => $value,
						  'SELECTED' => 'selected="selected"',
						  'LIBELLE' => $libelle,
						));
					}
					else
					{
						$template->assign_block_vars('r_admin.param_gen.lang_list', array(
						  'VALUE' => $value,
						  'LIBELLE' => $libelle,
						));
					}

					fclose($current);
				}
			}
			closedir($dh);
		}

		// Template par défaut

		$d = dir("templates/");
		while (false !== ($entry = $d->read()))
		{
		   if (substr($entry,0,1) != '.')
		   {
				$fp = fopen('templates/'.$entry.'/template.ini','r');

				while (($line = fgets($fp, 4096)) !== false)
				{
					$param = explode('=',$line);
					${trim($param[0])} = trim($param[1]);
				}
				if ($entry == DEFAULT_TEMPLATE)
				{
					$template->assign_block_vars('r_admin.param_gen.tpl_list', array(
					  'ROOT' => $entry,
					  'SELECTED' => 'selected="selected"',
					  'NAME' => $tpl_name,
					));
				}
				else
				{
					$template->assign_block_vars('r_admin.param_gen.tpl_list', array(
					  'ROOT' => $entry,
					  'NAME' => $tpl_name,
					));
				}


				fclose($fp);
		   }
		}
		$d->close();

		$requete = "SELECT * FROM ".TAB_CONFIG." WHERE ".CO_NAME." LIKE 'param_%' OR ".CO_NAME." LIKE 'activrub_%' ORDER BY ".CO_SUBCAT.", ".CO_NAME;
		$tab = $req1->db_use_query($requete);

		$i = 0;
		while ($i < count($tab))
		{
			if ($i == 0 || $tab[$i][CO_SUBCAT] != $tab[$i-1][CO_SUBCAT])
			{
				$template->assign_block_vars('r_admin.param_gen.subcat', array(
				  'TITLE' => $lang["admin_configgen_subcat_".$tab[$i][CO_SUBCAT]],
				));
			}

			$template->assign_block_vars('r_admin.param_gen.subcat.list', array(
			  'PARAM' => $tab[$i]["libelle"],
			));

			if ($tab[$i]["description"] != NULL)
			{
				$template->assign_block_vars('r_admin.param_gen.subcat.list.desc', array(
				  'LIBELLE' => $tab[$i]["description"],
				));

			}

			switch ($tab[$i]["form_type"]) {
				case "text":
					$template->assign_block_vars('r_admin.param_gen.subcat.list.text', array(
					  'NAME' => $tab[$i]["nom"],
					  'VALUE' => $tab[$i]["valeur"],
					));
				break;

				case "radio_yn":
					if ($tab[$i]["valeur"]==1)
					{
						$template->assign_block_vars('r_admin.param_gen.subcat.list.radio_yn', array(
						  'NAME' => $tab[$i]["nom"],
						  'L_YES' => $lang["gen_yes"],
						  'Y_CHECKED' => 'checked="checked"',
						  'L_NO' => $lang["gen_no"],
						));
					}
					else
					{
						$template->assign_block_vars('r_admin.param_gen.subcat.list.radio_yn', array(
						  'NAME' => $tab[$i]["nom"],
						  'L_YES' => $lang["gen_yes"],
						  'L_NO' => $lang["gen_no"],
						  'N_CHECKED' => 'checked="checked"',
						));
					}
				break;

			}

			$i++;
		}

		$lines = implode('',file("config/connect.php"));

		$template->assign_block_vars('r_admin.param_gen.subcat', array(
		  'TITLE' => $lang["admin_configgen_subcat_divers"],
		));

		// Activer / Désactiver OCS
		if ($_SERVER['HTTP_HOST'] != 'www.ouapi.org')
		{
			$ocs_ok = stripos($lines,'"OCS_INSTALL","Oui"');

			if ($ocs_ok)
			{
				$template->assign_block_vars('r_admin.param_gen.ocs', array(
					'Y_CHECKED' => 'checked="checked"',
				));
			}
			else
			{
				$template->assign_block_vars('r_admin.param_gen.ocs', array(
					'N_CHECKED' => 'checked="checked"',
				));
			}

			$ldap_ok = stripos($lines,'"LDAP_INSTALL","Oui"');

			if ($ldap_ok)
			{
				$template->assign_block_vars('r_admin.param_gen.ldap', array(
					'Y_CHECKED' => 'checked="checked"',
				));
			}
			else
			{
				$template->assign_block_vars('r_admin.param_gen.ldap', array(
					'N_CHECKED' => 'checked="checked"',
				));
			}

			$multi_ok = stripos($lines,'"MULTISITE","Oui"');

			if ($multi_ok)
			{
				$template->assign_block_vars('r_admin.param_gen.multi', array(
					'Y_CHECKED' => 'checked="checked"',

				));
			}
			else
			{
				$template->assign_block_vars('r_admin.param_gen.multi', array(
					'N_CHECKED' => 'checked="checked"',

				));
			}
		}
	}
	// Paramètrage LDAP
	elseif (isset($_GET["action"]) && $_GET["action"] == 'param_ldap')
	{
		$requete = "SELECT * FROM ".TAB_CONFIG." WHERE ".CO_NAME." LIKE 'ldap_%' ORDER BY ".CO_SUBCAT." DESC, ".CO_NAME;
		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('r_admin.param_ldap', array(
		  'TITLE' => $lang["admin_ldap_title"],
		  'L_SEND' => $lang["gen_send"],
		));

		$ds=@ldap_connect(LDAP_HOST, LDAP_PORT);
		$r=@ldap_bind($ds,LDAP_USER,LDAP_MDP);

		//Recherche user
		$sr=@ldap_search($ds, LDAP_MASK, "SN=*",array(),0,5);
		@ldap_sort($ds, $sr, "sn");
		$data = @ldap_get_entries($ds, $sr);

		//Recherche hard
		$sr=@ldap_search($ds, LDAP_MASK_HARD, "name=*",array(),0,5);
		@ldap_sort($ds, $sr, "name");
		$data_hard = @ldap_get_entries($ds, $sr);

		// Preparation des listes de choix à afficher
		$default_values = array(
		  'ldap_key' => 'mail;mail',
		  'ldap_key_hard' => 'nom;name',
		  'ldap_attr_fname' => 'givenname',
		  'ldap_attr_lname' => 'sn',
		  'ldap_attr_mail' => 'mail',
		  'ldap_attr_loginwin' => 'samaccountname',
		  'ldap_attr_hard_name' => 'name',
		  'ldap_attr_hard_description' => 'description',
		  'ldap_attr_hard_created' => 'whencreated',
		  'ldap_attr_hard_os' => 'operatingsystem',
		);

		$array_ldap_key = array('nom;lname','mail;mail','login_win;loginwin');
		$array_label_ldap_key = array($lang["admin_ldap_lname"],$lang["admin_ldap_mail"],$lang["admin_ldap_loginwin"]);
		$array_ldap_key_hard = array('nom;name');
		$array_label_ldap_key_hard = array($lang["admin_ldap_hardname"]);

		$array_label_ldap_attr_fname = array($lang["none"]);
		$array_ldap_attr_fname = array(-1);
		$array_label_ldap_attr_lname = array($lang["none"]);
		$array_ldap_attr_lname = array(-1);
		$array_label_ldap_attr_loginwin = array($lang["none"]);
		$array_ldap_attr_loginwin = array(-1);
		$array_label_ldap_attr_mail = array($lang["none"]);
		$array_ldap_attr_mail = array(-1);

		$array_label_ldap_attr_hard_name = array($lang["none"]);
		$array_ldap_attr_hard_name = array(-1);
		$array_label_ldap_attr_hard_description = array($lang["none"]);
		$array_ldap_attr_hard_description = array(-1);
		$array_label_ldap_attr_hard_created = array($lang["none"]);
		$array_ldap_attr_hard_created = array(-1);
		$array_label_ldap_attr_hard_os = array($lang["none"]);
		$array_ldap_attr_hard_os = array(-1);

		for ($j=0;$j<=$data[0]["count"];$j++)
		{
			if (isset($data[0][$j]) && $data[0][$j] != '')
			{
				array_push($array_label_ldap_attr_fname, $data[0][$j]);
				array_push($array_ldap_attr_fname, $data[0][$j]);
				array_push($array_label_ldap_attr_lname, $data[0][$j]);
				array_push($array_ldap_attr_lname, $data[0][$j]);
				array_push($array_label_ldap_attr_mail, $data[0][$j]);
				array_push($array_ldap_attr_mail, $data[0][$j]);
				array_push($array_label_ldap_attr_loginwin, $data[0][$j]);
				array_push($array_ldap_attr_loginwin, $data[0][$j]);
			}
		}

		for ($j=0;$j<=$data_hard[0]["count"];$j++)
		{
			if (isset($data_hard[0][$j]) && $data_hard[0][$j] != '')
			{
				array_push($array_label_ldap_attr_hard_name, $data_hard[0][$j]);
				array_push($array_ldap_attr_hard_name, $data_hard[0][$j]);
				array_push($array_label_ldap_attr_hard_description, $data_hard[0][$j]);
				array_push($array_ldap_attr_hard_description, $data_hard[0][$j]);
				array_push($array_label_ldap_attr_hard_created, $data_hard[0][$j]);
				array_push($array_ldap_attr_hard_created, $data_hard[0][$j]);
				array_push($array_label_ldap_attr_hard_os, $data_hard[0][$j]);
				array_push($array_ldap_attr_hard_os, $data_hard[0][$j]);

				//echo $data_hard[0][$j].' > '.$data_hard[0][$data_hard[0][$j]][0].'<br />';
			}

		}

		// Affichage des parametres
		$i = 0;
		while ($i < count($tab))
		{
			if ($i == 0 || $tab[$i]["subcategory"] != $tab[$i-1]["subcategory"])
			{
				$template->assign_block_vars('r_admin.param_ldap.subcat', array(
				  'TITLE' => $lang["admin_ldap_subcat_".$tab[$i]["subcategory"]],
				  'L_SETTING' => $lang["gen_setting"],
				  'L_VALUE' => $lang["gen_value"],
				));
			}

			$template->assign_block_vars('r_admin.param_ldap.subcat.list', array(
				'PARAM' => $tab[$i]["libelle"]
			));

			if ($tab[$i]["description"] != '')
			{
				$template->assign_block_vars('r_admin.param_ldap.subcat.list.desc', array(
					'LIBELLE' => $tab[$i]["description"]
				));
			}

			switch ($tab[$i]["form_type"]) {
				case "text":
					$template->assign_block_vars('r_admin.param_ldap.subcat.list.text', array(
					  'NAME' => $tab[$i]["nom"],
					  'VALUE' => $tab[$i]["valeur"],
					));
				break;
				case "list":
					$template->assign_block_vars('r_admin.param_ldap.subcat.list.select', array(
					  'NAME' => $tab[$i]["nom"],
					));

					$j = 0;
					while ($j < count(${"array_".$tab[$i]["nom"]}))
					{
						$tmp_constant = strtoupper($tab[$i]["nom"]);
						$tmp_value = ${"array_".$tab[$i]["nom"]}[$j];
						if ((defined($tmp_constant) && constant($tmp_constant) == $tmp_value) || (defined($tmp_constant) && constant($tmp_constant) == '' && $tmp_value == $default_values[$tab[$i]["nom"]]))
						{
							$template->assign_block_vars('r_admin.param_ldap.subcat.list.select.option', array(
							  'VALUE' => $tmp_value,
							  'SELECTED' => 'selected="selected"',
							  'LIBELLE' => ${"array_label_".$tab[$i]["nom"]}[$j],
							));
						}
						else
						{
							$template->assign_block_vars('r_admin.param_ldap.subcat.list.select.option', array(
							  'VALUE' => $tmp_value,
							  'LIBELLE' => ${"array_label_".$tab[$i]["nom"]}[$j],
							));
						}

						$j++;
					}
				break;


			}

			$i++;
		}

	}
	// Paramètrage OCS
	elseif (isset($_GET["action"]) && $_GET["action"] == 'param_ocs')
	{

		$template->assign_block_vars('r_admin.param_ocs', array(
		  'TITLE' => $lang["admin_ocs_title"],
		  'L_SETTING' => $lang["gen_setting"],
		  'L_VALUE' => $lang["gen_value"],
		  'L_SEND' => $lang["gen_send"],
		));

		$requete = "SELECT * FROM ".TAB_CONFIG." WHERE nom='db_ocs_host' OR nom='db_ocs_user' OR nom='db_ocs_mdp' OR nom='db_ocs_transm' ORDER BY id,nom";
		$tab = $req1->db_use_query($requete);

		$i = 0;
		while ($i < count($tab))
		{
			$template->assign_block_vars('r_admin.param_ocs.list', array(
				'PARAM' => $tab[$i]["libelle"]
			));

			if ($tab[$i]["description"] != '')
			{
				$template->assign_block_vars('r_admin.param_ocs.list.desc', array(
					'LIBELLE' => $tab[$i]["description"]
				));
			}

			switch ($tab[$i]["form_type"]) {
				case "text":
					$template->assign_block_vars('r_admin.param_ocs.list.text', array(
					  'NAME' => $tab[$i]["nom"],
					  'VALUE' => $tab[$i]["valeur"],
					));
				break;

			}

			$i++;
		}

		$connect_ocs = new db_connect();
		$err = $connect->test_cnx(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

		if (count($err) == 0)
		{
			$requete = "SELECT * FROM ".TAB_OCS_CONFIG." ORDER BY ".COL_OCS_CNF_NAME;
			$tab = $req1->db_use_query($requete);

			$template->assign_block_vars('r_admin.param_ocs.config', array(
				'TITLE' => $lang["admin_ocs_config_title"],
				'L_NAMEDESC' => $lang["admin_ocs_config_namedesc"],
				'L_VALUE1' => $lang["admin_ocs_config_value1"],
				'L_VALUE2' => $lang["admin_ocs_config_value2"],
			));

			$i = 0;
			while ($i < count($tab))
			{
				$template->assign_block_vars('r_admin.param_ocs.config.list', array(
					'NAME' => $tab[$i][COL_OCS_CNF_NAME],
					'IVALUE' => $tab[$i][COL_OCS_CNF_IVALUE],
					'TVALUE' => $tab[$i][COL_OCS_CNF_TVALUE],
					'DESC' => $tab[$i][COL_OCS_CNF_COMMENTS],
				));

				$i++;
			}
		}
		else
		{
			$template->assign_block_vars('r_admin.param_ocs.error', array(
				'TEXT' => $lang["ocs_connecterror"],
			));
		}
	}
	// Paramètrage général des plugins
	elseif (isset($_GET["action"]) && $_GET["action"] == 'param_plugin')
	{
		$requete = "SELECT * FROM ".TAB_PLUGIN." ORDER BY name,type";
		$tab = $req1->db_use_query_inv($requete);

		$new_plg = $inst_plg = $update_plg = 0;
		$directory = 'plugins';
		$hdir = opendir( $directory );

		$template->assign_block_vars('r_admin.param_plugin', array(
			'TITLE_NEW' => $lang["admin_plugin_titlenew"],
			'TITLE_INSTALLED' => $lang["admin_plugin_titleinstalled"],
			'TITLE_UPDATE' => $lang["admin_plugin_titleupdate"],
			'L_NAME' => $lang["admin_plugin_plgname"],
			'L_COMP' => $lang["admin_plugin_plgcompatibility"],
			'L_TYPE' => $lang["admin_plugin_plgtype"],
			'L_PATH' => $lang["admin_plugin_plgpath"],
			'L_TOOLS' => $lang["tools"],
		));

		while ( $item = readdir( $hdir ) )
		{
			if($item=="." || $item==".." || is_file($directory.'/'.$item)) continue;

			if ( is_file($directory.'/'.$item.'/param.ini'))
			{
				$fichier = fopen($directory.'/'.$item.'/param.ini','r');
				while (!feof($fichier))
				{
					$ligne = fgets($fichier);
					$temp = explode('=',$ligne);
					$param[trim($temp[0])] = trim($temp[1]);
				}
				fclose($fichier);

				// Nouveau plugin
				if (count($tab) == 0 || !in_array($param["plg_name"],$tab["name"]))
				{
					$template->assign_block_vars('r_admin.param_plugin.list_new', array(
						'NAME' => $param["plg_title"],
						'VERSION' => $param["plg_version"],
						'COMP' => $param["plg_ouapi_vers_comp"],
						'TYPE' => $param["plg_type"],
						'PATH' => $directory.'/'.$item,
					));

					// Si on a la version minimum de OUAPI recquise par le plugin
					if ($param["plg_ouapi_vers_comp"] <= GEN_VERSION)
					{
						$template->assign_block_vars('r_admin.param_plugin.list_new.tools', array(
							'TITLE' => $lang["gen_install"],
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/add.gif',
							'LINK' =>  'index.php?page=adm_plugins.php&amp;action=add&amp;etape=1&amp;path='.$item,
						));
					}

					if (isset($param["plg_desc"]))
					{
						$template->assign_block_vars('r_admin.param_plugin.list_new.desc', array(
							'LIBELLE' => $param["plg_desc"],
						));
					}
					$new_plg++;
				}
				else
				{
					$requete = "SELECT * FROM ".TAB_PLUGIN." WHERE ".PL_NAME."='".$param["plg_name"]."'";
					$tab_plg = $req1->db_use_query($requete);

					// Plugin installé et à jour
					if ($tab_plg[0][PL_VERSION] >= $param["plg_version"])
					{
						$template->assign_block_vars('r_admin.param_plugin.list_inst', array(
							'NAME' => $tab_plg[0][PL_TITLE],
							'VERSION' => $tab_plg[0][PL_VERSION],
							'TYPE' => $tab_plg[0][PL_TYPE],
							'PATH' => $directory.'/'.$tab_plg[0][PL_PATH],
						));

						if ($tab_plg[0][PL_DESCRIPTION] != '')
						{
							$template->assign_block_vars('r_admin.param_plugin.list_inst.desc', array(
								'LIBELLE' => $tab_plg[0][PL_DESCRIPTION],
							));
						}

						$template->assign_block_vars('r_admin.param_plugin.list_inst.tools', array(
							'TITLE' => $lang["gen_uninstall"],
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/del.gif',
							'LINK' =>  'index.php?page=adm_plugins.php&action=del&id='.$tab_plg[0][PL_ID],
						));
						$inst_plg++;
					}
					// Plugin installé et pas à jour
					elseif ($tab_plg[0][PL_VERSION] < $param["plg_version"])
					{
						$template->assign_block_vars('r_admin.param_plugin.list_update', array(
							'NAME' => $tab_plg[0][PL_TITLE],
							'VERSION' => $tab_plg[0][PL_VERSION],
							'COMP' => $param["plg_ouapi_vers_comp"],
							'TYPE' => $tab_plg[0][PL_TYPE],
							'PATH' => $directory.'/'.$tab_plg[0][PL_PATH],
						));

						if ($tab_plg[0][PL_DESCRIPTION] != '')
						{
							$template->assign_block_vars('r_admin.param_plugin.list_update.desc', array(
								'LIBELLE' => $tab_plg[0][PL_DESCRIPTION],
							));
						}

						$template->assign_block_vars('r_admin.param_plugin.list_update.tools', array(
							'TITLE' => $lang["gen_uninstall"],
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/del.gif',
							'LINK' =>  'index.php?page=adm_plugins.php&action=del&id='.$tab_plg[0][PL_ID],
						));
						$update_plg++;
					}

				}
			}
		}
		closedir( $hdir );

		if ($new_plg == 0)
		{
			$template->assign_block_vars('r_admin.param_plugin.no_new', array(
				'TEXT' => $lang["admin_plugin_nonew"],
			));
		}
		if ($update_plg == 0)
		{
			$template->assign_block_vars('r_admin.param_plugin.no_update', array(
				'TEXT' => $lang["admin_plugin_noupdate"],
			));
		}
		if ($inst_plg == 0)
		{
			$template->assign_block_vars('r_admin.param_plugin.no_inst', array(
				'TEXT' => $lang["admin_plugin_noinst"],
			));
		}
	}
	// Mise à jour de ouapi
	elseif (isset($_GET["action"]) && $_GET["action"] == 'maj_ouapi')
	{
		$template->assign_block_vars('r_admin.maj', array(
		  'TITLE' => $lang["admin_maj_title"],
		));
		// Controle de la version
		if ($fichier = @fopen('http://www.ouapi.org/downloads/flag.txt','r'))
		{
			while (!feof($fichier))
			{
				$ligne = fgets($fichier);
				$temp = explode('=',$ligne);
				$param[$temp[0]] = $temp[1];
			}
			fclose($fichier);

			//Controle de la version disponible sur le site
			if ($param["version"] > GEN_VERSION)
			{
				$template->assign_block_vars('r_admin.maj.new', array(
				  'TITLE' => $lang["admin_maj_newmajtitle"],
				  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
				  'TEXT' => $lang["admin_maj_newversionnum"].$param["version"],
				  'LINK_TEXT' => $lang["admin_maj_link"],
				  'LINK' => 'index.php?page=adm_ouapi.php&stage=1',
				));
			}
			else
			{
				$template->assign_block_vars('r_admin.maj.no', array(
				  'TITLE' => $lang["admin_maj_nomaj"]
				));

			}

		}

	}
	// NEWS + VERIF MAJ
	else
	{
		/*if ($fichier = @fopen('http://www.ouapi.org/downloads/flag.txt','r'))
		{
			while (!feof($fichier))
			{
				$ligne = fgets($fichier);
				$temp = explode('=',$ligne);
				$param[$temp[0]] = $temp[1];
			}
			fclose($fichier);

			//Controle de la version disponible sur le site
			if ($param["version"] > GEN_VERSION)
			{
				$template->assign_block_vars('r_admin.maj', array(
				  'TITLE' => $lang["admin_maj_newmajtitle"],
				  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
				  'TEXT' => $lang["admin_maj_newversionnum"].$param["version"],
				  'LINK_TEXT' => $lang["admin_maj_link"],
				  'LINK' => 'index.php?page=adm_ouapi.php&stage=1',
				));
			}
		}*/

		//Stats
		if (time()-GEN_DATEINSTALL > (60*24*3600) && GEN_STATSYN == 1)
		{
			if (GEN_STATSDATE == '')
			{
				$template->assign_block_vars('r_admin.stats', array(
				  'TITLE' => $lang["admin_title_statsalert"],
				  'SUBTITLE' => $lang["admin_title_statsthis"],
				  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
				  'BUTTONSEND' => $lang["admin_stats_buttonsend"],
				  'BUTTONNOTSEND' => $lang["admin_stats_buttonnotsend"],
				  'DETAILTITLE' => $lang["admin_stats_detailstitle"],

				));

				$template->assign_block_vars('r_admin.stats.infos', array(
				  'REFERENCEYES' => $lang["admin_stats_referenceyes"],
				  'REFERENCENO' => $lang["admin_stats_referenceno"],
				  'COMPANY' => $lang["admin_stats_companyname"],
				  'WEBSITE' => $lang["admin_stats_website"],
				  'CONTACT' => $lang["admin_stats_contact"],
				  'SUGGEST' => $lang["admin_stats_suggest"],
				  'COMMENT' => $lang["admin_stats_comment"],

				));


				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_versionlabel"],
				  'SHORTLABEL' => 'version',
				  'VALUE' => GEN_VERSION,
				));

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_installlabel"],
				  'SHORTLABEL' => 'install',
				  'VALUE' => GEN_DATEINSTALL,
				));

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_majlabel"],
				  'SHORTLABEL' => 'maj',
				  'VALUE' => GEN_DATELASTMAJ,
				));

				$requete = "SELECT * FROM ".TAB_USERS;
				$tab_users = $req1->db_use_query($requete);

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_userslabel"],
				  'SHORTLABEL' => 'users',
				  'VALUE' => count($tab_users),
				));

				$requete = "SELECT * FROM ".TAB_HARD." WHERE type_id='1' OR type_id='2'";
				$tab_hard = $req1->db_use_query($requete);

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_hardlabel"],
				  'SHORTLABEL' => 'hard',
				  'VALUE' => count($tab_hard),
				));

				$requete = "SELECT * FROM ".TAB_PERIPH;
				$tab_periph = $req1->db_use_query($requete);

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_periphlabel"],
				  'SHORTLABEL' => 'periph',
				  'VALUE' => count($tab_periph),
				));
			}
			//Envoi 2 fois par an (180j)
			elseif (time()-GEN_STATSDATE > (180*24*3600))
			{
				$template->assign_block_vars('r_admin.stats', array(
				  'TITLE' => $lang["admin_title_statsalert"],
				  'SUBTITLE' => $lang["admin_title_statsremind"],
				  'ICON' => 'templates/'.DEFAULT_TEMPLATE.'/images/sign_info.png',
				  'BUTTONSEND' => $lang["admin_stats_buttonsend"],
				  'BUTTONNOTSEND' => $lang["admin_stats_buttonnotsend"],
				  'DETAILTITLE' => $lang["admin_stats_detailstitle"],
				));

				$template->assign_block_vars('r_admin.stats.last_update', array(
				  'LABEL' => $lang["admin_stats_lastupdate"],
				  'VALUE' => GEN_STATSDATE,
				  'DATE' => date("d/m/Y",GEN_STATSDATE),
				));

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_versionlabel"],
				  'SHORTLABEL' => 'version',
				  'VALUE' => GEN_VERSION,
				));

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_installlabel"],
				  'SHORTLABEL' => 'install',
				  'VALUE' => GEN_DATEINSTALL,
				));

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_majlabel"],
				  'SHORTLABEL' => 'maj',
				  'VALUE' => GEN_DATELASTMAJ,
				));

				$requete = "SELECT * FROM ".TAB_USERS;
				$tab_users = $req1->db_use_query($requete);

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_userslabel"],
				  'SHORTLABEL' => 'users',
				  'VALUE' => count($tab_users),
				));

				$requete = "SELECT * FROM ".TAB_HARD." WHERE type_id='1' OR type_id='2'";
				$tab_hard = $req1->db_use_query($requete);

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_hardlabel"],
				  'SHORTLABEL' => 'hard',
				  'VALUE' => count($tab_hard),
				));

				$requete = "SELECT * FROM ".TAB_PERIPH;
				$tab_periph = $req1->db_use_query($requete);

				$template->assign_block_vars('r_admin.stats.details', array(
				  'LABEL' => $lang["admin_stats_details_periphlabel"],
				  'SHORTLABEL' => 'periph',
				  'VALUE' => count($tab_periph),
				));
			}

		}

		// RSS
		if (file_exists('temp/ouapi_rssfeed') && time()-filemtime('temp/ouapi_rssfeed') < (3600*24))
		{
			 $news = @RSS_Display('temp/ouapi_rssfeed', 2);
		}
		else
		{
			 if (@fopen('http://www.ouapi.org/feed/','r'))
			 {
				 $move = copy('http://www.ouapi.org/feed/','temp/ouapi_rssfeed');
				 $news = @RSS_Display('temp/ouapi_rssfeed', 4);
			 }
			 else
				$news = $lang["admin_rsserror"];
		}

		$template->assign_block_vars('r_admin.news', array(
			'TITLE_NEWS' => $lang["admin_news_ouapi"],
			'TEXT_NEWS' => $news
		));
	}

}

echo $affichage;
?>