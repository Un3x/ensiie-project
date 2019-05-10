<?php
/*
require '../vendor/autoload.php';
require '../src/model/course/CourseManager.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$CourseManager = new \City\CityManager($connection);

$courses = $CourseManager->searchCourses(,10);

echo json_encode($courses);*/


$courses = [["carrierId" => 3512, "price" => 30, "departureTime" => "12h", "arrivalTime" => "00h16"],
["carrierId" => 1365, "price" => 45.3, "departureTime" => "13h16", "arrivalTime" => "04h36"],
["carrierId" => 1348, "price" => 12, "departureTime" => "09h25", "arrivalTime" => "17h48"],
["carrierId" => 3481, "price" => 42, "departureTime" => "22h03", "arrivalTime" => "07h39"]];

if($courses){
    $result = [];

    foreach($courses as $course){
        //récupérer nom transporteur
        $carrier = ['name' => uniqid()];

        $result[] = ["carrierId" => $course['carrierId'], "price" => $course['price'], "departureTime" => $course['departureTime'], "arrivalTime" => $course['arrivalTime'], 'carrierName' => $carrier['name']];


    }

    echo '{"status" : "success", "data" : '.json_encode($result).'}';

}
else{
    header("HTTP/1.1 400 Bad Request");
    echo '{"status" : "fail"}';


}
