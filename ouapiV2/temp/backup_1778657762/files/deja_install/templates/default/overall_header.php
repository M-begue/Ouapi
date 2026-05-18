<?php
/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                           OUAPI install pack                              *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/
if (!isset($lang))
	$lang = array('title' => '', 'copyright' => '');

$affichage = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>'.$lang["title"].'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="templates/default/style.css" />
</head>
<body>
<div class="topmenu">
	<p class="button"><img src="images/icon_ouapi.png" style="vertical-align:middle" height="22" title="OUAPI" alt="" /></p>';
	
if (isset($_GET["etape"]) && basename($_SERVER["PHP_SELF"]) == 'install.php')
{
	$etape = array(1 => '','','','','','','');
	$etape[$_GET["etape"]] = 'font-weight:bold;color:black;background-color:#FF9911;';
	
	$affichage .= '
		<p class="button" style="width:22px;text-align:center;'.$etape[1].'">'.$lang["install_tab1"].'</p>
		<p class="button" style="width:22px;text-align:center;'.$etape[2].'">'.$lang["install_tab2"].'</p>
		<p class="button" style="width:22px;text-align:center;'.$etape[3].'">'.$lang["install_tab3"].'</p>
		<p class="button" style="width:22px;text-align:center;'.$etape[4].'">'.$lang["install_tab4"].'</p>
		<p class="button" style="width:22px;text-align:center;'.$etape[5].'">'.$lang["install_tab5"].'</p>
		<p class="button" style="width:22px;text-align:center;'.$etape[6].'">'.$lang["install_tab6"].'</p>
		<p class="button" style="width:22px;text-align:center;'.$etape[7].'">'.$lang["install_tabend"].'</p>
	';
}
elseif (isset($_GET["etape"]) && basename($_SERVER["PHP_SELF"]) == 'maj.php')
{
	$etape = array(1 => '','','','');
	$etape[$_GET["etape"]] = 'font-weight:bold;color:black;background-color:#FF9911;';

	$affichage .= '
		<p class="button" style="width:22px;text-align:center;'.$etape[1].'">'.$lang["install_tab1"].'</p>
		<p class="button" style="width:22px;text-align:center;'.$etape[2].'">'.$lang["install_tab2"].'</p>
		<p class="button" style="width:22px;text-align:center;'.$etape[3].'">'.$lang["install_tab3"].'</p>
		<p class="button" style="width:22px;text-align:center;'.$etape[4].'">'.$lang["install_tabend"].'</p>
	';
}
	
$affichage .= '</div>
<div style="clear:both"></div> 

<div class="body">';

?>