<!DOCTYPE html>
<html lang="fr">
    <head>







        <meta charset="utf-8"/>

        <title>Usagi Life</title>

        <meta name="description" content="Viens partager ta vie de lapin avec les autres utilisateurs !"/>

        <link rel="stylesheet" type="text/css" href="src/stylesheets/accueil.css" media="all"/>
    </head>


    <body>

        <div id="blocGauche">
        <div class="blocGaucheHeader">

            <!-- FORMULAIRE PAGE ACCUEIL -->
            <form action="public/perso.php" class="inputHeader" method="POST">

                <div class="usernameAndMDP">
                    <div class="inputUsername">
                            <input type="text" name="pseudo" autocomplete="username" placeholder="Nom d'utilisateur ou email" />
                        </div>
        
                    <div class="inputMDP">
                        <input type="password" name="mdp" autocomplete="current-password" placeholder="Mot de passe" />
                        <a class="didTheirForgot" href="resetPassword.html" rel="noopener">Mot de passe oublié ?</a>
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
                <img src="design/lapinBase.png" alt="Un joli lapin !"/>
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