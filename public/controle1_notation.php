<?php
session_start();
$pseudo=$_SESSION['pseudo'];
$pseudo_autre=$_GET['autre_pseudo'];
if(isset($_POST['note']) && $_POST['note'] !=="" && $_POST['note'] >= 0 && $pseudo !== $pseudo_autre ) {
    $note=$_POST['note'];
    header("Location: profil_autre.php?arg_note=$note&autre_pseudo=$pseudo_autre");
}
elseif ($pseudo == $pseudo_autre){
    header("Location: profil_autre.php?cod_err=1&autre_pseudo=$pseudo_autre");
}
else{
    header("Location: profil_autre.php?cod_er=1&autre_pseudo=$pseudo_autre");
}

?>

