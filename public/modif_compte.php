<?php

session_start();if(!isset($_SESSION['id_pseudo']))
try
{
  $dbName=getenv('DB_NAME');
  $dbUser=getenv('DB_USER');
  $dbPassword=getenv('DB_PASSWORD');
  $connexion=new PDO("pgsql:host=postgres user=$dbUser dbName=$dbName password=$dbPassword");
  $idpseudo=$_SESSION['id_pseudo'];
  $req = $pdo ->prepare('SELECT * FROM utilisateur WHERE id_pseudo="'.$idpseudo.'"');
  $req->execute(array(':id_pseudo'=>$idpseudo));
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<title>modifier profil d\'inscription</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" title="monstyle" href="style.css" />
</head>
<body>

<div id="section">
<div id="article">
<h2>Modifier les donnees</h2>

<form method="post" action="modif_compte.php">
<p>
<?php
while ($resultat = $req->fetch())
{
echo 'Bonjour'.' '.$resultat['id_pseudo'].'<br/><br/>';
echo  'Modifier votre pseudo : '.$resultat['pseudo'];?><br/>
<input  type="text" name="id_pseudo" size="30" /><br/><br/>
<?php
echo  'Modifier votre nom : '.$resultat['nom'] . '<br/>';?>
<input  type="text" name="nom" size="30" /><br/><br/>
<?php 
echo  'Modifier votre prénom : '.$resultat['prenom'];?><br/>
<input  type="text" name="prenom" size="30" /><br/><br/>
<?php 
echo  'Modifier votre date naiss : '.$resultat['birthdate'];?><br/>
<input  type="text" name="birthdate" size="30" /><br/><br/>						
<?php 
echo  'Modifier votre sexe : '.$resultat['sexe'];?><br/>
<input  type="text" name="sexe" size="30" /><br/><br/>

<?php 
echo  'Modifier votre email : '.$resultat['mail'];?><br/>
<input  type="text" name="mail" size="30" /><br/><br/>
</p>
</form>
</div>
<div id="aside">
<?php
  if(!empty($_POST['nom']) || !empty($_POST['prenom']) || !empty($_POST['id_pseudo']) || !empty($_POST['birthdate']) || !empty($_POST['sexe']) ||
  !empty($_POST['mail']))
  {

    try
    {
      $req= 'UPDATE utilisateur SET nom = :nom, prenom = :prenom,  birthdate=:birthdate, mail =:email, sexe =:sexe 
           WHERE id_pseudo ="'.$idpseudo.'"';
      $reqpreparee= $pdo->prepare($req);

      $reqpreparee ->execute(array('nom'=>$_POST['nom'], 
                 'prenom'=>$_POST['prenom'], 
                 'date_naiss'=>$_POST['birthdate'],   
                 'sexe'=>$_POST['sexe'], 
                 'mail'=>$_POST['mail'], 
                 'id_pseudo' => $_POST['id_pseudo']));
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
    
    echo '<br/><br/> Informations modifiées avec succès <br/>';

    $reqpreparee->closeCursor();
  }
  else
      {
      echo 'Vous devez remplir tous les champs !';
      }
  
  ?>
  <br/><br/><a href="Compte.html">Retour a la page profil</a>
  <?php
}

?>
</div>
</body>
</html>