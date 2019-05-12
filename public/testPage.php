<?php
/*     session_start();
    if (array_key_exists('connected',$_SESSION))
    {
        if($_SESSION['connected']){
            echo 'je suis connecté !';
        } else {
            echo 'je ne suis pas connecté !';
        }        
    } else {
        echo 'je ne suis pas connecté, genre du tout !';
    }      */
    require '../src/generalTools.php';

    if(LoginTools::isLoggedIn()){
        echo 'je suis connecté !';
    } else {
        echo 'pas connecté';
    }

?>