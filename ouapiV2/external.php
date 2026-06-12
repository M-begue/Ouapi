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
	global $connect;
	
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

  if (!empty($fields['creation_date']) && is_numeric($fields['creation_date'])) {
    // date('Y-m-d', ...) transforme le timestamp (ex: 1780584000) en chaîne "2026-06-04"
    $fields['creation_date'] = date('Y-m-d', intval($fields['creation_date']));
  } else {
    // Si le champ est vide ou mal formé, on met la date du jour par sécurité
    $fields['creation_date'] = date('Y-m-d');
  }

  $texte_analyse = htmlspecialchars_decode($fields['commentaire'], ENT_QUOTES);

  $lignes = preg_split('/\r\n|\r|\n/', trim($texte_analyse));

  // Initialisation des variables par défaut
  $cpu_libelle = "";
  $ram_capacite = null;
  $ram_type_libelle = "DDR4"; 
  $disque_capacite = null;
  $disque_type_libelle = "SSD";

  // --- LIGNE 1 : PROCESSEUR ---
  if (isset($lignes[0]) && !empty(trim($lignes[0]))) {
      $cpu_libelle = trim($lignes[0]);
  }

  // --- LIGNE 2 : CAPACITÉ ET FRÉQUENCE RAM ---
  if (isset($lignes[1]) && !empty(trim($lignes[1]))) {
      // On extrait la capacité et la fréquence depuis la ligne 2
      if (preg_match('/([\d,]+)\s*Go\s*@\s*(\d+)\s*MHz/i', $lignes[1], $matches)) {
          $ram_capacite = intval(str_replace(',', '.', $matches[1]));
          $ram_frequence = intval($matches[2]);

          // Logique de détection DDR selon la fréquence
          if ($ram_frequence >= 4800) { $ram_type_libelle = "DDR5"; }
          elseif ($ram_frequence >= 2133) { $ram_type_libelle = "DDR4"; }
          else { $ram_type_libelle = "DDR3"; }
      } 
      // Si pas de fréquence, on prend juste le premier nombre de la ligne avant "Go"
      elseif (preg_match('/([\d,]+)\s*Go/i', $lignes[1], $matches)) {
          $ram_capacite = intval(str_replace(',', '.', $matches[1]));
      }
  }

  // --- LIGNE 3 : CARACTÉRISTIQUES DISQUE (OPTIONNEL) ---
  // On peut s'en servir pour deviner si c'est un SSD ou HDD/eMMC au besoin
  if (isset($lignes[3])) {
      if (stripos($lignes[3], 'SSD') !== false) { $disque_type_libelle = "SSD"; }
      elseif (stripos($lignes[3], 'MMC') !== false) { $disque_type_libelle = "eMMC"; }
	  elseif (stripos($lignes[3], 'HDD') !== false) { $disque_type_libelle = "HDD"; }
  }

  // --- LIGNE 4 : CAPACITÉ DU DISQUE ---
  if (isset($lignes[3]) && !empty(trim($lignes[3]))) {
      
      $ligne_disque_propre = preg_replace('/[^\x20-\x7E]/', '', $lignes[3]);
      $ligne_disque_propre = str_replace(' ', '', $ligne_disque_propre); 

      if (preg_match('/([\d,.]+?)Go/i', $ligne_disque_propre, $matches)) {
          
          $parties = preg_split('/[,.]/', $matches[1]);
          $capacite_brute = trim($parties[0]);
          
          $disque_capacite = intval($capacite_brute);
      }
  }
	
  function getOrCreateRefId($connection, $tableName, $libelle) {
    if (empty($libelle)) return null;
    
    $query = "SELECT id FROM " . DB_PREFIX . $tableName . " WHERE libelle = ?";
    $stmt = $connection->prepare($query);
    if ($stmt) {
      $stmt->bind_param("s", $libelle);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($row = $result->fetch_assoc()) {
        $stmt->close();
        return $row['id'];
      }
      $stmt->close();
    }
    
    $queryInsert = "INSERT INTO " . DB_PREFIX . $tableName . " (libelle) VALUES (?)";
    $stmtInsert = $connection->prepare($queryInsert);
    if ($stmtInsert) {
      $stmtInsert->bind_param("s", $libelle);
      $stmtInsert->execute();
      $newId = $stmtInsert->insert_id;
      $stmtInsert->close();
      return $newId;
    }
    return null;
  }

  // Liaisons avec vos tables de référence (ouapi_ref_...)
  $cpu_id = getOrCreateRefId($connect->connection, "ref_cpu", $cpu_libelle);
  $ram_type_id = getOrCreateRefId($connect->connection, "ref_ram_type", $ram_type_libelle);
  $disque_type_id = getOrCreateRefId($connect->connection, "ref_disque_type", $disque_type_libelle);

	$query = "INSERT INTO " . DB_PREFIX . "hardware 
	          (num_serie, marque_id, modele_id, type_id, nom, os_id, agence_id, emplacement_id, ip, suivi_rebus, commentaire, creation_date, pfield_garantie, pfield_utilisateurprinc, cpu_id, ram_capacite, ram_type_id, disque_capacite, disque_type_id) 
	          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
	$stmt = $connect->connection->prepare($query);
	
	if ($stmt) {
    $commentaire = "";
    
    // Convert empty string to null for integer fields in custom pfields
    $pfield_garantie = (!empty($fields['pfield_garantie']) ? intval($fields['pfield_garantie']) : null);
    $pfield_utilisateurprinc = (!empty($fields['pfield_utilisateurprinc']) ? intval($fields['pfield_utilisateurprinc']) : null);

		$stmt->bind_param("sssssssssssssiiiiiiiii",
			$fields['num_serie'], $fields['marque_id'], $fields['modele_id'], $fields['type_id'],
			$fields['nom'], $fields['os_id'], $fields['agence_id'], $fields['emplacement_id'],
			$fields['ip'], $fields['suivi_rebus'], $commentaire, $fields['creation_date'],
			$pfield_garantie, $pfield_utilisateurprinc,
      $cpu_id, 
      $ram_capacite, 
      $ram_type_id, 
      $disque_capacite, 
      $disque_type_id
		);
		if ($stmt->execute()) {
      $stmt->close();
      echo "success";
      exit;
    } else {
      // Si l'exécution échoue (ex: contrainte de clé primaire, type de données...)
      http_response_code(500);
      echo "Erreur d'exécution SQL : " . $stmt->error;
      $stmt->close();
      exit;
    }
  } else {
    // Si la préparation de la requête échoue (ex: nom de colonne SQL mal orthographié)
    http_response_code(500);
    echo "Erreur de préparation SQL : " . $connect->connection->error;
    exit;
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

