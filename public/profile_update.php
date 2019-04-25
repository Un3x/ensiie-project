<?php
session_start();

require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();
$email_session = $_SESSION['email'];

$requete = "SELECT firstname, lastname FROM member WHERE email='$email_session';";
$q = $connection->query($requete);
$row = $q->fetch();
$firstname_disp=$row['firstname'];
$lastname_disp=$row['lastname'];
if(isset($_POST['valid_signup']))
{
    $email_form = $_SESSION['email'];
    $firstname_form = $_POST['firstname'];
    $lastname_form = $_POST['lastname'];
    $pwd_signup_form = $_POST['pwd_signup'];


    if(isset($_POST["pwd_signup"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]))
        {
            $query = "UPDATE member SET firstname='$firstname_form', lastname='$lastname_form', password='$pwd_signup_form' WHERE email='$email_form';";
            $result=$connection->prepare($query);
            $result->execute();
            $model->config($email_form, $lastname_form, $firstname_form, $pwd_signup_form);
        }
    else
        {/*$query = "UPDATE member SET firstname='$firstname_form',lastname='$lastname_form' WHERE email='$email_form';";
        $result=$connection->prepare($query);
        $result->execute();
        $model->config($email_form, $lastname_form, $firstname_form, $_SESSION['pwd']);*/
        header("Location:profile.php");
        //die("Not all the fields are filled !");
        }}
?>