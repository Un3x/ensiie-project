<?php

class Model
{
    public function dbConnect()
    {
        require '../vendor/autoload.php';

        //postgres
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

        return $connection;
    }

    function verif_mdp($email_form, $mdp)
    {
        //Get values passed from form in login.php file
        $email = $email_form;
        $password = $mdp;

        //To prevent mysql injection
        $email = stripcslashes($email);
        $password = stripcslashes($password);

        //connect to the server and select database
        $connection = $this->dbConnect();

        //Query the database for user
        $result = $connection->query("SELECT * FROM member WHERE email='$email' and password='$password'");
        $row = $result->fetch();		//change with prepare and execute like in registration2.php
        if(($row['email']==$email) && ($row['password']==$password)){
            return true;
        }
        else {
            return false;
        }
    }

    function config($email)
    {
        //session_start();
        global $hostName, $baseName, $userName, $pwd;	//Rappel : $nom_user est son email, il n'y a pas de colonnes username dans la BDD
        $_SESSION['email'] = $email;
        $_SESSION['nomhote'] = $hostName;
        $_SESSION['nombase'] = $baseName;
        $_SESSION['nomuser'] = $userName;
        $_SESSION['mdp'] = $pwd;
    }
}