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
    $requete = "SELECT firstname, lastname, email, password FROM member WHERE email='$email_form' AND password='$pwd'";
    $q = $connection->query($requete);
    $row = $q->fetch();
    $firstname_form=$row['firstname'];
    $lastname_form=$row['lastname'];

    if ($_POST["email"]!="" && $_POST["password"]!=""){
    if($model->verif_mdp($email_form, $pwd))
    {


        //Call config() in order to save the password into the session variable
        $model->config($email_form, $lastname_form, $firstname_form, $pwd);
        $_SESSION['email']=$email_form;
        $_SESSION['lastname']=$lastname_form;
        $_SESSION['firstname']=$firstname_form;
        $_SESSION['password']=$pwd;
        header('Location: accueil.php');
        exit();
    }}
    else if ($_POST["email"]=="" || $_POST["password"]=="")
    {
        echo "<script>checkFields()</script>";
    }
    else
    {
        print "<div class='form'><h3>Email or password incorrect !</h3></div>";
    }
}
?>
<script>
    function checkFields() {
        if((document.getElementById("email").value == "") && (document.getElementById("password").value == "")){
            document.getElementById("email").style.border='red 2px solid';
            document.getElementById("password").style.border='red 2px solid';
            document.getElementById("field_check").innerText = "Aucun des champs n\'est indiqué !";
            return false;
        }
        else if((document.getElementById("email").value == "")){
            document.getElementById("password").style.border='black 2px solid';
            document.getElementById("email").style.border='red 2px solid';
            document.getElementById("field_check").innerText = "L\'email n\'est pas indiqué !";
            return false;
        }
        else if((document.getElementById("password").value == "")){
            document.getElementById("password").style.border='red 2px solid';
            document.getElementById("email").style.border='black 2px solid';
            document.getElementById("field_check").innerText = "Le mot de passe n\'est pas indiqué !";
            return false;
        }
    }
</script>

<?php ob_start(); ?>

<div id="field_check">
</div><br>

<div class="connexion">

        <h1>Meetiie</h1>

        <span id="conn">Connexion</span><br/><br>

    <form role="form" method="POST" enctype="multipart/form-data" onSubmit="return checkFields()">
         <input type="email" name="email" id="email" placeholder="Adresse e-mail" size="30" ><br/>
         <input type="password" name="password" id="password" placeholder="Mot de passe" size="30" ><br/>
         <input type="submit" name="submit_button" value="Login"><br/>
    </form><br>

    <a href="pwdForgottenView.php">Mot de passe oublié ?</a><br/>
    <a href="signupView.php" title="Découvrez de nouveaux iiens">Créer un compte</a><br>
</div>

<?php $content = ob_get_clean();
require('template.php'); ?>
