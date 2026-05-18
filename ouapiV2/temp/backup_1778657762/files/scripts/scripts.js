	function verifErrors()
	{
		var errmsg = '';
		var input_tag = document.getElementsByTagName("input");
		
		for (var i = 0; i < input_tag.length;i++)
		{
			var verif_attrib = '';
			verif_attrib = input_tag[i].getAttribute("id");
				
			if (verif_attrib == 'required')
				{ errmsg += $lang["Incomplete"]; }
		}
		
		var input_tag = document.getElementsByTagName("select");
		
		for (var i = 0; i < input_tag.length;i++)
		{
			var verif_attrib = '';
			verif_attrib = input_tag[i].getAttribute("id");
				
			if (verif_attrib == 'required')
				{ errmsg += 'Veuillez remplir correctement le(s) champ(s) en rouge !'; }
		}
		
		if (errmsg != '')
		{
			alert(errmsg);
			return false;
		}
		return true;
	}
	
	function verifLong(champ) 
	{
		if (champ.value.length > 0)
			{ champ.id='ok'; }
		else
			{ champ.id='required'; }
	}	
	
	function verifValPos(champ) 
	{
		if (champ.options[champ.selectedIndex].value >= 0)
			{ champ.id='ok'; }
		else
			{ champ.id='required'; }
	}	



	// Fonction fermeture+rafraichissement by Marc 
	// Compatible IE/Firefox 
	function RefreshAndClose() {
	if (!window.opener.closed) {
	   window.opener.location = window.opener.location;
	   var obj_window = window.open('', '_self');
	   obj_window.open = window;
	   obj_window.focus();
	   opener=self;
	   self.close();
	}
	}
	// -->
	
	// <!-- Changer element selectionné d'une liste déroulante -->
	function ChangeListe(champ,valeur)
	{
		var idok=0; 
		for (var i = 0; i < champ.length;i++) 
		{
			var listed = champ.options[i].text.toUpperCase();
			var chaine = valeur.toUpperCase();
			if (listed.lastIndexOf(chaine) != -1)
			{ 
				idok = i;
			} 
		} 
		champ.options[idok].selected = true;
	}

  
function modifInnerText(elmt_id,toThis)
{
  if (document.getElementById)
  {
    document.getElementById(elmt_id).innerHTML = toThis;
  }
  else if (document.all)
  {
    document.all[elmt_id].innerHTML = toThis;
  }
}