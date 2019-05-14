<?php
session_start();
$_SESSION = array();//On écrase tableau de session
session_unset(); //Destruction de toutes les variabls de la session en cours
session_destroy();//Destruction de la session elle-même
header("location:index.php"); // redirection de l'utilisateur?>