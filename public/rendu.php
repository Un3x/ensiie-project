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
    <link rel="stylesheet" href=".css">
</head>
<body>
    <h2> Page de rendu  des livres (réservé aux admins)</h2>
    <nav>
         <!-- TODO recopier le nav-->
    </nav>
    <a href="index.php">TMPretour</a>
    <h2>Rendu des livres</h2>

    <?php 
    if (isset($okpseudo) && !($okpseudo)) {
        echo "<p>Pseudo invalide</p>";
    }
    ?>

    <form action="rendu.php" method="POST">
        Pseudo :<br>
        <input id="f1pseudo" type="text" name="pseudo"><br>
        <input type="button" class="input" onclick="valide_pseudo()" value="Valider">
        <input id="validerf1" style="display:none" type="submit" name="Envoyer">
    </form>
    <p id="f1error" style="display:none">Veuillez remplir le champ</p>

    <!--TODO mettre à jour "livre emprunt", "histo", "Livre", "User"-->
    <?php if (isset($okpseudo) && $okpseudo) : ?>
        <p id="displaytable">
            <h3>Liste des livres empruntés par <?php echo $_POST['pseudo']; ?></h3>
            <table class="table table-bordered table-hover table-striped">
                <thead style="font-weight: bold">
                    <td>#</td>
                    <td>titre</td>
                    <td>emprunteur</td>
                    <td>rendre</td>
                </thead>
        <?php 
        $livresarendre=$livreRepository->fetchByUser(PseudoToId($_POST['pseudo']));
        foreach ($livresarendre as $livre) : ?>
            <tr>
                <td><?php echo $livre->getId() ?></td>
                <td><?php echo $livre->getTitre() ?></td>
                <td><?php if ($livre->getEmprunteur() !='') echo IdToPseudo($livre->getEmprunteur()) ?></td>
                <td>

                    <form action="rendu.php" method="POST">
                        <input style="display:none" type="text" name="pseudo" value=<?php echo $_POST['pseudo'] ?>>
                        <input style="display:none" type="text" name="id_livre" value=<?php echo $livre->getId(); ?>>
                        <input type="submit" name="Valider" value="Valider">
                    </form>
        <? endforeach; ?>
    </table>
</p>
    <?php endif; ?>
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
