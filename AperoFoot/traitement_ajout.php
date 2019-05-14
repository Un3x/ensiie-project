<?php
include("mise_en_page.php");

entete();

menu_nav();




if(!isset($_POST['nom']) OR !isset($_POST['prenom']) OR !isset($_POST['password']) OR !isset($_POST['adresse_mail'])) {
	header('Location: connexion.php');
	exit();
}


$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$password=$_POST['password'];
$email=$_POST['adresse_mail'];

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=aperofoot;charset=utf8', 'root', '');
    
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


$requete = $bdd->exec('SELECT * FROM user');

print $requete;;

$req = $bdd->prepare('INSERT INTO user(password, nom, prenom, email) VALUES(:password, :nom, :prenom, :email');
$req->execute(array(
	'password' => $password,
	'nom' => $nom,
	'email' => $email,
	'prenom' => $prenom
	));

echo 'L utilisateur a bien été ajouté !';
$req->closeCursor();

pied();
?>