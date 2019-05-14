<?php

require '../vendor/autoload.php';
require '../src/Model/City/CityManager.class.php';

if(isset($_GET['n']) && isset($_GET['name']) && is_numeric($_GET['n']) && is_string($_GET['name'])){

    try{
        $connection = bdd();

        $CityManager = new CityManager($connection);

        $cities = $CityManager->getCityAutocompl($_GET['name'], $_GET['n']);

        echo '{"status" : "success", "data" : '.json_encode($cities).'}';
    }
    catch(Exception $e){
        header("HTTP/1.1 500 Internal Server Error");
        echo '{"status" : "fail"}';
    }
}
else{
    header("HTTP/1.1 400 Bad Request");
    echo '{"status" : "fail"}';

}
