<?php

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


function verif_authen(){
    return (isset($_SESSION['stat']) && ($_SESSION['stat'] == 'Visitor'));
}

function verif_admin(){
    return (isset($_SESSION['stat']) && ($_SESSION['stat'] == 'Admin'));
}

?>