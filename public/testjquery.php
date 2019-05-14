<?php
  $fname = $_POST['fname'];
  if ($fname == 'Amine'){
    echo "<script type=\"text/javascript\">alert(\"BITOKU\"); </script>";
  } else {
    echo "<script type=\"text/javascript\">alert(\"BOUDUCON\"); </script>";
  }
?>