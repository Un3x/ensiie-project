
<?php 
session_start();

require_once('../src/config.php');

if( isset($_GET['action']))
{
    if($_GET['action']=='informations')
    {
        require('informationsView.php');
    }
    if($_GET['action']=='choixInscription')
    {
        require('choix-inscriptionView.php');
    }

}
else
{
     require('accueilView.php');

}