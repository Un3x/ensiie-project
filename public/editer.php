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
$user_connected=isset($_SESSION["id_user"]);
if ($user_connected) {//on récupère les info sur l'utilisateur courant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}



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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="formulaire.css">
</head>
<div class="top"> <!--ajout d'un haut de page si l'utilisateur est admin ou si il est connecté-->
        <?php
        if ($user_connected) {
            echo "<TABLE >
      <TR>
        <TD class=\"bande1\" align=\"left\" WIDTH=\"100%\">Vous êtes connecté en tant que $nom \"$pseudo\" $prenom</TD>
        <TD style=\"border:none; height:30px\" align=\"right\"><form action=\"deconnection.php\"><input class=\"bande2\" type=\"submit\" value=\"Deconnexion\"></form></TD>
      </TR>
    </TABLE>";

            //"<p style=\"white-space: no-wrap\">Vous êtes connecté en tant que $nom \"$pseudo\" $prenom<div style=\"white-space: no-wrap\">Deconection</div> </p>";

        }
        else {
            echo "<TABLE >
      <TR>
        <TD class=\"bande1\" align=\"left\" WIDTH=\"100%\"></TD>
        <TD style=\"border:none; height:30px\" align=\"right\"><form action=\"connexion.php\"><input class=\"bande2\" type=\"submit\" value=\"Connexion\"></form></TD>
      </TR>
    </TABLE>";
        }
        
        ?>
</div>
<body>
    <header>
        <img src="./titre.png"/>
    </header>
    <nav>
        <a href="index.php" class="rubrique">Accueil    </a>
        <a href="bibliotheque.php" class="rubrique">|   Bibliothèque    </a>
        <?php if ($user_connected): ?>
            <a href="espace_perso.php" class="rubrique">|   Espace perso    </a>
            <a href="review.php" class="rubrique">|   Review    </a>
            <a href="editer.php" class="rubrique">|   Editer   </a>
            <?php endif; ?>
        <?php if ($user_connected && $admin): ?>
            <a href="liste_emprunts.php" class="rubrique">|   Liste   </a>
            <a href="ajout_livre.php" class="rubrique">|   Ajout livre   </a>
            <a href="rendu.php" class="rubrique">|   Retour   </a>
            <a href="emprunt.php" class="rubrique">|   Emprunt   </a>
        <?php endif; ?>
    </nav>
    <section class="connect">
     <!--ALED TODO mettre le logo de sciience comme dans toutes les autres pages ainsi qu\'une petite page de garde sympathique-->
    <div class="grand-titre">Page d'édition du profil</div>
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
     <form id="form_editer" action="editer.php" method="POST">
        Nom :<br>
        <input class="formulaire" id="1" type="text" name="nom" value=<?php echo $curr_user->getNom() ?> required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br>
        Prenom :<br>
        <input class="formulaire" id="2" type="text" name="prenom" value=<?php echo $curr_user->getPrenom() ?> required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50" /><br>
        Pseudo :<br>
        <input class="formulaire" id="3" type="text" name="pseudo" value=<?php echo $curr_user->getPseudo() ?> required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"><br>
        Nouveau mot de passe :<br>
        <input class="formulaire" id="4" type="password" name="mdp" ><br>
        Confirmation du nouveau mot de passe :<br>
        <input class="formulaire" id="5" type="password" name="cmdp" oninput="check(this)"><br>
        Date de naissance :<br>
        <input class="formulaire" id="6" type="date" name="ddn" value=<?php echo $curr_user->getDdn() ?> required /><br>
        Email :<br>
        <input class="formulaire" id="7" type="text" name="email" value=<?php echo $curr_user->getMail() ?> required pattern="[a-zA-Z0-9._-]*@[a-zA-Z0-9-]*.[a-zA-Z]*" maxlength="50"/><br>
        <input class="formulaire" id="valider" type="submit" name="Envoyer">
     </form>

     
     

     <p id="mdp_invalide" style="display:none">Mot de passe invalide</p>
     <p id="err" style="display:none">Veuillez remplir tous les champs</p>
    </section>
     </body>

     <script>
        function check(input) {
            if (input.value != document.getElementById('4').value) {
                input.setCustomValidity('Les deux mots de passe doivent être identiques.');
            } else {
                input.setCustomValidity('');
            }
        }
    </script>
</html>