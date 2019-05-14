<?php //connexion à la BDD

$PARAM_hote = 'localhost';
$PARAM_bddName = 'db';
$PARAM_user = 'root';
$PARAM_mdp = '';

try {
    $bdd = new PDO('mysql:host=' . $PARAM_hote . ';dbname=' . $PARAM_bddName, $PARAM_user, $PARAM_mdp);
    $bdd->exec("SET CHARACTER SET utf8");
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
    echo 'Impossible de se connecter à la base de donnée</br>';
            echo 'Erreur : ' .  $e->getMessage() . '<br />';
            echo 'N° : ' .      $e->getCode();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>







        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0"/>

        <title>Changer de mot de passe / Usagi Life</title>

        <meta name="description" content="Viens partager ta vie de lapin avec les autres utilisateurs !"/>

        <link rel="stylesheet" type="text/css" href="../stylesheets/inscription.css" media="all"/>
        <link rel="icon" type="image/png" href="../design/lapinBase.png" />
    </head>




    <body>

    <div class="btGauche"></div>

    <div class="formInscription">
    <?php 
    /**
     * fonction no_space( chaîne de caractère chr )
     * renvoit true si chr ne contient pas d'espaces, false sinon
     */
    function no_space($chr) {
        if (strpos($chr, ' ') == false) { return true; }
        else {return false; }
    }

    $isOk = true ;

    // verification d'existence des donnees entrées par l'utilisateur
    if ( empty($_POST['newMdp']) ) { echo '<p>Vous n\'avez pas renseigné votre nouveau mot de passe.</p>'; $isOk = false ;}
    if ( empty($_POST['newConfirmMDP']) ) { echo '<p>Vous n\'avez pas confirmé votre mot de passe.</p>'; $isOk = false ;}

    // verification validite types
    $_POST['pseudo'] = (string) $_POST['pseudo'];
    $_POST['newMdp'] = (string) $_POST['newMdp'];
    $_POST['newConfirmMDP'] = (string) $_POST['newConfirmMDP'];

    // verification validite pseudo & mdp & anniv & email
    if ( no_space($_POST['pseudo']) == false) { echo '<p>Il ne peut pas y avoir d\'espaces dans votre pseudo.</p>'; $isOk = false ;}
    if ( no_space($_POST['newMdp']) == false) { echo '<p>Il ne peut pas y avoir d\'espaces dans votre mot de passe.</p>'; $isOk = false ;}
    if ( $_POST['newMdp'] != $_POST['newConfirmMDP'] ) { echo '<p>Les mots de passe entrés ne sont pas identiques.</p>'; $isOk = false ;}

    
    if ($isOk == true) { // si toutes les donnees de l'user sont ok faire

        //essayer l'update de la base de donnee
        try {
            $request = $bdd->prepare('UPDATE user SET passwrd = :pw WHERE pseudo = :ps' );
            $request->execute(array(
                'pw' => $_POST['newMdp'],
                'ps' => $_POST['pseudo']
            ));
            echo '<p>Votre mot de passe a bien été mis à jour !</p>';
            ?>
            <br/>
            <a href="../index.php">Retour à l'accueil</a>
            <?php

        } catch (\Throwable $th) {
            echo "<p>Le pseudo que vous avez entré n'existe pas...</p>";
            ?>
            <br/>
            <a href="resetMdp.php">Retour au formulaire</a>
            <br/>
            <a href="../index.php">Retour à l'accueil</a>
            <?php
        }
        
        
    }
    else { // sinon le renvoyer au formulaire ou à l'accueil
        ?>
        <br/>
        <a href="resetMdp.php">Retour au formulaire</a>
        <br/>
        <a href="../index.php">Retour à l'accueil</a>
        <?php
    }
    ?>

    
    

    </div>

    <div class="btDroit"></div>

    </body>

</html>