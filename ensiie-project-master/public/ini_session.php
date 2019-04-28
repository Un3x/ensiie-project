<?php
    session_start();
    if( !isset( $_SESSION['Active']) ) {
        $_SESSION['Active'] = false;
    }
?>