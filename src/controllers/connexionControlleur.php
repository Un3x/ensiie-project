<?php

/*//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $pseudo));
$resultat = $req->fetch();
*/
if(!empty($_POST)){
		print "ici\n";
        extract($_POST);
        $valid = true;
		if(isset($_POST['connexion'])){
// Comparaison du pass envoyé via le formulaire avec la base64_decode
$pseudo=$_POST['pseudo'];
$id="2";
$resultat['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
$isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);
/*
if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{*/
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $id;/*$resultat['id'];*/
        $_SESSION['pseudo'] = $pseudo;
        echo 'Vous êtes connecté !';
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
		}
}
header('Location: ../index.php'); 
exit;
?>