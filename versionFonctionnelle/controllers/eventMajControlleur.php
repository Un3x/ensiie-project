=<?php
    session_start();
    //include('bd/connexionDB.php'); 
    if (isset($_SESSION['id'])){
        header('Location: ../index.php'); 
        exit;
    }
	$valid=true;
	//verifier dans la bd que l'utilisateur a les droits
	/*$req = $bdd->prepare('SELECT id_admin FROM Utilisateur WHERE id_Utilisateur = :id');
	$req->execute(array(
		'id' => $_SESSION['id']));
	$resultat = $req->fetch();
	if(!($resultat['id_admin']))
		$valid=false;
	*/
	
    if(!empty($_POST)){
        extract($_POST);
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
				/*$req = $bdd->prepare('UPDATE Event SET name = :newNom, id_Place = :lieu, datee = :dateEvent, price= :prix WHERE nom = :nom');
				$req->execute(array(
				'newNom' => $newNom), 
				'lieu' => $lieu),
				'dateEvent' => $dateEvent), 
				'prix' => $prix), 
				'nom' => $nom));*/
                header('Location: ../index.php');
                exit;
            }
        }
    }
	header('location: ../index.php');
	exit;
?>