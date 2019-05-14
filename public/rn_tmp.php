<?php 
session_start();
if ($_SESSION['authent']==0) {
    $_SESSION['try_rn']=1;
    if ($_SESSION['adresse']=="accueil.php") header("Location: accueil.php");
    if ($_SESSION['adresse']=="pageMembre.php") header("Location: pageMembre.php");
}
else header("Location: rejoins_nous.php");
?>