<?php
include("Modele.php");

// On récupère les variables envoyées par le formulaire
$titre = $_POST['titre'];
$theme = $_POST['theme'];
$contenu = $_POST['contenu'];

create_thread($titre,$theme,$contenu);
?>