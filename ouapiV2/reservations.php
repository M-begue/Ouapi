<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2010 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use;

// Ajout d'une réservation
if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_POST['soumettre']))
{
	$err = array();
	$agence_id = $_POST['agence_id'];
	$user_id = $_POST['user_id'];
		
	$date_deb = mktime($_POST['heure_deb'],$_POST['min_deb'],0,substr($_POST['date_deb'],3,2),substr($_POST['date_deb'],0,2),substr($_POST['date_deb'],6,4));
	$date_fin = mktime($_POST['heure_fin'],$_POST['min_fin'],0,substr($_POST['date_fin'],3,2),substr($_POST['date_fin'],0,2),substr($_POST['date_fin'],6,4));
	
	//Controle si la date de début est inférieure à la date de fin
	if ($date_deb > $date_fin)
		array_push($err,$lang["reserv_startenddateerr"]);

	// Controle si les dates de début et fin sont valides
	if (checkdate(substr($_POST['date_fin'],3,2), substr($_POST['date_fin'],0,2), substr($_POST['date_fin'],6,4)) == FALSE)
		array_push($err,$lang["reserv_enddateerr"].$date_fin);
	if (checkdate(substr($_POST['date_deb'],3,2), substr($_POST['date_deb'],0,2), substr($_POST['date_deb'],6,4)) == FALSE)
		array_push($err,$lang["reserv_startdateerr"].$date_frb);

	if (isset($_POST['hard_id']))
		$requete = "SELECT * FROM ".TAB_RESA." WHERE hard_id='".$_POST['hard_id']."' && (date_deb < '".$date_fin."' && date_fin > '".$date_deb."')";
	elseif (isset($_POST['periph_id']))
		$requete = "SELECT * FROM ".TAB_RESA." WHERE periph_id='".$_POST['periph_id']."' && (date_deb < '".$date_fin."' && date_fin > '".$date_deb."')";

	$tab_deb = $req1->db_use_query($requete);			

	if (count($tab_deb) > 0)
		array_push($err,$lang["reserv_datenokerr"]);

	$object = format_string_db($_POST['object']);

	if (count($err) == 0)
	{
		if (isset($_POST['hard_id']))
			$requete = "INSERT INTO ".TAB_RESA." (site_id,user_id,hard_id,object,date_deb,date_fin) VALUES ('".$agence_id."','".$user_id."','".$_POST['hard_id']."','".$object."','".$date_deb."','".$date_fin."')";
		elseif (isset($_POST['periph_id']))
			$requete = "INSERT INTO ".TAB_RESA." (site_id,user_id,periph_id,object,date_deb,date_fin) VALUES ('".$agence_id."','".$user_id."','".$_POST['periph_id']."','".$object."','".$date_deb."','".$date_fin."')";

		$tab = $req1->db_use_query($requete);

		$template->assign_block_vars('form_post', array(
			'OK' => $lang["reserv_addok"], 					
			'CLOSE' => $lang["close"],	
			'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
			'BACK' => $lang["return"],
			'ID' => 'mess_retour'
		));
	}
	else
	{
		$errors = $lang["reserv_addnok"].'<br/><br/>';
		
		while(list($key, $val) = each($err))
		{ 
			$aff_key = $key+1;
			$errors .= $aff_key.') '.$val.'<br/>';
		}
			
		$template->assign_block_vars('form_post', array(
			'OK' => $errors, 					
			'CLOSE' => $lang["close"],	
			'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
			'BACK' => $lang["return"]	,
			'ID' => 'alert'
		));
	}
}
// Suppression d'une réservation
elseif (isset($_GET['action']) && $_GET['action'] == 'Supprimer')
{
	$requete = "DELETE FROM ".TAB_RESA." WHERE id='".$_GET["id"]."'";
	$tab = $req1->db_use_query($requete);

	$template->assign_block_vars('form_post', array(
		'OK' => $lang["reserv_delok"], 					
		'CLOSE' => $lang["close"],	
		'BACK_PAGE' => $_SERVER['HTTP_REFERER'],
		'BACK' => $lang["return"]	,
		'ID' => 'mess_retour'
	));
}
// Gestion des réservations
elseif (isset($_GET['action']) && $_GET['action'] == 'Gerer')
{
	if (isset($_GET["hard_id"]))
	{
		$cat["table"] = "TAB_HARD";
		$cat["type"] = "hard";
		
	}
	elseif(isset($_GET["periph_id"]))
	{
		$cat["table"] = "TAB_PERIPH";
		$cat["type"] = "periph";	
	}

	// MATERIEL
	$tab = $req1->db_use_query("SELECT ".constant($cat["table"]).".*,
	  ".constant($cat["table"].'_MARQUE').".libelle AS l_marque,
	  ".constant($cat["table"].'_MODELE').".libelle AS l_modele	
	FROM ".constant($cat["table"])." 
	  LEFT JOIN ".constant($cat["table"].'_MARQUE')." ON ".constant($cat["table"].'_MARQUE').".id = ".constant($cat["table"]).".marque_id
	  LEFT JOIN ".constant($cat["table"].'_MODELE')." ON ".constant($cat["table"].'_MODELE').".id = ".constant($cat["table"]).".modele_id
	WHERE ".constant($cat["table"]).".id='".$_GET[$cat["type"].'_id']."'");

	// Formulaire d'ajout
	$template->assign_block_vars('form', array(
		'TITLE' => $lang["reserv_add"],
		'ACTION' => 'index.php?page=reservations.php&action=add',
		'L_HARD' => $lang["reserv_hard"],
		'L_USER' => $lang["reserv_user"],
		'L_OBJ' => $lang["reserv_object"],
		'HARDNAME' => $tab[0]['nom'].' ('.txt_to_na($tab[0]["l_marque"]).' - '.txt_to_na($tab[0]["l_modele"]).')',
		'AGENCE_ID' => $_GET['agence_id'],
		'L_ADD' => $lang["reserv_addbutton"],
		'TYPE_NAME' => $cat["type"].'_id',
		'TYPE_ID' => $_GET[$cat["type"].'_id'],
		'IMG_CALENDAR' => 'templates/'.DEFAULT_TEMPLATE.'/images/resa.gif',
		'L_STARTDATE' => $lang["reserv_startdate"],
		'L_ENDDATE' => $lang["reserv_enddate"],
		'SELECT_STHOUR' => form_genselect('heure_deb','class="non_form"',array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
		array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'),8),
		'SELECT_STMIN' => form_genselect('min_deb','class="non_form"',array(0,15,30,45),array('00','15','30','45'),0),
		'SELECT_ENDHOUR' => form_genselect('heure_fin','class="non_form"',array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
		array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'),18),
		'SELECT_ENDMIN' => form_genselect('min_fin','class="non_form"',array(0,15,30,45),array('00','15','30','45'),0),
		
	));
		
	// SITE
	// Si l'utilisateur a les droits d'édition
	if (preg_match('`;'.RGHT_RESA_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
	{
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
	}
	// Si l'utilisateur n'a PAS les droits d'édition
	else
	{
		$template->assign_block_vars('form.user', array(
			'ID' => $_SESSION["user_id"],
			'SELECTED' => 'selected',
			'USERNAME' => $_SESSION["nom_comp"]		
		));		
	}



	// UTILISATEUR
	// Si l'utilisateur a les droits d'édition
	if (preg_match('`;'.RGHT_RESA_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
	{
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE agence_id='".$_GET["agence_id"]."' ORDER BY nom");
		
		$i = 0;
		while ($i < count($tab))
		{
			
			if ($tab[$i]['id'] == $_SESSION["user_id"])
			{
				$template->assign_block_vars('form.user', array(
					'ID' => $tab[$i]['id'],
					'SELECTED' => 'selected',
					'USERNAME' => $tab[$i]['nom'].' '.$tab[$i]["prenom"]
				));
			}
			else
			{
				$template->assign_block_vars('form.user', array(
					'ID' => $tab[$i]['id'],
					'USERNAME' => $tab[$i]['nom'].' '.$tab[$i]["prenom"]
				));
			}

			$i++;
		}
	}
	else
	{
		$template->assign_block_vars('form.user', array(
			'ID' => $_SESSION["user_id"],
			'SELECTED' => 'selected',
			'USERNAME' => $_SESSION["nom_comp"]		
		));		
	}
						
	// calendrier des réservations
	$cal = new calendrier($lang);
	
	if (isset($_GET["hard_id"]))
	{
		$template->assign_block_vars('form.calendar', array(
		  'L_TITLE' => $lang["reserv_cal"],
		  'CAL' => $cal->aff_calendrier($_GET["mois"],$_GET["annee"],$_GET["hard_id"],'hard')
		));
	}
	elseif(isset($_GET["periph_id"]))
	{
		$template->assign_block_vars('form.calendar', array(
		  'L_TITLE' => $lang["reserv_cal"],
		  'CAL' => $cal->aff_calendrier($_GET["mois"],$_GET["annee"],$_GET["periph_id"],'periph')
		));
	}
	
	// Historique des réservations
	if (preg_match('`;'.RGHT_RESA_EDIT.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
	{
		if (isset($_GET["hard_id"]))
		{
			$requete = "SELECT ".TAB_RESA.".*,
			  ".TAB_USERS.".nom AS U_nom,
			  ".TAB_USERS.".prenom AS U_prenom
			FROM ".TAB_RESA." 
			  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_RESA.".user_id
			WHERE hard_id='".$_GET["hard_id"]."' ORDER BY date_deb DESC";
		}
		elseif(isset($_GET["periph_id"]))
		{
			$requete = "SELECT ".TAB_RESA.".*,
			  ".TAB_USERS.".nom AS U_nom,
			  ".TAB_USERS.".prenom AS U_prenom
			FROM ".TAB_RESA." 
			  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_RESA.".user_id
			WHERE periph_id='".$_GET["periph_id"]."' ORDER BY date_deb DESC";
		}
		
		$tab_resa = $req1->db_use_query($requete);			

		if (count($tab_resa) > 0)
		{
			$template->assign_block_vars('form.histo', array(
			  'L_TITLE' => $lang["reserv_histo"],
			  'L_USER' => $lang["user"],
			  'L_OBJECT' => $lang["reserv_object"],
			  'L_STARTDATE' => $lang["reserv_dated"],
			  'L_ENDDATE' => $lang["reserv_datef"],
			  'L_TOOLS' => $lang["tools"],		
			));
			
			$i = 0;
			while ($i < count($tab_resa))
			{						
				$template->assign_block_vars('form.histo.list', array(
				  'USER' => $tab_resa[$i]["U_prenom"].' '.$tab_resa[$i]["U_nom"],				
				  'OBJECT' => txt_to_na($tab_resa[$i]["object"]),				
				  'STARTDATE' => date("d/m/Y H:i",$tab_resa[$i]["date_deb"]),				
				  'ENDDATE' => date("d/m/Y H:i",$tab_resa[$i]["date_fin"]),				
				));

					
				if ((preg_match('`;'.RGHT_RESA_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10) && $tab_resa[$i]["date_fin"] >= time())
				{
						$template->assign_block_vars('form.histo.list.tools', array(
							'LINK' => 'index.php?page=reservations.php&id='.$tab_resa[$i]["id"].'&action=Supprimer',
							'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
							'TITLE' => $lang["delete"]
						));
				}
				
				$i++;
			}
		}
	}
}
elseif (isset($_GET['action']) && $_GET['action'] == 'view')
{
	if (isset($_GET["hard_id"]))
	{
		$cat["table"] = "TAB_HARD";
		$cat["type"] = "hard";
		
	}
	elseif(isset($_GET["periph_id"]))
	{
		$cat["table"] = "TAB_PERIPH";
		$cat["type"] = "periph";	
	}


	// MATERIEL
	$tab = $req1->db_use_query("SELECT ".constant($cat["table"]).".*,
	  ".constant($cat["table"].'_MARQUE').".libelle AS l_marque,
	  ".constant($cat["table"].'_MODELE').".libelle AS l_modele	
	FROM ".constant($cat["table"])." 
	  LEFT JOIN ".constant($cat["table"].'_MARQUE')." ON ".constant($cat["table"].'_MARQUE').".id = ".constant($cat["table"]).".marque_id
	  LEFT JOIN ".constant($cat["table"].'_MODELE')." ON ".constant($cat["table"].'_MODELE').".id = ".constant($cat["table"]).".modele_id
	WHERE ".constant($cat["table"]).".id='".$_GET[$cat["type"].'_id']."'");

						
	// calendrier des réservations
	$cal = new calendrier($lang);
	
	if (isset($_GET["hard_id"]))
	{
		$mat_id = $_GET["hard_id"];
		$mat_type = 'hard';
	}
	elseif(isset($_GET["periph_id"]))
	{
		$mat_id = $_GET["periph_id"];
		$mat_type = 'periph';
	}

	if (isset($_GET["week"]))
	{
		$template->assign_block_vars('view', array(
		  'L_TITLE' => $lang["reserv_cal"],
		  'CAL' => $cal->aff_calendrier_week($_GET["week"],$_GET["annee"],$mat_id,$mat_type)
		));	
	}
	else
	{
		$template->assign_block_vars('view', array(
		  'L_TITLE' => $lang["reserv_cal"],
		  'CAL' => $cal->aff_calendrier($_GET["mois"],$_GET["annee"],$mat_id,$mat_type)
		));	
	}
	
	$template->assign_block_vars('view.print', array(
		'LINK' => 'javascript:window.print()',
		'IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/impr_mini.gif',
		'TEXT' => $lang["gen_print"]
	));

}

?>