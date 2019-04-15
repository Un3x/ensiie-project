<head>
	<link rel="stylesheet" href="../CSS/style.css">
	<link rel="stylesheet" href="../CSS/connexion.css">
</head>

<body>


<?php

include("../inc/session.php");

if(isset($_SESSION['pseudo'])){ //si connecté, redirection vers la page d'acceuil
	header("location: index.php");
}

if (!isset($_POST['pseudo'])) { //pour l'instant on affiche tout le temps
	?>
	<div class="login-page">
	  	<div class="form">
			<form class="login-form">
			  <input id="pseudo" type="text" placeholder="Pseudo"/>
			  <input id="mdp" type="password" placeholder="Mot de passe"/>
			  <input type="submit" value="Connexion" />
			</form>
	  	</div>
	</div>
	<?php
}else{ //connexion
	if(isset($_SESSION['pseudo'])){ //si connecté, redirection vers la page d'acceuil
		header("location: index.php");
	}else if(!$_GET['c']){ // si compte non reconnu
		?><p class="error">Pseudo ou Mot de passe incorrect</p><?php
	}else{
		$connecte = create_session($_POST['pseudo'], $_POST['mdp']);
		if($connecte){
			header("location: index.php");
		}else{
			header("location: connexion.php?c=false");
		}
	}
}
?>
<body>
