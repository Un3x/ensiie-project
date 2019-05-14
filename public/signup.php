<?php session_start();?>
<?php require '../src/controlers/signupControler.php';?>
<!DOCTYPE html>
<html>
    <?php require('../src/components/head.php');?>
    <body>
        <header id="disconnected">
            <div class="container">
                <?php require('../src/components/navbar_connection.php');?>
            </div>
            <svg class="curve" preserveAspectRatio="none" width="1450" height="160" viewBox="0 0 1450 160" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g>
                <path d="M 0 160L 0 0C 552.762 3.38469e-14 829.144 157.977 1450 157.977L 1450 160L 0 160Z"/>
                </g>
            </svg>
            <div class="container">
                <div class="sign-container" id="signup-container">
                    <h1>Inscription</h1>
                    <form class="sign" id="signup" onSubmit = "return checkMdp(this)" action="signup.php" method="post">
                        <div id="signup-form">
                            <input type="text" placeholder="Nom" name="lname" required>
                            <input type="text" placeholder="Prénom" name="fname" required>
                            <input type="email" placeholder="E-mail" name="email" required>
                            <input type="password" minlength="6" maxlength="50" placeholder="Mot de passe" name="pwd" required>
                            <input type="password" placeholder="Confirmation du mot de passe" name="validpwd" required>
                            <input type="text" placeholder="Code d'activation" name="activcode" required>                          
                        </div>
                        <script type="text/javascript" src="jquery.min.js"></script>
                        <script type="text/javascript">
                        function checkMdp(form) {
                            pwd1=form.pwd.value;
                            pwd2=form.validpwd.value;
                            if (pwd1 != pwd2){
                                alert("Mots de passe différents, vérifiez la saisie.");
                                return false;
                            } else {
                                return true;
                            }
                        }
                        </script>
                        <button class="button" type="submit">Créer un compte</button><br/>
                    </form>
                </div>
            </div>
        </header>
        <?php require('../src/components/footer.php'); ?>
    </body>
</html>