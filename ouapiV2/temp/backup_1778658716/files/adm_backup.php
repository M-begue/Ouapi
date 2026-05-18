<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2014 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

/**
 * Fonction pour formater la taille des fichiers
 */
function formatBytes($bytes, $precision = 2) {
	$units = array('B', 'KB', 'MB', 'GB', 'TB');
	
	for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
		$bytes /= 1024;
	}
	
	return round($bytes, $precision) . ' ' . $units[$i];
}

/**
 * Fonction pour supprimer récursivement un répertoire
 */
function deleteDirectoryRecursive($dir) {
	if (!file_exists($dir)) {
		return true;
	}
	
	if (!is_dir($dir)) {
		return unlink($dir);
	}
	
	foreach (scandir($dir) as $item) {
		if ($item == '.' || $item == '..') {
			continue;
		}
		
		if (!deleteDirectoryRecursive($dir . DIRECTORY_SEPARATOR . $item)) {
			return false;
		}
	}
	
	return rmdir($dir);
}

$req1 = new db_use;
$req1->connection();
$affichage = '';

$backup_dir = 'backups';
$backup_prefix = 'OUAPI_backup_';

// Créer le répertoire de sauvegardes s'il n'existe pas
if (!is_dir($backup_dir)) {
	mkdir($backup_dir, 0777, TRUE);
}

// Traitement des actions
if (isset($_POST['action'])) {
	if ($_POST['action'] == 'create_backup') {
		// Création d'une nouvelle sauvegarde
		$timestamp = date('Y-m-d_H-i-s');
		$backup_name = $backup_prefix . $timestamp . '.zip';
		$backup_path = $backup_dir . '/' . $backup_name;
		$temp_backup_dir = 'temp/backup_' . time();
		
		try {
			// Créer le répertoire temporaire
			if (!is_dir($temp_backup_dir)) {
				mkdir($temp_backup_dir, 0777, TRUE);
			}

            $files_dest_dir = $temp_backup_dir . '/files';
            if (!is_dir($files_dest_dir)) {
                mkdir($files_dest_dir, 0777, TRUE);
            }
			
			// 1. SAUVEGARDE DES FICHIERS
			$CopieRecursive = new FileRecursive();
			$CopieRecursive->copie('./', $temp_backup_dir . '/files', '', 1, '', 1, array('temp', 'backups'));
			
			// 2. SAUVEGARDE DE LA BASE DE DONNÉES
			$db_backup = '';
			$result = $req1->connection->query('SHOW TABLES');
			$tables = array();
			
			if ($result) {
				while ($row = $result->fetch_row()) {
					$tables[] = $row[0];
				}
			}
			
			foreach ($tables as $table) {
				$db_backup .= "DROP TABLE IF EXISTS `" . $table . "`;\n";
				
				$create_result = $req1->connection->query('SHOW CREATE TABLE `' . $table . '`');
				if ($create_result) {
					$row2 = $create_result->fetch_row();
					$db_backup .= $row2[1] . ";\n\n";
				}
				
				$result = $req1->connection->query('SELECT * FROM `' . $table . '`');
				$num_fields = $result->field_count;
				
				while ($row = $result->fetch_row()) {
					$db_backup .= "INSERT INTO `" . $table . "` VALUES(";
					for ($j = 0; $j < $num_fields; $j++) {
						if (isset($row[$j]) && !is_null($row[$j])) {
                            // Remplace addslashes($row[$j]) par ceci :
                            $valeur = $req1->connection->real_escape_string($row[$j]); 
                            $valeur = preg_replace("`\n`", "\\n", $valeur);
                            $db_backup .= "'" . $valeur . "'";
                        } else {
                         $db_backup .= "NULL";
                        }
						if ($j < ($num_fields - 1)) {
							$db_backup .= ", ";
						}
					}
					$db_backup .= ");\n";
				}
				$db_backup .= "\n\n";
			}
			
			// Sauvegarder le fichier SQL
			$handle = fopen($temp_backup_dir . '/database_backup.sql', 'w+');
			fwrite($handle, $db_backup);
			fclose($handle);
			
			// Sauvegarder les infos de backup
			$info = "OUAPI Backup Information\n";
			$info .= "========================\n\n";
			$info .= "Date: " . date('Y-m-d H:i:s') . "\n";
			$info .= "Version: " . GEN_VERSION . "\n";
			$info .= "Database: " . DB_NAME . "\n";
			$info .= "Hostname: " . DB_HOST . "\n";
			
			$handle = fopen($temp_backup_dir . '/backup_info.txt', 'w+');
			fwrite($handle, $info);
			fclose($handle);
			
			// 3. CRÉATION DE L'ARCHIVE ZIP
			$zip = new ZipArchive();
			if ($zip->open($backup_path, ZipArchive::CREATE) === TRUE) {
				// Ajouter les fichiers à l'archive
				$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($temp_backup_dir));
				foreach ($iterator as $file) {
					if ($file->isFile()) {
						$file_path = $file->getPathname();
						$relative_path = str_replace($temp_backup_dir . '/', '', $file_path);
						$zip->addFile($file_path, $relative_path);
					}
				}
				$zip->close();
				
				// Nettoyer le répertoire temporaire
				deleteDirectoryRecursive($temp_backup_dir);
				
				// Message de succès
				$template->assign_block_vars('backup_message', array(
					'TYPE' => 'success',
					'TITLE' => $lang["backup_created_success"] ?? 'Sauvegarde créée avec succès',
					'TEXT' => $lang["backup_created_text"] ?? 'La sauvegarde a été créée: ' . $backup_name,
				));
			} else {
				throw new Exception($lang["backup_zip_error"] ?? 'Erreur lors de la création de l\'archive ZIP');
			}
		} catch (Exception $e) {
			$template->assign_block_vars('backup_message', array(
				'TYPE' => 'error',
				'TITLE' => $lang["backup_error"] ?? 'Erreur de sauvegarde',
				'TEXT' => $e->getMessage(),
			));
		}
	} elseif ($_POST['action'] == 'delete_backup') {
		// Suppression d'une sauvegarde
		$backup_file = basename($_POST['backup_file']);
		$file_path = $backup_dir . '/' . $backup_file;
		
		if (file_exists($file_path) && strpos($backup_file, $backup_prefix) === 0) {
			if (unlink($file_path)) {
				$template->assign_block_vars('backup_message', array(
					'TYPE' => 'success',
					'TITLE' => $lang["backup_deleted_success"] ?? 'Sauvegarde supprimée',
					'TEXT' => $lang["backup_deleted_text"] ?? 'La sauvegarde a été supprimée: ' . $backup_file,
				));
			}
		}
	}
}

// Affichage de l'interface de sauvegarde
$template->assign_block_vars('backup_interface', array(
	'TITLE' => $lang["backup_title"] ?? 'Sauvegardes',
	'CREATE_BACKUP' => $lang["backup_create"] ?? 'Créer une nouvelle sauvegarde',
	'BUTTON_CREATE' => $lang["backup_button_create"] ?? 'Créer la sauvegarde',
	'LIST_TITLE' => $lang["backup_list_title"] ?? 'Sauvegardes existantes',
	'NO_BACKUP' => $lang["backup_no_backup"] ?? 'Aucune sauvegarde disponible',
));

// Lister les sauvegardes existantes
if (is_dir($backup_dir)) {
	$backups = array();
	$handle = opendir($backup_dir);
	
	while (FALSE !== ($file = readdir($handle))) {
		if (strpos($file, $backup_prefix) === 0 && strtolower(substr($file, -4)) === '.zip') {
			$file_path = $backup_dir . '/' . $file;
			$file_size = filesize($file_path);
			$file_time = filemtime($file_path);
			
			$backups[] = array(
				'name' => $file,
				'size' => formatBytes($file_size),
				'size_bytes' => $file_size,
				'date' => date('Y-m-d H:i:s', $file_time),
				'timestamp' => $file_time,
			);
		}
	}
	closedir($handle);
	
	// Trier par date décroissante
	usort($backups, function($a, $b) {
		return $b['timestamp'] - $a['timestamp'];
	});
	
	// Afficher les sauvegardes
	foreach ($backups as $backup) {
		$template->assign_block_vars('backup_interface.backups', array(
			'NAME' => $backup['name'],
			'DATE' => $backup['date'],
			'SIZE' => $backup['size'],
			'DOWNLOAD' => $lang["backup_download"] ?? 'Télécharger',
			'DELETE' => $lang["backup_delete"] ?? 'Supprimer',
			'CONFIRM_DELETE' => $lang["backup_confirm_delete"] ?? 'Êtes-vous sûr de vouloir supprimer cette sauvegarde ?',
		));
	}
}

?>
