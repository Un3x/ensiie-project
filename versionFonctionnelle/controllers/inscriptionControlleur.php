<?php
    session_start();
    //include('bd/connexionDB.php'); 
    if (isset($_SESSION['id'])){
        header('Location: ../index.php'); 
        exit;
    }
    if(!empty($_POST)){
        extract($_POST);
        $valid = true;
        if (isset($_POST['inscription'])){
            $nom  = htmlentities(trim($nom)); // On récupère le nom
            $prenom = htmlentities(trim($prenom)); // on récupère le prénom
            $pseudo = htmlentities(trim($pseudo)); // On récupère le mail
            $mdp = trim($mdp); // On récupère le mot de passe 
            $confirmationMdp = trim($confirmationMdp);//  On récupère la confirmation du mot de passe
            $dateAnniv = trim($dateAnniv);//  On récupère la confirmation du mot de passe
            $promo = trim($promo);//  On récupère la confirmation du mot de passe

            //  Vérification du nom
            if(empty($nom)){
                $valid = false;
                $er_nom = ("Le nom d' utilisateur ne peut pas être vide");
            }       

            //  Vérification du prénom
            if(empty($prenom)){
                $valid = false;
                $er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");
            }     
            // Vérification du mot de passe
            if(empty($mdp)) {
                $valid = false;
                $er_mdp = "Le mot de passe ne peut pas être vide";

            }elseif($mdp != $confirmationMdp){
                $valid = false;
                $er_mdp = "La confirmation du mot de passe ne correspond pas";
            }

            if($valid){

				/*$mdp=password_hash($mdp, PASSWORD_DEFAULT);
                /*$req = $bdd->prepare('INSERT INTO Utilisateur (firstname,lastname,promo,birthday,pseudo,mdp,id_admin) VALUES array(prenom,nom,promo,dateAnniv,pseudo, mdp, 0));
				$req->execute(array(prenom,nom,promo,dateAnniv,pseudo, mdp, 0);*/
                //header('Location: index.php');
				print "test\n";
                //exit;
            }
        }
    }
header('location: ../index.php');
exit;
?>