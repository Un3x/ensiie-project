<?php
session_start();
if(isset($_POST['pseudo']))
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
    $ps=$_POST['pseudo'];
    if($ps !== "" )
    {
        $requete = $connection->prepare("SELECT * FROM Identite where 
              pseudo = ?");
        $requete->execute(array($ps));
        $count=0;
        while($tuple_courant=$requete->fetch()) {
            $count=++$count;
        }
        if($count==0) // pseudo non existant! il peut donc être attribué au nouvel utilisateur!
        {
            $_SESSION['pseudo'] = $ps;
            $_SESSION['ville'] = $_POST['ville'];
            $_SESSION['region'] = $_POST['region'];
            $_SESSION['nom'] = $_POST['nom'];
            $_SESSION['prenom'] = $_POST['prenom'];
            $_SESSION['sexe']=$_POST['sexe'];
            header('Location: inscription_fin.php');
        }
        else
        {
            header('Location: inscription.php?erreur=1'); // pseudo déjà pris
        }
    }
    else
    {
        header('Location: inscription.php?erreur=2'); // nom d'utilisateur vide
    }
}
else
{
    header('Location: inscription.php');
}
$connection=null; // fermer la connexion

?>

