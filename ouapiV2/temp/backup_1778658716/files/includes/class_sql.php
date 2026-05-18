<?php declare(strict_types=1);

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

class db_connect 
{
	public string $host = '';
	public string $user = '';
	public string $mdp = '';
	public string $db = '';
	public ?mysqli $connection = null;
	
	public function __construct() {}
	
	public function connection(string $host = DB_HOST, string $user = DB_USER, string $mdp = DB_MDP, string $db = DB_TRANSM): mysqli|false {
		try {
			$this->connection = mysqli_connect($host, $user, $mdp, $db);
			
			if (!$this->connection) {
				throw new mysqli_sql_exception("Connexion échouée");
			}
			
			$this->connection->set_charset('utf8mb4');
			return $this->connection;
		} catch (mysqli_sql_exception $e) {
			error_log($e->getMessage());
			return false;
		}
	}
	
	public function test_cnx(string $host = DB_HOST, string $user = DB_USER, string $mdp = DB_MDP, string $db = DB_TRANSM): array {
		$errors = [];
		
		try {
			$connection = @mysqli_connect($host, $user, $mdp, $db);
			
			if (!$connection) {
				$errors[] = mysqli_connect_errno();
			} else {
				$connection->close();
			}
		} catch (mysqli_sql_exception $e) {
			$errors[] = $e->getCode();
		}
		
		return $errors;
	}
}

class db_use extends db_connect
{
	public ?int $count = null;
	public array $tab = [];
	
	public function __construct($count = 0, $tab = '') {
		parent::__construct();
		$this->count = is_numeric($count) ? (int)$count : 0;
		$this->tab = [];
	}
	
	private function displayQueryDebug(string $requete): void {
		if (!defined("PARAM_DEBUG_MODE") || constant("PARAM_DEBUG_MODE") !== 1) {
			return;
		}
		
		$aff = $requete;
		$replacements = [
			'SELECT' => '<b>SELECT</b>',
			'FROM' => '<br/><b>FROM</b>',
			'LEFT JOIN' => '<br/>&nbsp;&nbsp;<b>LEFT JOIN</b>',
			'WHERE' => '<br/><b>WHERE</b>',
			'ORDER BY' => '<br/><b>ORDER BY</b>',
			'OR ' => '<b><i>OR </i></b>',
			'ON' => '<b><i>ON</i></b>',
			'LIKE' => '<b><i>LIKE</i></b>',
		];
		
		foreach ($replacements as $search => $replace) {
			$aff = str_replace($search, $replace, $aff);
		}
		
		echo '<div style="border: 1px solid black;background-color:white;float:center;margin-top:10px;margin-left:10px;margin-right:10px;padding:5px">'.$aff.'</div>';
		
		if ($this->connection && ($error = $this->connection->error)) {
			echo '<div style="background-color:red;color:white;float:center;margin-left:10px;margin-right:10px;padding:5px;"><b>MySQLi Error:</b> '.$error.'</div><br/>';
		}
		echo '<br/>';
	}

	/**
	 * Retourne un tableau sous la forme $tab[$ligne]['nom_du_champ']
	 */
	public function db_use_query(string $requete, ?string $table_name = null): array {
		$this->tab = [];
		
		// Vérifier et établir la connexion si nécessaire
		if ($this->connection === null) {
			$this->connection();
		}
		
		if ($this->connection === null) {
			throw new Exception("Impossible de se connecter à la base de données");
		}
		
		$query = @$this->connection->query($requete);
		$debut_query = strtoupper(substr($requete, 0, 6));
		
		if (str_starts_with($debut_query, "SELECT")) {
			$this->count = $query ? $query->num_rows : 0;
		} else {
			$this->count = null;
		}

		$this->displayQueryDebug($requete);
		
		if ($this->count !== null && $query) {
			$i = 0;
			while ($out = $query->fetch_assoc()) {
				if ($table_name === null) {
					$this->tab[$i] = $out;
				} else {
					foreach ($out as $fname => $value) {
						$this->tab[$i][$table_name.'.'.$fname] = $value;
					}
				}
				$i++;
			}
		}
		return $this->tab;
	}

	/**
	 * Retourne un tableau sous la forme $tab['nom_du_champ'][$ligne]
	 */
	public function db_use_query_inv(string $requete, ?string $table_name = null): array {
		$this->tab = [];
		
		// Vérifier et établir la connexion si nécessaire
		if ($this->connection === null) {
			$this->connection();
		}
		
		if ($this->connection === null) {
			throw new Exception("Impossible de se connecter à la base de données");
		}
		
		$query = @$this->connection->query($requete);
		$debut_query = strtoupper(substr($requete, 0, 6));
		
		$this->displayQueryDebug($requete);
		
		if (!str_starts_with($debut_query, "INSERT") && !str_starts_with($debut_query, "UPDATE") && !str_starts_with($debut_query, "DELETE")) {
			$this->count = $query ? $query->num_rows : 0;
		} else {
			$this->count = null;
		}
			
		if ($this->count !== null && $query) {
			// Construire un tableau inversé [colonne][ligne]
			$rows = $query->fetch_all(MYSQLI_ASSOC);
			
			if (!empty($rows)) {
				foreach ($rows as $i => $row) {
					foreach ($row as $fname => $value) {
						if ($table_name === null) {
							$this->tab[$fname][$i] = $value;
						} else {
							$this->tab[$table_name.'.'.$fname][$i] = $value;
						}
					}
				}
			}
		}
		
		return $this->tab;
	}
}
?>