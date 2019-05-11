<?php
require '../vendor/autoload.php';

include ("utils.php");

session_start();


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$user_connected=isset($_SESSION["id_user"]);
if ($user_connected) {//on récupère les info sur l'utilisateur courant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}



//rediriger si l'utilisateur n'est pas connecté
if (!isset($_SESSION["id_user"])) {
    header("Location: connexion.php");
}


$curr_user=$userRepository->fetchId($_SESSION["id_user"]);

$ok_pseudo=true;
$ok_nom=true;



if (isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['pseudo'])) {
    
    if (!verifPseudo($_POST['pseudo']) && !($_POST['pseudo']==$curr_user->getPseudo())) {
        $ok_pseudo=false;
    }
    if (!verifNomPrenom($_POST['nom'], $_POST['prenom']) && !($_POST['nom']==$curr_user->getNom() && $_POST['prenom']==$curr_user->getPrenom())) {
        $ok_nom=false;
    }
    if ($ok_pseudo && $ok_nom) {
        $tmp = $userRepository->creeUser_editer_information($_SESSION["id_user"], $_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['ddn'], $_POST['email'], $curr_user->getAdmin());
        $userRepository->updateUser_editer_information($tmp);

        header("Location: index.php");
    }
}

if (isset($_POST['mdp']) && isset($_POST['cmdp']) && ($_POST['mdp'] == isset($_POST['cmdp'])) ) {
    $userRepository->updateUser_editer_password($_SESSION["id_user"], $_POST['mdp']);
    header("Location: index.php");
}
    
?>


