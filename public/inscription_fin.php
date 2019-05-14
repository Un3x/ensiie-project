<?php
session_start();
$pseudo=$_SESSION['pseudo'];
$nom=$_SESSION['nom'];
$prenom=$_SESSION['prenom'];
$ville=$_SESSION['ville'];
$region=$_SESSION['region'];


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe </title>
    <link rel="stylesheet" type="text/css" href="prrr.css" />
</head>
<body>
<header>
    ManAdvisor
</header>
<br/>
<?php echo"<h2 style='text-align: center; color:blue'>Allez $pseudo! On y est presque!</h2>"?>
<p style="text-align: center; color:red"><em>Un mot de passe solide, c'est au moins 3 chiffres, 4 lettres et 1 caractère spécial!</em></p>
<br/>
<?php if(isset($_GET['erreur'])){
    $err = $_GET['erreur'];
    if($err==1 || $err==2)
        echo "<p style='color:red; text-align: center'>Oups! Les champs sont mal remplis!</p>";
}
?>
<form action="controle_inscription.php" method="post" onsubmit="return verifMdpidentique(this.mdp,this.mdpp)" class="form-style">
    <h2>Etape 2: Votre mot de passe</h2>
    <p>
        <input type="password"  name="mdp" placeholder="Votre mot de passe" onBlur="verifMdp(this)" />
    </p>
    <br/>
    <p>
        <input type="password"  name="mdpp" placeholder="Confirmation de votre mot de passe" />
    </p>
    <br/>
    <input type="submit" value="S'inscrire" />
    <input type="reset" value="Annuler" />


</form>
<script type="text/javascript" src="verification.js"></script>
</body>
</html>