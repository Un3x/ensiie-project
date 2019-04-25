<?php

include ("utils.php");

require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();


if (!(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['pseudo'])&&isset($_POST['mdp'])&&isset($_POST['cmdp']))) {
    echo '<html>
<head>
     <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
     <!--ALED TODO mettre le logo de sciience comme dans toutes les autres pages ainsi qu\'une petite page de garde sympathique-->
     <h2>Bienvenue sur la page d\'inscription de Sciience</h2>
     <nav>
         <!-- TODO recopier le nav-->
    </nav>';
    
     echo '<form action="inscription.php" method="POST">
        Nom (obligatoire) :<br>
        <input type="text" name="nom"/><br>
        Prenom (obligatoire) :<br>
        <input type="text" name="prenom"/><br>
        Pseudo (obligatoire) :<br>
        <input type="text" name="pseudo"/><br>
        Mot de passe (obligatoire) :<br>
        <input id="m1" type="password" name="mdp"/><br>
        Confirfation (obligatoire) :<br>
        <input id="m2" type="password" name="cmdp"/><br>
        Date de naissance :<br>
        <input type="text" name="ddn"/><br>
        Email :<br>
        <input type="text" name="email"/><br>
        <input type="hidden" name="pass" value="OK">
        <input type="button" class="input" onclick="testmdp()" value="Valider"/>
        <input id="valider" style="display:none" type="submit" class="Input" value="Valider"/>
     </form>
     <p id="mdp_inc" style="display:none">Mot de passe incorrect</p>
</body>';// vérifier la validité des champs avec javascript
}

elseif (!(verifNomPrenom($_POST['nom'], $_POST['prenom'])) || !(verifPseudo($_POST['pseudo']))) {
    echo '<html>
<head>
     <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href=".css">
</head>
<body>
     <!--ALED TODO mettre le logo de sciience comme dans toutes les autres pages ainsi qu\'une petite page de garde sympathique-->
     <h2>Bienvenue sur la page d\'inscription de Sciience</h2>
     <nav>
         <!-- TODO recopier le nav-->
    </nav>';
    if (!(verifNomPrenom($_POST['nom'], $_POST['prenom']))) {
        echo '<p> utilisateur déjà existant (couple nom, prenom) </p>';
    }
    if (!(verifPseudo($_POST['pseudo']))) {
        echo '<p>pseudo déjà utilisé</p>';
    }
    echo '<form action="inscription.php" method="POST">
        Nom (obligatoire) :<br>
        <input type="text" name="nom"/><br>
        Prenom (obligatoire) :<br>
        <input type="text" name="prenom"/><br>
        Pseudo (obligatoire) :<br>
        <input type="text" name="pseudo"/><br>
        Mot de passe (obligatoire) :<br>
        <input id="m1" type="password" name="mdp"/><br>
        Confirfation (obligatoire) :<br>
        <input id="m2" type="password" name="cmdp"/><br>
        Date de naissance :<br>
        <input type="text" name="ddn"/><br>
        Email :<br>
        <input type="text" name="email"/><br>
        <input type="hidden" name="pass" value="OK">
        <input type="button" class="input" onclick="testmdp()" value="Valider">
        <input id="valider" style="display:none" type="submit" class="Input" value="Valider"/>
     </form>
     <p id="mdp_inc" style="display:none">Mot de passe incorrect</p>
</body>';// TODO vérifier la validité des champs avec javascript  
}

else {
    $tmpid = genereIdUser();
    $newUser = $userRepository->creeUser($tmpid, $_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['ddn'], $_POST['mdp'], $_POST['email'], '0', '0', 'false');//TODO hashage du mdp
    $userRepository->insertUser($newUser);
    header("Location:index.php");
}
?>

<script>
    function testmdp() {
        tmp1=document.getElementById("m1").value;
        tmp2=document.getElementById("m2").value;
        if (tmp1!=tmp2 || tmp1=='') {
            document.getElementById("mdp_inc").style.display="block";
        }
        else {
            document.getElementById("valider").click();
        }
    }
</script>

</html>