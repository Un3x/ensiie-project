<?php
session_start();
$title = "Profil";
$css_link = '<link rel="stylesheet" type="text/css" href="css/loginStyle.css"/>';

require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();

if(isset($_POST['del_acc']))
{
    $del_account = $_SESSION['email'];
    $query = "DELETE FROM member WHERE email='$del_account'";
    $result=$connection->prepare($query);
    $result->execute();
    session_destroy();
    header("Location:loginView.php");
}

if(isset($_POST['valid_signup']))
{
    $email_form = $_SESSION['email'];
    $firstname_form = $_POST['firstname'];
    $lastname_form = $_POST['lastname'];

    if ($_POST["firstname"]=="" || $_POST["lastname"]=="")
    {
        echo "<script>updateNames()</script>";
    }
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
</script>

<?php ob_start(); ?>
<div id="message">
    Tous les champs sont obligatoires !
</div><br>
<form action="accueil.php">
    <button type="submit" >Retour Accueil</button><br>
</form>
<div class="connexion">
    <h1>Profil utilisateur</h1>

    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data" onSubmit="return updateNames()">
        <span id="conn">Remplir les champs ci-dessous pour changer votre nom et prénom</span><br/><br>

        <table id="pwd_update_1">
            <tr><td>Prénom:</td>
                <td><input type="text" name="firstname" id="firstname" maxlength="15" class="input_form" value=<?= $_SESSION['firstname']?> /><br></td></tr>

            <tr><td>Nom:</td>
                <td><input type="text" name="lastname" id="lastname" maxlength="15" class="input_form" value=<?= $_SESSION['lastname']?> /><br></td></tr>
        </table>
        <button type="submit" name="valid_signup" id="valid_signup" class="input_form">Modifier</button><br>
    </form>

    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data" onSubmit="return updatePwd()">

        <span id="conn"> Remplir les champs ci-dessous pour changer votre mot de passe</span><br/><br>

        <table id="pwd_update_2">
            <tr><td>Votre mot de passe actuel:</td>
                <td><input type="password" name="pwd_old" id="pwd_old" maxlength="20" class="input_form"/></td></tr>

            <tr><td>Votre nouveau mot de passe:</td>
            <td><input type="password" name="pwd_new" id="pwd_new" maxlength="20" class="input_form" /><br></td></tr>
        </table>
        <button type="submit" name="valid_mdp" id="valid_mdp" class="input_form">Modifier</button>
    </form>
    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data">
        <button type="submit" name="del_acc" id="del_acc" class="input_form">Supprimer mon compte</button>
    </form>
</div>

<?php $content = ob_get_clean();

require('template.php'); ?>
