<?php

include('../admin/functions.php');
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']) || empty($_SESSION['bde'])) 
{
	// Si inexistante ou nulle, on redirige vers le formulaire de login
	exit();
}

require '../../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$query = "SELECT * FROM associations ORDER BY name";

/*
$result = mysql_query($query,$connect);

$data = [];
while ($row = mysql_fetch_assoc($result)) {
    $data[] = $row;
}
mysql_free_result($result);

header('Content-type:text/javascript;charset=utf-8');

$data = json_encode($data);
echo $data;
*/

//var_dump($query);

$data = $connection->query($query)->fetchAll(\PDO::FETCH_OBJ);

header('Content-type:text/javascript;charset=utf-8');
$data = json_encode($data);

/*
echo '<pre>';
var_dump($data);
echo '</pre>';
*/

echo $data;

