<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2014 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

require('common_includes.php');

$backup_dir = 'backups';
$backup_prefix = 'OUAPI_backup_';

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

function cleanOldBackups($backup_dir, $backup_prefix, $max_backups = 10) {
	if (!is_dir($backup_dir)) {
		return;
	}
	
	$backups = array();
	$handle = opendir($backup_dir);
	
	while (FALSE !== ($file = readdir($handle))) {
		if (strpos($file, $backup_prefix) === 0 && strtolower(substr($file, -4)) === '.zip') {
			$file_path = $backup_dir . '/' . $file;
			$file_time = filemtime($file_path);
			
			$backups[] = array(
				'name' => $file,
				'path' => $file_path,
				'timestamp' => $file_time,
			);
		}
	}
	closedir($handle);

	if (count($backups) > $max_backups) {
		usort($backups, function($a, $b) {
			return $b['timestamp'] - $a['timestamp'];
		});
		
		for ($i = $max_backups; $i < count($backups); $i++) {
			if (file_exists($backups[$i]['path'])) {
				unlink($backups[$i]['path']);
			}
		}
	}
}

// Traitement du téléchargement
if (isset($_GET['action']) && $_GET['action'] == 'download' && isset($_GET['file'])) {
	$backup_file = basename($_GET['file']);
	$file_path = $backup_dir . '/' . $backup_file;
	
	// Vérifier que c'est un fichier de sauvegarde valide
	if (file_exists($file_path) && strpos($backup_file, $backup_prefix) === 0 && strtolower(substr($backup_file, -4)) === '.zip') {
		// Télécharger le fichier
		header('Content-Type: application/zip');
		header('Content-Disposition: attachment; filename="' . $backup_file . '"');
		header('Content-Length: ' . filesize($file_path));
		header('Pragma: no-cache');
		header('Expires: 0');
		
		readfile($file_path);
		exit;
	} else {
		header('HTTP/1.0 404 Not Found');
		echo 'Fichier de sauvegarde introuvable ou invalide';
		exit;
	}
}

// Traitement de la suppression
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['file'])) {
	$backup_file = basename($_GET['file']);
	$file_path = $backup_dir . '/' . $backup_file;
	
	// Vérifier que c'est un fichier de sauvegarde valide
	if (file_exists($file_path) && strpos($backup_file, $backup_prefix) === 0) {
		if (unlink($file_path)) {
			// Rediriger vers la page de backup
			header('Location: index.php?page=adm_backup.php&deleted=1');
			exit;
		}
	}
}

// Traitement de la création de sauvegarde (pour CRON ou requêtes directes)
if (isset($_GET['action']) && $_GET['action'] == 'create_backup') {
	try {
		require('config/declare.php');
		
		// Créer le répertoire de sauvegardes s'il n'existe pas
		if (!is_dir($backup_dir)) {
			mkdir($backup_dir, 0777, TRUE);
		}
		
		// Créer le répertoire de logs s'il n'existe pas
		$log_dir = 'backups/logs';
		if (!is_dir($log_dir)) {
			mkdir($log_dir, 0777, TRUE);
		}
		
		$log_file = $log_dir . '/backup_cron.log';
		$log_entry = "[" . date('Y-m-d H:i:s') . "] Début de la sauvegarde automatique\n";
		file_put_contents($log_file, $log_entry, FILE_APPEND);
		
		$timestamp = date('Y-m-d_H-i-s');
		$backup_name = $backup_prefix . $timestamp . '.zip';
		$backup_path = $backup_dir . '/' . $backup_name;
		$temp_backup_dir = 'temp/backup_' . time();
		
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
		file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] Fichiers sauvegardés\n", FILE_APPEND);
		
		// 2. SAUVEGARDE DE LA BASE DE DONNÉES
		$req1 = new db_use;
		$req1->connection();
		
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
		file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] Base de données sauvegardée\n", FILE_APPEND);
		
		// Sauvegarder les infos de backup
		$info = "OUAPI Backup Information\n";
		$info .= "========================\n\n";
		$info .= "Date: " . date('Y-m-d H:i:s') . "\n";
		$info .= "Version: " . GEN_VERSION . "\n";
		$info .= "Database: " . DB_TRANSM . "\n";
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
			file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] Archive ZIP créée: $backup_name\n", FILE_APPEND);
			
			// Limiter le nombre de sauvegardes à 10
			cleanOldBackups($backup_dir, $backup_prefix, 10);
			file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] Anciennes sauvegardes nettoyées\n", FILE_APPEND);
			
			file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] Sauvegarde terminée avec succès\n\n", FILE_APPEND);
			
			// Si appelé depuis un navigateur, rediriger avec le paramètre de succès
			if (isset($_GET['action'])) {
				header("Location: index.php?page=adm_backup.php&created=1");
				exit();
			}
			// Sinon (CRON), afficher le succès en JSON
			echo json_encode(array('status' => 'success', 'backup' => $backup_name));
			exit;
		} else {
			throw new Exception('Erreur lors de la création de l\'archive ZIP');
		}
	} catch (Exception $e) {
		// Enregistrer l'erreur
		$log_dir = 'backups/logs';
		if (!is_dir($log_dir)) {
			mkdir($log_dir, 0777, TRUE);
		}
		$log_file = $log_dir . '/backup_cron.log';
		file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] ERREUR: " . $e->getMessage() . "\n\n", FILE_APPEND);
		
		// Retourner l'erreur en JSON pour faciliter l'intégration CRON
		http_response_code(500);
		echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		exit;
	}
}

// Sinon, rediriger vers la page d'accueil
header('Location: index.php');
exit;

?>
