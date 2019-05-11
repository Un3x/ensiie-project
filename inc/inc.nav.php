<?php

function navAccueil()
{
	echo "\t<nav>\n";
	$date = date( "d/m/Y" );
	echo "<p>Date : $date</p>";
	if( isset( $_SESSION['pseudo'] ) )
	{
		echo "\t<p> Bonjour ".$_SESSION['pseudo']."</p>\n";
	}
	else
	{
		echo "\t<a href=\"connexion.php\"><button type=\"button\">Connexion</button></a>\n";
	}
	echo "\t</nav>\n";
	echo "<article>\n";
}
?>