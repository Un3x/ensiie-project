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
$userRepository = new \User\UserRepository($connection);
$auteurs = $auteurRepository->fetchAll();
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
    <link rel="stylesheet" href="formulaire.css">
    <title>Page d'ajout de livre</title>
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
<div class="container">
<div class="grand-titre">Page d'ajout de livre</div>
<form id="form_ajout_livre" action="ajout_livre.php" method="POST">
    Titre<br>
    <input class="formulaire" id="titre" type="text" name="titre" required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="70"/>
    <br>Auteur<br>
    <input class="formulaire" id="auteur" type="text" name="auteur1" required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/>
        
    <br>
    <a id="1" style="display:none">Auteur 2<br>
    <input class="formulaire" type="text" name="auteur2" pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br></a>

    <a id="2" style="display:none" >Auteur 3<br>
    <input class="formulaire" type="text" name="auteur3" pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br></a>

    <a id="3" style="display:none" >Auteur 4<br>
    <input class="formulaire" type="text" name="auteur4" pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br></a>

    <a id="4" style="display:none" >Auteur 5<br>
    <input class="formulaire" type="text" name="auteur5" pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br></a>

    <a id="5" style="display:none" >Auteur 6<br>
    <input class="formulaire" type="text" name="auteur6" pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br></a>

    <input class="formulaire" id="butt" type="button" class="input" onclick="ajoute_aut()" value="+">

    <br>Date de publication<br>
    <input class="formulaire" id="date" type="date" name="datepub" required/>
    
    <br>Image de couverture<br>
    <input class="formulaire" id="img" type="text" name="image"/ required maxlength="200">
   
    <br>Edition<br>
    <input class="formulaire" id="edition" type="text" name="edition" required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/>
    <br>
    <input class="formulaire" id="formSubmit" type="submit" class="butcon" value="Valider"/>
</form>
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

    

</script>
    
