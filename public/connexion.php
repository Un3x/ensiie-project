<?php
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");  

function connexion($connexion) {
    $psw = $_POST['psw'];
    $pseudo = $_POST['Pseudo'];
    $result = $connexion->query("SELECT * FROM utilisateur where id_pseudo = '$pseudo' AND pswd = '$psw'")->fetchAll();
    if(!empty($result)) { 
        session_start();
        $_SESSION['Pseudo'] = $pseudo;
        echo 1;
    }   
    else {
        echo 0;
    }
}

if (isset($_POST['fun'])) {
	if($_POST['fun'] == 'connexion') {
		connexion($connexion);
	}
}


?>

