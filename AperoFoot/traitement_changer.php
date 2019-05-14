<?php


include("mise_en_page.php");

entete();


if(!isset($_POST['nom']) OR !isset($_POST['prenom']) OR !isset($_POST['password']) OR !isset($_POST['email']) OR !isset($_POST['nouvelle_ville']) OR !isset($_POST['nouvelle_adresse'])) {
	header('Location: connexion.php');
	exit();
}


$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$password=$_POST['passowrd'];
$email=$_POST['email'];
$nouvelle_adresse=$_POST['nouvelle_adresse'];
$nouvelle_ville=$_POST['nouvelle_ville'];

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=pdo;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


$req = $bdd->prepare('UPDATE user(n_user, nom, prenom, password, ville, adresse) SET (:n_user, :nom, :prenom, :password, :email, :ville, :adresse) WHERE n_user=$_SESSION['id']');
$req->execute(array(
	'password' => $password,
	'nom' => $nom,
	'email' => $email,
	'ville'=> $nouvelle_ville,
	'adresse'=> $nouvelle_adresse,
	'prenom' => $prenom
	));


$req->closeCursor();
header('Location:connexion.php');
exit();

pied();
?>