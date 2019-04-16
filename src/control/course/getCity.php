<?php
require '../vendor/autoload.php';
require '../src/City/CityManager.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$CityManager = new \City\CityManager($connection);

$cities = $CityManager->getCityAutocompl($_GET['name'], 5);

echo implode(';', $cities);
