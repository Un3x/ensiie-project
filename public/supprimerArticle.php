<?php
require '../src/User/projetControl.php';
$type = $_POST['type'];
$reference = $_POST['reference'];

supprimerArticle( $type, $reference);
?>