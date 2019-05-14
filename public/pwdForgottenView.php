<?php
$title = "Meetiie - Reset Password";
$css_link = '<link rel=\"stylesheet\" type=\"text/css\" href=\"css/loginStyle.css\"/>';

require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();

if(isset($_POST['send_message_btn']))
{
    $email_tmp=$_POST['email_reset'];

    $requete = "SELECT * FROM member WHERE email='$email_tmp'";
    $q = $connection->query($requete);      //Il faut la remplacer par prepare et execute
    $row = $q->fetch();
    $message=$row['lastname']." ".$row['firstname']." votre mot de passe est : ".$row['password'];
    if(mail($_POST['email_reset'], "Recuperation du mot de passe", $message))
    {
        echo '<div class="msg">'
            .'Verifiez votre boite email !'
            .'</div>';
    }
    else
    {
        echo "Erreur !";
    }
}

ob_start();
?>

<div class="connexion">
    <h1>Password Reset</h1>
    <form role="form" method="POST" enctype="multipart/form-data">
        <input type="email" name="email_reset" placeholder="Username@ensiie.fr" size="48"><br><br>
        <input type="submit" name="send_message_btn" value="Reset">
        <input type="button" onclick="location.href='loginView.php'" value="Login"/>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

