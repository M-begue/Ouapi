<?php 

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                            OUAPI langue pack                              *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

//Etape 1: Vérif du fichier et mappage des colonnes
if (!isset($_GET["etape"]))
{
	$template->assign_block_vars('form', array(
	));
	
	$extensions_ok = array('csv','CSV','Csv','txt','TXT','Txt');  
	if(isset($_FILES['fichier']) && $_FILES['fichier']['tmp_name'] != "" && in_array( substr(strrchr($_FILES['fichier']['name'], '.'), 1), $extensions_ok ))
	{  
		$array_sep = array('pv', 'vir', 'dp', 'dz');
		$array_sepchar = array(';' , ',' , ':' , '#');
		$cle = array_search($_POST["sep"],$array_sep);
		$sep = $array_sepchar[$cle];

		$template->assign_block_vars('form.etape1', array(
		));
		
		$table = $_POST["table"];
		$site = $_POST["agence_id"];

		$name_ok = '/tmp_import.'.substr(strrchr($_FILES['fichier']['name'], '.'), 1);
		move_uploaded_file($_FILES['fichier']['tmp_name'], $name_ok);  
		
		$fp = fopen($name_ok,"r");	

		$ligne = fgets($fp, 4096);
		$tmp = explode($sep,$ligne);	
		$ligne2 = fgets($fp, 4096);
		$tmp2 = explode($sep,$ligne2);	
		
		$i = 0;
		while ($i < count($tmp))
		{
			$template->assign_block_vars('form.etape1.mappage', array(
				'EXEMPLE_VALUE' => format_string_input($tmp[$i]),	
				'EXEMPLE_VALUE2' => format_string_input($tmp2[$i]),		
			));
			$i++;
		}
		
		fclose($fp);
			
	}
	else
	{
	
	}
}
?>
