<?php
include("Modele.php");

// On récupère les variables envoyées par le formulaire
$id_thread = $_POST['id_thread'];
$id_post_avant = $_POST['id_post_avant'];
$contenu = $_POST['contenu'];

create_post($id_thread,$id_post_avant,$contenu);
?>