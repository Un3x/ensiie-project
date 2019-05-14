<?php
session_start();
$title = "Profil";
$css_link = '<link rel="stylesheet" type="text/css" href="css/loginStyle.css"/>';

require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();

if(isset($_POST['valid_del_email']))
{
    $email = $_SESSION['email'];
    $query = "DELETE FROM member WHERE email='$email'";
    $result=$connection->prepare($query);
    $result->execute();
    session_destroy();
    header("Location:loginView.php");
}

if(isset($_POST['valid_deban_email']))
{
    $deban_email = $_POST['deban_email'];
    $sql_verify = "SELECT * FROM member WHERE email='$deban_email';";
    $result_verify = $connection->prepare($sql_verify);
    $result_verify->execute();

    $count = $result_verify->rowCount();
    if($count!=0) {
        $query = "UPDATE member SET banned='false' WHERE email='$deban_email'";
        $result = $connection->prepare($query);
        $result->execute();
    }
    else {
        echo"<script>wrongEmail()</script>";
    }
}

if(isset($_POST['valid_ban_email']))
{
    $ban_email = $_POST['ban_email'];

    if ($_POST["ban_email"]!="") {
    $sql_verify = "SELECT * FROM member WHERE email='$ban_email';";
    $result_verify = $connection->prepare($sql_verify);
    $result_verify->execute();
    $count = $result_verify->rowCount();
        if ($count!=0) {
            $query = "UPDATE member SET banned='true' WHERE email='$ban_email'";
            $result = $connection->prepare($query);
            $result->execute();
        }
        else {
            echo"<script>wrongEmail()</script>";
        }
    }

}

if(isset($_POST['valid_signup']))
{
    $email_form = $_SESSION['email'];
    $firstname_form = $_POST['firstname'];
    $lastname_form = $_POST['lastname'];

    if($_POST["firstname"]!="" && $_POST["lastname"]!="")
    {
        $query = "UPDATE member SET firstname='$firstname_form', lastname='$lastname_form' WHERE email='$email_form';";
        $result=$connection->prepare($query);
        $result->execute();

        $requete = "SELECT firstname, lastname, password FROM member WHERE email='$email_form'";
        $q = $connection->query($requete);
        $row = $q->fetch();
        $password=$row['password'];
        $firstname_form=$row['firstname'];
        $lastname_form=$row['lastname'];
        $model->config($email_form, $lastname_form, $firstname_form, $password);

    }
    else if($_POST["firstname"]=="" || $_POST["lastname"]==""){
        echo "<script>updateNames()</script>";
    }
}

if(isset($_POST['valid_mdp']))
{
    $email_form = $_SESSION['email'];
    $pwd_old = $_POST['pwd_old'];
    $pwd_new = $_POST['pwd_new'];

    if ($_POST["pwd_old"]!="" && $_POST["pwd_new"]!=""){
        $requete = "SELECT firstname, lastname, password FROM member WHERE email='$email_form'";
        $q = $connection->query($requete);
        $row = $q->fetch();
        $password=$row['password'];
        $firstname_form=$row['firstname'];
        $lastname_form=$row['lastname'];

        if ($pwd_old == $password) {
            $query = "UPDATE member SET password='$pwd_new' WHERE email='$email_form';";
            $result=$connection->prepare($query);
            $result->execute();
            $model->config($email_form, $lastname_form, $firstname_form, $pwd_new);
        }
        else {
            echo"<script>wrongPwd()</script>";
        }
    }
}
?>
<script>

    function updateNames() {
        if((document.getElementById("firstname").value == "") && (document.getElementById("lastname").value == "")){
            document.getElementById("firstname").style.border='red 2px solid';
            document.getElementById("lastname").style.border='red 2px solid';
            document.getElementById("message").innerText = "Le nom et le prénom ne sont pas indiqués !";
            return false;
        }
        else if((document.getElementById("lastname").value == "")){
            document.getElementById("firstname").style.border='black 2px solid';
            document.getElementById("lastname").style.border='red 2px solid';
            document.getElementById("message").innerText = "Le nom n\'est pas indiqué !";
            return false;
        }
        else if((document.getElementById("firstname").value == "")){
            document.getElementById("firstname").style.border='red 2px solid';
            document.getElementById("lastname").style.border='black 2px solid';
            document.getElementById("message").innerText = "Le prénom n\'est pas indiqué !";
            return false;
        }
    }

    function updatePwd() {

        if((document.getElementById("pwd_old").value == "") && (document.getElementById("pwd_new").value == "")){
            document.getElementById("pwd_old").style.border='red 2px solid';
            document.getElementById("pwd_new").style.border='red 2px solid';
            document.getElementById("message").innerText = "Aucun des mots de passe n\'est indiqué !";
            return false;
        }
        else if((document.getElementById("pwd_new").value == "")){
            document.getElementById("pwd_old").style.border='black 2px solid';
            document.getElementById("pwd_new").style.border='red 2px solid';
            document.getElementById("message").innerText = "Le nouveau mot de passe n\'est pas indiqué !";
            return false;
        }
        else if((document.getElementById("pwd_old").value == "")){
            document.getElementById("pwd_old").style.border='red 2px solid';
            document.getElementById("pwd_new").style.border='black 2px solid';
            document.getElementById("message").innerText = "L\'ancien mot de passe n\'est pas indiqué !";
            return false;
        }
    }

    function wrongPwd()
    {
        alert("Le mot de passe actuel est incorrect !");
        return false;
    }

    function wrongEmail()
    {
        alert("Cet email n\'existe pas !");
        return false;
    }
</script>

<?php ob_start(); ?>
<div id="message">
    Tous les champs sont obligatoires<br><br>
</div>
<form action="accueil.php">
    <button type="submit" >Retour Accueil</button>
</form>
<div class="connexion">
    <h1>Profil Administrateur</h1>

    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data" onSubmit="return updateNames()">
        Prénom:
        <input type="text" name="firstname" id="firstname" maxlength="15" class="input_form" value=<?= $_SESSION['firstname']?>  /><br>
        Nom &nbsp;&nbsp;&nbsp;&nbsp;:
        <input type="text" name="lastname" id="lastname" maxlength="15" class="input_form" value=<?= $_SESSION['lastname']?>  /><br>
        <button type="submit" name="valid_signup" id="valid_signup" class="input_form">Valider</button><br>
    </form><br>
    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data" onSubmit="return updatePwd()">
        Votre mot de passe actuel:<br />
        <input type="password" name="pwd_old" id="pwd_old" maxlength="20" class="input_form"/><br>
        Votre nouveau mot de passe:<br />
        <input type="password" name="pwd_new" id="pwd_new" maxlength="20" class="input_form"/><br>
        <button type="submit" name="valid_mdp" id="valid_mdp" class="input_form">Valider</button>
    </form><br>

    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data" ">
        Utilisateur à bannir :<br />
        <input type="text" name="ban_email" id="ban_email" maxlength="38" class="input_form" placeholder="ex: prenom.nom@ensiie.fr"/><br>
        <button type="submit" name="valid_ban_email" id="valid_ban_email" class="input_form">Bannir</button>
    </form><br>
    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data" ">
        Utilisateur à débannir :<br />
        <input type="text" name="deban_email" id="deban_email" maxlength="38" class="input_form" placeholder="ex: prenom.nom@ensiie.fr"/><br>
        <button type="submit" name="valid_deban_email" id="valid_deban_email" class="input_form">Débannir</button>
    </form>

    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data"><br />
        <button type="submit" name="valid_del_email" id="valid_del_email" class="input_form">Supprimer le compte</button>
    </form><br>
</div>

<?php $content = ob_get_clean();

require('template.php'); ?>
