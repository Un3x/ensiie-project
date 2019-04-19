<?php $title = "Meetiie - Login"; 
$css_link = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/loginStyle.css\"/>";

echo $css_link;
?>


<?php ob_start(); ?>
<div class="connexion" onload="clear_form()">
        <h1>Meetiie</h1>
         <span id="conn">Connexion</span><br/>
         <form action="checkPwd.php" method="POST">
         <input type="email" name="email" placeholder="Adresse e-mail" size="35"required><br/>
         <input type="password" name="password" placeholder="Mot de passe" size="35"required><br/>
         <input type="submit" value="Login" onClick="clear_form()"><br/>
         </form><br>
         <a href="pwdForgottenView.php">Mot de passe oublié ?</a><br/>
         <a href="signup.php" title="Découvrez de nouveaux iiens">Créer un compte</a><br>
         </div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>