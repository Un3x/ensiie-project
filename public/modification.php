<?php
    session_start();
    $pseudo=$_SESSION['pseudo'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="prrr.css" />
</head>
<body>
<header>
    ManAdvisor
</header>
<nav>
    | <a href="deconnexion_user.php" class="nv">Déconnexion</a> | <a href="profil.php" class="nv">Mon Profil</a> | <a href="modification.php" class="nv">Modifier mon Profil</a> | <a href="recherche.php" class="nv">Rechercher|</a>
</nav>
<h2 style="text-align: center; color: blue">En avant le ménage!</h2>
<br/>
<?php if(isset($_GET['arg1'])&& isset($_GET['arg2']) && isset ($_GET['arg3']) && isset ($_GET['arg4'])&& isset ($_GET['arg5'])&& isset ($_GET['arg6'])){
    require 'controle2_modification.php';
    $arg1=$_GET['arg1'];$arg2=$_GET['arg2'];$arg3=$_GET['arg3'];$arg4=$_GET['arg4'];$arg5=$_GET['arg5'];$arg6=$_GET['arg6'];
    modification($arg1,$arg2,$arg3,$arg4,$arg5,$arg6);
    echo "<p style='color:red; text-align: center'>Super! Profil mis à jour!</p>";
}
?>
<form action="controle1_modification.php" method="post" class="form-style">
    <h2 style="text-align: center">Que veux-tu modifier <?php echo $pseudo; ?> ?</h2>
    <p>
        <input type="text" size="20" name="nprenom" id="nprenom" placeholder="Entrez cotre nouveau prénom" "/>
    </p>
    <p>
        <input type="text" size="20" name="nnom" id="nnom" placeholder="Entrez votre nouveau nom"/>
    </p>
    <p>
        Région :
        <select name="nregion">
            <option value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
            <option value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
            <option value="Bretagne">Bretagne</option>
            <option value="Centre-Val de Loire">Centre-Val de Loire</option>
            <option value="Corse">Corse</option>
            <option value="Grand Est">Grand Est</option>
            <option value="Hauts-de-France">Hauts-de-France</option>
            <option value="Île-de-France">Île-de-France</option>
            <option value="Normandie">Normandie</option>
            <option value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
            <option value="Occitanie">Occitanie</option>
            <option value="Outre-mer">Outre-mer</option>
            <option value="Pays de la Loire">Pays de la Loire</option>
            <option value="Provence-Alpes-Côte d'Azur">Provence-Alpes-Côte d'Azur</option>
        </select>
    </p>
    <p>
        <input type="text" size="20" name="nville" id="ville" placeholder="Entrez votre nouvelle ville" />
    </p>
    <br/>
    <p>
        <input type="text" size="20" name="nphrase" id="nphrase" placeholder="Entrez votre nouvelle phrase culte" "/>
    </p>
    <br/>
    <p>
        <input type="text" size="50" name="nmdp" id="nmdp" placeholder="Entrez votre nouveau mot de passe" />
    </p>
    <br/>
    <input type="submit" value="Modifier" name="m" />
    <input type="reset" value="Annuler" />


</form>
</body>
</html>