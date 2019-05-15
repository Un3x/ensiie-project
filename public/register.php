<?php

require '../src/Utilisateur/UtilisateurRepository.php';
require '../src/Utilisateur/Utilisateur.php';

session_start();
    // connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$userRepository = new \Utilisateur\UtilisateurRepository($connection);
$users = $userRepository->fetchAll();

    
    // on teste si le visiteur a soumis le formulaire
    	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
    	if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['mdp']) && !empty($_POST['mdp'])) && (isset($_POST['mdp_confirm']) && !empty($_POST['mdp_confirm']))) {
		// on teste les deux mots de passe
    	if ($_POST['mdp'] != $_POST['mdp_confirm']) {
    		$erreur = 'Les 2 mots de passe sont différents.';
    	}
    	else {
			$n=$userRepository->registered($_POST['email']);
			// on recherche si cet email est déjà utilisé par un autre utilisateur
       		if ($n==0) {
				$request = $userRepository->registerUser('1','1',$_POST['email'],$_POST['mdp']);
				if($request == false)
				{
					header('Location: inscription.php?erreur=42');
					exit();
				}
    		
    			$_SESSION['email'] = $_POST['email'];
    			header('Location: reussi2.php');
    			exit();
    		}
    		else {
			header('Location: inscription.php?erreur=1'); // Le mail est déjà utilisé
			}
    	}
    	}
    	else {
			header('Location: inscription.php?erreur=2'); // Un des champs est vide	 
    	}
?>