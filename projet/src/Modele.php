<?php
/* Connexion à la BDD en PDO
try { $bdd = new PDO('mysql:host=localhost;dbname=bdd','root',''); }
catch (Exeption $e) { die('Erreur : ' .$e->getMessage())  or die(print_r($bdd->errorInfo())); }

// Requête SQL sécurisée
$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE login= ? AND password= ?");
$req->execute(array($login, $password));*/

function create_thread($titre,$theme,$contenu) {
	
	// Connexion à la DB en PDO
	try { $bdd = new PDO('mysql:host=localhost;dbname=bdd','root',''); }
	catch (Exeption $e) { die('Erreur : ' .$e->getMessage())  or die(print_r($bdd->errorInfo())); }
	
	// Calcule des id et récupération de la date
	$id_thread = ;
	$id_premier_post = ;
	$date = ;
	
	// Requêtes SQL
	
	$req = "INSERT INTO thread(id_thread, titre, premier_post, theme) VALUES ('".$id_thread."','".$titre."','".$id_premier_post."','".$theme."')";
	pg_query($db,$req);
	
	$req = "INSERT INTO posts(id_post, contenu, id_thread, theme, date_send, id_post_avant) VALUES ('".$id_premier_post."','".$contenu."','".$id_thread."','".$theme."','".$date."','NULL')";
	pg_query($db,$req);
	
	pg_close( $db );
}

function create_post($id_thread,$id_post_avant,$contenu){
	
	// Connexion à la DB en PDO
	try { $bdd = new PDO('mysql:host=localhost;dbname=bdd','root',''); }
	catch (Exeption $e) { die('Erreur : ' .$e->getMessage())  or die(print_r($bdd->errorInfo())); }
	
	// Calcule de l'id et récupération de la date
	$id_post = ;
	$date = ;
	
	// Requêtes SQL
	$req = "INSERT INTO posts(id_post, contenu, id_thread, theme, date_send, id_post_avant) VALUES ('".$id_post."','".$contenu."','".$id_thread."','".$theme."','".$date."','".$id_post_avant."')";
	pg_query($db,$req);
	
	pg_close( $db );
}
?>