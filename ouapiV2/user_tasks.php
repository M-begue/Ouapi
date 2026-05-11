<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2012 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$req1 = new db_use;
$affichage = '';

/* Changer son mot de passe */

if (isset($_GET['action']) && $_GET['action'] == 'change_mdp')
{
	if (isset($_POST['soumettre']))
	{
		$errors = array();
		$tab_mdp = $req1->db_use_query("SELECT id,mdp FROM ".TAB_USERS." WHERE id='".$_SESSION["user_id"]."'");
		
		// Controle des erreurs
		if (count($tab_mdp) == 0 || !password_verify($_POST['oldpass'], $tab_mdp[0]['mdp']))
			array_push($errors, $lang["user_error_oldmdp"]);
		if ($_POST['pass'] == '')
			array_push($errors, $lang["user_error_blank"]);
		if ($_POST['pass'] != $_POST['confirm_pass'])
			array_push($errors, $lang["user_error_confirm"]);		
		
		if (count($errors) == 0)
		{
			$requete = "UPDATE ".TAB_USERS." SET mdp='".password_hash($_POST['pass'], PASSWORD_BCRYPT)."' WHERE id='".$_POST['user_id']."'";
			$tab = $req1->db_use_query($requete);
			
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["user_changemdpok"], 
				'CLOSE' => $lang["close"],
				'ID' => 'mess_retour'
			));
		}
		else
		{
			$err = $lang["user_changemdpnok"].'<br/><br/>';
			
			while(list($key, $val) = each($errors))
			{ 
				$aff_key = $key+1;
				$err .= $aff_key.') '.$val.'<br/>';
			}

			$template->assign_block_vars('form_post', array(
				'OK' => $err, 					
				'CLOSE' => $lang["close"],	
				'ID' => 'alert'
			));
			
			$template->assign_block_vars('form_post.back', array(
				'BACK_PAGE' => $_SERVER['HTTP_REFERER'],	
				'BACK' => $lang["return"],
			));			
		}
	}
	else
	{
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE id='".$_SESSION["user_id"]."'");

		$template->assign_block_vars('form', array(
			'TITLE' => $lang["adm_user_title_mdp"],
			'ACTION' => 'index.php?page=user_tasks.php&amp;action=change_mdp',
			'L_USERNAME' => $lang["adm_user_name"],
			'L_FIRSTNAME' => $lang["adm_user_firstname"],
			'L_OLDPWD' => $lang["user_oldpassword"],
			'L_NEWPWD' => $lang["user_newpassword"],
			'L_CONFIRMNEWPWD' => $lang["user_confirm_password"],
			'USERNAME' => $tab[0]['nom'],
			'FIRSTNAME' => $tab[0]['prenom'],
			'USER_ID' => $tab[0]['id'],
			'BUTTON' => $lang["edit"],
		));
		
	}
}
elseif (isset($_GET['action']) && $_GET['action'] == 'add_link')
{
	if (isset($_POST['soumettre']))
	{
		$errors = array();

		$libelle = format_string_db($_POST['libelle']);
		$link = format_string_db($_POST['link']);
		$color = $_POST['color'];
		$target = $_POST['target'];
		$image = $_POST['image'];
		$user_id = $_POST['user_id'];
		
		if (count($errors) == 0)
		{
			$requete = "INSERT INTO ".TAB_USERS_PL." (".UT_PL_USERID.", ".UT_PL_LIBELLE.",".UT_PL_LINK.",".UT_PL_COLOR.",".UT_PL_TARGET.",".UT_PL_IMAGE.")
			VALUES ('".$user_id."', '".$libelle."', '".$link."', '".$color."', '".$target."', '".$image."')";
			$tab = $req1->db_use_query($requete);
			
			$template->assign_block_vars('form_post', array(
				'OK' => $lang["user_addlinkok"], 
				'CLOSE' => $lang["close"],
				'ID' => 'mess_retour'
			));
		}
	}
	else
	{
		$tab = $req1->db_use_query("SELECT * FROM ".TAB_USERS." WHERE id='".$_SESSION["user_id"]."'");

		$template->assign_block_vars('form_addlink', array(
		  'ACTION' => 'index.php?page=user_tasks.php&amp;action=add_link',
		  'TITLE' => $lang["user_addlink_title"],
		  'L_LIBELLE' => $lang["user_addlink_libelle"],
		  'L_LINK' => $lang["user_addlink_link"],
		  'L_COLOR' => $lang["user_addlink_color"],
		  'L_TARGET' => $lang["user_addlink_target"],
		  'L_TARGET_BLANK' => $lang["user_addlink_target_blank"],
		  'L_TARGET_SELF' => $lang["user_addlink_target_self"],
		  'L_IMAGE' => $lang["user_addlink_image"],
		  'L_PREVIEW' => $lang["gen_preview"],
		  'BUTTON' => $lang["add"],
		  'PREVIEW_STYLE' => 'position:relative;
			background-color:#2956B2;
			background-image: linear-gradient(to right bottom, #2956B2, #FFF)',
		));

		// Couleur de bouton
$colors = array('2956B2','669DF0','BB00BB', 'CC0000','FF0000', 'FFA0A0', 'FFCCCC','FF9911', 'FFFF00', 'FFFFBB','00AA00', 'A0FFA0', '000000', 'AAAAAA', 'F0F0F0');		$i = 0;
		while($i < count($colors))
		{
			$template->assign_block_vars('form_addlink.colors', array(
				'COLOR' => $colors[$i],
				'ONCLICK' => 'form.color.value=\''.$colors[$i].'\';
				document.getElementById(\'preview\').style.backgroundColor=\'#'.$colors[$i].'\';
				document.getElementById(\'preview\').style.backgroundImage=\'linear-gradient(to right bottom, #'.$colors[$i].', #000)\';',
			));
			$i++;
		}

		// Images
		$i = 0;
		$dir = "images/gallery/";
		if (is_dir($dir) && $dh = opendir($dir)) 
		{
			while (($file = readdir($dh)) !== false) 
			{
				if ($file[0] != '.')
				{
					$template->assign_block_vars('form_addlink.image', array(
						'SRC' => $dir.'/'.$file,
						'ONCLICK' => 'form.image.value=\''.$file.'\';
						document.getElementById(\'preview_image\').src=\''.$dir.'/'.$file.'\'',
					));
					
				}
				
			}
			closedir($dh);
		}		
		
		// Visible apr l'utilisateur ou par tous
		if (preg_match('`;'.RGHT_ADMIN.';`',$_SESSION["grp_rights"]) || $_SESSION["user_grp"] == 10)
		{
			$template->assign_block_vars('form_addlink.user', array(
			  'L_VISIBLE' => $lang["user_addlink_user"],		  			
			  'ID' => $_SESSION["user_id"],		  			
			  'MYNAME' => $_SESSION["nom_comp"],		  			
			  'L_ALL' => $lang["user_addlink_allusers"],		  			
			));		
		}
		else
		{
			$template->assign_block_vars('form_addlink.user_hidden', array(
			  'USER_ID' => $_SESSION["user_id"],		  
			));		
		}
	}
}
elseif (isset($_GET['action']) && $_GET['action'] == 'del_link')
{
	$requete = "DELETE FROM ".TAB_USERS_PL." WHERE ".UT_PL_ID."='".intval($_GET["id"])."'";
	$tab = $req1->db_use_query($requete);
		
	$template->assign_block_vars('form_post', array(
		'OK' => $lang["user_dellinkok"], 
		'CLOSE' => $lang["close"],
		'ID' => 'mess_retour'
	));
}

echo $affichage;
?>