<?php
require_once('Classes/Utilisateur.php');
require_once("Controller/admin_set_utilisateur.php");
require_once('Classes/Evenement.php');
require_once("Model/db_data.php");
session_start();

include('View/admin_head.php');

include('View/admin_body_titre.php');

include("View/connexion_bouton.php");


if ($_SESSION['Utilisateur'] != NULL)
{
    include("View/evenement_form.php");
}

include('View/footer.php');
?>
