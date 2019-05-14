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

session_start();
?>


<html lang="fr">
    <head>







        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0"/>

        <title>Mon profil / Usagi Life</title>

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

            <form action="modifProfil.php" class="modify" method="POST">

            <div id="persoItem">
                <h1>Prénom :</h1>
                <p> <?php echo $_SESSION['prenom'] ?> </p>
            </div>

            <div id="persoItem">
                <h1>Pseudo :</h1>
                <p> <?php echo $_SESSION['pseudo'] ?> </p>
            </div>

            <div id="persoItem">
                <h1>Adresse mail :</h1>
                <p> <?php echo $_SESSION['email'] ?> </p>
                <input id="changed" name="email" type="text" placeholder="Adresse mail" />
            </div>

            <div id="persoItem">
                <h1>Date d'anniversaire :</h1>
                <p> <?php echo $_SESSION['anniv'] ?> </p>
            </div>

            <div id="persoItem">
                <h1>Description personnelle :</h1>
                <p> <?php echo $_SESSION['description'] ?> </p>
                <input id="changed" name="desc" type="text" placeholder="Description personnelle..." />
            </div>

            
                <div class="button">
                    <input type="submit" class="buttonM" value="Valider les changements" />
                </div>

            <?php
            /**
     * fonction no_space( chaîne de caractère chr )
     * renvoit true si chr ne contient pas d'espaces, false sinon
     */
    function no_space($chr) {
        if (strpos($chr, ' ') == false) { return true; }
        else {return false; }
    }

    function testMailFormat($value) {
        return preg_match( '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $value );
    }

    $isOk = true ;

    // verification d'existence des donnees entrées par l'utilisateur
    if ( empty($_POST['email']) ) { $isOk = false ;}
    if ( empty($_POST['desc']) ) { $isOk = false ;}
    
    // verification validite types 
    $_POST['email'] = (string) $_POST['email'];
    $_POST['desc'] = (string) $_POST['desc'];

    // verification validite pseudo & mdp & anniv & email
    if ( testMailFormat($_POST['email']) == 0) { $isOk = false ;}

    if ($isOk) {
        try {
            $request = $bdd->prepare('UPDATE user SET email = :em, perso_description = :dsc WHERE pseudo = :ps' );
            $request->execute(array(
                'em' => $_POST['email'],
                'dsc' => $_POST['desc'],
                'ps' => $_SESSION['pseudo'],
            ));
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['description'] = $_POST['desc'];
            echo '<p>Vos informations ont été mises à jour !</p>' ;
            ?>
            <a href="profil.php">Retour au profil</a>
            <?php
        } catch (\Throwable $th) {
            echo '<p>Vos informations n\'ont pas pû être mises à jour.</p>' ;
        }
    }       
    ?>
            </form>

        </div>

        <div class="btContenuD"></div>
        </div>
    </div>

    </body>

</html>