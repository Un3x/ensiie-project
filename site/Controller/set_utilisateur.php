<?php
// on teste si nos variables sont définies
if (isset($_SESSION['Utilisateur']))
{
	$idUser = $_SESSION['Utilisateur']->getAriseID();
	$_SESSION['Utilisateur'] = db_getUser($idUser);
}
else
{
    $utilisateur = NULL;
}
