<?php
require '../src/User/projetControl.php';
$status = $_POST['status'];
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];
connexion($pseudo, $mdp, $status);
?>