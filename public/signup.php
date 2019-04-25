<!DOCTYPE html>
<html>
    <?php require('../src/components/head.php');?>
    <body>
        <main id="disconnected">
            <div class="container">
                <?php require('../src/components/navbar_connection.php');?>
            </div>
            <svg id="curve" preserveAspectRatio="none" width="1450" height="160" viewBox="0 0 1450 160" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g>
                <path d="M 0 160L 0 0C 552.762 3.38469e-14 829.144 157.977 1450 157.977L 1450 160L 0 160Z"/>
                </g>
            </svg>
            <div class="container">
                <div class="sign-container" id="signup-container">
                    <h1>Inscription</h1>
                    <form class="sign" id="signup">
                        <div id="signup-form">
                            <input type="text" placeholder="Nom" name="lname" required>
                            <input type="text" placeholder="Prénom" name="fname" required>
                            <input type="email" placeholder="E-mail" name="email" required>
                            <input type="password" placeholder="Mot de passe" name="pwd" required>
                            <input type="password" placeholder="Confirmation du mot de passe" name="validpwd" required>
                            <input type="text" placeholder="Code d'activation" name="activcode" required>                          
                        </div>
                        <button class="button" type="submit">Créer un compte</button><br/>
                    </form>
                </div>
            </div>
        </main>
        <?php require('../src/components/footer.php'); ?>
    </body>
</html>