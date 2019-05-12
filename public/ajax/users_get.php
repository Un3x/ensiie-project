<?php

include('../admin/functions.php');
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']) || empty($_SESSION['president'])) 
{
	// Si inexistante ou nulle, on redirige vers le formulaire de login
	exit();
}

require '../../vendor/autoload.php';


$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$query = "SELECT * FROM users ORDER BY lastname, firstname";

$rows = $connection->query($query)->fetchAll(\PDO::FETCH_ASSOC);

header('Content-type:text/javascript;charset=utf-8');

$data = json_encode($rows);
echo $data;