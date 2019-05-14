<?php

function connectToBD()
{
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

	return $connection;
}
function connexionForm(){

       echo "
       <div class=\"co\">
	       <form action=index.php method=post>
	       		Pseudo: <input type='text' size='20' maxlength='28' name='pseudo'/>
				Mot de Passe: <input type='password' size='20' maxlength='28' name='mdp'/>
				<input type='submit' value='Se connecter'/>
	       </form>
       </div>
       ";

}


function testUser($pseudo,$mdp,$users){

	$u = new \User\User();
	$bool = false;

	foreach ($users as $user){
		if ($user->getPseudo() == $pseudo && $user->getMDP() == $mdp){
			$u->setLastname($user->getLastname());
			$u->setFirstname($user->getFirstname());
			$u->setMDP($user->getMDP());
			$u->setId($user->getId());
			$u->setPseudo($user->getPseudo());
			$u->setAdmin($user->getAdmin());
			$bool = true;
		}
	}

	if ($bool){
		return $u;
	}
	else{
		return NULL;
	}
}

function connect($userRepository,$users,$tab){


	if (!isset($_SESSION['connected'])){
		connexionForm();
		$_SESSION['connected'] = false ;
	}

	else{

		if (!$_SESSION['connected'] && $tab != NULL){

			$cu = new \User\User();

			$pseudo = $tab['pseudo'];
			$mdp = $tab['mdp'];

			$cu = testUser($pseudo,$mdp,$users);
			if ($cu != NULL){

				$_SESSION['currentPseudo'] = $cu->getPseudo();
				$_SESSION['currentFirstname'] = $cu->getFirstname();
				$_SESSION['currentLastname'] = $cu->getLastname();
				$_SESSION['currentMDP'] = $cu->getMDP();
				$_SESSION['currentId'] = $cu->getId();
				$_SESSION['currentAdmin'] = $cu->getAdmin();
				$_SESSION['connected'] = true;
				printUser($cu);
			}

			else{

				echo "<p style=\"color: red\"> Pseudo ou Mot de passe erroné</p>"; 
				/* PENSEZ A MODIFIER SUR LE CSS QUAND IL Y EN AURA */
				connexionForm();
			}
		}

		else {

			if (isset($_SESSION['currentId'])){

				$cu = new \User\User();
				$cu->setLastname($_SESSION['currentLastname']);
				$cu->setFirstname($_SESSION['currentPseudo']);
				$cu->setMDP($_SESSION['currentMDP']);
				$cu->setId($_SESSION['currentId']);
				$cu->setPseudo($_SESSION['currentPseudo']);
				$cu->setAdmin($_SESSION['currentAdmin']);
				printUser($cu);
			}
			else{
				connexionForm();
			}
		}
	}
}



function printUser($user){

	$pseudo = $user->getPseudo();
	echo "<p class=\"user\">Vous êtes connecté en tant que $pseudo</p>";

}

?>	