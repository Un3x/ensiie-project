<?php



function getForm($connexion) {
	$pseudo = $_SESSION['Pseudo'];
	$result=$connexion->query("SELECT * FROM utilisateur JOIN compte ON id_pseudo = id_pseudo_compte WHERE id_pseudo = '$pseudo';")->fetchAll();
	echo '<br><label for=prenom style ="width : 20%">Prénom : </label>                       
                        <input id = "FName" type="text" size="25" maxlength="30" value="'.$result[0]['prenom'].'"name="Prenom" style ="width : 50%"/> <span style="margin-left: 10px"><br><br>    
          <label for=nom style ="width : 20%">Nom : </label>      
                        <input id = "LName" type="text" size="25" maxlength="30" value="'.$result[0]['nom'].'"name="nom" style ="width : 50%"/> <span style="margin-left: 10px"><br><br>     
          <label for=mail style ="width : 20%">Mail : </label>                       
                        <input id = "Mail" type="email" size="25" maxlength="30" value="'.$result[0]['mail'].'"name="mail" pattern ="[^@]+@[^@]+\.[a-zA-Z]{2,}" style ="width : 50%"/> <span style="margin-left: 10px"><br><br>
          <label for=password style ="width : 20%">Mot de passe : </label>                       
                        <input id = "psw" type="password" size="25" maxlength="30" value="'.$result[0]['pswd'].'"name="psw" style ="width : 50%"/> <span style="margin-left: 10px"><br><br>
          <label for=forces style ="width : 20%">Forces : </label>                       
                        <input id = "Forces" type="text" size="25" maxlength="40" name="Forces" value="'.$result[0]['point_fort'].'" style ="width : 50%"/> <span style="margin-left: 10px"><br><br>
          <input class="bouton8" type="submit" value="Modifier" style ="width : 10%" name="modif"/></br></br>';
                     
}

function updateUser($connexion) {
	$pseudo = $_SESSION['Pseudo'];
	$connexion->query("UPDATE utilisateur SET prenom = '".$_POST['fname']."',nom = '".$_POST['lname']."', mail = '".$_POST['mail']."', pswd = '".$_POST['psw']."' WHERE id_pseudo = '$pseudo';");
	$connexion->query("UPDATE compte SET point_fort = '".$_POST['forces']."' WHERE id_pseudo_compte = '$pseudo';");

}




$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
session_start();

if (isset($_POST['fun'])) {
	if($_POST['fun'] == 'getForm') {
		getForm($connexion);
	}
	if($_POST['fun'] == 'updateUser') {
		updateUser($connexion);
	}
}


?>