<?php 
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
            </div>

            <div id="persoItem">
                <h1>Date d'anniversaire :</h1>
                <p> <?php echo $_SESSION['anniv'] ?> </p>
            </div>

            <div id="persoItem">
                <h1>Description personnelle :</h1>
                <p> <?php echo $_SESSION['description'] ?> </p>
            </div>

            <form action="modifProfil.php" class="modify" method="POST">
                <div class="button">
                    <input type="submit" class="buttonM" value="Modifier" />
                </div>
            </form>

        </div>

        <div class="btContenuD"></div>
        </div>
    </div>

    </body>

</html>