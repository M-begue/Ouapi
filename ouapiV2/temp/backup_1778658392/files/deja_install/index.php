<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                           OUAPI install pack                              *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/
session_start();

include("templates/default/overall_header.php");

if (!isset($_POST["soumettre"]))
{
	$affichage .= '<div style="width:600px;margin-left:auto;margin-right:auto;margin-bottom:50px;text-align:center;"><img src="images/logo.png" alt="" /><br/>
	<p style="margin-top:40px;">Selectionnez la langue d\'installation / Please select installation language:</p>';
	
	// Langue
	$affichage .= '<form name="form" action="index.php" method="post"><p style="margin-top:40px;">
	<select name="langue" class="non_form" style="width:120px;">';
	$i = 0;
	$dir = "lang/";
	if (is_dir($dir) && $dh = opendir($dir)) 
	{
		while (($file = readdir($dh)) !== false) 
		{
			if ($file[0] != '.' && substr($file,0,7) == 'install')
			{
				$current = fopen($dir.$file,'r');
				$libelle = trim(str_replace("<?php //","",fgets($current, 4096)));
				$value = str_replace(".php","",substr($file,8));
				if ($value = 'FR')
					$affichage .= '<option value="'.$value.'" selected="selected">'.$libelle.'</option>';
				else
					$affichage .= '<option value="'.$value.'">'.$libelle.'</option>';
				fclose($current);
			}
		}
		closedir($dh);
	}			
	$affichage .= '</select><br/><br/><br/>
	<input type="submit" name="soumettre" value="Go !" class="non_form" style="width:80px;" /></p></form>
	</div>';
}
else
{
	$_SESSION["install_lang"] = $_POST["langue"];
	if (isset($_SESSION["install_lang"]))
		include("lang/install_".$_SESSION["install_lang"].".php");

	$affichage .= '<div style="width:600px;margin-left:auto;margin-right:auto;margin-bottom:50px;text-align:center;"><img src="images/logo.png">
	<p style="margin-top:40px;">
	<font style="font-size:14px;"><b>'.$lang["index_select"].'</b></font><br/><br/>
	<a href="install.php?etape=1">'.$lang["index_first"].'</a><br/><br/>
	<a href="maj.php">'.$lang["index_maj"].'</a></p>
	</div>';
}
include("templates/default/overall_footer.php");

echo $affichage;

?>