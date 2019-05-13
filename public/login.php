<?php session_start();?>
<?php require '../src/controlers/loginControler.php';?>
<!DOCTYPE html>
<html>
    <?php require '../src/components/head.php';?>
    <body>
        <header id="disconnected">
            <div class="container">
                <?php require '../src/components/navbar_connection.php';?>
            </div>
            <svg class="curve" preserveAspectRatio="none" width="1450" height="160" viewBox="0 0 1450 160" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g>
                <path d="M 0 160L 0 0C 552.762 3.38469e-14 829.144 157.977 1450 157.977L 1450 160L 0 160Z"/>
                </g>
            </svg>
            <div class="container">
                <div class="sign-container">
                    <h1>Connexion</h1>
                    <form class="sign" method="post" action="./login.php">
          <div id="login-form">
            <label for="email"><img class="sign-icon" src="img/mail.png" /></label>
            <input type="email" placeholder="Email" name="email" required>
            <label for="pwd"><img class="sign-icon" src="img/lock.png"></label>
            <input type="password" placeholder="Mot de passe" name="pwd" required>
          </div>
          <?php
            if (array_key_exists('testco', $_SESSION)) {
                if (isset($_SESSION['testco'])) {
                    echo '<p class="sign-msg">Identifiants invalides</p>';
                }
            }
          ?>
          <button class="button" type="submit">Se connecter</button><br />
          <a href="#">Mot de passe oublié?</a>
        </form>
                </div>
            </div>
        </header>
        <?php require '../src/components/footer.php';?>
    </body>
</html>