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
        if (isset($_POST['majEvent'])){
            $nom  = htmlentities(trim($nom)); 
			$newNom = htmlentities(trim($newNom)); 
            $lieu = htmlentities(trim($lieu)); 
            $dateEvent = htmlentities(trim($dateEvent)); 
            $prix = htmlentities(trim($mdp)); 
            if(empty($nom)){
                $valid = false;
                $er_nom = ("Le nom de l'event dont les infos vont être changées doit être rentré");
            }       
			//verifier que $lieu n'est pas pris pour la date en question

            // Si toutes les conditions sont remplies alors on fait le traitement
            if($valid){
				//inséré dans la bd l'evenement
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