function ajoutMembre()
{
	getMembres();
}
function ajouterSelectMembres( membres )
{
	var nbMembres = document.getElementsByClassName( "selectName" ).length;
	if( nbMembres < membres.length )
	{
		var id = "formAjoutProjet"
		var champ      = document.getElementById( id );
		var ajout      = document.createElement( "select" );
		ajout.name     = "membre" + (nbMembres+1);
		ajout.required = "required";
		ajout.className = "selectName";

		for( var i = 0; i < membres.length; i++ )
		{
			var option = document.createElement( "option" );
			option.value = membres[i].id_membre;
			option.innerHTML = membres[i].surnom;
			ajout.appendChild( option );
		}
		//champ.appendChild( ajout );
		var bouton = document.getElementById( "bEnvoyer");
		champ.insertBefore( ajout, bouton );
	}
}
function getMembres()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var resultat = JSON.parse(this.responseText);
			ajouterSelectMembres( resultat );
		}
	};
	xhttp.open("GET", "../private/getMembres.php", true);
	xhttp.send();
}

function verficationEnvoie()
{
	var nbMembres = document.getElementsByClassName( "selectName" ).length;
	if( nbMembres == 0 )
	{
		alert( "Il faut au minimum un membre pour le projet." );
		return false;
	}
	else
	{
		var membres = [];
		for( var i = 0; i < nbMembres; i++ )
		{
			membres[i] = document.getElementsByName( "membre"+(i+1) )[0];
		}
		var cpt = [];
		for( var i = 0; i < membres[0].options.length; i++ )
		{
			cpt[i] = 0;
		}
		for( var i = 0; i < membres.length; i++ )
		{
			for(var j = 0; j < membres[i].options.length; j++ )
			{
				if( membres[i].options[ j ].selected )
				{
					cpt[j] += 1;
					if( cpt[j] > 1 )
					{
						alert( "Il ne peut y avoir qu'une fois un membre par projet." );
						return false;
					}
				}
			}
		}
		return true;
	}
}