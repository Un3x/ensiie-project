<?php
session_start();

require '../src/Utilisateur/UtilisateurRepository.php';
require '../src/Utilisateur/Utilisateur.php';

if(isset($_POST['email']) && isset($_POST['mdp']))
{
    // connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$userRepository = new \Utilisateur\UtilisateurRepository($connection);
$users = $userRepository->fetchAll();

   
    $user = $userRepository->userByMail($_POST['email']);
    $mdp = $user->getMdp();
    $email = $_POST['email'];
    
    
    if($email !== "" && $mdp !== "")
    {
        if ($_POST['mdp']==$mdp){
           $_SESSION['email']=$_POST['email'];
           header('Location: reussi1.php');
        }
        else
        {
           header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: connexion.php');
}

?>