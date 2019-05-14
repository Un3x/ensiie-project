<?php
require '../src/User/projetControl.php';
$pseudo = $_POST['pseudoS'];
$status = $_SESSION['status'];

supprimerUtilisateur($pseudo, $status);
?>