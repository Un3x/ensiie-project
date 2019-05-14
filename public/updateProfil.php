<?php
require '../src/User/projetControl.php';

$dateDeNaissance = $_SESSION['dateDeNaissance'];
$mail = $_SESSION['mail'];
$addresse = $_SESSION['addresse'];
$status = $_SESSION['status'];

if( isset($_POST['genre']) || isset($_POST['mail']) || isset($_POST['dateDeNaissance']) || isset($_POST['addresse']))
{  
    $pseudo = $_SESSION['pseudo'];
    $dateDeNaissance = $_POST['dateDeNaissance'];
    $mail = $_POST['mail'];
    $genre = $_POST['genre'];
    $addresse = $_POST['addresse']; 
    updateProfil($status, $pseudo, $dateDeNaissance, $mail,
                        $addresse, $genre);
   
}
else if( isset($_POST['nvxmdp']) && isset($_POST['nvxmdp2']) && isset($_POST['mdp']))
{
    $mdp = $_SESSION['mdp'];
    $ancienMdp = $_POST['mdp'];
    $nvxmdp = $_POST['nvxmdp'];
    $nvxmdp2 = $_POST['nvxmdp2'];
    $pseudo = $_SESSION['pseudo'];
    changerMdp( $pseudo, $mdp, $ancienMdp, $nvxmdp, $nvxmdp2, $status);
}  
else
{
    entete("");
    formulaireUpdateProfil($dateDeNaissance, $mail, $addresse);
    formulaireChangementMdp();
    
}

navigation($status); 
pied();
?>