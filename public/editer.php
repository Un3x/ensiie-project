<?php
require '../vendor/autoload.php';

include ("utils.php");

session_start();


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);




//rediriger si l'utilisateur n'est pas connecté
if (!isset($_SESSION["id_user"])) {
    header("Location: connexion.php");
}


$curr_user=$userRepository->fetchId($_SESSION["id_user"]);

$ok_pseudo=true;
$ok_nom=true;

if (isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['pseudo'])&&isset($_POST['mdp'])&&isset($_POST['cmdp'])) {
    if (!verifPseudo($_POST['pseudo']) && !($_POST['pseudo']==$curr_user->getPseudo())) {
        $ok_pseudo=false;
    }
    if (!verifNomPrenom($_POST['nom'], $_POST['prenom']) && !($_POST['nom']==$curr_user->getNom() && $_POST['prenom']==$curr_user->getPrenom())) {
        $ok_nom=false;
    }
    if ($ok_pseudo && $ok_nom) {
        $tmp = $userRepository->creeUser($_SESSION["id_user"], $_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['ddn'], $_POST['mdp'], $_POST['email'], '0', '0', $curr_user->getAdmin());
        $userRepository->updateUser($tmp);

        header("Location: index.php");
    }
}
?>




<!--TODO mettre en place les variables du formulaire selon les infos deja connues de l'utilisateur-->

<html>
<head>
<!-- Latest compiled and minified CSS -->
<meta charset="utf-8">
    <title>Sciience</title>
    <link rel="stylesheet" href=".css">
</head>
     <body>
     <!--ALED TODO mettre le logo de sciience comme dans toutes les autres pages ainsi qu\'une petite page de garde sympathique-->
     <h2>Page d'édition du profil</h2>
     <nav>
         <!-- ALED TODO recopier le nav-->
    </nav>
    <?php
    if (!$ok_nom) {
        echo "<p>couple (nom, prenom) invalide</p>";
    }

    if (!$ok_pseudo) {
        echo "<p>Pseudo déjà utilisé</p>";
    }
    ?>
     <form action="editer.php" method="POST">
        Nom :<br>
        <input id="1" type="text" name="nom" value=<?php echo $curr_user->getNom() ?> required pattern="[a-zA-Z0-9']*" maxlength="50"/><br>
        Prenom :<br>
        <input id="2" type="text" name="prenom" value=<?php echo $curr_user->getPrenom() ?> required pattern="[a-zA-Z0-9']*" maxlength="50" /><br>
        Pseudo :<br>
        <input id="3" type="text" name="pseudo" value=<?php echo $curr_user->getPseudo() ?> required pattern="[a-zA-Z0-9']*" maxlength="50"><br>
        Nouveau mot de passe :<br>
        <input id="4" type="password" name="mdp"><br>
        Confirmation du nouveau mot de passe :<br>
        <input id="5" type="password" name="cmdp"><br>
        Date de naissance :<br>
        <input id="6" type="date" name="ddn" value=<?php echo $curr_user->getDdn() ?> required /><br>
        Email :<br>
        <input id="7" type="text" name="email" value=<?php echo $curr_user->getMail() ?> required /><br>
        <!-- <input type="button" class="input" onclick="verif()" value="Valider"> -->
        <input id="valider" type="submit" name="Envoyer">
     </form>

     <p id="mdp_invalide" style="display:none">Mot de passe invalide</p>
     <p id="err" style="display:none">Veuillez remplir tous les champs</p>
     </body>

     <script>
        function verif() {
            document.getElementById("mdp_invalide").style.display="none";
            document.getElementById("err").style.display="none";
            tmpnom=document.getElementById("1").value;
            tmpprenom=document.getElementById("2").value;
            tmppseudo=document.getElementById("3").value;
            tmpmdp=document.getElementById("4").value;
            tmpcmdp=document.getElementById("5").value;
            tmpddn=document.getElementById("6").value;
            tmpemail=document.getElementById("7").value;
            if (tmpnom=='' || tmpprenom=='' || tmppseudo=='' || tmpmdp=='' || tmpddn=='' || tmpemail=='') {
                document.getElementById("err").style.display="block";
            }
            else if (tmpmdp!=tmpcmdp) {
                document.getElementById("mdp_invalide").style.display="block";
            }
            else {
                document.getElementById("valider").click();
            }
        }

    </script>
</html>