<?php
    session_start();

require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();
/*$email_session = $_SESSION['email'];

$requete = "SELECT firstname, lastname FROM member WHERE email='$email_session';";
$q = $connection->query($requete);
$row = $q->fetch();
$firstname_disp=$row['firstname'];
$lastname_disp=$row['lastname'];*/


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
   else
        {
            /*$query = "UPDATE member SET firstname='$firstname_form',lastname='$lastname_form' WHERE email='$email_form';";
            $result=$connection->prepare($query);
            $result->execute();
            $model->config($email_form, $lastname_form, $firstname_form, $_SESSION['pwd']);*/
            //header("Location:accueil.php");
            //die("Not all the fields are filled !");
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
            echo "jkjbkjb";
            $query = "UPDATE member SET password='$pwd_new' WHERE email='$email_form';";
            $result=$connection->prepare($query);
            $result->execute();
            $model->config($email_form, $lastname_form, $firstname_form, $pwd_new);
        }
    }
    //else { die("Not all the fields are filled !"); }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="css/profile.css"/>
    <script language="javascript" type="text/javascript">

        function envoyerForm() {
            if ((document.getElementById("lastname").value === '') || (document.getElementById("firstname").value === '')){
                document.getElementById("firstname").style.border='#CC3300 2px solid';
                document.getElementById("lastname").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = "Le nom ou le prénom n'est pas indiqués";
            }
            else {
                document.getElementById('message').innerText = 'Envoi serveur';

            }
        }

        function envoyerMdp() {
            if ((document.getElementById('pwd_old').value ==='' ) || (document.getElementById('pwd_new').value ==='' )){
                document.getElementById("pwd_old").style.border='#CC3300 2px solid';
                document.getElementById("pwd_new").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = "Le nouveau ou l'ancien n'est pas indiqués";
            }
        }

        function envoyer()
        {
            if((document.getElementById("lastname").value === '') && (document.getElementById("firstname").value === '') && (document.getElementById('pwd_signup').value ===''))
            {
                document.getElementById("firstname").style.border='#CC3300 2px solid';
                document.getElementById("lastname").style.border='#CC3300 2px solid';
                document.getElementById("pwd_signup").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = 'Le nom, le prénom et le mot de passe ne sont pas indiqués';
            }

            else if((document.getElementById("lastname").value === '') && (document.getElementById("firstname").value === '') && (document.getElementById('pwd_signup').value !==''))
            {
                document.getElementById("firstname").style.border='#CC3300 2px solid';
                document.getElementById("lastname").style.border='#CC3300 2px solid';
                document.getElementById("pwd_signup").style.border='#000000 2px normal';
                document.getElementById('message').innerText = 'Le nom et le prénom ne sont pas indiqués';
            }

            else if((document.getElementById("lastname").value === '') && (document.getElementById("firstname").value !== '') && (document.getElementById('pwd_signup').value ===''))
            {
                document.getElementById("firstname").style.border='#000000 2px normal';
                document.getElementById("lastname").style.border='#CC3300 2px solid';
                document.getElementById("pwd_signup").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = 'Le nom et le mot de passe ne sont pas indiqués';
            }

            else if((document.getElementById("lastname").value === '') && (document.getElementById("firstname").value !== '') && (document.getElementById('pwd_signup').value !==''))
            {
                document.getElementById("firstname").style.border='#000000 2px normal';
                document.getElementById("lastname").style.border='#CC3300 2px solid';
                document.getElementById("pwd_signup").style.border='#000000 2px normal';
                document.getElementById('message').innerText = 'Le nom n\'est pas indiqué';
            }

            else if((document.getElementById("lastname").value !== '') && (document.getElementById("firstname").value === '') && (document.getElementById('pwd_signup').value ===''))
            {
                document.getElementById("firstname").style.border='#CC3300 2px solid';
                document.getElementById("lastname").style.border='#000000 2px normal';
                document.getElementById("pwd_signup").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = 'Le prénom et le mot de passe ne sont pas indiqués';
            }

            else if((document.getElementById("lastname").value !== '') && (document.getElementById("firstname").value === '') && (document.getElementById('pwd_signup').value !==''))
            {
                document.getElementById("firstname").style.border='#CC3300 2px solid';
                document.getElementById("lastname").style.border='#000000 2px normal';
                document.getElementById("pwd_signup").style.border='#000000 2px normal';
                document.getElementById('message').innerText = 'Le prénom n\'est pas indiqué';
            }

            else if((document.getElementById("lastname").value !== '') && (document.getElementById("firstname").value !== '') && (document.getElementById('pwd_signup').value ===''))
            {
                document.getElementById("firstname").style.border='#000000 2px normal';
                document.getElementById("lastname").style.border='#000000 2px normal';
                document.getElementById("pwd_signup").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = 'Le mot de passe n\'est pas indiqué';
            }

            else if((document.getElementById("lastname").value !== '') && (document.getElementById("firstname").value !== '') && (document.getElementById('pwd_signup').value !==''))
            {
                document.getElementById('message').innerText = 'Envoi serveur';
            }

            /*else if((document.getElementById("lastname").value === '') && (document.getElementById("firstname").value !== ''))
            {
                document.getElementById("firstname").style.border='#000000 2px normal';
                document.getElementById("lastname").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = 'Le nom n\'est pas indiqué';
            }

            else if((document.getElementById("firstname").value === '') && (document.getElementById("lastname").value !== ''))
            {
                document.getElementById("lastname").style.border='#000000 2px normal';
                document.getElementById("firstname").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = 'Le prénom n\'est pas indiqué';
            }*/

            /*else if((document.getElementById("pwd_signup").value === '') && (document.getElementById("lastname").value !== ''))
            {
                document.getElementById("lastname").style.border='#000000 2px normal';
                document.getElementById("firstname").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = 'Le mot de passe n\'est pas indiqué';
            }*/

            /*else
            {
                document.getElementById('message').innerText = 'Envoi serveur';
            }*/
        }
    </script>
</head>
<body>
        <div class="titre_page"><!--<h1>Formulaire d'inscription</h1>--></div>
        <div class="div_int_page">
            <div class="div_saut_ligne">
            </div>
            <div id="n_1"></div>
            <div id="n_2">
                <div id="GTitre">
                    <h1>Profil utilisateur</h1>
                </div>
            </div>
            <div class="div_saut_ligne" id="n_3">
            </div>
            <div id="n_4">
                <div id="conteneur">
                    <div id="centre">
                        <div id="message">
                            Tous les champs sont obligatoires
                        </div>
                        <form>
                            <div class="div_input_form">
                                <input type="text" name="firstname" id="firstname" maxlength="15" class="input_form" value=<?= $_SESSION['firstname']?>  />
                            </div>
                            <div class="div_input_form">
                                <input type="text" name="lastname" id="lastname" maxlength="15" class="input_form" value=<?= $_SESSION['lastname']?>  />
                            </div>
                            <div class="div_input_form">
                                <!--<input type="submit" name="valid_signup" id="valid_signup" class="input_form" value="Valider" onclick="envoyer();"/>-->
                                <button type="submit" name="valid_signup" id="valid_signup" class="input_form" onclick="envoyerForm()">Valider</button>
                            </div>
                        </form>
                        <form>
                            <div class="div_input_form">
                                Remplir les champs ci-dessous pour changer le mot de passe.<br /><br />
                                Votre mot de passe actuel:<br />
                                <input type="password" name="pwd_old" id="pwd_old" maxlength="20" class="input_form"/>
                            </div>
                            <div class="div_input_form">
                                Votre nouveau mot de passe:<br />
                                <input type="password" name="pwd_new" id="pwd_new" maxlength="20" class="input_form"/>
                            </div>
                            <div class="div_input_form">
                                <button type="submit" name="valid_mdp" id="valid_mdp" class="input_form" onclick="envoyerMdp()">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="div_saut_ligne" id="n_5">
            </div>
        </div>
</body>
</html>
