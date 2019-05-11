<?php

include("utils.php");


require '../vendor/autoload.php';

session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$livres=$livreRepository->fetchAll();
$reservationRepository = new \Reservation\ReservationRepository($connection);
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



//vérification de la validité des variables postées
if (isset($_POST['pseudo'])) {
    $okpseudo= !(verifPseudo($_POST['pseudo']));
    if ($okpseudo && livreReserve(PseudoToId($_POST['pseudo'])) != '') {
        $aunereserv=true;
    }
}
if (isset($_POST['id_livre'])) {
    $okid= !(verifIdLivre($_POST['id_livre']));
    if ($okpseudo && estreservLivre($_POST['id_livre']) && (areservLivre($_POST['id_livre']) != PseudoToId($_POST['pseudo']))) {
        $dejareserv=true;
    }
    else {
        $dejareserv=false;
    }
    if (estEmprunte($_POST['id_livre'])) {
        $dejaemprunte=true;
    }
    else {
        $dejaemprunte=false;
    }
}





//Si tout est ok on réalise l'emprunt
//retirer de la table réservation si nécessaire
//update le livre dans sa table
if (isset($_POST['id_livre']) && isset($_POST['pseudo']) && $okpseudo && $okid && !($dejareserv) && !($dejaemprunte)) {
    $tmpres=$reservationRepository->creeReservation($_POST['id_livre'], PseudoToId($_POST['pseudo']));
    $reservationRepository->deleteReservation($tmpres);

    $tmplivre=$livreRepository->fetchId($_POST['id_livre']);
    $tmplivre->setEmprunteur(PseudoToId($_POST['pseudo']));
    $date = new DateTime();
    $tmplivre->setDateEmprunt($date);
    $livreRepository->updateLivre($tmplivre);

    header("Location: index.php");

}






?>

<html>
<head>
    <meta charset="utf-8">
    <title>Emprunt</title>
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
    <div class="grand-titre">Page d'emprunt de livre</div>
    <nav>
         <!-- TODO recopier le nav-->
    </nav>

    <?php
    if (isset($dejareserv) && $dejareserv) {
        echo "<p>Ce livre est déjà réservé par un autre utilisateur</p>";
    }

    if(isset($dejaemprunte) && $dejaemprunte) {
        echo "<p>Ce livre est déjà emprunté par un autre utilisateur</p>";
    }
    ?>






    <!-- premier formulaire où l'admin peut saisir un utilisateur non obligatoire-->
    <form action="emprunt.php" method="POST">
        <br>Pseudo de l'emprunteur :<br>
        <input id="f1pseudo" type="text" name="pseudo"><br>
        <input type="button" class="butcan" onclick="valide_emprunteur()" value="Valider">
        <input id="validerf1" style="display:none" type="submit" name="Envoyer">
    </form>

    <p id="f1error" style="display:none">Veuillez remplir le champ</p>


    <?php
    if (isset($okpseudo) && !($okpseudo)) {
        echo "<p>Pseudo Invalide</p>";
    }
    ?>




    <!-- second formulaire déjà prérempli si le premier à été validé-->
    <?php 
    

    if (isset($okpseudo) && $okpseudo) : ?>
        <?php $livresreserved = $livreRepository->fetchReserved(PseudoToId($_POST['pseudo'])); ?>
        <?php if ($livresreserved != []): ?>
    <div class="res">Livres réservés par cet utilisateur :</div>
    <table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <th>#</th>
    <th>titre</th>
    <th>emprunteur</th>
    <th>emprunter</th>
    </thead>
<?php 
    foreach ($livresreserved as $livre) : ?>
    <tr>
    <td><?php echo $livre->getId() ?></td>
    <td><?php echo $livre->getTitre() ?></td>
    <td><?php if ($livre->getEmprunteur() !='') echo IdToPseudo($livre->getEmprunteur()) ?></td>
    <td>

        <form action="emprunt.php" method="POST">
        <input style="display:none" type="text" name="id_livre" value=<?php echo $livre->getId() ?>>
        <input style="display:none" type="text" name="titre" value=<?php echo $livre->getTitre() ?>>
        Pseudo :<input type="text" name="pseudo" value=<?php if (isset($_POST['pseudo'])) echo $_POST['pseudo'] ?>>
        <input type="submit" class="butcan" name="Valider" value="Valider">
    </form>


    </tr>
<?php endforeach; ?>
    </table>

    <p id="f2error" style="display:none">Veuillez remplir correctement tous les champs</p>
    <?php endif; ?>

    <?php if ($livresreserved == []): ?>
    <h4>Cet utilisateur n'a pas réservé de livres</h4>
    <?php endif; ?>
    <?php endif; ?>

    <?php
    if (isset($okid) && !($okid)) {
        echo "<p>Id de Livre invalide</p>";
    }
    ?>
    <br>


<input type="button" onclick="affichetable()" value="Afficher la liste des livres">
<p></p>

<div id="displaytable" style="display:none">

    <div class="res">Liste des livres disponibles</div>
    <table class="table table-bordered table-hover table-striped">
    <thead style="font-weight: bold">
    <th>#</th>
    <th>titre</th>
    <th>emprunteur</th>
    <th>emprunter</th>
    </thead>
<?php 
    foreach ($livres as $livre) : ?>
    <tr>
    <td><?php echo $livre->getId() ?></td>
    <td><?php echo $livre->getTitre() ?></td>
    <td><?php if ($livre->getEmprunteur() !='') echo IdToPseudo($livre->getEmprunteur()) ?></td>
    <td>

        <form action="emprunt.php" method="POST">
        <input style="display:none" type="text" name="id_livre" value=<?php echo $livre->getId() ?>>
        <input style="display:none" type="text" name="titre" value=<?php echo $livre->getTitre() ?>>
        Pseudo :<input type="text" name="pseudo" value=<?php if (isset($_POST['pseudo'])) echo $_POST['pseudo'] ?>>
        <input type="submit" name="Valider" class="butcan" value="Valider">
    </form>


    </tr>
<?php endforeach; ?>
    </table>
</div>
</section>
</body>


<script>
    function valide_emprunteur() {
        tmp=document.getElementById("f1pseudo").value;
        if (tmp==''){
            document.getElementById("f1error").style.display="block";
        }
        else {
            document.getElementById("validerf1").click();
        }
    }


    function valide_formulaire() {
        tmpidlivre=document.getElementById("f2idlivre").value;
        tmptitre=document.getElementById("f2titre").value;
        tmppseudo=document.getElementById("f2pseudo").value;
        if (tmpidlivre=='' || tmptitre=='' || tmppseudo=='') {
            document.getElementById("f2error").style.display="block";
        }
        else {
            document.getElementById("validerf2").click();
        }
    }

    function affichetable() {
        if (document.getElementById("displaytable").style.display=="none") {
            document.getElementById("displaytable").style.display="block";
        }
        else {
            document.getElementById("displaytable").style.display="none";
        }
    }
</script>

</html>

