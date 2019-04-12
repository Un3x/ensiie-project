<head>
	<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

<?php

if(isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    header("location: connexion.php");
}

?>

<h1>Page d'administration</h1>

<h2>Bienvenue sur la page d'administration du site de l'association de Realitiie</h2>
<h2>Choissiez quelle partie du site vous souhaitez éditer :</h2>

<form action="" class="admin"><input type="submit" value="Articles"/></form>
<form action="" class="admin"><input type="submit" value="Projets"/></form>
<form action="" class="admin"><input type="submit" value="Membres"/></form>

</body>