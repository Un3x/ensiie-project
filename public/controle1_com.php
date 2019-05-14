<?php
$pseudo_autre=$_GET['autre_pseudo'];
    if(isset($_POST['commentaire']) && $_POST['commentaire'] !=="") {
        $commentaire=$_POST['commentaire'];
        header("Location: profil_autre.php?arg_com=$commentaire&autre_pseudo=$pseudo_autre");
    }
    else{
        header("Location: profil_autre.php?code_err=1&autre_pseudo=$pseudo_autre");
    }

?>