<?php

session_start();

require('../src/model.php');
$co = new Model();
$connection = $co->dbConnect();
?>

<?php ob_start(); ?>
<?php $content = ob_get_clean();

require('template.php'); ?>