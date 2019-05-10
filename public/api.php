<?php

require_once('../src/config.php');

if( isset($_GET['action']))
{
    switch($_GET['action']){
        case 'cityNameAPI' :
            require('../src/Controller/api/cityNameAPI.php');
            break;

        case 'searchCourseAPI' :
            require('../src/Controller/api/searchCourseAPI.php');
            break;
        
        case 'routingAPI' :
            require('../src/Controller/api/routingAPI.php');
            break;
    
        default:
            header("HTTP/1.1 404 Not Found");
            echo '{"status" : "fail"}';
            break;
    }
}
else
{
    header("HTTP/1.1 400 Bad Request");
    echo '{"status" : "fail"}';

}
