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
<br/>
<h2 style="text-align: center; color:blue">Une Vaste communauté vous attend!</h2>
<br/>
<?php if(isset($_GET['erreur'])){
    $err = $_GET['erreur'];
    if($err==1 || $err==2)
        echo "<p style='color:red; text-align: center'>Le pseudo est déjà pris!En choisir un autre!</p>";
}
?>
<form action="trait_inscrip.php" method="post" onsubmit="return verifFormIdentite(this)" class="form-style">
    <h2 style="text-align: center">Etape 1 : Votre identité</h2>
    <p>
        <input type="text" size="20" name="pseudo"  placeholder="Pseudo" onBlur=" verifPseudo(this)" />
        <span class="criteres">*Entre 3 et 20 caractères</span>
    </p>
    <br/>
    <p>
        <input type="text" size="20" name="prenom"  placeholder="Prénom" onBlur="verifPrenom(this)" />
        <span class="criteres">*Entre 1 et 200 caractères</span>
    </p>
    <br/>
    <p>
        <input type="text" size="20" name="nom"  placeholder="Nom" onBlur="verifNom(this)"/>
        <span class="criteres">*Entre 1 et 200 caractères</span>
    </p>
    <br/>
    <p>
        <input type="text" size="20" name="ville" id="ville" placeholder="Ville" onBlur="verifVille(this)"/>
        <span class="criteres">*Entre 1 et 500 caractères</span>
    </p>
    <br/>
    <p>
        Région :
        <select name="region">
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
            <option value="Occitani">Occitanie</option>
            <option value="Outre-mer">Outre-mer</option>
            <option value="Pays de la Loire">Pays de la Loire</option>
            <option value="Provence-Alpes-Côte d'Azur">Provence-Alpes-Côte d'Azur</option>
        </select>
    </p>
    <br/>
    <p>
        Sexe:
        <select name="sexe">
            <option value="M">Masculin</option>
            <option value="F">Féminin</option>
        </select>
    </p>
    <input type="submit" value="S'inscrire" />
    <input type="reset" value="Annuler" />


</form>
<script type="text/javascript" src="verification.js"></script>
</body>
</html>