<?php
include("../controllers/gestionSession.php");
include("../views/vueGen.php");
include("../views/creationEvent.php");
$titre="Creation event";
enTete($titre);
right_corner_header();
formulaire_creationEvent();
//maj_event();
pied();
?>