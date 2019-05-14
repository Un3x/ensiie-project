<?php 
session_start();
include './Vue.php'; ?>

<meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./contacts_pres.css">

<?php

if(isset($_GET['fres'])){
    unset($_POST);
    header('location: index.html');
}
else{

if(isset($_POST['name']))

{

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );


$destinataire = "dorian.doan@gmail.com";
$subject = "[Site_message] Message de " . $_POST['surname'] . " " . $_POST['name'];
$message = " Nom : " . $_POST['name'] . "\n" . " Prenom : " . $_POST['surname'] .
             "\n" ." E-mail : " . $_POST['mail'] . "\n" . "\n" . "Message: " . $_POST['message'] . "\n" ;

$headers = "From:" . $_POST['mail'] ;

mail($destinataire,$subject,$message,$headers)
?>


<br/><br/>
<b class="validate_devis_mess"> Votre message a bien été envoyé </b><br/>
<input class="bouton-retour" type="button" onclick="window.location='./index.php'" value="Retourner à l'accueil">

<?php
}
else {
?>

<html>
    <header>
        <title>IImagE</title>
    </header>

    <body>
<?php en_tete(isset($_SESSION['connecte'])); ?>

  <div class="texte-entete">
	<p>Envoyez nous un message !</p>		
  </div>
    <div class="formulaire">
	<form method="post" action="./contacts.php">  
            <label for="name">Nom (*):   </label>
            <input type="text" id="name" name="name" required minlength="1" maxlength="26" size="10"><br/><br/>
            <label for="surname">Prénom :</label>
            <input type="text" id="surname" name="surname" size="10"><br/><br/>
            <label for="mail">Mail (*):</label>
            <input type="email" id="mail" name="mail" required minlength="1" size="30"><br/><br/>
	    <label for="comment">Message :</label><br/>
	    <input type="text" id="message" name="message" required minlength="1" size="200"><br/><br/>
	    <button type="submit"  autofocus>Envoyer</button>
        </form>
    </div>
    </body>
</html>
<?php
}
}

pied();
?>
