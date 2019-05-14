<?php
include("Modele.php");
include("Vue.php");
include("../src/User/User.php");

if(!$_SESSION['connect']){
	header('Location: Connexion.php');
}
$psd = $_SESSION['nomuser'];
enTete2("Infomation of user id: $psd");
$users = search_info_perso($psd);

foreach ($users as $user){
	$messages = search_info_message($user->getId());
	foreach($messages as $message){
		vue_info_perso($user, $message);
	}
}

retour_menu();
pied();
?>