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

// Ajout
if (isset($_GET['action']) && $_GET['action'] == 'add')
{
	if (isset($_POST['soumettre']))
	{
		$err = array();
		$rs = format_string_db($_POST['rs']);

		$requete_verif = "SELECT raison_sociale FROM ".TAB_ENTREPRISE." WHERE raison_sociale='$rs'";
		$tab_verif = $req1->db_use_query($requete_verif);

		// Si le libelle n'existe pas déjà
		if (count($tab_verif) == 0)
		{			
			$requete = "INSERT INTO ".TAB_ENTREPRISE." (raison_sociale,adresse,cpostal,ville,telephone) VALUES ('".$rs."','".$_POST["adresse"]."',
			'".$_POST["cp"]."','".$_POST["ville"]."','".$_POST["tel"]."')";		
			$tab = $req1->db_use_query($requete);				
		}
		// Sinon >> Message d'erreur
		else
			array_push($err,$lang["adm_ext_err_rs"]);
			
		// Affichage
		if (count($err) == 0)
		{
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_ext_addok"], 					
				'CLOSE' => $lang["close"],	
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["return"],
				'ID' => 'mess_retour'
			));
		}
		else
		{
			$errors = $lang["adm_ext_adderror"].'<br/><br/>';
			
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
	else
	{
		$template->assign_block_vars('form', array(
		  'TITLE' => $lang["adm_ext_add"],
		  'ACTION' => 'index.php?page=adm_externes.php&action=add',
		  'BUTTON' => $lang["add"],
		));
	
		$template->assign_block_vars('form.compname', array(
		  'L_COMPNAME' => $lang["adm_ext_compname"],
		  'ID' => 'required'	
		));	
		
		$template->assign_block_vars('form.address', array(
		  'L_ADDRESS' => $lang["adm_ext_address"],
		));
		
		$template->assign_block_vars('form.cpostal', array(
		  'L_CPOSTAL' => $lang["adm_ext_cpostal"],
		));
		
		$template->assign_block_vars('form.city', array(
		  'L_CITY' => $lang["adm_ext_city"],
		));
		
		$template->assign_block_vars('form.phone', array(
		  'L_PHONE' => $lang["adm_ext_phone"],
		));
	}
}
/*******************************/
/*            Edition          */
/*******************************/
if (isset($_GET['action']) && $_GET['action'] == 'edit')
{
	if (isset($_POST['soumettre']))
	{
		$err = array();

		$requete_verif = "SELECT raison_sociale FROM ".TAB_ENTREPRISE." WHERE raison_sociale='".format_string_db($_POST["rs"])."' AND id<>'".$_GET["id"]."'";
		$tab_verif = $req1->db_use_query($requete_verif);

		// Si le libelle n'existe pas déjà
		if (count($tab_verif) == 0)
		{		
			$requete = "UPDATE ".TAB_ENTREPRISE." SET raison_sociale='".format_string_db($_POST["rs"])."', adresse='".$_POST["adresse"]."',
			cpostal='".$_POST["cp"]."', ville='".$_POST["ville"]."', telephone='".$_POST["tel"]."' WHERE id='".$_GET["id"]."'";			
			$tab = $req1->db_use_query($requete);				
		}
		// Sinon >> Message d'erreur
		else
			array_push($err,$lang["adm_ext_err_rs"]);
			
		// Affichage
		if (count($err) == 0)
		{
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_ext_editok"], 					
				'CLOSE' => $lang["close"],	
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["return"],
				'ID' => 'mess_retour'
			));
		}
		else
		{
			$errors = $lang["adm_ext_editerror"].'<br/><br/>';
			
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
	else
	{
		if (isset($_GET["id"]))
		{
			$requete = "SELECT * FROM ".TAB_ENTREPRISE." WHERE id='".$_GET["id"]."'";			
			$tab = $req1->db_use_query($requete);				
			
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_ext_edit_title"],
			  'ACTION' => 'index.php?page=adm_externes.php&action=edit&id='.$_GET["id"],
			  'BUTTON' => $lang["edit"],
			));
	
			$template->assign_block_vars('form.compname', array(
			  'L_COMPNAME' => $lang["adm_ext_compname"],
			  'ID' => 'ok',	
			  'VALUE' => $tab[0]["raison_sociale"],
			));	
			
			$template->assign_block_vars('form.address', array(
			  'L_ADDRESS' => $lang["adm_ext_address"],
			  'VALUE' => $tab[0]["adresse"],
			));
			
			$template->assign_block_vars('form.cpostal', array(
			  'L_CPOSTAL' => $lang["adm_ext_cpostal"],
			  'VALUE' => $tab[0]["cpostal"],
			));
			
			$template->assign_block_vars('form.city', array(
			  'L_CITY' => $lang["adm_ext_city"],
			  'VALUE' => $tab[0]["ville"],
			));
			
			$template->assign_block_vars('form.phone', array(
			  'L_PHONE' => $lang["adm_ext_phone"],
			  'VALUE' => $tab[0]["telephone"],
			));
		}
		else
		{
			$requete= "SELECT * FROM ".TAB_ENTREPRISE;
			$tab = $req1->db_use_query($requete);

			$template->assign_block_vars('select', array(
			  'TITLE' => $lang["adm_ext_edit_title"],
			));

			// On affiche les en tete de colonne s'il y a au moins 1 résultat
			if (count($tab) > 0)
			{
				$template->assign_block_vars('select.companies', array(
				  'L_COMPNAME' => $lang["adm_ext_compname"],
				  'L_ADDRESS' => $lang["adm_ext_address"],
				  'L_CPOSTAL' => $lang["adm_ext_cpostal"],
				  'L_CITY' => $lang["adm_ext_city"],
				  'L_TOOLS' => $lang["tools"],
				));
								
				$i = 0;
				while ($i < count($tab))
				{
					$template->assign_block_vars('select.companies.list', array(
					  'COMPNAME' => txt_to_na($tab[$i]["raison_sociale"]),
					  'ADDRESS' => txt_to_na($tab[$i]["adresse"]),
					  'CPOSTAL' => txt_to_na($tab[$i]["cpostal"]),
					  'CITY' => txt_to_na($tab[$i]["ville"]),
					  'TOOL_LINK' => $_SERVER['REQUEST_URI'].'&id='.$tab[$i]["id"],
					  'TOOL_TITLE' => $lang["edit"],
					  'TOOL_IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/edit.gif',
					));
					
					$i++;
				}

			}
			else
			{
				$template->assign_block_vars('select.no_companies', array(
				  'MESSAGE' => $lang["adm_ext_no_rs"],
				));
			}
		}

	}
}

// Suppression
if (isset($_GET['action']) && $_GET['action'] == 'del')
{
	if (isset($_POST['soumettre']))
	{
		$requete = "DELETE FROM ".TAB_ENTREPRISE." WHERE id='".$_GET["id"]."'";
		$tab = $req1->db_use_query($requete);

			$template->assign_block_vars('form_post', array(
				'OK' => $lang["adm_ext_delok"], 					
				'CLOSE' => $lang["close"],	
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["return"],
				'ID' => 'mess_retour'
			));
	}
	// Formulaire
	else
	{
		if (isset($_GET["id"]))
		{
			$requete = "SELECT * FROM ".TAB_ENTREPRISE." WHERE id='".$_GET["id"]."'";			
			$tab = $req1->db_use_query($requete);				
			
			$template->assign_block_vars('form', array(
			  'TITLE' => $lang["adm_ext_del_title"],
			  'ACTION' => 'index.php?page=adm_externes.php&action=del&id='.$_GET["id"],
			  'BUTTON' => $lang["delete"],
			));
					
			$template->assign_block_vars('form.compname', array(
			  'L_COMPNAME' => $lang["adm_ext_compname"],
			  'VALUE' => $tab[0]["raison_sociale"],
			  'DISABLED' => 'disabled',
			));	
		}
		else
		{
			$requete= "SELECT * FROM ".TAB_ENTREPRISE;
			$tab = $req1->db_use_query($requete);

			$template->assign_block_vars('select', array(
			  'TITLE' => $lang["adm_ext_del_title"]
			  ,
			));

			// On affiche les en tete de colonne s'il y a au moins 1 résultat
			if (count($tab) > 0)
			{
				$template->assign_block_vars('select.companies', array(
				  'L_COMPNAME' => $lang["adm_ext_compname"],
				  'L_ADDRESS' => $lang["adm_ext_address"],
				  'L_CPOSTAL' => $lang["adm_ext_cpostal"],
				  'L_CITY' => $lang["adm_ext_city"],
				  'L_TOOLS' => $lang["tools"],
				));
								
				$i = 0;
				while ($i < count($tab))
				{
					$template->assign_block_vars('select.companies.list', array(
					  'COMPNAME' => txt_to_na($tab[$i]["raison_sociale"]),
					  'ADDRESS' => txt_to_na($tab[$i]["adresse"]),
					  'CPOSTAL' => txt_to_na($tab[$i]["cpostal"]),
					  'CITY' => txt_to_na($tab[$i]["ville"]),
					  'TOOL_LINK' => $_SERVER['REQUEST_URI'].'&id='.$tab[$i]["id"],
					  'TOOL_TITLE' => $lang["delete"],
					  'TOOL_IMAGE' => 'templates/'.DEFAULT_TEMPLATE.'/images/delete.gif',
					));
					
					$i++;
				}

			}
			else
			{
				$template->assign_block_vars('select.no_companies', array(
				  'MESSAGE' => $lang["adm_ext_no_rs"],
				));
			}
		}
		
	}
}

echo $affichage;

?>