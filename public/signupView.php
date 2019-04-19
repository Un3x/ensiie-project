<?php $title = "Meetiie - Signup";
$css_link = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/loginStyle.css\"/>";

echo $css_link;
?>


<?php ob_start(); ?>
<div class="connexion">
    <h1>Meetiie</h1>
    <span id="conn">Créer votre compte Meetiie !</span><br/><br/>
    <form action="registration.php" method="POST">
        <input type="text" name="prenom" placeholder="Prénom" size="20" required><br>
        <input type="text" name="nom" placeholder="Nom" size="20"required><br/><br/>
        <input type="email" name="email" placeholder="Username@ensiie.fr" onload="clear_form()"size="48" required><br><br>
        <input type="password" name="password" placeholder="Mot de passe" size="48" required><br><br>
        <input type="submit" name="submit_btn" value="S'inscrire"><br/>
    </form><br>
</div><br>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
