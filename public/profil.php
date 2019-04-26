<?php
session_start();
$title = "Profil";
$css_link = '<link rel="stylesheet" type="text/css" href="css/loginStyle.css"/>';

$script = '

    <script language="javascript" type="text/javascript">
        function envoyerForm() {
            if ((document.getElementById("lastname").value === "") || (document.getElementById("firstname").value === "")){
                document.getElementById("firstname").style.border=\'#CC3300 2px solid\';
                document.getElementById("lastname").style.border=\'#CC3300 2px solid\';
                document.getElementById("message").innerText = "Le nom ou le prénom n\'est pas indiqués";
            }
            else {
                document.getElementById("message").innerText = "Envoi serveur";

            }
        }

        function envoyerMdp() {
            if ((document.getElementById("pwd_old").value === "" ) || (document.getElementById("pwd_new").value === "" )){
                document.getElementById("pwd_old").style.border=\'#CC3300 2px solid\';
                document.getElementById("pwd_new").style.border=\'#CC3300 2px solid\';
                document.getElementById("message").innerText = "Le nouveau ou l\'ancien n\'est pas indiqués";
            }
        }
    </script>
    
    ';

require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();



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
    }
}
?>


<?php ob_start(); ?>
<div id="message">
    Tous les champs sont obligatoires
</div>

<div class="connexion">
    <h1>Profil utilisateur</h1>

    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data">
        <span id="conn">Remplir les champs ci-dessous pour changer votre nom et prénom</span><br/><br>

        Prénom:
        <input type="text" name="firstname" id="firstname" maxlength="15" class="input_form" value=<?= $_SESSION['firstname']?>  /><br><br>

        Nom:
        <input type="text" name="lastname" id="lastname" maxlength="15" class="input_form" value=<?= $_SESSION['lastname']?>  /><br><br>

        <button type="submit" name="valid_signup" id="valid_signup" class="input_form">Valider</button><br><br>
    </form>

    <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data">


        <span id="conn"> Remplir les champs ci-dessous pour changer votre mot de passe</span><br/><br>

        Votre mot de passe actuel:<br />
        <input type="password" name="pwd_old" id="pwd_old" maxlength="20" class="input_form"/><br><br>

        Votre nouveau mot de passe:<br />
        <input type="password" name="pwd_new" id="pwd_new" maxlength="20" class="input_form"/><br><br>

        <button type="submit" name="valid_mdp" id="valid_mdp" class="input_form">Valider</button><br><br>
    </form>
</div>


<form action="accueil.php">
    <button type="submit" >Retour Accueil</button>
</form>

<?php $content = ob_get_clean();

require('templateScript.php'); ?>
