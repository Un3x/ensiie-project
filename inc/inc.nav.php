<?php
function navAccueil()
{
	echo "\t<nav>\n";
	$date = date( "d/m/Y" );
	echo "<p>Date : $date</p>";
	if( isset( $_SESSION['pseudo'] ) )
	{
		echo "\t<p> Bonjour ".$_SESSION['pseudo']."</p>\n";
		echo "\t<a href=\"deconnexion.php\"><button type=\"button\" class=\"bDecoCo\">Déconnexion</button></a>\n";
	}
	else
	{
		echo "\t<a href=\"connexion.php\"><button type=\"button\" class=\"bDecoCo\">Connexion</button></a>\n";
	}
	echo "\t</nav>\n";
	echo "<article>\n";
}
?>