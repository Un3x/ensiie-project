<?php
session_start();

// connexion à la base de données
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword")
or die('could not connect to database');


$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$pseudo= $_SESSION['pseudo'];
$ville= $_SESSION['ville'];
$region= $_SESSION['region'];
$sexe=$_SESSION['sexe'];
$mdp=$_POST['mdp'];
$mdpp=$_POST['mdpp'];
$phrase="Entrez une phrase qui vous caractérise pour faire la différence!";
$note=5;
if(isset($mdp))
{
    if($mdp==$mdpp){
        //Enregistrement de l'identité
        $query = $connection->prepare('INSERT INTO Identite(pseudo, nom, prenom,sexe,ville,region,note,phrase) VALUES(:pseudo,:nom,:prenom,:sexe,:ville,:region,:note,:phrase)');
        $query->bindValue('pseudo',$pseudo, PDO::PARAM_STR);
        $query->bindValue('nom',$nom, PDO::PARAM_STR);
        $query->bindValue('prenom',$prenom, PDO::PARAM_STR);
        $query->bindValue('sexe',$sexe, PDO::PARAM_STR);
        $query->bindValue('ville',$ville, PDO::PARAM_STR);
        $query->bindValue('region',$region, PDO::PARAM_STR);
        $query->bindValue('note',$note, PDO::PARAM_INT);
        $query->bindValue('phrase',$phrase, PDO::PARAM_STR);
        $query->execute();

        //Enregistrement de pseudo et mot de passe
        $other_query=$connection->prepare('INSERT INTO Connexion(pseudo,mdp) VALUES(:pseudo,:mdp)');
        $other_query->bindValue('pseudo',$pseudo,PDO::PARAM_STR);
        $other_query->bindValue('mdp',$mdpp,PDO::PARAM_STR);
        $other_query -> execute();

        //Enregistrment de avatar
        $other_other_query = $connection->prepare('INSERT INTO Avatar(pseudo,avatar) VALUES(:pseudo,:avatar)');
        $other_other_query->bindValue('pseudo',$pseudo,PDO::PARAM_STR);
        if($sexe=="M"){// si homme
            $other_other_query->bindValue('avatar',"avatar/avatar8.jpeg",PDO::PARAM_STR);
        }
        else{// si femme
            $other_other_query->bindValue('avatar',"avatar/avatar16.jpeg",PDO::PARAM_STR);
        }
        header('Location: new_membre.php'); //Redirection de l'utilisateur vers
    }
    else {
        header('Location: inscription_fin.php?erreur=1'); // mots de passe non identiques
    }

}
else {
    header('Location: inscription_fin.php?erreur=2'); // mots de passe non définis
}
$connection=null;
?>

