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

        <title>Inscription / Usagi Life</title>

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

    function testDateFormat($value) {
        return preg_match( '#^([0-9]{2})(/-)([0-9]{2})\2([0-9]{4})$#', $value);
    }

    function testMailFormat($value) {
        return preg_match( '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $value );
    }

    $isOk = true ;

    // verification d'existence des donnees entrées par l'utilisateur
    if ( empty($_POST['prenom']) ) { echo '<p>Vous n\'avez pas renseigné votre prénom.</p>'; $isOk = false ;}
    if ( empty($_POST['pseudo']) ) { echo '<p>Vous n\'avez pas renseigné votre pseudo.</p>'; $isOk = false ;}
    if ( empty($_POST['anniv']) ) { echo '<p>Vous n\'avez pas renseigné votre date d\'anniversaire.</p>'; $isOk = false ;}
    if ( empty($_POST['email']) ) { echo '<p>Vous n\'avez pas renseigné votre adresse email.</p>'; $isOk = false ;}
    if ( empty($_POST['mdp']) ) { echo '<p>Vous n\'avez pas renseigné votre mot de passe.</p>'; $isOk = false ;}
    if ( empty($_POST['confirmMDP']) ) { echo '<p>Vous n\'avez pas confirmé votre mot de passe.</p>'; $isOk = false ;}

    // verification validite types 
    $_POST['prenom'] = (string) $_POST['prenom'];
    $_POST['pseudo'] = (string) $_POST['pseudo'];
    $_POST['anniv'] = (string) $_POST['anniv'];
    $_POST['email'] = (string) $_POST['email'];
    $_POST['mdp'] = (string) $_POST['mdp'];
    $_POST['confirmMDP'] = (string) $_POST['confirmMDP'];

    // verification validite pseudo & mdp & anniv & email
    if ( no_space($_POST['pseudo']) == false) { echo '<p>Il ne peut pas y avoir d\'espaces dans votre pseudo.</p>'; $isOk = false ;}
    if ( no_space($_POST['mdp']) == false) { echo '<p>Il ne peut pas y avoir d\'espaces dans votre mot de passe.</p>'; $isOk = false ;}
    if ( testDateFormat($_POST['anniv']) == 1) { echo '<p>Votre date d\'anniversaire n\'est pas au format demandé.</p>'; $isOk = false ;}
    if ( testMailFormat($_POST['anniv']) == 1) { echo '<p>Votre adresse email n\'est pas au format demandé.</p>'; $isOk = false ;}
    if ( $_POST['mdp'] != $_POST['confirmMDP'] ) { echo '<p>Les mots de passe entrés ne sont pas identiques.</p>'; $isOk = false ;}

    
    if ($isOk == true) { // si toutes les donnees de l'user sont ok faire

        //ajout dans la base de donnees
        try {
            $request = $bdd->prepare('INSERT INTO user(is_admin, firstname, pseudo, email, birthday, passwrd ) VALUES(:isA, :pr, :ps, :em, :bd, :pw)' );
            $request->execute(array(
                'isA' => 0,
                'pr' => $_POST['prenom'],
                'ps' => $_POST['pseudo'],
                'em' => $_POST['email'],
                'bd' => $_POST['anniv'],
                'pw' => $_POST['mdp']
            ));
            echo '<p>Merci d\'avoir correctement rempli le formulaire !</p>';
            echo '<p>Vous êtes bien inscrit sur Usagi-Life, pour vous connecter, retournez à l\'accueil : </p>';
            ?>
            <br/>
            <a href="../index.php">Retour à l'accueil</a>
            <?php

        } catch (\Throwable $th) {
            echo "<p>Ce pseudo est malheureusement déjà prit...</p>";
            ?>
            <br/>
            <a href="inscription.php">Retour au formulaire d'inscription</a>
            <br/>
            <a href="../index.php">Retour à l'accueil</a>
            <?php
        }
        
        
    }
    else { // sinon le renvoyer au formulaire ou à l'accueil
        ?>
        <br/>
        <a href="inscription.php">Retour au formulaire d'inscription</a>
        <br/>
        <a href="../index.php">Retour à l'accueil</a>
        <?php
    }
    ?>

    
    

    </div>

    <div class="btDroit"></div>

    </body>

</html>