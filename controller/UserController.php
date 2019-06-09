<?php
namespace ChefController;
require_once('../view/planningView.php');
require_once('../view/filmView.php');
require_once('../view/ClientCompteView.php');
require_once('../view/allFonctionForm.php');
require_once ('../view/reservationView.php');
//require('../src/ConnectionBdd.php');
require_once('../src/Compte/CompteRepository.php');
//require_once('../src/Compte/Compte.php');
use Compte\Compte;
use Compte\CompteRepository;
use Admin\AdminRepository;
use Film\FilmRepository;
use mysql_xdevapi\Exception;

namespace UserController;

class UserController
{
    public function connexion($compte,$client,$admin)
    {
        if(isset($_POST['mdp']))
        {
            /*$ajout=new Compte();
            $ajout->setNomcompte("Radouanos");
            $ajout->setEmail("kowd@gmail.com");
            $ajout->setMotpasse("red");*/

            $ndc=$_POST['ndc'];
            $mdp=$_POST['mdp'];
            $sonCOmpte=$compte->getCompte($ndc,$mdp);
            if($sonCOmpte)
            {
                $monCompte=$client->getCompte($ndc);
                $monadmin=$admin->getAdmin($ndc);

                if($monadmin)
                {
                    if(!isset($_SESSION))session_start();
                    $_SESSION['nom']=$monadmin->getNom();
                    $_SESSION['prenom']=$monadmin->getPrenom();
                    $_SESSION['datenaissance']=$monadmin->getDatenaissance();
                    $_SESSION['adresse']=$monadmin->getAdresse();
                    $_SESSION['cp']=$monadmin->getCp();
                    $_SESSION['pays']=$monadmin->getPays();
                    $_SESSION['ncompte'] = $sonCOmpte->getNcompte();
                    $_SESSION['nomcompte'] = $sonCOmpte->getNomcompte();
                    $_SESSION['motpasse'] = $sonCOmpte->getMotpasse();
                    $_SESSION['email'] = $sonCOmpte->getEmail();
                    $_SESSION['admin']='a';
                    echo '<script language="Javascript"> document.location.replace("../profilclient");</script>';
                }
                else if($monCompte)
                {
                    if(!isset($_SESSION))session_start();
                    $_SESSION['nom']=$monCompte->getNom();
                $_SESSION['prenom']=$monCompte->getPrenom();
                $_SESSION['datenaissance']=$monCompte->getDatenaissance();
                $_SESSION['adresse']=$monCompte->getAdresse();
                $_SESSION['cp']=$monCompte->getCp();
                $_SESSION['pays']=$monCompte->getPays();
                $_SESSION['ncompte'] = $sonCOmpte->getNcompte();
                $_SESSION['nomcompte'] = $sonCOmpte->getNomcompte();
                $_SESSION['motpasse'] = $sonCOmpte->getMotpasse();
                $_SESSION['email'] = $sonCOmpte->getEmail();
                $_SESSION['compte']='c';
                echo '<script language="Javascript"> document.location.replace("../profilclient");</script>';
                }else return  "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>  Vous devez Completez la partie profil de votre compte
</div>".vue_connexion();
            }
            else return  "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong> Le nom de compte ou le mot de passe entré ne correspond à aucun compte. <a href='../inscription1'>Veuillez créer un compte.</a>
</div>".vue_connexion();
        }
        else return vue_connexion();
    }
    public function inscription($compte,$client,$client_objet,$compte_objet)
    {
        if(isset($_POST['nomcompte']))
        {
            $ndc=$_POST['nomcompte'];
            $mdp=$_POST['motpasse'];
            $mdp2=$_POST['motpasse2'];
            $mail = $_POST['email'];
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#',$mdp)) {

                if ($mdp == $mdp2) {

                    $compte_objet->setNomcompte($ndc);
                    $compte_objet->setMotpasse($mdp);
                    $compte_objet->setEmail($mail);
                    $add_compte = $compte->add($compte_objet);
                    if ($add_compte) {
                        if (!isset($_SESSION)) session_start();
                        $_SESSION['ndc'] = $ndc;
                        $_SESSION['mdp'] = $mdp;
                        $_SESSION['compte'] = 'c';
                        $_SESSION['email']=$mail;
                        echo '<script language="Javascript"> document.location.replace("../inscription2");</script>';
                    } else return "<div class=\"alert alert-danger\">
  <strong>Erreur ! </strong> Réspectez les champs de texte
</div>" . vue_inscription1();
                } else return "<div class=\"alert alert-danger\">
  <strong>Erreur ! </strong>Vous avez tapé 2 différents mot de passe 
</div>" . vue_inscription1();
            }else return "<div class=\"alert alert-danger\">
  <strong>Erreur ! Mot de passe non conforme </strong> un bon mot de passe contient des majuscules, des minuscules et au moins 1 chiffre
</div>" . vue_inscription1();

        }

        else
        {
            return vue_inscription1();
        }
    }
    public function inscription2($compte,$client,$client_objet,$compte_objet)
    {
        if(isset($_POST['nom']))
        {
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $ddn=$_POST['datenaissance'];
            $adresse = $_POST['adresse'];
            $cp= $_POST['cp'];
            $pays= $_POST['pays'];

            $sonCOmpte=$compte->getCompte($_SESSION['ndc'],$_SESSION['mdp']);
            $ncompte=$sonCOmpte->getNcompte();
            $client_objet->setNcompte($ncompte);
            $client_objet->setAdresse($adresse);
            $client_objet->setCp($cp);
            $client_objet->setNom($nom);
            $client_objet->setPays($pays);
            $client_objet->setPrenom($prenom);
            $client_objet->setDatenaissance($ddn);
            $add_cliet=$client->add($client_objet);
            if($add_cliet)
            {
                if(!isset($_SESSION))session_start();
                $_SESSION['nom']=$nom;
                $_SESSION['prenom']=$prenom;
                $_SESSION['ncompte']=$ncompte;
                $_SESSION['cp']=$cp;
                $_SESSION['datenaissance']=$ddn;
                $_SESSION['adresse']=$adresse;
                $_SESSION['pays']=$pays;
                echo '<script language="Javascript"> document.location.replace("../profilclient");</script>';
                // }else echo "SESSION EXISTE";
            }
        }
        else if(isset($_SESSION['ndc']))
        {
            return vue_inscription2();
        }
        else
        {
            return vue_inscription1();
        }



    }
    public function voirProfil($place)
    {
        if(isset($_SESSION)) {
            $combien=$place->nombreReservation($_SESSION['ncompte']);
            return profilClient($combien);
        }
    }
    public function voirMesReservationPlace($reservation,$v)
    {
        if(isset($_SESSION))
        {
                $reservation_objet=$reservation->allReservationOfCLient($_SESSION['ncompte']);
                if($reservation_objet) {
                    return voirReserv($reservation_objet,$v);
                }else return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>Vous n'avez pas de reservation
</div>";

        }
        else return vue_connexion();
    }
    public function voirMesReservationSalle($reservation,$v)
    {
        if(isset($_SESSION))
        {
            $reservation_objet=$reservation->allReservationOfCLient($_SESSION['ncompte']);
            if($reservation_objet) {
                return voirReserv($reservation_objet,$v);
            }else return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>Vous n'avez pas de reservation
</div>";

        }
        else return vue_connexion();
    }
    public function accueil($objet,$id)
    {
        global $req;
        echo "<h1>MON FILM PREFERE</h1>";
        $nombre=$objet->showFilm($id);
        if($nombre==true)
        {

            echo '<script language="Javascript"> document.location.replace("../affichePday");</script>';
        }
        else echo "film Does not exist";
    }
    public function accueil2()
    {
        return decale();
    }
    public function planningSemaine($planing,$film)
    {
        $today=date('Y-m-d');
        $plan_week=$planing->showPlaningOfWeek($today,date('Y-m-d', strtotime($today.' +6 days')));
        if($plan_week) {
            $max = sizeof($plan_week);
            $i = 0;
            $films = [];
            while ($i < $max) {
                $films[] = $film->showFilm($plan_week[$i]->getFilm());
                $i++;
            }
            if(isset($_POST['reserver']))
            {
                echo '<script language="Javascript"> document.location.replace("../reservePlace?Pla2='.$_POST['reserver'].'");</script>';
            }
            else return afficheWday($plan_week, $films);
        } else return "<div class=\"alert alert-warning\" role=\"alert\">PAs de planning pour cette semaine</div>";
    }
    public function planningJour($planing,$film)
    {
        $plan_day=$planing->showPlaningOfDate(date('Y-m-d'));
        if($plan_day)
        {
            if(isset($_POST['reserver']))
            {
                echo '<script language="Javascript"> document.location.replace("../reservePlace?Pla2='.$plan_day->getNplaning().'");</script>';
            }
            else {
                $unFilm=$film->showFilm($plan_day->getFilm());
                return affichePday($plan_day,$unFilm);
            }
        } else return "<div class=\"alert alert-warning\" role=\"alert\">PAs de planning pour aujourd'hui</div>";
    }
    public function planingSalle($planing,$film)
    {
        $today=date('Y-m-d');
        $plan_salle=$planing->showAllPlaningSalle($today);
        if($plan_salle) {

            $max = sizeof($plan_salle);
            $i = 0;
            $films = [];
            while ($i < $max) {
                $films[] = $film->showFilm($plan_salle[$i]->getFilm());
                $i++;
            }
            if(isset($_POST['reserver']))
            {
                echo '<script language="Javascript"> document.location.replace("../reserveSalle?Pla2='.$plan_salle[0]->getNplaning().'");</script>';
            }
            else return affichePsalle($plan_salle, $films);
        }else return "<div class=\"alert alert-warning\" role=\"alert\">Aucun planing de salle aujourd'hui</div>";
    }
    public function planingId($planing,$id)
    {
        $plan=$planing->showPlaningById($id);
        if($plan)
        {
            return afficheTableUnPlan($plan);
        }
        else
            return "<div class=\"alert alert-warning\" role=\"alert\">Aucun planing existe</div>";
    }
    public function VoirFilm($film,$id)
    {
        $fl = $film->showFilm($id);
        if ($fl) {
            return oneFIlm($fl);
        }
        else return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>Merci de vérifier que vous avez tapez un film qui existe dans la table
</div>";
    }
    public function showallFilms($film,$v)
    {
        $films=$film->showAllfilms();
        if($films)
        {
            return affiche_films($films,$v);
        }
        else return "<div class=\"alert alert-danger\">
  <strong>Erreur : !</strong> Table des films est vide !
</div>";
    }
    public function VoirFilmTitle($film,$title)
    {
        $f=$film->idFilmByName($title);
        $fl=$film->showFilm($f);
        if ($fl) {
            return oneFIlm($fl);
        }
        else return "<div class=\"alert alert-danger\">
  <strong>Erreur : ".$title." !</strong>  Merci de vérifier que vous avez tapez un film qui existe dans <a href='../showFilms' >la table</a>
</div>";
    }
    public function reserverSalle($reservation,$objet,$client,$typeEvent)
    {
        $idplaning=$_GET['Pla2'];
        $events=$typeEvent->showAllEvents();
        if(isset($_POST['nomevent']))
        {
            $objet->setClient($client);
                $objet->setPlaning($idplaning);
                    $objet->setNomevenement($_POST['nomevent']);
                        $objet->setTypeevenement($_POST['tevent']);
                            $exec=$reservation->add($objet);
                                if($exec)
                                    {
                                        return "<div class=\"alert alert-success\">
                            <strong>SALLE RÉSERVÉ ! </strong>
                            </div>";
                                    }else
            return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>aucun résultat trouvé veuillez vérifier les données
</div>";
        }
        else return formreserverSalle($events);
       // echo "Les Reservation possible :";
    }
    public function reserverPlace($reservation,$objet,$client)
    {
        $idplaning=$_GET['Pla2'];
        if(isset($_POST['nfauteuil']))
        {
            $objet->setClient($client);
                $objet->setFauteuil($_POST['nfauteuil']);
                        $objet->setPlaning($idplaning);
                        $exec=$reservation->add($objet);
                        if($exec)
                        {
                            return "<div class=\"alert alert-success\">
                            <strong>PLACE RESERVÉ!</strong>
                            </div>";
                        }
                        else
                            return "<div class=\"alert alert-danger\">
  <strong>Erreur !</strong>veuillez vérifier les données
</div>";

        }
        else return formreserverPlace();
    }
    public function filmOfCat($categorie,$catFilm,$v)
    {
        $fl=$categorie->allCategories();
        if(isset($_POST['filmcat']))
        {
                $tabs=$catFilm->showFilmsOfCategorie($_POST['filmcat']);
                if($tabs) {
                    $v1=filmOfCate($fl);
                    $v2=affiche_films($tabs,$v);
                    return $v2.$v1;
                }else return "
<div class=\"alert alert-warning\">
  <strong>Aucun film !</strong> la liste des films Correspondent à votre choix est vide .
</div>".filmOfCate($fl);

        }else return filmOfCate($fl);
    }

}