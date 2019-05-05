<?php
session_start();

require_once('../src/config.php');

if( isset($_GET['action']))
{
    switch($_GET['action']){
        case 'informations':
            require('../src/View/informationsView.php');
            break;

        case 'choixInscription':
            require('../src/View/choixInscriptionView.php');
            break;

        case 'clients':
            require('../src/View/clientsView.php');
            break;
        
        case 'connexion':
            require('../src/Controller/inscriptionClientController.php');
            if( isset($_GET['login']) && isset($_GET['password']))
            {
                tentativeConnexion();
            }
            else
            {
                connexionDebut();
            }
            break;

        case 'creatures':
            require('../src/View/creaturesView.php');
            break;

        case 'inscriptionClient':
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
            break;
        
        case 'searchCourse':
            require('../src/Controller/course/searchCourse.php');
            break;

        case 'infoCourse' :
            require('../src/Controller/course/infoCourse.php');
            break;

        case 'payment' :
            require('../src/Controller/course/payment.php');
            break;
        
        case 'confirmationCourse' :
            require('../src/Controller/course/confirmationCourse.php');
            break;
        
        case '' :
            require('../src/View/accueilView.php');
            break;

        default:
            require('../src/Controller/404.php');
            break;
    }
}
else
{
     require('../src/View/accueilView.php');

}
