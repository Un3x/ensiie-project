<?php
session_start();
unset($_SESSION['connected']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
unset($_SESSION['testco']);

$pitinadresse = $_SERVER['HTTP_HOST'];
header("Location: http://$pitinadresse");
exit();
?>