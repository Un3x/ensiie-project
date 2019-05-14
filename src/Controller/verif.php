<?php

// cost à gerer ?
function hasherPassword($pass)
{
 return password_hash($pass, PASSWORD_DEFAULT);
}

function verifierPassword($pass,$hash)
{
    return password_verify($pass,$hash);
}


function verifDate($a)
{

}
function verifNom($a)
{
    return  preg_match("#^(\d){1,15}$#", $_POST["phoneNumber"]);
}

function verifMail($mail)
{
    return filter_var($mail, FILTER_VALIDATE_EMAIL);
}

function verifPhoneNumber($n)
{
    return preg_match("#^(\d){10}$#", $_POST["phoneNumber"]);
}

function verifBirthDate($a)
{
    return preg_match("#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#", $a);
}
