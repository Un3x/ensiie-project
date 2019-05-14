<?php
  session_start();

  echo '<script>console.log("Welcome")</script>';

  if(isset($_SESSION['connected']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
    echo ("Bonjour " . $_SESSION['firstname'] ." !");
  } else {
    echo '<h1> Mais vous n\'êtes pas connecté ! </h1> ';
  }

  $pitinadresse = $_SERVER['HTTP_HOST'] . '/reset_session.php';
  echo "<a href=http://$pitinadresse> SE DECONNECTER :) </a>" ;

?>