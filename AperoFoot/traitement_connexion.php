
<?php



include("mise_en_page.php");
entete();

if(!isset($_POST['adresse_mail']) OR !isset($_POST['password'])) {
	header('Location: connexion.php');
	exit();
}

$adresse_mail = $_POST['adresse_mail'];
$password= $_POST['password'];

session_start();
$ok=0;

$bdd = new PDO('mysql: host=localhost ; dbname=aperofoot; charset=utf8', 'root', '');




$requete =  $bdd->query('SELECT n_user FROM user WHERE email = "'.$adresse_mail.'" AND password = "'.$password.'"');
if ( $requete -> fetch()  == false){
echo 'Mauvais pseudo ou mot de passe';
header('Location: connexion.php');
exit();
}
else{
echo 'Vous voilà connecté';
$ok=1;
$_SESSION['id']=$adresse_mail;
$_SESSION['password']=$password;
}

header('Location: mon_compte.php');
exit();



pied();



?>