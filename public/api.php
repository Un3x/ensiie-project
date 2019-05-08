<?php
//session_start(); -> il faut faire les ob_start() avant de commencer la session

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
            echo '{"status" : "fail"}';
            break;
    }
}
else
{
     echo '{"status" : "fail"}';

}
