<?php


function changeMDP($mdp,$newmdp){


	if ($_POST['mdp'] == $_SESSION['currentMDP']){

		$connection = connectTOBD();
		$newmdp = $_POST['newmdp'];
		$id = $_SESSION['currentId'];
		$sql = "UPDATE \"user\" SET mdp=? WHERE id=$id";
		$connection->prepare($sql)->execute([$newmdp]);

		$_SESSION['currentMDP'] = $newmdp;
	} 

	else{

		echo "<p class=erreur> Votre Mot de passe est erronné </p>";
	}

}


function changePseudo($mdp,$newPseudo){

	if ($_POST['mdp'] == $_SESSION['currentMDP']){

		$connection = connectTOBD();
		$newpseudo = $_POST['newpseudo'];
		$id = $_SESSION['currentId'];
		$sql = "UPDATE \"user\" SET pseudo=? WHERE id = $id";
		$connection->prepare($sql)->execute([$newpseudo]);

		$_SESSION['currentPseudo'] = $newpseudo;
	} 

	else{

		echo "<p class=erreur> Votre Mot de passe est erronné </p>";
	}
}