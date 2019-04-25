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
    //call js function
    //echo "<script>envoyer();</script>";

    $email_form = $_SESSION['email'];
    $firstname_form = $_POST['firstname'];
    $lastname_form = $_POST['lastname'];
    $pwd_signup_form = $_POST['pwd_signup'];


   if(isset($_POST["pwd_signup"]))
        {
            $query = "UPDATE member SET firstname='$firstname_form', lastname='$lastname_form', password='$pwd_signup_form' WHERE email='$email_form';";
            $result=$connection->prepare($query);
            $result->execute();
            $model->config($email_form, $lastname_form, $firstname_form, $pwd_signup_form);
        }
   else
        {
            $query = "UPDATE member SET firstname='$firstname_form',lastname='$lastname_form' WHERE email='$email_form';";
            $result=$connection->prepare($query);
            $result->execute();
            $model->config($email_form, $lastname_form, $firstname_form, $_SESSION['pwd']);
        }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="css/profile.css"/>
    <script language="javascript" type="text/javascript">

        function envoyer()
        {
            if((document.getElementById("firstname").value === '') && (document.getElementById("lastname").value === ''))
            {
                document.getElementById("firstname").style.border='#CC3300 2px solid';
                document.getElementById("lastname").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = 'Le nom et le prénom ne sont pas indiqués';
            }

            else if((document.getElementById("lastname").value === '') && (document.getElementById("firstname").value !== ''))
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
            }

            /*else if((document.getElementById("pwd_signup").value === '') && (document.getElementById("lastname").value !== ''))
            {
                document.getElementById("lastname").style.border='#000000 2px normal';
                document.getElementById("firstname").style.border='#CC3300 2px solid';
                document.getElementById('message').innerText = 'Le mot de passe n\'est pas indiqué';
            }*/

            else
            {
                document.getElementById('message').innerText = 'Envoi serveur';
            }
        }
    </script>
</head>
<body>
        <div class="titre_page"><h1>Formulaire d'inscription</h1></div>
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
                        <form id="signup" name="signup" role="form" method="POST" enctype="multipart/form-data">
                            <div class="div_input_form">
                                <input type="text" name="firstname" id="firstname" maxlength="15" class="input_form" value=<?= $_SESSION['firstname']?>  />
                            </div>
                            <div class="div_input_form">
                                <input type="text" name="lastname" id="lastname" maxlength="15" class="input_form" value=<?= $_SESSION['lastname']?>  />
                            </div>
                            <div class="div_input_form">
                                Votre mot de passe :<br />
                                <input type="password" name="pwd_signup" id="pwd_signup" maxlength="20" class="input_form"/>
                            </div>
                            <div class="div_input_form">
                                <!--<input type="submit" name="valid_signup" id="valid_signup" class="input_form" value="Valider" onclick="envoyer();"/>-->
                                <button type="submit" name="valid_signup" id="valid_signup" class="input_form" onclick="envoyer();">Valider</button>
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
