<?php $title = "Meetiie - Signup";
$css_link = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/loginStyle.css\"/>";
echo $css_link;

require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();

// If form submitted, insert values into the database.
if (isset($_POST['submit_btn']))
{

    // removes backslashes
    $lastnameTmp = stripslashes($_REQUEST['lastname']);
    $firstnameTmp = stripslashes($_REQUEST['firstname']);
    $email = stripslashes($_REQUEST['email']);
    $password = stripslashes($_REQUEST['password']);

    $sql_verify = "SELECT * FROM member WHERE email='$email';";
    $result_verify = $connection->prepare($sql_verify);
    $result_verify->execute();

    $count = $result_verify->rowCount();
    /*$result_verify = $connection->prepare("SELECT FOUND_ROWS()");
    $result_verify->execute();
    $row_count =$result_verify->fetchColumn();*/
    if($count!=0)
    {
        echo "Email déjà utilisé";
    }
    else {
        $query = "INSERT INTO member(firstname, lastname, email, password) VALUES ('$firstnameTmp', '$lastnameTmp', '$email', '$password')";
        $result=$connection->prepare($query);
        $result->execute();

        if($result){
            print "<div class='form'>
            <h3>You are registered successfully.</h3>
             <br/>Click here to <a href='loginView.php'>Login</a></div>";
        }
    }
}
?>


<?php ob_start(); ?>

<div class="connexion">

        <h1>Meetiie</h1>
        <span id="conn">Créez votre compte Meetiie !</span><br/><br/>

    <form role="form" method="POST" enctype="multipart/form-data">
        <input type="text" name="firstname" placeholder="Prénom" size="15" required>
        <input type="text" name="lastname" placeholder="Nom" size="15" required><br/><br/>
        <input type="email" name="email" placeholder="Username@ensiie.fr" size="38" required><br><br>
        <input type="password" name="password" placeholder="Mot de passe" size="20" required><br><br>
        <input type="submit" name="submit_btn" value="S'inscrire"><br/>
    </form><br>
</div><br>

<?php $content = ob_get_clean();
require('template.php'); ?>
