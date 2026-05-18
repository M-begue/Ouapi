<?php
$affichage = '';
@(include('../config/connect.php')) OR die ("Le fichier connect.php n'a pu être trouvé");
@(include('../config/param_ouapi.php')) OR die ("Le fichier param_ouapi.php n'a pu être trouvé");
@(include('../includes/class_sql.php'));

session_start();
if (isset($_POST["langue"]))
	$_SESSION["install_lang"] = $_POST["langue"];
elseif (isset($_SESSION["install_lang"]))
	include("lang/install_".$_SESSION["install_lang"].".php");
else
	include("lang/install_FR.php");

// Init de la connexion SQL
$connect = new db_connect();
$connect->connection();
$req1 = new db_use;

include("templates/default/overall_header.php");

// Init de l'étape selectionnée
$etape = array();
if (!isset($_GET["etape"]))
	$etape[0] = 'border:1px solid #000000;font-weight:bold;color:black;background-color:#686995;';
else
	$etape[$_GET["etape"]] = 'border:1px solid #000000;font-weight:bold;color:black;  background-color:#686995;';


$affichage .= '<FORM name="form" action="maj.php?etape='.(@$_GET["etape"]+1).'" method="POST">';
$affichage .= '<div class="cat_title">'.$lang["maj_title".@$_GET["etape"]] .'</div><br/>';

// Affichage du tableau
if (!isset($_GET["etape"]))
{
		$affichage .= '<div style="border:2px solid red;padding:5px;"><img src="images/warning2.gif" alt="" style="vertical-align:middle;margin-right:5px;" /><b>'.$lang["maj_disclamer"].'</b></div><br/>
		<table class="table" style="margin-top:20px;">
		<tr>
			<td class="titre2" colspan="2">'.$lang["maj_paramcheck"].'</td>
		</tr>
		<tr>
			<td class="row1" width="40%">'.$lang["maj_ouapibase"].'</td>';
		
		$tab = @$req1->db_use_query("SHOW DATABASES");
		
		if (count($tab) > 0 && !mysql_error())
		{
			$affichage .= '<td class="row1"><select name="database" class="non_form">';
			$i = 0;
			while ($i < count ($tab))
			{
				if ($tab[$i]["Database"] == DB_TRANSM)
					$affichage .= '<option value="'.$tab[$i]["Database"].'" selected>'.$tab[$i]["Database"].'</option>';
				else
					$affichage .= '<option value="'.$tab[$i]["Database"].'">'.$tab[$i]["Database"].'</option>';
				$i++;
			}
			$affichage .= '</select></td>';
		}
		else
		{
			$affichage .= '<td class="row1"><input type="text" name="database" value="'.DB_TRANSM.'" class="non_form"></td>';
		}
			
		$tab_version = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='gen_version'");

		$affichage .= '<tr>
			<td class="row1" width="40%">'.$lang["maj_currentversion"].'</td>
			<td class="row1"><input type="text" name="version" value="'.$tab_version[0]["valeur"].'" class="non_form"></td>
		</tr>';
		$affichage .= '<tr>
			<td colspan="2" align="center"><br/><input type="submit" name="soumettre" value="'.$lang["maj_etape1"].'" class="non_form"></td>
		</tr>
		</table>';
}
elseif ($_GET["etape"] == 1)
{
		$_SESSION["maj_database"] = $_POST["database"];
		$_SESSION["maj_version"] = $_POST["version"];
		
		$rep = "maj/";
		$dir = opendir($rep);
		$files = array();
		$errors = 0;
		
		while ($f = readdir($dir)) {
			if(is_file($rep.$f)) 
			{
				$ext = explode(".",$f);
				$filename_without_ext = $ext[0];  // ex: "1-4_1-5"
				
				// Comparer directement sans transformer les tirets
				if ($filename_without_ext == $_SESSION["maj_version"] && $ext[1] == 'txt')
					array_push($files,$f);
			}
		}
		closedir($dir);
		
		// Vérification de la base
		$connect_base = new db_connect();
		$connect_base->connection(DB_HOST,DB_USER,DB_MDP,$_SESSION["maj_database"]);
		
		$tab = @$req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE nom='gen_version'");		
		
		$affichage .= '<table class="table" style="margin-top:20px;">';

		if (count($tab) > 0)
		{
			$affichage .= '<tr>
				<td class="row1" width="10%"><img src="images/checked.gif" style="vertical-align:middle"></td>
				<td class="row1">'.$lang["maj_validbase"].'</td>
			</tr>';
			
			if ($tab[0]["valeur"] == $_SESSION["maj_version"])
			{
				$affichage .= '<tr>
					<td class="row1" width="10%"><img src="images/checked.gif" style="vertical-align:middle"></td>
					<td class="row1">'.$lang["maj_validversion"].'</td>
				</tr>';
			}
			else
			{
				$errors++;
				$affichage .= '<tr>
					<td class="row1" width="10%"><img src="images/not-checked.gif" style="vertical-align:middle"></td>
					<td class="row1">'.$lang["maj_invalidversion"].'</td>
				</tr>';
			}
		}
		else
		{
			$errors++;
			$affichage .= '<tr>
				<td class="row1" width="10%"><img src="images/not-checked.gif" style="vertical-align:middle"></td>
				<td class="row1">'.$lang["maj_invalidbase"].'</td>
			</tr>';	
			$affichage .= '<tr>
				<td class="row1" width="10%"><img src="images/not-checked.gif" style="vertical-align:middle"></td>
				<td class="row1">'.$lang["maj_invalidversion"].'</td>
			</tr>';	
		}

		$affichage .= '</table>';
		
		// Selection du fichier de mise à jour
		if (count($files) > 0)
		{
			$affichage .= '<br/><b>'.$lang["maj_choosever"].'</b><select name="maj_file" class="non_form" style="width:200px;margin-left:50px;">';
			$i = 0;
			while ($i < count($files))
			{
				$label = explode("#",str_replace("_"," -> ",str_replace("-",".",str_replace(".","#",$files[$i]))));
				$affichage .= '<option value="'.$files[$i].'">'.$label[0].'</option>';		
				$i++;
			}
			$affichage .= '</select><br/><br/>';	
		}
		else
		{
			$affichage .= '<table class="table" style="margin-top:20px;">
			<tr>
				<td class="row1" width="10%"><img src="images/warning2.gif" style="vertical-align:middle"></td>
				<td class="row1"><b>'.$lang["maj_nomajauto"].'</b><br/>
				<small style="color:#666;">Version détectée: <b>'.$_SESSION["maj_version"].'</b></small></td>
			</tr>
			</table><br/>';
			$affichage .= '<input type="checkbox" name="force_continue" value="1"> <b>Continuer quand même (ignorer les fichiers manquants)</b><br/><br/>';
		}
			
		if ($errors == 0 || isset($_POST["force_continue"]))
			$affichage .= '<div align="center"><input type="submit" name="soumettre" value="'.$lang["maj_etape2"].'" class="non_form"></div>';
		else
			$affichage .= '<div align="center"><a href="maj.php">'.$lang["maj_back"].'</a></div>';
		
}
elseif ($_GET["etape"] == 2)
{
	// Si force_continue et pas de maj_file, on skipe l'étape 2
	if (isset($_POST["force_continue"]) && empty($_POST["maj_file"]))
	{
		$affichage .= '<div style="margin-top:10px;margin-bottom:20px;font-weight:bold;color:#666;">Continuation forcée - Pas de fichier de migration à appliquer.</div>';
		$affichage .= '<div align="center" style="margin-top:20px"><input type="submit" name="soumettre" value="'.$lang["maj_etape3"].'" class="non_form"></div>';
	}
	else
	{
		$maj_fichiers = explode(".",$_POST["maj_file"]);
		$_SESSION["maj_file"] = $maj_fichiers[0];
		
		if ($fp = @fopen("maj/".$_SESSION["maj_file"].'.txt',"r"))
		{
			$affichage .= '<div style="color:red"><b>'.$lang["maj_fileedit"].'</b></div><br/><div style="text-align:left">';
			while (!feof($fp)) { 
			  $line = fgets($fp, 4096); 		  
			  $line = str_replace("\\n","<br/>",$line);
			  $line = str_replace("[F]",'<br/><font style="color:black;font-weight:bold;">[ '.$lang["maj_filename"],$line);
			  $line = str_replace("[/F]",' ]</font><br/>',$line);
			  $line = str_replace("[D_IF]",'<br/><u>'.$lang["maj_deleteif"].'</u><br/>',$line);
			  $line = str_replace("[/D_IF]",'<br/>',$line);
			  $line = str_replace("[A]",'<u>'.$lang["maj_after"].'</u><br/>',$line);
			  $line = str_replace("[/A]",'<br/><br/><u>'.$lang["maj_add"].'</u><br/>',$line);
			  
			if (defined("DB_PREFIX"))
				$line = str_replace("{DB_PREFIX}",DB_PREFIX,$line);
			else
				$line = str_replace("{DB_PREFIX}","ouapi_",$line);
			  
			  $affichage .= $line;
			}
			$affichage .= '</div>';
		}
		else
		{
			$affichage .= '<div style="margin-top:20px;margin-bottom:40px;font-weight:bold;">'.$lang["maj_nofilemaj"].'</div>';
		}

		$affichage .= '<div align="center" style="margin-top:20px"><input type="submit" name="soumettre" value="'.$lang["maj_etape3"].'" class="non_form"></div>';
	}
}
elseif ($_GET["etape"] == 3)
{
	// Si force_continue sans maj_file, skip l'affichage des requêtes
	if (empty($_SESSION["maj_file"]))
	{
		$affichage .= '<div style="margin-top:10px;margin-bottom:20px;font-weight:bold;color:#666;">Continuation forcée - Pas de requêtes SQL à exécuter.</div>';
	}
	else
	{
		$affichage .= '<div style="margin-top:10px;margin-bottom:20px;font-weight:bold;">'.$lang["maj_reqcontrol"].'</div>
		<div style="font-size:11px;">';
		
		// Lecture du fichier de requetes SQL
		if ($fp = @fopen("maj/".$_SESSION["maj_file"].'.sql',"r"))
		{
			while (!feof($fp)) 
			{ 
				$line = fgets($fp, 4096); 
			  
				if (defined("DB_PREFIX"))
					$line = str_replace("{DB_PREFIX}",DB_PREFIX,$line);
				else
					$line = str_replace("{DB_PREFIX}","ouapi_",$line);

				$nb = preg_match_all("`\{([A-Za-z0-9_]*)\}`",$line,$constantes);

				$j = 0;
				while ($j < $nb)
				{
					if (defined($constantes[1][$j]))
						$line = str_replace($constantes[0][$j],constant($constantes[1][$j]),$line);
					$j++;
				}
				
				$affichage .= str_replace(';[END]',';<br/>',$line);

			}
		}
		
		$affichage .= '</div>';
	}
	
	$affichage .= '<div align="center" style="margin:30px"><input type="submit" name="soumettre" value="'.$lang["maj_button"].'" class="non_form"></div>';
}
elseif ($_GET["etape"] == 4)
{
	$page = '';
	if ($fp = @fopen("maj/".$_SESSION["maj_file"].'.sql',"r"))
	{
		while (!feof($fp)) { 
		  $page .= fgets($fp, 4096); 
		}
	}

	// Remplacement du prefixe dans les requetes
	if (!defined("DB_PREFIX"))
		define("DB_PREFIX","ouapi_");
	
	// Remplacement des constantes {} dans les requetes
	$nb = preg_match_all("`\{([A-Za-z0-9_]*)\}`",$page,$constantes);
	
	$i = 0;
	while ($i < $nb)
	{
		if (defined($constantes[1][$i]))
			$page = str_replace($constantes[0][$i],constant($constantes[1][$i]),$page);
		$i++;
	}

	$requetes = preg_split('`;\[END\]`', $page);

	$affichage .= '<div style="text-align:left;">';
	foreach($requetes as $requete){
		$error = '';
		
		if (trim($requete) != '')
		{
			if (!preg_match("`_ldap_`i",$requete) && !preg_match("`_ocs_`i",$requete))
			{
				$tab = @$req1->db_use_query($requete);
				
				$error = mysql_error();
				if ($error == '')
					$error = '<font style="color:lime"><b>'.$lang["maj_ok"].'</b></font>';
				else
					$error = '<font style="color:#FF0000"><b>'.$error.'</b></font>';
				
				$affichage .= '<div style="font-size:11px;">'.$requete.'</b><br/>('.$error.' )</div>';
			}
		}
	}
	
	if (is_file("maj/".$_SESSION["maj_file"].'.php'))
		include("maj/".$_SESSION["maj_file"].'.php');

	$affichage .= '</div>
	<div style="margin-top:10px;" align="center"><b>'.$lang["maj_success"].'</b><br/><a href="../index.php">'.$lang["maj_homepage"].'</a></div>';
}

$affichage .= '</form><br/>';


include("templates/default/overall_footer.php");

echo $affichage;

?>