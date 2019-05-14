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

if (isset($_SESSION['connecte']) ) { echo '' ; }
else { session_start() ; }
?>

<html lang="fr">
    <head>







        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0"/>

        <title>Poster / Usagi Life</title>

        <meta name="description" content="Viens partager ta vie de lapin avec les autres utilisateurs !"/>

        <link rel="stylesheet" type="text/css" href="../stylesheets/perso.css" media="all"/>
        <link rel="icon" type="image/png" href="../design/lapinBase.png" />
    </head>


    <body>

    <div class="colonneGauche">

        <div class="picture">
            <div class="btPicG"></div>
            <img class="pic" src="../design/lapinUnknown.png" alt="../design/lapinUnknown.png" />
            <div class="btPicD"></div>
        </div>

        <div class="description">
            <?php echo '<h1>' . $_SESSION['pseudo'] . '</h1>' ?>
            <br/>
            <?php echo '<p>' . $_SESSION['description'] . '</p>' ?>
        </div>

    </div>

    <div class="colonneDroite">
        <div class="header">
        </div>

        <div class="menu">

            <div id="caseMenu" >
                <a href="profil.php">Mon profil</a>
            </div>

            <div id="caseMenu" >
                <a href="perso.php">Perso</a>
            </div>

            <?php
            if ($_SESSION['is_admin'] == 1) {
                ?>
                <div id="caseMenu" >
                    <a href="gerer.php">Gérer</a>
                </div>
                <?php
            }
            ?>

            <div id="caseMenu" >
                <a href="logout.php">Se déconnecter</a>
            </div>

        </div>

        <div class="contenu">
            <div class="btContenuG"></div>

            <div class="milieu">

            <?php
            
            $isOk = true;

            if ( empty($_POST['pst']) ) { echo '<p>Mais vous n\'avez rien écrit ! T.T.</p>'; $isOk = false ;}
            $_POST['pst'] = (string) $_POST['pst'];

            if ($isOk) {
                try {
                    $request = $bdd->prepare('INSERT INTO post (is_ok, author, contenu) VALUES(:ok, :au, :ct )' );
                    $request->execute(array(
                    'ok' => 0,
                    'au' => $_SESSION['pseudo'],
                    'ct' => $_POST['pst'],
                    ));
                    echo '<p>Votre message a bien été enregistré. Il va être validé par l\'équipe Usagi pour être posté sur le site !</p>' ; 
                } catch (\Throwable $th) {
                    echo '<p>Votre message n\'a pas été enregistré. Il y a dû y avoir un problème... T.T</p>' ; 
                }
            }
            
            ?>
            </div>

            <div class="btContenuD"></div>

        </div>
    </div>

    </body>

</html>