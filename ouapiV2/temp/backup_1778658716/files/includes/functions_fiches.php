<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2012 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

class fiche EXTENDS db_use
{	
	var $lang;
	
	function fiche($lang)
	{		
		$this->lang = $lang;
	}
	
			
	// Historique MAJ logiciel
	function aff_histo_soft($s_id,$h_id) 
	{
		$req1 = new db_use;
		$requete = "SELECT * FROM ".TAB_HARDSOFT." WHERE hardware_id='".$h_id."' AND software_id='".$s_id."' ORDER BY version_date_maj DESC, version_num DESC";
		$tab_liaison = $req1->db_use_query($requete);
		$retour = '';

		$retour .= '<br/><table class="table">
		<tr>
			<td class="titre2" colspan="3">Historique</td>
		</tr>
		<tr>
			<td class="titre3">'.$this->lang["fiche_histomaj_date"].'</td>
			<td class="titre3">'.$this->lang["fiche_histomaj_version"].'</td>
			<td class="titre3">'.$this->lang["fiche_histomaj_user"].'</td>
		</tr>';

		//Affichage de l'historique
		$i = 0;
		while ($i < count($tab_liaison))
		{
			$requete = "SELECT * FROM ".TAB_USERS." WHERE id='".$tab_liaison[$i]["user_maj_id"]."'";
			$tab_user = $req1->db_use_query($requete);	
			
			if ($tab_liaison[$i]["version_num"] != 0 && $tab_liaison[$i]["version_num"] != NULL)
				$version = $tab_liaison[$i]["version_num"];
			else
				$version = '-';

			$retour .= '<tr>
				<td class="row1">'.format_date_to_aff($tab_liaison[$i]["version_date_maj"],'/').'</td>
				<td class="row1">'.$version.'&nbsp;</td>
				<td class="row1">'.$tab_user[0]["prenom"].' '.$tab_user[0]["nom"].'&nbsp;</td>
			</tr>';
			$i++;
		}
		
		$retour .= '</table>';

		return $retour;			
	}		
		
	function aff_ocs_soft_installed($s_id = 0, $ocs_id = 0)
	{
		$connect = new db_connect();
		$connect->connection();
		$req1 = new db_use;

		$retour = '';
		
		$retour .= '<table class="table" align="center">
		<tr>
			<td class="titre2" colspan="5"><img src="templates/'.DEFAULT_TEMPLATE.'/images/soft_icon.gif" style="vertical-align:middle" height="16">&nbsp;'.$this->lang["fiche_ocs_soft_installed_title"].'</td>
		</tr>
		<tr>
			<td class="titre3">'.$this->lang["hard"].'</td>
			<td class="titre3">'.$this->lang["user"].'</td>
			<td class="titre3">'.$this->lang["fiche_ocs_lastupdate"].'</td>
			<td class="titre3">'.$this->lang["fiche_ocsinfo"].'</td>
			<td class="titre3">'.$this->lang["fiche_serial"].'</td>
		</tr>';

		if  ($ocs_id != 0)
		{
			$connect->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

			// Infos du logiciel recherché
			$requete = "SELECT * FROM ".TAB_OCS_SOFT." WHERE ".COL_OCS_SOFT_ID."='".$ocs_id."'";
			$tab_soft_ocs = $req1->db_use_query($requete);
			
			$requete = "SELECT ".TAB_OCS_SOFT.".*,
			  ".TAB_OCS_HARD.".".COL_OCS_LASTDATE."
			FROM ".TAB_OCS_SOFT." 
			  LEFT JOIN ".TAB_OCS_HARD." ON ".TAB_OCS_HARD.".".COL_OCS_HARD_ID." = ".TAB_OCS_SOFT.".".COL_OCS_SOFT_HARDID." 
			WHERE ".TAB_OCS_SOFT." .".COL_OCS_SOFT_NAME."='".$tab_soft_ocs[0][COL_OCS_SOFT_NAME]."'";
			$tab_ocs = $req1->db_use_query_inv($requete);
			
			$requete = "SELECT ".COL_OCS_HARD_ID." AS id,
			  ".COL_OCS_HARD_NAME." AS nom,
			  ".COL_OCS_USERID." AS user_lname
			FROM ".TAB_OCS_HARD."
			WHERE ".TAB_OCS_HARD.".".constant("OCS_MASK_TYPE".$_GET["agence_id"])." LIKE '".str_replace('*','%',constant("OCS_MASK".$_GET["agence_id"]))."'";
			$tab_hard = $req1->db_use_query_inv($requete);
		}
		elseif ($s_id != 0)
		{
			// Cherche les alias OCS du logiciel
			$requete = "SELECT * FROM ".TAB_SOFT_OCS_ALIAS." WHERE ouapi_soft_id='".$s_id."'";
			$tab_alias = $req1->db_use_query_inv($requete);	
			
			if (count($tab_alias) > 0)
			{
				$liste_alias = TAB_OCS_SOFT.".".COL_OCS_SOFT_NAME."='".implode("' OR ".TAB_OCS_SOFT.".".COL_OCS_SOFT_NAME."='",$tab_alias["ocs_soft_name"])."'";
				
				$requete = "SELECT ".TAB_HARD.".*,
				  ".TAB_USERS.".nom AS user_lname,
				  ".TAB_USERS.".prenom AS user_fname
				FROM ".TAB_HARD." 
				  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_HARD.".user_id
				WHERE ".TAB_HARD.".agence_id='".$_GET["agence_id"]."'";
				$tab_hard = $req1->db_use_query_inv($requete);

				// Liste les postes de l'agence
				$requete = "SELECT ".TAB_HARD.".*,
				".TAB_HARD.".".constant("OCS_CRIT_BASE".intval($_GET["agence_id"]))." AS crit_base
				FROM ".TAB_HARD." 
				WHERE ".TAB_HARD.".agence_id='".intval($_GET["agence_id"])."'";
				$tab_hard_ouapi = $req1->db_use_query_inv($requete);

				$liste_hard = str_replace('#','\'',addslashes(constant("OCS_CRIT_OCS".intval($_GET["agence_id"]))."=#".implode("# OR ".constant("OCS_CRIT_OCS".intval($_GET["agence_id"]))."=#",$tab_hard_ouapi["crit_base"])."#"));			

				// Liste des postes ou le logiciel est installé
				$connect->connection(DB_OCS_HOST,DB_OCS_USER,DB_OCS_MDP,DB_OCS_TRANSM);

				$requete = "SELECT ".TAB_OCS_SOFT.".*,
				".constant("OCS_CRIT_OCS".$_GET["agence_id"])." AS crit_ocs,
				".TAB_OCS_HARD.".".COL_OCS_LASTDATE."
				FROM ".TAB_OCS_SOFT." 
				  LEFT JOIN ".TAB_OCS_HARD." ON ".TAB_OCS_HARD.".".COL_OCS_HARD_ID." = ".TAB_OCS_SOFT.".".COL_OCS_SOFT_HARDID." 
				  LEFT JOIN ".TAB_OCS_BIOS." ON ".TAB_OCS_BIOS.".".COL_OCS_BIOS_HARDID." = ".TAB_OCS_HARD.".".COL_OCS_HARD_ID."
				WHERE (".$liste_hard.") AND (".$liste_alias.")";
				$tab_ocs = $req1->db_use_query_inv($requete);
			}
		}
		
		$i = 0;
		$aff = 0;
		while ($i < count($tab_hard["id"]))
		{
			//echo $tab_hard[constant("OCS_CRIT_BASE".$_GET["agence_id"])][$i].'<br/>';
			if  ($s_id != 0 && count($tab_ocs) > 0)
				$keys_ocs = array_keys($tab_ocs["crit_ocs"],$tab_hard[constant("OCS_CRIT_BASE".$_GET["agence_id"])][$i]);
			elseif  ($ocs_id != 0)
				$keys_ocs = array_keys($tab_ocs[COL_OCS_SOFT_HARDID],$tab_hard["id"][$i]);
			else
				$keys_ocs = array();

			if (count($keys_ocs) > 0)
			{
				$retour .= '<tr>
					<td class="row1">'.$tab_hard["nom"][$i].'</td>
					<td class="row1">'.txt_to_na($tab_hard["user_lname"][$i].' '.$tab_hard["user_fname"][$i]).'</td>
					<td class="row1">'.format_date_to_aff($tab_ocs[COL_OCS_LASTDATE][$keys_ocs[0]]).'</td>
					<td class="row1">';
				
				$j = 0;
				while ($j < count($keys_ocs))
				{
					$retour .= utf8_decode($tab_ocs[COL_OCS_SOFT_NAME][$keys_ocs[$j]]).' '.$this->lang["fiche_soft_version"].' '.txt_to_na($tab_ocs[COL_OCS_SOFT_VERSION][$keys_ocs[$j]]).'<br/>';
					$j++;
				}
				$retour .= '</td>';
				$aff++;

				$connect->connection();
				
				$requete = "SELECT * FROM ".TAB_SOFT_LICENCE." 	WHERE hardware_id='".$tab_hard["id"][$i]."' AND software_id='".$s_id."'";
				$tab_licence = $req1->db_use_query($requete);
				
				$retour .= '<td class="row1">';
				
				$lic = '';
				$j = 0;
				while ($j < count($tab_licence))
				{
					$lic = $tab_licence[$j]["serial"].'<br/>';
					$j++;
				}
				$retour .= txt_to_na($lic);
								
				$retour .= '</td>';
				
				$retour .= '</tr>';

			}

			
			$i++;
		}

		if ($aff == 0)
		{
			$retour .= '<tr>
				<td class="no_record" colspan="5">'.$this->lang["fiche_hardinstall_nohard"].'</td>
			</tr>';
		}
		
		$retour .= '</table>';
		return $retour;
	}
	
}
?>