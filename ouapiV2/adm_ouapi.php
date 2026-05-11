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

$majrootdir = './';
$temp_path = 'temp';
$save_path = $temp_path.'/save_'.GEN_VERSION;

if (isset($_GET["stage"]) && $_GET["stage"] == 1)
{
	
	$template->assign_block_vars('maj_stage1', array(
	  'TITLE' => $lang["autoupdate_stage1_title"],
	  'TEXT' => $lang["autoupdate_stage1_text"],
	  'CONTINUE' => $lang["autoupdate_continue"],
	  'UPLOAD' => $lang["autoupdate_stage1_upload"],
	  'DOWNLOAD' => $lang["autoupdate_stage1_download"],
	));
}
if (isset($_GET["stage"]) && $_GET["stage"] == 2)
{	
	$check = 0;
	$array_test = array();
	
	$template->assign_block_vars('maj_stage2', array(
		'TITLE' => $lang["autoupdate_stage2_title"],
		'TEXT' => $lang["autoupdate_stage2_text"],
		'PARAMETERS' => $lang["autoupdate_parameters"],
		'RESULTS' => $lang["autoupdate_results"],
		'DEFAULT_TEMPLATE' => DEFAULT_TEMPLATE,
	));
	
	// ETAPE 1 >> Verif et/ou création du repertoire temp
	if (is_dir($temp_path))
	{
		array_push($array_test, array('name' => 'temp_exists', 'result' => 1));		
		$check++;
	}
	else
	{
		if (mkdir($temp_path,0777,TRUE))
		{
			array_push($array_test, array('name' => 'temp_mkdir', 'result' => 1));		
			$check++;	
		}
		else
		{
			array_push($array_test, array('name' => 'temp_mkdir', 'result' => 0, 'message' => $temp_path));		
		}

	}
	
	
	// ETAPE 2 >> Verif et/ou creation du repertoire de sauvegarde
	if (is_dir($save_path))
	{
		array_push($array_test, array('name' => 'save_exists', 'result' => 0, 'message' => 'Delete directory: '.$save_path));		
	}
	else
	{
		if (mkdir($save_path,0777,TRUE))
		{
			array_push($array_test, array('name' => 'save_mkdir', 'result' => 1));		
			$check++;
		}
		else
		{
			array_push($array_test, array('name' => 'save_mkdir', 'result' => 0, 'message' => $save_path));				
		}
	}
	
	// ETAPE 3 >> Vérification de la dispo de l'extension ZIP
	if (extension_loaded("zip"))
	{
		$check++;
		array_push($array_test, array('name' => 'phpzip_active', 'result' => 1));		
	}
	else
	{
		if (dl('zip')) 
		{
			$check++;
			array_push($array_test, array('name' => 'phpzip_activation', 'result' => 1));		
		}
		else
		{
			array_push($array_test, array('name' => 'phpzip_activation', 'result' => 0));			
		}
	}


	// Si fichier déposé dans formulaire etape1
	if($_POST["uploadtype"] == 'uploadfile')
	{  
		if (isset($_FILES['doc']) && $_FILES['doc']['name'] != "")
		{
			$extensions_ok = array('ZIP');  
			$taille_max = 10000000;  
					
			// Controles
			if ( !in_array( strtoupper(substr(strrchr($_FILES['doc']['name'], '.'), 1)), $extensions_ok ) )
			{
				array_push($array_test, array('name' => 'ouapi_upload_type', 'result' => 0, 'message' => 'Filetype error'));			
			}
			else
			{
				$check++;
				array_push($array_test, array('name' => 'ouapi_upload_type', 'result' => 1));			
			}

			if ( file_exists($_FILES['doc']['tmp_name']) && filesize($_FILES['doc']['tmp_name']) > $taille_max)
			{
				array_push($array_test, array('name' => 'ouapi_upload_size', 'result' => 0, 'message' => 'Filesize error'));			
			}
			else
			{
				$check++;
				array_push($array_test, array('name' => 'ouapi_upload_size', 'result' => 1));			
			}
				
			$filepath = $_FILES['doc']['tmp_name'];
		}
		else
			array_push($array_test, array('name' => 'ouapi_upload_empty', 'result' => 0));			
	}
	// Si fichier chargé sur ouapi.org
	else
	{
		if ($myfile = @fopen('http://www.ouapi.org/downloads/current_version.zip','r'))
		{
			$check++;
			$check++;		
			array_push($array_test, array('name' => 'ouapi_download', 'result' => 1));					
			fclose($myfile);
		}
		else
			array_push($array_test, array('name' => 'ouapi_download', 'result' => 0));			
	}
		
	
	// Traitement si aucune erreur de verif
	if($check == 5)  
	{  
		$check2 = 0;
		
		// Sauvegarde des fichiers actuels
		$CopieRecursive=new FileRecursive();
		$CopieRecursive->copie('./', $save_path, '', 1,'',1, array('temp'));
		array_push($array_test, array('name' => 'files_save', 'result' => 1, 'message' => $save_path));
		$check2++;		
		
		// Dump de la base SQL actuelle
		$return = '';
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
		
		foreach($tables as $table)
		{
			$result = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);
			
			$return.= 'DROP TABLE '.$table.';';
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysql_fetch_row($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("`\n`","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}
		
		$handle = fopen($save_path.'/db-backup.sql','w+');
		fwrite($handle,$return);
		fclose($handle);
		
		if (fopen($save_path.'/db-backup.sql','r'))
		{
			$check2++;
			array_push($array_test, array('name' => 'db_save', 'result' => 1, 'message' => $save_path.'/db-backup.sql'));

		}
		else
		{
			array_push($array_test, array('name' => 'db_save', 'result' => 0));		
		}
		
		// formatage nom fichier 
		$dest_fichier = time().'.zip';				
		if($_POST["uploadtype"] == 'uploadfile')
		{  
			move_uploaded_file($_FILES['doc']['tmp_name'], $temp_path.'/'.$dest_fichier);  
			array_push($array_test, array('name' => 'zip_move', 'result' => 1));		
		}
		else
		{
			$move = copy('http://www.ouapi.org/downloads/current_version.zip',$temp_path.'/'.$dest_fichier);
			array_push($array_test, array('name' => 'zip_move', 'result' => 1));		
		}
			
		// Controle de l'archive
		$zip = new ZipArchive();
		if($zip->open( $temp_path.'/'.$dest_fichier) == TRUE)	
		{
			$check2++;
			array_push($array_test, array('name' => 'zip_open', 'result' => 1));
			
			// Recherche du fichier version
			for ($i=0; $i<$zip->numFiles;$i++) {
				$fileindex[$i] = $zip->statIndex($i);
				
				if (stripos($fileindex[$i]["name"],'ouapi_version.ini') !== FALSE)
					$version_fileindex = $fileindex[$i]["index"];					
			}
			
			if (isset($version_fileindex))
			{
				array_push($array_test, array('name' => 'ini_search', 'result' => 1));		
				
				// Extraction du fichier version
				$version_filename = $zip->getNameIndex($version_fileindex);
				if ($zip->extractTo($temp_path, $version_filename))
				{
					array_push($array_test, array('name' => 'ini_extract', 'result' => 1));		

					// Ouverture du fichier de version
					if ($fichier = @fopen($temp_path.'/'.$version_filename,'r'))
					{
						while (!feof($fichier)) 
						{
							$ligne = fgets($fichier); 
						}				
						fclose($fichier);
						
						$numversion = floatval($ligne);
						
						//Controle que la version est supérieure à la version actuelle
						if ($numversion > GEN_VERSION)
						{
							$check2++;
							array_push($array_test, array('name' => 'version_check', 'result' => 1, 'message' => 'Actual: '.GEN_VERSION.' -> Target: '.$numversion));		
							
							//Trouve les repertoires racine a l'interieur de l'archive (seront a supprimer par la suite pour faire la MAJ)
							$archive_subdirs = explode('/',$version_filename);
							array_pop($archive_subdirs);
							$archive_root = implode('/',$archive_subdirs);
						}
						else
						{
							array_push($array_test, array('name' => 'version_check', 'result' => 0, 'message' => 'Actual: '.GEN_VERSION.' -> Target: '.$numversion));								
						}
					}
					else
					{
					
					}
					
				}
				else
				{
					array_push($array_test, array('name' => 'ini_extract', 'result' => 0));						
				}
			}
			else
			{
				array_push($array_test, array('name' => 'ini_search', 'result' => 0));		
			}
			
			$zip->close();

		}
		else
		{
			array_push($array_test, array('name' => 'zip_open', 'result' => 0));		
		}

	}
	else
	{
	
	}
	
	$i = 0;
	while ($i < count($array_test))
	{
		if ($array_test[$i]["result"] == 1)
		{
			$class = 'table_success';
			$image = 'ok';
		}
		else
		{
			$class = 'table_error';
			$image = 'nok';
		}

		if (isset($array_test[$i]["message"]))
			$message = '<p style="margin:0;padding-left:30px"><i>'.$array_test[$i]["message"].'</i></p>';
		else
			$message = '';
		
		$template->assign_block_vars('maj_stage2.tests', array(
		  'NAME' => $lang["autoupdate_stage2_test_".$array_test[$i]["name"]],
		  'CLASS' => $class,
		  'IMAGE' => $image,
		  'MESSAGE' => $message,
		  'RESULT' => $lang["autoupdate_stage2_test_".$array_test[$i]["name"].'_'.$image],
		));
				
		$i++;
	}
	
	if ($check == 5 && $check2 == 4)
	{
		$template->assign_block_vars('maj_stage2.tests_ok', array(
		  'ZIP_FILENAME' => $temp_path.'/'.$dest_fichier,
		  'NUM_VERSION' => $numversion,
		  'ARCHIVE_ROOT' => $archive_root,
		  'L_CONTINUE' => $lang["autoupdate_continue"],
		));
	
	}

}
if (isset($_GET["stage"]) && $_GET["stage"] == 3)
{
	$zip = new ZipArchive();
	if($zip->open($_POST["zipfilename"]) == TRUE)	
	{
		
		//Extraction des fichiers dans un repertoire d'install temporaire
		if ($zip->extractTo($temp_path))
		{			
			$CopieRecursive=new FileRecursive();

			// Copie des nouveaux fichiers
			$CopieRecursive->copie($temp_path.'/'.$_POST["archive_root"], $majrootdir, '', 1,'',1);	
			
			// !!!!!!!!!!!!!!!! Ajouter un controle de copie des fichiers			
		}
		
		$zip->close();
	}
}

?>