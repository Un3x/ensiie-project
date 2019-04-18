<?php
	require( "../inc/inc.default.php" );
	require( "../inc/inc.nav.php" );
	require( "../src/Membre/Membre.php");
	require("../src/Membre/MembreRepository.php");
	entete( "Accueil" );
	navAccueil();
	
	//Postgres
	$members = "fetchAll"; //Récupération des membres
?>

<h2> NOTRE EQUIPE </h2>
<div>
	Le président
</div>


<?php
	pied();
?>