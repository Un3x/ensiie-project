<?php
    require '../src/generalTools.php';
    if(!LoginTools::isLoggedIn()){
        require 'reset_session.php';
    }
?>