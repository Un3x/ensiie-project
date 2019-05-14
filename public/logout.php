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

session_start() ;
?>

<html lang="fr">
    <head>







        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0"/>

        <title>Déconnection / Usagi Life</title>

        <meta name="description" content="Viens partager ta vie de lapin avec les autres utilisateurs !"/>

        <link rel="stylesheet" type="text/css" href="../stylesheets/inscription.css" media="all"/>
        <link rel="icon" type="image/png" href="../design/lapinBase.png" />
    </head>

    <body>

    <div class="btGauche"></div>

    <div class="formInscription">
        <?php 
        echo 'Au revoir ' . $_SESSION['pseudo'] . ' !' ;
        session_destroy();
        ?>
        <br/>
        <a href="../index.php">Retour à l'accueil</a>

    </div>
    <div class="btDroit"></div>

    </body>

</html>