<?php
include("C:/Users/lucky/Desktop/projet web/views/connexion.php");

function right_corner_header(){
	if(isset($_SESSION['id']) AND isset($_SESSION['pseudo'])){
		connecter($_SESSION['pseudo']);
	}
	else {
		formulaire_connexion();
	}
}
?>