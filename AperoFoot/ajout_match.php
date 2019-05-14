<?php
include("mise_en_page.php");
include("partial/annonce_match.php");

entete();

menu_nav();


if(!isset($_POST['match'])) {
	header('Location: accueil_recherche.php');
	exit();
}
?>

<?php

$nom_match = $_POST['match'];
$bdd = new PDO('mysql: host=localhost;dbname=aperofoot;charset=utf8','root','');

$rows = $bdd->query('SELECT n_user, nommatch, commentaires, ville from proposition where nommatch="'.$nom_match.'"');
if ($rows==false){
	header('Location: accueil_recherche.php');
exit();}
else{
	$resultat=$rows->fetchAll();
foreach($resultat as $row){
$nom_hote = $bdd->query('SELECT prenom from user join proposition on user.n_user = "'.$row['n_user'].'" ');
$nom = $nom_hote->fetch();
annonce_match($row['nommatch'], $nom['prenom'], $row['ville'], $row['commentaires']);
}}
pied();

?>