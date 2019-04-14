
<?php 
session_start();

require_once('../src/config.php');

if( isset($_GET['action']))
{
    if($_GET['action']=='informations')
    {
        require('../src/View/informationsView.php');
    }
    if($_GET['action']=='choixInscription')
    {
        require('../src/View/choixInscriptionView.php');
    }
    if($_GET['action']=='clients')
    {
        require('../src/View/clientsView.php');
    }
    if($_GET['action']=='connexion')
    {
        require('../src/View/connexionView.php');
    }
    if($_GET['action']=='creatures')
    {
        require('../src/View/creaturesView.php');
    }
    if($_GET['action']=='inscriptionClient')
    {
        require('../src/View/inscriptionClientView.php');
    }
}
else
{
     require('../src/View/accueilView.php');

}