
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
        require('../src/Controller/inscriptionClientController.php');
        if( isset($_GET[‘login’]) && isset($_GET['password']))
        {
            tentativeConnexion();
        }
        else
        {
            connexionDebut();
        }
    }

    if($_GET['action']=='creatures')
    {
        require('../src/View/creaturesView.php');
    }
    if($_GET['action']=='inscriptionClient')
    {
        require('../src/Controller/inscriptionClientController.php');
        if(isset($_GET['pseudo']) && isset($_GET['password'])
        && isset($_GET['password2']) && isset($_GET['prenom'])
        && isset($_GET['nom']) && isset($_GET['age'])
        && isset($_GET['mail']) && isset($_GET['age'])
        && isset($_GET['description']))
        {
            inscriptionClient();
        }
        else
        {
            inscriptionClientDebut();
        }
    }
}
else
{
     require('../src/View/accueilView.php');

}