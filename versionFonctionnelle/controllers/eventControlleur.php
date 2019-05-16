<?php
	//include('bd/connexionDB.php');
    session_start();
    if (isset($_SESSION['id'])){
        header('Location: ../index.php'); 
        exit;
    }
    if(!empty($_POST)){
        extract($_POST);
        $valid = true;
        if (isset($_POST['creatEvent'])){
			id_Event SERIAL PRIMARY KEY,
       name VARCHAR,
       id_Place INTEGER REFERENCES Place(id_Place),
       datee DATE,
       price FLOAT,
            $nom  = htmlentities(trim($nom)); 
            $lieu = htmlentities(trim($lieu)); 
            $dateEvent = htmlentities(trim($dateEvent)); 
            $prix = htmlentities(trim($mdp)); 
            if(empty($nom) or empty($lieu) or empty($dateEvent) or empty($prix)){
                $valid = false;
                $er_vide = ("Tout les champs doivent etre remplis");
            }   
			/*$req = $bdd->prepare('SELECT id_Event FROM Event WHERE lieu = :lieu AND dateEvent = :dateEvent');
			$req->execute(array(
				'lieu' => $lieu), 
				'dateEvent' => $dateEvent);
			$resultat = $req->fetch();
			//verifier que $lieu n'est pas pris pour la date en question
			if($resultat){
				$valid = false;
                $er_taken = ("Le lieu est déjà pris pour cette date");
			}*/
            if($valid){
				//Inserer dans la BD l'event
				/*$req = $bdd->prepare('INSERT INTO Event (id_Event,name,id_Place,datee,price) VALUES array(0, $nom, $lieu, $dateEvent, $prix));
				$req->execute(array(0, $nom, $lieu, $dateEvent, $prix));*/
                header('Location: ../index.php');
                exit;
            }
        }
    }
header('location: ../index.php');
exit;
?>