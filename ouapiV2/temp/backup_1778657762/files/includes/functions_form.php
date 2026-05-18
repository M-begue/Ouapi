<?php

// Génération de listes déroulantes
function form_genselect($name,$style,$values = array(), $labels = array(),$selected = 0)
{
	$retour = '<select name="'.$name.'" '.$style.'>';
	$i = 0;
	while ($i < count($labels))
	{
		if ($i == $selected)
			$retour .= '<option value="'.$values[$i].'" selected>'.$labels[$i].'</option>';
		else
			$retour .= '<option value="'.$values[$i].'">'.$labels[$i].'</option>';
		$i++;
	}
	$retour .= '</select>';
	return $retour;
}

// Convertion d'un binaire en checked
function form_bintochecked($bin)
{
	if ($bin == 1)
		$retour = 'checked="checked"';
	else
		$retour = '';
	
	return $retour;
}

// Convertion d'un binaire en selected
function form_bintoselected($bin)
{
	if ($bin == 1)
		$retour = 'selected="selected"';
	else
		$retour = '';
	
	return $retour;
}
