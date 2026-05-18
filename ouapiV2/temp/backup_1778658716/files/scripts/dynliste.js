/**
 * Lister les départements d'une région avec un objet
 * XMLHTTPRequest.
 */
/* Création de la variable globale qui contiendra l'objet XHR */
var requete = null;
/**
 * Fonction privée qui va créer un objet XHR.
 * Cette fonction initialisera la valeur dans la variable globale définie
 * ci-dessus.
 */
function creerRequete()
{
    try
    {
        /* On tente de créer un objet XmlHTTPRequest */
        requete = new XMLHttpRequest();
    }
    catch (microsoft)
    {
        /* Microsoft utilisant une autre technique, on essays de créer un objet ActiveX */
        try
        {
            requete = new ActiveXObject('Msxml2.XMLHTTP');
        }
        catch(autremicrosoft)
        {
            /* La première méthode a échoué, on en teste une seconde */
            try
            {
                requete = new ActiveXObject('Microsoft.XMLHTTP');
            }
            catch(echec)
            {
                /* À ce stade, aucune méthode ne fonctionne... mettez donc votre navigateur à jour ;) */
                requete = null;
            }
        }
    }
    if(requete == null)
    {		/* text should be replaced by $lang["main"][1] in OUAPI. Will be done later*/
        alert('Impossible de créer l\'objet requête,\nVotre navigateur ne semble pas supporter les object XMLHttpRequest.');
    }
}
/**
 * Fonction privée qui va mettre à jour l'affichage de la page.
 */
function actualiserDynliste(idbloc)
{
    var listeDept = requete.responseText;
    var blocListe = document.getElementById(idbloc);
    blocListe.innerHTML = listeDept;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getDynliste(idelmt,type)
{
	var bloctype = 'bloc_' + type
	var linktype = 'link_' + type
	
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idelmt == 'vide')
    {
        document.getElementById(bloctype).innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
		var blocListe = document.getElementById(bloctype);
        blocListe.innerHTML = "<span style=\"margin-left:180px;\">Loading...</span>";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = 'ajax.php?type='+ type +'&idelmt='+ idelmt;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                    actualiserDynliste(bloctype);
					
					/* Test si l'image d'ajout existe */
					if (document.getElementById(linktype))
					{
						var lien = document.getElementById(linktype).href 
						
						if (lien.indexOf("&parent=",0) == -1)
						{
							document.getElementById(linktype).href = lien + "&parent=" + idelmt
						}
						else
						{
							document.getElementById(linktype).href = lien.substring(0,lien.indexOf("&parent=",0)) + "&parent=" + idelmt
						}
					}
                }
				
            }
        };
        requete.send(null);
    }	
}