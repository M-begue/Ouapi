<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2010 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/
function day_conv3($day)
{
	if (!isset($_SESSION["int_lang"]))
	$_SESSION["int_lang"] = DEFAULT_LANGUAGE;
	include('lang/lang_'.$_SESSION["int_lang"].'.php');

	$jour["Mon"] = $lang["calendar"][20];
	$jour["Tue"] = $lang["calendar"][21];
	$jour["Wed"] = $lang["calendar"][22];
	$jour["Thu"] = $lang["calendar"][23];
	$jour["Fri"] = $lang["calendar"][24];
	$jour["Sat"] = $lang["calendar"][25];
	$jour["Sun"] = $lang["calendar"][26];

	return $jour[$day];
}

function aff_form_date($nom = "date", $annee_deb = 0)
{
	if (!isset($_SESSION["int_lang"]))
	$_SESSION["int_lang"] = DEFAULT_LANGUAGE;
	include('lang/lang_'.$_SESSION["int_lang"].'.php');

	if ($annee_deb == 0)
		$annee_deb = date("Y");
		
	$jour_actu = date("j");
	$mois_actu = date("n");	
	$annee_fin = date("Y")+1;
	
	$mois[1] = $lang["calendar"][1];
	$mois[2] = $lang["calendar"][2];
	$mois[3] = $lang["calendar"][3];
	$mois[4] = $lang["calendar"][4];
	$mois[5] = $lang["calendar"][5];
	$mois[6] = $lang["calendar"][6];
	$mois[7] = $lang["calendar"][7];
	$mois[8] = $lang["calendar"][8];
	$mois[9] = $lang["calendar"][9];
	$mois[10] = $lang["calendar"][10];
	$mois[11] = $lang["calendar"][11];
	$mois[12] = $lang["calendar"][12];
	
	$affichage .= '<input type="text" name="'.$nom.'_jour" value="'.$jour_actu.'" class="calendrier" size="2" maxlength="2"> ';
	
	$affichage .= '<Select name="'.$nom.'_mois" class="calendrier">';
		
	$i = 1;
	while ($i <= 12)
	{
		if ($i < 10)
			$valeur = "0".$i;
		else
			$valeur = $i;
		
		if ($i == $mois_actu)
			$affichage .= '<option value="'.$valeur.'" selected>'.$mois[$i].'</option>';
		else
			$affichage .= '<option value="'.$valeur.'">'.$mois[$i].'</option>';
		$i++;
	}
	$affichage .= '</select> ';
	
	$affichage .= '<Select name="'.$nom.'_annee" class="calendrier">';
		
	$i = $annee_deb;
	while ($i <= $annee_fin)
	{
		if ($i == date("Y"))
			$affichage .= '<option value="'.$i.'" selected>'.$i.'</option>';
		else		
			$affichage .= '<option value="'.$i.'">'.$i.'</option>';
		$i++;
	}
	$affichage .= '</select>';

	
	return $affichage;
}

function week_dates($week,$year) {
   $week_dates = array();
   // Get timestamp of first week of the year
   $first_day = mktime(0,0,1,1,1,$year);
   $first_week = date("W",$first_day);
   if ($first_week > 1) {
       $first_day = strtotime("+1 week",$first_day); // skip to next if year does not begin with week 1
   }
   // Get timestamp of the week
   $add_week = $week-1;
   $timestamp = strtotime("+$add_week week",$first_day);
   // Adjust to Monday of that week
   $what_day = date("w",$timestamp); // I wanted to do "N" but only version 4.3.9 is installed :-(
   if ($what_day==0) {
       // actually Sunday, last day of the week. FIX;
       $timestamp = strtotime("-6 days",$timestamp);
   } elseif ($what_day > 1) {
       $what_day--;
       $timestamp = strtotime("-$what_day days",$timestamp);
   }
   $week_dates[1] = $timestamp; // Monday
   $week_dates[2] = strtotime("+1 day",$timestamp); // Tuesday
   $week_dates[3] = strtotime("+2 day",$timestamp); // Wednesday
   $week_dates[4] = strtotime("+3 day",$timestamp); // Thursday
   $week_dates[5] = strtotime("+4 day",$timestamp); // Friday
   $week_dates[6] = strtotime("+5 day",$timestamp); // Saturday
   $week_dates[7] = strtotime("+6 day",$timestamp); // Sunday
   return($week_dates);
}
class calendrier EXTENDS db_use //renvoi un calendrier
{
	public $lang;
	var $mois;
	var $annee;
	var $avt;
	var $apr;
	
	function __construct($lang)
	{
		$this->lang = $lang;
	}
	
	function aff_calendrier($mois,$annee,$id,$type)
	{
		$annee = date("Y",mktime(0,0,0,$mois,1,$annee));
		$mois = date("n",mktime(0,0,0,$mois,1,$annee));
		
		$affichage = '';

		// Pr�paration de l'affichage des resa
		$req1 = new db_use;
		$requete = "SELECT ".TAB_RESA.".*,
		  ".TAB_USERS.".nom,
		  ".TAB_USERS.".prenom
		FROM ".TAB_RESA." 
		  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_RESA.".user_id
		WHERE ".$type."_id='".$id."' AND (
			(date_deb >= ".mktime(0,0,0,$mois,1,$annee)." AND date_deb <= ".mktime(23,59,59,($mois+1),0,$annee).") OR
			(date_fin >= ".mktime(0,0,0,$mois,1,$annee)." AND date_fin <= ".mktime(23,59,59,($mois+1),0,$annee).") OR
			(date_deb < ".mktime(0,0,0,$mois,1,$annee)." AND date_fin > ".mktime(23,59,59,($mois+1),0,$annee)."))
		ORDER BY date_deb ASC";
		$tab = $req1->db_use_query($requete);
		
		$resa = array();
		$j = 0;			
		while ($j < count($tab))
		{
			//echo 'Deb >'.$tab[$j]["date_deb"].' - '.mktime(0,0,0,$mois,1,$annee).'<br/>';
			//echo 'Fin >'.$tab[$j]["date_fin"].' - '.mktime(23,59,59,($mois+1),0,$annee).'<br/>';
			
			// Resa commence sur un mois pr�c�dent et fini sur un mois suivant 
			if ($tab[$j]["date_deb"] < mktime(0,0,0,$mois,1,$annee) && $tab[$j]["date_fin"] > mktime(23,59,59,($mois+1),0,$annee))
			{
				$i = 1;
				while ($i <= date("j", mktime(0,0,0,$mois+1,0,$annee)))
				{
					$resa[$i] = '<div class="resa_complday">'.$this->lang["reserv_complday"].' - '.aff_users($tab[$j]["nom"].' '.substr($tab[$j]["prenom"],0,1).'.',$tab[$j]["user_id"],$this->lang["hard_user_noref"],'[ '.$this->lang["none"].' ]').
					(($tab[$j]["object"] != '')?('<br/><i>'.$tab[$j]["object"].'</i>'):(' ')).'</div>';
					$i++;
				}
			}
			// R�sa commence sur un mois pr�c�dent et fini sur le mois courant
			elseif ($tab[$j]["date_deb"] < mktime(0,0,0,$mois,1,$annee) && $tab[$j]["date_fin"] >= mktime(0,0,0,$mois,1,$annee) && $tab[$j]["date_fin"] <= mktime(23,59,59,($mois+1),0,$annee))
			{
				$i = 1;
				while ($i <= date("j", $tab[$j]["date_fin"]-86400) && date("j", $tab[$j]["date_fin"]) != 1)
				{
					$resa[$i] = '<div class="resa_complday">'.$this->lang["reserv_complday"].' - '.aff_users($tab[$j]["nom"].' '.substr($tab[$j]["prenom"],0,1).'.',$tab[$j]["user_id"],$this->lang["hard_user_noref"],'[ '.$this->lang["none"].' ]')
					.(($tab[$j]["object"] != '')?('<br/><i>'.$tab[$j]["object"].'</i>'):(' ')).'</div>';
					$i++;
				}
				
				if (!isset($resa[date("j", $tab[$j]["date_fin"])]))
					$resa[date("j", $tab[$j]["date_fin"])] = '';

				$resa[date("j", $tab[$j]["date_fin"])] .= '<div class="resa_hour">00:00 > '.date("H:i", $tab[$j]["date_fin"]).'
				- '.aff_users($tab[$j]["nom"].' '.substr($tab[$j]["prenom"],0,1).'.',$tab[$j]["user_id"],$this->lang["hard_user_noref"],'[ '.$this->lang["none"].' ]').(($tab[$j]["object"] != '')?('<br/><i>'.$tab[$j]["object"].'</i>'):(' ')).'</div>';
			}
			// R�sa commence et fini sur le m�me mois
			elseif ($tab[$j]["date_deb"] >= mktime(0,0,0,($mois),1,$annee) && $tab[$j]["date_deb"] <= mktime(23,59,59,($mois+1),0,$annee) && $tab[$j]["date_fin"] >= mktime(0,0,0,($mois),1,$annee) && $tab[$j]["date_fin"] <= mktime(23,59,59,($mois+1),0,$annee))
			{
				// Plusieurs jours
				if (date("j", $tab[$j]["date_deb"]) != date("j", $tab[$j]["date_fin"]))
				{
					if (!isset($resa[date("j", $tab[$j]["date_deb"])]))
						$resa[date("j", $tab[$j]["date_deb"])] = '';
						
					$resa[date("j", $tab[$j]["date_deb"])] .= '<div class="resa_hour">'.date("H:i", $tab[$j]["date_deb"]).' > 23:59
					- '.aff_users($tab[$j]["nom"].' '.substr($tab[$j]["prenom"],0,1).'.',$tab[$j]["user_id"],$this->lang["hard_user_noref"],'[ '.$this->lang["none"].' ]').(($tab[$j]["object"] != '')?('<br/><i>'.$tab[$j]["object"].'</i>'):(' ')).'</div>';
					
					$i = date("j", $tab[$j]["date_deb"])+1;
					while ($i < date("j", $tab[$j]["date_fin"]))
					{
						$resa[$i] = '<div class="resa_complday">'.$this->lang["reserv_complday"].' - '.aff_users($tab[$j]["nom"].' '.substr($tab[$j]["prenom"],0,1).'.',$tab[$j]["user_id"],$this->lang["hard_user_noref"],'[ '.$this->lang["none"].' ]')
						.(($tab[$j]["object"] != '')?('<br/><i>'.$tab[$j]["object"].'</i>'):(' ')).'</div>';
						$i++;
					}
					
					$resa[date("j", $tab[$j]["date_fin"])] = '<div class="resa_hour">00:00 > '.date("H:i", $tab[$j]["date_fin"]).'
					- '.aff_users($tab[$j]["nom"].' '.substr($tab[$j]["prenom"],0,1).'.',$tab[$j]["user_id"],$this->lang["hard_user_noref"],'[ '.$this->lang["none"].' ]').(($tab[$j]["object"] != '')?('<br/><i>'.$tab[$j]["object"].'</i>'):(' ')).'</div>';	
				}	
				// Inf�rieur ou egal a une journ�e
				else
				{
					if (!isset($resa[date("j", $tab[$j]["date_deb"])]))
						$resa[date("j", $tab[$j]["date_deb"])] = '';
						
					$resa[date("j", $tab[$j]["date_deb"])] .= '<div class="resa_hour">'.date("H:i", $tab[$j]["date_deb"]).' > '.date("H:i", $tab[$j]["date_fin"]).'
					- '.aff_users($tab[$j]["nom"].' '.substr($tab[$j]["prenom"],0,1).'.',$tab[$j]["user_id"],$this->lang["hard_user_noref"],'[ '.$this->lang["none"].' ]').(($tab[$j]["object"] != '')?('<br/><i>'.$tab[$j]["object"].'</i>'):(' ')).'</div>';
				}					

			}
			// R�sa termine sur un mois suivant
			elseif ($tab[$j]["date_deb"] >= mktime(0,0,0,$mois,1,$annee) && $tab[$j]["date_deb"] <= mktime(23,59,59,($mois+1),0,$annee) && $tab[$j]["date_fin"] >= mktime(23,59,59,($mois+1),0,$annee))
			{
				if (!isset($resa[date("j", $tab[$j]["date_deb"])]))
					$resa[date("j", $tab[$j]["date_deb"])] = '';
					
				$resa[date("j", $tab[$j]["date_deb"])] .= '<div class="resa_hour">'.date("H:i", $tab[$j]["date_deb"]).' > 23:59
				- '.aff_users($tab[$j]["nom"].' '.substr($tab[$j]["prenom"],0,1).'.',$tab[$j]["user_id"],$this->lang["hard_user_noref"],'[ '.$this->lang["none"].' ]').(($tab[$j]["object"] != '')?('<br/><i>'.$tab[$j]["object"].'</i>'):(' ')).'</div>';

				$i = date("j", $tab[$j]["date_deb"])+1;
				while ($i <= date("j", mktime(0,0,0,($mois+1),0,$annee)))
				{
					$resa[$i] = '<div class="resa_complday">'.$this->lang["reserv_complday"].' - '.aff_users($tab[$j]["nom"].' '.substr($tab[$j]["prenom"],0,1).'.',$tab[$j]["user_id"],$this->lang["hard_user_noref"],'[ '.$this->lang["none"].' ]').(($tab[$j]["object"] != '')?('<br/><i>'.$tab[$j]["object"].'</i>'):(' ')).'</div>';
					$i++;
				}
			}

			$j++;
		}

		
		//variables
		$ts = mktime(1,1,1,$mois,1,$annee); //Recuperation du timestamp du numero du jour de base cad le numero du jour du premier jour du mois ouf !
		$tab = getdate($ts); //Recuperation du numero du jour de base, le numero du jour du premier jour du mois
		$j = 1 ; //premier jour 	
		$nbjour = date('t',$ts) ;//nombre de jour dans le mois
		$nom_mois = array('Janvier','F�vrier','Mars','Avril','Mai','Juin','Juillet','Ao�t','Septembre','Octobre','Novembre','D�cembre');//Nom des moins in French
		
		//cette sequence corrige le numero du dimanche. PHP donne 0, dans notre cas 7 est pr�f�rable, donc..
		if($tab['wday'] == 0)
		{
			$dp = 7 ;
		}
		else
		{
			$dp = $tab['wday'] ;
		}
		//Affichage de l'ent�te du calendrier	
		$affichage .= '<td style="border:1px solid black;vertical-align:top" width="50%">
		<table align="center" width="99%">
		<tr>';

		$url_prev = preg_replace("{&mois=".$_GET["mois"]."}","&mois=".($_GET["mois"]-1),$_SERVER['REQUEST_URI']);
		$url_next = preg_replace("{&mois=".$_GET["mois"]."}","&mois=".($_GET["mois"]+1),$_SERVER['REQUEST_URI']);
		
		$affichage .= '<td colspan="7" align="center" class="titre3" style="font-size:14px;"><a href="'.$url_prev.'">
		<img src="templates/'.DEFAULT_TEMPLATE.'/images/left_red.gif" border="0" style="vertical-align:middle"></a>
		'.$nom_mois[$mois-1].' '.$annee.'&nbsp;<a href="'.$url_next.'"><img src="templates/'.DEFAULT_TEMPLATE.'/images/right_red.gif" border="0" style="vertical-align:middle"></a></td>';
		$affichage .= '</tr>
		<tr>
			<td class="titre4" width="14%" align="center">Lun</td>
			<td class="titre4" width="14%" align="center">Mar</td>
			<td class="titre4" width="14%" align="center">Mer</td>
			<td class="titre4" width="14%" align="center">Jeu</td>
			<td class="titre4" width="14%" align="center">Ven</td>
			<td class="titre4" width="14%" align="center">Sam</td>
			<td class="titre4" width="14%" align="center">Dim</td>
		</tr>';
		
		//Affichage du calendrier
		for($i=1;$i<=42;$i++)
		{
			if($i % 7 == 1 ) //si il reste un, on commence forcement une nouvelle ligne	
			{
				$affichage .= "<tr>";
			}
		
			if(($dp <= $i)&&($j <= $nbjour))//si nous sommes apres le numero du premier jour et que nous n avons pas pass� le jour de fin
			{  
				$pos=array_search($j,$resa);

				if ($mois == date("m") && $annee == date("Y") && $j == date("d"))
					$font = 'color:darkblue;font-weight:bold;border: 2px solid darkblue;';
				else
					$font = '';
					
				if (isset($resa[$j]))
					$affichage .= "<td height='60px;' class='row1' style='".$font.";vertical-align:top;'><b>$j</b><br>".$resa[$j]."</td>" ; //on affiche
				else
					$affichage .= "<td height='60px;' class='row1' style='".$font.";vertical-align:top;'><b>$j</b></td>" ; //on affiche
				$j++;
			} 
			else
			{
				$affichage .= "<td></td>"; //sinon case vide
			}

			if($i % 7 == 0 ) //si il ne reste rien, cad des multiples de 7, on se retrouve forcement en fin de ligne	
			{
				$affichage .= "</tr>";
			}
		}
		$affichage .= '</table>'; //affichage de la fin du tableau
		
		
		return $affichage;
	}	
	
	function aff_calendrier_week($week,$annee,$id,$type)
	{
		$limit_dates = week_dates($week,$annee);	
		$affichage = '';

		// Pr�paration de l'affichage des resa
		$req1 = new db_use;
		$requete = "SELECT ".TAB_RESA.".*,
		  ".TAB_USERS.".nom,
		  ".TAB_USERS.".prenom
		FROM ".TAB_RESA." 
		  LEFT JOIN ".TAB_USERS." ON ".TAB_USERS.".id = ".TAB_RESA.".user_id
		WHERE ".$type."_id='".$id."' AND (
			(date_deb >= ".$limit_dates[1]." AND date_deb <= ".$limit_dates[7].") OR
			(date_fin >= ".$limit_dates[1]." AND date_fin <= ".$limit_dates[7].") OR
			(date_deb < ".$limit_dates[1]." AND date_fin > ".$limit_dates[7]."))
		ORDER BY date_deb ASC";
		$tab = $req1->db_use_query($requete);
		
		$resa = array();
		$avant = array();
		$last = array(date("Ymd", $limit_dates[1]) => $limit_dates[1],
		date("Ymd", $limit_dates[2]) => $limit_dates[2],
		date("Ymd", $limit_dates[3]) => $limit_dates[3],
		date("Ymd", $limit_dates[4]) => $limit_dates[4],
		date("Ymd", $limit_dates[5]) => $limit_dates[5],
		date("Ymd", $limit_dates[6]) => $limit_dates[6],
		date("Ymd", $limit_dates[7]) => $limit_dates[7]);
		
		$j = 0;			
		while ($j < count($tab))
		{			
			// echo 'Deb >'.$tab[$j]["date_deb"].' - '.mktime(0,0,0,$week,1,$annee).'<br/>';
			// echo 'Fin >'.$tab[$j]["date_fin"].' - '.mktime(23,59,59,($week+1),0,$annee).'<br/>';
			
			// Resa commence sur semaine pr�c�dente et fini sur une semaine apr�s 
			if ($tab[$j]["date_deb"] < $limit_dates[1] && $tab[$j]["date_fin"] > ($limit_dates[7]+86399))
			{
				foreach ($last as $cle => $valeur )
				{
					$resa[$cle] = '<div class="resa_view" style="height:'.round((24*3600)/200-10).'px;">
					<b>'.txt_to_na(trim($tab[$j][US_LNAME].' '.$tab[$j][US_FNAME])).'</b>'.
					(($tab[$j]["object"] != '')?('<br/>'.$tab[$j]["object"]):('')).'</div>';
				}
			}
			// R�sa commence sur semaine pr�c�dente et fini sur la semaine courante
			elseif ($tab[$j]["date_deb"] < $limit_dates[1] && $tab[$j]["date_fin"] >= $limit_dates[1] && $tab[$j]["date_fin"] <=($limit_dates[7]+86399))
			{
				foreach ($last as $cle => $valeur )
				{
					if ($cle >= date("Ymd", $tab[$j]["date_fin"]))
						break;
						
					$resa[$cle] = '<div class="resa_view" style="height:'.round((24*3600)/200-10).'px;">
					<b>'.txt_to_na(trim($tab[$j][US_LNAME].' '.$tab[$j][US_FNAME])).'</b>'.
					(($tab[$j]["object"] != '')?('<br/>'.$tab[$j]["object"]):('')).'</div>';
				}
				
				if (!isset($resa[date("Ymd", $tab[$j]["date_fin"])]))
					$resa[date("Ymd", $tab[$j]["date_fin"])] = '';

				// Dernier jour
				$duree = date("G",$tab[$j]["date_fin"])*3600 + date("i",$tab[$j]["date_fin"])*60;
				$avant = 0;
				$last[date("Ymd", $tab[$j]["date_fin"])] = $tab[$j]["date_fin"];
					
				$resa[date("Ymd", $tab[$j]["date_fin"])] .= '<div class="resa_view" style="height:'.round($duree/200-10).'px;">
				<b>'.txt_to_na(trim($tab[$j][US_LNAME].' '.$tab[$j][US_FNAME])).'</b>'.
				(($tab[$j]["object"] != '')?('<br/>'.$tab[$j]["object"]):(' ')).
				'<br/><i>(00:00 > '.date("H:i", $tab[$j]["date_fin"]).')</i>
				</div>';
			}
			// R�sa commence et fini sur la semaine courante
			elseif ($tab[$j]["date_deb"] >= $limit_dates[1] && $tab[$j]["date_deb"] <= ($limit_dates[7]+86399) && $tab[$j]["date_fin"] >= $limit_dates[1] && $tab[$j]["date_fin"] <= ($limit_dates[7]+86399))
			{
				// Plusieurs jours
				if (date("j", $tab[$j]["date_deb"]) != date("j", $tab[$j]["date_fin"]))
				{
					if (!isset($resa[date("Ymd", $tab[$j]["date_deb"])]))
						$resa[date("Ymd", $tab[$j]["date_deb"])] = '';
						
					//Premier jour
					$duree = (24*3600)-(date("G",$tab[$j]["date_deb"])*3600 + date("i",$tab[$j]["date_deb"])*60);
					$avant = $tab[$j]["date_deb"]-$last[date("Ymd", $tab[$j]["date_deb"])];
					$last[date("Ymd", $tab[$j]["date_deb"])] = $tab[$j]["date_fin"];
					
					$resa[date("Ymd", $tab[$j]["date_deb"])] .= '<div class="resa_view" style="height:'.round($duree/200-10).'px;margin-top:'.round($avant/200).'px">
					<b>'.txt_to_na(trim($tab[$j][US_LNAME].' '.$tab[$j][US_FNAME])).'</b>'.
					(($tab[$j]["object"] != '')?('<br/>'.$tab[$j]["object"]):(' ')).
					'<br/><i>('.date("H:i", $tab[$j]["date_deb"]).' > 23:59)<i></div>';
					
					// Jours centraux
					foreach ($last as $cle => $valeur ) {
						if ($cle > date("Ymd", $tab[$j]["date_deb"]) && $cle < date("Ymd", $tab[$j]["date_fin"]))
						{
							$resa[$cle] = '<div class="resa_view" style="height:'.round((24*3600)/200-10).'px;">
							<b>'.txt_to_na(trim($tab[$j][US_LNAME].' '.$tab[$j][US_FNAME])).'</b>'.
							(($tab[$j]["object"] != '')?('<br/>'.$tab[$j]["object"]):('')).'</div>';
						}
					}

					// Dernier jour
					$duree = date("G",$tab[$j]["date_fin"])*3600 + date("i",$tab[$j]["date_fin"])*60;
					$avant = 0;
					$last[date("Ymd", $tab[$j]["date_fin"])] = $tab[$j]["date_fin"];
					
					$resa[date("Ymd", $tab[$j]["date_fin"])] = '<div class="resa_view" style="height:'.round($duree/200-10).'px;margin-top:'.round($avant/200).'px">
					<b>'.txt_to_na(trim($tab[$j][US_LNAME].' '.$tab[$j][US_FNAME])).'</b>'.
					(($tab[$j]["object"] != '')?('<br/>'.$tab[$j]["object"]):(' ')).
					'<br/><i>(00:00 > '.date("H:i", $tab[$j]["date_fin"]).')</i></div>';	
				}	
				// Inf�rieur ou egal a une journ�e
				else
				{
					if (!isset($resa[date("Ymd", $tab[$j]["date_deb"])]))
						$resa[date("Ymd", $tab[$j]["date_deb"])] = '';
						
					$duree = $tab[$j]["date_fin"]-$tab[$j]["date_deb"];
					$avant = $tab[$j]["date_deb"]-$last[date("Ymd", $tab[$j]["date_deb"])];
					$last[date("Ymd", $tab[$j]["date_fin"])] = $tab[$j]["date_fin"];
					
					$resa[date("Ymd", $tab[$j]["date_deb"])] .= '<div class="resa_view" style="height:'.round($duree/200-10).'px;margin-top:'.round($avant/200).'px">
					<b>'.txt_to_na(trim($tab[$j][US_LNAME].' '.$tab[$j][US_FNAME])).'</b>'.
					(($tab[$j]["object"] != '')?('<br/>'.$tab[$j]["object"]):(' ')).
					'<br/><i>('.date("H:i", $tab[$j]["date_deb"]).' > '.date("H:i", $tab[$j]["date_fin"]).')</i>
					</div>';
				}					

			}
			// R�sa termine sur la semaine suivante
			elseif ($tab[$j]["date_deb"] >= $limit_dates[1] && $tab[$j]["date_deb"] <= ($limit_dates[7]+86399) && $tab[$j]["date_fin"] >= ($limit_dates[7]+86399))
			{
				if (!isset($resa[date("Ymd", $tab[$j]["date_deb"])]))
					$resa[date("Ymd", $tab[$j]["date_deb"])] = '';
					
				//Premier jour
				$duree = (24*3600)-(date("G",$tab[$j]["date_deb"])*3600 + date("i",$tab[$j]["date_deb"])*60);
				$avant = $tab[$j]["date_deb"]-$last[date("Ymd", $tab[$j]["date_deb"])];
				$last[date("j", $tab[$j]["date_deb"])] = $tab[$j]["date_fin"];
				
				$resa[date("Ymd", $tab[$j]["date_deb"])] .= '<div class="resa_view" style="height:'.round($duree/200-10).'px;margin-top:'.round($avant/200).'px">
				<b>'.txt_to_na(trim($tab[$j][US_LNAME].' '.$tab[$j][US_FNAME])).'</b>'.
				(($tab[$j]["object"] != '')?('<br/>'.$tab[$j]["object"]):(' ')).
				'<br/><i>('.date("H:i", $tab[$j]["date_deb"]).' > 23:59)</i></div>';

				// Jours complets suivants
				foreach ($last as $cle => $valeur )
				{
					if ($cle > date("Ymd", $tab[$j]["date_deb"]) && $cle < date("Ymd", $tab[$j]["date_fin"]))
					{
						$resa[$cle] = '<div class="resa_view" style="height:'.round((24*3600)/200-10).'px;">
						<b>'.txt_to_na(trim($tab[$j][US_LNAME].' '.$tab[$j][US_FNAME])).'</b>'.
						(($tab[$j]["object"] != '')?('<br/>'.$tab[$j]["object"]):('')).'</div>';
					}
				}
			}

			$j++;
		}
		
		//Affichage de l'ent�te du calendrier	
		$affichage .= '<td style="border:1px solid black;vertical-align:top" width="50%">
		<table align="center" width="99%">
		<tr>';

		$url_prev = preg_replace("{&week=".$_GET["week"]."}","&week=".($_GET["week"]-1),$_SERVER['REQUEST_URI']);
		$url_next = preg_replace("{&week=".$_GET["week"]."}","&week=".($_GET["week"]+1),$_SERVER['REQUEST_URI']);
		
		$libelle_semaine = $this->lang["gen_week"] ?? 'Semaine'; // Sécurité si la clé n'existe pas
		$affichage .= '<td></td><td colspan="7" align="center" class="titre3" style="font-size:14px;"><a href="'.$url_prev.'">
		<img src="templates/'.DEFAULT_TEMPLATE.'/images/left_red.gif" border="0" style="vertical-align:middle"></a>
		'.$libelle_semaine.' '.$week.' - '.$annee.'&nbsp;<a href="'.$url_next.'"><img src="templates/'.DEFAULT_TEMPLATE.'/images/right_red.gif" border="0" style="vertical-align:middle"></a></td>
		</tr>
		<tr>
		<td></td>';
			
		$days = array(
    		$this->lang["gen_mon"] ?? 'Lun',
    		$this->lang["gen_tue"] ?? 'Mar',
    		$this->lang["gen_wed"] ?? 'Mer',
    		$this->lang["gen_thu"] ?? 'Jeu',
    		$this->lang["gen_fri"] ?? 'Ven',
    		$this->lang["gen_sat"] ?? 'Sam',
    		$this->lang["gen_sun"] ?? 'Dim'
		);
		
		for($i=0;$i<7;$i++)
		{	
			if ($week == date("W") && $annee == date("Y") && date("j", $limit_dates[$i+1]) == date("j"))
				$font = 'border: 2px solid gold;background-color:gold;';
			else
				$font = '';
				
			$affichage .= '<td class="titre4" style="'.$font.'" width="14%" align="center">'.$days[$i].' '.date("j", $limit_dates[$i+1]).'</td>';
		}
		
		$affichage .= '</tr>
		<tr>
		<td class="row1" style="vertical-align:top;">
			<div style="border-top:1px solid black;margin-top:'.(4*3600/200).'px;height:'.(4*3600/200).'px">04:00</div>
			<div style="border-top:1px solid black;height:'.(4*3600/200).'px">08:00</div>
			<div style="border-top:1px solid black;height:'.(4*3600/200).'px">12:00</div>
			<div style="border-top:1px solid black;height:'.(4*3600/200).'px">16:00</div>
			<div style="border-top:1px solid black;height:'.(4*3600/200).'px">20:00</div>
		</td>';
		
		//Affichage du calendrier
		for($i=0;$i<7;$i++)
		{						
			if ($week == date("W") && $annee == date("Y") && date("j", $limit_dates[$i+1]) == date("j"))
				$font = 'border: 2px solid gold;';
			else
				$font = '';
				
			if (isset($resa[date("Ymd", $limit_dates[$i+1])]))
			{
				$affichage .= '<td class="row1" style="'.$font.';height:432px;vertical-align:top;">';
					$affichage .= '<div style="position:absolute;border-top:1px solid grey;margin-top:'.(4*3600/200).'px;width:12%;z-index:1;">&nbsp;</div>';
					$affichage .= '<div style="position:absolute;border-top:1px solid grey;margin-top:'.(8*3600/200+1).'px;width:12%;z-index:1;">&nbsp;</div>';
					$affichage .= '<div style="position:absolute;border-top:1px solid grey;margin-top:'.(12*3600/200+2).'px;width:12%;z-index:1;">&nbsp;</div>';
					$affichage .= '<div style="position:absolute;border-top:1px solid grey;margin-top:'.(16*3600/200+3).'px;width:12%;z-index:1;">&nbsp;</div>';
					$affichage .= '<div style="position:absolute;border-top:1px solid grey;margin-top:'.(20*3600/200+4).'px;width:12%;z-index:1;">&nbsp;</div>
					<div style="position:relative;height:0;"></div>';
					$affichage .= $resa[date("Ymd", $limit_dates[$i+1])];
				$affichage .= "</td>" ; 
			}
			else
			{
				$affichage .= '<td class="row1" style="'.$font.';height:432px;vertical-align:top;">
					<div style="border-top:1px solid grey;margin-top:'.(4*3600/200).'px;height:'.(4*3600/200).'px"></div>
					<div style="border-top:1px solid grey;height:'.(4*3600/200).'px"></div>
					<div style="border-top:1px solid grey;height:'.(4*3600/200).'px"></div>
					<div style="border-top:1px solid grey;height:'.(4*3600/200).'px"></div>
					<div style="border-top:1px solid grey;height:'.(4*3600/200).'px"></div>
				</td>'; 
			}
		}
		$affichage .= '</tr>
		</table>'; //affichage de la fin du tableau
		
		
		return $affichage;
	}	
} 
?>