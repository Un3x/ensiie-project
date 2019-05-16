<?php
include ("controllers/gestionSession.php");
include("views/vueGen.php");
include("views/inscription.php");
include("barre_navigation.php");
session_start();
enTete("Accueil");
right_corner_header();
barre_nav();
accueil();
pied();
//cas connecter:
//voir events public et prive
//creer un event
//(agenda)?
//envoyer un message a un organisateur, autre ?

//cas non connecter:
//voir events public 


?>