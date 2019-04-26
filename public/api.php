<?php
//session_start(); -> il faut faire les ob_start() avant de commencer la session

require_once('../src/config.php');

if( isset($_GET['action']))
{
    switch($_GET['action']){
        case 'getCities' :
            require('../src/Controller/api/getCities.php');
            break;

        case 'getCourses' :
            require('../src/Controller/api/getCourses.php');
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
