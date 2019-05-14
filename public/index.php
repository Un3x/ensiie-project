<?php 
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0"/>

    <title>Usagi Life</title>

    <link rel="stylesheet" type="text/css" href="../stylesheets/accueil.css" media="all"/>
    <link rel="icon" type="image/png" href="../design/lapinBase.png" />
</head>



<body>

    <div id="blocGauche">
        <div class="blocGaucheHeader">

            <!-- FORMULAIRE PAGE ACCUEIL -->
            <form action="perso.php" class="inputHeader" method="POST">

                <div class="usernameAndMDP">
                    <div class="inputUsername">
                            <input type="text" name="pseudo" autocomplete="username" placeholder="Nom d'utilisateur" />
                        </div>
        
                    <div class="inputMDP">
                        <input type="password" name="mdp" autocomplete="current-password" placeholder="Mot de passe" />
                        <a class="didTheirForgot" href="resetMDP.php" rel="noopener">Mot de passe oublié ?</a>
                    </div>

                </div>
                
                <div class="buttonSC">
                    <input type="submit" class="buttonSCHeader" value="Se connecter" />
                </div>
            </form>
            <!-- FIN DE FORMULAIRE -->

        </div>

        <div class="blocGaucheMiddle">
            <div class="icone">
                <img src="../design/lapinBase.png" alt="Un joli lapin !"/>
            </div>
            
            <div class="contenuGauche">
                <h1>Explorez le monde des lapins, partagez le votre.</h1>
                <h2>Rejoignez Usagi Life dès aujourd'hui.</h2>
            </div>

            <div class="boutonInscription">
                <form action="public/inscription.php" method="POST">
                    <input type="submit" class="boutonI" value="S'inscrire" />
                </form>
            </div>

        </div>


        </div>
            

        <div id="blocDroite">
            <div class="contenuDroite">

        </div>

    </div>

</body>






</html>