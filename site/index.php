<?php
require_once('Classes/Utilisateur.php');
require_once('Classes/Evenement.php');
session_start();

require_once('Model/db_data.php');
require_once("Controller/set_utilisateur.php");
include('Model/infos_njv.php');

include('View/page_titre.php');

include('View/head.php');

include('View/body_titre.php');

include("View/connexion_bouton.php");

include('View/deadline_commande.php');

if (isset($_SESSION['Utilisateur']))
{
    
    include('View/commande_finie.php');
	$parts = db_getAllFoods();
	$specials = db_getAllSpecials();
    include('View/commande_form.php');
}
else 
{
    include("View/not_connected.php");
}

include('View/footer.php');
?>