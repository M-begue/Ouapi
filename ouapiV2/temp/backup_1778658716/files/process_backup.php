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
			header('Location: index.php?page=adm_backup&deleted=1');
			exit;
		}
	}
}

// Sinon, rediriger vers la page d'accueil
header('Location: index.php');
exit;

?>
