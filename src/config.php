<?php

$GLOBALS['connecte'] = isset($_SESSION["id_utilisateur"]);

function bdd()
{
    return new PDO('mysql:host=localhost;dbname=test', " ","");
}
/*

*/