<?php
 if(!isset($_SESSION))session_start();
    $v_global = 'n';
    if(isset($_SESSION['compte']))
    {
            $v_global='c';
    }
    else if (isset($_SESSION['admin']))
    {
        $v_global='a';
    }
require('../controller/UserController.php');
require('../controller/ChefController.php');
require ('../view/indexView.php');// exactmeent;
require('../src/Compte/Compte.php');
require_once('../src/Compte/CompteRepository.php');
require('../src/Film/Film.php');
require('../src/Film/FilmRepository.php');
require('../src/Planing/Planing.php');
require('../src/Planing/PlaningRepository.php');
require('../src/Clients/Clients.php');
require('../src/Clients/ClientsRepository.php');
require('../src/Reservation_Place/ReservationPlaceRepository.php');
require('../src/Reservation_Place/ReservationPlace.php');
require('../src/Categorie_Film/CategorieFRepository.php');
require_once('../src/Reservation_Salle/ReservationSalleRepository.php');
require_once('../src/Reservation_Salle/ReservationSalle.php');
require_once('../src/Type_Evenement/TypeEvenementRepository.php');
require_once('../src/Type_Evenement/TypeEvenement.php');
require_once('../src/Categories/CategorieRepository.php');
require_once ('../src/Categories/Categories.php');
require_once('../src/Admin/AdminRepository.php');
require_once ('../src/Admin/Admin.php');
require_once ('../src/Fauteuils/FauteuilsRepository.php');
require_once ('../src/Fauteuils/Fauteuils.php');
require_once ('../src/Categories_Place/CategoriesPRepository.php');
require_once('../src/Categories_Place/CategoriesPlace.php');
//Routeur
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection;
try {
    $connection = new \PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
$fauteuil_objet=new \Fauteuils\Fauteuils();
$fauteuil=new \Fauteuils\FauteuilsRepository($connection);
$chefController=new \ChefController\ChefController();
$userController=new \UserController\UserController();
$film = new \Film\FilmRepository($connection);
$film_objet = new \Film\Film();
$compte=new Compte\CompteRepository($connection);
$compte_objet=new \Compte\Compte();
$planing=new Planing\PlaningRepository($connection);
$planing_objet=new Planing\Planing();
$client_objet=new \Clients\Clients();
$client=new \Clients\ClientsRepository($connection);
$reservation=new ReservationPlace\ReservationPlaceRepository($connection);
$reservation_objet=new ReservationPlace\ReservationPlace();
$reservationSalle=new \ReservationSalle\ReservationSalleRepository($connection);
$reservationSalle_obj= new \ReservationSalle\ReservationSalle();
$catFilm=new Categoriefilm\CategorieFRepository($connection);
$categoriePlace=new \categorieplace\CategoriesPRepository($connection);
$typeEvent=new \TypeEvenement\TypeEvenementRepository($connection);
$event=new \TypeEvenement\TypeEvenement();
$categorie=new \categorie\CategoriesRepository($connection);
$admin=new \Admin\AdminRepository($connection);
$admin_objet=new \Admin\Admin();
$execute=1; // Si = 0 execute pas le default
$body='';
$title="";
/*$*/
if($v_global == 'a') // les fonction d'admins
{
    if(strpos(($_SERVER['REQUEST_URI']),'/updateplaning?n_film')!==false)
    {
        $body=$chefController->updatePlaning($planing,$planing_objet);
        $execute=0;
        $title="Modifier un planning";
    }else if (strpos(($_SERVER['REQUEST_URI']),'/deleteplaning?nplaning')!==false)
    {
        $body=$chefController->deletePlaning($planing,$_GET['nplaning']);
        $execute=0;
        $title="suprimmer un planning";
    } else if(strpos(($_SERVER['REQUEST_URI']),'/deletefilm?nfilm')!==false)
    {
        $body=$chefController->deleteFilm($film,$_GET['nfilm']);
        $execute=0;
        $title="Suprimmer un film";
    } else if (strpos(($_SERVER['REQUEST_URI']),'/deleteRservation?nreservation')!==false)
    {
        $body=$chefController->removeReservationPlace($reservation,$_GET['nreservation']);
        $execute=0;
        $title="Suprimmer une réservation";
    } else if(strpos(($_SERVER['REQUEST_URI']),'/deleteRservationSalle?nreservationS')!==false)
    {
        $body=$chefController->deleteReservationSalle($reservationSalle,$_GET['nreservationS']);
        $execute=0;
        $title="Suprimmer une reservation salle";
    } else if(strpos(($_SERVER['REQUEST_URI']),'/deleteClient?nclient')!==false) {
        $body = $chefController->deleteClients($compte, $client, $connection,$_GET['nclient']);
        $execute=0;
        $title="suprimmer un client";
    }


    switch ($_SERVER['REQUEST_URI'])
    {
        case "/addnewAdmin":
            $body=$chefController->addAdmin($admin,$compte_objet,$compte,$admin_objet);
            $execute=0;
            $title="Ajouter un nouveau admin";
            break;
        case "/addPlaning" :
            $body=$chefController->addPlaning($planing, $planing_objet);
            $execute=0;
            $title="Ajouter un nouveau plannning";
            break;
        case "/deleteplaning" :
            $body=$chefController->deletePlaning($planing);
            $execute=0;
            $title="Suprimmer un plaing";
            break;
        case "/afficheplaning" :
            $body=$chefController->affichePlaning($planing);
            $execute=0;
            $title="affichage des plannings";
            break;
        case "/profil" :
            // if($v_global=='c') {
            $body=$chefController->adminPerso();
            $execute=0;
            $title=$_SESSION['nom'].$_SESSION['prenom'];
            break;
        case "/addFilm" :
            $body=$chefController->addFilm($film,$film_objet);
            $execute=0;
            $title="ajouter une nouveau film";
            break;
        case "/allReservationPlace":
            $body=$chefController->allReservationPlace($reservation,$v_global);
            $execute=0;
            $title="voir les réservations de la salle";
            break;
        case "/allReservationSalle":
            $body=$chefController->allReservationSalle($reservationSalle,$v_global);
            $execute=0;
            $title="voir les réservations des places";
            break;
        case "/allAdmins":
            $body=$chefController->allAdmin($admin,$v_global);
            $execute=0;
            $title="affichage des admins";
            break;
        case "/allClients":
            $body=$chefController->allClients($client,$v_global);
                $execute=0;
                $title="affichage des clients";
                break;
        case "/addFauteuil":
            $body=$chefController->addFauteuil($categoriePlace,$fauteuil,$fauteuil_objet);
            $execute=0;
            $title="ajouter un nouveau fauteuil";
            break;
        case "/addevent":
            $body=$chefController->addTypeEvenement($typeEvent,$event);
            $execute=0;
            $title="ajouter un nouveau évenement";
            break;
    }
}
if($v_global == 'c' || $v_global == 'a')
{
    if(stripos($_SERVER['REQUEST_URI'], '/planningClient?nplaning') !== false)
    {
        $body=$userController->planingId($planing,$_GET['nplaning']);
        $execute=0;
        $title="afficher un planning client";
    }

    switch ($_SERVER['REQUEST_URI'])
    {

        case "/voirMesReservation" :
            $body=$userController->voirMesReservationPlace($reservation,$v_global);$execute=0;$title="voir mes reservations";break;
        case "/profilclient" :
            $body=$userController->voirProfil($reservation);$title=$_SESSION['nom'].' '.$_SESSION['prenom'];$execute=0;break;
        case "/voirMesreserversalle" :
            $body=$userController->voirMesReservationPlace($reservationSalle,$v_global);$title="voir mes reservations salle";$execute=0;
            break;
    }

}
/*else
{
    $body="<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>Connectez vous <a href='../connexion'><strong>ICI</strong></a>
</div>";
$execute=0;
}*/

if(stripos($_SERVER['REQUEST_URI'], '/affichefilm?numero')!== false)
{
     $body=$userController->VoirFilm($film,$_GET['numero']);
     $execute=0;
     $title="afficher le film numero :".$_GET['numero'];
}else if (stripos($_SERVER['REQUEST_URI'], '/reservePlace?Pla2')!==false)
{
    $title="reservation de place";
        if(isset($_SESSION['ncompte'])) {

            $body=$userController->reserverPlace($reservation, $reservation_objet,$_SESSION['ncompte']);
        }
        else
            $body=$userController->connexion($compte,$client,$admin);

    $execute=0;
}
else if (stripos($_SERVER['REQUEST_URI'], '/reserveSalle?Pla2')!==false)
{
    $title="reservation de salle";
    if(isset($_SESSION['ncompte'])) {
        $body=$userController->reserverSalle($reservationSalle,$reservationSalle_obj,$_SESSION['ncompte'],$typeEvent);
    }
    else $body=$userController->connexion($compte,$client,$admin);
    $execute=0;
} if(stripos($_SERVER['REQUEST_URI'],'goFind')!==false)
{
    $title=trim(ltrim($_GET['goFind']," ") ," ");
    $body=$userController->VoirFilmTitle($film,$title);$execute=0;
}
/*else if (stripos($_SERVER['REQUEST_URI'], '/affichefilmcat?numero')!==false)
{
    $body=$userController->voirFilmCategorie($catFilm,$_GET['numero']);
    $execute=0;
}*/
switch ($_SERVER['REQUEST_URI'])
{
    /*case "/tester" : //image teste
        $userController->teste($film);$execute=0;break;*/
    case "/inscription1" ://client
        $body=$userController->inscription($compte, $client, $client_objet, $compte_objet);$execute=0;$title="inscription 1";
        break;
    case "/inscription2" :
        $body=$userController->inscription2($compte, $client, $client_objet, $compte_objet);$execute=0;$title="inscription 2";break;
    case "/connexion" :
        $body=$userController->connexion($compte,$client,$admin);$execute=0;break;$title="Connexion";
        case "/index.php" :
            $body=$userController->accueil2();
            $execute=0;
            $title="page d'accueil";
            break;
    case "/" :
        $body=$userController->accueil2();
        $execute=0;
        $title="page d'accueil";
        break;

    case "/affichePSalle" :
        $body=$userController->planingSalle($planing,$film);$execute=0;$title="afficher les plannigs";break;
        case "/accueil" :
            $body=$userController->accueil2();
            $execute=0;
            $title="page d'accueil";
            break;
        /*------- CONNEXION - INSCRIPTION------*/

        case "/deconnexion" :
            if ($v_global == 'c' || $v_global=='a') {
                $body=$chefController->deconnexion();
                break;
            } else $body=$userController->planningSemaine($planing,$film);
            break;

        case "/adminperso" :
            $body=$chefController->adminPerso();
            $execute=0;$title="Administrateur";
            break;
        /*---------------------------------*/
        /*--------ADMIN---------*/
        case "/derniernews" :
        /*------------PLANING--------------------*/

        case "/affichePday" :
            $body=$userController->planningJour($planing,$film);$execute=0;$title="le planning de jour";break;


        case "/afficheWday" :
            $body=$userController->planningSemaine($planing,$film);$execute=0;$title="le planning de la semaine";break;
        /*-------------------CLIENT-------------------*/


        /*------------------ Film -----------------*/
        case "/showFilms" :
            $body=$userController->showallFilms($film,$v_global);$execute=0;$title="affichage de film";break;
    case "/filmOfCategories" :
            $body=$userController->filmOfCat($categorie,$catFilm,$v_global);$execute=0;$title="affichage des films ";break;
}
//$execute=2;
if($execute==0) {
    require('../view/officielle.php');
}
else if($execute==1)
{
    require('../view/pageErreur.php');
}
//else
  //  require('../view/officielle.php');

/*if (isset($_GET['action'])) {
            if ($_GET['action'] == 'comment') {

                if (isset($_GET['id']) && ,$_GET['id'] > 0) {

                    poster();

                } else
                {

                    echo 'Erreur : aucun identifiant de billet envoyé';

                }

            }
            else if ($_GET['action']=='ajouter')
            {
                film();

            }
            else if($_GET['action']=='afficher')
            {
                showFilm();
            }
            else {
                Hello(2);
            }
        }else {*/
