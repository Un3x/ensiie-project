<?php
include("mise_en_page.php");

entete();

menu_nav();




if(!isset($_POST['nommatch']) OR !isset($_POST['place']) OR !isset($_POST['rue']) OR !isset($_POST['ville']) OR !isset($_POST['commentaires'])) {
	header('Location: connexion.php');
	exit();
}


$nommatch=$_POST['nommatch'];
$place=$_POST['place'];
$rue=$_POST['rue'];
$ville=$_POST['ville'];
$commentaires=$_POST['commentaires'];

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=aperofoot;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


$req = $bdd->prepare('INSERT INTO proposition(n_user, nommatch, place, rue, ville, commentaires) VALUES(:n_user, :nommatch, :place, :rue, :ville, :commentaires)');
$req->execute(array(
	'nommatch' => $nommatch,
	'place' => $place,
	'rue' => $rue,
	'ville' => $ville,
	'commentaires' => $commentaires,
	'n_user' =>$_SESSION['id']
	));

echo 'Le match a bien été ajouté!';
$req->closeCursor();

pied();
?>