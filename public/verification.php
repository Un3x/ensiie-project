<?php
session_start();
if(isset($_POST['pseudo']) && isset($_POST['mdp']))
{
    // connexion à la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
    or die('could not connect to database');

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
   // $pseudo = mysql_real_escape_string($connection,htmlspecialchars($_POST['pseudo']));//$mdp = mysqli_real_escape_string($connection,htmlspecialchars($_POST['mdp']));
    $pseudo=$_POST['pseudo'];
    $mdp=$_POST['mdp'];
    if($pseudo !== "" && $mdp !== "")
    {
        $requete = $connection->prepare("SELECT * FROM Connexion where 
              pseudo = ? and mdp= ?");
        $requete->execute(array($pseudo,$mdp));
        $count=0;
        while($tuple_courant=$requete->fetch()) {
            $count=++$count;
        }
        if($count==1) // nom d'utilisateur et mot de passe correctes
        {

            if($pseudo=="Administrateur") { // si administrateur redirection vers compte administrateur
                $_SESSION['admin']="Administrateur";
                header('Location: compte_admin.php');
            }
            else { //si utilisateur redirection vers mode utilisateur
                $_SESSION['pseudo'] = $pseudo;
                header('Location: pre_profil.php');
            }

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
$connection=null; // fermer la connexion

?>
