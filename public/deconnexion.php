<?php 
session_start();
$_SESSION['authent'] = 0;
$_SESSION['statut'] = NULL;
$_SESSION['pseudo'] = NULL;
if ($_SESSION['adresse']=="accueil.php") header("Location: accueil.php");
else if ($_SESSION['adresse']=="pageMembre.php") header("Location: pageMembre.php");
else header("Location: accueil.php");
?>
