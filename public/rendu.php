<?php

include ("utils.php");


require '../vendor/autoload.php';

session_start();


//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$historiqueRepository = new \Historique\HistoriqueRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$userRepository = new \User\UserRepository($connection);
$user_connected=isset($_SESSION["id_user"]);
if ($user_connected) {//on récupère les info sur l'utilisateur courrant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}

// ajouter une redirection automatique si l'utilisateur n'est pas admin
if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
}
if (!(verifAdmin($_SESSION["id_user"]))) {
    header("Location: index.php");
}

if (isset($_POST['pseudo'])) {
    $okpseudo = !(verifPseudo($_POST['pseudo']));
}



//si tout est bon on effectue le rendu
//ajouter la transaction à l'historique
//retirer la référece à l'utilisateur du livre en question
if (isset($okpseudo) && $okpseudo && isset($_POST['id_livre']) && !(verifIdLivre($_POST['id_livre']))) {
    $date = new DateTime();
    $tmplivre=$livreRepository->fetchId($_POST['id_livre']);
    $tmphist=$historiqueRepository->creeHistorique($_POST['id_livre'], PseudoToId($_POST['pseudo']), $tmplivre->getDateEmprunt(), $date, '', '');
    $historiqueRepository->insertHistorique($tmphist);

    $tmplivre->setEmprunteur(NULL);
    $livreRepository->updateLivreRendu($tmplivre);
}



?>




<html>
<head>
    <meta charset="utf-8">
    <title>Validation de rendu</title>
    <link rel="stylesheet" href="./css/style.css">
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
        <img src="../images/sciience.png"/>
    </header>
    <nav>
        <?php affiche_nav($user_connected, $admin) ?> <!-- dans utils.php -->
    </nav>
    <section>
    <div class="grand-titre">Rendu des livres</div class="grand-titre">

    <?php 
    if (isset($okpseudo) && !($okpseudo)) {
        echo "<p>Pseudo invalide</p>";
    }
    ?>
    <br>

    <form action="rendu.php" method="POST">
        Pseudo :<br>
        <input id="f1pseudo" type="text" name="pseudo"><br>
        <input class="bande2" type="button" class="input" onclick="valide_pseudo()" value="Valider">
        <input id="validerf1" style="display:none" type="submit" name="Envoyer">
    </form>
    <p id="f1error" style="display:none">Veuillez remplir le champ</p>

    <!--TODO mettre à jour "livre emprunt", "histo", "Livre", "User"-->
    <?php if (isset($okpseudo) && $okpseudo) : ?>
        <p id="displaytable">
            <div class="res">Liste des livres empruntés par <?php echo $_POST['pseudo']; ?></div>
            <?php $livresarendre=$livreRepository->fetchByUser(PseudoToId($_POST['pseudo']));
            if ($livresarendre != []): ?>
            <table class="table table-bordered table-hover table-striped">
                <thead style="font-weight: bold">
                    <th>#</th>
                    <th>titre</th>
                    <th>emprunteur</th>
                    <th>rendre</th>
                </thead>
        
        <?php foreach ($livresarendre as $livre) : ?>
            <tr>
                <td><?php echo $livre->getId() ?></td>
                <td><?php echo $livre->getTitre() ?></td>
                <td><?php if ($livre->getEmprunteur() !='') echo IdToPseudo($livre->getEmprunteur()) ?></td>
                <td>

                    <form action="rendu.php" method="POST">
                        <input style="display:none" type="text" name="pseudo" value=<?php echo $_POST['pseudo'] ?>>
                        <input style="display:none" type="text" name="id_livre" value=<?php echo $livre->getId(); ?>>
                        <input class="butcan" type="submit" name="Valider" value="Valider">
                    </form>
        <? endforeach; ?>
    </table>
<?php endif; ?>
<?php if ($livresarendre == []): ?>
    <p>Cet utilisateur n'a pas de livres à rendre</p>
<?php endif; ?>
</p>
    <?php endif; ?>
</section>
</body>

<script>


    function valide_pseudo() {
        tmp=document.getElementById("f1pseudo").value;
        if (tmp=='') {
            document.getElementById("f1error").style.display="block";
        }
        else {
            document.getElementById("validerf1").click();
        }
    }


</script>

</html>
