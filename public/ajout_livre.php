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
        $tmp=$livreRepository->creeLivre($new_idlivre, htmlspecialchars($_POST['titre'], $flags = ENT_QUOTES), $_POST['auteur1'], $_POST['datepub'], $_POST['image'], $_POST['edition'], '', '');
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
    <link rel="stylesheet" href="style.css">
    <title>Page d'ajout de livre</title>
</head>
<body>
<section>
<div class="container">
<h2>Page d'ajout de livre (Réservé aux Admins)</h2>
<form id="form_ajout_livre" action="ajout_livre.php" method="POST">
    Titre<br>
    <input id="titre" type="text" name="titre" required pattern="[a-zA-Z0-9']*" maxlength="70"/>
    <a id="error_titre" style="display:none"> Erreur </a>
    <br>Auteur<br>
    <input id="auteur" type="text" name="auteur1" required pattern="[a-zA-Z0-9']*" maxlength="50"/>
    <a id="error_auteur" style="display:none"> Erreur </a>
    
    <br>
    <a id="1" style="display:none" pattern="[a-zA-Z0-9']*" maxlength="50">Auteur 2<br>
    <input type="text" name="auteur2"/><br></a>

    <a id="2" style="display:none" pattern="[a-zA-Z0-9']*" maxlength="50">Auteur 3<br>
    <input type="text" name="auteur3"/><br></a>

    <a id="3" style="display:none" pattern="[a-zA-Z0-9']*" maxlength="50">Auteur 4<br>
    <input type="text" name="auteur4"/><br></a>

    <a id="4" style="display:none" pattern="[a-zA-Z0-9']*" maxlength="50">Auteur 5<br>
    <input type="text" name="auteur5"/><br></a>

    <a id="5" style="display:none" pattern="[a-zA-Z0-9']*" maxlength="50">Auteur 6<br>
    <input type="text" name="auteur6"/><br></a>

    <input id="butt" type="button" class="input" onclick="ajoute_aut()" value="+">
    <br>Date de publication<br>
    <input id="date" type="date" name="datepub" required/>
    <a id="error_date" style="display:none"> Erreur </a>
    <br>Image de couverture<br>
    <input id="img" type="text" name="image"/ required maxlength="200">
    <a id="error_img" style="display:none"> Erreur </a>
    <br>Edition<br>
    <input id="edition" type="text" name="edition" required pattern="[a-zA-Z0-9']*" maxlength="50"/>
    <a id="error_edition" style="display:none"> Erreur </a>
    <br>
    <input type="submit" value="Valider"/>
</form>
<p id="incomplet" style="display:none">Veuillez remplir correctement tous les champs</p>
</section>
</body>
</html>
    
<script type="text/javascript">
    var nb_click=1;

    function afficher(frm){
        alert("Vous avez tapé : " + frm.elements['auteur'].value)
    }

    function ajoute_aut() {
        document.getElementById(nb_click.toString()).style.display="block";
        if (nb_click>=5) {
            document.getElementById("butt").style.display="none";
        }
        nb_click=nb_click+1;
    }

    function form_valid() {
        valide = true;
        alert("controle en cours");
        regex = /[^a-zA-Z0-9]/
        form = document.forms['form_ajout_livre']; 
        titre = form.elements['titre'].value;
        auteur = form.elements['auteur'].value;
        date = form.elements['date'].value;
        img = form.elements['img'].value;
        edition = form.elements['edition'].value;

        if (titre=='') {
            valide = false;
            document.getElementById("error_titre").style.display="inline";
            document.getElementById("error_titre").innerHTML="Le champ doit être non vide.";
        } 
        else if (titre.length > 70) {
            valide = false;
            document.getElementById("error_titre").style.display="inline";
            document.getElementById("error_titre").innerHTML="La saisie ne doit excéder 70 caractères.";
        } 
        else if (regex.test(titre)) {
            valide = false;
            document.getElementById("error_titre").style.display="inline";
            document.getElementById("error_titre").innerHTML="La saisie comporte des caractères spéciaux.";
            alert("Niktarace");
       }
        if (auteur=="") {
            valide = false;
            alert("Niktarace");
        }
        if (titre=='' || auteur=='' || date=='' || img=='' || edition=='') {
            valide = false;
            document.getElementById("incomplet").style.display="block";           
            document.getElementById("error_auteur").style.display="inline";
            document.getElementById("error_date").style.display="inline";
            document.getElementById("error_img").style.display="inline";
            document.getElementById("error_edition").style.display="inline";
        }
        return valide;
    }

</script>
    
<style>

:invalid { 
  background-color: #F0DDDD;
  border-color: #e88;
  -webkit-box-shadow: 0 0 5px rgba(255, 0, 0, .8);
  -moz-box-shadow: 0 0 5px rbba(255, 0, 0, .8);
  -o-box-shadow: 0 0 5px rbba(255, 0, 0, .8);
  -ms-box-shadow: 0 0 5px rbba(255, 0, 0, .8);
  box-shadow:0 0 5px rgba(255, 0, 0, .8);
}

:required {
  border-color: black;
  -webkit-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  -moz-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  -o-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  -ms-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  box-shadow: 0 0 5px rgba(0, 0, 255, .5);
}

form {
  width:300px;
  margin: 20px auto;
}

input {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  border:1px solid #ccc;
  font-size:20px;
  width:300px;
  min-height:30px;
  display:block;
  margin-bottom:15px;
  margin-top:5px;
  outline: none;

  -webkit-border-radius:5px;
  -moz-border-radius:5px;
  -o-border-radius:5px;
  -ms-border-radius:5px;
  border-radius:5px;
}
</style>