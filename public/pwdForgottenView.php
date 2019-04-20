<?php
$title = "Meetiie - Reset Password";
$css_link = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/loginStyle.css\"/>";

echo $css_link;

require('../src/model.php');
$co = new Model();
$connection = $co->dbConnect();

if(isset($_POST['send_message_btn']))
{
    $email_tmp=$_POST['email_reset'];

    $requete = "SELECT * FROM member WHERE email='$email_tmp'";
    $q = $connection->query($requete);
    $row = $q->fetch();
    $message=$row['lastname']." ".$row['firstname']." votre mot de passe est : ".$row['password'];
    if(mail($_POST['email_reset'], "Recuperation du mot de passe", $message))
    {
        echo '<div class="msg">'
            .'Verifiez votre boite email !'
            .'</div>';
        //echo "Verifiez votre boite email !";
        //echo "<script>alert(\"Vérifiez votre boite email\")</script>";	fonctionnel mais pas ce qu'on vise au niveau design
    }
    else
    {
        echo "Erreur !";
    }
}
?>


<?php ob_start(); ?>

<div class="connexion">
    <h1>Password Reset</h1>
    <form role="form" method="POST" enctype="multipart/form-data">	<!--Ajouter la page de action; action=\"send_script.php\"-->
        <input type="email" name="email_reset" placeholder="Username@ensiie.fr" size="48"><br><br>
        <input type="submit" name="send_message_btn" value="Reset">
        <input type="button" onclick="location.href='loginView.php'" value="Login"/>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

