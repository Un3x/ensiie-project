<?php

/*
// Recuperation du mot de passe hashé correspondant au pseudo
$req = $bdd->prepare('SELECT id_Utilisateur, mdp FROM Utilisateur WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $pseudo));
$resultat = $req->fetch();
*/

if(!empty($_POST)){
    extract($_POST);
    $valid = true;
	if(isset($_POST['connexion'])){
		// Comparaison du pass envoyé via le formulaire avec la base64_decode
		$pseudo=$_POST['pseudo'];
		//$id=$resultat['id_Utilisateur']; 
		//ligne en dessous a supprimer lorsque la liaison a la bd sera opérationnelle
		$id="2";
		//lorsque bd connectée supprimer la ligne en dessous car $resultat['mdp'] renvera le mot de passe hashé contenu dans la bd
		$resultat['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
		$isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);
/*
		if (!$resultat){
			echo 'Mauvais identifiant ou mot de passe !';
		}
		else{*/
			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['id'] = $id;
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