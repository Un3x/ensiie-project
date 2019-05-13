<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>


<?php ob_start(); ?>

<div>
nom : <?=$name?> <br/>
réputation : <?=$reputation?> <br/>
âge : <?=$age?> <br/>
description : <?=$description?> <br/>
genre : <?=$gender?> <br/>
date de création : <?=$creationDate?> <br/>

<?=$_GET['userType']=='Client'? "nombre de trajets : $nbCourses <br/>" : ""?>

<?=$_GET['userType']=='Vendor' ? "nombre de trajets : $nbCourses <br/>
    race : $race <br/>
    prix : $price <br/>" : "" ?>

</div>




<?php $content = ob_get_clean(); ?>

<?php require("../src/View/template.php"); ?>
