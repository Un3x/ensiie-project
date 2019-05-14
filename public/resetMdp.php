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
            <h1>Changez votre mot de passe :</h1>


            <!-- FORMULAIRE CHANGEMENT DE MDP USAGI-LIFE -->
            <form action="traitementMdp.php" method="POST">

                <div id="divAsked">
                    <h6>Nom d'utilisateur :</h6>
                    <input id="asked" name="pseudo" type="text" placeholder="Nom d'utilisateur" />
                </div>

                <div id="divAsked">
                    <h6>Nouveau mot de passe :</h6><h5>Faites attention, votre mot de passe ne peut pas contenir d'espaces.</h5>
                    <input id="asked" name="newMdp" type="password" placeholder="Mot de passe" />
                </div>

                <div id="divAsked">
                    <h6>Confirmez votre mot de passe :</h6>
                    <input id="asked" name="newConfirmMDP" type="password" placeholder="Confirmez votre mdp" />
                </div>

                <input type="submit" class="validInscription" value="Valider" />
            </form>

        </div>

        <div class="btDroit"></div>
    </body>

</html>