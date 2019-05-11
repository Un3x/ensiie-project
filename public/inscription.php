<?php

include ("utils.php");

require '../vendor/autoload.php';

session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

$ok_pseudo = true;
$ok_nom = true;
$ok_mdp = true;

if (isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['pseudo'])&&isset($_POST['mdp'])&&isset($_POST['cmdp'])&&isset($_POST['ddn'])&&isset($_POST['email'])) {
    
    if (!verifPseudo($_POST['pseudo'])) {
        $ok_pseudo=false;
        echo "Ce pseudo existe déjà !";
    }
    if (!verifNomPrenom($_POST['nom'], $_POST['prenom']) ) {
        $ok_nom=false;
        echo "Quelqu'un vous a usurpé ! Cette combinaison Nom, Prénom existe déjà !";
    }
    if ($_POST['mdp'] != $_POST['cmdp']) {
        $ok_mdp=false;
    }
    if ($ok_pseudo && $ok_nom && $ok_mdp) {
        $tmpid = genereIdUser();
        $newUser = $userRepository->creeUser($tmpid, $_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['ddn'], $_POST['mdp'], $_POST['email'], '0', '0', 'false');
        $userRepository->insertUser($newUser);

        $_SESSION['id_user']=$tmpid;

        header("Location: index.php");
    }
}

?>

<html>
<head>
     <meta charset="utf-8"/>
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="formulaire_small.css">
</head>
<body>
     <!--ALED TODO mettre le logo de sciience comme dans toutes les autres pages ainsi qu\'une petite page de garde sympathique-->
     <h2>Bienvenue sur la page d\'inscription de Sciience</h2>
     <nav>
         <!-- TODO recopier le nav-->
    </nav>';

    
    <section class="connect">
        <form class="form"action="inscription.php" method="POST">
            Nom :<br>
            <input class="formulaire" type="text" name="nom" required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br>
            Prenom :<br>
            <input class="formulaire" type="text" name="prenom" required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br>
            Pseudo :<br>
            <input class="formulaire" type="text" name="pseudo" required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br>
            Mot de passe :<br>
            <input class="formulaire" id="m1" type="password" name="mdp" required /><br>
            Confirmation du mot de passe :<br>
            <input class="formulaire" id="m2" type="password" name="cmdp" oninput="check(this)" required /><br>
            Date de naissance :<br>
            <input class="formulaire" type="date" name="ddn" required /><br>
            Email :<br>
            <input class="formulaire" type="text" name="email" required pattern="[a-zA-Z0-9._-]*@[a-zA-Z0-9-]*.[a-zA-Z]*" maxlength="50"/><br>
            <input class="formulaire" id="valider" type="submit" value="Valider"/>
        </form>
    </section>

</body>



<script>
    

    function check_mdp(input) {
        if (input.value != document.getElementById('m1').value) {
            input.setCustomValidity('Les deux mots de passe doivent être identiques.');
        } else {
            input.setCustomValidity('');
        }
    }
</script>

</html>