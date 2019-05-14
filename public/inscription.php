<?php

function inscription($connexion) {
    $psw = $_POST['psw'];
    $prenom = $_POST['FName'];
    $nom = $_POST['LName'];
    $genre = $_POST['genre'];
    $mail = $_POST['Mail'];
    $bday = $_POST['BDay'];
    $pseudo = $_POST['Pseudo'];
    if(checkUser($connexion,$pseudo)) {
       $connexion->query("INSERT INTO utilisateur VALUES('$pseudo', '$prenom', '$nom', '$mail', '$psw', '$genre', '$bday')");
       $connexion->query("INSERT INTO compte VALUES('$pseudo', '')");
       session_start();
       $_SESSION['Pseudo'] = $pseudo;
       echo 1;
    }
    else {
        echo 0;
    }
}

function checkUser($connexion,$pseudo) {
    $result = $connexion->query("SELECT * FROM utilisateur WHERE id_pseudo = '$pseudo'")->fetchAll();
    if(!empty($result)) { 
        return 0;
    }
    else {
        return 1;
    }
}

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

if (isset($_POST['fun'])) {
	if($_POST['fun'] == 'inscription') {
		inscription($connexion);
	}
}


?>