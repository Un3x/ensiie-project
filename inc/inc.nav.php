<?php
function navAccueil()
{
	echo "\t<nav>\n";
	$date = date( "d/m/Y" );
	
	if( isset( $_SESSION['pseudo'] ) )
	{
		echo "\t<p><a href=\"../public/deconnexion.php\"><img class=\"boutton_co\" src=\"../img/bouton_deco.png\"></button></a></p>\n";
		echo "\t<p> Bonjour ".$_SESSION['pseudo']."</p>\n";
		echo "<p>Date : $date</p>";
	}
	else
	{
		echo "\t<a href=\"../public/connexion.php\"><button type=\"button\" class=\"bDecoCo\">Connexion</button></a>\n";
		echo "<p>Date : $date</p>";
	}
	echo "\t</nav>\n";
	echo "<article>\n";
}
?>