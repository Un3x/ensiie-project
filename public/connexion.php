<head>
	<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

<?php
require '../src/Membre/Membre.php';
require '../src/Membre/MembreRepository.php';
require( "../inc/inc.default.php" );
require( "../inc/inc.nav.php" );
entete( "Connexion" );
navAccueil();

if(isset($_SESSION['pseudo'])){ //si connecté, redirection vers la page d'acceuil
	header("location: index.php");
}

require( "../inc/connexionForm.php" );

?>
<body>
