<?php

if(isset($_GET['departure']) && isset($_GET['arrival']) && is_string($_GET['departure']) && is_string($_GET['arrival'])){
    try{
        
        require_once('../vendor/autoload.php');
        require_once('../src/Model/Course/CourseManager.php');
        require_once('../src/Model/User/VendorManager.class.php');
        require_once('../src/Model/City/CityManager.class.php');
        require_once('../src/Model/Race/RaceManager.class.php');

        $connection = bdd();

        $CourseManager = new CourseManager($connection);

        if($modeDemo){
            $vendor = new Vendor();
            $VendorManager = new VendorManager($connection);
            $cityManager = new CityManager($connection);
            $raceManager = new RaceManager($connection);
            $idCity = $cityManager->get2($_GET['departure'])->getId();

            $vendor->hydrate(substr(md5(mt_rand()), 0, 7), substr(md5(mt_rand()), 0, 7), $raceManager->get(rand(1,2)) , "testprojetlicorne+bot_".substr(md5(mt_rand()), 0, 7)."@gmail.com", "imabot", rand(0,100), "0000000000", date_create(),rand(0,42), "Hello ! I'm a bot !", "other", rand(0,10), rand(0,10), false, $idCity, rand(0,1000)/100);
            $VendorManager->add($vendor);
        }


        $courses = $CourseManager->fetchCourses($_GET['departure'],$_GET['arrival']);

        echo '{"status" : "success", "data" : '.json_encode($courses).'}';
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
