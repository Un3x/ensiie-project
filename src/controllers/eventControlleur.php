<?php
    session_start();
    //include('bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
    // S'il y a une session alors on ne retourne plus sur cette page
    if (isset($_SESSION['id'])){
        header('Location: ../index.php'); 
        exit;
    }
    if(!empty($_POST)){
		print "ici\n";
        extract($_POST);
        $valid = true;
        if (isset($_POST['creatEvent'])){
            $nom  = htmlentities(trim($nom)); 
            $lieu = htmlentities(trim($lieu)); 
            $dateEvent = htmlentities(trim($dateEvent)); 
            $prix = htmlentities(trim($mdp)); 
            if(empty($nom) or empty($lieu) or empty($dateEvent) or empty($prix)){
                $valid = false;
                $er_vide = ("Tout les champs doivent etre remplis");
            }       
			//verifier que $lieu n'est pas pris pour la date en question

            // Si toutes les conditions sont remplies alors on fait le traitement
            if($valid){
				//inséré dans la bd l'evenement
                //$DB->insert("INSERT INTO Utilisateur (nom, prenom, mail, mdp, date_creation_compte) VALUES 
                    //(?, ?, ?, ?, ?)", 
                    //array($nom, $prenom, $mail, $mdp, $date_creation_compte));
				//dire que l'event s'est bien creer
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