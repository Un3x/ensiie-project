<?php
session_start();
unset($_SESSION['connected']);
unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
$pitinadresse = $_SERVER['HTTP_HOST'];
header("Location: http://$pitinadresse");
exit();
?>