<?php

require '../vendor/autoload.php';
require '../src/Model/City/CityManager.class.php';
if(isset($_GET['n']) && isset($_GET['name'])){



    //postgres
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


    $CityManager = new CityManager($connection);

    $cities = $CityManager->getCityAutocompl($_GET['name'], $_GET['n']);

    echo '{"status" : "success", "data" : '.json_encode($cities).'}';
}
else{
    header("HTTP/1.1 400 Bad Request");
    echo '{"status" : "fail"}';


}
