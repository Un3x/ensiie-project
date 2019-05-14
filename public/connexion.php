<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="prrr.css" />
</head>
<body>
<header>
    ManAdvisor
</header>
<h2 style="text-align:center; color:blue">Un clic, une note!</h2>
<br/>
<form action="verification.php" method="post" class="form-style">
    <h2 style="text-align:center"> Authentification</h2>
    <p>
        <input type="text" size="50" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo"  />
    </p>
    <p>
        <input type="password" size="50" name="mdp" id="mdp" placeholder="Entrez Votre mot de passe" />
    </p>
    <br/>
    <input type="submit" value="Se connecter" />
    <input type="reset" value="Annuler" />

    <?php
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        if($err==1 || $err==2)
            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect. Réessayez!</p>";
    }
    ?>
</form>

</body>
</html>