<?php
    session_start();
    //include('bd/connexionDB.php'); 
    if (isset($_SESSION['id'])){
        header('Location: ../index.php'); 
        exit;
    }
	
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
        $valid = true;
        if (isset($_POST['majUser'])){ 
			$mdp = trim($mdp);
			$newMdp = trim($newMdp);
            $pseudo = htmlentities(trim($pseudo)); 
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
            if($valid){
				/*$req = $bdd->prepare('UPDATE Utilisateur SET firstname = :prenom,lastname = :nom,promo = :promo,birthday =: dateAnniv,pseudo =: pseudo,mdp =: newMdp,id_admin = 0' WHERE pseudo = :pseudo);
				$req->execute(array(
				'prenom' => $prenom), 
				'nom' => $nom),
				'promo' => $promo), 
				'birthday' => $dateAnniv), 
				'pseudo' => $pseudo),
				'mdp' => $newMdp));*/
                header('Location: ../index.php');
                exit;
            }
        }
    }
header('location: ../index.php');
exit;
?>