<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

$connect = new db_connect();
$connect->connection();
$req1 = new db_use;

//Globales
$tab = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE ".CO_GLOBAL."='1'");
$i = 0;
while ($i < count($tab))
{
	define(strtoupper($tab[$i][CO_NAME]),$tab[$i][CO_VALUE]);
	$i++;
}

// Champs personnels
$lang = array();

$tab = $req1->db_use_query("SELECT * FROM ".TAB_CONFIG." WHERE ".CO_NAME." LIKE 'pfparam_%'");
$i = 0;

while ($i < count($tab))
{
	$lang["s_".$tab[$i][CO_LIBELLE]] = $tab[$i][CO_VALUE];
	$i++;
}

?>