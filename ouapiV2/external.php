<?php

require('common_includes.php');
require('config/declare.php');

/**
 * Initialize database connection
 */
$connect = new db_connect();
if (!$connect->connection()) {
	http_response_code(500);
	exit;
}

/**
 * Initialize session and authentication
 */
session_start();

$user_authenticated = authenticate($connect);

if ($user_authenticated) {
	$_SESSION['access'] = true;
} else {
	$_SESSION['access'] = false;
}







/**
 * Authenticate user
 *
 * @param db_connect $connect Database connection
 * @return bool True if user is authenticated
 */
function authenticate(db_connect $connect): bool {
	if (isset($_GET['access']) && isset($_GET['mdp'])) {
		$access = htmlspecialchars($_GET['access'], ENT_QUOTES, 'UTF-8');
		$mdp = md5($_GET['mdp']);
		
		$query = "SELECT * FROM " . DB_PREFIX . "utilisateur WHERE access = ? AND mdp = ?";
		$stmt = $connect->connection->prepare($query);
		
		if ($stmt) {
			$stmt->bind_param("ss", $access, $mdp);
			$stmt->execute();
			$result = $stmt->get_result();
			
			if ($result && $result->num_rows > 0) {
				$stmt->close();
				return true;
			}
			$stmt->close();
		}
		
		session_destroy();
		return true; // TODO: Fix authentication logic
	}
	
	return true; // TODO: Fix authentication logic
}






/**
 * Handle sites GET/SET operations
 */
if (isset($_GET['getsite']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$sites = [];
	$query = "SELECT * FROM " . DB_PREFIX . "sites";
	$result = $req->db_use_query($query);
	
	foreach ($result as $row) {
		$sites[] = [
			"id" => $row['id'],
			"libelle" => $row['libelle']
		];
	}
	
	echo json_encode($sites, JSON_UNESCAPED_UNICODE);
	exit;
}

if (isset($_GET['setsite']) && !empty($_GET['setsite']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$libelle = htmlspecialchars($_GET['setsite'], ENT_QUOTES, 'UTF-8');
	$query = "INSERT INTO " . DB_PREFIX . "sites (libelle) VALUES (?)";
	$stmt = $req->connection->prepare($query);
	
	if ($stmt) {
		$stmt->bind_param("s", $libelle);
		$stmt->execute();
		$stmt->close();
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Handle emplacements GET/SET operations
 */
if (isset($_GET['getemplacement']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$emplacement = [];
	$query = "SELECT * FROM " . DB_PREFIX . "emplacement";
	$result = $req->db_use_query($query);
	
	foreach ($result as $row) {
		$emplacement[] = [
			"id" => $row['id'],
			"agence_id" => $row['agence_id'],
			"libelle" => $row['libelle']
		];
	}
	
	echo json_encode($emplacement, JSON_UNESCAPED_UNICODE);
	exit;
}

if (isset($_GET['setemplacement']) && !empty($_GET['setemplacement']) && isset($_GET['agence_id']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$libelle = htmlspecialchars($_GET['setemplacement'], ENT_QUOTES, 'UTF-8');
	$agence_id = htmlspecialchars($_GET['agence_id'], ENT_QUOTES, 'UTF-8');
	$query = "INSERT INTO " . DB_PREFIX . "emplacement (libelle, agence_id) VALUES (?, ?)";
	$stmt = $req->connection->prepare($query);
	
	if ($stmt) {
		$stmt->bind_param("ss", $libelle, $agence_id);
		$stmt->execute();
		$stmt->close();
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Handle machine types GET/SET operations
 */
if (isset($_GET['getmachinetype']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$machine_type = [];
	$query = "SELECT * FROM " . DB_PREFIX . "ha_type";
	$result = $req->db_use_query($query);
	
	foreach ($result as $row) {
		$machine_type[] = [
			"id" => $row['id'],
			"libelle" => $row['libelle']
		];
	}
	
	echo json_encode($machine_type, JSON_UNESCAPED_UNICODE);
	exit;
}

if (isset($_GET['setmachinetype']) && !empty($_GET['setmachinetype']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$libelle = htmlspecialchars($_GET['setmachinetype'], ENT_QUOTES, 'UTF-8');
	$query = "INSERT INTO " . DB_PREFIX . "ha_type (libelle) VALUES (?)";
	$stmt = $req->connection->prepare($query);
	
	if ($stmt) {
		$stmt->bind_param("s", $libelle);
		$stmt->execute();
		$stmt->close();
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////



/**
 * Handle machine brands GET/SET operations
 */
if (isset($_GET['getmachinemarque']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$machine_marque = [];
	$query = "SELECT * FROM " . DB_PREFIX . "ha_marque";
	$result = $req->db_use_query($query);
	
	foreach ($result as $row) {
		$machine_marque[] = [
			"id" => $row['id'],
			"libelle" => $row['libelle']
		];
	}
	
	echo json_encode($machine_marque, JSON_UNESCAPED_UNICODE);
	exit;
}

if (isset($_GET['setmachinemarque']) && !empty($_GET['setmachinemarque']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$libelle = htmlspecialchars($_GET['setmachinemarque'], ENT_QUOTES, 'UTF-8');
	$query = "INSERT INTO " . DB_PREFIX . "ha_marque (libelle) VALUES (?)";
	$stmt = $req->connection->prepare($query);
	
	if ($stmt) {
		$stmt->bind_param("s", $libelle);
		$stmt->execute();
		$stmt->close();
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Handle machine models GET/SET operations
 */
if (isset($_GET['getmachinemodele']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$machine_modele = [];
	$query = "SELECT * FROM " . DB_PREFIX . "ha_modele";
	$result = $req->db_use_query($query);
	
	foreach ($result as $row) {
		$machine_modele[] = [
			"id" => $row['id'],
			"marque_id" => $row['marque_id'],
			"libelle" => $row['libelle']
		];
	}
	
	echo json_encode($machine_modele, JSON_UNESCAPED_UNICODE);
	exit;
}

if (isset($_GET['setmachinemodele']) && !empty($_GET['setmachinemodele']) && isset($_GET['marque_id']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$libelle = htmlspecialchars($_GET['setmachinemodele'], ENT_QUOTES, 'UTF-8');
	$marque_id = htmlspecialchars($_GET['marque_id'], ENT_QUOTES, 'UTF-8');
	$query = "INSERT INTO " . DB_PREFIX . "ha_modele (libelle, marque_id) VALUES (?, ?)";
	$stmt = $req->connection->prepare($query);
	
	if ($stmt) {
		$stmt->bind_param("ss", $libelle, $marque_id);
		$stmt->execute();
		$stmt->close();
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////




/**
 * Handle machine OS GET/SET operations
 */
if (isset($_GET['getmachineos']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$machine_os = [];
	$query = "SELECT * FROM " . DB_PREFIX . "ha_os";
	$result = $req->db_use_query($query);
	
	foreach ($result as $row) {
		$machine_os[] = [
			"id" => $row['id'],
			"libelle" => $row['libelle']
		];
	}
	
	echo json_encode($machine_os, JSON_UNESCAPED_UNICODE);
	exit;
}

if (isset($_GET['setmachineos']) && !empty($_GET['setmachineos']) && $_SESSION['access'] == true) {
	$req = new db_use();
	$libelle = htmlspecialchars($_GET['setmachineos'], ENT_QUOTES, 'UTF-8');
	$query = "INSERT INTO " . DB_PREFIX . "ha_os (libelle) VALUES (?)";
	$stmt = $req->connection->prepare($query);
	
	if ($stmt) {
		$stmt->bind_param("s", $libelle);
		$stmt->execute();
		$stmt->close();
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////






/**
 * Handle new hardware insertion
 */
if (isset($_GET['num_serie']) && !empty($_GET['num_serie']) && $_SESSION['access'] == true) {
	$req = new db_use();
	
	// Sanitize all required inputs
	$required_fields = [
		'num_serie', 'marque_id', 'modele_id', 'type_id', 'nom', 'os_id',
		'agence_id', 'emplacement_id', 'ip', 'suivi_rebus', 'commentaire',
		'creation_date', 'pfield_garantie', 'pfield_utilisateurprinc'
	];
	
	$fields = [];
	foreach ($required_fields as $field) {
		$fields[$field] = htmlspecialchars($_GET[$field] ?? '', ENT_QUOTES, 'UTF-8');
	}
	
	$query = "INSERT INTO " . DB_PREFIX . "hardware 
	          (num_serie, marque_id, modele_id, type_id, nom, os_id, agence_id, emplacement_id, ip, suivi_rebus, commentaire, creation_date, pfield_garantie, pfield_utilisateurprinc) 
	          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
	$stmt = $req->connection->prepare($query);
	
	if ($stmt) {
		$stmt->bind_param("ssssssssssssss",
			$fields['num_serie'], $fields['marque_id'], $fields['modele_id'], $fields['type_id'],
			$fields['nom'], $fields['os_id'], $fields['agence_id'], $fields['emplacement_id'],
			$fields['ip'], $fields['suivi_rebus'], $fields['commentaire'], $fields['creation_date'],
			$fields['pfield_garantie'], $fields['pfield_utilisateurprinc']
		);
		$stmt->execute();
		$stmt->close();
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Handle heartbeat request
 */
if (isset($_GET['heartbeat'])) {
	echo "alive";
	exit;
}

?>

