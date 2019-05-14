<?php
require '../src/User/projetControl.php';
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$genre = $_POST['genre'];
$mdp = $_POST['mdp'];
$mdp2 = $_POST['mdp2'];
$mail = $_POST['mail'];
$addresse = $_POST['addresse'];
$dateDeNaissance = $_POST['dateDeNaissance'];
$pseudo = $_POST['pseudo'];
$numEtudiant = $_POST['numEtudiant'];


inscription( $pseudo, $nom, $prenom, $mdp, $mdp2,
            $genre, $mail, $addresse, $numEtudiant, $dateDeNaissance);
?>