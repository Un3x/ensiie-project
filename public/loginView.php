<?php
session_start();
$title = "Meetiie - Login";
$css_link = '<link rel="stylesheet" type="text/css" href="css/loginStyle.css"/>';

require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();

if(isset($_POST['submit_button']))
{

    //Retrieve email and password values in $email_form and $mdp
    $email_form = $_POST['email'];
    $pwd = $_POST['password'];

    //Retrieve firstname and lastname corresponding the email above, from the database
    $requete = "SELECT firstname, lastname FROM member WHERE email='$email_form'";
    $q = $connection->query($requete);
    $row = $q->fetch();
    $firstname_form=$row['firstname'];
    $lastname_form=$row['lastname'];

    //Il faut utiliser le commentaire en-dessous au lieu de $connection->query
    /*$q = $connection->prepare($requete);
    $q->execute();*/

    //Vérifier si le mot de passe est bien saisi pour éviter le SQL-Injection
    if(!isset($pwd))
    {die("Veuillez entrer votre mot de passe !");}

    //Vérifier que le hashage correspond au mot de passe saisi

    if($model->verif_mdp($email_form, $pwd))
    {
        //Il faut decrypter le password avant de le passer a verif_mdp


        //Appel de config() pour sauvegarder le mot de passe dans la variable de session
        $model->config($email_form, $lastname_form, $firstname_form, $pwd);
        $_SESSION['email']=$email_form;                 //essayer de supprimer ces 4 lignes si c'est possible
        $_SESSION['lastname']=$lastname_form;
        $_SESSION['firstname']=$firstname_form;
        $_SESSION['password']=$pwd;
        //header("Location:accueil.php");
        header('Location: accueil.php');
        exit();
    }
    else
    {	//echo "<div id='error_msg'>Email/Mot de passe incorrect !</div>";
        //echo "Email/Mot de passe incorrect !";
        //exit();

        print "<div class='form'><h3>Email or password incorrect !</h3></div>";

        /*Il faut essayer de l'afficher en-dessous du champ de password dans la page login, voir favori (log out user de awa)*/
    }
}
?>


<?php ob_start(); ?>

<div class="connexion">

        <h1>Meetiie</h1>

        <span id="conn">Connexion</span><br/><br>

    <form role="form" method="POST" enctype="multipart/form-data">
         <input type="email" name="email" placeholder="Adresse e-mail" size="30" required><br/>
         <input type="password" name="password" placeholder="Mot de passe" size="30" required><br/>
         <input type="submit" name="submit_button" value="Login"><br/>
    </form><br>

    <a href="pwdForgottenView.php">Mot de passe oublié ?</a><br/>
    <a href="signupView.php" title="Découvrez de nouveaux iiens">Créer un compte</a><br>
</div>

<?php $content = ob_get_clean();

require('template.php'); ?>
