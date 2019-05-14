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

            <div id="caseMenu" >
                <a href="poster.php">Poster</a>
            </div>

            <div id="caseMenu" >
                <a href="logout.php">Se déconnecter</a>
            </div>

        </div>

        <div class="contenu">
        <div class="btContenuG"></div>

            <div class="milieu">
                <h1>Gérer les post utilisateurs :</h1>
                <script language="javascript">
                    <!--
                    document.write("<h2>Il faudrait pas qu'ils écrivent n'importe quoi !</h2>"); -->
                    </script>
                <?php
                $request = $bdd->query('SELECT * FROM post WHERE is_ok = 0' );
                while ($donnees = $request->fetch()) {
                    $_SESSION['id_post'] = $donnees['id'];
                    ?>
                    <div id="onepost">
                        <strong>Lapin(e) : <?php echo $donnees['author']; ?> </strong>
                        <p> <?php echo $donnees['contenu']; ?> </p>
                    </div>

                    <form action="traitementGerer.php" method="POST">

                        <input type="radio" name="validate" value="oui" id="oui" /> <label for="oui">Oui</label>
                        <input type="radio" name="validate" value="non" id="non" checked="checked" /> <label for="non">Non</label>

                        <div class="button2">
                            <input type="submit" class="buttonM" value="Valider" />
                        </div>
                    </form>

                    <?php
                    
                }
                ?>
            </div>

        <div class="btContenuD"></div>
        </div>
    </div>

    </body>

</html>