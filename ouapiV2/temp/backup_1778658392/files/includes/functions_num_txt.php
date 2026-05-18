<?php declare(strict_types=1);

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

/**
 * Escape string using mysqli connection if available, otherwise return as-is.
 * This replaces the deprecated mysql_real_escape_string().
 */
function escape_string_db(string $string): string
{
	global $req1;
	if (isset($req1) && $req1 instanceof db_use && $req1->connection instanceof mysqli) {
		return $req1->connection->real_escape_string($string);
	}
	return $string;
}

class dateOp {
	public array $errno = [];
	public array $dat = [];
	public string $format = '';
	public array $dat2 = [];
	public string $format2 = '';

	public function __construct(string $dat, string $format = "jj/mm/aaaa hh:ii:ss")
	{
		$this->errno = [];

		if (strlen($dat) !== strlen($format)) {
			$this->_error("Format de date incompatible avec la date fournie");
			return false;
		}

		$this->dat['origine'] = $dat;
		$this->format = strtolower($format);
		$this->_ExplodeDate($this->dat, $this->format);
	}
 
	public function AjouteJours(float $nb): bool
	{
		$this->dat['jj'] += $nb;
		return true;
	}

	public function AjouteMois(float $nb): bool
	{
		$this->dat['mm'] += $nb;
		return true;
	}

	public function AjouteAnnees(float $nb): bool
	{
		$this->dat['aaaa'] += $nb;
		return true;
	}

	public function AjouteHeures(float $nb): bool
	{
		$this->dat['hh'] += $nb;
		return true;
	}

	public function AjouteMinutes(float $nb): bool
	{
		$this->dat['ii'] += $nb;
		return true;
	}

	public function AjouteSecondes(float $nb): bool
	{
		$this->dat['ss'] += $nb;
		return true;
	}
	public function DiffenrenceEntreDate(string $dat, string $format = "jj/mm/aaaa hh:ii:ss"): array|false
	{
		if (strlen($dat) !== strlen($format)) {
			$this->_error("Format de date incompatible avec la date fournie");
			return false;
		}
		$this->dat2['origine'] = $dat;
		$this->format2 = strtolower($format);
		$this->_ExplodeDate($this->dat2, $this->format2);
		$d1 = mktime((int)$this->dat['hh'], (int)$this->dat['mm'], (int)$this->dat['ss'], (int)$this->dat['mm'], (int)$this->dat['jj'], (int)$this->dat['aaaa']);
		$d2 = mktime((int)$this->dat2['hh'], (int)$this->dat2['mm'], (int)$this->dat2['ss'], (int)$this->dat2['mm'], (int)$this->dat2['jj'], (int)$this->dat2['aaaa']);

		$d = $d1 - $d2;

		return array("ans" => date('Y', $d) - 1970, "mois" => date('m', $d) - 1, "jours" => date('d', $d) - 1, "joursTotal" => $d / 60 / 60 / 24);
	}

	public function GetDate(string $format = "jj/mm/aaaa"): string
	{
		$format = str_replace(array('jj', 'j', 'm', 'nn', 'aaaa', 'aa', 'hh', 'h', 'ii', 'ss'), array('d', 'D', 'n', 'm', 'Y', 'y', 'H', 'G', 'i', 's'), $format);
		return date($format, mktime((int)$this->dat['hh'], (int)$this->dat['ii'], (int)$this->dat['ss'], (int)$this->dat['mm'], (int)$this->dat['jj'], (int)$this->dat['aaaa']));
	}
 
	private function _ExplodeDate(array &$dat, string $format): bool
	{
		$j[0]=2;
		if (($j[1]=strpos($format,'jj'))===false) {
			$j[0]=1;
			if (($j[1]=strpos($format,'j'))===false)
				$this->_error($format." : Les jours n'ont pas �t� trouv�s... Les jours doivent �tre pr�cis�s par 'jj' ou par 'j' (ex: jj/mm/aaaa)");	
		}
		$m[0]=2;
		if (($m[1]=strpos($format,'mm'))===false)
			$m[0]=1;
			if (($m[1]=strpos($format,'m'))===false)
				$this->_error($format." : Les mois n'ont pas �t� trouv�s... Les mois doivent �tre pr�cis�s par 'mm' ou par 'm' (ex: jj/mm/aaaa)");
		$a[0]=4;
		if (($a[1]=strpos($format,'aaaa'))===false) {
			//cherche pour un aa au lieu de aaaa
			$a[0]=2;
			if (($a[1]=strpos($format,'aa'))===false)
				$this->_error($format." : Les ann�es n'ont pas �t� trouv�s... Les ann�es doivent �tre pr�cis�s par 'aaaa' ou par 'aa' (ex: jj/mm/aaaa)");
		}
		$h[0]=2;
		if (($h[1]=strpos($format,'hh'))===false)
			$h[0]=1;
			if (($h[1]=strpos($format,'h'))===false)
				$this->_error($format." : Les heures n'ont pas �t� trouv�es... Les heures doivent �tre pr�cis�es par 'hh' ou 'h' (ex: jj/mm/aaaa hh:ii:ss)");
		$i[0]=2;
		if (($i[1]=strpos($format,'ii'))===false)
			$i[0]=1;
			if (($i[1]=strpos($format,'i'))===false)
				$this->_error($format." : Les minutes n'ont pas �t� trouv�es... Les minutes doivent �tre pr�cis�es par 'ii' ou 'i' (ex: jj/mm/aaaa hh:ii:ss)");
		$s[0]=2;
		if (($s[1]=strpos($format,'ss'))===false)
			$s[0]=1;
			if (($s[1]=strpos($format,'s'))===false)
				$this->_error($format." : Les secondes n'ont pas �t� trouv�es... Les secondes doivent �tre pr�cis�s par 'ss' ou 's' (ex: jj/mm/aaaa hh:ii:ss)");
		$dat['jj']	=($j[1]!==false)?floatval(substr($dat['origine'],$j[1],$j[0])):1;
		$dat['mm']	=($m[1]!==false)?floatval(substr($dat['origine'],$m[1],$m[0])):1;
		$dat['aaaa']	=($a[1]!==false)?floatval(substr($dat['origine'],$a[1],$a[0])):1970;
		if ($a[0]==2)
			$dat['aaaa']=floatval(substr(date('Y'),0,2).$dat['aaaa']);
		$dat['hh']	=($h[1]!==false)?floatval(substr($dat['origine'],$h[1],$h[0])):0;
		$dat['ii']	=($i[1]!==false)?floatval(substr($dat['origine'],$i[1],$i[0])):0;
		$dat['ss']	=($s[1]!==false)?floatval(substr($dat['origine'],$s[1],$s[0])):0;
		return true;
	}
	private function _error(string $str): bool
	{
		$this->errno[] = $str;
		return true;
	}
}

// Formatage de l'affichage des colonnes
function col_displaying(string $col_name, string $col_value): string
{
	$retour = '';
	// Date
	if (strripos($col_name, '_date') !== false || strripos($col_name, 'date_') !== false || strripos($col_name, '.date') !== false || strripos($col_name, 'whencreated') !== false)
	{
		$retour = format_date_to_aff($col_value);
	}
	// Commentaire
	elseif (strripos($col_name, 'commentaire') !== false && strlen($col_value) > 30)
	{
		$retour = substr($col_value, 0, 30) . '...';
	}
	else
	{
		$retour = $col_value;
	}

	return txt_to_na($retour);
}


function format_date_to_aff(string $date, string $separateur = '/', int $hms = 1): string
{
	$retour = '';
	// Vérification des dates invalides (0000-00-00 ou vides)
	if (empty($date) || $date === '0000-00-00' || $date === '0000-00-00 00:00:00')
	{
		return '';
	}
	
	if (strlen($date) === 10)
	{
		// Cas AAAA/MM/JJ ou AAAA-MM-JJ
		if (strripos($date, '/') !== false || strripos($date, '-') !== false)
		{
			$annee = substr($date, 0, 4);
			$mois = substr($date, 5, 2);
			$jour = substr($date, 8, 2);

			$retour = $jour . $separateur . $mois . $separateur . $annee;
		}
		// Timestamp
		elseif (is_numeric($date))
		{
			$retour = date("d/m/Y", (int)$date);
		}
		else
		{
			$retour = $date;
		}
	}
	// Cas LDAP
	elseif (strlen($date) === 17 && substr($date, 14, 3) === '.0Z')
	{
		$annee = substr($date, 0, 4);
		$mois = substr($date, 4, 2);
		$jour = substr($date, 6, 2);
		$heure = substr($date, 8, 2);
		$minutes = substr($date, 10, 2);

		if ($hms === 0)
			$retour = $jour . $separateur . $mois . $separateur . $annee;
		else
			$retour = $jour . $separateur . $mois . $separateur . $annee . ' ' . $heure . ':' . $minutes;
	}
	elseif (strlen($date) >= 16)
	{
		$annee = substr($date, 0, 4);
		$mois = substr($date, 5, 2);
		$jour = substr($date, 8, 2);
		$heure = substr($date, 11, 5);

		$retour = $jour . $separateur . $mois . $separateur . $annee . ' ' . $heure;
	}
	else
	{
		$retour = $date;
	}

	return $retour;
}

function format_numtel_to_aff(string $num, string $separateur): string
{
	if (strlen($num) === 10)
	{
		$n1 = substr($num, 0, 2);
		$n2 = substr($num, 2, 2);
		$n3 = substr($num, 4, 2);
		$n4 = substr($num, 6, 2);
		$n5 = substr($num, 8, 2);

		$retour = $n1 . $separateur . $n2 . $separateur . $n3 . $separateur . $n4 . $separateur . $n5;
	}
	elseif ($num === '')
	{
		$retour = 'Non renseigné';
	}
	else
	{
		$retour = $num;
	}

	return $retour;
}

function mois_en_periode(int $num): string
{
	return match($num) {
		1 => 'Mois',
		2 => 'Bimestre',
		3 => 'Trimestre',
		6 => 'Semestre',
		12 => 'An',
		default => ''
	};
}

function bin_to_yn(int $bin): string
{
	return $bin === 1 ? 'Oui' : 'Non';
}

function num_to_na(int $bin): string|int
{
	return $bin !== 0 ? $bin : 'N/A';
}

function num_to_empty(int $num): string|int
{
	return $num !== 0 ? $num : '';
}

function txt_to_na(?string $txt): string
{
	return ($txt !== null && trim($txt) !== '') ? $txt : 'N/A';
}


function txt_to_zero(string $txt): string
{
	return $txt !== '' ? $txt : '0';
}

function array_isearch(string $str, array $array): int|string|false
{
	$str = strtolower($str);
	foreach ($array as $k => $v) {
		if (strtolower($v) === $str) {
			return $k;
		}
	}
	return false;
}

// Formatage des nom d'utilisateur
/*function aff_user($id,$tab_user,$lang) {
	if ($id > 0 && count($tab_user) != 0)
		$user = $tab_user[0]["nom"].' '.$tab_user[0]["prenom"];
	elseif ($id > 0 && count($tab_user) == 0)
		$user = '[ '.$lang["hard_user_noref"].' ]';
	elseif ($id == 0)
		$user = '[ '.$lang["none"].' ]';
	
	return $user;
}*/

function aff_users(string $aff, int $id, string $lang_noref = 'bb', string $lang_none = 'aa'): string
{
	$test = str_replace(' ', '', $aff);

	if ($test !== '')
	{
		return $aff;
	}
	elseif ($test === '' && $id === 0)
	{
		return $lang_none;
	}
	elseif ($test === '' && $id !== 0)
	{
		return $lang_noref;
	}

	return '';
}

function format_string_db(string $string): string
{
	// magic_quotes_gpc is always OFF in PHP 5.4+, so stripslashes is not needed
	$retour = $string;
	// Use mysqli::real_escape_string() if connection available, otherwise return as-is
	return escape_string_db($retour);
}

function format_string_input(string $string): string
{
	return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function format_text_db(string $text): string
{
	// magic_quotes_gpc is always OFF in PHP 5.4+, so stripslashes is not needed
	$retour = $text;
	// Use mysqli::real_escape_string() if connection available, otherwise return as-is
	return escape_string_db($retour);
}

function neg_to_zero(int|float $num): int|float
{
	return $num <= 0 ? 0 : $num;
}

function ext_str_ireplace(string $findme, string $replacewith, string $subject): string
{
	// Replaces $findme in $subject with $replacewith
	// Ignores the case and keeps the original capitalization by using $1 in $replacewith

	$rest = $subject;
	$result = '';

	while (($pos = stripos($rest, $findme)) !== false) {
		// Remove the wanted string from $rest and append it to $result
		$result .= substr($rest, 0, $pos);
		$rest = substr($rest, $pos);

		// Remove the wanted string from $rest and place it correctly into $result
		$result .= str_replace('$1', substr($rest, 0, strlen($findme)), $replacewith);
		$rest = substr($rest, strlen($findme));
	}

	// After the last match, append the rest
	$result .= $rest;

	return $result;
} 

function cut_str(string $chaine, int $lenght = 30): string
{
	$retour = '';

	$tabs = str_split($chaine, $lenght);

	// Affichage du tableau résultant
	foreach ($tabs as $tab) {
		$retour .= $tab . "<br/>";
	}

	return $retour;
}


?>