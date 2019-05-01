<?php

include("utils.php");


require '../vendor/autoload.php';

session_start();

unset($_SESSION['id_user']);
header("Location: index.php");

?>