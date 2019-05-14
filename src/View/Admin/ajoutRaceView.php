<?php $title = "Accès Admin! " ?>

<?php ob_start(); ?>

<form action="/ajoutRaceAdmin" method="POST">
    <label for="name"> Nom :</label>
    <input type="text" name="nom" id="name"/>
    <br/>
    <br/>
    <label for="vitesse"> Vitesse : </label>
    <input type="number" name="vitesse" id ="vitesse"/>
    <br/>
    <br/>
    <label for="capacite"> Capacité : </label>
    <input type="number" name="capacite" id ="capacite"/>
    <br/>
    <br/>
    <br/>
    <input type="submit" value="Ajouter cette race"/>
    <br/>
    <br/>
    <br/>
</form>

<?php $content = ob_get_clean(); ?>


<?php require "../src/View/template.php"; ?>
