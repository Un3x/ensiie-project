  <html>
    <head>
    <title>Inscription</title>
	<link rel="stylesheet" href="/assets/css/main.css" media="screen" type="text/css" />
    </head>

    <body>
    <div id="page-wrapper">
    <h1> Inscription à l'espace utilisateur :</h1><br />
    <form action="register.php" method="post">
    <label><b>Adresse Mail :</b></label> <input type="text" placeholder="Entrer votre mail" name="email" value="<?php if (isset($_POST['email'])) echo htmlentities(trim($_POST['email'])); ?>"required><br />
    <label><b>Mot de passe :</b></label> <input type="password" placeholder="Entrer votre mot de passe" name="mdp" value="<?php if (isset($_POST['mdp'])) echo htmlentities(trim($_POST['mdp'])); ?>"required><br />
    <label><b>Confirmation du mot de passe :</b></label> <input type="password" placeholder="Entrer votre mot de passe à nouveau" name="mdp_confirm" value="<?php if (isset($_POST['mdp_confirm'])) echo htmlentities(trim($_POST['mdp_confirm'])); ?>"required><br />
    <input type="submit" name="inscription" value="Inscription">
    </form>
    <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1)
                        echo "<p style='color:red'>Cette adresse mail est déjà utilisée</p>";
                }
                ?>
          </div>
    </body>
 </html>