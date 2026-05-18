<?php

/****************************************************************************
*                                                                           *
*                  Copyright (c) 2008-2013 Nicolas BIDET                    *
*                               OUAPI pack                                  *
*        License http://www.gnu.org/licenses/ GNU/GPL Public License        *
*                                                                           *
****************************************************************************/

function exp_csv($nom,$donnees)
{
	$fname = $nom.".csv";
	header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment;filename='.$fname);
	$fp = fopen('php://output', 'w');

	if (!is_array($donnees)) {
		return;
	}

	$i = 0;
	while ($i < count($donnees))
	{
		fputcsv($fp,$donnees[$i],',');
		$i++;
	}
	fclose($fp);

}

?>