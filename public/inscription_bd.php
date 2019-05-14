<?php session_start();
 include '../src/connexion.php';
 ?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" type="text/css" href="projet.css">
</head>

<body>
<?php

$tab=$_POST;


$connection = connectToBD();
    
   
$sql = "INSERT INTO \"user\"(firstname, lastname, pseudo, mdp, admin) VALUES (?,?,?,?,?)";
$prenom = $tab['prenom'];
$nom = $tab['nom'];
$pseudo = $tab['pseudo'];	
$mdp = $tab['mdp'];

$req = $connection->prepare($sql);
$req->execute([$prenom,$nom,$pseudo,$mdp,'Non']);

echo "<p>Inscription réussie</p><br>";
echo "<a href=index.php> Retour au menu </a><br>";
?>

</body>
</html>


