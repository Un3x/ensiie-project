<?php

include ("utils.php");


require '../vendor/autoload.php';

session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$livreRepository = new \Livre\LivreRepository($connection);
$livres = $livreRepository->fetchAll();
$auteurRepository = new \Auteur\AuteurRepository($connection);
$auteurs = $auteurRepository->fetchAll();

// ajouter une redirection automatique si l'utilisateur n'est pas admin
if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
}
if (!(verifAdmin($_SESSION["id_user"]))) {
    header("Location: index.php");
}


if (isset($_POST['titre']) && isset($_POST['datepub']) && isset($_POST['image']) && isset($_POST['edition']) && isset($_POST['auteur1'])) {
    if (verifTitre($_POST['titre'])) {
        $new_idlivre=genereIdLivre();
        $tmp=$livreRepository->creeLivre($new_idlivre, $_POST['titre'], $_POST['auteur1'], $_POST['datepub'], $_POST['image'], $_POST['edition'], '', '');
        //modifier l'id de l'emprunteur de base non c'est bon je l'ai mis à null dans la fonction d'insertion

        $livreRepository->insertLivre($tmp);
        $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur1']);
        $auteurRepository->insertAuteur($tmp);
        if ($_POST['auteur2']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur2']);
            $auteurRepository->insertAuteur($tmp);
        }
        if ($_POST['auteur3']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur3']);
            $auteurRepository->insertAuteur($tmp);
        }
        if ($_POST['auteur4']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur4']);
            $auteurRepository->insertAuteur($tmp);
        }
        if ($_POST['auteur5']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur5']);
            $auteurRepository->insertAuteur($tmp);
        }
        if ($_POST['auteur6']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur6']);
            $auteurRepository->insertAuteur($tmp);
        }

        header("Location: index.php");
    }
}

?>
<html>
<head>
<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href=".css">
    <title>Page d'ajout de livre</title>
</head>
    <body>
    <div class="container">
    <h2>Page d'ajout de livre (Réservé aux Admins)</h2>
    <form action="ajout_livre.php" method="POST">
    Titre<br>
    <input id="titre" type="text" name="titre"/><br>
    Auteur<br>
    <input id="auteur" type="text" name="auteur1"/><br>

    <a id="1" style="display:none">Auteur 2<br>
    <input type="text" name="auteur2"/><br></a>

    <a id="2" style="display:none">Auteur 3<br>
    <input type="text" name="auteur3"/><br></a>

    <a id="3" style="display:none">Auteur 4<br>
    <input type="text" name="auteur4"/><br></a>

    <a id="4" style="display:none">Auteur 5<br>
    <input type="text" name="auteur5"/><br></a>

    <a id="5" style="display:none">Auteur 6<br>
    <input type="text" name="auteur6"/><br></a>

    <input id="butt" type="button" class="input" onclick="ajoute_aut()" value="+"><br>
    Date de publication<br>
    <input id="date" type="text" name="datepub"/><br>
    Image de couverture<br>
    <input id="img" type="text" name="image"/><br>
    Edition<br>
    <input id="edition" type="text" name="edition"/><br>
    <input type="button" class="input" onclick="test_valid()" value="Valider">
    <input id="valider" style="display:none" type="submit" class="Input" value="Valider"/>
</form>
<p id="incomplet" style="display:none">Veuillez remplir correctement tous les champs</p>
</body>
</html>
    
<script>
    var nb_click=1;

    function ajoute_aut() {
        document.getElementById(nb_click.toString()).style.display="block";
        if (nb_click>=5) {
            document.getElementById("butt").style.display="none";
        }
        nb_click=nb_click+1;
    }

    function test_valid() {
        tmptitre=document.getElementById("titre").value;
        tmpauteur=document.getElementById("auteur").value;
        tmpdate=document.getElementById("date").value;
        tmpimg=document.getElementById("img").value;
        tmpedition=document.getElementById("edition").value;
        if (tmptitre=='' || tmpauteur=='' || tmpdate=='' || tmpimg=='' || tmpedition=='') {
            document.getElementById("incomplet").style.display="block";
        }
        else {
            document.getElementById("valider").click();
        }
    }

</script>
    
    
