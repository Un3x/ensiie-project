<?php
include("Vue.php");
session_start();
include("config.php");

$_SESSION['connect'] = 0;
//session_destroy();
affiche_info("Et maintenant <br/>Au revoir");
retour_menu();

?>