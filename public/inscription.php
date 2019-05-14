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
            <h1>Créez votre compte :</h1>


            <!-- FORMULAIRE INSCRIPTION USAGI-LIFE -->
            <form action="traitementInscription.php" method="POST">

                <div id="divAsked">
                    <h6>Prénom :</h6>
                    <input id="asked" name="prenom" type="text" placeholder="Prénom" />
                </div>

                <div id="divAsked">
                    <h6>Nom d'utilisateur :</h6><h5>C'est votre pseudo, il ne peut pas contenir d'espaces.</h5>
                    <input id="asked" name="pseudo" type="text" placeholder="Nom d'utilisateur" />
                </div>

                <div id="divAsked">
                    <h6>Date d'anniversaire :</h6><h5>Attention au format demandé 'AAAA-MM-JJ' !</h5>
                    <input id="asked" name="anniv" type="text" placeholder="AAAA-MM-JJ" />
                </div>

                <div id="divAsked">
                    <h6>Adresse mail :</h6>
                    <input id="asked" name="email" type="text" placeholder="Adresse mail" />
                </div>

                <div id="divAsked">
                    <h6>Mot de passe :</h6><h5>Faites attention, votre mot de passe ne peut pas contenir d'espaces.</h5>
                    <input id="asked" name="mdp" type="password" placeholder="Mot de passe" />
                </div>

                <div id="divAsked">
                    <h6>Confirmez votre mot de passe :</h6>
                    <input id="asked" name="confirmMDP" type="password" placeholder="Confirmez votre mdp" />
                </div>

                <input type="submit" class="validInscription" value="S'inscrire" />
            </form>

        </div>

        <div class="btDroit"></div>
    </body>

</html>