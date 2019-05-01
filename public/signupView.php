<?php $title = "Meetiie - Signup";
$css_link = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/loginStyle.css\"/>";
echo $css_link;
?>
<script>
    function validateEmail()
    {
        if(!(document.getElementsByTagName('email').value == /^[a-zA-Z0-9_.+-]+@ensiie.fr$/g))
        {
            alert("Email invalide ! ");
            return false;
        }
        return true;
    }

    function checkFields() {
        if((document.getElementById("firstname").value == "")) {
            alert("Prénom non indiqué !");
            return false;
        }
        else if((document.getElementById("lastname").value == "")) {
            alert("Nom non indiqué !");
            return false;
        }
        else if((document.getElementById("email").value == "")) {
            alert("Email non indiqué !");
            return false;
        }
        else if((document.getElementById("password").value == "")) {
            alert("Mot de passe non indiqué !");
            return false;
        }}
</script>
<?php
require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();

// If form submitted, insert values into the database.
if (isset($_POST['submit_btn']))
{
    if (($_POST['firstname']=="") || ($_POST['lastname']=="") || ($_POST['email']=="") || ($_POST['password']=="")) {
        echo "<script>checkFields()</script>";
    } else{
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
        print "<div class='form'><h4>Email déjà utilisé !</h4></div>";
    }
    else {

        if(!("<script>checkFields()</script>")){
        $query = "INSERT INTO member(firstname, lastname, email, password) VALUES ('$firstnameTmp', '$lastnameTmp', '$email', '$password')";
        $result=$connection->prepare($query);
        $result->execute();

        if($result){
            print "<div class='form'>
            <h3>You are registered successfully.</h3>
             <br/>Click here to <a href='loginView.php'>Login</a></div>";
        }}
    }}
}
?>


<?php ob_start(); ?>

<div class="connexion">

        <h1>Meetiie</h1>
        <span id="conn">Créez votre compte Meetiie !</span><br/><br/>

    <form role="form" method="POST" enctype="multipart/form-data" onSubmit="return checkFields()">
        <input type="text" name="firstname" id="firstname" placeholder="Prénom" size="15">
        <input type="text" name="lastname" id="lastname" placeholder="Nom" size="15"><br/><br/>
        <input type="email" name="email" id="email" placeholder="Username@ensiie.fr" size="38"><br><br>
        <input type="password" name="password" id="password" placeholder="Mot de passe" size="38"><br><br>
        <input type="submit" name="submit_btn" value="S'inscrire" onclick="validateEmail()"><br/>
    </form><br>
</div><br>

<?php $content = ob_get_clean();
require('template.php'); ?>
