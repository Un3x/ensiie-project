<?php
    session_start();
    //include('bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
    // S'il y a une session alors on ne retourne plus sur cette page
    if (isset($_SESSION['id'])){
        header('Location: ../index.php'); 
        exit;
    }
	//verifier dans la bd que l'utilisateur a les droits
    if(!empty($_POST)){
		print "ici\n";
        extract($_POST);
        $valid = true;
        if (isset($_POST['majUser'])){ 
			$mdp = trim($mdp);
			$newMdp = trim($newMdp);
            $pseudo = htmlentities(trim($pseudo)); // On récupère le mail
			$prenom = htmlentities(trim($prenom)); 
            $nom = htmlentities(trim($nom)); 
            $dateAnniv = htmlentities(trim($dateAnniv)); 
            $promo = htmlentities(trim($promo)); 
            if(empty($mdp)){
                $valid = false;
                $er_mdp = ("Le mot de passe doit être rentré");
            }    
			$mdp = password_hash($mdp, PASSWORD_DEFAULT);
			if(!($isPasswordCorrect = password_verify($mdp, $resultat['mdp'])) or $valid=true){
				$valid = false;
				$er_mdpV = ("Le mot de passe rentré ne coïncide pas");
			}
			//verifier que $lieu n'est pas pris pour la date en question

            // Si toutes les conditions sont remplies alors on fait le traitement
            if($valid){
				//inséré dans la bd les nouvelles donnees du user
				//avec update
                //$DB->insert("INSERT INTO Utilisateur (nom, prenom, mail, mdp, date_creation_compte) VALUES 
                    //(?, ?, ?, ?, ?)", 
                    //array($nom, $prenom, $mail, $mdp, $date_creation_compte));
				//dire que l'event s'est bien mis a jour
                header('Location: ../index.php');
                exit;
            }
			//else
				//dire que l'event s'est mal creer
        }
    }
header('location: ../index.php');
exit;
?>