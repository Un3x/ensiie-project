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

<br/><br/>

<h2>Bienvenue sur la page d'administration du site de l'association de Realitiie</h2>
<br/>
<h2>Choissiez quelle partie du site vous souhaitez éditer :</h2>
<br/><br/><br/>

<form action=""><input type="submit" class="admin" value="Articles"/></form>
<form action=""><input class="admin" type="submit" value="Projets"/></form>
<form action=""><input class="admin" type="submit" value="Membres"/></form>

</body>