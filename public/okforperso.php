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

// verification de l'identite de l'utilisateur entrant
/**
 * fonction no_space( chaîne de caractère chr )
 * renvoit true si chr ne contient pas d'espaces, false sinon
 */
function no_space($chr) {
    if (strpos($chr, ' ') == false) { return true; }
    else {return false; }
}

$isOk = true;
if ( empty($_POST['pseudo']) ) { echo '<p>Vous n\'avez pas renseigné votre pseudo.</p>'; $isOk = false ;}
if ( empty($_POST['mdp']) ) { echo '<p>Vous n\'avez pas renseigné votre mot de passe.</p>'; $isOk = false ;}

$_POST['pseudo'] = (string) $_POST['pseudo'];
$_POST['mdp'] = (string) $_POST['mdp'];

$request = $bdd->prepare('SELECT id FROM user WHERE pseudo = :ps');
$request->execute(array(
    'ps' => $_POST['pseudo']
));
$donnees = $request->fetch();
$potentielId = $donnees['id'];

if ($potentielId == NULL) { echo '<p>Votre pseudo n\'est pas reconnu.</p>'; $isOk = false ;}

$request = $bdd->prepare('SELECT passwrd FROM user WHERE pseudo = :ps ');
$request->execute(array(
    'ps' => $_POST['pseudo']
));

$donnees = $request->fetch();
$potentielMdp = $donnees['passwrd'];

if ( $potentielMdp != $_POST['mdp'] ) { echo '<p>Mauvais mot de passe.</p>'; $isOk = false; }

if ( $isOk ) {
    // start session 
    session_start();
    $request = $bdd->prepare('SELECT * FROM user WHERE pseudo= :ps');
    $request->execute(array(
        'ps' => $_POST['pseudo']
    ));
    $donnees = $request->fetch();

    // definition variables utiles dans la session
    $_SESSION['connecte'] = 1;
    $_SESSION['id'] = $donnees['id'];
    $_SESSION['is_admin'] = $donnees['is_admin'];
    $_SESSION['prenom'] = $donnees['firstname'];
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $_SESSION['email'] = $donnees['email'];
    $_SESSION['anniv'] = $donnees['birthday'];
    $_SESSION['description'] = $donnees['perso_description'];
    $_SESSION['nb_followers'] = $donnees['nb_followers'];
    $_SESSION['nb_friends'] = $donnees['nb_friends'];
    $_SESSION['picture'] = $donnees['picture'];
    $_SESSION['is_post'] = 0;


    echo '<p>Votre authentification a réussie ! Vous pouez accéder à votre espace personnel !</p>' ;
    ?>
    <a href="perso.php">Accès à votre espace personnel</a>
    <?php
}
else {
    echo '<p>Votre authentification a échouée. Possédez vous un compte Usagi-Life ?</p>' ;
    ?> 
    <a href="../index.php">Retour à l'accueil</a>
    <?php
}

?>
    </div>

<div class="btDroit"></div>

    </body>
    
</html>