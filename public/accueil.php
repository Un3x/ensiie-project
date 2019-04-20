<?php

session_start();

require('../src/model.php');
$co = new Model();
$connection = $co->dbConnect();
?>

<?php ob_start(); ?>
    caca
<?php $content = ob_get_clean();

require('template.php'); ?>