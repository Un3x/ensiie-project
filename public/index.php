<?php
session_start();

require_once('../src/config.php');

if( isset($_GET['action'])) {

    
    switch ($_GET['action']) {
        case 'profil' :
            if (!$GLOBALS['user']) header('Location: /connexion');

            require('../src/Controller/User/Profil/profilController.php');
            profilDebut();
            break;
        case 'changementProfil':
            if (!$GLOBALS['user']) header('Location: /connexion');

            require('../src/Controller/User/Profil/profilController.php');
            profilModifEnCours();
            break;
        case 'validationProfil':
            if (!$GLOBALS['user']) header('Location: /connexion');
            
            require('../src/Controller/User/Profil/profilController.php');
            if (isset($_POST["annuler"])) {
                profilDebut();
            } else if (isset($_POST["valider"])) {
                validationProfil();
            } else {
                profilDebut();
            }
            break;
        case 'parametre' :
            if (!$GLOBALS['user']) header('Location: /connexion');
            
            require('../src/Controller/User/Profil/parametreController.php');
            parametreDebut();
            break;
        case 'modifPassword':
            if (!$GLOBALS['user']) header('Location: /connexion');
            
            require('../src/Controller/User/Profil/parametreController.php');
            if (isset($_POST["password"]) && isset($_POST["passwordOld"]) && isset($_POST["passwordOld"]))
                parametreModifPassword();
            else
                parametreDebut();
            break;
        case 'destructionCompteDemande' :
            if (!$GLOBALS['user']) header('Location: /connexion');
            
            require('../src/View/User/Profil/destructionCompteView.php');
            break;

        case 'destructionCompte':
            if (!$GLOBALS['user']) header('Location: /connexion');

            require('../src/Controller/User/Profil/parametreController.php');
            parametreSupprimeCompte();
            break;

        case 'informations':
            require('../src/View/informationsView.php');
            break;

        case 'choixInscription':
            require('../src/View/User/Link/choixInscriptionView.php');
            break;

        case 'clients':
            require('../src/View/clientsView.php');
            break;
        
        case 'connexion':
            if( ! $GLOBALS['user'])
            {
                require('../src/Controller/User/Link/connexionController.php');
                if (isset($_POST['login']) && isset($_POST['password'])) {
                    tentativeConnexion();
                } else {
                    connexionDebut();
                }
            }
            else
            {
                require('../src/Controller/User/Profil/profilController.php');
                profilDebut();
            }
            break;

        case 'deconnexion':
            require('../src/Controller/User/Link/deconnexionController.php');
            break;

        case 'creatures':
            require('../src/View/creaturesView.php');
            break;

        case 'inscriptionClient':
            require('../src/Controller/User/Link/inscriptionClientController.php');
            if(isset($_POST['mail']) && isset($_POST['password'])
            && isset($_POST['password2']) && isset($_POST['prenom'])
            && isset($_POST['nom']) && isset($_POST["phoneNumber"]) && isset($_POST["birthDate"])
            && isset($_POST['description']) && isset($_POST["genre"]))
            {
                inscriptionClient();
            }
            else
            {
                inscriptionClientDebut();
            }
            break;

        case 'trajets':
            require('../src/Controller/User/Profil/mesTrajetsController.php');
            break;
        case 'inscriptionCarrier':
            require('../src/Controller/User/Link/inscriptionCarrierController.php');
            if(isset($_POST['password'])
                && isset($_POST['password2']) && isset($_POST['prenom'])
                && isset($_POST['nom']) && isset($_POST['genre']) && isset($_POST['phoneNumber']) && isset($_POST['birthDate'])
                && isset($_POST['mail'])
                && isset($_POST['description']) && isset($_POST['race']) && isset($_POST['price']))
            {
                inscriptionCarrier();
            }
            else {
                inscriptionCarrierDebut();
            }
            break;

        case 'userInfos':
            require('../src/Controller/User/userInfosController.php');
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

        case 'acceptCourse' :
            require('../src/Controller/course/accept.php');
            break;

        case 'refuseCourse' :
            require('../src/Controller/course/refuse.php');
            break;

        case 'cancelCourse' :
            require('../src/Controller/course/cancel.php');
            break;
            
        case 'aPropos' :
            require('../src/View/aProposView.php');
            break;
        
        case 'conditionUtilisation' :
            require('../src/View/conditionsUtilisationsView.php');
            break;
            
        case 'venteAme' :
            require('../src/View/venteAmeView.php');
            break;
            
        case 'contactezNous' :
            require('../src/View/contactezNousView.php');
            break;
            
        case 'contactezNousController' :
            require('../src/Controller/contactezNousController.php');
            break;

        case 'utilisateursAdmin' :
            if( $GLOBALS["user"] && $_SESSION["userType"] == "Admin")
            {
                require("../src/Controller/Admin/utilisateursController.php");
                allClients();
            }
            else
            {
                header("HTTP/1.1 404 Not Found");
                require('../src/Controller/404.php');
            }
            break;
        case 'vendeursAdmin' :
            if( $GLOBALS["user"] && $_SESSION["userType"] == "Admin")
            {
                require("../src/Controller/Admin/utilisateursController.php");
                allVendor();
            }
            else
            {
                header("HTTP/1.1 404 Not Found");
                require('../src/Controller/404.php');
            }
            break;
        case 'modifUserAdmin' :
            if($GLOBALS["user"] && $_SESSION['userType'] == "Admin") {
                require('../src/Controller/Admin/utilisateursController.php');
                if (isset($_GET['id']) && isset($_GET['type'])) {
                    if (isset($_POST['destruction'])) {
                        destruction($_GET['id'], $_GET['type']);
                    } else {
                        oneUser($_GET['id'], $_GET['type']);
                    }
                }
            }

            else
            {
                header("HTTP/1.1 404 Not Found");
                require('../src/Controller/404.php');
            }
            break;

        case 'coursesAdmin' :
            if($GLOBALS["user"] && $_SESSION['userType'] == "Admin") {
            require('../src/Controller/Admin/allCoursesController.php');
            }
            else
            {
                header("HTTP/1.1 404 Not Found");
                require('../src/Controller/404.php');
            }
            break;
        case 'racesAdmin':
            if($GLOBALS["user"] && $_SESSION['userType'] == "Admin") {
            require('../src/Controller/Admin/racesAdmin.php');
            allRaces();
            }
            else
            {
                header("HTTP/1.1 404 Not Found");
                require('../src/Controller/404.php');
            }

            break;

        case 'ajoutRaceAdmin':
            if($GLOBALS["user"] && $_SESSION['userType'] == "Admin") {
                require('../src/Controller/Admin/racesAdmin.php');
                if(isset($_POST['capacite']) && isset($_POST['vitesse']) && isset($_POST['nom']))
                {
                    ajoutRace();
                }
                else
                {
                    ajoutRaceDebut();
                }
            }
            else
            {
                header("HTTP/1.1 404 Not Found");
                require('../src/Controller/404.php');
            }
            break;
        case 'inscriptionAdmin':
            if($GLOBALS["user"] && $_SESSION['userType'] == "Admin") {
                require('../src/Controller/Admin/inscriptionAdminController.php');
                if(isset($_POST['mail']) && isset($_POST['password'])
                    && isset($_POST['password2']) && isset($_POST['prenom'])
                    && isset($_POST['nom']) && isset($_POST["phoneNumber"]) && isset($_POST["birthDate"])
                    && isset($_POST['description']) && isset($_POST["genre"]))
                {
                    inscriptionAdmin();
                }
                else
                {
                    inscriptionAdminDebut();
                }

            }
            else
            {
                header("HTTP/1.1 404 Not Found");
                require('../src/Controller/404.php');
            }

            break;
        case '' :
            require('../src/View/accueilView.php');
            break;

        default:
            header("HTTP/1.1 404 Not Found");
            require('../src/Controller/404.php');
            break;
    }
}
else
{
     require('../src/View/accueilView.php');

}
